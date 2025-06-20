<?php
require_once __DIR__ . '/../../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = trim($_POST['titulo']);
    $descricao = trim($_POST['descricao']);

    // Validação dos campos
    if (empty($titulo) || empty($descricao)) {
        die("Título e descrição são obrigatórios.");
    }

    if (strlen($titulo) > 100) {
        die("O título não pode ter mais de 100 caracteres.");
    }

    // Upload da imagem
    $imagem = null;
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == UPLOAD_ERR_OK) {
        $ext = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
        $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        // Verifica se é uma imagem válida
        $check = getimagesize($_FILES['imagem']['tmp_name']);
        if ($check === false) {
            die("O arquivo não é uma imagem válida.");
        }

        if (!in_array(strtolower($ext), $extensoesPermitidas)) {
            die("Extensão não permitida.");
        }

        if ($_FILES['imagem']['size'] > 2 * 1024 * 1024) { // Limite de 2MB
            die("Imagem muito grande. Máximo 2MB.");
        }

        $nomeImagem = uniqid('servico_') . '.' . $ext;
        $caminhoImagem = __DIR__ . '/../../../../Frontend/assets/Repositorio_de_Fotos/' . $nomeImagem;

        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoImagem)) {
            $imagem = $nomeImagem;
        } else {
            die("Erro ao salvar a imagem.");
        }
    }

    $stmt = $pdo->prepare("INSERT INTO servicos (titulo, descricao, imagem) VALUES (?, ?, ?)");
    if ($stmt->execute([$titulo, $descricao, $imagem])) {
        header("Location: /Frontend/admin/servicos/servicos-tab.php");
        exit;
    } else {
        echo "Erro ao inserir serviço.";
    }
} else {
    header("Location: form.php");
    exit;
}
?>

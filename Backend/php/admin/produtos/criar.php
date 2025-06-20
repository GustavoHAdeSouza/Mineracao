<?php
require_once __DIR__ . '/../../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST['nome']);
    $descricao = trim($_POST['descricao']);

    if (empty($nome) || empty($descricao)) {
        die("Nome e descrição são obrigatórios.");
    }

    if (strlen($nome) > 100) {
        die("O nome não pode ter mais de 100 caracteres.");
    }

    // Upload da imagem
    $imagem = null;
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == UPLOAD_ERR_OK) {
        $ext = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
        $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        $check = getimagesize($_FILES['imagem']['tmp_name']);
        if ($check === false) {
            die("O arquivo não é uma imagem válida.");
        }

        if (!in_array(strtolower($ext), $extensoesPermitidas)) {
            die("Extensão não permitida.");
        }

        if ($_FILES['imagem']['size'] > 2 * 1024 * 1024) {
            die("Imagem muito grande. Máximo 2MB.");
        }

        $nomeImagem = uniqid('produto_') . '.' . $ext;
        $caminhoImagem = __DIR__ . '/../../../../Frontend/assets/Repositorio_de_Fotos/' . $nomeImagem;

        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoImagem)) {
            $imagem = $nomeImagem;
        } else {
            die("Erro ao salvar a imagem.");
        }
    }

    $stmt = $pdo->prepare("INSERT INTO produtos (nome, descricao, imagem) VALUES (?, ?, ?)");
    if ($stmt->execute([$nome, $descricao, $imagem])) {
        header("Location: /Frontend/admin/produtos/produtos-tab.php");
        exit;
    } else {
        echo "Erro ao inserir produto.";
    }
} else {
    header("Location: form.php");
    exit;
}
?>

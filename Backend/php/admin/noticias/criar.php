<?php
require_once __DIR__ . '/../../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = trim($_POST['titulo']);
    $conteudo = trim($_POST['conteudo']);

    if (empty($titulo) || empty($conteudo)) {
        die("Título e conteúdo são obrigatórios.");
    }

    if (strlen($titulo) > 150) {
        die("O título não pode ter mais de 150 caracteres.");
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

        $nomeImagem = uniqid('noticia_') . '.' . $ext;
        $caminhoImagem = __DIR__ . '/../../../../Frontend/assets/Repositorio_de_Fotos/' . $nomeImagem;

        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoImagem)) {
            $imagem = $nomeImagem;
        } else {
            die("Erro ao salvar a imagem.");
        }
    }

    $stmt = $pdo->prepare("INSERT INTO noticias (titulo, conteudo, imagem) VALUES (?, ?, ?)");
    if ($stmt->execute([$titulo, $conteudo, $imagem])) {
        header("Location: /Frontend/admin/noticias/noticias-tab.php");
        exit;
    } else {
        echo "Erro ao inserir notícia.";
    }
} else {
    header("Location: form.php");
    exit;
}
?>

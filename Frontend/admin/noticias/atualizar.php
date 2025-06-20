<?php

require_once __DIR__ . '/../../../Backend/php/auth-admin.php';
require_once __DIR__ . '/../../../Backend/php/config.php';

// Verifica se o ID foi passado na URL
if (!isset($_GET['id'])) {
    die('ID da notícia não fornecido.');
}

$id = intval($_GET['id']);

// Busca a notícia no banco
try {
    $stmt = $pdo->prepare("SELECT * FROM noticias WHERE id = ?");
    $stmt->execute([$id]);
    $noticia = $stmt->fetch();

    if (!$noticia) {
        die('Notícia não encontrada.');
    }
} catch (PDOException $e) {
    die("Erro ao buscar notícia: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Atualizar Notícia</title>
</head>
<body>
    <h1>Atualizar Notícia</h1>

    <form action="/Backend/php/admin/noticias/atualizar.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= htmlspecialchars($noticia['id']) ?>">

        <label for="titulo">Título:</label><br>
        <input type="text" id="titulo" name="titulo" value="<?= htmlspecialchars($noticia['titulo']) ?>" required><br><br>

        <label for="conteudo">Conteúdo:</label><br>
        <textarea id="conteudo" name="conteudo" rows="5" cols="40" required><?= htmlspecialchars($noticia['conteudo']) ?></textarea><br><br>

        <label for="imagem">Imagem:</label><br>
        <input type="file" name="imagem" accept="image/*"><br><br>

        <input type="submit" value="Atualizar">
    </form>

    <br>
    <a href="index.php">Voltar</a>
</body>
</html>

<?php 

require_once __DIR__ . '/../../../Backend/php/auth-admin.php';

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Criar Notícia</title>
</head>
<body>

<h1>Criar Notícia</h1>

<form action="/Backend/php/admin/noticias/criar.php" method="POST" enctype="multipart/form-data">
    Título:<br>
    <input type="text" name="titulo" required><br><br>

    Conteúdo:<br>
    <textarea name="conteudo" rows="5" cols="40" required></textarea><br><br>

    Imagem:<br>
    <input type="file" name="imagem" accept="image/*"><br><br>

    <input type="submit" value="Salvar">
</form>

<a href="index.php">Voltar</a>

</body>
</html>

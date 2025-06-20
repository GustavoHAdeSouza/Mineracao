<?php 

require_once __DIR__ . '/../../../Backend/php/auth-admin.php';

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Criar Produtos</title>
</head>
<body>

<h1>Criar Produtos</h1>

<form action="/Backend/php/admin/produtos/criar.php" method="POST" enctype="multipart/form-data">
    Nome:<br>
    <input type="text" name="nome" required><br><br>

    Descrição:<br>
    <textarea name="descricao" rows="5" cols="40" required></textarea><br><br>

    Imagem:<br>
    <input type="file" name="imagem" accept="image/*"><br><br>

    <input type="submit" value="Salvar">
</form>

<a href="index.php">Voltar</a>

</body>
</html>

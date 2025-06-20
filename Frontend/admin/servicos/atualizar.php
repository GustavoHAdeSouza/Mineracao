<?php

require_once __DIR__ . '/../../../Backend/php/auth-admin.php';
require_once __DIR__ . '/../../../Backend/php/config.php';

// Verifica se o ID foi passado na URL
if (!isset($_GET['id'])) {
    die('ID da serviço não fornecido.');
}

$id = intval($_GET['id']);

// Busca o serviço no banco
try {
    $stmt = $pdo->prepare("SELECT * FROM servicos WHERE id = ?");
    $stmt->execute([$id]);
    $descricao = $stmt->fetch();

    if (!$descricao) {
        die('Serviço não encontrada.');
    }
} catch (PDOException $e) {
    die("Erro ao buscar serviço: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Atualizar serviço</title>
</head>
<body>
    <h1>Atualizar serviço</h1>

    <form action="/Backend/php/admin/servicos/atualizar.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= htmlspecialchars($descricao['id']) ?>">

        <label for="titulo">Título:</label><br>
        <input type="text" id="titulo" name="titulo" value="<?= htmlspecialchars($descricao['titulo']) ?>" required><br><br>

        <label for="descricao">Descrição:</label><br>
        <textarea id="descricao" name="descricao" rows="5" cols="40" required><?= htmlspecialchars($descricao['descricao']) ?></textarea><br><br>

        <label for="imagem">Imagem:</label><br>
        <input type="file" name="imagem" accept="image/*"><br><br>
        
        <input type="submit" value="Atualizar">
    </form>

    <br>
    <a href="index.php">Voltar</a>
</body>
</html>

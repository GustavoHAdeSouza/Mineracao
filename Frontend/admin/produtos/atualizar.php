<?php

require_once __DIR__ . '/../../../Backend/php/auth-admin.php';
require_once __DIR__ . '/../../../Backend/php/config.php';

// Verifica se o ID foi passado na URL
if (!isset($_GET['id'])) {
    die('ID da produto não fornecido.');
}

$id = intval($_GET['id']);

// Busca a produto no banco
try {
    $stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = ?");
    $stmt->execute([$id]);
    $produto = $stmt->fetch();

    if (!$produto) {
        die('Produto não encontrada.');
    }
} catch (PDOException $e) {
    die("Erro ao buscar produto: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Atualizar Produto</title>
</head>
<body>
    <h1>Atualizar Produto</h1>

    <form action="/Backend/php/admin/produtos/atualizar.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= htmlspecialchars($produto['id']) ?>">

        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($produto['nome']) ?>" required><br><br>

        <label for="descricao">Descrição:</label><br>
        <textarea id="descricao" name="descricao" rows="5" cols="40" required><?= htmlspecialchars($produto['descricao']) ?></textarea><br><br>

        <label for="imagem">Imagem:</label><br>
        <input type="file" name="imagem" accept="image/*"><br><br>
        
        <input type="submit" value="Atualizar">
    </form>

    <br>
    <a href="index.php">Voltar</a>
</body>
</html>

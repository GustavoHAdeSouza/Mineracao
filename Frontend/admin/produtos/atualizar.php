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
    <link rel="stylesheet" href="../../assets/css/admin.css">
</head>
<body>

    <div class="admin-header">
        <div class="container"><h1 class="admin-title">Painel Administrativo</h1><h2>Gestão de Conteúdo</h2></div>
    </div>
    <div class="container">

        <div class="admin-panel">
            <h1>Atualizar Produto</h1>
            <br>
            <form action="/Backend/php/admin/produtos/atualizar.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= htmlspecialchars($produto['id']) ?>">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" class="form-control" value="<?= htmlspecialchars($produto['nome']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="descricao">Descrição:</label>
                    <textarea id="descricao" name="descricao" class="form-control" required><?= htmlspecialchars($produto['descricao']) ?></textarea>
                </div>
                <div class="form-group">
                    <label for="imagem">Imagem:</label>
                    <input type="file" name="imagem" accept="image/*" class="form-control">
                </div>
                <br>
                <input type="submit" value="Atualizar" class="btn btn-primary">
            </form>
            <br>
            <a href="produtos-tab.php" class="btn btn-secondary">Voltar</a>
        </div>
    </div>

</body>
</html>

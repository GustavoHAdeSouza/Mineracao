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
    <link rel="stylesheet" href="../../assets/css/admin.css">
</head>
<body>    

    <div class="admin-header">
        <div class="container"><h1 class="admin-title">Painel Administrativo</h1><h2>Gestão de Conteúdo</h2></div>
    </div>
    <div class="container">
        
        <div class="admin-panel">
            <h1>Atualizar serviço</h1>
            <br>
            <form action="/Backend/php/admin/servicos/atualizar.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= htmlspecialchars($descricao['id']) ?>">
                <div class="form-group">
                    <label for="titulo">Título:</label>
                    <input type="text" id="titulo" name="titulo" class="form-control" value="<?= htmlspecialchars($descricao['titulo']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="descricao">Descrição:</label>
                    <textarea id="descricao" name="descricao" class="form-control" required><?= htmlspecialchars($descricao['descricao']) ?></textarea>
                </div>
                <div class="form-group">
                    <label for="imagem">Imagem:</label>
                    <input type="file" name="imagem" accept="image/*" class="form-control">
                </div>
                <br>
                <input type="submit" value="Atualizar" class="btn btn-primary">
            </form>
            <br>
            <a href="servicos-tab.php" class="btn btn-secondary">Voltar</a>
        </div>
    </div>
    
</body>
</html>

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
    <link rel="stylesheet" href="../../assets/css/admin.css">
</head>
<body>

    <div class="admin-header">
        <div class="container"><h1 class="admin-title">Painel Administrativo</h1><h2>Gestão de Conteúdo</h2></div>
    </div>
    <div class="container">

        <div class="admin-panel">
            <h1>Atualizar Notícia</h1>
            <br>
            <form action="/Backend/php/admin/noticias/atualizar.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= htmlspecialchars($noticia['id']) ?>">
                <div class="form-group">
                    <label for="titulo">Título:</label>
                    <input type="text" id="titulo" name="titulo" class="form-control" value="<?= htmlspecialchars($noticia['titulo']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="conteudo">Conteúdo:</label>
                    <textarea id="conteudo" name="conteudo" class="form-control" required><?= htmlspecialchars($noticia['conteudo']) ?></textarea>
                </div>
                <div class="form-group">
                    <label for="imagem">Imagem:</label>
                    <input type="file" name="imagem" accept="image/*" class="form-control">
                </div>
                <br>
                <input type="submit" value="Atualizar" class="btn btn-primary">
            </form>
            <br>
            <a href="noticias-tab.php" class="btn btn-secondary">Voltar</a>
        </div>
    </div>

</body>
</html>


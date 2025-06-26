<?php 

require_once __DIR__ . '/../../../Backend/php/auth-admin.php';

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Produto</title>
    <link rel="stylesheet" href="../../assets/css/admin.css">
</head>
<body>

    <div class="admin-header">
        <div class="container"><h1 class="admin-title">Painel Administrativo</h1><h2>Gestão de Conteúdo</h2></div>
    </div>
    <div class="container">

        <div class="admin-panel">
            <h1>Criar Produtos</h1>
            <br>
            <form action="/Backend/php/admin/produtos/criar.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <span>Nome:</span>
                    <input type="text" name="nome" class="form-control" required>
                </div>
                <div class="form-group">
                    <span>Descrição:</span>
                    <textarea name="descricao" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <span>Imagem:</span>
                    <input type="file" name="imagem" accept="image/*" class="form-control">
                </div>
                <br>
                <input type="submit" value="Salvar" class="btn btn-primary">
            </form>
            <br>
            <a href="produtos-tab.php" class="btn btn-secondary">Voltar</a>
        </div>
    </div>

</body>
</html>

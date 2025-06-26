<?php

require_once __DIR__ . '../../../../Backend/php/auth-admin.php';
require_once __DIR__ . '../../../../Backend/php/admin/produtos/produtos-tab-query.php';
require_once __DIR__ . '../../../../Backend/php/keycloak-config.php';


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administração - Mineração Areias</title>
    <link rel="stylesheet" href="../../assets/css/admin.css">
</head>
<body>

    <script>
    function logout() {
        if (confirm("Você realmente quer sair do sistema?") == true) {
            window.location.href = "<?php echo $keycloakAuthClientArray['kcUrlLogout']; ?>";
        }
    }
    </script>
    
    <header>
        <div class="container">
            <div class="header-content">
                <div>
                        <img class="logo" src="../../assets/Repositorio_de_Fotos/logo.png">
                </div>
                <nav>
                    <ul>
                        <li><a href="../../../index.php">Home</a></li>
                        <li><a href="../../pages/sobre.php">Sobre nós</a></li>
                        <li><a href="../../pages/servicos.php">Serviços</a></li>
                        <li><a href="../../pages/noticias.php">Notícias</a></li>
                        <li><a href="../../pages/contatos.php">Contatos</a></li>
                        <li><a style="cursor:pointer" onclick="logout()">Sair</a></li>
                    </ul>
                    <button class="mobile-menu-btn">≡</button>
                </nav>
            </div>
        </div>
    </header>
    
    <div class="admin-header">
        <div class="container">
            <h1 class="admin-title">Painel Administrativo</h1>
            <h2>Gestão</h2>
        </div>
    </div>
            
            <div class="admin-tabs">
                <div class="admin-tab active" onclick="window.location.href='../produtos/produtos-tab.php'">Produtos</div>
                <div class="admin-tab" onclick="window.location.href='../servicos/servicos-tab.php'">Serviços</div>
                <div class="admin-tab" onclick="window.location.href='../noticias/noticias-tab.php'">Notícias</div>
            </div>
            
<div id="produtosTab" class="admin-panel active">
    <div class="search-box">
        <form method="GET" action="">
            <input type="text" name="buscarProd" placeholder="Buscar produto..." value="<?= htmlspecialchars($buscarProd) ?>">
            <button type="submit">Buscar</button>
        </form>
    </div>

    <a href="/Frontend/admin/produtos/criar.php">
        <button class="btn btn-secondary">Criar Novo Produto</button>
    </a>

    <br><br>

    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Data Criada</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($produtos) > 0): ?>
                <?php foreach ($produtos as $produto): ?>
                    <tr>
                        <td><?= htmlspecialchars($produto['id']) ?></td>
                        <td><?= htmlspecialchars($produto['nome']) ?></td>
                        <td title="<?= htmlspecialchars($produto['descricao']) ?>">
                            <?= htmlspecialchars(mb_strimwidth($produto['descricao'], 0, 20, '...')) ?>
                        </td>
                        <td><?= htmlspecialchars(date('d/m/Y', strtotime($produto['data_criacao']))) ?></td>
                        <td>
                            <div class="action-buttons">
                                <a href="atualizar.php?id=<?= $produto['id'] ?>">
                                    <button class="btn btn-secondary">Editar</button>
                                </a>
                                <a href="../../../Backend/php/admin/produtos/deletar.php?id=<?= $produto['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir?')">
                                    <button class="btn btn-danger">Remover</button>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Nenhum produto encontrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="pagination">
        <?php if ($pageProd > 1): ?>
            <a href="?pageProd=<?= $pageProd - 1 ?>&buscarProd=<?= urlencode($buscarProd) ?>" class="pagination-btn">Anterior</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPaginasProd; $i++): ?>
            <a href="?pageProd=<?= $i ?>&buscarProd=<?= urlencode($buscarProd) ?>" class="pagination-btn <?= ($i === $pageProd) ? 'active' : '' ?>">
                <?= $i ?>
            </a>
        <?php endfor; ?>

        <?php if ($pageProd < $totalPaginasProd): ?>
            <a href="?pageProd=<?= $pageProd + 1 ?>&buscarProd=<?= urlencode($buscarProd) ?>" class="pagination-btn">Próximo</a>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
<?php

require_once __DIR__ . '../../../../Backend/php/auth-admin.php';
require_once __DIR__ . '../../../../Backend/php/admin/noticias/noticias-tab-query.php';
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
                <div class="admin-tab" onclick="window.location.href='../produtos/produtos-tab.php'">Produtos</div>
                <div class="admin-tab" onclick="window.location.href='../servicos/servicos-tab.php'">Serviços</div>
                <div class="admin-tab active" onclick="window.location.href='../noticias/noticias-tab.php'">Notícias</div>
            </div>

<div id="noticiasTab" class="admin-panel active">
    <div class="search-box">
        <!-- Formulário GET para busca -->
        <form method="GET" action="">
            <input type="text" name="buscar" placeholder="Buscar notícias" value="<?= htmlspecialchars($buscar) ?>">
            <button type="submit">Buscar</button>
        </form>
    </div>

    <a href="/Frontend/admin/noticias/criar.php"><button class="btn btn-secondary">Criar Nova Notícia</button></a>
    <br><br>

    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Título</th>
                <th>Conteúdo</th>
                <th>Data Criada</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($noticias) > 0): ?>
                <?php foreach ($noticias as $noticia): ?>
                    <tr>
                        <td><?= htmlspecialchars($noticia['id']) ?></td>
                        <td><?= htmlspecialchars($noticia['titulo']) ?></td>
                        <td title="<?= htmlspecialchars($noticia['conteudo']) ?>">
                            <?= htmlspecialchars(mb_strimwidth($noticia['conteudo'], 0, 20, '...')) ?>
                        </td>
                        <td><?= htmlspecialchars($noticia['data_criacao']) ?></td>
                        <td>
                            <div class="action-buttons">
                                <a href="atualizar.php?id=<?= $noticia['id'] ?>">
                                    <button class="btn btn-secondary">Editar</button>
                                </a>
                                <a href="../../../Backend/php/admin/noticias/deletar.php?id=<?= $noticia['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir?')">
                                    <button class="btn btn-danger">Remover</button>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Nenhuma notícia encontrada.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="?page=<?= $page - 1 ?>&buscar=<?= urlencode($buscar) ?>" class="pagination-btn">Anterior</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
            <a href="?page=<?= $i ?>&buscar=<?= urlencode($buscar) ?>" class="pagination-btn <?= ($i === $page) ? 'active' : '' ?>">
                <?= $i ?>
            </a>
        <?php endfor; ?>

        <?php if ($page < $totalPaginas): ?>
            <a href="?page=<?= $page + 1 ?>&buscar=<?= urlencode($buscar) ?>" class="pagination-btn">Próximo</a>
        <?php endif; ?>
    </div>
</div>


</body>
</html>
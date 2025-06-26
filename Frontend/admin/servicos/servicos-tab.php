<?php

require_once __DIR__ . '../../../../Backend/php/auth-admin.php';
require_once __DIR__ . '../../../../Backend/php/admin/servicos/servicos-tab-query.php';
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
                <div class="admin-tab active" onclick="window.location.href='../servicos/servicos-tab.php'">Serviços</div>
                <div class="admin-tab" onclick="window.location.href='../noticias/noticias-tab.php'">Notícias</div>
            </div>
            
           <div id="servicoTab" class="admin-panel active">
    <div class="search-box">
        <form method="GET" action="">
            <input type="text" name="buscarServ" placeholder="Buscar serviço" value="<?= htmlspecialchars($buscarServ) ?>">
            <button type="submit">Buscar</button>
        </form>
    </div>

    <a href="/Frontend/admin/servicos/criar.php">
        <button class="btn btn-secondary">Criar Novo Serviço</button>
    </a>
    <br><br>

    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Título</th>
                <th>Descrição</th>
                <th>Data Criada</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($servicos) > 0): ?>
                <?php foreach ($servicos as $servico): ?>
                    <tr>
                        <td><?= htmlspecialchars($servico['id']) ?></td>
                        <td><?= htmlspecialchars($servico['titulo']) ?></td>
                        <td title="<?= htmlspecialchars($servico['descricao']) ?>">
                            <?= htmlspecialchars(mb_strimwidth($servico['descricao'], 0, 20, '...')) ?>
                        </td>
                        <td><?= htmlspecialchars($servico['data_criacao']) ?></td>
                        <td>
                            <div class="action-buttons">
                                <a href="atualizar.php?id=<?= $servico['id'] ?>">
                                    <button class="btn btn-secondary">Editar</button>
                                </a>
                                <a href="../../../Backend/php/admin/servicos/deletar.php?id=<?= $servico['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir?')">
                                    <button class="btn btn-danger">Remover</button>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Nenhum serviço encontrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="pagination">
        <?php if ($pageServ > 1): ?>
            <a href="?pageServ=<?= $pageServ - 1 ?>&buscarServ=<?= urlencode($buscarServ) ?>" class="pagination-btn">Anterior</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPaginasServ; $i++): ?>
            <a href="?pageServ=<?= $i ?>&buscarServ=<?= urlencode($buscarServ) ?>" class="pagination-btn <?= ($i === $pageServ) ? 'active' : '' ?>">
                <?= $i ?>
            </a>
        <?php endfor; ?>

        <?php if ($pageServ < $totalPaginasServ): ?>
            <a href="?pageServ=<?= $pageServ + 1 ?>&buscarServ=<?= urlencode($buscarServ) ?>" class="pagination-btn">Próximo</a>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
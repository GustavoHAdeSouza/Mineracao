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
    <title>Administração - Lorem Ipsum Areias</title>
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

    <div class="top-bar">
        <div class="container">
            <div class="top-bar-content">
                <div class="top-bar-contact">
                    <span>HORÁRIO DE ATENDIMENTO</span>
                    <a href="tel:+551112345678">(11) 1234-5678</a>
                    <a href="mailto:contato@loremipsum.com">contato@loremipsum.com</a>
                </div>
                <div class="top-bar-social">
                    <a href="#">FB</a>
                    <a href="#">IG</a>
                </div>
            </div>
        </div>
    </div>
    
    <header>
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    [LOGO AQUI]
                </div>
                <nav>
                    <ul>
                        <li><a href="../../index.html">Home</a></li>
                        <li><a href="./sobre.html">Sobre nós</a></li>
                        <li><a href="./servicos.html">Serviços</a></li>
                        <li><a href="./servicos.html">Notícias</a></li>
                        <li><a href="./contatos.html">Contatos</a></li>
                        <li><a href="./admin.html" style="color: #90ee90;">Admin</a></li>
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
            <h2>Gestão de Estoque e Preços</h2>
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

            </div>
    
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-column">
                    <div class="logo">
                        [LOGO AQUI]
                    </div>
                </div>
                <div class="footer-column">
                    <h3>Matriz</h3>
                    <p>Av. Lorem Ipsum, n° 123</p>
                    <p>Bairro Lorem - Cidade Ipsum - SP</p>
                    <p>CEP 12345-678</p>
                    <p>contato@loremipsum.com</p>
                    <p>(11) 1234-5678</p>
                </div>
                <div class="footer-column">
                    <h3>Filiais</h3>
                    <p>Av. Lorem Ipsum, n° 456</p>
                    <p>Bairro Lorem - Cidade Ipsum - SP</p>
                    <p>CEP 12345-678</p>
                    <p>filial@loremipsum.com</p>
                    <p>(11) 8765-4321</p>
                </div>
                <div class="footer-column">
                    <h3>Departamentos</h3>
                    <p>São Paulo: (11) 1234-5678</p>
                    <p>Rio de Janeiro: (21) 1234-5678</p>
                    <p>Vendas: (11) 8765-4321</p>
                    <p>WhatsApp: (11) 98765-4321</p
                </div>
            </div>
        </div>
    </footer>   
    <div class="bottom-footer">
        <div class="container">
            <div class="bottom-footer-content">
                <div>© 2025 Lorem Ipsum Areias. Todos os direitos reservados.</div>
                <div>Desenvolvido por <a href="#">Lorem Ipsum Desenvolvimento</a></div>
            </div>
        </div>
    </div>
</body>
</html>
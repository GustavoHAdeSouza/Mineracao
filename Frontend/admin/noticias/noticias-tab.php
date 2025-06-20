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
                        <li><a href="./noticias.html">Notícias</a></li>
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
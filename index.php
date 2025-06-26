<?php 

require_once __DIR__ . '/Backend/php/index.php';

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mineração - Areias</title>
    <link rel="stylesheet" href="./Frontend/assets/css/index.css">
</head>
<body>
    <script src="./Frontend/assets/js/index.js"></script>

    <header>
        <div class="container">
            <div class="header-content">
                <div>
                        <img class="logo" src="./Frontend/assets/Repositorio_de_Fotos/logo.png">
                </div>
                <nav>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="./Frontend/pages/sobre.php">Sobre nós</a></li>
                        <li><a href="./Frontend/pages/servicos.php">Serviços</a></li>
                        <li><a href="./Frontend/pages/noticias.php">Notícias</a></li>
                        <li><a href="./Frontend/pages/contatos.php">Contatos</a></li>
                    </ul>
                    <button class="mobile-menu-btn">≡</button>
                </nav>
            </div>
        </div>
    </header>
    
    <div class="banner">
        <div class="container">
            <div class="banner-content">
                <h1>Mineração Areias</h1>
                <h2>Uma das maiores fornecedoras de areia do estado do Rio Grande do Sul</h2>
                <a href="./Frontend/pages/sobre.php" class="btn">Saiba mais</a>
            </div>
        </div>
    </div>
    
    <section class="products-section">
    <div class="container">
        <div class="products-grid">
            <?php foreach ($produtos as $produto): ?>
                <div class="product-card">
                <div class="product-image">
                    <?php if (!empty($produto['imagem']) && file_exists(__DIR__ . "/Frontend/assets/Repositorio_de_Fotos/" . $produto['imagem'])): ?>
                        <img src="/Frontend/assets/Repositorio_de_Fotos/<?= htmlspecialchars($produto['imagem']) ?>" alt="<?= htmlspecialchars($produto['nome']) ?>">
                    <?php else: ?>
                        <div class="no-image">Sem imagem</div>
                    <?php endif; ?>
                </div>
                    <div class="product-content">
                        <h2 class="product-title"><?= htmlspecialchars($produto['nome']) ?></h2>
                        <p class="product-description">
                            <?= htmlspecialchars(mb_strimwidth($produto['descricao'], 0, 100, '...')) ?>
                        </p>
                        <div class="product-details">
                            <div class="product-icon"><?= htmlspecialchars($produto['id']) ?></div>
                            <a href="#"
                               class="product-btn"
                               onclick="openModal('<?= htmlspecialchars(addslashes($produto['nome'])) ?>', '<?= htmlspecialchars(addslashes(nl2br($produto['descricao']))) ?>')">
                               Saiba Mais
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="pagination">
            <?php if ($page > 1): ?>
                <a href="?page=<?= $page - 1 ?>" class="pagination-btn">Anterior</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                <a href="?page=<?= $i ?>" class="pagination-btn <?= ($i === $page) ? 'active' : '' ?>">
                    <?= $i ?>
                </a>
            <?php endfor; ?>

            <?php if ($page < $totalPaginas): ?>
                <a href="?page=<?= $page + 1 ?>" class="pagination-btn">Próximo</a>
            <?php endif; ?>
        </div>
    </div>
</section>

<div id="product-modal" class="modal">
    <div class="modal-content">
        <span class="close-btn" onclick="closeModal()">&times;</span>
        <h2 id="modal-title"></h2>
        <p id="modal-content"></p>
    </div>
</div>

    
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-column">
                    <img class="logo" src="./Frontend/assets/Repositorio_de_Fotos/logo.png">
                </div>
                <div class="footer-column">
                    <h3>Matriz</h3>
                    <p>Av. Lorem Ipsum, n° 123</p>
                    <p>Bairro Lorem - Cidade Ipsum - SP</p>
                    <p>CEP 12345-678</p>
                    <p>mineracaophp@gmail.com</p>
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
                    <p>WhatsApp: (11) 98765-4321</p>
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
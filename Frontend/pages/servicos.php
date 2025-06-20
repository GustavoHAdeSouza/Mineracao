<?php 

require_once __DIR__ . '../../../Backend/php/servicos.php';

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serviços - Lorem Ipsum Areias</title>
    <link rel="stylesheet" href="../assets/css/servicos.css">
</head>
<body>
    <script src="../assets/js/servicos.js"></script>
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
                        <li><a href="../../index.php">Home</a></li>
                        <li><a href="./sobre.php">Sobre nós</a></li>
                        <li><a href="./servicos.php" class="active">Serviços</a></li>
                        <li><a href="./noticias.php">Notícias</a></li>
                        <li><a href="./contatos.php">Contatos</a></li>
                    </ul>
                    <button class="mobile-menu-btn">≡</button>
                </nav>
            </div>
        </div>
    </header>
    
    <div class="page-title">
        <div class="container">
            <h1>Nossos Serviços</h1>
        </div>
    </div>
    
   <section class="services-section">
    <div class="container">
        <div class="services-grid">
            <?php foreach ($servicos as $servico): ?>
                <div class="service-card">
                <div class="service-image">
                    <?php if (!empty($servico['imagem']) && file_exists(__DIR__ . "/../assets/Repositorio_de_Fotos/" . $servico['imagem'])): ?>
                        <img src="/Frontend/assets/Repositorio_de_Fotos/<?= htmlspecialchars($servico['imagem']) ?>" alt="<?= htmlspecialchars($servico['titulo']) ?>">
                    <?php else: ?>
                        <div class="no-image">Sem imagem</div>
                    <?php endif; ?>
                </div>
                    <div class="service-content">
                        <h2 class="service-title"><?= htmlspecialchars($servico['titulo']) ?></h2>
                        <p class="service-description">
                            <?= htmlspecialchars(mb_strimwidth($servico['descricao'], 0, 100, '...')) ?>
                        </p>
                        <div class="service-details">
                            <div class="service-icon"><?= htmlspecialchars($servico['id']) ?></div>
                            <a href="#"
                               class="service-btn"
                               onclick="openModal('<?= htmlspecialchars(addslashes($servico['titulo'])) ?>', '<?= htmlspecialchars(addslashes(nl2br($servico['descricao']))) ?>')">
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

<div id="service-modal" class="modal">
    <div class="modal-content">
        <span class="close-btn" onclick="closeModal()">&times;</span>
        <h2 id="modal-title"></h2>
        <p id="modal-content"></p>
    </div>
</div>


    
    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <h2 class="cta-title">Precisa de um Serviço Personalizado?</h2>
                <p class="cta-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in dui mauris. Vivamus hendrerit arcu sed erat molestie vehicula. Entre em contato conosco para uma solução sob medida.</p>
                <a href="contatos.html" class="cta-btn">Fale Conosco</a>
            </div>
        </div>
    </section>
    
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
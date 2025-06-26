<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contatos - Lorem Ipsum Areias</title>
    <link rel="stylesheet" href="../assets/css/contatos.css">

</head>
<body>
    
    <header>
        <div class="container">
            <div class="header-content">
                    <img class="logo" src="../assets/Repositorio_de_Fotos/logo.png">
                <nav>
                    <ul>
                        <li><a href="../../index.php">Home</a></li>
                        <li><a href="./sobre.php">Sobre nós</a></li>
                        <li><a href="./servicos.php">Serviços</a></li>
                        <li><a href="./noticias.php">Notícias</a></li>
                        <li><a href="./contatos.php" class="active">Contatos</a></li>
                    </ul>
                    <button class="mobile-menu-btn">≡</button>
                </nav>
            </div>
        </div>
    </header>
    
    <div class="page-title">
        <div class="container">
            <h1>Contatos</h1>
        </div>
    </div>
    
    <section class="contact-section">
        <div class="container">
            <div class="contact-content">
                <div class="contact-info">
                    <h2>Informações de Contato</h2>
                    <div class="contact-details">
                        <p><strong>Endereço:</strong> Av. Lorem Ipsum, 123 - Bairro Ipsum</p>
                        <p><strong>Telefone:</strong> (11) 1234-5678</p>
                        <p><strong>WhatsApp:</strong> (11) 98765-4321</p>
                        <p><strong>E-mail:</strong> mineracaophp@gmail.com</p>
                        <p><strong>Horário de Atendimento:</strong> Segunda a Sexta, 08:00 - 18:00</p>
                    </div>
                    
                    <h2>Redes Sociais</h2>
                    <div class="social-links">
                        <a href="#">Facebook</a>
                        <a href="#">Instagram</a>
                        <a href="#">LinkedIn</a>
                    </div>
                </div>
                
            <div class="contact-form">
                <h2>Envie uma Mensagem</h2>

                <form action="../../Backend/php/enviar-email.php" method="POST">
                    <div class="form-group">
                        <label for="name">Nome Completo</label>
                        <input type="text" id="name" name="name" required>
                    </div>

                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="phone">Telefone</label>
                        <input type="tel" id="phone" name="phone">
                    </div>

                    <div class="form-group">
                        <label for="message">Sua Mensagem</label>
                        <textarea id="message" name="message" required></textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="submit-btn">Enviar Mensagem</button>
                    </div>
                </form>
            </div>

            </div>
        </div>
    </section>
    
    <section class="map-section">
        <div class="container">
            <h2 style="text-align: center; margin-bottom: 20px; color: #003366;">Nossa Localização</h2>
                <iframe class="map-container" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3454.364812834814!2d-51.22377332444689!3d-30.0263900749327!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x951979082a86e831%3A0x9b4615117c97cf33!2sInstituto%20Federal%20de%20Educa%C3%A7%C3%A3o%2C%20Ci%C3%AAncia%20e%20Tecnologia%20do%20Rio%20Grande%20do%20Sul%20-%20Campus%20Porto%20Alegre!5e0!3m2!1spt-BR!2sbr!4v1750899458380!5m2!1spt-BR!2sbr" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>
    
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-column">
                <img class="logo" src="../assets/Repositorio_de_Fotos/logo.png">
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
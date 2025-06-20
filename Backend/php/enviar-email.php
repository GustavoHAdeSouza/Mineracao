<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Carrega o autoload do Composer
require '../vendor/autoload.php';

// Verifica se foi enviado via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Dados do formulário
    $nome = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $telefone = htmlspecialchars($_POST['phone']);
    $mensagem = htmlspecialchars($_POST['message']);

    // Instancia o PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configurações do servidor SMTP
        $mail->isSMTP();
        $mail->Host       = getenv("EMAIL_HOST");      // Servidor SMTP
        $mail->SMTPAuth   = getenv("EMAIL_SMTP_AUTH");
        $mail->Username   = getenv("EMAIL_USERNAME");  ;
        $mail->Password   = getenv("EMAIL_PASSWORD"); // Sua senha ou App Key do Gmail
        $mail->SMTPSecure = getenv("EMAIL_SMTP_SECURE");                 // TLS ou 'ssl'
        $mail->Port       = getenv("EMAIL_PORT"); // Porta TLS: 587 | SSL: 465

        // Remetente
        $mail->setFrom(getenv("EMAIL_USERNAME"), 'Mineracao');

        // Destinatário (empresa)
        $mail->addAddress(getenv("EMAIL_EMPRESA"), 'Mineracao');

        // Responder para quem preencheu o formulário
        $mail->addReplyTo($email, $nome);

        // Conteúdo
        $mail->isHTML(true);
        $mail->Subject = 'Nova mensagem do site - Contato';
        $mail->Body    = "
            <h2>Nova mensagem recebida do site</h2>
            <p><strong>Nome:</strong> {$nome}</p>
            <p><strong>E-mail:</strong> {$email}</p>
            <p><strong>Telefone:</strong> {$telefone}</p>
            <p><strong>Mensagem:</strong><br>{$mensagem}</p>
        ";
        $mail->AltBody = "Nome: {$nome}\nEmail: {$email}\nTelefone: {$telefone}\nMensagem:\n{$mensagem}";

        // Envia
        $mail->send();
       echo "<script>
                alert('Mensagem enviada com sucesso! Obrigado, {$nome}. Entraremos em contato em breve.');
                window.location.href = '../../Frontend/pages/contatos.php'; // redireciona para a página que quiser
            </script>";
    } catch (Exception $e) {
        echo "<h2>Erro ao enviar mensagem.</h2>";
        echo "<p>Erro: {$mail->ErrorInfo}</p>";
    }
} else {
    echo "Método inválido.";
}
?>

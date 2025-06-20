<?php
session_start();

if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
    http_response_code(403);
    echo "<!DOCTYPE html>
    <html lang='pt-br'>
    <head>
        <meta charset='UTF-8'>
        <title>Acesso Negado</title>
        <style>
            body { font-family: sans-serif; background-color: #f8d7da; color: #721c24; display: flex; align-items: center; justify-content: center; height: 100vh; }
            .box { background: #f5c6cb; padding: 30px; border-radius: 8px; border: 1px solid #f5c2c7; text-align: center; }
            h1 { margin-bottom: 10px; }
        </style>
    </head>
    <body>
        <div class='box'>
            <h1>Acesso negado</h1>
            <p>Você não é autorizado a acessar essa página.</p>
        </div>
    </body>
    </html>";
    exit;
}

$userData = $_SESSION['user'];
$welcomeName = htmlspecialchars($userData['given_name'] ?? $userData['name'] ?? 'Usuário');
$userEmail = htmlspecialchars($userData['email'] ?? 'N/A');
?>

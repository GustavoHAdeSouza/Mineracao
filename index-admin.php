<?php
// Inicia a sessão em todas as páginas que precisam de autenticação.
session_start();

// 1. VERIFICAR AUTENTICAÇÃO
if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
    header('Location: login-admin.php');
    exit;
}

// 2. RECUPERAR E PREPARAR DADOS DO USUÁRIO
$userData = $_SESSION['user'];

// Usa o primeiro nome (given_name) para uma saudação mais pessoal.
$firstName = htmlspecialchars($userData['given_name'] ?? '');
// Como alternativa, usa o nome completo (name). Se nenhum existir, usa 'Usuário'.
$welcomeName = !empty($firstName) ? $firstName : htmlspecialchars($userData['name'] ?? 'Usuário');

// Captura o e-mail para exibição.
$userEmail = htmlspecialchars($userData['email'] ?? 'N/A');

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo</title>
    <style>
        body { font-family: sans-serif; line-height: 1.6; padding: 20px; }
        .container { max-width: 800px; margin: auto; }
        .user-info { background-color: #f0f0f0; border-left: 5px solid #007bff; padding: 15px; margin-bottom: 20px; }
        nav a { margin-right: 15px; }
        pre { background-color: #333; color: #fff; padding: 10px; border-radius: 5px; white-space: pre-wrap; word-wrap: break-word; }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Painel Administrativo</h1>
            <nav>
                <a href="#">Dashboard</a>
                <a href="#">Usuários</a>
                <a href="#">Configurações</a>
                <a href="logout.php"><strong>Sair (Logout)</strong></a>
            </nav>
        </header>

        <hr>

        <main>
            <div class="user-info">
                <h2>Bem-vindo(a), <?php echo $welcomeName; ?>!</h2>
                <p>Seu e-mail registrado é: <?php echo $userEmail; ?></p>
            </div>

            <h3>Conteúdo Principal</h3>
            <p>Este é o conteúdo protegido do seu painel administrativo. Somente usuários logados podem ver esta página.</p>
            
            <hr>

            <h4>Dados completos recebidos do Keycloak (para depuração)</h4>
            <p>Você pode usar qualquer um desses dados para personalizar a experiência do usuário.</p>
            <pre><?php print_r($userData); ?></pre>
        </main>
    </div>
</body>
</html>
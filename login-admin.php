<?php

require_once __DIR__ . '/Backend/vendor/autoload.php';
require_once __DIR__ . '/Backend/php/keycloak-config.php';

use League\OAuth2\Client\Provider\GenericProvider;
use GuzzleHttp\Client;

$provider = new GenericProvider([
    'clientId'                => $keycloakAuthClientArray["kcClientId"],
    'clientSecret'            => $keycloakAuthClientArray["kcClientSecret"],
    'redirectUri'             => $keycloakAuthClientArray["kcRedirectUri"],
    'urlAuthorize'            => $keycloakAuthClientArray["urlAuthorize"],
    'urlAccessToken'          => $keycloakAuthClientArray["urlAccessToken"],
    'urlResourceOwnerDetails' => $keycloakAuthClientArray["urlResourceOwnerDetails"],
    'scopes'                  => 'openid profile email'
]);

session_start();

// -----------------------------------------------------------------------------
// ETAPA 1: Redirecionar para a página de autorização do Keycloak.
// -----------------------------------------------------------------------------
// Se o parâmetro 'code' não estiver na URL, significa que o usuário
// ainda não foi autenticado no provedor.
if (!isset($_GET['code'])) {

    // Gera a URL de autorização.
    $authorizationUrl = $provider->getAuthorizationUrl();

    // Armazena o 'state' na sessão. Este valor é usado para prevenir ataques CSRF.
    $_SESSION['oauth2state'] = $provider->getState();

    // Redireciona o usuário para a página de login do Keycloak.
    header('Location: ' . $authorizationUrl);
    exit;
}

// -----------------------------------------------------------------------------
// ETAPA 2: Validar o 'state' para proteção contra CSRF.
// -----------------------------------------------------------------------------
// Compara o 'state' recebido na URL com o que foi armazenado na sessão.
// Se forem diferentes ou se algum estiver vazio, o processo é interrompido.
elseif (empty($_GET['state']) || empty($_SESSION['oauth2state']) || $_GET['state'] !== $_SESSION['oauth2state']) {
    // Limpa o 'state' da sessão, se existir.
    if (isset($_SESSION['oauth2state'])) {
        unset($_SESSION['oauth2state']);
    }

    // Interrompe a execução com uma mensagem de erro.
    exit('Estado inválido. Ataque CSRF detectado.');
}

// -----------------------------------------------------------------------------
// ETAPA 3: Obter o token de acesso e os dados do usuário.
// -----------------------------------------------------------------------------
// Se o 'code' e o 'state' são válidos, o processo continua.
else {
    try {
        // Troca o 'code' de autorização por um 'access token'.
        $accessToken = $provider->getAccessToken('authorization_code', [
            'code' => $_GET['code']
        ]);

        // Com o token de acesso, busca os dados do usuário (resource owner).
        $resourceOwner = $provider->getResourceOwner($accessToken);
        $userData = $resourceOwner->toArray();

        // Armazena os dados do usuário na sessão para uso posterior.
        $_SESSION['user'] = $userData;

        // Redireciona o usuário para a página principal do sistema do admin.
        header('Location: /Frontend/admin/produtos/produtos-tab.php');
        exit;

    } catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
        // Pega QUALQUER erro ou exceção que acontecer no bloco try

        echo '<h1>Ocorreu um Erro Crítico</h1>';
        echo '<h2>Classe do Erro:</h2>';
        echo '<p>' . get_class($e) . '</p>';

        echo '<h2>Mensagem:</h2>';
        echo '<p>' . $e->getMessage() . '</p>';

        // Tenta pegar a resposta do servidor, se o método existir no erro
        if (method_exists($e, 'getResponseBody')) {
            echo '<h2>Resposta do Servidor Keycloak:</h2>';
            $responseBody = $e->getResponseBody();
            echo '<pre style="background-color: #f0f0f0; border: 1px solid #ccc; padding: 10px; border-radius: 5px;">';
            print_r($responseBody);
            echo '</pre>';
        }

        echo '<h2>Stack Trace:</h2>';
        echo '<pre>' . $e->getTraceAsString() . '</pre>';
        exit;
    }
}
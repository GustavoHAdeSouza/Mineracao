<?php

// Pega a variável de ambiente. Se não existir, usa 'local' como padrão. É mais seguro.
$env = getenv("KEYCLOAK_ENV") ?? 'local';

$keycloakAuthClientArray = [];
$realm = 'mineracao';

// URLs públicas (Navegador do usuário)
$publicBase   = "http://localhost:8080/realms/{$realm}/protocol/openid-connect";

// As URLs de comunicação interna devem usar o nome do serviço Docker ('keycloak')
$keycloakInternalUrl = "http://keycloak:8080/realms/{$realm}/protocol/openid-connect";

// A URL de redirecionamento usa o endereço público (localhost na sua máquina)
$redirectUri = "http://localhost:5555/login-admin.php";

switch ($env) {
    case "local":
        $keycloakAuthClientArray = [
            "kcClientId"                => 'mineracao',
            "kcClientSecret"            => 'fwgKutrKQzoEwvgywPfXPNo4eo238SwR',
            "kcRedirectUri"             => $redirectUri,
            // URLs para comunicação de servidor para servidor (PHP -> Keycloak)
            "urlAuthorize"              => "{$publicBase}/auth",
            "urlAccessToken"            => "{$keycloakInternalUrl}/token",
            "urlResourceOwnerDetails"   => "{$keycloakInternalUrl}/userinfo",
            // URL para o navegador do usuário (Logout)
            "kcUrlLogout"               => "{$publicBase}/logout"
        ];
        break;
    
    default:
        header('Content-Type: text/plain', true, 500);
        exit("Erro: A variável de ambiente 'KEYCLOAK_ENV' ('" . htmlspecialchars($env) . "') é inválida.");
}

?>
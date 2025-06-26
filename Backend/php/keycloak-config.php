<?php
$env = 'local';

$keycloakAuthClientArray = [];
$realm = getenv('KEYCLOAK_REALM');
$clientId = getenv('KEYCLOAK_CLIENT_ID');
$clientSecret = getenv('KEYCLOAK_CLIENT_SECRET');

// URLs públicas e internas padrão — podem variar por ambiente
switch ($env) {
    case "local":
        $publicBase   = "http://localhost:8080/realms/{$realm}/protocol/openid-connect";
        $keycloakInternalUrl = "http://keycloak:8080/realms/{$realm}/protocol/openid-connect";
        $redirectUri = "http://localhost:5555/login-admin.php";

        $keycloakAuthClientArray = [
            "kcClientId"              => "$realm",
            "kcClientSecret"          => "$clientSecret",
            "kcRedirectUri"           => $redirectUri,
            "urlAuthorize"            => "{$publicBase}/auth",
            "urlAccessToken"          => "{$keycloakInternalUrl}/token",
            "urlResourceOwnerDetails" => "{$keycloakInternalUrl}/userinfo",
            "kcUrlLogout"             => "{$publicBase}/logout?post_logout_redirect_uri=" . urlencode($redirectUri) . "&client_id=$clientId"
        ];
        break;

    case "dev":
        $publicBase   = "https://dev-keycloak.exemplo.com/realms/{$realm}/protocol/openid-connect";
        $keycloakInternalUrl = "https://dev-keycloak.internal/realms/{$realm}/protocol/openid-connect";
        $redirectUri = "https://dev.seusite.com/login-admin.php";

        $keycloakAuthClientArray = [
            "kcClientId"              => 'mineracao-dev',
            "kcClientSecret"          => 'dev-secret-aqui',
            "kcRedirectUri"           => $redirectUri,
            "urlAuthorize"            => "{$publicBase}/auth",
            "urlAccessToken"          => "{$keycloakInternalUrl}/token",
            "urlResourceOwnerDetails" => "{$keycloakInternalUrl}/userinfo",
            "kcUrlLogout"             => "{$publicBase}/logout?post_logout_redirect_uri=" . urlencode($redirectUri) . "&client_id=mineracao-dev"
        ];
        break;

    case "hom":
        $publicBase   = "https://hom-keycloak.exemplo.com/realms/{$realm}/protocol/openid-connect";
        $keycloakInternalUrl = "https://hom-keycloak.internal/realms/{$realm}/protocol/openid-connect";
        $redirectUri = "https://hom.seusite.com/login-admin.php";

        $keycloakAuthClientArray = [
            "kcClientId"              => 'mineracao-hom',
            "kcClientSecret"          => 'hom-secret-aqui',
            "kcRedirectUri"           => $redirectUri,
            "urlAuthorize"            => "{$publicBase}/auth",
            "urlAccessToken"          => "{$keycloakInternalUrl}/token",
            "urlResourceOwnerDetails" => "{$keycloakInternalUrl}/userinfo",
            "kcUrlLogout"             => "{$publicBase}/logout?post_logout_redirect_uri=" . urlencode($redirectUri) . "&client_id=mineracao-hom"
        ];
        break;

    case "prod":
        $publicBase   = "https://keycloak.seusite.com/realms/{$realm}/protocol/openid-connect";
        $keycloakInternalUrl = "https://keycloak.internal/realms/{$realm}/protocol/openid-connect";
        $redirectUri = "https://seusite.com/login-admin.php";

        $keycloakAuthClientArray = [
            "kcClientId"              => 'mineracao-prod',
            "kcClientSecret"          => 'prod-secret-aqui',
            "kcRedirectUri"           => $redirectUri,
            "urlAuthorize"            => "{$publicBase}/auth",
            "urlAccessToken"          => "{$keycloakInternalUrl}/token",
            "urlResourceOwnerDetails" => "{$keycloakInternalUrl}/userinfo",
            "kcUrlLogout"             => "{$publicBase}/logout?post_logout_redirect_uri=" . urlencode($redirectUri) . "&client_id=mineracao-prod"
        ];
        break;

    default:
        header('Content-Type: text/plain', true, 500);
        exit("Erro: A variável de ambiente 'KEYCLOAK_ENV' ('" . htmlspecialchars($env) . "') é inválida.");
}
?>

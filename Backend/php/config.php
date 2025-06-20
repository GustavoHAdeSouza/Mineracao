<?php 

$db_name = getenv('MYSQL_DATABASE');
$db_host = getenv('MYSQL_HOST');
$db_user = getenv('MYSQL_USER');
$db_pass = getenv('MYSQL_PASSWORD');
$db_port = getenv('MYSQL_PORT');

try {
    $pdo = new PDO("mysql:dbname=$db_name;host=$db_host;port=$db_port;charset=utf8mb4", $db_user, $db_pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}


?>
<?php
require_once __DIR__ . '/config.php';

// Verifica a página atual na URL. Se não tiver, assume como página 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Define quantas notícias por página
$perPage = 6;

// Calcula o offset
$offset = ($page - 1) * $perPage;

// Conta o total de notícias
$totalStmt = $pdo->query("SELECT COUNT(*) FROM noticias");
$totalNoticias = $totalStmt->fetchColumn();
$totalPaginas = ceil($totalNoticias / $perPage);

// Busca as notícias dessa página
$stmt = $pdo->prepare("SELECT * FROM noticias ORDER BY data_criacao DESC LIMIT :limit OFFSET :offset");
$stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();

$noticias = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

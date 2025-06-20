<?php
require_once __DIR__ . '/config.php';

// Página atual
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;

// Quantidade por página
$perPage = 6;

// Calcula o offset
$offset = ($page - 1) * $perPage;

// Conta total de serviços
$totalStmt = $pdo->query("SELECT COUNT(*) FROM servicos");
$totalServicos = $totalStmt->fetchColumn();
$totalPaginas = ceil($totalServicos / $perPage);

// Busca serviços da página atual
$stmt = $pdo->prepare("SELECT * FROM servicos ORDER BY data_criacao ASC LIMIT :limit OFFSET :offset");
$stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();

$servicos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

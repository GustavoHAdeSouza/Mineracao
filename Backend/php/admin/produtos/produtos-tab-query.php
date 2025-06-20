<?php
require_once __DIR__ . '/../../config.php';

$itensPorPagina = 10;

// ✔️ Página atual
$pageProd = isset($_GET['pageProd']) ? (int)$_GET['pageProd'] : 1;
if ($pageProd < 1) $pageProd = 1;

// ✔️ Termo de busca
$buscarProd = isset($_GET['buscarProd']) ? trim($_GET['buscarProd']) : '';

// ✔️ Calcula OFFSET
$offsetProd = ($pageProd - 1) * $itensPorPagina;

try {
    // ✔️ Consulta com ou sem filtro de busca
    if ($buscarProd !== '') {
        $stmt = $pdo->prepare("SELECT * FROM produtos WHERE nome LIKE :buscar ORDER BY id ASC LIMIT :limit OFFSET :offset");
        $stmt->bindValue(':buscar', '%' . $buscarProd . '%', PDO::PARAM_STR);
    } else {
        $stmt = $pdo->prepare("SELECT * FROM produtos ORDER BY id ASC LIMIT :limit OFFSET :offset");
    }

    $stmt->bindValue(':limit', $itensPorPagina, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offsetProd, PDO::PARAM_INT);
    $stmt->execute();
    $produtos = $stmt->fetchAll();

    // ✔️ Contagem total
    if ($buscarProd !== '') {
        $count = $pdo->prepare("SELECT COUNT(*) FROM produtos WHERE nome LIKE :buscar");
        $count->bindValue(':buscar', '%' . $buscarProd . '%', PDO::PARAM_STR);
        $count->execute();
        $totalProd = $count->fetchColumn();
    } else {
        $totalProd = $pdo->query("SELECT COUNT(*) FROM produtos")->fetchColumn();
    }

    $totalPaginasProd = ceil($totalProd / $itensPorPagina);

} catch (PDOException $e) {
    die("Erro ao buscar produtos: " . $e->getMessage());
}
?>
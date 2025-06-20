<?php
require_once __DIR__ . '/../../config.php';

$itensPorPagina = 10; // Quantidade de notícias por página

// Página atual via GET, padrão 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;

// Termo de busca via GET
$buscar = isset($_GET['buscar']) ? trim($_GET['buscar']) : '';

// Calcular o OFFSET
$offset = ($page - 1) * $itensPorPagina;

try {
    if ($buscar !== '') {
        // Consulta com filtro pelo título
        $sql = "SELECT * FROM noticias WHERE titulo LIKE :buscar ORDER BY id ASC LIMIT :limit OFFSET :offset";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':buscar', '%' . $buscar . '%', PDO::PARAM_STR);
    } else {
        // Consulta sem filtro
        $sql = "SELECT * FROM noticias ORDER BY id ASC LIMIT :limit OFFSET :offset";
        $stmt = $pdo->prepare($sql);
    }

    $stmt->bindValue(':limit', $itensPorPagina, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $noticias = $stmt->fetchAll();

    // Contar o total para paginação (com filtro, se tiver)
    if ($buscar !== '') {
        $countSql = "SELECT COUNT(*) FROM noticias WHERE titulo LIKE :buscar";
        $countStmt = $pdo->prepare($countSql);
        $countStmt->bindValue(':buscar', '%' . $buscar . '%', PDO::PARAM_STR);
        $countStmt->execute();
        $total = $countStmt->fetchColumn();
    } else {
        $total = $pdo->query("SELECT COUNT(*) FROM noticias")->fetchColumn();
    }

    $totalPaginas = ceil($total / $itensPorPagina);

} catch (PDOException $e) {
    die("Erro ao buscar notícias: " . $e->getMessage());
}
?>
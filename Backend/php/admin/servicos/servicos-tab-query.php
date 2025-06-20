<?php 

require_once __DIR__ . '/../../config.php';

$itensPorPagina = 10; // Quantidade de serviços por página

// Página atual via GET, padrão 1
$pageServ = isset($_GET['pageServ']) ? (int)$_GET['pageServ'] : 1;
if ($pageServ < 1) $pageServ = 1;

// Termo de busca via GET
$buscarServ = isset($_GET['buscarServ']) ? trim($_GET['buscarServ']) : '';

// Calcular o OFFSET
$offsetServ = ($pageServ - 1) * $itensPorPagina;

try {
    if ($buscarServ !== '') {
        // Consulta com filtro pelo título
        $sql = "SELECT * FROM servicos WHERE titulo LIKE :buscar ORDER BY id ASC LIMIT :limit OFFSET :offset";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':buscar', '%' . $buscarServ . '%', PDO::PARAM_STR);
    } else {
        // Consulta sem filtro
        $sql = "SELECT * FROM servicos ORDER BY id ASC LIMIT :limit OFFSET :offset";
        $stmt = $pdo->prepare($sql);
    }

    $stmt->bindValue(':limit', $itensPorPagina, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offsetServ, PDO::PARAM_INT);
    $stmt->execute();
    $servicos = $stmt->fetchAll();

    // Contar o total para paginação (com filtro, se tiver)
    if ($buscarServ !== '') {
        $countSql = "SELECT COUNT(*) FROM servicos WHERE titulo LIKE :buscar";
        $countStmt = $pdo->prepare($countSql);
        $countStmt->bindValue(':buscar', '%' . $buscarServ . '%', PDO::PARAM_STR);
        $countStmt->execute();
        $totalServ = $countStmt->fetchColumn();
    } else {
        $totalServ = $pdo->query("SELECT COUNT(*) FROM servicos")->fetchColumn();
    }

    $totalPaginasServ = ceil($totalServ / $itensPorPagina);

} catch (PDOException $e) {
    die("Erro ao buscar serviços: " . $e->getMessage());
}
?>
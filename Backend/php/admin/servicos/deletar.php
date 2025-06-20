<?php
require_once __DIR__ . '/../../config.php';

// Pega o ID pela URL e filtra como número inteiro
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

if ($id) {
    try {
        $stmt = $pdo->prepare("DELETE FROM servicos WHERE id = ?");
        $stmt->execute([$id]);

        // Redireciona para a listagem após deletar
        header("Location: index.php");
        exit;
    } catch (PDOException $e) {
        die("Erro ao deletar serviços: " . $e->getMessage());
    }
} else {
    // Se não tiver ID, redireciona de volta
    header("Location: index.php");
    exit;
}
?>

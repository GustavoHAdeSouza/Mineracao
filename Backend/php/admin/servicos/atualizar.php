<?php
require_once __DIR__ . '/../../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $titulo = trim($_POST['titulo']);
    $descricao = trim($_POST['descricao']);

    if (empty($titulo) || empty($descricao)) {
        die("Título e descrição são obrigatórios.");
    }

    // Validação simples de tamanho
    if (strlen($titulo) > 100) {
        die("O título não pode ter mais de 100 caracteres.");
    }

    // Busca imagem atual
    $stmtBusca = $pdo->prepare("SELECT imagem FROM servicos WHERE id = ?");
    $stmtBusca->execute([$id]);
    $servicoAtual = $stmtBusca->fetch();
    $imagemAntiga = $servicoAtual ? $servicoAtual['imagem'] : null;

    $imagem = null;

    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == UPLOAD_ERR_OK) {
        $ext = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
        $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        // Verifica se é imagem válida
        $check = getimagesize($_FILES['imagem']['tmp_name']);
        if ($check === false) {
            die("Arquivo enviado não é uma imagem.");
        }

        if (!in_array(strtolower($ext), $extensoesPermitidas)) {
            die("Extensão não permitida.");
        }

        if ($_FILES['imagem']['size'] > 10 * 1024 * 1024) {
            die("Imagem muito grande. Máximo 2MB.");
        }

        $nomeImagem = uniqid('servico_') . '.' . $ext;
        $caminhoImagem = __DIR__ . '/../../../../Frontend/assets/Repositorio_de_Fotos/' . $nomeImagem;

        // Remove imagem antiga
        if ($imagemAntiga) {
            $caminhoImagemAntiga = __DIR__ . '/../../../../Frontend/assets/Repositorio_de_Fotos/' . $imagemAntiga;
            if (file_exists($caminhoImagemAntiga)) {
                unlink($caminhoImagemAntiga);
            }
        }

        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoImagem)) {
            $imagem = $nomeImagem;
        }
    }

    if ($imagem) {
        $stmt = $pdo->prepare("UPDATE servicos SET titulo = ?, descricao = ?, imagem = ? WHERE id = ?");
        $stmt->execute([$titulo, $descricao, $imagem, $id]);
    } else {
        $stmt = $pdo->prepare("UPDATE servicos SET titulo = ?, descricao = ? WHERE id = ?");
        $stmt->execute([$titulo, $descricao, $id]);
    }

    header("Location: index.php");
    exit;
} else {
    die("Requisição inválida.");
}
?>

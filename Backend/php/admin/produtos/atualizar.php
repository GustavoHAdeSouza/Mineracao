<?php
require_once __DIR__ . '/../../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $nome = trim($_POST['nome']);
    $descricao = trim($_POST['descricao']);

    if (empty($nome) || empty($descricao)) {
        die("Nome e descrição são obrigatórios.");
    }

    if (strlen($nome) > 100) {
        die("O nome não pode ter mais de 100 caracteres.");
    }

    // Busca a imagem atual
    $stmtBusca = $pdo->prepare("SELECT imagem FROM produtos WHERE id = ?");
    $stmtBusca->execute([$id]);
    $produtoAtual = $stmtBusca->fetch();
    $imagemAntiga = $produtoAtual ? $produtoAtual['imagem'] : null;

    $imagem = null;

    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == UPLOAD_ERR_OK) {
        $ext = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
        $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        $check = getimagesize($_FILES['imagem']['tmp_name']);
        if ($check === false) {
            die("O arquivo não é uma imagem válida.");
        }

        if (!in_array(strtolower($ext), $extensoesPermitidas)) {
            die("Extensão não permitida.");
        }

        if ($_FILES['imagem']['size'] > 2 * 1024 * 1024) {
            die("Imagem muito grande. Máximo 2MB.");
        }

        $nomeImagem = uniqid('produto_') . '.' . $ext;
        $caminhoImagem = __DIR__ . '/../../../../Frontend/assets/Repositorio_de_Fotos/' . $nomeImagem;

        // Apaga imagem antiga se existir
        if ($imagemAntiga) {
            $caminhoImagemAntiga = __DIR__ . '/../../../../Frontend/assets/Repositorio_de_Fotos/' . $imagemAntiga;
            if (file_exists($caminhoImagemAntiga)) {
                unlink($caminhoImagemAntiga);
            }
        }

        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoImagem)) {
            $imagem = $nomeImagem;
        } else {
            die("Erro ao salvar a imagem.");
        }
    }

    if ($imagem) {
        $stmt = $pdo->prepare("UPDATE produtos SET nome = ?, descricao = ?, imagem = ? WHERE id = ?");
        $stmt->execute([$nome, $descricao, $imagem, $id]);
    } else {
        $stmt = $pdo->prepare("UPDATE produtos SET nome = ?, descricao = ? WHERE id = ?");
        $stmt->execute([$nome, $descricao, $id]);
    }

    header("Location: index.php");
    exit;
} else {
    die("Requisição inválida.");
}
?>

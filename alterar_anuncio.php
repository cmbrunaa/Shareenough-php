<?php
session_start();
include "conn.php";

// Verifica se a ONG está logada
if (!isset($_SESSION['id_ong'])) {
    header("Location: login.php");
    exit();
}

$id_ong = $_SESSION['id_ong'];
$id_post = $_GET['id_post'] ?? null;

// Verifica se o ID do anúncio foi fornecido
if (!$id_post) {
    echo "Anúncio não encontrado.";
    exit();
}

// Processa a atualização do anúncio
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $boxpost = $_POST['boxpost'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];
    $numero = $_POST['numero'];
    $categoria = $_POST['categoria'];

    $query = "UPDATE postagem_ong SET boxpost = :boxpost, telefone = :telefone, endereco = :endereco, numero = :numero, categoria = :categoria WHERE id_post = :id_post AND id_ong = :id_ong";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':boxpost', $boxpost);
    $stmt->bindParam(':telefone', $telefone);
    $stmt->bindParam(':endereco', $endereco);
    $stmt->bindParam(':numero', $numero);
    $stmt->bindParam(':categoria', $categoria);
    $stmt->bindParam(':id_post', $id_post);
    $stmt->bindParam(':id_ong', $id_ong);

    // Executa a atualização e redireciona após sucesso
    if ($stmt->execute()) {
        header("Location: anuncios-ong.php"); // Redireciona após atualização
        exit();
    } else {
        echo "Erro ao atualizar o anúncio.";
    }
} else {
    // Busca o anúncio para editar
    $query = "SELECT * FROM postagem_ong WHERE id_post = :id_post AND id_ong = :id_ong";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id_post', $id_post);
    $stmt->bindParam(':id_ong', $id_ong);
    $stmt->execute();
    $anuncio = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$anuncio) {
        echo "Anúncio não encontrado ou você não tem permissão para editá-lo.";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Alterar Anúncio</title>
    
</head>
<body>
        <div class="alterar-dados">
            <h1>Alterar Anúncio</h1>
            <form action="" method="post">
                <label for="boxpost">Descrição:</label>
                <textarea id="boxpost" name="boxpost" required><?= htmlspecialchars($anuncio['boxpost']) ?></textarea><br>

                <label for="telefone">Telefone:</label>
                <input type="text" id="telefone" name="telefone" value="<?= htmlspecialchars($anuncio['telefone']) ?>" required><br>

                <label for="endereco">Endereço:</label>
                <input type="text" id="endereco" name="endereco" value="<?= htmlspecialchars($anuncio['endereco']) ?>" required><br>

                <label for="numero">Número:</label>
                <input type="text" id="numero" name="numero" value="<?= htmlspecialchars($anuncio['numero']) ?>" required><br>

                <label for="categoria">Categoria:</label>
                <input type="text" id="categoria" name="categoria" value="<?= htmlspecialchars($anuncio['categoria']) ?>" required><br>

                <input type="submit" value="Atualizar Anúncio" class="btn-alterar-ads">
            </form>
            <a href="anuncios-ong.php"><button class="btnongdoavoltar-altads">Voltar</button></a>
        </div>
</body>
</html>

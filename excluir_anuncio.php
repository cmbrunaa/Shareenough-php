<?php
session_start();
include "conn.php";

if (!isset($_SESSION['id_ong'])) {
    header("Location: login.php");
    exit();
}

$id_ong = $_SESSION['id_ong'];
$id_post = $_GET['id_post'] ?? null;

if (!$id_post) {
    echo "Anúncio não encontrado.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $query = "DELETE FROM postagem_ong WHERE id_post = :id_post AND id_ong = :id_ong";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id_post', $id_post);
    $stmt->bindParam(':id_ong', $id_ong);

    if ($stmt->execute()) {
        echo "Anúncio excluído com sucesso!";
        header("Location: pagina-ong.php");
        exit();
    } else {
        echo "Erro ao excluir o anúncio.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Excluir Anúncio</title>
</head>
<body>
    <div class="ongpost-excluir">
        <h1>Excluir Anúncio</h1>
        <p>Tem certeza de que deseja excluir este anúncio?</p>
        <form method="post">
            <button type="submit" class="exc-confirm">Confirmar Exclusão</button>
        </form>
        <a href="anuncios-ong.php"><button class="cancelar-exc">Cancelar</button></a>
    </div>
</body>
</html>

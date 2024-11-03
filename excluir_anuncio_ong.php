<?php
session_start(); // Inicia a sessão

// Verifica se o administrador está logado
if (!isset($_SESSION['email']) || $_SESSION['tipo_usuario'] !== 'Admin') {
    // Redireciona para a página de login se não estiver logado como Admin
    header("Location: login.php");
    exit();
}

// Recupera os dados da sessão
$email = $_SESSION['email'];
$nome = $_SESSION['nome'];
date_default_timezone_set('America/Sao_Paulo');

include "conn.php";

// Obtém o id_post da URL
$id_post = isset($_GET['id_post']) ? $_GET['id_post'] : null;

// Verifica se o ID do anúncio foi fornecido
if (!$id_post) {
    echo "Anúncio não encontrado.";
    exit();
}

// Processa a exclusão do anúncio
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $query = "DELETE FROM postagem_ong WHERE id_post = :id_post";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id_post', $id_post);

    // Executa a exclusão e redireciona após sucesso
    if ($stmt->execute()) {
        header("Location: anuncios-adm.php"); // Redireciona após exclusão
        exit();
    } else {
        echo "Erro ao excluir o anúncio.";
    }
}

// Busca o anúncio para confirmação
$query = "SELECT * FROM postagem_ong WHERE id_post = :id_post";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id_post', $id_post);
$stmt->execute();
$anuncio = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$anuncio) {
    echo "Anúncio não encontrado.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Excluir Anúncio</title>
    <style>
        .excluir-dados {
    position: absolute;
    top: 40%;
    left: 50%;
    transform: translate(-50%, -35%);
    width: 500px;
    height: 400px;
    background-color: #e0f2f1; /* Verde claro para o fundo */
    padding: 20px;
    border-radius: 15px;
    box-shadow: 12px 12px rgba(54, 52, 52, 0.523);
}

p{
    text-align: center;
    margin-bottom: 20px;
    color: #317634;
}
    </style>
</head>
<body>
    <div class="excluir-dados">
        <h1>Excluir Anúncio</h1>
        <p>Você está prestes a excluir o seguinte anúncio:</p>
        <p><strong>Descrição:</strong> <?= htmlspecialchars($anuncio['boxpost']) ?></p>
        <p><strong>Telefone:</strong> <?= htmlspecialchars($anuncio['telefone']) ?></p>
        <p><strong>Endereço:</strong> <?= htmlspecialchars($anuncio['endereco']) ?></p>
        <p><strong>Número:</strong> <?= htmlspecialchars($anuncio['numero']) ?></p>
        <p><strong>Categoria:</strong> <?= htmlspecialchars($anuncio['categoria']) ?></p>
        <p>Tem certeza de que deseja excluir este anúncio?</p>
        <form method="post">
            <button type="submit" style="position:absolute;background-color: red; color: white; border: none; border-radius: 5px; padding: 10px 15px; cursor: pointer; left:38%;">Confirmar Exclusão</button>
        </form>
        <a href="anuncios-adm.php">Cancelar</a>
    </div>
</body>
</html>

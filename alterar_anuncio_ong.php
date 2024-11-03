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

// Processa a atualização ou exclusão do anúncio
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Se o formulário for enviado para atualização
    if (isset($_POST['atualizar'])) {
        $boxpost = $_POST['boxpost'];
        $telefone = $_POST['telefone'];
        $endereco = $_POST['endereco'];
        $numero = $_POST['numero'];
        $categoria = $_POST['categoria'];

        $query = "UPDATE postagem_ong SET boxpost = :boxpost, telefone = :telefone, endereco = :endereco, numero = :numero, categoria = :categoria WHERE id_post = :id_post";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':boxpost', $boxpost);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':endereco', $endereco);
        $stmt->bindParam(':numero', $numero);
        $stmt->bindParam(':categoria', $categoria);
        $stmt->bindParam(':id_post', $id_post);

        // Executa a atualização e redireciona após sucesso
        if ($stmt->execute()) {
            header("Location: anuncios-adm.php"); // Redireciona após atualização
            exit();
        } else {
            echo "Erro ao atualizar o anúncio.";
        }
    } elseif (isset($_POST['excluir'])) {
        // Se o formulário for enviado para exclusão
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
} else {
    // Busca o anúncio para editar
    $query = "SELECT * FROM postagem_ong WHERE id_post = :id_post";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id_post', $id_post);
    $stmt->execute();
    $anuncio = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$anuncio) {
        echo "Anúncio não encontrado.";
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
    <style>
       body {
    font-family: Arial, sans-serif;
    background-color: #f0f8ff; /* Fundo claro para contrastar com o verde */
}

/* Estilos para o container do formulário */
.alterar-dados {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 700px;
    height: 750px;
    background-color: #e0f2f1; /* Verde claro para o fundo */
    padding: 20px;
    border-radius: 15px;
    box-shadow: 12px 12px rgba(54, 52, 52, 0.523);
}

/* Estilos para o título */
h1 {
    color: #336633; /* Verde escuro para o título */
    text-align: center;
}

/* Estilos para os labels e inputs */
label {
    display: block;
    margin-bottom: 5px;
    color: #555;
}

textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius:3px;
    box-sizing: border-box;
}

input, textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius:3px;
    box-sizing: border-box;
    
}

#alter-adm-btn-success{
    position: absolute;
    left: 35%;
    margin-top: 15px;
    cursor: pointer;
}
#alter-adm-btn-back{
    position: absolute;
    top: 700px;
}
</style>
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

        <input type="submit" name="atualizar" class="btn-success-end" id="alter-adm-btn-success" value="Atualizar Anúncio">

    </form>
    <a href="anuncios-adm.php"><button class="doacao-back " id="alter-adm-btn-back">Voltar</button></a>
    </div>
</body>
</html>

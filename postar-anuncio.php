<?php
session_start(); // Inicia a sessão

// Verifica se o usuário está logado
if (!isset($_SESSION['id_ong'])) {
    echo "Você precisa estar logado para postar um anúncio.";
    echo "<a href='login.php'>Fazer login</a>";
    return;
}

// Verifica se o ID da ONG foi passado
if (!isset($_GET['id_ong'])) {
    echo "O anúncio não está mais disponível.";
    echo "<a href='anuncios1.html'>Voltar</a>";
    return;
}

$id_ong = $_GET['id_ong'];

// Processa o envio do formulário
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Receber dados do formulário
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $observacao = $_POST['observacao'];
    
    // Verifica se o arquivo foi enviado
    if (isset($_FILES['foto_anuncio']) && $_FILES['foto_anuncio']['error'] == UPLOAD_ERR_OK) {
        $foto_anuncio = $_FILES['foto_anuncio']['name'];

        // Mover a imagem para o diretório desejado
        if (move_uploaded_file($_FILES['foto_anuncio']['tmp_name'], "uploads/" . $foto_anuncio)) {
            // Inserir dados no banco de dados
            include "conn.php"; // Inclui a conexão com o banco de dados
            $query = "INSERT INTO anuncios (id_ong, titulo, descricao, observacao, foto_anuncio) 
                      VALUES (:id_ong, :titulo, :descricao, :observacao, :foto_anuncio)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id_ong', $id_ong);
            $stmt->bindParam(':titulo', $titulo);
            $stmt->bindParam(':descricao', $descricao);
            $stmt->bindParam(':observacao', $observacao);
            $stmt->bindParam(':foto_anuncio', $foto_anuncio);

            if ($stmt->execute()) {
                echo "Anúncio postado com sucesso!";
                // Opcional: Redirecionar para outra página
                // header("Location: anuncios.php");
                // exit();
            } else {
                echo "Erro ao postar o anúncio.";
            }
        } else {
            echo "Erro ao mover a foto do anúncio.";
        }
    } else {
        echo "Erro no upload da foto do anúncio.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Postar Anúncio</title>
</head>
<body>
    <h2>Postar Anúncio</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" required><br><br>

        <label for="descricao">Descrição:</label>
        <textarea name="descricao" required></textarea><br><br>

        <label for="observacao">Observação:</label>
        <textarea name="observacao"></textarea><br><br>

        <label for="foto_anuncio">Foto do Anúncio:</label>
        <input type="file" name="foto_anuncio" accept="image/*" required><br><br>

        <input type="submit" value="Postar Anúncio">
    </form>
</body>
</html>

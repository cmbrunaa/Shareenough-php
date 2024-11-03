<?php
session_start();

// Verifica se o usuário está logado como ONG
if (!isset($_SESSION['email']) || !isset($_SESSION['id_ong'])) {
    header("Location: login.php");
    exit();
}

// Obtém o ID da ONG da sessão
$id_ong_sessao = $_SESSION['id_ong'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Document</title>
</head>
<body>
<?php
// Inclui a conexão com o banco de dados
include "conn.php";
date_default_timezone_set('America/Sao_Paulo');


// Consulta para buscar os anúncios da ONG
$query = "SELECT 
    ongs.id_ong, 
    ongs.nome AS nome_ong, 
    ongs.endereco AS endereco_ong, 
    ongs.cnpj, 
    postagem_ong.id_post, 
    postagem_ong.boxpost, 
    postagem_ong.telefone AS telefone_postagem, 
    postagem_ong.endereco AS endereco_postagem, 
    postagem_ong.numero, 
    postagem_ong.categoria, 
    postagem_ong.ong_post_file, 
    postagem_ong.data_post
FROM 
    postagem_ong 
INNER JOIN 
    ongs ON ongs.id_ong = postagem_ong.id_ong";

$stmt = $conn->prepare($query);
$stmt->execute();

if ($stmt->rowCount() === 0) {
    echo "<p>Nenhum anúncio encontrado.</p>";
} else {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $foto_anuncio = "upload/" . htmlspecialchars($row['ong_post_file']);
        $boxpost = htmlspecialchars($row['boxpost']);
        $telefone = htmlspecialchars($row['telefone_postagem']);
        $endereco_postagem = htmlspecialchars($row['endereco_postagem']);
        $numero = htmlspecialchars($row['numero']);
        $categoria = htmlspecialchars($row['categoria']);
        $data_post = htmlspecialchars($row['data_post']);
        $nome_ong = htmlspecialchars($row['nome_ong']);
        $id_ong_anuncio = $row['id_ong'];
        $id_post = $row['id_post'];

        echo "<div class='anuncio'>";
        if (file_exists($foto_anuncio)) {
            echo "<img src='$foto_anuncio' alt='Imagem do anúncio' class='anuncio-imagem' style='width: 100%; max-width: 300px; height: auto; border-radius: 8px;'>";
        } else {
            echo "<p>Imagem não encontrada: $foto_anuncio</p>";
        }
        echo "<div class='boxpost-text'><h4>$boxpost</h4></div>";
        echo "<p>ONG: $nome_ong</p>";
        echo "<p>Telefone: $telefone</p>";
        echo "<p>Endereço: $endereco_postagem, Nº $numero</p>";
        echo "<p>Categoria: $categoria</p>";
        echo "<p>Publicado em: $data_post</p>";

        // Exibe os botões "Alterar" e "Excluir" somente se o anúncio pertence à ONG logada
        if ($id_ong_anuncio == $id_ong_sessao) {
            echo "<a href='alterar_anuncio.php?id_post=$id_post' class='btn-alterar-ads'>Alterar</a> | ";
            echo "<a href='excluir_anuncio.php?id_post=$id_post' class='btn-excluir-ads' onclick='return confirm(\"Tem certeza que deseja excluir este anúncio?\")'>Excluir</a>";
        }

        echo "</div>";
    }
}
?>



</body>
</html>



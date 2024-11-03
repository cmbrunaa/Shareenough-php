<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];
$nome = $_SESSION['nome'];
$data_cadastro = $_SESSION['data_cadastro'] ?? 'Data não disponível';
$telefone = $_SESSION['telefone'] ?? 'Telefone não disponível';

include "conn.php";
date_default_timezone_set('America/Sao_Paulo');

$query = "SELECT 
    ongs.id_ong, 
    ongs.nome AS nome_ong, 
    ongs.endereco AS endereco_ong, 
    ongs.cnpj, 
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
        // Define o caminho da imagem corretamente
        $foto_anuncio = "upload/" . htmlspecialchars($row['ong_post_file']); // Ajuste o caminho do arquivo
        $boxpost = htmlspecialchars($row['boxpost']);
        $telefone = htmlspecialchars($row['telefone_postagem']);
        $endereco_postagem = htmlspecialchars($row['endereco_postagem']);
        $numero = htmlspecialchars($row['numero']);
        $categoria = htmlspecialchars($row['categoria']);
        $data_post = htmlspecialchars($row['data_post']);
        $nome_ong = htmlspecialchars($row['nome_ong']);

        echo "<div class='anuncio'>";
        // Verifica se o arquivo de imagem existe antes de exibir
        if (file_exists($foto_anuncio)) {
            echo "<img src='$foto_anuncio' alt='Imagem do anúncio' class='anuncio-imagem' style='width: 100%; max-width: 300px; height: auto; border-radius: 8px;'>";
        } else {
            // Adiciona uma mensagem de depuração
            echo "<p>Imagem não encontrada: $foto_anuncio</p>";
        }
        echo "<div class='boxpost-text'><h4>$boxpost</h4></div>";
        echo "<div class='ads-info'>";
        echo "<p>POSTADO PELA ONG: $nome_ong</p>"; // Exibe o nome da ONG
        echo "<p>Telefone: $telefone</p>";
        echo "<p>Endereço: $endereco_postagem, Nº $numero</p>";
        echo "<p>Categoria: $categoria</p>";
        echo "<p>Anúncio publicado em: $data_post</p>";
        echo "<a href='doaconfirm.php?id_ong=" . htmlspecialchars($row['id_ong']) . "' style='display: inline-block; background-color: #28a745; color: white; padding: 10px 15px; border-radius: 5px; text-decoration: none;'>Doar</a>";
        echo "</div>";
        echo "</div>";
    }
}
?>

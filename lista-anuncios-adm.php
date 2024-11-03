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
// Você pode adicionar mais dados da sessão aqui, se necessário
date_default_timezone_set('America/Sao_Paulo');

include "conn.php";

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
    postagem_ong.data_post,
    postagem_ong.id_post 
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
        $foto_anuncio = "upload/" . htmlspecialchars($row['ong_post_file']); 
        $boxpost = htmlspecialchars($row['boxpost']);
        $telefone = htmlspecialchars($row['telefone_postagem']);
        $endereco_postagem = htmlspecialchars($row['endereco_postagem']);
        $numero = htmlspecialchars($row['numero']);
        $categoria = htmlspecialchars($row['categoria']);
        $data_post = htmlspecialchars($row['data_post']);
        $nome_ong = htmlspecialchars($row['nome_ong']);
        $id_post = $row['id_post'];  // Acesse o id_post aqui

        echo "<div class='anuncio'>";
        // Verifica se o arquivo de imagem existe antes de exibir
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
        
        // Botões de alterar e excluir com a classe btn
        echo "<a href='alterar_anuncio_ong.php?id_post=" . htmlspecialchars($id_post) . "' class='btn btn-alterar'>Alterar</a> | ";
        echo "<a href='excluir_anuncio_ong.php?id_post=" . htmlspecialchars($id_post) . "' class='btn btn-excluir' onclick='return confirm(\"Tem certeza que deseja excluir este anúncio?\")'>Excluir</a>";

        echo "</div>";
    }
}
?>

<style>
.btn {
    display: inline-block;
    padding: 10px 20px;
    margin: 5px;
    border-radius: 8px;
    text-decoration: none;
    color: #000;
    transition: background-color 0.3s;
}

.btn-alterar {
    background-color: #f8f348; /* Cor para o botão Alterar */
}

.btn-alterar:hover {
    background-color: yellow; /* Cor ao passar o mouse no botão Alterar */
}

.btn-excluir {
    background-color: #d80000; /* Cor para o botão Excluir */
}

.btn-excluir:hover {
    background-color: darkred; /* Cor ao passar o mouse no botão Excluir */
}
</style>

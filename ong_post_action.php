<?php
session_start();

// Verifica se o usuário está logado e é uma ONG
if (!isset($_SESSION['email']) || $_SESSION['tipo_usuario'] !== 'ONG') {
    header("Location: login.php");
    exit();
}

// Recupera o ID da ONG e outras informações de sessão
if (!isset($_SESSION['id_ong'])) {
    die("Erro: ID da ONG não definido na sessão.");
}
$id_ong = $_SESSION['id_ong'];
$email = $_SESSION['email'];
$nome = $_SESSION['nome'];
$data_cadastro = $_SESSION['data_cadastro'] ?? 'Data não disponível';
$telefone = $_SESSION['telefone'] ?? 'Telefone não disponível';

include "conn.php";
date_default_timezone_set('America/Sao_Paulo');
$data_post = date('Y-m-d H:i:s');

if (isset($_POST['publicar'])) {
    // Obtém os dados do formulário
    $boxpost = $_POST['boxpost'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];
    $numero = $_POST['numero'];
    $categoria = $_POST['categoria'];
    $foto_anuncio = $_FILES['ong_post_file']['name'];

    // Criptografa o nome do arquivo com md5
    $extensao = strtolower(pathinfo($foto_anuncio, PATHINFO_EXTENSION));
    $nome_criptografado = md5(time() . $foto_anuncio) . ".$extensao";

    // Move a imagem para o diretório desejado
    if (move_uploaded_file($_FILES['ong_post_file']['tmp_name'], "upload/" . $nome_criptografado)) {
        // Prepara e executa o INSERT no banco de dados
        $grava = $conn->prepare(
            'INSERT INTO `postagem_ong` (`id_post`, `boxpost`, `telefone`, `endereco`, `numero`, `categoria`, `ong_post_file`, `data_post`, `id_ong`) 
            VALUES (null, :boxpost, :telefone, :endereco, :numero, :categoria, :ong_post_file, :data_post, :id_ong)'
        );
        $grava->bindValue(':boxpost', $boxpost);
        $grava->bindValue(':telefone', $telefone);
        $grava->bindValue(':endereco', $endereco);
        $grava->bindValue(':numero', $numero);
        $grava->bindValue(':categoria', $categoria);
        $grava->bindValue(':ong_post_file', $nome_criptografado); // Armazena o nome criptografado
        $grava->bindValue(':data_post', $data_post);
        $grava->bindValue(':id_ong', $id_ong);

        if ($grava->execute()) {
            echo "Dados inseridos com sucesso!";
            header("Location: anuncios-ong.php");
            exit;
        } else {
            echo "Erro ao inserir dados: " . $grava->errorInfo()[2];
        }
    } else {
        echo "Erro no upload da imagem!";
    }
}
?>

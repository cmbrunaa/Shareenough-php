<?php
session_start();

// Verifica se o usuário está logado e é uma ONG
if (!isset($_SESSION['email']) || $_SESSION['tipo_usuario'] !== 'ONG') {
    header("Location: login.php");
    exit();
}

// Conexão com o banco de dados
$conn = new PDO('mysql:host=localhost;dbname=shareenoughv2', 'root', getenv("MYSQL_PASS"));

// Recupera o ID da ONG da sessão
$id_ong = $_SESSION['id_ong'];

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Atualiza os dados da ONG
    $novo_nome = htmlspecialchars($_POST['nome']);
    $novo_endereco = htmlspecialchars($_POST['endereco']);
    $novo_cnpj = htmlspecialchars($_POST['cnpj']);
    $novo_telefone = htmlspecialchars($_POST['telefone']);

    // Atualiza no banco de dados
    $sql = "UPDATE ongs SET nome = :nome, endereco = :endereco, cnpj = :cnpj, telefone = :telefone WHERE id_ong = :id_ong";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nome', $novo_nome);
    $stmt->bindParam(':endereco', $novo_endereco);
    $stmt->bindParam(':cnpj', $novo_cnpj);
    $stmt->bindParam(':telefone', $novo_telefone);
    $stmt->bindParam(':id_ong', $id_ong);

    if ($stmt->execute()) {
        // Atualiza os dados da sessão se necessário
        $_SESSION['nome'] = $novo_nome;
        $_SESSION['endereco'] = $novo_endereco;
        $_SESSION['cnpj'] = $novo_cnpj;
        $_SESSION['telefone'] = $novo_telefone;

        header("Location: perfil-ong.php"); // Redireciona para a página de alteração de dados após a alteração
        exit();
    } else {
        die("Erro ao atualizar os dados.");
    }
}

// Busca os dados da ONG para preencher os campos do formulário
$sql = "SELECT nome, endereco, cnpj, telefone FROM ongs WHERE id_ong = :id_ong";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id_ong', $id_ong);
$stmt->execute();

// Verifica se a consulta retornou algum resultado
$ong = $stmt->fetch(PDO::FETCH_ASSOC);
if ($ong === false) {
    die("Erro: A ONG com o ID especificado não foi encontrada.");
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Dados - ONG</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  
</head>
<body>
<header>
    <nav>
        <a class="logo" href="index.php">
            <img src="./img/logo.png" />
        </a>
        <ul class="nav-list">
            <li><a href="quemsomos.php">Quem Somos</a></li>
            <li><a href="ongs.html">Ongs</a></li>
            <li><a href="faq.php">Faq</a></li>
            <li><a href="anuncios-ong.php">Anúncios</a></li>
            <li><a href="ong_post.php">Minhas publicações</a></li>
            <li><a href="logout.php">Sair</a></li>
        </ul>
    </nav>
</header>

<section class="alterar-dados">
    <h1>Alterar Dados da ONG</h1>
    <form action="" method="post">
        <div class="form-row">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($ong['nome']); ?>" required>
        </div>
        <div class="form-row">
            <label for="endereco">Endereço:</label>
            <input type="text" name="endereco" id="endereco" value="<?php echo htmlspecialchars($ong['endereco']); ?>" required>
        </div>
        <div class="form-row">
            <label for="cnpj">CNPJ:</label>
            <input type="text" name="cnpj" id="cnpj" value="<?php echo htmlspecialchars($ong['cnpj']); ?>" required>
        </div>
        <div class="form-row">
            <label for="telefone">Telefone:</label>
            <input type="text" name="telefone" id="telefone" value="<?php echo htmlspecialchars($ong['telefone']); ?>" required>
        </div>

        <a  href="perfil-ong.php"><button class="btnongdoavoltar" id="btnvoltaralterar">Voltar para meu perfil</button></a>
        <button type="submit" class="btn-salvar">Salvar Alterações</button>
    </form>
</section>

</body>
</html>

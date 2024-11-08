<?php
session_start(); // Inicia a sessão

// Verifica se o usuário está logado e é um Usuário
if (!isset($_SESSION['email']) || $_SESSION['tipo_usuario'] !== 'Usuario') {
    header("Location: login.php");
    exit();
}

// Conexão com o banco de dados
$conn = new PDO('mysql:host=localhost;dbname=shareenoughv2', 'root', getenv("MYSQL_PASS"));

// Recupera o ID do usuário da sessão
$id_usuario = $_SESSION['id_usuario'];

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Atualiza os dados do usuário
    $novo_nome = htmlspecialchars($_POST['nome']);
    $novo_telefone = htmlspecialchars($_POST['telefone']);
    $novo_email = htmlspecialchars($_POST['email']);

    // Atualiza no banco de dados
    $sql = "UPDATE usuarios SET nome = :nome, telefone = :telefone, email = :email WHERE id_usuario = :id_usuario";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nome', $novo_nome);
    $stmt->bindParam(':telefone', $novo_telefone);
    $stmt->bindParam(':email', $novo_email);
    $stmt->bindParam(':id_usuario', $id_usuario);

    if ($stmt->execute()) {
        // Atualiza os dados da sessão se necessário
        $_SESSION['nome'] = $novo_nome;
        $_SESSION['telefone'] = $novo_telefone;
        $_SESSION['email'] = $novo_email;

        header("Location: perfil-usuario.php"); // Redireciona para a página de perfil após a alteração
        exit();
    } else {
        die("Erro ao atualizar os dados.");
    }
}

// Busca os dados do usuário para preencher os campos do formulário
$sql = "SELECT nome, telefone, email FROM usuarios WHERE id_usuario = :id_usuario";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id_usuario', $id_usuario);
$stmt->execute();

// Verifica se a consulta retornou algum resultado
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);
if ($usuario === false) {
    die("Erro: O usuário com o ID especificado não foi encontrado.");
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Alterar Dados - Usuário</title>
    <style>
        /* Adicionando um estilo básico para o formulário */
        .alterar-dados {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .form-row {
            display: flex;
            flex-direction: column;
            margin-bottom: 15px;
        }
        label {
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"] {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: green;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: darkgreen;
        }
    </style>
</head>
<body>
<header>
    <nav>
        <a class="logo" href="index.php">
            <img src="./img/logo.png" />
        </a>
        <ul class="nav-list">
            <li><a href="pagina-usuario.php">Página Inicial</a></li>
            <li><a href="quemsomos.php">Quem Somos</a></li>
            <li><a href="anuncios.php">Anúncios</a></li>
            <li><a class="logout" href="logout.php">Sair</a></li>
        </ul>
    </nav>
</header>

<section class="alterar-dados">
    <h1>Alterar Dados do Usuário</h1>
    <form action="" method="post">
        <div class="form-row">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($usuario['nome']); ?>" required>
        </div>
        <div class="form-row">
            <label for="telefone">Telefone:</label>
            <input type="text" name="telefone" id="telefone" value="<?php echo htmlspecialchars($usuario['telefone']); ?>" required>
        </div>
        <div class="form-row">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required>
        </div>
        <button type="submit">Salvar Alterações</button>
    </form>
</section>

</body>
</html>

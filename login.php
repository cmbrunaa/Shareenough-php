<?php
session_start();
include "conn.php"; // Conexão com o banco de dados

$erroLogin = false; // Variável para verificar erro de login

if (isset($_POST['logar'])) {
    $email = $_POST['email'];
    $senha = md5($_POST['senha']); // Usando md5 para hash da senha

    // Login de usuário comum
    $ver_login_usuario = $conn->prepare('SELECT * FROM `usuarios` WHERE `email` = :pemail AND `senha` = :psenha');
    $ver_login_usuario->bindValue(':pemail', $email);
    $ver_login_usuario->bindValue(':psenha', $senha);
    $ver_login_usuario->execute();

    if ($ver_login_usuario->rowCount() > 0) {
        $row = $ver_login_usuario->fetch();
        $_SESSION['id_usuario'] = $row['id_usuario']; 
        $_SESSION['tipo_usuario'] = 'Usuario';
        $_SESSION['email'] = $row['email'];
        $_SESSION['nome'] = $row['nome'];
        $_SESSION['data_cadastro'] = $row['data_cadastro'];
        $_SESSION['telefone'] = $row['telefone'];
        header('Location: pagina-usuario.php');
        exit;
    }

    // Login de ONG
    $ver_login_ong = $conn->prepare('SELECT * FROM `ongs` WHERE `email` = :pemail AND `senha` = :psenha');
    $ver_login_ong->bindValue(':pemail', $email);
    $ver_login_ong->bindValue(':psenha', $senha);
    $ver_login_ong->execute();

    if ($ver_login_ong->rowCount() > 0) {
        $row = $ver_login_ong->fetch();
        $_SESSION['id_ong'] = $row['id_ong'];
        $_SESSION['tipo_usuario'] = 'ONG';
        $_SESSION['email'] = $row['email'];
        $_SESSION['nome'] = $row['nome'];
        $_SESSION['data_cadastro'] = $row['data_cadastro'];
        $_SESSION['endereco'] = $row['endereco'];
        $_SESSION['telefone'] = $row['telefone'];
        $_SESSION['cnpj'] = $row['cnpj'];
        header('Location: pagina-ong.php');
        exit;
    }

    // Login de Administrador
    $ver_login_admin = $conn->prepare('SELECT * FROM `administrador` WHERE `email` = :pemail AND `senha` = :psenha');
    $ver_login_admin->bindValue(':pemail', $email);
    $ver_login_admin->bindValue(':psenha', $senha);
    $ver_login_admin->execute();

    if ($ver_login_admin->rowCount() > 0) {
        $row = $ver_login_admin->fetch();
        $_SESSION['id_usuario'] = $row['id_admin'];
        $_SESSION['tipo_usuario'] = 'Admin';
        $_SESSION['email'] = $row['email'];
        $_SESSION['nome'] = $row['nome'];
        header('Location: pagina-admin.php');
        exit;
    }

    // Define a variável de erro para exibir uma mensagem
    $erroLogin = true;
}
?>

<!DOCTYPE html>
<html lang="pt-br" class="html-login">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Login</title>
</head>
<body class="body-login">
<header>
    <nav>
        <a class="logo" href="index.php">
            <img src="./img/logo.png" />
        </a>
        <ul class="nav-list">
            <li><a href="index.php">Página inicial</a></li> 
            <li><a href="quemsomos.html">Quem Somos</a></li>
            <li><a href="faq.html">Faq</a></li>
        </ul>
    </nav>
</header>
<main class="mainlogin">
    <div class="boxlogin">
        <form class="login-form" action="" method="POST">
            <h2>Faça seu login</h2>
            <?php if ($erroLogin): ?>
                <div class="alert alert-danger">Credenciais inválidas. Tente novamente.</div>
            <?php endif; ?>
            <label for="email"></label>
            <input type="text" name="email" id="email" placeholder="Digite seu email" required><br>
            <label for="password"></label>
            <input type="password" name="senha" id="minhasenha" placeholder="Digite sua senha" required>
            <div class="showsenha">
                <button type="button" onclick="mostrarSenha()" class="showpassword">Mostrar senha</button>
            </div><br>
            <button type="submit" name="logar" class="botaologin">ENTRAR</button>
        </form>
        <div class="login-link">
            <p>Não possui Login? <a href="cadastro-usuario.php">Cadastrar-se</a></p>
        </div>
    </div>
</main>

<script>
    function mostrarSenha() {
        var senha = document.getElementById("minhasenha");
        senha.type = (senha.type === "password") ? "text" : "password";
    }
</script>

<footer class="rodape" style="position: absolute; top:800px">
    <section class="rodapebox">
        <div class="caixasrodape">
            <h1>Redes Sociais</h1>
            <p>Siga nas redes sociais.</p>
            <a href="https://www.facebook.com" target="_blank"><img src="img/facebook.png" alt="Facebook"></a>
            <a href="https://www.instagram.com" target="_blank"><img src="img/instagram.png" alt="Instagram"></a>
            <a href="https://twitter.com" target="_blank"><img src="img/twitter.png" alt="Twitter"></a>
            <a href="https://www.linkedin.com" target="_blank"><img src="img/linkedin.png" alt="LinkedIn"></a>
        </div>
        <div class="caixasrodape" style="display: flex; flex-direction: column; justify-content: space-between;">
            <div>
                <h1>Suporte</h1>
                <a href="faq.html">FAQ</a>
            </div>
            <div class="direitoscopyright">
                <p>&copy; 2024 SHAREENOUGH - Todos os direitos reservados</p>
            </div> 
        </div>
        <div class="caixasrodape">
            <h1>Contato</h1>
            <div class="contato-item">
                <a href="https://mail.google.com/mail/u/0/#inbox" target="_blank"><img src="img/gmail.png" alt="gmail"></a> 
                <a href="https://mail.google.com/mail/u/0/#inbox" target="_blank">shareenough@gmail.com</a>
            </div> 
            <div class="contato-item">
                <a href="https://www.whatsapp.com/" target="_blank"><img src="img/whatsapp.png" alt="whatsapp"></a> 
                <a href="https://www.whatsapp.com/" target="_blank">(41) 99999-9999</a>
            </div>
        </div>
    </section>
</footer>
</body>
</html>

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
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>SHAREENOUGH ADM</title>
</head>
<body>
    <header id="header-adm">
    <nav>
        <a class="logo" href="pagina-admin.php">
            <img src="./img/logo.png" />
        </a>
        <ul class="nav-list" id="nav-list-adm">
            <li><a href="anuncios-adm.php">Excluir Anúncios</a></li>
        </ul>
    </nav>
    </header>
    <main class="main-adm">
        <div class="adm-welcome">
            <h1>Olá, Admin <?php echo $nome; ?>!</h1> <!-- Saudação personalizada -->
            <p id="p-um">Bem-vindo(a) à área de administração.</p>
            <p id="pdois">Aqui você pode excluir anúncios indesejáveis, alterar dados e excluir perfis de ongs e usuários! Navegue pelo menu para ter acesso as páginas de alterações.</p>
            <a href="excluir_usuarios.php"><button class="btn-exc-adm">Excluir Perfis</button></a>
            <a href="anuncios-adm.php"><button class="btn-exc-adm">Excluir Anúncios</button></a>
        </div>
        

   
       
    
    </main>
</body>
</html>

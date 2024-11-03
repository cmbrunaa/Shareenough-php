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
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css"> <!-- Arquivo CSS externo -->
    <title>SHAREENOUGH ADM</title>
    <style>
        .adm-welcome {
            margin-top: 80px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
            padding: 30px;
            background-color: #ffffff;
        }
        .adm-welcome h1 {
            color: #209926;
        }
        .adm-welcome p {
            font-size: 1.1rem;
            color: #555;
        }
        .btn-logout {
            background-color: #e60000;
            color: #fff;
            border: none;
            margin-top: 20px;
        }
        .btn-logout:hover {
            background-color: #cc0000;
        }
        .btn-excluir-anuncios {
            background-color: #007bff;
            color: #fff;
            border: none;
            margin-top: 10px;
        }
        .btn-excluir-anuncios:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <a class="logo" href="pagina-admin.php">
                <img src="./img/logo.png" alt="Logo" />
            </a>
            <ul class="nav-list">
                <li><a href="anuncios-adm.php">Excluir Anúncios</a></li>
                <li><a href="logout.php">Sair</a></li>
            </ul>
        </nav>
    </header>
    

    <main>
    <div class="container">
            <div class="adm-welcome mx-auto mt-5 p-4 col-md-8">
                <h1>Olá, Admin <?php echo htmlspecialchars($nome); ?>!</h1> <!-- Saudação personalizada -->
                <p>Bem-vindo(a) à área de administração.</p>
                <p>Aqui você pode excluir anúncios indesejáveis e alterar dados! Navegue pelo menu para ter acesso às páginas de alterações.</p>
                
                <!-- Botão para excluir anúncios -->
                <a href="anuncios-adm.php" class="btn btn-excluir-anuncios">Excluir Anúncios</a>
                
                <!-- Botão de Logout -->
                <a href="logout.php" class="btn btn-logout">Logout</a>
            </div>
        </div>
    </main>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

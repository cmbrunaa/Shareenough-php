<?php
session_start(); // Inicia a sessão

// Verifica se o usuário está logado
if (!isset($_SESSION['email'])) {
    // Redireciona para a página de login se não estiver logado
    header("Location: login.php");
    exit();
}

// Recupera os dados da sessão
$email = $_SESSION['email'];
$nome = $_SESSION['nome'];
$data_cadastro = isset($_SESSION['data_cadastro']) ? $_SESSION['data_cadastro'] : 'Data não disponível';
$telefone = isset($_SESSION['telefone']) ? $_SESSION['telefone'] : 'Telefone não disponível';

if (isset($_GET['id_ong'])) {
    $id_ong = $_GET['id_ong']; // Captura o ID da ONG
} else {
    echo "Erro: ID da ONG não está definido.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>SHAREENOUGH</title>
</head>
<body>
    <header>
    <nav>
        <a class="logo" href="pagina-usuario.php">
            <img src="./img/logo.png" />
        </a>
        <ul class="nav-list">
            <li><a href="anuncios.php">Anúncios</a></li>
            <li><a href="perfil-usuario.php"><img src="img/user.png" width="20px" height="20px"/></a></li>
        </ul>
    </nav>
    </header>
    
    <main>
        <section class="doaconfirmmain">
            <div class="doaconfirmdiv">
                <h1>Selecione o tipo de doação que você irá fazer</h1>

                <form action="redireciona_doacao.php" method="POST">
                    <input type="hidden" name="id_ong" value="<?php echo htmlspecialchars($_GET['id_ong']); ?>">
                    <button type="submit" class="btn-doaconfirm" name="tipo_doacao"  id="roupa" value="roupa">Roupas</button>
                    <button type="submit" class="btn-doaconfirm" name="tipo_doacao" id="alimento" value="alimento">Alimentos</button>
                </form>
                <p>Ao selecionar um botão, você será redirecionado para o formulário correspondente a opção selecionada</p>
            </div>
        </section>

    </main>

   <footer class="rodape" style="position:absolute; top:701px;flex-shrink: 0;">
        <section class="rodapebox">
            <div class="caixasrodape">
                <h1>Redes Socias</h1>
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
            <div class="caixasrodape contato-rodape">
                <h1>Contato</h1>
                  <div class="contato-item">
                    <a href="https://mail.google.com/mail/u/0/#inbox" target="_blank"><img src="img/gmail.png" alt="gmail"></a> 
                    <a href="https://mail.google.com/mail/u/0/#inbox" target="_blank"><p>shareenough@gmail.com</p></a>
                </div> 
                <div class="contato-item contato-item1">
                    <a href="https://www.whatsapp.com/" target="_blank"><img src="img/whatsapp.png" alt="whatsapp"></a> 
                    <a href="https://www.whatsapp.com/" target="_blank">(41) 99999-9999</a>
                </div>
            </div>
        </section>
    </footer>
</body>
</html>
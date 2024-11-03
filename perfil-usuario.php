<?php
session_start(); // Inicia a sessão

// Verifica se o usuário está logado
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Recupera os dados do usuário da sessão
$id_usuario = $_SESSION['id_usuario'];
$tipo_usuario = $_SESSION['tipo_usuario'];
$email = $_SESSION['email'];
$nome = $_SESSION['nome'];
$data_cadastro = isset($_SESSION['data_cadastro']) ? $_SESSION['data_cadastro'] : 'Data não disponível';
$telefone = isset($_SESSION['telefone']) ? $_SESSION['telefone'] : 'Telefone não disponível';

try {
    // Conexão com o banco de dados
    $conn = new PDO('mysql:host=localhost;dbname=shareenoughv2', 'root', '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Busca a imagem do usuário
    $stmt = $conn->prepare("SELECT imagem FROM usuarios WHERE id_usuario = :id_usuario");
    $stmt->bindParam(':id_usuario', $id_usuario);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $url_imagem = $row['imagem'] ?: 'caminho/para/imagem/default.jpg'; // Define uma imagem padrão se não houver
    } else {
        $url_imagem = 'caminho/para/imagem/default.jpg'; // Imagem padrão caso não exista
    }
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}

$conn = null; // Fecha a conexão com o banco de dados
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Meu Perfil</title>

</head>

<body>
    <header>
        <nav>
            <a class="logo" href="pagina-usuario.php">
                <img src="./img/logo.png" />
            </a>
            <ul class="nav-list">
                <li><a href="pagina-usuario.php">Página Inicial</a></li>
                <li><a href="anuncios.php">Anúncios</a></li>
                <li><a class="logout" href="logout.php">Sair</a></li>
            </ul>
        </nav>
    </header>

    <main>
            <div class="containerprofile">
            <img src="<?php echo htmlspecialchars($url_imagem); ?>" alt="Imagem do usuário">
            </div>
        <div class="userdate">
            <h4>Usuário desde: <?php echo date('d/m/Y', strtotime($data_cadastro)); ?></h4>
        </div>
     
        <section class="infoaccount">
            <div class="accnome">
                <h4>Nome do Usuário:</h4>
                <p><?php echo htmlspecialchars($nome); ?></p>
            </div>
            <div class="accemail">
                <h4>Seu Email:</h4>
                   <p> <?php echo htmlspecialchars($email); ?></p>
            </div>
            <div class="acctel">
                <h4>Seu Telefone:</h4>
                <p><?php echo htmlspecialchars($telefone); ?></p>
                <div class="alterar-dados-btn">
                <a href="alterar_dados.php" class="botao-alterar">Alterar Dados</a>
                </div>
            </div>

            
    
            <div class="barra"></div>
            <div class="doacaohistorico">
                <h1>Banco de doações</h1>
                <h4>Aqui está o seu histórico de doações</h4>
                <?php include "historico-doacao.php"; ?>
            </div>
        </section>
    </main>
    <footer class="rodape" id="rodapeuser">
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

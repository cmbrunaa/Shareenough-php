<?php
session_start(); // Inicia a sessão

// Verifica se a ONG está logada
if (!isset($_SESSION['id_ong'])) {
    header("Location: login.php");
    exit();
}

// Recupera os dados da ONG da sessão
$id_ong = $_SESSION['id_ong'];
$nome = $_SESSION['nome'];
$email = $_SESSION['email'];
$telefone = $_SESSION['telefone'];
$data_cadastro = isset($_SESSION['data_cadastro']) ? $_SESSION['data_cadastro'] : 'Data não disponível';

try {
    // Conexão com o banco de dados
    $conn = new PDO('mysql:host=localhost;dbname=shareenoughv2', 'root', getenv("MYSQL_PASS"));
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Busca a imagem da ONG
    $stmt = $conn->prepare("SELECT foto, cnpj, endereco FROM ongs WHERE id_ong = :id_ong");
    $stmt->bindParam(':id_ong', $id_ong);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $ong = $stmt->fetch(PDO::FETCH_ASSOC);
        $url_imagem = $ong['foto'] ?: 'caminho/para/imagem/default.jpg'; // Define uma imagem padrão se não houver
        $cnpj = $ong['cnpj'];
        $endereco = $ong['endereco'];
    } else {
        $url_imagem = 'caminho/para/imagem/default.jpg'; // Imagem padrão caso não exista
        $cnpj = 'CNPJ não disponível';
        $endereco = 'Endereço não disponível';
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
    <title>Meu Perfil - ONG</title>
    <link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
<header>
    <nav>
        <a class="logo" href="pagina-ong.php">
            <img src="./img/logo.png" />
        </a>
        <ul class="nav-list">
            <li><a href="pagina-ong.php">Página inicial</a></li> 
            <li><a href="anuncios-ong.php">Meus anúncios</a></li>
            <li><a href="ong_post.php">Fazer publicações</a></li>
            <li><a href="logout.php">Sair</a></li>
        </ul>
    </nav>
</header>

<section class="ongprofilemain">
    <div class="ongpostprofilepic2">
             <img src="<?php echo htmlspecialchars($url_imagem); ?>" alt="Imagem da ONG" class="foto-perfil" style='width: 100%; max-width: 345px; height: 345px; border-radius: 8px;' >
    </div>
    <div class="ongprofilecaddata">
        <h4>Parabéns por estar conosco desde: <?php echo date('d/m/Y', strtotime($data_cadastro)); ?></h4>
    </div>

    <div class="ongprofileinfos">
        <h1>Suas informações estão contidas neste box</h1>
        <p>Você pode visualizar e, se desejar, alterar suas informações aqui</p>
        <div class="profileinfo1">
            <h4>Nome:</h4>
            <p><?php echo htmlspecialchars($nome); ?></p>
        </div>
        <div class="profileinfo1">
            <h4>Endereço:</h4>
            <p><?php echo isset($_SESSION['endereco']) ? htmlspecialchars($_SESSION['endereco']) : 'Não cadastrado'; ?></p>
        </div>
        <div class="profileinfo1">
            <h4>Email:</h4>
            <p><?php echo htmlspecialchars($email); ?></p>
        </div>
        <div class="profileinfo1">
            <h4>CNPJ:</h4>
            <p><?php echo isset($_SESSION['cnpj']) ? htmlspecialchars($_SESSION['cnpj']) : 'Não cadastrado'; ?></p>
        </div>
        <div class="profileinfo1">
            <h4>Telefone:</h4>
            <p><?php echo htmlspecialchars($telefone); ?></p>
            <a href="alterar_dados_ong.php" class="botao-alterar">Alterar Dados</a>
        </div>
    </div>
</section>

<footer class="rodape" id="rodapeongprofile">
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

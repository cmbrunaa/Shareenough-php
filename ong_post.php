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
    <title>Postagem</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <nav>
        <a class="logo" href="pagina-ong.php">
            <img src="./img/logo.png" />
        </a>
        <ul class="nav-list">
            <li><a href="pagina-ong.php">Página inicial</a></li>
            <li><a href="anuncios-ong.php">Anúncios</a></li>
            <li><a href="perfil-ong.php"><img src="img/user.png" width="20px" height="20px"/></a></li>
        </ul>
    </nav>
    </header>
    <section class="ongpostmainsec">
        <div class="ongpostprofilepic">
        <img src="<?php echo htmlspecialchars($url_imagem); ?>" alt="Imagem da ONG" class="foto-perfil" style='width: 100%; max-width: 300px; height: 278px; border-radius: 8px;' >

        </div>

        <div class="ongpostmain">
                <h1>Faça sua postagem aqui</h1>

                <form action="ong_post_action.php" method="POST" enctype="multipart/form-data">
                    <p>
                        <label for="boxpost"> Box Post
                            <input type="text" name="boxpost" id="ongposttext" placeholder="Digite o conteúdo do seu post aqui">
                        </label>
                    </p>
                    <p>
                       <label for="telefone">Insira seu telefone:
                        <input type="number" name="telefone" id="ongposttel" placeholder="Insira apenas números, sem espaço ou simbolos">
                       </label> 
                    </p>
                    <p>
                        <label for="endereco"> Endereço
                            <input type="text" name="endereco" id="ongpostendereco" placeholder="Digite o endereço do local de entrega/retirada">
                        </label>
                        </p>
                        <label for="numero"> Número
                            <input type="number" name="numero" id="ongpostnumero">
                        </label>
                    
                    <p>
                        <label for="categoria"> Categoria: 
                            <input type="radio" name="categoria" id="btn_rp_ali" value="roupa" required> Roupa
                        </label>

                        <label for="btn_rp_ali">
                            <input type="radio" name="categoria" id="btn_rp_ali" value="alimento" required> Alimento
                        </label>
                    </p>
                    <p>
                        <label for="ongpostfile" class="file-label"> Adicione uma foto
                            <input type="file" name="ong_post_file" id="ongpostfile" id="enviarfile" >
                        </label>
                    </p>
                    <p><input type="submit" name="publicar" value="publicar" class="publicar"></p>
                </form>
                

                <a  href="perfil-ong.php"><button class="btnongdoavoltar">Voltar para meu perfil</button></a>
                <a  href="pagina-ong.php"><button class="btnongdoavoltar">Ir para página inicial</button></a>
        </div>
    </section>
</body>
</html>
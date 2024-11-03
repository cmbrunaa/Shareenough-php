<?php 
include "conn.php";

date_default_timezone_set('America/Sao_Paulo');
if(isset($_POST['cadastrar'])){
    $nome=$_POST['name'];
    $tel=$_POST['telefone'];
    $cnpj=$_POST['cnpj'];
    $endereco=$_POST['endereco'];
    $email=$_POST['email'];
    $senha=$_POST['password'];

    // Validações
    if(!preg_match('/^[^0-9]{2,80}$/i',$nome)){
        echo "Nome inválido, digite novamente!";
    }
    $cnpjexp='/^\d{2}\.\d{3}\.\d{3}\/\d{4}-\d{2}$/';
    if(!preg_match($cnpjexp, $cnpj)){
        echo "Cnpj inválido, digite de acordo com o padrão!";
    }
    if(!preg_match('/^\(?\d{2}\)?\s?\d{4,5}-?\d{4}$/', $tel)){
        echo "Número inválido, digite novamente!";
    }
    if(!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email)){
        echo "Formato de email inválido, digite novamente!";
    }
    if(!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/', $senha)){
        echo "Formato de senha inválida, digite de acordo com o padrão definido.";
    }

    // Hash da senha usando md5
    $senha = md5($senha);

    $datacad = date('Y-m-d H:i:s');

    // Configurações para upload de arquivo
    $_UP['pasta'] = "upload/"; // Pasta onde os arquivos serão armazenados
    $_UP['tamanho_arquivo'] = 1024 * 1024 * 20; // 20MB
    $_UP['extensao'] = ['jpg', 'png', 'jpeg', 'gif'];
    $_UP['renomear'] = true; // Se true, renomeia o arquivo para evitar conflitos

    // Função para fazer o upload da imagem
    function uploadImagem($file) {
        global $_UP;
        if ($file['error'] === UPLOAD_ERR_OK) {
            $arquivo = $file['name'];
            $extensao = strtolower(pathinfo($arquivo, PATHINFO_EXTENSION));

            if (!in_array($extensao, $_UP['extensao'])) {
                return "Extensão não aceita!";
            }

            if ($file['size'] > $_UP['tamanho_arquivo']) {
                return "Arquivo muito grande!";
            }

            $nome_final = $_UP['renomear'] ? md5(time()) . ".$extensao" : $arquivo;
            if (move_uploaded_file($file['tmp_name'], $_UP['pasta'] . $nome_final)) {
                return $_UP['pasta'] . $nome_final; // Retorna o caminho da imagem
            }
        }
        return null; // Retorna null se não houve upload
    }

    $url_imagem = uploadImagem($_FILES['imagem']); // Faz o upload da imagem

    if (!$url_imagem) {
        echo "Erro ao fazer upload da imagem.";
        exit();
    }

    $grava=$conn->prepare('INSERT INTO `ongs` (`id_ong`, `nome`, `cnpj`, `endereco`, `email`, `telefone`, `senha`, `data_cadastro`, `foto`) VALUES (NULL, :nome, :cnpj, :endereco, :email, :tel, :senha, :data_cadastro, :foto);');
    $grava->bindValue(':nome', $nome);
    $grava->bindValue(':cnpj', $cnpj);
    $grava->bindValue(':endereco', $endereco);
    $grava->bindValue(':email', $email);
    $grava->bindValue(':tel', $tel); 
    $grava->bindValue(':senha', $senha);
    $grava->bindValue(':data_cadastro', $datacad);
    $grava->bindValue(':foto', $url_imagem); // Armazena o caminho da imagem

    if ($grava->execute()) {
        header("Location: login.php");
        exit();
    } else {
        echo "Erro ao cadastrar usuário.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Cadastro</title>
</head>
<body>
    <header>
        <nav>
            <a class="logo" href="index.php">
                <img src="./img/logo.png" />
            </a>
            <ul class="nav-list">
                <li><a href="quemsomos.html">Quem Somos</a></li>
                <li><a href="ongs.html">Ongs</a></li>
                <li><a href="faq.html">Faq</a></li>
                <li><a href="index.php">Página inicial</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="cadastro3d">
            <form class="cad-form" method="POST" enctype="multipart/form-data" class="formcad">
                <h2>Faça seu Cadastro</h2>
                <p>Preencha todas as informações abaixo para realizar seu cadastro:</p>
                <label for="name"></label>
                <input type="text" name="name" id="name" placeholder="Digite o nome da sua ong" class="formstyle" required><br>
                <label for="telefone"></label>
                <input type="text" name="telefone" placeholder="Digite seu Telefone" class="formstyle" required><br>
                <label for="cnpj"></label>
                <input type="text" name="cnpj"  placeholder="Digite seu CNPJ" class="formstyle" required><br>
                <label for="endereco"></label>
                <input type="text" name="endereco" class="formstyle" placeholder="Digite seu endereço">
                    <p class="senharules">Exemplo: "Rua das Flores, 123, Jardim das Oliveiras (bairro)"</p>
                <label for="email"></label>
                <input type="text" name="email" id="email" class="formstyle" placeholder="Digite seu email" required>
                    <p class="senharules">Exemplo: ong@gmail.com</p>
                <label for="password"></label>
                <input type="password" name="password" id="password" class="formstyle" placeholder="Digite sua Senha" required>
                <p class="senharules">Insira uma foto de perfil:</p>
                <label for="imagem" class="formstyle">
                <input type="file" name="imagem" accept="image/*" required></label><br>
                
                <p class="senharules">Para maior segurança digite sua senha de acordo com o formato a seguir</p>
                <p class="senharules">Entre 8 e 20 caracteres. Pelo menos uma letra maiúscula. Pelo menos uma letra minúscula. Pelo menos um número. Pelo menos um caractere especial(!@#$.,%&).</p>
                <input type="submit" name="cadastrar" value="cadastrar" class="botaologin">
             
            </form>
            <div class="cad-link">
                <p>Já possui cadastro? <a href="login.php">Faça login</a></p>
            </div>  
        </div>
    </main> 
</body>
</html
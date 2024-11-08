<?php 
include "conn.php";

date_default_timezone_set('America/Sao_Paulo');
if(isset($_POST['cadastrar'])){
    $nome=$_POST['name'];
    $cpf_cnpj=$_POST['cpf_cnpj'];
    $tel=$_POST['telefone'];
    $email=$_POST['email'];
    $senha=$_POST['password'];

    // Validações
    if(!preg_match('/^[^0-9]{2,80}$/i',$nome)){
        echo "Nome inválido, digite novamente!";
    } 
    $cpfexp='/^(\d{3}\.\d{3}\.\d{3}-\d{2}|\d{2}\.\d{3}\.\d{3}\/\d{4}-\d{2})$/';
    if(!preg_match($cpfexp, $cpf_cnpj)){
        echo "Cpf inválido, digite de acordo com o padrão!";
    }
    if(!preg_match('/^\(?\d{2}\)?\s?\d{4,5}-?\d{4}$/', $tel)){
        echo "Número inválido, digite novamente!";
    }
    if(!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email)){
        echo "formato de email inválido, digite novamente!";
    }
    if(!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/', $senha)){
        echo "formato de senha inválida, digite de acordo com o padrão definido.";
    }

    $datacad = date('Y-m-d H:i:s');

    // Criptografar a senha com MD5
    $senha_hash = md5($senha);

    // Configurações para upload de arquivo
    $_UP['pasta'] = "upload/";
    $_UP['tamanho_arquivo'] = 1024 * 1024 * 20; // 20MB
    $_UP['extensao'] = ['jpg', 'png', 'jpeg', 'gif'];
    $_UP['renomear'] = true;

    // Função para realizar o upload de fotos
    function uploadFoto($file) {
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
                return $_UP['pasta'] . $nome_final;
            }
        }
        return null; // Retorna null se não houve upload
    }

    $url_imagem = uploadFoto($_FILES['imagem']); // Faz o upload da imagem

    if (!$url_imagem) {
        echo "Erro ao fazer upload da imagem.";
        exit();
    }

    $grava=$conn->prepare('INSERT INTO `usuarios` (`id_usuario`, `nome`, `email`, `senha`, `telefone`,`cpf_cnpj`, `data_cadastro`, `imagem`) VALUES (NULL, :nome, :email, :senha, :tel, :cpf_cnpj, :data_cadastro, :imagem);');
    $grava->bindValue(':nome', $nome);
    $grava->bindValue(':email', $email);
    $grava->bindValue(':senha', $senha_hash); // Use a senha criptografada
    $grava->bindValue(':tel', $tel);
    $grava->bindValue(':cpf_cnpj', $cpf_cnpj);
    $grava->bindValue(':data_cadastro', $datacad);
    $grava->bindValue(':imagem', $url_imagem); // Armazena o caminho da imagem

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
    <style>
        body {
            background-color: rgb(186, 245, 186);
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <a class="logo" href="index.html">
                <img src="./img/logo.png" />
            </a>
            <ul class="nav-list">
                <li><a href="quemsomos.html">Quem Somos</a></li>
                <li><a href="faq.html">Faq</a></li>
                <li><a href="index.html">Página inicial</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="cadastro3d">
            <form class="cad-form" method="POST" enctype="multipart/form-data" class="formcad">
                <h2>Faça seu Cadastro</h2>
                <p>Preencha todas as informações abaixo para realizar seu cadastro:</p>
                <label for="name"></label>
                <input type="text" name="name" id="name" placeholder="Digite seu Nome / Razão Social" class="formstyle" required><br>
                <label for="telefone"></label>
                <input type="text" name="telefone"  placeholder="Digite seu Telefone" class="formstyle" required><br>
                <label for="cpf_cnpj"></label>
                <input type="text" name="cpf_cnpj" id="cpf_cnpj" placeholder="Digite seu CPF ou CNPJ" class="formstyle" required><br>
                <label for="email"></label>
                <input type="text" name="email" id="email" class="formstyle" placeholder="Digite seu email" required>
                <label for="password"></label>
                <input type="password" name="password" id="password" class="formstyle" placeholder="Digite sua Senha" required>
                <p class="senharules">Insira uma foto de perfil:</p>
                <label for="imagem"></label>
                <input type="file" name="imagem" id="imagem" class="formstyle" accept="image/*" required><br>
                <p class="senharules">Para maior segurança digite sua senha de acordo com o formato a seguir</p>
                <p class="senharules">Entre 8 e 20 caracteres. Pelo menos uma letra maiúscula. Pelo menos uma letra minúscula. Pelo menos um número. Pelo menos um caractere especial(!@#$.,%&).</p>
                <input type="submit" name="cadastrar" value="cadastrar" class="botaologin">
                <a href="login.php"><p>Cadastrar-se</p></a>
            </form>
            <div class="cad-link">
                <p>Já possui cadastro? <a href="login.php">Faça login</a></p>
            </div>  
        </div>
    </main>
    
    <footer class="rodape" style="position: absolute; top:1100px">
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
            <div class="caixasrodape">
                <h1>Contato</h1>
                <p>support@shareenough.com</p>
            </div>
        </section>
    </footer>
</body>
</html>
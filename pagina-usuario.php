<?php
session_start(); // Inicia a sessão

// Verifica se a ONG está logada
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
?>

<!DOCTYPE html>
<html lang="pt-br">
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
        <section class="slide-inteiro">
            <div class="bannerdiv">
                <div class="conteudobannerdiv">
                    <h2>
                         Faça parte dessa corrente de solidariedade!
                    </h2>
                     <p>
                         No SHAREENOUGH, acreditamos no poder da colaboração para transformar vidas. 
                        Nossa plataforma conecta pessoas e empresas a ONGs que estão fazendo a diferença em nossa comunidade. Juntos, podemos oferecer apoio a quem mais precisa.</p></br><p>
                        Acesse o link abaixo para conferir os anúncios mais recentes:
                     </p>
                     <a class="btn" href="./anuncios.php">
                       Confira os anúncios
                     </a>
                 
                </div>
            </div>      
        </section> 
        <section>
            <div class="ad">
                <div class="ads-content">
                    <img src="img/campanhadoagasalho.png" alt="campanha do agasalho"></div>
       
               <div class="ads-content">
                    <img src="img/campanhadoalimento.png" alt="campanha do alimento"></div>
               <div class="ads-content">
                    <img src="img/shareenoughlogotipo.png" alt="logotipo do Site">
               </div>
            </div>     
        </section>   

        <section>
            <div class="container">
                <div class="conteudo-inicial" id="conteudo-inicial-user">
                    <h2>O que você pode doar?</h2>
                    <p >Facilidade e Conveniência: Nosso site facilita o processo de doação. 
                        Com apenas alguns cliques, você pode fazer a diferença na vida de alguém.
                        No nosso site, você pode escolher o que deseja doar para ajudar quem mais precisa. Seja roupas de inverno ou alimentos 
                        não perecíveis, sua doação será muito valiosa.</p> 
                    <h2>Como Funciona?</h2>
                    <p><strong>Cadastro:</strong> Primeiro, faça seu cadastro em nosso site. Escolha se está cadastrando como pessoa física ou jurídica e preencha os dados necessários.</p>
                    <p><strong>Escolha o que Doar:</strong> Após o cadastro, você será redirecionado diretamente para nossa página de anúncios, 
                    onde poderá escolher o que deseja doar.</p>
                    <p><strong>Leve as Doações:</strong>  Dirija-se ao ponto de coleta escolhido e entregue suas doações. 
                    Seu gesto fará a diferença na vida de muitas pessoas! Para saber mais acesse a página quem somos ou o nosso faq de dúvidas.</p>  
                    <p><strong></strong></p>


                </div>
            </div>
        </section>
    </main>

    <footer class="rodape">
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
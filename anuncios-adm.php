<!DOCTYPE html>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Anúncios</title>
</head>
<body>
    <header>
        <nav>
            <a class="logo" href="pagina-admin.php">
            <img src="./img/logo.png" />
        </a>
            <ul class="nav-list">
            <li><a href="pagina-admin.php">Página inicial</a></li>
            <li><a class="logout-user" href="logout.php">Sair</a></li>
            </ul>
        </nav>
        </header>
    
        <main>
            <section class="anunciosmain">
                <?php
                    include "lista-anuncios-adm.php"
                ?>
                
                     
                   
            </section>
        </main>

        <footer class="rodape" style="position: absolute; top:2300px;">
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
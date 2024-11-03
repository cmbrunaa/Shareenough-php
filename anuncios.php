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
            <a class="logo" href="pagina-usuario.php">
            <img src="./img/logo.png" />
        </a>
            <ul class="nav-list">

                <li><a href="pagina-usuario.php">Página inicial</a></li>
                <li><a href="perfil-usuario.php"><img src="img/user.png" width="20px" height="20px"/></a></li>
            </ul>
        </nav>
        </header>
    
        <main>
            <section class="anunciosmain">
                <?php
                    include "lista-anuncios.php"
                ?>
                
                     
                   
            </section>
        </main>

       

</body>
</html>
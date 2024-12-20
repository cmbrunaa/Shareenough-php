<?php
    session_start();
if(!isset($_SESSION['login'])){
    header('location:login.php');
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Quem Somos</title>
</head>

<body>
    <header>
        <nav>
            <a class="logo" href="index.html">
                <img src="./img/logo.png" />
            </a>
            <ul class="nav-list">
                <li><a href="index.html">Página Inicial</a></li>
                <li><a href="faq.html">Faq</a></li>
                <li><a href="login.html">Login</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section class="boxprincipal">
            <div class="caixasobre">
                <div class="description">
                    <h1>SOBRE O SITE</h1>
                    <p>Shareenough é uma organização da sociedade civil, dedicada à assistência social beneficente, sem
                        fins lucrativos.
                        Nosso objetivo é promover segurança alimentar e atender às necessidades básicas de membros
                        carentes da comunidade,
                        oferecendo alimentos e vestuário adequados diariamente.</p>

                    <p>Realizamos atividades de coleta, armazenamento e distribuição de alimentos e artigos de vestuário
                        para entidades e
                        organizações que apoiam pessoas e comunidades necessitadas.
                        A Shareenough não apenas combate a desnutrição, mas também promove inclusão social, respeito,
                        dignidade e cidadania para todos.
                        Ao colaborar conosco, você ajuda aqueles que mais necessitam e demonstra responsabilidade social
                        e cidadania, recebendo reconhecimento
                        da comunidade e daqueles que se beneficiam dessa ação.</p>
                    <p>Shareenough é um exemplo de autogestão da sociedade, mostrando que podemos buscar soluções para
                        demandas sociais através da generosidade e solidariedade da população, e com a participação de
                        todos para enfrentar um dos maiores problemas da humanidade: a fome.</p>

                    <!-- <div class="container" style="flex-direction: row; gap: 14px;">
                        <a class="botaologinpagesobre" href="cadastro.html">Cadastre-se</a>
                        <h4>ou</h4>
                        <a class="botaologinpagesobre" href="login.html">Faça Login</a>
                    </div> -->
                </div>
                <div class="banner-item">
                    <img src="./img/about.jpg" />
                </div>
            </div>
            <div class="caixasobre">
                <div class="banner-item">
                    <img src="./img/persons.jpg" />
                </div>
                <div class="description">
                    <h1>HISTÓRIA DA ORGANIZAÇÃO</h1>
                    <p>Shareenough surgiu devido ao trabalho educacional da faculdade, voltado para atender uma demanda
                        da
                        sociedade. Diante dessa realidade,
                        os estudantes Bruna, Emanoelli e Naftali, fundadores do Shareenough, identificaram a fome como
                        um
                        dos mais graves desafios que assolam a humanidade.
                    <p>Nessa percepção, enxergaram uma oportunidade valiosa de promover mudanças significativas na
                        sociedade, o que os motivou a iniciar esta nobre jornada. </p>
                    <p>Impulsionados pelo desejo de fazer a diferença e pela convicção de que cada ação pode ter um
                        impacto
                        positivo, eles uniram esforços e recursos para fundar a Shareenough,
                        transformando ideias em ações concretas para combater a fome e promover o bem-estar social.</p>
                </div>
            </div>
            <div class="caixasobre">
                <div class="description">
                    <h1>COMO FUNCIONA O SISTEMA DE DOAÇÕES</h1>
                    <p>Para contribuir com a sociedade e realizar uma doação, siga estas etapas simples:

                        Acesse nosso site e clique na opção de cadastro/login.
                    <p style="text-indent: 0;">
                    <strong>1.</strong> Complete o cadastro ou faça login, fornecendo os dados pessoais solicitados.
                    <br/>
                    <strong>2.</strong> Após o cadastro ou login, você será direcionado para uma página onde estarão listadas as ONGs parceiras
                        cadastradas em nosso site.
                    <br/>
                    <strong>3.</strong> Explore os perfis das ONGs, clicando em cada uma no menu "ongs" para saber mais sobre suas atividades e necessidades.
                    <br/>
                    <strong>4.</strong> Encontre o anúncio que corresponda ao tipo da sua doação e às necessidades da ONG.
                    <br/>
                    <strong>5.</strong> Selecione o anúncio desejado, <strong>clique em doar e preencha o formulário solicitado.</strong>
                    <br/>
                    <strong>6.</strong> <strong>Salve o QRcode gerado no fim do preenchimento</strong> pois irá ser necessário aprensenta-lo ao chegar ao local para checarem suas informações.
                    <br/>
                    <strong>7.</strong>Antes de entregar sua doação, certifique-se de que ela esteja em bom estado de conservação e
                    devidamente higienizada. A sua doação será entregue com muito carinho a quem mais precisa, fazendo uma diferença positiva
                        na vida daqueles que são beneficiados pela sua generosidade.</p>
                </div>
                <div class="banner-item">
                    <img src="./img/como-funciona.jpg" />
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
            <div class="caixasrodape">
                <h1>Contato</h1>
                <div class="contato-item">
                    <a href="https://mail.google.com/mail/u/0/#inbox" target="_blank"><img src="img/gmail.png"
                            alt="gmail"></a>
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
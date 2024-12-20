<?php
    session_start();
if(!isset($_SESSION['login'])){
    header('location:login-usuario.php');
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>FAQ</title>
</head>

<body>
    <header class="faqheader">
        <nav class="navfaq">
            <a class="logo" href="index.html">
                <img src="./img/logo.png" />
            </a>
            <ul class="nav-list">
                <li><a href="index.html">Página Inicial</a></li>
                <li><a href="quemsomos.html">Quem Somos</a></li>
                <li><a href="login.html">Login</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section class="faqsessaoprincipal">
            <section class="faqsessao1">
                <h1>Alguma dúvida? Procure pela dúvida que atenda às suas necessidades aqui!</h1>
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Você também viabilizam o acesso a outros tipos de ONG?
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Não, por enquanto todas as ONGs cadastradas no Shareenough são relacionadas à doação de alimentos ou de vestuário de inverno.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Qual o limite de quantidade de itens que posso levar para doação?
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Toda ajuda é bem-vinda, não há limite. A única observação é que exigimos que as roupas estejam em bom estado de conservação, assim como os alimentos (esses, na embalagem original sem nenhuma rasura).
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Quais tipos de doação posso fazer?
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Você pode doar agasalhos e alimentos não perecíveis.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                Qual a quantidade mínima de itens que preciso para doar?
                            </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Não há uma quantidade mínima exata, porém pedimos que cada doação esteja em bom estado e completa quando em pares (ex: par de meias).
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFive">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                Qual a importância de colaborar com as ONGs?
                            </button>
                        </h2>
                        <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Colaborar com as ONGs é essencial para apoiar comunidades vulneráveis em diversas áreas, como saúde e educação. Sua contribuição promove mudanças positivas, melhorando a qualidade de vida dos necessitados e fortalecendo o tecido social para um mundo mais justo.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingSix">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                Como cadastrar sua ONG?
                            </button>
                        </h2>
                        <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Se você representa uma ONG e deseja fazer parte de nossa rede de parceiros, entre em contato conosco pelo email shareenough@gmail.com.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingSeven">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                Preciso me comprometer com doações regulares?
                            </button>
                        </h2>
                        <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Não, você pode fazer doações únicas sempre que desejar.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingEight">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                Tenho que pagar algo para fazer a doação?
                            </button>
                        </h2>
                        <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Não! O significado doar vai muito além de atribuir um valor, prezamos pela ação social de ajudar o próximo, assim não será cobrado nenhum valor exceto o seu sorriso.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingNine">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                                A partir de qual idade pode colaborar com as ONGs?
                            </button>
                        </h2>
                        <div id="collapseNine" class="accordion-collapse collapse" aria-labelledby="headingNine" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Para se cadastrar no site, a idade mínima estabelecida é de 18 anos, porém, se você tiver menos, poderá fazer a doação acompanhado(a) dos seus responsáveis. Afinal, não existe idade certa quando o assunto é ajudar o próximo.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTen">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                                Como entro em contato se tiver mais perguntas?
                            </button>
                        </h2>
                        <div id="collapseTen" class="accordion-collapse collapse" aria-labelledby="headingTen" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Se você tiver mais dúvidas ou precisar de mais informações, entre em contato conosco através do nosso formulário de contato ou do e-mail shareenough@gmail.com. Estamos aqui para ajudar!
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </section>
    </main>
    <footer class="rodape">
        <section class="rodapebox" style="position: relative; top:auto;">
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

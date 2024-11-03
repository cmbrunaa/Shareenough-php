<?php
session_start(); // Inicia a sessão

// Verifica se o usuário está logado
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

if (isset($_GET['id_ong'])) {
    $id_ong = $_GET['id_ong']; // Captura o ID da ONG
} else {
    echo "Erro: ID da ONG não está definido.";
    exit();
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Formulário de Doação de Alimentos</title>
</head>
<body>
<section class="doacao-section">
        <div class="doacao-container">
            <h1>Formulário de Doação de Alimentos</h1>
            <form class="doacao-form" action="processa_doacao.php" method="POST" enctype="multipart/form-data">
                        <label for="tipo_alimento">Tipo do Alimento:</label>
                        <select id="tipo_alimento" name="tipo_alimento" class="doacao-input" required>
                            <option value="" disabled selected>Selecione uma opção</option>
                            <option value="arroz">Arroz</option>
                            <option value="feijao">Feijão</option>
                            <option value="macarrao">Macarrão</option>
                            <option value="farinha">Farinha</option>
                            <option value="oleo">Óleo</option>
                            <option value="acucar">Açúcar</option>
                            <option value="sal">Sal</option>
                            <option value="biscoitos">Biscoitos</option>
                            <option value="higiene">Higiene</option>
                            <option value="produtos_limpeza">Produtos de Limpeza</option>
                        </select>

                        <label for="quantidade">Quantidade de Produtos:</label>
                        <input type="number" id="quantidade" name="quantidade_alimentos" class="doacao-input" min="1" required>

                        <label for="condicao">Cesta Básica Completa?</label>
                        <select id="condicao" name="cesta_basica" class="doacao-input" required>
                            <option value="" disabled selected>Selecione uma opção</option>
                            <option value="sim">Sim</option>
                            <option value="nao">Não</option>
                        </select>

                        <label for="peso">Peso:</label>
                        <select id="peso" name="peso" class="doacao-input" required>
                            <option value="" disabled selected>Selecione uma opção</option>
                            <option value="5kg">5kg</option>
                            <option value="10kg+">10kg+</option>
                        </select>

                        <label for="fotos">Fotos dos Produtos:</label>
                        <input type="file" id="fotos" name="fotos" class="doacao-input" accept="image/*" multiple required>

                        <input type="hidden" name="id_ong" value="<?php echo htmlspecialchars($id_ong); ?>">
                        <input type="hidden" name="tipo_doacao" value="alimento"> <!-- Adicione esta linha -->

                        <input type="submit" value="doar" class="doacao-submit">
            </form>

            <a class="doacao-back" href="doaconfirm.php">Voltar</a>
        </div>
    </section>
</body>
</html>

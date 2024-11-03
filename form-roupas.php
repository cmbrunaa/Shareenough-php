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

// Supondo que você tenha a ID da ONG disponível
 // Altere isso conforme sua lógica de obtenção da ID da ONG
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
    <title>Formulário de Doação de Roupas</title>
</head>
<body>
<section class="doacao-section">
        <div class="doacao-container">
            <h1>Formulário de Doação de Roupas de Inverno</h1>
            <form class="doacao-form" action="processa_doacao.php" method="POST" enctype="multipart/form-data">
    <label for="tipo_roupa">Tipo de Roupa:</label>
    <select id="tipo_roupa" name="tipo_roupa" class="doacao-input" required>
        <option value="" disabled selected>Selecione uma opção</option>
        <option value="masculina">Masculina</option>
        <option value="feminina">Feminina</option>
        <option value="unissex">Unissex</option>
    </select>

    <label for="quantidade">Quantidade de Peças:</label>
    <input type="number" id="quantidade" name="quantidade_roupas" class="doacao-input" min="1" required>

    <label for="condicao">Condições das Roupas:</label>
    <select id="condicao" name="condicao" class="doacao-input" required>
        <option value="" disabled selected>Selecione uma opção</option>
        <option value="nova">Novas</option>
        <option value="usada">Usadas (bom estado)</option>
        <option value="usada">Usadas (precisando de ajustes)</option>
    </select>

    <label for="tamanho">Tamanho:</label>
    <select id="tamanho" name="tamanho" class="doacao-input" required>
        <option value="" disabled selected>Selecione uma opção</option>
        <option value="infantil">Infantil (1 ao 14)</option>
        <option value="infantil">Infantil (14 ao 16)</option>
        <option value="adulto">Adulto PP</option>
        <option value="adulto">Adulto P</option>
        <option value="adulto">Adulto M</option>
        <option value="adulto">Adulto G</option>
        <option value="adulto">Adulto GG</option>
        <option value="adulto">Adulto XG</option>
    </select>

    <label for="fotos">Fotos das Roupas:</label>
    <input type="file" id="fotos" name="fotos" class="doacao-input" accept="image/*" multiple required>

    <input type="hidden" name="id_ong" value="<?php echo htmlspecialchars($id_ong); ?>">

    <input type="hidden" name="tipo" value="roupa">
    <input type="hidden" name="tipo_doacao" value="roupa"> <!-- Adicione esta linha -->

    <input type="submit" value="enviar" class="doacao-submit">
</form>

            <a class="doacao-back" href="doaconfirm.php">Voltar</a>
        </div>
    </section>
</body>
</html>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecionando para o Formulário</title>
</head>
<body>
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

// Recupera os dados do formulário
$id_ong = $_POST['id_ong'] ?? null; // Usa POST para pegar o id_ong
$tipo_doacao = $_POST['tipo_doacao'] ?? null; // Usa POST para pegar o tipo_doacao

if (!$id_ong) {
    echo "<p>Erro: ID da ONG não foi fornecido.</p>";
    exit();
}

if ($tipo_doacao == 'roupa') {
    header("Location: form-roupas.php?id_ong=" . urlencode($id_ong));
    exit();
} elseif ($tipo_doacao == 'alimento') {
    header("Location: form-alimento.php?id_ong=" . urlencode($id_ong));
    exit();
} else {
    echo "<p>Tipo de doação inválido. Por favor, escolha uma opção válida.</p>";
}
?>
</body>
</html>

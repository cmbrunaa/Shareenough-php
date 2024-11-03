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
$id_ong = isset($_GET['id_ong']) ? $_GET['id_ong'] : null; // Altere isso conforme sua lógica de obtenção da ID da ONG
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Formulário de Doação</title>
</head>
<body>
    <section class="doacao-section">
        <div class="doacao-container">
            <h1>Formulário de Doação</h1>
            <form class="doacao-form" action="processa_doacao.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id_ong" value="<?php echo htmlspecialchars($id_ong); ?>"> <!-- ID da ONG -->

                <label for="tipo_doacao">Tipo de Doação:</label>
                <select id="tipo_doacao" name="tipo_doacao" class="doacao-input" required onchange="toggleDoacaoFields(this.value)">
                    <option value="" disabled selected>Selecione uma opção</option>
                    <option value="roupa">Roupas</option>
                    <option value="alimento">Alimentos</option>
                </select>

                <!-- Campos de doação de roupas -->
                <div id="roupa_fields" style="display:none;">
                    <label for="tipo_roupa">Tipo de Roupa:</label>
                    <select id="tipo_roupa" name="tipo_roupa" class="doacao-input" required>
                        <option value="" disabled selected>Selecione uma opção</option>
                        <option value="masculina">Masculina</option>
                        <option value="feminina">Feminina</option>
                        <option value="unissex">Unissex</option>
                    </select>

                    <label for="quantidade_roupas">Quantidade de Peças:</label>
                    <input type="number" id="quantidade_roupas" name="quantidade_roupas" class="doacao-input" min="1" required>

                    <label for="condicao">Condições das Roupas:</label>
                    <select id="condicao" name="condicao" class="doacao-input" required>
                        <option value="" disabled selected>Selecione uma opção</option>
                        <option value="nova">Novas</option>
                        <option value="usada_bom_estado">Usadas (bom estado)</option>
                        <option value="usada_precisando_ajustes">Usadas (precisando de ajustes)</option>
                    </select>

                    <label for="tamanho">Tamanho:</label>
                    <select id="tamanho" name="tamanho" class="doacao-input" required>
                        <option value="" disabled selected>Selecione uma opção</option>
                        <option value="PP">PP</option>
                        <option value="P">P</option>
                        <option value="M">M</option>
                        <option value="G">G</option>
                        <option value="GG">GG</option>
                    </select>

                    <label for="fotos_roupas">Fotos:</label>
                    <input type="file" id="fotos_roupas" name="fotos_roupas" accept="image/*" required>
                </div>

                <!-- Campos de doação de alimentos -->
                <div id="alimento_fields" style="display:none;">
                    <label for="tipo_alimento">Tipo de Alimento:</label>
                    <input type="text" id="tipo_alimento" name="tipo_alimento" class="doacao-input" required>

                    <label for="quantidade_alimentos">Quantidade de Alimentos:</label>
                    <input type="number" id="quantidade_alimentos" name="quantidade_alimentos" class="doacao-input" min="1" required>

                    <label for="peso">Peso (kg):</label>
                    <input type="number" id="peso" name="peso" class="doacao-input" min="0" step="0.01" required>

                    <label for="cesta_basica">Cesta Básica?</label>
                    <select id="cesta_basica" name="cesta_basica" class="doacao-input" required>
                        <option value="" disabled selected>Selecione uma opção</option>
                        <option value="sim">Sim</option>
                        <option value="nao">Não</option>
                    </select>

                    <label for="fotos_alimentos">Fotos:</label>
                    <input type="file" id="fotos_alimentos" name="fotos_alimentos" accept="image/*" required>
                </div>

                <input type="submit" value="Doar" class="doacao-submit">
            </form>
            <a class="doacao-back" href="anuncios1.html">Voltar</a>
        </div>
    </section>

    <script>
        function toggleDoacaoFields(tipo) {
            if (tipo === 'roupa') {
                document.getElementById('roupa_fields').style.display = 'block';
                document.getElementById('alimento_fields').style.display = 'none';
            } else if (tipo === 'alimento') {
                document.getElementById('roupa_fields').style.display = 'none';
                document.getElementById('alimento_fields').style.display = 'block';
            } else {
                document.getElementById('roupa_fields').style.display = 'none';
                document.getElementById('alimento_fields').style.display = 'none';
            }
        }
    </script>
</body>
</html>

<?php  
session_start(); // Inicia a sessão

// Verifica se o usuário está logado
if (!isset($_SESSION['email'])) {
    header("Location: login-usuario.php");
    exit();
}

// Recupera os dados da sessão
$email = $_SESSION['email'];
$nome = $_SESSION['nome'];
$data_cadastro = isset($_SESSION['data_cadastro']) ? $_SESSION['data_cadastro'] : 'Data não disponível';
$telefone = isset($_SESSION['telefone']) ? $_SESSION['telefone'] : 'Telefone não disponível';
$id_usuario = $_SESSION['id_usuario']; // ID do usuário

// Verifica se o ID da ONG foi passado pelo formulário
$id_ong = isset($_POST['id_ong']) ? $_POST['id_ong'] : null;

if (is_null($id_ong)) {
    echo "Erro: ID da ONG não está definido.";
    exit(); // Interrompe a execução se o ID da ONG não estiver disponível
}

include "conn.php"; // Inclui a conexão com o banco de dados
date_default_timezone_set('America/Sao_Paulo'); // Define o fuso horário

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipo_doacao = $_POST['tipo_doacao']; // Tipo de doação (roupa ou alimento)
    $data_doacao = date('Y-m-d H:i:s'); // Data atual

    // Configurações para upload de arquivo
    $_UP['pasta'] = "upload/";
    $_UP['tamanho_arquivo'] = 1024 * 1024 * 20; // 20MB
    $_UP['extensao'] = ['jpg', 'png', 'jpeg', 'gif'];
    $_UP['renomear'] = true;

    $url = null; // Inicializa a variável $url

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

    // Processamento para doação de roupa
    if ($tipo_doacao == 'roupa') {
        $tipo_roupa = $_POST['tipo_roupa'];
        $qntd_pecas = $_POST['quantidade_roupas'];
        $condicao = $_POST['condicao'];
        $tamanho = $_POST['tamanho'];

        $url = uploadFoto($_FILES['fotos']); // Faz o upload da foto

        if (!$url) {
            echo "Erro ao fazer upload da foto.";
            exit();
        }

        // Insere a doação no banco de dados
        $grava = $conn->prepare('INSERT INTO `doacoes` (`id_usuario`, `id_ong`, `tipo_doacao`, `tipo_roupa`, `tamanho`, `condicao`, `qntd_pecas`, `fotos`, `data_doacao`) 
            VALUES (:pid_usuario, :pid_ong, :ptipo, :ptipo_roupa, :ptamanho, :pcondicao, :pqntd_pecas, :pfotos, :pdata_doacao);');
        $grava->bindValue(':pid_usuario', $id_usuario);
        $grava->bindValue(':pid_ong', $id_ong); // ID da ONG utilizado aqui
        $grava->bindValue(':ptipo', 'roupa');
        $grava->bindValue(':ptipo_roupa', $tipo_roupa);
        $grava->bindValue(':ptamanho', $tamanho);
        $grava->bindValue(':pcondicao', $condicao);
        $grava->bindValue(':pqntd_pecas', $qntd_pecas);
        $grava->bindValue(':pfotos', $url);
        $grava->bindValue(':pdata_doacao', $data_doacao);

        if ($grava->execute()) {
            header("Location: sucesso.php"); // Página de confirmação
            exit();
        } else {
            echo "Erro ao cadastrar a doação: " . implode(", ", $grava->errorInfo());
        }
    }

    // Processamento para doação de alimento
    elseif ($tipo_doacao == 'alimento') {
        $tipo_alimento = $_POST['tipo_alimento'];
        $qntd_alimentos = $_POST['quantidade_alimentos'];
        $cesta_basica = $_POST['cesta_basica'];
        $peso = $_POST['peso'];

        $url = uploadFoto($_FILES['fotos']); // Faz o upload da foto

        if (!$url) {
            echo "Erro ao fazer upload da foto.";
            exit();
        }

        // Insere a doação no banco de dados
        $grava = $conn->prepare('INSERT INTO `doacoes` (`id_usuario`, `id_ong`, `tipo_doacao`, `tipo_alimento`, `qntd_alimentos`, `cesta_basica`, `peso`, `fotos`, `data_doacao`) 
            VALUES (:pid_usuario, :pid_ong, :ptipo, :ptipo_alimento, :pqntd_alimentos, :pcesta_basica, :ppeso, :pfotos, :pdata_doacao);');
        $grava->bindValue(':pid_usuario', $id_usuario);
        $grava->bindValue(':pid_ong', $id_ong); // ID da ONG utilizado aqui
        $grava->bindValue(':ptipo', 'alimento');
        $grava->bindValue(':ptipo_alimento', $tipo_alimento);
        $grava->bindValue(':pqntd_alimentos', $qntd_alimentos);
        $grava->bindValue(':pcesta_basica', $cesta_basica);
        $grava->bindValue(':ppeso', $peso);
        $grava->bindValue(':pfotos', $url);
        $grava->bindValue(':pdata_doacao', $data_doacao);

        if ($grava->execute()) {
            header("Location: sucesso.php"); // Página de confirmação
            exit();
        } else {
            echo "Erro ao cadastrar a doação: " . implode(", ", $grava->errorInfo());
        }
    }
}
?>

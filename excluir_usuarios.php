<?php
session_start();
include "conn.php";

// Verifica se o administrador está logado
if (!isset($_SESSION['email']) || $_SESSION['tipo_usuario'] !== 'Admin') {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];
$nome = $_SESSION['nome'];

// Função para excluir um usuário ou ONG
if (isset($_GET['excluir']) && isset($_GET['tipo'])) {
    $id = $_GET['id'];
    $tipo = $_GET['tipo']; // Tipo pode ser 'usuario' ou 'ong'
    
    if ($tipo === 'usuario') {
        // Exclui as doações associadas ao usuário antes de excluir o usuário
        $stmt = $conn->prepare('DELETE FROM doacoes WHERE id_usuario = :id');
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        // Exclui o usuário
        $stmt = $conn->prepare('DELETE FROM usuarios WHERE id_usuario = :id');
        $stmt->bindValue(':id', $id);
        $stmt->execute();

    } elseif ($tipo === 'ong') {
        // Exclui as postagens associadas à ONG
        $stmt = $conn->prepare('DELETE FROM postagem_ong WHERE id_ong = :id');
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        // Exclui as doações associadas à ONG
        $stmt = $conn->prepare('DELETE FROM doacoes WHERE id_ong = :id');
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        // Exclui a ONG
        $stmt = $conn->prepare('DELETE FROM ongs WHERE id_ong = :id');
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }

    echo "<script>alert('Registro excluído com sucesso!'); window.location.href='excluir_usuarios.php';</script>";
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administração | ShareEnough</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<header id="header-exc">
    <nav>
        <a class="logo" href="pagina-admin.php">
            <img src="./img/logo.png" alt="Logo" />
        </a>
        <ul class="nav-list">
            <li><a class="logout-user" href="anuncios-adm.php">Excluir Anúncios</a></li>
            <li><a class="logout-user" href="logout.php">Sair</a></li>
        </ul>
    </nav>
</header>

<main>
    <div class="container my-5" id="admexcmain">

        <!-- Lista de Usuários -->
        <h2 class="mt-5">Usuários</h2>
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th></th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Data de Cadastro</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $conn->prepare('SELECT * FROM usuarios');
                $stmt->execute();

                if ($stmt->rowCount() == 0) {
                    echo "<tr><td colspan='6' class='text-center'>Não há usuários cadastrados.</td></tr>";
                } else {
                    while ($user = $stmt->fetch()) {
                        echo "<tr>";
                        echo "<td><img src='{$user['imagem']}' alt='Imagem do Usuário' style='width:50px;height:50px;'></td>";
                        echo "<td>" . htmlspecialchars($user['nome']) . "</td>";
                        echo "<td>" . htmlspecialchars($user['email']) . "</td>";
                        echo "<td>" . htmlspecialchars($user['telefone']) . "</td>";
                        echo "<td>" . htmlspecialchars($user['data_cadastro']) . "</td>";
                        echo "<td>
                                <a href='excluir_usuarios.php?excluir=1&id={$user['id_usuario']}&tipo=usuario' onclick=\"return confirm('Deseja realmente excluir este usuário?');\"><button class='btn-exc-adm'>Excluir</button></a>
                              </td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>

        <!-- Lista de ONGs -->
        <h2 class="mt-5">ONGs</h2>
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th></th>
                    <th>Nome</th>
                    <th>CNPJ</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Data de Cadastro</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $conn->prepare('SELECT * FROM ongs');
                $stmt->execute();

                if ($stmt->rowCount() == 0) {
                    echo "<tr><td colspan='7' class='text-center'>Não há ONGs cadastradas.</td></tr>";
                } else {
                    while ($ong = $stmt->fetch()) {
                        echo "<tr>";
                        echo "<td><img src='{$ong['foto']}' alt='Foto da ONG' style='width:50px;height:50px;'></td>";
                        echo "<td>" . htmlspecialchars($ong['nome']) . "</td>";
                        echo "<td>" . htmlspecialchars($ong['cnpj']) . "</td>";
                        echo "<td>" . htmlspecialchars($ong['email']) . "</td>";
                        echo "<td>" . htmlspecialchars($ong['telefone']) . "</td>";
                        echo "<td>" . htmlspecialchars($ong['data_cadastro']) . "</td>";
                        echo "<td>
                                <a href='excluir_usuarios.php?excluir=1&id={$ong['id_ong']}&tipo=ong' onclick=\"return confirm('Deseja realmente excluir esta ONG?');\"><button class='btn-exc-adm'>Excluir</button></a>
                              </td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</main>
</body>
</html>

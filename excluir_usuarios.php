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
        $stmt = $conn->prepare('DELETE FROM usuarios WHERE id_usuario = :id');
    } elseif ($tipo === 'ong') {
        $stmt = $conn->prepare('DELETE FROM ongs WHERE id_ong = :id');
    }

    $stmt->bindValue(':id', $id);
    $stmt->execute();
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
    <style>
        /* Responsividade para tabelas */
        @media (max-width: 768px) {
            .table-responsive {
                overflow-x: auto;
            }
        }

        /* Ajustes no conteúdo para telas pequenas */
        @media (max-width: 768px) {
            .container {
                padding-left: 15px;
                padding-right: 15px;
            }
            h1, h2 {
                font-size: 1.5rem;
            }
            .table th, .table td {
                font-size: 0.9rem;
            }
        }

    </style>
</head>
<body>
<header>
    <nav>
        <a class="logo" href="pagina-admin.php">
            <img src="./img/logo.png" alt="Logo" />
        </a>
        <ul class="nav-list">
            <li><a href="anuncios-adm.php">Excluir Anúncios</a></li>
            <li><a href="excluir_usuarios.php">Excluir Usuários</a></li>
            <li><a href="logout.php">Sair</a></li>
        </ul>
    </nav>
</header>

<div class="container my-5">
    <h1 class="mb-4">Olá, Admin <?php echo htmlspecialchars($nome); ?>!</h1>
    <p>Bem-vindo(a) à área de administração.</p>

    <!-- Conteúdo da página (tabelas de usuários e ONGs) -->

    <!-- Lista de Usuários -->
    <h2 class="mt-5">Usuários</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
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
                        echo "<td>{$user['id_usuario']}</td>";
                        echo "<td>" . htmlspecialchars($user['nome']) . "</td>";
                        echo "<td>" . htmlspecialchars($user['email']) . "</td>";
                        echo "<td>" . htmlspecialchars($user['telefone']) . "</td>";
                        echo "<td>" . htmlspecialchars($user['data_cadastro']) . "</td>";
                        echo "<td>
                                <a href='excluir_usuarios.php?excluir=1&id={$user['id_usuario']}&tipo=usuario' class='btn btn-danger btn-sm' onclick=\"return confirm('Deseja realmente excluir este usuário?');\">Excluir</a>
                              </td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Lista de ONGs -->
    <h2 class="mt-5">ONGs</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
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
                        echo "<td>{$ong['id_ong']}</td>";
                        echo "<td>" . htmlspecialchars($ong['nome']) . "</td>";
                        echo "<td>" . htmlspecialchars($ong['cnpj']) . "</td>";
                        echo "<td>" . htmlspecialchars($ong['email']) . "</td>";
                        echo "<td>" . htmlspecialchars($ong['telefone']) . "</td>";
                        echo "<td>" . htmlspecialchars($ong['data_cadastro']) . "</td>";
                        echo "<td>
                                <a href='excluir_usuarios.php?excluir=1&id={$ong['id_ong']}&tipo=ong' class='btn btn-danger btn-sm' onclick=\"return confirm('Deseja realmente excluir esta ONG?');\">Excluir</a>
                              </td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


<?php 
try {
    $conn= NEW PDO('mysql:host=localhost;dbname=shareenoughv2', 'root', getenv("MYSQL_PASS"));// host do banco, usuario, senha do banco
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Exibe uma mensagem de erro se a conexão falhar
    echo "Conexão falhou: " . $e->getMessage();
    exit; // Para a execução do script
}
?>
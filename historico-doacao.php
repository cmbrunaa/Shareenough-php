<?php

try {
    $conn = new PDO('mysql:host=localhost;dbname=shareenoughv2', 'root', '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $email = $_SESSION['email'];

    $stmt = $conn->prepare("SELECT Doacoes.tipo_doacao, Doacoes.data_doacao, Doacoes.tipo_roupa, Doacoes.tamanho, 
                                        Doacoes.condicao, Doacoes.qntd_pecas, Doacoes.tipo_alimento, 
                                        Doacoes.qntd_alimentos, Doacoes.cesta_basica, Doacoes.peso, 
                                        Doacoes.fotos 
                             FROM Doacoes 
                             INNER JOIN usuarios ON Doacoes.id_usuario = usuarios.id_usuario 
                             WHERE usuarios.email = :email");
    
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<div class='doacao' style='border: 1px solid #ccc; margin: 10px; padding: 10px;'>";
            echo "<h5>" . htmlspecialchars($row['tipo_doacao']) . ", enviado em " . date('d/m/Y', strtotime($row['data_doacao'])) . "</h5>";
            
            if (!empty($row['tipo_roupa'])) {
                echo "<p>Tipo: " . htmlspecialchars($row['tipo_roupa']) . "</p>";
            }

            if (!empty($row['tamanho'])) {
                echo "<p>Tamanho: " . htmlspecialchars($row['tamanho']) . "</p>";
            }

            if (!empty($row['condicao'])) {
                echo "<p>Condição: " . htmlspecialchars($row['condicao']) . "</p>";
            }

            if ($row['tipo_doacao'] == 'roupa' && !empty($row['qntd_pecas'])) {
                echo "<p>Quantidade de peças: " . htmlspecialchars($row['qntd_pecas']) . "</p>";
            } elseif ($row['tipo_doacao'] == 'alimento') {
                if (!empty($row['qntd_alimentos'])) {
                    echo "<p>Quantidade de alimentos: " . htmlspecialchars($row['qntd_alimentos']) . "</p>";
                }
                if (!empty($row['cesta_basica'])) {
                    echo "<p>Cesta básica: " . htmlspecialchars($row['cesta_basica']) . "</p>";
                }
                if (!empty($row['peso'])) {
                    echo "<p>Peso: " . htmlspecialchars($row['peso']) . "</p>";
                }
            }

            // Verifica e ajusta o caminho da imagem
            $foto_anuncio = strpos($row['fotos'], 'upload/') === 0 
                ? htmlspecialchars($row['fotos']) 
                : 'upload/' . htmlspecialchars($row['fotos']);

            if (file_exists($foto_anuncio)) {
                echo "<img src='$foto_anuncio' alt='Foto da doação' style='max-width: 200px;'>";
            } else {
                echo "<p>Foto não disponível.</p>";
            }

            echo "</div>";
        }
    } else {
        echo "<p>Você ainda não fez nenhuma doação.</p>";
    }
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}

$conn = null;
?>

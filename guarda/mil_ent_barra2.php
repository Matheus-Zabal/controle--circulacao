<?php
include '../conexao.php'; // Conexão com o banco

// Verifica se o método é POST e se o campo foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cod = $_POST['cod'] ?? null;

    if (!$cod) {
        die('Código de barras não recebido ou inválido.');
    }

    // Exibição para depuração do código recebido
    echo "Código recebido: " . htmlspecialchars($cod);

    // Buscando informações do banco para o código
    $consulta = $mysqli->query("SELECT * FROM militares WHERE MIL_CODBAR = '$cod'");
    if (!$consulta) {
        die("Erro na consulta SQL: " . $mysqli->error);
    }

    if ($consulta->num_rows == 0) {
        echo "<script>alert('Código de barras não encontrado no banco de dados!'); window.location.href='index5.php';</script>";
        exit;
    }

    // Dados do militar encontrados no banco
    $row = $consulta->fetch_assoc();
    echo "<h3>Militar encontrado:</h3>";
    echo "Nome: " . $row['MIL_NDG'] . "<br>";
    echo "Posto/Graduação: " . $row['MIL_POSTGRAD'] . "<br>";
    echo "Código de barras: " . $row['MIL_CODBAR'] . "<br>";
}
?>

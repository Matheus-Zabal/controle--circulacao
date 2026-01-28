<?php
include '../conexao.php'; // Conexão com o banco

// Verifica se o formulário foi enviado via método POST e se o campo 'cod' foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cod'])) {
    $cod = $_POST['cod']; // Código enviado pelo scanner no formulário

    if (!$cod) {
        // Se o código não for enviado ou estiver vazio, exibe erro
        echo "<p>Erro: Código de barras não recebido.</p>";
        echo "<p>Volte e passe novamente o código.</p>";
        exit;
    }

    // Depuração: Exibe o código enviado pelo scanner
    echo "<p>Código recebido: " . htmlspecialchars($cod) . "</p>";

    // Realiza consulta ao banco para verificar se o código de barras existe
    $consulta = $mysqli->query("SELECT * FROM militares WHERE MIL_CODBAR = '$cod'");
    if (!$consulta) {
        // Exibe erro caso a consulta ao banco falhe
        die("<p>Erro na consulta ao banco de dados: " . $mysqli->error . "</p>");
    }

    if ($consulta->num_rows === 0) {
        // Caso nenhum resultado seja encontrado, exibe alerta
        echo "<p>Erro: Código de barras não encontrado no banco de dados.</p>";
        echo "<p>Volte e passe novamente o código.</p>";
        exit;
    }

    // Caso o código seja encontrado, exibe os dados do militar
    $militar = $consulta->fetch_assoc();
    echo "<h3>Dados do Militar Encontrado:</h3>";
    echo "<p><strong>Nome:</strong> " . htmlspecialchars($militar['MIL_NDG']) . "</p>";
    echo "<p><strong>Posto/Graduação:</strong> " . htmlspecialchars($militar['MIL_POSTGRAD']) . "</p>";
    echo "<p><strong>Código de Barras:</strong> " . htmlspecialchars($militar['MIL_CODBAR']) . "</p>";
} else {
    // Caso o método não seja POST ou nenhuma variável 'cod' seja enviada
    echo "<p>Erro: Nenhum código de barras foi enviado.</p>";
    echo "<p>Volte e passe o código novamente.</p>";
}
?>

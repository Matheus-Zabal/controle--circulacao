<?php
include '../conexao.php'; // Conexão com o banco
session_start();

// Autenticação: Verifica o perfil do usuário
$sql = $mysqli->query("SELECT * FROM `usuarios` WHERE `USU_LOGIN` = '".$_SESSION['USU_LOGIN']."' AND `USU_SENHA`= '".$_SESSION['USU_SENHA']."' AND `USU_PERFIL` = 'Guarda'"); 
if ($sql->num_rows != 1) {
    session_destroy();
    echo "<script>alert('ALGO ESTÁ ERRADO, O SENHOR NÃO PODE ESTAR NESTA PÁGINA');window.location.href='../index.php';</script>";  
    exit;
}
?>
<html>
<head>
<meta http-equiv="refresh" content="60" /> <!-- Atualização automática da página -->
<title>Circulação de Pessoas</title>
<link rel="stylesheet" href="css/estiloMenu.css">
</head>
<body>
<div id="container">
    <center>
        <h2>ENTRADA E SAÍDA DE MILITARES</h2>
        <h4>PASSE SEU CÓDIGO DE BARRAS NO LEITOR</h4>
        <form method="POST" action="mil_ent_barra1.php" id="formlogin" name="formlogin">
            <input type="text" name="cod" id="cod" autocomplete="off" placeholder="Passe o código"/><br><br>
        </form>
    </center>
</div>

<!-- Script para forçar envio do formulário ao pressionar Enter -->
<script>
document.getElementById('cod').addEventListener('keydown', function (event) {
    if (event.key === 'Enter') {
        document.forms['formlogin'].submit(); // Envia o formulário
    }
});

// Deixar o cursor piscando no campo de entrada
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('cod').focus();
});
</script>
</body>
</html>

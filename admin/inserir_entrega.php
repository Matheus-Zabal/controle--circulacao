<?php
include '../conexao.php';
session_start();

// Verificação de login e perfil
$sql = $mysqli->query("SELECT * FROM `usuarios` WHERE `USU_LOGIN` = '".$_SESSION['USU_LOGIN']."' AND `USU_SENHA`= '".$_SESSION['USU_SENHA']."' AND `USU_PERFIL` = 'Administrador' ");
if ($sql->num_rows != 1) {
    session_destroy();
    echo "<script>alert('ALGO ESTA ERRADO, O SENHOR NO PODE ESTAR NESTA PAGINA'); window.location.href='../index.php';</script>";
    exit;
}

// Recebe os dados do formulário
$entregador = $_POST['ENT_ENTREGADOR'];
$recebedor = $_POST['ENT_RECEBEDOR'];
$descricao = $_POST['ENT_DESCRICAO'];

// Insere no banco de dados
$stmt = $mysqli->prepare("INSERT INTO entregas (ENT_ENTREGADOR, ENT_RECEBEDOR, ENT_DESCRICAO) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $entregador, $recebedor, $descricao);

if ($stmt->execute()) {
    echo "<script>alert('Entrega cadastrada com sucesso!'); window.location.href='cadastro_entrega.php';</script>";
} else {
    echo "<script>alert('Erro ao cadastrar entrega.'); window.history.back();</script>";
}
?>

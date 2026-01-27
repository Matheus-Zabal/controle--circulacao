<?php
include '../conexao.php';
session_start();
$sql = $mysqli->query("SELECT * FROM `usuarios` WHERE `USU_LOGIN` = '".$_SESSION['USU_LOGIN']."' AND `USU_SENHA`= '".$_SESSION['USU_SENHA']."' AND `USU_PERFIL` = 'Convencional' "); 
 if($sql->num_rows != 1)
		{
	session_destroy();
    echo"<script language='javascript' type='text/javascript'>alert('ALGO ESTA ERRADO, O SENHOR NO PODE ESTAR NESTA PAGINA');window.location.href='../index.php';</script>";  
	exit;

//requer a ID que foi mandada do link excluir
$id =$_REQUEST['id'];
$query = "DELETE FROM militares WHERE MIL_CODIGO=".$id;
$dados = $mysqli->query ($query);
 header('Location: todos.php');
?>
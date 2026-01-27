<?php
include '../conexao.php';
	session_start();
$sql = $mysqli->query("SELECT * FROM `usuarios` WHERE `USU_LOGIN` = '".$_SESSION['USU_LOGIN']."' AND `USU_SENHA`= '".$_SESSION['USU_SENHA']."' AND `USU_PERFIL` = 'Administrador' "); 
 if($sql->num_rows != 1)
		{
	session_destroy();
    echo"<script language='javascript' type='text/javascript'>alert('ALGO ESTA ERRADO, O SENHOR NO PODE ESTAR NESTA PAGINA');window.location.href='../index.php';</script>";  
	exit;
	}

$PERM_CODIGO=$_POST['PERM_CODIGO'];
$PERM_SIT=$_POST['PERM_SIT'];


			
		//altera dados do permissionário
			
		$result=$mysqli->query("UPDATE permissionarios SET `PERM_SIT`='$PERM_SIT' WHERE `PERM_CODIGO`='$PERM_CODIGO'");
			echo"<script language='javascript' type='text/javascript'>alert('PERMISSIONÁRIO ALTERADO COM SUCESSO');window.location.href='perm_cad.php';</script>";
	
?>

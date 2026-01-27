<?php
include '../conexao.php'
?>
<?php
	session_start();
	$login = $_POST['USU_LOGIN'];
	$senha =base64_encode($_POST['USU_SENHA']);
	$perfil = $_POST['USU_PERFIL'];
	$usu_codigo = $_POST['USU_CODIGO'];
	
	 $result=$mysqli->query("UPDATE usuarios SET `USU_LOGIN`='$login', `USU_SENHA`='$senha', `USU_PERFIL`='$perfil' WHERE `USU_CODIGO`='$usu_codigo'");
	  	header('Location: usuarios.php');
?>

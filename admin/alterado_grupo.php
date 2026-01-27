<?php
include '../conexao.php'
?>
<?php
	session_start();
	
	$mil_codigo = $_POST['MIL_CODIGO'];
	$mil_sit = $_POST['MIL_SIT'];

	 $result=$mysqli->query("UPDATE militares SET `MIL_SIT`='$mil_sit' WHERE `MIL_CODIGO`='$mil_codigo'");
	  	header('Location: todos.php');
?>

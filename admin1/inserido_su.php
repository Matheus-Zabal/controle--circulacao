<?php
include '../conexao.php'
?>
<?php

$su = $_POST['su'];
	// Insere os dados
			$query = "INSERT INTO su (su)	VALUES ('$su')";
			$mysqli->query($query) or die ($mysqli->error);
			echo"<script language='javascript' type='text/javascript'>alert('SU CADASTRADA COM SUCESSO');window.location.href='insere_su.php';</script>";
 ?>

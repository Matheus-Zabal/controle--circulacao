<?php
include '../conexao.php'
?>
<?php

$USU_PERFIL = $_POST['USU_PERFIL'];
$USU_LOGIN = $_POST['USU_LOGIN'];
$USU_SENHA=base64_encode($_POST['USU_SENHA']);
	// Insere os dados  se der erro inserir no SQL um valor padrao para USU_MIL_CODIGO.. pode ser 0
			$query = "INSERT INTO usuarios (USU_PERFIL, USU_LOGIN, USU_SENHA)
			VALUES ('$USU_PERFIL', '$USU_LOGIN', '$USU_SENHA')";
			$mysqli->query($query) or die ($mysqli->error);
			echo"<script language='javascript' type='text/javascript'>alert('SENHA CADASTRADA COM SUCESSO');window.location.href='usuarios.php';</script>";
 ?>

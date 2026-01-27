<?php
include '../conexao.php';
	session_start();
$sql = $mysqli->query("SELECT * FROM `usuarios` WHERE `USU_LOGIN` = '".$_SESSION['USU_LOGIN']."' AND `USU_SENHA`= '".$_SESSION['USU_SENHA']."' AND `USU_PERFIL` = 'Convencional' "); 
 if($sql->num_rows != 1)
		{
	session_destroy();
    echo"<script language='javascript' type='text/javascript'>alert('ALGO ESTA ERRADO, O SENHOR NO PODE ESTAR NESTA PAGINA');window.location.href='../index.php';</script>";  
	exit;
	}
$VEI_DONO = $_POST['VEI_DONO'];
$VEI_PLACA = $_POST['VEI_PLACA'];
$VEI_MARCA = $_POST['VEI_MARCA'];
$VEI_MODELO = $_POST['VEI_MODELO'];
$VEI_ANO = $_POST['VEI_ANO'];
$VEI_COR = $_POST['VEI_COR'];
$VEI_OBS = $_POST['VEI_OBS'];
$VEI_CODIGO = $_POST['VEI_CODIGO'];
			
			//altera dados do militar
			$result=$mysqli->query("UPDATE veiculos SET `VEI_DONO`='$VEI_DONO', `VEI_PLACA`='$VEI_PLACA', `VEI_MARCA`='$VEI_MARCA', `VEI_MARCA`='$VEI_MARCA', `VEI_MODELO`='$VEI_MODELO', `VEI_ANO`='$VEI_ANO', `VEI_COR`='$VEI_COR', `VEI_OBS`='$VEI_OBS' WHERE `VEI_CODIGO`='$VEI_CODIGO'");
			echo"<script language='javascript' type='text/javascript'>alert('VEICULO ALTERADO COM SUCESSO');window.location.href='vei_cad.php';</script>";

?>

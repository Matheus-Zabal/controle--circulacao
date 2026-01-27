<?php
include '../conexao.php';
	session_start();
$sql = $mysqli->query("SELECT * FROM `usuarios` WHERE `USU_LOGIN` = '".$_SESSION['USU_LOGIN']."' AND `USU_SENHA`= '".$_SESSION['USU_SENHA']."' AND `USU_PERFIL` = 'Guarda' "); 
 if($sql->num_rows != 1)
		{
	session_destroy();
    echo"<script language='javascript' type='text/javascript'>alert('ALGO ESTA ERRADO, O SENHOR NO PODE ESTAR NESTA PAGINA');window.location.href='../index.php';</script>";  
	exit;
	}

$VEI_VIS_CODIGO = $_POST['VIS_CODIGO'];
$VEI_DONO = $_POST['VEI_DONO'];
$VEI_PLACA = $_POST['VEI_PLACA'];
$VEI_MARCA = $_POST['VEI_MARCA'];
$VEI_MODELO = $_POST['VEI_MODELO'];
$VEI_ANO = $_POST['VEI_ANO'];
$VEI_COR = $_POST['VEI_COR'];
$VEI_OBS = $_POST['VEI_OBS'];
$VEI_FOTO = $_POST['VEI_FOTO'];
$VEI_DATACADASTRO=date("Y-m-d");

			//insere dados 
			$query = "INSERT INTO veiculos (VEI_VIS_CODIGO, VEI_DONO, VEI_PLACA, VEI_MARCA, VEI_SIT, VEI_MODELO, VEI_ANO, VEI_COR, VEI_DATACADASTRO, VEI_FOTO, VEI_OBS) 
			          VALUES ('$VEI_VIS_CODIGO', '$VEI_DONO', '$VEI_PLACA', '$VEI_MARCA', '1', '$VEI_MODELO', '$VEI_ANO', '$VEI_COR', '$VEI_DATACADASTRO', '$VEI_FOTO', '$VEI_OBS')";
			$mysqli->query($query) or die ($mysqli->errors);
			echo"<script language='javascript' type='text/javascript'>alert('VEICULO INSERIDO COM SUCESSO');window.location.href='cad_vei.php';</script>";
	
?>


<?php
include '../conexao.php'
?>
<?php
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
			$mysqli->query($query) or die ($mysqli->error);
			echo"<script language='javascript' type='text/javascript'>alert('VEICULO INSERIDO COM SUCESSO');window.location.href='cad_vei.php';</script>";
	
?>


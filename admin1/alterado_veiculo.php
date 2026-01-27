<?php
include '../conexao.php'
?>
<?php
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

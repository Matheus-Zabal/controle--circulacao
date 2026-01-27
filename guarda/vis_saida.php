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
$login= $_SESSION['USU_LOGIN'];

$id =$_REQUEST['cod'];
$vei_codigo=$_REQUEST['cod_vei'];

$sql_entrada = "SELECT * FROM circ_pessoas_prov WHERE CIR_VIS_CODIGO=$id";
$consulta = $mysqli->query($sql_entrada);
while($sql_entrada = mysqli_fetch_array($consulta)){
$cir_codigo = $sql_entrada["CIR_VIS_CODIGO"];
$cir_ent = $sql_entrada["CIR_ENT"];
$cir_reg = $sql_entrada["CIR_REG"];
$cir_destino = $sql_entrada["CIR_DESTINO"];
$cir_resp = $sql_entrada["CIR_RESP"];
$cir_crachacor = $sql_entrada["CIR_CRACHACOR"];
$cir_crachanr = $sql_entrada["CIR_CRACHANR"];
$cir_obs = $sql_entrada["CIR_OBS"];
$cad_entrada=$sql_entrada["CIR_CAD_ENTRADA"];

}
     // MANDA DADOS PARA O BANCO DE ENTRADA E SAIDA DEFINITIVO
		   $query = "INSERT INTO circulacao_pessoas (CIR_VIS_CODIGO, CIR_DESTINO, CIR_RESP, CIR_CRACHANR, CIR_CRACHACOR, CIR_OBS, CIR_ENT, CIR_REG, CIR_SAIDA, CIR_CAD_ENTRADA, CIR_CAD_SAIDA) 
										     VALUES ('$cir_codigo', '$cir_destino', '$cir_resp', '$cir_crachanr', '$cir_crachacor', '$cir_obs', '$cir_ent', '$cir_reg', NOW(),'$cad_entrada', '$login')";
			$mysqli->query($query) or die ($mysqli->error);
			
		
			$mysqli->query("DELETE FROM circ_pessoas_prov WHERE CIR_VIS_CODIGO=$id");
			
			
		if ($vei_codigo>=1){
		
		//INSERE O VEICULO SE TIVER
		$query = "INSERT INTO circulacao_veiculos (CIRV_VEI_CODIGO, CIRV_DESTINO, VEI_MOT, CIRV_OBS, CIRV_ENT, CIRV_REG, CIRV_SAIDA) 
                                  VALUES ('$vei_codigo', '$cir_destino', '$cir_codigo',  '$cir_obs', '$cir_ent', '$cir_reg', NOW())";
		$mysqli->query($query) or die ($mysqli->error);
		
		$mysqli->query("DELETE FROM`circulacao_veiculos_prov` WHERE CIRV_VEI_CODIGO=$vei_codigo");
		
		header("location:index.php");
			
	
}
else {
header("location:index.php");
}

?>

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
$login= $_SESSION['USU_LOGIN'];


$id =$_REQUEST['cod'];
$cod_vei =$_REQUEST['cod_vei'];
$cracha_nr =$_POST['cracha_nr'];
$cracha_cor =$_POST['cracha_cor'];
$acompanhante =$_POST['acompanhante'];
$destino =$_POST['destino'];
$obs =$_POST['obs'];
 echo $cod_vei;

//puxa dos dados do militar do sql
$sql = "SELECT * FROM visitantes WHERE VIS_CODIGO=$id";
$query = $mysqli->query($sql);
	while($sql = mysqli_fetch_array($query)){
	$vis_codigo = $sql["VIS_CODIGO"];
	$vis = $sql["VIS_EMPRESA"];
	}

$sql1 = $mysqli->query("SELECT * FROM veiculos WHERE VEI_CODIGO='$cod_vei'");
	while ($dados1 = mysqli_fetch_array($sql1)) {
    $vei_codigo=$dados1 ['VEI_CODIGO'];
	}	


//INSERE OS DADOS NA LISTA DE VISITANTES NO QUARTEL

$var=("SELECT * FROM circ_pessoas_prov WHERE CIR_VIS_CODIGO=$id");
$v_query = $mysqli->query($var);
if ($v_query->num_rows !=1) {
  // INSERE OS DADOS VALIDA ENTRADA
 $query = "INSERT INTO circ_pessoas_prov ( CIR_VIS_CODIGO, CIR_DESTINO, CIR_RESP, CIR_CRACHANR, CIR_CRACHACOR, CIR_OBS, CIR_ENT, CIR_REG, CIR_CAD_ENTRADA) 
                                  VALUES ('$vis_codigo', '$destino', '$acompanhante', '$cracha_nr', '$cracha_cor', '$obs', NOW(), NOW(), '$login')";
 $mysqli->query($query) or die ($mysqli->error);
 
 //INSERE O VEICULO
 $query = "INSERT INTO circulacao_veiculos_prov (CIRV_VEI_CODIGO, CIRV_DESTINO, VEI_MOT, CIRV_OBS, CIRV_ENT, CIRV_REG) 
                                  VALUES ('$vei_codigo', '$destino', '$vis_codigo',  '$obs', NOW(), NOW())";
  $mysqli->query($query) or die ($mysqli->error);
   header("location:index.php");

	}
	?>

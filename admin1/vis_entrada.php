<?php
include '../conexao.php';
session_start();
$login= $_SESSION['USU_LOGIN'];


$id =$_REQUEST['cod'];
$cracha_nr =$_POST['cracha_nr'];
$cracha_cor =$_POST['cracha_cor'];
$acompanhante =$_POST['acompanhante'];
$destino =$_POST['destino'];
$obs =$_POST['obs'];
?>
<?php


//puxa dos dados do militar do sql
$sql = ("SELECT * FROM visitantes WHERE VIS_CODIGO=$id");
$query = $mysqli->query($sql);
	while($sql = mysqli_fetch_array($query)){
	$vis_codigo = $sql["VIS_CODIGO"];
	$vis = $sql["VIS_EMPRESA"];
	
}

//INSERE OS DADOS NA LISTA DE VISITANTES NO QUARTEL
$var=("SELECT * FROM circ_pessoas_prov WHERE CIR_VIS_CODIGO=$id");
$var_query = $mysqli->query($var);

if ($var_query->num_rows !=1) {
  // INSERE OS DADOS VALIDA ENTRADA
 $query = "INSERT INTO circ_pessoas_prov ( CIR_VIS_CODIGO, CIR_DESTINO, CIR_RESP, CIR_CRACHANR, CIR_CRACHACOR, CIR_OBS, CIR_ENT, CIR_REG, CIR_CAD_ENTRADA) 
                                  VALUES ('$vis_codigo', '$destino', '$acompanhante', '$cracha_nr', '$cracha_cor', '$obs', NOW(), NOW(), '$login')";
 $mysqli->query($query) or die ($mysqli->error);
   header("location:index.php");
	}
	?>

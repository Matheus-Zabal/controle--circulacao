<?php
include '../conexao.php'
?>

<?php
//requer a ID que foi mandada do link ENTRADA
$id =$_POST['cod'];


// verifica se o codigo de barra existe
$sql = $mysqli->query("SELECT * FROM militares WHERE `MIL_CODBAR` = '$id'"); 
 if($sql->num_rows != 1)		{
    echo"<script language='javascript' type='text/javascript'>alert('ESTE CODIGO DE BARRAS NÃO ESTÁ NO SISTEMA - FAVOR ENTRAR EM CONTATO COM O ADMINISTRADOR DO SISTEMA');window.location.href='index1.php';</script>";  
	exit;
	}


//puxa dos dados do militar do sql
$sql = "SELECT * FROM militares WHERE MIL_CODBAR=$id";
$query = $mysqli->query($sql);
	while($sql = mysqli_fetch_array($query)){
	$mil_codigo = $sql["MIL_CODIGO"];
	$mil_bateria = $sql["MIL_BATERIA"];
	
}

$sql_entrada = "SELECT * FROM circ_pessoas_prov WHERE CIR_MIL_CODIGO=$mil_codigo";
$consulta = $mysqli->query($sql_entrada);
while($sql_entrada = mysqli_fetch_array($consulta)){
$cir_codigo = $sql_entrada["CIR_MIL_CODIGO"];
$cir_destino = $sql_entrada["CIR_DESTINO"];
$cir_ent = $sql_entrada["CIR_ENT"];
$cir_reg = $sql_entrada["CIR_REG"];
}



//INSERE OS DADOS NA LISTA DE MILITARES NO QUARTEL
$var="SELECT * FROM circ_pessoas_prov WHERE CIR_MIL_CODIGO=$mil_codigo";
$var_query=$mysqli->query($var);
if ($var_query->num_rows !=1) {
  // INSERE OS DADOS VALIDA ENTRADA
  $query = "INSERT INTO circ_pessoas_prov ( CIR_MIL_CODIGO, CIR_DESTINO, CIR_ENT, CIR_REG) VALUES ('$mil_codigo', '$mil_bateria', NOW(), NOW())";
  $mysqli->query($query) or die ($mysqli->error);
  
   header("location:index1.php");
	}
	
	else {
				
     // MANDA DADOS PARA O BANCO DE ENTRADA E SAIDA DEFINITIVO
		   $query = "INSERT INTO circulacao_pessoas (CIR_MIL_CODIGO, CIR_DESTINO, CIR_ENT, CIR_REG, CIR_SAIDA) 
										     VALUES ('$cir_codigo', '$cir_destino', '$cir_ent', '$cir_reg', NOW())";
			$mysqli->query($query) or die ($mysqli->error);
						
			$mysqli->query("DELETE FROM circ_pessoas_prov WHERE CIR_MIL_CODIGO=$mil_codigo");
			header("location:index1.php");
		
  }
  
  
  
?>
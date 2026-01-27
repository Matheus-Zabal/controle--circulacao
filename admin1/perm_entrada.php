<?php
include '../conexao.php'
?>

<?php
//requer a ID que foi mandada do link ENTRADA
$id =$_REQUEST['cod'];

//puxa dos dados do militar do sql
$sql = "SELECT * FROM permissionarios WHERE PERM_CODIGO=$id";
$query = $mysqli->query($sql);
	while($sql = mysqli_fetch_array($query)){
	$perm_codigo = $sql["PERM_CODIGO"];
	$perm_local = $sql["PERM_LOCAL"];
	
}

$sql_entrada = "SELECT * FROM circ_pessoas_prov WHERE CIR_PERM_CODIGO=$id";
$consulta = $mysqli->query($sql_entrada);
while($sql_entrada = mysqli_fetch_array($consulta)){
$cir_codigo = $sql_entrada["CIR_PERM_CODIGO"];
$cir_destino = $sql_entrada["CIR_DESTINO"];
$cir_ent = $sql_entrada["CIR_ENT"];
$cir_reg = $sql_entrada["CIR_REG"];
}



//INSERE OS DADOS NA LISTA DE MILITARES NO QUARTEL
$var="SELECT * FROM circ_pessoas_prov WHERE CIR_PERM_CODIGO=$id";
$v_query=$mysqli->query($var);

if ($v_query->num_rows !=1) {
  // INSERE OS DADOS VALIDA ENTRADA
 $query = "INSERT INTO circ_pessoas_prov ( CIR_PERM_CODIGO, CIR_DESTINO, CIR_ENT, CIR_REG) VALUES ('$perm_codigo', '$perm_local', NOW(), NOW())";
 $mysqli->query($query) or die ($mysqli->error);
   header("location:index2.php");
	}
	
	else {
				
     // MANDA DADOS PARA O BANCO DE ENTRADA E SAIDA DEFINITIVO
		   $query = "INSERT INTO circulacao_pessoas (CIR_PERM_CODIGO, CIR_DESTINO, CIR_ENT, CIR_REG, CIR_SAIDA) 
										     VALUES ('$cir_codigo', '$cir_destino', '$cir_ent', '$cir_reg', NOW())";
			$mysqli->query($query) or die ($mysqli->error);
						
			$mysqli->query("DELETE FROM circ_pessoas_prov WHERE CIR_PERM_CODIGO=$id");
			header("location:index2.php");
		
  }
  
  
  
?>

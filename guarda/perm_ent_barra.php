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

//requer a ID que foi mandada do link ENTRADA
$id =$_POST['cod'];
//$id = substr("$id1", 1, -1);

// verifica se o codigo de barra existe
$sql = $mysqli->query("SELECT * FROM permissionarios WHERE `PERM_CODBAR` = '$id'"); 
 if($sql->num_rows != 1)		{
    echo"<script language='javascript' type='text/javascript'>alert('ESTE CODIGO DE BARRAS NÃO ESTÁ NO SISTEMA - FAVOR ENTRAR EM CONTATO COM O ADMINISTRADOR DO SISTEMA');window.location.href='index.php';</script>";  
	exit;
	}


//puxa dos dados do permissionario do sql
$sql = "SELECT * FROM permissionarios WHERE PERM_CODBAR=$id";
$query = $mysqli->query($sql);
	while($sql = mysqli_fetch_array($query)){
	$perm_codigo = $sql["PERM_CODIGO"];
	$perm_local = $sql["PERM_LOCAL"];
	
}

$sql_entrada = "SELECT * FROM circ_pessoas_prov WHERE CIR_PERM_CODIGO=$perm_codigo";
$consulta = $mysqli->query($sql_entrada);
while($sql_entrada = mysqli_fetch_array($consulta)){
$cir_codigo = $sql_entrada["CIR_PERM_CODIGO"];
$cir_destino = $sql_entrada["CIR_DESTINO"];
$cir_ent = $sql_entrada["CIR_ENT"];
$cir_reg = $sql_entrada["CIR_REG"];
}



//INSERE OS DADOS NA LISTA DE PERMISSIONARIOS NO QUARTEL

$var="SELECT * FROM circ_pessoas_prov WHERE CIR_PERM_CODIGO=$cir_codigo";
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
						
			$mysqli->query("DELETE FROM circ_pessoas_prov WHERE CIR_PERM_CODIGO=$perm_codigo");
			header("location:index2.php");
		
  }
  
  
  
?>

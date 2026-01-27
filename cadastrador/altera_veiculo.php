<?php
include '../conexao.php'
?>
<?php
	session_start();
	$id =$_REQUEST['cod'];


// A variavel $SQL pega as variaveis $login e $senha, faz uma pesquisa na tabela usuarios
$sql = $mysqli->query("SELECT * FROM `usuarios` WHERE `USU_LOGIN` = '".$_SESSION['USU_LOGIN']."' AND `USU_SENHA`= '".$_SESSION['USU_SENHA']."' AND `USU_PERFIL` = 'Convencional' "); 
 if($sql->num_rows != 1)
		{
	session_destroy();
    echo"<script language='javascript' type='text/javascript'>alert('ALGO ESTA ERRADO, O SENHOR NO PODE ESTAR NESTA PAGINA');window.location.href='../index.php';</script>";  
	exit;
	}
   ?>

<html>
<head>

<title>Circulação de Pessoas</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

</head>
<?php include 'menuexemplo.php' ?> 
<body>
<div id="container" align="center">
<?php
//inicia a consulta dos militares cadastrados
	$consulta = $mysqli->query("SELECT * FROM veiculos WHERE VEI_CODIGO=$id");
	while($row = mysqli_fetch_array($consulta)) {
	$saida=$row['VEI_CODIGO'];
	$placa=$row['VEI_PLACA'];	
	$codigo_visitante=$row['VEI_VIS_CODIGO'];	
	$dono=$row['VEI_DONO'];	
	$marca=$row['VEI_MARCA'];	
	$modelo=$row['VEI_MODELO'];	
	$ano=$row['VEI_ANO'];	
	$cor=$row['VEI_COR'];	
	$renavam=$row['VEI_OBS'];	
	$foto=$row['VEI_FOTO'];
	}
	
		
	$consulta1 = $mysqli->query("SELECT * FROM visitantes WHERE VIS_CODIGO='$codigo_visitante'");
     $row1 = mysqli_fetch_array($consulta1);
	 $cadastrou=$row1['VIS_NOME'];	
?>

 <form method="POST" enctype="multipart/form-data" action="alterado_veiculo.php">

<center><table width="1100" border="1">
  <tr>
    <th colspan="3" bgcolor="#CCCCCC" scope="col">DADOS DO VEICULO</th>
  </tr>
  <tr><?php
   echo "<td width=241 rowspan=8><center><img src='$foto' width=320 height=240/></center></td>"; ?>
    <td width="149" height="36" bgcolor="#CCCCCC">DONO NO DOC:</td>
    <td width="488"><input size="80"  type="text" name="VEI_DONO" value="<?php echo $dono; ?>" /></td>
  </tr>
  <tr>
    <td height="33" bgcolor="#CCCCCC">PLACA:</td>
    <td><input size="80"  type="text" name="VEI_PLACA" value="<?php echo $placa; ?>" /></td>
  </tr>
  <tr>
    <td height="32" bgcolor="#CCCCCC">MARCA:</td>
    <td><input size="80"  type="text" name="VEI_MARCA" value="<?php echo $marca; ?>" /></td>
  </tr>
  <tr>
    <td height="34" bgcolor="#CCCCCC">MODELO:</td>
    <td><input size="80"  type="text" name="VEI_MODELO" value="<?php echo $modelo; ?>" /></td>
  </tr>
  <tr>
    <td height="34" bgcolor="#CCCCCC">ANO:</td>
    <td><input size="80"  type="text" name="VEI_ANO" value="<?php echo $ano; ?>" /></td>
  </tr>
  <tr>
    <td height="30" bgcolor="#CCCCCC">COR:</td>
    <td><input size="80"  type="text" name="VEI_COR" value="<?php echo $cor; ?>" /></td>
  </tr>
  <tr>
    <td height="30" bgcolor="#CCCCCC">RENAVAM:</td>
    <td><input size="80"  type="text" name="VEI_OBS" value="<?php echo $renavam; ?>" /></td>
  </tr>
    <tr>
    <td height="30" bgcolor="#CCCCCC">CADASTROU:</td>
	<td><?php echo $cadastrou; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (foto ao lado)</td>
  </tr>
  <input type="hidden" name="VEI_CODIGO" value="<?php echo $saida; ?>" />
    
  </table></center>
  <p align="center">
	
	<center><button type ="submit" name="enviar" >ALTERAR</button>
	</form>
	</center>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>

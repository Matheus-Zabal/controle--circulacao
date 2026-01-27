<?php
include '../conexao.php'
?>
<?php
	session_start();
	$id =$_REQUEST['cod'];
// A variavel $SQL pega as variaveis $login e $senha, faz uma pesquisa na tabela usuarios
$sql = $mysqli->query("SELECT * FROM `usuarios` WHERE `USU_LOGIN` = '".$_SESSION['USU_LOGIN']."' AND `USU_SENHA`= '".$_SESSION['USU_SENHA']."' AND `USU_PERFIL` = 'Guarda' "); 
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
<div class="alert alert-secondary" align="center">

<form method="POST" action="vei_entrada1.php">
<table>
	<tr>
		<td><input type="text" name="busca" id="cod" size="20" class="form-control" style="height: 40px; width: 400px;" placeholder="PESQUISE PELA PLACA DO VEÍCULO"></td>
		<td><input type="submit" value="PESQUISAR" name="" class="btn btn-primary"></td>
	<tr>
</table>
      </form>
  <script language="javascript">
document.getElementById('cod').focus();
</script>
</div>
<?php
//inicia a consulta dos militares cadastrados
 	 
	$consulta = $mysqli->query("SELECT * FROM veiculos WHERE VEI_CODIGO=$id");
	while($row = mysqli_fetch_array($consulta)) {
	$saida=$row['VEI_CODIGO'];	
	$codigo_visitante=$row['VEI_VIS_CODIGO'];	
	$dono=$row['VEI_DONO'];	
	$placa=$row['VEI_PLACA'];	
	$marca=$row['VEI_MARCA'];	
	$modelo=$row['VEI_MODELO'];	
	$ano=$row['VEI_ANO'];	
	$cor=$row['VEI_COR'];	
	$renavam=$row['VEI_OBS'];	
	$foto=$row['VEI_FOTO'];
	$nome1="altera_veiculo.php?cod=".$row['VEI_CODIGO'];
	$nome2="hist_veiculo.php?cod=".$row['VEI_CODIGO'];
	}
	
	$consulta1 = $mysqli->query("SELECT * FROM visitantes WHERE VIS_CODIGO='$codigo_visitante'");
     $row1 = mysqli_fetch_array($consulta1);
	 $cadastrou=$row1['VIS_NOME'];	
?>
<div class="w-50 p-3">
<center><table class="table table-striped">
  <tr>
    <th colspan="3" scope="col">DADOS DO VEÍCULO</th>
  </tr>
  <tr><?php
   echo "<td width=241 rowspan=8><center><img src='$foto' width=320 height=240/></center></td>"; ?>
    <td>DONO NO DOC:</td>
    <td ><?php echo $dono; ?></td>
  </tr>
  <tr>
    <td>PLACA:</td>
    <td><?php echo $placa; ?></td>
  </tr>
  <tr>
    <td>MARCA:</td>
    <td><?php echo $marca; ?></td>
  </tr>
  <tr>
    <td>MODELO:</td>
    <td><?php echo $modelo; ?></td>
  </tr>
  <tr>
    <td >ANO:</td>
    <td><?php echo $ano; ?></td>
  </tr>
  <tr>
    <td>COR:</td>
    <td><?php echo $cor; ?></td>
  </tr>
  <tr>
    <td>RENAVAM:</td>
    <td><?php echo $renavam; ?></td>
  </tr>
    <tr>
    <td>CADASTROU:</td>
    <td><?php echo $cadastrou; ?></td>
  </tr>
  </table></center>
  <p align="center">
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<input type="button" value=" &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Voltar &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;" onClick="history.back()"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
</p>
</div>
</div>
</body>
</html>

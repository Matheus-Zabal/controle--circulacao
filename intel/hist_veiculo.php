<?php
include '../conexao.php'
?>
<?php
	session_start();
	$id =$_REQUEST['cod'];

// A variavel $SQL pega as variaveis $login e $senha, faz uma pesquisa na tabela usuarios
$sql = $mysqli->query("SELECT * FROM `usuarios` WHERE `USU_LOGIN` = '".$_SESSION['USU_LOGIN']."' AND `USU_SENHA`= '".$_SESSION['USU_SENHA']."' AND `USU_PERFIL` = 'Convencional'"); 
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
	<script>
   function cont(){
   var conteudo = document.getElementById('print').innerHTML;
   tela_impressao = window.open('Despachos');
   tela_impressao.document.write(conteudo);
   tela_impressao.window.print();
   tela_impressao.window.close();
}
</script>
<div id="container">
</head>
<?php include 'menuexemplo.php' ?> 
<body>
<div id="container" align="center">
<div class="alert alert-primary" align="center">
<center> <form method="POST" action="hist_perm2.php">
      Do dia <input type="text" name="data" id="datepicker" placeholder="Data Inicial dd/mm/aaaa" value=""/>
     até <input type="text" name="data1" id="datepicker1" placeholder="Data Final dd/mm/aaaa" value=""/>
     <input type="hidden" name="cod" value="<?php echo $id; ?>"/>
	  <input type="submit" value="FILTRAR HITÓRICO" name="">
      </form> </center>
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


<center><table width="900" border="1">
  <tr>
    <th colspan="3" bgcolor="#CCCCCC" scope="col">DADOS DO VEICULO</th>
  </tr>
  <tr><?php
   echo "<td width=241 rowspan=8><center><img src='$foto' width=320 height=240/></center></td>"; ?>
    <td width="149" height="36" bgcolor="#CCCCCC">DONO NO DOC:</td>
    <td width="488"><?php echo $dono; ?></td>
  </tr>
  <tr>
    <td height="33" bgcolor="#CCCCCC">PLACA:</td>
    <td><?php echo $placa; ?></td>
  </tr>
  <tr>
    <td height="32" bgcolor="#CCCCCC">MARCA:</td>
    <td><?php echo $marca; ?></td>
  </tr>
  <tr>
    <td height="34" bgcolor="#CCCCCC">MODELO:</td>
    <td><?php echo $modelo; ?></td>
  </tr>
  <tr>
    <td height="34" bgcolor="#CCCCCC">ANO:</td>
    <td><?php echo $ano; ?></td>
  </tr>
  <tr>
    <td height="30" bgcolor="#CCCCCC">COR:</td>
    <td><?php echo $cor; ?></td>
  </tr>
  <tr>
    <td height="30" bgcolor="#CCCCCC">RENAVAM:</td>
    <td><?php echo $renavam; ?></td>
  </tr>
    <tr>
    <td height="30" bgcolor="#CCCCCC">CADASTROU:</td>
    <td><?php echo $cadastrou; ?></td>
  </tr>
  </table></center>
  <p align="center">ÚLTIMOS 50 REGISTROS
		   <div id="print" class="conteudo">
		   
   <center><table border=1 width=1085>
     <tr>
	

	<th bgcolor="#CCCCCC" width=25%><center>MOTORISTA</center></th>
	<th bgcolor="#CCCCCC" width=10%><center>DESTINO</center></th>
	<th bgcolor="#CCCCCC" width=10%><center>PLACA</center></th>
	<th bgcolor="#CCCCCC" width=10%><center>ENTRADA</center></th>
	<th bgcolor="#CCCCCC" width=10%><center>SAÍDA</center></th>

	
	</tr>
<?php
	//inicia a consulta dos militares cadastrados
$consulta3 = $mysqli->query("SELECT * FROM circulacao_veiculos WHERE CIRV_VEI_CODIGO=$id ORDER BY `CIRV_ENT` desc LIMIT 50" );
	//faz o loop
	while($row3 = mysqli_fetch_array($consulta3)) {
	//cria uma variavel para registrar entrada
	$saida="vis_saida.php?cod=".$row3 ['CIRV_CODIGO'];	
	$codigo=$row3['VEI_MOT'];
	$data=$row3['CIRV_ENT'];
	$data1=$row3['CIRV_SAIDA'];
	$destino=$row3['CIRV_DESTINO'];
	$convertido= date('d/m/y - H:i:s', strtotime("$data"));
	$convertido1= date('d/m/y - H:i:s', strtotime("$data1"));
	
	 $consulta2 = $mysqli->query("SELECT * FROM visitantes WHERE VIS_CODIGO='$codigo'");
     $row2 = mysqli_fetch_array($consulta2);
     $motorista=$row2['VIS_NOME'];
	 //cria uma variavel para o caminho da foto	
	echo "<tr>";
	echo "<td><center>$motorista</center></td>";
	echo "<td><center>$destino</center></td>";
	echo "<td><center>$placa</center></td>";
	echo "<td><center>$convertido</center></td>";
	echo "<td><center>$convertido1</center></td>";
	echo "</tr>"; 
	}
	echo "</table></center>";
	  echo   "<div>";?>
	<center><input type="button" onClick="cont();" value="IMPRIMIR"></center> 

</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>

<?php
  include '../conexao.php'
?>
<?php
   session_start();

   $pegar_ip = $_SERVER["REMOTE_ADDR"];

    $ip_permitido = "10.26.32.169";
   $ip_permitido3 = "10.26.36.17";
   $ip_permitido1 = "10.26.36.2";
   $ip_permitido2 = "10.26.37.232";
  

    if (($pegar_ip == $ip_permitido) || ($pegar_ip == $ip_permitido1) || ($pegar_ip == $ip_permitido2))
    {


   
$USU_MIL_CODIGO = $_SESSION['USU_MIL_CODIGO'];
$grupo=$_SESSION['USU_GRUPO'];
  $sql = $mysqli->query("SELECT * FROM `usuarios` WHERE `USU_LOGIN` = '".$_SESSION['USU_LOGIN']."' AND `USU_SENHA`= '".$_SESSION['USU_SENHA']."' AND `USU_PERFIL` = 'Guarda' "); 
  if($query= $sql->num_rows != 1)
   {
   session_destroy();
     echo"<script language='javascript' type='text/javascript'>alert('ALGO ESTA ERRADO, O SENHOR NO PODE ESTAR NESTA PAGINA');window.location.href='../index.html';</script>";  
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
<div id="container">
<div class="alert alert-secondary" align="center">
<center><table>
  <tr> <td>
   
<center><h5>NOME DO VISITANTE</h5></center>
      <form method="POST" action="busca.php">
      <center><input type="text" name="busca" id="cod" size="20" style="height: 40px; width: 300px;" class="form-control"></center><br>
      <center><input type="submit" value="PESQUISAR" name="" class="btn btn-primary"></center>
      </form>
<!--deixar o cursor piscando para codigo de barras-->
  <script language="javascript">
document.getElementById('cod').focus();
</script>
</td>
 <td>
 
<center><h5>PLACA DO VEÍCULO</h5></center>
      <form method="POST" action="vei_entrada1.php">
      <center><input type="text" name="busca" id="cod" size="20" style="height: 40px; width: 300px;" class="form-control"></center><br>
      <center><input type="submit" value="PESQUISAR" name="" class="btn btn-primary"></center>
      </form>
</td></tr>
</table>
</center>
</div>

<center><h5>VISITANTES NO INTERIOR DA OM</h5></center>
<center><table class="table table-striped">
  <tr>
	<th><center>FOTO</center></th>
	<th><center>NOME</center></th>
	<th><center>DESTINO/OBS</center></th>
        <th><center>CRACHÁ</center></th>
	<th><center>ACOMPANHANTE</center></th>
	<th><center>PLACA VEÍCULO</center></th>
	<th><center>ENTRADA</center></th>
	<th><center>REGISTRAR SAÍDA</center></th>
	</tr>
<?php
		
$consulta = $mysqli->query('SELECT * FROM circ_pessoas_prov WHERE `CIR_VIS_CODIGO`>="0" ORDER BY `CIR_ENT` DESC');
	//faz o loop
	while($row = mysqli_fetch_array($consulta)) {
	//cria uma variavel para registrar entrada
	$codigo=$row['CIR_VIS_CODIGO'];
	
	$data=$row['CIR_ENT'];
	$convertido= date('d/m/y  H:i:s', strtotime("$data"));
	
	
	$consulta1 = $mysqli->query("SELECT * FROM visitantes WHERE VIS_CODIGO='$codigo'");
     $row1 = mysqli_fetch_array($consulta1);
	 //cria uma variavel para o caminho da foto	
	$foto=$row1['VIS_FOTO'];
	
	
	$consulta2 = $mysqli->query("SELECT * FROM circulacao_veiculos_prov WHERE VEI_MOT='$codigo'");
     $row2 = mysqli_fetch_array($consulta2);
	$motorista=$row2['CIRV_VEI_CODIGO'];

	$consulta3 = $mysqli->query("SELECT * FROM veiculos WHERE VEI_CODIGO='$motorista'");
	$row3 = mysqli_fetch_array($consulta3);
	$placa=$row3['VEI_PLACA'];	
	$vei_codigo=$row3['VEI_CODIGO'];
	$nome_placa="veiculo.php?cod=".$row3['VEI_CODIGO'];
	$saida="vis_saida.php?cod=$codigo&cod_vei=$vei_codigo";		
		$nome="civis.php?cod=".$row1['VIS_CODIGO'];
	echo "<tr>";
	echo "<td><center><img src='$foto' width=160 height=120/></center></td>";
	echo "<td><a href=".$nome."><center>" 	. $row1['VIS_NOME'] . "</a></center></td>";
	echo "<td><center>" 	. $row['CIR_DESTINO'] . "</br>" 	. $row['CIR_OBS'] . "</center></td>";
        echo "<td><center>" 	. $row['CIR_CRACHANR'] . " - " 	. $row['CIR_CRACHACOR'] . "</center></td>";
	echo "<td><center>" 	. $row['CIR_RESP'] . "</center></td>";
	echo "<td><a href=".$nome_placa."><center>" 	. $row3['VEI_PLACA'] . "</a></center></td>";
	echo "<td><center>$convertido</center></td>";
	echo "<td><a href=".$saida."><center><img src='../imagens/icone_saidav.gif' width=48 height=48/></a></center></td>";
	echo "</tr>"; 
	}

	echo "</table></center>";
?>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
<?php 
 } 
 else 
  { 
      echo"<script language='javascript' type='text/javascript'>alert('SEU COMPUTADOR NÃO ESTÁ HABILITADO PARA ESTA OPERAÇÃO');window.location.href='../index.php';</script>";
 }
 ?>

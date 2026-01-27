<?php
include '../conexao.php'
?>
<?php
	session_start();

// A variavel $SQL pega as variaveis $login e $senha, faz uma pesquisa na tabela usuarios
$sql = $mysqli->query("SELECT * FROM `usuarios` WHERE `USU_LOGIN` = '".$_SESSION['USU_LOGIN']."' AND `USU_SENHA`= '".$_SESSION['USU_SENHA']."' AND `USU_PERFIL` = 'Inteligencia' "); 
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
<link rel="stylesheet" href="css/estiloMenu.css">

<div id="container">
</head>
<?php include 'menu.php' ?> 
<body>


<br>
<center><h3>PUBLICO CIVIL DENTRO DO 3º GAC AP</h3></center>
<center><table border=1 width=98%>
  <tr>
	<th bgcolor="#CCCCCC" width=4%><center>FOTO</center></th>
	<th bgcolor="#CCCCCC" width=20%><center>NOME</center></th>
	<th bgcolor="#CCCCCC" width=10%><center>DESTINO/OBS</center></th>
	<th bgcolor="#CCCCCC" width=10%><center>ACOMPANHANTE</center></th>
	<th bgcolor="#CCCCCC" width=10%><center>PLACA VEÍCULO</center></th>
	<th bgcolor="#CCCCCC" width=7%><center>ENTRADA</center></th>

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
	echo "<td><center>" 	. $row['CIR_RESP'] . "</center></td>";
	echo "<td><a href=".$nome_placa."><center>" 	. $row3['VEI_PLACA'] . "</a></center></td>";
	echo "<td><center>$convertido</center></td>";
	echo "</tr>"; 
	}

	echo "</table></center>";
?>
<br>
</body>
 </div>
</html>
	<footer>
      <!-- Duvidas: 3º GAC AP  - Ten Martinuzzi 55 9 9139 1221 -->
    </footer>

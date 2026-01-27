<?php
include '../conexao.php'
?>
<?php
	session_start();
$id =$_REQUEST['cod'];	
$cod_vei =$_REQUEST['cod_vei'];	

// A variavel $SQL pega as variaveis $login e $senha, faz uma pesquisa na tabela usuarios
$sql = $mysqli->query("SELECT * FROM `usuarios` WHERE `USU_LOGIN` = '".$_SESSION['USU_LOGIN']."' AND `USU_SENHA`= '".$_SESSION['USU_SENHA']."' AND `USU_PERFIL` = 'Administrador' "); 
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
<br>
<br>
<center><h3>VEÍCULO SELECIONADO</h3></center>
<center><table border=1 width=98%>

<?php 
$sql = $mysqli->query("SELECT * FROM veiculos WHERE VEI_CODIGO='$cod_vei'");
	while ($dados = mysqli_fetch_array($sql)) {
    $vei_codigo=$dados ['VEI_CODIGO'];
	echo "<tr>";
	echo "<td><center>" 	. $dados['VEI_DONO'] . "</center></td>";
	echo "<td><center>" 	. $dados['VEI_MARCA'] . "</center></td>";
	echo "<td><center>" 	. $dados['VEI_MODELO'] . "</center></td>";
	echo "<td><center>" 	. $dados['VEI_PLACA'] . "</center></td>";
	echo "<td><center>" 	. $dados['VEI_COR'] . "</center></td>";
	echo "<td><center>" 	. $dados['VEI_ANO'] . "</center></td>";

	echo "</tr>"; 
	}	
	echo "</table></center>";
	
?>
<br>
<br>
<br>

<?php
//inicia a consulta dos militares cadastrados
$consulta = $mysqli->query("SELECT * FROM visitantes WHERE VIS_CODIGO=$id");
	//faz o loop
	while($row = mysqli_fetch_array($consulta)) {
	//cria uma variavel para registrar entrada
	$entrada="vis_entrada.php?cod=".$row ['VIS_CODIGO'];	
	//cria uma variavel para o caminho da foto	
	$foto=$row['VIS_FOTO'];
	echo "<center><img src='$foto' width=320 height=240/></center>";
	echo "<center><H2>" 	. $row['VIS_NOME'] . "</H2></center>";
	echo "<h4><center>RG:" 	. $row['VIS_RG'] . ", CPF: " 	. $row['VIS_CPF'] . " </center></h4>";
	echo "<h4><center>EMPRESA: " 	. $row['VIS_EMPRESA'] . "</center></h4>";
	echo "<h4><center>TELEFONE: " 	. $row['VIS_TELCEL'] . "</center></h4>";?>
	<form method="POST" action="vis_entrada1.php" id="formlogin" name="formlogin" >
	<td><center>DESTINO: <input type="text" name="destino" value=""/></center></td><br>
	<td><center>ACOMPANHANTE: <input size="35" type="text" name="acompanhante" value=""/></center></td> <br>
	<td><center>CRACHA NR: <input type="text" name="cracha_nr" value=""/> COR: <input type="text" name="cracha_cor" value=""/></center></td> <br>
	<td><center>OBSERVAÇÃO: <input size="80"type="text" name="obs" value=""/></center></td> <br>
	<td><center><input type="hidden" name="cod" value="<?php echo "$id" ?>;"/></center></td> <br>
	<td><center><input type="hidden" name="cod_vei" value="<?php echo "$cod_vei" ?>;"/></center></td> <br>
	<center><input type="submit" name="INSERIR" value="REGISTRAR ENTRADA DE VEÍCULO E VISITANTE"/></center><br>
	<?php

	
	}
	echo "</table></center>";
?>

</body>
 </div>
</html>

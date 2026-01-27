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

	$busca =$_POST['busca'];
	$cod =$_POST['cod'];


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
<link rel="stylesheet" href="css/estiloMenu.css">

<div id="container">
</head>
<?php include 'menu.php' ?> 
<body>

<center><h3>VEÍCULO SELECIONADO</h3></center>
<center><table border=1 width=98%>

<?php 
$sql = $mysqli->query("SELECT * FROM veiculos WHERE VEI_CODIGO='$cod'");
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

<center><h3>SELECIONE O CONDUTOR PARA INSERIR O VEÍCULO E VISITANTE</h3></center>
<center><table border=1 width=100%>
  <tr>
	<th bgcolor="#CCCCCC" width=8%><center>FOTO</center></th>
	<th bgcolor="#CCCCCC" width=40%><center>NOME</center></th>
	<th bgcolor="#CCCCCC" width=8%><center>IDT/CPF</center></th>
	<th bgcolor="#CCCCCC" width=10%><center>TELEFONE</center></th>
	<th bgcolor="#CCCCCC" width=30%><center>EMPRESA</center></th>
	<th bgcolor="#CCCCCC" width=30%><center>EDITAR</center></th>
	<th bgcolor="#CCCCCC" width=10%><center>SELECIONAR</center></th>
	</tr>
<?php
$sql = $mysqli->query("SELECT * FROM visitantes WHERE VIS_NOME LIKE '%$busca%'");
$count = $sql->num_rows;

// conta quantos registros encontrados com a nossa especificação
if ($count == 0) {
   echo "<center><H2>NENHUM RESULTADO ENCONTRADO!</H2></center>";
} else {
    // senão
    if ($count == 1) {
    echo "1 resultado encontrado!";
}
// se houver um resultado diz que existe um resultado
if ($count > 1) {
    echo "$count resultados encontrados!";
}
// se houver mais de um resultado diz quantos resultados existem
while ($dados = mysqli_fetch_array($sql)) {
	$vis_codigo=$dados['VIS_CODIGO'];
	$saida="vei_entrada4.php?cod=$vis_codigo&cod_vei=$vei_codigo";	

	$foto=$dados['VIS_FOTO'];
	echo "<tr>";
	echo "<td><center><img src='$foto' width=160 height=120/></center></td>";
	echo "<td><center>" 	. $dados['VIS_NOME'] . "</center></td>";
		echo "<td><center>" 	. $dados['VIS_RG'] . "  " 	. $dados['VIS_CPF'] . "</center></td>";
	echo "<td><center>" 	. $dados['VIS_TELCEL'] . "</center></td>";
	echo "<td><center>" 	. $dados['VIS_EMPRESA'] . "</center></td>";
	echo "<td><center>EDITAR</center></td>";
    echo "<td><a href=".$saida."><center><img src='../imagens/seta.jpg' width=48 height=48/></a></center></td>";
	echo "</tr>"; 
	}	
	}
	echo "</table></center>";
	
?>
<br>
</body>
 </div>
</html>

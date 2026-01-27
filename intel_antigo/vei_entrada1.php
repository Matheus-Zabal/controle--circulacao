<?php
include '../conexao.php'
?>
<?php
	session_start();
	$busca =$_POST['busca'];


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
<center><h3>PESQUISE PELA PLACA DO VEÍCULO	</h3></center>
      <form method="POST" action="vei_entrada1.php">
      <center><input type="text" name="busca" id="cod" size="20"></center><br>
    <center>  <input type="submit" value="PESQUISAR" name=""></center>
      </form>
  <script language="javascript">
document.getElementById('cod').focus();
</script>
<br>
<br>

<center><h3>VEICULOS ENCONTRADOS NA PESQUISA</h3></center>
<center><table border=1 width=98%>

<?php 
$sql = $mysqli->query("SELECT * FROM veiculos WHERE VEI_PLACA LIKE '%$busca%'");
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
    // enquanto houverem resultados...
	$entrada="vei_entrada2.php?cod=".$dados ['VEI_CODIGO'];
	$nome="veiculo.php?cod=".$dados['VEI_CODIGO'];
	echo "<tr>";
	echo "<td><center>" 	. $dados['VEI_DONO'] . "</center></td>";
	echo "<td><center>" 	. $dados['VEI_MARCA'] . "</center></td>";
	echo "<td><center>" 	. $dados['VEI_MODELO'] . "</center></td>";
	echo "<td><a href=".$nome."><center>" 	. $dados['VEI_PLACA'] . "</a></center></td>";
	echo "<td><center>" 	. $dados['VEI_COR'] . "</center></td>";
	echo "<td><center>" 	. $dados['VEI_ANO'] . "</center></td>";
	echo "</tr>"; 
	}	
	}
	echo "</table></center>";
	
?>
</body>
 </div>
</html>

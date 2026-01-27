<?php
include '../conexao.php'
?>
<?php
	session_start();
	$codigo =$_GET['cod'];
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
<center><h3>VEÍCULO SELECIONADO</h3></center>
<center><table border=1 width=98%>

<?php 
$sql = $mysqli->query("SELECT * FROM veiculos WHERE VEI_CODIGO='$codigo'");
	while ($dados = mysqli_fetch_array($sql)) {
    // enquanto houverem resultados...
	$entrada="vei_entrada3.php?cod=".$dados ['VEI_CODIGO'];
	echo "<tr>";
	echo "<td><center>" 	. $dados['VEI_DONO'] . "</center></td>";
	echo "<td><center>" 	. $dados['VEI_MARCA'] . "</center></td>";
	echo "<td><center>" 	. $dados['VEI_MODELO'] . "</center></td>";
	echo "<td><center>" 	. $dados['VEI_PLACA'] . "</center></td>";
	echo "<td><center>" 	. $dados['VEI_COR'] . "</center></td>";
	echo "<td><center>" 	. $dados['VEI_ANO'] . "</center></td>";
	echo "<td><center><a href=".$entrada."><center><img src='../imagens/icone_entrada.gif' width=48 height=48/></center></td>";
	echo "</tr>"; 
	}	
	echo "</table></center>";
	
?>
<center><h3>PESQUISE PELO NOME DO VISITANTE CONDUTOR</h3></center>
      <form method="POST" action="vei_entrada3.php">
      <center><input type="text" name="busca" id="cod" size="20"></center><br>
	  <input type="hidden" name="cod" size="20" value="<?php echo $codigo ?>">
    <center>  <input type="submit" value="PESQUISAR" name=""></center>
		 </form>
<!--deixar o cursor piscando para codigo de barras-->
  <script language="javascript">
document.getElementById('cod').focus();
</script>
<br>
<br>
</body>
 </div>
</html>

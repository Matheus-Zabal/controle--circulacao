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

   ?>

<html>
<head>

<title>Circulação de Pessoas</title>
<link rel="stylesheet" href="css/estiloMenu.css">

<div id="container">
</head>
<?php include 'menu.php' ?> 
<body>
<center><h3>PESQUISE PELO NOME DO MILITAR</h3></center>
      <form method="POST" action="busca_mil.php">
      <center><input type="text" name="busca" id="cod" size="20"></center><br>
    <center>  <input type="submit" value="PESQUISAR" name=""></center>
      </form>
  <script language="javascript">
document.getElementById('cod').focus();
</script>
<br>
<br>
<center><h2>MILITARES CADASTRADOS</h2></center>
<center><table border=1 width=80%>
  <tr>
	<th bgcolor="#CCCCCC" width=7%><center>FOTO</center></th>
	<th bgcolor="#CCCCCC" width=5%><center>POSTO/GRAD</center></th>
	<th bgcolor="#CCCCCC" width=40%><center>NOME DE COMPLETO</center></th>
	<th bgcolor="#CCCCCC" width=20%><center>NOME DE GUERRA</center></th>
	<th bgcolor="#CCCCCC" width=10%><center>BATERIA</center></th>
	<th bgcolor="#CCCCCC" width=20%><center>ALTERAR</center></th>
	</tr>
<?php
//inicia a consulta dos militares cadastrados
$consulta = $mysqli->query('SELECT * FROM `militares` WHERE MIL_SIT>="1" ORDER BY `militares`.`MIL_NDG` ASC');
	//faz o loop
	while($row = mysqli_fetch_array($consulta)) {
	//cria uma variavel para registrar entrada
     $saida="mil_alterar.php?cod=".$row['MIL_CODIGO'];
     $nome="militar.php?cod=".$row['MIL_CODIGO'];
		//cria uma variavel para o caminho da foto	
	$foto=$row['MIL_FOTO'];
	echo "<tr>";
	echo "<td><center><img src='$foto' width=60 height=80/></center></td>";
	echo "<td><center>" 	. $row['MIL_POSTGRAD'] . "</center></td>";
	echo "<td><a href=".$nome."><center>" 	. $row['MIL_NOME'] . "</a></center></td>";
	echo "<td><center>" 	. $row['MIL_NDG'] . "</center></td>";
	echo "<td><center>" 	. $row['MIL_BATERIA'] . "</center></td>";
	echo "<td><a href=".$saida."><center>ALTERAR</a></center></td>";
	echo "</tr>"; 
	}
	echo "</table></center>";
?>


</body>
 </div>
</html>

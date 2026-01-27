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

<center><h2>PERMISSIONARIOS DENTRO DO 3º GAC AP</h2></center>
<center><table border=1 width=80%>
  <tr>
	<th bgcolor="#CCCCCC" width=4%><center>FOTO</center></th>
	<th bgcolor="#CCCCCC" width=20%><center>NOME</center></th>
	<th bgcolor="#CCCCCC" width=10%><center>DESTINO</center></th>
	<th bgcolor="#CCCCCC" width=7%><center>ENTRADA</center></th>
	</tr>
<?php
	//inicia a consulta dos militares cadastrados
$consulta = $mysqli->query('SELECT * FROM circ_pessoas_prov WHERE `CIR_PERM_CODIGO`>="0" ORDER BY `CIR_ENT` DESC');
	//faz o loop
	while($row = mysqli_fetch_array($consulta)) {
	//cria uma variavel para registrar entrada
	$saida="perm_entrada.php?cod=".$row ['CIR_PERM_CODIGO'];	
	$codigo=$row['CIR_PERM_CODIGO'];
	$data=$row['CIR_ENT'];
	$convertido= date('d/m/y - H:i:s', strtotime("$data"));
	

	$consulta1 = $mysqli->query("SELECT * FROM permissionarios WHERE PERM_CODIGO='$codigo'");
     $row1 = mysqli_fetch_array($consulta1);
	 //cria uma variavel para o caminho da foto	
	$foto=$row1['PERM_FOTO'];
	$nome="perm.php?cod=".$row1['PERM_CODIGO'];
	echo "<tr>";
	echo "<td><center><img src='$foto' width=120 height=90/></center></td>";
	echo "<td><a href=".$nome." target=_blank><center>" 	. $row1['PERM_NOME'] . "</a></center></td>";
	echo "<td><center>" 	. $row['CIR_DESTINO'] . "</center></td>";
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

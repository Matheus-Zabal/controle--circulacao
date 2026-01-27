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
<body>

<center><h2>PERMISSIONÁRIOS CADASTRADOS</h2></center>
<center><table border=1 width=95%>
  <tr>
	<th bgcolor="#CCCCCC" width=7%><center>FOTO</center></th>
	<th bgcolor="#CCCCCC" width=30%><center>NOME</center></th>
	<th bgcolor="#CCCCCC" width=10%><center>RG</center></th>
	<th bgcolor="#CCCCCC" width=30%><center>LOCAL DE TRABALHO</center></th>
	<th bgcolor="#CCCCCC" width=10%><center>REGISTRAR</center></th>
	</tr>
<?php

//inicia a consulta dos militares cadastrados
$consulta = $mysqli->query('SELECT * FROM permissionarios WHERE PERM_SIT>=1 ORDER BY `PERM_NOME` ASC');
	//faz o loop
	while($row = mysqli_fetch_array($consulta)) {
	//cria uma variavel para registrar entrada
	$nome="perm.php?cod=".$row['PERM_CODIGO'];
	$entrada="perm_entrada.php?cod=".$row ['PERM_CODIGO'];	
	$foto=$row['PERM_FOTO'];
	echo "<tr>";
	echo "<td><center><img src='$foto' width=80 height=60/></center></td>";
	echo "<td><a href=".$nome." target=_blank><center>" 	. $row['PERM_NOME'] . "</a></center></td>";
	echo "<td><center>" 	. $row['PERM_IDT'] . "</center></td>";
	echo "<td><center>" 	. $row['PERM_LOCAL'] . "</center></td>";
	echo "<td><a href=".$entrada."><center><img src='../imagens/icone_entrada.gif' width=48 height=48/></a></center></td>";
	echo "</tr>"; 
	}
	echo "</table></center>";
?>


</body>
 </div>
</html>

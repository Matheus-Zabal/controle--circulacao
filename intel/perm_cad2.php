<?php
include '../conexao.php'
?>
<?php
	session_start();
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
<?php
$datamostra = date('d-m-Y', strtotime("+2 day"));
?>
<h2><center>GERENCIAMENTO DE PERMISSIONARIOS CADASTRADOS</center><h2>

<center><table  width="600" border=1>
		<tr>

 <th bgcolor="#CCCCCC" scope="row">FOTO</th>
 <th bgcolor="#CCCCCC" scope="row">NOME</th>
 <th bgcolor="#CCCCCC" scope="row">LOCAL</th>
 <th bgcolor="#CCCCCC" scope="row">ALTERAR</th>
   </tr>

<?php
$consulta2 = $mysqli->query("SELECT * FROM permissionarios WHERE PERM_SIT=0 ORDER BY `PERM_NOME` ASC");
 while($row2 = mysqli_fetch_array($consulta2)) {
	 $foto=$row2['PERM_FOTO'];
	echo "<tr>";
	$row2['PERM_CODIGO'];
	echo "<td><center><img src='$foto' width=80 height=60/></center></td>";
	echo "<td><center>" . $row2['PERM_NOME'] . "</center></td>";
	echo "<td><center>" . $row2['PERM_LOCAL'] . "</center></td>";
	echo "<td><center><a href=alterando_perm.php?id=" . $row2['PERM_CODIGO'] . " >Alterar</a></center></td>";
	echo	"</tr>";
	}

?>
 
<br>
</body>
</div>
</html>

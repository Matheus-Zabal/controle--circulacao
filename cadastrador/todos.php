<?php
include '../conexao.php';
session_start();

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
<h2><center>GERENCIAMENTO DE MILITARES CADASTRADOS</center><h2>

<center><table  width="600" border=1>
		<tr>
 <th bgcolor="#CCCCCC" scope="row">GRAD</th>
 <th bgcolor="#CCCCCC" scope="row">NOME</th>
 <th bgcolor="#CCCCCC" scope="row">BATERIA</th>
 <th bgcolor="#CCCCCC" scope="row">ALTERAR</th>
 <th bgcolor="#CCCCCC" scope="row">CADASTRAR SENHA</th>
 <th bgcolor="#CCCCCC" scope="row">EXCLUIR</th>
       </tr>

<?php
$consulta2 = $mysqli->query("SELECT * FROM militares WHERE MIL_SIT>=1 ORDER BY `MIL_NDG` ASC");
 while($row2 = mysqli_fetch_array($consulta2)) {
	echo "<tr>";
	$row2['MIL_CODIGO'];
	echo "<td><center>" . $row2['MIL_POSTGRAD'] . "</center></td>";
	echo "<td><center>" . $row2['MIL_NDG'] . "</center></td>";
		echo "<td><center>" . $row2['MIL_BATERIA'] . "</center></td>";
	echo "<td><center><a href=alterando_grupo.php?id=" . $row2['MIL_CODIGO'] . " >Alterar</a></center></td>";
	echo "<td><center><a href=inserir_usuario.php?id=" . $row2['MIL_CODIGO'] . " >Cadastrar Senha</a></center></td>";
	echo "<td><center><a href=excluir_militar.php?id=" . $row2['MIL_CODIGO'] . " >Excluir</a></center></td>";
	echo	"</tr>";
	}

?>
 
<br>
</body>
</div>
</html>

<?php
include '../conexao.php'
?>
<?php
	session_start();
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
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<title>Circulação de Pessoas</title>

</head>
<?php include 'menuexemplo.php' ?> 
<body>
<div id="container">
<?php
$datamostra = date('d-m-Y', strtotime("+2 day"));
?>
<div class="alert alert-info" role="alert">
<h4><center>PERMISSIONARIOS CADASTRADOS (INATIVOS)</center><h4>
</div>
<center>
<div class="w-50 p-3">
<table class="table table-striped">
	<tr>
 		<th><center>FOTO</center></th>
 		<th><center>NOME</center></th>
 		<th><center>LOCAL</center></th>
 		<th><center>ALTERAR</center></th>
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
</div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>

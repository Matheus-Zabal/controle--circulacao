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
<title>Circulação de Pessoas</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

</head>
<?php include 'menuexemplo.php' ?> 
<body>
<?php
$datamostra = date('d-m-Y', strtotime("+2 day"));
?>
<div id="container" align="center">
<div class="alert alert-info" role="alert">
<h4><center>MILITARES CADASTRADOS (INATIVOS)</center><h4>
</div>
<div class="w-50 p-3">
<center>
<table class="table table-striped">
<tr>
 <th><center>P/G</center></th>
 <th><center>NOME</center></th>
 <th><center>BATERIA</center></th>
 <th><center>ALTERAR</center></th>
 <th><center>EXCLUIR</center></th>
</tr>

<?php
$consulta2 = $mysqli->query("SELECT * FROM militares WHERE MIL_SIT=0 ORDER BY `MIL_NDG` ASC");
 while($row2 = mysqli_fetch_array($consulta2)) {
	echo "<tr>";
	$row2['MIL_CODIGO'];
	echo "<td><center>" . $row2['MIL_POSTGRAD'] . "</center></td>";
	echo "<td><center>" . $row2['MIL_NDG'] . "</center></td>";
		echo "<td><center>" . $row2['MIL_BATERIA'] . "</center></td>";
	echo "<td><center><a href=alterando_grupo.php?id=" . $row2['MIL_CODIGO'] . " >Alterar</a></center></td>";
	echo "<td><center><a href=excluir_militar1.php?id=" . $row2['MIL_CODIGO'] . " >Excluir</a></center></td>";
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

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
<div id="container" align="center">
<div class="alert alert-info" role="alert">
<center><h4> CADASTRO DE SUBUNIDADE</h4></center>
</div>
<center>
<form name = "cadastro" method = "post" action="inserido_su.php">
	<table class="table table-striped">
  <tr>
     Digite o nome da nova da Subunidade: <input type="text" name="su" style="height: 30px; width: 400px;"/>
     <input type="submit" value="CADASTRAR" />
     </div>
     </tr>  
    
</table>

</form></center>

<div class="w-50 p-3">

<center><h4>SUBUNIDADES CADASTRADAS</h4></center>
<center><table class="table table-striped">
<tr>
    <th><center>SU</th></center>
    <th><center>EXCLUIR</th></center>
   </tr>
  <?php
$consulta2 = $mysqli->query("SELECT * FROM su ORDER BY `su` ASC");
 while($row2 = mysqli_fetch_array($consulta2)) {
	echo "<td><center>" . $row2['su'] . "</center></td>";
	echo "<td><center><a href=excluir_su.php?id=" . $row2['id'] . " >Excluir</a></center></td>";
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

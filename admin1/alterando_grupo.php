<?php
include '../conexao.php'
?>
<?php
	session_start();
	
$id= $_GET['id'];	
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

<div id="container" align="center">
</head>
<?php include 'menuexemplo.php' ?> 
<body>
<div class="alert alert-info" role="alert">
<h3><center>ALTERAR CAMPOS</center><h3>
<h4><center>Use a opção SITUACÃO caso queira desativar o militar por algum tempo</center><h4>
</div>
<div class="w-50 p-3">
 <form method="POST" action="alterado_grupo.php">

<table class="table">
	<tr>
		<th><center>GRAD</center></th>
		<th><center>NOME</center></th>
		<th><center>NOME COMPLETO</center></th>
		<th><center>BATERIA</center></th>
		<th><center>SITUAÇÃO</center></th>
	</tr>
<?php
$consulta2 = $mysqli->query("SELECT * FROM militares where `MIL_CODIGO` = '$id'");
 while($row2 = mysqli_fetch_array($consulta2)) {
	 $bateria =$row2['MIL_BATERIA'];
	 $mil_sit =$row2['MIL_SIT'];
	 $mil_codigo =$row2['MIL_CODIGO'];
	 $mil_nome =$row2['MIL_NOME'];
	 $mil_postgrad =$row2['MIL_POSTGRAD'];
	 $mil_ndg =$row2['MIL_NDG'];
		 
	 
	echo "<tr>"; ?>
	<tr>
	<td><?php echo $mil_postgrad ?></center></td>
  	<td><center><?php echo $mil_ndg ?></center></td>
	<td><center><?php echo $mil_nome ?></center></td>
	<td><center><?php echo "$bateria"; ?></center></td>
	<td><select name="MIL_SIT"size="1">  <option value="<?php echo "$mil_sit"; ?>"><?php echo "$mil_sit"; ?></option>
	<option  class="greenText" value="0">INATIVO</option>
	<option class="redText" value="1">ATIVO</option></select></td>
	</tr>
	<?PHP
	}
?>
	<input type="hidden"  name="MIL_CODIGO" value="<?php echo "$mil_codigo";?>"/>
	
	</table></center></div>
	
	<center><button type ="submit" name="enviar" class="btn btn-primary btn-lg">ALTERAR</button></center>
	</form>
	</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>	
</body>
</html>

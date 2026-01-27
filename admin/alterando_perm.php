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

</head>
<?php include 'menuexemplo.php' ?> 
<body>
<div id="container" align="center">
<div class="alert alert-info" role="alert">
<h3><center>ALTERAR CAMPOS</center><h3>
<h4><center>Use a opção SITUACÃO caso queira desativar o permissionário</center><h4>
</div>
	<div class="w-50 p-3">
	<form method="POST" action="alterado_perm1.php">
		<center>
		<table class="table table-striped">
			<tr>
   				<th><center>NOME COMPLETO</center></th>
   				<th><center>SITUAÇÃO</center></th>
    			</tr>
<?php
$consulta2 = $mysqli->query("SELECT * FROM permissionarios where `PERM_CODIGO` = '$id'");
 while($row2 = mysqli_fetch_array($consulta2)) {
	 $perm_sit =$row2['PERM_SIT'];
	 $perm_codigo =$row2['PERM_CODIGO'];
	 $perm_nome =$row2['PERM_NOME'];
	 
	 
	echo "<tr>"; ?>
	<tr>
	<td><center><?php echo $perm_nome ?></center></td>
	
	<td><select name="PERM_SIT"size="1">  <option value="<?php echo "$perm_sit"; ?>"><?php echo "$perm_sit"; ?></option>
	<option  class="greenText" value="0">INATIVO</option>
	<option class="redText" value="1">ATIVO</option></select></td>
	</tr>
	<?PHP
	}
?>
	<input type="hidden"  name="PERM_CODIGO" value="<?php echo "$perm_codigo";?>"/>
	</form>
	</div>
	</table></center>
	<center><button type ="submit" name="enviar" class="btn btn-primary btn-lg">ALTERAR</button></center>
	
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>

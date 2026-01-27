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



</head>
<?php include 'menuexemplo.php' ?> 
<body>
<div class="alert alert-info" role="alert">
<h4><center>ALTERAR DADOS DO USUÁRIO</center><h4>
</div>
 <form method="POST" action="alterado_usuario.php">
<center>
<div class="w-50 p-3">
<table class="table table-striped">
		<tr>
   <th>LOGIN</th>
   <th>SENHA</th>
   <th>PERFIL</th>

       </tr>
<?php
$consulta2 = $mysqli->query("SELECT * FROM usuarios where `USU_CODIGO` = '$id'");
 while($row2 = mysqli_fetch_array($consulta2)) {
	 $perfil =$row2['USU_PERFIL'];
	 $login =$row2['USU_LOGIN'];
	 $senha =$row2['USU_SENHA'];
	 $usu_codigo =$row2['USU_CODIGO'];
			 
	 
	echo "<tr>"; ?>
	<tr>
	<td><input type="text" name="USU_LOGIN" size="40" value="<?php echo $login ?>"/a></center></td>
	<td><input type="password" name="USU_SENHA" size="20" value="<?php echo base64_decode($senha) ?>"/a></center></td>
	<td width="30"><div ><select name="USU_PERFIL">
	 <option  value="<?php echo "$perfil"; ?>"><?php echo "$perfil"; ?></option>
	<option value="Convencional">Convencional</option>
	<option value="Administrador">Administrador</option>
	<option value="Inteligencia">Inteligência</option>
	</select></div></td>
	</tr>
	<?PHP
	}
?>
	<input type="hidden"  name="USU_CODIGO" value="<?php echo "$usu_codigo";?>"/>
	</form>
	</table></center>
	<center><button type ="submit" name="enviar" >ALTERAR</button></center>
	
</div></div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>

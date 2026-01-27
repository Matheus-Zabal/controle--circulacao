<?php
include '../conexao.php'
?>
<?php
	session_start();
	
$id = $_GET['id'] ?? null;
	
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
<h3><center>CADASTRAR USUÁRIO NO SISTEMA</center></h3>
</div>
<h4><center>Use o posto ou graduação e o nome de guerra do militar para fazer o login</center></h4>
<form method="POST" action="inserido_usuario.php">
<center>
<div class="w-50 p-3">
<table class="table table-striped">
		<tr>
 <th><center>LOGIN</center></th>
 <th><center>SENHA</center></th>
 <th><center>PERFIL</center></th>
       </tr>
	<td width="30"><div><input size="50"  type="text" name="USU_LOGIN" /></div></td>
	<td width="30"><div><input size="50" type="password" name="USU_SENHA" /></div></td>
	<td width="30"><div><select name="USU_PERFIL">
	<option value="Convencional">Cadastrador</option>
	<option value="Administrador">Administrador</option>
	<option value="Inteligencia">Inteligência</option>
	<option value="Guarda">Guarda</option>
	</select></div></td>
	</tr>
	<input type="hidden"  name="USU_MIL_CODIGO" value="<?php echo "$mil_codigo";?>"/>
	
	</table></center></div>
	<center><button type ="submit" name="enviar" class="btn btn-primary btn-lg">CADASTRAR SENHA</button></center>
	</form>
	</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>

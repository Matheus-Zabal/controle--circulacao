<?php
include '../conexao.php'
?>
<?php
	session_start();
	$id =$_REQUEST['cod'];


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
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<title>Circulação de Pessoas</title>

</head>
<?php include 'menuexemplo.php' ?> 
<body>
<div id="container" align="center">
<?php
//inicia a consulta dos militares cadastrados
	$consulta = $mysqli->query("SELECT * FROM permissionarios WHERE PERM_CODIGO=$id");
	while($row = mysqli_fetch_array($consulta)) {
	$saida=$row['PERM_CODIGO'];		
	$foto=$row['PERM_FOTO'];
	$nome=$row['PERM_NOME'];
	$rg=$row['PERM_IDT'];
	$local=$row['PERM_LOCAL'];
	}
?>
<div class="w-50 p-3">
 <form method="POST" enctype="multipart/form-data" action="alterado_perm.php">
<center>
<table class="table table-striped">
	<tr>
	<th colspan="5" scope="col">DADOS CADASTRADOS DO PERMISSIONÁRIO/FUNCIONÁRIO</th>
	</tr>
	<tr>
	<?php  echo "<td rowspan=3><center><img src='$foto' width=400 height=300/></center>"; ?>
	<input name="arquivo" type="file" /></td>
	<td>NOME</td>
	<td><input size="80"  type="text" name="PERM_NOME" value="<?php echo $nome; ?>" /></td>
	</tr>
	<tr>
	<td>IDENTIDADE</td>
	<td><input size="80"  type="text" name="PERM_IDT" value="<?php echo $rg; ?>" /></td>
	</tr>
	<tr>
	<td>LOCAL</td>
	<td ><input size="80"  type="text" name="PERM_LOCAL" value="<?php echo $local; ?>" /></td>
	</tr>
	<input type="hidden" name="PERM_CODIGO" value="<?php echo $saida; ?>" />
	<input size="80"  type="hidden" name="PERM_FOTO" value="<?php echo $foto; ?>" />
	</table>
	</center>
	<center>
	<button type ="submit" name="enviar" class="btn btn-primary btn-lg">ALTERAR CADASTRO</button>
	</center>
	</form>
	</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>

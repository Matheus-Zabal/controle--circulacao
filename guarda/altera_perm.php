<?php
include '../conexao.php'
?>
<?php
	session_start();
	$id =$_REQUEST['cod'];


// A variavel $SQL pega as variaveis $login e $senha, faz uma pesquisa na tabela usuarios
$sql = $mysqli->query("SELECT * FROM `usuarios` WHERE `USU_LOGIN` = '".$_SESSION['USU_LOGIN']."' AND `USU_SENHA`= '".$_SESSION['USU_SENHA']."' AND `USU_PERFIL` = 'Guarda' "); 

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

<br>
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
 <form method="POST" enctype="multipart/form-data" action="alterado_perm.php">
<center><table width="1085" border="1">
	<tr>
	<th height="38" bgcolor="#CCCCCC" colspan="5" scope="col">DADOS CADASTRADOS DO PERMISSIONÁRIO</th>
	</tr>
	<tr>
	<?php  echo "<td width=241 rowspan=3><center><img src='$foto' width=400 height=300/></center>"; ?>
	<input name="arquivo" type="file" /></td>
	<td bgcolor="#CCCCCC" width="167" height="33">NOME</td>
	<td colspan="3"><input size="80"  type="text" name="PERM_NOME" value="<?php echo $nome; ?>" /></td>
	</tr>
	<tr>
	<td bgcolor="#CCCCCC" height="30">IDENTIDADE</td>
	<td colspan="3"><input size="80"  type="text" name="PERM_IDT" value="<?php echo $rg; ?>" /></td>
	</tr>
	<tr>
	<td bgcolor="#CCCCCC" height="30">LOCAL</td>
	<td colspan="3"><input size="80"  type="text" name="PERM_LOCAL" value="<?php echo $local; ?>" /></td>
	</tr>
	<input type="hidden" name="PERM_CODIGO" value="<?php echo $saida; ?>" />
	<input size="80"  type="hidden" name="PERM_FOTO" value="<?php echo $foto; ?>" />
	</form>
	</table></center>
	<br>
	<center><button type ="submit" name="enviar" >ALTERAR</button></center>
	<br>
</body>
 </div>
</html>
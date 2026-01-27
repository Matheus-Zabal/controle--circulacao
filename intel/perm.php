<?php
include '../conexao.php'
?>
<?php
	session_start();
	$id =$_REQUEST['cod'];
// A variavel $SQL pega as variaveis $login e $senha, faz uma pesquisa na tabela usuarios
$sql = $mysqli->query("SELECT * FROM `usuarios` WHERE `USU_LOGIN` = '".$_SESSION['USU_LOGIN']."' AND `USU_SENHA`= '".$_SESSION['USU_SENHA']."' AND `USU_PERFIL` = 'Inteligencia' "); 
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
	$nome1="altera_perm.php?cod=".$row['PERM_CODIGO'];
	$nome2="hist_perm.php?cod=".$row['PERM_CODIGO'];
		$nome3="cracha_perm.php?cod=".$row['PERM_CODIGO'];
	}
?>
 <div class="w-50 p-3">
<center><table width="1085" class="table table-striped">
  <tr>
    <th height="38" colspan="5" scope="col">DADOS CADASTRADOS DO PERMISSIONÁRIO</th>
  </tr>
  <tr>
    <?php  echo "<td width=241 rowspan=3><center><img src='$foto' width=400 height=300/></center></td>"; ?>
    <td width="167" height="33">NOME</td>
    <td colspan="3"><?php echo $nome; ?></td>
  </tr>
  <tr>
    <td height="30">IDENTIDADE</td>
    <td colspan="3"><?php echo $rg; ?></td>
  </tr>
  
  <tr>
    <td height="30">LOCAL</td>
    <td colspan="3"><?php echo $local; ?></td>
  </tr>
 </table></center>
</div>
  <p align="center">
<?php  


echo " &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<a href=".$nome2."><input type=submit  value='HISTÓRICO DE VISITAS'></a>";
?>

 </p>
<br>
<br>
<br>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>

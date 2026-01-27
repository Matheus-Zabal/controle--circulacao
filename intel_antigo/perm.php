<?php
include '../conexao.php'
?>
<?php
	session_start();
	$id =$_REQUEST['cod'];


// A variavel $SQL pega as variaveis $login e $senha, faz uma pesquisa na tabela usuarios
$sql = $mysqli->query("SELECT * FROM `usuarios` WHERE `USU_LOGIN` = '".$_SESSION['USU_LOGIN']."' AND `USU_SENHA`= '".$_SESSION['USU_SENHA']."' AND `USU_PERFIL` = 'Inteligencia' "); 
/* Logo abaixo temos um bloco com if e else, verificando se a variavel $SQL foi bem sucedida, ou seja se ela estiver encontrado algum registro identico o seu valor sera igual a 1,
 se nao, se nao tiver registros seu valor sera 0. Dependendo do resultado ele redirecionara para a pagina direciona.php
 ou retornara para a pagina do formulario inicial para que se possa tentar novamente realizar o login */
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
	$nome1="altera_perm.php?cod=".$row['PERM_CODIGO'];
	$nome2="hist_perm.php?cod=".$row['PERM_CODIGO'];
		$nome3="cracha_perm.php?cod=".$row['PERM_CODIGO'];
	}
?>
<center><table width="1085" border="1">
  <tr>
    <th height="38" bgcolor="#CCCCCC" colspan="5" scope="col">DADOS CADASTRADOS DO PERMISSIONÁRIO</th>
  </tr>
  <tr>
    <?php  echo "<td bgcolor=black width=241 rowspan=3><center><img src='$foto' width=400 height=300/></center></td>"; ?>
    <td bgcolor="#CCCCCC" width="167" height="33">NOME</td>
    <td colspan="3"><?php echo $nome; ?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC" height="30">IDENTIDADE</td>
    <td colspan="3"><?php echo $rg; ?></td>
  </tr>
  
  <tr>
    <td bgcolor="#CCCCCC" height="30">LOCAL</td>
    <td colspan="3"><?php echo $local; ?></td>
  </tr>
 </table></center>

  <p align="center">
<?php  

echo " &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<a href=".$nome2."><input type=submit  value='VER HISTÓRICO DO PERMISSIONÁRIO'></a>";
?>
 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<input type="button" value=" &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;VOLTAR &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;" onClick="history.back()"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
 </p>
<br>
<br>
<br>

</body>
 </div>
</html>

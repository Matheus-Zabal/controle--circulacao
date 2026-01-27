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
<center><h3>PESQUISE PELO NOME DO MILITAR</h3></center>
      <form method="POST" action="busca_mil.php">
      <center><input type="text" name="busca" id="cod" size="20"></center><br>
    <center>  <input type="submit" value="PESQUISAR" name=""></center>
      </form>
  <script language="javascript">
document.getElementById('cod').focus();
</script>
<br>
<br>
<?php
//inicia a consulta dos militares cadastrados
	$consulta = $mysqli->query("SELECT * FROM militares WHERE MIL_CODIGO=$id");
	while($row = mysqli_fetch_array($consulta)) {
	$saida=$row['MIL_CODIGO'];		
	$foto=$row['MIL_FOTO'];
	$grad=$row['MIL_POSTGRAD'];
	$nome=$row['MIL_NOME'];
	$mil_ndg=$row['MIL_NDG'];
	$bateria=$row['MIL_BATERIA'];
	$idt=$row['MIL_IDT'];
	$sec=$row['MIL_SECAO'];
	$funcao=$row['MIL_FUNC'];
	$nome1="altera_militar.php?cod=".$row['MIL_CODIGO'];
	$nome3="cracha_militar.php?cod=".$row['MIL_CODIGO'];
	$nome2="hist_militar.php?cod=".$row['MIL_CODIGO'];
	}
?>


<center><table width="900" border="1">
  <tr>
    <th colspan="3" bgcolor="#CCCCCC" scope="col">DADOS DO MILITAR</th>
  </tr>
  <tr><?php
   echo "<td width=241 rowspan=7><center><img src='$foto' width=240 height=320/></center></td>"; ?>
    <td width="149" height="36" bgcolor="#CCCCCC">POSTO/GRAD:</td>
    <td width="488"><?php echo $grad; ?></td>
  </tr>
  <tr>
    <td height="33" bgcolor="#CCCCCC">NOME DE GUERRA:</td>
    <td><?php echo $mil_ndg; ?></td>
  </tr>
  <tr>
    <td height="32" bgcolor="#CCCCCC">NOME COMPLETO:</td>
    <td><?php echo $nome; ?></td>
  </tr>
  <tr>
    <td height="34" bgcolor="#CCCCCC">IDENTIDADE:</td>
    <td><?php echo $idt; ?></td>
  </tr>
  <tr>
    <td height="34" bgcolor="#CCCCCC">BATERIA:</td>
    <td><?php echo $bateria; ?></td>
  </tr>
  <tr>
    <td height="30" bgcolor="#CCCCCC">SEÇÃO:</td>
    <td><?php echo $sec; ?></td>
  </tr>
  <tr>
    <td height="30" bgcolor="#CCCCCC">FUNÇÃO:</td>
    <td><?php echo $funcao; ?></td>
  </tr>
  
  </table></center>
  <p align="center">
<?php 



echo " &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<a href=".$nome2."><input type=submit  value='VER HISTÓRICO DO MILITAR'></a>";


?>
 

</p>
<br>
<br>
<br>

</body>
 </div>
</html>

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
<center><h3>PESQUISE PELA PLACA DO VEÍCULO</h3></center>
      <form method="POST" action="vei_entrada1.php">
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
 	 
	$consulta = $mysqli->query("SELECT * FROM veiculos WHERE VEI_CODIGO=$id");
	while($row = mysqli_fetch_array($consulta)) {
	$saida=$row['VEI_CODIGO'];	
	$codigo_visitante=$row['VEI_VIS_CODIGO'];	
	$dono=$row['VEI_DONO'];	
	$placa=$row['VEI_PLACA'];	
	$marca=$row['VEI_MARCA'];	
	$modelo=$row['VEI_MODELO'];	
	$ano=$row['VEI_ANO'];	
	$cor=$row['VEI_COR'];	
	$renavam=$row['VEI_OBS'];	
	$foto=$row['VEI_FOTO'];
	$nome1="altera_veiculo.php?cod=".$row['VEI_CODIGO'];
	$nome2="hist_veiculo.php?cod=".$row['VEI_CODIGO'];
	}
	
	$consulta1 = $mysqli->query("SELECT * FROM visitantes WHERE VIS_CODIGO='$codigo_visitante'");
     $row1 = mysqli_fetch_array($consulta1);
	 $cadastrou=$row1['VIS_NOME'];	
?>


<center><table width="900" border="1">
  <tr>
    <th colspan="3" bgcolor="#CCCCCC" scope="col">DADOS DO VEICULO</th>
  </tr>
  <tr><?php
   echo "<td width=241 rowspan=8><center><img src='$foto' width=320 height=240/></center></td>"; ?>
    <td width="149" height="36" bgcolor="#CCCCCC">DONO NO DOC:</td>
    <td width="488"><?php echo $dono; ?></td>
  </tr>
  <tr>
    <td height="33" bgcolor="#CCCCCC">PLACA:</td>
    <td><?php echo $placa; ?></td>
  </tr>
  <tr>
    <td height="32" bgcolor="#CCCCCC">MARCA:</td>
    <td><?php echo $marca; ?></td>
  </tr>
  <tr>
    <td height="34" bgcolor="#CCCCCC">MODELO:</td>
    <td><?php echo $modelo; ?></td>
  </tr>
  <tr>
    <td height="34" bgcolor="#CCCCCC">ANO:</td>
    <td><?php echo $ano; ?></td>
  </tr>
  <tr>
    <td height="30" bgcolor="#CCCCCC">COR:</td>
    <td><?php echo $cor; ?></td>
  </tr>
  <tr>
    <td height="30" bgcolor="#CCCCCC">RENAVAM:</td>
    <td><?php echo $renavam; ?></td>
  </tr>
    <tr>
    <td height="30" bgcolor="#CCCCCC">CADASTROU:</td>
    <td><?php echo $cadastrou; ?></td>
  </tr>
  </table></center>
  <p align="center">
<?php  

echo " &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<a href=".$nome2."><input type=submit  value='VER HISTÓRICO DO VEÍCULO'></a>";
?>
 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<input type="button" value=" &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Voltar &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;" onClick="history.back()"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
	

</p>
<br>
<br>
<br>

</body>
 </div>
</html>

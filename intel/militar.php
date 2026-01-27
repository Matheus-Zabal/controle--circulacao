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
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<title>Circulação de Pessoas</title>

</head>
<?php include 'menuexemplo.php' ?> 
<body>
<div id="container" align="center">
<div class="alert alert-secondary" align="center">

      <form method="POST" action="busca_mil.php">
      
      <table>
    <tr>
    	<td><input type="text" name="busca" id="cod" size="30" style="width: 400px;" class="form-control" placeholder="PESQUISE POR NOME DE MILITAR"></td>
    	<td><input type="submit" value="PESQUISAR" name="" class="btn btn-primary"></td>
    </tr>
</table>
      </form>
  <script language="javascript">
document.getElementById('cod').focus();
</script>
</div>
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

<div class="w-50 p-3">
<center>
<table class="table table-striped">
  <tr>
    <th colspan="3">DADOS DO MILITAR</th>
  </tr>
  <tr><?php
   echo "<td width=241 rowspan=7><center><img src='$foto' width=240 height=320/></center></td>"; ?>
    <td>POSTO/GRAD:</td>
    <td><?php echo $grad; ?></td>
  </tr>
  <tr>
    <td>NOME DE GUERRA:</td>
    <td><?php echo $mil_ndg; ?></td>
  </tr>
  <tr>
    <td>NOME COMPLETO:</td>
    <td><?php echo $nome; ?></td>
  </tr>
  <tr>
    <td>IDENTIDADE:</td>
    <td><?php echo $idt; ?></td>
  </tr>
  <tr>
    <td>BATERIA:</td>
    <td><?php echo $bateria; ?></td>
  </tr>
  <tr>
    <td>SEÇÃO:</td>
    <td><?php echo $sec; ?></td>
  </tr>
  <tr>
    <td>FUNÇÃO:</td>
    <td><?php echo $funcao; ?></td>
  </tr>
  </table></center></div>
  <p align="center">
<?php  




echo " &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<a href=".$nome2."><input type=submit  value='VER HISTÓRICO DO MILITAR'></a>";


?>
 
</p>
</div>
<div class="alert alert-secondary">
<strong><center>Seção de Informática do 3º GAC AP</strong><br>informatica@3gacap.eb.mil.br</center>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>

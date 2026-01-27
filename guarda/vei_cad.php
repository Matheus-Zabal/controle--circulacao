<?php
include '../conexao.php'
?>
<?php
	session_start();
	
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
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<title>Circulação de Pessoas</title>
</head>
<?php include 'menuexemplo.php' ?> 
<body>
<div id="container" align="center">
<div class="alert alert-secondary" align="center">
<center><label>Pesquise pela placa do veículo:</label></center>
      <form method="POST" action="vei_entrada1.php">
      <center><input type="text" name="busca" id="cod" size="20" style="height: 40px; width: 400px;" class="form-control"></center><br>
      <center><input type="submit" value="PESQUISAR" name="" class="btn btn-primary"></center>
      </form>
<script language="javascript">
document.getElementById('cod').focus();
</script>
</div>
<center><h5>RELAÇÃO DE VEÍCULOS CADASTRADOS</h5></center>
<center>
<table class="table table-striped">
  <tr>
	<th><center>FOTO</center></th>
	<th><center>NOME VISITANTE</center></th>
	<th><center>DONO NO DOC</center></th>
	<th><center>MARCA</center></th>
	<th><center>MODELO</center></th>
	<th><center>PLACA</center></th>
	<th><center>COR</center></th>
	<th><center>ANO</center></th>
	<th><center>REGISTRAR</center></th>
	</tr>
<?php
	//inicia a consulta dos militares cadastrados
	$consulta = $mysqli->query('SELECT * FROM veiculos ORDER BY `VEI_MARCA` ASC');
	//faz o loop
	while($row = mysqli_fetch_array($consulta)) {
	$foto=$row['VEI_FOTO'];	
	$codigo=$row['VEI_VIS_CODIGO'];	
	$consulta1 = $mysqli->query("SELECT * FROM visitantes WHERE VIS_CODIGO='$codigo'");
	$row1 = mysql_fetch_array($consulta1);
	$entrada="vei_entrada2.php?cod=".$row ['VEI_CODIGO'];
	$nome="veiculo.php?cod=".$row['VEI_CODIGO'];
	echo "<tr>";
	echo "<td><center><img src='$foto' width=80 height=60/></center></td>";
	echo "<td><center>" 	. $row1['VIS_NOME'] . "</center></td>";
	echo "<td><center>" 	. $row['VEI_DONO'] . "</center></td>";
	echo "<td><center>" 	. $row['VEI_MARCA'] . "</center></td>";
	echo "<td><center>" 	. $row['VEI_MODELO'] . "</center></td>";
	echo "<td><a href=".$nome."><center>" 	. $row['VEI_PLACA'] . "</a></center></td>";
	echo "<td><center>" 	. $row['VEI_COR'] . "</center></td>";
	echo "<td><center>" 	. $row['VEI_ANO'] . "</center></td>";
	echo "<td><center><a href=".$entrada."><center><img src='../imagens/icone_entrada.gif' width=48 height=48/></center></td>";
	echo "</tr>"; 
	}
	echo "</table></center>";
?>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>

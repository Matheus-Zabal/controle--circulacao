<?php
include '../conexao.php'
?>
<?php
	session_start();

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

<title>Circulação de Pessoas</title>
<!-- <link rel="stylesheet" href="css/estiloMenu.css"> -->
<meta http-equiv="refresh" content="30">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<div id="container">
</head>
<?php include 'menuexemplo.php' ?> 
<body>
<div class="alert alert-secondary" align="center">
<center>
	<h5>LISTANDO MILITARES QUE ESTÃO NA OM</h5>
</center>

</div> 
<!--deixar o cursor piscando para codigo de barras-->
	<script language="javascript">
		document.getElementById('cod').focus();
	</script>

<center>
<table class="table table-striped">
  		<tr>
			<th><center>FOTO</center></th>
			<th><center>POSTO/GRAD</center></th>
			<th><center>NOME DE GUERRA</center></th>
			<th><center>BATERIA</center></th>
			<th><center>ENTRADA</center></th>
			
		</tr>
	</thead>
<?php
	//inicia a consulta dos militares cadastrados
	$consulta = $mysqli->query('SELECT * FROM circ_pessoas_prov WHERE `CIR_MIL_CODIGO`>="0" ORDER BY `CIR_REG` ASC');
	//faz o loop
	while($row = mysqli_fetch_array($consulta)) {
	//cria uma variavel para registrar entrada
	$saida="mil_entrada.php?cod=".$row ['CIR_MIL_CODIGO'];	
	$codigo=$row['CIR_MIL_CODIGO'];
	$data=$row['CIR_ENT'];
	$convertido= date('d/m/y - H:i:s', strtotime("$data"));
	
	$consulta1 = $mysqli->query("SELECT * FROM militares WHERE MIL_CODIGO='$codigo'");
     	$row1 = mysqli_fetch_array($consulta1);
	 //cria uma variavel para o caminho da foto	
	$foto=$row1['MIL_FOTO'];
	$nome="militar.php?cod=".$row1['MIL_CODIGO'];
	echo "<tr>";
	echo "<td><center><img src='$foto' width=48 height=64 class=img-thumbnail/></center></td>";
	echo "<td><center>" 	. $row1['MIL_POSTGRAD'] . "</center></td>";
	echo "<td ><a href=".$nome."><center>" 	. $row1['MIL_NDG'] . "</a></center></td>";
	echo "<td><center>" 	. $row['CIR_DESTINO'] . "</center></td>";
	echo "<td><center>$convertido</center></td>";
	
	echo "</tr>"; 
	}
	echo "</table></center>";
?>
<br>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
 </div>
</html>
</html>

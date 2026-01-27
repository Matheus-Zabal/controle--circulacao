<?php
include '../conexao.php'
?>
<?php
	session_start();

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

<title>Circulação de Pessoas</title>
<!-- <link rel="stylesheet" href="css/estiloMenu.css"> -->
<meta http-equiv="refresh" content="30">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

</head>
<?php include 'menuexemplo.php' ?> 
<body>

<center>
<div class="alert alert-secondary" align="center">
<center><h5>PREENCHA UM DOS CRITÉRIOS DE PESQUISA ABAIXO E CLIQUE EM PESQUISAR</h5></center>

<table>
  <tr> <td>

    <form method="POST" action="busca.php">
    <center><input type="text" name="busca" id="cod" size="20" style="height: 40px; width: 300px;" placeholder="POR NOME DO VISITANTE"></center><br>
    <center><input type="submit" value="PESQUISAR" name="" class="btn btn-primary"></center>
    </form>

<!--deixar o cursor piscando para codigo de barras-->
<script language="javascript">
document.getElementById('cod').focus();
</script>
</td>
<td>
      <form method="POST" action="vei_entrada1.php">
      <center><input type="text" name="busca" id="cod" size="20" style="height: 40px; width: 300px;" placeholder="POR PLACA DO VEÍCULO"></center><br>
      <center><input type="submit" value="PESQUISAR" name="" class="btn btn-primary"></center>
      </form>
</td></tr>
</table>
</center>
</div>

<center><h5>PÚBLICO CIVIL DENTRO DO 6° Esqd C Mec</h5></center>

<table class="table table-striped">
  		<tr>
			<th><center>FOTO</center></th>
			<th><center>NOME</center></th>
			<th><center>DESTINO</center></th>
			<th><center>ACOMPANHANTE</center></th>
			<th><center>PLACA VEÍCULO</center></th>
			<th><center>ENTRADA</center></th>
			<th><center>REGISTRAR SAÍDA</center></th>
		</tr>
<?php
		
        $consulta = $mysqli->query('SELECT * FROM circ_pessoas_prov WHERE `CIR_VIS_CODIGO`>="0" ORDER BY `CIR_ENT` DESC');
	
//faz o loop
	while($row = mysqli_fetch_array($consulta)) {
//cria uma variavel para registrar entrada
	$codigo=$row['CIR_VIS_CODIGO'];
	
	$data=$row['CIR_ENT'];
	$convertido= date('d/m/y  H:i:s', strtotime("$data"));
	
	$consulta1 = $mysqli->query("SELECT * FROM visitantes WHERE VIS_CODIGO='$codigo'");
        $row1 = mysqli_fetch_array($consulta1);
	
	//cria uma variavel para o caminho da foto	
	$foto=$row1['VIS_FOTO'];
	
	$consulta2 = $mysqli->query("SELECT * FROM circulacao_veiculos_prov WHERE VEI_MOT='$codigo'");
        $row2 = mysqli_fetch_array($consulta2);
	$motorista=$row2['CIRV_VEI_CODIGO'];

	$consulta3 = $mysqli->query("SELECT * FROM veiculos WHERE VEI_CODIGO='$motorista'");
	$row3 = mysqli_fetch_array($consulta3);
	$placa=$row3['VEI_PLACA'];	
	$vei_codigo=$row3['VEI_CODIGO'];
	$nome_placa="veiculo.php?cod=".$row3['VEI_CODIGO'];
	$saida="vis_saida.php?cod=$codigo&cod_vei=$vei_codigo";		
        $nome="civis.php?cod=".$row1['VIS_CODIGO'];
	echo "<tr>";
	echo "<td><center><img src='$foto' width=48 height=36/></center></td>";
	echo "<td><a href=".$nome."><center>" 	. $row1['VIS_NOME'] . "</a></center></td>";
	echo "<td><center>" 	. $row['CIR_DESTINO'] . "</center></td>";
	echo "<td><center>" 	. $row['CIR_RESP'] . "</center></td>";
	echo "<td><a href=".$nome_placa."><center>" 	. $row3['VEI_PLACA'] . "</a></center></td>";
	echo "<td><center>$convertido</center></td>";
	echo "<td><a href=".$saida."><center><img src='../imagens/icone_saidav.gif' width=48 height=48/></a></center></td>";
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

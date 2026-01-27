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
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<title>Circulação de Pessoas</title>
</head>
<?php include 'menuexemplo.php' ?> 
<body>

<div id="container" align="center">
<div class="alert alert-secondary" align="center">

      <form method="POST" action="busca_mil.php">
      <center>
      <table>
      <tr>
      	<td>
      	 <input type="text" name="busca" id="cod" class="form-control" style="width: 300px;" placeholder="Pesquise pelo nome do militar">
      	</td>
      	<td>
      <input type="submit" value="PESQUISAR" name="" class="btn btn-primary"></center>
      	</td>
      </tr>
      </table>
      </form>
      
  <script language="javascript">
document.getElementById('cod').focus();
</script>
</div>
<center><h5>RELAÇÃO DE MILITARES CADASTRADOS</h5></center>
<img alt="" src="../imagens1/legenda.png" style="float:right; height:33px; width:270px" />
<center><table class="table table-striped">
  <tr>
	<th><center>FOTO</center></th>
	<th><center>POSTO/GRAD</center></th>
	<th><center>NOME DE COMPLETO</center></th>
	<th><center>NOME DE GUERRA</center></th>
	<th><center>BATERIA</center></th>
	<th><center>REGISTRAR</center></th>
	</tr>
<?php
//inicia a consulta dos militares cadastrados
$consulta = $mysqli->query('SELECT * FROM `militares` WHERE MIL_SIT>="1" ORDER BY `militares`.`END_COD` ASC');
	//faz o loop
	while($row = mysqli_fetch_array($consulta)) {
	//cria uma variavel para registrar entrada
	$id = $row['MIL_CODIGO'];
	$saida="mil_entrada2.php?cod=".$row['MIL_CODIGO'];
	$nome="militar.php?cod=".$row['MIL_CODIGO'];
		//cria uma variavel para o caminho da foto	
	$foto=$row['MIL_FOTO'];
	echo "<tr>";
	echo "<td><center><img src='$foto' width=36 height=48/></center></td>";
	echo "<td><center>" 	. $row['MIL_POSTGRAD'] . "</center></td>";
	echo "<td><p href=".$nome."><center>" 	. $row['MIL_NOME'] . "</p></center></td>";
	echo "<td><center>" 	. $row['MIL_NDG'] . "</center></td>";
	echo "<td><center>" 	. $row['MIL_BATERIA'] . "</center></td>";


	//INSERE OS DADOS NA LISTA DE MILITARES NO QUARTEL
	$var=("SELECT * FROM circ_pessoas_prov WHERE CIR_MIL_CODIGO=$id");
	$var_query = $mysqli->query($var);
	if ($var_query->num_rows !=1) {
	echo "<td><a href=".$saida."><center><img src='../imagens/icone_entrada.gif' width=48 height=48/></a></center></td>";
	echo "</tr>"; 
	} else {
		echo "<td><a href=".$saida."><center><img src='../imagens/icone_saidav.gif' width=48 height=48/></a></center></td>";
		echo "</tr>"; 
	}



	}
	echo "</table></center>";
?>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>

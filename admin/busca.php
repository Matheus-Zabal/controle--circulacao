<?php
include '../conexao.php'
?>
<?php
	session_start();
	$busca =$_POST['busca'];
// A variavel $SQL pega as variaveis $login e $senha, faz uma pesquisa na tabela usuarios
$sql = $mysqli->query("SELECT * FROM `usuarios` WHERE `USU_LOGIN` = '".$_SESSION['USU_LOGIN']."' AND `USU_SENHA`= '".$_SESSION['USU_SENHA']."' AND `USU_PERFIL` = 'Administrador' "); 
 if($sql->num_rows != 1)
		{
	session_destroy();
    echo"<script language='javascript' type='text/javascript'>alert('ALGO ESTA ERRADO, O SENHOR NO PODE ESTAR NESTA PAGINA');window.location.href='../index.php';</script>";  
	exit;
	}
   ?>

<html>
<head>
<meta http-equiv="refresh" content="30">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<title>Circulação de Pessoas</title>

</head>
<?php include 'menuexemplo.php' ?> 
<body>
<div id="container">
<div class="alert alert-secondary" align="center">
    <form method="POST" action="busca.php">
    <table>
    <tr>
    	<td><input type="text" name="busca" size="20" style="height: 40px; width: 400px;" class="form-control" placeholder="PESQUISE PELO NOME DO VISITANTE"></td>
    	<td><input type="submit" value="PESQUISAR" name="" class="btn btn-primary"></td>
    </tr>
    </table>
    </form>
</div>
<center><h5>PESSOA(S) ENCONTRADA(S) NA PESQUISA</h5></center>
<center>
<table class="table table-striped">
  <tr>
	<th><center>FOTO</center></th>
	<th><center>NOME</center></th>
	<th><center>IDT/CPF</center></th>
	<th><center>TELEFONE</center></th>
	<th><center>EMPRESA</center></th>
	<th><center>EDITAR</center></th>
	<th><center>SELECIONAR</center></th>
	</tr>
<?php 
$sql = $mysqli->query("SELECT * FROM visitantes WHERE VIS_NOME LIKE '%$busca%'");
$count = $sql->num_rows;

// conta quantos registros encontrados com a nossa especificação
if ($count == 0) {
   echo "<center><H2>NENHUM RESULTADO ENCONTRADO!</H2></center>";
} else {
    // senão
    if ($count == 1) {
    echo "1 resultado encontrado!";
}
// se houver um resultado diz que existe um resultado
if ($count > 1) {
    echo "$count resultados encontrados!";
}
// se houver mais de um resultado diz quantos resultados existem
while ($dados = mysqli_fetch_array($sql)) {
	$saida="vis_reg_ent.php?cod=".$dados['VIS_CODIGO'];	
    // enquanto houverem resultados...
    // exibir a coluna nome e a coluna email
	$nome="civis.php?cod=".$dados['VIS_CODIGO'];

	$foto=$dados['VIS_FOTO'];
	echo "<tr>";
	echo "<td><center><img src='$foto' width=160 height=120/></center></td>";
	echo "<td><a href=".$nome."><center>" 	. $dados['VIS_NOME'] . "</a></center></td>";
		echo "<td><center>" 	. $dados['VIS_RG'] . "  " 	. $dados['VIS_CPF'] . "</center></td>";
	echo "<td><center>" 	. $dados['VIS_TELCEL'] . "</center></td>";
	echo "<td><center>" 	. $dados['VIS_EMPRESA'] . "</center></td>";
	echo "<td><center>EDITAR</center></td>";
    echo "<td><a href=".$saida."><center><img src='../imagens/seta.png' width=48 height=48/></a></center></td>";
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

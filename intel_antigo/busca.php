<?php
include '../conexao.php'
?>
<?php
	session_start();
	$busca =$_POST['busca'];


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
<link rel="stylesheet" href="css/estiloMenu.css">

<div id="container">
</head>
<?php include 'menu.php' ?> 
<body>
<center><h3>PESQUISE PELO NOME DO VISITANTE</h3></center>
      <form method="POST" action="busca.php">
      <center><input type="text" name="busca" size="20"></center><br>
    <center>  <input type="submit" value="PESQUISAR" name=""></center>
      </form>

<br>
<br>

<center><h3>PESSOAS ENCONTRADA NA PESQUISA</h3></center>
<center><table border=1 width=100%>
  <tr>
	<th bgcolor="#CCCCCC" width=8%><center>FOTO</center></th>
	<th bgcolor="#CCCCCC" width=40%><center>NOME</center></th>
	<th bgcolor="#CCCCCC" width=8%><center>IDT/CPF</center></th>
	<th bgcolor="#CCCCCC" width=10%><center>TELEFONE</center></th>
	<th bgcolor="#CCCCCC" width=30%><center>EMPRESA</center></th>
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
	echo "</tr>"; 
	}	
	}
	echo "</table></center>";
	
?>
</body>
 </div>
</html>

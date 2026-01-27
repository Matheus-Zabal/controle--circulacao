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
<center><h3>PESQUISE PELO NOME  DO MILITAR</h3></center>
      <form method="POST" action="busca_mil.php">
      <center><input type="text" name="busca"  id="cod" size="20"></center><br>
    <center>  <input type="submit" value="PESQUISAR" name=""></center>
      </form>
  <script language="javascript">
document.getElementById('cod').focus();
</script>
<br>
<br>

<center><h3>MILITARES ENCONTRADOS NA PESQUISA</h3></center>
<center><table border=1 width=80%>

<?php 
$sql = $mysqli->query("SELECT * FROM militares WHERE MIL_NOME LIKE '%$busca%' AND MIL_SIT>=1");
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
	$id = $dados['MIL_CODIGO'];
	$saida="mil_entrada2.php?cod=".$dados['MIL_CODIGO'];	
	$nome="militar.php?cod=".$dados['MIL_CODIGO'];
    // enquanto houverem resultados...
    // exibir a coluna nome e a coluna email


	$foto=$dados['MIL_FOTO'];
	echo "<tr>";
	echo "<td><center><img src='$foto' width=60 height=80/></center></td>";
	echo "<td><center>" 	. $dados['MIL_POSTGRAD'] . "</center></td>";
	echo "<td><a href=".$nome."><center>" 	. $dados['MIL_NOME'] . "</a></center></td>";
	echo "<td><center>" 	. $dados['MIL_NDG'] . "</center></td>";
	echo "<td><center>" 	. $dados['MIL_BATERIA'] . "</center></td>";
   
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
	}
	echo "</table></center>";
	
?>
</body>
 </div>
</html>

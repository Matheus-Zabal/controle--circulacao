<?php
include '../conexao.php'
?>
<?php
	session_start();
	


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
<center><h3>PESQUISE PELA PLACA DO VEÍCULO	</h3></center>
      <form method="POST" action="vei_entrada1.php">
      <center><input type="text" name="busca" id="cod" size="20"></center><br>
    <center>  <input type="submit" value="PESQUISAR" name=""></center>
      </form>
  <script language="javascript">
document.getElementById('cod').focus();
</script>
<center><h2>VEICULOS CADASTRADOS</h2></center>
<center><table border=1 width=98%>
  <tr>
	<th bgcolor="#CCCCCC" ><center>FOTO</center></th>
	<th bgcolor="#CCCCCC" ><center>NOME VISITANTE</center></th>
	<th bgcolor="#CCCCCC" ><center>DONO NO DOC</center></th>
	<th bgcolor="#CCCCCC" ><center>MARCA</center></th>
	<th bgcolor="#CCCCCC" ><center>MODELO</center></th>
	<th bgcolor="#CCCCCC" ><center>PLACA</center></th>
	<th bgcolor="#CCCCCC" ><center>COR</center></th>
	<th bgcolor="#CCCCCC" ><center>ANO</center></th>
	</tr>
<?php
//inicia a consulta dos militares cadastrados
$consulta = $mysqli->query('SELECT * FROM veiculos ORDER BY `VEI_MARCA` ASC');
	//faz o loop
	while($row = mysqli_fetch_array($consulta)) {
	$foto=$row['VEI_FOTO'];	
	$codigo=$row['VEI_VIS_CODIGO'];	
	 $consulta1 = $mysqli->query("SELECT * FROM visitantes WHERE VIS_CODIGO='$codigo'");
     $row1 = mysqli_fetch_array($consulta1);
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
	echo "</tr>"; 
	}
	echo "</table></center>";
?>


</body>
 </div>
</html>

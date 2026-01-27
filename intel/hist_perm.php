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


<div id="container" align="center">
</head>
<?php include 'menuexemplo.php' ?> 
	<script>
   function cont(){
   var conteudo = document.getElementById('print').innerHTML;
   tela_impressao = window.open('Despachos');
   tela_impressao.document.write(conteudo);
   tela_impressao.window.print();
   tela_impressao.window.close();
}
</script>

<body>
<br>
<br>
<br>
<center> <form method="POST" action="hist_perm2.php">
      Do dia <input type="text" name="data" id="datepicker" placeholder="Data Inicial dd/mm/aaaa" value=""/>
     até <input type="text" name="data1" id="datepicker1" placeholder="Data Final dd/mm/aaaa" value=""/>
     <input type="hidden" name="cod" value="<?php echo $id; ?>"/>
	  <input type="submit" value="FILTRAR HITÓRICO" name="">
      </form> </center>

<?php
///inicia a consulta dos militares cadastrados
	$consulta = $mysqli->query("SELECT * FROM permissionarios WHERE PERM_CODIGO=$id");
	while($row = mysqli_fetch_array($consulta)) {
	$saida=$row['PERM_CODIGO'];		
	$foto=$row['PERM_FOTO'];
	$nome=$row['PERM_NOME'];
	$rg=$row['PERM_IDT'];
	$local=$row['PERM_LOCAL'];
	$nome1="altera_perm.php?cod=".$row['PERM_CODIGO'];
	$nome2="hist_perm.php?cod=".$row['PERM_CODIGO'];
	}
?>
 <div class="w-50 p-3" align="center">
<center><table width="1085" class="table table-striped">
  <tr>
    <th height="38" colspan="5" scope="col">DADOS CADASTRADOS DO PERMISSIONÁRIO</th>
  </tr>
  <tr>
    <?php  echo "<td width=241 rowspan=3><center><img src='$foto' width=400 height=300/></center></td>"; ?>
    <td width="167" height="33">NOME</td>
    <td colspan="3"><?php echo $nome; ?></td>
  </tr>
  <tr>
    <td height="30">IDENTIDADE</td>
    <td colspan="3"><?php echo $rg; ?></td>
  </tr>
  
  <tr>
    <td height="30">LOCAL</td>
    <td colspan="3"><?php echo $local; ?></td>
  </tr>
 </table></center>

  <p align="center">ÚLTIMOS 50 REGISTROS
		   <div id="print" class="conteudo">
		   
   <center><table width="1085" class="table table-striped">
     <tr>
	
	<th width=10%><center>NOME</center></th>
	<th width=10%><center>ENTRADA</center></th>
	<th width=10%><center>SAÍDA</center></th>

	
	</tr>
<?php
	//inicia a consulta dos militares cadastrados
$consulta = $mysqli->query("SELECT * FROM circulacao_pessoas WHERE CIR_PERM_CODIGO=$id ORDER BY `CIR_ENT` desc LIMIT 50" );
	//faz o loop
	while($row = mysqli_fetch_array($consulta)) {
	//cria uma variavel para registrar entrada
	$saida="vis_saida.php?cod=".$row ['CIR_PERM_CODIGO'];	
	$codigo=$row['CIR_PERM_CODIGO'];
	$data=$row['CIR_ENT'];
	$data1=$row['CIR_SAIDA'];
	$convertido= date('d/m/y - H:i:s', strtotime("$data"));
	$convertido1= date('d/m/y - H:i:s', strtotime("$data1"));
	
	 $consulta1 = $mysqli->query("SELECT * FROM permissionarios WHERE PERM_CODIGO='$codigo'");
     $row1 = mysqli_fetch_array($consulta1);
	 //cria uma variavel para o caminho da foto	
	$foto=$row1['PERM_FOTO'];
	echo "<tr>";
	echo "<td><center>" 	. $row1['PERM_NOME'] . "</center></td>";
	echo "<td><center>$convertido</center></td>";
	echo "<td><center>$convertido1</center></td>";
	echo "</tr>"; 
	}
	echo "</table></center>";
	  echo   "<div>";?>
	<center><input type="button" onClick="cont();" value="IMPRIMIR"></center> 

</div>
</body>
</html>

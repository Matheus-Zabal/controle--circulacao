<?php
include '../conexao.php'
?>
<?php
	session_start();
   $data = $_POST['data'];
   $data1 = $_POST['data1'];
   $pub = $_POST['pub'];

  // converte a data para o formato SQL
    
	$data_inicial = implode("-",array_reverse(explode("/",$data)));
	$data_fi = implode("-",array_reverse(explode("/",$data1)));
	$data_final =  date('Y/m/d', strtotime('+1 days', strtotime("$data_fi")));

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

<title>Circulação de Pessoas</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<div id="container">
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

<?php
switch($pub) { 
    case 'civis': ?>
 <div id="print" class="conteudo"><br>
   <center><table class="table table-striped">
     <tr>
	<th bgcolor="#CCCCCC" width=7%><center>FOTO</center></th>
	<th bgcolor="#CCCCCC" width=25%><center>NOME</center></th>
	<th bgcolor="#CCCCCC" width=20%><center>EMPRESA</center></th>
	<th bgcolor="#CCCCCC" width=15%><center>DESTINO</center></th>
	<th bgcolor="#CCCCCC" width=10%><center>RESPONSÁVEL</center></th>
	<th bgcolor="#CCCCCC" width=6%><center>ENTRADA</center></th>
	<th bgcolor="#CCCCCC" width=6%><center>SAÍDA</center></th>
	</tr>
<?php
	//inicia a consulta dos militares cadastrados
$consulta = $mysqli->query("SELECT * FROM circulacao_pessoas WHERE (CIR_SAIDA BETWEEN '$data_inicial' AND '$data_final') AND CIR_VIS_CODIGO>=0 ORDER BY `CIR_ENT` ASC" );
	//faz o loop
	while($row = mysqli_fetch_array($consulta)) {
	//cria uma variavel para registrar entrada
	$saida="vis_saida.php?cod=".$row ['CIR_VIS_CODIGO'];	
	$codigo=$row['CIR_VIS_CODIGO'];
	$data=$row['CIR_ENT'];
	$data1=$row['CIR_SAIDA'];
	$convertido= date('d/m/y  H:i:s', strtotime("$data"));
	$convertido1= date('d/m/y  H:i:s', strtotime("$data1"));
	
	
	 $consulta1 = $mysqli->query("SELECT * FROM visitantes WHERE VIS_CODIGO='$codigo'");
     $row1 = mysqli_fetch_array($consulta1);
	 //cria uma variavel para o caminho da foto	
	$foto=$row1['VIS_FOTO'];
	echo "<tr>";
	echo "<td><center><img src='$foto' width=80 height=60/></center></td>";
	echo "<td><center>" 	. $row1['VIS_NOME'] . "</center></td>";
	echo "<td><center>" 	. $row1['VIS_EMPRESA'] . "</center></td>";
	echo "<td><center>" 	. $row['CIR_DESTINO'] . "</center></td>";
	echo "<td><center>" 	. $row['CIR_RESP'] . "</center></td>";
	echo "<td><center>$convertido</center></td>";
	echo "<td><center>$convertido1</center></td>";


	echo "</tr>"; 
	}
	echo "</table></center>"; 
    echo   "<div>";?>
	<center><input type="button" onClick="cont();" value="IMPRIMIR"></center> 
     <?php
	 break; 
		  
case 'mil': 
	      ?>
		   <div id="print" class="conteudo">
   <center><table border=1 width=95%>
     <tr>
	<th bgcolor="#CCCCCC" width=7%><center>FOTO</center></th>
	<th bgcolor="#CCCCCC" width=7%><center>POSTO/GRAD</center></th>
	<th bgcolor="#CCCCCC" width=10%><center>NOME GUERRA</center></th>
	<th bgcolor="#CCCCCC" width=10%><center>BATERIA</center></th>
	<th bgcolor="#CCCCCC" width=10%><center>ENTRADA</center></th>
	<th bgcolor="#CCCCCC" width=10%><center>SAÍDA</center></th>
	</tr>
<?php
	//inicia a consulta dos militares cadastrados
$consulta = $mysqli->query("SELECT * FROM circulacao_pessoas WHERE (CIR_SAIDA BETWEEN '$data_inicial' AND '$data_final') AND CIR_MIL_CODIGO>=0 ORDER BY `CIR_ENT` ASC" );
	//faz o loop
	while($row = mysqli_fetch_array($consulta)) {
	//cria uma variavel para registrar entrada
	$saida="vis_saida.php?cod=".$row ['CIR_MIL_CODIGO'];	
	$codigo=$row['CIR_MIL_CODIGO'];
	$data=$row['CIR_ENT'];
	$data1=$row['CIR_SAIDA'];
	$convertido= date('d/m/y - H:i:s', strtotime("$data"));
	$convertido1= date('d/m/y - H:i:s', strtotime("$data1"));
	
	 $consulta1 = $mysqli->query("SELECT * FROM militares WHERE MIL_CODIGO='$codigo'");
     $row1 = mysqli_fetch_array($consulta1);
	 //cria uma variavel para o caminho da foto	
	$foto=$row1['MIL_FOTO'];
	echo "<tr>";
	echo "<td><center><img src='$foto' width=60 height=80/></center></td>";
	echo "<td><center>" 	. $row1['MIL_POSTGRAD'] . "</center></td>";
	echo "<td><center>" 	. $row1['MIL_NDG'] . "</center></td>";
	echo "<td><center>" 	. $row['CIR_DESTINO'] . "</center></td>";
	echo "<td><center>$convertido</center></td>";
	echo "<td><center>$convertido1</center></td>";

	echo "</tr>"; 
	}
	echo "</table></center>";
	  echo   "<div>";?>
	<center><input type="button" onClick="cont();" value="IMPRIMIR"></center> 
     <?php
        break; 
	case 'perm': 
       ?>
		   <div id="print" class="conteudo">
   <center><table border=1 width=95%>
     <tr>
	<th bgcolor="#CCCCCC" width=7%><center>FOTO</center></th>
	<th bgcolor="#CCCCCC" width=10%><center>NOME</center></th>
	<th bgcolor="#CCCCCC" width=10%><center>DESTINO</center></th>
	<th bgcolor="#CCCCCC" width=10%><center>ENTRADA</center></th>
	<th bgcolor="#CCCCCC" width=10%><center>SAÍDA</center></th>
	</tr>
<?php
	//inicia a consulta dos militares cadastrados
$consulta = $mysqli->query("SELECT * FROM circulacao_pessoas WHERE (CIR_SAIDA BETWEEN '$data_inicial' AND '$data_final') AND CIR_PERM_CODIGO>=0 ORDER BY `CIR_ENT` ASC" );
	//faz o loop
	while($row = mysqli_fetch_array($consulta)) {
	//cria uma variavel para registrar entrada
	$saida="vis_saida.php?cod=".$row ['CIR_PERM_CODIGO'];	
	$codigo=$row['CIR_PERM_CODIGO'];	
	$destino=$row['CIR_DESTINO'];
	$data=$row['CIR_ENT'];
	$data1=$row['CIR_SAIDA'];
	$convertido= date('d/m/y - H:i:s', strtotime("$data"));
	$convertido1= date('d/m/y - H:i:s', strtotime("$data1"));
	
	 $consulta1 = $mysqli->query("SELECT * FROM permissionarios WHERE PERM_CODIGO='$codigo'");
     $row1 = mysqli_fetch_array($consulta1);
	 //cria uma variavel para o caminho da foto	
	$foto=$row1['PERM_FOTO'];
	echo "<tr>";
	echo "<td><center><img src='$foto' width=60 height=80/></center></td>";
	echo "<td><center>" 	. $row1['PERM_NOME'] . "</center></td>";
	echo "<td><center>" 	. $row['CIR_DESTINO'] . "</center></td>";
	echo "<td><center>$convertido</center></td>";
	echo "<td><center>$convertido1</center></td>";

	echo "</tr>"; 
	}
	echo "</table></center>";
	  echo   "<div>";?>
	<center><input type="button" onClick="cont();" value="IMPRIMIR"></center> 
     <?php



	  
        break; 
		
			case 'vei': 
       ?>
		   <center><table border=1 width=1085>
     <tr>
	

	<th bgcolor="#CCCCCC" width=25%><center>MOTORISTA</center></th>
	<th bgcolor="#CCCCCC" width=10%><center>DESTINO</center></th>
	<th bgcolor="#CCCCCC" width=10%><center>PLACA</center></th>
	<th bgcolor="#CCCCCC" width=10%><center>ENTRADA</center></th>
	<th bgcolor="#CCCCCC" width=10%><center>SAÍDA</center></th>

	
	</tr>
<?php
//inicia a consulta dos militares cadastrados
 	 	
	
	//inicia a consulta dos militares cadastrados
$consulta3 = $mysqli->query("SELECT * FROM circulacao_veiculos WHERE (CIRV_SAIDA BETWEEN '$data_inicial' AND '$data_final') AND CIRV_VEI_CODIGO>=0 ORDER BY `CIRV_ENT` ASC");
	//faz o loop
	while($row3 = mysqli_fetch_array($consulta3)) {
	//cria uma variavel para registrar entrada
	$saida="vis_saida.php?cod=".$row3 ['CIRV_CODIGO'];	
	$codigo=$row3['VEI_MOT'];
	$data=$row3['CIRV_ENT'];
	$placa1=$row3['CIRV_VEI_CODIGO'];
	$data1=$row3['CIRV_SAIDA'];
	$destino=$row3['CIRV_DESTINO'];
	$convertido= date('d/m/y - H:i:s', strtotime("$data"));
	$convertido1= date('d/m/y - H:i:s', strtotime("$data1"));
	
	$consulta = $mysqli->query("SELECT * FROM veiculos WHERE VEI_CODIGO=$placa1");
	$row = mysqli_fetch_array($consulta) ;
	$placa=$row['VEI_PLACA'];	
    
	$consulta1 = $mysqli->query("SELECT * FROM visitantes WHERE VIS_CODIGO='$codigo'");
     $row1 = mysqli_fetch_array($consulta1);
	 $cadastrou=$row1['VIS_NOME'];	
	$nome="civis.php?cod=".$row1['VIS_CODIGO'];
	
	 $consulta2 = $mysqli->query("SELECT * FROM visitantes WHERE VIS_CODIGO='$codigo'");
     $row2 = mysqli_fetch_array($consulta2);
     $motorista=$row2['VIS_NOME'];
	 //cria uma variavel para o caminho da foto	
	echo "<tr>";
	echo "<td><center>$motorista</center></td>";
	echo "<td><center>$destino</center></td>";
	echo "<td><center>$placa</center></td>";
	echo "<td><center>$convertido</center></td>";
	echo "<td><center>$convertido1</center></td>";
	echo "</tr>"; 
	}
	echo "</table></center>";
	  echo   "<div>";

	  
        break; 
	} 

?>

</html>

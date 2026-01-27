<?php
include '../conexao.php'
?>
<?php
	session_start();
	$id =$_POST['cod'];
   $data = $_POST['data'];
   $data1 = $_POST['data1'];
// A variavel $SQL pega as variaveis $login e $senha, faz uma pesquisa na tabela usuarios
$sql = $mysqli->query("SELECT * FROM `usuarios` WHERE `USU_LOGIN` = '".$_SESSION['USU_LOGIN']."' AND `USU_SENHA`= '".$_SESSION['USU_SENHA']."' AND `USU_PERFIL` = 'Inteligencia'"); 
 if($sql->num_rows != 1)
		{
	session_destroy();
    echo"<script language='javascript' type='text/javascript'>alert('ALGO ESTA ERRADO, O SENHOR NO PODE ESTAR NESTA PAGINA');window.location.href='../index.php';</script>";  
	exit;
	}
	
	  // converte a data para o formato SQL
    $data_inicial = implode("-",array_reverse(explode("/",$data)));
	$data_fi = implode("-",array_reverse(explode("/",$data1)));
	$data_final =  date('Y/m/d', strtotime('+1 days', strtotime("$data_fi")));
	
   ?>

<html>
<head>

<title>Circulação de Pessoas</title>
<link rel="stylesheet" href="css/estiloMenu.css">
	<script>
   function cont(){
   var conteudo = document.getElementById('print').innerHTML;
   tela_impressao = window.open('Despachos');
   tela_impressao.document.write(conteudo);
   tela_impressao.window.print();
   tela_impressao.window.close();
}
</script>
<div id="container">
</head>
<?php include 'menu.php' ?> 

<body>
<?php
//inicia a consulta dos militares cadastrados
	$consulta = $mysqli->query("SELECT * FROM militares WHERE MIL_CODIGO=$id");
	while($row = mysqli_fetch_array($consulta)) {
	$saida=$row['MIL_CODIGO'];		
	$foto=$row['MIL_FOTO'];
	$grad=$row['MIL_POSTGRAD'];
	$nome=$row['MIL_NOME'];
	$mil_ndg=$row['MIL_NDG'];
	$bateria=$row['MIL_BATERIA'];
	$idt=$row['MIL_IDT'];
	$sec=$row['MIL_SECAO'];
	$funcao=$row['MIL_FUNC'];
	$nome1="altera_militar.php?cod=".$row['MIL_CODIGO'];
	$nome2="cracha_militar.php?cod=".$row['MIL_CODIGO'];
	$nome2="hist_militar.php?cod=".$row['MIL_CODIGO'];
	}
?>
<br>
<br>
     <center> <form method="POST" action="hist_militar2.php">
      Do dia <input type="date" name="data" id="datepicker" placeholder="Data Inicial dd/mm/aaaa" value=""/>
     até <input type="date" name="data1" id="datepicker1" placeholder="Data Final dd/mm/aaaa" value=""/>
     <input type="hidden" name="cod" value="<?php echo $id; ?>"/>
	  <input type="submit" value="FILTRAR HITÓRICO" name="">
      </form> </center>
<center><table width="900" border="1">
  <tr>
    <th colspan="3" bgcolor="#CCCCCC" scope="col">DADOS DO MILITAR</th>
  </tr>
  <tr><?php
   echo "<td width=241 rowspan=7><center><img src='$foto' width=240 height=320/></center></td>"; ?>
    <td width="149" height="36" bgcolor="#CCCCCC">POSTO/GRAD:</td>
    <td width="488"><?php echo $grad; ?></td>
  </tr>
  <tr>
    <td height="33" bgcolor="#CCCCCC">NOME DE GUERRA:</td>
    <td><?php echo $mil_ndg; ?></td>
  </tr>
  <tr>
    <td height="32" bgcolor="#CCCCCC">NOME COMPLETO:</td>
    <td><?php echo $nome; ?></td>
  </tr>
  <tr>
    <td height="34" bgcolor="#CCCCCC">IDENTIDADE:</td>
    <td><?php echo $idt; ?></td>
  </tr>
  <tr>
    <td height="34" bgcolor="#CCCCCC">BATERIA:</td>
    <td><?php echo $bateria; ?></td>
  </tr>
  <tr>
    <td height="30" bgcolor="#CCCCCC">SEÇÃO:</td>
    <td><?php echo $sec; ?></td>
  </tr>
  <tr>
    <td height="30" bgcolor="#CCCCCC">FUNÇÃO:</td>
    <td><?php echo $funcao; ?></td>
  </tr>
  
  </table></center>
  <p align="center">
		   <div id="print" class="conteudo">
   <center><table border=1 width=900>
     <tr>
	<th bgcolor="#CCCCCC" width=7%><center>POSTO/GRAD</center></th>
	<th bgcolor="#CCCCCC" width=10%><center>NOME GUERRA</center></th>
	<th bgcolor="#CCCCCC" width=10%><center>ENTRADA</center></th>
	<th bgcolor="#CCCCCC" width=10%><center>SAÍDA</center></th>

	
	</tr>
<?php
	//inicia a consulta dos militares cadastrados
$consulta = $mysqli->query("SELECT * FROM circulacao_pessoas WHERE (CIR_SAIDA BETWEEN '$data_inicial' AND '$data_final') AND CIR_MIL_CODIGO=$id ORDER BY `CIR_ENT` desc" );
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
	echo "<td><center>" 	. $row1['MIL_POSTGRAD'] . "</center></td>";
	echo "<td><center>" 	. $row1['MIL_NDG'] . "</center></td>";
	echo "<td><center>$convertido</center></td>";
	echo "<td><center>$convertido1</center></td>";
	echo "</tr>"; 
	}
	echo "</table></center>";
	  echo   "<div>";?>
	<center><input type="button" onClick="cont();" value="IMPRIMIR"></center> 


</body>
</html>

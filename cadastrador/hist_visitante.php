<?php
include '../conexao.php'
?>
<?php
	session_start();
	$id =$_REQUEST['cod'];

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
<?php
//inicia a consulta dos militares cadastrados
	$consulta = $mysqli->query("SELECT * FROM visitantes WHERE VIS_CODIGO=$id");
	while($row = mysqli_fetch_array($consulta)) {
	$saida=$row['VIS_CODIGO'];		
	$foto=$row['VIS_FOTO'];
	$nome=$row['VIS_NOME'];
	$rg=$row['VIS_RG'];
	$cpf=$row['VIS_CPF'];
	$datanasc=$row['VIS_DATANASC'];
	$empresa=$row['VIS_EMPRESA'];
	$endereco=$row['VIS_ENDERECO'];
	$numero=$row['VIS_NUMERO'];
	$compl=$row['VIS_COMPLEMENTO'];
	$bairro=$row['VIS_BAIRRO'];
	$telcel=$row['VIS_TELCEL'];
	$telcom=$row['VIS_TELRES'];
	$vis_postgrad=$row['VIS_POSTGRAD'];
	$vis_ndg=$row['VIS_NDG'];
	$vis_om=$row['VIS_OM'];
	$nome1="altera_civil.php?cod=".$row['VIS_CODIGO'];
	$nome2="hist_visitante.php?cod=".$row['VIS_CODIGO'];
	}
?>
<br>
<br>
     <center> <form method="POST" action="hist_visitante2.php">
      Do dia <input type="text" name="data" id="datepicker" placeholder="Data Inicial dd/mm/aaaa" value=""/>
     até <input type="text" name="data1" id="datepicker1" placeholder="Data Final dd/mm/aaaa" value=""/>
     <input type="hidden" name="cod" value="<?php echo $id; ?>"/>
	  <input type="submit" value="FILTRAR HITÓRICO" name="">
      </form> </center>

<center><table width="1085" border="1">
  <tr>
    <th height="38" bgcolor="#CCCCCC" colspan="5" scope="col">DADOS CADASTRADOS DO VISITANTE</th>
  </tr>
  <tr>
    <?php  echo "<td bgcolor=black width=241 rowspan=10><center><img src='$foto' width=400 height=300/></center></td>"; ?>
    <td bgcolor="#CCCCCC" width="167" height="33">NOME</td>
    <td colspan="3"><?php echo $nome; ?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC" height="30">IDENTIDADE</td>
    <td colspan="3"><?php echo $rg; ?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC" height="30">CPF</td>
    <td colspan="3"><?php echo $cpf; ?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC" height="30">DATA NASC</td>
    <td colspan="3"><?php echo $datanasc; ?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC" height="30">EMPRESA</td>
    <td colspan="3"><?php echo $empresa; ?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC" height="30">ENDEREÇO</td>
    <td colspan="3"><?php echo $endereco; ?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC" height="30">NUMERO</td>
    <td width="113"><?php echo $numero; ?></td>
    <td bgcolor="#CCCCCC" width="140">COMPLEMENTO</td>
    <td width="245"><?php echo $compl; ?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC" height="30">BAIRRO</td>
    <td colspan="3"><?php echo $bairro; ?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC" height="30">TEL. CELULAR</td>
    <td><?php echo $telcel; ?></td>
    <td bgcolor="#CCCCCC" >TEL COMERCIAL</td>
    <td><?php echo $telcom; ?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC" height="30">POSTO/GRAD</td>
    <td><?php echo $vis_postgrad; ?></td>
    <td bgcolor="#CCCCCC">NOME DE GUERRA</td>
    <td><?php echo $vis_ndg; ?></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td bgcolor="#CCCCCC">OM</td>
    <td colspan="3"><?php echo $vis_om; ?></td>
  </tr>
</table></center>
  <p align="center">ÚLTIMOS 50 REGISTROS
		   <div id="print" class="conteudo">
		   
   <center><table border=1 width=1085>
     <tr>
	<th bgcolor="#CCCCCC" width=25%><center>NOME</center></th>
	<th bgcolor="#CCCCCC" width=15%><center>DESTINO</center></th>
	<th bgcolor="#CCCCCC" width=8%><center>ENTRADA</center></th>
	<th bgcolor="#CCCCCC" width=8%><center>SAÍDA</center></th>

	
	</tr>
<?php
	//inicia a consulta dos militares cadastrados
$consulta = $mysqli->query("SELECT * FROM circulacao_pessoas WHERE CIR_VIS_CODIGO=$id ORDER BY `CIR_ENT` desc LIMIT 50" );
	//faz o loop
	while($row = mysqli_fetch_array($consulta)) {
	//cria uma variavel para registrar entrada
	$saida="vis_saida.php?cod=".$row ['CIR_VIS_CODIGO'];	
	$codigo=$row['CIR_VIS_CODIGO'];
	$data=$row['CIR_ENT'];
	$data1=$row['CIR_SAIDA'];
	$destino=$row['CIR_DESTINO'];
	$convertido= date('d/m/y - H:i:s', strtotime("$data"));
	$convertido1= date('d/m/y - H:i:s', strtotime("$data1"));
	
	 $consulta1 = $mysqli->query("SELECT * FROM visitantes WHERE VIS_CODIGO='$codigo'");
     $row1 = mysqli_fetch_array($consulta1);
	 //cria uma variavel para o caminho da foto	
	echo "<tr>";
	echo "<td><center>" 	. $row1['VIS_NOME'] . "</center></td>";
	echo "<td><center>$destino</center></td>";
	echo "<td><center>$convertido</center></td>";
	echo "<td><center>$convertido1</center></td>";
	echo "</tr>"; 
	}
	echo "</table></center>";
	  echo   "<div>";?>
	<center><input type="button" onClick="cont();" value="IMPRIMIR"></center> 

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>

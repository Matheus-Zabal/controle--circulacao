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

</head>
<?php include 'menuexemplo.php' ?> 
<body>
<div id="container" align="center">

<div class="alert alert-secondary" align="center">
<form method="POST" action="busca.php">
<table>
    <tr>
    	<td><input type="text" name="busca" size="20" style="width: 400px;" class="form-control" placeholder="PESQUISE PELO NOME DO VISITANTE"></td>
    	<td><input type="submit" value="PESQUISAR" name="" class="btn btn-primary"></td>
    </tr>
</table>
</form>
</div>
     
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
	}
?>
 <form method="POST" enctype="multipart/form-data" action="alterado_civil.php">
<center>
<div class="w-50 p-3">
<table class="table table-bordered table-striped">
  <tr> <tr>
    <th colspan="5" scope="col">DADOS CADASTRADOS DO VISITANTE</th>
  </tr>
  <tr>
    <?php  echo "<td rowspan=10><center><img src='$foto' width=400 height=300/></center></td>"; ?>
    <td>NOME</td>
    <td colspan="3"><input size="40"  type="text" name="VIS_NOME" value="<?php echo $nome; ?>" /></td>
  </tr>
  <tr>
    <td>IDENTIDADE</td>
    <td colspan="3"><input size="40"  type="text" name="VIS_RG" value="<?php echo $rg; ?>" /></td>
  </tr>
  <tr>
    <td>CPF</td>
    <td colspan="3"><input size="40"  type="text" name="VIS_CPF" value="<?php echo $cpf; ?>" /></td>
  </tr>
  <tr>
    <td>DATA NASC</td>
    <td colspan="3"><input size="40"  type="text" name="VIS_DATANASC" value="<?php echo $datanasc; ?>" /></td>
  </tr>
  <tr>
    <td>EMPRESA</td>
    <td colspan="3"><input size="40"  type="text" name="VIS_EMPRESA" value="<?php echo $empresa; ?>" /></td>
  </tr>
  <tr>
    <td>ENDEREÇO</td>
    <td colspan="3"><input size="40"  type="text" name="VIS_ENDERECO" value="<?php echo $endereco; ?>" /></td>
  </tr>
  <tr>
    <td>NÚMERO</td>
    <td><input type="text" name="VIS_NR" value="<?php echo $numero; ?>" /></td>
    <td>COMPLEMENTO</td>
    <td><input size="20" type="text" name="VIS_COMPLEMENTO" value="<?php echo $compl; ?>" /></td>
  </tr>
  <tr>
    <td>BAIRRO</td>
    <td colspan="3"><input size="40"  type="text" name="VIS_BAIRRO" value="<?php echo $bairro; ?>" /></td>
  </tr>
  <tr>
    <td>TEL. CELULAR</td>
    <td><input  type="text" name="VIS_TELCEL" value="<?php echo $telcel; ?>" /></td>
    <td>TEL COMERCIAL</td>
    <td><input size="20" type="text" name="VIS_TELRES" value="<?php echo $telcom; ?>" /></td>
  </tr>
  <tr>
    <td>POSTO/GRAD</td>
    <td><input type="text" name="VIS_POSTGRAD" value="<?php echo $vis_postgrad; ?>" /></td>
    <td>NOME DE GUERRA</td>
    <td><input size="20" type="text" name="VIS_NDG" value="<?php echo $vis_ndg; ?>" /></td>
  </tr>
  <tr>
   <td colspan="1" scope="col"><input name="arquivo" type="file" /></td>
    <td>OM</td>
    <td colspan="3"><input size="40" type="text" name="VIS_OM" value="<?php echo $vis_om; ?>" /></td>
  </tr>
    <input size="40"  type="hidden" name="VIS_CODIGO" value="<?php echo $saida; ?>" />
  <input size="40"  type="hidden" name="VIS_FOTO" value="<?php echo $foto; ?>" />
 </form>
</table>
</div>
</center>
<center><button type ="submit" name="enviar" class="btn btn-primary">ALTERAR DADOS</button></center>
</p>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</div>
</body>
</html>

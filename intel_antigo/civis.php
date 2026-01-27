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
<?php
//inicia a consulta dos militares cadastrados
	$consulta = $mysqli->query("SELECT * FROM visitantes WHERE VIS_CODIGO=$id");
	while($row = mysqli_fetch_array($consulta)) {
	$saida=$row['VIS_CODIGO'];		
	$foto=$row['VIS_FOTO'];
	$nome=$row['VIS_NOME'];
	$rg=$row['VIS_RG'];
	$cpf=$row['VIS_CPF'];
	$datanasc1=$row['VIS_DATANASC'];
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
	$datanasc= date('d/m/y', strtotime("$datanasc1"));
	}
?>
<center><table width="98%" border="1">
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

  <p align="center">
<?php  

echo " &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<a href=".$nome2."><input type=submit  value='VER HISTÓRICO DO VISITANTE'></a>";
?>
 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<input type="button" value=" &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;VOLTAR &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;" onClick="history.back()"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
</p>
<br>
<br>
<br>

</body>
 </div>
</html>

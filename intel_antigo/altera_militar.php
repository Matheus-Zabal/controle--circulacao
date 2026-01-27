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
<center><h3>PESQUISE PELO NOME DO MILITAR</h3></center>
      <form method="POST" action="busca_mil.php">
      <center><input type="text" name="busca" id="cod" size="20"></center><br>
    <center>  <input type="submit" value="PESQUISAR" name=""></center>
      </form>
  <script language="javascript">
document.getElementById('cod').focus();
</script>
<br>
<br>
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
	}
?>

 <form method="POST" enctype="multipart/form-data" action="alterado_mil.php">
<center><table width="900" border="1">
  <tr>
    <th colspan="3" bgcolor="#CCCCCC" scope="col">DADOS DO MILITAR</th>
  </tr>
  <tr><?php
   echo "<td width=241 rowspan=7><center><img src='$foto' width=240 height=320/></center></td>"; ?>
    <td width="149" height="36" bgcolor="#CCCCCC">POSTO/GRAD:</td>
	<td width="488"><div align="left"><select name="MIL_POSTGRAD">
			  <option value="<?php echo $grad; ?>"><?php echo $grad; ?></option>
        <option value="Gen Ex">Gen Ex</option>
        <option value="Gen Div">Gen Div</option>
        <option value="Gen Bda">Gen Bda</option>
			  <option value="Cel">Cel</option>
			  <option value="Ten Cel">Ten Cel</option>
			  <option value="Maj">Maj</option>
			  <option value="Cap">Cap</option>
			  <option value="1º Ten">1º Ten</option>
			  <option value="2º Ten">2º Ten</option>
			  <option value="Asp Of">Asp Of</option>
			  <option value="S Ten">S Ten</option>
			  <option value="1º Sgt">1º Sgt</option>
			  <option value="2º Sgt">2º Sgt</option>
			  <option value="3º Sgt">3º Sgt</option>
			  <option value="Al">Aluno</option>
			  <option value="Cb">Cb</option>
			  <option value="Cb EV">Cb EV</option>
			  <option value="Sd">Sd</option>
			  <option value="Sd EV">Sd EV</option></td>
 
	</select>
	  </tr>
  <tr>
    <td height="33" bgcolor="#CCCCCC">NOME DE GUERRA:</td>
	    <td><input size="80"  type="text" name="MIL_NDG" value="<?php echo $mil_ndg; ?>" /></td>
  </tr>
  <tr>
    <td height="32" bgcolor="#CCCCCC">NOME COMPLETO:</td>
    <td><input size="80"  type="text" name="MIL_NOME" value="<?php echo $nome; ?>" /></td>
  </tr>
  <tr>
    <td height="34" bgcolor="#CCCCCC">IDENTIDADE:</td>
    <td><input size="80"  type="text" name="MIL_IDT" value="<?php echo $idt; ?>" /></td>
  </tr>


<tr>
    <td height="34" bgcolor="#CCCCCC">SU:</td>
    <td><div align="left"><select name="MIL_BATERIA">
	<option value="<?php echo $bateria ?>"><?php echo $bateria ?></option> 
    <?php $consulta1 = $mysqli->query("SELECT * FROM su ORDER BY `su` ASC");
          while($row1 = mysqli_fetch_array($consulta1)) { 
                $su =  $row1['su'];
    ?>
          <option value="<?php echo $su ?>"><?php echo $su ?></option>  
    <?php }   ?>
    </select></center></td>
</tr>
 <tr>
    <td height="30" bgcolor="#CCCCCC">SEÇÃO:</td>
    <td><input size="80"  type="text" name="MIL_SECAO" value="<?php echo $sec; ?>" /></td>
  </tr>

  <tr>
    <td height="30" bgcolor="#CCCCCC">FUNÇÃO:</td>
    <td><input size="80"  type="text" name="MIL_FUNC" value="<?php echo $funcao; ?>" /></td>
  </tr>
  <tr>
    <td colspan="3" scope="col"><input name="arquivo" type="file" /></td>
  </tr>
  <input size="80"  type="hidden" name="MIL_CODIGO" value="<?php echo $saida; ?>" />
  <input size="80"  type="hidden" name="MIL_FOTO" value="<?php echo $foto; ?>" />
  </form>
  </table></center>
	
		<BR>
	<center><button type ="submit" name="enviar" >ALTERAR</button></center>
<br>
<br>
<br>

</body>
 </div>
</html>

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
<center>
 <form method="POST" action="busca_mil.php">
      
      <table>
    <tr>
    	<td><input type="text" name="busca" id="cod" size="30" style="width: 400px;" class="form-control" placeholder="PESQUISE POR NOME DE MILITAR"></td>
    	<td><input type="submit" value="PESQUISAR" name="" class="btn btn-primary"></td>
    </tr>
</table>
      </form>
  <script language="javascript">
document.getElementById('cod').focus();
</script>
</div>
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
<div class="w-50 p-3">
 <form method="POST" enctype="multipart/form-data" action="alterado_mil.php">
<center><table class="table table-striped">
  <tr>
    <th colspan="3" scope="col">CADASTRO</th>
  </tr>
  <tr><?php
   echo "<td width=241 rowspan=7><center><img src='$foto' width=240 height=320/></center></td>"; ?>
    <td width="149" height="36">POSTO/GRAD:</td>
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
    <td height="33">NOME DE GUERRA:</td>
      <td><input size="80"  type="text" name="MIL_NDG" value="<?php echo $mil_ndg; ?>" style="text-transform: uppercase;"/></td>
  </tr>
  <tr>
    <td height="32">NOME COMPLETO:</td>
    <td><input size="80"  type="text" name="MIL_NOME" value="<?php echo $nome; ?>" style="text-transform: uppercase;"/></td>
  </tr>
  <tr>
    <td height="34">IDENTIDADE:</td>
    <td><input size="80"  type="text" name="MIL_IDT" value="<?php echo $idt; ?>" /></td>
  </tr>


<tr>
    <td height="34">SU:</td>
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
    <td height="30">SEÇÃO:</td>
    <td><input size="80"  type="text" name="MIL_SECAO" value="<?php echo $sec; ?>" /></td>
  </tr>

  <tr>
    <td height="30">FUNÇÃO:</td>
    <td><input size="80"  type="text" name="MIL_FUNC" value="<?php echo $funcao; ?>" /></td>
  </tr>
  <tr>
    <td colspan="3" scope="col"><input name="arquivo" type="file" /></td>
  </tr>
  <input size="80"  type="hidden" name="MIL_CODIGO" value="<?php echo $saida; ?>" />
  <input size="80"  type="hidden" name="MIL_FOTO" value="<?php echo $foto; ?>" />
  </form>
  </table></center>
  
  <center><button type ="submit" name="enviar" class="btn btn-primary btn-lg">ALTERAR DADOS DO MILITAR</button></center>

</div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>

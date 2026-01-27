<?php
include '../conexao.php'
?>
<?php
	session_start();
	$id =$_REQUEST['cod'];

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
<link rel="stylesheet" href="css/estiloMenu.css">

<div id="container">
</head>
 <ul id="menu-bar">
  <li><a href="#">Entrada/Saída</a>
  <ul>
  <li><a href="index.php">Civis/veículos</a> </li>
  <li><a href="index1.php">Militares</a> </li>
  <li><a href="index2.php">Permissionários</a> </li>
  </ul>
    <li><a href="#">Cadastrados</a>
  <ul>
  <li><a href="mil_cad.php">Militares</a> </li>
    <li><a href="perm_cad.php">Permissionários</a> </li>
  <li><a href="civis_cad.php">Civis</a> </li>
  <li><a href="vei_cad.php">Veículos</a> </li>
  </ul>
   <li><a href="pesquisa.php">Pesquisa entrada saída</a> </li>
	<li><a href="#">Gerenciar</a>
  <ul>
  <li><a href="todos.php">Militares Ativos</a> </li>
  <li><a href="todos1.php">Militares Inativos</a> </li>
  <li><a href="perm_cad1.php">Permissionários Ativos</a> </li>
  <li><a href="perm_cad2.php">Permissionários Inativos</a> </li>
  <li><a href="usuarios.php">Usuários</a> </li>
  <li><a href="inserir_usuario.php">Inserir usuário</a> </li>
  <li><a href="insere_su.php">Inserir SU</a> </li>
  </ul>
  <li><a href="altera_senha.php">Alterar Senha</a> </li>
  <li><a href="logout.php">SAIR</a></li>
 </ul>
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
	$consulta = $mysqli->query("SELECT * FROM veiculos WHERE VEI_CODIGO=$id");
	while($row = mysqli_fetch_array($consulta)) {
	$saida=$row['VEI_CODIGO'];
	$placa=$row['VEI_PLACA'];	
	$codigo_visitante=$row['VEI_VIS_CODIGO'];	
	$dono=$row['VEI_DONO'];	
	$marca=$row['VEI_MARCA'];	
	$modelo=$row['VEI_MODELO'];	
	$ano=$row['VEI_ANO'];	
	$cor=$row['VEI_COR'];	
	$renavam=$row['VEI_OBS'];	
	$foto=$row['VEI_FOTO'];
	}
	
		
	$consulta1 = $mysqli->query("SELECT * FROM visitantes WHERE VIS_CODIGO='$codigo_visitante'");
     $row1 = mysqli_fetch_array($consulta1);
	 $cadastrou=$row1['VIS_NOME'];	
?>

 <form method="POST" enctype="multipart/form-data" action="alterado_veiculo.php">

<center><table width="1100" border="1">
  <tr>
    <th colspan="3" bgcolor="#CCCCCC" scope="col">DADOS DO VEICULO</th>
  </tr>
  <tr><?php
   echo "<td width=241 rowspan=8><center><img src='$foto' width=320 height=240/></center></td>"; ?>
    <td width="149" height="36" bgcolor="#CCCCCC">DONO NO DOC:</td>
    <td width="488"><input size="80"  type="text" name="VEI_DONO" value="<?php echo $dono; ?>" /></td>
  </tr>
  <tr>
    <td height="33" bgcolor="#CCCCCC">PLACA:</td>
    <td><input size="80"  type="text" name="VEI_PLACA" value="<?php echo $placa; ?>" /></td>
  </tr>
  <tr>
    <td height="32" bgcolor="#CCCCCC">MARCA:</td>
    <td><input size="80"  type="text" name="VEI_MARCA" value="<?php echo $marca; ?>" /></td>
  </tr>
  <tr>
    <td height="34" bgcolor="#CCCCCC">MODELO:</td>
    <td><input size="80"  type="text" name="VEI_MODELO" value="<?php echo $modelo; ?>" /></td>
  </tr>
  <tr>
    <td height="34" bgcolor="#CCCCCC">ANO:</td>
    <td><input size="80"  type="text" name="VEI_ANO" value="<?php echo $ano; ?>" /></td>
  </tr>
  <tr>
    <td height="30" bgcolor="#CCCCCC">COR:</td>
    <td><input size="80"  type="text" name="VEI_COR" value="<?php echo $cor; ?>" /></td>
  </tr>
  <tr>
    <td height="30" bgcolor="#CCCCCC">RENAVAM:</td>
    <td><input size="80"  type="text" name="VEI_OBS" value="<?php echo $renavam; ?>" /></td>
  </tr>
    <tr>
    <td height="30" bgcolor="#CCCCCC">CADASTROU:</td>
	<td><?php echo $cadastrou; ?></td>
  </tr>
  <input type="hidden" name="VEI_CODIGO" value="<?php echo $saida; ?>" />
    </form>
  </table></center>
  <p align="center">
	
	<center><button type ="submit" name="enviar" >ALTERAR</button></center>
<br>
<br>
<br>

</body>
 </div>
</html>
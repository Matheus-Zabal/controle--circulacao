<?php
include '../conexao.php'
?>
<?php
	session_start();
	
$id= $_GET['id'];	
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
<h3><center>ALTERAR CAMPOS</center><h3>
<h4><center>Use a opção SITUACÃO caso queira desativar o militar por algum tempo</center><h4>
 <form method="POST" action="alterado_gupo.php">
<center><table  width="500" border=1>
		<tr>
   <th bgcolor="#CCCCCC" scope="row">LOGIN</th>
    <tH <th bgcolor="#CCCCCC" scope="row">SENHA</th>
    <tH <th bgcolor="#CCCCCC" scope="row">PERFIL</th>
       </tr>
<?php
$consulta2 = $mysqli->query("SELECT * FROM usuarios where `USU_MIL_CODIGO` = '$id'");
 while($row2 = mysqli_fetch_array($consulta2)) {
	 $login=$row2['USU_LOGIN'];
	 $senha =$row2['USU_SENHA'];
	 $perfil =$row2['USU_PERFIL'];
	 $mil_codigo =$row2['USU_MIL_CODIGO'];
	 
		 
	 
	echo "<tr>"; ?>
	<tr>
	<td><input type="text" name="USU_MIL_LOGIN" size="15" value="<?php echo $login ?>"/a></center></td>
	<td><input type="password" name="USU_MIL_SENHA" size="50" value="<?php echo $senha ?>"/a></center></td>
	  <td width="30"><div ><select name="USU_PERFIL">
	<option value="Convencional">Convencional</option>
	<option value="Furriebiac">Furriel Bia C</option>
	<option value="Furriel1biao">Furriel 1ª Bia</option>
	<option value="Furriel2biao">Furriel 2ª Bia</option>
	<option value="Furriel3biao">Furriel 3ª Bia</option>
	<option value="FurrielNPOR">Furriel NPOR</option>
	<option value="FurrielPO">Furriel PO</option>
	<option value="Administrador">Administrador</option>
	<option value="Inteligencia">Inteligência</option>
	<option value="Cmt">Cmt</option>
	<option value="Ordenanca">Ordenança</option>

	</select></div></td>
	</tr>
	<?PHP
	}
?>
	<input type="hidden"  name="USU_MIL_CODIGO" value="<?php echo "$mil_codigo";?>"/>
	</form>
	</table></center>
	<BR>
	<center><button type ="submit" name="enviar" >ALTERAR</button></center>
	
	
<br>
</body>
</div>
</html>
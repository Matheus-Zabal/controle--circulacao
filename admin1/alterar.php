<?php
include '../conexao.php'
?>
<?php
	session_start();
	


// A variavel $SQL pega as variaveis $login e $senha, faz uma pesquisa na tabela usuarios
$sql = $mysqli->query("SELECT * FROM `usuarios` WHERE `USU_LOGIN` = '".$_SESSION['USU_LOGIN']."' AND `USU_SENHA`= '".$_SESSION['USU_SENHA']."' AND `USU_PERFIL` = 'Convencional' "); 
 if($sql->num_rows != 1)
		{
	session_destroy();
    echo"<script language='javascript' type='text/javascript'>alert('ALGO ESTA ERRADO, O SENHOR NO PODE ESTAR NESTA PAGINA');window.location.href='../index.html';</script>";  
	exit;
	}
   ?>
<?php
//requer a ID que foi mandanda do link alterar
$id =$_REQUEST['cod'];
//faz a consulta pra ver se existe a ID
$query = "SELECT * FROM despacho WHERE CODIGO=".$id;
$dados = $mysqli->query ($query);
$resultado = mysqli_fetch_assoc($dados);
//puxa os dados
$data = $resultado['DATA'];
$assunto = $resultado['ASSUNTO'];
$ramal =$resultado['RAMAL'];
$datainvertida= strftime('%d/%m/%Y',strtotime($data));

?>

   
<html>
<head>

<title>Arranchamento</title>
<link rel="stylesheet" href="css/estiloMenu.css">
<link href="css/redmond/jquery-ui-1.10.1.custom.css" rel="stylesheet" />
<!-- Biblioteca padrao do Jquery na pasta js/ -->
<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript">
$(document).ready(function(e) {
    $("#datepicker").datepicker({
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sab','Dom'],
        dayNames: ['Domingo','Segunda','Terca','Quarta','Quinta','Sexta','Sabado'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
        monthNames: ['Janeiro','Fevereiro','Marco','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        dateFormat: 'dd/mm/yy',
        nextText: 'Proximo',
        prevText: 'Anterior',
		minDate: 1,
		maxDate: 14
		});
		
});
</script>

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

<CENTER><h2>ALTERAR DESPACHO</h2></CENTER>
<center><form name = "cadastro" method = "post" action="alterando.php"
><table width="370" border="0">
<input type="hidden" name="id" value="<?php echo $id ?>" />
   <tr>
    <th width="116" scope="row"><div align="right">DATA</div> </th>
    <td width="238"><div align="left"><input id="datepicker" type="text" name="data" value="<?php echo $datainvertida ?>" /></div>  </td>
  </tr>
 <tr>
    <th width="116" scope="row"><div bgcolor="#666666"><div align="right">ASSUNTO:</div></th>
    <td width="238"><div align="left"><textarea rows="4" cols="50" name="assunto" value="" ><?php echo $assunto ?></textarea></div></td>
  </tr>
  <tr>
    <th scope="row"><div align="right">RAMAL:</div></th>
    <td><div align="left"><input type="text" name="ramal" value="<?php echo $ramal ?>"  /></div></td>
  </tr>   
 </table>
<input type="submit" name="alterar" value="ALTERAR"/><br />
</form></center>
<br>
<br>
</body>
</div>
</html>
<?php
include '../conexao.php'
?>
<?php
	session_start();

$sql = $mysqli->query("SELECT * FROM `usuarios` WHERE `USU_LOGIN` = '".$_SESSION['USU_LOGIN']."' AND `USU_SENHA`= '".$_SESSION['USU_SENHA']."' AND `USU_PERFIL` = 'Guarda' "); 
 if($sql->num_rows != 1)
		{
	session_destroy();
    echo"<script language='javascript' type='text/javascript'>alert('ALGO ESTA ERRADO, O SENHOR NO PODE ESTAR NESTA PAGINA');window.location.href='../index.php';</script>";  
	exit;
	}
   ?>

<html>
<head>

<title>Inserir Usuarios</title>
<link rel="stylesheet" href="css/estiloMenu.css">
<link href="css/redmond/jquery-ui-1.10.1.custom.css" rel="stylesheet" />
<!-- Biblioteca padrao do Jquery na pasta js/ -->
<script type="text/javascript" src="js/checkbox.js"></script>
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
				});
		
});
</script>
<div id="container">
</head>
<?php include 'menu.php' ?> 
<body>
<h3><center>CADASTRO DE PERMISSIONARIOS</center><h3>
<h4><center>Favor preencher todos os campos.</center><h4>
 <form method="POST" enctype="multipart/form-data" action="insere_perm.php">
<center><table  width="800" border=1>
			<tr>
	 <th bgcolor="#CCCCCC" scope="row">NOME: </th>
	   <td width="30" ><div ><input size="80"  type="text" name="PERM_NOME" placeholder="Nome como é conhecido" /></div></td>
	 	</tr>
				<tr>
	 <th bgcolor="#CCCCCC" scope="row">IDENTIDADE: </th>
	   <td width="30" ><div ><input size="80"  type="text" name="PERM_IDT" /></div></td>
	 	</tr>
		<tr>
	 <th bgcolor="#CCCCCC" scope="row">LOCAL: </th>
	   <td width="30" ><div ><input size="80"  type="text" name="PERM_LOCAL" /></div></td>
	 	</tr>

   	<tr>
	 <th bgcolor="#CCCCCC" scope="row">FOTO: </th>
    <td width="30" ><div > <input name="arquivo" type="file" /></div></td>
	 	</tr>
   		</form>
	</table></center>
	<BR>
	<center><button type ="submit" name="enviar" >INSERIR PERMISSIONÁRIO</button></center>
		
<br>
</body>
</div>
</html>

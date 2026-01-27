<?php
include '../conexao.php'
?>
<?php
	session_start();
	


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

<title>Inserir Permissionário</title>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
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

</head>
<?php include 'menuexemplo.php' ?> 
<body>
<div id="container" align="center">
<div class="alert alert-info" role="alert">
<h3><center>CADASTRO DE PERMISSIONÁRIOS</center><h3>
<h4><center>Favor preencher todos os campos.</center><h4>
</div>
<div class="w-50 p-3">
 <form method="POST" enctype="multipart/form-data" action="insere_perm.php">
  <div class="form-group">
  <center>
<table class="table table-striped">
			<tr>
	 <th scope="row">NOME COMPLETO: </th>
	   <td><div ><input size="60"  type="text" name="PERM_NOME" class="form-control"/></div></td>
	 	</tr>
				<tr>
	 <th scope="row">IDENTIDADE: </th>
	   <td><div ><input size="60"  type="text" name="PERM_IDT" class="form-control"/></div></td>
	 	</tr>
		<tr>
	 <th scope="row">LOCAL: </th>
	   <td><div ><input size="60"  type="text" name="PERM_LOCAL" class="form-control"/></div></td>
	 	</tr>

   	<tr>
	 <th scope="row">FOTO: <a href="#" onClick='window.open("https://10.26.36.3/camera/","WEBCAM","height=800 width=1000")'>Abrir WEBCAM</a></th>
    <td ><div > <input name="arquivo" type="file" /></div></td>
	 	</tr>
   		
	</table></center>
	<center><button type ="submit" name="enviar" class="btn btn-primary btn-lg">INSERIR PERMISSIONÁRIO</button></center>
		</form>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>

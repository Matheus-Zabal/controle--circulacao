<?php
include '../conexao.php';
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
<center><h3>PESQUISE O NOME DO VISITANTE MOTORISTA</h3></center>
      <form method="POST" action="cad_vei1.php">
      <center><input type="text" name="busca" id="cod" size="20"></center><br>
    <center>  <input type="submit" value="PESQUISAR" name=""></center>
      </form>
<!--deixar o cursor piscando para codigo de barras-->
  <script language="javascript">
document.getElementById('cod').focus();
</script>
<br>


<br>
</body>
</div>
</html>

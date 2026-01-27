<?php
include '../conexao.php'
?>
<?php
	session_start();
	


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
<link href="css/redmond/jquery-ui-1.10.1.custom.css" rel="stylesheet" />
<!-- Biblioteca padrao do Jquery na pasta js/ -->
<script type="text/javascript" src="js/checkbox.js"></script>
<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>


</script>
<div id="container">
</head>
<?php include 'menu.php' ?> 
<body>
<br><br><br>

<center><h3>PESQUISA DE ENTRADA E SAÍDA DE PESSOAL</h3></center>
      <form method="POST" action="busca_ent_sai.php">
      <center><strong>DATA INICIAL: </strong> <input type="date" name="data" id="datepicker" placeholder="dd/mm/aaaa (data menor)" value=""/></center><br>
      <center><strong>DATA FINAL: </strong> <input type="date" name="data1" id="datepicker1" placeholder="dd/mm/aaaa (data maior)" value=""/></center><br>
	  <center> <strong>PUBLICO: </strong><select name="pub"></center> 
	  <td><option value="civis">Civis</option>
	  <option value="mil">Militares</option> 
	  <option value="perm">Permissionarios</option>
	  <option value="vei">Veículo</option>
	  	</select>
		<br>
		<br>
	  <input type="submit" value="PESQUISAR" name="">
      </form>


<br>
</body>
 </div>
</html>

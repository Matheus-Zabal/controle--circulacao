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
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<?php include 'menuexemplo.php' ?> 
<body>
<div id="container" align="center">
<center>
<div class="alert alert-secondary" align="center">
<h4>PESQUISA DE ENTRADA E SAÍDA DE PESSOAL</h4>
</div>
</center>
      <form method="POST" action="busca_ent_sai.php">
	<center><strong>DATA INICIAL: </strong> <input type="date" name="data" placeholder="dd/mm/aaaa" value=""/></center><br>
	<center><strong>DATA FINAL: </strong> <input type="date" name="data1" placeholder="dd/mm/aaaa" value=""/></center><br>
	<center> <strong>PUBLICO: </strong><select name="pub"></center> 
	  <td><option value="civis">Civis / Outra OM</option>
	  <option value="mil">Militares</option> 
	  <option value="perm">Permissionários / Obras</option>
	  <option value="vei">Veículos</option>
	  	</select>
		<br><br>
	  <input type="submit" value="Gerar relatório" name="" class="btn btn-primary">
      </form>
 </div>
<br>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>

<?php
include '../conexao.php'
?>
<?php
  session_start();
  


// A variavel $SQL pega as variaveis $login e $senha, faz uma pesquisa na tabela usuarios
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
<Meta http-equiv="refresh" content="60" />
<title>Circulação de Pessoas</title>
<link rel="stylesheet" href="css/estiloMenu.css">
<div id="container">
</head>
<body>
<center><h2>ENTRADA E SAÍDA DE MILITARES</h2></center><br>
<center><h4>PASSE SEU CÓDIGO DE BARRAS NO LEITOR</h4></center><br>


<center><form method="POST" action="mil_ent_barra1.php" id="formlogin" name="formlogin" >
 <input type="text" name="cod" id="cod" /><br> <br> 
 </form></center>
 
 <!--deixar o cursor piscando para codigo de barras-->
  <script language="javascript">
document.getElementById('cod').focus();
</script>
</body>
 </div>
</html>
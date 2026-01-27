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
<h1><center><p class='msg-success'>CÓDIGO NÃO ENCONTRADO!</p></center></h1>
<h1><center><p class='msg-success'>TENTE NOVAMENTE OU ENTRE EM CONTATO COM A SEÇ INFOR!</p></center></h1>
        <script>
            setTimeout(function(){ 
                var msg = document.getElementsByClassName("msg-success");
                while(msg.length > 0){
                    msg[0].parentNode.removeChild(msg[0]);
                }
            }, 3000);

      setTimeout(function() {
      window.location.href = "index5.php";
      }, 5000);

        </script>
<br>
</body>
 </div>
</html>
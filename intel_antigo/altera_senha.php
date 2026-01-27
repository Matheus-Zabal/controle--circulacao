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
    echo"<script language='javascript' type='text/javascript'>alert('ALGO ESTA ERRADO, O SENHOR NO PODE ESTAR NESTA PAGINA');window.location.href='../index.html';</script>";  
	exit;
	}
   ?>
<html>
<head>

<title>Trocar senha</title>
<link rel="stylesheet" href="../css/estiloMenu.css">
<link rel="stylesheet" href="../css/style.css">
<div id="container">
</head>
<body>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

 
	<title>Alterar Senha</title>
<br>
<div id="despacho_centro">
        <form action="alterando_senha.php" method="post" id="login-form">
        <div class="form-group">
          <label class="label-control">
            <span class="label-text"></span>
          </label>
          Digite a nova senha:<input type="password" name="senha" class="form-control" />
        </div>
          <span class="label-text"></span>
          </label> 
          Confirme a nova senha:<input type="password" name="confirmacao" class="form-control" />
		   <input type="submit" value="ALTERAR" class="btn" />
        </div>
       
           </form>
  </div>
 <br>
<br>
</body>
</div>
</div>
</html>

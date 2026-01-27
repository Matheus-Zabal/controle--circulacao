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
	 $senha = ($_POST['senha']);
	 $senha1 = base64_encode($_POST['senha']);
	 $confirme_senha = ($_POST['confirmacao']);
     $USU_CODIGO = $_SESSION['USU_CODIGO'];
?>

<?php
  if($senha == "" && $confirme_senha == "") {
        echo "
            <script>
                alert('Os campos das senhas não podem ser nulos.');
                window.location='altera_senha.php';
            </script>";
    } else {
        if ($senha != $confirme_senha) {
            echo "
            <script>
                alert('AS SENHAS NÃO COICIDEM - TENTE NOVAMENTE!.');
                window.location='altera_senha.php';
            </script>";
        } else {
            if ($result=$mysqli->query("UPDATE usuarios SET USU_SENHA='$senha1' WHERE USU_CODIGO='$USU_CODIGO'")) {
               echo"<script language='javascript' type='text/javascript'>alert('SENHA ALTERADA COM SUCESSO!!! ENTRE NOVAMENTE COM SUA NOVA SENHA');window.location.href='logout.php';</script>";
            }
        }
    }
	
?>

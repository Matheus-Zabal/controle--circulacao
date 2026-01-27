<?php
include '../conexao.php'
?>
<?php
    session_start();
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

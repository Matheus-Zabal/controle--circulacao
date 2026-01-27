<?php
include '../conexao.php'
?>
<?php
  session_start();
  $busca =$_POST['busca'];


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
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<?php include 'menuexemplo.php' ?> 
<body>
<div id="container">
<center><h3>PESQUISE PELA PLACA DO VEÍCULO  </h3></center>
      <form method="POST" action="vei_entrada1.php">
      <center><input type="text" name="busca" id="cod" size="20"></center><br>
     <center>  <input type="submit" value="PESQUISAR" name=""></center>
      </form>
  <script language="javascript">
document.getElementById('cod').focus();
</script>
<br>
<br>

<center><h3>MILITARES ENCONTRADOS NA PESQUISA</h3></center>
<center><table border=1 width=98%>

<?php 
$sql = $mysqli->query("SELECT * FROM veiculos WHERE VEI_PLACA LIKE '%$busca%'");
$count = $sql->num_rows;


// conta quantos registros encontrados com a nossa especificação
if ($count == 0) {
   echo "<center><H2>NENHUM RESULTADO ENCONTRADO!</H2></center>";
} else {
    // senão
    if ($count == 1) {
    echo "1 resultado encontrado!";
}
// se houver um resultado diz que existe um resultado
if ($count > 1) {
    echo "$count resultados encontrados!";
}
// se houver mais de um resultado diz quantos resultados existem
while ($dados = mysqli_fetch_array($sql)) {
    // enquanto houverem resultados...
  $entrada="vei_entrada2.php?cod=".$dados ['VEI_CODIGO'];
  $nome="veiculo.php?cod=".$dados['VEI_CODIGO'];
  echo "<tr>";
  echo "<td><center>"   . $dados['VEI_DONO'] . "</center></td>";
  echo "<td><center>"   . $dados['VEI_MARCA'] . "</center></td>";
  echo "<td><center>"   . $dados['VEI_MODELO'] . "</center></td>";
  echo "<td><a href=".$nome."><center>"   . $dados['VEI_PLACA'] . "</a></center></td>";
  echo "<td><center>"   . $dados['VEI_COR'] . "</center></td>";
  echo "<td><center>"   . $dados['VEI_ANO'] . "</center></td>";
  echo "<td><center><a href=".$entrada."><center><img src='../imagens/icone_entrada.gif' width=48 height=48/></center></td>";
  echo "</tr>"; 
  } 
  }
  echo "</table></center>";
?>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>

<?php
include '../conexao.php'
?>
<?php
	session_start();
	$busca =$_POST['busca'];

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
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<title>Circulação de Pessoas</title>

</head>
<?php include 'menuexemplo.php' ?> 
<body>
<div id="container">
<div class="alert alert-secondary" align="center">

      <form method="POST" action="busca_mil.php">
      <center>
      <table>
      <tr>
      	<td>
      	 <input type="text" name="busca" id="cod" class="form-control" style="width: 300px;" placeholder="Pesquise pelo nome do militar">
      	</td>
      	<td>
      <input type="submit" value="PESQUISAR" name="" class="btn btn-primary"></center>
      	</td>
      </tr>
      </table>
      </form>
      
  <script language="javascript">
document.getElementById('cod').focus();
</script>
</div>

<center><h3>LISTANDO O RESULTADO DA CONSULTA</h3></center>
<center><table class="table table-striped">
  <tr>
	<th><center>FOTO</center></th>
	<th><center>POSTO/GRAD</center></th>
	<th><center>NOME DE COMPLETO</center></th>
	<th><center>NOME DE GUERRA</center></th>
	<th><center>BATERIA</center></th>
	<th><center>REGISTRAR</center></th>
	</tr>
<?php 
$sql = $mysqli->query("SELECT * FROM militares WHERE MIL_NOME LIKE '%$busca%' AND MIL_SIT>=1");
$count = $sql->num_rows;

// conta quantos registros encontrados com a nossa especificação
if ($count == 0) {
   echo "<center><H2>NENHUM RESULTADO ENCONTRADO!</H2></center>";
} else {
    // senão
    if ($count == 1) {
    echo "1 militar encontrado!";
}
// se houver um resultado diz que existe um resultado
if ($count > 1) {
    echo "$count militares encontrados!";
}
// se houver mais de um resultado diz quantos resultados existem
while ($dados = mysqli_fetch_array($sql)) {
	$saida="mil_entrada.php?cod=".$dados['MIL_CODIGO'];	
	    $nome="militar.php?cod=".$dados['MIL_CODIGO'];
    // enquanto houverem resultados...
    // exibir a coluna nome e a coluna email

        $id = $dados['MIL_CODIGO'];
	$foto=$dados['MIL_FOTO'];
	echo "<tr>";
	echo "<td><center><img src='$foto' width=60 height=80/></center></td>";
	echo "<td><center>" 	. $dados['MIL_POSTGRAD'] . "</center></td>";
	echo "<td><p href=".$nome."><center>" 	. $dados['MIL_NOME'] . "</p></center></td>";
	echo "<td><center>" 	. $dados['MIL_NDG'] . "</center></td>";
	echo "<td><center>" 	. $dados['MIL_BATERIA'] . "</center></td>";
    	//echo "<td><a href=".$saida."><center><img src='../imagens/icone_entrada.gif' width=48 height=48/></a></center></td>";
    	 
    	// $consulta = $mysqli->query('SELECT * FROM `militares` WHERE MIL_SIT>="1" ORDER BY `militares`.`END_COD` ASC');
    	
    	$var = ("SELECT * FROM circ_pessoas_prov WHERE CIR_MIL_CODIGO=$id");
                    $var_query = $mysqli->query($var);
                    if ($var_query->num_rows != 1) {
                        echo "<td><a href=" . $saida . "><center><img src='../imagens/icone_entrada.gif' width=48 height=48/></a></center></td>";
                    } else {
                        echo "<td><a href=" . $saida . "><center><img src='../imagens/icone_saidav.gif' width=48 height=48/></a></center></td>";
                    }
    	
    	//
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

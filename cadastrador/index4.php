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
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">


</head>
<?php include 'menuexemplo.php' ?> 
<body>
<div id="container" align="center">
<center><h4>Codigo de Barras</h4></center>
<center><form method="POST" action="mil_ent_barra.php" id="formlogin" name="formlogin" >
 <input type="text" name="cod" id="cod" />
 </form></center>
 
<!--deixar o cursor piscando para codigo de barras-->
  <script language="javascript">
document.getElementById('cod').focus();
</script>
<h1><center><p class='msg-success'> SAÍDA REGISTRADA!</p></center></h1>
<?php
	//inicia a consulta dos militares cadastrados
     //$consulta = $mysqli->query('SELECT * FROM circulacao_pessoas WHERE `CIR_MIL_CODIGO`>="0" ORDER BY `CIR_ENT` DESC LIMIT 1');
     $consulta = $mysqli->query('SELECT * FROM circulacao_pessoas WHERE `CIR_MIL_CODIGO`>="0" ORDER BY `CIR_CODIGO` DESC LIMIT 1');
	//faz o loop
	while($row = mysqli_fetch_array($consulta)) {
	//cria uma variavel para registrar entrada
	$saida="mil_entrada.php?cod=".$row ['CIR_MIL_CODIGO'];	
	$codigo=$row['CIR_MIL_CODIGO'];
	$data=$row['CIR_ENT'];
	$convertido= date('d/m/y - H:i:s', strtotime("$data"));
	
	 $consulta1 = $mysqli->query("SELECT * FROM militares WHERE MIL_CODIGO='$codigo'");
     $row1 = mysqli_fetch_array($consulta1);
	//cria uma variavel para o caminho da foto
	$foto=$row1['MIL_FOTO'];
	echo $foto;
	echo "    ";
	echo $codigo;
	echo "    ";
	echo $id;
	$nome="militar.php?cod=".$row1['MIL_CODIGO'];?>

	<center><table class="table table-striped">
		<tr>
    <td><center><p class='msg-success'> <?php echo "<img src='$foto' width=160 height=240/>"; ?></p>
	<p class='msg-success'> <?php echo $row1['MIL_POSTGRAD'] ?>
		 <?php echo $row1['MIL_NDG'] ?></p></center></td>

		 <td><center><p class='msg-success'><img src="../imagens1/visto_sai.png" width=160 height=240/></p></center></td>

	<?php } ?>

		</tr>
        <script>
            setTimeout(function(){ 
                var msg = document.getElementsByClassName("msg-success");
                while(msg.length > 0){
                    msg[0].parentNode.removeChild(msg[0]);
                }
            }, 4000);

      setTimeout(function() {
      window.location.href = "index1.php";
      }, 4000);

        </script>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>

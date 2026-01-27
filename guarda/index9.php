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

<title>Circulação de Pessoas</title>
<link rel="stylesheet" href="css/estiloMenu.css">

<div id="container">
</head>
<?php include 'menu.php' ?> 
<body>


<center><h2>Codigo de Barras</h2></center>
<center><form method="POST" action="mil_ent_barra2.php" id="formlogin" name="formlogin" >
 <input type="text" name="cod" id="cod" /><br> <br> 
 </form></center>
 
<!--deixar o cursor piscando para codigo de barras-->
  <script language="javascript">
document.getElementById('cod').focus();
</script>
<h1><center><p class='msg-success'> ENTRADA REGISTRADA!</p></center></h1>
<?php
	//inicia a consulta dos militares cadastrados
     $consulta = $mysqli->query('SELECT * FROM circ_pessoas_prov WHERE `CIR_MIL_CODIGO`>="0" ORDER BY `CIR_ENT` DESC LIMIT 1');
	//faz o loop
	while($row = mysqli_fetch_array($consulta)) {
	//cria uma variavel para registrar entrada
	$saida="mil_entrada.php?cod=".$row ['CIR_MIL_CODIGO'];	
	$codigo=$row['CIR_MIL_CODIGO'];
	$data=$row['CIR_ENT'];
	$convertido= date('d/m/y - H:i:s', strtotime("$data"));
	$consulta1 = $mysqli->query("SELECT * FROM militares WHERE MIL_CODIGO='$codigo'");
	
  	 $consulta1 = $mysqli->query("SELECT * FROM militares WHERE MIL_CODIGO='$codigo'");
    	 $row1 = mysqli_fetch_array($consulta1);
 
  	//cria uma variavel para o caminho da foto	
	$foto=$row1['MIL_FOTO'];
	//echo $foto;
	$nome="militar.php?cod=".$row1['MIL_CODIGO'];?>
	<center><table border=0 width=50%>
	<tr>
    	<td><center><p class='msg-success'> <?php echo "<img src='$foto' width=160 height=240/>"; ?></p>
	<p class='msg-success'> <?php echo $row1['MIL_POSTGRAD'] ?>
	<?php echo $row1['MIL_NDG'] ?></p></center></td>
	<td><center><p class='msg-success'><img src="../imagens1/visto_ent.png" width=160 height=240/></p></center></td>
	<?php } ?>
    </tr>
        <script>
       	  setTimeout(function() {
    	  window.location.href = "mil_cad.php";
          }, 2000);
        </script>
<br>
</body>
 </div>
</html>

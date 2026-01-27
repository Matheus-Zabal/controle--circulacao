<?php
include '../conexao.php'
?>
<?php
	session_start();
	$codigo =$_GET['cod'];
 
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

<title>Inserir veículo</title>
<link rel="stylesheet" href="css/estiloMenu.css">
<link href="css/redmond/jquery-ui-1.10.1.custom.css" rel="stylesheet" />
<!-- Biblioteca padrao do Jquery na pasta js/ -->
<script type="text/javascript" src="js/checkbox.js"></script>
<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>

<script type="text/javascript">
$(document).ready(function(e) {
    $("#datepicker").datepicker({
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sab','Dom'],
        dayNames: ['Domingo','Segunda','Terca','Quarta','Quinta','Sexta','Sabado'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
        monthNames: ['Janeiro','Fevereiro','Marco','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        dateFormat: 'dd/mm/yy',
        nextText: 'Proximo',
        prevText: 'Anterior',
				});
		
});
</script>
<div id="container">
</head>
<?php include 'menu.php' ?> 
<body>
<?php
$sql = $mysqli->query("SELECT * FROM visitantes WHERE VIS_CODIGO='$codigo'");
while ($dados = mysqli_fetch_array($sql)) {
	$vis_codigo=$dados['VIS_CODIGO'];
	$nome=$dados['VIS_NOME'];
	$foto=$dados['VIS_FOTO'];
}
?>

<h3><center>CADASTRO DE VEICULOS</center><h3>
<h4><center>Favor preencher todos os campos.</center><h4>
 <form method="POST" action="insere_vei.php">
 
<center><table  width="800" border=1>
<input size="80"  type="hidden" name="VIS_CODIGO" value="<?php echo $vis_codigo ?>"/>
<input size="80"  type="hidden" name="VEI_FOTO" value="<?php echo $foto ?>"/>

	<tr>
	   <?php echo "<td colspan=2><center><img src='$foto' width=320 height=240/></center></td>" ;?>
	 	</tr>		
		<tr>
	 <th bgcolor="#CCCCCC" scope="row">NOME DO MOTORISTA: </th>
	   <td width="30" ><div ><input size="80"  type="text" name="NOME" value="<?php echo $nome ?>"/></div></td>
	 	</tr>
					<tr>
	 <th bgcolor="#CCCCCC" scope="row">DONO NO DOCUMENTO: </th>
	   <td width="30" ><div ><input size="80"  type="text" name="VEI_DONO" /></div></td>
	 	</tr>
			<tr>
	 <th bgcolor="#CCCCCC" scope="row">PLACA: </th>
	   <td width="30" ><div ><input size="80"  type="text" name="VEI_PLACA" /></div></td>
	 	</tr>		
		<tr>
	 <th bgcolor="#CCCCCC" scope="row">MODELO: </th>
	   <td width="30" ><div ><input size="80"  type="text" name="VEI_MODELO" /></div></td>
	 	</tr
					<tr>
	 <th bgcolor="#CCCCCC" scope="row">RENAVAM: </th>
	   <td width="30" ><div ><input size="80"  type="text" name="VEI_OBS" /></div></td>
	 	</tr>
			<tr>
	 <th bgcolor="#CCCCCC" scope="row">MARCA: </th>
	   <td width="30" ><div ><input size="80"  type="text" name="VEI_MARCA" /></div></td>
	 	</tr>
			
		<tr>
	 <th bgcolor="#CCCCCC" scope="row">ANO: </th>
	   <td width="30" ><div ><input size="80"  type="text" name="VEI_ANO" /></div></td>
	 	</tr>
					<tr>
	 <th bgcolor="#CCCCCC" scope="row">COR: </th>
	   <td width="30" ><div ><input size="80"  type="text" name="VEI_COR" /></div></td>
	 	</tr>
	</form>
	</table></center>
	<BR>
	<center><button type ="submit" name="enviar" >INSERIR VEÍCULO</button></center>
		
<br>
</body>
</div>
</html>

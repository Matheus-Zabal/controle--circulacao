<?php
include '../conexao.php'
?>
<?php
	session_start();
	$codigo =$_GET['cod'];
 
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

<title>Inserir veículo</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
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
</head>
<?php include 'menuexemplo.php' ?> 
<body>
<?php
$sql = $mysqli->query("SELECT * FROM visitantes WHERE VIS_CODIGO='$codigo'");
while ($dados = mysqli_fetch_array($sql)) {
	$vis_codigo=$dados['VIS_CODIGO'];
	$nome=$dados['VIS_NOME'];
	$foto=$dados['VIS_FOTO'];
}
?>
<div id="container" align="center">
<div class="alert alert-secondary" role="alert">
<h4><center>CADASTRO DE VEICULOS</center><h4>
<h5><center>Favor preencher todos os campos.</center><h5>
</div>

<div class="w-50 p-3">
 <form method="POST" action="insere_vei.php">
 <div class="form-group">
<center>
<table class="table table-striped">
<input size="60"  type="hidden" name="VIS_CODIGO" value="<?php echo $vis_codigo ?>"/>
<input size="60"  type="hidden" name="VEI_FOTO" value="<?php echo $foto ?>"/>
	<tr>
	   <?php echo "<td colspan=2><center><img src='$foto' width=320 height=240/></center></td>" ;?>
	 	</tr>		
		<tr>
	 <th scope="row">NOME DO MOTORISTA: </th>
	   <td><div ><input size="60"  type="text" readonly="readonly" name="NOME" class="form-control" value="<?php echo $nome ?>"/></div></td>
	 	</tr>
					<tr>
	 <th scope="row">DONO NO DOCUMENTO: </th>
	   <td><div ><input size="60"  type="text" class="form-control" name="VEI_DONO" style="text-transform: uppercase;"/></div></td>
	 	</tr>
			<tr>
	 <th scope="row">PLACA: </th>
	   <td><div ><input size="60"  type="text" class="form-control" name="VEI_PLACA" /></div></td>
	 	</tr>		
		<tr>
	 <th scope="row">MODELO: </th>
	   <td><div ><input size="60"  type="text" class="form-control" name="VEI_MODELO" style="text-transform: uppercase;"/></div></td>
	 	</tr
					<tr>
	 <th scope="row">RENAVAM: </th>
	   <td><div ><input size="60"  type="text" class="form-control" name="VEI_OBS" /></div></td>
	 	</tr>
			<tr>
	 <th scope="row">MARCA: </th>
	   <td><div ><input size="60"  type="text" class="form-control" name="VEI_MARCA" style="text-transform: uppercase;"/></div></td>
	 	</tr>
			
		<tr>
	 <th scope="row">ANO: </th>
	   <td><div ><input size="60"  type="text" class="form-control" name="VEI_ANO" /></div></td>
	 	</tr>
					<tr>
	 <th scope="row">COR: </th>
	   <td><div ><input size="60"  type="text" class="form-control" name="VEI_COR" style="text-transform: uppercase;"/></div></td>
	 	</tr>
	</table>
	</center>
	<center>
	<button type ="submit" name="enviar" class="btn btn-primary btn-lg">INSERIR VEÍCULO</button>
	</div>
	</form>
	</center>
	</div>	
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>

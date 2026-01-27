<?php
include '../conexao.php'
?>
<?php
	session_start();
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

<title>Circulação de Pessoas</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<!-- Biblioteca padrao do Jquery na pasta js/ -->
<script type="text/javascript" src="js/checkbox.js"></script>
<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>

</head>
<?php include 'menuexemplo.php' ?> 

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
<body>
<div id="container" align="center">
<div class="alert alert-info" role="alert">
<h3><center>CADASTRO DE VISITANTES</center><h3>
<h4><center>Favor preencher o máximo de campos.</center><h4>
</div>
<div class="w-50 p-3">
 <form method="POST" enctype="multipart/form-data" action="insere_civil.php">
 <div class="form-group">
<center><table class="table table-striped">
			<tr>
	 <th scope="row">NOME COMPLETO: </th>
	   <td><div ><input size="60"  type="text" name="VIS_NOME" class="form-control"/></div></td>
	 	</tr>
				<tr>
	 <th scope="row">IDENTIDADE: </th>
	   <td><div ><input size="60"  type="text" name="VIS_RG" class="form-control"/></div></td>
	 	</tr>
		<tr>
	 <th scope="row">CPF: </th>
	   <td><div ><input size="60"  type="text" name="VIS_CPF" class="form-control"/></div></td>
	 	</tr>
			<tr>
	 <th scope="row">DATA NASCIMENTO: </th>
	   <td><div > <input type="text" name="VIS_DATANASC" id="datepicker" value="" class="form-control"/></div></td>
	 	</tr>

  	<tr>
	 <th scope="row">EMPRESA: </th>
	   <td><div ><input size="60"  type="text" name="VIS_EMPRESA" class="form-control"/></div></td>
	 	</tr>
  	<tr>
	 <th scope="row">ENDEREÇO: </th>
	    <td><div ><input size="60"  type="text" name="VIS_ENDERECO" class="form-control"/></div></td>
	 	</tr>
		<tr>
	 <th scope="row">NR: </th>
	    <td><div ><input size="60"  type="text" name="VIS_NR" class="form-control"/></div></td>
	 	</tr>
		<tr>
	 <th scope="row">COMPLEMENTO: </th>
	    <td><div ><input size="60"  type="text" name="VIS_COMPLEMENTO" class="form-control"/></div></td>
	 	</tr>
		<tr>
	 <th scope="row">BAIRRO: </th>
	    <td><div ><input size="60"  type="text" name="VIS_BAIRRO" class="form-control"/></div></td>
	 	</tr>
		<tr>
	 <th scope="row">TELEFONE RESIDENCIAL: </th>
	    <td><div ><input size="60"  type="text" name="VIS_TELRES" class="form-control"/></div></td>
	 	</tr>
		<tr>
	 <th scope="row">TELEFONE CELULAR: </th>
	    <td><div ><input size="60"  type="text" name="VIS_TELCEL" class="form-control"/></div></td>
	 	</tr>
		<tr>
   <th scope="row">POSTO/GRAD</th>
   	  <td><div align="left"><select name="VIS_POSTGRAD" class="form-control">
			  <option value="Civil">Civil</option>
			  <option value="Cel">Cel</option>
			  <option value="Ten Cel">Ten Cel</option>
			  <option value="Maj">Maj</option>
			  <option value="Cap">Cap</option>
			  <option value="1º Ten">1º Ten</option>
			  <option value="2º Ten">2º Ten</option>
			  <option value="Asp Of">Asp Of</option>
			  <option value="S Ten">S Ten</option>
			  <option value="1º Sgt">1º Sgt</option>
			  <option value="2º Sgt">2º Sgt</option>
			  <option value="3º Sgt">3º Sgt</option>
			  <option value="Al">Aluno</option>
			  <option value="Cb">Cb</option>
			  <option value="Cb EV">Cb EV</option>
			  <option value="Sd">Sd</option>
			  <option value="Sd EV">Sd EV</option>
			  
 
	</select>
	</tr>
	<tr>
	 <th scope="row">NOME DE GUERRA: </th>
	   <td><div ><input size="60"  type="text" name="VIS_NDG" class="form-control"/></div></td>
	 	</tr>
		<tr>
	 <th scope="row">OM: </th>
	   <td><div ><input size="60"  type="text" name="VIS_OM" class="form-control"/></div></td>
	 	</tr>
   	<tr>
	 <th scope="row">FOTO: <a href="#" onClick='window.open("https://10.26.36.3/camera/","WEBCAM","height=800 width=1000")'>Abrir WEBCAM</a></th>
    <td><div > <input name="arquivo" type="file" /></div></td>
	 	</tr>
   		
	</table></center>
	<center><button type ="submit" name="enviar" class="btn btn-primary btn-lg">INSERIR VISITANTE</button></center>
	</form>
</div>		
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>

<?php
include '../conexao.php'
?>
<?php
	session_start();

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

<title>Inserir Usuarios</title>
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
<h3><center>CADASTRO DE VISITANTES</center><h3>
<h4><center>Favor preencher o máximo de campos.</center><h4>
 <form method="POST" enctype="multipart/form-data" action="insere_civil.php">
<center><table  width="800" border=1>
			<tr>
	 <th bgcolor="#CCCCCC" scope="row">NOME COMPLETO: </th>
	   <td width="30" ><div ><input size="80"  type="text" name="VIS_NOME" /></div></td>
	 	</tr>
				<tr>
	 <th bgcolor="#CCCCCC" scope="row">IDENTIDADE: </th>
	   <td width="30" ><div ><input size="80"  type="text" name="VIS_RG" /></div></td>
	 	</tr>
		<tr>
	 <th bgcolor="#CCCCCC" scope="row">CPF: </th>
	   <td width="30" ><div ><input size="80"  type="text" name="VIS_CPF" /></div></td>
	 	</tr>
			<tr>
	 <th bgcolor="#CCCCCC" scope="row">DATA NASCIMENTO: </th>
	   <td width="30" ><div > <input type="text" name="VIS_DATANASC" value=""/></div></td>
	 	</tr>

  	<tr>
	 <th bgcolor="#CCCCCC" scope="row">EMPRESA: </th>
	   <td width="30" ><div ><input size="80"  type="text" name="VIS_EMPRESA" /></div></td>
	 	</tr>
  	<tr>
	 <th bgcolor="#CCCCCC" scope="row">ENDEREÇO: </th>
	    <td width="30" ><div ><input size="80"  type="text" name="VIS_ENDERECO" /></div></td>
	 	</tr>
		<tr>
	 <th bgcolor="#CCCCCC" scope="row">NR: </th>
	    <td width="30" ><div ><input size="80"  type="text" name="VIS_NR" /></div></td>
	 	</tr>
		<tr>
	 <th bgcolor="#CCCCCC" scope="row">COMPLEMENTO: </th>
	    <td width="30" ><div ><input size="80"  type="text" name="VIS_COMPLEMENTO" /></div></td>
	 	</tr>
		<tr>
	 <th bgcolor="#CCCCCC" scope="row">BAIRRO: </th>
	    <td width="30" ><div ><input size="80"  type="text" name="VIS_BAIRRO" /></div></td>
	 	</tr>
		<tr>
	 <th bgcolor="#CCCCCC" scope="row">TELEFONE RESIDENCIAL: </th>
	    <td width="30" ><div ><input size="80"  type="text" name="VIS_TELRES" /></div></td>
	 	</tr>
		<tr>
	 <th bgcolor="#CCCCCC" scope="row">TELEFONE CELULAR: </th>
	    <td width="30" ><div ><input size="80"  type="text" name="VIS_TELCEL" /></div></td>
	 	</tr>
		<tr>
   <th width="30" bgcolor="#CCCCCC" scope="row">POSTO/GRAD</th>
   	  <td><div align="left"><select name="VIS_POSTGRAD">
                          <option value=""></option>
 			  <option value="Civil"></option>
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
	 <th bgcolor="#CCCCCC" scope="row">NOME DE GUERRA: </th>
	   <td width="30" ><div ><input size="80"  type="text" name="VIS_NDG" /></div></td>
	 	</tr>
		<tr>
	 <th bgcolor="#CCCCCC" scope="row">OM: </th>
	   <td width="30" ><div ><input size="80"  type="text" name="VIS_OM" /></div></td>
	 	</tr>
   	<tr>
	 <th bgcolor="#CCCCCC" scope="row">FOTO: </th>
    <td width="30" ><div > <input name="arquivo" type="file" /></div></td>
	 	</tr>
   		</form>
	</table></center>
	<BR>
	<center><button type ="submit" name="enviar" >INSERIR VISITANTE</button></center>
		
<br>
</body>
</div>
</html>

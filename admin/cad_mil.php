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
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<title>Circulação de Pessoas</title>

</head>
<?php include 'menuexemplo.php' ?> 
<body>

<div id="container" align="center">
<div class="alert alert-info" role="alert">
<h3><center>CADASTRO DE MILITARES</center><h3>
<h4><center>Favor preencher o máximo de campos.</center><h4>
</div>
 <div class="w-50 p-3">
 <form method="POST" enctype="multipart/form-data" action="insere_mil.php">
  <div class="form-group">
<center>
	<table class="table table-striped">
 	 <tr>
		<th>POSTO/GRAD</th>
		<td><div align="left"><select name="MIL_POSTGRAD">
		<option value="Gen Ex">Gen Ex</option>
		<option value="Gen Div">Gen Div</option>
		<option value="Gen Bda">Gen Bda</option>
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
	 <th>NOME DE GUERRA: </th>
	   <td><div ><input size="60"  type="text" name="MIL_NDG" class="form-control" /></div></td>
	 	</tr>
		<tr>
	 <th>NOME COMPLETO: </th>
	   <td><div ><input size="60"  type="text" name="MIL_NOME" class="form-control" /></div></td>
	 	</tr>
				<tr>
	 <th>IDENTIDADE: </th>
	   <td><div ><input size="60"  type="text" name="MIL_IDT" class="form-control" /></div></td>
	 	</tr>

<tr>
    <th>SU: </th>
    <td><div align="left"><select name="MIL_BATERIA">
    <?php $consulta1 = $mysqli->query("SELECT * FROM su ORDER BY `su` ASC");
          while($row1 = mysqli_fetch_array($consulta1)) { 
               $su =  $row1['su'];
    ?>
               <option value="<?php echo $su ?>"><?php echo $su ?></option>  

    <?php }   ?>
    </select></center></td>
</tr> 
<tr>
	 <th>SEÇÃO: </th>
	    <td><div ><input size="60"  type="text" name="MIL_SECAO" class="form-control"/></div></td>
	 	</tr>

  	<tr>
	 <th>FUNÇÃO: </th>
	    <td><div ><input size="60"  type="text" name="MIL_FUNC" class="form-control" /></div></td>
	 	</tr>
  	<tr>
	 <th>FOTO: <a href="#" onClick='window.open("https://10.26.36.3/camera/","WEBCAM","height=800 width=1000")'>Abrir WEBCAM</a> </th>
    <td><div > <input name="arquivo" type="file" /></div></td>
	 	</tr>
   		</form>
   		</div>
		<center><button type ="submit" name="enviar" class="btn btn-primary btn-lg">INSERIR MILITAR</button></center>
	</table>
	</center>
	<br>
	
	</div>	
	</div>
	<div class="alert alert-info">
    <strong><center>Seção de Informática do 6° Esqd C Mec</strong><br>informatica@6esqdcmec.eb.mil.br</center>
  </div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>

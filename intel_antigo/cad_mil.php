<?php
include '../conexao.php'
?>
<?php
	session_start();
	
// A variavel $SQL pega as variaveis $login e $senha, faz uma pesquisa na tabela usuarios
$sql = $mysqli->query("SELECT * FROM `usuarios` WHERE `USU_LOGIN` = '".$_SESSION['USU_LOGIN']."' AND `USU_SENHA`= '".$_SESSION['USU_SENHA']."' AND `USU_PERFIL` = 'Inteligencia' "); 
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
<h3><center>CADASTRO DE MILITARES</center><h3>
<h4><center>Favor preencher o máximo de campos.</center><h4>
 <form method="POST" enctype="multipart/form-data" action="insere_mil.php">
<center><table  width="800" border=1>
		<tr>
   <th width="30" bgcolor="#CCCCCC" scope="row">POSTO/GRAD</th>
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
	 <th bgcolor="#CCCCCC" scope="row">NOME DE GUERRA: </th>
	   <td width="30" ><div ><input size="80"  type="text" name="MIL_NDG" /></div></td>
	 	</tr>
		<tr>
	 <th bgcolor="#CCCCCC" scope="row">NOME COMPLETO: </th>
	   <td width="30" ><div ><input size="80"  type="text" name="MIL_NOME" /></div></td>
	 	</tr>
				<tr>
	 <th bgcolor="#CCCCCC" scope="row">IDENTIDADE: </th>
	   <td width="30" ><div ><input size="80"  type="text" name="MIL_IDT" /></div></td>
	 	</tr>

<tr>
    <th bgcolor="#CCCCCC" scope="row"><div align="center">SU: </div></th>
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
	 <th bgcolor="#CCCCCC" scope="row">SEÇÃO: </th>
	    <td width="30" ><div ><input size="80"  type="text" name="MIL_SECAO" /></div></td>
	 	</tr>

  	<tr>
	 <th bgcolor="#CCCCCC" scope="row">FUNÇÃO: </th>
	    <td width="30" ><div ><input size="80"  type="text" name="MIL_FUNC" /></div></td>
	 	</tr>
  	<tr>
	 <th bgcolor="#CCCCCC" scope="row">FOTO: </th>
    <td width="30" ><div > <input name="arquivo" type="file" /></div></td>
	 	</tr>
   		</form>
	</table></center>
	<BR>
	<center><button type ="submit" name="enviar" >INSERIR MILITAR</button></center>
		
<br>
</body>
</div>
</html>

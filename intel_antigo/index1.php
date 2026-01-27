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
<META http-equiv=Content-Type content="text/html; charset=iso-8859-1">
<meta http-equiv="refresh" content="300">
<title>Circulação de Pessoas</title>
<link rel="stylesheet" href="css1/estiloMenu.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
 <script src="../tabela/jquery.min.js"></script>
      <link rel="stylesheet" href="../tabela/jquery.dataTables.min.css">
      <script src="../tabela/jquery.dataTables.min.js"></script>
      <link rel="stylesheet" href="../tabela/bootstrap.min.css">
      <link rel="stylesheet" href="../tabela/dataTables.bootstrap.min.css">
       <script>
	    $(document).ready(function(){
		    $('#id_da_tabela').DataTable({
                     "iDisplayLength": 25,
		    	"language": {
		               "sEmptyTable": "Nenhum registro encontrado",
					    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
					    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
					    "sInfoFiltered": "(Filtrados de _MAX_ registros)",
					    "sInfoPostFix": "",
					    "sInfoThousands": ".",
					    "sLengthMenu": "_MENU_ resultados por página",
					    "sLoadingRecords": "Carregando...",
					    "sProcessing": "Processando...",
					    "sZeroRecords": "Nenhum registro encontrado",
					    "sSearch": "Pesquisar",
					    "oPaginate": {
					        "sNext": "Próximo",
					        "sPrevious": "Anterior",
					        "sFirst": "Primeiro",
					        "sLast": "Último"
        
    }
			   },
		"order": [[ 0, "desc" ]],

		    });
		});
	    </script>




<div id="container">
<?php include 'menu.php' ?> 
<body>
<center><h2>MILITARES NA OM</h2></center>
<center><table class="table table-bordered table-hover" id="id_da_tabela">
<thead>
  <tr>
	<th bgcolor="#CCCCCC" width=4%><center>FOTO</center></th>
	<th bgcolor="#CCCCCC" width=5%><center>POSTO/GRAD</center></th>
	<th bgcolor="#CCCCCC" width=20%><center>NOME DE GUERRA</center></th>
	<th bgcolor="#CCCCCC" width=10%><center>SEÇÃO</center></th>
	<th bgcolor="#CCCCCC" width=20%><center>ENTRADA</center></th>
	</tr>
    </thead>
  	<tbody>
<?php
	//inicia a consulta dos militares cadastrados
	$consulta = $mysqli->query("SELECT * FROM circ_pessoas_prov WHERE `CIR_MIL_CODIGO`>='0' ORDER BY `END_COD` ASC");
	//faz o loop
	while($row = mysqli_fetch_array($consulta)) {
	//cria uma variavel para registrar entrada
	$saida="mil_entrada1.php?cod=".$row ['CIR_MIL_CODIGO'];	
	$codigo=$row['CIR_MIL_CODIGO'];
	$data=$row['CIR_ENT'];
	$convertido= date('d/m/y - H:i:s', strtotime("$data"));
	
	 $consulta1 = $mysqli->query("SELECT * FROM militares WHERE MIL_CODIGO='$codigo'");
     $row1 = mysqli_fetch_array($consulta1);
	 //cria uma variavel para o caminho da foto	
	$foto=$row1['MIL_FOTO'];
	$nome="militar.php?cod=".$row1['MIL_CODIGO'];
	echo "<tr>";
	echo "<td><center><img src='$foto' width=30 height=40/></center></td>";
	echo "<td><center>" 	. $row1['MIL_POSTGRAD'] . "</center></td>";
	echo "<td><a href=".$nome." target=_blank><center>" 	. $row1['MIL_NDG'] . "</a></center></td>";
	echo "<td><center>" 	. $row1['MIL_SECAO'] . "</center></td>";
	echo "<td><center>$convertido</center></td>";
	
	echo "</tr>"; 
	}
	?>
	</tbody>
	</table></center>
<br>
</body>
 </div>
</html>

<?php
include '../conexao.php'
?>
<?php
	session_start();
	


// A variavel $SQL pega as variaveis $login e $senha, faz uma pesquisa na tabela usuarios
$sql = $mysqli->query("SELECT * FROM `usuarios` WHERE `USU_LOGIN` = '".$_SESSION['USU_LOGIN']."' AND `USU_SENHA`= '".$_SESSION['USU_SENHA']."' AND `USU_PERFIL` = 'Inteligencia' "); 
/* Logo abaixo temos um bloco com if e else, verificando se a variavel $SQL foi bem sucedida, ou seja se ela estiver encontrado algum registro identico o seu valor sera igual a 1,
 se nao, se nao tiver registros seu valor sera 0. Dependendo do resultado ele redirecionara para a pagina direciona.php
 ou retornara para a pagina do formulario inicial para que se possa tentar novamente realizar o login */
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
<title>Circulação de Pessoas</title>
<link rel="stylesheet" href="css/estiloMenu.css">
<div id="container">
</head>
<META http-equiv=Content-Type content="text/html; charset=iso-8859-1">
<meta http-equiv="refresh" content="30">
<title>Circulação de Pessoas</title>
<link rel="stylesheet" href="css1/estiloMenu.css">
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
</head>
<?php include 'menu.php' ?> 
<body> 	<center><h2>MILITARES CADASTRADOS</h2></center>
<center><table class="table table-bordered table-hover" id="id_da_tabela">
<thead>
  <tr>
	<th bgcolor="#CCCCCC" width=7%><center>FOTO</center></th>
	<th bgcolor="#CCCCCC" width=5%><center>POSTO/GRAD</center></th>
	<th bgcolor="#CCCCCC" width=40%><center>NOME DE COMPLETO</center></th>
	<th bgcolor="#CCCCCC" width=20%><center>NOME DE GUERRA</center></th>
	<th bgcolor="#CCCCCC" width=20%><center>SU</center></th>
	<th bgcolor="#CCCCCC" width=10%><center>SEÇÃO</center></th>
	<th bgcolor="#CCCCCC" width=20%><center>REGISTRAR</center></th>
	</tr>
	   </thead>
  	<tbody>
<?php
//inicia a consulta dos militares cadastrados
$consulta = $mysqli->query('SELECT * FROM `militares` WHERE MIL_SIT>="1" ORDER BY `militares`.`END_COD` ASC');
	//faz o loop
	while($row = mysqli_fetch_array($consulta)) {
	//cria uma variavel para registrar entrada
	$id = $row['MIL_CODIGO'];
     $saida="mil_entrada2.php?cod=".$row['MIL_CODIGO'];
     $nome="militar.php?cod=".$row['MIL_CODIGO'];
		//cria uma variavel para o caminho da foto	
	$foto=$row['MIL_FOTO'];
	echo "<tr>";
	echo "<td><center><img src='$foto' width=30 height=40/></center></td>";
	echo "<td><center>" 	. $row['MIL_POSTGRAD'] . "</center></td>";
	echo "<td><a href=".$nome."><center>" 	. $row['MIL_NOME'] . "</a></center></td>";
	echo "<td><center>" 	. $row['MIL_NDG'] . "</center></td>";
	echo "<td><center>" 	. $row['MIL_BATERIA'] . "</center></td>";
	echo "<td><center>" 	. $row['MIL_SECAO'] . "</center></td>";


	//INSERE OS DADOS NA LISTA DE MILITARES NO QUARTEL
	$var=("SELECT * FROM circ_pessoas_prov WHERE CIR_MIL_CODIGO=$id");
	$var_query = $mysqli->query($var);
	if ($var_query->num_rows !=1) {
	echo "<td><a href=".$saida."><center><img src='../imagens/icone_entrada.gif' width=48 height=48/></a></center></td>";
	echo "</tr>"; 
	} else {
		echo "<td><a href=".$saida."><center><img src='../imagens/icone_saidav.gif' width=48 height=48/></a></center></td>";
		echo "</tr>"; 
	}



	} 
	?>
	</tbody>
	</table></center>



</body>
 </div>
</html>


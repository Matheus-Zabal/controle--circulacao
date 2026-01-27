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
<br>
<div id="container">
<center><h4>RELAÇÃO DE PERMISSIONÁRIOS E PESSOAL DAS OBRAS CADASTRADOS</h4></center>
<center><table class="table table-striped">

 <form method="POST" action="gerar_todos_permissio.php">
        <center><input type="submit" value="GERAR CRACHÁS"></center>
        <center>

  <tr>
	<th><center>FOTO</center></th>
	<th><center>NOME</center></th>
	<th><center>RG</center></th>
	<th><center>LOCAL DE TRABALHO</center></th>
	<th><center>REGISTRAR</center></th>
	<th><center>TODOS<br><input type="checkbox" id="selectAll"></center></th>
	</tr>
<?php

//inicia a consulta dos militares cadastrados
$consulta = $mysqli->query('SELECT * FROM permissionarios WHERE PERM_SIT>=1 ORDER BY `PERM_NOME` ASC');
	//faz o loop
	while($row = mysqli_fetch_array($consulta)) {
	//cria uma variavel para registrar entrada
	$nome="perm.php?cod=".$row['PERM_CODIGO'];
	$entrada="perm_entrada.php?cod=".$row ['PERM_CODIGO'];	
	$foto=$row['PERM_FOTO'];
	echo "<tr>";
	echo "<td><center><img src='$foto' width=60 height=80/></center></td>";
	echo "<td><p href=".$nome."><center>" 	. $row['PERM_NOME'] . "</p></center></td>";
	echo "<td><center>" 	. $row['PERM_IDT'] . "</center></td>";
	echo "<td><center>" 	. $row['PERM_LOCAL'] . "</center></td>";
	//echo "<td><a href=".$entrada."><center><img src='../imagens/icone_entrada.gif' width=48 height=48/></a></center></td>";
	
	$id = $row['PERM_CODIGO'];
	$var = ("SELECT * FROM circ_pessoas_prov WHERE CIR_PERM_CODIGO=$id");
                    $var_query = $mysqli->query($var);
                    if ($var_query->num_rows != 1) {
                        echo "<td><a href=" . $entrada . "><center><img src='../imagens/icone_entrada.gif' width=48 height=48/></a></center></td>";
                    } else {
                        echo "<td><a href=" . $entrada . "><center><img src='../imagens/icone_saidav.gif' width=48 height=48/></a></center></td>";
                    }
    	
    	//
	echo "<td><center><input type=\"checkbox\" class=\"checkbox-permissionario\" value=\"$id\"></center></td>";
	echo "</tr>"; 
	}
	echo "</table></center>";
?>
<input type="hidden" name="permissionarios_selecionados[]" id="permissionariosSelecionados" value="">
</form>


</body>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
 
 <script>
    document.addEventListener('DOMContentLoaded', function () {
        const selectAllCheckbox = document.getElementById('selectAll');
        const checkboxes = document.querySelectorAll('.checkbox-permissionario');
        const permissionariosSelecionadosInput = document.getElementById('permissionariosSelecionados');

        selectAllCheckbox.addEventListener('change', function () {
            checkboxes.forEach(function (checkbox) {
                checkbox.checked = selectAllCheckbox.checked;
            });

            updatePermissionariosSelecionados();
        });

        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('change', function () {
                updatePermissionariosSelecionados();
            });
        });

        function updatePermissionariosSelecionados() {
    const selecionados = Array.from(checkboxes)
        .filter(checkbox => checkbox.checked)
        .map(checkbox => checkbox.value);

    permissionariosSelecionadosInput.value = selecionados.join(',');
    
    console.log("Valor do campo de input hidden:", permissionariosSelecionadosInput.value);
}

    });
</script>
</html>

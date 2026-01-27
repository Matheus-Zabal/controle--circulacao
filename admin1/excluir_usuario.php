<?php
include '../conexao.php'
?>	
<?php
//requer a ID que foi mandada do link excluir
$id =$_REQUEST['id'];
$query = "DELETE FROM usuarios WHERE USU_CODIGO=".$id;
$dados = $mysqli->query ($query);
 header('Location: usuarios.php');
?>

<?php
include '../conexao.php'
?>	
<?php
//requer a ID que foi mandada do link excluir
$id =$_REQUEST['id'];
$query = "DELETE FROM militares WHERE MIL_CODIGO=".$id;
$dados = $mysqli->query ($query);
 header('Location: todos1.php');
?>
<?php
include '../conexao.php'
?>	
<?php
//requer a ID que foi mandada do link excluir
$id =$_REQUEST['cod'];
$query = "DELETE FROM dentista WHERE CODIGO=".$id;
$dados = $mysqli->query ($query);
 header('Location: index.php');
?>
<?php
include '../conexao.php'
?>	
<?php
//requer a ID que foi mandada do link excluir
$id =$_REQUEST['id'];
$query = "DELETE FROM su WHERE id=".$id;
$dados = $mysqli->query ($query);
 header('Location: insere_su.php');
?>

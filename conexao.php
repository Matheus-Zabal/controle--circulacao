<?php
/*$servidor = "localhost";
$usuario = "root";
$senha = "f1r3f0xM4ll3t1831";
$banco = "controle_circulacao";
// Conecta-se ao banco de dados MySQL
$mysqli = new mysqli($servidor, $usuario, $senha, $banco);
// Caso algo tenha dado errado, exibe uma mensagem de erro
if (mysqli_connect_errno()) trigger_error(mysqli_connect_error());
*/

$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "controle_circulacao";

// Conecta-se ao banco de dados MySQL
$mysqli = new mysqli($servidor, $usuario, $senha, $banco);

// Caso algo tenha dado errado, exibe uma mensagem de erro
if ($mysqli->connect_errno) {
    trigger_error($mysqli->connect_error);
}


?>

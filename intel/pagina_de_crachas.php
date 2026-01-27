<?php
include '../conexao.php';
session_start();

// Verificar se o usuário tem permissão
$sql = $mysqli->query("SELECT * FROM `usuarios` WHERE `USU_LOGIN` = '" . $_SESSION['USU_LOGIN'] . "' AND `USU_SENHA` = '" . $_SESSION['USU_SENHA'] . "' AND `USU_PERFIL` = 'Convencional' ");
if ($sql->num_rows != 1) {
    session_destroy();
    echo "<script language='javascript' type='text/javascript'>alert('ALGO ESTÁ ERRADO, O SENHOR NÃO PODE ESTAR NESTA PÁGINA');window.location.href='../index.php';</script>";
    exit;
}

// Inicie a tabela para listar os militares
echo '<html>';
echo '<head>';
echo '<title>Imprimir Crachás de Militares</title>';
echo '</head>';
echo '<body>';
echo '<h1>Imprimir Crachás de Militares</h1>';

echo '<table>';
echo '<tr>';
echo '<th>FOTO</th>';
echo '<th>POSTO/GRAD</th>';
echo '<th>NOME COMPLETO</th>';
echo '<th>NOME DE GUERRA</th>';
echo '<th>IMPRIMIR CRACHÁ</th>';
echo '</tr>';

// Consulta os militares
$consulta = $mysqli->query('SELECT * FROM `militares` WHERE MIL_SIT = "1" ORDER BY `militares`.`END_COD` ASC');

while ($row = mysqli_fetch_array($consulta)) {
    echo '<tr>';
    echo '<td><center><img src="' . $row['MIL_FOTO'] . '" width="36" height="48"/></center></td>';
    echo '<td><center>' . $row['MIL_POSTGRAD'] . '</center></td>';
    echo '<td><center>' . $row['MIL_NOME'] . '</center></td>';
    echo '<td><center>' . $row['MIL_NDG'] . '</center></td>';
    echo '<td><center><a href="gerar_cracha.php?cod=' . $row['MIL_CODIGO'] . '">Imprimir Crachá</a></center></td>';
    echo '</tr>';
}

echo '</table>';

// Adicione um botão para imprimir a lista de militares
echo '<button onclick="window.print()" style="margin: 20px;">Imprimir Lista de Militares</button>';

echo '</body>';
echo '</html>';
?>


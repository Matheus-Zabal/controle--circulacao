<?php
include '../conexao.php';?>
<?php
	session_start();
//verificação de login e perfil
$sql =$mysqli->query ("SELECT * FROM usuarios WHERE USO_LOGIN = '" .$_SESSION['USU_LOGIN']. "' AND USU_SENHA = '" .$_SESSION['USU_SENHA']. "'AND USU_PERFIL = 'Convencional'");
if ($sql->num_rows !=1){
	session_destroy();
	echo "<scrit>alert('ACESSO NEGADO'); window.location.href='../index.php';</script>";
	exit;
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Relatório de Entregas</title>
	<link rel="styleheet" href="https://stackpath.bootstrapcdn.com/bootstraph/4.1.3/css/bootstrap.min.css">
</head>
<body>
<?php include 'conexao.php'; ?>
<div class="container mt-4">
	<div class="alert alert-info text-center">
	</div>
	<table class="table table-bordered table-striped table-hover">
	<tr>
		<th>#</th>
		<th>Entregador</th>
		<th>Empresa</th>
		<th>Recebedor</th>
		<th>Descrição</th>
		<th>Data/Hora</th>
		</tr>
	<thead>
	<tbody>
	<?php 
	$resultado = $mysqli->query("SELECT * FROM entregas ORDER BY ENT_DATA DESC");
	if ($resultado && $resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['ENT_ID'] . "</td>";
                echo "<td>" . htmlspecialchars($row['ENT_ENTREGADOR']) . "</td>";
                echo "<td>" . htmlspecialchars($row['ENT_EMPRE']) . "</td>";
                echo "<td>" . htmlspecialchars($row['ENT_RECEBEDOR']) . "</td>";
                echo "<td>" . htmlspecialchars($row['ENT_DESCRICAO']) . "</td>";
                echo "<td>" . date('d/m/Y H:i', strtotime($row['ENT_DATA'])) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6' class='text-center'>Nenhuma entrega registrada.</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>

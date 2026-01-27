
<?php
include '../conexao.php';
session_start();

// Verificação de login e perfil (igual seu sistema atual)
$sql = $mysqli->query("SELECT * FROM `usuarios` WHERE `USU_LOGIN` = '".$_SESSION['USU_LOGIN']."' AND `USU_SENHA`= '".$_SESSION['USU_SENHA']."' AND `USU_PERFIL` = 'Administrador' ");
if ($sql->num_rows != 1) {
    session_destroy();
    echo "<script>alert('ALGO ESTA ERRADO, O SENHOR NO PODE ESTAR NESTA PAGINA'); window.location.href='../index.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Entregas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>
<body>
<?php include 'menuexemplo.php'; ?>
<div class="container mt-4">
    <div class="alert alert-info text-center">
        <h3>Cadastro de Entregas</h3>
    </div>
    <form method="POST" action="inserir_entrega.php">
        <div class="form-group">
            <label>Quem Entregou:</label>
            <input type="text" name="ENT_ENTREGADOR" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Quem Recebeu:</label>
            <input type="text" name="ENT_RECEBEDOR" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Descrição da Entrega:</label>
            <textarea name="ENT_DESCRICAO" class="form-control" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Cadastrar Entrega</button>
    </form>
</div>
</body>
</html>


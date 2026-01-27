<?php
include '../conexao.php';
?>
<?php
session_start();

$sql = $mysqli->query("SELECT * FROM `usuarios` WHERE `USU_LOGIN` = '" . $_SESSION['USU_LOGIN'] . "' AND `USU_SENHA` = '" . $_SESSION['USU_SENHA'] . "' AND `USU_PERFIL` = 'Administrador' ");
if ($sql->num_rows != 1) {
    session_destroy();
    echo "<script language='javascript' type='text/javascript'>alert('ALGO ESTÁ ERRADO, O SENHOR NÃO PODE ESTAR NESTA PÁGINA');window.location.href='../index.php';</script>";
    exit;
}
?>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Circulação de Pessoas</title>
</head>
<?php include 'menuexemplo.php' ?>
<body>

<div id="container" align="center">
    <div class="alert alert-secondary" align="center">
        <form method="POST" action="busca_mil.php">
            <center>
                <table>
                    <tr>
                        <td>
                            <input type="text" name="busca" id="cod" class="form-control" style="width: 300px;"
                                   placeholder="Pesquise pelo nome do militar">
                        </td>
                        <td>
                            <input type="submit" value="PESQUISAR" name="" class="btn btn-primary"></center>
                        </td>
                    </tr>
                </table>
        </form>

        <script language="javascript">
            document.getElementById('cod').focus();
        </script>
    </div>
    <center><h5>RELAÇÃO DE MILITARES CADASTRADOS</h5></center>
    <form method="POST" action="gerar_todos_crachas.php">
        <center><input type="submit" value="GERAR CRACHÁS"></center>
        <center>
            <table class="table table-striped">
                <tr>
                    <th><center>FOTO</center></th>
                    <th><center>POSTO/GRAD</center></th>
                    <th><center>NOME DE COMPLETO</center></th>
                    <th><center>NOME DE GUERRA</center></th>
                    <th><center>SEÇÃO</center></th>
                    <th><center>REGISTRAR</center></th>
                    <th><center>TODOS<br><input type="checkbox" id="selectAll"></center></th>
                </tr>
                <?php
                $consulta = $mysqli->query('SELECT * FROM `militares` WHERE MIL_SIT>="1" ORDER BY `militares`.`END_COD` ASC');
                while ($row = mysqli_fetch_array($consulta)) {
                    $id = $row['MIL_CODIGO'];
                    $saida = "mil_entrada2.php?cod=" . $row['MIL_CODIGO'];
                    $nome = "militar.php?cod=" . $row['MIL_CODIGO'];
                    $foto = $row['MIL_FOTO'];
                    echo "<tr>";
                    echo "<td><center><img src='$foto' width=36 height=48/></center></td>";
                    echo "<td><center>" . $row['MIL_POSTGRAD'] . "</center></td>";
                    echo "<td><a href=" . $nome . "><center>" . $row['MIL_NOME'] . "</a></center></td>";
                    echo "<td><center>" . $row['MIL_NDG'] . "</center></td>";
                    echo "<td><center>" . $row['MIL_SECAO'] . "</center></td>";
                    $var = ("SELECT * FROM circ_pessoas_prov WHERE CIR_MIL_CODIGO=$id");
                    $var_query = $mysqli->query($var);
                    if ($var_query->num_rows != 1) {
                        echo "<td><a href=" . $saida . "><center><img src='../imagens/icone_entrada.gif' width=48 height=48/></a></center></td>";
                    } else {
                        echo "<td><a href=" . $saida . "><center><img src='../imagens/icone_saidav.gif' width=48 height=48/></a></center></td>";
                    }
                    echo "<td><center><input type=\"checkbox\" class=\"checkbox-militar\" value=\"$id\"></center></td>";
                    echo "</tr>";
                }
                echo "</table></center>";
                ?>
                
                <input type="hidden" name="militares_selecionados[]" id="militaresSelecionados" value="">
</form>

</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const selectAllCheckbox = document.getElementById('selectAll');
        const checkboxes = document.querySelectorAll('.checkbox-militar');
        const militaresSelecionadosInput = document.getElementById('militaresSelecionados');

        selectAllCheckbox.addEventListener('change', function () {
            checkboxes.forEach(function (checkbox) {
                checkbox.checked = selectAllCheckbox.checked;
            });

            updateMilitaresSelecionados();
        });

        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('change', function () {
                updateMilitaresSelecionados();
            });
        });

        function updateMilitaresSelecionados() {
    const selecionados = Array.from(checkboxes)
        .filter(checkbox => checkbox.checked)
        .map(checkbox => checkbox.value);

    militaresSelecionadosInput.value = selecionados.join(',');
    
    console.log("Valor do campo de input hidden:", militaresSelecionadosInput.value);
}

    });
</script>

</body>
</html>


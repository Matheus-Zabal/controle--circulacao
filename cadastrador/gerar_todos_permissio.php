<?php
include '../conexao.php';
session_start();

// Verifica se o usuário está logado como 'Convencional'
$sql = $mysqli->query("SELECT * FROM `usuarios` WHERE `USU_LOGIN` = '" . $_SESSION['USU_LOGIN'] . "' AND `USU_SENHA`= '" . $_SESSION['USU_SENHA'] . "' AND `USU_PERFIL` = 'Convencional' ");

if ($sql->num_rows != 1) {
    session_destroy();
    echo "<script language='javascript' type='text/javascript'>alert('ALGO ESTÁ ERRADO, VOCÊ NÃO DEVE ESTAR NESTA PÁGINA');window.location.href='../index.php';</script>";
    exit;
}
?>

<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Circulação de Pessoas</title>
    <link rel="stylesheet" href="css/estiloMenu.css">
    <style>
        .conteudo {
            display: inline-block;
            margin: 10px;
            /* Margem entre os crachás */
            border: 2px solid #e0e0e0;
            width: 300px;
            height: 456px;
            text-align: center;
            /* Centraliza o conteúdo */
            background-image: url('imagens/fundo.jpg');
            /* Define a imagem de fundo */
            background-size: cover;
            /* Faz a imagem cobrir todo o card */
        }
    </style>
</head>

<body>
    <?php
    /// Retrieve selected military IDs
    $permissionariosSelecionados = isset($_POST['permissionarios_selecionados']) ? $_POST['permissionarios_selecionados'] : array();

    // Convert the array of IDs to a comma-separated string
    $permissionariosSelecionadosString = implode(',', $permissionariosSelecionados);

    // Use the selected IDs in your SQL query
    $consulta = $mysqli->query('SELECT * FROM permissionarios WHERE PERM_CODIGO IN (' . $permissionariosSelecionadosString . ')');

    $crachas_por_folha = 2; // Quantidade de crachás por folha
    $cracha_contador = 0;

    while ($row = mysqli_fetch_array($consulta)) {
        $code = $row['PERM_CODBAR'];
        $imagem = $row['PERM_FOTO'];
        $nome = $row['PERM_NOME'];

        if ($cracha_contador % $crachas_por_folha == 0) {
            // Abre uma nova linha de crachás
            echo "<div class='folha'>";
        }

        echo "<div class='conteudo' id='print'>";
        echo "<center>";
        echo "<table width='100%' border='0'>";
        //echo "<tr><td background='imagens/fundo.jpg'><center><br>";

        $ano = date("Y");
        echo "<br><br><br><B>3º GAC AP</B><br>";
        echo "Permissionários<br>";
        echo "<img src='$imagem' class='rounded' border='2' width='105' height='140'/></p>";
        echo "<strong>$nome</strong></p>";

        //echo "<br>";
        // Gere o código de barras para este crachá
        geraCodigoBarra($code);

        echo "<br></center></td></tr></table></center></div>";

        if (($cracha_contador + 1) % $crachas_por_folha == 0) {
            // Fecha a linha de crachás
            echo "</div>";
        }

        $cracha_contador++;
    }

    // Certifica-se de fechar a última linha de crachás, se necessário
    if ($cracha_contador % $crachas_por_folha != 0) {
        echo "</div>";
    }

    // Função para gerar o código de barras
    // Função para gerar o código de barras
    function geraCodigoBarra($numero)
    {
        $fino = 1.2;
        $largo = 2.4;
        $altura = 60;
        $barcodes = array(
            '00110', '10001', '01001', '11000', '00101',
            '10100', '01100', '00011', '10010', '01010'
        );

        for ($f1 = 9; $f1 >= 0; $f1--) {
            for ($f2 = 9; $f2 >= 0; $f2--) {
                $f = ($f1 * 10) + $f2;
                $texto = '';
                for ($i = 1; $i < 6; $i++) {
                    $texto .= substr($barcodes[$f1], ($i - 1), 1) . substr($barcodes[$f2], ($i - 1), 1);
                }
                $barcodes[$f] = $texto;
            }
        }

        echo '<img src="imagens/p.gif" width="' . $fino . '" height="' . $altura . '" border="0" />';
        echo '<img src="imagens/b.gif" width="' . $fino . '" height="' . $altura . '" border="0" />';
        echo '<img src="imagens/p.gif" width="' . $fino . '" height="' . $altura . '" border="0" />';
        echo '<img src="imagens/b.gif" width="' . $fino . '" height="' . $altura . '" border="0" />';

        $texto = $numero;

        if (strlen($texto) % 2 != 0) {
            $texto = '0' . $texto;
        }

        while (strlen($texto) > 0) {
            $i = round(substr($texto, 0, 2));
            $texto = substr($texto, strlen($texto) - (strlen($texto) - 2), (strlen($texto) - 2));

            if (isset($barcodes[$i])) {
                $f = $barcodes[$i];
            }

            for ($i = 1; $i < 11; $i += 2) {
                if (substr($f, ($i - 1), 1) == '0') {
                    $f1 = $fino;
                } else {
                    $f1 = $largo;
                }
                echo '<img src="imagens/p.gif" width="' . $f1 . '" height="' . $altura . '" border="0">';


                if (substr($f, $i, 1) == '0') {
                    $f2 = $fino;
                } else {
                    $f2 = $largo;
                }
                echo '<img src="imagens/b.gif" width="' . $f2 . '" height="' . $altura . '" border="0">';
            }
        }
        echo '<img src="imagens/p.gif" width="' . $largo . '" height="' . $altura . '" border="0" />';
        echo '<img src="imagens/b.gif" width="' . $fino . '" height="' . $altura . '" border="0" />';
        echo '<img src="imagens/p.gif" width="1" height="' . $altura . '" border="0" />';
    }

    ?>

    <br>
    <!-- Scripts e estilos relacionados ao Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>

<?php

include '../conexao.php';
session_start();

// Validação do perfil do usuário
$sql = $mysqli->query("SELECT * FROM usuarios WHERE USU_LOGIN = '".$_SESSION['USU_LOGIN']."' AND USU_SENHA= '".$_SESSION['USU_SENHA']."' AND USU_PERFIL = 'Administrador'");
if ($sql->num_rows != 1) {
    session_destroy();
    echo "<script>alert('ALGO ESTÁ ERRADO, O SENHOR NÃO PODE ESTAR NESTA PÁGINA'); window.location.href='../index.php';</script>";
    exit;
}

// Captura dos dados do formulário
$MIL_POSTGRAD   = $_POST['MIL_POSTGRAD'];
$MIL_NDG        = $_POST['MIL_NDG'];
$MIL_NOME       = $_POST['MIL_NOME'];
$MIL_IDT        = $_POST['MIL_IDT'];
$MIL_BATERIA    = $_POST['MIL_BATERIA'];
$MIL_SECAO      = $_POST['MIL_SECAO'];
$MIL_FUNC       = $_POST['MIL_FUNC'];
$MIL_CODBAR     = date("YmdHis");
$MIL_DATACADASTRO = date("Y-m-d");

// Mapeamento de código do posto/graduação
$postos = [
    'Gen Ex' => 1, 'Gen Div' => 2, 'Gen Bda' => 3, 'Cel' => 4,
    'Ten Cel' => 5, 'Maj' => 6, 'Cap' => 7, '1º Ten' => 8,
    '2º Ten' => 9, 'Asp Of' => 10, 'S Ten' => 11, '1º Sgt' => 12,
    '2º Sgt' => 13, '3º Sgt' => 14, 'Al' => 15, 'Cb' => 16,
    'Cb EV' => 17, 'Sd' => 18, 'Sd EV' => 19
];

$CODIGO = $postos[$MIL_POSTGRAD] ?? 0;

// Verifica se um arquivo foi enviado
if (isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] === UPLOAD_ERR_OK) {
    $arquivo_tmp = $_FILES['arquivo']['tmp_name'];

    if (!file_exists($arquivo_tmp)) {
        die("Erro: Arquivo temporário não encontrado.");
    }

    if (filesize($arquivo_tmp) == 0) {
        die("Erro: O arquivo está vazio.");
    }

    $info = @getimagesize($arquivo_tmp);
    if ($info === false) {
        die("Erro: O conteúdo do arquivo não é uma imagem válida.");
    }

    // Redimensionamento com GD
    $largura = 240;
    $altura = 320;
    $destino = '../imagens/' . uniqid() . '.jpg';

    $imagemOrig = imagecreatefromstring(file_get_contents($arquivo_tmp));
    $imagemNova = imagecreatetruecolor($largura, $altura);

    imagecopyresampled(
        $imagemNova, $imagemOrig,
        0, 0, 0, 0,
        $largura, $altura,
        $info[0], $info[1]
    );

    imagejpeg($imagemNova, $destino);
    imagedestroy($imagemOrig);
    imagedestroy($imagemNova);

    // Inserção no banco
    $query = "INSERT INTO militares (
        MIL_NOME, MIL_NDG, MIL_POSTGRAD, MIL_BATERIA, MIL_SIT,
        MIL_IDT, END_COD, MIL_SECAO, MIL_FUNC, MIL_DATACADASTRO,
        MIL_FOTO, MIL_CODBAR
    ) VALUES (
        '$MIL_NOME', '$MIL_NDG', '$MIL_POSTGRAD', '$MIL_BATERIA', '1',
        '$MIL_IDT', '$CODIGO', '$MIL_SECAO', '$MIL_FUNC', '$MIL_DATACADASTRO',
        '$destino', '$MIL_CODBAR'
    )";

    $mysqli->query($query) or die("Erro ao inserir: " . $mysqli->error);
    echo "<script>alert('MILITAR INSERIDO COM SUCESSO'); window.location.href='cad_mil.php';</script>";
} else {
    // Trata erros de upload
    $erroUpload = $_FILES["arquivo"]["error"];
    switch ($erroUpload) {
        case UPLOAD_ERR_NO_FILE:
            echo "Erro: Nenhum arquivo foi enviado.";
            break;
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            echo "Erro: O arquivo enviado excede o tamanho permitido.";
            break;
        default:
            echo "Erro ao fazer o upload. Código de erro: $erroUpload";
            break;
    }
}
?>

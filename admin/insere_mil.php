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
<!--
include '../conexao.php';
	session_start();
$sql = $mysqli->query("SELECT * FROM `usuarios` WHERE `USU_LOGIN` = '".$_SESSION['USU_LOGIN']."' AND `USU_SENHA`= '".$_SESSION['USU_SENHA']."' AND `USU_PERFIL` = 'Administrador' "); 
 if($sql->num_rows != 1)
		{
	session_destroy();
    echo"<!--<script language='javascript' type='text/javascript'>alert('ALGO ESTA ERRADO, O SENHOR NO PODE ESTAR NESTA PAGINA');window.location.href='../index.php';</script>";  
	exit;
	}

$MIL_POSTGRAD = $_POST['MIL_POSTGRAD'];
$MIL_NDG = $_POST['MIL_NDG'];
$MIL_NOME = $_POST['MIL_NOME'];
$MIL_IDT = $_POST['MIL_IDT'];
$MIL_BATERIA=$_POST['MIL_BATERIA'];
$MIL_SECAO=$_POST['MIL_SECAO'];
$MIL_FUNC=$_POST['MIL_FUNC'];
$MIL_CODBAR= date("YmdHis");
$MIL_DATACADASTRO=date("Y-m-d");

switch ($MIL_POSTGRAD) {
		case 'Gen Ex':
		  $CODIGO = 1;
        break;
		case 'Gen Div':
		  $CODIGO = 2;
        break;
		case 'Gen Bda':
		  $CODIGO = 3;
        break;
		case 'Cel':
		 $CODIGO = 4;
        break;
		case 'Ten Cel':
         $CODIGO = 5;
        break;
		case 'Maj':
         $CODIGO = 6;
        break;
	   case 'Cap':
         $CODIGO = 7;
        break;
     
	   case '1º Ten':
         $CODIGO = 8;
        break;
     
	   case '2º Ten':
         $CODIGO = 9;
        break;
     
	   case 'Asp Of':
         $CODIGO = 10;
        break;
       case 'S Ten':
         $CODIGO = 11;
        break;
      case '1º Sgt':
         $CODIGO = 12;
        break;
		 case '2º Sgt':
         $CODIGO = 13;
        break;
		 case '3º Sgt':
         $CODIGO = 14;
        break;
		 case 'Al':
         $CODIGO = 15;
        break; 
		case 'Cb':
         $CODIGO = 16;
		 break; 
		 case 'Cb EV':
         $CODIGO = 17;
        break; 
		case 'Sd':
         $CODIGO = 18;
     	break; 
		case 'Sd EV':
         $CODIGO = 19;
        break;
}
/*echo '<pre>';
print_r($_FILES);
echo '</pre>';
exit;*/

if (isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] === UPLOAD_ERR_OK) {
    $arquivo_tmp = 
    $nome = $_FILES['arquivo']['name'];
    $arquivo_tmp = $_FILES['arquivo']['tmp_name'];
    if (file_exists($arquivo_tmp)) {
        echo "O arquivo temporário existe e será carregado.";
        $info = getimagesize($arquivo_tmp);
        if ($info) {
            echo "<br>Imagem válida. Tipo: " . $info['mime'];
        } else {
            echo "<br>O arquivo não é uma imagem válida.";
        }
    } else {
        echo "O arquivo temporário NÃO existe mais.";
    }
    exit;  // <-- Para testar, interrompe o script aqui
    
    // ... segue o restante do código para processar o upload com WideImage, inserção no banco, etc.
}


    // Verifica se o arquivo tem uma extensão válida
    $extensao = strtolower(strrchr($nome, '.'));
    if (strstr('.jpg;.jpeg;.gif;.png', $extensao)) {
        // Verifica se o arquivo realmente é uma imagem válida
        if (@getimagesize($arquivo_tmp)) {
            require('lib/WideImage.php');

            $novoNome = md5(microtime()) . $extensao;
            $destino = '../imagens/' . $novoNome;

            $arquivo = WideImage::load($arquivo_tmp);
            $arquivo = $arquivo->resize(240, 320);
            $marca = WideImage::load('imagens/gac.gif');
            $marca = $marca->resize(30, 40);
            $arquivo = $arquivo->crop(60, 1, 200, 400);
            $nova_img = $arquivo->merge($marca, 'right', 'bottom', 50);
            $nova_img->saveToFile($destino);

            // Insere no banco
            $query = "INSERT INTO militares (MIL_NOME, MIL_NDG, MIL_POSTGRAD, MIL_BATERIA, MIL_SIT, MIL_IDT, END_COD, MIL_SECAO, MIL_FUNC, MIL_DATACADASTRO, MIL_FOTO, MIL_CODBAR) 
                      VALUES ('$MIL_NOME', '$MIL_NDG', '$MIL_POSTGRAD', '$MIL_BATERIA', '1', '$MIL_IDT', '$CODIGO', '$MIL_SECAO', '$MIL_FUNC', '$MIL_DATACADASTRO', '$destino', '$MIL_CODBAR')";
            $mysqli->query($query) or die($mysqli->error);

            echo "<!--<script language='javascript' type='text/javascript'>alert('MILITAR INSERIDO COM SUCESSO');window.location.href='cad_mil.php';</script>";
        } else {
            echo "O arquivo enviado não é uma imagem válida.";
        }
    } else {
        echo "Você poderá enviar apenas arquivos \"*.jpg;*.jpeg;*.gif;*.png\"<br />";
    }
} else {
    echo "Falha no envio do arquivo. Código do erro: " . $_FILES['arquivo']['error'];
}*/



// verifica se foi enviado um arquivo 
/*if(isset($_FILES['arquivo']['name']) && $_FILES["arquivo"]["error"] == 0){
	//inclui a biblioteca wideimage
	require('lib/WideImage.php');
	$arquivo_tmp = $_FILES['arquivo']['tmp_name'];
	$nome = $_FILES['arquivo']['name'];
		
	
	// Pega a extensao
	$extensao = strrchr($nome, '.');

	// Converte a extensao para mimusculo
	$extensao = strtolower($extensao);

	// Somente imagens, .jpg;.jpeg;.gif;.png
	// Aqui eu enfilero as extesões permitidas e separo por ';'
	// Isso server apenas para eu poder pesquisar dentro desta String
	if(strstr('.jpg;.jpeg;.gif;.png', $extensao))	{
		
		// Cria um nome único para esta imagem
		// Evita que duplique as imagens no servidor.
		$novoNome = md5(microtime()) . $extensao;
		
		// Concatena a pasta com o nome
		$destino = '../imagens/' . $novoNome; 
		
					
		$arquivo = WideImage::load($arquivo_tmp);
		$arquivo = $arquivo->resize(240, 320); //redimensiona a imagem
		$marca = WideImage::load('imagens/gac.gif');//carrega logo do GAC
		$marca = $marca->resize(30, 40); //redimensiona o logo
		$arquivo = $arquivo->crop(60, 1, 200, 400); // Corta a imagem (Argumentos: X1, Y1, X2, Y2)
		$nova_img = $arquivo->merge($marca, 'right', 'bottom', 50); //mescla a foto com a marca d'agua do gac
		$nova_img->saveToFile("$destino"); // para mescar trocas arquivo por nova_img
		
			//insere dados do militar
			$query = "INSERT INTO militares(MIL_NOME, MIL_NDG, MIL_POSTGRAD, MIL_BATERIA, MIL_SIT, MIL_IDT, END_COD, MIL_SECAO, MIL_FUNC, MIL_DATACADASTRO, MIL_FOTO, MIL_CODBAR) 
			          VALUES ('$MIL_NOME', '$MIL_NDG', '$MIL_POSTGRAD', '$MIL_BATERIA', '1', '$MIL_IDT', '$CODIGO', '$MIL_SECAO', '$MIL_FUNC', '$MIL_DATACADASTRO', '$destino', '$MIL_CODBAR')";
			$mysqli->query($query) or die ($mysqli->error);
			echo"<!--<script language='javascript' type='text/javascript'>alert('MILITAR INSERIDO COM SUCESSO');window.location.href='cad_mil.php';</script>-->";
		
	}
	else
		echo "Você poderá enviar apenas arquivos \"*.jpg;*.jpeg;*.gif;*.png\"<br />";
}
else
{
	echo "Você não enviou nenhum arquivo!";
}
?>
<!--include '../conexao.php';
session_start();

// Verificação de sessão segura
if(!isset($_SESSION['USU_LOGIN'])) {
    echo "<script>alert('ACESSO NEGADO: Faça login novamente'); 
          window.location.href='../index.php';</script>";
    exit;
}

// Verificação do usuário admin
$sql = $mysqli->prepare("SELECT 1 FROM usuarios WHERE USU_LOGIN = ? AND USU_SENHA = ? AND USU_PERFIL = 'Administrador'");
$sql->bind_param("ss", $_SESSION['USU_LOGIN'], $_SESSION['USU_SENHA']);
$sql->execute();
if($sql->get_result()->num_rows != 1) {
    session_destroy();
    echo "<script>alert('ACESSO NÃO AUTORIZADO'); 
          window.location.href='../index.php';</script>";
    exit;
}

// Coleta segura dos dados
$dados = [
    'MIL_POSTGRAD' => $_POST['MIL_POSTGRAD'] ?? '',
    'MIL_NDG' => $_POST['MIL_NDG'] ?? '',
    'MIL_NOME' => $_POST['MIL_NOME'] ?? '',
    'MIL_IDT' => $_POST['MIL_IDT'] ?? '',
    'MIL_BATERIA' => $_POST['MIL_BATERIA'] ?? '',
    'MIL_SECAO' => $_POST['MIL_SECAO'] ?? '',
    'MIL_FUNC' => $_POST['MIL_FUNC'] ?? ''
];

// Mapeamento de postos (igual ao seu original)
$postos = [
    'Gen Ex' => 1, 'Gen Div' => 2, 'Gen Bda' => 3,
    'Cel' => 4, 'Ten Cel' => 5, 'Maj' => 6,
    'Cap' => 7, '1º Ten' => 8, '2º Ten' => 9,
    'Asp Of' => 10, 'S Ten' => 11, '1º Sgt' => 12,
    '2º Sgt' => 13, '3º Sgt' => 14, 'Al' => 15,
    'Cb' => 16, 'Cb EV' => 17, 'Sd' => 18, 'Sd EV' => 19
];

$CODIGO = $postos[$dados['MIL_POSTGRAD']] ?? 0;

// Processamento seguro com transação
$mysqli->begin_transaction();

try {
    // 1. Inserir o militar
    $query = "INSERT INTO militares (
                MIL_NOME, MIL_NDG, MIL_POSTGRAD, MIL_BATERIA, 
                MIL_SIT, MIL_IDT, END_COD, MIL_SECAO, 
                MIL_FUNC, MIL_DATACADASTRO, MIL_CODBAR
              ) VALUES (?, ?, ?, ?, '1', ?, ?, ?, ?, ?, ?)";
    
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param(
        "ssssssssss", 
        $dados['MIL_NOME'],
        $dados['MIL_NDG'],
        $dados['MIL_POSTGRAD'],
        $dados['MIL_BATERIA'],
        $dados['MIL_IDT'],
        $CODIGO,
        $dados['MIL_SECAO'],
        $dados['MIL_FUNC'],
        date("Y-m-d"),
        date("YmdHis")
    );
    
    if(!$stmt->execute()) {
        throw new Exception("Erro ao inserir militar: " . $stmt->error);
    }

    // 2. Se houver upload de imagem
    if(isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] == 0) {
        require('lib/WideImage.php');
        
        $ext = strtolower(pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION));
        if(!in_array($ext, ['jpg', 'jpeg', 'gif', 'png'])) {
            throw new Exception("Formato de imagem inválido");
        }

        $novoNome = md5(uniqid()) . '.' . $ext;
        $destino = '../imagens/' . $novoNome;

        // Processamento da imagem (igual ao seu original)
        $img = WideImage::load($_FILES['arquivo']['tmp_name'])
               ->resize(240, 320)
               ->crop(60, 1, 200, 400);
        
        $marca = WideImage::load('imagens/gac.gif')->resize(30, 40);
        $img->merge($marca, 'right', 'bottom', 50)->saveToFile($destino);

        // Atualiza o militar com a foto
        $update = $mysqli->prepare("UPDATE militares SET MIL_FOTO = ? WHERE MIL_CODBAR = ?");
        $update->bind_param("ss", $destino, date("YmdHis"));
        $update->execute();
    }

    $mysqli->commit();
    
    // Redirecionamento com mensagem
    echo "<script>
            alert('MILITAR CADASTRADO COM SUCESSO');
            window.location.href = 'cad_mil.php';
          </script>";

} catch (Exception $e) {
    $mysqli->rollback();
    echo "<script>
            alert('ERRO: " . addslashes($e->getMessage()) . "');
            window.history.back();
          </script>";
}*/


?>-->

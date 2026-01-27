<?php
include '../conexao.php';
	session_start();
$sql = $mysqli->query("SELECT * FROM `usuarios` WHERE `USU_LOGIN` = '".$_SESSION['USU_LOGIN']."' AND `USU_SENHA`= '".$_SESSION['USU_SENHA']."' AND `USU_PERFIL` = 'Convencional' "); 
 if($sql->num_rows != 1)
		{
	session_destroy();
    echo"<script language='javascript' type='text/javascript'>alert('ALGO ESTA ERRADO, O SENHOR NO PODE ESTAR NESTA PAGINA');window.location.href='../index.php';</script>";  
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

// verifica se foi enviado um arquivo 
if(isset($_FILES['arquivo']['name']) && $_FILES["arquivo"]["error"] == 0){
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
		$arquivo = $arquivo->resize(320, 240); //redimensiona a imagem
		$marca = WideImage::load('imagens/gac.gif');//carrega logo do GAC
		$marca = $marca->resize(30, 40); //redimensiona o logo
		$arquivo = $arquivo->crop(60, 1, 200, 400); // Corta a imagem (Argumentos: X1, Y1, X2, Y2)
		$nova_img = $arquivo->merge($marca, 'right', 'bottom', 50); //mescla a foto com a marca d'agua do gac
		$nova_img->saveToFile("$destino"); // para mescar trocas arquivo por nova_img
		
			//insere dados do militar
			$query = "INSERT INTO militares(MIL_NOME, MIL_NDG, MIL_POSTGRAD, MIL_BATERIA, MIL_SIT, MIL_IDT, END_COD, MIL_SECAO, MIL_FUNC, MIL_DATACADASTRO, MIL_FOTO, MIL_CODBAR) 
			          VALUES ('$MIL_NOME', '$MIL_NDG', '$MIL_POSTGRAD', '$MIL_BATERIA', '1', '$MIL_IDT', '$CODIGO', '$MIL_SECAO', '$MIL_FUNC', '$MIL_DATACADASTRO', '$destino', '$MIL_CODBAR')";
			$mysqli->query($query) or die ($mysqli->error);
			echo"<script language='javascript' type='text/javascript'>alert('MILITAR INSERIDO COM SUCESSO');window.location.href='cad_mil.php';</script>";
		
	}
	else
		echo "Você poderá enviar apenas arquivos \"*.jpg;*.jpeg;*.gif;*.png\"<br />";
}
else
{
	echo "Você não enviou nenhum arquivo!";
}
?>

<?php
include '../conexao.php';
	session_start();
$sql = $mysqli->query("SELECT * FROM `usuarios` WHERE `USU_LOGIN` = '".$_SESSION['USU_LOGIN']."' AND `USU_SENHA`= '".$_SESSION['USU_SENHA']."' AND `USU_PERFIL` = 'Guarda' "); 
 if($sql->num_rows != 1)
		{
	session_destroy();
    echo"<script language='javascript' type='text/javascript'>alert('ALGO ESTA ERRADO, O SENHOR NO PODE ESTAR NESTA PAGINA');window.location.href='../index.php';</script>";  
	exit;
	}
	
$PERM_NOME = $_POST['PERM_NOME'];
$PERM_IDT = $_POST['PERM_IDT'];
$PERM_LOCAL = $_POST['PERM_LOCAL'];
$PERM_CODIGO=$_POST['PERM_CODIGO'];
$PERM=$_POST['PERM_FOTO'];


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
		$marca = WideImage::load('imagens/3de.gif');//carrega logo do GAC
		$marca = $marca->resize(45, 60); //redimensiona o logo
		$nova_img = $arquivo->merge($marca, 'right', 'bottom', 50); //mescla a foto com a marca d'agua do gac
		$nova_img->saveToFile("$destino"); // para mescar trocas arquivo por nova_img
		
			
		//altera dados do visitante
			$result=$mysqli->query("UPDATE permissionarios SET `PERM_NOME`='$PERM_NOME', `PERM_IDT`='$PERM_IDT', `PERM_LOCAL`='$PERM_LOCAL', `PERM_FOTO`='$destino' WHERE `PERM_CODIGO`='$PERM_CODIGO'");
			echo"<script language='javascript' type='text/javascript'>alert('PERMISSIONÁRIO ALTERADO COM SUCESSO');window.location.href='perm_cad.php';</script>";
		
	}
	else
		echo "Você poderá enviar apenas arquivos \"*.jpg;*.jpeg;*.gif;*.png\"<br />";
}
else
{
		$result=$mysqli->query("UPDATE permissionarios SET `PERM_NOME`='$PERM_NOME', `PERM_IDT`='$PERM_IDT', `PERM_LOCAL`='$PERM_LOCAL' WHERE `PERM_CODIGO`='$PERM_CODIGO'");
			echo"<script language='javascript' type='text/javascript'>alert('PERMISSIONÁRIO ALTERADO COM SUCESSO');window.location.href='perm_cad.php';</script>";
	}
?>

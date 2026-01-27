<?php
include '../conexao.php'
?>
<?php

$PERM_NOME = $_POST['PERM_NOME'];
$PERM_IDT = $_POST['PERM_IDT'];
$PERM_LOCAL= $_POST['PERM_LOCAL'];
$PERM_CODBAR= date("YmdHis");
$PERM_DATACADASTRO=date("Y-m-d");
 $data_sql = implode("-",array_reverse(explode("/",$PERM_DATACADASTRO)));
			
		

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
		$marca = $marca->resize(45, 60); //redimensiona o logo
		$nova_img = $arquivo->merge($marca, 'right', 'bottom', 50); //mescla a foto com a marca d'agua do gac
		$nova_img->saveToFile("$destino"); // para mescar trocas arquivo por nova_img
		
			//insere dados do permissionario
			$query = "INSERT INTO permissionarios(PERM_NOME, PERM_IDT, PERM_LOCAL, PERM_CODBAR, PERM_SIT, PERM_FOTO, PERM_DATACADASTRO) 
			          VALUES ('$PERM_NOME', '$PERM_IDT', '$PERM_LOCAL','$PERM_CODBAR', '1', '$destino', '$data_sql')";
			$mysqli->query($query) or die ($mysqli->error);
			echo"<script language='javascript' type='text/javascript'>alert('PERMISSIONARIO INSERIDO COM SUCESSO');window.location.href='index.php';</script>";
		
	}
	else
		echo "Você poderá enviar apenas arquivos \"*.jpg;*.jpeg;*.gif;*.png\"<br />";
}
else
{
	echo "Você não enviou nenhum arquivo!";
}
?>

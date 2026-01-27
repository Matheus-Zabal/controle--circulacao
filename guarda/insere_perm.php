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
$PERM_LOCAL= $_POST['PERM_LOCAL'];
$PERM_CODBAR= date("YmdHis");
$PERM_DATACADASTRO=date("Y-m-d");
$data_sql = implode("-",array_reverse(explode("/",$PERM_DATACADASTRO)));
	
// verifica se foi enviado um arquivo 
if(isset($_FILES['arquivo']['name']) && $_FILES["arquivo"]["error"] == 0){

	$arquivo_tmp = $_FILES['arquivo']['tmp_name'];
	$nome = $_FILES['arquivo']['name'];
	
		// Pega a extensao
	$extensao = strrchr($nome, '.');

	// Converte a extensao para mimusculo
	$extensao = strtolower($extensao);

	// Somente imagens, .jpg;.jpeg;.gif;.png
	// Aqui eu enfilero as extesões permitidas e separo por ';'
	// Isso server apenas para eu poder pesquisar dentro desta String
	if(strstr('.jpg;.jpeg;.gif;.png', $extensao))
	{
		// Cria um nome único para esta imagem
		// Evita que duplique as imagens no servidor.
		$novoNome = md5(microtime()) . '.' . $extensao;
		
		// Concatena a pasta com o nome
		$destino = '../imagens/' . $novoNome; 
		
		// tenta mover o arquivo para o destino
		if( @move_uploaded_file( $arquivo_tmp, $destino  ))
		{
	
			//insere dados do permissionario
			$query = "INSERT INTO permissionarios(PERM_NOME, PERM_IDT, PERM_LOCAL, PERM_SIT, PERM_FOTO, PERM_DATACADASTRO, PERM_CODBAR) 
			          VALUES ('$PERM_NOME', '$PERM_IDT', '$PERM_LOCAL', '1', '$destino', '$data_sql', '$PERM_CODBAR')";
			$mysqli->query($query) or die ($mysqli->error);
			echo"<script language='javascript' type='text/javascript'>alert('PERMISSIONARIO INSERIDO COM SUCESSO');window.location.href='index.php';</script>";
		}
		else
			echo "Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.<br />";
	}
	else
		echo "Você poderá enviar apenas arquivos \"*.jpg;*.jpeg;*.gif;*.png\"<br />";
}
else
{
	echo "Você não enviou nenhum arquivo!";
}

?>
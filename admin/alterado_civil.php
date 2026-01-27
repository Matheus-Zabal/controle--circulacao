<?php
include '../conexao.php'
?>
<?php
$VIS_POSTGRAD = $_POST['VIS_POSTGRAD'];
$VIS_NDG = $_POST['VIS_NDG'];
$VIS_NOME = $_POST['VIS_NOME'];
$VIS_OM = $_POST['VIS_OM'];
$VIS_RG = $_POST['VIS_RG'];
$VIS_CPF = $_POST['VIS_CPF'];
$VIS_DATANASC = $_POST['VIS_DATANASC'];
$VIS_EMPRESA=$_POST['VIS_EMPRESA'];
$VIS_ENDERECO=$_POST['VIS_ENDERECO'];
$VIS_NR=$_POST['VIS_NR'];
$VIS_COMPLEMENTO=$_POST['VIS_COMPLEMENTO'];
$VIS_BAIRRO=$_POST['VIS_BAIRRO'];
$VIS_TELRES=$_POST['VIS_TELRES'];
$VIS_CODIGO=$_POST['VIS_CODIGO'];
$VIS_FOTO=$_POST['VIS_FOTO'];
$VIS_TELCEL=$_POST['VIS_TELCEL'];
$VIS_CODBAR= date("YmdHsi");
$VIS_DATACADASTRO=date("Y-m-d");
 $data_sql = implode("-",array_reverse(explode("/",$VIS_DATANASC)));


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
	if(strstr('.jpg;.jpeg;.gif;.png', $extensao))	{
		
		// Cria um nome único para esta imagem
		// Evita que duplique as imagens no servidor.
		$novoNome = md5(microtime()) . $extensao;
		
		// Concatena a pasta com o nome
		$destino = 'imagens/' . $novoNome; 
		
		// tenta mover o arquivo para o destino
		if( @move_uploaded_file( $arquivo_tmp, $destino  ))
		{
			
		//altera dados do visitante
			$result=$mysqli->query("UPDATE visitantes SET `VIS_NOME`='$VIS_NOME', `VIS_BAIRRO`='$VIS_BAIRRO', `VIS_OM`='$VIS_OM',`VIS_NDG`='$VIS_NDG', `VIS_POSTGRAD`='$VIS_POSTGRAD', `VIS_RG`='$VIS_RG', `VIS_CPF`='$VIS_CPF', `VIS_EMPRESA`='$VIS_EMPRESA', `VIS_ENDERECO`='$VIS_ENDERECO', `VIS_NUMERO`='$VIS_NR', `VIS_TELRES`='$VIS_TELRES', `VIS_TELCEL`='$VIS_TELCEL', `VIS_COMPLEMENTO`='$VIS_COMPLEMENTO', `VIS_DATANASC`='$VIS_DATANASC', `VIS_FOTO`='$destino' WHERE `VIS_CODIGO`='$VIS_CODIGO'");
			echo"<script language='javascript' type='text/javascript'>alert('VISITANTE ALTERADO COM SUCESSO');window.location.href='civis_cad.php';</script>";
		}
			
		else
			//se der erro dar um chmod na pasta
			echo "Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.<br />";
	}
	else
		echo "Você poderá enviar apenas arquivos \"*.jpg;*.jpeg;*.gif;*.png\"<br />";
}
else
{
			//altera dados do visitante sem foto
			$result=$mysqli->query("UPDATE visitantes SET `VIS_NOME`='$VIS_NOME', `VIS_BAIRRO`='$VIS_BAIRRO', `VIS_OM`='$VIS_OM',`VIS_NDG`='$VIS_NDG', `VIS_POSTGRAD`='$VIS_POSTGRAD', `VIS_RG`='$VIS_RG', `VIS_CPF`='$VIS_CPF', `VIS_EMPRESA`='$VIS_EMPRESA', `VIS_ENDERECO`='$VIS_ENDERECO', `VIS_NUMERO`='$VIS_NR', `VIS_TELRES`='$VIS_TELRES', `VIS_TELCEL`='$VIS_TELCEL', `VIS_COMPLEMENTO`='$VIS_COMPLEMENTO', `VIS_DATANASC`='$VIS_DATANASC' WHERE `VIS_CODIGO`='$VIS_CODIGO'");
			echo"<script language='javascript' type='text/javascript'>alert('VISITANTE ALTERADO COM SUCESSO');window.location.href='civis_cad.php';</script>";
}
?>
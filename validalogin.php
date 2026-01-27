<?php
include 'conexao.php'
?>

<?php 
if (($_POST['USU_LOGIN'] != '') || ($_POST['USU_SENHA'] != ''))
	{
// as variáveis login e senha recebem os dados digitados na página anterior
$USU_LOGIN = $_POST['USU_LOGIN'];
$USU_SENHA = base64_encode($_POST['USU_SENHA']);


// A variavel $SQL pega as variaveis $login e $senha, faz uma pesquisa na tabela usuarios
$sql = $mysqli->query("SELECT * FROM `usuarios` WHERE `USU_LOGIN` = '$USU_LOGIN' AND `USU_SENHA`= '$USU_SENHA'"); 


/* Logo abaixo temos um bloco com if e else, verificando se a variável $SQL foi bem sucedida, ou seja se ela estiver encontrado algum registro idêntico o seu valor será igual a 1,
 se não, se não tiver registros seu valor será 0. Dependendo do resultado ele redirecionará para a pagina direciona.php
 ou retornara para a pagina do formulário inicial para que se possa tentar novamente realizar o login */
 if($sql->num_rows != 1)
		{
		echo"<script language='javascript' type='text/javascript'>alert('LOGIN INVALIDO');window.location.href='index.php';</script>";
		exit;	
		} else {
		// Salva os dados encontados na variável $resultado
			$resultado = mysqli_fetch_assoc($sql);
			// Se a sessão não existir, inicia uma
			if (!isset($_SESSION)) session_start();
			// Salva os dados encontrados na sessão
			$_SESSION['USU_LOGIN'] = $resultado['USU_LOGIN'];
			$_SESSION['USU_SENHA'] = $resultado['USU_SENHA'];
			$_SESSION['USU_PERFIL'] = $resultado['USU_PERFIL'];
			$_SESSION['USU_CODIGO'] = $resultado['USU_CODIGO'];
			//$_SESSION['USU_MIL_CODIGO'] = $resultado['USU_MIL_CODIGO'];
			
			
  // Redireciona o visitante de acordo com o perfil
		  switch ($_SESSION['USU_PERFIL'])
						{
							case "Convencional": header('location: cadastrador/index.php'); 
								//registra o login e o horário que o usuário acessou
									$login= $_SESSION['USU_LOGIN'];
									$query = "INSERT INTO controle_login(login) VALUES ('$login')";
									$mysqli->query($query) or die (mysql_error ());
							break;
							case "Administrador": header('location: admin/index.php'); break;
							case "Inteligencia": header('location: intel/index1.php'); break;
							case "Guarda": header('location: guarda/index1.php'); break;
							 exit;
						}
				}
	}
?>

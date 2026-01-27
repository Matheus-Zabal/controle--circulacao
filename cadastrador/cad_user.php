<?php
include '../conexao.php';
session_start();
$sql = $mysqli->query("SELECT * FROM `usuarios` WHERE `USU_LOGIN` = '".$_SESSION['USU_LOGIN']."' AND `USU_SENHA`= '".$_SESSION['USU_SENHA']."' AND `USU_PERFIL` = 'Convencional' "); 
 if($sql->num_rows != 1)
        {
    session_destroy();
    echo"<script language='javascript' type='text/javascript'>alert('ALGO ESTA ERRADO, O SENHOR NO PODE ESTAR NESTA PAGINA');window.location.href='../index.php';</script>";  
    exit;
$MIL_POSTGRAD = $_POST['MIL_POSTGRAD'];
$MIL_NDG = $_POST['MIL_NDG'];
$MIL_NOME = $_POST['MIL_NOME'];
$MIL_BATERIA=$_POST['MIL_BATERIA'];

switch ($MIL_POSTGRAD) {
		case 'Cel':
		  $CODIGO = 1;
        break;
		case 'TC':
         $CODIGO = 2;
        break;
		
       case 'Maj':
         $CODIGO = 3;
        break;
     
	   case 'Cap':
         $CODIGO = 4;
        break;
     
	   case '1º Ten':
         $CODIGO = 5;
        break;
     
	   case '2º Ten':
         $CODIGO = 6;
        break;
     
	   case 'Asp':
         $CODIGO = 7;
        break;
       case 'ST':
         $CODIGO = 8;
        break;
      case '1º Sgt':
         $CODIGO = 9;
        break;
		 case '2º Sgt':
         $CODIGO = 10;
        break;
		 case '3º Sgt':
         $CODIGO = 11;
        break;
		 case 'Al':
         $CODIGO = 12;
        break; case 'Cb':
         $CODIGO = 13;
        break; case 'Sd':
         $CODIGO = 14;
        break;
		break; case 'Sd EV':
         $CODIGO = 15;
        break;
}

	// Insere os dados
			$query = "INSERT INTO militares(MIL_NOME, MIL_NDG, MIL_POSTGRAD, MIL_BATERIA, MIL_SIT, CODIGO) VALUES ('$MIL_NOME', '$MIL_NDG', '$MIL_POSTGRAD', '$MIL_BATERIA', '1', $CODIGO)";
			$mysqli->query($query) or die ($mysqli->error);
			echo"<script language='javascript' type='text/javascript'>alert('MILITAR INSERIDO COM SUCESSO');window.location.href='index.php';</script>";
 ?>
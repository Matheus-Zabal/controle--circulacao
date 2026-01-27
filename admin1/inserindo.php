<?php
include '../conexao.php'
?>
<?php
$PRO_POSTGRAD = $_POST['PRO_POSTGRAD'];
$PRO_NDG = $_POST['PRO_NDG'];
$PRO_NOME = $_POST['PRO_NOME'];

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
			$query = "INSERT INTO salcgu (PRO_NOME, MIL_NDG, MIL_POSTGRAD, CODIGO) VALUES ('$PRO_NOME', '$PRO_NDG', PRO_POSTGRAD', $CODIGO)";
			$mysqli->query($query) or die ($mysqli->error);
			echo"<script language='javascript' type='text/javascript'>alert('Despacho cadastrado com Sucesso');window.location.href='inserir.php';</script>";
 ?>
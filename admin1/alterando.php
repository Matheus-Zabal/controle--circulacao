<?php
include '../conexao.php'
?>
<?php
session_start();
?>
<?php
$MIL_CODIGO = $_SESSION['USU_MIL_CODIGO'];
$id =$_POST['id'];
$assunto =$_POST['assunto'];
$data=$_POST['data'];
$ramal=$_POST['ramal'];

	//verificas se os registros nao estao vazios
			if($assunto == "" || $assunto == null){
			echo"<script language='javascript' type='text/javascript'>alert('O assunto deve ser preenchido');window.location.href='index.php';</script>";
			die();
			}
			if($data == "" || $data == null){
			echo"<script language='javascript' type='text/javascript'>alert('A data deve ser preenchido');window.location.href='index.php';</script>";
			die();
			}
			if($ramal == "" || $ramal == null){
			echo"<script language='javascript' type='text/javascript'>alert('O ramal deve ser preenchido');window.location.href='index.php';</script>";
			die();
			}
// converte a data para o formato SQL
	$data_sql = implode("-",array_reverse(explode("/",$data)));
	//tranforma a data inserida e a data do sistema em horas para poder limitar as datas
	$data_inicial =  date('Y/m/d H:i:s' , strtotime('now'));
	$data_final	  = $data_sql;
	$diff =  strtotime($data_final) - strtotime($data_inicial);
 	$horas    = $diff/3600;
			
				if ($horas<9){
					 echo"<script language='javascript' type='text/javascript'>alert('CADASTRO SOMENTE PODERA SER REALIZADO ATE AS 17 HORAS');window.location.href='index.php';</script>";
					 die();
				}
				if ($horas>336){
					 echo"<script language='javascript' type='text/javascript'>alert('A DATA NAO PODERA SER MAIOR QUE 14 DIAS');window.location.href='index.php';</script>";
					 die();
				}
				
			// verifica se a data nao esta marcada como dia sem despacho		
			$sem_despacho = $mysqli->query("select * from data where sem_despacho = '".$data_sql."'");
			if($sem_despacho->num_rows >= 1){
			 echo"<script language='javascript' type='text/javascript'>alert('POR DETERMINAÇÃO DO COMANDANTE NESTA DATA NÃO HAVERÁ DESPACHO');window.location.href='index.php';</script>";
					 die();
				}
	  			
	// Insere os dados
			$query ="UPDATE despacho SET ASSUNTO='".$assunto."', DATA='".$data_sql."', RAMAL='".$ramal."' where CODIGO='".$id."'";
			$mysqli->query($query) or die ($mysqli->error);
			echo"<script language='javascript' type='text/javascript'>alert('SEU DESPACHO FOI ALTERADO');window.location.href='index.php';</script>";
 ?>
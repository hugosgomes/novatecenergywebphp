<?php
include('_app/Config.inc.php');
if (empty($Create)):
	$Create = new Create;
endif;
$hora = date('H:i:s');
$h = date('H');
$hrsLivres = array ("07", "08", "09", "17", "20", "21", "22", "23");

if (in_array($h, $hrsLivres)) { 
	exec('ImportOs.bat');
  // CRIA NOVA LINHA NA TABELA 00_LOGIMPORTACAO
	$log = array('PROCESSO' => "GNS/AGENDAMENTOS >>> O ROBÔ FOI EXECUTADO PELA TELA DE AGENDAMENTOS!");
	$Create->ExeCreate("[00_LogImportacao]",$log);
	echo "<script>alert('Executado com sucesso!');history.back();</script>";
}else {
echo "<script>alert('Este horário não é permitido!');history.back();</script>";
}


?>

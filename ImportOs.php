<?php
include('_app/Config.inc.php');
if (empty($Create)):
	$Create = new Create;
endif;

$hora = date('H:i:s');
$h = date('H');
$m = date('i');
$hrsLivres = array ("07", "08", "09", "17", "20", "21", "22", "23");
$hrsMinLivres = array ("45");

if(($h == $hrsLivres[2] || $h == $hrsLivres[3]) && $m < $hrsMinLivres[0]){
	exec('ImportOs.bat');
  // CRIA NOVA LINHA NA TABELA 00_LOGIMPORTACAO
	$log = array('PROCESSO' => "GNS/AGENDAMENTOS >>> O ROBÔ FOI EXECUTADO PELA TELA DE AGENDAMENTOS!");
	$Create->ExeCreate("[00_LogImportacao]",$log);
	echo "<script>alert('Executado com sucesso!');history.back();</script>";
}elseif (in_array($h, $hrsLivres) && $h != $hrsLivres[2] && $h != $hrsLivres[3]){
	exec('ImportOs.bat');
  // CRIA NOVA LINHA NA TABELA 00_LOGIMPORTACAO
	$log = array('PROCESSO' => "GNS/AGENDAMENTOS >>> O ROBÔ FOI EXECUTADO PELA TELA DE AGENDAMENTOS!");
	$Create->ExeCreate("[00_LogImportacao]",$log);
	echo "<script>alert('Executado com sucesso!');history.back();</script>";
}else {
	echo "<script>alert('Não é permitido rodar 10 minutos antes do próximo horário!');history.back();</script>";
}

?>

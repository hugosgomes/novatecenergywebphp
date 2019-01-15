<?php
include('_app/Config.inc.php');
if (empty($Create)):
	$Create = new Create;
endif;
exec('ImportOs.bat');
  // CRIA NOVA LINHA NA TABELA 00_LOGIMPORTACAO
$log = array('PROCESSO' => "GNS/AGENDAMENTOS >>> O ROBÔ FOI EXECUTADO PELA TELA DE AGENDAMENTOS!");
	$Create->ExeCreate("[00_LogImportacao]",$log);
	echo "<script>alert('Executado com sucesso!');history.back();</script>";
	?>
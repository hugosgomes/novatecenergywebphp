<?php 

require '_app/Config.inc.php';
if (empty($Create)):
	$Create = new Create;
endif;
if (empty($Read)):
	$Read = new Read;
endif;

?>
<!DOCTYPE html>
<html>
<head>
	<title>GERADOR DE NÚMEROS</title>
</head>
<body>
	<center><h1 style="font-family: 'Arial'; ">GERADOR DE NÚMEROS</h1></center>
	<?php 
	$Read->FullRead("SELECT Registro.[COD CLIENTE] As COD, Registro.NCLIENTE, [10_ClientesCEGObs].ID, Registro.STATUS, [10_ClientesCEGObs].CONCLUSAO, [10_ClientesCEGObs].TEMA, [10_ClientesCEGObs].DATAAGENDADA, Registro.[DATA STATUS] 
		From [10_ClientesCEGObs] INNER Join Registro On [10_ClientesCEGObs].CLIENTE = Registro.[COD CLIENTE] 
		Where [10_ClientesCEGObs].DATAAGENDADA < Convert(DATE, getdate()) And ((Registro.NCLIENTE) Is Not null) And [10_ClientesCEGObs].TEMA = 2 And [10_ClientesCEGObs].CONCLUSAO = 0 Order By [DATA STATUS] DESC ", "");

	$quantidade = count($Read->getResult());
	if($Read->getResult()){
		$i = 1;
		echo "<center><textarea rows='30' cols='180'>";
		foreach ($Read->getResult() as $teste) {
			if($i < $quantidade){
				echo str_replace('.0', '', $teste['NCLIENTE'] . " or ");
			}else {
				echo str_replace('.0', '',  $teste['NCLIENTE']);
			}
			$i++;
		}
		echo "</textarea></center>";
		//
		//while ($i <= $quantidade ) {
		/// echo $Read->getResult()[$i];
		//}
		//
	}else {
		echo "sem resultado";
	}
	?>

</textarea>
</body>
</html>


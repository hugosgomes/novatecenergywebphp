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
	$Read->FullRead("SELECT Registro.STATUS, Registro.NCLIENTE, Registro.[COD CLIENTE] From Registro Where (((Registro.STATUS)<>2 And (Registro.STATUS)<>1) And ((Registro.NCLIENTE) Is Not Null))", "");

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


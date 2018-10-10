<?php 

session_start();
require '../../../_app/Config.inc.php';

if (empty($_SESSION['userLogin'])):
    $jSON['trigger'] = AjaxErro('<b class="icon-warning">OPSS:</b> Você não tem permissão para essa ação ou não está logado como administrador!', E_USER_ERROR);
    echo json_encode($jSON);
    die;
endif;

$jSON = null;

$delimitador = ';';
$cerca = '"';
$registro = [];

// Abrir arquivo para leitura
$f = fopen('//192.168.0.101/Robo/relatorioestadoportas.csv', 'r');
if ($f) { 

    // Ler cabecalho do arquivo
    $cabecalho = fgetcsv($f, 0, $delimitador, $cerca);
    $cabecalho = array_map("utf8_encode", $cabecalho);

    // Enquanto nao terminar o arquivo
    while (!feof($f)) { 

        // Ler uma linha do arquivo
        $linha = fgetcsv($f, 0, $delimitador, $cerca);
        if (!$linha) {
            continue;
        }

        // Montar registro com valores indexados pelo cabecalho
        $linha = array_map("utf8_encode", $linha);
        $registro = array_combine($cabecalho, $linha);

        // Obtendo o nome
        //echo $registro['nome'].PHP_EOL;
    }
    fclose($f);
}

$Create = new Create;
$Create->ExeCreate("[14_ImportEstadoPortas_SVSH]",$registro);

$jSON['Sucess'] = 'Sucess';
if ($jSON):
    echo json_encode($jSON);
else:
    $jSON['trigger'] = AjaxErro('<b class="icon-warning">OPSS:</b> Desculpe. Mas uma ação do sistema não respondeu corretamente. Ao persistir, contate o desenvolvedor!', E_USER_ERROR);
    echo json_encode($jSON);
endif;

?>
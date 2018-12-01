<?php 

session_start();
require '../../../_app/Config.inc.php';

if (empty($_SESSION['userLogin'])):
    $jSON['trigger'] = AjaxErro('<b class="icon-warning">OPSS:</b> Você não tem permissão para essa ação ou não está logado como administrador!', E_USER_ERROR);
    echo json_encode($jSON);
    die;
endif;

usleep(50000);

//DEFINE O CALLBACK E RECUPERA O POST
$jSON = null;
$CallBack = 'Previsoes';
$PostData = filter_input_array(INPUT_POST, FILTER_DEFAULT);//Criar um array com tudo o que foi passado no post.

//VALIDA AÇÃO
if ($PostData && $PostData['callback_action'] && $PostData['callback'] == $CallBack):
    //PREPARA OS DADOS
    $Case = $PostData['callback_action'];
    unset($PostData['callback'], $PostData['callback_action']);

    // AUTO INSTANCE OBJECT READ
    if (empty($Read)):
        $Read = new Read;
    endif;

    if (empty($Query)):
        $Query = new Query;
    endif;

    //SELECIONA AÇÃO
    switch ($Case):
        case 'consulta':
        	$mes = $PostData['mes'] == 't' ? "MONTH(EMISSAO) >= 1" : "MONTH(EMISSAO) = {$PostData['mes']}";
        	$ano = $PostData['ano'] == 't' ? "YEAR(EMISSAO) >= 1900" : "YEAR(EMISSAO) = {$PostData['ano']}";
        	$jSON['dataTable_sem_certificar'] = "";
        	$jSON['j_faturamento'] = "";
            $jSON['j_previsao'] = "";

            //TOTAL SEM CERTIFICAR DE REDE
            $Read->FullRead("exec [dbo].[50_SomaPrecertificar]","");
            if ($Read->getResult()):
            	$valor = $Read->getResult()[0]['SomaDeTOTAL'] == "" ? 0 : $Read->getResult()[0]['SomaDeTOTAL'];
            	$valor = number_format($valor,2,',','.');
                $jSON['dataTable_sem_certificar'] .= "<tr>
				<td><center>R$ $valor</center></td>";
            else:
                $jSON['dataTable_sem_certificar'] .= "
				<tr><td><center>R$ 0,00</center></td>";
            endif;


            //TOTAL SEM CERTIFICAR DE ADESÃO
            $Read->FullRead("SELECT SUM(VALOROP) AS VALOR FROM Registro WHERE STATUSB = 2","");
            if ($Read->getResult()):
            	$valor = $Read->getResult()[0]['VALOR'] == "" ? 0 : $Read->getResult()[0]['VALOR'];
            	$valor = number_format($valor,2,',','.');
                $jSON['dataTable_sem_certificar'] .= "
				<td><center>R$ $valor</center></td>";
            else:
                $jSON['dataTable_sem_certificar'] .= "
				<td><center>R$ 0,00</center></td>";
            endif;


            //TOTAL CERTIFICADO DE REDE DO MES
            $Read->FullRead("SELECT ISNULL(SUM(ATUAL),0)+ISNULL(SUM(ATUALANTECIPO),0) AS TOTAL from [50_PrecertId] WHERE NF IS NULL AND {$mes} AND {$ano}","");
            if ($Read->getResult()):
            	$valor = $Read->getResult()[0]['TOTAL'] == "" ? 0 : $Read->getResult()[0]['TOTAL'];
            	$valor = number_format($valor,2,',','.');
                $jSON['j_faturamento'] .= "<tr>
				<td>Certificado:</td><td><center>R$ $valor</center></td>";
            else:
                $jSON['j_faturamento'] .= "
				<tr>
				<td>Certificado:</td><td><center>R$ 0,00</center></td>";
            endif;


            //TOTAL CERTIFICADO DE ADESÃO DO MES
            $Read->FullRead("SELECT ISNULL(SUM(TOTAL),0) AS TOTAL from [10_PrecertId] WHERE NF IS NULL AND {$mes} AND {$ano}","");
            if ($Read->getResult()):
            	$valor = $Read->getResult()[0]['TOTAL'] == "" ? 0 : $Read->getResult()[0]['TOTAL'];
            	$valor = number_format($valor,2,',','.');
                $jSON['j_faturamento'] .= "
				<td><center>R$ $valor</center></td>";
            else:
                $jSON['j_faturamento'] .= "
				<td><center>R$ 0,00</center></td></tr>";
            endif;


            //TOTAL FATURADO DE REDE DO MES
            $Read->FullRead("SELECT ISNULL(SUM(ATUAL),0)+ISNULL(SUM(ATUALANTECIPO),0) AS TOTAL from [50_PrecertId] INNER JOIN Contas ON [50_PrecertId].NF = Contas.Id
				WHERE {$mes} AND {$ano}","");
            if ($Read->getResult()):
            	$valor = $Read->getResult()[0]['TOTAL'] == "" ? 0 : $Read->getResult()[0]['TOTAL'];
            	$valor = number_format($valor,2,',','.');
                $jSON['j_faturamento'] .= "<tr>
				<td>Faturado:</td><td><center>R$ $valor</center></td>";
            else:
                $jSON['j_faturamento'] .= "
				<tr>
				<td>Faturado:</td><td><center>R$ 0,00</center></td>";
            endif;


            //TOTAL FATURADO DE ADESÃO DO MES
            $Read->FullRead("SELECT ISNULL(SUM(TOTAL),0) AS TOTAL from [10_PrecertId] INNER JOIN Contas ON [10_PrecertId].NF = Contas.Id
				WHERE {$mes} AND {$ano}","");
            if ($Read->getResult()):
            	$valor = $Read->getResult()[0]['TOTAL'] == "" ? 0 : $Read->getResult()[0]['TOTAL'];
            	$valor = number_format($valor,2,',','.');
                $jSON['j_faturamento'] .= "
				<td><center>R$ $valor</center></td>";
            else:
                $jSON['j_faturamento'] .= "
				<td><center>R$ 0,00</center></td></tr>";
            endif;


            //TOTAL FATURADO RECEBIDO DE REDE DO MES
            $Read->FullRead("SELECT ISNULL(SUM(ATUAL),0)+ISNULL(SUM(ATUALANTECIPO),0) AS TOTAL from [50_PrecertId] INNER JOIN Contas ON [50_PrecertId].NF = Contas.Id
				WHERE Contas.DataMovimento IS NOT NULL AND {$mes} AND {$ano}","");
            if ($Read->getResult()):
            	$valor = $Read->getResult()[0]['TOTAL'] == "" ? 0 : $Read->getResult()[0]['TOTAL'];
            	$valor = number_format($valor,2,',','.');
                $jSON['j_faturamento'] .= "<tr>
				<td>Recebido:</td><td><center>R$ $valor</center></td>";
            else:
                $jSON['j_faturamento'] .= "
				<tr>
				<td>Recebido:</td><td><center>R$ 0,00</center></td>";
            endif;


            //TOTAL FATURADO RECEBIDO DE ADESÃO DO MES
            $Read->FullRead("SELECT ISNULL(SUM(TOTAL),0) AS TOTAL from [10_PrecertId] INNER JOIN Contas ON [10_PrecertId].NF = Contas.Id
				WHERE Contas.DataMovimento IS NOT NULL AND {$mes} AND {$ano}","");
            if ($Read->getResult()):
            	$valor = $Read->getResult()[0]['TOTAL'] == "" ? 0 : $Read->getResult()[0]['TOTAL'];
            	$valor = number_format($valor,2,',','.');
                $jSON['j_faturamento'] .= "
				<td><center>R$ $valor</center></td>";
            else:
                $jSON['j_faturamento'] .= "
				<td><center>R$ 0,00</center></td></tr>";
            endif;


            //TOTAL EM ABERTO DE TODOS OS MESES DE REDE
            $Read->FullRead("SELECT ISNULL(SUM(ATUAL),0)+ISNULL(SUM(ATUALANTECIPO),0) AS TOTAL from [50_PrecertId] WHERE NF IS NULL","");
            if ($Read->getResult()):
                $valor = $Read->getResult()[0]['TOTAL'] == "" ? 0 : $Read->getResult()[0]['TOTAL'];
                $valor = number_format($valor,2,',','.');
                $jSON['j_previsao'] .= "<tr>
                <td><center>R$ $valor</center></td>";
            else:
                $jSON['j_previsao'] .= "
                <tr>
                <td><center>R$ 0,00</center></td>";
            endif;


            //TOTAL EM ABERTO DE TODOS OS MESES DE ADESÃO
            $Read->FullRead("SELECT ISNULL(SUM(TOTAL),0) AS TOTAL from [10_PrecertId] WHERE NF IS NULL","");
            if ($Read->getResult()):
                $valor = $Read->getResult()[0]['TOTAL'] == "" ? 0 : $Read->getResult()[0]['TOTAL'];
                $valor = number_format($valor,2,',','.');
                $jSON['j_previsao'] .= "
                <td><center>R$ $valor</center></td>";
            else:
                $jSON['j_previsao'] .= "
                <td><center>R$ 0,00</center></td></tr>";
            endif;

         break;
    endswitch;

    //RETORNA O CALLBACK
    if ($jSON):
        echo json_encode($jSON);
    else:
        $jSON['trigger'] = AjaxErro('<b class="icon-warning">OPSS:</b> Desculpe. Mas uma ação do sistema não respondeu corretamente. Ao persistir, contate o desenvolvedor!', E_USER_ERROR);
        echo json_encode($jSON);
    endif;
else:
    //ACESSO DIRETO
    die('<br><br><br><center><h1>Acesso Restrito!</h1></center>');
endif;

 ?>
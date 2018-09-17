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
$CallBack = 'Historico';
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

    //SELECIONA AÇÃO
    switch ($Case):        
        case 'Carregar':
        $jSON['historico'] = null;
        $jSON['selectClientes'] = null;

        $where = $PostData['idCliente'] != 't' ? "WHERE [60_Clientes].Id = {$PostData['idCliente']}" : "";

        //Carrega e retorna os dados da tabela
        $Read->FullRead("SELECT [60_Clientes].Id, NomeCliente, [60_OS].Endereco, [60_OS].Bairro, [60_OS].Municipio FROM [60_Clientes]
						INNER JOIN [60_OT] ON [60_Clientes].Id = [60_OT].Cliente
						INNER JOIN [60_OS] ON [60_OT].Id = [60_OS].OT {$where}
						ORDER BY NomeCliente","");
            if ($Read->getResult()):
                foreach ($Read->getResult() as $historico):
                	$jSON['historico'] .= "<tr role='row' class='odd pointer j_table' value='{$historico['Id']}' callback='Historico' callback_action='CarregarHistorico'>
	                							<td>{$historico['NomeCliente']}</td>
	                							<td>{$historico['Endereco']}</td>
	                							<td>{$historico['Bairro']}</td>
	                							<td>{$historico['Municipio']}</td>
                						   </tr>";
                endforeach;                   
            else:
                $jSON['historico'] = null;
            endif;

        //CARREGA E RETORNA OS DADOS DO CLIENTE PARA INICIAR O SELECT
        $Read->FullRead("SELECT Id, NomeCliente FROM [60_Clientes] ORDER BY NomeCliente","");
            if ($Read->getResult()):
                foreach ($Read->getResult() as $clientes):
                	$jSON['selectClientes'] .= "<option value={$clientes['Id']}>{$clientes['NomeCliente']}</option>";
                endforeach;                   
            else:
                $jSON['selectClientes'] = null;
            endif;
    	break;


        //CARREGA O HISTÓRICO DE OS's NA LATERAL DIREITA DA PÁGINA
	    case 'CarregarHistorico':
	    $jSON['historicoOs'] = null;
	    $Read->FullRead("SELECT NomeOs, NumOS, [60_OS].Status, Valorcobrar, Users.[NOME COMPLETO] AS Atualizadopor, Tecnicos.[NOME COMPLETO] AS Tecnico, CONVERT(NVARCHAR,Atualizadoem,103) AS ATUALIZADO_EM, ObsCEG FROM [60_OS] INNER JOIN [60_OT] ON [60_OS].OT = [60_OT].Id INNER JOIN [60_Clientes] ON [60_OT].Cliente = [60_Clientes].Id
                    LEFT JOIN Funcionários Tecnicos ON [60_OS].Tecnico = Tecnicos.ID LEFT JOIN Funcionários Users ON [60_OS].Atualizadopor = Users.ID
					WHERE [60_Clientes].Id = " . $PostData['idCliente'] . " ORDER BY Atualizadoem DESC","");
            if ($Read->getResult()):
                foreach ($Read->getResult() as $Oss):
                	$valor = number_format($Oss['Valorcobrar'],2,',','.');
                	$status = getStatusOs($Oss['Status']);
                    $tecnico = $Oss['Tecnico'] ? $Oss['Tecnico'] : 'Não Associado';
                    $atualizadopor = $Oss['Atualizadopor'] ? $Oss['Atualizadopor'] : 'Não Associado';
                	$jSON['historicoOs'] .= "<hr><hr>
									          <div class='box box100' style='padding-bottom: 0px;'>
									            <li style='padding-bottom: 5px;'><h3><b><i class='icon-history'></i>&ensp;{$Oss['NomeOs']}</b></h3></li>
									          </div>
									          <div class='box box50' style='padding-bottom: 0px;'>
									            <li style='padding-bottom: 5px;font-size: 12px;'>OS:{$Oss['NumOS']}</li>
									            <li style='padding-bottom: 5px;font-size: 12px;'>Valor: R$ {$valor}</li>
									            <li style='padding-bottom: 5px;font-size: 12px;'>Técnico: {$tecnico}</li>
									          </div>
									          <div class='box box50' style='padding-bottom: 0px;text-align: right;'>
									            <li style='padding-bottom: 5px;font-size: 12px;'>Status: {$status}</li>
									            <li style='padding-bottom: 5px;font-size: 11px;color: gray;'>Usuário: {$atualizadopor}</li>
									            <li style='padding-bottom: 5px;font-size: 11px;color: gray;'>Atualizado em: {$Oss['ATUALIZADO_EM']}</li>
									          </div>
									          <div class='box box100' style='padding-top: 0px;'>
									            <li style='padding-bottom: 5px;font-size: 12px;'>OBS.: {$Oss['ObsCEG']}</li>
									          </div>";
                endforeach;                   
            else:
                $jSON['historicoOs'] = null;
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
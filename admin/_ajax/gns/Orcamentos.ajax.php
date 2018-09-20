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
$CallBack = 'Orcamentos';
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
        case 'consulta':
            $jSON['addTabela'] = null;
            $jSON['addAprovado'] = 0;
            $jSON['addReprovado'] = 0;
            $jSON['addExecutado'] = 0;
            $where = "";
            $where .= $PostData['ano'] != 't' ? ' AND YEAR([60_Orcamentos].DataEnt) = ' . $PostData['ano'] . " " : "";
            $where .= $PostData['mes'] != 't' ? ' AND MONTH([60_Orcamentos].DataEnt) = ' . $PostData['mes'] . " " : "";
            $where .= $PostData['Status'] != 't' ? ' AND [60_Orcamentos].Status = ' . $PostData['Status'] . " " : "";
            $where = substr($where, 5);
            $where = $where ? " WHERE " . $where : "";

            //Carrega e retorna os dados da tabela
            $Read->FullRead("SELECT [60_Orcamentos].id, [60_Clientes].NumCliente, [60_OS].NumOS, [60_OS].Endereco + ', ' + [60_OS].Bairro + ' - ' + [60_OS].Municipio AS ENDERECO,
                            [60_OS].NomeOs FROM [60_Clientes] INNER JOIN [60_OT] ON [60_Clientes].Id = [60_OT].Cliente INNER JOIN [60_OS] ON [60_OT].Id = [60_OS].OT
                            INNER JOIN [60_Orcamentos] ON [60_OS].Id = [60_Orcamentos].idOS" . $where,"");
                if ($Read->getResult()):
                    foreach ($Read->getResult() as $orcamentos):
                        $jSON['addTabela'] .= "<tr class='pointer' idOrcamento = '{$orcamentos['id']}'  callback='Orcamentos' callback_action='detalhes'>
                                                    <td>{$orcamentos['NumCliente']}</td>
                                                    <td>{$orcamentos['NumOS']}</td>
                                                    <td>{$orcamentos['ENDERECO']}</td>
                                                    <td>{$orcamentos['NomeOs']}</td>
                                               </tr>";
                    endforeach;
                else:
                    $jSON['addTabela'] = "<tr><td colspan='4'><center>Nenhuma informação</center></td></tr>";
                endif;


            //SOMATÓRIO DE VALOR APROVADO
            $Read->FullRead("SELECT SUM([60_Orcamentos].Valor) SOMA FROM [60_Clientes] INNER JOIN [60_OT] ON [60_Clientes].Id = [60_OT].Cliente INNER JOIN [60_OS] ON [60_OT].Id = [60_OS].OT INNER JOIN [60_Orcamentos] ON [60_OS].Id = [60_Orcamentos].idOS WHERE [60_Orcamentos].Status = 0","");
                if ($Read->getResult()):
                    foreach ($Read->getResult() as $orcamentos):
                        $valor = number_format($orcamentos['SOMA'],2,',','.');
                        $jSON['addAprovado'] = "R$ " . $valor;
                    endforeach;
                else:
                    $jSON['addAprovado'] = 0;
                endif;

            //SOMATÓRIO DE VALOR REPROVADO
            $Read->FullRead("SELECT SUM([60_Orcamentos].Valor) SOMA FROM [60_Clientes] INNER JOIN [60_OT] ON [60_Clientes].Id = [60_OT].Cliente INNER JOIN [60_OS] ON [60_OT].Id = [60_OS].OT INNER JOIN [60_Orcamentos] ON [60_OS].Id = [60_Orcamentos].idOS WHERE [60_Orcamentos].Status = 2","");
                if ($Read->getResult()):
                    foreach ($Read->getResult() as $orcamentos):
                        $valor = number_format($orcamentos['SOMA'],2,',','.');
                        $jSON['addReprovado'] = "R$ " . $valor;
                    endforeach;
                else:
                    $jSON['addReprovado'] = 0;
                endif;


            //SOMATÓRIO DE VALOR EXECUTADO
            $Read->FullRead("SELECT SUM([60_Orcamentos].Valor) SOMA FROM [60_Clientes] INNER JOIN [60_OT] ON [60_Clientes].Id = [60_OT].Cliente INNER JOIN [60_OS] ON [60_OT].Id = [60_OS].OT INNER JOIN [60_Orcamentos] ON [60_OS].Id = [60_Orcamentos].idOS WHERE [60_Orcamentos].Status = 1","");
                if ($Read->getResult()):
                    foreach ($Read->getResult() as $orcamentos):
                        $valor = number_format($orcamentos['SOMA'],2,',','.');
                        $jSON['addExecutado'] = "R$ " . $valor;
                    endforeach;
                else:
                    $jSON['addExecutado'] = 0;
                endif;
        break;


        case 'detalhes':
            $jSON['addDetalhes'] = null;

            //SOMATÓRIO DE VALOR EXECUTADO
            $Read->FullRead("SELECT CONVERT(NVARCHAR,[60_Orcamentos].DataEnt,103) AS DataEnt, TecnicoEnt.[NOME COMPLETO] AS TecnicoEnt,
                CONVERT(NVARCHAR,[60_Orcamentos].DataExe,103) AS DataExe, TecExe.[NOME COMPLETO] AS TecExe, [60_Orcamentos].Status, [60_Orcamentos].Valor
                FROM [60_Orcamentos] INNER JOIN Funcionários TecnicoEnt ON [60_Orcamentos].TecnicoEnt = TecnicoEnt.ID
                INNER JOIN Funcionários TecExe ON [60_Orcamentos].TecExe = TecExe.ID WHERE [60_Orcamentos].ID = " . $PostData['idOrcamento'],"");
            if ($Read->getResult()):
                    foreach ($Read->getResult() as $detalhes):
                        $valor = number_format($detalhes['Valor'],2,',','.');
                        $status = getStatusOrcamentoGNS($detalhes['Status']);
                        $jSON['addDetalhes'] = "<li><center><span id='j_btn_editar' class='btn btn_darkblue icon-share' >Editar</span></center></li>
                              <br>
                              <li>Data Entrada: {$detalhes['DataEnt']}</li>
                              <li>Técnico Entrada: {$detalhes['TecnicoEnt']}</li>
                              <li>Data Execução: {$detalhes['DataExe']}</li>
                              <li>Técnico Execução: {$detalhes['TecExe']}</li>
                              <li>Status: $status</li>
                              <li>Valor: (R$)$valor</li>";
                    endforeach;
                else:
                    $jSON['addDetalhes'] = 0;
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
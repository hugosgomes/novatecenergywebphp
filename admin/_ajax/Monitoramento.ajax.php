<?php

session_start();
require '../../_app/Config.inc.php';

if (empty($_SESSION['userLogin'])):
    $jSON['trigger'] = AjaxErro('<b class="icon-warning">OPSS:</b> Você não tem permissão para essa ação ou não está logado como administrador!', E_USER_ERROR);
    echo json_encode($jSON);
    die;
endif;

usleep(50000);

//DEFINE O CALLBACK E RECUPERA O POST
$jSON = null;
$CallBack = 'Monitoramento';
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
        $associados = 0;
        $atendidos = 0;
        $cancelados = 0;
        $ausentes = 0;
        $reagendadosNVT = 0;
        $reagendadosGNS = 0;
        $semAtender = 0;
        $criterioTec = "";
        $orcamentoAprov = 0;
        $orcamentoExec = 0;
        $orcamentoReprov = 0;

                if(!$PostData['Tecnico']):
                    $jSON['trigger'] = AjaxErro("SELECIONE PRIMEIRO UM TÉCNICO!", E_USER_WARNING);
                else:
                    //CLAUSULA DE CRITÉRIO PARA FILTRAR POR TÉCNICO
                    $criterioTec = $PostData['Tecnico'] != "t" ? " AND Tecnico = " . $PostData['Tecnico'] : "";

                    //CLIENTES ASSOCIADOS
                    $Read->FullRead("SELECT COUNT(*) AS QUANTIDADE FROM [60_OS] WHERE STATUS = 0 " . $criterioTec,"");
                    if ($Read->getResult()):
                        foreach ($Read->getResult() as $OS):
                            extract($OS);
                            $associados = $QUANTIDADE;
                        endforeach;                   
                    else:
                        $associados = 0;
                    endif;

                    //CLIENTES ATENDIDOS  
                    $Read->FullRead("SELECT COUNT(*) AS QUANTIDADE FROM [60_OS] WHERE STATUS = 1 " . $criterioTec,"");
                    if ($Read->getResult()):
                        foreach ($Read->getResult() as $OS):
                            extract($OS);
                            $atendidos = $QUANTIDADE;
                        endforeach;                   
                    else:
                        $atendidos = 0;
                    endif;

                    //CLIENTES CANCELADOS  
                    $Read->FullRead("SELECT COUNT(*) AS QUANTIDADE FROM [60_OS] WHERE STATUS = 2 " . $criterioTec,"");
                    if ($Read->getResult()):
                        foreach ($Read->getResult() as $OS):
                            extract($OS);
                            $cancelados = $QUANTIDADE;
                        endforeach;                   
                    else:
                        $cancelados = 0;
                    endif;

                    //CLIENTES AUSENTES  
                    $Read->FullRead("SELECT COUNT(*) AS QUANTIDADE FROM [60_OS] WHERE STATUS = 3 " . $criterioTec,"");
                    if ($Read->getResult()):
                        foreach ($Read->getResult() as $OS):
                            extract($OS);
                            $ausentes = $QUANTIDADE;
                        endforeach;                   
                    else:
                        $ausentes = 0;
                    endif;

                    //CLIENTES REAGENDADOS NVT  
                    $Read->FullRead("SELECT COUNT(*) AS QUANTIDADE FROM [60_OS] WHERE STATUS = 4 " . $criterioTec,"");
                    if ($Read->getResult()):
                        foreach ($Read->getResult() as $OS):
                            extract($OS);
                            $reagendadosNVT = $QUANTIDADE;
                        endforeach;                   
                    else:
                        $reagendadosNVT = 0;
                    endif;

                    //CLIENTES REAGENDADOS GNS  
                    $Read->FullRead("SELECT COUNT(*) AS QUANTIDADE FROM [60_OS] WHERE STATUS = 5 " . $criterioTec,"");
                    if ($Read->getResult()):
                        foreach ($Read->getResult() as $OS):
                            extract($OS);
                            $reagendadosGNS = $QUANTIDADE;
                        endforeach;                   
                    else:
                        $reagendadosGNS = 0;
                    endif;

                    //CLIENTES SEM ATENDER  
                    $Read->FullRead("SELECT COUNT(*) AS QUANTIDADE FROM [60_OS] WHERE STATUS = 6 " . $criterioTec,"");
                    if ($Read->getResult()):
                        foreach ($Read->getResult() as $OS):
                            extract($OS);
                            $semAtender = $QUANTIDADE;
                        endforeach;                   
                    else:
                        $semAtender = 0;
                    endif;

                    //ORÇAMENTOS APROVADOS 
                    $Read->FullRead("SELECT COUNT(*) AS QUANTIDADE FROM [60_OS] WHERE STATUS2 = 0 " . $criterioTec,"");
                    if ($Read->getResult()):
                        foreach ($Read->getResult() as $OS):
                            extract($OS);
                            $orcamentoAprov = $QUANTIDADE;
                        endforeach;                   
                    else:
                        $orcamentoAprov = 0;
                    endif;

                    //ORÇAMENTOS EXECUTADOS 
                    $Read->FullRead("SELECT COUNT(*) AS QUANTIDADE FROM [60_OS] WHERE STATUS2 = 1 " . $criterioTec,"");
                    if ($Read->getResult()):
                        foreach ($Read->getResult() as $OS):
                            extract($OS);
                            $orcamentoExec = $QUANTIDADE;
                        endforeach;                   
                    else:
                        $orcamentoExec = 0;
                    endif;

                    //ORÇAMENTOS REPROVADOS 
                    $Read->FullRead("SELECT COUNT(*) AS QUANTIDADE FROM [60_OS] WHERE STATUS2 = 2 " . $criterioTec,"");
                    if ($Read->getResult()):
                        foreach ($Read->getResult() as $OS):
                            extract($OS);
                            $orcamentoReprov = $QUANTIDADE;
                        endforeach;                   
                    else:
                        $orcamentoReprov = 0;
                    endif;

                    $orcamentoTotal = $orcamentoAprov + $orcamentoExec + $orcamentoReprov;
                    
                    $jSON['trigger'] = true;
                    $jSON['addlist'] = "<ul id='dataList'>
                                          <li>Cliente(s) Associado(s): {$associados} </li>
                                          <li>Cliente(s) Atendido(s): {$atendidos} </li>
                                          <li>Cliente(s) Cancelado(s): {$cancelados} </li>
                                          <li>Cliente(s) Ausente(s): {$ausentes} </li>
                                          <li>Cliente(s) Reagendado(s) NVT: {$reagendadosNVT} </li>
                                          <li>Cliente(s) Reagendado(s) GNS: {$reagendadosGNS} </li>
                                          <li>Cliente(s) Sem Atender: {$semAtender} </li>
                                        </ul>";
                    $jSON['addOrcamentolist'] = "<div id='orcamento-list'>
                                                    <h1>Orçamentos:</h1>
                                                    <ul>
                                                        <li>Aprovados: {$orcamentoAprov} </li>
                                                        <li>Executados: {$orcamentoExec} </li>
                                                        <li>Reprovados: {$orcamentoReprov} </li>
                                                        <li><b>Total: {$orcamentoTotal} </b></li>
                                                    </ul>
                                                </div>";
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

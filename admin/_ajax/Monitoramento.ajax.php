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
                if(!$PostData['Tecnico']):
                    $jSON['trigger'] = AjaxErro("SELECIONE PRIMEIRO UM TÉCNICO!", E_USER_WARNING);
                else:
                    //CLIENTES ASSOCIADOS                    
                    $Read->FullRead("SELECT COUNT(*) AS QUANTIDADE FROM [60_Clientes]","");
                    if ($Read->getResult()):
                        foreach ($Read->getResult() as $OS):
                            extract($OS);
                            $associados = $QUANTIDADE;
                        endforeach;                   
                    else:
                        $associados = 0;
                    endif;

                    //CLIENTES ATENDIDOS  
                    $Read->FullRead("SELECT count(CLIENTE) AS QUANTIDADE FROM [60_ClientesCEGObs] WHERE CONCLUSAO = 1 GROUP BY CLIENTE","");
                    if ($Read->getResult()):
                        foreach ($Read->getResult() as $OS):
                            extract($OS);
                            $atendidos = $QUANTIDADE;
                        endforeach;                   
                    else:
                        $atendidos = 0;
                    endif;

                    //CLIENTES CANCELADOS  
                    $Read->FullRead("SELECT COUNT(*) AS QUANTIDADE FROM [60_Clientes]","");
                    if ($Read->getResult()):
                        foreach ($Read->getResult() as $OS):
                            extract($OS);
                            $cancelados = $QUANTIDADE;
                        endforeach;                   
                    else:
                        $cancelados = 0;
                    endif;

                    //CLIENTES AUSENTES  
                    $Read->FullRead("SELECT COUNT(*) AS QUANTIDADE FROM [60_Clientes]","");
                    if ($Read->getResult()):
                        foreach ($Read->getResult() as $OS):
                            extract($OS);
                            $ausentes = $QUANTIDADE;
                        endforeach;                   
                    else:
                        $ausentes = 0;
                    endif;

                    //CLIENTES REAGENDADOS NVT  
                    $Read->FullRead("SELECT COUNT(*) AS QUANTIDADE FROM [60_Clientes]","");
                    if ($Read->getResult()):
                        foreach ($Read->getResult() as $OS):
                            extract($OS);
                            $reagendadosNVT = $QUANTIDADE;
                        endforeach;                   
                    else:
                        $reagendadosNVT = 0;
                    endif;

                    //CLIENTES REAGENDADOS GNS  
                    $Read->FullRead("SELECT COUNT(*) AS QUANTIDADE FROM [60_Clientes]","");
                    if ($Read->getResult()):
                        foreach ($Read->getResult() as $OS):
                            extract($OS);
                            $reagendadosGNS = $QUANTIDADE;
                        endforeach;                   
                    else:
                        $reagendadosGNS = 0;
                    endif;

                    //CLIENTES SEM ATENDER  
                    $Read->FullRead("SELECT COUNT(*) AS QUANTIDADE FROM [60_Clientes]","");
                    if ($Read->getResult()):
                        foreach ($Read->getResult() as $OS):
                            extract($OS);
                            $semAtender = $QUANTIDADE;
                        endforeach;                   
                    else:
                        $semAtender = 0;
                    endif;

                    /*
                    $Read->FullRead("SELECT COUNT(*) AS QUANTIDADE FROM [60_Clientes]","");
                    if ($Read->getResult()):
                        $jSON['addlist'] = null;
                        foreach ($Read->getResult() as $OS):
                            extract($OS);
                            $jSON['trigger'] = true;
                            $jSON['addlist'] .= "<ul id='dataList'><li>Cliente(s) Associado(s): {$QUANTIDADE} </li></ul>";
                        endforeach;                   
                    else:
                        $jSON['trigger'] = true;
                        $jSON['addlist'] = "<ul id='dataList'><li>Cliente(s) Associado(s): 0 </li></ul>";
                    endif;
                    */
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

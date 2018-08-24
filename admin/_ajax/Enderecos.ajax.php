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
$CallBack = 'Enderecos';
$PostData = filter_input_array(INPUT_POST, FILTER_DEFAULT);

//VALIDA AÇÃO
if ($PostData && $PostData['callback_action'] && $PostData['callback'] == $CallBack):
    //PREPARA OS DADOS
    $Case = $PostData['callback_action'];
    unset($PostData['callback'], $PostData['callback_action']);

    // AUTO INSTANCE OBJECT READ
    if (empty($Read)):
        $Read = new Read;
    endif;

    // AUTO INSTANCE OBJECT CREATE
    if (empty($Create)):
        $Create = new Create;
    endif;

    // AUTO INSTANCE OBJECT UPDATE
    if (empty($Update)):
        $Update = new Update;
    endif;
    
    // AUTO INSTANCE OBJECT DELETE
    if (empty($Delete)):
        $Delete = new Delete;
    endif;

    //SELECIONA AÇÃO
    switch ($Case):
        case 'pesquisa':           

            $LOG = explode(" ", $PostData['logradouro'],4);
            $LOGb = $LOG[1];
            $LOGc = $LOG[2];

            $PostData['logradouro'] = str_replace(" ", '%', $PostData['logradouro']);
            $PostData['bairro'] = str_replace(" ", '%', $PostData['bairro']);
            $UF = 19;
            
            //CONSULTA NO BANCO BAIRROS COM SEMELHANÇA DE ENDEREÇO          
            $Read->FullRead("SELECT [s].[ID], [s].[BAIRRO], [s].[CEP], [s].[COMPLEMENTO], [s].[LATITUDE], [s].[LOCAL], [s].[LOGRADOURO], 
                                    [s].[LOGRADOUROB], [s].[LONGITUDE], [s].[TIPO], [s].[TIPO2], [s].[TIPO AVBR], [s.BairroNavigation].[ID], 
                                    [s.BairroNavigation].[AREA], [s.BairroNavigation].[BAIRRO], [s.BairroNavigation].[BAIRROB], [s.BairroNavigation].[LOC]
                                    FROM (
                                    select distinct [dbo].[00_Bairro].[BAIRROB],  [dbo].[00_Logradouro].[ID] ,[dbo].[00_Logradouro].[TIPO] ,
                                    [dbo].[00_Logradouro].[TIPO2], [dbo].[00_Logradouro].[LOGRADOURO], [dbo].[00_Logradouro].[TIPO AVBR], 
                                    [dbo].[00_Logradouro].[CEP],[dbo].[00_Logradouro].[COMPLEMENTO],[dbo].[00_Logradouro].[LOCAL],
                                    [dbo].[00_Logradouro].[LATITUDE],[dbo].[00_Logradouro].[LONGITUDE],[dbo].[00_Logradouro].[BAIRRO],
                                    [dbo].[00_Logradouro].[LOGRADOUROB]
                                    from [dbo].[00_Logradouro] inner join [dbo].[00_Bairro] 
                                    on [dbo].[00_Bairro].ID = [dbo].[00_Logradouro].BAIRRO inner join[dbo].[00_Localidade] 
                                    on[dbo].[00_Localidade].ID = [dbo].[00_Bairro].LOC 
                                    where[00_Localidade].UF = :uf and ([dbo].[00_Logradouro].LOGRADOUROB like '". $PostData['logradouro'] ."%'
                                    or [dbo].[00_Logradouro].LOGRADOUROB like '%". $PostData['logradouro']. "%' 
                                    or ([dbo].[00_Logradouro].LOGRADOUROB like '%". $LOGb . "%'
                                    or [dbo].[00_Logradouro].LOGRADOUROB like '%". $LOGb. "%'
                                    or [dbo].[00_Logradouro].LOGRADOUROB like '%". $LOGc ."%')
                                    and ([dbo].[00_Bairro].BAIRROB like '%". $PostData['bairro'] ."'))
                                    ) AS [s]
                                    LEFT JOIN [00_Bairro] AS [s.BairroNavigation] ON [s].[BAIRRO] = [s.BairroNavigation].[ID]","uf={$UF}");

            //CASO TENHA RESULTADO, DEVOLVE UM JSON PARA A TABELA SECUNDÁRIA
            if ($Read->getResult()):
                            $jSON['trigger'] = AjaxErro("<b class='icon-checkmark'>OS adicionada com sucesso ao técnico!");
                            $jSON['success'] = true;
                            $Update->ExeUpdate("[60_OS]", $PostData, "WHERE [60_OS].Id = :id", "id={$OSId}");
                            if($Update->getResult()):
                                $Read->FullRead("SELECT NomeCliente, [60_OS].Id, [60_OS].Tecnico, [60_OS].[OSServico],[60_OS].NumOS, [60_OS].Status, [60_OS].DataAgendamento, [60_Enderecos].ENDERECO, [60_OS].turno as TURNO,
                                              [00_Logradouro].LATITUDE, [00_Logradouro].LONGITUDE FROM [60_Clientes]
                                              inner join [60_OT] on [60_Clientes].Id = [60_OT].Cliente
                                              inner join [60_OS] on [60_OT].Id = [60_OS].OT
                                              inner join [60_Enderecos] on [60_Clientes].EnderecoId = [60_Enderecos].ID
                                              inner join [00_Logradouro] on [60_Enderecos].LOGRADOUROID = [00_Logradouro].ID 
                                              WHERE [60_OS].Id = :id","id={$OSId}");
                                $jSON['addtable'] = "<tr class='j_tecnico' id='{$Read->getResult()[0]['Id']}'><td>{$Read->getResult()[0]['NomeCliente']}</td><td>{$Read->getResult()[0]['NumOS']}</td><td>{$Read->getResult()[0]['OSServico']}</td><td>{$Read->getResult()[0]['ENDERECO']}</td><td>". date('d/m/Y', strtotime($Read->getResult()[0]['DataAgendamento'])) ."</td><td>{$PostData['Tecnico']}</td><td>{$Read->getResult()[0]['TURNO']}</td><td><span rel='agendamentos' callback='Agendamentos' callback_action='delete' class='j_del_tecnico icon-cancel-circle btn btn_red' id='{$Read->getResult()[0]['Id']}'></span></td></td>";
                            else:
                                 $jSON['trigger'] = AjaxErro("Erro ao adicionar OS ao Técnico! Por favor tente novamente.");           
                            endif;
                        else:
                            $jSON['trigger'] = AjaxErro("<b class='icon-checkmark'>Erro ao adicionar OS!");
                            $jSON['success'] = true;
                        endif; 

            break;

        case 'delete':            
            break;

        case 'consulta':                
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

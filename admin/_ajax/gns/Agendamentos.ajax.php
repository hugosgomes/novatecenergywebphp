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
$CallBack = 'Agendamentos';
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
        case 'addTecnico':
            $OSId = $PostData['os_id'];
            unset($PostData['os_id']);

                if(!$PostData['Tecnico']):
                    $jSON['trigger'] = AjaxErro("SELECIONE PRIMEIRO UM TÉCNICO!", E_USER_WARNING);
                else:
                    if($PostData['Tecnico'] == 't'):
                        $jSON['trigger'] = AjaxErro("DIRECIONE PARA APENAS UM TÉCNICO. A SELEÇÃO TODOS ESTÁ MARCADA!", E_USER_WARNING);
                    else:
                        $Read->FullRead("SELECT NomeCliente, [60_OS].Id, [60_OS].Tecnico, [60_OS].[OSServico],[60_OS].NumOS, [60_OS].Status, [60_OS].DataAgendamento, [60_Enderecos].ENDERECO, [60_OS].turno as TURNO,
                                              [00_Logradouro].LATITUDE, [00_Logradouro].LONGITUDE FROM [60_Clientes]
                                              inner join [60_OT] on [60_Clientes].Id = [60_OT].Cliente
                                              inner join [60_OS] on [60_OT].Id = [60_OS].OT
                                              inner join [60_Enderecos] on [60_Clientes].EnderecoId = [60_Enderecos].ID
                                              inner join [00_Logradouro] on [60_Enderecos].LOGRADOUROID = [00_Logradouro].ID 
                                              WHERE [60_OS].Id = :id","id={$OSId}");
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
                    endif;
                endif;
            break;

        case 'delete':
            $OSId = $PostData['os_id'];
            unset($PostData['os_id']);
            $Tecnico['Tecnico'] = "0";

                if(!$PostData['Tecnico']):
                    $jSON['trigger'] = AjaxErro("SELECIONE PRIMEIRO UM TÉCNICO!", E_USER_WARNING);
                else:
                    if($PostData['Tecnico'] == 't'):
                        $Read->FullRead("SELECT NomeCliente, [60_OS].Id, [60_OS].Tecnico, [60_OS].[OSServico],[60_OS].NumOS, [60_OS].Status, [60_OS].DataAgendamento, [60_Enderecos].ENDERECO, [60_OS].turno as TURNO,
                                              [00_Logradouro].LATITUDE, [00_Logradouro].LONGITUDE FROM [60_Clientes]
                                              inner join [60_OT] on [60_Clientes].Id = [60_OT].Cliente
                                              inner join [60_OS] on [60_OT].Id = [60_OS].OT
                                              inner join [60_Enderecos] on [60_Clientes].EnderecoId = [60_Enderecos].ID
                                              inner join [00_Logradouro] on [60_Enderecos].LOGRADOUROID = [00_Logradouro].ID 
                                              WHERE [60_OS].Id = :id","id={$OSId}");
                    else:
                        $Read->FullRead("SELECT NomeCliente, [60_OS].Id, [60_OS].Tecnico, [60_OS].[OSServico],[60_OS].NumOS, [60_OS].Status, [60_OS].DataAgendamento, [60_Enderecos].ENDERECO, [60_OS].turno as TURNO,
                                          [00_Logradouro].LATITUDE, [00_Logradouro].LONGITUDE FROM [60_Clientes]
                                          inner join [60_OT] on [60_Clientes].Id = [60_OT].Cliente
                                          inner join [60_OS] on [60_OT].Id = [60_OS].OT
                                          inner join [60_Enderecos] on [60_Clientes].EnderecoId = [60_Enderecos].ID
                                          inner join [00_Logradouro] on [60_Enderecos].LOGRADOUROID = [00_Logradouro].ID 
                                          WHERE [60_OS].Id = :id AND [60_OS].Tecnico = :tecnico","id={$OSId}&tecnico={$PostData['Tecnico']}");
                    endif;

                    if ($Read->getResult()):
                        $jSON['trigger'] = AjaxErro("<b class='icon-checkmark'>OS retirada do técnico!");
                        $jSON['success'] = true;
                        $Update->ExeUpdate("[60_OS]", $Tecnico, "WHERE [60_OS].Id = :id", "id={$OSId}");
                        var_dump($Update->getResult());
                        $jSON['deltable'] = $OSId;
                    else:
                        $jSON['trigger'] = AjaxErro("<b class='icon-checkmark'>Erro ao retirar a OS!");
                        $jSON['success'] = true;
                    endif;
                endif;
            break;

        case 'consulta':
              //VERIFICA DE O FOI SELECIONADO TODOS OS TÉCNICOS
              if($PostData['semana'] == 1):
                if($PostData['Tecnico'] == 't'):
                    $Read->FullRead("SELECT NomeCliente, [60_OS].Id, [60_OS].Tecnico, [60_OS].[NomeOS],[60_OS].NumOS, [60_OS].Status, [60_OS].DataAgendamento, [60_Enderecos].ENDERECO, [60_OS].turno as TURNO,
                                          [00_Logradouro].LATITUDE, [00_Logradouro].LONGITUDE FROM [60_Clientes]
                                          inner join [60_OT] on [60_Clientes].Id = [60_OT].Cliente
                                          inner join [60_OS] on [60_OT].Id = [60_OS].OT
                                          inner join [60_Enderecos] on [60_Clientes].EnderecoId = [60_Enderecos].ID
                                          inner join [00_Logradouro] on [60_Enderecos].LOGRADOUROID = [00_Logradouro].ID
                                          WHERE [60_OS].Tecnico <> 0",NULL);
                else:
                    $Read->FullRead("SELECT NomeCliente, [60_OS].Id, [60_OS].Tecnico, [60_OS].[NomeOS],[60_OS].NumOS, [60_OS].Status, [60_OS].DataAgendamento, [60_Enderecos].ENDERECO, [60_OS].turno as TURNO,
                                          [00_Logradouro].LATITUDE, [00_Logradouro].LONGITUDE FROM [60_Clientes]
                                          inner join [60_OT] on [60_Clientes].Id = [60_OT].Cliente
                                          inner join [60_OS] on [60_OT].Id = [60_OS].OT
                                          inner join [60_Enderecos] on [60_Clientes].EnderecoId = [60_Enderecos].ID
                                          inner join [00_Logradouro] on [60_Enderecos].LOGRADOUROID = [00_Logradouro].ID 
                                          WHERE [60_OS].Tecnico = :tecnico","tecnico={$PostData['Tecnico']}");
                endif;
              endif;
              if ($Read->getResult()):
                  $jSON['addtable'] = null;
                  foreach ($Read->getResult() as $OS):
                      extract($OS);
                      $jSON['trigger'] = true;
                      $jSON['success'] = true;
                      $jSON['addtable'] .= "<tr class='j_tecnico' id='{$Id}'><td>{$NomeCliente}</td><td>{$NumOS}</td><td>{$NomeOS}</td><td>{$ENDERECO}</td><td>". date('d/m/Y', strtotime($DataAgendamento)) ."</td><td>{$Tecnico}</td><td>{$TURNO}</td><td><span rel='agendamentos' callback='Agendamentos' callback_action='delete' class='j_del_tecnico icon-cancel-circle btn btn_red' id='{$Id}'></span></td></td>";
                  endforeach;                   
              else:
                  $jSON['trigger'] = true;
                  $jSON['success'] = true;
                  $jSON['addtable'] = "<tr class='j_tecnico' id='semOS'><td>Sem O.S direcionada para esta tecnico</td></tr>";
              endif;
            break;

        case 'consultar_Os':
          $Id = $PostData['Id'];
          unset($PostData['Id']);
          $Update->ExeUpdate("[60_OS]", $PostData, " WHERE [Id] = :id", "id={$Id}");
          if($Read->getResult()):             
          else:
             $jSON['trigger'] = true;
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
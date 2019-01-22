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
                    $jSON['triggerErro'] = AjaxErro("SELECIONE PRIMEIRO UM TÉCNICO!", E_USER_WARNING); 
                else:
                    if($PostData['Tecnico'] == 't'):
                        $jSON['triggerErro'] = AjaxErro("DIRECIONE PARA APENAS UM TÉCNICO. A SELEÇÃO TODOS ESTÁ MARCADA!", E_USER_WARNING);
                    else:
                        $Read->FullRead("SELECT Id FROM [60_OS] WHERE [60_OS].Id = :id","id={$OSId}");
                        if ($Read->getResult()):
                            $jSON['trigger'] = AjaxErro("<b class='icon-checkmark no-print'>OS adicionada com sucesso ao técnico!");
                            $jSON['success'] = true;
                            $Update->ExeUpdate("[60_OS]", $PostData, "WHERE [60_OS].Id = :id", "id={$OSId}");
                            if($Update->getResult()):
                                $Read->FullRead("SELECT NomeCliente, [60_OS].Id IDOS, [60_OS].[OSServico],[60_OS].NumOS, [60_OS].NomeOS, [60_OS].Status, [60_OS].DataAgendamento, [60_OS].Endereco, [60_OS].Bairro, [60_OS].Municipio, [60_OS].turno as TURNO,
                                  [60_OS].Latitude, [60_OS].Longitude, IIF([Funcionários].[NOME COMPLETO] IS NOT NULL, [Funcionários].[NOME COMPLETO], FuncionariosTerceirizados.NOME) AS Tecnico, [00_NivelAcesso].[ID] AS IdTecnico FROM [60_Clientes]
                                  inner join [60_OT] on [60_Clientes].Id = [60_OT].Cliente
                                  inner join [60_OS] on [60_OT].Id = [60_OS].OT
                                  INNER JOIN [00_NivelAcesso] ON [60_OS].Tecnico = [00_NivelAcesso].ID
                                  LEFT JOIN  Funcionários ON [00_NivelAcesso].IDFUNCIONARIO = Funcionários.ID
                                  LEFT JOIN  FuncionariosTerceirizados ON [00_NivelAcesso].IDTERCEIRIZADO = FuncionariosTerceirizados.ID  
                                              WHERE [60_OS].Id = :id","id={$OSId}");
                                $jSON['addtable'] = "<tr class='j_tecnico' id='{$Read->getResult()[0]['IDOS']}'><td>{$Read->getResult()[0]['NomeCliente']}</td><td>{$Read->getResult()[0]['NumOS']}</td><td>{$Read->getResult()[0]['NomeOS']}</td><td>{$Read->getResult()[0]['Endereco']} {$Read->getResult()[0]['Bairro']} {$Read->getResult()[0]['Municipio']}</td><td>". date('d/m/Y', strtotime($Read->getResult()[0]['DataAgendamento'])) ."</td><td>". strstr($Read->getResult()[0]['Tecnico'], ' ', true)."</td><td>{$Read->getResult()[0]['TURNO']}</td><td class='no-print'><span rel='agendamentos' callback='Agendamentos' callback_action='delete' style='padding-right: 5px;margin-left: 20%;margin-right: 30%;margin-top: 10%;' class='j_del_tecnico icon-cross btn btn_red' id='{$Read->getResult()[0]['IDOS']}'></span></td></td></tr>";
                                 $jSON['idOS'] = $Read->getResult()[0]['IDOS'];
                            else:
                                 $jSON['trigger'] = AjaxErro("Erro ao adicionar OS ao Técnico! Por favor tente novamente.");           
                            endif;
                        else:
                            $jSON['trigger'] = AjaxErro("Erro ao adicionar OS!");
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
                        $Read->FullRead("SELECT [60_OS].Id FROM [60_OS] WHERE Id = :id","id={$OSId}");
                    if ($Read->getResult()):
                        $Update->ExeUpdate("[60_OS]", $Tecnico, "WHERE [60_OS].Id = :id", "id={$OSId}");
                        if($Update->getResult()):
                          $jSON['trigger'] = AjaxErro("<b class='icon-checkmark no-print'>OS retirada do técnico!");
                          $jSON['success'] = true;                        
                          $jSON['deltable'] = $OSId;

                          $Read->FullRead("SELECT  NomeCliente, [60_OS].Id, [60_OS].[OSServico], [60_OS].NomeOs,[60_OS].NumOS, [60_OS].Status, [60_OS].DataAgendamento, [60_OS].Endereco, [60_OS].Bairro, 
                            [60_OS].Tecnico, [60_OS].turno as TURNO,
                            [60_OS].Latitude, [60_OS].Longitude FROM [60_Clientes]
                            inner join [60_OT] on [60_Clientes].Id = [60_OT].Cliente
                            inner join [60_OS] on [60_OT].Id = [60_OS].OT
                            WHERE [60_OS].Id = :id","id={$OSId}");
                          foreach ($Read->getResult() as $marker): 
                            extract($marker);
                          $data = date("d/m/Y", strtotime($DataAgendamento));
                            $jSON['infowindow'] = "<div class='info-window'><h3 class='m_bottom'>{$OSServico}</h3><div class='info-content'><p>OS: <b>{$NumOS}</b></p><p>Cliente: <b>{$NomeCliente}</b></p><p>Serviço: <b>{$NomeOs}</b></p><p>Endereço: <b>{$Endereco}, {$Bairro}</b></p><p>Data: <b>{$data}</b></p><span rel='single_message' callback='Agendamentos' callback_action='addTecnico' class='j_add_tecnico icon-plus btn btn_darkblue' id='{$Id}'>Add</span></div></div>";
                            $jSON['latitude'] = $Latitude;
                            $jSON['longitude'] = $Longitude;
                          endforeach;
                        else:
                          $jSON['trigger'] = AjaxErro("Erro ao tentar retirar a OS do Técnico!");
                        endif;
                    else:
                        $jSON['trigger'] = AjaxErro("Erro ao retirar a OS!");
                        $jSON['success'] = true;
                    endif;
                endif;
            break;

        case 'consulta':
              //VERIFICA DE O FOI SELECIONADO TODOS OS TÉCNICOS              
              if($PostData['semana'] == 1):
                if($PostData['Tecnico'] == 't'):
                    $Read->FullRead("SELECT NomeCliente, [60_OS].Id IDOS, [60_OS].[OSServico],[60_OS].NumOS, [60_OS].NomeOS, [60_OS].Status, [60_OS].DataAgendamento, [60_OS].Endereco, [60_OS].Bairro, [60_OS].Municipio, [60_OS].turno as TURNO,
                      [60_OS].Latitude, [60_OS].Longitude, IIF([Funcionários].[NOME COMPLETO] IS NOT NULL, [Funcionários].[NOME COMPLETO], FuncionariosTerceirizados.NOME) AS Tecnico, [00_NivelAcesso].[ID] AS IdTecnico FROM [60_Clientes]
                      inner join [60_OT] on [60_Clientes].Id = [60_OT].Cliente
                      inner join [60_OS] on [60_OT].Id = [60_OS].OT
                      INNER JOIN [00_NivelAcesso] ON [60_OS].Tecnico = [00_NivelAcesso].ID
                      LEFT JOIN  Funcionários ON [00_NivelAcesso].IDFUNCIONARIO = Funcionários.ID
                      LEFT JOIN  FuncionariosTerceirizados ON [00_NivelAcesso].IDTERCEIRIZADO = FuncionariosTerceirizados.ID  
                                          WHERE [60_OS].Tecnico <> 0 AND DatePart(Week,[60_OS].DataAgendamento) = DatePart(Week,GETDATE()) AND year([60_OS].DataAgendamento) = year(GETDATE())",NULL);
                else:
                    $Read->FullRead("SELECT NomeCliente, [60_OS].Id IDOS, [60_OS].[OSServico],[60_OS].NumOS, [60_OS].NomeOS, [60_OS].Status, [60_OS].DataAgendamento, [60_OS].Endereco, [60_OS].Bairro, [60_OS].Municipio, [60_OS].turno as TURNO,
                      [60_OS].Latitude, [60_OS].Longitude, IIF([Funcionários].[NOME COMPLETO] IS NOT NULL, [Funcionários].[NOME COMPLETO], FuncionariosTerceirizados.NOME) AS Tecnico, [00_NivelAcesso].[ID] AS IdTecnico FROM [60_Clientes]
                      inner join [60_OT] on [60_Clientes].Id = [60_OT].Cliente
                      inner join [60_OS] on [60_OT].Id = [60_OS].OT
                      INNER JOIN [00_NivelAcesso] ON [60_OS].Tecnico = [00_NivelAcesso].ID
                      LEFT JOIN  Funcionários ON [00_NivelAcesso].IDFUNCIONARIO = Funcionários.ID
                      LEFT JOIN  FuncionariosTerceirizados ON [00_NivelAcesso].IDTERCEIRIZADO = FuncionariosTerceirizados.ID  
                                          WHERE [60_OS].Tecnico = :tecnico  AND DatePart(Week,[60_OS].DataAgendamento) = DatePart(Week,GETDATE()) AND year([60_OS].DataAgendamento) = year(GETDATE())","tecnico={$PostData['Tecnico']}");
                endif;
              else:
                if($PostData['Tecnico'] == 't'):
                  $Read->FullRead("SELECT NomeCliente, [60_OS].Id IDOS, [60_OS].[OSServico],[60_OS].NumOS, [60_OS].NomeOS, [60_OS].Status, [60_OS].DataAgendamento, [60_OS].Endereco, [60_OS].Bairro, [60_OS].Municipio, [60_OS].turno as TURNO,
                    [60_OS].Latitude, [60_OS].Longitude, IIF([Funcionários].[NOME COMPLETO] IS NOT NULL, [Funcionários].[NOME COMPLETO], FuncionariosTerceirizados.NOME) AS Tecnico, [00_NivelAcesso].[ID] AS IdTecnico FROM [60_Clientes]
                    inner join [60_OT] on [60_Clientes].Id = [60_OT].Cliente
                    inner join [60_OS] on [60_OT].Id = [60_OS].OT
                    INNER JOIN [00_NivelAcesso] ON [60_OS].Tecnico = [00_NivelAcesso].ID
                    LEFT JOIN  Funcionários ON [00_NivelAcesso].IDFUNCIONARIO = Funcionários.ID
                    LEFT JOIN  FuncionariosTerceirizados ON [00_NivelAcesso].IDTERCEIRIZADO = FuncionariosTerceirizados.ID  
                                            WHERE [60_OS].[DataAgendamento] = :dia","dia={$PostData['dia']}");
                else:
                  $Read->FullRead("SELECT NomeCliente, [60_OS].Id IDOS, [60_OS].[OSServico],[60_OS].NumOS, [60_OS].NomeOS, [60_OS].Status, [60_OS].DataAgendamento, [60_OS].Endereco, [60_OS].Bairro, [60_OS].Municipio, [60_OS].turno as TURNO,
                    [60_OS].Latitude, [60_OS].Longitude, IIF([Funcionários].[NOME COMPLETO] IS NOT NULL, [Funcionários].[NOME COMPLETO], FuncionariosTerceirizados.NOME) AS Tecnico, [00_NivelAcesso].[ID] AS IdTecnico FROM [60_Clientes]
                    inner join [60_OT] on [60_Clientes].Id = [60_OT].Cliente
                    inner join [60_OS] on [60_OT].Id = [60_OS].OT
                    INNER JOIN [00_NivelAcesso] ON [60_OS].Tecnico = [00_NivelAcesso].ID
                    LEFT JOIN  Funcionários ON [00_NivelAcesso].IDFUNCIONARIO = Funcionários.ID
                    LEFT JOIN  FuncionariosTerceirizados ON [00_NivelAcesso].IDTERCEIRIZADO = FuncionariosTerceirizados.ID  
                                            WHERE [60_OS].Tecnico = :tecnico AND [60_OS].[DataAgendamento] = :dia","tecnico={$PostData['Tecnico']}&dia={$PostData['dia']}");
                endif;
              endif;
              if ($Read->getResult()):
                  $jSON['addtable'] = null;
                  foreach ($Read->getResult() as $OS):
                      extract($OS);
                      
                        //MOSTRA O STATUS DO CHAMADO CASO O MESMO SEJA DIFERENTE DE '0'
                        if ($Status == 0):
                          $sts = "<td class='no-print'><span style='padding-right: 5px;margin-left: 15%;margin-right: 30%;margin-top: 10%;' rel='agendamentos' callback='Agendamentos'callback_action='delete' class='j_del_tecnico icon-cross btn btn_red' id='{$IDOS}'></span></td>";
                        else:
                          $sts = "<td class='no-print'><span style='padding-right: 5px;margin-left: 15%;margin-right: 30%;margin-top: 10%;'><img src='_img\check.png'></span></td>";
                        endif;

                      $jSON['trigger'] = true;
                      $jSON['success'] = true;
                      $jSON['addtable'] .= "
                      <tr class='j_tecnico'>
                      <td>{$NomeCliente}</td>
                      <td>{$NumOS}</td>
                      <td>{$NomeOS}</td>
                      <td>{$Endereco} {$Bairro} {$Municipio}</td>
                      <td>". date('d/m/Y', strtotime($DataAgendamento)) ."</td>
                      <td style='text-align: center; vertical-align: middle'>". strstr($Tecnico, ' ', true)."</td>
                      <td style='text-align: center; vertical-align: middle'>{$TURNO}</td>".
                      $sts
                      ."</tr>";
                      $jSON['idOS'] = $IDOS;
                  endforeach;                   
              else:
                  $jSON['trigger'] = true;
                  $jSON['success'] = true;
                  $jSON['addtable'] = "<tr class='j_tecnico no-print' id='semOS'><td>Sem O.S direcionada para esta tecnico</td></tr>";
              endif;
            break;

        case 'consultar_Os':
          $Id = $PostData['Id'];
          unset($PostData['Id']);
          $Update->ExeUpdate("[60_OS]", $PostData, " WHERE [Id] = :id", "id={$Id}");
          if($Update->getResult()):             
          else:
             $jSON['trigger'] = true;
          endif;
        break;

         case 'os_s_end':

         $Read->FullRead("SELECT Id, Endereco, Bairro, Municipio, Cep, Latitude, Longitude FROM [60_OS] WHERE Latitude IS NULL AND Longitude IS NULL"," ");

             
              if ($Read->getResult()):

                  $jSON['OS_sem_end'] = null;
                  foreach ($Read->getResult() as $os_s_end):
                      $jSON['trigger'] = true;
                      $jSON['OS_sem_end'] .= "
                      <tr class='j_table_S_END' id='{$os_s_end['Id']}'>
                      <td style='padding-left: 10px;'>{$os_s_end['Endereco']}</td>
                      <td style='padding-left: 10px;'>{$os_s_end['Bairro']}</td>
                      <td style='text-align: center;'>{$os_s_end['Municipio']}</td>
                      <td style='text-align: center;'>{$os_s_end['Cep']}</td>

                      <form id='{$os_s_end['Id']}'><td style='text-align: center;'><input type='text' id='lat{$os_s_end['Id']}' name='latitude' placeholder='Inserir Latitude'/></td>
                      <td style='text-align: center;'><input type='text' id='lng{$os_s_end['Id']}' name='longitude' placeholder='Inserir Longitude'/></td>

                      <td style='text-align: center;'><span class='btn btn_darkblue j_inserir_coord' callback='Agendamentos' callback_action='inserir_coord' id='{$os_s_end['Id']}'><i class='icon-plus'></i>Adicionar</span></td></form>

                      </tr>";
                  endforeach;                   
              else:
                  $jSON['trigger'] = true;
                  $jSON['OS_sem_end'] = "<tr class='j_table_S_END'><td colspan='7' style='font-size: 15px;'><center>Nenhum endereço foi encontrado</center></td></tr>";
                endif;
                break;

                case 'inserir_coord':
                $coord_id = $PostData['Id'];
                unset($PostData['Id']);

                if(empty($PostData['Latitude']) || empty($PostData['Longitude'])):
                    $jSON['Trigger'] = AjaxErro('<b class="icon-warning">OPSS:</b> Insira valor de Latitude e Longitude!', E_USER_WARNING);
                 else:
                 $Update->ExeUpdate("[60_OS]", $PostData, " WHERE [Id] = :id", "id={$coord_id}");
                 if($Update->getResult()):  
                  $jSON['exclui_linha'] = $coord_id;           
                else:
                 $jSON['trigger'] = true;

               endif;
             endif;
             break;
             case 'importOs_manual':
               if (empty($Upload)):
                  $Upload = new Upload('//192.168.0.101/Robo');
                endif;
                 
                if(isset($_FILES['os_manual'])){

                 if($_FILES['os_manual']['type'] == 'application/vnd.ms-excel'){

                      $Upload->File($_FILES['os_manual'], "gns", '/');
                      
                     if ($Upload->getResult()):
                           $jSON['trigger'] = AjaxErro('Arquivo enviado com sucesso!', E_USER_ERROR);
                        $Read->FullRead("exec [60_ImportacaoGNS]");
                    endif;
                      
                    }else {
                      $jSON['trigger'] = AjaxErro('ATENÇÃO: Só é permitido arquivo CSV (Excel)', E_USER_WARNING);
                    }

                }
                 
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
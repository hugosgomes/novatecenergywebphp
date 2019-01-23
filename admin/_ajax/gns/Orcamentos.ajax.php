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
$Data = new DateTime();
//VALIDA AÇÃO
if ($PostData && $PostData['callback_action'] && $PostData['callback'] == $CallBack):
    //PREPARA OS DADOS
    $Case = $PostData['callback_action'];
    unset($PostData['callback'], $PostData['callback_action']);

    // AUTO INSTANCE OBJECT READ
    if (empty($Read)):
        $Read = new Read;
    endif;

    if (empty($Update)):
        $Update = new Update;
    endif;
    if (empty($Create)):
        $Create = new Create;
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
            $Read->FullRead("SELECT [60_Orcamentos].id,[60_Clientes].Id, [60_Clientes].NumCliente, [60_OS].NumOS, [60_OS].Endereco + ', ' + [60_OS].Bairro + ' - ' + [60_OS].Municipio AS ENDERECO,
                            [60_OS].NomeOs, [60_Orcamentos].Status FROM [60_Clientes] INNER JOIN [60_OT] ON [60_Clientes].Id = [60_OT].Cliente INNER JOIN [60_OS] ON [60_OT].Id = [60_OS].OT
                            INNER JOIN [60_Orcamentos] ON [60_OS].Id = [60_Orcamentos].idOS" . $where,"");
                if ($Read->getResult()):
                    foreach ($Read->getResult() as $orcamentos):
                        extract($orcamentos);
                        $orcamentos_NumCliente = str_replace(".0", "", $orcamentos['NumCliente']);
                        if($Status == 1){
                            $Status = "APROVADO";
                        }else if($Status == 2){
                            $Status = "EXECUTADO";
                        }else if($Status == 3){
                            $Status = "RECUSADO";
                        }else if($Status == 4){
                            $Status = "RECUPERADO";
                        }
                        $jSON['addTabela'] .= "<tr class='pointer' idOrcamento = '{$orcamentos['id']}' idCliente='{$Id}'  callback='Orcamentos' callback_action='detalhes' style='font-size:13.5px'>
                                                    <td>{$orcamentos_NumCliente}</td>
                                                    <td>{$NumOS}</td>
                                                    <td>{$ENDERECO}</td>
                                                    <td>{$NomeOs}</td>
                                                    <td>{$Status}</td>
                                               </tr>";
                    endforeach;
                else:
                    $jSON['addTabela'] = "<tr><td colspan='4'><center>Nenhuma informação</center></td></tr>";
                endif;


            //SOMATÓRIO DE VALOR APROVADO
            $Read->FullRead("SELECT SUM([60_Orcamentos].Valor) SOMA FROM [60_Clientes] INNER JOIN [60_OT] ON [60_Clientes].Id = [60_OT].Cliente INNER JOIN [60_OS] ON [60_OT].Id = [60_OS].OT INNER JOIN [60_Orcamentos] ON [60_OS].Id = [60_Orcamentos].idOS WHERE [60_Orcamentos].Status = 1","");
                if (!empty($Read->getResult()[0]['SOMA'])):
                    foreach ($Read->getResult() as $orcamentos):
                        $valor = number_format($orcamentos['SOMA'],2,',','.');
                        $jSON['addAprovado'] = "R$ " . $valor;
                    endforeach;
                else:
                    $jSON['addAprovado'] = "R$ ". 0;
                endif;

            //SOMATÓRIO DE VALOR REPROVADO
            $Read->FullRead("SELECT SUM([60_Orcamentos].Valor) SOMA FROM [60_Clientes] INNER JOIN [60_OT] ON [60_Clientes].Id = [60_OT].Cliente INNER JOIN [60_OS] ON [60_OT].Id = [60_OS].OT INNER JOIN [60_Orcamentos] ON [60_OS].Id = [60_Orcamentos].idOS WHERE [60_Orcamentos].Status = 3","");
                if (!empty($Read->getResult()[0]['SOMA'])):
                    foreach ($Read->getResult() as $orcamentos):
                        $valor = number_format($orcamentos['SOMA'],2,',','.');
                        $jSON['addReprovado'] = "R$ " . $valor;
                    endforeach;
                else:
                    $jSON['addReprovado'] = "R$ ". 0;
                endif;


            //SOMATÓRIO DE VALOR EXECUTADO
            $Read->FullRead("SELECT SUM([60_Orcamentos].Valor) SOMA FROM [60_Clientes] INNER JOIN [60_OT] ON [60_Clientes].Id = [60_OT].Cliente INNER JOIN [60_OS] ON [60_OT].Id = [60_OS].OT INNER JOIN [60_Orcamentos] ON [60_OS].Id = [60_Orcamentos].idOS WHERE [60_Orcamentos].Status = 2","");
                if (!empty($Read->getResult()[0]['SOMA'])):
                    foreach ($Read->getResult() as $orcamentos):
                        $valor = number_format($orcamentos['SOMA'],2,',','.');
                        $jSON['addExecutado'] = "R$ " . $valor;
                    endforeach;
                else:
                    $jSON['addExecutado'] = "R$ ". 0;
                endif;
        break;


        case 'detalhes':
                
            $jSON['addDetalhes'] = null;
            //INFORMAÇÕES DETALHADAS
            $Read->FullRead("SELECT CONVERT(NVARCHAR,[60_Orcamentos].DataEnt,103) AS DataEnt, IIF(Func1.ID is not null, Func1.[NOME COMPLETO], Func2.NOME) AS TecnicoEnt, 
            IIF(Funcionários.ID is not null, Funcionários.[NOME COMPLETO], FuncionariosTerceirizados.NOME) AS TecnicoExe,
            CONVERT(NVARCHAR,[60_Orcamentos].DataExe,103) AS DataExe, [60_Orcamentos].Status, [60_Orcamentos].Valor,CONVERT(NVARCHAR,[60_Orcamentos].DataAgendamento,103) AS DataAgend FROM [60_Orcamentos]
            LEFT JOIN [00_NivelAcesso] ON [60_Orcamentos].TecExe = [00_NivelAcesso].ID
            INNER JOIN [00_NivelAcesso]  NivelAcesso ON [60_Orcamentos].TecnicoEnt = NivelAcesso.ID
            INNER JOIN [60_OS] ON [60_Orcamentos].IdOS = [60_OS].Id
            LEFT JOIN  Funcionários ON [00_NivelAcesso].IDFUNCIONARIO = Funcionários.ID
            LEFT JOIN [60_OS_ServicosAPP] ON [60_Orcamentos].ID = [60_OS_ServicosAPP].IDOrcamento
            LEFT JOIN [60_OS_PecasAPP] ON [60_Orcamentos].ID = [60_OS_PecasAPP].IDOrcamento  
            LEFT JOIN  FuncionariosTerceirizados ON [00_NivelAcesso].IDTERCEIRIZADO = FuncionariosTerceirizados.ID
            LEFT JOIN  Funcionários  Func1 ON NivelAcesso.IDFUNCIONARIO = Func1.ID
            LEFT JOIN  FuncionariosTerceirizados Func2 ON NivelAcesso.IDTERCEIRIZADO = Func2.ID WHERE [60_Orcamentos].ID = " . $PostData['idOrcamento'],"");
            if (!empty($Read->getResult())):
                    foreach ($Read->getResult() as $detalhes):
                      extract($detalhes);
                        $valor = number_format($Valor,2,',','.');
                        $status = getStatusOrcamentoGNS($detalhes['Status']);
                        $jSON['addDetalhes'] = $Status == 3  ? "
                              <br>
                              <li><span>Data Entrada: </span>{$detalhes['DataEnt']}</li>
                              <li><span>Técnico Entrada: </span>{$detalhes['TecnicoEnt']}</li>
                              <li><span>Data Agendamento: </span>{$detalhes['DataAgend']}</li>
                              <li><span>Data Execução: </span>{$detalhes['DataExe']}</li>
                              <li><span>Técnico Execução: </span>{$detalhes['TecnicoExe']}</li>
                              <li><span>Status: </span>$status</li>
                              <li><span>Valor:</span> (R$)  $valor</li>
                              <li><center><a id='j_btn_editar' class='btn btn_darkblue icon-share'  href='#j_modal' rel='modal:open' callback='Orcamentos' callback_action='editar' idOrcamento='{$PostData['idOrcamento']}'>CONTATOS</a></center></li>" : "<br>
                              <li><span>Data Entrada: </span>{$detalhes['DataEnt']}</li>
                              <li><span>Técnico Entrada: </span>{$detalhes['TecnicoEnt']}</li>
                              <li><span>Data Agendamento: </span>{$detalhes['DataAgend']}</li>
                              <li><span>Data Execução: </span>{$detalhes['DataExe']}</li>
                              <li><span>Técnico Execução: </span>{$detalhes['TecnicoExe']}</li>
                              <li><span>Status: </span>$status</li>
                              <li><span>Valor:</span> (R$)  $valor</li>";
                    endforeach;
                else:
                    $jSON['addDetalhes'] = 0;
                endif;

            //TABELA SERVIÇOS
                $jSON['addServicos'] = null;
                   $Read->FullRead("SELECT [60_Orcamentos].ID,  [60_OS_ListaServicos].Descricao AS NomeServico, [60_OS_ServicosAPP].Qtd AS QtdServico, [60_OS_ServicosAPP].Valor AS ValorServico FROM [60_Orcamentos]
                    INNER JOIN [60_OS_ServicosAPP] ON [60_Orcamentos].ID = [60_OS_ServicosAPP].IDOrcamento
                    INNER JOIN [60_OS_ListaServicos] ON [60_OS_ServicosAPP].ID_servico = [60_OS_ListaServicos].Id

                    WHERE [60_Orcamentos].ID = " . $PostData['idOrcamento'],"");
            if ($Read->getResult()):
                    foreach ($Read->getResult() as $Servicos):
                        $totalServico = $Servicos['QtdServico'] * $Servicos['ValorServico'];
                        $TotalServico = number_format($totalServico,2,',','.');
                        $valorServico = number_format($Servicos['ValorServico'],2,',','.');
                        $jSON['addServicos'] .= "
                        <tr class='j_Servicos linha' idOrcamento='{$PostData['idOrcamento']}'>
                         <td style='width: 50%;'>{$Servicos['NomeServico']}</td>
                         <td>{$Servicos['QtdServico']}</td>
                         <td>{$valorServico}</td>
                         <td>{$TotalServico}</td>
                        </tr>";
                           $jSON['Servico'] = "{$totalServico}";
                    endforeach;
                else:
                    $jSON['addServicos'] = "
                        <tr class='j_Pecas' idOrcamento='{$PostData['idOrcamento']}'>
                         <td style='width: 50%;'></td>
                         <td></td>
                         <td></td>
                         <td></td>
                         </tr>";
                         $jSON['Servico'] = "0";

                endif;
            //TABELA PEÇAS
                $jSON['addPecas'] = null;

                   $Read->FullRead("SELECT [60_Orcamentos].ID, [60_Pecas].Peca AS NomePeca, [60_OS_PecasAPP].Qtd AS QtdPeca, [60_OS_PecasAPP].Valor AS ValorPeca FROM [60_Orcamentos]
                    INNER JOIN [60_OS_PecasAPP] ON [60_Orcamentos].ID = [60_OS_PecasAPP].IDOrcamento
                    INNER JOIN [60_Pecas] ON [60_OS_PecasAPP].ID_Pecas = [60_Pecas].Id
                    WHERE [60_Orcamentos].ID = " . $PostData['idOrcamento'],"");
            if ($Read->getResult()):
              $Pecas = NULL;
                    foreach ($Read->getResult() as $Pecas):
                        $totalPecas = $Pecas['QtdPeca'] * $Pecas['ValorPeca'];
                        $TotalPecas = number_format($totalPecas,2,',','.');
                        $valorPecas = number_format($Pecas['ValorPeca'],2,',','.');
                        $jSON['addPecas'] .= "
                        <tr class='j_Pecas linha' idOrcamento='{$PostData['idOrcamento']}'>
                         <td style='width: 50%;'>{$Pecas['NomePeca']}</td>
                         <td>{$Pecas['QtdPeca']}</td>
                         <td>{$valorPecas}</td>
                         <td>{$TotalPecas}</td>
                        </tr>";
                        $jSON['Peca'] = "{$totalPecas}";
                    endforeach;
                else:
                    $jSON['addPecas'] = "
                        <tr class='j_Pecas' idOrcamento='{$PostData['idOrcamento']}'>
                         <td style='width: 50%;'></td>
                         <td></td>
                         <td></td>
                         <td></td>
                         </tr>";
                         $jSON['Peca'] = "0";
                endif;

                //TABELA orçamento
                $jSON['addOrcamentos'] = null;
                   $Read->FullRead("SELECT [60_Orcamentos].Valor,[60_Orcamentos].ID,[NumParcelas] AS parcelas,[60_OS_ServicosAPP].Qtd AS QtdServico,[60_OS_ServicosAPP].Valor AS ValorServico,[60_OS_PecasAPP].Qtd AS QTDPecas,[60_OS_PecasAPP].Valor AS ValorPecas FROM [60_Orcamentos]
                LEFT JOIN [60_OS_ServicosAPP] ON [60_Orcamentos].ID = [60_OS_ServicosAPP].IDOrcamento
                LEFT JOIN [60_OS_PecasAPP] ON [60_Orcamentos].ID = [60_OS_PecasAPP].IDOrcamento 
                WHERE [60_Orcamentos].ID = " . $PostData['idOrcamento'],"");
            if (!empty($Read->getResult())):
                    foreach ($Read->getResult() as $Orcamentos):
                        extract($Orcamentos);

                        if($parcelas == 0 || $parcelas == NULL){
                            unset($parcelas);
                            $parcelas = 1;
                        }

                        $vParcelas = $Valor / $parcelas;
                        $Valor = number_format($Valor,2,',','.');
                        $VParcelas = number_format($vParcelas,2,',','.');

                        $jSON['addOrcamentos'] = "
                        <tr class='j_Orcamentos linha' idOrcamento='{$PostData['idOrcamento']}'>
                         <td style='width: 50%;'>{$parcelas}</td>
                         <td>{$VParcelas}</td>
                         <td>{$Valor}</td>
                        </tr>";

                        $jSON['orcamento'] = "{$valor}";
                    endforeach;
                else:
                    $jSON['addPecas'] = "
                        <tr class='j_Pecas' idOrcamento='{$PostData['idOrcamento']}'>
                         <td style='width: 50%;'></td>
                         <td></td>
                         <td></td>
                         <td></td>
                         </tr>";
                         $jSON['Peca'] = "0";
                endif;
        break;

        case 'editar':
            $Read->FullRead("SELECT DataContato,Status,Obs,IdOS,IdOrcamento FROM [60_ContatosOrcamento] WHERE IdOrcamento = {$PostData['idOrcamento']}", "");
            if($Read->getResult()){
              $jSON['addContatos'] = null;
              $value = null;
              $time = [];
              foreach ($Read->getResult() as $value) {

                extract($value);
                //RECEBE HORA E DATA
                $time = $DataContato;
                list($data,$hora) = explode(" ", $time);
                //CONVERTE STATUS EM TEXTO
                $status = $Status == 0 ? "Retornar Depois" : "Contato Feito";
                //RETORNO AJAX
                  $jSON['addContatos'] .= "
                  <tr>
                    <td>".date("d/m/Y",strtotime($data))."</td>
                    <td>".date("H:i",strtotime($hora))."</td>
                    <td>{$status}</td>
                    <td>{$Obs}</td>
                  </tr>
                ";
              }
              $jSON['addIdOrca'] = $PostData["idOrcamento"];
              $jSON["addIdOS"] = $IdOS;
            }
            if($PostData['idOrcamento']):
            $jSON['addTecnicos'] = null;
            $jSON['addStatus'] = null;
            $jSON['addId'] = $PostData['idOrcamento'];

            //DADOS PARA PREENCHER OS SELECTS DO MODAL
            $Read->FullRead("SELECT [00_NivelAcesso].ID, CASE WHEN FUNC.ID IS NOT NULL THEN FUNC.[NOME COMPLETO] ELSE TERC.NOME END AS NOME
            FROM [00_NivelAcesso] LEFT JOIN Funcionários FUNC ON [00_NivelAcesso].IDFUNCIONARIO = FUNC.ID
            LEFT JOIN FuncionariosTerceirizados TERC ON [00_NivelAcesso].IDTERCEIRIZADO = TERC.ID
            WHERE MOBILE_GNS = 1 AND FUNC.[DATA DE DEMISSÃO] IS NULL ORDER BY NOME","");
            if ($Read->getResult()):
                foreach ($Read->getResult() as $tecnicos):
                    $jSON['addTecnicos'] .= "<option value = '{$tecnicos['ID']}'>{$tecnicos['NOME']}</option>";
                endforeach;
            else:
                $jSON['addTecnicos'] = "<option value = 't'>SELECIONE UM TÉCNICO</option>";
            endif;

            foreach (getStatusOrcamentoGNS() as $key => $value) {
                $jSON['addStatus'] .= "<option value = '{$key}'>{$value}</option>";
            }

            //DADOS PARA PREENCHER OS CAMPOS DO MODAL COM AS INFORMAÇÕES ATUAIS DO ORÇAMENTO
            $Read->FullRead("SELECT * FROM [60_Orcamentos] WHERE ID = " . $PostData['idOrcamento'],"");
            
            if ($Read->getResult()):
                foreach ($Read->getResult() as $key => $value):
                    $jSON[$key] = $value;
                endforeach;
            endif;
          endif;
        break;

        case 'atualizar':
            if(in_array('', $PostData) || in_array('t', $PostData)):
                $jSON['trigger'] = AjaxErro('<b class="icon-warning">Um ou mais campos em branco!</b>', E_USER_ERROR);
            else:
                if(isset($PostData["Valor"])):
                    $PostData["Valor"] = str_replace("." , "" , $PostData["Valor"]); // Primeiro tira os pontos
                    $PostData["Valor"] = str_replace("," , "." , $PostData["Valor"]); // Substitui a vírgula pelo ponto
                endif;

                $PostData['DataExe'] = NULL;
                $PostData['DataRecuperacao'] = $Data->format('Ymd H:i:s');
                $clientesSemOT = array(
                    'IDCLIENTE' => $PostData['Idcliente'],
                    'IDOS' =>  NULL,
                    'DATAAGENDAMENTO' => $PostData['DataAgendamento'],
                    'USUARIOSISTEMA' => $PostData['usuario'],
                    'IDORCAMENTO' => $PostData['ID']
                );

                $Create->Execreate("[60_ClientesSemOT]",$clientesSemOT);

                $id = $PostData['ID'];
                unset($PostData['ID']);
                unset($PostData['Idcliente']);
                unset($PostData['usuario']);
                $Update->ExeUpdate("[60_Orcamentos]", $PostData, "WHERE [60_Orcamentos].ID = :id", "id={$id}");
                $jSON['trigger'] = AjaxErro('<b class="icon-checkmark">Orçamento Atualizado Com Êxito!</b>', E_USER_ERROR);
                $jSON['ID'] = $id;
            endif;
            
        break;
        case 'salvar_contato':
          if($PostData['status'] != "t"){
            if($PostData['Obs'] != null){

            $salvar_contato = array(
              'Status' => $PostData['status'],
              'Obs' => $PostData['Obs'],
              'IdOS' => $PostData['IdOs'],
              'IdOrcamento' => $PostData['IdOrc']
            );

            $Create->Execreate("[60_ContatosOrcamento]",$salvar_contato);
            $jSON["trigger"] = AjaxErro('<b class="icon-checkmark">Contato registrado com exito!</b>', E_USER_ERROR);
            }else{
              $jSON["trigger"] = AjaxErro('<b class="icon-warning">Preencher campo Observação!</b>', E_USER_ERROR);
            }
          }else{
            $jSON["trigger"] = AjaxErro('<b class="icon-warning">Selecionar Status contato!</b>', E_USER_ERROR);
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
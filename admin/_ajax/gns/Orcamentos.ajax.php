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
    if(empty($Orcamento)):
      $Orcamento = new Orcamento;
    endif;
    if(empty($ItensOrcamento)):
      $ItensOrcamento = new ItensOrcamento;
    endif;
    //SELECIONA AÇÃO
    switch ($Case):
        case 'consulta':

            $jSON['addTabela'] = null;
            $jSON['addAprovado'] = 0;
            $jSON['addReprovado'] = 0;
            $jSON['addExecutado'] = 0;
            $where = "";
            $innerJoin = "";

            $innerJoin = $PostData['StatusContato'] != 't' ? ' INNER JOIN [60_ContatosOrcamento] ON [60_Orcamentos].id = [60_ContatosOrcamento].IdOrcamento ' : "";
            $where .= $PostData['ano'] != 't' ? ' AND YEAR([60_Orcamentos].DataEnt) = ' . $PostData['ano'] . " " : "";
            $where .= $PostData['mes'] != 't' ? ' AND MONTH([60_Orcamentos].DataEnt) = ' . $PostData['mes'] . " " : "";
            $where .= $PostData['Status'] != 't' ? ' AND [60_Orcamentos].Status = ' . $PostData['Status'] . " " : "";
            $where .= $PostData['StatusContato'] != 't' ? ' AND [60_ContatosOrcamento].Status = ' . $PostData['StatusContato'] . " " : "";
            $where = substr($where, 5);
            $where = $where ? " WHERE " . $where : "";

            //Carrega e retorna os dados da tabela
            $Read->FullRead("SELECT distinct [60_Orcamentos].id,[60_Clientes].Id, [60_Clientes].NumCliente, [60_OS].NumOS, [60_OS].Endereco + ', ' + [60_OS].Bairro + ' - ' + [60_OS].Municipio AS ENDERECO,
                            [60_OS].NomeOs, [60_Orcamentos].Status FROM [60_Clientes] INNER JOIN [60_OT] ON [60_Clientes].Id = [60_OT].Cliente INNER JOIN [60_OS] ON [60_OT].Id = [60_OS].OT
                            INNER JOIN [60_Orcamentos] ON [60_OS].Id = [60_Orcamentos].idOS" . $innerJoin . $where,"");
                if ($Read->getResult()):
                    foreach ($Read->getResult() as $orcamentos):
                        extract($orcamentos);
                        $orcamentos_NumCliente = str_replace(".0", "", $orcamentos['NumCliente']);
                        $jSON['addTabela'] .= "<tr class='pointer' idOrcamento = '{$orcamentos['id']}' idCliente='{$Id}'  callback='Orcamentos' callback_action='detalhes' style='font-size:13.5px'>
                                                    <td>{$orcamentos_NumCliente}</td>
                                                    <td>{$NumOS}</td>
                                                    <td>{$ENDERECO}</td>
                                                    <td>{$NomeOs}</td>
                                                    <td>{$Orcamento->getStatus($Status)}</td>
                                               </tr>";
                    endforeach;
                else:
                    $jSON['addTabela'] = "<tr><td colspan='4'><center>Nenhuma informação</center></td></tr>";
                endif;


            //SOMATÓRIO DE VALOR APROVADO
            $Read->FullRead("SELECT SUM([60_Orcamentos].Valor) SOMA FROM [60_Clientes] INNER JOIN [60_OT] ON [60_Clientes].Id = [60_OT].Cliente INNER JOIN [60_OS] ON [60_OT].Id = [60_OS].OT INNER JOIN [60_Orcamentos] ON [60_OS].Id = [60_Orcamentos].idOS WHERE [60_Orcamentos].Status = 1","");
                if (!empty($Read->getResult()[0]['SOMA'])):
                    foreach ($Read->getResult() as $orcamentos):
                        $jSON['addAprovado'] = "R$ " . $Orcamento->getValor($orcamentos['SOMA']);
                    endforeach;
                else:
                    $jSON['addAprovado'] = "R$ ". 0;
                endif;

            //SOMATÓRIO DE VALOR REPROVADO
            $Read->FullRead("SELECT SUM([60_Orcamentos].Valor) SOMA FROM [60_Clientes] INNER JOIN [60_OT] ON [60_Clientes].Id = [60_OT].Cliente INNER JOIN [60_OS] ON [60_OT].Id = [60_OS].OT INNER JOIN [60_Orcamentos] ON [60_OS].Id = [60_Orcamentos].idOS WHERE [60_Orcamentos].Status = 3","");
                if (!empty($Read->getResult()[0]['SOMA'])):
                    foreach ($Read->getResult() as $orcamentos):
                        $jSON['addReprovado'] = "R$ " . $Orcamento->getValor($orcamentos['SOMA']);
                    endforeach;
                else:
                    $jSON['addReprovado'] = "R$ ". 0;
                endif;


            //SOMATÓRIO DE VALOR EXECUTADO
            $Read->FullRead("SELECT SUM([60_Orcamentos].Valor) SOMA FROM [60_Clientes] INNER JOIN [60_OT] ON [60_Clientes].Id = [60_OT].Cliente INNER JOIN [60_OS] ON [60_OT].Id = [60_OS].OT INNER JOIN [60_Orcamentos] ON [60_OS].Id = [60_Orcamentos].idOS WHERE [60_Orcamentos].Status = 2","");
                if (!empty($Read->getResult()[0]['SOMA'])):
                    foreach ($Read->getResult() as $orcamentos):
                        $jSON['addExecutado'] = "R$ " . $Orcamento->getValor($orcamentos['SOMA']);
                    endforeach;
                else:
                    $jSON['addExecutado'] = "R$ ". 0;
                endif;
        break;

        case 'detalhes':
                
            $jSON['addDetalhes'] = null;
            //INFORMAÇÕES DETALHADAS
            $Read->FullRead("SELECT CONVERT(NVARCHAR,[60_Orcamentos].DataEnt,103) AS DataEnt, IIF(Func1.ID IS NOT NULL, Func1.[NOME COMPLETO], Func2.NOME) AS TecnicoEnt, 
            IIF(Funcionários.ID IS NOT NULL, Funcionários.[NOME COMPLETO], FuncionariosTerceirizados.NOME) AS TecnicoExe,
            CONVERT(NVARCHAR,[60_Orcamentos].DataExe,103) AS DataExe, [60_Orcamentos].Status, [60_Orcamentos].Valor,CONVERT(NVARCHAR,[60_Orcamentos].DataAgendamento,103) AS DataAgend, IdOS FROM [60_Orcamentos]
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

                      $Read->FullRead("SELECT COUNT(*) AS STATUSPECAS FROM [60_OS_PecasAPP] WHERE [60_OS_PecasAPP].Status IS NULL AND [60_OS_PecasAPP].ID = {$PostData['idOrcamento']}","");
                      
                      $STATUSPECAS = $Read->getResult()[0]['STATUSPECAS'];
                      

                      $Read->FullRead("SELECT COUNT(*) AS STATUSSERVICOS FROM [60_OS_ServicosAPP] WHERE [60_OS_ServicosAPP].Status IS NULL AND [60_OS_ServicosAPP].IDOrcamento = {$PostData['idOrcamento']}","");

                      $STATUSSERVICOS = $Read->getResult()[0]['STATUSSERVICOS'];

                        $jSON['addDetalhes'] = $Status == 3 && ($STATUSPECAS != 0 ||  $STATUSSERVICOS != 0) ? "
                              <br>
                              <li><span ID='STATUSPECAS'>Data Entrada: </span>{$detalhes['DataEnt']}</li>
                              <li><span>Técnico Entrada: </span>{$detalhes['TecnicoEnt']}</li>
                              <li><span>Data Agendamento: </span>{$detalhes['DataAgend']}</li>
                              <li><span>Data Execução: </span>{$detalhes['DataExe']}</li>
                              <li><span>Técnico Execução: </span>{$detalhes['TecnicoExe']}</li>
                              <li><span>Status: </span>{$Orcamento->getStatus($Status)}</li>
                              <li><span>Valor:</span> (R$)  {$Orcamento->getValor($Valor)}</li>
                              <li><center><a id='j_btn_editar' class='btn btn_darkblue icon-share'  href='#j_modal' rel='modal:open' callback='Orcamentos' callback_action='editar' idOrcamento='{$PostData['idOrcamento']}' IdOs='{$IdOS}'>CONTATOS</a></center></li>" : "<br>
                              <li><span>Data Entrada: </span>{$detalhes['DataEnt']}</li>
                              <li><span>Técnico Entrada: </span>{$detalhes['TecnicoEnt']}</li>
                              <li><span>Data Agendamento: </span>{$detalhes['DataAgend']}</li>
                              <li><span>Data Execução: </span>{$detalhes['DataExe']}</li>
                              <li><span>Técnico Execução: </span>{$detalhes['TecnicoExe']}</li>
                              <li><span>Status: </span>{$Orcamento->getStatus($Status)}</li>
                              <li><span>Valor:</span> (R$)  {$Orcamento->getValor($Valor)}</li>";
                    endforeach;
                else:
                    $jSON['addDetalhes'] = 0;
                endif;

            //TABELA SERVIÇOS
                $jSON['addServicos'] = null;
                $Servicos = null;
                   $Read->FullRead("SELECT [60_Orcamentos].ID,  [60_OS_ListaServicos].Descricao, [60_OS_ServicosAPP].Qtd, [60_OS_ServicosAPP].Valor FROM [60_Orcamentos]
                    INNER JOIN [60_OS_ServicosAPP] ON [60_Orcamentos].ID = [60_OS_ServicosAPP].IDOrcamento
                    INNER JOIN [60_OS_ListaServicos] ON [60_OS_ServicosAPP].ID_servico = [60_OS_ListaServicos].Id

                    WHERE [60_Orcamentos].ID = " . $PostData['idOrcamento'],"");

            if ($Read->getResult()):
              
                    foreach ($Read->getResult() as $Servicos):
                      
                        $jSON['addServicos'] .= "
                        <tr class='j_Servicos linha' idOrcamento='{$PostData['idOrcamento']}'>
                         <td style='width: 50%;'>{$ItensOrcamento->getNome($Servicos['Descricao'])}</td>
                         <td>{$ItensOrcamento->getQtd($Servicos['Qtd'])}</td>
                         <td>{$ItensOrcamento->getValor($Servicos['Valor'])}</td>
                         <td>{$ItensOrcamento->getValorTotal($Servicos['Qtd'],$Servicos['Valor'])}</td>
                        </tr>";
                        $jSON['Servico'] = "{$ItensOrcamento->getValorTotal($Servicos['Qtd'],$Servicos['Valor'])}";
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

                   $Read->FullRead("SELECT [60_Orcamentos].ID, [60_Pecas].Peca, [60_OS_PecasAPP].Qtd, [60_OS_PecasAPP].Valor FROM [60_Orcamentos]
                    INNER JOIN [60_OS_PecasAPP] ON [60_Orcamentos].ID = [60_OS_PecasAPP].IDOrcamento
                    INNER JOIN [60_Pecas] ON [60_OS_PecasAPP].ID_Pecas = [60_Pecas].Id
                    WHERE [60_Orcamentos].ID = " . $PostData['idOrcamento'],"");
            if ($Read->getResult()):
              $Pecas = NULL;
                    foreach ($Read->getResult() as $Pecas):
                        $jSON['addPecas'] .= "
                        <tr class='j_Pecas linha' idOrcamento='{$PostData['idOrcamento']}'>
                         <td style='width: 50%;'>{$ItensOrcamento->getNome($Pecas['Peca'])}</td>
                         <td>{$ItensOrcamento->getQtd($Pecas['Qtd'])}</td>
                         <td>{$ItensOrcamento->getValor($Pecas['Valor'])}</td>
                         <td>{$ItensOrcamento->getValorTotal($Pecas['Qtd'],$Pecas['Valor'])}</td>
                        </tr>";
                        $jSON['Peca'] = "{$ItensOrcamento->getValorTotal($Pecas['Qtd'],$Pecas['Valor'])}";
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

                //TABELA ORÇAMENTO
                $jSON['addOrcamentos'] = null;
                   $Read->FullRead("SELECT [60_Orcamentos].Valor,[60_Orcamentos].ID,[NumParcelas] AS parcelas,[60_OS_ServicosAPP].Qtd AS QtdServico,[60_OS_ServicosAPP].Valor AS ValorServico,[60_OS_PecasAPP].Qtd AS QTDPecas,[60_OS_PecasAPP].Valor AS ValorPecas FROM [60_Orcamentos]
                LEFT JOIN [60_OS_ServicosAPP] ON [60_Orcamentos].ID = [60_OS_ServicosAPP].IDOrcamento
                LEFT JOIN [60_OS_PecasAPP] ON [60_Orcamentos].ID = [60_OS_PecasAPP].IDOrcamento 
                WHERE [60_Orcamentos].ID = " . $PostData['idOrcamento'],"");
            if (!empty($Read->getResult())):
                    foreach ($Read->getResult() as $Orcamentos):
                        extract($Orcamentos);

                        $jSON['addOrcamentos'] = "
                        <tr class='j_Orcamentos linha' idOrcamento='{$PostData['idOrcamento']}'>
                         <td style='width: 50%;'>{$ItensOrcamento->getNParcelas($parcelas)}</td>
                         <td>{$ItensOrcamento->getValorParcelas($parcelas,$Valor)}</td>
                         <td>{$Orcamento->getValor($Valor)}</td>
                        </tr>";

                        $jSON['orcamento'] = "{$Orcamento->getValor($Valor)}";
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

          // CONSULTAR TELEFONES DO CLIENTE
            $Read->FullRead("SELECT [Telefone1],[Telefone2],[Telefone3] FROM [BDNVT].[dbo].[60_Clientes] LEFT JOIN [60_OT] ON [60_Clientes].Id = [60_OT].Cliente LEFT JOIN [60_OS] ON [60_OT].Id = [60_OS].OT LEFT JOIN [60_Orcamentos] ON [60_OS].Id = [60_Orcamentos].IdOS WHERE [60_Orcamentos].IdOS = {$PostData["Idos"]}", "");
            if($Read->getResult()):

              $tel = null;
              $jSON["addTelCliente"] = null;

              foreach ($Read->getResult() as $tel):
                extract($tel);

                $Tel1 = $Telefone1 != null ? "<label class='label box box33'><span><b>Telefone 1: </b></span><p><a href='tel:0{$Telefone1}'>{$Telefone1}</a></p></label>" : "";
                $Tel2 = $Telefone2 != null ? "<label class='label box box33'><span><b>Telefone 2: </b></span><p><a href='tel:0{$Telefone2}'>{$Telefone2}</a></p></label>" : "";
                $Tel3 = $Telefone3 != null ? "<label class='label box box33'><span><b>Telefone 3: </b></span><p><a href='tel:0{$Telefone3}'>{$Telefone3}</a></p></label>" : "";

                $jSON["addTelCliente"] = $Tel1.$Tel2.$Tel3;

              endforeach;
            endif;

          // CONSULTA LISTA DE CONTATOS
            $Read->FullRead("SELECT DataContato,Status,Obs,IdOS,IdOrcamento FROM [60_ContatosOrcamento] WHERE IdOrcamento = {$PostData['idOrcamento']}", "");
            if($Read->getResult()):
              $jSON['addContatos'] = null;
              $value = null;
              $time = [];
              foreach ($Read->getResult() as $value):

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
              endforeach;
              $jSON['addIdOrca'] = $PostData["idOrcamento"];
              $jSON["addIdOS"] = $IdOS;
            endif;

            if($PostData['idOrcamento']):
            $jSON['addTecnicos'] = null;
            $jSON['addStatus'] = null;
            $jSON['addSelecionaItens'] = null;
            $jSON['addId'] = $PostData['idOrcamento'];

            // PREENCHER MODAL COM ITENS DO ORÇAMENTO
            //TABELA SERVIÇOS
                $jSON['addSerRecusa'] = null;
                $Servicos = null;
                   $Read->FullRead("SELECT [60_Orcamentos].ID,[60_OS_ServicosAPP].Status,[60_OS_ServicosAPP].ID AS IdServ,[60_OS_ServicosAPP].ID_servico AS IDSERVICO, [60_OS_ListaServicos].Descricao, [60_OS_ServicosAPP].Qtd, [60_OS_ServicosAPP].Valor FROM [60_Orcamentos]
                    INNER JOIN [60_OS_ServicosAPP] ON [60_Orcamentos].ID = [60_OS_ServicosAPP].IDOrcamento
                    INNER JOIN [60_OS_ListaServicos] ON [60_OS_ServicosAPP].ID_servico = [60_OS_ListaServicos].Id WHERE [60_OS_ServicosAPP].Status <> 4 AND [60_Orcamentos].ID = " . $PostData['idOrcamento'],"");
                   
            if ($Read->getResult()):
              
                foreach ($Read->getResult() as $Servicos):
                  extract($Servicos);

                    $jSON['addSerRecusa'] .= "
                    <tr class='j_Servicos linhas' name='servico' id='{$ItensOrcamento->getId($IdServ)}' idserv='{$ItensOrcamento->getId($IDSERVICO)}'>
                     <td style='width: 50%;'>{$ItensOrcamento->getNome($Descricao)}</td>
                     <td style='text-align:center'>{$ItensOrcamento->getQtd($Qtd)}</td>
                     <td style='text-align:center'>{$ItensOrcamento->getValor($Valor)}</td>
                     <td style='text-align:center'>{$ItensOrcamento->getValorTotal($Qtd,$Valor)}</td>
                     <td><input type='checkbox' value='{$ItensOrcamento->getId($IdServ)}' class='recupera-itens-serv'/></td>
                    </tr>";
                    $jSON['ServicoRecusa'] = "{$ItensOrcamento->getValorTotal($Qtd,$Valor)}";
                endforeach;
            endif;
            //TABELA PEÇAS
                $jSON['addPecasRecusa'] = null;
                $jSON['PecaRecusa'] = null;
                   $Read->FullRead("SELECT [60_Orcamentos].ID,[60_OS_PecasAPP].Status,[60_OS_PecasAPP].ID AS IdPec,[60_OS_PecasAPP].ID_Pecas AS IDPECAS, [60_Pecas].Peca, [60_OS_PecasAPP].Qtd, [60_OS_PecasAPP].Valor FROM [60_Orcamentos]
                    INNER JOIN [60_OS_PecasAPP] ON [60_Orcamentos].ID = [60_OS_PecasAPP].IDOrcamento
                    INNER JOIN [60_Pecas] ON [60_OS_PecasAPP].ID_Pecas = [60_Pecas].Id
                    WHERE [60_OS_PecasAPP].Status <> 4 AND [60_Orcamentos].ID = " . $PostData['idOrcamento'],"");
            if ($Read->getResult()):
              $Pecas = NULL;
                  foreach ($Read->getResult() as $Pecas):
                    extract($Pecas);

                      $jSON['addPecasRecusa'] .= "
                      <tr class='j_Pecas linhas' name='peca' id='{$ItensOrcamento->getId($IdPec)}' idpeca='{$ItensOrcamento->getId($IDPECAS)}'>
                       <td style='width: 50%;'>{$ItensOrcamento->getNome($Peca)}</td>
                       <td style='text-align:center'>{$ItensOrcamento->getQtd($Qtd)}</td>
                       <td style='text-align:center'>{$ItensOrcamento->getValor($Valor)}</td>
                       <td style='text-align:center'>{$ItensOrcamento->getValorTotal($Qtd,$Valor)}</td>
                       <td><input type='checkbox' value='{$ItensOrcamento->getId($IdPec)}' class='recupera-itens-pec'/></td>
                      </tr>";
                      $jSON['PecaRecusa'] = "{$ItensOrcamento->getValorTotal($Qtd,$Valor)}";
                  endforeach;
            endif;
            if($jSON['PecaRecusa'] != null || $jSON['addPecasRecusa'] != null):
              $jSON['formaPagt'] = null;
              $jSON['addSelecionaItens'] = "<tr class='seleciona-todos' IdOrc='{$PostData["idOrcamento"]}' IdOs = '{$PostData['Idos']}'>
                                              <td></td>
                                              <td></td>
                                              <td></td>
                                              <td></td>
                                              <td><input type='checkbox' name='recupera-todos' value='t'/></td>
                                            </tr>";
              foreach ($Orcamento->getFormaPagamento() as $key => $value):

                $jSON['formaPagt'] .= "<option value = '{$key}'>{$value}</option>";
              endforeach;
            else:

              $jSON['addSelecionaItens'] = "";
            endif;
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
              // CRIAR ORÇAMENTO
              $orcamento = array(

                "IdOS" => $PostData['IdOs'],
                "TecnicoEnt" => $PostData["TecnicoEntrada"],
                "Status" => 4,
                "Valor" => $PostData["total"],
                "FormaPagamento" => $PostData["FormaPagamento"],
                "NumParcelas" => $PostData["NumParcelas"],
                "DataAgendamento" => $PostData["DataAgend"],
                "Obs" => $PostData["Obs"],
                "OrcamentoOrigem" => $PostData["IdOrcamento"],
                "OsOrigem" => $PostData['IdOs']
              );

              $Create->Execreate("[60_Orcamentos]",$orcamento);

              if($Create->getResult()){

                $idOrcamento = $Create->getResult();
                $jSON["trigger"] = AjaxErro('<b class="icon-warning">Orçamento recuperado com sucesso!</b>', E_USER_ERROR);
                $Itens = ["Status"=> 4];

                
                // ATUALIZA STATUS DE PEÇAS 
                for($i = 0; $i < $PostData['linhasPecas']; $i++){
                  
                  $Update->ExeUpdate("[60_OS_PecasAPP]",$Itens, "WHERE ID = :id", "id={$PostData['Peca']['Id'][$i]}");
                }
                // ATUALIZA STATUS SERVICOS
                for($i = 0; $i < $PostData['linhasServc']; $i++){
                  
                  $Update->ExeUpdate("[60_OS_ServicosAPP]",$Itens, "WHERE ID = :id", "id={$PostData['Servico']['Id'][$i]}");
                }
                
                // CRIAR PEÇAS DO ORÇAMENTO
                for($i = 0; $i < $PostData['linhasPecas']; $i++){
                  
                  $orcamento_pecas = array(

                    'IDOrcamento' => $idOrcamento,
                    'ID_Pecas' => $PostData['Peca']['IdPeca'][$i],
                    'Qtd' => $PostData['Peca']['Qtd'][$i],
                    'Valor' => $ItensOrcamento->setValor($PostData['Peca']['Valor'][$i]),
                    'Status' => 4
                  );

                  $Create->Execreate("[60_OS_PecasAPP]",$orcamento_pecas); 
                }

                // CRIAR SERVIÇOS DO ORÇAMENTO
                for($i = 0; $i < $PostData['linhasServc']; $i++){
                  $orcamento_servicos = array(

                    'IDOrcamento' => $idOrcamento,
                    'ID_servico' => $PostData['Servico']['IdServico'][$i],
                    'Qtd' => $PostData['Servico']['Qtd'][$i],
                    'Valor' => $ItensOrcamento->setValor($PostData['Servico']['Valor'][$i]),
                    'Status' => 4
                  );

                  $Create->Execreate("[60_OS_ServicosAPP]",$orcamento_servicos);
                }

              }


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
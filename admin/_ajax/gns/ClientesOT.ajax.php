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
$CallBack = 'ClientesOT';
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
        case 'addCliente':
                //EXCLUI ESTES VALORES POIS NÃO VÃO PARA O BANCO
                unset($PostData['ID']);
                unset($PostData['NumOT']);

                //PESQUISA O USUARIO NO SISTEMA E CADASTRA PARA CONTROLE
                $Read->FullRead("SELECT [ID] FROM [Funcionários] WHERE [ID] = :user","user={$_SESSION['userLogin']['ID']}");
                $PostData['USUARIOSISTEMA'] = $Read->getResult()[0]['ID'];
                $PostData['DATASISTEMA'] = date('d/m/Y H:m:s');

                //CADASTRA NO BANCO O CLIENTE
                $Create->ExeCreate("[60_ClientesSemOT]",$PostData);
                $Read->ExeRead("[60_ClientesSemOT]","WHERE [ID] = :cliente", "cliente={$Create->getResult()}");
                $jSON['trigger'] = AjaxErro("<b class='icon-checkmark'>Cliente adicionado com sucesso!");
                $jSON['success'] = true;
                //REDIRECIONA PARA MESMA PAGINA PARA CARREGAR A TABELA COM OS CLIENTES SEM OT                       
                $jSON['redirect'] = "dashboard.php?wc=gns/clienteOT";

            break;

        case 'consulta':

            //PESQUISA SE JÁ EXISTE NO BANCO UMA OT CRIADA PARA ESTE CLIENTE
            $Read->FullRead("SELECT Id,Cliente, NumOT, TipoOT FROM [60_OT] WHERE [Cliente] = :cliente","cliente={$PostData['cli_id']}");
            if ($Read->getResult()):

                foreach ($Read->getResult() as $OT):
                    extract($OT);
                    $Id = $OT['Id'];
                    $cliente = $OT['Cliente'];
                    $NumOT = $OT['NumOT'];
                    $TipoOT = $OT['TipoOT'];
                    $jSON['trigger'] = true;
                    $jSON['addOT'] = "<tr class='j_ot' id='{$Id}'><td style='width: 80%;'>{$NumOT} - {$TipoOT}</td><td callback='ClientesOT' callback_action='insere' class='j_insere_ot icon-checkmark btn btn_darkblue' rel='' id='{$Id}' linha_sem_os='{$cliente}' style='float: right;'>&ensp;Atribuir OT/OS</td></tr>";
                endforeach;
            else:
                $jSON['trigger'] = AjaxErro("Sem OT cadastrada para vincular ao Cliente!");
            endif;
        break;

        case 'insere':
            $OT = ['IDOT' => intval($PostData['IDOT'])];
            //ATUALIZA VINCULANDO OT AO CLIENTE
            $Update->ExeUpdate("[60_ClientesSemOT]",$OT, "WHERE [60_ClientesSemOT].[IDCLIENTE] = :id", "id={$PostData['linhaSemOs']}");
            if($Update->getResult()):
                $jSON['trigger'] = AjaxErro("OT vinculada ao cliente com sucesso!");
                $jSON['ot'] = $Update->getResult();
            else:
                $jSON['trigger'] = AjaxErro("Erro ao vincular endereço!", E_USER_WARNING);
            endif;
        break;    

        //CARREGA OS DADOS DOS CLIENTES
        case 'carregarTabela':
            $jSON['addTabela'] = null;
            $Read->FullRead("SELECT ID, IDCLIENTE, DATAAGENDAMENTO FROM [60_ClientesSemOT]
                    WHERE [IDOT] IS NULL ORDER BY [DATAAGENDAMENTO] ASC"," ");
            if ($Read->getResult()):
                foreach ($Read->getResult() as $CLI):                    
                    extract($CLI);
                    $IDCLIENTE = $CLI['IDCLIENTE'];
                    $ID = $CLI['ID'];
                    $dataAgendamento = date('d/m/Y', strtotime($DATAAGENDAMENTO));
                    $Read->FullRead("SELECT NomeCliente FROM [60_Clientes] WHERE [Id] = :id","id={$IDCLIENTE}");
                    foreach ($Read->getResult() as $CLI):
                        extract($CLI);
                    endforeach;
                    $jSON['addTabela'] .= "
                    <tr>
                    <td id='{$IDCLIENTE}'>{$NomeCliente}</td>
                    <td>{$dataAgendamento}</td>
                    <td><span class='j_pesquisa_ot icon-search btn btn_darkblue' rel='{$IDCLIENTE}' linha_sem_os='{$IDCLIENTE}' callback='ClientesOT' callback_action='consulta'>&ensp;Consultar OT/OS</span></td>
                    </tr>";
                endforeach;
            else:
                $jSON['trigger'] = AjaxErro("Sem OT cadastrada para vincular ao Cliente!");
                 $jSON['addTabela'] = AjaxErro("Sem OT cadastrada para vincular ao Cliente!");
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

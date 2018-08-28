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

        case 'atualizaCliente':
            
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

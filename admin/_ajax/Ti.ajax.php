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
$CallBack = 'Ti';
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
    $Upload = new Upload('../../uploads/');

    //SELECIONA AÇÃO
    switch ($Case):
        case 'manager':
            if(!isset($PostData['TI'])):
                $PostData['TI'] = 0;
            endif;
            if(!isset($PostData['GNS'])):
                $PostData['GNS'] = 0;
            endif;
            if(!isset($PostData['CLIENTES_PARTICULARES'])):
                $PostData['CLIENTES_PARTICULARES'] = 0;
            endif;

            $Read->FullRead("SELECT * FROM [00_NivelAcesso] WHERE IDFUNCIONARIO = :idfunc","idfunc={$PostData['ID']}");
            if($Read->getResult()):
                $ID = $PostData['ID'];
                unset($PostData['ID']);
                $Update->ExeUpdate("[Funcionários]", $PostData, "WHERE ID= :id", "id={$ID}");
            else:
                $ID = $PostData['ID'];
                unset($PostData['ID']);
                $Create->ExeCreate("[80_Chamados]",$PostData);
            endif;


            break;

        case 'consultaUsuario':
                         
                $Read->FullRead("SELECT * FROM [00_NivelAcesso] WHERE IDFUNCIONARIO = :idfunc","idfunc={$PostData['ID']}");
                if($Read->getResult()):
                    $jSON['permissoesUsuario'] = "<div id='permissoesUsuario'><input type='hidden' name='ID' value='{$Read->getResult()[0]['ID']}'/><input class='' name='GNS' type='checkbox' value='1' ".($Read->getResult()[0]['GNS'] == 1 ? 'checked':'')."> GNS <input class='' name='CLIENTES_PARTICULARES' type='checkbox' value='1' ".($Read->getResult()[0]['CLIENTES_PARTICULARES'] == 1 ? 'checked':'')."> Clientes Particulares <input class='' name='TI' type='checkbox' value='1' ".($Read->getResult()[0]['TI'] == 1 ? 'checked':'')." > TI </br></div>";
                    
                    $Read->FullRead("SELECT * FROM [Funcionários] WHERE ID = :id","id={$PostData['ID']}");
                    if($Read->getResult()):
                    $jSON['dadosUsuario'] = "<div id='dadosUsuario'><h5>{$Read->getResult()[0]['NOME COMPLETO']}</h5><p>{$Read->getResult()[0]['E-MAIL CORPORATIVO']}</p><span rel='agendamentos' callback='Ti' callback_action='resetarSenha' class='j_resetar_senha icon-cancel-circle btn btn_red m_top' id='{$Read->getResult()[0]['ID']}'>Resetar Senha</span></div>";
                    else:
                        $jSON['trigger'] = AjaxErro("Usuário não encontrado", E_USER_WARNING);
                    endif;
                else:
                    $Read->FullRead("SELECT * FROM [Funcionários] WHERE ID = :id","id={$PostData['ID']}");
                    if($Read->getResult()):
                        $jSON['dadosUsuario'] = "<div id='dadosUsuario'></div>";
                        $jSON['permissoesUsuario'] = "<div id='permissoesUsuario'><input type='hidden' name='ID' value='{$Read->getResult()[0]['ID']}'/><input class='' name='GNS' type='checkbox' value='1'> GNS <input class='' name='CLIENTES_PARTICULARES' type='checkbox' value='1'> Clientes Particulares <input class='' name='TI' type='checkbox' value='1'> TI </br></div>";                
                        $jSON['trigger'] = AjaxErro("Usuário sem permissões. Ao cadastrar, o mesmo passará a usar o sistema com as devidas permissões escolhidas."); 
                    endif;               
                endif;
            break;

        case 'resetarSenha':
            $SENHA['SENHA'] = hash('sha1', "1234");
            $Update->ExeUpdate("[Funcionários]", $SENHA, "WHERE ID= :id", "id={$PostData['ID']}");
            if($Update->getResult()):
                $jSON['trigger'] = AjaxErro("Senha resetada com sucesso!");
            else:
                $jSON['trigger'] = AjaxErro("Erro ao tentar resetar a senha do usuário!");
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

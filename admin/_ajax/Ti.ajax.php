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
        $PostData['TI'] = (!isset($PostData['TI']) ? $PostData['TI'] = "0" : $PostData['TI'] = 1);
        $PostData['GNS'] = (!isset($PostData['GNS']) ?  $PostData['GNS'] = "0" : $PostData['GNS'] = 1);
        $PostData['MOBILE_GNS'] = (!isset($PostData['MOBILE_GNS']) ?  $PostData['MOBILE_GNS'] = "0" : $PostData['MOBILE_GNS'] = 1);
        $PostData['CLIENTES_PARTICULARES'] = (!isset($PostData['CLIENTES_PARTICULARES']) ? $PostData['CLIENTES_PARTICULARES'] = "0" : $PostData['CLIENTES_PARTICULARES'] = 1);
        $PostData['FERRAMENTAS'] = (!isset($PostData['FERRAMENTAS']) ?  $PostData['FERRAMENTAS'] = "0" : $PostData['FERRAMENTAS'] = 1);
        $PostData['DIRETORIA'] = (!isset($PostData['DIRETORIA']) ?  $PostData['DIRETORIA'] = "0" : $PostData['DIRETORIA'] = 1);
        $PostData['RH'] = (!isset($PostData['RH']) ?  $PostData['RH'] = "0" : $PostData['RH'] = 1);

           
          $Read->FullRead("SELECT * FROM [00_NivelAcesso] WHERE IDFUNCIONARIO = :idfunc","idfunc={$PostData['ID']}");
            if($Read->getResult()):
                $ID = $PostData['ID'];
              unset($PostData['ID']);
                $Update->ExeUpdate("[00_NivelAcesso]", $PostData, "WHERE IDFUNCIONARIO = :id", "id={$ID}");
                $jSON['trigger'] = AjaxErro("<b class='icon-checkmark'>Permissão de Funcionário Atualizada!<b>");
                 
            else:
                $ID = $PostData['ID'];
              
                $CriaAcesso = array(
                'IDFUNCIONARIO' => $ID,
                'GNS' => $PostData['GNS'],
                'MOBILE_GNS' => $PostData['MOBILE_GNS'],
                'CLIENTES_PARTICULARES' => $PostData['CLIENTES_PARTICULARES'],
                'TI' => $PostData['TI'],
                'FERRAMENTAS' => $PostData['FERRAMENTAS'],
                'DIRETORIA' => $PostData['DIRETORIA'],
                'RH' => $PostData['RH'],
                );
             $Create->ExeCreate("[00_NivelAcesso]",$CriaAcesso);
             $jSON['trigger'] = AjaxErro("<b class='icon-checkmark'>Permissão de Funcionário Criada!</b>"); 
             
            endif;
            break;

        case 'consultaUsuario':
                         
                $Read->FullRead("SELECT * FROM [00_NivelAcesso] WHERE IDFUNCIONARIO = :idfunc","idfunc={$PostData['ID']}");
                if($Read->getResult()):
                    $jSON['permissoesUsuario'] = "
                    <div id='permissoesUsuario' style='font-size: 15px;'>
                    <input type='hidden' name='ID' value='{$Read->getResult()[0]['IDFUNCIONARIO']}'/>
                    <input style='width: 5%;' id='modulos' type='checkbox' />Selecionar Todos<br><br>
                    <input style='width: 5%;' class='' name='CLIENTES_PARTICULARES' type='checkbox' value='1' ".($Read->getResult()[0]['CLIENTES_PARTICULARES'] == 1 ? 'checked':'').">Clientes Particulares <br>
                    <input style='width: 5%;' class='' name='DIRETORIA' type='checkbox' value='1' ".($Read->getResult()[0]['DIRETORIA'] == 1 ? 'checked':'').">Diretoria <br>
                    <input style='width: 5%;' class='' name='FERRAMENTAS' type='checkbox' value='1' ".($Read->getResult()[0]['FERRAMENTAS'] == 1 ? 'checked':'')." >FERRAMENTAS </br>
                    <input style='width: 5%;' class='' name='GNS' type='checkbox' value='1' ".($Read->getResult()[0]['GNS'] == 1 ? 'checked':'').">GNS <br>
                    <input style='width: 5%;' class='' name='MOBILE_GNS' type='checkbox' value='1' ".($Read->getResult()[0]['MOBILE_GNS'] == 1 ? 'checked':'').">MOBILE GNS <br>
                    <input style='width: 5%;' class='' name='TI' type='checkbox' value='1' ".($Read->getResult()[0]['TI'] == 1 ? 'checked':'')." >TI </br>
                    <input style='width: 5%;' class='' name='RH' type='checkbox' value='1' ".($Read->getResult()[0]['RH'] == 1 ? 'checked':'').">RH <br></div>";

                    $jSON['Permissao'] = true;

                    $Read->FullRead("SELECT * FROM [Funcionários] WHERE ID = :id","id={$PostData['ID']}");
                    if($Read->getResult()):
                    $jSON['dadosUsuario'] = "
                    <article class='wc_tab_target wc_active blocoDados' id='profile'  style='border-top: 5px solid #1a4a7b;'>
                    <div class='panel'>
                    <div id='dadosUsuario' style='text-align: center;'>
                    <h5>{$Read->getResult()[0]['NOME COMPLETO']}</h5>
                    <p>{$Read->getResult()[0]['E-MAIL CORPORATIVO']}</p>
                    <div class='box box50'>
                    <span rel='agendamentos' callback='Ti' callback_action='resetarSenha' class='j_resetar_senha btn btn_darkblue m_top' id='{$Read->getResult()[0]['ID']}'>Resetar Senha</span>
                    </div>
                    <div class='box box50'>
                    <span rel='agendamentos' callback='Ti' callback_action='desativarConta' class='j_desativar_conta icon-cancel-circle btn btn_red m_top' id='{$Read->getResult()[0]['ID']}'>Desativar Conta</span>
                    </div>
                    </div>
                     </article>
                    </div>";
                    else:
                        $jSON['trigger'] = AjaxErro("Usuário não encontrado", E_USER_WARNING);
                    endif;
                else:
                    $Read->FullRead("SELECT * FROM [Funcionários] WHERE ID = :id","id={$PostData['ID']}");
                    if($Read->getResult()):
                        $jSON['dadosUsuario'] = "<div id='dadosUsuario'></div>";
                        $jSON['permissoesUsuario'] = "
                        <div id='permissoesUsuario' style='font-size: 15px;'>
                        <input type='hidden' name='ID' value='{$Read->getResult()[0]['ID']}'/>
                        <input style='width: 5%;' id='modulos' type='checkbox' />Selecionar Todos<br><br>
                        <input style='width: 5%;' class='' name='CLIENTES_PARTICULARES' type='checkbox' value='1'>Clientes Particulares <br>
                        <input style='width: 5%;' class='' name='DIRETORIA' type='checkbox' value='1'>Diretoria <br>
                        <input style='width: 5%;' class='' name='FERRAMENTAS' type='checkbox' value='1'>FERRAMENTAS </br>
                        <input style='width: 5%;' class='' name='GNS' type='checkbox' value='1'>GNS <br>
                        <input style='width: 5%;' class='' name='MOBILE_GNS' type='checkbox' value='1'>MOBILE GNS <br>
                        <input style='width: 5%;' class='' name='TI' type='checkbox' value='1'>TI </br>
                        <input style='width: 5%;' class='' name='RH' type='checkbox' value='1'>RH <br></div>"; 

                        $jSON['Permissao'] = false;  

                        $jSON['trigger'] = AjaxErro("<b class='icon-warning'>Usuário sem permissões. Ao cadastrar, o mesmo passará a usar o sistema com as devidas permissões escolhidas.</b>"); 
                    endif;               
                endif;
            break;

        case 'resetarSenha':
            $SENHA['SENHA'] = hash('sha1', "1234");
            $Update->ExeUpdate("[Funcionários]", $SENHA, "WHERE ID= :id", "id={$PostData['ID']}");
            if($Update->getResult()):
                $jSON['trigger'] = AjaxErro("<b class='icon-checkmark'>Senha resetada com sucesso!</b>");
            else:
                $jSON['trigger'] = AjaxErro("<b class='icon-warning'>Erro ao tentar resetar a senha do usuário!</b>");
            endif;
            break;

            case 'desativarConta':
            $Delete->ExeDelete("[00_NivelAcesso]", "WHERE IDFUNCIONARIO = :id", "id={$PostData['ID']}");
             if($Delete->getResult()):
                $jSON['trigger'] = AjaxErro("<b class='icon-checkmark'>Conta desativada com sucesso!<b>", E_USER_WARNING);
            else:
                $jSON['trigger'] = AjaxErro("<b class='icon-warning'>Erro ao tentar desativar conta<b>", E_USER_WARNING);
            endif;
            break;

        case 'monitoramento':
            $Read->FullRead("SELECT [00_NivelAcesso].ID, CASE WHEN FUNC.ID IS NOT NULL THEN FUNC.[NOME COMPLETO] ELSE TERC.NOME END AS NOME
                FROM [00_NivelAcesso] LEFT JOIN Funcionários FUNC ON [00_NivelAcesso].IDFUNCIONARIO = FUNC.ID
                LEFT JOIN FuncionariosTerceirizados TERC ON [00_NivelAcesso].IDTERCEIRIZADO = TERC.ID
                WHERE MOBILE_GNS = 1 AND FUNC.[DATA DE DEMISSÃO] IS NULL ORDER BY NOME"," ");
            if($Read->getResult()):
                
                $value = null;
                $TecGNS = [];
                foreach ($Read->getResult() as $value) {

                    extract($value);
                    array_push($TecGNS, array("ID"=>$ID,"NOME"=>$NOME));

                
                }

                    if($TecGNS):
                        $i = 0;
                        $t = count($TecGNS);
                        $jSON["TEC"] = null;
                        for ($i = 0;$i < $t; $i++) {
                           
                            //QTD OS's ATRIBUIDAS A CADA TÉCNICO
                            $Read->FullRead("SELECT COUNT(*) AS QUANTIDADE FROM [60_OS] WHERE convert(varchar(10), DataAgendamento, 102) = convert(varchar(10), getdate(), 102) AND Tecnico = {$TecGNS[$i]["ID"]}"," ");
                           
                            $TecGNS[$i]["ATRIBUIDO"] = $Read->getResult()[0]["QUANTIDADE"];

                            //QTD OS'S ATENDIDAS POR CADA TÉCNICO
                            $Read->FullRead("SELECT COUNT(*) AS QUANTIDADE FROM [60_OS] WHERE STATUS != 0 AND convert(varchar(10), DataAgendamento, 102) 
                        = convert(varchar(10), getdate(), 102) AND Tecnico =  {$TecGNS[$i]["ID"]}","");

                            $TecGNS[$i]["ATENDIDO"] = $Read->getResult()[0]["QUANTIDADE"];

                        //CALCULA PORCENTAGEM DE OS'S ATENDIDAS POR CADA TÉCNICO
                        $porcento = $TecGNS[$i]["ATENDIDO"] != 0 ? ($TecGNS[$i]["ATENDIDO"] * 100) / $TecGNS[$i]["ATRIBUIDO"] : 0;
                        $percent = number_format($porcento,2);
                        $cor = $percent > 50 ? "green" : "red";

                        $jSON['trigger'] = true;  
                        $jSON["TEC"] .= "<tr>
                                            <td>{$TecGNS[$i]["NOME"]}</td>
                                            <td style='text-align:center'>{$TecGNS[$i]["ATRIBUIDO"]}</td>
                                            <td style='text-align:center'>{$TecGNS[$i]["ATENDIDO"]}</td>
                                            <td style='text-align:center;color:{$cor}'>{$percent}%</td>
                                        </tr>";
                        }

                    endif;
                    
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

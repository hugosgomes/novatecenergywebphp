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
$CallBack = 'Clientes';
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
        case 'cadCliente':
            $Cliente = null; 
            if(!empty($PostData['CPF'])):
                //TRATAMENTO DE CPF RETIRANDO PONTOS E TRAÇO DO CPF
                $CPF2 = str_replace(".", "", $PostData["CPF"]);
                $AUXCPF = str_replace("-", "", $CPF2);
                $PostData["CPF"] = $AUXCPF;

                //PESQUISA DE EXISTE O CPF INFORMADO
                $Read->FullRead("SELECT ID, CPF FROM [80_ClientesParticulares] WHERE CPF = :cpf","cpf={$PostData['CPF']}");
                if(!$Read->getResult()):   
                    //MONTA ARRAY CLIENTE PARA INSERIR NO BANCO                   
                    $CLIENTE = array("NOME"=>$PostData["NOME"],"TELEFONE"=>$PostData["TELEFONE"],"EMAIL"=>$PostData["EMAIL"],"TIPO"=>$PostData["TIPO"],"DATACADASTRO"=>date('Y-m-d H:i:s'),"CPF"=>$PostData["CPF"]);
                    $Create->ExeCreate("[80_ClientesParticulares]", $CLIENTE);
                    $IdCli = $Create->getResult();                       
                else:
                    $IdCli = $Read->getResult()[0]["ID"];                                
                endif;
            endif;

            if(!empty($PostData['CNPJ'])):
                //TRATAMENTO CNPJ RETIRANDO PONTOS, TRAÇO E BARRO DO CNPJ
                $CNPJ2 = str_replace(".", "", $PostData["CNPJ"]);
                $CNPJ3 = str_replace("/", "", $CNPJ2);
                $AUXCNPJ = str_replace("-", "", $CNPJ3);
                $PostData["CNPJ"] = $AUXCNPJ;

                $Read->FullRead("SELECT ID, CPF FROM [80_ClientesParticulares] WHERE CPF = :cpf","cpf={$PostData['CPF']}");
                if(!$Read->getResult()):   
                    //MONTA ARRAY CLIENTE PARA INSERIR NO BANCO                   
                    $CLIENTE = array("NOME"=>$PostData["NOME"],"TELEFONE"=>$PostData["TELEFONE"],"EMAIL"=>$PostData["EMAIL"],"TIPO"=>$PostData["TIPO"],"DATACADASTRO"=>date('Y-m-d H:i:s'), "CNPJ"=>$PostData["CNPJ"]);
                    $Create->ExeCreate("[80_ClientesParticulares]", $CLIENTE);
                    $IdCli = $Create->getResult();
                else:
                    $IdCli = $Read->getResult()[0]["ID"];                                
                endif;
            endif;

            //VERIFICA SE JÁ EXISTE ENDEREÇO SEMELHANTE CADASTRADO PARA ESTE CLIENTE
            $Read->FullRead("SELECT ID, CEP, NUMERO, COMPLEMENTO FROM [80_Enderecos] WHERE IDCLIENTE = :cliente AND CEP = :cep AND NUMERO = :numero AND COMPLEMENTO = :complemento","cliente={$IdCli}&cep={$PostData['CEP']}&numero={$PostData['NUMERO']}&complemento={$PostData['COMPLEMENTO']}");
            $IdEnd = null;               
            if(!$Read->getResult()):
                $IdEnd = null;                   
                //MONTA ARRAY ENDEREÇO PARA INSERIR NO BANCO
                $ENDERECO = array("IDCLIENTE"=>$IdCli,"CEP"=>$PostData["CEP"],"LOGRADOURO"=>$PostData["LOGRADOURO"],"NUMERO"=>$PostData["NUMERO"],"BAIRRO"=>$PostData["BAIRRO"], "CIDADE"=>$PostData["CIDADE"],"UF"=>$PostData["UF"], "COMPLEMENTO"=>$PostData["COMPLEMENTO"]);
                $Create->ExeCreate("[80_Enderecos]", $ENDERECO);
                $IdEnd = $Create->getResult();
            endif;
                      
            //CRIA ARRAY DE ORÇAMENTO
            $ORCAMENTO = array("IDCLIENTE"=>$IdCli,"IDENDERECO"=>$IdEnd,"TIPOSERVICO"=>$PostData["TIPOSERVICO"],"STATUS"=> 0, "DATASOLICITACAO"=>date('Y-m-d H:i:s'),"OBS"=>$PostData["OBS"]);
            $Create->ExeCreate("[80_Orcamentos]", $ORCAMENTO);

            $jSON['inpuval'] = "null"; 
            $jSON['trigger'] = AjaxErro("Orçamento adicionado com sucesso!");
            $jSON['success'] = true;
      break;
    case 'consulta':       
            if(!empty($PostData["CPFCNPJ"])):
                
                //VERIFICA SE É UM CPF
                if(strlen($PostData["CPFCNPJ"]) == 14):
                    //TRATAMENTO DE CPF RETIRANDO PONTOS E TRAÇO DO CPF
                    $PostData["CPF"] = $PostData["CPFCNPJ"];
                    $CPF2 = str_replace(".", "", $PostData["CPF"]);
                    $AUXCPF = str_replace("-", "", $CPF2);
                    $PostData["CPF"] = $AUXCPF;

                    //PESQUISA SE O CLIENTE JÁ EXISTE BUSCANDO PELO CPF
                    $Read->FullRead("SELECT * FROM [80_ClientesParticulares] WHERE CPF = :cpf","cpf={$PostData['CPF']}");
                    if($Read->getResult()):
                        $IdCliente = $Read->getResult()[0]['ID'];
                        $jSON['trigger'] = true;
                        $jSON['cliente'] = $Read->getResult()[0];
                        $jSON['dadosCliente'] = "<article class='dados'><h1>{$Read->getResult()[0]['NOME']}</h1><p>{$Read->getResult()[0]['TELEFONE']}</p><p>{$Read->getResult()[0]['EMAIL']}</p></article>";
                        $Read->FullRead("SELECT * FROM [80_Enderecos] WHERE IDCLIENTE = :id","id={$IdCliente}");
                        if($Read->getResult()):
                            $jSON['enderecoCLiente'] = null;
                            foreach ($Read->getResult() as $ENDERECO):
                                extract($ENDERECO);                       

                                $jSON['enderecoCLiente'] .= "<article class='enderecos'><p>{$LOGRADOURO}, {$NUMERO} {$COMPLEMENTO} - {$BAIRRO} - {$CIDADE} {$UF} - {$CEP}</p></article>";
                            endforeach;
                        endif;
                    else:
                        $jSON['enderecoCLiente'] = "<article class='dados'><h1>Cliente não cadastrado!</h1></article>";
                    endif;
                elseif (strlen($PostData["CPFCNPJ"]) == 18):
                    //TRATAMENTO CNPJ RETIRANDO PONTOS, TRAÇO E BARRO DO CNPJ
                    $PostData["CNPJ"] = $PostData["CPFCNPJ"];
                    $CNPJ = $PostData["CNPJ"];
                    $CNPJ2 = str_replace(".", "", $PostData["CNPJ"]);
                    $CNPJ3 = str_replace("/", "", $CNPJ2);
                    $AUXCNPJ = str_replace("-", "", $CNPJ3);
                    $PostData["CNPJ"] = $AUXCNPJ; 

                    //PESQUISA SE O CLIENTE JÁ EXISTE BUSCANDO PELO CNPJ
                    $Read->FullRead("SELECT * FROM [80_ClientesParticulares] WHERE CNPJ = :cnpj","cnpj={$PostData['CNPJ']}");
                    if($Read->getResult()):
                        $IdCliente = $Read->getResult()[0]['ID'];
                        $jSON['trigger'] = true;
                        $jSON['cliente'] = $Read->getResult()[0];
                        $jSON['dadosCliente'] = "<article class='dados'><h1>{$Read->getResult()[0]['NOME']}</h1><p>{$Read->getResult()[0]['TELEFONE']}</p><p>{$Read->getResult()[0]['EMAIL']}</p></article>";
                        $Read->FullRead("SELECT * FROM [80_Enderecos] WHERE IDCLIENTE = :id","id={$IdCliente}");
                        if($Read->getResult()):
                            $jSON['enderecoCLiente'] = null;
                            foreach ($Read->getResult() as $ENDERECO):
                                extract($ENDERECO);                       

                                $jSON['enderecoCLiente'] .= "<article class='enderecos'><p>{$LOGRADOURO}, {$NUMERO} {$COMPLEMENTO} - {$BAIRRO} - {$CIDADE} {$UF} - {$CEP}</p></article>";
                            endforeach;
                        endif;
                    else:
                        $jSON['enderecoCLiente'] = "<article class='dados'><h1>Cliente não cadastrado!</h1></article>";
                    endif;
                 else:

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

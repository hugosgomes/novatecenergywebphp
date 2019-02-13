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
                $IdCli = null;
                $IdEnd = null;                

                if ($PostData['id_cliente'] == 0) {

                    //CONSULTA PARA VERIFICAR SE EXISTE CADASTRO UTILIZANDO ESTE TELEFONE
                    $Read->FullRead("SELECT * FROM [80_ClientesParticulares] WHERE TELEFONE = '{$PostData["TELEFONE"]}'",""); 

                    if($Read->getResult()):
                        $jSON['trigger'] = AjaxErro("Já existe cadastro para este telefone!",E_USER_WARNING);
                        break;
                    endif;

                    if(strlen($PostData["NUMERO"])>5):
                        $jSON['trigger'] = AjaxErro("O campo número só conter 5 dígitos!",E_USER_WARNING);
                        break;
                    endif;

                    //CONSULTA PARA VERIFICAR SE EXISTE CADASTRO UTILIZANDO ESTE TELEFONE2
                    $Read->FullRead("SELECT * FROM [80_ClientesParticulares] WHERE TELEFONE2 = '{$PostData["TELEFONE2"]}'",""); 

                    if($Read->getResult()):
                        $jSON['trigger'] = AjaxErro("Já existe cadastro para este telefone2!",E_USER_WARNING);
                        break;
                    endif;

                    //TESTA SE O CEP TEM O TRAÇO OU NÃO
                    if (strstr($PostData['CEP'], '-')):
                        $Quebra = explode("-", $PostData['CEP']);
                        $PostData['CEP'] = $Quebra[0].$Quebra[1];
                    endif;

                    //TRATAMENTO DE CPF RETIRANDO PONTOS E TRAÇO DO CPF
                    if(!empty($PostData['CPF'])):                    
                        $CPF2 = str_replace(".", "", $PostData["CPF"]);
                        $AUXCPF = str_replace("-", "", $CPF2);
                        $PostData["CPF"] = $AUXCPF;
                    endif;

                    //TRATAMENTO CNPJ RETIRANDO PONTOS, TRAÇO E BARRA DO CNPJ
                    if (!empty($PostData['CNPJ'])):                    
                        $CNPJ2 = str_replace(".", "", $PostData["CNPJ"]);
                        $CNPJ3 = str_replace("/", "", $CNPJ2);
                        $AUXCNPJ = str_replace("-", "", $CNPJ3);
                        $PostData["CNPJ"] = $AUXCNPJ;
                    endif;

                    //MONTA ARRAY CLIENTE PARA INSERIR NO BANCO                   
                    $CLIENTE = array(
                        "NOME"=>strtoupper($PostData["NOME"]),
                        "TELEFONE"=>$PostData["TELEFONE"],
                        "TELEFONE2"=>$PostData["TELEFONE2"],
                        "EMAIL"=>$PostData["EMAIL"],
                        "TIPO"=>$PostData["TIPO"],
                        "CPF"=> !empty($PostData['CPF'])? $PostData["CPF"]: NULL,
                        "CNPJ"=> !empty($PostData['CNPJ'])? $PostData["CNPJ"] : NULL
                    );

                    $Create->ExeCreate("[80_ClientesParticulares]", $CLIENTE);
                    $IdCli = $Create->getResult();
                }else{
                    //TESTA SE O CEP TEM O TRAÇO OU NÃO
                    if (strstr($PostData['CEP'], '-')):
                        $Quebra = explode("-", $PostData['CEP']);
                        $PostData['CEP'] = $Quebra[0].$Quebra[1];
                    endif;

                    //TRATAMENTO DE CPF RETIRANDO PONTOS E TRAÇO DO CPF
                    if(!empty($PostData['CPF'])):                    
                        $CPF2 = str_replace(".", "", $PostData["CPF"]);
                        $AUXCPF = str_replace("-", "", $CPF2);
                        $PostData["CPF"] = $AUXCPF;
                    endif;

                    //TRATAMENTO CNPJ RETIRANDO PONTOS, TRAÇO E BARRA DO CNPJ
                    if (!empty($PostData['CNPJ'])):                    
                        $CNPJ2 = str_replace(".", "", $PostData["CNPJ"]);
                        $CNPJ3 = str_replace("/", "", $CNPJ2);
                        $AUXCNPJ = str_replace("-", "", $CNPJ3);
                        $PostData["CNPJ"] = $AUXCNPJ;
                    endif;

                    //GUARDA O ID DO CLIENTE
                    $IdCli = $PostData['id_cliente'];
                }
                                               
                    
                 //VERIFICA SE JÁ EXISTE ENDEREÇO SEMELHANTE CADASTRADO PARA ESTE CLIENTE
                $Read->FullRead("SELECT ID FROM [80_Enderecos] WHERE IDCLIENTE = :cliente AND CEP = :cep AND NUMERO = :numero AND COMPLEMENTO = :complemento","cliente={$IdCli}&cep={$PostData['CEP']}&numero={$PostData['NUMERO']}&complemento={$PostData['COMPLEMENTO']}");                   
                       
                if(!$Read->getResult()):

                    //MONTA ARRAY ENDEREÇO PARA INSERIR NO BANCO
                    $ENDERECO = array("IDCLIENTE"=>$IdCli,"CEP"=>$PostData["CEP"],"LOGRADOURO"=>strtoupper($PostData["LOGRADOURO"]),"NUMERO"=>$PostData["NUMERO"],"BAIRRO"=>strtoupper($PostData["BAIRRO"]), "CIDADE"=>strtoupper($PostData["CIDADE"]),"UF"=>$PostData["UF"], "COMPLEMENTO"=>$PostData["COMPLEMENTO"]);
                    $Create->ExeCreate("[80_Enderecos]", $ENDERECO);
                    $IdEnd = $Create->getResult();
                else:
                    $IdEnd = $Read->getResult()[0]['ID'];

                    //VERIFICA SE JÁ EXISTE UM ORÇAMENTO EM ABERTO PARA ESTE CLIENTE E ENDEREÇO
                    $ReadOrc = new Read;
                    $ReadOrc->FullRead("SELECT COUNT(ID) AS QTD FROM [80_Orcamentos] WHERE TIPOSERVICO = :tipoServico AND STATUS < 5 AND IDCLIENTE = :cliente AND IDENDERECO = :idEndereco","tipoServico={$PostData['TIPOSERVICO']}&cliente={$IdCli}&idEndereco={$IdEnd}");
                    if($ReadOrc->getResult()[0]['QTD'] > 0):
                        $jSON['trigger'] = AjaxErro("Já existe orçamento em andamento para este serviço!",E_USER_WARNING);
                        break;
                    endif;
                endif;

                //CRIA ARRAY DE ORÇAMENTO
                if($IdCli && $IdEnd):
                    $ORCAMENTO = array("IDCLIENTE"=>$IdCli,"IDENDERECO"=>$IdEnd,"TIPOSERVICO"=>$PostData["TIPOSERVICO"],"STATUS"=> 0, "OBS"=>$PostData["OBS"], "USUARIO_SISTEMA"=> $_SESSION['userLogin']["ID"]);
                    $Create->ExeCreate("[80_Orcamentos]", $ORCAMENTO);
                    $IdOrcamento = null;
                    $Valor = 0;
                    if($Create->getResult()){
                        $IdOrcamento = $Create->getResult();
                        $TipoServico = 0;
                        $Chamado = array(
                        'IDORCAMENTO' => $IdOrcamento,
                        'OBS' => $PostData["OBS"],
                        'TIPO_SERVICO' => $TipoServico,
                        "USUARIO_SISTEMA"=> $_SESSION['userLogin']["ID"]
                        );
                        $Create->ExeCreate("[80_Chamados]", $Chamado);

                    }
                    $jSON['inpuval'] = "null"; 
                    $jSON['trigger'] = AjaxErro("Orçamento adicionado com sucesso!");
                    $jSON['success'] = true;  
                else:
                    $jSON['trigger'] = AjaxErro("Erro ao cadastrar o Orçamento");
                endif;
      break;
    case 'consulta':       
            switch ($PostData["Rel"]):
                case 0:
                    //PESQUISA SE O CLIENTE JÁ EXISTE BUSCANDO PELO CPF
                    $Read->FullRead("SELECT * FROM [80_ClientesParticulares] WHERE ID = :id","id={$PostData['Valor']}");
                    if($Read->getResult()):
                        $IdCliente = $Read->getResult()[0]['ID'];
                        $jSON['trigger'] = true;
                        $jSON['cliente'] = $Read->getResult()[0];

                        $jSON['dadosCliente'] = "<article class='dados'><h1>{$Read->getResult()[0]['NOME']}</h1><p>".($Read->getResult()[0]['CPF'] ? "<b>CPF: </b>{$Read->getResult()[0]['CPF']}<br>" : "").($Read->getResult()[0]['CNPJ'] ? "<b>CNPJ: </b>{$Read->getResult()[0]['CNPJ']}<br>" : "")."<b>Telefone: </b>{$Read->getResult()[0]['TELEFONE']}<br><b>E-mail: </b>{$Read->getResult()[0]['EMAIL']}<br><a class='link' href='#ex1' rel='modal:open' id='{$Read->getResult()[0]['ID']}' callback='Clientes' callback_action='edita_cliente' onclick='abreModal(this);'><span class='btn btn_blue'>Editar Dados de Clientes</span></a></p></article>";
                        

                        $Read->FullRead("SELECT * FROM [80_Enderecos] WHERE IDCLIENTE = :id","id={$IdCliente}");
                        if($Read->getResult()):
                            $jSON['enderecoCLiente'] = null;
                            foreach ($Read->getResult() as $ENDERECO):
                                extract($ENDERECO);                       

                                $jSON['enderecoCLiente'] .= "<tr class='enderecos'><td><span style='font-size: 15px;'><b>Endereço:</b></span></td></tr><tr class='enderecos'><td><span style='font-size: 15px;'>{$LOGRADOURO}, {$NUMERO} {$COMPLEMENTO} - {$BAIRRO} - {$CIDADE} {$UF} - {$CEP}</span><br><br><span callback='Clientes' callback_action='use_endereco' class='j_usar_endereco btn btn_darkblue' id='{$ID}'>Usar Endereço</span></td></tr>";
                            endforeach;
                        endif;
                    else:
                        $jSON['enderecoCLiente'] = "<article class='dados'><h1>Cliente não cadastrado!</h1></article>";
                    endif;


                break;
                case 1:
                    $Read->FullRead("SELECT * FROM [80_Enderecos] WHERE ID = :id","id={$PostData['Valor']}");
                    if($Read->getResult()):
                        $jSON['enderecoCLiente'] = null;
                        foreach ($Read->getResult() as $ENDERECO):
                            extract($ENDERECO);                       

                            $jSON['enderecoCLiente'] = "<tr class='enderecos'><td><span style='font-size: 15px;'><b>Endereço:</b></span></td></tr><tr class='enderecos'><td><span style='font-size: 15px;'>{$LOGRADOURO}, {$NUMERO} {$COMPLEMENTO} - {$BAIRRO} - {$CIDADE} {$UF} - {$CEP}</span><br><br><span callback='Clientes' callback_action='use_endereco' class='j_usar_endereco btn btn_darkblue' id='{$ID}'>Usar Endereço</span></td></tr>";

                            $jSON['trigger'] = true;
                            
                            $Read->FullRead("SELECT * FROM [80_ClientesParticulares] WHERE ID = :id","id={$IDCLIENTE}");
                            $jSON['cliente'] = $Read->getResult()[0];

                            $jSON['dadosCliente'] = "<article class='dados'><h1>{$Read->getResult()[0]['NOME']}</h1><p>".($Read->getResult()[0]['CPF'] ? "<b>CPF: </b>{$Read->getResult()[0]['CPF']}<br>" : "").($Read->getResult()[0]['CNPJ'] ? "<b>CNPJ: </b>{$Read->getResult()[0]['CNPJ']}<br>" : "")."<b>Telefone: </b>{$Read->getResult()[0]['TELEFONE']}<br><b>E-mail: </b>{$Read->getResult()[0]['EMAIL']}<br><a class='link' href='#ex1' rel='modal:open' id='{$Read->getResult()[0]['ID']}' callback='Clientes' callback_action='edita_cliente' onclick='abreModal(this);'><span class='btn btn_blue'>Editar Dados de Clientes</span></a></p></article>";
                            

                        endforeach;
                    else:
                        $jSON['enderecoCLiente'] = "<article class='dados'><h1>Cliente não cadastrado!</h1></article>";
                    endif;
                
                break;
                case 2:

                    $PostData["CPF"] = $PostData["Valor"];
                    $CPF2 = str_replace(".", "", $PostData["CPF"]);
                    $AUXCPF = str_replace("-", "", $CPF2);
                    $PostData["CPF"] = $AUXCPF;

                    //PESQUISA SE O CLIENTE JÁ EXISTE BUSCANDO PELO CPF
                    $Read->FullRead("SELECT * FROM [80_ClientesParticulares] WHERE CPF = :cpf","cpf={$PostData['CPF']}");
                    if($Read->getResult()):
                        $IdCliente = $Read->getResult()[0]['ID'];
                        $jSON['trigger'] = true;
                        $jSON['cliente'] = $Read->getResult()[0];

                        $jSON['dadosCliente'] = "<article class='dados'><h1>{$Read->getResult()[0]['NOME']}</h1><p>".($Read->getResult()[0]['CPF'] ? "<b>CPF: </b>{$Read->getResult()[0]['CPF']}<br>" : "").($Read->getResult()[0]['CNPJ'] ? "<b>CNPJ: </b>{$Read->getResult()[0]['CNPJ']}<br>" : "")."<b>Telefone: </b>{$Read->getResult()[0]['TELEFONE']}<br><b>E-mail: </b>{$Read->getResult()[0]['EMAIL']}<br><a class='link' href='#ex1' rel='modal:open' id='{$Read->getResult()[0]['ID']}' callback='Clientes' callback_action='edita_cliente' onclick='abreModal(this);'><span class='btn btn_blue'>Editar Dados de Clientes</span></a></p></article>";

                        $Read->FullRead("SELECT * FROM [80_Enderecos] WHERE IDCLIENTE = :id","id={$IdCliente}");
                        if($Read->getResult()):
                            $jSON['enderecoCLiente'] = null;
                            foreach ($Read->getResult() as $ENDERECO):
                                extract($ENDERECO);                       

                                $jSON['enderecoCLiente'] .= "<tr class='enderecos'><td><span style='font-size: 15px;'><b>Endereço:</b></span></td></tr><tr class='enderecos'><td><span style='font-size: 15px;'>{$LOGRADOURO}, {$NUMERO} {$COMPLEMENTO} - {$BAIRRO} - {$CIDADE} {$UF} - {$CEP}</span></td></tr>";
                            endforeach;
                        endif;
                    else:
                        $jSON['enderecoCLiente'] = "<article class='dados'><h1>Cliente não cadastrado!</h1></article>";
                    endif;
                
                break;
                case 3:

                    $PostData["CNPJ"] = $PostData["Valor"];
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

                        $jSON['dadosCliente'] = "<article class='dados'><h1>{$Read->getResult()[0]['NOME']}</h1><p>".($Read->getResult()[0]['CPF'] ? "<b>CPF: </b>{$Read->getResult()[0]['CPF']}<br>" : "").($Read->getResult()[0]['CNPJ'] ? "<b>CNPJ: </b>{$Read->getResult()[0]['CNPJ']}<br>" : "")."<b>Telefone: </b>{$Read->getResult()[0]['TELEFONE']}<br><b>E-mail: </b>{$Read->getResult()[0]['EMAIL']}<br><a class='link' href='#ex1' rel='modal:open' id='{$Read->getResult()[0]['ID']}' callback='Clientes' callback_action='edita_cliente' onclick='abreModal(this);'><span class='btn btn_blue'>Editar Dados de Clientes</span></a></p></article>";

                        $Read->FullRead("SELECT * FROM [80_Enderecos] WHERE IDCLIENTE = :id","id={$IdCliente}");
                        if($Read->getResult()):
                            $jSON['enderecoCLiente'] = null;
                            foreach ($Read->getResult() as $ENDERECO):
                                extract($ENDERECO);                       

                                $jSON['enderecoCLiente'] .= "<tr class='enderecos'><td><span style='font-size: 15px;'><b>Endereço:</b></span></td></tr><tr class='enderecos'><td><span style='font-size: 15px;'>{$LOGRADOURO}, {$NUMERO} {$COMPLEMENTO} - {$BAIRRO} - {$CIDADE} {$UF} - {$CEP}</span></td></tr>";
                            endforeach;
                        endif;                    
                    else:
                        $jSON['enderecoCLiente'] = "<article class='dados'><h1>Cliente não cadastrado!</h1></article>";
                    endif;                
                break;
            endswitch;
        break;

        case 'edita_cliente':
            $Read->FullRead("SELECT * FROM [80_ClientesParticulares] WHERE ID = :id","id={$PostData['ID']}");
            if($Read->getResult()):
                $jSON['editaDados'] = $Read->getResult()[0];
            endif;
        break;

        case 'alteraCliente':

                //CASO O CLIENTE NÃO TENHA CPF E CNPJ
                if(empty($PostData['CPF']) && empty($PostData['CNPJ'])):
                    $CLIENTE = array("NOME"=>$PostData["NOME"],"TELEFONE"=>$PostData["TELEFONE"],"TELEFONE2"=>$PostData["TELEFONE2"],"EMAIL"=>$PostData["EMAIL"],"TIPO"=>$PostData["TIPO"]);
                    $Update->ExeUpdate("[80_ClientesParticulares]", $CLIENTE, "WHERE ID= :id", "id={$PostData['ID']}");
                    if ($Update->getResult()):
                        $jSON['trigger'] = AjaxErro("Cliente alterado com sucesso");
                        $jSON['redirect'] = 'dashboard.php?wc=clientes/cadastro';
                    else:
                        $jSON['trigger'] = AjaxErro('Erro ao atualizar os dados do cliente!', E_USER_ERROR);
                        $jSON['redirect'] = 'dashboard.php?wc=clientes/cadastro';
                    endif;

                endif;

                if(!empty($PostData['CPF'])):   

                    //TRATAMENTO DE CPF RETIRANDO PONTOS E TRAÇO DO CPF
                    $CPF2 = str_replace(".", "", $PostData["CPF"]);
                    $AUXCPF = str_replace("-", "", $CPF2);
                    $PostData["CPF"] = $AUXCPF;

                    //PESQUISA SE EXISTE O CPF INFORMADO
                    $Read->FullRead("SELECT ID FROM [80_ClientesParticulares] WHERE CPF = :cpf","cpf={$PostData['CPF']}");
                    if(!$Read->getResult()):   
                        //MONTA ARRAY CLIENTE PARA INSERIR NO BANCO                   
                        $CLIENTE = array("NOME"=>$PostData["NOME"],"TELEFONE"=>$PostData["TELEFONE"],"EMAIL"=>$PostData["EMAIL"],"TIPO"=>$PostData["TIPO"], "CPF"=>$PostData["CPF"]);
                        
                        $Update->ExeUpdate("[80_ClientesParticulares]", $CLIENTE, "WHERE ID= :id", "id={$PostData['ID']}");
                        $jSON['trigger'] = AjaxErro("Cliente alterado com sucesso"); 
                        $jSON['redirect'] = 'dashboard.php?wc=clientes/cadastro';                    
                    else:
                        $jSON['trigger'] = AjaxErro('Já existe cliente com este CPF cadastrado!', E_USER_ERROR);                        
                    endif; 
                endif; 

                if (!empty($PostData['CNPJ'])):

                    //TRATAMENTO CNPJ RETIRANDO PONTOS, TRAÇO E BARRO DO CNPJ
                    $CNPJ2 = str_replace(".", "", $PostData["CNPJ"]);
                    $CNPJ3 = str_replace("/", "", $CNPJ2);
                    $AUXCNPJ = str_replace("-", "", $CNPJ3);
                    $PostData["CNPJ"] = $AUXCNPJ;

                    $Read->FullRead("SELECT ID, CNPJ FROM [80_ClientesParticulares] WHERE CNPJ = :cnpj","cnpj={$PostData['CNPJ']}");
                    if(!$Read->getResult()):   
                        //MONTA ARRAY CLIENTE PARA INSERIR NO BANCO                   
                        $CLIENTE = array("NOME"=>$PostData["NOME"],"TELEFONE"=>$PostData["TELEFONE"],"EMAIL"=>$PostData["EMAIL"],"TIPO"=>$PostData["TIPO"], "CNPJ"=>$PostData["CNPJ"]);
                        
                        $Update->ExeUpdate("[80_ClientesParticulares]", $CLIENTE, "WHERE ID= :id", "id={$PostData['ID']}");
                        $jSON['trigger'] = AjaxErro("Cliente alterado com sucesso");
                        $jSON['redirect'] = 'dashboard.php?wc=clientes/cadastro';
                    else:
                        $jSON['trigger'] = AjaxErro('Já existe cliente com este CNPJ cadastrado!', E_USER_ERROR);                              
                    endif; 
                endif;          
      break;

      case 'use_endereco':
      $Read->FullRead("SELECT * FROM [80_Enderecos] WHERE ID = :id","id={$PostData['ID']}");

     $jSON['useEndereco'] = $Read->getResult()[0];
      break;

      case 'busca_clientes':

                   $Read->FullRead("SELECT ID, NOME FROM [80_ClientesParticulares]");

                        $jSON['trigger'] = true;
                        $jSON['buscarCliente'] = $Read->getResult();

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

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
        //TRATAMENTO DE CPF
        $CPF = $PostData["CPF"];
        $CPF2 = str_replace(".", "", $CPF);
        $AUXCPF = str_replace("-", "", $CPF2);
        $PostData["CPF"] = $AUXCPF;


        //TRATAMENTO CNPJ
        $CNPJ = $PostData["CNPJ"];
        $CNPJ2 = str_replace(".", "", $CNPJ);
        $CNPJ3 = str_replace("/", "", $CNPJ2);
        $AUXCNPJ = str_replace("-", "", $CNPJ3);
        $PostData["CNPJ"] = $AUXCNPJ; 


        //CONSULTA DO CPF NO BANCO SE JÁ EXISTE CRIA ORÇAMENTO
        $Read->FullRead("SELECT CPF FROM [80_ClientesParticulares] WHERE CPF = :cpf","cpf={$PostData['CPF']}");
        if($Read->getResult()):
          $ID = $Create->getResult();
            $orcamento = array("IDCLIENTE"=>$ID,"ASSUNTO"=>$PostData["ASSUNTO"],"STATUS"=>0);
            $Create->ExeCreate("[80_Orcamentos]", $orcamento);
            if($Create->getResult())://RETORNA ID DO ULTIMO REGISTRO INSERIDO NO BANCO DE DADOS
              $jSON['trigger'] = AjaxErro("<b class='icon-checkmark'>CPF JÁ CADASTRADO/ORÇAMENTO CRIADO COM SUCESSO!");
              $jSON['inpuval'] = "null"; 
            endif;
              
        else:
          //CONSULTA CNPJ NO BANCO SE JÁ EXISTE CRIA ORÇAMENTO
          $Read->FullRead("SELECT CNPJ FROM [80_ClientesParticulares] WHERE CNPJ = :cnpj","cnpj={$PostData['CNPJ']}");
          if($Read->getResult()):
           $ID = $Create->getResult();
            $orcamento = array("IDCLIENTE"=>$ID,"ASSUNTO"=>$PostData["ASSUNTO"],"STATUS"=>0);
            $Create->ExeCreate("[80_Orcamentos]", $orcamento);
            if($Create->getResult())://RETORNA ID DO ULTIMO REGISTRO INSERIDO NO BANCO DE DADOS
              $jSON['trigger'] = AjaxErro("<b class='icon-checkmark'>CNPJ JÁ CADASTRADO/ORÇAMENTO CRIADO COM SUCESSO!");
              $jSON['inpuval'] = "null"; 
            endif;
          else:
            //SE CPF E CNPJ NÃO EXISTEM NO BANCO CADSTRA E CRIA ORÇAMENTO
            $Create->ExeCreate("[80_ClientesParticulares]", $PostData);
            $ID = $Create->getResult();
            $orcamento = array("IDCLIENTE"=>$ID,"ASSUNTO"=>$PostData["ASSUNTO"],"STATUS"=>0);
            $Create->ExeCreate("[80_Orcamentos]", $orcamento);
            if($Create->getResult())://RETORNA ID DO ULTIMO REGISTRO INSERIDO NO BANCO DE DADOS
              $jSON['trigger'] = AjaxErro("<b class='icon-checkmark'>CLIENTE CADASTRADO/ORÇAMENTO CRIADO COM SUCESSO!");
              $jSON['inpuval'] = "null"; 
            endif;
          endif;
              
      endif;  
            
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
                        $jSON['trigger'] = true;
                        $jSON['cliente'] = $Read->getResult()[0];
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
                        $jSON['trigger'] = true;
                        $jSON['cliente'] = $Read->getResult()[0];
                    endif;
                 else:

                 endif;
            endif;
        break;
    case 'endereco':       
            var_dump($PostData);
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

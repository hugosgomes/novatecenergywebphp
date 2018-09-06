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
$CallBack = 'Home';
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

    switch ($Case):        
        case 'consulta':
        $criterioEndereco = "";
        $ctiterioCliente = "";
        $criterioMes = "";
        $idCliente = "";
        $criterioOrdem = "data";        

        $consulta_inicial = $PostData['inicial'];
        $criterioEndereco = $PostData['endereco'] != "t" ? " AND [80_Enderecos].ID = " . $PostData['endereco'] . " ": "";
        $ctiterioCliente = $PostData['cliente'] != "t" ? " AND [80_Enderecos].IDCLIENTE = " . $PostData['cliente'] . " ": "";
        $criterioMes = $PostData['mes'] != "t" ? " AND MONTH([80_Orcamentos].DATASOLICITACAO) = " . $PostData['mes'] . " ": "";
        $criterioOrdemAnalise = $PostData['ordemAnalise'] != "data" ? " ORDER BY [80_Orcamentos].VALOR DESC" : " ORDER BY [80_Orcamentos].DATASOLICITACAO";
        $valueOrdem = $PostData['ordemAnalise'] == "data" ? "valor": "data";
        $criterioOrdemExecutando = $PostData['ordemExecutando'] != "data" ? " ORDER BY [80_Orcamentos].VALOR DESC" : " ORDER BY [80_Orcamentos].DATASOLICITACAO";
        $valueOrdemExecutando = $PostData['ordemExecutando'] == "data" ? "valor": "data";
        
        $queryColunas = "SELECT [80_Enderecos].LOGRADOURO + ', ' + [80_Enderecos].NUMERO + ', ' + [80_Enderecos].COMPLEMENTO + ' - ' + [80_Enderecos].BAIRRO + ',' +
                        [80_Enderecos].CIDADE + ',' + [80_Enderecos].UF AS ENDERECO, [80_Orcamentos].ID FROM [80_Orcamentos]
                        INNER JOIN [80_ClientesParticulares] ON [80_Orcamentos].IDCLIENTE = [80_ClientesParticulares].ID
                        INNER JOIN [80_Enderecos] ON [80_Orcamentos].IDENDERECO = [80_Enderecos].ID ";       

        $Read->FullRead($queryColunas . " WHERE [80_Orcamentos].STATUS = 0 AND [80_ClientesParticulares].TIPO = 2 " . $criterioEndereco . $ctiterioCliente .
                        " ORDER BY [80_Orcamentos].DATASOLICITACAO","");
        if ($Read->getResult()):
        	$jSON['addcoluna1'] = null;//É necessário desclarar como numo por causa da fraca tipação
        	foreach ($Read->getResult() as $enderecos):
        		$jSON['trigger'] = true;
        		$jSON['addcoluna1'] .= "<div class='box_content buttons_clientes clientes_sem_contato'>".
							        		"<a href='#'><div class='panel_header' style='padding: 0px;border: none;'>".
							        		"<span  style='color: #bdbdbd;'></span>".
							        		"</div></a>".
							        		"<ul><li class='endereco_txt'><a class='link' href='.chamados' rel='modal' id = {$enderecos['ID']} callback='Home' callback_action='consulta_modal'>".
                                            "<span><b>{$enderecos['ENDERECO']}</b></span></a></li></ul>".
						        		"</div>";
        	endforeach;
        endif;

        $Read->FullRead($queryColunas. " WHERE [80_Orcamentos].STATUS = 1 AND [80_ClientesParticulares].TIPO = 2" . $criterioEndereco . $ctiterioCliente .
                        "ORDER BY [80_Orcamentos].DATASOLICITACAO","");
        if ($Read->getResult()):
            $jSON['addcoluna2'] = null;//É necessário desclarar como numo por causa da fraca tipação
            foreach ($Read->getResult() as $enderecos):
                $jSON['trigger'] = true;
                $jSON['addcoluna2'] .= "<div class='box_content buttons_clientes clientes_sem_contato'>".
                                            "<a href='#'><div class='panel_header' style='padding: 0px;border: none;'>".
                                            "<span  style='color: #bdbdbd;'></span>".
                                            "</div></a>".
                                            "<ul><li class='endereco_txt'><a class='link' href='.chamados' rel='modal'><span><b>{$enderecos['ENDERECO']}</b></span></a></li></ul>".
                                        "</div>";
            endforeach;
        endif;

        $Read->FullRead($queryColunas. " WHERE [80_Orcamentos].STATUS = 2 AND [80_ClientesParticulares].TIPO = 2" . $criterioEndereco . $ctiterioCliente . $criterioOrdemAnalise,"");
        if ($Read->getResult()):
            $jSON['addcoluna3'] = null;//É necessário desclarar como numo por causa da fraca tipação
            foreach ($Read->getResult() as $enderecos):
                $jSON['trigger'] = true;
                $jSON['addcoluna3'] .= "<div class='box_content buttons_clientes clientes_sem_contato'>".
                                            "<a href='#'><div class='panel_header' style='padding: 0px;border: none;'>".
                                            "<span  style='color: #bdbdbd;'></span>".
                                            "</div></a>".
                                            "<ul><li class='endereco_txt'><a class='link' href='.chamados' rel='modal'><span><b>{$enderecos['ENDERECO']}</b></span></a></li></ul>".
                                        "</div>";                             
            endforeach;
        endif;

        $Read->FullRead($queryColunas. " WHERE [80_Orcamentos].STATUS = 3 AND [80_ClientesParticulares].TIPO = 2" . $criterioEndereco . $ctiterioCliente . $criterioOrdemExecutando,"");
        if ($Read->getResult()):
            $jSON['addcoluna4'] = null;//É necessário desclarar como numo por causa da fraca tipação
            foreach ($Read->getResult() as $enderecos):
                $jSON['trigger'] = true;
                $jSON['addcoluna4'] .= "<div class='box_content buttons_clientes clientes_sem_contato'>".
                                            "<a href='#'><div class='panel_header' style='padding: 0px;border: none;'>".
                                            "<span  style='color: #bdbdbd;'></span>".
                                            "</div></a>".
                                            "<ul><li class='endereco_txt'><a class='link' href='.chamados' rel='modal'><span><b>{$enderecos['ENDERECO']}</b></span></a></li></ul>".
                                        "</div>";
            endforeach;
        endif;

        $Read->FullRead($queryColunas. " WHERE [80_Orcamentos].STATUS = 4 AND [80_ClientesParticulares].TIPO = 2". $criterioMes .
                        "ORDER BY [80_Orcamentos].DATASOLICITACAO","");
        if ($Read->getResult()):
            $jSON['addcoluna5'] = null;//É necessário desclarar como numo por causa da fraca tipação
            foreach ($Read->getResult() as $enderecos):
                $jSON['trigger'] = true;
                $jSON['addcoluna5'] .= "<div class='box_content buttons_clientes clientes_sem_contato'>".
                                            "<a href='#'><div class='panel_header' style='padding: 0px;border: none;'>".
                                            "<span  style='color: #bdbdbd;'></span>".
                                            "</div></a>".
                                            "<ul><li class='endereco_txt'><a class='link' href='.chamados' rel='modal'><span><b>{$enderecos['ENDERECO']}</b></span></a></li></ul>".
                                        "</div>";
            endforeach;
        endif;

        $Read->FullRead($queryColunas. " WHERE [80_Orcamentos].STATUS = 5 AND [80_ClientesParticulares].TIPO = 2". $criterioMes .
                        "ORDER BY [80_Orcamentos].DATASOLICITACAO","");
        if ($Read->getResult()):
            $jSON['addcoluna6'] = null;//É necessário desclarar como numo por causa da fraca tipação
            foreach ($Read->getResult() as $enderecos):
                $jSON['trigger'] = true;
                $jSON['addcoluna6'] .= "<div class='box_content buttons_clientes clientes_sem_contato'>".
                                            "<a href='#'><div class='panel_header' style='padding: 0px;border: none;'>".
                                            "<span  style='color: #bdbdbd;'></span>".
                                            "</div></a>".
                                            "<ul><li class='endereco_txt'><a class='link' href='.chamados' rel='modal'><span><b>{$enderecos['ENDERECO']}</b></span></a></li></ul>".
                                        "</div>";
            endforeach;
        endif;

        $Read->FullRead($queryColunas. " WHERE [80_Orcamentos].STATUS = 6 AND [80_ClientesParticulares].TIPO = 2". $criterioMes .
                        "ORDER BY [80_Orcamentos].DATASOLICITACAO","");
        if ($Read->getResult()):
            $jSON['addcoluna7'] = null;//É necessário desclarar como numo por causa da fraca tipação
            foreach ($Read->getResult() as $enderecos):
                $jSON['trigger'] = true;
                $jSON['addcoluna7'] .= "<div class='box_content buttons_clientes clientes_sem_contato'>".
                                            "<a href='#'><div class='panel_header' style='padding: 0px;border: none;'>".
                                            "<span  style='color: #bdbdbd;'></span>".
                                            "</div></a>".
                                            "<ul><li class='endereco_txt'><a class='link' href='.chamados' rel='modal'><span><b>{$enderecos['ENDERECO']}</b></span></a></li></ul>".
                                        "</div>";
            endforeach;
        endif;


        //PREENCHER TOTAL EM ANÁLISE
        $jSON['addEmAnalise'] = NULL;
        $Read->FullRead("SELECT SUM([80_Orcamentos].VALOR) AS VALOR FROM [80_Orcamentos]
                        INNER JOIN [80_ClientesParticulares] ON [80_Orcamentos].IDCLIENTE = [80_ClientesParticulares].ID
                        INNER JOIN [80_Enderecos] ON [80_Orcamentos].IDENDERECO = [80_Enderecos].ID  WHERE [80_Orcamentos].STATUS = 2 "  . $criterioEndereco . $ctiterioCliente . 
                        "AND [80_ClientesParticulares].TIPO = 2","");
        foreach ($Read->getResult() as $totais):
            $totais['VALOR'] = number_format($totais['VALOR'],2,',','.');
            $jSON['trigger'] = true;
            $jSON['addEmAnalise'] = "<h2 class='js_h2_emAnalise'><a href='#'  onclick='ordenarOrcamento();'><i id='j_ordemEmAnalise' ordemAnalise='". $valueOrdem . "' class='icon-sort-numberic-desc' style='font-size: 15px;float: right;color: white;'></i></a>Em Análise (R$){$totais['VALOR']}<br></h2>";
        endforeach;


        //PREENCHER TOTAL EXECUTANDO
        $jSON['addExecutando'] = NULL;
        $Read->FullRead("SELECT SUM([80_Orcamentos].VALOR) AS VALOR FROM [80_Orcamentos]
                        INNER JOIN [80_ClientesParticulares] ON [80_Orcamentos].IDCLIENTE = [80_ClientesParticulares].ID
                        INNER JOIN [80_Enderecos] ON [80_Orcamentos].IDENDERECO = [80_Enderecos].ID  WHERE [80_Orcamentos].STATUS = 3 "  . $criterioEndereco . $ctiterioCliente . 
                        "AND [80_ClientesParticulares].TIPO = 2","");
        foreach ($Read->getResult() as $totais):
            $totais['VALOR'] = number_format($totais['VALOR'],2,',','.');
            $jSON['trigger'] = true;
            $jSON['addExecutando'] = "<h2 class='js_h2_executando'><a href='#'  onclick='ordenarOrcamento();'><i id='j_ordemExecutando' ordemExecutando='". $valueOrdemExecutando . "' class='icon-sort-numberic-desc' style='font-size: 15px;float: right;color: white;'></i></a>Em Análise (R$){$totais['VALOR']}<br></h2>";
        endforeach;


        if ($consulta_inicial == 0) {
            //PREENCHER COMBO DE ENREDEÇO
            $jSON['addComboEndereco'] = "<option value='t' class='j_option_endereco'>>> TODOS <<</option>";
            $Read->FullRead("SELECT [80_Enderecos].ID, [80_Enderecos].LOGRADOURO + ', ' + [80_Enderecos].NUMERO + ', ' + [80_Enderecos].COMPLEMENTO + ' - ' + [80_Enderecos].BAIRRO + ',' +
                            [80_Enderecos].CIDADE + ',' + [80_Enderecos].UF AS ENDERECO FROM [80_Enderecos]
                            INNER JOIN [80_ClientesParticulares] ON [80_Enderecos].IDCLIENTE = [80_ClientesParticulares].ID
                            WHERE [80_ClientesParticulares].TIPO = 2","");
            foreach ($Read->getResult() as $enderecos):
                $jSON['trigger'] = true;
                $jSON['addComboEndereco'] .= "<option value='{$enderecos['ID']}' class='j_option_endereco'>{$enderecos['ENDERECO']}</option>";
            endforeach;

            //PREENCHER COMBO DE ENREDEÇO
            $jSON['addComboCliente'] = "<option value='t' class='j_option_cliente'>>> TODOS <<</option>";
            $Read->FullRead("SELECT ID,NOME FROM [80_ClientesParticulares] WHERE TIPO = 2","");
            foreach ($Read->getResult() as $clientes):
                $jSON['trigger'] = true;
                $jSON['addComboCliente'] .= "<option value='{$clientes['ID']}' class='j_option_cliente'>{$clientes['NOME']}</option>";
            endforeach;            
            
        }
        break;

        case 'consulta_modal':
            $idCliente = $PostData['idcliente'];
            $Read->FullRead("SELECT UPPER([80_ClientesParticulares].NOME) AS NOME, [80_ClientesParticulares].EMAIL, [80_ClientesParticulares].TELEFONE, [80_Enderecos].LOGRADOURO + ', ' + [80_Enderecos].NUMERO + ', ' + [80_Enderecos].COMPLEMENTO + ' - ' + [80_Enderecos].BAIRRO + ',' +
                [80_Enderecos].CIDADE + ',' + [80_Enderecos].UF AS ENDERECO, [80_Orcamentos].ID FROM [80_Orcamentos]
                INNER JOIN [80_ClientesParticulares] ON [80_Orcamentos].IDCLIENTE = [80_ClientesParticulares].ID
                INNER JOIN [80_Enderecos] ON [80_Orcamentos].IDENDERECO = [80_Enderecos].ID WHERE [80_Orcamentos].ID = " . $idCliente,"");
            if ($Read->getResult()):
                $jSON['addClienteModal'] = null;//É necessário desclarar como numo por causa da fraca tipação
                foreach ($Read->getResult() as $dadosModalCliente):
                $jSON['addClienteModal'] = "<div class='dados_clientes'>
                                             <h5>{$dadosModalCliente['NOME']}</h5>
                                             <ul class='cl_dados'>
                                               <li style='padding-bottom: 0px;' class='dados_endereco'>{$dadosModalCliente['EMAIL']}<span class='m_endereco'></span></li>
                                               <li  style='padding-bottom: 0px;'>{$dadosModalCliente['ENDERECO']}</li>
                                               <li  style='padding-bottom: 0px;'><a href='tel:021980564678' style='color: #004491'>{$dadosModalCliente['TELEFONE']}</a></li>
                                               <br>
                                               <hr>
                                             </div>";
                $jSON['teste'] = "SELECT UPPER([80_ClientesParticulares].NOME) AS NOME, [80_ClientesParticulares].EMAIL, [80_ClientesParticulares].TELEFONE, [80_Enderecos].LOGRADOURO + ', ' + [80_Enderecos].NUMERO + ', ' + [80_Enderecos].COMPLEMENTO + ' - ' + [80_Enderecos].BAIRRO + ',' +
                [80_Enderecos].CIDADE + ',' + [80_Enderecos].UF AS ENDERECO, [80_Orcamentos].ID FROM [80_Orcamentos]
                INNER JOIN [80_ClientesParticulares] ON [80_Orcamentos].IDCLIENTE = [80_ClientesParticulares].ID
                INNER JOIN [80_Enderecos] ON [80_Orcamentos].IDENDERECO = [80_Enderecos].ID";
                endforeach;
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
 ?>
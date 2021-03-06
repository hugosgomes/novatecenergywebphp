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
$date = date("d/m/Y H:i");
//VALIDA AÇÃO
if ($PostData && $PostData['callback_action'] && $PostData['callback'] == $CallBack):
    //PREPARA OS DADOS
    $Case = $PostData['callback_action'];
    unset($PostData['callback'], $PostData['callback_action']);

    // AUTO INSTANCE OBJECT READ AND CREATE
    if (empty($Read)):
        $Read = new Read;
    endif;

    if (empty($Create)):
        $Create = new Create;
    endif;

    if (empty($Update)):
        $Update = new Update;
    endif;

    switch ($Case):        
        case 'consulta':
        $criterioEndereco = "";
        $criterioCliente = "";
        $criterioMes = "";
        $criterioMesFiltro = "";
        $criterioAnoFiltro = "";
        $idCliente = "";  

        $valueOrdem = $PostData['ordemAnalise'];
        $valueOrdemExecutando = $PostData['ordemExecutando'];

        if ($PostData['ordem'] == "analise") {
            $valueOrdem = $valueOrdem == "data" ? "valor": "data";
        }else if ($PostData['ordem'] == "executando"){
            $valueOrdemExecutando = $valueOrdemExecutando == "data" ? "valor": "data";
        }   

        $consulta_inicial = $PostData['inicial'];
        $criterioEndereco = $PostData['endereco'] != "t" ? " AND [80_Enderecos].ID = " . $PostData['endereco'] . " ": "";
        $criterioCliente = $PostData['cliente'] != "t" ? " AND [80_Enderecos].IDCLIENTE = " . $PostData['cliente'] . " ": "";
        $criterioMes = $PostData['mes'] != "t" ? " AND (MONTH(DATAAGENDADA) = " . $PostData['mes'] . ") ": "";
        $criterioAno = $PostData['ano'] != "t" ? " AND (YEAR(DATAAGENDADA) = " . $PostData['ano'] . ") ": "";
        $criterioMesFiltro = $PostData['mes'] != "t" ? " AND (MONTH([80_Orcamentos].DATA_SISTEMA) = " . $PostData['mes'] . ") ": "";
        $criterioAnoFiltro = $PostData['ano'] != "t" ? " AND (YEAR([80_Orcamentos].DATA_SISTEMA) = " . $PostData['ano'] . ") ": "";
        $criterioOrdemAnalise = $valueOrdem != "data" ? " ORDER BY [80_Orcamentos].VALOR DESC" : " ORDER BY [80_Orcamentos].DATASOLICITACAO";
        $criterioOrdemExecutando = $valueOrdemExecutando != "data" ? " ORDER BY [80_Orcamentos].VALOR DESC" : " ORDER BY [80_Orcamentos].DATASOLICITACAO"; 
        $criterioMesCanc = $PostData['mes'] != "t" ? " AND (MONTH([80_Chamados].DATA_SISTEMA) = " . $PostData['mes'] . ") ": "";
        $criterioAnoCanc = $PostData['ano'] != "t" ? " AND (YEAR([80_Chamados].DATA_SISTEMA) = " . $PostData['ano'] . ") ": "";      

        
        
        $queryColunas = "SELECT [80_Enderecos].LOGRADOURO + ', ' + [80_Enderecos].NUMERO + ', ' + [80_Enderecos].COMPLEMENTO + ' - ' + [80_Enderecos].BAIRRO + ',' +
                        [80_Enderecos].CIDADE + ',' + [80_Enderecos].UF AS ENDERECO, [80_Orcamentos].ID, [80_Orcamentos].DATASOLICITACAO, [80_Orcamentos].STATUS FROM [80_Orcamentos]
                        INNER JOIN [80_ClientesParticulares] ON [80_Orcamentos].IDCLIENTE = [80_ClientesParticulares].ID
                        INNER JOIN [80_Enderecos] ON [80_Orcamentos].IDENDERECO = [80_Enderecos].ID ";       

        $Read->FullRead($queryColunas . " WHERE [80_Orcamentos].STATUS = 0 AND [80_ClientesParticulares].TIPO = 2 " . $criterioEndereco . $criterioCliente .
                        " GROUP BY [80_Enderecos].LOGRADOURO + ', ' + [80_Enderecos].NUMERO + ', ' + [80_Enderecos].COMPLEMENTO + ' - ' + [80_Enderecos].BAIRRO + ',' +
                        [80_Enderecos].CIDADE + ',' + [80_Enderecos].UF, [80_Orcamentos].ID, [80_Orcamentos].STATUS, [80_Orcamentos].DATASOLICITACAO ORDER BY [80_Orcamentos].DATASOLICITACAO","");
        
        if ($Read->getResult()):
        	$jSON['addcoluna1'] = null;//É necessário desclarar como numo por causa da fraca tipação
        	foreach ($Read->getResult() as $enderecos):
        		$jSON['trigger'] = true;
        		$jSON['addcoluna1'] .= "<div class='box_content buttons_clientes clientes_sem_contato' style='text-transform: uppercase;>".
							        		"<a href='#'><div class='panel_header' style='padding: 0px;border: none;'>".
							        		"<span  style='color: #bdbdbd;'></span>".
							        		"</div></a>".
							        		"<ul><li class='endereco_txt'><a class='link' href='#ex1' rel='modal:open' id = {$enderecos['ID']} callback='Home' callback_action='consulta_modal' status='{$enderecos['STATUS']}' onclick='abreModal(this);'>".
                                            "<span><b>{$enderecos['ENDERECO']}</b></span></a></li></ul>".
						        		"</div>";
        	endforeach;
        endif;

        $Read->FullRead($queryColunas. " WHERE [80_Orcamentos].STATUS = 1 AND [80_ClientesParticulares].TIPO = 2" . $criterioEndereco . $criterioCliente .
                        " ORDER BY [80_Orcamentos].DATASOLICITACAO","");
        if ($Read->getResult()):
            $jSON['addcoluna2'] = null;
            //É necessário desclarar como numo por causa da fraca tipação
            foreach ($Read->getResult() as $enderecos):
                $cor = getCor($enderecos['ID']);
                $jSON['trigger'] = true;
                $jSON['addcoluna2'] .= "<div class='box_content {$cor} clientes_sem_contato' style='text-transform: uppercase;>".
                                            "<a href='#'><div class='panel_header' style='padding: 0px;border: none;'>".
                                            "<span  style='color: #bdbdbd;'></span>".
                                            "</div></a>".
                                            "<ul><li class='endereco_txt'><a class='link' href='#ex1' rel='modal:open' id = {$enderecos['ID']} callback='Home' callback_action='consulta_modal' status='{$enderecos['STATUS']}' onclick='abreModal(this);'><span><b>{$enderecos['ENDERECO']}</b></span></a></li></ul>".
                                        "</div>";
            endforeach;
        endif;

        $Read->FullRead($queryColunas. " WHERE [80_Orcamentos].STATUS = 2 AND [80_ClientesParticulares].TIPO = 2" . $criterioEndereco . $criterioCliente . $criterioOrdemAnalise,"");
        if ($Read->getResult()):
            $jSON['addcoluna3'] = null;//É necessário desclarar como numo por causa da fraca tipação
            foreach ($Read->getResult() as $enderecos):
                $jSON['trigger'] = true;
                $jSON['addcoluna3'] .= "<div class='box_content buttons_clientes clientes_sem_contato' style='text-transform: uppercase;'>".
                                            "<a href='#'><div class='panel_header' style='padding: 0px;border: none;'>".
                                            "<span  style='color: #bdbdbd;'></span>".
                                            "</div></a>".
                                            "<ul><li class='endereco_txt'><a class='link' href='#ex1' rel='modal:open' id = {$enderecos['ID']} callback='Home' callback_action='consulta_modal' status='{$enderecos['STATUS']}' onclick='abreModal(this);'><span><b>{$enderecos['ENDERECO']}</b></span></a></li></ul>".
                                        "</div>";                             
            endforeach;
        endif;

        $Read->FullRead($queryColunas. " WHERE [80_Orcamentos].STATUS = 3 AND [80_ClientesParticulares].TIPO = 2" . $criterioEndereco . $criterioCliente . $criterioOrdemExecutando,"");
        if ($Read->getResult()):
            $jSON['addcoluna4'] = null;//É necessário desclarar como numo por causa da fraca tipação
            foreach ($Read->getResult() as $enderecos):
                $jSON['trigger'] = true;
                $jSON['addcoluna4'] .= "<div class='box_content buttons_clientes clientes_sem_contato' style='text-transform: uppercase;>".
                                            "<a href='#'><div class='panel_header' style='padding: 0px;border: none;'>".
                                            "<span  style='color: #bdbdbd;'></span>".
                                            "</div></a>".
                                            "<ul><li class='endereco_txt'><a class='link' href='#ex1' rel='modal:open' id = {$enderecos['ID']} callback='Home' callback_action='consulta_modal' status='{$enderecos['STATUS']}' onclick='abreModal(this);'><span><b>{$enderecos['ENDERECO']}</b></span></a></li></ul>".
                                        "</div>";
            endforeach;
        endif;

            //CARREGAMENTO DEFAULT OU FILTRO POR MÊS E ANO STATUS 5
           $Read->FullRead("SELECT DISTINCT [80_Orcamentos].DATA_SISTEMA, [80_Enderecos].LOGRADOURO +', 
' +[80_Enderecos].NUMERO+', ' +[80_Enderecos].COMPLEMENTO+'-' + [80_Enderecos].BAIRRO+', ' +[80_Enderecos].CIDADE+', ' +[80_Enderecos].UF AS ENDERECO, [80_Orcamentos].ID, 
[80_Orcamentos].STATUS FROM [80_Orcamentos] 
INNER JOIN [80_ClientesParticulares] ON [80_Orcamentos].IDCLIENTE = [80_ClientesParticulares].ID 
INNER JOIN [80_Enderecos] ON [80_Orcamentos].IDENDERECO = [80_Enderecos].ID 
INNER JOIN [80_Chamados] ON [80_Chamados].IDORCAMENTO = [80_Orcamentos].ID WHERE ([80_Orcamentos].STATUS = 5) 
AND [80_ClientesParticulares].TIPO = 2 ". $criterioEndereco . $criterioCliente . $criterioMesFiltro . $criterioAnoFiltro .""); 
        //var_dump($Read);
        if ($Read->getResult()):

            $jSON['addcoluna5'] = null;//É necessário desclarar como numo por causa da fraca tipação
            foreach ($Read->getResult() as $enderecos):
                $jSON['trigger'] = true;
                $jSON['addcoluna5'] .= "<div class='box_content buttons_clientes clientes_sem_contato' style='text-transform: uppercase;>".
                                            "<a href='#'><div class='panel_header' style='padding: 0px;border: none;'>".
                                            "<span  style='color: #bdbdbd;'></span>".
                                            "</div></a>".
                                            "<ul><li class='endereco_txt'><a class='link' href='#ex1' rel='modal:open' id = {$enderecos['ID']} callback='Home' callback_action='consulta_modal' status='{$enderecos['STATUS']}' onclick='abreModal(this);'><span><b>{$enderecos['ENDERECO']}</b></span></a></li></ul>".
                                        "</div>";
            endforeach;
        endif;

        //CARREGAMENTO DEFAULT OU FILTRO POR MÊS E ANO STATUS 6
           $Read->FullRead("SELECT DISTINCT [80_Orcamentos].DATA_SISTEMA, [80_Enderecos].LOGRADOURO +', 
' +[80_Enderecos].NUMERO+', ' +[80_Enderecos].COMPLEMENTO+'-' + [80_Enderecos].BAIRRO+', ' +[80_Enderecos].CIDADE+', ' +[80_Enderecos].UF AS ENDERECO, [80_Orcamentos].ID, [80_Orcamentos].STATUS FROM [80_Orcamentos] INNER JOIN [80_ClientesParticulares] ON [80_Orcamentos].IDCLIENTE = [80_ClientesParticulares].ID INNER JOIN [80_Enderecos] ON [80_Orcamentos].IDENDERECO = [80_Enderecos].ID 
INNER JOIN [80_Chamados] ON [80_Chamados].IDORCAMENTO = [80_Orcamentos].ID WHERE ([80_Orcamentos].STATUS = 6) 
AND [80_ClientesParticulares].TIPO = 2 ". $criterioEndereco . $criterioCliente . $criterioMesFiltro . $criterioAnoFiltro .""); 
       
        if ($Read->getResult()):

            $jSON['addcoluna6'] = null;//É necessário desclarar como numo por causa da fraca tipação
            foreach ($Read->getResult() as $enderecos):
                $jSON['trigger'] = true;

                $jSON['addcoluna6'] .= "<div class='box_content buttons_clientes clientes_sem_contato' style='text-transform: uppercase;>".
                                        "<a href='#'><div class='panel_header' style='padding: 0px;border: none;'>".
                                        "<span  style='color: #bdbdbd;'></span>".
                                        "</div></a>".
                                        "<ul><li class='endereco_txt'><a class='link' href='#ex1' rel='modal:open' id = {$enderecos['ID']} callback='Home' callback_action='consulta_modal' status='{$enderecos['STATUS']}' onclick='abreModal(this);'><span><b>{$enderecos['ENDERECO']}</b></span></a></li></ul>".
                                    "</div>";
            endforeach;
        endif;

         //CARREGAMENTO DEFAULT OU FILTRO POR MÊS E ANO STATUS 7
        $Read->FullRead("SELECT DISTINCT [80_Orcamentos].DATA_SISTEMA, [80_Enderecos].LOGRADOURO +', 
' +[80_Enderecos].NUMERO+', ' +[80_Enderecos].COMPLEMENTO+'-' + [80_Enderecos].BAIRRO+', ' +[80_Enderecos].CIDADE+', ' +[80_Enderecos].UF AS ENDERECO, [80_Orcamentos].ID, [80_Orcamentos].STATUS FROM [80_Orcamentos] INNER JOIN [80_ClientesParticulares] ON [80_Orcamentos].IDCLIENTE = [80_ClientesParticulares].ID 
INNER JOIN [80_Enderecos] ON [80_Orcamentos].IDENDERECO = [80_Enderecos].ID 
INNER JOIN [80_Chamados] ON [80_Chamados].IDORCAMENTO = [80_Orcamentos].ID WHERE ([80_Orcamentos].STATUS = 7) 
AND [80_ClientesParticulares].TIPO = 2 ". $criterioEndereco . $criterioCliente . $criterioMesFiltro . $criterioAnoFiltro .""); 
        if ($Read->getResult()):

            $jSON['addcoluna7'] = null;//É necessário desclarar como numo por causa da fraca tipação
            foreach ($Read->getResult() as $enderecos):
                $jSON['trigger'] = true;
                $jSON['addcoluna7'] .= "<div class='box_content buttons_clientes clientes_sem_contato' style='text-transform: uppercase;>".
                                            "<a href='#'><div class='panel_header' style='padding: 0px;border: none;'>".
                                            "<span  style='color: #bdbdbd;'></span>".
                                            "</div></a>".
                                            "<ul><li class='endereco_txt'><a class='link' href='#ex1' rel='modal:open' id = {$enderecos['ID']} callback='Home' callback_action='consulta_modal' status='{$enderecos['STATUS']}' onclick='abreModal(this);'><span><b>{$enderecos['ENDERECO']}</b></span></a></li></ul>".
                                        "</div>";
            endforeach;
        endif;


        //PREENCHER TOTAL EM ANÁLISE
        $jSON['addEmAnalise'] = NULL;
        $Read->FullRead("SELECT SUM([80_Orcamentos].VALOR) AS VALOR FROM [80_Orcamentos]
                        INNER JOIN [80_ClientesParticulares] ON [80_Orcamentos].IDCLIENTE = [80_ClientesParticulares].ID
                        INNER JOIN [80_Enderecos] ON [80_Orcamentos].IDENDERECO = [80_Enderecos].ID  WHERE [80_Orcamentos].STATUS = 2 "  . $criterioEndereco . $criterioCliente . 
                        "AND [80_ClientesParticulares].TIPO = 2","");
        foreach ($Read->getResult() as $totais):
            $totais['VALOR'] = number_format(!$totais['VALOR']?0:$totais['VALOR'],2,',','.');
            $jSON['trigger'] = true;
            $jSON['addEmAnalise'] = "<h2 class='js_h2_emAnalise'><a href='#'  onclick='ordenarOrcamentoAnalise();'><i id='j_ordemEmAnalise' ordemAnalise='". $valueOrdem . "' class='icon-sort-numberic-desc' style='font-size: 15px;float: right;color: white;'></i></a>Em Análise <p style='color: white;padding-right: 15px;'>(R$){$totais['VALOR']}</p><br></h2>";
        endforeach;


        //PREENCHER TOTAL EXECUTANDO
        $jSON['addExecutando'] = NULL;
        $Read->FullRead("SELECT SUM(VALOR) AS VALOR FROM( SELECT MAX([80_Chamados].DATAAGENDADA) AS DATAAGENDADA, [80_Orcamentos].ID, [80_Orcamentos].VALOR FROM [80_Orcamentos] 
INNER JOIN [80_Enderecos] ON [80_Orcamentos].IDENDERECO = [80_Enderecos].ID 
INNER JOIN [80_ClientesParticulares] ON [80_Orcamentos].IDCLIENTE = [80_ClientesParticulares].ID 
LEFT JOIN [80_Chamados] ON [80_Orcamentos].ID = [80_Chamados].IDORCAMENTO WHERE [80_Orcamentos].STATUS = 4 "  . $criterioEndereco . $criterioCliente . $criterioMes . "AND [80_ClientesParticulares].TIPO = 2 GROUP BY  [80_Orcamentos].ID, [80_Orcamentos].VALOR)A","");

        foreach ($Read->getResult() as $totais):
            $totais['VALOR'] = $totais['VALOR'] ? $totais['VALOR'] : 0;
            $totais['VALOR'] = number_format($totais['VALOR'],2,',','.');
            $jSON['trigger'] = true;
            $jSON['addExecutando'] = "<h2 class='js_h2_executando'><a href='#'  onclick='ordenarOrcamentoExecutando();'><i id='j_ordemExecutando' ordemExecutando='". $valueOrdemExecutando . "' class='icon-sort-numberic-desc' style='font-size: 15px;float: right;color: white;'></i></a>Serviço Agendado <p style='color: white;padding-right: 15px;'>(R$){$totais['VALOR']}</p><br></h2>";
        endforeach;


        //PREENCHER TOTAL EXECUTADO FILTRO MÊS E ANO
        $jSON['addExecutado'] = NULL;
        $Read->FullRead("SELECT SUM(VALOR) AS VALOR FROM( SELECT MAX([80_Chamados].DATAAGENDADA) AS DATAAGENDADA, [80_Orcamentos].ID, [80_Orcamentos].VALOR FROM [80_Orcamentos] 
INNER JOIN [80_Enderecos] ON [80_Orcamentos].IDENDERECO = [80_Enderecos].ID 
INNER JOIN [80_ClientesParticulares] ON [80_Orcamentos].IDCLIENTE = [80_ClientesParticulares].ID 
LEFT JOIN [80_Chamados] ON [80_Orcamentos].ID = [80_Chamados].IDORCAMENTO WHERE [80_Orcamentos].STATUS = 5 "  . $criterioEndereco . $criterioCliente . $criterioAno . $criterioMes . "AND [80_ClientesParticulares].TIPO = 2 GROUP BY  [80_Orcamentos].ID, [80_Orcamentos].VALOR)A","");

        foreach ($Read->getResult() as $totais):        
            $totais['VALOR'] = number_format(!$totais['VALOR']?0:$totais['VALOR'],2,',','.');
            $jSON['trigger'] = true;
            $jSON['addExecutado'] = "<h2 class='js_h2_executado'><a href='#'><i class='' id='j_ordemExecutado' ordemExecutado='data' callback='Home' callback_action='consulta' style='font-size: 15px;float: right;color: white;'></i></a>Executado <p style='color: white;'>(R$){$totais['VALOR']}</p></h2>";
        endforeach;

        //PREENCHER TOTAL CANCELADO FILTRO MÊS E ANO
        $jSON['addCancelado'] = NULL;
        $Read->FullRead("SELECT SUM(VALOR) AS VALOR FROM( SELECT MAX([80_Chamados].DATA_SISTEMA) AS DATASISTEMA, [80_Orcamentos].ID, [80_Orcamentos].VALOR FROM [80_Orcamentos] 
INNER JOIN [80_Enderecos] ON [80_Orcamentos].IDENDERECO = [80_Enderecos].ID 
INNER JOIN [80_ClientesParticulares] ON [80_Orcamentos].IDCLIENTE = [80_ClientesParticulares].ID 
LEFT JOIN [80_Chamados] ON [80_Orcamentos].ID = [80_Chamados].IDORCAMENTO WHERE [80_Orcamentos].STATUS = 6 "  . $criterioEndereco . $criterioCliente . $criterioAnoCanc . $criterioMesCanc. "AND [80_ClientesParticulares].TIPO = 2 GROUP BY  [80_Orcamentos].ID, [80_Orcamentos].VALOR)A","");
        foreach ($Read->getResult() as $totais):
            $totais['VALOR'] = $totais['VALOR'] ? $totais['VALOR'] : 0;
            $totais['VALOR'] = number_format(!$totais['VALOR']?0:$totais['VALOR'],2,',','.');
            $jSON['trigger'] = true;
            $jSON['addCancelado'] = "<h2 class='js_h2_cancelado'><a href='#'><i class='' id='j_ordemCancelado' ordemCancelado='data' callback='Home' callback_action='consulta' style='font-size: 15px;float: right;color: white;'></i></a>Cancelado <p style='color: white;'>(R$){$totais['VALOR']}</p></h2>";
        endforeach;

        //PREENCHER TOTAL RECUSADO FILTRO ENDEREÇO E CLIENTE
        $jSON['addRecusado'] = NULL;
        $Read->FullRead("SELECT SUM(VALOR) AS VALOR FROM( SELECT MAX([80_Chamados].DATAAGENDADA) AS DATAAGENDADA, [80_Orcamentos].ID, [80_Orcamentos].VALOR FROM [80_Orcamentos] 
INNER JOIN [80_Enderecos] ON [80_Orcamentos].IDENDERECO = [80_Enderecos].ID 
INNER JOIN [80_ClientesParticulares] ON [80_Orcamentos].IDCLIENTE = [80_ClientesParticulares].ID 
LEFT JOIN [80_Chamados] ON [80_Orcamentos].ID = [80_Chamados].IDORCAMENTO WHERE [80_Orcamentos].STATUS = 7 "  . $criterioEndereco . $criterioCliente . $criterioAno . $criterioMes . "AND [80_ClientesParticulares].TIPO = 2 GROUP BY  [80_Orcamentos].ID, [80_Orcamentos].VALOR)A","");
        foreach ($Read->getResult() as $totais):        
            $totais['VALOR'] = number_format(!$totais['VALOR']?0:$totais['VALOR'],2,',','.');
            $jSON['trigger'] = true;
            $jSON['addRecusado'] = "<h2 class='js_h2_recusado'><a href='#'><i class='' id='j_ordemrecusado' ordemRecusado='data' callback='Home' callback_action='consulta' style='font-size: 15px;float: right;color: white;'></i></a>Recusado <p style='color: white;'>(R$){$totais['VALOR']}</p></h2>";
        endforeach;


        if ($consulta_inicial == 0) {
            //PREENCHER COMBO DE ENREDEÇO
            $jSON['addComboEndereco'] = null;
            $Read->FullRead("SELECT [80_Enderecos].ID, [80_Enderecos].LOGRADOURO + ', ' + [80_Enderecos].NUMERO + ', ' + [80_Enderecos].COMPLEMENTO + ' - ' + [80_Enderecos].BAIRRO + ',' +
                            [80_Enderecos].CIDADE + ',' + [80_Enderecos].UF AS ENDERECO FROM [80_Enderecos]
                            INNER JOIN [80_ClientesParticulares] ON [80_Enderecos].IDCLIENTE = [80_ClientesParticulares].ID
                            WHERE [80_ClientesParticulares].TIPO = 2 ORDER BY [80_Enderecos].LOGRADOURO ASC","");
            foreach ($Read->getResult() as $enderecos):
                $jSON['trigger'] = true;
                $jSON['addComboEndereco'] .= "{$enderecos['ID']} ".trim($enderecos['ENDERECO'])."*";
            endforeach;

            //PREENCHER COMBO DE CLIENTE
            $jSON['addComboCliente'] = null;
            $Read->FullRead("SELECT ID,NOME FROM [80_ClientesParticulares] WHERE TIPO = 2 ORDER BY NOME ASC","");
            foreach ($Read->getResult() as $clientes):
               
                $jSON['trigger'] = true;
                $jSON['addComboCliente'] .= "{$clientes['ID']} ".trim($clientes['NOME'])."*";
            endforeach;            
            
        }
        break;

        case 'consulta_modal':
            //Preenchendo modal
            $TIPO = getWcTipoServico();
            $idOrcamento = $PostData['idOrcamento'];
            $Read->FullRead("SELECT UPPER([80_ClientesParticulares].NOME) AS NOME, [80_ClientesParticulares].EMAIL, [80_ClientesParticulares].TELEFONE,[80_ClientesParticulares].TELEFONE2, [80_Enderecos].LOGRADOURO + ', ' + [80_Enderecos].NUMERO + ', ' + [80_Enderecos].COMPLEMENTO + ' - ' + [80_Enderecos].BAIRRO + ',' +
                [80_Enderecos].CIDADE + ',' + [80_Enderecos].UF AS ENDERECO, [80_Orcamentos].ID, [80_Orcamentos].STATUS,[80_Orcamentos].OBS,[80_Orcamentos].TIPOSERVICO FROM [80_Orcamentos]
                INNER JOIN [80_ClientesParticulares] ON [80_Orcamentos].IDCLIENTE = [80_ClientesParticulares].ID
                INNER JOIN [80_Enderecos] ON [80_Orcamentos].IDENDERECO = [80_Enderecos].ID WHERE [80_Orcamentos].ID = " . $idOrcamento,"");
            
            if ($Read->getResult()):                
                $jSON['addClienteModal'] = null;//É necessário declarar como numo por causa da fraca tipação
                $jSON['statusOrcamento'] = null;
                foreach ($Read->getResult() as $dadosModalCliente):
                    
                    extract($dadosModalCliente);

                    //SÓ EXIBE ESSA ESTRUTURA SE O TELEFONE EXISTIR NO BANCO
                    $Tel1 = isset($TELEFONE) && $TELEFONE != null ? "<b>1º Tel:</b> <a href='tel:021980564678' style='color: #004491'>{$TELEFONE}</a> " : "";
                    $Tel2 = isset($TELEFONE2) && $TELEFONE2 != null ? "/ <b>2º Tel:</b> <a href='tel:021980564678' style='color: #004491'>{$TELEFONE2}</a> " : "";

                    $jSON['addClienteModal'] .= "<div class='dados_clientes'>".
                                             "<h5>{$NOME}</h5>".
                                             "<ul class='cl_dados' id='{$ID}'>".
                                               "<li style='padding-bottom: 0px;' class='dados_endereco'>{$EMAIL}<span class='m_endereco'></span></li>".
                                               "<li  style='padding-bottom: 0px;'>{$ENDERECO}</li>".
                                               "<li  style='padding-bottom: 0px;'>{$Tel1}{$Tel2}</li>".
                                               "<li  style='padding-bottom: 0px;'>Serviço: {$TIPO[$TIPOSERVICO]}</li>".
                                               "<li  style='padding-bottom: 0px;'>OBS.: ".trim($OBS)."</li>".
                                               "<br>".
                                               "<hr>".
                                             "</div>";  
                

                endforeach;
                $paramStatus = $PostData['status'];
                foreach (getStatusOrcamento($paramStatus) as $key => $value) {
                    //EVITANDO QUE O STATUS EXECUTANDO ENTRE NA LISTA DE STATUS 
                    if ($key != 4) {
                        $jSON['statusOrcamento'] .= "<option value='{$key}'>$value</option>";
                    }                  
                }
            endif;


            //Preenchendo técnicos GNS
            $Read->FullRead("SELECT IIF(FUNC.ID IS NOT NULL, FUNC.ID, TERC.ID) AS ID, IIF(FUNC.ID IS NOT NULL, FUNC.[NOME COMPLETO], TERC.NOME) AS NOME
                FROM [00_NivelAcesso] LEFT JOIN Funcionários FUNC ON [00_NivelAcesso].IDFUNCIONARIO = FUNC.ID
                LEFT JOIN FuncionariosTerceirizados TERC ON [00_NivelAcesso].IDTERCEIRIZADO = TERC.ID
                WHERE [00_NivelAcesso].MOBILE_CLIENTES_PARTICULARES = 1 ORDER BY NOME","");
            if ($Read->getResult()):
                $jSON['addTecnicos'] = null;//É necessário desclarar como numo por causa da fraca tipação
                foreach ($Read->getResult() as $addTecnicos):
                    $jSON['addTecnicos'] .= "<option value = '{$addTecnicos['ID']}'>{$addTecnicos['NOME']}</option>";
                endforeach;
            endif;

            $jSON['addHistorico'] = preencherHistorico($PostData);
                                               

        break;
        case 'salva-edicao':
            $ID = $PostData['ID'];
            //REMOVER PONTO
            $val = str_replace(".","",$PostData['VALOR']);
            //REMOVER VIRGULA
            $valor = str_replace(",",".",$val);
            //CONSULTAR O STATUS DO CHAMADO
            $Read->FullRead("SELECT TIPO_SERVICO FROM [80_Chamados] WHERE ID = {$ID}");
            
            switch ($Read->getResult()[0]['TIPO_SERVICO']) {
                case '0'://sem contato
                    $SalvaEdicaoChamado = array(
                        'OBS' => isset($PostData["OBS"]) ? $PostData['OBS'] : NULL,
                    );
                break;
                
                case '1'://visita agendada
                    $SalvaEdicaoChamado = array(
                        'DATAAGENDADA' => isset($PostData["DATAAGENDAMENTO"]) ? $PostData["DATAAGENDAMENTO"] : NULL ,
                        'TECNICO' => isset($PostData["TECNICO"]) ? $PostData["TECNICO"] : NULL,
                        'VALOR' => isset($valor) ? $valor : NULL,
                        'FORMAPAGAMENTO' => isset($PostData["FORMAPAGAMENTO"]) ? $PostData["FORMAPAGAMENTO"] : NULL,
                        'NUM_PARCELAS' => isset($PostData["QNTPARCELAS"]) ? $PostData["QNTPARCELAS"] : NULL,
                        'OBS' => isset($PostData["OBS"]) ? $PostData['OBS'] : NULL,
                        'USUARIO_SISTEMA' => $_SESSION['userLogin']['ID'],//
                    );
                break;
                case '2'://em análise
                    $SalvaEdicaoChamado = array(
                        'VALOR' => isset($valor) ? $valor : NULL,
                        'FORMAPAGAMENTO' => isset($PostData["FORMAPAGAMENTO"]) ? $PostData["FORMAPAGAMENTO"] : NULL,
                        'NUM_PARCELAS' => isset($PostData["QNTPARCELAS"]) ? $PostData["QNTPARCELAS"] : NULL,
                        'OBS' => isset($PostData["OBS"]) ? $PostData['OBS'] : NULL,
                    );
                break;
                case '3'://serviço agendado
                    $SalvaEdicaoChamado = array(
                        'DATAAGENDADA' => isset($PostData["DATAAGENDAMENTO"]) ? $PostData["DATAAGENDAMENTO"] : NULL ,
                        'TECNICO' => isset($PostData["TECNICO"]) ? $PostData["TECNICO"] : NULL,
                        'OBS' => isset($PostData["OBS"]) ? $PostData['OBS'] : NULL,
                    );
                break;
                case '5'://executado
                    $SalvaEdicaoChamado = array(
                        'DATAAGENDADA' => isset($PostData["DATAAGENDAMENTO"]) ? $PostData["DATAAGENDAMENTO"] : NULL ,
                        'TECNICO' => isset($PostData["TECNICO"]) ? $PostData["TECNICO"] : NULL,
                        'OBS' => isset($PostData["OBS"]) ? $PostData['OBS'] : NULL,
                    );
                 break;
                 case '6'://cancelado
                    $SalvaEdicaoChamado = array(
                        'OBS' => isset($PostData["OBS"]) ? $PostData['OBS'] : NULL,
                    );
                 break;
                 case '7'://recusado
                    $SalvaEdicaoChamado = array(
                        'OBS' => isset($PostData["OBS"]) ? $PostData['OBS'] : NULL,
                    );
                 break;
            }

            $Update->ExeUpdate("[80_Chamados]",$SalvaEdicaoChamado, "WHERE ID = :id", "id={$PostData['ID']}");
            if($Update->getResult()){
                $jSON['trigger'] = AjaxErro('Chamado atualizado com sucesso');
                $jSON['salva_edicao'] = AjaxErro('Chamado atualizado com sucesso');
            }else{
                $jSON['trigger'] = AjaxErro('Erro na edição do chamado');
            }
            
        break;
        case 'salvachamado':
            //Salvando chamado   
            if(isset($PostData["VALOR"])):
                $PostData["VALOR"] = str_replace("." , "" , $PostData["VALOR"]); // Primeiro tira os pontos
                $PostData["VALOR"] = str_replace("," , "." , $PostData["VALOR"]); // Substitui a vírgula pelo ponto
            endif;                    
            $chamado = array(
                'IDORCAMENTO' => $PostData["idOrcamento"],
                'VALOR' => isset($PostData["VALOR"]) ? $PostData["VALOR"] : NULL,
                'USUARIO_SISTEMA' => $_SESSION['userLogin']['ID'],
                'DATAAGENDADA' => isset($PostData["DATAAGENDAMENTO"]) ? $PostData["DATAAGENDAMENTO"] : NULL ,
                'OBS' => $PostData["OBS"],
                'TECNICO' => isset($PostData["TECNICO"]) ? $PostData["TECNICO"] : NULL,
                'TIPO_SERVICO' => $PostData["STATUS"],
                'FORMAPAGAMENTO' => isset($PostData["FORMAPAGAMENTO"]) ? $PostData["FORMAPAGAMENTO"] : NULL,
                'NUM_PARCELAS' => isset($PostData["QNTPARCELAS"]) ? $PostData["QNTPARCELAS"] : NULL
            );


            $Resultado = NULL;
            if(isset($PostData['IDCHAMADO'])):                
                $Update->ExeUpdate("[80_Chamados]", $chamado, "WHERE [80_Chamados].ID = :id", "id={$PostData['IDCHAMADO']}");
                $Resultado = 1;
            else:
                $Create->ExeCreate("[80_Chamados]",$chamado);
                $Resultado = 1;
            endif;

            if ($Resultado == 1) {
                    $orcamento = array(
                    'VALOR' => isset($PostData["VALOR"]) ? $PostData["VALOR"] : NULL,
                    'NUM_PARCELAS' => isset($PostData["QNTPARCELAS"]) ? $PostData["QNTPARCELAS"] : NULL,
                    'STATUS' => $PostData["STATUS"],
                    'FORMAPAGAMENTO' => isset($PostData["FORMAPAGAMENTO"]) ? $PostData["FORMAPAGAMENTO"] : NULL,
                    'DATA_SISTEMA' => $date
                );                

                if (empty($PostData["VALOR"])) {
                    unset($orcamento['VALOR']);
                }

                if (empty($PostData["QNTPARCELAS"])) {
                    unset($orcamento['NUM_PARCELAS']);
                }

                if (empty($PostData["FORMAPAGAMENTO"])) {
                    unset($orcamento['FORMAPAGAMENTO']);
                }

                $Update->ExeUpdate('[80_Orcamentos]', $orcamento, "WHERE ID = :ID", "ID={$PostData['idOrcamento']}");
                if ($Update->getResult()) {
                    $jSON['inpuval']='null';
                    $jSON['trigger'] = AjaxErro('Cadastro realizado');
                    $jSON['addHistorico'] = preencherHistorico($PostData);
                }else{
                    $jSON['trigger'] = AjaxErro('Erro ao cadastrar!');
                }
            }else{
                $jSON['trigger'] = AjaxErro('Erro ao cadastrar!');
            }

        break;
        case 'editar':
            //Salvando chamado
            $Read->FullRead("SELECT ID, CONVERT(NVARCHAR,DATAAGENDADA,103) AS DATAAGENDADA, OBS, TECNICO, VALOR, FORMAPAGAMENTO, NUM_PARCELAS, TIPO_SERVICO FROM [80_Chamados] WHERE ID = :id","id={$PostData['ID']}");
            if($Read->getResult()):
                $jSON['editaChamado'] = $Read->getResult()[0];
                $jSON['addIdChamado'] = "<input type='hidden' name='IDCHAMADO' value='{$Read->getResult()[0]['ID']}'/>";
            else:
                $jSON['trigger'] = AjaxErro('Chamado não foi encontrado!', E_USER_ERROR);
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


function preencherHistorico($PostData){
    //Preenchendo histórico de chamados
    $Read = new Read;
    $idCliente = $PostData['idOrcamento'];
    $historico = "";
    $primeiro = false;
    $classe = 'buttons_chamados';
    $status = 'Aberto';
    
    $Read->FullRead("SELECT [80_Chamados].ID, [80_Chamados].OBS, CONVERT(VARCHAR,[80_Chamados].DATA_SISTEMA,103) + ' ' + CONVERT(VARCHAR,[80_Chamados].DATA_SISTEMA,108) AS DATA, Funcionários.[NOME COMPLETO],   
                    [80_Chamados].TIPO_SERVICO, CONVERT(VARCHAR,[80_Chamados].DATAAGENDADA,103) AS DATAAGENDADA, [80_Chamados].VALOR, [80_Chamados].NUM_PARCELAS FROM [80_Orcamentos]
                    INNER JOIN [80_Chamados] ON [80_Orcamentos].ID = [80_Chamados].IDORCAMENTO
                    INNER JOIN Funcionários ON [80_Chamados].USUARIO_SISTEMA = Funcionários.ID
                    WHERE [80_Orcamentos].ID = " . $idCliente . " ORDER BY [80_Chamados].DATA_SISTEMA DESC","");


    $btEditar = $Read->getResult() ? "<span rel='{$Read->getResult()[0]['ID']}' callback='Home' callback_action='editar' class='icon-pencil btn btn_blue' id='j_edit_chamado'>Editar Chamado</span>" : "";
    if ($Read->getResult()):
        $obs = null;
        $jSON['addHistorico'] = null;//É necessário desclarar como numo por causa da fraca tipação
        foreach ($Read->getResult() as $addHistorico):
            $obs = $addHistorico['OBS'];
            $valor = number_format($addHistorico['VALOR'] == "" || $addHistorico['VALOR'] == NULL ? 0 : $addHistorico['VALOR'],2,',','.');
            $tipoServico = getStatusOrcamento()[$addHistorico['TIPO_SERVICO']];
            $historico .= "<div class='box_content buttons_chamados {$classe}' style='height: auto;''>
                            <ul>
                              <div class='box box50' style='padding-bottom: 0px;'>
                                <li style='padding-bottom: 5px;'><h3><b><i class='icon-history'></i>&ensp;{$tipoServico}</b></h3></li>
                                <li style='padding-bottom: 5px;font-size: 12px;'>Data de Agendamento: {$addHistorico['DATAAGENDADA']}</li>
                                <li style='padding-bottom: 5px;font-size: 12px;'>Valor: R$ {$valor}</li>
                                <li style='padding-bottom: 5px;font-size: 12px;'>Parcelas: {$addHistorico['NUM_PARCELAS']}</li>
                              </div>
                              <div class='box box50' style='padding-bottom: 0px;text-align: right;'>
                                <li style='padding-bottom: 5px;font-size: 12px;'>Status: {$status}</li>
                                <li style='padding-bottom: 5px;font-size: 11px;color: gray;'>Usuário: {$addHistorico['NOME COMPLETO']}</li>
                                <li style='padding-bottom: 5px;font-size: 11px;color: gray;'>Registrado em: {$addHistorico['DATA']}</li>
                                <li style='padding-bottom: 5px;font-size: 11px;color: gray;'>{$btEditar}</li>
                              </div>
                              <div class='box box100' style='padding-top: 0px;'>
                                <li style='padding-bottom: 5px;font-size: 12px;'>OBS.:".$obs."</li>
                              </div>
                            </ul>
                          </div>";
            $classe = 'buttons_chamados_block';
            $status = 'Fechado';
            $btEditar = "";
        endforeach;
    endif;

    return $historico;
}


function getCor($id){
    $Read = new Read;
    $Read->FullRead("SELECT [80_Chamados].DATAAGENDADA AS DATAAGENDADA FROM [80_Chamados] INNER JOIN [80_Orcamentos]
                    ON [80_Chamados].IDORCAMENTO = [80_Orcamentos].ID WHERE [80_Orcamentos].ID = :id AND [80_Chamados].TIPO_SERVICO = 1 ORDER BY [80_Chamados].ID DESC","id={$id}");

    if($Read->getResult()){
        $Result = $Read->getResult();
        $data = new DateTime($Result[0]["DATAAGENDADA"]);
        $dataAtual = new DateTime();

        if ($data<=$dataAtual) {
            return 'buttons_clientes_vermelho';
        }elseif ($data->format('d/m/Y')==$dataAtual->modify('+1 day')->format('d/m/Y')) {
            return 'buttons_clientes_amarelo';
        }else{
            return 'buttons_clientes_verde';
        }
    }
}

function before ($tag, $inthat)
{
    echo substr($inthat, 0, strpos($inthat, $tag));
};


?>
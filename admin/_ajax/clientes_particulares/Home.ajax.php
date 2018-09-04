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

        $criterioEndereco = $PostData['endereco'] != "t" ? " AND endereco = " . $PostData['endereco'] : "";
        $ctiterioCliente = $PostData['cliente'] != "t" ? " AND cliente = " . $PostData['cliente'] : "";

        $Read->FullRead("SELECT [80_Enderecos].LOGRADOURO + ', ' + [80_Enderecos].NUMERO + ' - ' + [80_Enderecos].BAIRRO + ',' +
                      [80_Enderecos].CIDADE + ',' + [80_Enderecos].UF AS ENDERECO FROM [80_Orcamentos]
                      INNER JOIN [80_ClientesParticulares] ON [80_Orcamentos].IDCLIENTE = [80_ClientesParticulares].ID
                      INNER JOIN [80_Enderecos] ON [80_ClientesParticulares].ID = [80_Enderecos].IDCLIENTE
                      WHERE [80_Orcamentos].STATUS = 0 
                      ORDER BY [80_Orcamentos].DATASOLICITACAO","");
        if ($Read->getResult()):
        	$jSON['addcoluna1'] = null;//É necessário desclarar como numo por causa da fraca tipação
        	foreach ($Read->getResult() as $enderecos):
        		$jSON['trigger'] = true;
        		$jSON['addcoluna1'] .= "<div class='box_content buttons_clientes clientes_sem_contato'>
							        		<a href='#'><div class='panel_header' style='padding: 0px;border: none;'>
							        		<span  style='color: #bdbdbd;'></span>
							        		</div></a>
							        		<ul><li class='endereco_txt'><a class='link' href='.chamados' rel='modal'><span><b>{$enderecos['ENDERECO']}</b></span></a></li></ul>
						        		</div>";
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
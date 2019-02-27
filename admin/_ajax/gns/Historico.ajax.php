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
$CallBack = 'Historico';
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
    if (empty($Create)):
        $Create = new Create;
    endif;
    if (empty($Upload)):
        $Upload = new Upload('../../../uploads/');
    endif;

    //SELECIONA AÇÃO
    switch ($Case):        
        case 'Carregar':
        $jSON['historico'] = null;
        $jSON['selectClientes'] = null;

        $where = $PostData['nomeCliente'] != '' ? " AND [60_Clientes].NomeCliente LIKE '%{$PostData['nomeCliente']}%'" : "";
        $where .= $PostData['dataCliente'] != '' ? " AND FORMAT( [60_OS].DataAgendamento, 'dd/MM/yyyy', 'pt-BR' ) = '{$PostData['dataCliente']}'" : "";
        $where .= $PostData['numCliente'] != '' ? " AND [60_Clientes].NumCliente = {$PostData['numCliente']}" : "";
        $where .= $PostData['enderecoCliente'] != '' ? " AND [60_OS].Endereco LIKE '%{$PostData['enderecoCliente']}%'" : "";
        $where .= $PostData['bairroCliente'] != '' ? " AND [60_OS].Bairro LIKE '%{$PostData['bairroCliente']}%'" : "";
        $where .= $PostData['municipioCliente'] != '' ? " AND [60_OS].Municipio LIKE '%{$PostData['municipioCliente']}%'" : "";
        $where .= $PostData['cepCliente'] != '' ? " AND [60_OS].Cep = '{$PostData['cepCliente']}'" : "";
        $where .= $PostData['cpfCliente'] != '' ? " AND [60_Clientes].CPFCNPJ = '{$PostData['cpfCliente']}'" : "";
        $where .= $PostData['statusAtend'] != 't' ? " AND [60_OS].Status = '{$PostData['statusAtend']}'" : "";
        $where = substr($where, 5);
        $where = $where ? " WHERE " . $where : "";

        //Carrega e retorna os dados da tabela
        
        $Read->FullRead("SELECT DISTINCT [60_Clientes].Id, [60_Clientes].NumCliente, [60_Clientes].NomeCliente, [60_Clientes].Telefone1, [60_Clientes].Telefone2, [60_Clientes].Telefone3, 
                        [60_OS].Endereco, [60_OS].Bairro, [60_OS].Municipio, [60_OS].Cep, [60_OS].Zona, [60_OS].Subzona, [60_Clientes].CPFCNPJ, [60_Clientes].EmailGns,
                        [60_Siebel].TelefoneZeus FROM [60_Clientes]
                        INNER JOIN [60_OT] ON [60_OT].Cliente = [60_Clientes].Id
                        INNER JOIN [60_OS] ON [60_OS].OT = [60_OT].Id
                        INNER JOIN [60_Siebel] ON [60_Siebel].NumeroCliente = [60_Clientes].NumCliente {$where} ORDER BY NomeCliente"," ");

            if ($Read->getResult()):
                foreach ($Read->getResult() as $historico):
                     $historico_NumCliente = str_replace(".0", "", $historico['NumCliente']);
                    $jSON['historico'] .= "<tr role='row' class='odd pointer j_table' value='{$historico['Id']}' callback='Historico' callback_action='CarregarHistorico'>".
                                                 //<td style='text-align: center;'>{$historico['Status']}</td>
                                                 "<td style='text-align: center;'>{$historico_NumCliente}</td>
                                                 <td>{$historico['NomeCliente']}</td>
                                                 <td style='text-align: center;'><a href='tel:0{$historico['Telefone1']}'>{$historico['Telefone1']}</a></td>
                                                 <td style='text-align: center;'><a href='tel:0{$historico['Telefone2']}'>{$historico['Telefone2']}</a></td>
                                                 <td style='text-align: center;'><a href='tel:0{$historico['Telefone3']}'>{$historico['Telefone3']}</a></td>
                                                 <td style='text-align: center;'><a href='tel:0{$historico['TelefoneZeus']}'>{$historico['TelefoneZeus']}</a></td>
                                                 <td>{$historico['Endereco']}</td>
                                                 <td style='text-align: center;'>{$historico['Bairro']}</td>
                                                 <td style='text-align: center;'>{$historico['Municipio']}</td>
                                                 <td style='text-align: center;'>{$historico['Cep']}</td>
                                                 <td style='text-align: center;'>{$historico['Zona']}</td>
                                                 <td style='text-align: center;'>{$historico['Subzona']}</td>
                                                 <td style='text-align: center;'>{$historico['CPFCNPJ']}</td>
                                                 <td style='text-align: center;'><a href='mailto:{$historico['EmailGns']}'>{$historico['EmailGns']}</a></td>
                                           </tr>";
                endforeach;    
            else:
                $jSON['historico'] = null;
            endif;
        break;

        //CARREGA O HISTÓRICO DE OS's NA LATERAL DIREITA DA PÁGINA
	    case 'CarregarHistorico':
            $jSON['dadosCli'] = null;
            $jSON['historicoOs'] = null;
            
            $Read->FullRead("SELECT Id AS id_OT, NumOT FROM [60_OT] WHERE Cliente = {$PostData['idCliente']}","");            
            if($Read->getResult())
            {
                $id_OT = $Read->getResult()[0]['id_OT'];
            }
            
            foreach ($Read->getResult() as $dataOT)
            {
                extract($dataOT);
                $id_ot = $dataOT['id_OT'];
                $num_ot = $dataOT['NumOT'];

                $jSON['historicoOs'] .= "<div class='box box100' style='padding-bottom: 0px;'>
                                      <li style='padding-bottom: 5px;'><h3 style='text-align: center;'><b>OT: &ensp;{$dataOT['NumOT']}</b></h3></li>
                                      </div>";
           
                $Read->FullRead("SELECT [60_Clientes].Id AS IdDoCliente,NomeOs,[60_OS].Id AS IDOS, NumOS, [60_OS].Status,[60_OS].Latitude,[60_OS].Longitude, Valorcobrar, 'VERIFICAR' AS Atualizadopor, 
                        CASE WHEN FUNC.ID IS NOT NULL THEN FUNC.[NOME COMPLETO] ELSE TERC.NOME END AS Tecnico, 
                        CONVERT(NVARCHAR,Atualizadoem,103) AS ATUALIZADO_EM,[60_Atendimentos].Obs , [00_NivelAcesso].ID AS TecnicoId, [60_OT].Id AS IdOT FROM [60_OS]
                        INNER JOIN [60_OT] ON [60_OS].OT = [60_OT].Id 
                        INNER JOIN [60_Clientes] ON [60_OT].Cliente = [60_Clientes].Id 
                        LEFT JOIN [60_Atendimentos] ON [60_OS].Id = [60_Atendimentos].IdOS
                        LEFT JOIN [00_NivelAcesso] ON [60_OS].Tecnico = [00_NivelAcesso].ID
                        LEFT JOIN  Funcionários FUNC ON [00_NivelAcesso].IDFUNCIONARIO = FUNC.ID
                        LEFT JOIN  FuncionariosTerceirizados TERC ON [00_NivelAcesso].IDTERCEIRIZADO = TERC.ID WHERE [60_Clientes].Id = {$PostData['idCliente']} AND [60_OT].Id = {$id_OT} ORDER BY Atualizadoem DESC","");

                if ($Read->getResult()){

                
                    $Idos = $Read->getResult()[0]['IDOS'];
                            
                    foreach ($Read->getResult() as $Oss)
                    {
                                extract($Oss);
                            	$valor = number_format($Oss['Valorcobrar'],2,',','.');
                            	$status = getStatusOs($Oss['Status']);
                                $tecnico = $Oss['Tecnico'] ? $Oss['Tecnico'] : 'Não Associado';
                                $tecnicoId = $Oss['TecnicoId'];
                                $IdCliente = $Oss['IdDoCliente'];
                                $IdOS = $Oss['IDOS'];
                                $Longitude = $Oss['Longitude'];
                                $Latitude = $Oss['Latitude'];
                                $finalizaOs = $Oss['TecnicoId'] != 0 && $Oss['Status'] == 0? "<a style='color:#fff;text-decoration-line:none !important;' href='dashboard.php?wc=gns/formulario&IdOS={$IdOS}&IdTecnico={$tecnicoId}&IdDoCliente={$IdCliente}&Longitude={$Longitude}&Latitude={$Latitude}''><span class='btn btn_darkblue finalizar-OS' style='height:35px;'>Finalizar OS</span></a>" : '';
                                $atualizadopor = $Oss['Atualizadopor'] ? $Oss['Atualizadopor'] : 'Não Associado';

                                    //$fotos .= "<li style='padding-bottom: 5px;font-size: 12px;'><img src='{$end}'/></li>"
                                $imgs = NULL;
                                $imgs2 = NULL;
                                $imgs3 = NULL;
                                $imgs4 = NULL;
                                $imgs5 = NULL;
                                $imgs6 = NULL;
                                $imgs7 = NULL;
                                $Read->FullRead("SELECT [60_OS_Fotos].Arquivo AS Foto,[60_OS_Fotos].Tipo FROM [BDNVT].[dbo].[60_OS_Fotos] WHERE [60_OS_Fotos].OS =:id ","id={$IdOS}");

                                if($Read->getResult()){
                                    foreach ($Read->getResult() as $img) {

                                        extract($Read->getResult());

                                        switch ($img['Tipo']) 
                                        {
                                            case '1':
                                                $imgs .= "<div style='width:15%;display:inline-block'><a href='http://192.168.0.101:83/novatec/uploads/{$img['Foto']}' rel='shadowbox[1]'>
                                            <img class='img'  src='http://192.168.0.101:83/novatec/uploads/{$img['Foto']}'/>
                                            </a></div>";
                                            break;
                                            
                                            case '2':
                                                $imgs2 .= "
                                            <div style='width:15%;display:inline-block'><a href='http://192.168.0.101:83/novatec/uploads/{$img['Foto']}' rel='shadowbox[2]'>
                                            <img class='img'  src='http://192.168.0.101:83/novatec/uploads/{$img['Foto']}'/></a></div>";
                                            break;

                                            case '3':
                                            $imgs3 .= "
                                            <div style='width:15%;display:inline-block'><a href='http://192.168.0.101:83/novatec/uploads/{$img['Foto']}' rel='shadowbox[3]'>
                                            <img class='img'  src='http://192.168.0.101:83/novatec/uploads/{$img['Foto']}'/></a></div>";
                                            break;

                                            case '4':
                                            $imgs4 .= "
                                            <div style='width:15%;display:inline-block'><a href='http://192.168.0.101:83/novatec/uploads/{$img['Foto']}' rel='shadowbox[4]'>
                                            <img class='img'  src='http://192.168.0.101:83/novatec/uploads/{$img['Foto']}'/></a></div>";
                                            break;

                                            case '5':
                                            $imgs5 .= "
                                            <div style='width:15%;display:inline-block'><a href='http://192.168.0.101:83/novatec/uploads/{$img['Foto']}' rel='shadowbox[5]'>
                                            <img class='img'  src='http://192.168.0.101:83/novatec/uploads/{$img['Foto']}'/></a></div>";
                                            break;

                                            case '6':
                                            $imgs6 .= "
                                            <div style='width:15%;display:inline-block'><a href='http://192.168.0.101:83/novatec/uploads/{$img['Foto']}' rel='shadowbox[6]'>
                                            <img class='img'  src='http://192.168.0.101:83/novatec/uploads/{$img['Foto']}'/></a></div>";
                                            break;

                                            case '7':
                                            $imgs7 .= "
                                            <div style='width:15%;display:inline-block'><a href='http://192.168.0.101:83/novatec/uploads/{$img['Foto']}' rel='shadowbox[7]'>
                                            <img class='img'  src='http://192.168.0.101:83/novatec/uploads/{$img['Foto']}'/></a></div>";
                                            break;
                                        }
                                        
                                    }
                                    
                                }

                                //SÓ EXIBE O TÍTULO E IMAGEM EM HISTÓRICO DE CLIENTE SE FOR DIFERENTE DE NULO
                                $imgs  != null ?  $i1 = "block" : $i1 = "none";
                                $imgs2 != null ?  $i2 = "block" : $i2 = "none";
                                $imgs3 != null ?  $i3 = "block" : $i3 = "none";
                                $imgs4 != null ?  $i4 = "block" : $i4 = "none";
                                $imgs5 != null ?  $i5 = "block" : $i5 = "none";
                                $imgs6 != null ?  $i6 = "block" : $i6 = "none";
                                $imgs7 != null ?  $i7 = "block" : $i7 = "none";


                                $valorAprovado = 0;
                                $valorReprovado = 0;
                                $btnOrc = null;

                                $Read->FullRead("SELECT Valor FROM [60_Orcamentos] WHERE Status <> 3 AND IdOS =:id ","id={$Idos}");
                                if($Read->getResult())
                                {
                                    $valorAprovado =  number_format($Read->getResult()[0]['Valor'],2,',','.');
                                }

                                $Read->FullRead("SELECT [60_Orcamentos].ID AS idORC, [60_Orcamentos].Valor ,[60_OT].Cliente AS idCliORC FROM [60_Orcamentos]
                                                INNER JOIN [60_OS] ON [60_OS].Id = [60_Orcamentos].IdOS
                                                INNER JOIN [60_OT] ON [60_OT].Id = [60_OS].OT WHERE [60_Orcamentos].Status = 3 AND IdOS =:id ","id={$Idos}");
                                if($Read->getResult())
                                {
                                    $valorReprovado = number_format($Read->getResult()[0]['Valor'],2,',','.');
                                    $idOrcam = $Read->getResult()[0]['idORC'];
                                    $idCliOrc = $Read->getResult()[0]['idCliORC'];
                                }

                                

                                 $valorAprovado = $valorAprovado == 0 ? "" : "<li style='padding-bottom: 5px;font-size: 12px;'>Valor Aprovado: R$ {$valorAprovado}</li>";
                                 $valorReprovado = $valorReprovado == 0 ? "" : "<li style='padding-bottom: 5px;font-size: 12px;'>Valor Reprovado: R$ {$valorReprovado}</li>
                                                                                <li style='padding-bottom: 5px;font-size: 12px;'><a style='color:#fff;text-decoration-line:none !important;' href='dashboard.php?wc=gns/orcamentos&idOrcamento={$idOrcam}&idClienteOrc={$idCliOrc}'><span class='btn btn_darkblue finalizar-OS' style='height:35px;'>Orçamento</span></a>";
                                 
                            	$jSON['historicoOs'] .= "<hr><hr>
            									          <div class='box box100' style='padding-bottom: 0px;'>
            									            <li style='padding-bottom: 5px;'><h3><b><i class='icon-history'></i>&ensp;{$Oss['NomeOs']}</b></h3></li>
            									          </div>
            									          <div class='box box50' style='padding-bottom: 0px;'>
            									            <li style='padding-bottom: 5px;font-size: 12px;'>OS:{$Oss['NumOS']}</li>                                               
                                                            {$valorAprovado}{$valorReprovado}
            									            <li style='padding-bottom: 5px;font-size: 12px;'>Técnico: {$tecnico}</li>
            									          </div>
            									          <div class='box box50' style='padding-bottom: 0px;text-align: right;'>
            									            <li style='padding-bottom: 5px;font-size: 12px;'>Status: {$status}</li>
            									            <li style='padding-bottom: 5px;font-size: 11px;color: gray;'>Usuário: {$atualizadopor}</li>
            									            <li style='padding-bottom: 5px;font-size: 11px;color: gray;'>Atualizado em: {$Oss['ATUALIZADO_EM']}</li>
            									          </div>
            									          <div class='box box100' style='padding-top: 0px;'>
            									            <li style='padding-bottom: 5px;font-size: 12px;'>OBS.: {$Oss['Obs']}</li>
                                                            <li>{$finalizaOs}
                                                            </li>
            									          </div>
                                                          <div class='box box100' style='padding-top: 0px;'>
                                                            <p style='display:{$i1}'><b>Foto Medidor</b></p>
                                                                {$imgs}
                                                            <p style='display:{$i2}'><b>Situação do serviço</b></p>
                                                                {$imgs2}
                                                            <p style='display:{$i3}'><b>Defeitos</b></p>
                                                                {$imgs3}
                                                            <p style='display:{$i4}'><b>Assinatura</b></p>
                                                                {$imgs4}
                                                            <p style='display:{$i5}'><b>Local</b></p>
                                                                {$imgs5}
                                                            <p style='display:{$i6}'><b>Assinatura técnico</b></p>
                                                                {$imgs6}
                                                            <p style='display:{$i7}'><b>Ausente</b></p>
                                                                {$imgs7}
                                                            </div>
                                                          ";
                    }

                        
                           $Read->FullRead("SELECT [60_OS].OT, CONVERT(VARCHAR(10), [60_OS].DataAgendamento, 103) AS DataAgendamento,
                                            [60_OT].NumOT, [60_OT].Cliente FROM [60_OS]
                                            INNER JOIN [60_OT] ON [60_OS].OT = [60_OT].Id
                                            where [60_OT].Cliente = {$PostData['idCliente']} AND [60_OS].DataAgendamento >= CONVERT(VARCHAR(10), DATEPART(year, GETDATE()), 103)"," ");

                            $count_visit = count($Read->getResult());

                            $Read->FullRead("SELECT [60_Clientes].Id, CONVERT(VARCHAR(10), [60_OS].DataAgendamento, 103) AS DataAgendamento, [60_Clientes].NumCliente,[60_Clientes].NomeCliente, [60_OS].Status, 
                                [60_Clientes].Telefone1, [60_OS].Endereco, [60_OS].Bairro, [60_OS].Cep, [60_OS].Status, [60_OS].Municipio, [60_Clientes].Telefone2, 
                                [60_Clientes].Telefone3, [60_Siebel].Zona,[60_Siebel].SubZona, [60_Clientes].CPFCNPJ, [60_Siebel].TelefoneZeus, 
                                [60_Clientes].EmailGns FROM [60_Clientes] INNER JOIN [60_Siebel] ON [60_Clientes].NumCliente = [60_Siebel].NumeroCliente
                                INNER JOIN [60_OS] ON [60_Siebel].NumeroOS = [60_OS].NumOS
                                INNER JOIN [60_OT] ON [60_Siebel].NumeroOT = [60_OT].NumOT WHERE [60_Clientes].Id = {$PostData['idCliente']}"," ");
                            $IdCliente = $Read->getResult()[0]['Id'];

                            $jSON['dadosCli'] = "<div class='box box100' style='padding-bottom: 0px;'>
                                                    <li style='padding-bottom: 5px;'><h3><b>Nome: {$Read->getResult()[0]['NomeCliente']}</b></h3></li>
                                                    <li style='padding-bottom: 5px;'><h3><b>Visitas no Ano:</b> {$count_visit}</h3></li>
                                                    <li style='padding-bottom: 5px;font-size: 12px;'><b>Endereço:</b> {$Read->getResult()[0]['Endereco']} - {$Read->getResult()[0]['Bairro']} - {$Read->getResult()[0]['Cep']} (<b>Zona:</b> {$Read->getResult()[0]['Zona']} - <b>SubZona:</b> {$Read->getResult()[0]['SubZona']})</li>
                                                </div>
                                                <div class='box box50' style='padding-bottom: 0px;'>
                                                    <li style='padding-bottom: 5px;font-size: 12px;'><b>Telefone:</b> <a href='tel:0{$Read->getResult()[0]['Telefone1']}'>{$Read->getResult()[0]['Telefone1']}</a></li>
                                                    <li style='padding-bottom: 5px;font-size: 12px;'><b>Telefone:</b> <a href='tel:0{$Read->getResult()[0]['Telefone2']}'>{$Read->getResult()[0]['Telefone1']}</a></li>
                                                    <li style='padding-bottom: 5px;font-size: 12px;'><b>Telefone Zeus:</b> <a href='tel:0{$Read->getResult()[0]['TelefoneZeus']}'>{$Read->getResult()[0]['Telefone1']}</a></li>         
                                                </div>
                                                <div class='box box50' style='padding-bottom: 0px;text-align: right;'>
                                                    <li style='padding-bottom: 5px;font-size: 12px;'><b>E-mail GNS:</b> <a href='mailto:{$Read->getResult()[0]['EmailGns']}'>{$Read->getResult()[0]['EmailGns']}</a></li>  
                                                    <li style='padding-bottom: 5px;font-size: 12px;'><b>CPF/CNPJ:</b> {$Read->getResult()[0]['CPFCNPJ']}</li>
                                                </div>";

                            $Read->FullRead("SELECT * FROM [60_ClientesDocumentos] WHERE IDCLIENTE = :idcliente","idcliente={$IdCliente}");
                            $jSON['docsCli'] = "<div class='box box100' style='padding-bottom: 0px;'>
                                                    <form id='form_sendDoc' class='j_tab_home tab_create' name='user_manager' action='' method='post' enctype='multipart/form-data'>
                                                    
                                                        <li style='padding-bottom: 5px;font-size: 12px;'><b>Enviar Documentos:</b><input type='file' name='arquivos_cliente[]' class='wc_loadimage' multiple=''><br><br><span class='btn btn_blue' rel='{$IdCliente}' id='sendDoc' callback='Historico' callback_action='sendDoc'>Enviar</span></li>
                                                    </form>
                                                </div>";

                }else{
                    $jSON['historicoOs'] = null;
                }
            }
        break;  
        case 'sendDoc':       

            if(isset($_FILES['arquivos_cliente'])){
                $d_title = "Defeitos";
                $d_arquivos = array($_FILES['arquivos_cliente']['size']);
                $idCliente = $PostData['idcliente'];
                $d_Image = (!empty($_FILES['arquivos_cliente']) ? $_FILES['arquivos_cliente'] : NULL);
                $d_Size = (!empty($_FILES['arquivos_cliente']['size']) ? array_sum($d_arquivos) : NULL);

                if (!empty($d_Image)){
                $d_File = $d_Image;
                $d_gbFile = array();
                $d_gbCount = count($d_File['type']);
                $d_gbKeys = array_keys($d_File);
                $d_gbLoop = 0;

                    for ($gb = 0; $gb < $d_gbCount; $gb++){
                        foreach ($d_gbKeys as $Keys){
                            $d_gbFiles[$gb][$Keys] = $d_File[$Keys][$gb];
                        }
                    }

                // $jSON['defeitos'] = NULL;
                    foreach ($d_gbFiles as $d_UploadFile){
                        $d_gbLoop ++;
                        if ($d_UploadFile['type'] == "image/jpg" || $d_UploadFile['type'] == "image/jpeg" || $d_UploadFile['type'] == "image/png") {
                            $Upload->Image($d_UploadFile, "{$idCliente}_". time(), IMAGE_W, 'ClientesDocumentos');
                        } elseif($d_UploadFile['type'] == "application/pdf" || $d_UploadFile['type'] == "application/msword") {
                            $Upload->File($d_UploadFile, "{$idCliente}_". time(), 'ClientesDocumentos');
                        }else{
                            $jSON['trigger'] = AjaxErro("<b class='icon-checkmark'>Arquivo com formato não suportado pelo sistema</b>");
                        }

                        if ($Upload->getResult()){
                            $d_gbCreate = array('IDCLIENTE' => $idCliente, 'ARQUIVO' => $Upload->getResult(), 'USUARIOSISTEMA' => $_SESSION['userLogin']['ID']);                          
                            $Create->ExeCreate('[60_ClientesDocumentos]', $d_gbCreate);

                            if($Create->getResult()){
                                $jSON['trigger'] = AjaxErro("<b class='icon-checkmark'>Arquivos enviados com sucesso!</b>");

                            }else{
                                $jSON['trigger'] = AjaxErro("<b class='icon-checkmark'>Erro ao tentar enviar os arquivos!</b>");
                            }
                        }
                    }
                }
            }else{
                $jSON['trigger'] = AjaxErro("<b class='icon-checkmark'>Nenhum arquivo foi selecionado!</b>");
            }
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
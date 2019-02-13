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
$CallBack = 'Monitoramento';
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

    //SELECIONA AÇÃO
    switch ($Case):        
        case 'consulta':
        //$naoassociados = 0;
        $associados = 0;
        $atendidos = 0;
        $cancelados = 0;
        $ausentes = 0;
        $reagendadosNVT = 0;
        $reagendadosGNS = 0;
        $semAtender = 0;
        $criterioTec = "";
        $orcamentoAprov = 0;
        $orcamentoExec = 0;
        $orcamentoReprov = 0;
        $qtdOs = 0;

                if(!$PostData['Tecnico']):
                    $jSON['trigger'] = AjaxErro("SELECIONE PRIMEIRO UM TÉCNICO!", E_USER_WARNING);
                else:
                    //SELECIONAR TODOS OS TÉCNICOS
                    $ArrayTecnicos = [];
                    $Read->FullRead("SELECT [00_NivelAcesso].ID, CASE WHEN FUNC.ID IS NOT NULL THEN FUNC.[NOME COMPLETO] ELSE TERC.NOME END AS NOME
                FROM [00_NivelAcesso] LEFT JOIN Funcionários FUNC ON [00_NivelAcesso].IDFUNCIONARIO = FUNC.ID
                LEFT JOIN FuncionariosTerceirizados TERC ON [00_NivelAcesso].IDTERCEIRIZADO = TERC.ID
                WHERE MOBILE_GNS = 1 AND FUNC.[DATA DE DEMISSÃO] IS NULL ORDER BY NOME"," ");

                    if($Read->getResult()):

                        $jSON['addlistOciosidade'] = null;
                        foreach ($Read->getResult() as $value) {

                            extract($value);
                            array_push($ArrayTecnicos, array("ID"=>$ID,"NOME"=>$NOME));
                        }
                    endif;

                    if($ArrayTecnicos):
                        $horaAtual = date('H:i:s');
                        $i = 0;
                        $t = count($ArrayTecnicos);
                        
                        for ($i = 0;$i < $t; $i++) {
                           
                            //QTD OS's ATRIBUIDAS A CADA TÉCNICO
                            $Read->FullRead("SELECT COUNT(*) AS QUANTIDADE FROM [60_OS] WHERE convert(varchar(10), DataAgendamento, 102) = convert(varchar(10), getdate(), 102) AND Tecnico = {$ArrayTecnicos[$i]["ID"]}"," ");
                           
                            $ArrayTecnicos[$i]["ATRIBUIDO"] = $Read->getResult()[0]["QUANTIDADE"];

                            //DATASAIDA DO ULTIMO ATENDIMENTO PARA CADA TECNICO
                            $Read->FullRead("SELECT MAX(convert(varchar(8),[DataSaida],108)) AS SAIDA FROM [BDNVT].[dbo].[60_Atendimentos] WHERE STATUS = 1 AND CONVERT(VARCHAR(10), DataAtendimento,102) = convert(varchar(10), getdate(),102)  AND idTecnico = {$ArrayTecnicos[$i]["ID"]}", "");

                            $ArrayTecnicos[$i]["SAIDA"] = $Read->getResult()[0]["SAIDA"];

                            if($ArrayTecnicos[$i]["SAIDA"] == null):

                                $ArrayTecnicos[$i]["OCIOSIDADE"] = "<td style='color:red;text-align:center'>Ocioso</td>";
                            else:
                                //quanto tempo ele está sem atender
                                $diff = abs(strtotime($horaAtual) - strtotime($ArrayTecnicos[$i]["SAIDA"]));

                                if($diff >= 5400):

                                    $ArrayTecnicos[$i]["OCIOSIDADE"] = "<td style='color:red;text-align:center'>Ocioso</td>";
                                else:

                                    $ArrayTecnicos[$i]["OCIOSIDADE"] = "<td style='color:green;text-align:center'>Não ocioso</td>";
                                endif;
                            endif;
                            $nomeTec = explode(" ", $ArrayTecnicos[$i]["NOME"]);
                            
                            //AVISO DE OCIOSIDADE
                            $jSON['addlistOciosidade'] .= "
                               
                                    <tr>
                                        <td>".$nomeTec[0]." ". $nomeTec[1]." ".$nomeTec[2]."</td>
                                        {$ArrayTecnicos[$i]["OCIOSIDADE"]}
                                        <td>{$ArrayTecnicos[$i]["SAIDA"]}</td>
                                    </tr>
                                
                            ";
                                    
                        }
                    
                    endif;
                    //CLAUSULA DE CRITÉRIO PARA FILTRAR POR TÉCNICO
                    $criterioTec = $PostData['Tecnico'] != "t" ? " AND Tecnico = " . $PostData['Tecnico'] : " AND Tecnico <> 0 ";

                    if($PostData['Tecnico'] !="t"):

                    $ArrayTecnicos = [];
                    //DATASAIDA DO ULTIMO ATENDIMENTO PARA O TECNICO
                    $Read->FullRead("SELECT [00_NivelAcesso].ID, CASE WHEN FUNC.ID IS NOT NULL THEN FUNC.[NOME COMPLETO] ELSE TERC.NOME END AS NOME
                FROM [00_NivelAcesso] LEFT JOIN Funcionários FUNC ON [00_NivelAcesso].IDFUNCIONARIO = FUNC.ID
                LEFT JOIN FuncionariosTerceirizados TERC ON [00_NivelAcesso].IDTERCEIRIZADO = TERC.ID
                WHERE [00_NivelAcesso].ID = {$PostData['Tecnico']} AND MOBILE_GNS = 1 AND FUNC.[DATA DE DEMISSÃO] IS NULL ORDER BY NOME", "");

                    $ArrayTecnicos["NOME"] = $Read->getResult()[0]["NOME"];
                            //DATASAIDA DO ULTIMO ATENDIMENTO PARA CADA TECNICO
                            $Read->FullRead("SELECT MAX(convert(varchar(8),[DataSaida],108)) AS SAIDA FROM [BDNVT].[dbo].[60_Atendimentos] WHERE STATUS = 1 AND CONVERT(VARCHAR(10), DataAtendimento,102) = convert(varchar(10), getdate(),102)  AND idTecnico = {$PostData["Tecnico"]}", "");

                            $ArrayTecnicos["SAIDA"] = $Read->getResult()[0]["SAIDA"];

                            if($ArrayTecnicos["SAIDA"] == null):

                                $ArrayTecnicos["OCIOSIDADE"] = "<td style='color:red;text-align:center'>Ocioso</td>";
                            else:
                                //quanto tempo ele está sem atender
                                $diff = abs(strtotime($horaAtual) - strtotime($ArrayTecnicos["SAIDA"]));

                                if($diff >= 5400):

                                    $ArrayTecnicos["OCIOSIDADE"] = "<td style='color:red;text-align:center'>Ocioso</td>";
                                else:

                                    $ArrayTecnicos["OCIOSIDADE"] = "<td style='color:green;text-align:center'>Não ocioso</td>";
                                endif;
                            endif;
                            $nomeTec = explode(" ", $ArrayTecnicos["NOME"]);
                            
                            //AVISO DE OCIOSIDADE
                            $jSON['addlistOciosidade'] = "
                               
                                    <tr>
                                        <td>".$nomeTec[0]." ". $nomeTec[1]." ".$nomeTec[2]."</td>
                                        {$ArrayTecnicos["OCIOSIDADE"]}
                                        <td>{$ArrayTecnicos["SAIDA"]}</td>
                                    </tr>
                                
                            ";
                    endif;
                    //CLIENTES ASSOCIADOS
                    $Read->FullRead("SELECT COUNT(*) AS QUANTIDADE FROM [60_OS] WHERE convert(varchar(10), DataAgendamento, 102) = convert(varchar(10), getdate(), 102)" . $criterioTec,"");
                    if ($Read->getResult()):
                        foreach ($Read->getResult() as $OS):
                            extract($OS);
                            $associados = $QUANTIDADE;
                            $qtdOs = $QUANTIDADE;
                        endforeach;

                        //TEMPO MÁXIMO EM CADA ATENDIMENTO
                        $tempo = "08:00:00";//DEFININDO O TEMPO
                        if($PostData['Tecnico'] != "t" && $associados > 0): 

                            $segundos = 0;
                            $minutos = 0;

                            //REMOVER AS DIVISÕES DO TEMPO
                            list($horas,$mins,$seg) = explode(":",$tempo); 
                            if($horas <> 0){
                                //UMA HORA = 3600s ENTÃO, CONTAREMOS DE 3600 EM 3600
                                for($i=1;$i<=$horas;$i++){

                                    $segundos += 3600;
                                }
                            }
                            if($mins <> 0){
                                //O MESMO DO ANTERIOR, 1 MINUTO = 60s CONTAREMOS DE 60 EM 60
                                for($j=1;$j<=$mins;$j++){

                                    $minutos += 60;
                                }
                            }
                            //SOMAMOS TUDO E OBTEMOS O TOTAL DO TEMPO EM SEGUNDOS.
                            $total = $segundos + $minutos + $seg; 

                            //DIVIDIMOS PELA QTD DE OS's ASSOCIADAS;
                            $meutempo = $total / $associados;

                            //AGORA SÓ TRASNFORMAR EM HORAS NOVAMENTE...
                            $TempoMax =  gmdate("H:i:s", $meutempo);
                        else:
                            $TempoMax = "00:00:00";
                        endif;   

                    else:
                        $associados = 0;
                        $qtdOs = 0;
                    endif;

                    //CLIENTES ATENDIDOS  
                    $Read->FullRead("SELECT COUNT(*) AS QUANTIDADE FROM [60_OS] WHERE STATUS = 1 AND convert(varchar(10), DataAgendamento, 102) 
                        = convert(varchar(10), getdate(), 102)" . $criterioTec,"");
                    if ($Read->getResult()):
                        foreach ($Read->getResult() as $OS):
                            extract($OS);
                            $atendidos = $QUANTIDADE;

                            //TEMPO GASTO EM CADA ATENDIMENTO
                            $TempoMedio = 0;
                            $Tempo = 0;

                            //TEMPO MÉDIO DE ATENDIMENTOS
                            if($PostData["Tecnico"] != "t"):
                                $Read->FullRead("SELECT DATEDIFF(MINUTE, DataAtendimento, DataSaida) AS TEMPOMEDIO FROM [60_Atendimentos] WHERE STATUS = 1 AND convert(varchar(10), DataAtendimento, 102) = convert(varchar(10), getdate(), 102) AND idTecnico = {$PostData['Tecnico']}","");

                                if($Read->getResult() != null):
                                    foreach ($Read->getResult() as $value) {
                                        
                                        $Tempo += $Read->getResult()[0]["TEMPOMEDIO"];
                                    }
                                endif;
                            endif;
                        endforeach;
                        $TempoMedio = $Tempo == 0 ? 0 : $Tempo / $atendidos;              
                    else:
                        $atendidos = 0;
                    endif;

                    //CLIENTES CANCELADOS  
                    $Read->FullRead("SELECT COUNT(*) AS QUANTIDADE FROM [60_OS] WHERE STATUS = 2 AND convert(varchar(10), DataAgendamento, 102) 
                        = convert(varchar(10), getdate(), 102)" . $criterioTec,"");
                    if ($Read->getResult()):
                        foreach ($Read->getResult() as $OS):
                            extract($OS);
                            $cancelados = $QUANTIDADE;
                        endforeach;                   
                    else:
                        $cancelados = 0;
                    endif;

                    //CLIENTES AUSENTES  
                    $Read->FullRead("SELECT COUNT(*) AS QUANTIDADE FROM [60_OS] WHERE STATUS = 3 AND convert(varchar(10), DataAgendamento, 102) 
                        = convert(varchar(10), getdate(), 102)" . $criterioTec,"");
                    if ($Read->getResult()):
                        foreach ($Read->getResult() as $OS):
                            extract($OS);
                            $ausentes = $QUANTIDADE;
                        endforeach;                   
                    else:
                        $ausentes = 0;
                    endif;

                    //CLIENTES REAGENDADOS NVT  
                    $Read->FullRead("SELECT COUNT(*) AS QUANTIDADE FROM [60_OS] WHERE STATUS = 4 AND convert(varchar(10), DataAgendamento, 102) 
                        = convert(varchar(10), getdate(), 102)" . $criterioTec,"");
                    if ($Read->getResult()):
                        foreach ($Read->getResult() as $OS):
                            extract($OS);
                            $reagendadosNVT = $QUANTIDADE;
                        endforeach;                   
                    else:
                        $reagendadosNVT = 0;
                    endif;

                    //CLIENTES REAGENDADOS GNS  
                    $Read->FullRead("SELECT COUNT(*) AS QUANTIDADE FROM [60_OS] WHERE STATUS = 5 AND convert(varchar(10), DataAgendamento, 102) 
                        = convert(varchar(10), getdate(), 102)" . $criterioTec,"");
                    if ($Read->getResult()):
                        foreach ($Read->getResult() as $OS):
                            extract($OS);
                            $reagendadosGNS = $QUANTIDADE;
                        endforeach;                   
                    else:
                        $reagendadosGNS = 0;
                    endif;

                    //CLIENTES SEM ATENDER  
                    $Read->FullRead("SELECT COUNT(*) AS QUANTIDADE FROM [60_OS] WHERE STATUS = 0 AND convert(varchar(10), DataAgendamento, 102) 
                        = convert(varchar(10), getdate(), 102)" . $criterioTec,"");
                    if ($Read->getResult()):
                        foreach ($Read->getResult() as $OS):
                            extract($OS);
                            $semAtender = $QUANTIDADE;
                        endforeach;                   
                    else:
                        $semAtender = 0;
                    endif;

                    //ORÇAMENTOS APROVADOS 
                    $Read->FullRead("SELECT COUNT(*) AS QUANTIDADE FROM [60_Orcamentos]
                        INNER JOIN [60_OS] ON [60_Orcamentos].IdOS = [60_OS].Id
                        WHERE [60_Orcamentos].Status = 1 AND convert(varchar(10), [60_OS].DataAgendamento, 102) 
                        = convert(varchar(10), getdate(), 102)" . $criterioTec,"");
                    if ($Read->getResult()):
                        $Valor = 0;
                        $VALOR = 0;
                        foreach ($Read->getResult() as $OS):
                            extract($OS);
                            $orcamentoAprov = $QUANTIDADE;

                            //VALOR DOS APROVADOS
                            $Read->FullRead("SELECT SUM(Valor) AS VALOR FROM [60_Orcamentos]
                                INNER JOIN [60_OS] ON [60_Orcamentos].IdOS = [60_OS].Id
                                WHERE [60_Orcamentos].Status = 1 AND convert(varchar(10), [60_OS].DataAgendamento, 102) 
                                = convert(varchar(10), getdate(), 102)" . $criterioTec,"");
                            if($Read->getResult() && $Read->getResult()[0]['VALOR'] != ""){

                                $VALOR = $Read->getResult()[0]['VALOR'];
                                $ValorAp = $Read->getResult()[0]['VALOR'];    
                            }else{

                                $VALOR = 0;
                                $ValorAp = 0;
                            }

                        endforeach;   

                        $ValorA = number_format($VALOR,2,",",".");                
                            
                    else:
                        $orcamentoAprov = 0;
                    endif;

                    //ORÇAMENTOS EXECUTADOS 
                    $Read->FullRead("SELECT COUNT(*) AS QUANTIDADE FROM [60_Orcamentos]
                        INNER JOIN [60_OS] ON [60_Orcamentos].IdOS = [60_OS].Id
                        WHERE [60_Orcamentos].Status = 2 AND convert(varchar(10), [60_OS].DataAgendamento, 102) 
                        = convert(varchar(10), getdate(), 102) " . $criterioTec,"");
                        $Valor = 0;
                        $VALOR = 0;
                    if ($Read->getResult()):
                        foreach ($Read->getResult() as $OS):
                            extract($OS);
                            $orcamentoExec = $QUANTIDADE;

                            //VALOR DOS EXECUTADOS
                            $Read->FullRead("SELECT SUM(Valor) AS VALOR FROM [60_Orcamentos]
                                INNER JOIN [60_OS] ON [60_Orcamentos].IdOS = [60_OS].Id
                                WHERE [60_Orcamentos].Status = 2 AND convert(varchar(10), [60_OS].DataAgendamento, 102) 
                                = convert(varchar(10), getdate(), 102)" . $criterioTec,"");
                            if($Read->getResult() && $Read->getResult()[0]['VALOR'] != ""){

                                $VALOR = $Read->getResult()[0]['VALOR']; 
                                 $ValorExe = $Read->getResult()[0]['VALOR'];   
                            }else{

                                $VALOR = 0;
                                $ValorExe = 0;
                            }
                        endforeach; 
                        $ValorE = number_format($VALOR,2,",",".");                  
                    else:
                        $orcamentoExec = 0;
                    endif;

                    //ORÇAMENTOS RECUSADOS 
                    $Read->FullRead("SELECT COUNT(*) AS QUANTIDADE FROM [60_Orcamentos]
                        INNER JOIN [60_OS] ON [60_Orcamentos].IdOS = [60_OS].Id
                        WHERE [60_Orcamentos].Status =  3 AND convert(varchar(10), [60_OS].DataAgendamento, 102) 
                        = convert(varchar(10), getdate(), 102) " . $criterioTec,"");
                    if ($Read->getResult()):
                        foreach ($Read->getResult() as $OS):
                            extract($OS);
                            $orcamentoReprov = $QUANTIDADE;

                            //VALOR DOS RECUSADOS
                            $Read->FullRead("SELECT SUM(Valor) AS VALOR FROM [60_Orcamentos]
                                INNER JOIN [60_OS] ON [60_Orcamentos].IdOS = [60_OS].Id
                                WHERE [60_Orcamentos].Status = 3 AND convert(varchar(10), [60_OS].DataAgendamento, 102) 
                                = convert(varchar(10), getdate(), 102)" . $criterioTec,"");
                            if($Read->getResult() && $Read->getResult()[0]['VALOR'] != ""){

                                $VALOR = $Read->getResult()[0]['VALOR'];
                                $ValorRec = $Read->getResult()[0]['VALOR'];    
                            }else{

                                $VALOR = 0;
                                $ValorRec = 0;
                            }
                        endforeach;
                        $ValorR = number_format($VALOR,2,",",".");
                    else:
                        $orcamentoReprov = 0;
                    endif;

                    $orcamentoTotal = $orcamentoAprov + $orcamentoExec + $orcamentoReprov;
                    $ValorT = number_format($ValorAp + $ValorExe + $ValorRec,2,",",".");
                    
                    $altoDesemp = "<td style='color:green'><b>Alto Desemp.</b></td>";
                    $baixoDesemp = "<td style='color:red'><b>Baixo. Desemp.</b></td>";

                    //DESEMPENHO TEMPO MAXIMO ATENDIMENTO
                    $DesemTempo = gmdate("H:i:s",strtotime($TempoMedio)) <= gmdate("H:i:s",strtotime($TempoMax)) && $atendidos > 0? $altoDesemp : $baixoDesemp;  

                    //DESEMPENHO QTD ORÇAMENTOS GERADOS
                    $orcamentoDesemp = $orcamentoAprov + $orcamentoExec + $orcamentoReprov;
                    $porcentOrca = $atendidos != 0  || $orcamentoAprov != 0 || $orcamentoExec != 0 || $orcamentoReprov != 0 ? ($orcamentoDesemp * 100 / $associados) : 0;
                    $percent = number_format($porcentOrca,2);

                    $DesempOrc = $porcentOrca >= 70 ? $altoDesemp : $baixoDesemp;

                    //DESEMPENHO VALOR ORÇAMENTOS APROVADOS E EXECUTADOS
                    $orcamentoDesempValor = $ValorAp + $ValorExe;
                    $DesempValor = $orcamentoDesempValor > 2500 ? $altoDesemp : $baixoDesemp;
                    $DValor = number_format($orcamentoDesempValor,2,",",".");



                    //RESPOSTA JSON
                    $jSON['trigger'] = true;
                    $jSON['addlist'] = "<table id='dataList' class='cell-border compact stripe table' style='width: 100%;font-size: 15px;'>
                    <tr>
                        <td>Associado(s):</td>
                        <td>{$associados}</td>
                    </tr>
                    <tr>
                        <td>Atendido(s):</td>
                        <td>{$atendidos}</td>
                    </tr>
                    <tr>
                        <td>Cancelado(s):</td>
                        <td>{$cancelados}</td>
                    </tr>
                    <tr>
                        <td>Ausente(s):</td>
                        <td>{$ausentes}</td>
                    </tr>
                    <tr>
                        <td>Reagend.(s) NVT:</td>
                        <td>{$reagendadosNVT}</td>
                    </tr>
                    <tr>
                        <td>Reagend.(s) GNS:</td>
                        <td>{$reagendadosGNS}</td>
                    </tr>
                    <tr>
                        <td>Sem Atender:</td>
                        <td>{$semAtender}</td>
                    </tr>
                    </table>";

                    $jSON['addOrcamentolist'] = "<table id='orcamento-list' class='cell-border compact stripe table' style='width: 100%;font-size: 15px;'>
                    <thead>
                      <th>Orçamentos</th>
                      <th>Qtd</th>
                      <th>valor</th>
                    </thead>
                    <tr>
                        <td>Aprovado(s):</td>
                        <td style='text-align:center'>{$orcamentoAprov}</td>
                        <td><b><span style='text-align:left'>R$</span> {$ValorA}</br></td>
                    </tr>
                    <tr>
                        <td>Executado(s):</td>
                        <td style='text-align:center'>{$orcamentoExec}</td>
                        <td><b><span style='text-align:left'>R$</span> {$ValorE}</br></td>
                    </tr>
                    <tr>
                        <td>Reprovado(s):</td>
                        <td style='text-align:center'>{$orcamentoReprov}</td>
                        <td><b><span style='text-align:left'>R$</span> {$ValorR}</br></td>
                    </tr>
                    <tr>
                        <td><b>Total:</b></td>
                        <td style='text-align:center'>{$orcamentoTotal}</td>
                        <td><b><span style='text-align:left'>R$</span> {$ValorT}</br></td>
                    </tr>
                    </table>";

                    if($PostData["Tecnico"] != "t"):

                        $jSON['addMedialist'] = "<table class='monitoramentoGns' id='media-list' class='cell-border compact stripe table' style='width: 100%;font-size: 15px;'>
                        <tr>
                            <td>OS's Atendidas:</td>
                            <td style='text-align:left'>{$atendidos}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Qtd. OS/Tempo:</td>
                            <td>{$TempoMax} min</td>
                            <td></td>
                            
                        </tr>
                        <tr>
                            <td>M. de Temp Atend.:</td>
                            <td>".round($TempoMedio)." min</td>
                            {$DesemTempo}
                        </tr>
                        <tr>
                            <td>Atendimentos c/ Orçamentos:</td>
                            <td>{$percent} %</td>
                            {$DesempOrc}
                        </tr>
                        <tr>
                            <td>R$ Orçamentos Aprovados:</td>
                            <td>R$ {$DValor}</td>
                            {$DesempValor}
                        </tr>
                        </table>";

                    endif;
                    carregaLocalizações();   

                    $Read->FullRead("SELECT  [60_OS].NomeOs,[60_OS].NumOS, NomeCliente,Telefone1,Telefone2,Telefone3,[NumOT],[ObsOT], [60_OS].DataAgendamento,[PeriodoAgendamento],
                    [60_OS].Latitude, [60_OS].Longitude, [60_OS].Status FROM [60_Clientes]
                    inner join [60_OT] on [60_Clientes].Id = [60_OT].Cliente
                    inner join [60_OS] on [60_OT].Id = [60_OS].OT
                    WHERE convert(varchar(10), DataAgendamento, 102) = convert(varchar(10), getdate(), 102) " . $criterioTec,"");

                    $jSON['locations'] = $Read->getResult();

                    $jSON['qtdOs'] = $qtdOs;

                    $criterioLoc = $PostData['Tecnico'] != "t" ? " WHERE IDTECNICO = " . $PostData['Tecnico'] : "";
                    $Read->FullRead("SELECT * FROM [60_Localizacao] " . $criterioLoc," ");
                    for ($o=0; $o < count($Read->getResult()); $o++) { 
                        array_push($jSON['locations'], $Read->getResult()[$o]);
                    }
                    
                    
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


function carregaLocalizações(){
    
    $ch = curl_init("http://www.gps7.com.br/gps7/api/api.php?action=posicoes&usuario=rdias@novatecenergy.com.br&senha=1234");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $json = curl_exec($ch);
    curl_close($ch);
    $carLocation = json_decode($json, true);

    $Carro = new Read;    
    $Update = new Update;
    $Create = new Create;
    $LOCALIZACAO = NULL;
    foreach ($carLocation['msg'] as $key => $value) {
        $placa = substr($value['identificador'],0,7);
        $Carro->FullRead("SELECT CASE WHEN FUNC.ID IS NOT NULL THEN FUNC.[NOME COMPLETO] ELSE TERC.NOME END AS nome, SUB.PRODUTO AS carro,
                    [00_NivelAcesso].ID AS id, SUB.IDPROD AS idCarro FROM [40_Interna_ID]
                    LEFT JOIN Funcionários FUNC ON [40_Interna_ID].USUARIO_PORTADOR = FUNC.ID
                    LEFT JOIN FuncionariosTerceirizados TERC ON [40_Interna_ID].USUARIO_PORTADOR_TERCEIRIZADO = TERC.ID
                    INNER JOIN [00_NivelAcesso] ON FUNC.ID = [00_NivelAcesso].IDFUNCIONARIO OR TERC.ID = [00_NivelAcesso].IDTERCEIRIZADO
                    INNER JOIN(
                    SELECT max([40_Interna].INTERNA) ULTMOV, [40_Produtos].PRODUTO, [40_Produtos].Id IDPROD FROM [40_Produtos]
                    INNER JOIN [40_Interna] ON [40_Produtos].Id = [40_Interna].PRODUTO
                    WHERE [40_Produtos].PRODUTO LIKE '%" . $placa . "%'
                    GROUP BY [40_Produtos].PRODUTO, [40_Produtos].Id) SUB
                    ON [40_Interna_ID].ID = SUB.ULTMOV
                    WHERE [40_Interna_ID].TIPO_MOVIMENTO = 244 AND MOBILE_GNS = 1
                    ORDER BY NOME" ," ");
        if ($Carro->getResult()) {
            $LOCALIZACAO['IDTECNICO'] = $Carro->getResult()[0]['id'];
            $LOCALIZACAO['NOME'] = $Carro->getResult()[0]['nome'];
            $LOCALIZACAO['IDCARRO'] = $Carro->getResult()[0]['idCarro'];
            $LOCALIZACAO['CARRO'] = $Carro->getResult()[0]['carro'];
            $LOCALIZACAO['LATITUDE'] = $value['latitude'];
            $LOCALIZACAO['LONGITUDE'] = $value['longitude'];

            $Carro->FullRead("SELECT * FROM [60_Localizacao] WHERE IDTECNICO = :tec" ,"tec={$Carro->getResult()[0]['id']}");            
            if ($Carro->getResult()) {
                $Update->ExeUpdate("[60_Localizacao]", $LOCALIZACAO, "WHERE ID = :id", "id={$Carro->getResult()[0]['ID']}");
            }else{
                $Create->Execreate("[60_Localizacao]",$LOCALIZACAO);
            }
        }
    }
    

}
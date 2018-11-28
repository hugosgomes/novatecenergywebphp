<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Slim\Http\UploadedFile;


$app->post('/atendimentos/finalizados/', function (Request $request, Response $response, array $args) {
    $Create = new Create();
    $Update = new Update();
    $Read = new Read();
    
    $body = $request->getParsedBody();  
    //var_dump($body);

    $Retorno = null;

    for ($i=0; $i < count($body); $i++) { 

        //TRATAMENTO DOS DADOS DE ATENDIMENTO
        $atendimentoFinalizado[$i]['IdOS'] = intval($body[$i]['idAtendimento']);
        $atendimentoFinalizado[$i]['idTecnico'] = intval($body[$i]['idTecnico']);
        $atendimentoFinalizado[$i]['Status'] = intval($body[$i]['Status']);
        $atendimentoFinalizado[$i]['DataAtendimento'] = ($body[$i]['dataHoraAtendimento'] == "null" || $body[$i]['dataHoraAtendimento'] == null ? $body[$i]['DataAtendimento'] : $body[$i]['dataHoraAtendimento']['dataHoraInicio']);
        $atendimentoFinalizado[$i]['DataSaida'] = ($body[$i]['dataHoraAtendimento'] == "null" || $body[$i]['dataHoraAtendimento'] == null ? $body[$i]['DataAtendimento'] : $body[$i]['dataHoraAtendimento']['dataHoraFinal']);
        $atendimentoFinalizado[$i]['NumManometro'] = ($body[$i]['NumManometro'] == "null" || $body[$i]['NumManometro'] == ""? 0 : $body[$i]['NumManometro']);
        $atendimentoFinalizado[$i]['PressaoInicial'] = ($body[$i]['PressaoInicial'] == "null" ? 0 : floatval($body[$i]['PressaoInicial']));
        $atendimentoFinalizado[$i]['PressaoFinal'] = ($body[$i]['PressaoFinal'] == "null" || $body[$i]['PressaoFinal'] == ""? 0 : floatval($body[$i]['PressaoFinal']));
        $atendimentoFinalizado[$i]['TempoTeste'] = ($body[$i]['TempoTeste'] == "null" || $body[$i]['TempoTeste'] == ""? 0 : intval($body[$i]['TempoTeste']));
        $atendimentoFinalizado[$i]['StatusTeste'] = ($body[$i]['statusVazamento'] == "null" || $body[$i]['statusVazamento'] == ""? NULL : $body[$i]['statusVazamento']);
        $atendimentoFinalizado[$i]['NumOcorrencia'] = ($body[$i]['NumOcorrencia'] == "null" || $body[$i]['NumOcorrencia'] == "" ? NULL : $body[$i]['NumOcorrencia']);
        $atendimentoFinalizado[$i]['Defeito'] = ($body[$i]['instalacaoDefeito'] == "null" || $body[$i]['instalacaoDefeito'] == "" ? NULL : $body[$i]['statusVazamento']);
        $atendimentoFinalizado[$i]['Obs'] = ($body[$i]['obs'] == "null" || $body[$i]['obs'] == ""? NULL : $body[$i]['obs']);
        $atendimentoFinalizado[$i]['NomeContato'] = ($body[$i]['nomeContato'] == "null" || $body[$i]['nomeContato'] == ""? NULL : $body[$i]['nomeContato']);
        $atendimentoFinalizado[$i]['TelefoneContato'] = ($body[$i]['telefoneContato'] == "null" || $body[$i]['telefoneContato'] == ""? NULL : $body[$i]['telefoneContato']);
        $atendimentoFinalizado[$i]['Gas'] = ($body[$i]['naturalouGlp'] == "null" || $body[$i]['naturalouGlp'] == ""? NULL : $body[$i]['naturalouGlp']);
        $atendimentoFinalizado[$i]['Ramificacao'] = ($body[$i]['aparenteEmbutida'] == "null" || $body[$i]['aparenteEmbutida'] == ""? NULL : $body[$i]['aparenteEmbutida']);
        $atendimentoFinalizado[$i]['Diametro'] = ($body[$i]['diametro'] == "null" || $body[$i]['diametro'] == ""? NULL : $body[$i]['diametro']);
        $atendimentoFinalizado[$i]['Material'] = ($body[$i]['cuFerroOutros'] == "null" || $body[$i]['cuFerroOutros'] == ""? NULL : $body[$i]['cuFerroOutros']);
        $atendimentoFinalizado[$i]['Latitude'] = ($body[$i]['latitude'] == "null" || $body[$i]['latitude'] == ""? NULL : $body[$i]['latitude']);
        $atendimentoFinalizado[$i]['Longitude'] = ($body[$i]['longitude'] == "null" || $body[$i]['longitude'] == ""? NULL : $body[$i]['longitude']);
        $atendimentoFinalizado[$i]['Pressao'] = ($body[$i]['bpMpaMpb'] == "null" || $body[$i]['bpMpaMpb'] == ""? NULL : $body[$i]['bpMpaMpb']);
        
        //ATUALIZA DADOS DO CLIENTE
        $atualizaCliente[$i]['EmailNVT'] = ($body[$i]['emailClinte'] == "null" || $body[$i]['emailClinte'] == ""? NULL : $body[$i]['emailClinte']);
        $atualizaCliente[$i]['TelefoneNVT'] = ($body[$i]['telCliente'] == "null" || $body[$i]['telCliente'] == ""? NULL : $body[$i]['telCliente']);
        $Read->FullRead("SELECT Id FROM [60_Clientes] WHERE Id = :id","id={$body[$i]['idCliente']}");
        if($Read->getResult()){
            $Update->ExeUpdate("[60_Clientes]", $atualizaCliente[$i], "WHERE Id = :id", "id={$body[$i]['idCliente']}");
        }else{
            $Retorno['Cliente'] = "error";
        }

        //SALVA ATENDIMENTO
        $Read->FullRead("SELECT Id FROM [60_Atendimentos] WHERE IdOS = :id","id={$atendimentoFinalizado[$i]['IdOS']}");
        if(!$Read->getResult()){
            $Create->ExeCreate("[60_Atendimentos]", $atendimentoFinalizado[$i]);
                if($Create->getResult()){
                    $Os['Status'] = $atendimentoFinalizado[$i]['Status'];
                    //MUDAR AO COLOCAR EM PRODUÇÃO
                    $Update->ExeUpdate("[60_OS]", $Os, "WHERE Id = :id", "id={$atendimentoFinalizado[$i]['IdOS']}");

                    $Retorno[$atendimentoFinalizado[$i]['IdOS']] = "sucess1";                    
                }else{
                     $Retorno[$atendimentoFinalizado[$i]['IdOS']] = "error";
                }
        }else{
            $Update->ExeUpdate("[60_Atendimentos]", $atendimentoFinalizado[$i], "WHERE Id = :id", "id={$atendimentoFinalizado[$i]['IdOS']}");
            if($Update->getResult()){
                $Os['Status'] = $atendimentoFinalizado[$i]['Status'];
                //MUDAR AO COLOCAR EM PRODUÇÃO
                $Update->ExeUpdate("[60_OS]", $Os, "WHERE Id = :id", "id={$atendimentoFinalizado[$i]['IdOS']}");

                $Retorno[$atendimentoFinalizado[$i]['IdOS']] = "sucess2";                
            }else{
                 $Retorno[$atendimentoFinalizado[$i]['IdOS']] = "error";
            }
        }   
        //SALVA APARELHOS
        for($a=0; $a < count($body[$i]['aparelho']); $a++){       
            $Aparelhos[$i]['IdOS'] = intval($body[$i]['idAtendimento']);
            $Aparelhos[$i]['Tipo'] = ($body[$i]['aparelho'][$a]['tipo'] == "null" || $body[$i]['aparelho'][$a]['tipo'] == "" ? NULL : $body[$i]['aparelho'][$a]['tipo']);
            $Aparelhos[$i]['Marca'] = ($body[$i]['aparelho'][$a]['marca'] == "null" || $body[$i]['aparelho'][$a]['marca'] == "" ? NULL : $body[$i]['aparelho'][$a]['marca']);
            $Aparelhos[$i]['Modelo'] = ($body[$i]['aparelho'][$a]['modelo'] == "null" || $body[$i]['aparelho'][$a]['modelo'] == "" ? NULL : $body[$i]['aparelho'][$a]['modelo']);
            $Aparelhos[$i]['PotNominal'] = ($body[$i]['aparelho'][$a]['potenciaNominal'] == "null" || $body[$i]['aparelho'][$a]['potenciaNominal'] == "" ? NULL : intval($body[$i]['aparelho'][$a]['potenciaNominal']));
            $Aparelhos[$i]['Tiragem'] = ($body[$i]['aparelho'][$a]['tiragem'] == "null" || $body[$i]['aparelho'][$a]['tiragem'] == "" ? NULL : $body[$i]['aparelho'][$a]['tiragem']);
            $Aparelhos[$i]['Combustao'] = ($body[$i]['aparelho'][$a]['combustao'] == "null" || $body[$i]['aparelho'][$a]['combustao'] == "" ? NULL : $body[$i]['aparelho'][$a]['combustao']);
            $Aparelhos[$i]['Funcionamento'] = ($body[$i]['aparelho'][$a]['funcionamento'] == "null" || $body[$i]['aparelho'][$a]['funcionamento'] == "" ? NULL : $body[$i]['aparelho'][$a]['funcionamento']);
            $Aparelhos[$i]['TiragemHigienteCombustao'] = ($body[$i]['aparelho'][$a]['higCombusTiragem'] == "null" || $body[$i]['aparelho'][$a]['higCombusTiragem'] == "" ? NULL : $body[$i]['aparelho'][$a]['higCombusTiragem']);
            $Aparelhos[$i]['Con'] = ($body[$i]['aparelho'][$a]['higCombusCOn'] == "null" || $body[$i]['aparelho'][$a]['higCombusCOn'] == "" ? NULL : $body[$i]['aparelho'][$a]['higCombusCOn']);
            $Aparelhos[$i]['CoAmb'] = ($body[$i]['aparelho'][$a]['higCombusCOAmbiente'] == "null" || $body[$i]['aparelho'][$a]['higCombusCOAmbiente'] == "" ? NULL : $body[$i]['aparelho'][$a]['higCombusCOAmbiente']);
            $Aparelhos[$i]['Tempo'] = ($body[$i]['aparelho'][$a]['higCombusTempoMin'] == "null" || $body[$i]['aparelho'][$a]['higCombusTempoMin'] == "" ? NULL : $body[$i]['aparelho'][$a]['higCombusTempoMin']);
            $Aparelhos[$i]['Analisador'] = ($body[$i]['aparelho'][$a]['analizador'] == "null" || $body[$i]['aparelho'][$a]['analizador'] == "" ? NULL : $body[$i]['aparelho'][$a]['analizador']);
            $Aparelhos[$i]['NumeroDeSerie'] = ($body[$i]['aparelho'][$a]['numSerie'] == "null" || $body[$i]['aparelho'][$a]['numSerie'] == "" ? NULL : $body[$i]['aparelho'][$a]['numSerie']);
            $Aparelhos[$i]['Aparelho'] = ($body[$i]['aparelho'][$a]['aparelho'] == "null" || $body[$i]['aparelho'][$a]['aparelho'] == "" ? NULL : intval($body[$i]['aparelho'][$a]['aparelho']));
            $Aparelhos[$i]['Local'] = ($body[$i]['aparelho'][$a]['local'] == "null" || $body[$i]['aparelho'][$a]['local'] == "" ? NULL : $body[$i]['aparelho'][$a]['local']);
            //FALTANDO O LOCAL DO APARELHO. VERIFICAR ONDE DEVO BUSCAR ESSE DADO
            $Create->ExeCreate("[60_TesteAparelho]", $Aparelhos[$i]);        
        } 

        //SALVANDO TERMO DE RESPONSABILIDADE
        ($body[$i]['termoResponsabilidade']['spnVentSup1'] == "null" || $body[$i]['termoResponsabilidade']['spnVentSup1'] == "") && 
        ($body[$i]['termoResponsabilidade']['spnVentSup2'] == "null" || $body[$i]['termoResponsabilidade']['spnVentSup2'] == "") &&
        ($body[$i]['termoResponsabilidade']['spnVentSup3'] == "null" || $body[$i]['termoResponsabilidade']['spnVentSup3'] == "") &&
        ($body[$i]['termoResponsabilidade']['edtVentSup1'] == "null" || $body[$i]['termoResponsabilidade']['edtVentSup1'] == "") && 
        ($body[$i]['termoResponsabilidade']['edtVentSup2'] == "null" || $body[$i]['termoResponsabilidade']['edtVentSup2'] == "") &&
        ($body[$i]['termoResponsabilidade']['edtVentSup3'] == "null" || $body[$i]['termoResponsabilidade']['edtVentSup3'] == "") ? "" : 
        $termoResponsabilidade[1] = [
                                    'IdOs'=> intval($body[$i]['idAtendimento']), 
                                    'Situacao' => "Ventilação permanente superior", 
                                    'Local1' => ($body[$i]['termoResponsabilidade']['spnVentSup1'] == "null" || $body[$i]['termoResponsabilidade']['spnVentSup1'] == "" ? $body[$i]['termoResponsabilidade']['edtVentSup1']: $body[$i]['termoResponsabilidade']['spnVentSup1']), 
                                    'Local2' =>  ($body[$i]['termoResponsabilidade']['spnVentSup2'] == "null" || $body[$i]['termoResponsabilidade']['spnVentSup2'] == "" ? $body[$i]['termoResponsabilidade']['edtVentSup2'] : $body[$i]['termoResponsabilidade']['spnVentSup2']), 
                                    'Local3' =>  ($body[$i]['termoResponsabilidade']['spnVentSup3'] == "null" || $body[$i]['termoResponsabilidade']['spnVentSup3'] == "" ? $body[$i]['termoResponsabilidade']['edtVentSup3'] : $body[$i]['termoResponsabilidade']['spnVentSup3'])
                                ];
        ($body[$i]['termoResponsabilidade']['spnVentInf1'] == "null" || $body[$i]['termoResponsabilidade']['spnVentInf1'] == "") && 
        ($body[$i]['termoResponsabilidade']['spnVentInf2'] == "null" || $body[$i]['termoResponsabilidade']['spnVentInf2'] == "") &&
        ($body[$i]['termoResponsabilidade']['spnVentInf3'] == "null" || $body[$i]['termoResponsabilidade']['spnVentInf3'] == "") &&
        ($body[$i]['termoResponsabilidade']['edtVentInf1'] == "null" || $body[$i]['termoResponsabilidade']['edtVentInf1'] == "") && 
        ($body[$i]['termoResponsabilidade']['edtVentInf2'] == "null" || $body[$i]['termoResponsabilidade']['edtVentInf2'] == "") &&
        ($body[$i]['termoResponsabilidade']['edtVentInf3'] == "null" || $body[$i]['termoResponsabilidade']['edtVentInf3'] == "") ? "" : 
        $termoResponsabilidade[2] = [
                                    'IdOs'=> intval($body[$i]['idAtendimento']), 
                                    'Situacao' => "Ventilação permanente inferior", 
                                    'Local1' => ($body[$i]['termoResponsabilidade']['spnVentInf1'] == "null" || $body[$i]['termoResponsabilidade']['spnVentInf1'] == "" ? $body[$i]['termoResponsabilidade']['edtVentInf1'] : $body[$i]['termoResponsabilidade']['spnVentInf1']), 
                                    'Local2' =>  ($body[$i]['termoResponsabilidade']['spnVentInf2'] == "null" || $body[$i]['termoResponsabilidade']['spnVentInf2'] == "" ? $body[$i]['termoResponsabilidade']['edtVentInf2'] : $body[$i]['termoResponsabilidade']['spnVentInf2']), 
                                    'Local3' =>  ($body[$i]['termoResponsabilidade']['spnVentInf3'] == "null" || $body[$i]['termoResponsabilidade']['spnVentInf3'] == "" ? $body[$i]['termoResponsabilidade']['edtVentInf3'] : $body[$i]['termoResponsabilidade']['spnVentInf3'])];        
        ($body[$i]['termoResponsabilidade']['spnRegApar1'] == "null" || $body[$i]['termoResponsabilidade']['spnRegApar1'] == "") && 
        ($body[$i]['termoResponsabilidade']['spnRegApar2'] == "null" || $body[$i]['termoResponsabilidade']['spnRegApar2'] == "") &&
        ($body[$i]['termoResponsabilidade']['spnRegApar3'] == "null" || $body[$i]['termoResponsabilidade']['spnRegApar3'] == "") &&
        ($body[$i]['termoResponsabilidade']['edtRegApar1'] == "null" || $body[$i]['termoResponsabilidade']['edtRegApar1'] == "") && 
        ($body[$i]['termoResponsabilidade']['edtRegApar2'] == "null" || $body[$i]['termoResponsabilidade']['edtRegApar2'] == "") &&
        ($body[$i]['termoResponsabilidade']['edtRegApar3'] == "null" || $body[$i]['termoResponsabilidade']['edtRegApar3'] == "") ? "" : 
        $termoResponsabilidade[3] = [
                                    'IdOs'=> intval($body[$i]['idAtendimento']), 
                                    'Situacao' => "Ventilação permanente inferior", 
                                    'Local1' => ($body[$i]['termoResponsabilidade']['spnRegApar1'] == "null" || $body[$i]['termoResponsabilidade']['spnRegApar1'] == "" ? $body[$i]['termoResponsabilidade']['edtRegApar1'] : $body[$i]['termoResponsabilidade']['spnRegApar1']), 
                                    'Local2' =>  ($body[$i]['termoResponsabilidade']['spnRegApar2'] == "null" || $body[$i]['termoResponsabilidade']['spnRegApar2'] == "" ? $body[$i]['termoResponsabilidade']['edtRegApar2'] : $body[$i]['termoResponsabilidade']['spnRegApar2']), 
                                    'Local3' =>  ($body[$i]['termoResponsabilidade']['spnRegApar3'] == "null" || $body[$i]['termoResponsabilidade']['spnRegApar3'] == "" ? $body[$i]['termoResponsabilidade']['edtRegApar3'] : $body[$i]['termoResponsabilidade']['spnRegApar3'])];             
        ($body[$i]['termoResponsabilidade']['spnChamAdeq1'] == "null" || $body[$i]['termoResponsabilidade']['spnChamAdeq1'] == "") && 
        ($body[$i]['termoResponsabilidade']['spnChamAdeq2'] == "null" || $body[$i]['termoResponsabilidade']['spnChamAdeq2'] == "") &&
        ($body[$i]['termoResponsabilidade']['spnChamAdeq3'] == "null" || $body[$i]['termoResponsabilidade']['spnChamAdeq3'] == "") &&
        ($body[$i]['termoResponsabilidade']['edtChamAdeq1'] == "null" || $body[$i]['termoResponsabilidade']['edtChamAdeq1'] == "") && 
        ($body[$i]['termoResponsabilidade']['edtChamAdeq2'] == "null" || $body[$i]['termoResponsabilidade']['edtChamAdeq2'] == "") &&
        ($body[$i]['termoResponsabilidade']['edtChamAdeq3'] == "null" || $body[$i]['termoResponsabilidade']['edtChamAdeq3'] == "") ? "" : 
        $termoResponsabilidade[4] = [
                                    'IdOs'=> intval($body[$i]['idAtendimento']), 
                                    'Situacao' => "Ventilação permanente inferior", 
                                    'Local1' => ($body[$i]['termoResponsabilidade']['spnChamAdeq1'] == "null" || $body[$i]['termoResponsabilidade']['spnChamAdeq1'] == "" ? $body[$i]['termoResponsabilidade']['edtChamAdeq1'] : $body[$i]['termoResponsabilidade']['spnChamAdeq1']), 
                                    'Local2' =>  ($body[$i]['termoResponsabilidade']['spnChamAdeq2'] == "null" || $body[$i]['termoResponsabilidade']['spnChamAdeq2'] == "" ? $body[$i]['termoResponsabilidade']['edtChamAdeq2'] : $body[$i]['termoResponsabilidade']['spnChamAdeq2']), 
                                    'Local3' =>  ($body[$i]['termoResponsabilidade']['spnChamAdeq3'] == "null" || $body[$i]['termoResponsabilidade']['spnChamAdeq3'] == "" ? $body[$i]['termoResponsabilidade']['edtChamAdeq3'] : $body[$i]['termoResponsabilidade']['spnChamAdeq3'])];
        ($body[$i]['termoResponsabilidade']['spnTuboFlex1'] == "null" || $body[$i]['termoResponsabilidade']['spnTuboFlex1'] == "") && 
        ($body[$i]['termoResponsabilidade']['spnTuboFlex2'] == "null" || $body[$i]['termoResponsabilidade']['spnTuboFlex2'] == "") &&
        ($body[$i]['termoResponsabilidade']['spnTuboFlex3'] == "null" || $body[$i]['termoResponsabilidade']['spnTuboFlex3'] == "") &&
        ($body[$i]['termoResponsabilidade']['edtTuboFlex1'] == "null" || $body[$i]['termoResponsabilidade']['edtTuboFlex1'] == "") && 
        ($body[$i]['termoResponsabilidade']['edtTuboFlex2'] == "null" || $body[$i]['termoResponsabilidade']['edtTuboFlex2'] == "") &&
        ($body[$i]['termoResponsabilidade']['edtTuboFlex3'] == "null" || $body[$i]['termoResponsabilidade']['edtTuboFlex3'] == "") ? "" : 
        $termoResponsabilidade[5] = [
                                    'IdOs'=> intval($body[$i]['idAtendimento']), 
                                    'Situacao' => "Ventilação permanente inferior", 
                                    'Local1' => ($body[$i]['termoResponsabilidade']['spnChamAdeq1'] == "null" || $body[$i]['termoResponsabilidade']['spnChamAdeq1'] == "" ? $body[$i]['termoResponsabilidade']['edtTuboFlex1'] : $body[$i]['termoResponsabilidade']['spnChamAdeq1']), 
                                    'Local2' =>  ($body[$i]['termoResponsabilidade']['spnChamAdeq2'] == "null" || $body[$i]['termoResponsabilidade']['spnChamAdeq2'] == "" ? $body[$i]['termoResponsabilidade']['edtTuboFlex2'] : $body[$i]['termoResponsabilidade']['spnChamAdeq2']), 
                                    'Local3' =>  ($body[$i]['termoResponsabilidade']['spnChamAdeq3'] == "null" || $body[$i]['termoResponsabilidade']['spnChamAdeq3'] == "" ? $body[$i]['termoResponsabilidade']['edtTuboFlex3'] : $body[$i]['termoResponsabilidade']['spnChamAdeq3'])];
        ($body[$i]['termoResponsabilidade']['spnTermCham1'] == "null" || $body[$i]['termoResponsabilidade']['spnTermCham1'] == "") && 
        ($body[$i]['termoResponsabilidade']['spnTermCham2'] == "null" || $body[$i]['termoResponsabilidade']['spnTermCham2'] == "") &&
        ($body[$i]['termoResponsabilidade']['spnTermCham3'] == "null" || $body[$i]['termoResponsabilidade']['spnTermCham3'] == "") &&
        ($body[$i]['termoResponsabilidade']['edtTermCham1'] == "null" || $body[$i]['termoResponsabilidade']['edtTermCham1'] == "") && 
        ($body[$i]['termoResponsabilidade']['edtTermCham2'] == "null" || $body[$i]['termoResponsabilidade']['edtTermCham2'] == "") &&
        ($body[$i]['termoResponsabilidade']['edtTermCham3'] == "null" || $body[$i]['termoResponsabilidade']['edtTermCham3'] == "") ? "" : 
        $termoResponsabilidade[6] = [
                                    'IdOs'=> intval($body[$i]['idAtendimento']), 
                                    'Situacao' => "Ventilação permanente inferior", 
                                    'Local1' => ($body[$i]['termoResponsabilidade']['spnTermCham1'] == "null" || $body[$i]['termoResponsabilidade']['spnTermCham1'] == "" ? $body[$i]['termoResponsabilidade']['edtTermCham1'] : $body[$i]['termoResponsabilidade']['spnTermCham1']), 
                                    'Local2' =>  ($body[$i]['termoResponsabilidade']['spnTermCham2'] == "null" || $body[$i]['termoResponsabilidade']['spnTermCham2'] == "" ? $body[$i]['termoResponsabilidade']['edtTermCham2'] : $body[$i]['termoResponsabilidade']['spnTermCham2']), 
                                    'Local3' =>  ($body[$i]['termoResponsabilidade']['spnTermCham3'] == "null" || $body[$i]['termoResponsabilidade']['spnTermCham3'] == "" ? $body[$i]['termoResponsabilidade']['edtTermCham3'] : $body[$i]['termoResponsabilidade']['spnTermCham3'])];
        ($body[$i]['termoResponsabilidade']['spnAreaAbert1'] == "null" || $body[$i]['termoResponsabilidade']['spnAreaAbert1'] == "") && 
        ($body[$i]['termoResponsabilidade']['spnAreaAbert2'] == "null" || $body[$i]['termoResponsabilidade']['spnAreaAbert2'] == "") &&
        ($body[$i]['termoResponsabilidade']['spnAreaAbert3'] == "null" || $body[$i]['termoResponsabilidade']['spnAreaAbert3'] == "") &&
        ($body[$i]['termoResponsabilidade']['edtAreaAbert1'] == "null" || $body[$i]['termoResponsabilidade']['edtAreaAbert1'] == "") && 
        ($body[$i]['termoResponsabilidade']['edtAreaAbert2'] == "null" || $body[$i]['termoResponsabilidade']['edtAreaAbert2'] == "") &&
        ($body[$i]['termoResponsabilidade']['edtAreaAbert3'] == "null" || $body[$i]['termoResponsabilidade']['edtAreaAbert3'] == "") ? "" : 
        $termoResponsabilidade[7] = [
                                    'IdOs'=> intval($body[$i]['idAtendimento']), 
                                    'Situacao' => "Ventilação permanente inferior", 
                                    'Local1' => ($body[$i]['termoResponsabilidade']['spnAreaAbert1'] == "null" || $body[$i]['termoResponsabilidade']['spnAreaAbert1'] == "" ? $body[$i]['termoResponsabilidade']['edtAreaAbert1'] : $body[$i]['termoResponsabilidade']['spnAreaAbert1']), 
                                    'Local2' =>  ($body[$i]['termoResponsabilidade']['spnAreaAbert2'] == "null" || $body[$i]['termoResponsabilidade']['spnAreaAbert2'] == "" ? $body[$i]['termoResponsabilidade']['edtAreaAbert2'] : $body[$i]['termoResponsabilidade']['spnAreaAbert2']), 
                                    'Local3' =>  ($body[$i]['termoResponsabilidade']['spnAreaAbert3'] == "null" || $body[$i]['termoResponsabilidade']['spnAreaAbert3'] == "" ? $body[$i]['termoResponsabilidade']['edtAreaAbert3'] : $body[$i]['termoResponsabilidade']['spnAreaAbert3'])];
        ($body[$i]['termoResponsabilidade']['spnOutros1'] == "null" || $body[$i]['termoResponsabilidade']['spnOutros1'] == "") && 
        ($body[$i]['termoResponsabilidade']['spnOutros2'] == "null" || $body[$i]['termoResponsabilidade']['spnOutros2'] == "") &&
        ($body[$i]['termoResponsabilidade']['spnOutros3'] == "null" || $body[$i]['termoResponsabilidade']['spnOutros3'] == "") &&
        ($body[$i]['termoResponsabilidade']['edtOutros1'] == "null" || $body[$i]['termoResponsabilidade']['edtOutros1'] == "") && 
        ($body[$i]['termoResponsabilidade']['edtOutros2'] == "null" || $body[$i]['termoResponsabilidade']['edtOutros2'] == "") &&
        ($body[$i]['termoResponsabilidade']['edtOutros3'] == "null" || $body[$i]['termoResponsabilidade']['edtOutros3'] == "") ? "" : 
        $termoResponsabilidade[8] = [
                                    'IdOs'=> intval($body[$i]['idAtendimento']), 
                                    'Situacao' => "Ventilação permanente inferior", 
                                    'Local1' => ($body[$i]['termoResponsabilidade']['spnOutros1'] == "null" || $body[$i]['termoResponsabilidade']['spnOutros1'] == "" ? $body[$i]['termoResponsabilidade']['edtOutros1'] : $body[$i]['termoResponsabilidade']['spnOutros1']), 
                                    'Local2' =>  ($body[$i]['termoResponsabilidade']['spnOutros2'] == "null" || $body[$i]['termoResponsabilidade']['spnOutros2'] == "" ? $body[$i]['termoResponsabilidade']['edtOutros2'] : $body[$i]['termoResponsabilidade']['spnOutros2']), 
                                    'Local3' =>  ($body[$i]['termoResponsabilidade']['spnOutros3'] == "null" || $body[$i]['termoResponsabilidade']['spnOutros3'] == "" ? $body[$i]['termoResponsabilidade']['edtOutros3'] : $body[$i]['termoResponsabilidade']['spnOutros3'])];             
        if(isset($termoResponsabilidade)){
            foreach ($termoResponsabilidade as $TERMO) { 
                $Create->ExeCreate("[60_TermosResponsabilidade]", $TERMO);                                                             
            }  
        }     

        //SALVANDO REDE DE DISTRIBUIÇÃO 
        $body[$i]['redeDistribuicao']['redeDeDistribuicao1'] == "null" || $body[$i]['redeDistribuicao']['redeDeDistribuicao1'] == "" ? "" : $RedeDistribuicao[1] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 1, 'InstalacaoInterna' => $body[$i]['redeDistribuicao']['redeDeDistribuicao1']];
        $body[$i]['redeDistribuicao']['redeDeDistribuicao2'] == "null" || $body[$i]['redeDistribuicao']['redeDeDistribuicao2'] == "" ? "" :$RedeDistribuicao[2] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 2, 'InstalacaoInterna' => $body[$i]['redeDistribuicao']['redeDeDistribuicao2']];
        $body[$i]['redeDistribuicao']['redeDeDistribuicao3'] == "null" || $body[$i]['redeDistribuicao']['redeDeDistribuicao3'] == "" ? "" :$RedeDistribuicao[3] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 3, 'InstalacaoInterna' => $body[$i]['redeDistribuicao']['redeDeDistribuicao3']];
        $body[$i]['redeDistribuicao']['redeDeDistribuicao4'] == "null" || $body[$i]['redeDistribuicao']['redeDeDistribuicao4'] == "" ? "" :$RedeDistribuicao[4] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 4, 'InstalacaoInterna' => $body[$i]['redeDistribuicao']['redeDeDistribuicao4']];
        $body[$i]['redeDistribuicao']['redeDeDistribuicao5'] == "null" || $body[$i]['redeDistribuicao']['redeDeDistribuicao5'] == "" ? "" :$RedeDistribuicao[5] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 5, 'InstalacaoInterna' => $body[$i]['redeDistribuicao']['redeDeDistribuicao5']];
        $body[$i]['redeDistribuicao']['redeDeDistribuicao6'] == "null" || $body[$i]['redeDistribuicao']['redeDeDistribuicao6'] == "" ? "" :$RedeDistribuicao[6] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 6, 'InstalacaoInterna' => $body[$i]['redeDistribuicao']['redeDeDistribuicao6']];
        $body[$i]['redeDistribuicao']['redeDeDistribuicao7'] == "null" || $body[$i]['redeDistribuicao']['redeDeDistribuicao7'] == "" ? "" :$RedeDistribuicao[7] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 7, 'InstalacaoInterna' => $body[$i]['redeDistribuicao']['redeDeDistribuicao7']];
        $body[$i]['redeDistribuicao']['redeDeDistribuicao8'] == "null" || $body[$i]['redeDistribuicao']['redeDeDistribuicao8'] == "" ? "" :$RedeDistribuicao[8] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 8, 'InstalacaoInterna' => $body[$i]['redeDistribuicao']['redeDeDistribuicao8']];
        $body[$i]['redeDistribuicao']['redeDeDistribuicao9'] == "null" || $body[$i]['redeDistribuicao']['redeDeDistribuicao9'] == "" ? "" :$RedeDistribuicao[9] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 9, 'InstalacaoInterna' => $body[$i]['redeDistribuicao']['redeDeDistribuicao9']];
        $body[$i]['redeDistribuicao']['redeDeDistribuicao10'] == "null" || $body[$i]['redeDistribuicao']['redeDeDistribuicao10'] == "" ? "" :$RedeDistribuicao[10] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 10, 'InstalacaoInterna' => $body[$i]['redeDistribuicao']['redeDeDistribuicao10']];
        $body[$i]['redeDistribuicao']['redeDeDistribuicao11'] == "null" || $body[$i]['redeDistribuicao']['redeDeDistribuicao11'] == "" ? "" :$RedeDistribuicao[11] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 11, 'InstalacaoInterna' => $body[$i]['redeDistribuicao']['redeDeDistribuicao11']];
        $body[$i]['redeDistribuicao']['redeDeDistribuicao12'] == "null" || $body[$i]['redeDistribuicao']['redeDeDistribuicao12'] == "" ? "" :$RedeDistribuicao[12] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 12, 'InstalacaoInterna' => $body[$i]['redeDistribuicao']['redeDeDistribuicao12']];
        $body[$i]['redeDistribuicao']['redeDeDistribuicao13'] == "null" || $body[$i]['redeDistribuicao']['redeDeDistribuicao13'] == "" ? "" :$RedeDistribuicao[13] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 13, 'InstalacaoInterna' => $body[$i]['redeDistribuicao']['redeDeDistribuicao13']];
        $body[$i]['redeDistribuicao']['redeDeDistribuicao14'] == "null" || $body[$i]['redeDistribuicao']['redeDeDistribuicao14'] == "" ? "" :$RedeDistribuicao[14] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 14, 'InstalacaoInterna' => $body[$i]['redeDistribuicao']['redeDeDistribuicao14']];
        $body[$i]['redeDistribuicao']['redeDeDistribuicao15'] == "null" || $body[$i]['redeDistribuicao']['redeDeDistribuicao15'] == "" ? "" :$RedeDistribuicao[15] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 15, 'InstalacaoInterna' => $body[$i]['redeDistribuicao']['redeDeDistribuicao15']];
        $body[$i]['redeDistribuicao']['redeDeDistribuicao16'] == "null" || $body[$i]['redeDistribuicao']['redeDeDistribuicao16'] == "" ? "" :$RedeDistribuicao[16] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 16, 'InstalacaoInterna' => $body[$i]['redeDistribuicao']['redeDeDistribuicao16']];
        $body[$i]['redeDistribuicao']['redeDeDistribuicao17'] == "null" || $body[$i]['redeDistribuicao']['redeDeDistribuicao17'] == "" ? "" :$RedeDistribuicao[17] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 17, 'InstalacaoInterna' => $body[$i]['redeDistribuicao']['redeDeDistribuicao17']];
        $body[$i]['redeDistribuicao']['redeDeDistribuicao18'] == "null" || $body[$i]['redeDistribuicao']['redeDeDistribuicao18'] == "" ? "" :$RedeDistribuicao[18] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 18, 'InstalacaoInterna' => $body[$i]['redeDistribuicao']['redeDeDistribuicao18']];
        $body[$i]['redeDistribuicao']['redeDeDistribuicao19'] == "null" || $body[$i]['redeDistribuicao']['redeDeDistribuicao19'] == "" ? "" :$RedeDistribuicao[19] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 19, 'InstalacaoInterna' => $body[$i]['redeDistribuicao']['redeDeDistribuicao19']];
        $body[$i]['redeDistribuicao']['redeDeDistribuicao20'] == "null" || $body[$i]['redeDistribuicao']['redeDeDistribuicao20'] == "" ? "" :$RedeDistribuicao[20] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 20, 'InstalacaoInterna' => $body[$i]['redeDistribuicao']['redeDeDistribuicao20']];
        $body[$i]['redeDistribuicao']['redeDeDistribuicao21'] == "null" || $body[$i]['redeDistribuicao']['redeDeDistribuicao21'] == "" ? "" :$RedeDistribuicao[21] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 21, 'InstalacaoInterna' => $body[$i]['redeDistribuicao']['redeDeDistribuicao21']];
        $body[$i]['redeDistribuicao']['redeDeDistribuicao22'] == "null" || $body[$i]['redeDistribuicao']['redeDeDistribuicao22'] == "" ? "" :$RedeDistribuicao[22] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 22, 'InstalacaoInterna' => $body[$i]['redeDistribuicao']['redeDeDistribuicao22']];
        $body[$i]['redeDistribuicao']['redeDeDistribuicao23'] == "null" || $body[$i]['redeDistribuicao']['redeDeDistribuicao23'] == "" ? "" :$RedeDistribuicao[23] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 23, 'InstalacaoInterna' => $body[$i]['redeDistribuicao']['redeDeDistribuicao23']];
        if(isset($RedeDistribuicao)){
            foreach ($RedeDistribuicao as $REDE) { 
                $Create->ExeCreate("[60_Defeitos]", $REDE);                                                             
            }  
        }             
               

        //SALVANDO APARELHO A GAS
        ($body[$i]['aparelhoGas']['aparelhoGas24Aparelho1'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas24Aparelho1'] == "") && 
        ($body[$i]['aparelhoGas']['aparelhoGas24Aparelho2'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas24Aparelho2'] == "") &&
        ($body[$i]['aparelhoGas']['aparelhoGas24Aparelho3'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas24Aparelho3'] == "") ? "" : 
        $AparelhoGas[1] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 24, 'Aparelho1' => $body[$i]['aparelhoGas']['aparelhoGas24Aparelho1'], 'Aparelho2' => $body[$i]['aparelhoGas']['aparelhoGas24Aparelho2'], 'Aparelho3' => $body[$i]['aparelhoGas']['aparelhoGas24Aparelho3']];
        ($body[$i]['aparelhoGas']['aparelhoGas25Aparelho1'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas25Aparelho1'] == "") && 
        ($body[$i]['aparelhoGas']['aparelhoGas25Aparelho2'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas25Aparelho2'] == "") &&
        ($body[$i]['aparelhoGas']['aparelhoGas25Aparelho3'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas25Aparelho3'] == "") ? "" : 
        $AparelhoGas[2] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 25, 'Aparelho1' => $body[$i]['aparelhoGas']['aparelhoGas25Aparelho1'], 'Aparelho2' => $body[$i]['aparelhoGas']['aparelhoGas25Aparelho2'], 'Aparelho3' => $body[$i]['aparelhoGas']['aparelhoGas25Aparelho3']];
        ($body[$i]['aparelhoGas']['aparelhoGas26Aparelho1'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas26Aparelho1'] == "") && 
        ($body[$i]['aparelhoGas']['aparelhoGas26Aparelho2'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas26Aparelho2'] == "") &&
        ($body[$i]['aparelhoGas']['aparelhoGas26Aparelho3'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas26Aparelho3'] == "") ? "" : 
        $AparelhoGas[3] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 26, 'Aparelho1' => $body[$i]['aparelhoGas']['aparelhoGas26Aparelho1'], 'Aparelho2' => $body[$i]['aparelhoGas']['aparelhoGas26Aparelho2'], 'Aparelho3' => $body[$i]['aparelhoGas']['aparelhoGas26Aparelho3']];
        ($body[$i]['aparelhoGas']['aparelhoGas27Aparelho1'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas27Aparelho1'] == "") && 
        ($body[$i]['aparelhoGas']['aparelhoGas27Aparelho2'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas27Aparelho2'] == "") &&
        ($body[$i]['aparelhoGas']['aparelhoGas27Aparelho3'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas27Aparelho3'] == "") ? "" : 
        $AparelhoGas[4] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 27, 'Aparelho1' => $body[$i]['aparelhoGas']['aparelhoGas27Aparelho1'], 'Aparelho2' => $body[$i]['aparelhoGas']['aparelhoGas27Aparelho2'], 'Aparelho3' => $body[$i]['aparelhoGas']['aparelhoGas27Aparelho3']];
        ($body[$i]['aparelhoGas']['aparelhoGas28Aparelho1'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas28Aparelho1'] == "") && 
        ($body[$i]['aparelhoGas']['aparelhoGas28Aparelho2'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas28Aparelho2'] == "") &&
        ($body[$i]['aparelhoGas']['aparelhoGas28Aparelho3'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas28Aparelho3'] == "") ? "" : 
        $AparelhoGas[5] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 28, 'Aparelho1' => $body[$i]['aparelhoGas']['aparelhoGas28Aparelho1'], 'Aparelho2' => $body[$i]['aparelhoGas']['aparelhoGas28Aparelho2'], 'Aparelho3' => $body[$i]['aparelhoGas']['aparelhoGas28Aparelho3']];
        ($body[$i]['aparelhoGas']['aparelhoGas29Aparelho1'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas29Aparelho1'] == "") && 
        ($body[$i]['aparelhoGas']['aparelhoGas29Aparelho2'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas29Aparelho2'] == "") &&
        ($body[$i]['aparelhoGas']['aparelhoGas29Aparelho3'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas29Aparelho3'] == "") ? "" : 
        $AparelhoGas[6] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 29, 'Aparelho1' => $body[$i]['aparelhoGas']['aparelhoGas29Aparelho1'], 'Aparelho2' => $body[$i]['aparelhoGas']['aparelhoGas29Aparelho2'], 'Aparelho3' => $body[$i]['aparelhoGas']['aparelhoGas29Aparelho3']];
        ($body[$i]['aparelhoGas']['aparelhoGas30Aparelho1'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas30Aparelho1'] == "") && 
        ($body[$i]['aparelhoGas']['aparelhoGas30Aparelho2'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas30Aparelho2'] == "") &&
        ($body[$i]['aparelhoGas']['aparelhoGas30Aparelho3'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas30Aparelho3'] == "") ? "" : 
        $AparelhoGas[7] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 30, 'Aparelho1' => $body[$i]['aparelhoGas']['aparelhoGas30Aparelho1'], 'Aparelho2' => $body[$i]['aparelhoGas']['aparelhoGas30Aparelho2'], 'Aparelho3' => $body[$i]['aparelhoGas']['aparelhoGas30Aparelho3']];
        ($body[$i]['aparelhoGas']['aparelhoGas31Aparelho1'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas31Aparelho1'] == "") && 
        ($body[$i]['aparelhoGas']['aparelhoGas31Aparelho2'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas31Aparelho2'] == "") &&
        ($body[$i]['aparelhoGas']['aparelhoGas31Aparelho3'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas31Aparelho3'] == "") ? "" : 
        $AparelhoGas[8] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 31, 'Aparelho1' => $body[$i]['aparelhoGas']['aparelhoGas31Aparelho1'], 'Aparelho2' => $body[$i]['aparelhoGas']['aparelhoGas31Aparelho2'], 'Aparelho3' => $body[$i]['aparelhoGas']['aparelhoGas31Aparelho3']];
        ($body[$i]['aparelhoGas']['aparelhoGas32Aparelho1'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas32Aparelho1'] == "") && 
        ($body[$i]['aparelhoGas']['aparelhoGas32Aparelho2'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas32Aparelho2'] == "") &&
        ($body[$i]['aparelhoGas']['aparelhoGas32Aparelho3'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas32Aparelho3'] == "") ? "" : 
        $AparelhoGas[9] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 32, 'Aparelho1' => $body[$i]['aparelhoGas']['aparelhoGas32Aparelho1'], 'Aparelho2' => $body[$i]['aparelhoGas']['aparelhoGas32Aparelho2'], 'Aparelho3' => $body[$i]['aparelhoGas']['aparelhoGas32Aparelho3']];
        ($body[$i]['aparelhoGas']['aparelhoGas33Aparelho1'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas33Aparelho1'] == "") && 
        ($body[$i]['aparelhoGas']['aparelhoGas33Aparelho2'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas33Aparelho2'] == "") &&
        ($body[$i]['aparelhoGas']['aparelhoGas33Aparelho3'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas33Aparelho3'] == "") ? "" : 
        $AparelhoGas[10] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 33, 'Aparelho1' => $body[$i]['aparelhoGas']['aparelhoGas33Aparelho1'], 'Aparelho2' => $body[$i]['aparelhoGas']['aparelhoGas33Aparelho2'], 'Aparelho3' => $body[$i]['aparelhoGas']['aparelhoGas33Aparelho3']];
        ($body[$i]['aparelhoGas']['aparelhoGas34Aparelho1'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas34Aparelho1'] == "") && 
        ($body[$i]['aparelhoGas']['aparelhoGas34Aparelho2'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas34Aparelho2'] == "") &&
        ($body[$i]['aparelhoGas']['aparelhoGas34Aparelho3'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas34Aparelho3'] == "") ? "" : 
        $AparelhoGas[11] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 34, 'Aparelho1' => $body[$i]['aparelhoGas']['aparelhoGas34Aparelho1'], 'Aparelho2' => $body[$i]['aparelhoGas']['aparelhoGas34Aparelho2'], 'Aparelho3' => $body[$i]['aparelhoGas']['aparelhoGas34Aparelho3']];
        ($body[$i]['aparelhoGas']['aparelhoGas35Aparelho1'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas35Aparelho1'] == "") && 
        ($body[$i]['aparelhoGas']['aparelhoGas35Aparelho2'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas35Aparelho2'] == "") &&
        ($body[$i]['aparelhoGas']['aparelhoGas35Aparelho3'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas35Aparelho3'] == "") ? "" : 
        $AparelhoGas[12] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 35, 'Aparelho1' => $body[$i]['aparelhoGas']['aparelhoGas35Aparelho1'], 'Aparelho2' => $body[$i]['aparelhoGas']['aparelhoGas35Aparelho2'], 'Aparelho3' => $body[$i]['aparelhoGas']['aparelhoGas35Aparelho3']];
        ($body[$i]['aparelhoGas']['aparelhoGas36Aparelho1'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas36Aparelho1'] == "") && 
        ($body[$i]['aparelhoGas']['aparelhoGas36Aparelho2'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas36Aparelho2'] == "") &&
        ($body[$i]['aparelhoGas']['aparelhoGas36Aparelho3'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas36Aparelho3'] == "") ? "" : 
        $AparelhoGas[13] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 36, 'Aparelho1' => $body[$i]['aparelhoGas']['aparelhoGas36Aparelho1'], 'Aparelho2' => $body[$i]['aparelhoGas']['aparelhoGas36Aparelho2'], 'Aparelho3' => $body[$i]['aparelhoGas']['aparelhoGas36Aparelho3']];
        ($body[$i]['aparelhoGas']['aparelhoGas37Aparelho1'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas37Aparelho1'] == "") && 
        ($body[$i]['aparelhoGas']['aparelhoGas37Aparelho2'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas37Aparelho2'] == "") &&
        ($body[$i]['aparelhoGas']['aparelhoGas37Aparelho3'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas37Aparelho3'] == "") ? "" : 
        $AparelhoGas[14] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 37, 'Aparelho1' => $body[$i]['aparelhoGas']['aparelhoGas37Aparelho1'], 'Aparelho2' => $body[$i]['aparelhoGas']['aparelhoGas37Aparelho2'], 'Aparelho3' => $body[$i]['aparelhoGas']['aparelhoGas37Aparelho3']];
        ($body[$i]['aparelhoGas']['aparelhoGas38Aparelho1'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas38Aparelho1'] == "") && 
        ($body[$i]['aparelhoGas']['aparelhoGas38Aparelho2'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas38Aparelho2'] == "") &&
        ($body[$i]['aparelhoGas']['aparelhoGas38Aparelho3'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas38Aparelho3'] == "") ? "" : 
        $AparelhoGas[15] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 38, 'Aparelho1' => $body[$i]['aparelhoGas']['aparelhoGas38Aparelho1'], 'Aparelho2' => $body[$i]['aparelhoGas']['aparelhoGas38Aparelho2'], 'Aparelho3' => $body[$i]['aparelhoGas']['aparelhoGas38Aparelho3']];
        ($body[$i]['aparelhoGas']['aparelhoGas39Aparelho1'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas39Aparelho1'] == "") && 
        ($body[$i]['aparelhoGas']['aparelhoGas39Aparelho2'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas39Aparelho2'] == "") &&
        ($body[$i]['aparelhoGas']['aparelhoGas39Aparelho3'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas39Aparelho3'] == "") ? "" : 
        $AparelhoGas[16] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 39, 'Aparelho1' => $body[$i]['aparelhoGas']['aparelhoGas39Aparelho1'], 'Aparelho2' => $body[$i]['aparelhoGas']['aparelhoGas39Aparelho2'], 'Aparelho3' => $body[$i]['aparelhoGas']['aparelhoGas39Aparelho3']];
        ($body[$i]['aparelhoGas']['aparelhoGas40Aparelho1'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas40Aparelho1'] == "") && 
        ($body[$i]['aparelhoGas']['aparelhoGas40Aparelho2'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas40Aparelho2'] == "") &&
        ($body[$i]['aparelhoGas']['aparelhoGas40Aparelho3'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas40Aparelho3'] == "") ? "" : 
        $AparelhoGas[17] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 40, 'Aparelho1' => $body[$i]['aparelhoGas']['aparelhoGas40Aparelho1'], 'Aparelho2' => $body[$i]['aparelhoGas']['aparelhoGas40Aparelho2'], 'Aparelho3' => $body[$i]['aparelhoGas']['aparelhoGas40Aparelho3']];
        ($body[$i]['aparelhoGas']['aparelhoGas41Aparelho1'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas41Aparelho1'] == "") && 
        ($body[$i]['aparelhoGas']['aparelhoGas41Aparelho2'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas41Aparelho2'] == "") &&
        ($body[$i]['aparelhoGas']['aparelhoGas41Aparelho3'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas41Aparelho3'] == "") ? "" : 
        $AparelhoGas[18] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 41, 'Aparelho1' => $body[$i]['aparelhoGas']['aparelhoGas41Aparelho1'], 'Aparelho2' => $body[$i]['aparelhoGas']['aparelhoGas41Aparelho2'], 'Aparelho3' => $body[$i]['aparelhoGas']['aparelhoGas41Aparelho3']];
        ($body[$i]['aparelhoGas']['aparelhoGas42Aparelho1'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas42Aparelho1'] == "") && 
        ($body[$i]['aparelhoGas']['aparelhoGas42Aparelho2'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas42Aparelho2'] == "") &&
        ($body[$i]['aparelhoGas']['aparelhoGas42Aparelho3'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas42Aparelho3'] == "") ? "" : 
        $AparelhoGas[19] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 42, 'Aparelho1' => $body[$i]['aparelhoGas']['aparelhoGas42Aparelho1'], 'Aparelho2' => $body[$i]['aparelhoGas']['aparelhoGas42Aparelho2'], 'Aparelho3' => $body[$i]['aparelhoGas']['aparelhoGas42Aparelho3']];
        ($body[$i]['aparelhoGas']['aparelhoGas43Aparelho1'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas43Aparelho1'] == "") && 
        ($body[$i]['aparelhoGas']['aparelhoGas43Aparelho2'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas43Aparelho2'] == "") &&
        ($body[$i]['aparelhoGas']['aparelhoGas43Aparelho3'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas43Aparelho3'] == "") ? "" : 
        $AparelhoGas[20] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 43, 'Aparelho1' => $body[$i]['aparelhoGas']['aparelhoGas43Aparelho1'], 'Aparelho2' => $body[$i]['aparelhoGas']['aparelhoGas43Aparelho2'], 'Aparelho3' => $body[$i]['aparelhoGas']['aparelhoGas43Aparelho3']];
        ($body[$i]['aparelhoGas']['aparelhoGas44Aparelho1'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas44Aparelho1'] == "") && 
        ($body[$i]['aparelhoGas']['aparelhoGas44Aparelho2'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas44Aparelho2'] == "") &&
        ($body[$i]['aparelhoGas']['aparelhoGas44Aparelho3'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas44Aparelho3'] == "") ? "" : 
        $AparelhoGas[21] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 44, 'Aparelho1' => $body[$i]['aparelhoGas']['aparelhoGas44Aparelho1'], 'Aparelho2' => $body[$i]['aparelhoGas']['aparelhoGas44Aparelho2'], 'Aparelho3' => $body[$i]['aparelhoGas']['aparelhoGas44Aparelho3']];
        ($body[$i]['aparelhoGas']['aparelhoGas45Aparelho1'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas45Aparelho1'] == "") && 
        ($body[$i]['aparelhoGas']['aparelhoGas45Aparelho2'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas45Aparelho2'] == "") &&
        ($body[$i]['aparelhoGas']['aparelhoGas45Aparelho3'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas45Aparelho3'] == "") ? "" : 
        $AparelhoGas[22] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 45, 'Aparelho1' => $body[$i]['aparelhoGas']['aparelhoGas45Aparelho1'], 'Aparelho2' => $body[$i]['aparelhoGas']['aparelhoGas45Aparelho2'], 'Aparelho3' => $body[$i]['aparelhoGas']['aparelhoGas45Aparelho3']];
        ($body[$i]['aparelhoGas']['aparelhoGas46Aparelho1'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas46Aparelho1'] == "") && 
        ($body[$i]['aparelhoGas']['aparelhoGas46Aparelho2'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas46Aparelho2'] == "") &&
        ($body[$i]['aparelhoGas']['aparelhoGas46Aparelho3'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas46Aparelho3'] == "") ? "" : 
        $AparelhoGas[23] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 46, 'Aparelho1' => $body[$i]['aparelhoGas']['aparelhoGas46Aparelho1'], 'Aparelho2' => $body[$i]['aparelhoGas']['aparelhoGas46Aparelho2'], 'Aparelho3' => $body[$i]['aparelhoGas']['aparelhoGas46Aparelho3']];
        ($body[$i]['aparelhoGas']['aparelhoGas47Aparelho1'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas47Aparelho1'] == "") && 
        ($body[$i]['aparelhoGas']['aparelhoGas47Aparelho2'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas47Aparelho2'] == "") &&
        ($body[$i]['aparelhoGas']['aparelhoGas47Aparelho3'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas47Aparelho3'] == "") ? "" : 
        $AparelhoGas[24] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 47, 'Aparelho1' => $body[$i]['aparelhoGas']['aparelhoGas47Aparelho1'], 'Aparelho2' => $body[$i]['aparelhoGas']['aparelhoGas47Aparelho2'], 'Aparelho3' => $body[$i]['aparelhoGas']['aparelhoGas47Aparelho3']];
        ($body[$i]['aparelhoGas']['aparelhoGas48Aparelho1'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas48Aparelho1'] == "") && 
        ($body[$i]['aparelhoGas']['aparelhoGas48Aparelho2'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas48Aparelho2'] == "") &&
        ($body[$i]['aparelhoGas']['aparelhoGas48Aparelho3'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas48Aparelho3'] == "") ? "" : 
        $AparelhoGas[25] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 48, 'Aparelho1' => $body[$i]['aparelhoGas']['aparelhoGas48Aparelho1'], 'Aparelho2' => $body[$i]['aparelhoGas']['aparelhoGas48Aparelho2'], 'Aparelho3' => $body[$i]['aparelhoGas']['aparelhoGas48Aparelho3']];
        ($body[$i]['aparelhoGas']['aparelhoGas49Aparelho1'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas49Aparelho1'] == "") && 
        ($body[$i]['aparelhoGas']['aparelhoGas49Aparelho2'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas49Aparelho2'] == "") &&
        ($body[$i]['aparelhoGas']['aparelhoGas49Aparelho3'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas49Aparelho3'] == "") ? "" : 
        $AparelhoGas[26] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 49, 'Aparelho1' => $body[$i]['aparelhoGas']['aparelhoGas49Aparelho1'], 'Aparelho2' => $body[$i]['aparelhoGas']['aparelhoGas49Aparelho2'], 'Aparelho3' => $body[$i]['aparelhoGas']['aparelhoGas49Aparelho3']];
        ($body[$i]['aparelhoGas']['aparelhoGas50Aparelho1'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas50Aparelho1'] == "") && 
        ($body[$i]['aparelhoGas']['aparelhoGas50Aparelho2'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas50Aparelho2'] == "") &&
        ($body[$i]['aparelhoGas']['aparelhoGas50Aparelho3'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas50Aparelho3'] == "") ? "" : 
        $AparelhoGas[27] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 50, 'Aparelho1' => $body[$i]['aparelhoGas']['aparelhoGas50Aparelho1'], 'Aparelho2' => $body[$i]['aparelhoGas']['aparelhoGas50Aparelho2'], 'Aparelho3' => $body[$i]['aparelhoGas']['aparelhoGas50Aparelho3']];
        ($body[$i]['aparelhoGas']['aparelhoGas51Aparelho1'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas51Aparelho1'] == "") && 
        ($body[$i]['aparelhoGas']['aparelhoGas51Aparelho2'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas51Aparelho2'] == "") &&
        ($body[$i]['aparelhoGas']['aparelhoGas51Aparelho3'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas51Aparelho3'] == "") ? "" : 
        $AparelhoGas[28] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 51, 'Aparelho1' => $body[$i]['aparelhoGas']['aparelhoGas51Aparelho1'], 'Aparelho2' => $body[$i]['aparelhoGas']['aparelhoGas51Aparelho2'], 'Aparelho3' => $body[$i]['aparelhoGas']['aparelhoGas51Aparelho3']];
        ($body[$i]['aparelhoGas']['aparelhoGas52Aparelho1'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas52Aparelho1'] == "") && 
        ($body[$i]['aparelhoGas']['aparelhoGas52Aparelho2'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas52Aparelho2'] == "") &&
        ($body[$i]['aparelhoGas']['aparelhoGas52Aparelho3'] == "null" || $body[$i]['aparelhoGas']['aparelhoGas52Aparelho3'] == "") ? "" : 
        $AparelhoGas[29] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 52, 'Aparelho1' => $body[$i]['aparelhoGas']['aparelhoGas52Aparelho1'], 'Aparelho2' => $body[$i]['aparelhoGas']['aparelhoGas52Aparelho2'], 'Aparelho3' => $body[$i]['aparelhoGas']['aparelhoGas52Aparelho3']];
        if(isset($AparelhoGas)){
            foreach ($AparelhoGas as $APGAS) { 
                $Create->ExeCreate("[60_Defeitos]", $APGAS);                                                             
            }  
        } 

        //SALVANDO LIGAÇÃO APARELHO GAS
        ($body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas53Aparelho1'] == "null" || $body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas53Aparelho1'] == "") && 
        ($body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas53Aparelho2'] == "null" || $body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas53Aparelho2'] == "") &&
        ($body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas53Aparelho3'] == "null" || $body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas53Aparelho3'] == "") ? "" : 
        $LigAparelhoGas[1] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 53, 'Aparelho1' => $body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas53Aparelho1'], 'Aparelho2' => $body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas53Aparelho2'], 'Aparelho3' => $body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas53Aparelho3']];
        ($body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas54Aparelho1'] == "null" || $body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas54Aparelho1'] == "") && 
        ($body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas54Aparelho2'] == "null" || $body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas54Aparelho2'] == "") &&
        ($body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas54Aparelho3'] == "null" || $body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas54Aparelho3'] == "") ? "" : 
        $LigAparelhoGas[2] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 54, 'Aparelho1' => $body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas54Aparelho1'], 'Aparelho2' => $body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas54Aparelho2'], 'Aparelho3' => $body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas54Aparelho3']];
        ($body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas55Aparelho1'] == "null" || $body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas55Aparelho1'] == "") && 
        ($body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas55Aparelho2'] == "null" || $body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas55Aparelho2'] == "") &&
        ($body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas55Aparelho3'] == "null" || $body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas55Aparelho3'] == "") ? "" : 
        $LigAparelhoGas[3] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 55, 'Aparelho1' => $body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas55Aparelho1'], 'Aparelho2' => $body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas55Aparelho2'], 'Aparelho3' => $body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas55Aparelho3']];
        ($body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas56Aparelho1'] == "null" || $body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas56Aparelho1'] == "") && 
        ($body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas56Aparelho2'] == "null" || $body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas56Aparelho2'] == "") &&
        ($body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas56Aparelho3'] == "null" || $body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas56Aparelho3'] == "") ? "" : 
        $LigAparelhoGas[4] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 56, 'Aparelho1' => $body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas56Aparelho1'], 'Aparelho2' => $body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas56Aparelho2'], 'Aparelho3' => $body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas56Aparelho3']];
        ($body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas57Aparelho1'] == "null" || $body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas57Aparelho1'] == "") && 
        ($body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas57Aparelho2'] == "null" || $body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas57Aparelho2'] == "") &&
        ($body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas57Aparelho3'] == "null" || $body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas57Aparelho3'] == "") ? "" : 
        $LigAparelhoGas[5] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 57, 'Aparelho1' => $body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas57Aparelho1'], 'Aparelho2' => $body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas57Aparelho2'], 'Aparelho3' => $body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas57Aparelho3']];
        ($body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas58Aparelho1'] == "null" || $body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas58Aparelho1'] == "") && 
        ($body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas58Aparelho2'] == "null" || $body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas58Aparelho2'] == "") &&
        ($body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas58Aparelho3'] == "null" || $body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas58Aparelho3'] == "") ? "" : 
        $LigAparelhoGas[6] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 58, 'Aparelho1' => $body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas58Aparelho1'], 'Aparelho2' => $body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas58Aparelho2'], 'Aparelho3' => $body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas58Aparelho3']];
        ($body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas59Aparelho1'] == "null" || $body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas59Aparelho1'] == "") && 
        ($body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas59Aparelho2'] == "null" || $body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas59Aparelho2'] == "") &&
        ($body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas59Aparelho3'] == "null" || $body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas59Aparelho3'] == "") ? "" : 
        $LigAparelhoGas[7] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 59, 'Aparelho1' => $body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas59Aparelho1'], 'Aparelho2' => $body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas59Aparelho2'], 'Aparelho3' => $body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas59Aparelho3']];
        ($body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas60Aparelho1'] == "null" || $body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas60Aparelho1'] == "") && 
        ($body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas60Aparelho2'] == "null" || $body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas60Aparelho2'] == "") &&
        ($body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas60Aparelho3'] == "null" || $body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas60Aparelho3'] == "") ? "" : 
        $LigAparelhoGas[8] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 60, 'Aparelho1' => $body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas60Aparelho1'], 'Aparelho2' => $body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas60Aparelho2'], 'Aparelho3' => $body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas60Aparelho3']];
        ($body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas61Aparelho1'] == "null" || $body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas61Aparelho1'] == "") && 
        ($body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas61Aparelho2'] == "null" || $body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas61Aparelho2'] == "") &&
        ($body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas61Aparelho3'] == "null" || $body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas61Aparelho3'] == "") ? "" : 
        $LigAparelhoGas[9] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 61, 'Aparelho1' => $body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas61Aparelho1'], 'Aparelho2' => $body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas61Aparelho2'], 'Aparelho3' => $body[$i]['ligacaoAparelhoGas']['ligacaoAparelhoGas61Aparelho3']];
        if(isset($LigAparelhoGas)){
            foreach ($LigAparelhoGas as $LIGAP) { 
                $Create->ExeCreate("[60_Defeitos]", $LIGAP);                                                             
            }  
        } 

        //SALVANDO INDIVIDUAL NATURAL FORÇADA
        ($body[$i]['individualNaturalForcada']['indviNaturalForcada62Aparelho1'] == "null" || $body[$i]['individualNaturalForcada']['indviNaturalForcada62Aparelho1'] == "") && 
        ($body[$i]['individualNaturalForcada']['indviNaturalForcada62Aparelho2'] == "null" || $body[$i]['individualNaturalForcada']['indviNaturalForcada62Aparelho2'] == "") &&
        ($body[$i]['individualNaturalForcada']['indviNaturalForcada62Aparelho3'] == "null" || $body[$i]['individualNaturalForcada']['indviNaturalForcada62Aparelho3'] == "") ? "" : 
        $IndNatForcada[1] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 62, 'Aparelho1' => $body[$i]['individualNaturalForcada']['indviNaturalForcada62Aparelho1'], 'Aparelho2' => $body[$i]['individualNaturalForcada']['indviNaturalForcada62Aparelho2'], 'Aparelho3' => $body[$i]['individualNaturalForcada']['indviNaturalForcada62Aparelho3']];
        ($body[$i]['individualNaturalForcada']['indviNaturalForcada63Aparelho1'] == "null" || $body[$i]['individualNaturalForcada']['indviNaturalForcada63Aparelho1'] == "") && 
        ($body[$i]['individualNaturalForcada']['indviNaturalForcada63Aparelho2'] == "null" || $body[$i]['individualNaturalForcada']['indviNaturalForcada63Aparelho2'] == "") &&
        ($body[$i]['individualNaturalForcada']['indviNaturalForcada63Aparelho3'] == "null" || $body[$i]['individualNaturalForcada']['indviNaturalForcada63Aparelho3'] == "") ? "" : 
        $IndNatForcada[2] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 63, 'Aparelho1' => $body[$i]['individualNaturalForcada']['indviNaturalForcada63Aparelho1'], 'Aparelho2' => $body[$i]['individualNaturalForcada']['indviNaturalForcada63Aparelho2'], 'Aparelho3' => $body[$i]['individualNaturalForcada']['indviNaturalForcada63Aparelho3']];
        ($body[$i]['individualNaturalForcada']['indviNaturalForcada64Aparelho1'] == "null" || $body[$i]['individualNaturalForcada']['indviNaturalForcada64Aparelho1'] == "") && 
        ($body[$i]['individualNaturalForcada']['indviNaturalForcada64Aparelho2'] == "null" || $body[$i]['individualNaturalForcada']['indviNaturalForcada64Aparelho2'] == "") &&
        ($body[$i]['individualNaturalForcada']['indviNaturalForcada64Aparelho3'] == "null" || $body[$i]['individualNaturalForcada']['indviNaturalForcada64Aparelho3'] == "") ? "" : 
        $IndNatForcada[3] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 64, 'Aparelho1' => $body[$i]['individualNaturalForcada']['indviNaturalForcada64Aparelho1'], 'Aparelho2' => $body[$i]['individualNaturalForcada']['indviNaturalForcada64Aparelho2'], 'Aparelho3' => $body[$i]['individualNaturalForcada']['indviNaturalForcada64Aparelho3']];
        ($body[$i]['individualNaturalForcada']['indviNaturalForcada65Aparelho1'] == "null" || $body[$i]['individualNaturalForcada']['indviNaturalForcada65Aparelho1'] == "") && 
        ($body[$i]['individualNaturalForcada']['indviNaturalForcada65Aparelho2'] == "null" || $body[$i]['individualNaturalForcada']['indviNaturalForcada65Aparelho2'] == "") &&
        ($body[$i]['individualNaturalForcada']['indviNaturalForcada65Aparelho3'] == "null" || $body[$i]['individualNaturalForcada']['indviNaturalForcada65Aparelho3'] == "") ? "" : 
        $IndNatForcada[4] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 65, 'Aparelho1' => $body[$i]['individualNaturalForcada']['indviNaturalForcada65Aparelho1'], 'Aparelho2' => $body[$i]['individualNaturalForcada']['indviNaturalForcada65Aparelho2'], 'Aparelho3' => $body[$i]['individualNaturalForcada']['indviNaturalForcada65Aparelho3']];
        ($body[$i]['individualNaturalForcada']['indviNaturalForcada66Aparelho1'] == "null" || $body[$i]['individualNaturalForcada']['indviNaturalForcada66Aparelho1'] == "") && 
        ($body[$i]['individualNaturalForcada']['indviNaturalForcada66Aparelho2'] == "null" || $body[$i]['individualNaturalForcada']['indviNaturalForcada66Aparelho2'] == "") &&
        ($body[$i]['individualNaturalForcada']['indviNaturalForcada66Aparelho3'] == "null" || $body[$i]['individualNaturalForcada']['indviNaturalForcada66Aparelho3'] == "") ? "" : 
        $IndNatForcada[5] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 66, 'Aparelho1' => $body[$i]['individualNaturalForcada']['indviNaturalForcada66Aparelho1'], 'Aparelho2' => $body[$i]['individualNaturalForcada']['indviNaturalForcada66Aparelho2'], 'Aparelho3' => $body[$i]['individualNaturalForcada']['indviNaturalForcada66Aparelho3']];
        ($body[$i]['individualNaturalForcada']['indviNaturalForcada67Aparelho1'] == "null" || $body[$i]['individualNaturalForcada']['indviNaturalForcada67Aparelho1'] == "") && 
        ($body[$i]['individualNaturalForcada']['indviNaturalForcada67Aparelho2'] == "null" || $body[$i]['individualNaturalForcada']['indviNaturalForcada67Aparelho2'] == "") &&
        ($body[$i]['individualNaturalForcada']['indviNaturalForcada67Aparelho3'] == "null" || $body[$i]['individualNaturalForcada']['indviNaturalForcada67Aparelho3'] == "") ? "" : 
        $IndNatForcada[6] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 67, 'Aparelho1' => $body[$i]['individualNaturalForcada']['indviNaturalForcada67Aparelho1'], 'Aparelho2' => $body[$i]['individualNaturalForcada']['indviNaturalForcada67Aparelho2'], 'Aparelho3' => $body[$i]['individualNaturalForcada']['indviNaturalForcada67Aparelho3']];
        ($body[$i]['individualNaturalForcada']['indviNaturalForcada68Aparelho1'] == "null" || $body[$i]['individualNaturalForcada']['indviNaturalForcada68Aparelho1'] == "") && 
        ($body[$i]['individualNaturalForcada']['indviNaturalForcada68Aparelho2'] == "null" || $body[$i]['individualNaturalForcada']['indviNaturalForcada68Aparelho2'] == "") &&
        ($body[$i]['individualNaturalForcada']['indviNaturalForcada68Aparelho3'] == "null" || $body[$i]['individualNaturalForcada']['indviNaturalForcada68Aparelho3'] == "") ? "" : 
        $IndNatForcada[7] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 68, 'Aparelho1' => $body[$i]['individualNaturalForcada']['indviNaturalForcada68Aparelho1'], 'Aparelho2' => $body[$i]['individualNaturalForcada']['indviNaturalForcada68Aparelho2'], 'Aparelho3' => $body[$i]['individualNaturalForcada']['indviNaturalForcada68Aparelho3']];
        ($body[$i]['individualNaturalForcada']['indviNaturalForcada69Aparelho1'] == "null" || $body[$i]['individualNaturalForcada']['indviNaturalForcada69Aparelho1'] == "") && 
        ($body[$i]['individualNaturalForcada']['indviNaturalForcada69Aparelho2'] == "null" || $body[$i]['individualNaturalForcada']['indviNaturalForcada69Aparelho2'] == "") &&
        ($body[$i]['individualNaturalForcada']['indviNaturalForcada69Aparelho3'] == "null" || $body[$i]['individualNaturalForcada']['indviNaturalForcada69Aparelho3'] == "") ? "" : 
        $IndNatForcada[8] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 69, 'Aparelho1' => $body[$i]['individualNaturalForcada']['indviNaturalForcada69Aparelho1'], 'Aparelho2' => $body[$i]['individualNaturalForcada']['indviNaturalForcada69Aparelho2'], 'Aparelho3' => $body[$i]['individualNaturalForcada']['indviNaturalForcada69Aparelho3']];
        ($body[$i]['individualNaturalForcada']['indviNaturalForcada70Aparelho1'] == "null" || $body[$i]['individualNaturalForcada']['indviNaturalForcada70Aparelho1'] == "") && 
        ($body[$i]['individualNaturalForcada']['indviNaturalForcada70Aparelho2'] == "null" || $body[$i]['individualNaturalForcada']['indviNaturalForcada70Aparelho2'] == "") &&
        ($body[$i]['individualNaturalForcada']['indviNaturalForcada70Aparelho3'] == "null" || $body[$i]['individualNaturalForcada']['indviNaturalForcada70Aparelho3'] == "") ? "" : 
        $IndNatForcada[9] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 70, 'Aparelho1' => $body[$i]['individualNaturalForcada']['indviNaturalForcada70Aparelho1'], 'Aparelho2' => $body[$i]['individualNaturalForcada']['indviNaturalForcada70Aparelho2'], 'Aparelho3' => $body[$i]['individualNaturalForcada']['indviNaturalForcada70Aparelho3']];
        ($body[$i]['individualNaturalForcada']['indviNaturalForcada71Aparelho1'] == "null" || $body[$i]['individualNaturalForcada']['indviNaturalForcada71Aparelho1'] == "") && 
        ($body[$i]['individualNaturalForcada']['indviNaturalForcada71Aparelho2'] == "null" || $body[$i]['individualNaturalForcada']['indviNaturalForcada71Aparelho2'] == "") &&
        ($body[$i]['individualNaturalForcada']['indviNaturalForcada71Aparelho3'] == "null" || $body[$i]['individualNaturalForcada']['indviNaturalForcada71Aparelho3'] == "") ? "" : 
        $IndNatForcada[10] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 71, 'Aparelho1' => $body[$i]['individualNaturalForcada']['indviNaturalForcada71Aparelho1'], 'Aparelho2' => $body[$i]['individualNaturalForcada']['indviNaturalForcada71Aparelho2'], 'Aparelho3' => $body[$i]['individualNaturalForcada']['indviNaturalForcada71Aparelho3']];
        ($body[$i]['individualNaturalForcada']['indviNaturalForcada72Aparelho1'] == "null" || $body[$i]['individualNaturalForcada']['indviNaturalForcada72Aparelho1'] == "") && 
        ($body[$i]['individualNaturalForcada']['indviNaturalForcada72Aparelho2'] == "null" || $body[$i]['individualNaturalForcada']['indviNaturalForcada72Aparelho2'] == "") &&
        ($body[$i]['individualNaturalForcada']['indviNaturalForcada72Aparelho3'] == "null" || $body[$i]['individualNaturalForcada']['indviNaturalForcada72Aparelho3'] == "") ? "" : 
        $IndNatForcada[11] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 72, 'Aparelho1' => $body[$i]['individualNaturalForcada']['indviNaturalForcada72Aparelho1'], 'Aparelho2' => $body[$i]['individualNaturalForcada']['indviNaturalForcada72Aparelho2'], 'Aparelho3' => $body[$i]['individualNaturalForcada']['indviNaturalForcada72Aparelho3']];
        ($body[$i]['individualNaturalForcada']['indviNaturalForcada73Aparelho1'] == "null" || $body[$i]['individualNaturalForcada']['indviNaturalForcada73Aparelho1'] == "") && 
        ($body[$i]['individualNaturalForcada']['indviNaturalForcada73Aparelho2'] == "null" || $body[$i]['individualNaturalForcada']['indviNaturalForcada73Aparelho2'] == "") &&
        ($body[$i]['individualNaturalForcada']['indviNaturalForcada73Aparelho3'] == "null" || $body[$i]['individualNaturalForcada']['indviNaturalForcada73Aparelho3'] == "") ? "" : 
        $IndNatForcada[12] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 73, 'Aparelho1' => $body[$i]['individualNaturalForcada']['indviNaturalForcada73Aparelho1'], 'Aparelho2' => $body[$i]['individualNaturalForcada']['indviNaturalForcada73Aparelho2'], 'Aparelho3' => $body[$i]['individualNaturalForcada']['indviNaturalForcada73Aparelho3']];
        ($body[$i]['individualNaturalForcada']['indviNaturalForcada74Aparelho1'] == "null" || $body[$i]['individualNaturalForcada']['indviNaturalForcada74Aparelho1'] == "") && 
        ($body[$i]['individualNaturalForcada']['indviNaturalForcada74Aparelho2'] == "null" || $body[$i]['individualNaturalForcada']['indviNaturalForcada74Aparelho2'] == "") &&
        ($body[$i]['individualNaturalForcada']['indviNaturalForcada74Aparelho3'] == "null" || $body[$i]['individualNaturalForcada']['indviNaturalForcada74Aparelho3'] == "") ? "" : 
        $IndNatForcada[13] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 74, 'Aparelho1' => $body[$i]['individualNaturalForcada']['indviNaturalForcada74Aparelho1'], 'Aparelho2' => $body[$i]['individualNaturalForcada']['indviNaturalForcada74Aparelho2'], 'Aparelho3' => $body[$i]['individualNaturalForcada']['indviNaturalForcada74Aparelho3']];
        ($body[$i]['individualNaturalForcada']['indviNaturalForcada74Aparelho3'] == "null" || $body[$i]['individualNaturalForcada']['indviNaturalForcada74Aparelho3'] == "") && 
        ($body[$i]['individualNaturalForcada']['indviNaturalForcada75Aparelho2'] == "null" || $body[$i]['individualNaturalForcada']['indviNaturalForcada75Aparelho2'] == "") &&
        ($body[$i]['individualNaturalForcada']['indviNaturalForcada75Aparelho3'] == "null" || $body[$i]['individualNaturalForcada']['indviNaturalForcada75Aparelho3'] == "") ? "" : 
        $IndNatForcada[14] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 75, 'Aparelho1' => $body[$i]['individualNaturalForcada']['indviNaturalForcada74Aparelho3'], 'Aparelho2' => $body[$i]['individualNaturalForcada']['indviNaturalForcada75Aparelho2'], 'Aparelho3' => $body[$i]['individualNaturalForcada']['indviNaturalForcada75Aparelho3']];
        if(isset($IndNatForcada)){
            foreach ($IndNatForcada as $INDNAT) { 
                $Create->ExeCreate("[60_Defeitos]", $INDNAT);                                                             
            }  
        } 

        //SALVANDO COLETIVO NATURAL FORÇADA
        ($body[$i]['coletivoNaturalForcada']['colNaturalForcada76Aparelho1'] == "null" || $body[$i]['coletivoNaturalForcada']['colNaturalForcada76Aparelho1'] == "") && 
        ($body[$i]['coletivoNaturalForcada']['colNaturalForcada76Aparelho2'] == "null" || $body[$i]['coletivoNaturalForcada']['colNaturalForcada76Aparelho2'] == "") &&
        ($body[$i]['coletivoNaturalForcada']['colNaturalForcada76Aparelho3'] == "null" || $body[$i]['coletivoNaturalForcada']['colNaturalForcada76Aparelho3'] == "") ? "" : 
        $ColNatForcada[1] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 76, 'Aparelho1' => $body[$i]['coletivoNaturalForcada']['colNaturalForcada76Aparelho1'], 'Aparelho2' => $body[$i]['coletivoNaturalForcada']['colNaturalForcada76Aparelho2'], 'Aparelho3' => $body[$i]['coletivoNaturalForcada']['colNaturalForcada76Aparelho3']];
        ($body[$i]['coletivoNaturalForcada']['colNaturalForcada77Aparelho1'] == "null" || $body[$i]['coletivoNaturalForcada']['colNaturalForcada77Aparelho1'] == "") && 
        ($body[$i]['coletivoNaturalForcada']['colNaturalForcada77Aparelho2'] == "null" || $body[$i]['coletivoNaturalForcada']['colNaturalForcada77Aparelho2'] == "") &&
        ($body[$i]['coletivoNaturalForcada']['colNaturalForcada77Aparelho3'] == "null" || $body[$i]['coletivoNaturalForcada']['colNaturalForcada77Aparelho3'] == "") ? "" : 
        $ColNatForcada[2] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 77, 'Aparelho1' => $body[$i]['coletivoNaturalForcada']['colNaturalForcada77Aparelho1'], 'Aparelho2' => $body[$i]['coletivoNaturalForcada']['colNaturalForcada77Aparelho2'], 'Aparelho3' => $body[$i]['coletivoNaturalForcada']['colNaturalForcada77Aparelho3']];
        ($body[$i]['coletivoNaturalForcada']['colNaturalForcada78Aparelho1'] == "null" || $body[$i]['coletivoNaturalForcada']['colNaturalForcada78Aparelho1'] == "") && 
        ($body[$i]['coletivoNaturalForcada']['colNaturalForcada78Aparelho2'] == "null" || $body[$i]['coletivoNaturalForcada']['colNaturalForcada78Aparelho2'] == "") &&
        ($body[$i]['coletivoNaturalForcada']['colNaturalForcada78Aparelho3'] == "null" || $body[$i]['coletivoNaturalForcada']['colNaturalForcada78Aparelho3'] == "") ? "" : 
        $ColNatForcada[3] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 78, 'Aparelho1' => $body[$i]['coletivoNaturalForcada']['colNaturalForcada78Aparelho1'], 'Aparelho2' => $body[$i]['coletivoNaturalForcada']['colNaturalForcada78Aparelho2'], 'Aparelho3' => $body[$i]['coletivoNaturalForcada']['colNaturalForcada78Aparelho3']];
        ($body[$i]['coletivoNaturalForcada']['colNaturalForcada79Aparelho1'] == "null" || $body[$i]['coletivoNaturalForcada']['colNaturalForcada79Aparelho1'] == "") && 
        ($body[$i]['coletivoNaturalForcada']['colNaturalForcada79Aparelho2'] == "null" || $body[$i]['coletivoNaturalForcada']['colNaturalForcada79Aparelho2'] == "") &&
        ($body[$i]['coletivoNaturalForcada']['colNaturalForcada79Aparelho3'] == "null" || $body[$i]['coletivoNaturalForcada']['colNaturalForcada79Aparelho3'] == "") ? "" : 
        $ColNatForcada[4] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 79, 'Aparelho1' => $body[$i]['coletivoNaturalForcada']['colNaturalForcada79Aparelho1'], 'Aparelho2' => $body[$i]['coletivoNaturalForcada']['colNaturalForcada79Aparelho2'], 'Aparelho3' => $body[$i]['coletivoNaturalForcada']['colNaturalForcada79Aparelho3']];
        ($body[$i]['coletivoNaturalForcada']['colNaturalForcada80Aparelho1'] == "null" || $body[$i]['coletivoNaturalForcada']['colNaturalForcada80Aparelho1'] == "") && 
        ($body[$i]['coletivoNaturalForcada']['colNaturalForcada80Aparelho2'] == "null" || $body[$i]['coletivoNaturalForcada']['colNaturalForcada80Aparelho2'] == "") &&
        ($body[$i]['coletivoNaturalForcada']['colNaturalForcada80Aparelho3'] == "null" || $body[$i]['coletivoNaturalForcada']['colNaturalForcada80Aparelho3'] == "") ? "" : 
        $ColNatForcada[5] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 80, 'Aparelho1' => $body[$i]['coletivoNaturalForcada']['colNaturalForcada80Aparelho1'], 'Aparelho2' => $body[$i]['coletivoNaturalForcada']['colNaturalForcada80Aparelho2'], 'Aparelho3' => $body[$i]['coletivoNaturalForcada']['colNaturalForcada80Aparelho3']];
        ($body[$i]['coletivoNaturalForcada']['colNaturalForcada81Aparelho1'] == "null" || $body[$i]['coletivoNaturalForcada']['colNaturalForcada81Aparelho1'] == "") && 
        ($body[$i]['coletivoNaturalForcada']['colNaturalForcada81Aparelho2'] == "null" || $body[$i]['coletivoNaturalForcada']['colNaturalForcada81Aparelho2'] == "") &&
        ($body[$i]['coletivoNaturalForcada']['colNaturalForcada81Aparelho3'] == "null" || $body[$i]['coletivoNaturalForcada']['colNaturalForcada81Aparelho3'] == "") ? "" : 
        $ColNatForcada[6] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 81, 'Aparelho1' => $body[$i]['coletivoNaturalForcada']['colNaturalForcada81Aparelho1'], 'Aparelho2' => $body[$i]['coletivoNaturalForcada']['colNaturalForcada81Aparelho2'], 'Aparelho3' => $body[$i]['coletivoNaturalForcada']['colNaturalForcada81Aparelho3']];
        ($body[$i]['coletivoNaturalForcada']['colNaturalForcada82Aparelho1'] == "null" || $body[$i]['coletivoNaturalForcada']['colNaturalForcada82Aparelho1'] == "") && 
        ($body[$i]['coletivoNaturalForcada']['colNaturalForcada82Aparelho2'] == "null" || $body[$i]['coletivoNaturalForcada']['colNaturalForcada82Aparelho2'] == "") &&
        ($body[$i]['coletivoNaturalForcada']['colNaturalForcada82Aparelho3'] == "null" || $body[$i]['coletivoNaturalForcada']['colNaturalForcada82Aparelho3'] == "") ? "" : 
        $ColNatForcada[7] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 82, 'Aparelho1' => $body[$i]['coletivoNaturalForcada']['colNaturalForcada82Aparelho1'], 'Aparelho2' => $body[$i]['coletivoNaturalForcada']['colNaturalForcada82Aparelho2'], 'Aparelho3' => $body[$i]['coletivoNaturalForcada']['colNaturalForcada82Aparelho3']];        
        if(isset($ColNatForcada)){
            foreach ($ColNatForcada as $COLNAT) { 
                $Create->ExeCreate("[60_Defeitos]", $COLNAT);                                                             
            }  
        } 

        //SALVANDO CARACTERISTICAS HIGIENICAS A COMBUSTÃO
        ($body[$i]['higienicasCombustao']['higienicasCombustao83Aparelho1'] == "null" || $body[$i]['higienicasCombustao']['higienicasCombustao83Aparelho1'] == "") && 
        ($body[$i]['higienicasCombustao']['higienicasCombustao83Aparelho2'] == "null" || $body[$i]['higienicasCombustao']['higienicasCombustao83Aparelho2'] == "") &&
        ($body[$i]['higienicasCombustao']['higienicasCombustao83Aparelho3'] == "null" || $body[$i]['higienicasCombustao']['higienicasCombustao83Aparelho3'] == "") ? "" : $CarHigCombustao[1] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 83, 'Aparelho1' => $body[$i]['higienicasCombustao']['higienicasCombustao83Aparelho1'], 'Aparelho2' => $body[$i]['higienicasCombustao']['higienicasCombustao83Aparelho2'], 'Aparelho3' => $body[$i]['higienicasCombustao']['higienicasCombustao83Aparelho3']];

        ($body[$i]['higienicasCombustao']['higienicasCombustao84Aparelho1'] == "null" || $body[$i]['higienicasCombustao']['higienicasCombustao84Aparelho1'] == "") && 
        ($body[$i]['higienicasCombustao']['higienicasCombustao84Aparelho2'] == "null" || $body[$i]['higienicasCombustao']['higienicasCombustao84Aparelho2'] == "") &&
        ($body[$i]['higienicasCombustao']['higienicasCombustao84Aparelho3'] == "null" || $body[$i]['higienicasCombustao']['higienicasCombustao84Aparelho3'] == "") ? "" : $CarHigCombustao[2] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 84, 'Aparelho1' => $body[$i]['higienicasCombustao']['higienicasCombustao84Aparelho1'], 'Aparelho2' => $body[$i]['higienicasCombustao']['higienicasCombustao84Aparelho2'], 'Aparelho3' => $body[$i]['higienicasCombustao']['higienicasCombustao84Aparelho3']];
        
        ($body[$i]['higienicasCombustao']['higienicasCombustao85Aparelho1'] == "null" || $body[$i]['higienicasCombustao']['higienicasCombustao85Aparelho1'] == "") && 
        ($body[$i]['higienicasCombustao']['higienicasCombustao85Aparelho2'] == "null" || $body[$i]['higienicasCombustao']['higienicasCombustao85Aparelho2'] == "") &&
        ($body[$i]['higienicasCombustao']['higienicasCombustao85Aparelho3'] == "null" || $body[$i]['higienicasCombustao']['higienicasCombustao85Aparelho3'] == "") ? "" : $CarHigCombustao[3] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 85, 'Aparelho1' => $body[$i]['higienicasCombustao']['higienicasCombustao85Aparelho1'], 'Aparelho2' => $body[$i]['higienicasCombustao']['higienicasCombustao85Aparelho2'], 'Aparelho3' => $body[$i]['higienicasCombustao']['higienicasCombustao85Aparelho3']];
        if(isset($CarHigCombustao)){
            foreach ($CarHigCombustao as $CARHIG) { 
                $Create->ExeCreate("[60_Defeitos]", $CARHIG);                                                             
            }  
        } 

        //SALVANDO RECOMENDAÇÕES
        $body[$i]['recomendacoes']['recomendacoes86Aparelho1'] == "null" || $body[$i]['recomendacoes']['recomendacoes86Aparelho1'] == "" ? "" : $Recomendacoes[1] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 86, 'InstalacaoInterna' => $body[$i]['recomendacoes']['recomendacoes86Aparelho1']];
        $body[$i]['recomendacoes']['recomendacoes87Aparelho1'] == "null" || $body[$i]['recomendacoes']['recomendacoes87Aparelho1'] == "" ? "" : $Recomendacoes[2] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 87, 'InstalacaoInterna' => $body[$i]['recomendacoes']['recomendacoes87Aparelho1']];
        $body[$i]['recomendacoes']['recomendacoes88Aparelho1'] == "null" || $body[$i]['recomendacoes']['recomendacoes88Aparelho1'] == "" ? "" : $Recomendacoes[3] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 88, 'InstalacaoInterna' => $body[$i]['recomendacoes']['recomendacoes88Aparelho1']];
        $body[$i]['recomendacoes']['recomendacoes89Aparelho1'] == "null" || $body[$i]['recomendacoes']['recomendacoes89Aparelho1'] == "" ? "" : $Recomendacoes[4] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 89, 'InstalacaoInterna' => $body[$i]['recomendacoes']['recomendacoes89Aparelho1']];
        $body[$i]['recomendacoes']['recomendacoes90Aparelho1'] == "null" || $body[$i]['recomendacoes']['recomendacoes90Aparelho1'] == "" ? "" : $Recomendacoes[5] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 90, 'InstalacaoInterna' => $body[$i]['recomendacoes']['recomendacoes90Aparelho1']];
        ($body[$i]['recomendacoes']['recomendacoes91Aparelho1'] == "null" || $body[$i]['recomendacoes']['recomendacoes91Aparelho1'] == "") && 
        ($body[$i]['recomendacoes']['recomendacoes91Aparelho2'] == "null" || $body[$i]['recomendacoes']['recomendacoes91Aparelho2'] == "") &&
        ($body[$i]['recomendacoes']['recomendacoes91Aparelho3'] == "null" || $body[$i]['recomendacoes']['recomendacoes91Aparelho3'] == "") ? "" : 
        $Recomendacoes[6] = ['IdOs'=> intval($body[$i]['idAtendimento']), 'ItemInspecao' => 91, 'InstalacaoInterna' => NULL, 'Aparelho1' => $body[$i]['recomendacoes']['recomendacoes91Aparelho1'], 'Aparelho2' => $body[$i]['recomendacoes']['recomendacoes91Aparelho2'], 'Aparelho3' => $body[$i]['recomendacoes']['recomendacoes91Aparelho3']];
        if(isset($Recomendacoes)){
            foreach ($Recomendacoes as $RECO) { 
                $Create->ExeCreate("[60_Defeitos]", $RECO);                   
            }
        }

        //TRATAMENTO DO ORÇAMENTO, PEÇAS E SERVIÇOS **********************************
        if ($body[$i]['orcamento']['item'] != NULL){
            $orcamento[$i]['IdOS'] = intval($body[$i]['orcamento']['idAtendimento']);
            $orcamento[$i]['DataEnt'] = $body[$i]['orcamento']['DataEnt'];
            $orcamento[$i]['TecnicoEnt'] = intval($body[$i]['orcamento']['idTecnico']);
            $orcamento[$i]['FormaPagamento'] = intval($body[$i]['orcamento']['FormaPagamento']);
            $orcamento[$i]['NumParcelas'] = intval($body[$i]['orcamento']['NumParcelas']);
            $orcamento[$i]['DataAgendamento'] = ($body[$i]['orcamento']['dataAgendamento'] == "null" || $body[$i]['orcamento']['dataAgendamento'] == ""? NULL : $body[$i]['orcamento']['dataAgendamento']);
            $orcamento[$i]['Valor'] = 0;

            $orcamento[$i]['Status'] = intval($body[$i]['orcamento']['Status']);

            $idOrcamentoQuery = 0;
            
            $TotalAprov = 0;
            $TotalReprov = 0;

            $Read->FullRead("SELECT ID, Status FROM [60_Orcamentos] WHERE IdOS = :idos AND Status = :st","idos={$orcamento[$i]['IdOS']}&st={$orcamento[$i]['Status']}");
            if(!$Read->getResult()){
                $Create->ExeCreate("[60_Orcamentos]", $orcamento[$i]);
                $IdOrcamento = $Create->getResult();
                $idOrcamentoQuery = $IdOrcamento;

                    if($orcamento[$i]['Status'] == 1){
                        $ClienteSemOT[$i]['IDCLIENTE'] = intval($body[$i]['idCliente']);
                        $ClienteSemOT[$i]['IDORCAMENTO'] = $IdOrcamento;
                        $ClienteSemOT[$i]['USUARIOSISTEMA'] = intval($body[$i]['orcamento']['idTecnico']);
                        $ClienteSemOT[$i]['DATAAGENDAMENTO'] = $body[$i]['orcamento']['dataAgendamento'];
                        
                        $Create->ExeCreate("[60_ClientesSemOT]", $ClienteSemOT[$i]);
                    }// END $orcamento[$i]['Status'] == 1

                    //var_dump($body[$i]['orcamento']['item']);
                    for($o=0; $o < count($body[$i]['orcamento']['item']); $o++){
                        if($body[$i]['orcamento']['item'][$o]['tipo'] == "1"){
                            if($body[$i]['orcamento']['item'][$o]['aprovado'] == "1"){
                                $ItemPecas[$o]['IDOrcamento'] = $IdOrcamento;
                                $ItemPecas[$o]['ID_Pecas'] = intval($body[$i]['orcamento']['item'][$o]['id']);
                                $ItemPecas[$o]['Qtd'] = intval($body[$i]['orcamento']['item'][$o]['qtd']);
                                $ItemPecas[$o]['Valor'] = floatval($body[$i]['orcamento']['item'][$o]['valor']);
                                $Create->ExeCreate("[60_OS_PecasAPP]", $ItemPecas[$o]);

                                $SubTotalPc =  $ItemPecas[$o]['Qtd'] * $ItemPecas[$o]['Valor'];
                                $TotalAprov = $TotalAprov + $SubTotalPc;
                            }else{//CASO O ITE
                                $Read->FullRead("SELECT ID, Status FROM [60_Orcamentos] WHERE IdOS = :idos AND Status = 3","idos={$orcamento[$i]['IdOS']}");
                                $IdOrcamentoReprov = NULL;
                                if(!$Read->getResult()){
                                    $orcamento[$i]['Status'] = 3;
                                    $orcamento[$i]['DataAgendamento'] = NULL;
                                    $orcamento[$i]['Valor'] = 0;
                                    $Create->ExeCreate("[60_Orcamentos]", $orcamento[$i]);
                                    $IdOrcamentoReprov = $Create->getResult();
                                    $idOrcamentoQuery = $IdOrcamentoReprov;

                                    $ItemPecas[$o]['IDOrcamento'] = $IdOrcamentoReprov;
                                    $ItemPecas[$o]['ID_Pecas'] = intval($body[$i]['orcamento']['item'][$o]['id']);
                                    $ItemPecas[$o]['Qtd'] = intval($body[$i]['orcamento']['item'][$o]['qtd']);
                                    $ItemPecas[$o]['Valor'] = floatval($body[$i]['orcamento']['item'][$o]['valor']);
                                    $Create->ExeCreate("[60_OS_PecasAPP]", $ItemPecas[$o]);     

                                    $SubTotalPc =  $ItemPecas[$o]['Qtd'] * $ItemPecas[$o]['Valor'];
                                    //$TotalReprov = $TotalReprov + $SubTotalSv;

                                }else{
                                    $IdOrcamentoReprov = $Read->getResult()[0]['ID'];
                                    $idOrcamentoQuery = $IdOrcamentoReprov;
                                    $ItemPecas[$o]['IDOrcamento'] = $IdOrcamentoReprov;
                                    $ItemPecas[$o]['ID_Pecas'] = intval($body[$i]['orcamento']['item'][$o]['id']);
                                    $ItemPecas[$o]['Qtd'] = intval($body[$i]['orcamento']['item'][$o]['qtd']);
                                    $ItemPecas[$o]['Valor'] = floatval($body[$i]['orcamento']['item'][$o]['valor']);
                                    $Create->ExeCreate("[60_OS_PecasAPP]", $ItemPecas[$o]);

                                    $SubTotalPc =  $ItemPecas[$o]['Qtd'] * $ItemPecas[$o]['Valor'];
                                    $TotalReprov = $TotalReprov + $SubTotalSv;
                                }
                            }
                            
                        }else{//END $body[$i]['orcamento']['item'][$o]['tipo'] == "1"
                            if($body[$i]['orcamento']['item'][$o]['aprovado'] == "1"){
                                $ItemServicos[$o]['IDOrcamento'] = $IdOrcamento;
                                $ItemServicos[$o]['ID_servico'] = intval($body[$i]['orcamento']['item'][$o]['id']);
                                $ItemServicos[$o]['Qtd'] = intval($body[$i]['orcamento']['item'][$o]['qtd']);
                                $ItemServicos[$o]['Valor'] = floatval($body[$i]['orcamento']['item'][$o]['valor']);
                                $Create->ExeCreate("[60_OS_ServicosAPP]", $ItemServicos[$o]);

                                $SubTotalSv =  $ItemServicos[$o]['Qtd'] * $ItemServicos[$o]['Valor'];
                                $TotalAprov = $TotalAprov + $SubTotalSv;
                            }else{//$body[$i]['orcamento']['item'][$o]['aprovado'] == "1"
                                $Read->FullRead("SELECT ID, Status FROM [60_Orcamentos] WHERE IdOS = :idos AND Status = 3","idos={$orcamento[$i]['IdOS']}");
                                $IdOrcamentoReprov = NULL;
                                if(!$Read->getResult()){
                                    $orcamento[$i]['Status'] = 3;
                                    $orcamento[$i]['DataAgendamento'] = NULL;
                                    $orcamento[$i]['Valor'] = 0;
                                    $Create->ExeCreate("[60_Orcamentos]", $orcamento[$i]);
                                    $IdOrcamentoReprov = $Create->getResult();
                                    $idOrcamentoQuery = $IdOrcamentoReprov;

                                    $ItemServicos[$o]['IDOrcamento'] = $IdOrcamentoReprov;
                                    $ItemServicos[$o]['ID_servico'] = intval($body[$i]['orcamento']['item'][$o]['id']);
                                    $ItemServicos[$o]['Qtd'] = intval($body[$i]['orcamento']['item'][$o]['qtd']);
                                    $ItemServicos[$o]['Valor'] = floatval($body[$i]['orcamento']['item'][$o]['valor']);
                                    $Create->ExeCreate("[60_OS_ServicosAPP]", $ItemServicos[$o]);

                                    $SubTotalSv =  $ItemServicos[$o]['Qtd'] * $ItemServicos[$o]['Valor'];
                                    $TotalReprov = $TotalReprov + $SubTotalSv;

                                }else{
                                    $IdOrcamentoReprov = $Read->getResult()[0]['ID'];
                                    $idOrcamentoQuery = $IdOrcamentoReprov;
                                    $ItemServicos[$o]['IDOrcamento'] = $IdOrcamentoReprov;
                                    $ItemServicos[$o]['ID_servico'] = intval($body[$i]['orcamento']['item'][$o]['id']);
                                    $ItemServicos[$o]['Qtd'] = intval($body[$i]['orcamento']['item'][$o]['qtd']);
                                    $ItemServicos[$o]['Valor'] = floatval($body[$i]['orcamento']['item'][$o]['valor']);
                                    $Create->ExeCreate("[60_OS_ServicosAPP]", $ItemServicos[$o]);

                                    $SubTotalSv =  $ItemServicos[$o]['Qtd'] * $ItemServicos[$o]['Valor'];
                                    $TotalReprov = $TotalReprov + $SubTotalSv;
                                }
                            }                
                        }
                        var_dump(floatval($body[$i]['orcamento']['item'][$o]['total']));
                        $Query = new Query();
                        $Query->FullQuery("UPDATE [60_Orcamentos] SET Valor = Valor + " . floatval($body[$i]['orcamento']['item'][$o]['total']) . " WHERE ID = " . $idOrcamentoQuery,"");
                    }

                }
        }   
    }
        
    return $response->withJson($Retorno);
    //return $response->withJson($body);

});

//PASTA PADRÃO PARA ENVIO DAS IMAGENS
$container = $app->getContainer();
if (!file_exists("../uploads/images/".date("Y")."/".date("m")) && !is_dir("../uploads/images/".date("Y")."/".date("m"))):
    mkdir("../uploads/images/".date("Y")."/".date("m"));
    $container['upload_directory'] = "../uploads/images/".date("Y")."/".date("m");
else:
    $container['upload_directory'] = "../uploads/images/".date("Y")."/".date("m");
endif;


//POST DE ENVIO DE IMAGENS E CADASTRO NO BANCO
$app->post('/atendimentos/fotos/', function(Request $request, Response $response) {
    $Read = new Read();
    $parsedBody = $request->getParsedBody();
    $files = $request->getUploadedFiles();
    $retorno['msg'] = true;
      
    $uploadedFile = $files['image'];
    $directory = $this->get('upload_directory');
    $uploadedFiles = $request->getUploadedFiles();
    

    // handle single input with single file upload
    $uploadedFile = $uploadedFiles['image'];
    
    if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
        $Orcamentos = NULL;
        $Defeitos = NULL;
        $email = NULL;
        $Aparelhos = NULL;

        //UPLOAD DA IMAGEM
        $filename = moveUploadedFile($directory, $uploadedFile, $parsedBody['idAtendimento'], $parsedBody['tipo']); 
        
        //CADASTRO DO CAMINHO DA IMAGEM NO BANCO DE DADOS
        $Fotos['OS'] =  $parsedBody['idAtendimento'];
        $Fotos['Arquivo'] = "images/".date("Y")."/".date("m")."/". $filename;
        

        switch ($parsedBody['tipo']) {
            case 'Medidor':
                $Fotos['Tipo'] = 1;
                break;
            case 'Servico':
                $Fotos['Tipo'] = 2;
                break;
            case 'Defeitos':
                $Fotos['Tipo'] = 3;
                break;
            case 'Assinatura':
                $Fotos['Tipo'] = 4;
                break;
            case 'Local':
                $Fotos['Tipo'] = 5;
                break;
            case 'Assinaturatecnico':
                $Fotos['Tipo'] = 6;
                break;
                
        }
        $Create = new Create;
        $Create->ExeCreate("[60_OS_Fotos]", $Fotos);

        if($parsedBody['tipo'] == "Assinatura"){
            $idAtendimento = intval($parsedBody['idAtendimento']);
            $img = (array) $uploadedFiles['image'];
            $Read->FullRead("SELECT Cliente FROM [60_OT] INNER JOIN [60_OS] ON [60_OT].[Id] = [60_OS].[OT] WHERE [60_OS].[Id] = :id","id={$idAtendimento}");
            if($Read->getResult()){
                $IdCliente = $Read->getResult()[0]['Cliente'];
                $Read->FullRead("SELECT * FROM [60_Clientes] WHERE [Id] = :id","id={$IdCliente}");
                $Cliente = $Read->getResult()[0];
            }
            $Read->FullRead("SELECT [60_Atendimentos].*, [60_OS].[NomeOs], [60_OS].[NumOS], [60_OS].[Endereco], [60_OS].[Bairro], [40_Produtos].[PRODUTO] FROM [60_Atendimentos] 
                        INNER JOIN [60_OS] ON [60_OS].[Id] = [60_Atendimentos].[IdOS]
                        LEFT JOIN [40_Produtos] ON [40_Produtos].[Id] = [60_Atendimentos].[NumManometro]
                        WHERE [60_Atendimentos].IdOS = :id","id={$idAtendimento}");
            $Atendimento = $Read->getResult()[0];
            
            $Read->FullRead("SELECT ID FROM [60_Orcamentos] WHERE idOS = :id","id={$idAtendimento}");
            if($Read->getResult()){
                $IdOrcamento = intval($Read->getResult()[0]["ID"]);
                

                $Read->FullRead("SELECT [60_OS_ServicosAPP].[Qtd] AS Qtd, [60_OS_ServicosAPP].[Valor] AS Valor, [60_OS_ListaServicos].[Descricao] AS nome FROM [60_OS_ServicosAPP] 
                                INNER JOIN [60_OS_ListaServicos] ON [60_OS_ListaServicos].[Id] = [60_OS_ServicosAPP].[ID_servico]
                                WHERE [60_OS_ServicosAPP].IDOrcamento = :id","id={$IdOrcamento}");
                if($Read->getResult()){
                    foreach ($Read->getResult() as $ORCAMENTOS) {
                        $Orcamentos .= "<tr><td>".$ORCAMENTOS['nome']."</td><td>".$ORCAMENTOS['Qtd']."</td><td>".$ORCAMENTOS['Valor']."</td><td>".$ORCAMENTOS['Valor'] * $ORCAMENTOS['Qtd']."</td></tr>";
                    }
                }

                $Read->FullRead("SELECT [60_OS_PecasAPP].[Qtd] AS Qtd, [60_OS_PecasAPP].[Valor] AS Valor, [60_Pecas].[Peca] AS nome FROM [60_OS_PecasAPP] 
                                INNER JOIN [60_Pecas] ON [60_Pecas].[Id] = [60_OS_PecasAPP].[ID_Pecas]
                                WHERE [60_OS_PecasAPP].IDOrcamento = :id","id={$IdOrcamento}");
                if($Read->getResult()){
                    foreach ($Read->getResult() as $ORCAMENTOS) {
                        $Orcamentos .= "<tr><td>{$ORCAMENTOS['nome']}</td><td>{$ORCAMENTOS['Qtd']}</td><td>{$ORCAMENTOS['Valor']}</td><td>".$ORCAMENTOS['Valor'] * $ORCAMENTOS['Qtd']."</td></tr>";
                    }
                }
            }      

            $Termos = NULL;
            $Read->FullRead("SELECT * FROM [60_TermosResponsabilidade] WHERE IDOs = :id","id={$idAtendimento}");
            if($Read->getResult()){                
                foreach ($Read->getResult() as $TERMOS) {
                    $Termos .= "<tr><td>".$TERMOS['Situacao']."</td><td>".$TERMOS['Local1']."</td><td>".$TERMOS['Local1']."</td><td>".$TERMOS['Local1']."</td></tr>";
                }                
            }
            
            $Read->FullRead("SELECT * FROM [60_Defeitos] WHERE idOs = :id","id={$idAtendimento}");
            if($Read->getResult()){                
                foreach ($Read->getResult() as $DEFEITOS) {
                    $Defeitos .= "<tr><td>".getItemInspecao($DEFEITOS['ItemInspecao'])."</td><td>".$DEFEITOS['InstalacaoInterna']."</td><td>".$DEFEITOS['Aparelho1']."</td><td>".$DEFEITOS['Aparelho2']."</td><td>".$DEFEITOS['Aparelho3']."</td></tr>";
                }                
            }

            $Read->FullRead("SELECT * FROM [60_TesteAparelho] WHERE IdOs = :id","id={$idAtendimento}");
            if($Read->getResult()){                
                foreach ($Read->getResult() as $APARELHO) {
                    $Aparelhos .= "<tr><td colspan='2' align='center' valign='middle'><b>Aparelho {$APARELHO['Aparelho']}</b></td></tr><tr><td>Local: {$APARELHO['Local']}</td><td>Tipo: {$APARELHO['Tipo']}</td></tr><tr><td> Marca: {$APARELHO['Marca']}</td><td> Modelo: {$APARELHO['Modelo']}</td></tr><tr><td>Potencia Nominal: {$APARELHO['PotNominal']}</td><td>Tiragem: {$APARELHO['Tiragem']}</td></tr><tr><td>Combustão: {$APARELHO['Combustao']}</td><td>Funcionamento: {$APARELHO['Funcionamento']}</td></tr><tr><td colspan='2'align='center' valign='middle'><b>Higiene da Combustão</b></td></tr><tr><td> Tiragem: {$APARELHO['TiragemHigienteCombustao']}</td><td>COn: {$APARELHO['Con']}</td></tr><tr><td>COAmb: {$APARELHO['CoAmb']}</td><td>Tempo: {$APARELHO['Tempo']}min</td></tr><tr><td> Analisador: {$APARELHO['Analisador']}</td><td>Nº Série: {$APARELHO['NumeroDeSerie']}</td></tr>";
                }                
            }

            $AssinaturaCliente = NULL;
            $Read->FullRead("SELECT * FROM [60_OS_Fotos] WHERE OS = :id AND Tipo = 4","id={$idAtendimento}");
            if($Read->getResult()){               
                $AssinaturaCliente = $Read->getResult()[0]['Arquivo'];            
            }

            $AssinaturaTecnico = NULL;
            $Read->FullRead("SELECT * FROM [60_OS_Fotos] WHERE OS = :id AND Tipo = 6","id={$idAtendimento}");
            if($Read->getResult()){               
                $AssinaturaTecnico = $Read->getResult()[0]['Arquivo'];            
            }

            //DEVE SER ALTERADO QUANDO ESTIVER EM PRODUÇÃO
            //var_dump($Atendimento, $Cliente, $Orcamentos, $Defeitos, $Aparelhos);

            sleep(20);
            $email = enviaEmail($Atendimento, $Cliente, $Orcamentos, $Termos, $Defeitos, $Aparelhos, $AssinaturaCliente, $AssinaturaTecnico);
        }           
               

        //RETORNO AO CLIENT
        $retorno['msg'] = true;
        $retorno['imagem'] = $filename;
        if ($email){
            $retorno['email'] = $email;
        }
        return $response->withJson($retorno);
    }else{
        $retorno['msg'] = false;
        return $response->withJson($retorno);
    }

});

/**
 * Moves the uploaded file to the upload directory and assigns it a unique name
 * to avoid overwriting an existing uploaded file.
 *
 * @param string $directory directory to which the file is moved
 * @param UploadedFile $uploaded file uploaded file to move
 * @return string filename of moved file
 */
function moveUploadedFile($directory, UploadedFile $uploadedFile, $idAtendimento, $tipo)
{
    $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
    $filename = sprintf($idAtendimento . "_" . $tipo . "_" . time().".".$extension);

    $uploadedFile->moveTo($directory . "/" . $filename);

    return $filename;
}

function enviaEmail($Atendimento, $Cliente, $Orcamentos, $Termos, $Defeitos,  $Aparelhos, $AssinaturaCliente, $AssinaturaTecnico){
    $Email = new Email;


    $MailContent = '<table width="1000" style="font-family: "Trebuchet MS", sans-serif;">
                        <tr><td>
                            <font face="Trebuchet MS" size="3">#mail_body#</font>
                        </td></tr>
                    </table>
                    <style>body, img{max-width: 550px !important; height: auto !important;} p{margin-botton: 15px 0 !important;}</style>';
    
    $DataAtendimento = date('d/m/Y', strtotime($Atendimento['DataAtendimento']));
    $DataSaida = date('d/m/Y', strtotime($Atendimento['DataSaida']));
    $NumOcorrencia = (($Atendimento['StatusTeste'] == 'Maior 5L') ? " / Nº da Ocorrência: {$Atendimento['NumOcorrencia']}" : " ");
    $StatusTeste = null;
    if ($Atendimento['StatusTeste'] == 'Maior 5L'){
        $StatusTeste = "<tr><td colspan='5'><b>Declaro que tenho ciência que na data ".$DataAtendimento." esta empresa detectou um escapamento de gás com vazão igual ou superior a 5 litros/hora em minha instalação interna de gás e neste mesmo momento entrou em contato com o Call Center de emergência da distribuidora de gás canalizado local para informá-la. O registro de protocolo nº ".$Atendimento['NumOcorrencia']." é o número pelo qual poderei acompanhar o atendimento. Estou ciente que este procedimento tem caráter de assegurar a minha segurança como a de minha vizinhança. Também fui informado que seria importante o fechamento da válvula do meu medidor até a chegada da equipe da Distribuidora de gás.</b></td></tr>";
    }

    if($Defeitos == NULL){
        $Defeito = NULL;
    }else{
        $Defeito =  " <p><b>DADOS DE INSPEÇÃO</b></p>
                    <p><b>Legendas:<br>
                    N/A: Não se aplica C: Correta I: Incorreto RI: Resolvido no Local</b></p>                    
                    <table border='1' >
                      <tr>
                        <td><b>ITEM DE INPEÇÃO</b></td>
                        <td><b>INSTALAÇÃO INTERNA</b></td>
                        <td><b>APARELHO1</b></td>
                        <td><b>APARELHO2</b></td>
                        <td><b>APARELHO3</b></td>                        
                      </tr>
                        {$Defeitos}                                          
                    </table>";
    }

    if ($Defeitos == NULL){
        $TermoDefeitos = "<p><b>APARELHOS NO LOCAL</b></p>
                    <table border='1' width='1000'>
                        {$Aparelhos}<tr><td colspan='5'>Por meio deste documento certifica-se que, no dia de hoje, tenha sido comprovada em suas partes visíveis e acessiveis a rede de distribuição interna, a conexão dos aparelhos a gás à instalação, adequação dos aparelhos e ambiente, obtendo-se o resultado abaixo assinaladado<br><b>NÃO FORAM DETECTADOS DEFEITOS</b></td></tr></table>";
    }else{
        $TermoDefeitos = "<p><b>APARELHOS NO LOCAL</b></p>
                    <table border='1' width='1000'>
                        {$Aparelhos}<tr><td colspan='5'>Por meio deste documento certifica-se que, no dia de hoje, tenha sido comprovada em suas partes visíveis e acessiveis a rede de distribuição interna, a conexão dos aparelhos a gás à instalação, adequação dos aparelhos e ambiente, obtendo-se o resultado abaixo assinaladado<br><b>EXISTEM DEFEITOS E OS MESMOS ESTÃO SINALIZADOS ABAIXO</b></td></tr></table>";
    }
    if($Termos == NULL){
        $TermosResp = NULL;
    }else{
        $TermosResp =  "
        <p><b>TERMO DE RESPONSABILIDADE</b></p>
        <table border='1' >
                <tr>
                    <td colspan='4'><b>Serviço de Origem:</b> {$Atendimento['NomeOs']}<br>
                    Declaro que os itens abaixo assinalados encontram-se adequados conforme aprovado no serviço acima realizado, e estou ciente de que os mesmos não devem ser alterados, e que a alteração deste coloca em risco a segurança na utilização do abastecimento a gás.</td>
                </tr>
                  <tr>
                    <td><b>Situação executada / existente</b></td>
                    <td><b>Local 1</b></td>
                    <td><b>Local 2</b></td>
                    <td><b>Local 3</b></td>                        
                  </tr>
                    {$Termos}                                          
            </table>";
    }
    if($Orcamentos == NULL){
        $Orcamento = NULL;
    }else{
        $Orcamento =  "<p><b>ORÇAMENTO</b></p>
                    <table border='1' width='1000'>
                      <tr>
                        <td><b>ITEM</b></td>
                        <td><b>QUANTIDADE</b></td>
                        <td><b>VALOR UNT.(R$)</b></td>
                        <td><b>VALOR TOTAL(R$)</b></td>
                      </tr>
                        {$Orcamentos}
                      <tr>
                        <td colspan='4'><b>1- Os preços apresentados para serviços de adequações não incluem obras civis em pisos, muros e paredes.<br>
                        2- O orçamento elaborada p/ nova instalação é para execução em tubulação aparente, não incluindo reposição de material de acabamento em pisos e paredes.<br>
                        3- Este valor será cobrado na conta de fornecimento de gás do cliente, que em caso de atraso estará sujeito a cobrança de multa. No caso de solicitação de cancelamento de titularidade e débito deverá ser quitado a vista.<br>
                        4- Este orçamento é válçido por 30 dias a assinatura do cliente.<br>
                        5- Esta proposta estará sujeita a revisão, a ser aprovada pelo cliente, em caso de alteração das condições previamente analisadas ou em virtude das necessidades técnicas decorrentes da execução dos serviços.</b></td>
                      </tr>                   
                    </table>";
    }
    

    switch ($Atendimento['Status']) {
            case 1:
                $ToCliente = "  <p style='font-size: 1.2em;'>Prezado(a) {$Cliente['NomeCliente']}</p>
                    <p>Este e-mail é refente ao atendimento realizado pela Novatec Energy na data ". $DataAtendimento.".</p>
                    <table width='1000'>
                      <tr><td width='700'><b>NOVATEC Energy Ltda.</b></td><td rowspan='5'><img src='http://novatecenergy.ddns.net:83/Rodrigo/novatec/img/logo-email.png' width='250' ></td></tr>
                      <tr><td>CNPJ: 09.012.806/0001-74</td></tr>
                      <tr><td>Rua Conde de Agrolongo nº 362</td></tr>
                      <tr><td>CEP: 21020-190 Penha - Rio de Janeiro</td></tr>
                      <tr><td>(21) 3046-8004</td></tr>                                  
                    </table>
                    <p><b>Informe de Defeitos nas instalações a gás individuais</b></p>
                    <table border='1' width='1000'>
                      <tr>
                        <td colspan='1'>Nº da OS:<br>".$Atendimento['NumOS']."</td>
                        <td colspan='4'>Nome do Cliente / Condomínio:<br>".$Cliente['NomeCliente']."</td>
                      </tr>
                      <tr>
                        <td>Nº do Cliente:<br>".$Cliente['NumCliente']."</td>
                        <td colspan='3'>Endenreço - rua / nº / Complemento:<br>".$Atendimento['Endereco']."<br> 
                        </td><td>Bairro:<br>".$Atendimento['Bairro']."</td>
                      </tr>
                      <tr>
                        <td>Data da Inspeção: <br>".$DataAtendimento."</td><td>Hora de Chegada: <br>".$DataAtendimento." </td><td>Hora de Saída: <br> ".$DataSaida."</td><td>Gás: <br>".$Atendimento['gas']."</td><td>Pressão: <br>".$Atendimento['Pressao']."</td>
                      </tr>
                      <tr>
                        <td colspan='2'>Ramificação Interna:<br> ".$Atendimento['Ramificacao']."</td>
                        <td colspan='1'>Diâmetro: <br>".$Atendimento['Diametro']."</td>
                        <td colspan='2'>Material:  <br> ".$Atendimento['Material']."</td>
                      </tr>
                      <tr>
                        <td colspan='2' align='center' valign='middle'><b>Teste de Estanquidade</b></td>
                        <td colspan='3' align='center' valign='middle'><b>Dados do Medidor / Verificação de estanquidade</b></td>
                      </tr>                    
                      <tr>
                        <td>Pressão Inicial:<br>".$Atendimento['PressaoInicial']."</td>
                        <td>Pressão Final:<br>".$Atendimento['PressaoFinal']."</td>
                        <td colspan='3'>Manômetro:<br>".$Atendimento['PRODUTO']."</td>
                      </tr>
                      <tr>
                        <td>Tempo de Teste:<br>".$Atendimento['TempoTeste']."min</td>
                        <td>Vazão de Fuga: <br>".$Atendimento['StatusTeste']."</td>
                        <td>Leitura Inicial: <br>".$Atendimento['PressaoInicial']."</td>
                        <td>Leitura Final: <br>".$Atendimento['PressaoFinal']."</td>
                        <td>Vazão de Fuga: <br>".$Atendimento['StatusTeste']."</td>                        
                      </tr>".$StatusTeste."
                    </table>
                    {$TermoDefeitos}                                    
                    {$Defeito}
                    {$Orcamento}
                    {$TermosResp}        
                    <p><b>OBSERVAÇÕES IDENTIFICADAS PELO TÉCNICO</b></p>             
                    <p>{$Atendimento['Obs']}</p>
                    <p>*****</p>
                    <table width='1000' >
                      <tr>
                        <td><img src='http://novatecenergy.ddns.net:83/Rodrigo/novatec/uploads/{$AssinaturaCliente}' width='250' ><br><b>ASSINATURA DO CLIENTE</b></td>                       
                        <td><img src='http://novatecenergy.ddns.net:83/Rodrigo/novatec/uploads/{$AssinaturaTecnico}' width='250' ><br><b>ASSINATURA DO TÉCNICO</b></td>   
                      </tr>                                        
                    </table>";
                break;

            case 2:
                $ToCliente = "  <p style='font-size: 1.2em;'>Prezado(a) {$Cliente['NomeCliente']}</p>
                    <p>Este e-mail é refente ao cancelamento de nosso Atendimento. Data de nosso atendimento {$DataAtendimento}.</p>
                    <p>Observações identificadas pelo técnico: {$Atendimento['Obs'] }</p>
                    <p>*****************************</p>
                    <table width='1000' >
                      <tr>
                        <td><img src='http://novatecenergy.ddns.net:83/Rodrigo/novatec/uploads/{$AssinaturaCliente}' width='250' ><br><b>ASSINATURA DO CLIENTE</b></td>                       
                        <td><img src='http://novatecenergy.ddns.net:83/Rodrigo/novatec/uploads/{$AssinaturaTecnico}' width='250' ><br><b>ASSINATURA DO TÉCNICO</b></td>   
                      </tr>                                        
                    </table>";
                break;

            case 3:
                $ToCliente = "  <p style='font-size: 1.2em;'>Prezado(a) {$Cliente['NomeCliente']}</p>
                    <p>Este e-mail é refente a tentativa de atendimento realizado pela Novatec Energy na data {$DataAtendimento}.</p>
                    <p>Observações identificadas pelo técnico: {$Atendimento['Obs'] }</p>
                    <p>*****</p>  
                    ";
                break;

        }

    


    $MailMensage = str_replace("#mail_body#", $ToCliente, $MailContent);
    //DESCOMENTAR ESTA LINHA QUANDO FOR PARA PRODUÇÃO
    //$Email->EnviarMontando("Comprovante de atendimento Novatec Energy. OS: ".$Atendimento['NumOs']." ", $MailMensage, "Novatec Energy", "gns@novatecenergy.com.br", $Cliente['NomeCliente'], $Cliente['EmailGns']);
    $Email->EnviarMontando("Comprovante de atendimento Novatec Energy. OS: ".$Atendimento['NumOS']." ", $MailMensage, "Novatec Energy", "gns@novatecenergy.com.br", $Cliente['NomeCliente'], "rdias@novatecenergy.com.br");

    $CopyMensage = str_replace("#mail_body#", $ToCliente, $MailContent);

    //DESCOMENTAR ESTA LINHA QUANDO FOR PARA PRODUÇÃO
    //$Email->EnviarMontando("Comprovante de envio. OS: ".$Atendimento['NumOs']." ", $CopyMensage, $Cliente['NomeCliente'], $Cliente['EmailGns'], "Novatec Energy", "gns@novatecenergy.com.br");
    $Email->EnviarMontando("Comprovante de envio. OS: ".$Atendimento['NumOS']." ", $CopyMensage, $Cliente['NomeCliente'], "rdias@novatecenergy.com.br", "Novatec Energy", "gns@novatecenergy.com.br");
    
    return $Email;
}
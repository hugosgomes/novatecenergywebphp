<?php 

$PostData = filter_input(INPUT_GET,'text', FILTER_DEFAULT);//Criar um array com tudo o que foi passado no post.
$jSON = null;
$Case = $PostData;

require '_app/Config.inc.php';

try{
    switch ($Case):
    case 'ImportacaoGNS':

        $delimitador = '|';
        $cerca = '"';
        $registro = array();
        $Query = new Query;

        //apaga os registros da ultima importacao
        $Query->FullQuery("USE TESTECI DELETE from [60_ImportGNS]"," ");

       // importarCSV('//192.168.0.101/Robo/gns.csv', "[60_ImportGNS]");   

          // Abrir arquivo para leitura
       $f = fopen('//192.168.0.101/Robo/gns.csv', '[60_ImportGNS]');

    $delimitador = '|';
    $cerca = '"';
    $registro = array();
    $Create = new Create;

    // Abrir arquivo para leitura
    $f = fopen($file, 'r');
    if ($f) { 

        // Ler cabecalho do arquivo
        $cabecalho = fgetcsv($f, 0, $delimitador, $cerca);
        $cabecalho = array_map("utf8_encode", $cabecalho);

        foreach ($cabecalho as $key => $value) {
            $value = str_replace(" (", "_", $value);
            $value = str_replace("/", "_", $value);
            $value = str_replace(" ", "_", $value);
            $value = str_replace(")", "", $value);
            $value = str_replace("-", "_", $value);
            $value = str_replace("ç", "c", $value);
            $value = str_replace("ã", "a", $value);
            $value = str_replace("ó", "o", $value);
            $value = str_replace("í", "i", $value);
            $value = str_replace("ú", "u", $value);
            $value = str_replace("_", "", $value);
            $value = str_replace("á", "a", $value);
            $cabecalho[$key] = $value;
            //var_dump($value);
        }

        // Enquanto nao terminar o arquivo
        while (!feof($f)) { 

            // Ler uma linha do arquivo
            $linha = fgetcsv($f, 0, $delimitador, $cerca);
            if (!$linha) {
                continue;
            }

            // Montar registro com valores indexados pelo cabecalho
            $linha = array_map("utf8_encode", $linha);
            $registro = array_combine($cabecalho, $linha);
            unset($registro[""]);//remover coluna a mais que está vindo com o arquivo 
            $Create->ExeCreate($tabela,$registro);
            
        }
        fclose($f);
    }

      /* 
        $Query->FullQuery("INSERT into [60_Siebel] (
         [areaResponsavel],[DataAgendamento],[NumeroCliente],[NomeCliente],[Telefone1],[NumeroOT],[Organizacao],[NomeOS],[NomeOT],[NumeroOS],[Endereco],[Bairro]
         ,[SituacaoCliente],[cep],[SituacaoOS],[ObsOT],[ObsCEG],[Criadoem],[Criadopor],[Município],[Atualizadoem],[Atualizadopor],[ExecutorServico],[CPFExecutorServico]
         ,[Prioridade],[Mercado],[NovoPeriododeagendamento],[SituacaodeFornecimento],[TipoAgendamento],[UsuarioColetivo],[DataSituacaoReal],[MotivoNaoRealizacao]
         ,[DataRealizacao_NaoRealizacao_Anulacao],[DataSolicitacao],[Telefone2],[Telefone3],[Zona],[SubZona],[No.OSgarantia],[Valoracobrar],[Obs.Empreiteira],[LoteFaturamento]
         ,[LoteImpressao],[DataLoteImpressao],[OS_AliasName],[OT_AliasName],[UsuarioLoteImpressao],[CPF_CNPJ],[vazio],[Periododeagendamento],[areadeagendamento]
         ,[AgendamentoXAtendimento],[AtendimentoXRealizacao],[RealizacaoXComunicacao],[Cups],[CodigoSolicitacaoZeus],[SolicitacaoZeus],[TelefoneZeus],[areaOrigem],[emailGNS])
         select * from [60_ImportGNS] V
         WHERE NOT EXISTS (
         select * from [60_Siebel] CV 
         WHERE CV.[NumeroOS] = V.[NumeroOS])");

        $rowCount = $Query->getResult();
        $Query->FullQuery("INSERT INTO DBO.[00_LogImportacao] (PROCESSO,LINHAS,DATAIMPORT) VALUES ('DADOS RECEBIDOS SIEBEL', {$rowCount},GETDATE());");

        $Query->FullQuery("update [60_Siebel] set areaOrigem =  REPLACE(areaOrigem,'.','')");

        $Query->FullQuery("update [60_Siebel] set areaOrigem =  'Não Informado' where areaOrigem is null");

        //Insere Clientes
        $Query->FullQuery("INSERT into [60_clientes] ([NumCliente]      ,[NomeCliente]      ,[Telefone1]      ,[Telefone2]      ,[Telefone3]      ,[Criadoem]
          ,[UsuarioColetivo]      ,[CPFCNPJ]      ,[SituacaoCliente]      ,[Mercado]      ,[SituacaoFornecimento]      ,[AreaAgendamento]    ,[AreaOrigem], EmailGns)
          select distinct s.numerocliente,s.nomecliente,s.telefone1,s.telefone2,s.telefone3,s.criadoem,s.usuariocoletivo,s.cpf_cnpj, s.SituacaoCliente, s.Mercado, s.SituacaodeFornecimento,
          s.areadeagendamento, s.areaOrigem, s.emailGNS
          from [60_Siebel] S
          WHERE NOT EXISTS (
          select * from [60_clientes] t WHERE s.numerocliente = t.[NumCliente] )");

        $rowCount2 = $Query->getResult();
        $Query->FullQuery("INSERT INTO DBO.[00_LogImportacao] (PROCESSO,LINHAS,DATAIMPORT) VALUES ('CLIENTES INSERIDOS DO SIEBEL', {$rowCount2},GETDATE())");

        //Insere OTs
        $Query->FullQuery("INSERT into [60_OT] (TipoOT,Cliente,NumOT,ObsOT)
          select distinct s.NomeOT, c.Id,s.numeroot,s.obsot 
          from [60_Siebel] S
          left join [60_clientes] c on c.NumCliente= s.numerocliente
          WHERE NOT EXISTS (
          select * from [60_OT] t
          WHERE s.[NumeroOt] = t.NumOT)");

        $rowCount3 = $Query->getResult();
       $Query->FullQuery("INSERT INTO DBO.[00_LogImportacao] (PROCESSO,LINHAS,DATAIMPORT) VALUES ('OTS INSERIDOS DO SIEBEL', {$rowCount3},GETDATE())");

        //importa OS
        $Query->FullQuery("UPDATE [60_Siebel] set [Valoracobrar] = 0 where [Valoracobrar] is null");

        $Query->FullQuery("INSERT INTO [60_OS] ([OT],[NumOS],[NomeOs]      ,[Status]      ,[Status2]      ,[OrcamentoEnt]      ,[DataOrEnt]      ,[OrcamentoApr]      ,[DataOrApr]     ,[OrcamentoExec]      ,[DataOrExec]      ,[Cancelada]      ,[Tipo]      ,[NOSgarantia]      ,
         [ObsCEG]      ,[ObsEmpreiteira]      ,[DataAgendamento]      ,[DataComunicacao]      ,[PeriodoAgendamento]      ,[NovoPeriodoAgendamento]      ,[DataRealizaAnula]      ,[MotivoNaoRealiza]      ,[Valorcobrar]      ,[Prioridade]      ,[TipoAgendamento]
         ,[Criadoem]      ,[Criadopor]      ,[Atualizadoem]      ,[ExecutorServico]      ,[CPFExecutorServico],[turno], 
         [Endereco], [Bairro], Municipio, Cep, Zona, Subzona )
         select t.Id as OT,s.numeroOs,s.NomeOS ,0 AS STATUS, NULL AS STATUS2, 0 AS oRCAMENTOent,null as DataOrEnt,0 as [OrcamentoApr] , NULL AS DATAoRAPR, NULL AS ORCEXEC,null as [DataOrApr] , 0 AS CANCELADA, 0 AS TIPO, [NO.oSGARANTIA] AS noSGARANTIA,
         S.OBSCEG,S.[OBS.EMPREITEIRA] ,convert(datetime,SUBSTRING(S.DATAaGENDAMENTO,1,10)+' '+SUBSTRING(S.DATAaGENDAMENTO,11,8),103),
         NULL AS DATACOMUNICACAO,S.PERIODODEAGENDAMENTO, NULL AS NOVOPERIODODEAGENDAMENTO, NULL AS DATAREALIZAANULA, 0 AS MOTIVONAOREALIZADA, 
         CONVERT(DECIMAL(15,1), REPLACE(REPLACE(replace(REPLACE([Valoracobrar], 'R$',''),' ', ''), '.',''), ',','')/100),
         S.PRIORIDADE,S.TIPOaGENDAMENTO,convert(datetime,S.DATASOLICITACAO,103),S.CRIADOPOR,
         convert(datetime,S.ATUALIZADOEM,103), S.EXECUTORsERVICO,
         S.CPFEXECUTORsERVICO,s.Periododeagendamento, s.Endereco, s.Bairro, s.Município, s.cep, s.Zona, s.SubZona
         from [60_Siebel] s
         inner join [60_OT] t on s.numeroOt = t.NumOT
         WHERE NOT EXISTS (
         select * from [60_OS] t
         WHERE s.[numeroOs] = t.NumOS)");


        $rowCount4 = $Query->getResult();
       $Query->FullQuery("INSERT INTO DBO.[00_LogImportacao] (PROCESSO,LINHAS,DATAIMPORT) VALUES ('OSs INSERIDOS DO SIEBEL', {$rowCount4},GETDATE())");
*/
        break;

    endswitch;

    echo "Importação Concluída Com Êxito!";

}catch(Exception $e){
    echo "Erro na Importação: " . $e->getMessage();
}
/*

  $f = fopen('//192.168.0.101/Robo/gns.csv', "r");

function importarCSV($file, $tabela){

    $delimitador = '|';
    $cerca = '"';
    $registro = array();
    $Create = new Create;

    // Abrir arquivo para leitura
    $f = fopen($file, 'r');
    if ($f) { 

        // Ler cabecalho do arquivo
        $cabecalho = fgetcsv($f, 0, $delimitador, $cerca);
        $cabecalho = array_map("utf8_encode", $cabecalho);

        foreach ($cabecalho as $key => $value) {
            $value = str_replace(" (", "_", $value);
            $value = str_replace("/", "_", $value);
            $value = str_replace(" ", "_", $value);
            $value = str_replace(")", "", $value);
            $value = str_replace("-", "_", $value);
            $value = str_replace("ç", "c", $value);
            $value = str_replace("ã", "a", $value);
            $value = str_replace("ó", "o", $value);
            $value = str_replace("í", "i", $value);
            $value = str_replace("ú", "u", $value);
            $value = str_replace("_", "", $value);
            $value = str_replace("á", "a", $value);
            $cabecalho[$key] = $value;
            //var_dump($value);
        }

        // Enquanto nao terminar o arquivo
        while (!feof($f)) { 

            // Ler uma linha do arquivo
            $linha = fgetcsv($f, 0, $delimitador, $cerca);
            if (!$linha) {
                continue;
            }

            // Montar registro com valores indexados pelo cabecalho
            $linha = array_map("utf8_encode", $linha);
            $registro = array_combine($cabecalho, $linha);
            unset($registro[""]);//remover coluna a mais que está vindo com o arquivo 
            $Create->ExeCreate($tabela,$registro);
            
        }
        fclose($f);
    }
}
*/
?>
<?php 

$PostData = filter_input(INPUT_GET,'text', FILTER_DEFAULT);//Criar um array com tudo o que foi passado no post.
$jSON = null;
$Case = $PostData;

require '_app/Config.inc.php';

try{
    switch ($Case):
    case 'Importacao':

        $Query = new Query;

        $Query->FullQuery("DELETE from [14_ImportEstadoPortas_SVSH];"," ");

        importarCSV('//192.168.0.101/Robo/relatorioestadoportas.csv', "[14_ImportEstadoPortas_SVSH]");        

        //GRAVA AS PORTAS NOVAS
        $Query->FullQuery("INSERT INTO [dbo].[14_ImportEstadoPortas]
            ([Zona],[Distribuidora],[Delegação],[Tipo],[Município],[Estado],[Tipo via],[Via],[Número via],[Anexo],[Escadaria],[Bloco],[Piso],[Porta],[Bairro],[Empresa],[Gestor]
            ,[Código_Agente],[Agente],[Celular_Agente],[Lote],[Código_Atividade],[CIDI],[Nome],[Sobrenomes],[Telefone 1],[Telefone 2],[E-mail],[ContrataACS (Sim/Não)],[Contrata fogão (Sim/Não)],[Contrata Calefação (Sim/Não)]
            ,[Resultado_Visita],[Detalhes_Resultado],[Data do Relatório da Visita],[Hora do Relatório da Visita],[Data da Visita],[Hora da Visita],[Comentários],[Número_Visitas_Realizadas],[Tipo_Combustível_Fogão]
            ,[Tipo_Combustível_Aquecedor],[Tipo_Combustível_Calefação],[Tipo_de_Moradia],[Regime_de_Posse],[Foto1],[Foto2],[Foto3],[Foto4],[Foto5],[Foto6])
            SELECT [Zona],[Distribuidora],[Delegacao],[Tipo],[Municipio],[Estado],[Tipovia],[Via],[Numerovia],[Anexo],[Escadaria],[Bloco],[Piso],[Porta],[Bairro],[Empresa],[Gestor]
            ,[CodigoAgente],[Agente],[CelularAgente],[Lote],[CodigoAtividade],[CIDI],[Nome],[Sobrenomes],[Telefone1],[Telefone2],[Email],[ContrataACSSimNao],
            [ContratafogaoSimNao],[ContrataCalefacaoSimNao],[ResultadoVisita],[DetalhesResultado],[DatadoRelatoriodaVisita],[HoradoRelatoriodaVisita],
            [DatadaVisita],[HoradaVisita],[Comentarios],[NumeroVisitasRealizadas],[TipoCombustivelFogao]
            ,[TipoCombustivelAquecedor],[TipoCombustivelCalefacao],[TipodeMoradia],[RegimedePosse],[Foto1],[Foto2],[Foto3],[Foto4],[Foto5],[Foto6]
            FROM [14_ImportEstadoPortas_SVSH] WHERE NOT EXISTS ( SELECT * FROM [14_ImportEstadoPortas] V WHERE V.CIDI = [14_ImportEstadoPortas_SVSH].CIDI);"," ");

        $rowCount = $Query->getResult();

        $Query->FullQuery("INSERT INTO DBO.[00_LogImportacao] (PROCESSO,LINHAS,DATAIMPORT) VALUES ('ESTRUTURAS IMPORTADAS DO OMNIA ', {$rowCount},GETDATE());"," ");

        //SOMENTE OS LOTES QUE AINDA NÃO FORAM IMPORTADOS
        $Query->FullQuery("delete from [14_ImportEstadoPortas_SVSH] where Lote in(
            select NUMLOTEGNF from [11_Lotes]
            union
            select NUMLOTEGNF from [12_Lotes]
        )"," ");

         //ENVIAR UM E-MAIL INFORMANDO SE EXISTEM NOVOS LOTES IMPORTADOS
            $Read->FullRead("SELECT DISTINCT [14_ImportEstadoPortas_SVSH].Lote
             FROM [14_ImportEstadoPortas_SVSH] LEFT JOIN (
             SELECT NUMLOTEGNF AS LOTE FROM [11_Lotes] UNION SELECT NUMLOTEGNF AS LOTE FROM [12_Lotes] UNION SELECT NUM_LOTE_GNF AS LOTE FROM [11_ImportaLoteB])A
             ON [14_ImportEstadoPortas_SVSH].Lote = A.LOTE
             WHERE (([14_ImportEstadoPortas_SVSH].Tipo)='SV') AND (A.LOTE Is Null);"," ");
            $qtdLinhas = count($Read->getResult());

            if($qtdLinhas > 0){

                $NumOs = 5;
                $Cliente = "teste";
                $EmailCliente = "cmailard@novatecenergy.com.br";
                $linhas = $qtdLinhas;
                function envioTeste($NumOs, $Cliente, $EmailCliente, $linhas){

                   $Email = new Email;
                   $MailContent = '<table width="550" style="font-family: "Trebuchet MS", sans-serif;">
                   <tr><td>
                   <font face="Trebuchet MS" size="3">#mail_body#</font>
                   </td></tr>
                   </table>
                   <style>body, img{max-width: 550px !important; height: auto !important;} p{margin-botton: 15px 0 !important;}</style>';

                    $ToAdmin = "<p>Novos Lotes Importados</p>
                    <p>Qtd. de Lotes Importados: {$linhas}</p>
                    <p style='font-size: 0.9em;'>Sistema Ch4_Bot</p>";

                    $CopyMensage = str_replace("#mail_body#", $ToAdmin, $MailContent);

                    $Email->EnviarMontando("Comprovante de envio. OS: ".$NumOs." ", $CopyMensage, $Cliente, $EmailCliente, "Novatec Energy", "cmailard@novatecenergy.com.br");
                }
                envioTeste($NumOs, $Cliente, $EmailCliente, $linhas);
            }

        //Inserindo dados formatados SV na tabela 11_ImportaLoteB
        $Query->FullQuery("INSERT INTO [11_ImportaLoteB] (LOCALIDADE, BAIRRO, TIPO_LOGRADOURO, LOGRADOURO, NUM, COMPLEMENTO, APT, CASA, NOVO, LOTE, COD_ATIVIDADE, NUM_LOTE_GNF, CIDI, TIPO) 
            SELECT DISTINCT [14_ImportEstadoPortas_SVSH].Municipio, [14_ImportEstadoPortas_SVSH].Bairro, [14_ImportEstadoPortas_SVSH].[Tipovia], [14_ImportEstadoPortas_SVSH].Via, 
            [14_ImportEstadoPortas_SVSH].[Numerovia], LTrim(IIf([14_ImportEstadoPortas_SVSH].[Anexo] IS NOT NULL
            ,[14_ImportEstadoPortas_SVSH].[Anexo],'') +
            IIf([14_ImportEstadoPortas_SVSH].Escadaria IS NOT NULL,' ' + [14_ImportEstadoPortas_SVSH].[Escadaria],'') + 
            IIf([14_ImportEstadoPortas_SVSH].Bloco IS NOT NULL,' ' + [14_ImportEstadoPortas_SVSH].[Bloco],'')) AS COMPLEMENTO, 
            [14_ImportEstadoPortas_SVSH].Porta, 0, 'Sim', 0, [14_ImportEstadoPortas_SVSH].CodigoAtividade, [14_ImportEstadoPortas_SVSH].Lote, 
            [14_ImportEstadoPortas_SVSH].CIDI, [14_ImportEstadoPortas_SVSH].Tipo 
            FROM [14_ImportEstadoPortas_SVSH] LEFT JOIN (
            SELECT NUMLOTEGNF AS LOTE FROM [11_Lotes] UNION SELECT NUMLOTEGNF AS LOTE FROM [12_Lotes] UNION SELECT NUM_LOTE_GNF AS LOTE FROM [11_ImportaLoteB])A
            ON [14_ImportEstadoPortas_SVSH].Lote = A.LOTE
            WHERE (([14_ImportEstadoPortas_SVSH].Tipo)='SV') AND (A.LOTE Is Null);"," ");

        //Inserindo dados formatados SH e outros na tabela 11_ImportaLoteB
        $Query->FullQuery("INSERT INTO [11_ImportaLoteB] (LOCALIDADE, BAIRRO, TIPO_LOGRADOURO, LOGRADOURO, NUM, COMPLEMENTO, APT, CASA, NOVO, LOTE, COD_ATIVIDADE, NUM_LOTE_GNF, CIDI, TIPO) 
            SELECT DISTINCT [14_ImportEstadoPortas_SVSH].[Municipio] AS Expr1, [14_ImportEstadoPortas_SVSH].Bairro, [14_ImportEstadoPortas_SVSH].Tipovia AS Expr2, 
            [14_ImportEstadoPortas_SVSH].Via, [14_ImportEstadoPortas_SVSH].Numerovia AS Expr3, LTrim(IIf([14_ImportEstadoPortas_SVSH].[Anexo] IS NULL OR 
            LEN([14_ImportEstadoPortas_SVSH].[Anexo]) = 0,'',
            [14_ImportEstadoPortas_SVSH].[Anexo]) + IIf([14_ImportEstadoPortas_SVSH].[Escadaria] IS NULL OR LEN([14_ImportEstadoPortas_SVSH].[Escadaria]) = 0,'',' ' + 
            [14_ImportEstadoPortas_SVSH].[Escadaria]) + IIf([14_ImportEstadoPortas_SVSH].[Bloco] IS NULL OR LEN([14_ImportEstadoPortas_SVSH].[Bloco]) = 0,'',' ' + 
            [14_ImportEstadoPortas_SVSH].[Bloco]) + IIf([14_ImportEstadoPortas_SVSH].[Piso] IS NULL OR LEN([14_ImportEstadoPortas_SVSH].[Piso]) = 0, '',' ' + 
            [14_ImportEstadoPortas_SVSH].[Piso]) + IIf([14_ImportEstadoPortas_SVSH].[Porta] IS NULL OR LEN([14_ImportEstadoPortas_SVSH].[Porta]) = 0,
            '',' ' + [14_ImportEstadoPortas_SVSH].[Porta])) AS COMPLEMENTO, '' AS Porta, 0, 'Sim', 0,[14_ImportEstadoPortas_SVSH].Lote, [14_ImportEstadoPortas_SVSH].CodigoAtividade AS Expr4, 
            [14_ImportEstadoPortas_SVSH].CIDI,  [14_ImportEstadoPortas_SVSH].Tipo FROM (([14_ImportEstadoPortas_SVSH] LEFT JOIN [12_Lotes] ON [14_ImportEstadoPortas_SVSH].Lote = [12_Lotes].NUMLOTEGNF) LEFT JOIN [11_Lotes] 
            ON [14_ImportEstadoPortas_SVSH].Lote = [11_Lotes].NUMLOTEGNF) LEFT JOIN [11_ImportaLoteB] ON [14_ImportEstadoPortas_SVSH].Lote = [11_ImportaLoteB].NUM_LOTE_GNF
            WHERE ((([14_ImportEstadoPortas_SVSH].Tipo)<>'SV') AND (([12_Lotes].NUMLOTEGNF) Is Null) AND (([11_Lotes].NUMLOTEGNF) Is Null) AND 
            (([11_ImportaLoteB].NUM_LOTE_GNF) Is Null))"," ");

        break;

    case 'Visitas':

        $delimitador = ';';
        $cerca = '"';
        $registro = array();
        $Query = new Query;

        $Query->FullQuery("DELETE from [14_ImportVisitasPortasSVSH];"," ");

        // Abrir arquivo para leitura
        $f = fopen('//192.168.0.101/Robo/relatoriovisitasportas.csv', 'r');

        //Leitura do cabeçalho
        $linha = fgetcsv($f, 0, $delimitador, $cerca);

        if ($f) { 

            // Enquanto nao terminar o arquivo
            while (!feof($f)) { 

                // Ler uma linha do arquivo
                $linha = fgetcsv($f, 0, $delimitador, $cerca);
                if (!$linha) {
                    continue;
                }

                // Montar registro com valores indexados pelo cabecalho
                $linha = array_map("utf8_encode", $linha);
                foreach ($linha as $key => $value) {
                    $value = str_replace("'", "", $value);
                    $linha[$key] = "'".$value."'";
                }

                unset($linha[49]);

                //importa do csv para o banco
                $Query->FullQuery("INSERT INTO [14_ImportVisitasPortasSVSH] ([Zona],[Distribuidora],[Delegacao],[Lote],[CIDI],[Mercado],[Municipio],[Estado],[Tipovia],[Via],[Numerovia],[Anexo],[Escadaria],[Bloco],[Piso]
                 ,[Porta],[Bairro],[Gestor],[Empresa],[CodigoAgente],[Nomedoagente],[Movelagente],[ResultadoVisita],[DetalheResultado],[DatadoRelatoriodaVisita]
                 ,[HoradoRelatoriodaVisita],[DatadaVisita],[Horavisita],[DatahoradoUltimoRelatorio],[Tipocombustivelfogao],[Tipocombustivelaquecedor]
                 ,[Tipocombustivelcalefacao],[Tipo_de_Moradia],[Regime_de_posse],[ContrataACS],[Contratafogao],[ContrataCalefacao],[Nome],[Sobrenome]
                 ,[Telefone1],[Telefone2],[Email],[Comentarios],[Foto1],[Foto2],[Foto3],[Foto4],[Foto5],[Foto6]) VALUES (" . implode(",", array_values($linha)) . ")","");
                
            }
            fclose($f);
        }
        

        //traz as visitas que vieram e as coloca no banco, trasz somente se não existir
        $Query->FullQuery("insert into [dbo].[14_ImportVisitasPortas] (
            [Zona] ,[Distribuidora]  ,[Delegacao] ,[Lote]      ,[CIDI]      ,[Mercado]      ,[Municipio]      ,[Estado]      ,[Tipovia]      ,[Via]
            ,[Numerovia]      ,[Anexo]      ,[Escadaria]      ,[Bloco]      ,[Piso]      ,[Porta]      ,[Bairro]      ,[Gestor]      ,[Empresa]      ,[CodigoAgente]
            ,[Nomedoagente]      ,[Movelagente]      ,[ResultadoVisita]      ,[DetalheResultado]      ,[DatadoRelatoriodaVisita]      ,[HoradoRelatoriodaVisita]      ,[DatadaVisita]
            ,[Horavisita]      ,[DatahoradoUltimoRelatorio]      ,[Tipocombustivelfogao]      ,[Tipocombustivelaquecedor]      ,[Tipocombustivelcalefacao]      ,[Tipo_de_Moradia]
            ,[Regime_de_posse]      ,[ContrataACS]      ,[Contratafogao]      ,[ContrataCalefacao]      ,[Nome]      ,[Sobrenome]      ,[Telefone1]      ,[Telefone2]
            ,[Email]      ,[Comentarios]      ,[Foto1]      ,[Foto2]      ,[Foto3]      ,[Foto4]      ,[Foto5]      ,[Foto6]      ,[Datemport])
            select * from [14_ImportVisitasPortasSVSH] V
            WHERE NOT EXISTS (
            select * from [14_ImportVisitasPortas] CV 
            WHERE CV.CIDI = V.CIDI AND
            CV.DatadoRelatoriodaVisita = V.[DatadoRelatoriodaVisita] and
            CV.HoradoRelatoriodaVisita = V.HoradoRelatoriodaVisita);"," ");

        $rowCount = $Query->getResult();

        $Query->FullQuery("INSERT INTO DBO.[00_LogImportacao] (PROCESSO,LINHAS,DATAIMPORT) VALUES ('iMPORTACAO DE VISITAS DO OMNIA ', {$rowCount},GETDATE())"," ");

        $Query->FullQuery("select V.IDLOTE , V.IDCONDESTRUTURA,V.Tipo,V.MotivoVisita,V.IDUSUario,V.DTPGR,V.DATAHORA,V.VENDA,
            V.Resultado,V.D2,V.SVG,V.SVE,V.NomeREsp,V.TLDResp,V.PARENTESCO,V.obs,V.LONGITUDE,V.LATITUDE,V.sTATUS into #temp
            from [14_VW_ImportVisitas] V
            WHERE NOT EXISTS (
            select * from [11_CondVisitas] CV 
            WHERE CV.IDCONDESTRUTURA = V.IDCONDESTRUTURA AND
            year(CV.DATAHORA) = year(V.DATAHORA) and
            month(CV.DATAHORA) = month(V.DATAHORA) and
            day(CV.DATAHORA) = day(V.DATAHORA) and 
            DATEPART(hour,CV.DATAHORA) = DATEPART(hour,V.DATAHORA));"," ");

        //cadastra as visitas no 11 condvisitas
        $Query->FullQuery("INSERT INTO [dbo].[11_CondVisitas]
          ([IDLOTE],[IDCONDESTRUTURA],[TIPO],[MOTIVOVISITA],[IDUSUARIO] ,[DTPGR],[DATAHORA],[VENDA]
          ,[RESULTADO] ,[D2],[SVG],[SVE],[NOMERESP],[TLFRESP],[PARENTESCO],[OBS],[LONGITUDE],[LATITUDE]
          ,[STATUS] )
          select V.IDLOTE , V.IDCONDESTRUTURA,V.Tipo,V.MotivoVisita,V.IDUSUario,V.DTPGR,V.DATAHORA,V.VENDA,
          V.Resultado,V.D2,V.SVG,V.SVE,V.NomeREsp,V.TLDResp,V.PARENTESCO,V.obs,V.LONGITUDE,V.LATITUDE,V.sTATUS
          from #temp V"," ");

        $rowCount = $Query->getResult();

        $Query->FullQuery("INSERT INTO DBO.[00_LogImportacao] (PROCESSO,LINHAS,DATAIMPORT) VALUES ('iMPORTACAO DE VISITAS NO 11CONDVISITAS OMNIA ', {$rowCount},GETDATE());"," ");

        //importa as visitas no 12condvisitas
        $Query->FullQuery("insert into [12_CondVisitas] ([IDCOND] ,[VISITADO],[INTERESSE] ,[PCO] ,[NPCO],[POTENCIAL] ,[TARIFASOCIAL] ,[IDUSUARIO] ,[DATAHORA]
          ,[RESULTADO]  ,[OBS] ,[LATITUDE] ,[LONGITUDE] ,[STATUS] ,[VISANT]  ,[IDUSUARIOAGENDAMENTO] ,[DTPGR]
          ,[DATAAGENDAMENTO]  ,[OBSAGENDAMENTO] ,[TIPOCONTATO] ,[NOMECONTATO] ,[TLFCONTATO] ,[UPDATED] ,[LOCALIZACAOFAKE])
          (select cast(V.IDCOND as int) , cast(V.VISITADO as int), cast(V.INTERESSE as int),cast(V.PCO as int),cast(V.NPCO as int),cast(V.potencial as int),
          cast(V.TARIFASOCIAL as int),cast(V.iduSUARIO as int), V.DATAHORA,cast(V.resultado as int),V.OBS,V.LATITUDE,V.LONGITUDE,cast(V.sTATUS as int),cast(V.visiant as int), V.idusuarioagendamento, V.Dtpgr,
          V.dataagendamento,V.obsagendamento ,cast( V.tipocontato as int), V.nomecontato, V.tlfcontato ,V.updated,V.localizacaofake
          from   [14_VW_ImportVisit3] V
          WHERE NOT EXISTS (
          select CV.IDCOND from [12_CondVisitas] CV 
          WHERE (CV.IDCOND = v.IDCOND AND
          year(CV.DATAHORA) = v.a1 and
          month(CV.DATAHORA) = v.a3 and
          day(CV.DATAHORA) = v.a2 and
          DATEPART(hour,CV.DATAHORA) = v.a4 and
          DATEPART(minute,CV.DATAHORA) = v.a5)));"," ");

        $rowCount = $Query->getResult();

        $Query->FullQuery("INSERT INTO DBO.[00_LogImportacao] (PROCESSO,LINHAS,DATAIMPORT) VALUES ('iMPORTACAO DE VISITAS NO 12CONDVISITAS DO OMNIA ', {$rowCount},GETDATE());"," ");

        //Atualiza as visitas caso da atualização do codigo do agente
        $Query->FullQuery("update [11_CondVisitas]
            set [11_CondVisitas].IDUSUARIO = v.IDUSUario
            from [11_CondVisitas] c
            inner join [14_VW_ImportVisitas] v on c.IDCONDESTRUTURA = v.IDCONDESTRUTURA
            where c.IDUSUARIO is null"," ");

        break;


    case 'Fechados':

        importarCSV('//192.168.0.101/Robo/relatorioestadoportas.csv', "[14_ImportEstadoPortas_SVSH]");
        
        $Query = new Query;

        $Query->FullQuery("select DISTINCT LOTE into #temp from [14_ImportEstadoPortas_SVSH] ORDER BY 1;"," ");

        $Query->FullQuery("update [11_Lotes] set status = 137 FROM [11_Lotes] AS A INNER JOIN #temp AS B ON A.NUMLOTEGNF = B.Lote WHERE A.status = 136;"," ");

        $rowCount = $Query->getResult();

        $Query->FullQuery("INSERT INTO DBO.[00_LogImportacao] (PROCESSO,LINHAS,DATAIMPORT) VALUES ('11LOTES FECHADOS DO OMNIA ', {$rowCount},GETDATE());"," ");

        $Query->FullQuery("update [12_Lotes] set status = 137 FROM [12_Lotes] AS A INNER JOIN #temp AS B ON A.NUMLOTEGNF = B.Lote WHERE A.status = 136;"," ");

        $rowCount = $Query->getResult();

        $Query->FullQuery("INSERT INTO DBO.[00_LogImportacao] (PROCESSO,LINHAS,DATAIMPORT) VALUES ('12LOTES FECHADOS DO OMNIA ', {$rowCount},GETDATE());"," ");

        break;
    endswitch;

    echo "Importação Concluída Com Êxito!";

}catch(Exception $e){
    echo "Erro na Importação: " . $e->getMessage();
}



function importarCSV($file, $tabela){

    $delimitador = ';';
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

?>
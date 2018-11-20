<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App($config);

//GET QUE DEVOLVE TODOS OS TECNICOS CADASTRADOS
$app->get('/tecnicos/', function (Request $request, Response $response, array $args) {
    $Read = new Read;
    $Read->FullRead("SELECT CASE WHEN FUNC.ID IS NOT NULL THEN FUNC.[NOME COMPLETO] ELSE TERC.NOME END AS nome, SUB.PRODUTO AS manometro,
                        [00_NivelAcesso].ID AS id, SUB.IDPROD AS idManometro,
                        CASE WHEN FUNC.ID IS NOT NULL THEN FUNC.SENHA ELSE TERC.SENHA END AS senha,
                        CASE WHEN FUNC.ID IS NOT NULL THEN 'FUNCIONÁRIO' ELSE 'TERCEIRIZADO' END AS tipoFunc FROM [40_Interna_ID]
                        LEFT JOIN Funcionários FUNC ON [40_Interna_ID].USUARIO_PORTADOR = FUNC.ID
                        LEFT JOIN FuncionariosTerceirizados TERC ON [40_Interna_ID].USUARIO_PORTADOR_TERCEIRIZADO = TERC.ID
                        INNER JOIN [00_NivelAcesso] ON FUNC.ID = [00_NivelAcesso].IDFUNCIONARIO OR TERC.ID = [00_NivelAcesso].IDTERCEIRIZADO
                        INNER JOIN(
                        SELECT max([40_Interna].INTERNA) ULTMOV, [40_Produtos].PRODUTO, [40_Produtos].Id IDPROD FROM [40_Produtos]
                        INNER JOIN [40_Interna] ON [40_Produtos].Id = [40_Interna].PRODUTO
                        WHERE [40_Produtos].PRODUTO LIKE 'MANÔMETRO%'
                        GROUP BY [40_Produtos].PRODUTO, [40_Produtos].Id) SUB
                        ON [40_Interna_ID].ID = SUB.ULTMOV
                        WHERE [40_Interna_ID].TIPO_MOVIMENTO = 244 AND MOBILE_GNS = 1
                        ORDER BY NOME"," ");
    if($Read->getResult()):
    	return $response->withJson($Read->getResult());
    else:
    	return $response->withJson("Dados não encontrados!");
    endif;
});

//GET QUE BUSCA AS PEÇAS CADASTRADAS NO SISTEMA
$app->get('/pecas/', function (Request $request, Response $response, array $args) {    
    $Read = new Read;
    $Read->FullRead("SELECT [Id] AS id, [Peca] AS peca, [ValorFinal] AS valor FROM [60_Pecas]", " ");
    if($Read->getResult()):
        return $response->withJson($Read->getResult());
    else:
        return $response->withJson($Read->getResult());
    endif;
});

//GET QUE BUSCA AS PEÇAS CADASTRADAS NO SISTEMA
$app->get('/servicos/', function (Request $request, Response $response, array $args) {    
    $Read = new Read;
    $Read->FullRead("SELECT [Id] AS id, [Codigo] AS codigo, [Descricao] AS descricao, [ValorClienteAssist] AS valorcliente, [ValorClientePAG] AS valorclientepag FROM [60_OS_ListaServicos] WHERE [ValorClienteAssist] <> 0.00 AND [ValorClientePAG] <> 0.00", " ");
    if($Read->getResult()):
        return $response->withJson($Read->getResult());
    else:
        return $response->withJson($Read->getResult());
    endif;
});

//GET QUE BUSCA OS MANOMETROS CADASTRADOS
$app->get('/manometros/', function (Request $request, Response $response, array $args) {    
    $Read = new Read;
    $Read->FullRead("SELECT Id AS id, CODIGO AS codigo, PRODUTO AS manometro
                        FROM [40_Produtos]
                        WHERE (PRODUTO LIKE N'%MANÔMETRO%') AND CODIGO IS NOT NULL", " ");
    if($Read->getResult()):
        return $response->withJson($Read->getResult());
    else:
        return $response->withJson($Read->getResult());
    endif;
});


//GET QUE TESTA O LOGIN DO TECNICO
$app->get('/tecnicos/login/{id}/{senha}', function (Request $request, Response $response, array $args) {
    $id = $request->getAttribute('id');
    $senha = sha1($request->getAttribute('senha'));
    $retorno['msg'] = true;
    
    $Read = new Read;
    $Read->FullRead("SELECT [Funcionários].ID AS id,[NOME COMPLETO] AS nome FROM Funcionários
                        WHERE [Funcionários].GNSMOBILE = 1 AND [ID] = :id AND SENHA = :senha AND Funcionários.[DATA DE DEMISSÃO] IS NULL
                        ORDER BY [NOME COMPLETO]","id={$id}&senha={$senha}");
    if($Read->getResult()):
        return $response->withJson($retorno);
    else:
        $retorno['msg'] = false;
        return $response->withJson($retorno);
    endif;
});

//GET QUE BUSCA AS OS RELACIONADAS AO TÉCNICO
$app->get('/atendimentos/{tecnico}', function (Request $request, Response $response, array $args) {
    $tecnico = $request->getAttribute('tecnico');
    
    $Read = new Read;
    $Read->FullRead("SELECT [60_OS].Id AS idOS, [60_OS].NumOS AS numeroOS, [60_OS].NomeOS AS nomeOS, [60_OS].Status AS statusOS, [60_OS].ObsCEG AS obsCEG,  [60_OS].ObsEmpreiteira AS obsEmpreiteira, CONVERT (date, [60_OS].DataAgendamento) AS DataAgendamento, [60_OS].PeriodoAgendamento AS periodo, [60_OS].Prioridade AS prioridadeOS, [60_OS].Tecnico AS tecnico, [60_OS].Turno AS turno, [60_OS].Endereco AS endereco, [60_OS].Bairro AS bairro, [60_OS].Municipio AS municipio, [60_OS].Cep AS cep, [60_OS].Latitude AS latitude, [60_OS].Longitude AS longitude,
        [60_Clientes].id AS idCliente, [60_Clientes].[CPFCNPJ] AS cpfcnpj, [60_Clientes].NumCliente AS numCliente, [60_Clientes].NomeCliente AS nomeCliente, [60_Clientes].Telefone1 AS telefone1, [60_Clientes].Telefone2 AS telefone2, [60_Clientes].Telefone3 AS telefone3,
               [60_OT].Id AS idOT, [60_OT].NumOT AS numOT, [60_OT].ObsOT AS obsOT, [60_OT].TipoOT AS TipoOT
               FROM [60_Clientes] 
               INNER JOIN [60_OT] on [60_Clientes].Id = [60_OT].Cliente
               INNER JOIN [60_OS] on [60_OT].Id = [60_OS].OT
               WHERE [Tecnico] = :tecnico AND [Status] = 0 AND (DataAgendamento = CONVERT (date, GETDATE())   OR DataAgendamento = DATEADD(day,1,(CONVERT (date, GETDATE()))))","tecnico={$tecnico}");
    if($Read->getResult()):
        return $response->withJson($Read->getResult());
    else:
        return $response->withJson($Read->getResult());
    endif;
});
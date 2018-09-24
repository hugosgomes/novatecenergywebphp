<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App($config);

//GET QUE DEVOLVE TODOS OS TECNICOS CADASTRADOS
$app->get('/tecnicos/', function (Request $request, Response $response, array $args) {
    $Read = new Read;
    $Read->FullRead("SELECT [Funcionários].ID AS id,[NOME COMPLETO] AS nome, [Funcionários].[SENHA] AS senha FROM Funcionários
                        WHERE [Funcionários].GNSMOBILE = 1 AND Funcionários.[DATA DE DEMISSÃO] IS NULL
                        ORDER BY [NOME COMPLETO]"," ");
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
    $Read->FullRead("SELECT [Id] AS id, [Codigo] AS codigo, [Descricao] AS descricao, [ValorClienteAssist] AS valorcliente, [ValorClientePAG] AS valorclientepag FROM [60_OS_ListaServicos]", " ");
    if($Read->getResult()):
        return $response->withJson($Read->getResult());
    else:
        return $response->withJson($Read->getResult());
    endif;
});

//GET QUE BUSCA OS MANOMETROS CADASTRADOS
$app->get('/manometro/', function (Request $request, Response $response, array $args) {    
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
        [60_Clientes].id AS idCliente, [60_Clientes].NumCliente AS numCliente, [60_Clientes].NomeCliente AS nomeCliente, [60_Clientes].Telefone1 AS telefone1, [60_Clientes].Telefone2 AS telefone2, [60_Clientes].Telefone3 AS telefone3,
               [60_OT].Id AS idOT, [60_OT].NumOT AS numOT, [60_OT].ObsOT AS obsOT
               FROM [60_Clientes] 
               INNER JOIN [60_OT] on [60_Clientes].Id = [60_OT].Cliente
               INNER JOIN [60_OS] on [60_OT].Id = [60_OS].OT
               WHERE [Tecnico] = :tecnico AND [Status] = 1 AND (DataAgendamento = CONVERT (date, GETDATE())   OR DataAgendamento = DATEADD(day,1,(CONVERT (date, GETDATE()))))","tecnico={$tecnico}");
    if($Read->getResult()):
        return $response->withJson($Read->getResult());
    else:
        return $response->withJson($Read->getResult());
    endif;
});


/* GET QUE RETORNA O TECNICO PELO ID INFORMADO
$app->get('/tecnicos/{id}', function (Request $request, Response $response, array $args) {
    $id = $request->getAttribute('id');
    $Read = new Read;
    $Read->FullRead("SELECT [p].[ID] AS id,  [p].[NOME COMPLETO] AS nome, [p].[SETOR] AS setor, [p].[TITULO (FUNÇÃO)] AS funcao FROM [Funcionários] AS [p] WHERE [ID] = :id","id={$id}");
    if($Read->getResult()):
    	return $response->withJson($Read->getResult()[0]);
    else:
    	return $response->withJson("Técnico não encontrado!");
    endif;
});

$app->get('/atendimentos/', function (Request $request, Response $response, array $args) {
    //$id = $request->getAttribute('id');
    $Read = new Read;
    $Read->FullRead("SELECT DatePart(Week,GETDATE()) as SEMANA,
						NomeCliente, [60_OS].Id, [60_OS].[OSServico],[60_OS].NumOS, [60_OS].Status, [60_OS].DataAgendamento, [60_OS].Tecnico, [60_OS].turno as TURNO
						FROM [60_Clientes]
						inner join [60_OT] on [60_Clientes].Id = [60_OT].Cliente
						inner join [60_OS] on [60_OT].Id = [60_OS].OT
						WHERE DatePart(Week,[60_OS].DataAgendamento) = DatePart(Week,GETDATE()) AND year([60_OS].DataAgendamento) = year(GETDATE())"," ");
    if($Read->getResult()):
    	return $response->withJson($Read->getResult()[0]);
    else:
    	return $response->withJson("Técnico não encontrado!");
    endif;
});

$app->get('/pecas/', function (Request $request, Response $response, array $args) {
    //$id = $request->getAttribute('id');
    $Read = new Read;
    $Read->FullRead("SELECT ID, Peca, ValorFinal, [40_Unidades].UNIDADE FROM [60_Pecas] inner join [40_Unidades] on [60_Pecas].Unidade = [40_Unidades].[COD]"," ");
    if($Read->getResult()):
    	return $response->withJson($Read->getResult());
    else:
    	return $response->withJson("Peças não encontradas!");
    endif;
});*/
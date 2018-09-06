<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App($config);

//GET QUE DEVOLVE TODOS OS TECNICOS CADASTRADOS
$app->get('/tecnicos/', function (Request $request, Response $response, array $args) {
    $Read = new Read;
    $Read->FullRead("SELECT [p].[ID] AS id,  [p].[NOME COMPLETO] AS nome, [p].[SETOR] AS setor, [p].[TITULO (FUNÇÃO)] AS funcao
                    FROM [Funcionários] AS [p]
                    WHERE [p].[DATA DE DEMISSÃO] IS NULL AND ([p].[TITULO (FUNÇÃO)] = 5) AND [p].[SETOR] = 2
                    ORDER BY [p].[NOME COMPLETO]"," ");
    if($Read->getResult()):
    	return $response->withJson($Read->getResult());
    else:
    	return $response->withJson("Dados não encontrados!");
    endif;
});


//GET QUE TESTA O LOGIN DO TECNICO
$app->get('/tecnicos/login/{id}/{senha}', function (Request $request, Response $response, array $args) {
    $id = $request->getAttribute('id');
    $senha = sha1($request->getAttribute('senha'));
    $retorno['msg'] = true;
    
    $Read = new Read;
    $Read->FullRead("SELECT [p].[ID] AS id,  [p].[NOME COMPLETO] AS nome FROM [Funcionários] AS [p] WHERE [ID] = :id AND SENHA = :senha","id={$id}&senha={$senha}");
    if($Read->getResult()):
        return $response->withJson($retorno);
    else:
        $retorno['msg'] = false;
        return $response->withJson($retorno);
    endif;
});


// GET QUE RETORNA O TECNICO PELO ID INFORMADO
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
});
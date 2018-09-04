<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->put('/{id}', function (Request $request, Response $response, array $args) {
    $id = $request->getAttribute('id');
    $Update = new Update;
    $Update->ExeUpdate(DB_USERS, $request->getParsedBody(), "WHERE user_id = :id", "id={$id}");
    return $response->withJson($Update->getResult());
});
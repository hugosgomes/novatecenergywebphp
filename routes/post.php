<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->post('/', function (Request $request, Response $response, array $args) {
    $Create = new Create;
    $Create->ExeCreate(DB_USERS, $request->getParsedBody());
    return $response->withJson($Create->getResult());
});
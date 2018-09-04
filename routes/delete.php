<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->delete('/{id}', function (Request $request, Response $response, array $args) {
    $id = $request->getAttribute('id');
    $Delete = new Delete;
    $Delete->ExeDelete(DB_USERS, "WHERE user_id = :id", "id={$id}");
    return $response->withJson($Delete->getResult());
});
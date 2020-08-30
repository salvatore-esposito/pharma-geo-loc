<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use GeoPharmsLoc\JSONRPCServer;

$app->get('/', function (Request $request, Response $response, $args) {
  $payload = "{ \"id\": 1, \"jsonrpc\": \"2.0\", \"method\": \"SearchNearestPharmacy\", \"params\": { \"currentLocation\": { \"latitude\": 41.10938993, \"longitude\": 15.0321010 }, \"range\": 5000, \"limit\": 2 } }";

  $jsonrpcServer = new JSONRPCServer;
  $jsonrpcServer->setRequest($payload);

  $newResponse = $response->withHeader('Content-type', 'application/json');
  $newResponse->getBody()->write($jsonrpcServer->getResponse('pharmacies'));

  return $newResponse;
});

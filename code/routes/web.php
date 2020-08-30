<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use GeoPharmsLoc\JSONRPCServer;

$app->get('/', function (Request $request, Response $response, $args) {
  $payload = "{ \"id\": 1, \"jsonrpc\": \"2.0\", \"method\": \"SearchNearestPharmacy\", \"params\": { \"currentLocation\": { \"latitude\": 40.881515, \"longitude\": 14.234398 }, \"range\": 2000, \"limit\": 2 } }";

  $jsonrpcServer = new JSONRPCServer;
  $jsonrpcServer->setRequest($payload);

  $jsonResponse = $response->withHeader('Content-type', 'application/json');
  $jsonResponse->getBody()->write($jsonrpcServer->getResponse('pharmacies'));

  return $jsonResponse;
});

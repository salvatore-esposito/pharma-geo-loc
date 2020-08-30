<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get('/', function (Request $request, Response $response, $args) {
  $response->getBody()->write(
    $this->get('view')->render('index.twig' , [
      'lat' => $coords->getCords()['lat'],
      'lon' => $coords->getCords()['lon']
    ])
  );
  return $response;
});

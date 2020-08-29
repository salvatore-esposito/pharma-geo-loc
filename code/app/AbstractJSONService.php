<?php
declare(strict_types=1);

namespace GeoPharmsLoc;

use GuzzleHttp\Client;

abstract class AbstractJSONService
{
  abstract public static function getPayload(array $params = []) : array;

  protected static function getHttpClientInstance() : \Psr\Http\Client\ClientInterface
  {
    return new Client();
  }

  protected static function getJsonResponse($response) : array
  {
    if($response->getStatusCode() !== 200)
    {
      //todo Must launch an exception if there are problems
      throw new \Exception();
    }
    $contentLength = $response->getHeader('content-length')[0];
    return json_decode($response->getBody()->read($contentLength), TRUE);
  }
}

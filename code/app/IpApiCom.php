<?php
declare(strict_types=1);

namespace GeoPharmsLoc;

class IpApiCom extends AbstractJSONService
{
  private const URL='http://ip-api.com/json/';

  public static function getPayload(array $params = []) : array
  {
    if(!array_key_exists('ip', $params))
    {
      //Need Impment an Execption
      throw new \Exception;
    }

    $client = static::getHttpClientInstance();
    $response = $client->request('GET', self::URL . '/' . $params['ip']);
    return static::getJsonResponse($response);
  }
}
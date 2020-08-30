<?php
declare(strict_types=1);

namespace GeoPharmsLoc;

final class IpApiCom extends AbstractJSONService
{
  private const URL='http://ip-api.com/json/';

  public static function getPayload(array $params = []) : array
  {
    if(!array_key_exists('ip', $params))
    {
      //Need Impment an Exception
      throw new \Exception;
    }

    $client = static::getHttpClientInstance();
    $response = $client->request('GET', self::URL . '/' . $params['ip']);
    return static::getJsonResponse($response);
  }
}

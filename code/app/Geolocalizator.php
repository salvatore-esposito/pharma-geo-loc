<?php
declare(strict_types=1);

namespace GeoPharmsLoc;

use GuzzleHttp\Client;

class Geolocalizator
{
  protected $ip;
  protected $IpAddressHeader;
  protected $coordinates;
  protected const IP_API_SERVICE = 'http://ip-api.com/json/';
  protected $client;

  public function __construct(string $ip = '')
  {
    global $container;

    $this->setAddressHeader($container->get( 'app' )['REMOTE_ADDR_HEADER']);
    $this->setIp($ip);
    $this->client = new Client();
  }

  public function setIp(string $ip) : void
  {
    $this->ip = $ip!=='' ? $ip : $this->getUserIp();
  }

  public function setAddressHeader(string $IpAddressHeader) : void
  {
    $this->IpAddressHeader = $IpAddressHeader;
  }

  public function getIp() : ?string
  {
    return $this->ip;
  }

  private function getUserIp() : ?string
  {
    return $_SERVER[$this->IpAddressHeader];
  }

  public function getLocalizationArray() : array
  {
    $response = $this->client->request('GET', self::IP_API_SERVICE . '/' . $this->getIp());
    if($response->getStatusCode() !== 200)
    {
      throw new \Exception();
    }
    return json_decode($response->getBody()->read(1024), true);
  }

  public function getCoordinates() : Coordinates
  {
    $response = $this->getLocalizationArray();
    //To Do ckeck if they're already in redis, otherwise make call and cache them
    $this->coordinates = new Coordinates([
      'lat' => $response['lat'],
      'lon' => $response['lon']
    ]);
    return $this->coordinates;
  }
}

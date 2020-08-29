<?php
declare(strict_types=1);

namespace GeoPharmsLoc;

class Geolocalizator
{
  protected $ip;
  protected $IpAddressHeader;
  protected $coordinates;

  public function __construct(string $ip = '')
  {
    global $container;

    $this->setAddressHeader($container->get( 'app' )['REMOTE_ADDR_HEADER']);
    $this->setIp($ip);
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
    return IpApiCom::getPayload([
            'ip' => $this->getIp()
           ]);
  }

  public function getCoordinates() : Coordinates
  {
    //need to lauch an exception if there's a malformed json
    $response = $this->getLocalizationArray();
    //todo ckeck if they're already in redis, otherwise make call and cache them
    $this->coordinates = new Coordinates([
      'lat' => $response['lat'],
      'lon' => $response['lon']
    ]);
    return $this->coordinates;
  }
}

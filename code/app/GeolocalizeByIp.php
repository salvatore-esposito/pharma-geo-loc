<?php
declare(strict_types=1);

namespace GeoPharmsLoc;

//Must be rewritten and you have to create an interface to create different localization
//methods
class GeolocalizeByIp implements GeolocalizationMethodInterface
{
  protected $ip;
  protected $IpAddressHeader;
  protected $GeoCoordinate;

  public function __construct(string $ip) //method ByIp
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

  public function performGetGeoCoordinate() : GeoCoordinate
  {
    {
      //need to lauch an exception if there's a malformed json
      $response = IpApiCom::getPayload([
                    'ip' => $this->getIp()
                  ]);;
      //todo ckeck if they're already in redis, otherwise make call and cache them
      $this->GeoCoordinate = new GeoCoordinate([
        'lat' => $response['lat'],
        'lon' => $response['lon']
      ]);

      return $this->GeoCoordinate;
    }
  }
}

<?php
declare(strict_types=1);

namespace GeoPharmsLoc;

class Geolocalizator
{
  protected $method;


  public function __construct(GeolocalizationMethodInterface $method) //method ByIp
  {
    $this->method = $method;
  }

  public function getGeoCoordinate() : GeoCoordinate
  {
    return $this->method->getGeoCoordinates();
  }
}

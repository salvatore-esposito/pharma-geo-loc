<?php
declare(strict_types=1);

namespace GeoPharmsLoc;

class GeolocalizeByUserCoord implements GeolocalizationMethodInterface
{
  protected $geoCoordinate;

  public function __construct(Geocoordinate $geocoordinate)
  {
    $this->geoCoordinate = $geoCoordinate;
  }

  public function performGetGeoCoordinate() : GeoCoordinate
  {
      return $this->geoCoordinate;
  }
}

<?php
declare(strict_types=1);

namespace GeoPharmsLoc;

use Location\GeoCoordinate as GeoGeoCoordinate;
use Location\Distance\Vincenty;

class EarthDistanceCalculator
{
  public static function calculateDistance(GeoCoordinate $GeoCoordinate1, GeoCoordinate $GeoCoordinate2) : float
  {
    $calculator = new Vincenty();
    return $calculator->getDistance($GeoCoordinate1->toCoordinate(), $GeoCoordinate2->toCoordinate()); // returns 128130.850 (meters; ≈128 kilometers)
  }
}

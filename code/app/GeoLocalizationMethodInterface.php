<?php
declare(strict_types=1);

namespace GeoPharmsLoc;

//Must be rewritten and you have to create an interface to create different localization
//methods
interface GeolocalizationMethodInterface
{
  public function getGeoCoordinates() : GeoCoordinate;
}

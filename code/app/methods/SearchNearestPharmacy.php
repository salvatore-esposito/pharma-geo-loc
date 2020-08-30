<?php
declare(strict_types=1);

namespace GeoPharmsLoc\Methods;

use GeoPharmsLoc\MethodInterface as MethodInterface;
use GeoPharmsLoc\Geolocalizator as Geolocalizator;
use GeoPharmsLoc\Geolocalizator as GeolocalizeByIp;
use GeoPharmsLoc\PharmacyFactory as PharmacyFactory;
use GeoPharmsLoc\EarthDistanceCalculator as EarthDistanceCalculator;

final class SearchNearestPharmacy implements MethodInterface
{
  public static function operation() : void
  {
    $geolocalizeMethod = new GeolocalizeByIp('151.70.202.83');
    $geolocalizator = new Geolocalizator($geolocalizeMethod);
    $userCoords = $geolocalizator->getGeoCoordinate();
    $pharmacies = PharmacyFactory::getPharmsArray();

    $distances = [];

    foreach ($pharmacies as $pharmacy) {
      $distance[] = EarthDistanceCalculator::calculateDistance($userCoords,
                                                 $pharmacy->getGeoCoords());

      if($distance < 100000) $distances[] = $distance;
    }
    print_r($distances);
  }
}

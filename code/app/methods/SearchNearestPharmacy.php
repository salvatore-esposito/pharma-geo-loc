<?php
declare(strict_types=1);

namespace GeoPharmsLoc\Methods;

use GeoPharmsLoc\MethodInterface as MethodInterface;
use GeoPharmsLoc\Geolocalizator as Geolocalizator;
use GeoPharmsLoc\PharmacyFactory as PharmacyFactory;
use GeoPharmsLoc\EarthDistanceCalculator as EarthDistanceCalculator;

final class SearchNearestPharmacy implements MethodInterface
{
  public function operation( array $params = [] ) : array
  {
    extract($params);

    $pharmacies = PharmacyFactory::getPharmsArray();

    $pharmaciesWithinRange = [];
    foreach ($pharmacies as $pharmacy) {

      if(count($pharmaciesWithinRange) === $limit) break;

      $distance = EarthDistanceCalculator::calculateDistance($currentLocation,
                                                             $pharmacy->getGeoCoords());
      if($distance <= $range)
        {
          $pharmacy->distance = $distance;
          $pharmaciesWithinRange[] = $pharmacy;
        }
    }
    return $pharmaciesWithinRange;
  }
}

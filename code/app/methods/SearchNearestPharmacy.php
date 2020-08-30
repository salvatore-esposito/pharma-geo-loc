<?php
declare(strict_types=1);

namespace GeoPharmsLoc\Methods;

use GeoPharmsLoc\MethodInterface as MethodInterface;
use GeoPharmsLoc\Geolocalizator as Geolocalizator;
use GeoPharmsLoc\PharmacyFactory as PharmacyFactory;
use GeoPharmsLoc\EarthDistanceCalculator as EarthDistanceCalculator;
use GeoPharmsLoc\GeoCoordinate as GeoCoordinate;

final class SearchNearestPharmacy implements MethodInterface
{
  public function operation( array $params = [] ) : array
  {
    if(!(array_key_exists('range', $params) &&
         array_key_exists('currentLocation', $params) &&
         array_key_exists('limit', $params))
      )
    {
      throw new \InvalidArgumentException('$params must have range,currentLocation and limit keys!');
    }

    extract($params);

    if(!($currentLocation instanceof GeoCoordinate ))
    {
      throw new \InvalidArgumentException('currentLocation must be of GeoCoordinate type!');
    }

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

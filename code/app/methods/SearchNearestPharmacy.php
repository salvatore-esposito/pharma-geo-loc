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
  public static function operation( array $params = [] ) : array
  {
    if(!(array_key_exists('range', $params) &&
         array_key_exists('currentLocation', $params) &&
         array_key_exists('limit', $params))
      )
    {
      throw new \InvalidArgumentException('$params must have range,currentLocation and limit keys!');
    }

    extract($params);

    $currentLocation = new GeoCoordinate([
        'lat' => $currentLocation['latitude'],
        'lon' => $currentLocation['longitude']
      ]);

    $pharmacies = PharmacyFactory::getPharmsArray();

    $pharmaciesWithinRange = [];
    foreach ($pharmacies as $pharmacy) {

    if(count($pharmaciesWithinRange) === $limit) break;


    $distance = EarthDistanceCalculator::calculateDistance($currentLocation,
                                                             $pharmacy->getGeoCoords());
    if($distance <= $range)
      {
        $pharmaciesWithinRange[] = [
          'name' => $pharmacy->getName(),
          'distance' => $distance,
          'location' => [
            'latitude' => $pharmacy->getCoords()['lat'],
            'longitude' => $pharmacy->getCoords()['lon']
          ]];
      }
    }

    usort($pharmaciesWithinRange, function($element1, $element2){
      if ($element1['distance'] == $element2['distance']) {
        return 0;
      }
      return ($element1['distance'] < $element2['distance']) ? -1 : 1;
    });

    return $pharmaciesWithinRange;
  }
}

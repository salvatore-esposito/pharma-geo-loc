<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use GeoPharmsLoc\Methods\SearchNearestPharmacy;
use GeoPharmsLoc\GeolocalizeByIp;
use GeoPharmsLoc\Geolocalizator;

class SearchNearestPharmacyTest extends TestCase
{
  private $searchNearestPharmacy;

    public function setUp() : void
    {
      $this->searchNearestPharmacy = new SearchNearestPharmacy();
    }

    public function testOperation()
    {
      $isWithinRange = FALSE;
      $range = 1000;
      $limit = 2;
      $geolocalizeByIp = new GeolocalizeByIp(require('currentip.php'));
      $geolocalizator = new Geolocalizator($geolocalizeByIp);
      $userCoord = $geolocalizator->getGeoCoordinate()->getCoords();
      $params = [
        'range' => $range,
        'currentLocation' => [
                'latitude' => $userCoord['lat'],
                'longitude' => $userCoord['lon']
              ],
        'limit' => $limit
      ];
      $pharmaciesWithinRange = $this->searchNearestPharmacy->operation($params);
      foreach ($pharmaciesWithinRange as $pharm) {
        $isWithinRange = $pharm->distance < $range;
        if(!$isWithinRange) break;
        continue;
      }
      //Are returned Pharmacies all in Range?
      $this->assertTrue($isWithinRange);

    }

}

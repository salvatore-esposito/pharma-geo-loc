<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use GeoPharmsLoc\Geolocalizator;
use GeoPharmsLoc\GeolocalizeByIp;
use GeoPharmsLoc\GeoCoordinate;

class GeolocalizatorTest extends TestCase
{
  private $geolocalizator;
  private $ipTester;//require('currentip.php'); //put here your ip

    public function setUp() : void
    {
      $this->ipTester  = require('currentip.php');
      $_SERVER['REMOTE_ADDR'] = $this->ipTester;
      $this->geolocalizeByIp = new GeolocalizeByIp($this->ipTester);
      $this->geolocalizator = new Geolocalizator($this->geolocalizeByIp);
    }

    public function testCoords()
    {
      $expectedCoord = new GeoCoordinate(['lat' => 40.9544, 'lon' => 14.267]);
      $this->assertEquals(
        $expectedCoord,
        $this->geolocalizator->getGeoCoordinate()
      );
    }

}

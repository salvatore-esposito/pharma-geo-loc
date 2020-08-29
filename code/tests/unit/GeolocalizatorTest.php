<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use GeoPharmsLoc\Geolocalizator;
use GeoPharmsLoc\Coordinates;

class GeolocalizatorTest extends TestCase
{
  private $geolocalizator;
  private $ipTester = '151.70.202.83';

    public function setUp() : void
    {
      $_SERVER['REMOTE_ADDR'] = $this->ipTester;
      $this->geolocalizator = new Geolocalizator();
    }

    public function testSetIp()
    {
        $this->assertEquals(
          $this->ipTester,
          $this->geolocalizator->getIp(),
          'Ips don\'t match'
        );
    }

    public function testGetUserIp()
    {
      $reflectedGeolocalizator = new ReflectionMethod( $this->geolocalizator , 'getUserIp' );
      $reflectedGeolocalizator ->setAccessible(true);

      $remoteAddres=$this->ipTester;
      $this->assertEquals(
        $remoteAddres,
        $reflectedGeolocalizator ->invoke( $this->geolocalizator),
        'The User ip doesn\'t match the expected one'
      );
    }

    public function testCoords()
    {
      $expectedCoord = new Coordinates(['lat' => 40.9544, 'lon' => 14.267]);
      $this->assertEquals(
        $expectedCoord,
        $this->geolocalizator->getCoordinates()
      );
    }

}

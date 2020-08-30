<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use GeoPharmsLoc\GeolocalizeByIp;
use GeoPharmsLoc\GeoCoordinate;

class GeolocalizeByIpTest extends TestCase
{
  private $geolocalizator;
  private $ipTester;

    public function setUp() : void
    {
      $this->ipTester  = require('currentip.php');

      $_SERVER['REMOTE_ADDR'] = $this->ipTester;
      $this->geolocalizeByIp = new GeolocalizeByIp($this->ipTester);
    }

    public function testSetIp()
    {
        $this->assertEquals(
          $this->ipTester,
          $this->geolocalizeByIp->getIp(),
          'Ips don\'t match'
        );
    }

    public function testGetUserIp()
    {
      $reflectedGeolocalizeByIp = new ReflectionMethod( $this->geolocalizeByIp , 'getUserIp' );
      $reflectedGeolocalizeByIp->setAccessible(true);

      $remoteAddres=$this->ipTester;
      $this->assertEquals(
        $remoteAddres,
        $reflectedGeolocalizeByIp->invoke( $this->geolocalizeByIp),
        'The User ip doesn\'t match the expected one'
      );
    }

}

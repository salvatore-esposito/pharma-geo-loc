<?php
use PHPUnit\Framework\TestCase;
use GeoPharmsLoc\Geolocalizator;

class GeolocalizatorTest extends TestCase
{
  private $geolocalization;
  private $ipTester = '127.0.0.1';

    public function setUp() : void
    {
      $this->geolocalization = new Geolocalizator($this->ipTester);
    }

    public function testSetIp()
    {
        $this->assertEquals(
          $this->ipTester,
          $this->geolocalization->getIp(),
          'Ips don\'t match'
        );
    }

}

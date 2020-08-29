<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use GeoPharmsLoc\EarthDistanceCalculator;
use GeoPharmsLoc\GeoCoordinate;

class EarthDistanceCalculatorTest extends TestCase
{
  private $earthDistanceCalculator;

    public function testCalculateDistance()
    {
      $coordinate1 = new GeoCoordinate(['lat' => 19.820664, 'lon' => -155.468066]); // Mauna Kea Summit
      $coordinate2 = new GeoCoordinate(['lat' => 20.709722, 'lon' => -156.253333]); // Haleakala Summit

      $this->assertEquals(
        128130.850,
        EarthDistanceCalculator::calculateDistance($coordinate1, $coordinate2)
      );
    }

}

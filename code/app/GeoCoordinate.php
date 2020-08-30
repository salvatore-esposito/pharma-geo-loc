<?php
declare(strict_types=1);

namespace GeoPharmsLoc;

use Location\Coordinate;

class GeoCoordinate
{
  protected $coords;

  public function __construct(array $coords)
  {
    $this->setLon($coords['lon']);
    $this->setLat($coords['lat']);
  }

  public function setLon(float $long)
  {
    $this->coords['lon'] = $long;
  }

  public function setLat(float $lat)
  {
    $this->coords['lat'] = $lat;
  }

  public function getCoords() : array
  {
    return $this->coords;
  }

  public function toCoordinate(): Coordinate
  {
      return new Coordinate($this->coords['lat'], $this->coords['lon']);
  }
}

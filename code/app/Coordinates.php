<?php
declare(strict_types=1);

namespace GeoPharmsLoc;

class Coordinates
{
  protected $coords;

  public function __construct(array $coords)
  {
    $this->setLong($coords['lon']);
    $this->setLat($coords['lat']);
  }

  public function setLong(float $long)
  {
    $this->coords['lon'] = $long;
  }

  public function setLat(float $lat)
  {
    $this->coords['lat'] = $lat;
  }

  public function getCords() : array
  {
    return $this->coords;
  }
}

<?php
declare(strict_types=1);

namespace GeoPharmsLoc;

class Coordinates
{
  protected $cords;

  public function __construct(array $coords)
  {
    $this->setLong($coords['lon']);
    $this->setLat($coords['lat']);
  }

  public function setLong(float $long)
  {
    $this->cords['lon'] = $long;
  }

  public function setLat(float $lat)
  {
    $this->cords['lat'] = $lat;
  }

  public function getCords() : array
  {
    return $this->coords;
  }
}

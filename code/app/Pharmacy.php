<?php
declare(strict_types=1);

namespace GeoPharmsLoc;

class Pharmacy
{
  private $name;
  private $coords;

  public function __construct(string $name, GeoCoordinate $coords)
  {
    $this->name = $name;
    $this->coords = $coords;
  }

  public function getName() : string
  {
    return $this->name;
  }

  public function getGeoCoords() : GeoCoordinate
  {
    return $this->coords;
  }

  public function getCoords() : array
  {
    return $this->coords->getCoords();
  }


}

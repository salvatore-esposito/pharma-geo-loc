<?php
declare(strict_types=1);

namespace GeoPharmsLoc;

// note that this class has two responsibilities: make Pharmacies objects and put them
// in an array repository
class PharmacyFactory
{
    public static function createPharmacyObject($name, $coords) : array
    {
      return new Pharmacy( $name, $coords );
    }


    public static function getPharmsArray() : array
    {
      {
        $pharmacies = [];

        //Put this as an arguments
        $jsonPayload = CampaniaPharmacies::getPayload();

        $coords = new GeoCoordinate([ 'lon' => 0, 'lat' => 0]);

        foreach ($jsonPayload as $pharmacy) {

          $coords->setLon($pharmacy['geometry']['GeoCoordinate'][0]);
          $coords->setLat($pharmacy['geometry']['GeoCoordinate'][1]);

          $pharmacies[] = self::createPharmacyObject(
                                               $pharmacy['properties']['Descrizione'],
                                               $coords);
        }
        return $pharmacies;
      }
    }
}

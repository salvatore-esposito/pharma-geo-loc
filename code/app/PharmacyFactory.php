<?php
declare(strict_types=1);

namespace GeoPharmsLoc;

class PharmacyFactory
{
    public static function createPharmsArrayFromJSON() : array
    {
      $pharmacies = [];

      //Put this as arguments
      $jsonPayload = CampaniaPharmacies::getPayload();

      $coords = new GeoCoordinate([ 'lon' => 0, 'lat' => 0]);

      foreach ($jsonPayload as $pharmacy) {

        $coords->setLon($pharmacy['geometry']['GeoCoordinate'][0]);
        $coords->setLat($pharmacy['geometry']['GeoCoordinate'][1]);

        $pharmacies[] = new Pharmacy(
                        $pharmacy['properties']['Descrizione'],
                        $coords
                      );
      }
      return $pharmacies;
    }
}

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

      $coords = new Coordinates([ 'lon' => 0, 'lat' => 0]);

      foreach ($jsonPayload as $pharmacy) {

        $coords->setLon($pharmacy['geometry']['coordinates'][0]);
        $coords->setLat($pharmacy['geometry']['coordinates'][1]);

        $pharmacies[] = new Pharmacy(
                        $pharmacy['properties']['Descrizione'],
                        $coords
                      );
      }
      return $pharmacies;
    }
}

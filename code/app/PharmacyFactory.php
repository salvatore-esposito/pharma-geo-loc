<?php
declare(strict_types=1);

namespace GeoPharmsLoc;

// note that this class has two responsibilities: make Pharmacies objects and put them
// in an array repository
class PharmacyFactory
{
    public static function createPharmacyObject(string $name, GeoCoordinate $coords) : Pharmacy
    {
      return new Pharmacy( $name, $coords );
    }


    public static function getPharmsArray() : array
    {
      {
        $pharmacies = [];

        //Put this as an arguments
        $jsonPayload = CampaniaPharmacies::getPayload();

        echo '<pre>';
        foreach ($jsonPayload as $pharmacy) {

          $pharmacies[] = self::createPharmacyObject(
                                               $pharmacy['properties']['Descrizione'],
                                               new GeoCoordinate([
                                                 'lon' => $pharmacy['geometry']['coordinates'][0],
                                                 'lat' => $pharmacy['geometry']['coordinates'][1]])
                                               );
        }
        return $pharmacies;
      }
    }
}

<?php
declare(strict_types=1);

namespace GeoPharmsLoc;


use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

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
        global $container;

        $cache = new FilesystemAdapter( '', 0, $container->get('app')['CACHE_DIR']);

        $jsonPayloadCacheItem = $cache->getItem('_localpharms.cache');

        if(!$jsonPayloadCacheItem->isHit())
        {
          $jsonPayload = CampaniaPharmacies::getPayload();
          $jsonPayloadCacheItem->set($jsonPayload);
          $cache->save($jsonPayloadCacheItem);
        }
        $jsonPayload = $jsonPayloadCacheItem->get();

        $pharmacies = [];
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

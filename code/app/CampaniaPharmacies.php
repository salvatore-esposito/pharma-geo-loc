<?php
declare(strict_types=1);

namespace GeoPharmsLoc;

final class CampaniaPharmacies extends AbstractJSONService
{
  private const URL='https://dati.regione.campania.it/catalogo/resources/Elenco-Farmacie.geojson';

  public static function getPayload(array $params = []) : array
  {
    $client = static::getHttpClientInstance();
    $response = $client->request('GET', self::URL);
    return static::getJsonResponse($response)['features'];
  }
}

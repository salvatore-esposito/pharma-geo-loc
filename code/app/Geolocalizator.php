<?php
namespace GeoPharmsLoc;

use GuzzleHttp\Client;

class Geolocalizator
{
  protected $ip;

  public function __construct(string $ip = NULL)
  {
    $this->setIp($ip);
  }

  public function setIp(string $ip) : void
  {
    if($ip) $this->ip = $ip;
  }

  public function getIp() : ?string
  {
    if(!$this->ip) return NULL;
    return $this->ip;
  }
}

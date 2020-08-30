<?php
declare(strict_types=1);

namespace GeoPharmsLoc;

use GeoPharmsLoc\Methods\SearchNearestPharmacy as SearchNearestPharmacy;

// note that this class has two responsibilities: make Pharmacies objects and put them
// in an array repository
class JSONRPCServer
{
  public function __construct() {
    //create and configure a laminas server with a factory
    SearchNearestPharmacy::operation();
  }
}

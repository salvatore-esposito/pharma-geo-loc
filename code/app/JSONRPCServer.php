<?php
declare(strict_types=1);

namespace GeoPharmsLoc;

use Laminas\Json\Server\Server as Server;
use Laminas\Json\Server\Request as Request;
use Laminas\Json\Server\Response as Response;
use Laminas\Json\Server\Error as Error;
use GeoPharmsLoc\Methods\SearchNearestPharmacy as SearchNearestPharmacy;

// note that this class has two responsibilities: make Pharmacies objects and put them
// in an array repository
class JSONRPCServer
{
  public function __construct() {
    //create and configure a laminas server with a factory
    //You have to creare a RequestAdapter
    SearchNearestPharmacy::operation();
  }
}

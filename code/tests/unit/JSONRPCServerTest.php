<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use GeoPharmsLoc\JSONRPCServer;

class JSONRPCServerTest extends TestCase
{
  private $jsonrpcserver;
  private $ipTester;

    public function setUp() : void
    {
      $this->$jsonrpcserver  = new JSONRPCServer();
    }
}

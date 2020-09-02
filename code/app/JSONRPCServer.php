<?php
declare(strict_types=1);

namespace GeoPharmsLoc;

use Symfony\Component\Filesystem\Filesystem;

// note that this class has two responsibilities: make Pharmacies objects and put them
// in an array repository
class JSONRPCServer
{
  public $payload;
  private $filesystem;

  public function __construct() {
    $this->filesystem = new Filesystem;
  }

  public function setRequest(string $paramsString) : void
  {
    $this->payload = json_decode($paramsString, TRUE);
  }


  private function performOperation() : array
  {
    if(!$this->filesystem->exists(sprintf("./app/Methods/%s.php", $this->payload['method'])))
     {
       throw new \Exception();
     }

     $method = "GeoPharmsLoc\\Methods\\" . $this->payload['method'];

     $result = forward_static_call(
                      array($method, 'operation'), $this->payload['params']
                    );

     return $result;
  }

  public function getResponse(string $resultName) : string
  {

    try {
      $result = $this->performOperation();
    }
    catch (\Exception $e){
      $resultName = 'Error:';
      $result = [ 'message' => 'method not found', 'code' => -32601 ];
    }

    $response  = [
      'jsonrpc' => '2.0',
      'id' => $this->payload['id'],
      'result' => [
        $resultName => $result
      ]
    ];

    return json_encode($response);
  }
}

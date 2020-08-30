<?php

declare(strict_types=1);

namespace GeoPharmsLoc;

interface MethodInterface
{
  public function operation(array $params) : array;
}

<?php

namespace App\core;

class Application
{
  public static $DIR_ROOT;
  public function __construct($root)
  {
    self::$DIR_ROOT = $root;
    $this->request = new Request();
    $this->route = new Route($this->request);
  }

  public function run()
  {
    $this->route->call();
  }
}

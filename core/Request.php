<?php

namespace App\core;

class Request
{
  public function url()
  {
    $method = $_SERVER["REQUEST_METHOD"];
    $path = $_SERVER["REQUEST_URI"];

    return ["method" => $method, "path" => $path];
  }
}

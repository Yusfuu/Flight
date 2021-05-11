<?php

namespace App\core;

class Response
{
  public static function json($body)
  {
    header('Content-Type: application/json');
    exit(json_encode($body));
  }

  public static function make($error, $code, $type, $message)
  {
    return [
      "error" => $error,
      "code" => $code,
      "type" => $type,
      "message" => $message
    ];
  }
}

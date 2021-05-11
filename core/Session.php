<?php

namespace App\core;

class Session
{
  public static function put(string $key, $value)
  {
    if (!isset($_SESSION)) session_start();
    $_SESSION[$key] = $value;
  }

  public static function flush()
  {
    if (!isset($_SESSION)) session_start();
    $_SESSION = array();
    session_destroy();
  }

  public static function get(string $key)
  {
    if (!isset($_SESSION)) session_start();
    return $_SESSION[$key] ?? false;
  }
}

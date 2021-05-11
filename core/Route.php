<?php

namespace App\core;

class Route
{
  private static $routemap = [];

  public function __construct($request)
  {
    $this->request = $request->url();
  }

  public static function get($path, $fn)
  {
    self::$routemap["GET"][$path] = $fn;
  }

  public static function post($path, $fn)
  {
    self::$routemap["POST"][$path] = $fn;
  }

  public function call()
  {
    $method = $this->request["method"];
    $path = $this->request["path"];

    $callback = self::$routemap[$method][$path] ?? false;

    if ($callback === false) {
      http_response_code(404);
      return include_once Application::$DIR_ROOT . "/views/_404.php";
    }

    return call_user_func($callback);
  }

  public static function render($view)
  {
    return include_once Application::$DIR_ROOT . "/views/$view.php";
  }

  public static function view($view, ?array $params = [])
  {
    ob_start();
    self::render($view);
    $layout = ob_get_clean();

    if (preg_match_all("/{{(.*?)}}/", $layout, $m)) {
      foreach ($m[1] as $key => $value) {
        $layout = str_replace($m[0][$key], sprintf('%s', $params[$value]), $layout);
      }
    }
    exit($layout);
  }
}

<?php

namespace App\controllers;

use App\core\Response;
use App\models\Token;

class Controller
{
  public function next()
  {
    $auth = new Token();

    if ($auth->isAuthenticated() === false) {
      $response = Response::make(true, 403, "forbidden", "Unauthorized");
      return Response::json($response);
    }

    $admin = (array) $auth->verify($_COOKIE["jwtcookie"])["body"]->data;

    if ($admin["credentials"] === "basic") {
      $response = Response::make(true, 403, "forbidden", "Unauthorized");
      return Response::json($response);
    }
  }


  public static function redirect(string $path)
  {
    header("Location: http://" . $_SERVER["HTTP_HOST"] . "$path");
    exit;
  }

  function filter($str)
  {
    if (is_numeric($str) || is_array($str)) {
      return $str;
    }
    $str = trim($str);
    $str = stripslashes($str);
    $str = htmlspecialchars($str);
    return strlen($str) === 0 ? false : $str;
  }

  public function validate($array, $labels = [])
  {
    if (count(array_intersect_key(array_flip($labels), $array)) === count($labels)) {
      $arrBody = [];
      foreach ($array as $key => $value) {
        $str = $this->filter($value);
        if ($str === false) {
          return false;
        }
        $arrBody[$key] = $value;
      }
      return $arrBody;
    }
    return false;
  }

  public function assertExactJson()
  {
    $method = $_SERVER["REQUEST_METHOD"];
    $contentType = $_SERVER["CONTENT_TYPE"] ?? false;
    $object = json_decode(file_get_contents("php://input"), true);

    if ($method !== "POST") {
      http_response_code(400);
      $response = Response::make(true, 400, "bad request", "Only POST requests are allowed");
      return Response::json($response);
    }

    if ($contentType !== "application/json") {
      http_response_code(400);
      $response = Response::make(true, 400, "bad request", "Content-Type header must be set to application/json");
      return  Response::json($response);
    }

    if (!is_array($object)) {
      http_response_code(400);
      $response = Response::make(true, 400, "bad request", "Body is not specified or specified incorrectly");
      return  Response::json($response);
    }
    return $object;
  }
}

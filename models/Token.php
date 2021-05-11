<?php

namespace App\models;

use \Firebase\JWT\JWT;

class Token
{

  public function __construct()
  {
    $this->key = $_ENV["KEY"];
  }

  public function create($body)
  {
    $iat = time();
    $exp = $iat + 31557600;
    $payload = array(
      "iat" => $iat,
      "exp" => $exp,
      "data" => $body
    );
    $jwt = JWT::encode($payload, $this->key);
    return $jwt;
  }


  public function verify(?string $jwt = null)
  {
    try {
      $decoded = JWT::decode($jwt, $this->key, array('HS256'));
      return ["error" => false, "body" => $decoded];
    } catch (\Throwable $th) {
      return ["error" => true, "body" => null];
    }
  }
  public function isAuthenticated()
  {
    session_start();
    return isset($_COOKIE["jwtcookie"]) && $this->verify($_COOKIE["jwtcookie"])["error"] === false;
  }

  public function id()
  {
    return $this->verify($_COOKIE["jwtcookie"])["body"]->data->id;
  }
}

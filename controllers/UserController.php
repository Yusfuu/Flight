<?php

namespace App\controllers;

use App\core\Response;
use App\models\Token;
use App\models\User;

class UserController
{
  public static function signup()
  {
    $middleware = new Controller();
    $json = $middleware->assertExactJson();
    $body = $middleware->validate($json, ["email", "password", "firstName", "lastName"]);

    if ($body === false) {
      $response = Response::make(true, 400, "bad request", "required attribute");
      return  Response::json($response);
    }

    $email = $body["email"];
    $password = $body["password"];
    $firstName = $body["firstName"];
    $lastName = $body["lastName"];

    $user = new User();
    $response = $user->signup($email, $password, $firstName, $lastName);

    Response::json($response);
  }

  public static function signin()
  {
    $middleware = new Controller();
    $json = $middleware->assertExactJson();
    $body = $middleware->validate($json, ["email", "password"]);

    if ($body === false) {
      $response = Response::make(true, 400, "bad request", "required attribute");
      return  Response::json($response);
    }

    $email = $body["email"];
    $password = $body["password"];

    $user = new User();
    $response = $user->signin($email, $password);

    Response::json($response);
  }

  public static function logout()
  {
    $middleware = new Controller();
    $json = $middleware->assertExactJson();
    $body = $middleware->validate($json, ["logout"]);

    $logout = $body["logout"] ?? false;

    if ($logout === true) {
      $user = new User();
      $response = $user->logout();
      Response::json($response);
    }
  }

  public static function reservation()
  {

    $middleware = new Controller();
    $json = $middleware->assertExactJson();
    $body = $middleware->validate($json, ["fid", "passengers"]);
    $auth = new Token();
    $user = new User();

    $fid = $body["fid"];
    $passengers = $body["passengers"];
    $id = $auth->id();
    $response = $user->reservation($id, $fid, $passengers);
    Response::json($response);
  }

  public static function _reservation()
  {
    $auth = new Token();
    $id = $auth->id();
    $user = new User();
    $response = $user->_reservation($id);
    Response::json($response);
  }

  public static function delete()
  {
    $middleware = new Controller();
    $json = $middleware->assertExactJson();
    $body = $middleware->validate($json, ["rid"]);

    if ($body === false) {
      $response = Response::make(true, 400, "bad request", "required attribute");
      return  Response::json($response);
    }

    $user = new User();

    $rid = $body["rid"];
    $response = $user->delete($rid);
    Response::json($response);
  }
}

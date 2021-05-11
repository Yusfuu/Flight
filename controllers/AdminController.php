<?php

namespace App\controllers;

use App\core\Response;
use App\models\Admin;
use App\models\Flight;
use App\models\User;

class AdminController
{
  public static function signin()
  {
    $middleware = new Controller();

    $json = $middleware->assertExactJson();

    $body = $middleware->validate($json, ["email", "password"]);

    $email = $body["email"];
    $password = $body["password"];

    $admin = new Admin();
    $response = $admin->signin($email, $password);
    Response::json($response);
  }

  public static function logout()
  {
    $middleware = new Controller();
    $middleware->next();

    $json = $middleware->assertExactJson();
    $body = $middleware->validate($json, ["logout"]);

    $logout = $body["logout"] ?? false;

    if ($logout === true) {
      $user = new User();
      $response = $user->logout();
      Response::json($response);
    }
  }

  public static function flights()
  {
    $flight = new Flight();
    $response = $flight->flights();
    Response::json($response);
  }

  public static function _reservation()
  {
    $middleware = new Controller();
    $middleware->next();

    $flight = new Flight();
    $response = $flight->_reservation();
    Response::json($response);
  }

  public static function add()
  {
    $middleware = new Controller();
    $middleware->next();
    $json = $middleware->assertExactJson();

    $body = $middleware->validate($json, ["type", "origin", "destination", "departing", "returning", "price", "seats"]);

    if ($body === false) {
      $response = Response::make(true, 400, "bad request", "required attribute");
      return  Response::json($response);
    }

    $type = $body["type"];
    $origin = $body["origin"];
    $destination = $body["destination"];
    $departing = $body["departing"];
    $returning = $body["returning"];
    $price = $body["price"];
    $seats = $body["seats"];

    $flight = new Flight();
    $response = $flight->add($type, $origin, $destination, $departing, $returning, $price, $seats);

    $response["res"]["id"] = $response["id"];
    $response = $response["res"];

    Response::json($response);
  }

  public static function delete()
  {
    $middleware = new Controller();
    $middleware->next();
    $json = $middleware->assertExactJson();
    $body = $middleware->validate($json, ["id"]);

    if ($body === false) {
      $response = Response::make(true, 400, "bad request", "required attribute");
      return  Response::json($response);
    }

    $id = $body["id"];
    $flight = new Flight();
    $response = $flight->delete($id);
    Response::json($response);
  }

  public static function edite()
  {
    $middleware = new Controller();
    $middleware->next();
    $json = $middleware->assertExactJson();
    $body = $middleware->validate($json, ["id", "type", "origin", "destination", "departing", "returning", "price", "seats"]);

    if ($body === false) {
      $response = Response::make(true, 400, "bad request", "required attribute");
      return  Response::json($response);
    }

    $id = $body["id"];
    $type = $body["type"];
    $origin = $body["origin"];
    $destination = $body["destination"];
    $departing = $body["departing"];
    $returning = $body["returning"];
    $price = $body["price"];
    $seats = $body["seats"];

    $flight = new Flight();
    $response = $flight->edite($id, $type, $origin, $destination, $departing, $returning, $price, $seats);
    Response::json($response);
  }

  public static function pagination()
  {
    $middleware = new Controller();
    $json = $middleware->assertExactJson();
    $body = $middleware->validate($json, ["offset"]);

    if ($body === false) {
      $response = Response::make(true, 400, "bad request", "required attribute");
      return  Response::json($response);
    }

    $offset = $json["offset"];
    $flight = new Flight();
    $response = $flight->pagination($offset);
    Response::json($response);
  }
}

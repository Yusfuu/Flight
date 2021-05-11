<?php

namespace App\controllers;

use App\core\Route;
use App\models\Token;

class UserViewController
{
  public static function signin()
  {
    $auth = new Token();

    if ($auth->isAuthenticated() === true) {
      Controller::redirect("/account/dashboard");
    }

    Route::render("User/signin");
  }

  public static function signup()
  {
    $auth = new Token();

    if ($auth->isAuthenticated() === true) {
      Controller::redirect("/account/dashboard");
    }

    Route::render("User/signup");
  }

  public static function dashboard()
  {
    $auth = new Token();

    if ($auth->isAuthenticated() === false) {
      Controller::redirect("/account/signin");
    }

    $user = (array) $auth->verify($_COOKIE["jwtcookie"])["body"]->data;

    if ($user["credentials"] === "admin") {
      Controller::redirect("/a/account/dashboard");
    }

    Route::view("User/dashboard", $user);
  }

  public static function reservation()
  {
    $auth = new Token();

    if ($auth->isAuthenticated() === false) {
      Controller::redirect("/account/signin");
    }

    $user = (array) $auth->verify($_COOKIE["jwtcookie"])["body"]->data;

    if ($user["credentials"] === "admin") {
      Controller::redirect("/a/account/dashboard");
    }

    Route::view("User/reservation", $user);
  }
  public static function home()
  {
    Route::render("home");
  }
}

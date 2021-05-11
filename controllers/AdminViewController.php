<?php

namespace App\controllers;

use App\core\Route;
use App\models\Token;

class AdminViewController
{
  public static function dashboard()
  {
    $auth = new Token();

    if ($auth->isAuthenticated() === false) {
      Controller::redirect("/a/account/signin");
    }

    $admin = (array) $auth->verify($_COOKIE["jwtcookie"])["body"]->data;

    if ($admin["credentials"] === "basic") {
      Controller::redirect("/account/dashboard");
    }

    Route::view("Admin/dashboard", $admin);
  }
  public static function signin()
  {
    $auth = new Token();

    if ($auth->isAuthenticated() === true) {
      Controller::redirect("/a/account/dashboard");
    }

    Route::render("Admin/signin");
  }

  public static function reservation()
  {
    $auth = new Token();

    if ($auth->isAuthenticated() === false) {
      Controller::redirect("/a/account/signin");
    }

    $admin = (array) $auth->verify($_COOKIE["jwtcookie"])["body"]->data;

    if ($admin["credentials"] === "basic") {
      Controller::redirect("/account/dashboard");
    }

    Route::view("Admin/reservation", $admin);
  }
}

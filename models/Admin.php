<?php

namespace App\models;

use App\core\Response;
use App\core\Session;

class Admin
{
  public function signin($email, $password)
  {
    $dbh = Database::connect();
    $query = "SELECT * FROM admin WHERE email = ?;";
    $sth = $dbh->prepare($query);
    $sth->execute([$email]);

    if ($sth->rowCount() === 0) {
      return Response::make(true, 400, "bad request", "The email you entered doesn't belong to any account");
    }

    $admin = $sth->fetch();

    if (!password_verify($password, $admin["password"])) {
      return Response::make(true, 401, "Unauthorized", "Authentication Failed");
    }

    // remove password from array and set credentials
    unset($admin["password"]);
    $admin["credentials"] = "admin";

    // set cookie of token
    $this->cookie($admin);
    Session::put("authenticate", true);
    return Response::make(false, 200, "success", "Authentication Success");
  }

  public function cookie($main)
  {
    $token = new Token();
    $jwt = $token->create($main);
    setcookie("jwtcookie", $jwt, time() + 31557600, "/", $_SERVER["SERVER_NAME"], true, true);
  }

  public function logout()
  {
    Session::flush();
    setcookie("jwtcookie", "", time() - 3600, "/", $_SERVER["SERVER_NAME"], true, true);
    return Response::make(false, 200, "success", "Success");
  }
}

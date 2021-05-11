<?php

namespace App\models;

use App\core\Response;
use App\core\Session;

class User
{
  private function emailExist($_email, $dbh)
  {
    $email = filter_var($_email, FILTER_VALIDATE_EMAIL);
    $query = "SELECT email FROM users WHERE email = ?;";
    $sth = $dbh->prepare($query);
    $sth->execute([$email]);
    return $sth->rowCount();
  }

  public function signin($email, $password)
  {
    $dbh = Database::connect();

    if ($this->emailExist($email, $dbh) === 0) {
      return Response::make(true, 400, "bad request", "The email you entered doesn't belong to any account");
    }

    $query = "SELECT * FROM users WHERE email = ?;";
    $sth = $dbh->prepare($query);
    $sth->execute([$email]);
    $user = $sth->fetch();

    // verify hash password
    if (!password_verify($password, $user["password"])) {
      return Response::make(true, 401, "Unauthorized", "Authentication Failed");
    }

    // remove password from array and set credentials
    unset($user["password"]);
    $user["credentials"] = "basic";

    // set cookie of token
    $this->cookie($user);
    Session::put("authenticate", true);
    return Response::make(false, 200, "success", "Authentication Success");
  }

  public function signup($email, $password, $firstName, $lastName)
  {
    $dbh = Database::connect();

    if ($this->emailExist($email, $dbh) > 0) {
      return Response::make(true, 400, "bad request", "Another account is using $email");
    }

    $query = "INSERT INTO users (email, password, firstName, lastName) VALUES (?, ?, ?, ?);";
    $sth = $dbh->prepare($query);

    // hash password
    $password = password_hash($password, PASSWORD_DEFAULT);
    $sth->execute([$email, $password, $firstName, $lastName]);

    // set cookie of token
    $this->cookie(["id" => $dbh->lastInsertId(), "email" => $email, "firstName" => $firstName, "lastName" => $lastName, "credentials" => "basic"]);

    return Response::make(false, 200, "success", "Success");
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

  public function reservation($uid, $fid, $passengers = [])
  {
    $dbh = Database::connect();

    // check seats 
    $flight = new Flight();
    $seats = $flight->seats($fid);
    $howManyPassenger = count($passengers) + 1;

    if ($seats < $howManyPassenger) {
      return Response::make(true, 200, "error", "empty seats");
    }

    $sth = $dbh->prepare("INSERT INTO reservation (uid, fid) VALUES (?, ?);");
    $sth->execute([$uid, $fid]);
    $rid = $dbh->lastInsertId();

    if (!empty($passengers)) {
      $sth = $dbh->prepare("INSERT INTO passenger (rid, name, birth) VALUES (?, ?, ?);");
      foreach ($passengers as $value) {
        array_unshift($value, $rid);
        $sth->execute(array_values($value));
      }
    }

    $sth = $dbh->prepare("UPDATE flight SET seats = ? WHERE id = ?;");
    $sth->execute([$seats - $howManyPassenger, $fid]);

    return Response::make(false, 200, "success", "Success");
  }


  public function _reservation($id)
  {
    $dbh = Database::connect();
    $query = "SELECT f.id,f.type,f.origin,f.destination,f.departing,f.returning,f.seats,f.price,r.id as rid
    FROM flight f
    INNER JOIN reservation r ON r.uid = ? AND r.fid = f.id;";
    $sth = $dbh->prepare($query);
    $sth->execute([$id]);
    $result = $sth->fetchAll();
    return ["body" => $result];
  }

  public function delete($rid)
  {
    $dbh = Database::connect();

    $sth = $dbh->prepare("SELECT COUNT(*) FROM reservation WHERE id = ? AND uid = ?;");
    $sth->execute([$rid, (new Token())->id()]);
    if ($sth->fetchColumn() == 0) {
      return Response::make(true, 400, "bad request", "Unauthorized");
    }

    // get reservation info
    $sth = $dbh->prepare("SELECT * FROM reservation WHERE id = ?;");
    $sth->execute([$rid]);
    $reservation = $sth->fetch();

    // update flight
    $flight = new Flight();

    $sth = $dbh->prepare("SELECT COUNT(rid) FROM `passenger` WHERE rid = ?;");
    $sth->execute([$rid]);
    $c = $sth->fetchColumn();

    $fid = $reservation["fid"];
    $seats = $flight->seats($fid);
    $dbh->prepare("UPDATE flight SET seats = ? WHERE id = ?;")->execute([($c + $seats + 1), $fid]);

    // delete reservation
    $dbh->prepare("DELETE FROM reservation WHERE id = ?;")->execute([$rid]);
    return Response::make(false, 200, "success", "reservation deleted");
  }
}

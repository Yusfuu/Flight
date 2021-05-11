<?php

namespace App\models;

use App\core\Response;

class Flight
{
  public function flights()
  {
    $dbh = Database::connect();
    $sth = $dbh->prepare("SELECT * FROM flight WHERE seats <> 0;");
    $sth->execute();
    $result = $sth->fetchAll();
    Response::json(["body" => $result]);
  }

  public function _reservation()
  {
    $dbh = Database::connect();
    $query = "SELECT f.type,f.origin,f.destination,f.departing,f.returning,f.seats,f.price,u.firstName,u.lastName
              FROM flight f
              INNER JOIN reservation r ON f.id = r.fid
              INNER JOIN users u ON u.id = r.uid";
    $sth = $dbh->prepare($query);
    $sth->execute();
    $result = $sth->fetchAll();
    Response::json(["body" => $result]);
  }

  public function edite($id, $type, $origin, $destination, $departing, $returning, $price, $seats)
  {
    $dbh = Database::connect();
    $query = "UPDATE flight SET type = ? , origin = ?, destination = ?, departing = ?, returning = ?, price = ?, seats = ? WHERE id = ?;";
    $sth = $dbh->prepare($query);
    $sth->execute([$type, $origin, $destination, $departing, $returning, $price, $seats, $id]);
    return Response::make(false, 200, "success", "Flight edited");
  }

  public function delete($id)
  {
    $dbh = Database::connect();
    $dbh->prepare("DELETE FROM flight WHERE id = ?")->execute([$id]);
    return Response::make(false, 200, "success", "Flight deleted");
  }

  public function add($type, $origin, $destination, $departing, $returning, $price, $seats)
  {
    $dbh = Database::connect();
    $query = "INSERT INTO flight (type, origin, destination, departing, returning, seats, price) VALUES (?, ?, ?, ?, ?, ?, ?);";

    $sth = $dbh->prepare($query);
    $sth->execute([$type, $origin, $destination, $departing, $returning, $seats, $price]);
    return ["res" => Response::make(false, 200, "success", "Flight added"), "id" => $dbh->lastInsertId()];
  }

  public function seats($fid)
  {
    $dbh = Database::connect();
    $sth = $dbh->prepare("SELECT seats FROM flight WHERE id = ?;");
    $sth->execute([$fid]);
    return $sth->fetch()["seats"];
  }


  public function pagination($offset)
  {
    $dbh = Database::connect();
    $sth = $dbh->prepare("SELECT * FROM flight WHERE seats <> 0 LIMIT 6 OFFSET $offset;");
    $sth->execute();
    $result = $sth->fetchAll();
    return ["body" => $result, "offset" => $offset];
  }
}

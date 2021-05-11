<?php

use App\controllers\AdminController;
use App\controllers\AdminViewController;
use App\controllers\UserController;
use App\controllers\UserViewController;
use App\core\Application;
use App\core\Route;

require __DIR__ . "/../vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

$app = new Application(dirname(__DIR__));

// handle GET request for user
Route::get("/", [UserViewController::class, "home"]);
Route::get("/home", [UserViewController::class, "home"]);
Route::get("/account/signup", [UserViewController::class, "signup"]);
Route::get("/account/signin", [UserViewController::class, "signin"]);
Route::get("/account/dashboard", [UserViewController::class, "dashboard"]);
Route::get("/account/reservation", [UserViewController::class, "reservation"]);
Route::get("/account/api/reservation", [UserController::class, "_reservation"]);

// handle POST request for user
Route::post("/account/signup", [UserController::class, "signup"]);
Route::post("/account/signin", [UserController::class, "signin"]);
Route::post("/account/logout", [UserController::class, "logout"]);
Route::post("/account/reservation", [UserController::class, "reservation"]);
Route::post("/account/api/reservation/delete", [UserController::class, "delete"]);


// handle GET request for admin
Route::get("/a/account/dashboard", [AdminViewController::class, "dashboard"]);
Route::get("/a/account/signin", [AdminViewController::class, "signin"]);
Route::get("/a/account/reservation", [AdminViewController::class, "reservation"]);
Route::get("/api/flights", [AdminController::class, "flights"]);
Route::get("/api/reservation", [AdminController::class, "_reservation"]);

// handle POST request for admin
Route::post("/a/account/signin", [AdminController::class, "signin"]);
Route::post("/a/account/logout", [AdminController::class, "logout"]);
Route::post("/api/flights/add", [AdminController::class, "add"]);
Route::post("/api/flights/delete", [AdminController::class, "delete"]);
Route::post("/api/flights/edite", [AdminController::class, "edite"]);

Route::post("/api/reservation/pagination", [AdminController::class, "pagination"]);

$app->run();

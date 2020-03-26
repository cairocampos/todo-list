<?php
session_start();
require __DIR__."/vendor/autoload.php";

use CoffeeCode\Router\Router;

global $router;
$router = new Router(ROOT);

$router->namespace("Source\App");

$router->group(null);
$router->get("/", "Web:home");
$router->get("/register", "Web:register");
$router->post("/register", "Web:register");
$router->get("/login", "Web:login");
$router->post("/login", "Web:login");
$router->get("/logout", "Web:logout");

$router->group("ops");
$router->get("/{errcode}", "Web:error");


$router->group("api");
$router->get("/tasks", "Api:tasks");
$router->post("/tasks", "Api:tasks");
$router->delete("/tasks", "Api:tasks");
$router->put("/tasks", "Api:tasks");

$router->dispatch();

if($router->error()) {
    $router->redirect("/ops/{$router->error()}");
}
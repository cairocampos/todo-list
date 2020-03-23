<?php

require __DIR__."/../../vendor/autoload.php";

use Source\Models\User;
use CoffeeCode\DataLayer\Connect;

global $db;
$db = Connect::getInstance();
$error = Connect::getError();

if($error) {
    echo "Connection Failed: {$error->getMessage()}";
    die();
}

function url(string $uri = null) {
    if($uri) {
        return ROOT."{$uri}";
    }
    return ROOT;
}

function isLogged() {
    $user = new User;
    if(!$user->checkLogin()) {
       return false;
    }

    return true;
}
<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class User extends DataLayer
{   
    private $info;

    public function __construct() 
    {
        parent::__construct("users", ["email", "pass"]);
    }

    public function checkLogin()
    {
        if(isset($_SESSION["token"]) && !empty($_SESSION["token"])) {
            $user = $this->find("token = :utoken", "utoken={$this->info->token}")->fetch();

            if($user->token == $_SESSION["token"]) {
                return true;
            }
        }

        return false;
    }

    public function save(): bool
    {
        $user = (new User)->find("email = :email", "email={$this->email}")->count();
        if($user) {
            return false;
        } else {
            parent::save();
            return true;
        }
    }
}
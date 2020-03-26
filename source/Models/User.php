<?php

namespace Source\Models;

use Source\Models\Task;
use CoffeeCode\DataLayer\DataLayer;

class User extends DataLayer
{   
    public $info;

    public function __construct() 
    {
        parent::__construct("users", ["email", "pass"]);
    }

    public function checkLogin()
    {
        if(isset($_SESSION["token"]) && !empty($_SESSION["token"])) {
            $user = $this->find("token = :utoken", "utoken={$_SESSION['token']}")->fetch();
            if($user->token == $_SESSION["token"]) {
                $this->info = $user;
                return true;
            }
        }

        return false;
    }

    public function createToken($user_id): string
    {
        $hash = md5(time().rand(0,999).rand(0,999).time());
        $user = $this->findById($user_id);

        if($user) {
            $user->token = $hash;
            $user->save();
            return $hash;
        }

        return false;
        
    }

    public function getInfo() {
        return $this->find("token = :utoken", "utoken={$_SESSION["token"]}")->fetch();
    }

    /*public function save(): bool
    {
        $user = (new User)->find("email = :email", "email={$this->email}")->count();
        if($user) {
            return false;
        } else {
            parent::save();
            return true;
        }
    }*/

    public function getTasks() 
    {   
        $user = $this->find("token = :utoken", "utoken={$_SESSION['token']}")->fetch();
        return (new Task)->find("id_user = :uid", "uid={$user->id}")->fetch(true);
    }
}
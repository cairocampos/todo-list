<?php
namespace Source\App;

use Source\Models\User;
use League\Plates\Engine;

class Web
{   
    private $view;

    public function __construct()
    {   
        $this->view = Engine::create(__DIR__."/../../themes", "php");
    }

    public function home(): void
    {   
        if(!isLogged()) {
            echo $this->view->render("login", []);
            die();
        }
        echo $this->view->render("home", []);
    } 

    public function register(): void 
    {   
        $arr = [];
       if(!empty($_POST["name"]) && !empty($_POST["email"]) && !empty($_POST["pass"])) {
        $user = new User;
        $user->name = $_POST["name"];
        $user->email = $_POST["email"];
        $user->pass = $_POST["pass"];
        $u = $user->save();

        if($u) {
            $arr["success"] = "Usuário cadastrado com sucesso!";
        } else {
            $arr["error"] = "Já existe um usuário com esse E-mail ativo!";
        }
       }         

        echo $this->view->render("register", $arr);
    }

    public function error(array $data)
    {
        echo "erro {$data['errcode']}";
    }
}
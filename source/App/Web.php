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
        $arr = [];
        if(!isLogged()) {
            header("Location: ".url("/login"));
            die();
        }

        $arr["tasks"] = (new User)->getTasks();
       
        echo $this->view->render("home", $arr);
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

    public function login() {
        $arr = [];
        if(!empty($_POST["email"]) && !empty($_POST["pass"])) {
            $user = new User;
            $user->email = $_POST["email"];
            $user->pass = $_POST["pass"];
            $u = $user->find("email = :email", "email={$user->email}")->fetch();
            if($u->email) {
                if($user->pass === $u->pass) {
                    $_SESSION["token"] = $user->createToken($u->id);
                    header("Location: ".url());
                    exit;
                } else {
                    $arr["error"] = "Senha incorreta!";
                }
            } else {
                $arr["error"] = "Email incorreto!";
            }
        }
        
        echo $this->view->render("login", $arr);
    }

    public function logout() {
        unset($_SESSION["token"]);
        header("Location: ".url());
        exit;
    }

    public function error(array $data)
    {   
        http_response_code($data['errcode']);
        echo "erro {$data['errcode']}";
    }
}
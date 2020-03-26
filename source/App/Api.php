<?php

namespace Source\App;

use Source\Models\Task;
use Source\Models\User;

class Api 
{   
    private $method;

    public function __construct() {
        if($_SERVER["REQUEST_METHOD"]) {
            $this->method = $_SERVER["REQUEST_METHOD"];
        }
    }

    public function tasks() 
    {
        $task = new Task;  
        $user = (new User)->getInfo();              
        switch($this->method) {
            case "POST":
                $task->title = $_POST["title"];
                $task->id_user = $user->id;
                $task->save();
                echo json_encode($task->data());
            break;
            case "GET":
                $tasks = $task->find("id_user = :uid", "uid={$user->id}")->fetch(true);
                $arr = [];
                if($tasks):
                    foreach($tasks as $task) {
                        array_push($arr, ["id" => $task->id, "title" => $task->title, "status" => $task->status]);
                    }
                endif;
                echo json_encode($arr);
            break;
            case "DELETE":
                parse_str(file_get_contents('php://input'), $data);

                $t = $task->find("id = :id", "id={$data['id']}")->fetch();
                if($t) {
                    $t->destroy();
                    $this->success();
                }                
            break;
            case "PUT":
                parse_str(file_get_contents('php://input'), $data);
                $t = $task->findById($data["id"]);
                if($t) {
                    $t->title = $data["title"];
                    $t->status = $data["status"];
                    $t->save();
                    echo json_encode($t->data());
                }   
            break;
        }
    }

    private function success() {
        $arr = ["data" => ["success" => true, "error" => null]];
        echo json_encode($arr);
    }
}
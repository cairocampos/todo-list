<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class Task extends DataLayer 
{
    public function __construct() 
    {
        parent::__construct("tasks", ["title"]);
    }
}
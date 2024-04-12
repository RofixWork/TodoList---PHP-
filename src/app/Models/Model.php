<?php

namespace App\Models;

use App\Application;
use App\DB;

abstract class Model
{
    protected \PDO $db;

    public function __construct()
    {
        $this->db = Application::db();
    }
}
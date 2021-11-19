<?php

use Core\DB;
use Core\Routes;

include_once __DIR__ . '/../Core/Helper.php';
include_once __DIR__ . '/../vendor/autoload.php';

/*
    Set session
*/

session_start();

/*
    Set Databases
*/
new DB();

Routes::init();
?>
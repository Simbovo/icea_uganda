<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();

require_once '../app/Loader.php';

use application\controller\employeeController;
use app\application\library\commonFunctions;
use application\library\Logger;

$logger = new Logger();
$lib = new commonFunctions();
$empl = new employeeController();

foreach ($lib->cleanInputs($_POST) as $key => $value) {
    $$key = $value;
}

$username = $_SESSION['username'];

$conf_user = $empl->confirmUser($empcode, $username);

if ($conf_user) {
    echo "success";
    $message = "Confirmed user id $empcode";
} else {
    echo "failed";
}



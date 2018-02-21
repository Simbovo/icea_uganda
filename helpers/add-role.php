<?php

/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 17/05/16
 * Time: 11:15
 */
require_once('../app/Loader.php');

use app\application\library\commonFunctions;
use application\controller\settingsController;
use application\library\Logger;

$lib = new commonFunctions();
$settings = new settingsController();
$logger = new Logger();

$role = $lib->cleanInputs($_POST['role_name']);

$save_role = $settings->addRole($role);
if ($save_role) {
    $response['Status'] = "success";
    $response['Message'] = "Role Added successfully";
    $response['Location'] = "roles";
} else {
    $response['Status'] = "failed";
    $response['Message'] = "Role addition ended with an error. Please contact admi";
    $response['Location'] = "roles";
}

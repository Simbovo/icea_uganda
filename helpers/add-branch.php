<?php

/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 27/04/16
 * Time: 12:00
 */
require_once('../app/Loader.php');

use app\application\library\commonFunctions;
use application\controller\companyController;
use application\library\Logger;

$lib = new commonFunctions();
$cmp = new companyController();
$logger = new Logger();

$data = $_POST['data'];

$data = $lib->cleanInputs($data);

$save_data = json_decode($data);

$save_branch = $cmp->addBranch($save_data);

if ($save_branch) {
    $response['Status'] = "success";
    $response['Message'] = "Successfuly logged in";
    $response['Location'] = "branches";
    echo json_encode($response);
    $message = "Created a new branch $save_data->branch_name";
    $log = $logger->write_to_log($message);
} else {
    $response['Status'] = "failed";
    $response['Message'] = "Successfuly logged in";
    $response['Location'] = "branches";
    echo json_encode($response);
}





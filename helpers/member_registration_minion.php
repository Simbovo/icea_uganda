<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

//get the required class
session_start();

//require the autoload file.
require('../app/Loader.php');

//initialize the class to be used
use application\controller\memberController;
use app\application\library\commonFunctions;

$obj = new memberController();
$lib = new commonFunctions();

foreach ($_POST as $key => $value) {
    $$key = $value;
}
$action = $lib->decryptStringArray($_POST['token'], 'token321');


/**
 * Check if details already Exists
 *
 */
$is_registered = false;//obj->checkIfRegistered($idno, $mobile_no, $email, $cif_id);

if ($is_registered) {
    $resp = array("status" => "exists", "message" => "Client Already exists");
    echo json_encode($resp);
    exit;
} else {
    switch ($action) {
        case 'registration': // member registration
            $data = $lib->cleanInputs($_POST);
            $reg_results = $obj->member_registration_v2(json_encode($data));
            echo $reg_results;
            break;
        case 'nominees': //joint/group member nominiees
            $data = $lib->cleanInputs($_POST);
            $reg_results = $obj->nominees_registration(json_encode($data));
            echo $reg_results;
            break;
        case 'beneficiaries': //member/account beneficiaries
            $data = $lib->cleanInputs($_POST);
            $reg_results = $obj->nominees_registration(json_encode($data));
            echo $reg_results;
            break;
        default:
            $resp = array("status" => "not_defined", "message" => "Unknown request, contact admin");
            echo json_encode($resp);
    }
}



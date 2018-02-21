<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


session_start();
require_once '../app/Loader.php';

use app\application\controller\accountController;
use app\application\library\commonFunctions;
use application\library\Logger;


$fnc = new commonFunctions();
$acct = new accountController();

$username = $_SESSION['username'];

$data = json_decode($_POST['data']);
$seccode = $fnc->cleanInputs($data->add_type);
$agent_no = $_SESSION['branch_code'];
$catname = $fnc->cleanInputs($data->add_cat);
$memno = $fnc->cleanInputs($data->memno);

if (empty($seccode) || empty($memno) || empty($catname)) {
    echo "application_error";
    exit;
}


if ($seccode == '002') {
    $modey = 1;
} else {
    $modey = 0;
}
$acctnumber = $agent_no . '-' . $catname . '-' . $memno . '-' . $seccode;

//clean and sanitize account number
$acctnumber = $fnc->sanitize($acctnumber);

if ($acct->checkIfUmAcctExist($acctnumber)) {
    echo "account_exists";
} else {
    $ins_result = $acct->registerUMAccount($acctnumber, $agent_no, $seccode, $catname, $memno, $modey, $uname);

    if ($ins_result) {
        echo "registered";

    } else {
        echo "failed";
    }
}


<?php

use application\library\Logger;

require_once('../app/Loader.php');

foreach ($_POST as $key => $value) {
    $$key = $value;
}

$sanitize = new app\application\library\commonFunctions();

$sanitize->cleanInputs($_POST);


$reg = new \application\controller\employeeController();

$dob = date('d-M-y', strtotime($dob));
$d_employed = date('d-M-y', strtotime($d_employed));

$fullname = $fname . ' ' . $sname;

$result = $reg->updateEmployee($pf_no, $sname, $fullname, $id_no, $dob, $d_employed, $department, $mobile_no, $email, $home_town, $terms, $pf_no, $empcode);

if ($result == true) {
    echo "true";
    $message = "Edited staff number $pf_no, name $fullname";
    $logger = new Logger();
    $log = $logger->write_to_log($message);
} else {
    echo "false";
}



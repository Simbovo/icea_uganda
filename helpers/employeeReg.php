<?php

use application\library\Logger;

require_once('../app/Loader.php');

foreach ($_POST as $key => $value) {
    $$key = $value;
}

$sanitize = new app\application\library\commonFunctions();
$logger = new Logger();

$sanitize->cleanInputs($_POST);


$reg = new \application\controller\employeeController();
$dob = date('d-M-y', strtotime($dob));
$d_employed = date('d-M-y', strtotime($d_employed));

$fullname = $fname . ' ' . $sname;
$rows = $reg->checkIfExits($pf_no);

if (count($rows) >= 1) {
    $response['Status'] = "registered";
    $response['Message'] = "The employee is already registered";
    echo json_encode($response);
} else {
    $result = $reg->registerEmployee($sname, $fullname, $id_no, $dob, $d_employed, $department, $mobile_no, $email, $home_town, $terms, $pf_no);

    if ($result == true) {
        $response['Status'] = "success";
        $response['Message'] = "The employee has been registered succesfuly";
        $response['Location'] = "employees";

        echo json_encode($response);
        $message = "Registered and employee named $fullname";
        $log = $logger->write_to_log($message);
    } else {
        $response['Status'] = "failed";
        $response['Message'] = "The employee registration ended with an error. Contact administrator";
        $response['Location'] = "employees";
        echo json_encode($response);
    }
}


<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of empRegister
 *
 * @author Allan Wiz
 */
session_start();

require '../controller/registrationController.php';

$regs = new registration();

foreach ($_POST as $key => $value) {
    $$key = $value;
}

$fullname = $fname . ' ' . $sname . ' ' . $oname;


$dob = date('d-M-y', strtotime($dob));

$d_employed = date('d-M-y', strtotime($d_employed));

$regData = $regs->registerEmployee($sname, $oname, $fullname, $id_no, $dob, $d_employed, $department, $mobile_no, $email, $home_town, $terms);


if ($regData) {
    echo "registered";
} else {
    echo "failed";
}
?>

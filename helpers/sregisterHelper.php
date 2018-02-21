<?php
/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 9/15/15
 * Time: 11:52 PM
 */
session_start();
require '../app/Loader.php';
use application\controller\Mailer;
use application\controller\memberController as selfRegister;

$client = new selfRegister();
$mail = new Mailer;

//die(var_dump($_POST));
foreach ($_POST as $key => $value) {
    $$key = $value;
}
$fullname = $first_name . '' . $surname . '' . $othername;

$dob_check = date('Y', strtotime($dob));
$dob_db = date('d-M-Y', strtotime($dob));

$date_diff = date('Y') - $dob_check;
//

$is_registered = $client->checkifexists($id_no, $gsm_no, $email);


if ($date_diff < 18) {
    echo "age";
    exit;
} else if ($is_registered) {
//check if Id number already exists	echo "exists";
    echo "exists";
    exit;

} else {
    $_SESSION['id_no'] = $id_no;
    $full_name = $surname . ' ' . $first_name . ' ' . $other_name;
    $result = $client->memberSelfRegister($title, $surname, $first_name, $other_name, $full_name, $dob_db, $gender, $marital_status, $town, $id_no, $gsm_no, $email, $p_address, date('Y-m-d'));

    if ($result) {
        /*$subject = 'CIC Asset Registration';
        $body = 'Thank you for your interest to join our ever growing asset portfolio
    Please continue with the registration here';
        $send_email = $mail->sendEmails($subject, $email, $body);
        if(!$send_email){
            echo "failed";
        }*/
        echo "success";
    } else {
        echo "failed";
    }
}

<?php

/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 11/2/15
 * Time: 1:10 PM
 */
session_start();

require('../app/Loader.php');

use application\controller\memberController as pass;
use application\controller\settingsController;

$passObj = new pass();
$set = new settingsController();


foreach ($_POST as $key => $value) {
    $$key = $value;
}
$ref_no = $_SESSION['username'];

/**
 * User details
 */
$data = $passObj->getOnlineUserById($ref_no);
//die(var_dump($data));
$old_pass = $data->passwrd;
$email = $data->e_mail;
$username = $data->username;

/*
 *
 * do my logic here and send email here
 * */

if (md5($currpass) != $data->passwrd) {
    echo "error_match";
} else if ($email == "") {
    echo "no_email";
} else {
    //encrypt new user password for saving to the database
    $new_pass = md5($password);

  
        $update = $set->changePassword($new_pass, $ref_no);

        if ($update) {
            echo "success";
        } else {
            echo "save_error";
        }
    
}



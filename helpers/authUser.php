<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

ini_set("error_reporting", E_ALL);

require __DIR__ . '/../app/Loader.php';

use app\application\model\staffSetUp;
use application\controller\authController as Auth;

$auth = new Auth();
$isStaff = new staffSetUp();

$data = json_decode($_POST['data']);
$password = trim($data->password);
$username = trim(strtolower($data->username));
/**
 * check if the user is already logged in,
 * if yes then alert user.
 */
$check = $auth->checkIfLoggedIn($username);

/*if (count($check) >= 1) {
    $response['Status'] = "logged in";
    $response['Message'] = "You are already logged in";
    echo json_encode($response);
    exit;
} else {*/
    $result = $auth->authUser($username, md5($password));
    if ($result) {
        $response['Status'] = "success";
        $response['Message'] = "Successfully logged in";
        $response['Location'] = "dashboard";
        echo json_encode($response);
    } else {
        $response['Status'] = "failed";
        $response['Message'] = "Invalid credentials";
        $response['Location'] = "";
        echo json_encode($response);
    }
//
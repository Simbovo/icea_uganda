<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use application\library\Logger;

session_start();

require_once '../app/Loader.php';

$staff = new \application\controller\employeeController();
$lib = new app\application\library\commonFunctions();
$logger = new Logger();

foreach($_POST as $key=>$value){
    $$key = $value;
}


$user = $_SESSION['username'];
$empCode = $lib->cleanInputs($empcode);

$confirm = $staff->confirmEmployee($empCode, $user) ;
        
if($confirm == true){
    echo "true";
    $message =  "Confirmed staff with id $empCode";
    $log =  $logger->write_to_log($message);
}else{
    echo "failed";
}




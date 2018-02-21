<?php

session_start();

require_once('../app/Loader.php');
use app\application\library\commonFunctions;
use application\controller\memberController;
use application\controller\settingsController;

$functions = new commonFunctions();
$details = new memberController();
$settings = new settingsController();


foreach ($_POST as $key => $value) {
    $$key = $value;
}


$code = $functions->cleanInputs($username_);

$member_data = $details->membersByUsername($code);


                		         
if (!empty($member_data->e_mail)) {
   	
    $update = $settings->resetPassword($username_, $member_data->e_mail);
    if(!$update){
    	$response['status'] = 'fail';
    	$response['message'] = 'There was a problem resetting you password, please try again later';

    	echo json_encode($response);
    }
    	$response['status'] = 'ok';
    	$response['message'] = 'Password recovery link has been sent to your email address';
    	$response['url_location'] = 'login';

    	echo json_encode($response);
} else {
    	$response['status'] = 'error';
    	$response['message'] = 'There was a problem resetting you password, please try again later';
    	echo json_encode($response);
}

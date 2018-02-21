<?php


require_once('vendor/autoload.php');

use app\application\library\commonFunctions;
use application\controller\memberController;
use application\controller\settingsController;

$functions = new commonFunctions();
$details = new memberController();
$settings = new settingsController();


if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $username = filter_var($_GET['username'], FILTER_SANITIZE_STRING);

    $code = $functions->cleanInputs($username);

    $member_data = $details->membersByUsername($code);
    if (!empty($member_data->e_mail)) {

        $update = $settings->resetPassword($username, $member_data->e_mail);
        if (!$update) {
            $response['statusId'] = '0';
            $response['statusName'] = 'There was an error sending email, please contact our office for assistance.';

            echo json_encode($response);
        }
        $response['statusId'] = '1';
        $response['message'] = 'Your password has been reset, Please check your email for details';
        $response['url_location'] = 'login';

        echo json_encode($response);
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Error updating your details. Please contact our customer care for assistance';
        echo json_encode($response);
    }

}


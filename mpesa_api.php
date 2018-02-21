<?php
error_reporting(1);
require('vendor/autoload.php');

use  app\application\controller\transactionController;
use application\controller\Mailer;

$sms = new Mailer();

$trans = new transactionController();

$username = "wizglobal";
$password = "karanjag";

$credentials = base64_encode($username.':'.$password);

if($_SERVER['REQUEST_METHOD'] == 'GET'){

	$orig = $_GET["orig"]; 
	$dest = $_GET["dest"];
	$tstamp = date('Y-m-d', strtotime($_GET["tstamp"]));
	$sms_text = $_GET["text"];
	$customer_id = $_GET["customer_id"];
	$user = $_GET["user"];
	$pass = $_GET["pass"];
	$routemethod_id = $_GET["routemethod_id"];
	$routemethod_name = $_GET["routemethod_name"];
	$mpesa_code = $_GET["mpesa_code"];
	$mpesa_acc = $_GET["mpesa_acc"];
	$mpesa_msisdn = $_GET["mpesa_msisdn"];
	$mpesa_trx_date = $_GET["mpesa_trx_date"];
	$mpesa_trx_time = $_GET["mpesa_trx_time"];
	$mpesa_amt = $_GET["mpesa_amt"];
	$mpesa_sender = preg_replace('/[^A-Za-z0-9\. -]/', '', $_GET["mpesa_sender"]);
	$provider = 'Safaricom';

	if(isset($mpesa_msisdn)){
		//printf('%s', 'Starting deposits.....');
		$save_money = $trans->save_mpayment($mpesa_code, $tstamp, $sms_text, $mpesa_amt, $dest, $mpesa_sender, $mpesa_msisdn, $mpesa_acc, $provider);
        $response = json_decode($save_money);
        if($response->status == "success"){
            //printf('%s', 'Starting messaging.....');
            $sms_delivery = $sms->send_sms($response->message, $mpesa_msisdn);
            echo $sms_delivery;
        }else{
            echo $response->message;
        }
	}else{
		echo 'Error 1';
	}
}else{
	echo "Error";
}


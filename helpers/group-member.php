<?php

require('../app/Loader.php');

use app\application\library\commonFunctions;
use app\application\model\DbConnection;
use application\controller\memberController;
use app\application\controller\accountController;

$data = new \application\controller\dataController();
$func = new commonFunctions();
$conn = DbConnection::getInstance();
$mem_obj = new memberController();
$acc = new accountController();

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    parse_str(file_get_contents("php://input"), $account_details);
}


$_serviceUrl = "http://soa3internaldev.ebsafrica.com/ESB/RS/UnitTrust/Rest/Account/queryAccountDetails";

$data_json = json_encode($account_details);
var_dump($data_json);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $_serviceUrl);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length: ' . strlen($data_json)));
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

$data = json_decode($response);


if($data->Status->Status == "SUCCESS"){
    $SchemeCode = $data->AccountIdentifier->SchemeCode;
    $SchemeType = $data->AccountIdentifier->SchemeType;
    $AccountCurrency = $data->AccountIdentifier->AccountCurrency;
    $AccountID = $data->AccountIdentifier->AccountID;
    $BranchID = $data->AccountIdentifier->BranchID;



}else{

}

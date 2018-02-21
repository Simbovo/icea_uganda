<?php

/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 9/12/15
 * Time: 7:44 PM
 */
require_once('../app/Loader.php');

use app\application\library\commonFunctions;
use application\controller\memberController;
use application\controller\Mailer;

session_start();

$lib = new commonFunctions();
$mem = new memberController();
$mailer = new Mailer();
$dbh = \application\model\DbConnection::getInstance();

foreach ($lib->cleanInputs($_POST) as $key => $value) {
# code...
    $$key = $value;
}

$update = $mem->WebDetails(json_encode($_POST), $_SESSION['id_no']);

$qry = "SELECT allnames, e_mail, id_no FROM members_web where id_no = :id";
$sth = $dbh->dbConn->prepare($qry);
$sth->execute(array(":id" => $_SESSION['id_no']));
$data = $sth->fetch(PDO::FETCH_ASSOC);
$cicam_mail = "cic.asset@cic.co.ke";
$url = "cic.co.ke";
$mail_body = 'Hi ' . $data['allnames'] . ', <br>
         Thank you for showing interest to invest with us. Our customer service personnel will get in touch with you soon.<br>
         
        <p> If you have any queries regarding the registration process, please contact us on the details below: <br></p>
        <p> Email:
         <a href=' . $cicam_mail . ' target="_blank"> Write us an email</a><br>
             </p>
         <strong>
       <p> <span style="text-decoration: underline;">CONTACTS:</span></strong></p>
        <p>0703099313<br />
        0703099347<br />
        0202823313<br />
        0202823347</p>
        
         <p>Alternatively please visit  <a href=' . $url . ' target="_blank">our website</a>
             for more information.</p>';
$email = $data['e_mail'];
$mail_subject = "Welcome to CIC asset Management Ltd";

$mail = $mailer->sendEmails($mail_subject, $email, $mail_body);
if ($update) {
    $response['code'] = "ok";
    $response['Message'] = "Successfully completed the risk assessment. Your scrore is " . $score_;
    $response['location'] = 'success';

    echo json_encode($response);
} else {
    $response['code'] = "fail";
    $response['Message'] = "There was a technical error, please try again later";
    $response['location'] = '';

    echo json_encode($response);
}
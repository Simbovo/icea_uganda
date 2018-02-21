<?php

/* 
* To change this license header, choose License Headers in Project Properties.
* To change this template file, choose Tools | Templates
* and open the template in the editor.
*/


require_once '../app/Loader.php';


use application\model\DbConnection;
use application\controller\Mailer;
use application\controller\employeeController;
use app\application\library\commonFunctions;
use app\application\controller\agentController;
use application\controller\memberController;

$mailer = new Mailer();
$dbh = DbConnection::getInstance();
$empl = new employeeController();
$lib =  new commonFunctions();
$mem = new memberController;
$ag = new agentController;


foreach ($_POST as $key => $value) {
    $$key = $value;
}


$QryStr = "SELECT * FROM memberpass WHERE username = :refno";

try {
    $stmt = $dbh->dbConn->prepare($QryStr);
    $stmt->bindParam(":refno",$username);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);


    if (count($result) >= 1) {
        echo "registered";
    } else {
        /***
        check for user levels
        */
        if ($user_type == "Administrator") {
            $user_level = 1;
        } else if ($user_type == "customer") {
            $user_level = 3;
        } else if ($user_type == "agent") {
            $user_level = 4;
        } else {
            $user_level = 0;
        }
        /**

        */
        $reg_date = date('Y-m-d');
        $password = $lib->generateRandomPassword();
        $user_registration = $empl->userWebAccess($ref_no, $email, $username, $user_type, $reg_date, $user_level, md5($password));

        if ($user_registration) {

            $subject = 'Unittrust Access';
            $message =  'Hi ' . $name . ', <br>
            This is to confirm that you have been registered to access the  unittrust portal.
            <br>

            Your  login credentials are: <br>
            <p align="center"><strong> Username: ' . $username . ' </strong></p>
            <p align="center"><strong> Password: ' . $password . ' </strong><p>

                <p>Please note that the credentials are system generated and thus we advise that you change them immediately.
                 <p>Thank you</p>';

                 //send email here
                 //$send_email = $mailer->sendEmails($subject, $email, $message);
                 $send_email = true;
                 if(!$send_email){
                    echo "mail_error";
                }else{
                    echo "success";
                    /*if ($user_type == "customer") {
                        $upd = $mem->updateWeb($ref_no);
                        //echo $upd;
                        if(!$upd){
                            echo "failed";
                        }else{
                            echo "success";
                        }
                    } else if ($user_type == "agent") {
                        $upd = $ag->updateWeb($ref_no);
                        if(!$upd){
                            echo "failed";
                        }else{
                            echo "success";
                        }
                    }
*/
                }
            }
        }

    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }

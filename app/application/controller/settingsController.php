<?php

/**
 * Class to manage system roles
 * 
 */
namespace application\controller;


use application\model\DbConnection;
use app\application\controller\mailController;
use app\application\library\commonFunctions as Lib;

class settingsController
{
    private $dbConnection;
    private $comp_name;
    private $username;
    private $user_id;
    private $user_type;
    private $logger;
    private $mailer;
    private $lib;
    public function __construct()
    {
        //session_start();
        $this->dbConnection = DbConnection::getInstance();
        $this->comp_name = $_SESSION['computer_name'];
        $this->username = $_SESSION['username'];
        $this->user_id = $_SESSION['ref_no'];
        $this->user_type = $_SESSION['category'];
        $this->logger = new \application\library\Logger();
        $this->lib =  new Lib();
    }

    public function configurations()
    {
        $QryStr = "SELECT * FROM syssettings";

        try {
            $stmt = $this->dbConnection->dbConn->prepare($QryStr);
            $stmt->execute();

            $result = $stmt->fetch(\PDO::FETCH_OBJ);
            return $result;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function updateConfigs()
    {
        $QryStr = "select smsurl, smsusername, smspassword,smssenderid,smstrainingmsg from syssettings";

        try {
            $stmt = $this->dbConnection->dbConn->prepare($QryStr);
            $stmt->execute();

            $result = $stmt->fetch(\PDO::FETCH_OBJ);
            return $result;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function roles()
    {
        $QryStr = "SELECT * FROM USERCONTROL ORDER BY CONTROLNO";
        try {
            $stmt = $this->dbConnection->dbConn->prepare($QryStr);
            $stmt->execute();

            $result = $stmt->fetchAll(\PDO::FETCH_OBJ);
            return $result;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function addRole($role_)
    {
        $QryStr = "INSERT INTO USERCONTROL (UTYPE, uname, reg_date, compname) VALUES(:role, :uname, CURRENT_TIMESTAMP, :compname)";
        try {
            $stmt = $this->dbConnection->dbConn->prepare($QryStr);

            $response = $stmt->execute(array(":role" => $role_, ":uname" => $this->username, ":compname" => $this->comp_name));
            
            $message = "User added a role: - ". $role_;
            $this->logger->write_to_log($message);
            if($response){
                return true;
            }else{
                return FALSE;
            }
            
        } catch (\PDOException $e) {
            echo json_encode("Error ".$e->getMessage());
        }
    }

    public function checkIfPwdExits($pass, $username)
    {
        $QryStr = "select * from password_history where passwrd = :pass and lower(username) = :username";

        try {
            $stmt = $this->dbConnection->dbConn->prepare($QryStr);
            $stmt->bindParam(":pass", $pass);
            $stmt->bindParam(":username", strtolower($username));
            $stmt->execute();

            $rows = $stmt->fetchAll(\PDO::FETCH_OBJ);
            
            if(count($rows) > 0){
                return true;
            }else{
                return false;
            }

        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function updatePasswordHistory($dbasePass, $change_type, $username = '')
    {
        if($username != ''){
            $username_ = $username;
        }else{
            $username_ = $this->username;
        }
        $QryStr = "INSERT INTO PASSWORD_HISTORY(REGDATE, USERNAME,USERTYPE,PASSWRD, CHANGETYPE, userid)
        VALUES (CURRENT_TIMESTAMP,:username,:category,:dbasePass, :change_type,:user_id)";
        try {
            $stmt = $this->dbConnection->dbConn->prepare($QryStr);
            $stmt->bindParam(":username", $username_);
            $stmt->bindParam(":category", $this->user_type);
            $stmt->bindParam(":dbasePass", $dbasePass);
            $stmt->bindParam(":change_type", $change_type);
            $stmt->bindParam(":user_id", $this->user_id);

            $res = $stmt->execute();

            if ($res) {
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $ex) {
            echo $ex->getTraceAsString();
        }
    }

    public function companyInfo()
    {
        $QryStr = "SELECT * FROM company";
        try {
            $stmt = $this->dbConnection->dbConn->prepare($QryStr);
            $stmt->execute();
            $result = $stmt->fetch(\PDO::FETCH_OBJ);
            return $result;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function changePassword($password, $username) {
        $QryStr = "UPDATE memberpass SET passwrd = ?, CODE=NULL WHERE lower(username) = ?";
        try {
            $stmt = $this->dbConnection->dbConn->prepare($QryStr);

            $ch_rs = $stmt->execute(array($password, strtolower($username)));
            
            if(!$ch_rs){
                return false;
            }
              $rs = $this->updatePasswordHistory($password, 'PASSWORD RESET', $username);
            if(!$rs){
                return false;
            }
            return true;


    } catch (\PDOException $ex) {
        $ex->getMessage();
    }
}
public function resetPassword($username, $email){


    try {

        $token = $this->lib->encrypTStringArray($username, 'cicam0912');
        $reset_time = $_SERVER['REQUEST_TIME'];

        $QryStr = "update memberpass set password_token= :token, p_reset_timestamp =:tstamp WHERE lower(username) = :username";
        $sth = $this->dbConnection->dbConn->prepare($QryStr);
        $params = array(":token"=>$token, ":tstamp"=>$reset_time, ":username"=>$username);

        if(!$sth->execute($params)){
            return false;
        }else{
         $url = "http://wwww.clients.cic.co.ke/unittrust/reset-account?token=$token";

         $mail_subject = "Forgot Password";

         $mail_body = 'Hi ' . $username . ', <br>
         We heard that you lost/forgot your password. We are sorry about. 

         Please click on the link below to reset your password.<br>

         <a href='.$url.' target="_blank">Password change link</a><br>

         If you did not initiate this request, please ignore this email.

         <p>Please note that the link is active only for 24 hours and after that the link will be deactivated.
             Please visit

             <a href='.$url.' target="_blank">our homepage</a>
             immediately and change it.</p>';

             $this->mailer = new Mailer();

             $send_email = $this->mailer->sendEmails($mail_subject, $email, $mail_body);
             if(!$send_email){
                return false;
            }
            return true;
        }
    } catch (\PDOException $e) {
        echo $e->getMessage();
    }
}


} 
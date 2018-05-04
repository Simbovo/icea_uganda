<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of authClass
 *
 * @author Allan Wiz
 */

namespace application\controller;

use application\model\DbConnection;

class authController
{

    var $dbh;
    var $session_id;

    //put your code here

    function __construct() {
        session_start();
        $this->dbh = DbConnection::getInstance();
    }

    public function authUser($username, $password) {

        try {

            $useraname = trim($username);
            $username = strip_tags($username);
            $username = strtolower($username);

            $query = "SELECT * FROM memberpass WHERE lower(username) = :username AND passwrd= :password";
            $stmt = $this->dbh->dbConn->prepare($query);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":password", $password);
            $stmt->execute();

            while ($resultset = $stmt->fetch(\PDO::FETCH_ASSOC)) {


                try {
                    $checkQuery = "select username,e_mail, refno,category, code, user_level from memberpass where lower(username) =:username";

                    $stmt = $this->dbh->dbConn->prepare($checkQuery);
                    $stmt->bindParam(":username", $username);
                    $stmt->execute();

                    if ($dataset = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                        //regenerate session id
                        session_regenerate_id();

                        //set session variables

                        $hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
                        $_SESSION['LoggedIn'] = true;
                        $_SESSION['username'] = $dataset['username'];
                        $_SESSION['e_mail'] = $dataset['e_mail'];
                        $_SESSION['category'] = $dataset['category'];
                        $_SESSION['ref_no'] = $dataset['refno'];
                        $_SESSION['user_level'] = $dataset['user_level'];
                        $_SESSION['last_activity'] = time();
                        $ip_address = $this->getIpAddress();
                        $this->session_id = session_id();
                        $_SESSION['session_id'] = $this->session_id;

                        $this->isStaff($username);
                    }

                    $AccQry = "INSERT INTO accesslog (sessionid, memberid ,user_type ,ipaddress, host_name) "
                        . "VALUES (:session_id, :member_id,:user_type,:ip_address, :host_name)";

                    $stmt = $this->dbh->dbConn->prepare($AccQry);
                    $stmt->bindParam(":session_id", $this->session_id);
                    $stmt->bindParam(":member_id", $_SESSION['username']);
                    $stmt->bindParam(":user_type", $_SESSION['category']);
                    $stmt->bindParam(":ip_address", $ip_address);
                    $stmt->bindParam(":host_name", $hostname);

                    if ($stmt->execute()) {
                        return true;
                    } else {
                        return false;
                    }
                } catch (\PDOException $exc) {
                    echo $exc->getMessage();
                }
            }
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function isStaff($username){
        try{
            $checkQuery = "SELECT U.USER_ID, U.USERNAME, U.SURNAME, U.USER_TYPE,U.BRANCHID,"
                . " U.BRANCHNAME, M.REFNO, M.E_MAIL, M.CATEGORY, M.CODE, M.USER_LEVEL FROM MEMBERPASS M "
                . "INNER JOIN USERSETUP U ON lower(M.USERNAME) = lower(U.USERNAME) where lower(U.USERNAME) =:username";
            $stmt = $this->dbh->dbConn->prepare($checkQuery);
            $stmt->bindParam(":username", $username);
            $stmt->execute();
 
            if ($dataset = $stmt->fetch(\PDO::FETCH_ASSOC)) {

                //set session variables
                $_SESSION['user_id'] = $dataset['user_id'];
                $_SESSION['user_type'] = $dataset['user_type'];
                $_SESSION['surname'] = $dataset['surname'];
                $_SESSION['branch_name'] = $dataset['branchname'];
                $_SESSION['branch_code'] = $dataset['branchid'];


                $_SESSION['computer_name'] =  $this->getHostByName();

                $this->session_id = session_id();
                $_SESSION['session_id'] = $this->session_id;
            }

        }catch (\PDOException $ex){

        }
    }

    private function getIpAddress() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) { //check ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) { //to check ip is pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    function logout($time, $session_id) {
        try {

            unset($_SESSION['username']);
            unset($_SESSION['e_mail']);
            unset($_SESSION['category']);
            unset($_SESSION['user_type']);
            unset($_SESSION['ref_no']);
            unset($_SESSION['codey']);
            unset($_SESSION['branch_name']);
            unset($_SESSION['branch_code']);
            unset($_SESSION['last_activity']);

            $QryStr = "UPDATE accesslog SET logouttime = ? WHERE sessionid = ?";
            $stmt = $this->dbh->dbConn->prepare($QryStr);

            $stmt->execute(array($time, $session_id));
            session_destroy();

            header('location:../index');
        } catch (\PDOException $exit) {
            echo $exit->getMessage();
        }
    }

    public function checkIfLoggedIn($username) {
        $QryStr = "SELECT * FROM accesslog WHERE memberid = :username and logouttime is null";

        try {
            $sth = $this->dbh->dbConn->prepare($QryStr);
            $sth->bindParam(":username", $username);
            $sth->execute();

            $rows = $sth->fetchAll(\PDO::FETCH_ASSOC);

            return $rows;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    /**
     * Let us do the authentication of users here.
     * @param type $username_
     * @param type $password_
     */
    public function do_login($username_, $password_) {
        $QryStr = "select * from memberpass where lower(username) = :username and password = :password limit 1";
        try {
            $stmt = $this->dbh->dbConn->prepare($QryStr);
            $stmt->bindParam(':username', $username_, \PDO::PARAM_STR);
            $stmt->bindParam(':password', $password_, \PDO::PARAM_STR);

            $stmt->execute();

            $result = $stmt->fetch(\PDO::FETCH_ASSOC);

            if (count($result) <= 0) {
                //regenerate session id
                session_regenerate_id();
                //get host address
                $hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
                //init session variables
                $_SESSION['LoggedIn'] = true;
                $_SESSION['username'] = $result['username'];
                $_SESSION['e_mail'] = $result['e_mail'];
                $_SESSION['category'] = $result['category'];
                $_SESSION['ref_no'] = $result['refno'];
                $_SESSION['user_level'] = $result['user_level'];
                $_SESSION['last_activity'] = time();
                $ip_address = $this->getIpAddress();
                $this->session_id = session_id();
                $_SESSION['session_id'] = $this->session_id;

                //log user access
                $log_access = $this->log_useraccess($ip_address, $hostname);
                if (!$log_access) {
                    return FALSE;
                }
            } else {
                return false;
            }
        } catch (\PDOException $ex) {
            $response['error'] = "Error " . $ex->getMessage();
        }
    }

    private function log_useraccess($ip_address, $hostname) {
        $AccQry = "INSERT INTO accesslog (sessionid,memberid ,user_type ,ipaddress, host_name) "
            . "VALUES (:session_id, :member_id,:user_type,:ip_address, :host_name)";

        $stmt = $this->dbh->dbConn->prepare($AccQry);
        $stmt->bindParam(":session_id", $this->session_id);
        $stmt->bindParam(":member_id", $_SESSION['username']);
        $stmt->bindParam(":user_type", $_SESSION['category']);
        $stmt->bindParam(":ip_address", $ip_address);
        $stmt->bindParam(":host_name", $hostname);

        if ($stmt->execute()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    private function getHostByName()
    {
        return gethostname();
    }

}

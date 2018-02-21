<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of staffSetUp
 *
 * @author Allan Kemboi <allankemboi51@gmail.com >
 */
namespace app\application\model;
use application\model\DbConnection;


class staffSetUp
{


    //put your code here
    var $dbConnection;
    var $staff_id, $staff_rights, $staff_name, $user_type;
    var $server_time, $day;
    var $last_login;
    var $branchId, $branchName;

    public function __construct()
    {
        //database conncetion
        $this->dbConnection = DbConnection::getInstance();
//get the staff ID

    }

    public function LoginTimeNotExpired()
    {
        $this->staff_id = $_SESSION['ref_no'];
        return $this->server_time = $_SERVER['REQUEST_TIME'];

        $QryStr = "select ldate,confirmed from unitmaster.usersetup where user_id='$this->staff_id'";
        try {
            $stmt = $this->dbConnection->dbConn->prepare($QryStr);
            $stmt->execute();
            while ($row = $stmt->fetch(\PDO::FETCH_OBJ)) {
                $this->lastlogin = strtotime($row->ldate);
                $confirmed = $row->confirmed;
            }
            if ($this->lastlogin > $this->server_time && $confirmed == 1) {
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $exception) {
            echo $exception->getTraceAsString();
            echo $exception->getMessage();
        }
    }

    public function loginDay()
    {
        $QryStr = "SELECT * FROM unitmaster.usersetup WHERE user_id = '$this->staff_id'";
        try {
            $stmt = $this->dbConnection->dbConn->prepare($QryStr);
            $stmt->execute();

            $this->day = $day = date('l', $this->server_time);

            while ($row = $stmt->fetch(\PDO::FETCH_OBJ)) {
                if ($this->day == 'Monday') {
                    $login = $row->monn;
                } else if ($this->day == 'Tuesday') {
                    $login = $row->tuee;
                } else if ($this->day == 'Wednesday') {
                    $login = $row->wedd;
                } else if ($this->day == 'Thursday') {
                    $login = $row->thurr;
                } else if ($this->day == 'Friday') {
                    $login = $row->frii;
                } else if ($this->day == 'Saturday') {
                    $login = $row->satt;
                } else if ($this->day == 'Sunday') {
                    $login = $row->sunn;
                } else {

                }
                if ($login == '1') {
                    return true;
                } else {
                    return false;
                }
            }
        } catch (\PDOException $exc) {
            echo $exc->getTraceAsString();
            echo $exc->getMessage();
        }
    }

    public function userDetails()
    {
        $QryStr = "select u.user_id, u.username, u.surname, u.user_type,u.branchid,
                  u.branchname, m.refno, m.e_mail, m.category, m.code from unitmaster.memberpass m inner join
                  unitmaster.usersetup u on m.username = u.username where u.username ='$this->staff_id'";

        try {
            $stmt = $this->dbConnection->dbConn->prepare($QryStr);
            $stmt->execute();

            while ($result = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                $this->staff_name = $result['surname'];
                $this->user_type = $result['user_type'];
                $this->branchId = $result['branch_id'];
                $this->branchName = $result['branch_name'];
            }

            $_SESSION['branch_id'] = $this->branchId;
            $_SESSION['branch_name'] = $this->branchName;
            return $result;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function isAdmin()
    {
        $QryStr = "SELECT * FROM unitmaster.usersetup WHERE user_id = '$this->staff_id'";
        try {
            $stmt = $this->dbConnection->dbConn->prepare($QryStr);
            $stmt->execute();

            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                $this->user_type = $row['user_type'];
            }
            if ($this->user_type == 'Administrator') {
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $exce) {
            echo $exce->getMessage();
        }

    }
}



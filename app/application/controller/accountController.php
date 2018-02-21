<?php

/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 9/21/15
 * Time: 5:04 PM
 */

namespace app\application\controller;

use application\model\DbConnection;
use application\library\Logger;

class accountController
{

    var $dbConnection;
    private $seq_number;
    private $logger;
    private $member_no;

    public function __construct() {
        @session_start();
        $this->dbConnection = DbConnection::getInstance();
        $this->logger = new Logger();
        $this->member_no = $_SESSION['ref_no'];
    }

    public function requestSequence() {
        $QryStr = "select  MEMBERNUMBER_fin_SEQ.nextval as id from dual";
        try {
            $sth = $this->dbConnection->dbConn->prepare($QryStr);
            $sth->execute();
            $id = $sth->fetchColumn(0);
            if (strlen($id) == 1) {
                $this->seq_number = "000000000000000000$id";
            } else if (strlen($id) == 2) {
                $this->seq_number = "00000000000000000$id";
            } else if (strlen($id) == 3) {
                $this->seq_number = "0000000000000000$id";
            } else if (strlen($id) == 4) {
                $this->seq_number = "000000000000000$id";
            } else if (strlen($id) == 6) {
                $this->seq_number = "00000000000000$id";
            } else if (strlen($id) == 7) {
                $this->seq_number = "0000000000000$id";
            } else if (strlen($id) == 8) {
                $this->seq_number = "000000000000$id";
            } else if (strlen($id) == 9) {
                $this->seq_number = "00000000000$id";
            } else if (strlen($id == 10)) {
                $this->seq_number = "0000000000$id";
            } else if (strlen($id) == 10) {
                $this->seq_number = "000000000$id";
            } else if (strlen($id) == 11) {
                $this->seq_number = "00000000$id";
            } else if (strlen($id) == 12) {
                $this->seq_number = "00000000$id";
            } else if (strlen($id) == 13) {
                $this->seq_number = "0000000$id";
            } else if (strlen($id) == 14) {
                $this->seq_number = "000000$id";
            } else if (strlen($id) == 15) {
                $this->seq_number = "00000$id";
            } else if (strlen($id) == 16) {
                $this->seq_number = "0000$id";
            } else if (strlen($id) == 17) {
                $this->seq_number = "000$id";
            } else if (strlen($id) == 18) {
                $this->seq_number = "00$id";
            } else if (strlen($id) == 19) {
                $this->seq_number = "0$id";
            } else {
                $this->seq_number = "$id";
            }

            return $this->seq_number;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function BankAccountExist($member_no) {
        $QryStr = "select * from membersbankdetails where accountno=:acc_no";
        try {
            $stmt = $this->dbConnection->dbConn->prepare($QryStr);
            $stmt->bindParam(":member_no", $member_no);
            $stmt->execute();

            $rows = $stmt->fetch(\PDO::FETCH_ASSOC);

        } catch (\PDOException $e) {
            echo $e->getMessage();
            //trigger_error('Error occured while trying to select get user data in DB:' . $e->getMessage(), E_USER_ERROR);
        }
        return $rows;
    }

    public function checkIfUmAcctExist($account_no) {
        $QryStr = "SELECT * FROM accounts WHERE account_no = :account";

        try {
            $stmt = $this->dbConnection->dbConn->prepare($QryStr);
            $stmt->bindParam(":account", $account_no, \PDO::PARAM_STR);
            $stmt->execute();

            $result = $stmt->fetch(\PDO::FETCH_ASSOC);

            if (is_array($result)) {
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function registerUMAccount($account_no, $agent_no, $security_code, $cat_code, $member_no, $modey, $uname) {
        $QryStr = "INSERT INTO "
            . "accounts(account_no, agent_no, reg_date, security_code,catname, member_no, uname, mode)"
            . "VALUES(:account_no, :agent_no, current_date, :security_code, :catname, :member_no, :uname, :modey)";
        try {
            $stmt = $this->dbConnection->dbConn->prepare($QryStr);
            $stmt->bindParam(":account_no", $account_no);
            $stmt->bindParam(":agent_no", $agent_no);
            $stmt->bindParam(":security_code", $security_code);
            $stmt->bindParam(":catname", $cat_code);
            $stmt->bindParam(":member_no", $member_no);
            $stmt->bindParam(":modey", $modey);
            $stmt->bindParam(":uname", $uname);

            /**
             * Log activity here
             */
            $action = "Created a unit-trust account number $account_no for member number $member_no";
            $this->logger->write_to_log($action);

            $stmt->execute();

            return true;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function getAccountDetails($member_no) {
        $QryStr = "select  a.account_no,  a.agent_no,  a.security_code,  a.catname,"
            . " a.reg_date,  g.agent_name,  s.descript, c.description,  s.fundtype from accounts a "
            . " inner join agents g on g.agent_no = a.agent_no "
            . " inner join securities s on a.security_code = s.security_code "
            . " inner join category c on c.catno = a.catname where member_no = :member_no";
        try {
            $stmt = $this->dbConnection->dbConn->prepare($QryStr);
            $stmt->bindParam(":member_no", $member_no);
            $stmt->execute();

            $bank_details = $stmt->fetchAll(\PDO::FETCH_OBJ);

            return $bank_details;
        } catch (\PDOException $e) {
            echo $e->getTraceAsString();
            echo $e->getMessage();
        }
    }

    public function registerAccount($member_no, $bank_name, $bank_code, $full_name, $branch, $branch_id, $account_type, $account_name, $account_no) {
        //check if account already exists
        $check = $this->BankAccountExist($member_no);
        if (!is_array($check)) {
            try {
                $QryStr = "insert into membersbankdetails(MEMBERNO, BANKNAME, BANKCODE, FULLNAMES, BRANCH, BRANCH_ID, ACCOUNTNAME,ACCOUNTTYPE, ACCOUNTNO)
            VALUES(:mem_num, :bank_name, :bank_code,:full_name, :branch,:branch_id,:acc_name,:acc_type, :acc_no)";
                $stmt = $this->dbConnection->dbConn->prepare($QryStr);
                $stmt->bindParam(":mem_num", $member_no);
                $stmt->bindParam(":bank_name", $bank_name);
                $stmt->bindParam(":bank_code", $bank_code);
                $stmt->bindParam(":full_name", $full_name);
                $stmt->bindParam(":branch", $branch);
                $stmt->bindParam(":branch_id", $branch_id);
                $stmt->bindParam(":acc_name", $account_name);
                $stmt->bindParam(":acc_type", $account_type);
                $stmt->bindParam(":acc_no", $account_no);

                $stmt->execute();
                $action = "Registered bank account number $account_no for member number $member_no";
                $this->logger->write_to_log($action);
                return true;
            } catch (\PDOException $e) {
                echo $e->getMessage();
            }
        } else {
            echo "Sorry the account number you are trying to register is registered to " . $check['fullnames'] . ". Please try again another account number";
        }
    }

    public function getMemberBankDetails($member_no) {
        $QryStr = "select * from membersbankdetails where memberno=:member_no";
        try {
            $stmt = $this->dbConnection->dbConn->prepare($QryStr);
            $stmt->bindParam(":member_no", $member_no);
            $stmt->execute();

            $result = $stmt->fetch(\PDO::FETCH_OBJ);
            $action = "Viewed bank account details for member number $member_no";
            //$this->logger->write_to_log($action);
            return $result;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function client_agents() {
        $QryStr = "select a.account_no,s.descript,s.security_code,s.fundtype,
    g.agent_no,g.agent_name from accounts a inner join agents g on a.agent_no = g.agent_no
    inner join securities s on a.security_code = s.security_code where a.member_no=:member_no
    order by a.account_no asc";

        try {
            $stmt = $this->dbConnection->dbConn->prepare($QryStr);
            $stmt->bindparam(":member_no", $this->member_no);
            $stmt->execute();
            $rows = $stmt->fetchAll(\PDO::FETCH_OBJ);

            return $rows;
        } catch (\PDOException $ex) {
            echo "error: " . $ex->getMessage();
        }
    }

}

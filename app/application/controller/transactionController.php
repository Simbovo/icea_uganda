<?php

/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 9/30/15
 * Time: 4:25 PM
 *
 *
 *
 * The class is used to handle all transactions in the system
 * Purchases and Withdrawal Transactions
 *
 */

namespace app\application\controller;

use app\application\library\commonFunctions as lib;
use application\library\Logger;
use application\model\DbConnection;

class transactionController
{

    var $dbh;
    var $trans_type;
    var $branch_code, $branch_name, $market_value;
    public $current_date;
    private $value_date;
    private $comp_name;
    private $logger, $member_no;

    public function __construct() {
        @session_start();
        $this->dbConnect = DbConnection::getInstance();
        $this->branch_code = $_SESSION['branch_code'];
        $this->branch_name = $_SESSION['branch_name'];
        $this->value_date = lib::value_date();
        $this->comp_name = $_SESSION['computer_name'];
        $this->current_date = date('Y-m-d');
        $this->logger = new Logger();
        $this->member_no = $_SESSION['ref_no'];
    }

    public function doPurchase($mem_no, $full_name, $amount, $acc_no, $portfolio, $mop, $username, $doc_no, $bank_code, $drawer_name, $drawer_payee) {
        $this->trans_type = "PURCHASE";
        //$server_time = strtotime($_SERVER['REQUEST_TIME']);

        $QryStr = "insert into trans_amount(trans_type, trans_date, member_no, full_name,account_no, amount, sysdate, portfolio, mop, u_name, doc_no, BRANCHID, bnkcode, bankaccdets, drawername,drawerpayee, value_date, compname)
        values (:trans_type,CURRENT_DATE, :mem_no,:full_name,:acc_no,:amount,CURRENT_TIMESTAMP, :portfolio,:mop, :u_name,:doc_no, :branch_id, :bank_code, :bank_branch, :drawer_name, :drawer_payee, :val_date, :compname)";
        try {
            $stmt = $this->dbConnect->dbConn->prepare($QryStr);
            $stmt->bindParam(":trans_type", $this->trans_type);
            // $stmt->bindParam(":trans_date", CURRENT_DATE)
            $stmt->bindParam(":mem_no", $mem_no);
            $stmt->bindParam(":full_name", $full_name);
            $stmt->bindParam(":acc_no", $acc_no);
            $stmt->bindParam(":amount", $amount);
            //$stmt->bindParam(":sysdate", $server_time);
            $stmt->bindParam(":portfolio", $portfolio);
            $stmt->bindParam(":mop", $mop);
            $stmt->bindParam(":u_name", $username);
            $stmt->bindParam(":doc_no", $doc_no);
            $stmt->bindParam(":branch_id", $this->branch_code);
            $stmt->bindParam(":bank_code", $bank_code);
            $stmt->bindParam(":bank_branch", $this->branch_name);
            $stmt->bindParam(":drawer_name", $drawer_name);
            $stmt->bindParam(":drawer_payee", $drawer_payee);
            $stmt->bindParam(":val_date", $this->value_date);
            $stmt->bindParam(":compname", $this->comp_name);

            $stmt->execute();
            $action = "Did a top up for member number $mem_no of amount $amount to account number $acc_no . Transaction reference id $doc_no";
            $this->logger->write_to_log($action);
            return true;
        } catch (\PDOException $e) {

            echo $e->getMessage();
            echo "<br>";
            echo $e->getLine();
        }
    }

    public function checkReferenceNo($doc_no) {
        $QryStr = "SELECT * FROM TRANS_AMOUNT WHERE DOC_NO = :doc_no";
        try {
            $stmt = $this->dbConnect->dbConn->prepare($QryStr);
            $stmt->bindParam(":doc_no", $doc_no);
            $stmt->execute();
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);

            if (is_array($result)) {
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $ex) {
            echo $ex->getTraceAsString();
        }
    }

    public function getTransByRefNo($doc_no) {
        $QryStr = "SELECT * FROM TRANS_AMOUNT WHERE DOC_NO = :doc_no";
        try {
            $stmt = $this->dbConnect->dbConn->prepare($QryStr);
            $stmt->bindParam(":doc_no", $doc_no);
            $stmt->execute();
            $result = $stmt->fetch(\PDO::FETCH_OBJ);

            return $result;
        } catch (\PDOException $ex) {
            echo $ex->getTraceAsString();
        }
    }

    public function checkIfFirstDeposit($accountNumber) {
        $QryStr = "SELECT * FROM TRANS WHERE ACCOUNT_NO=:acc_no AND CONFIRMED IS NOT NULL AND DELETED IS NULL AND REVERSED IS NULL";

        try {
            $stmt = $this->dbConnect->dbConn->prepare($QryStr);
            $stmt->bindParam(":acc_no", $accountNumber, \PDO::PARAM_STR);
            $stmt->execute();

            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            if (is_array($result)) {
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            echo $e->getTraceAsString();
        }
    }

    public function account_balance($account_number) {
        $QryStr = "SELECT TRANS.ACCOUNT_NO, Sum(TRANS.AMOUNT) as Amount,Sum(TRANS.NETAMOUNT) as netamount, "
            . "Sum(CAST(TRANS.NOOFSHARES AS FLOAT)) as totalunits, "
            . "SECURITIES.DESCRIPT FROM TRANS INNER JOIN ACCOUNTS ON TRANS.ACCOUNT_NO = ACCOUNTS.ACCOUNT_NO "
            . "INNER JOIN SECURITIES ON ACCOUNTS.SECURITY_CODE = SECURITIES.SECURITY_CODE "
            . "WHERE TRANS.CONFIRMED IS NOT NULL AND TRANS.REVERSED IS NULL "
            . "AND TRANS.DELETED IS NULL AND ACCOUNTS.ACCOUNT_NO = :account_no "
            . "GROUP BY TRANS.ACCOUNT_NO,SECURITIES.DESCRIPT";

        try {
            $stmt = $this->dbConnect->dbConn->prepare($QryStr);
            $stmt->execute(array(":account_no" => $account_number));

            $balance = $stmt->fetch(\PDO::FETCH_ASSOC);
            if (count($balance) >= 1) {
                $response = $balance;
            } else {
                $response = 0.00;
            }
        } catch (\PDOException $ex) {
            $response['status'] = "Error";
            $response['Message'] = "Internal Server error: " . $ex->getMessage();
        }
        return $response;
    }

    public function calcRunningBalance($member_no) {
        $DateQry = "SELECT max(NAV_DATE) as maxdate FROM NAVS  WHERE CONFIRMD IS NOT NULL and security_code not IN ('006','004')";

        $sth = $this->dbConnect->dbConn->prepare($DateQry);
        $sth->execute();

        $res = $sth->fetch(\PDO::FETCH_OBJ);

        $max_date = date('Y-m-d', strtotime($res->maxdate));

        $QryStr = "SELECT NAVS.NAV_DATE,  MEMBERS.MEMBER_NO, members.allnames, TRANS.ACCOUNT_NO, TRANS.PORTFOLIO,
                    case when (SECURITIES.FUNDTYPE='Rate Fee' and SECURITIES.SEC_TYPE=1) then (select sum(a.netAMOUNT)
                    from trans a where a.ACCOUNT_NO=TRANS.ACCOUNT_NO  and a.CONFIRMED is not null and a.REVERSED is null and a.DELETED is null
                    and cast(a.TRANS_DATE as date)<= '$max_date') when (SECURITIES.FUNDTYPE='Rate Fee' and SECURITIES.SEC_TYPE=null)
                    then (select sum(a.netAMOUNT) from trans a where a.ACCOUNT_NO=TRANS.ACCOUNT_NO and a.CONFIRMED is not null
                     and a.REVERSED is null and a.DELETED is null and cast(a.TRANS_DATE as date)<= '$max_date')
                     when (SECURITIES.FUNDTYPE='Rate Fee' and SECURITIES.SEC_TYPE=0)
                     then (select sum(a.netAMOUNT) from trans a where a.ACCOUNT_NO=TRANS.ACCOUNT_NO
                     and a.trans_type<>'INTEREST' and a.CONFIRMED is not null and a.REVERSED is null and a.DELETED is null
                     and cast(a.TRANS_date as date)<= '$max_date') when (SECURITIES.FUNDTYPE<>'Rate Fee')
                     then ((Sum(CAST(CAST(TRANS.NOOFSHARES AS FLOAT) AS DECIMAL(17,2))) * NAVS.AMOUNT))
                     else sum(TRANS.NETAMOUNT) end as p_amt,    sum(TRANS.NETAMOUNT) as netamt,
                     sum(cast(cast(TRANS.NOOFSHARES as float) as decimal(17,2))) as mktvalue,
                     CAST(NAVS.AMOUNT AS DECIMAL(17,2)),NAVS.ADM_FEE, NAVS.P_PRICE
                     FROM TRANS INNER JOIN ACCOUNTS ON TRANS.ACCOUNT_NO = ACCOUNTS.ACCOUNT_NO
                     INNER JOIN NAVS ON ACCOUNTS.SECURITY_CODE = NAVS.SECURITY_CODE
                     INNER JOIN MEMBERS ON MEMBERS.MEMBER_NO = TRANS.MEMBER_NO
                     INNER JOIN SECURITIES ON ACCOUNTS.SECURITY_CODE = SECURITIES.SECURITY_CODE
                     where cast(NAVS.nav_date as date)= '$max_date' and MEMBERS.CONFIRMED is not null
                     and MEMBERS.CONFIRMED is not null and TRANS.CONFIRMED is not null
                      and TRANS.REVERSED is null and TRANS.DELETED is null
                      and NAVS.CONFIRMD IS NOT NULL and cast(TRANS.TRANS_date as date)<= '$max_date'
                      and accounts.account_no = '$member_no'
                      group by NAVS.NAV_DATE, MEMBERS.MEMBER_NO, members.allnames,trans.account_no,
                      trans.portfolio, securities.fundtype,securities.sec_type, navs.amount, navs.adm_fee, navs.p_price";
        try {
            $stmt = $this->dbConnect->dbConn->prepare($QryStr);
            //$stmt->bindParam(":member_no", $member_no, \PDO::PARAM_STR);
            //$stmt->bindParam(":max_date", $max_date);
            $stmt->execute();

            $market_value = $stmt->fetch(\PDO::FETCH_ASSOC);

            return $market_value;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Function to get the transactions done today
     * at the branch level
     * @return mixed
     */
    public function todayTransactions() {
        $QryStr = "SELECT TRANS_AMOUNT.TRANS_ID,TRANS_AMOUNT.TRANS_TYPE, TO_CHAR(TRANS_AMOUNT.TRANS_DATE, 'DD.MM.YYYY:HH24:MI:SS'),
        TRANS_AMOUNT.MEMBER_NO, TRANS_AMOUNT.FULL_NAME, TRANS_AMOUNT.PORTFOLIO, TRANS.DELETED, TRANS.REVERSED,  TRANS_AMOUNT.AMOUNT
        FROM
        TRANS INNER JOIN TRANS_AMOUNT ON TRANS_AMOUNT.TRANS_ID = TRANS.RECONCILED
        where trans.trans_date = to_date('$this->current_date','dd/mm/yyyy') and trans_amount.branchid='$this->branch_code'  AND TRANS_AMOUNT.RECONCILED = 1
        AND TRANS.CONFIRMED = 1 AND TRANS.REVERSED IS NULL ORDER BY trans_amount.TRANS_DATE ASC";

        try {
            $stmt = $this->dbConnect->dbConn->prepare($QryStr);
            $stmt->execute();
            $result = $stmt->fetchAll(\PDO::FETCH_OBJ);
            $message = "Viewed days transactions";
            $this->logger->write_to_log($message);
            return $result;
        } catch (\PDOException $ex) {
            $ex->getMessage();
        }
    }

    public function withdrawFunds($member_no, $name, $account_no, $amount, $portfolio, $mop, $username, $doc_no, $bank_details) {

        $this->trans_type = "WITHDRAWAL";

        $with_amount = gmp_neg((int)$amount);

        $QryStr = "insert into trans_amount(trans_type, trans_date, member_no, full_name,account_no, amount, portfolio, mop, u_name, doc_no, bankaccdets, sysdate )"
            . " VALUES(:trans_type, CURRENT_DATE, :member_no,:full_name,:account_no,:amount,:portfolio,:payment_mode,:user_name,:reference,:bank_name, CURRENT_TIMESTAMP)";
        try {
            $stmt = $this->dbConnect->dbConn->prepare($QryStr);
            $stmt->bindParam(":trans_type", $this->trans_type);
            $stmt->bindParam(":member_no", $member_no);
            $stmt->bindParam(":full_name", $name);
            $stmt->bindParam(":account_no", $account_no);
            $stmt->bindParam(":amount", $with_amount);
            $stmt->bindParam(":portfolio", $portfolio);
            $stmt->bindParam(":payment_mode", $mop);
            $stmt->bindParam(":user_name", $username);
            $stmt->bindParam(":reference", $doc_no);
            $stmt->bindParam(":bank_name", $bank_details);

            $stmt->execute();

            return true;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function statement($accNo) {
        $QryStr = "SELECT * FROM TRANS WHERE ACCOUNT_NO=:acc_no"
            . " AND CONFIRMED IS NOT NULL AND DELETED IS NULL AND REVERSED IS NULL order by trans_id";
        try {
            $stmt = $this->dbConnect->dbConn->prepare($QryStr);
            $stmt->bindParam(":acc_no", $accNo, \PDO::PARAM_STR);
            $stmt->execute();

            $trans = $stmt->fetchAll(\PDO::FETCH_OBJ);
            return $trans;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    /**
     * @param $report_type
     * @param $startDate
     * @param $endDate
     * @return mixed
     *
     */
    public function transReport($report_type, $startDate, $endDate) {
        if ($startDate == "" && $endDate == "") {
            $where_clause = "cast(trans_date as date) = '$this->current_date'";
        } else {
            $where_clause = "cast(trans_date as date) BETWEEN :startDate "
                . "AND :endDate ";
        }
        $QryStr = "SELECT * FROM TRANS_AMOUNT WHERE $where_clause and
        CONFIRMED = 1 AND portfolio =:portfolio AND reconciled = 1  
        AND trans_amount.branchid='$this->branch_code'";
        echo $QryStr;
        try {
            $stmt = $this->dbConnect->dbConn->prepare($QryStr);

            $stmt->execute(array(":startDate" => $startDate, ":endDate" => $endDate, ":portfolio" => $report_type));


            $result = $stmt->fetchAll(\PDO::FETCH_OBJ);
            return $result;
        } catch (\PDOException $exe) {
            echo $exe->getMessage();
        }
    }

    /**
     * @param $startDate
     * @param $endDate
     * @return mixed
     */
    public function revenueReport($startDate, $endDate) {

        if ($startDate == "" && $endDate == "") {
            $where_clause = "trans.trans_date = to_date('$this->current_date','dd/mm/yyyy')";
        } else {
            $where_clause = "TRUNC(trans.trans_date) BETWEEN TO_DATE(:startDate, 'dd/mm/yyyy') "
                . "AND TO_DATE(:endDate,'dd/mm/yyyy')";
        }

        $QryStr = "SELECT BANKACCDETS, SUM (ADMINFEE)as ADMFEE, TRIM (TRANS_DATE) as trans_date,
        SECURITIES.DESCRIPT FROM ACCOUNTS INNER JOIN SECURITIES
        ON (ACCOUNTS.SECURITY_CODE = SECURITIES.SECURITY_CODE)
        INNER JOIN TRANS ON (TRANS.ACCOUNT_NO = ACCOUNTS.ACCOUNT_NO) 
        WHERE $where_clause  AND CONFIRMED = 1
        AND REVERSED IS NULL AND DELETED IS NULL AND FUNDTYPE = 'Admin Fee' and bankaccdets = '$this->branch_name'
        GROUP BY BANKACCDETS, TRANS_DATE, SECURITIES.DESCRIPT
        ORDER BY  SECURITIES.DESCRIPT,TRANS_DATE";

        try {
            $stmt = $this->dbConnect->dbConn->prepare($QryStr);

            $stmt->execute(array(":startDate" => $startDate, ":endDate" => $endDate));

            $stmt->execute();

            $result = $stmt->fetchAll(\PDO::FETCH_OBJ);
            return $result;
        } catch (\PDOException $exe) {
            echo $exe->getMessage();
        }
    }

    public function create_list() {

    }

    /**
     * @param $report_type
     * @param $startDate
     * @param $endDate
     * @return mixed
     */
    public function postedTrans($report_type, $startDate, $endDate) {
        if ($startDate == "" && $endDate == "") {
            $where_clause = "trans_amount.trans_date = to_date('$this->current_date','dd/mm/yyyy')";
        } else {
            $where_clause = "TRUNC(trans_amount.trans_date) BETWEEN TO_DATE(:startDate, 'dd/mm/yyyy') "
                . "AND TO_DATE(:endDate,'dd/mm/yyyy')";
        }
        $QryStr = "SELECT * FROM TRANS_AMOUNT WHERE $where_clause and
        CONFIRMED is null and reconciled is null and branchid = '$this->branch_code' AND portfolio =:portfolio";

        try {
            $stmt = $this->dbConnect->dbConn->prepare($QryStr);

            $stmt->execute(array(":startDate" => $startDate, ":endDate" => $endDate, ":portfolio" => $report_type));


            $result = $stmt->fetchAll(\PDO::FETCH_OBJ);
            return $result;
        } catch (\PDOException $exe) {
            echo $exe->getMessage();
        }
    }

    /**
     * @param $report_type
     * @param $startDate
     * @param $endDate
     * @return mixed
     */
    public function confirmedTransactions($report_type, $startDate, $endDate) {
        if ($startDate == "" && $endDate == "") {
            $where_clause = "trans_amount.trans_date to_date('$this->current_date','dd/mm/yyyy')";
        } else {
            $where_clause = "trans_amount.trans_date BETWEEN TO_DATE(:startDate, 'dd/mm/yyyy') "
                . "AND TO_DATE(:endDate,'dd/mm/yyyy')";
        }

        $QryStr = "SELECT TRANS_AMOUNT.TRANS_ID,TRANS_AMOUNT.TRANS_TYPE, TO_CHAR(TRANS_AMOUNT.TRANS_DATE, 'DD-MON-YYYY') as TRANS_DATE,
        TRANS_AMOUNT.MEMBER_NO, TRANS_AMOUNT.FULL_NAME, TRANS_AMOUNT.PORTFOLIO, TRANS.DELETED, TRANS.REVERSED,  TRANS_AMOUNT.AMOUNT
        FROM
        TRANS INNER JOIN TRANS_AMOUNT ON TRANS_AMOUNT.TRANS_ID = TRANS.RECONCILED
        where $where_clause  and trans_amount.branchid='$this->branch_code' AND TRANS_AMOUNT.PORTFOLIO = :portfolio AND TRANS_AMOUNT.RECONCILED = 1
        AND TRANS.CONFIRMED = 1 AND TRANS.REVERSED IS NULL  ORDER BY trans_amount.TRANS_DATE ASC";

        try {
            $stmt = $this->dbConnect->dbConn->prepare($QryStr);

            $stmt->execute(array(":startDate" => $startDate, ":endDate" => $endDate, ":portfolio" => $report_type));


            $result = $stmt->fetchAll(\PDO::FETCH_OBJ);

            return $result;
        } catch (\PDOException $exe) {
            echo $exe->getMessage();
        }
    }

    /**
     * @param $report_type
     * @param $startDate
     * @param $endDate
     * @return mixed
     */
    public function reversedTrans($report_type, $startDate, $endDate) {
        if ($startDate == "" && $endDate == "") {

            $where_clause = "trans_amount.trans_date = to_date('$this->current_date','dd/mm/yyyy')";
        } else {
            $where_clause = "TRUNC(trans_amount.trans_date) BETWEEN TO_DATE(:startDate, 'dd/mm/yyyy') "
                . "AND TO_DATE(:endDate,'dd/mm/yyyy')";
        }

        $QryStr = "SELECT TRANS_AMOUNT.TRANS_ID,TRANS_AMOUNT.TRANS_TYPE, TO_CHAR(TRANS_AMOUNT.TRANS_DATE, 'DD.MM.YYYY:HH24:MI:SS'),
        TRANS_AMOUNT.MEMBER_NO, TRANS_AMOUNT.FULL_NAME, TRANS_AMOUNT.DOC_NO, TRANS_AMOUNT.PORTFOLIO,TRANS_AMOUNT.CANCELREASON,
        TRANS_AMOUNT.AMOUNT FROM TRANS INNER JOIN TRANS_AMOUNT ON TRANS_AMOUNT.TRANS_ID = TRANS.RECONCILED
        where $where_clause and trans_amount.branchid='$this->branch_code' AND TRANS_AMOUNT.PORTFOLIO = :portfolio AND
        TRANS_AMOUNT.RECONCILED = 0 AND TRANS.CONFIRMED =1 AND TRANS.REVERSED = 1  ORDER BY trans_amount.TRANS_DATE ASC";

        try {
            $stmt = $this->dbConnect->dbConn->prepare($QryStr);

            $stmt->execute(array(":startDate" => $startDate, ":endDate" => $endDate, ":portfolio" => $report_type));


            $result = $stmt->fetchAll(\PDO::FETCH_OBJ);

            return $result;
        } catch (\PDOException $exe) {
            echo $exe->getMessage();
        }
    }

    /**
     * @param $startDate
     * @param $endDate
     *
     */
    public function transSummary($startDate, $endDate) {
        if ($startDate == "" && $endDate == "") {
            $where_clause = "trans_amount.trans_date = to_date('$this->current_date','dd/mm/yyyy')";
        } else {
            $where_clause = "TRUNC(trans_amount.trans_date) BETWEEN TO_DATE(:startDate, 'dd/mm/yyyy') "
                . "AND TO_DATE(:endDate,'dd/mm/yyyy')";
        }


        $QryStr = "SELECT  TRANS_AMOUNT.PORTFOLIO, sum(TRANS_AMOUNT.AMOUNT)AS AMOUNT, TRANS_AMOUNT.TRANS_TYPE FROM TRANS INNER JOIN
        TRANS_AMOUNT ON TRANS_AMOUNT.TRANS_ID = TRANS.RECONCILED where $where_clause and trans_amount.branchid='$this->branch_code'
        AND TRANS_AMOUNT.RECONCILED = 1 AND TRANS.CONFIRMED = 1 AND TRANS.REVERSED IS NULL group by trans_amount.trans_type,
        trans_amount.portfolio order by trans_amount.portfolio, trans_amount.trans_type";
        try {
            $stmt = $this->dbConnect->dbConn->prepare($QryStr);

            $stmt->execute(array(":startDate" => $startDate, ":endDate" => $endDate));


            $result = $stmt->fetchAll(\PDO::FETCH_OBJ);

            return $result;
        } catch (\PDOException $exe) {
            echo $exe->getMessage();
        }
    }

    /* public function pendingTransactions($report_type, $startDate, $endDate)
      {
      if ($startDate == "" && $endDate == "") {
      $where_clause = "trans_amount.trans_date = to_date('$this->current_date','dd/mm/yyyy')";
      } else {
      $where_clause = "TRUNC(trans_amount.trans_date) BETWEEN TO_DATE(:startDate, 'dd/mm/yyyy') "
      . "AND TO_DATE(:endDate,'dd/mm/yyyy')";
      }

      $QryStr = "";
  } */

    /**
     * Fetch latest transactions for a client
     * @param string $member_no
     * @return  array
     */
    public function client_latest_transactions() {
        $QryStr = "SELECT * FROM TRANS WHERE member_no=:member_no"
            . " AND CONFIRMED IS NOT NULL AND DELETED IS NULL AND REVERSED IS NULL order by trans_id desc LIMIT 50";
        try {
            $stmt = $this->dbConnect->dbConn->prepare($QryStr);
            $stmt->bindParam(":member_no", $this->member_no, \PDO::PARAM_STR);
            $stmt->execute();

            $trans = $stmt->fetchAll(\PDO::FETCH_OBJ);
            return $trans;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }


    public function  agent_commission($agent_code, $date_from, $date_to) {
        if ($date_from != "" && $date_to != "") {
            $where_clause = ' t.AGENT_CODE =:agent_code AND trans_date BETWEEN :startDate AND :endDate';
            $params = array(":startDate" => $date_from, ":endDate" => $date_to, ":agent_code" => $agent_code);
        } else {
            $where_clause = ' t.AGENT_CODE =:agent_code';
            $params = array(":agent_code" => $agent_code);
        }

        $QryStr = "SELECT A.AGENT_NO, A.AGENT_NAME, M.MEMBER_NO, M.ALLNAMES, Sum(T.AMTVALUE) AS COMMISION, S.DESCRIPT, "
            . "A.POST_ADDRESS, A.TOWN, A.GSM_NO,T.MAINAGENTNAME "
            . "FROM TRANS_AGENT_COMM T "
            . "INNER JOIN ACCOUNTS C ON T.ACCOUNT_NO = C.ACCOUNT_NO "
            . "INNER JOIN SECURITIES S ON C.SECURITY_CODE = S.SECURITY_CODE "
            . "INNER JOIN MEMBERS M ON   T.MEMBER_NO = M.MEMBER_NO "
            . "INNER JOIN AGENTS A ON T.AGENT_CODE = A.AGENT_NO "
            . " WHERE $where_clause"
            . " GROUP BY  A.AGENT_NO,  A.AGENT_NAME,  M.MEMBER_NO,  M.ALLNAMES,  S.DESCRIPT,T.MAINAGENTNAME, "
            . "A.POST_ADDRESS, A.TOWN, A.GSM_NO "
            . "ORDER BY A.AGENT_NO, M.MEMBER_NO";


        try {
            $sth = $this->dbConnect->dbConn->prepare($QryStr);

            $sth->execute($params);

            $result = $sth->fetchAll(\PDO::FETCH_OBJ);

        } catch (\PDOException $ex) {
            $result = $ex->getMessage();
        }
        return $result;
    }

    public function uncredited_interest($account_no) {
        $QryStr = "select sum(amount) as interestamount from trans_interest where account_no = :acc_no and used is  null";
        try {
            $sth = $this->dbConnect->dbConn->prepare($QryStr);
            $sth->bindParam(':acc_no', $account_no);
            $sth->execute();
            $result = $sth->fetch(\PDO::FETCH_ASSOC);

            return $result;

        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function view_mpayments($receipt_no = "") {

        if (isset($receipt_no)) {
            $where = " where receiptno = :receipt_no";
        } else {
            $where = " ";
        }
        $Qry = "SELECT * from m_payment " . $where;

        try {
            $sth = $this->dbConnect->dbConn->prepare($Qry);
            if (isset($receipt_no)) {
                $sth->bindParam(":receipt_no", $receipt_no, \PDO::PARAM_STR);
                $sth->execute();
                $result = $sth->fetch(\PDO::FETCH_ASSOC);
            }
            $sth->execute();
            $result = $sth->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }

    }

    public function save_mpayment($mpesa_code, $tstamp, $sms_text, $mpesa_amt, $dest, $mpesa_sender, $mpesa_msisdn, $mpesa_acc, $provider) 
     {

        $rows = $this->view_mpayments($mpesa_code);

        $date = new \DateTime();
        $newdate = $date->format('Y-m-d');
        $newtime = $date->format('Y-m-d H:i:s');
        if (count($rows) > 0) {
            $response = array("status" => "duplicate", "message" => "Mpesa receipt already exists");
        } else {
            $query = "INSERT INTO m_payment (receiptno, tdate, regdate, transdet, amtin, telno, fullnames, acctno, fund, svc_provider) 
                     VALUES (:mpesa_code,:tstamp,:newdate,:sms_text,:mpesa_amt,:mpesa_msisdn,:mpesa_sender, :mpesa_acc,:dest,:provider)";

            try {
                $sth = $this->dbConnect->dbConn->prepare($query);
                $sth->bindParam(":mpesa_code", $mpesa_code);
                $sth->bindParam(":tstamp", $tstamp);
                $sth->bindParam(":newdate", $newdate);
                $sth->bindParam(":sms_text", $sms_text);
                $sth->bindParam(":mpesa_amt", $mpesa_amt);
                $sth->bindParam(":mpesa_msisdn", $mpesa_msisdn);
                $sth->bindParam(":mpesa_sender", $mpesa_sender);
                $sth->bindParam(":mpesa_acc", $mpesa_acc);
                $sth->bindParam(":dest", $dest);
                $sth->bindParam(":provider", $provider);

                if ($sth->execute()) {
                    $response = array("status" => "success", "message" => "Dear $mpesa_sender, you have successfully topped up your account with Kshs.  $mpesa_amt, your account will be updated soon, Thank You");
                } else {
                    $response = array("status" => "success", "message" => "Transaction ended with an error");
                }


            } catch (\PDOException $ex) {
                $response = array("status" => "error", 'message' => "Error Message ->" . $ex->getMessage());
            }
        }
        return json_encode($response);
    }

    public function consolidatedSales($startDate = null, $endDate = null) {

        $startDate = date('Y-m-d', strtotime($startDate));

        $endDate = date('Y-m-d', strtotime($endDate));    
            if (is_null($startDate) && is_null($endDate)) {

                $where_clause = " cast(trans_date as date) = ";

            } elseif (is_null($startDate) && !is_null($endDate)) {

                $where_clause = " cast(trans_date as date) = :endDate";

            } elseif (!is_null($startDate) && is_null($endDate)) {

                $where_clause = " cast(trans_date as date) = :startDate";

            } else {

                $where_clause = " cast(trans_date as date) between :startDate  and :endDate";

            }     
            $QryStr = "select PORTFOLIO, AMOUNT, NETAMOUNT, TRANS_TYPE, MOP, TRANS_ID, "

            . " cast(noofshares as float) as SHARES, "

            . " MEMBER_NO, FULL_NAME, TRANS_DATE, INITDEPO from trans "

            . " where deleted is null and reversed is null and confirmed =1 "

            . " and " . $where_clause;

        try {

            $sth = $this->dbConnect->dbConn->prepare($QryStr);

            //$sth->bindValue(":company_id", 12);

            is_null($startDate) ? " " : $sth->bindParam(":startDate", $startDate);

            is_null($endDate) ? " " : $sth->bindParam(":endDate", $endDate);

            $sth->execute();

            $result = $sth->fetchAll(\PDO::FETCH_OBJ);

            $response['status'] = "success";

            $response['data'] = $result;

        } catch (\PDOException $ex) {

            $response['status'] = 'failed';

            $response['data'] = null;

        }

        return json_encode($response);

    }
   
}

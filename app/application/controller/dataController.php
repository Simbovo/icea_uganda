<?php

namespace application\controller;

use application\model\DbConnection;
use application\library\Logger;

class dataController
{

    var $dbh;
    private $staff_id;
    private $date;
    private $logger;
    private $branch_code;

    public function __construct() {
        session_start();
        $this->dbh = DbConnection::getInstance();
        $this->date = date('d/M/Y');
        $this->logger = new Logger();
        $this->branch_code = $_SESSION['branch_code'];
    }

    public function totalOnlineUsers() {
        $this->staff_id = $_SESSION['ref_no'];
        $QryStr = "SELECT * FROM memberpass WHERE refno != '$this->staff_id' ORDER BY refno DESC";
        try {
            $stmt = $this->dbh->dbConn->prepare($QryStr);
            $stmt->execute();
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);

            return $result;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function totalFeedBacks() {
        $QryStr = "select * from feedbacks";
        try {
            $stmt = $this->dbh->dbConn->prepare($QryStr);
            $stmt->execute();
            $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            $result = count($rows);
            return $result;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function totalOnlineRegisteredClients() {
        $QryStr = "SELECT count(*) FROM memberpass";
        try {
            $stmt = $this->dbh->dbConn->prepare($QryStr);
            $stmt->execute();

            $result = $stmt->fetchColumn();

            return $result;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function todaysTrans() {

        $QryStr = "SELECT count(*) FROM trans WHERE trans_date = CURRENT_DATE";

        try {
            $stmt = $this->dbh->dbConn->prepare($QryStr);
            $stmt->execute();

            $result = $stmt->fetchColumn();

            return $result;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function viewNavs() {
        $QryStr = "SELECT  NAVS.NAV_ID,  NAVS.NAV_DATE,  NAVS.SECURITY_CODE,  NAVS.AMOUNT,  NAVS.P_PRICE,  NAVS.ADM_FEE,
                    NAVS.STAFFNAME,  SECURITIES.DESCRIPT
                    FROM  NAVS
                    INNER JOIN SECURITIES ON NAVS.SECURITY_CODE = SECURITIES.SECURITY_CODE
                    WHERE
                    NAVS.CONFIRMD = 1 AND (NAVS.SECURITY_CODE <> '004') AND (NAVS.SECURITY_CODE <> '004')
                    ORDER BY
                    NAVS.NAV_DATE DESC";
        try {
            $stmt = $this->dbh->dbConn->prepare($QryStr);
            $stmt->execute();
            $action = "Viewed Net Asset Value details";
            //$this->logger->write_to_log($action);
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            return $result;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function viewRates() {
        $QryStr = "SELECT I_RATES.RATE_ID, I_RATES.RATE_DATE, I_RATES.RATE, I_RATES.STAFFNAME, SECURITIES.DESCRIPT
        FROM I_RATES
        INNER JOIN SECURITIES ON I_RATES.SECURITY_CODE = SECURITIES.SECURITY_CODE
         WHERE I_RATES.CONFIRMD = 1
         ORDER BY I_RATES.RATE_DATE DESC";
        try {
            $stmt = $this->dbh->dbConn->prepare($QryStr);
            $stmt->execute();

            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            $action = "Viewed rate values details";
            $this->logger->write_to_log($action);
            return $result;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getBankDetails() {
        $QryStr = "SELECT * FROM bank_details ORDER BY bank_name";
        try {
            $stmt = $this->dbh->dbConn->prepare($QryStr);
            $stmt->execute();

            $result = $stmt->fetchAll(\PDO::FETCH_OBJ);

            return $result;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getBankBranches($bank_code = "") {
        $QryStr = "select * from bank_branches where bank_code = :bank_code order by branch_name";
        try {
            $stmt = $this->dbh->dbConn->prepare($QryStr);
            if ($bank_code != "") {
                $stmt->bindParam(":bank_code", $bank_code);
            }
            $stmt->execute();

            $result = $stmt->fetchAll(\PDO::FETCH_OBJ);

            return $result;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     *
     * @return type
     */
    public function getBankBranch() {
        $QryStr = "select * from bank_branches order by branchname";
        try {
            $stmt = $this->dbh->dbConn->prepare($QryStr);

            $stmt->execute();

            $result = $stmt->fetchAll(\PDO::FETCH_OBJ);

            //return $result;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
        return $result;
    }

    public function getSecurityDetails($security_code) {
        $QryStr = "select * from securities where security_code = :sec_code";
        try {
            $stmt = $this->dbh->dbConn->prepare($QryStr);
            $stmt->bindParam(":sec_code", $security_code);
            $stmt->execute();

            $result = $stmt->fetch(\PDO::FETCH_OBJ);

            return $result;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getMaxSecCode() {
        $QryStr = "select * from I_RATES where cast(RATE_DATE as date)
                in (select max(cast(RATE_DATE as date)) from I_RATES where CONFIRMD is not null)";

        try {
            $stmt = $this->dbh->dbConn->prepare($QryStr);

            $stmt->execute();

            $result = $stmt->fetch(\PDO::FETCH_OBJ);

            return $result;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    /**
     * @param $sec_code
     * @return mixed
     */
       public function getMaxByNavDate($sec_code) {

        $QryStr = "SELECT  N.NAV_DATE,  N.AMOUNT, N.P_PRICE, S.DESCRIPT FROM  NAVS N
                  INNER JOIN SECURITIES S ON N.SECURITY_CODE = S.SECURITY_CODE
                  WHERE CAST(N.NAV_DATE AS DATE) = (SELECT Max(N.NAV_DATE)
                  FROM NAVS N WHERE N.CONFIRMD IS NOT NULL AND N.SECURITY_CODE = :code) AND N.CONFIRMD IS NOT NULL and  N.SECURITY_CODE <>'002' AND N.SECURITY_CODE = :code";

        try {
            $stmt = $this->dbh->dbConn->prepare($QryStr);
            $stmt->bindParam(":code", $sec_code);
            $stmt->execute();

            $result = $stmt->fetch(\PDO::FETCH_OBJ);

            return $result;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }


    public function getMaxNavDate() {

        $QryStr = "SELECT  N.NAV_DATE,  N.AMOUNT, N.P_PRICE, S.DESCRIPT FROM  NAVS N
                  INNER JOIN SECURITIES S ON N.SECURITY_CODE = S.SECURITY_CODE
                  WHERE CAST(N.NAV_DATE AS DATE) = (SELECT Max(N.NAV_DATE)
                  FROM NAVS N WHERE N.CONFIRMD IS NOT NULL) AND N.CONFIRMD IS NOT NULL 
                  AND N.SECURITY_CODE <>'002'";

        try {
            $stmt = $this->dbh->dbConn->prepare($QryStr);

            $stmt->execute();

            $result = $stmt->fetchAll(\PDO::FETCH_OBJ);

            return $result;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }


    public function totalRegisteredClients() {
        $QryStr = "SELECT count(*) FROM members WHERE confirmed IS NOT NULL ";
        try {
            $stmt = $this->dbh->dbConn->prepare($QryStr);
            $stmt->execute();

            $rows = $stmt->fetchColumn();
            return $rows;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    /**
     *     function to display sec details drop down
     */
    public function getSecDetails() {
        $QryStr = "SELECT * FROM securities";
        try {

            $stmt = $this->dbh->dbConn->prepare($QryStr);
            $stmt->execute();

            $result = $stmt->fetchAll(\PDO::FETCH_OBJ);

            return $result;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @return mixed
     *
     */
    public function getCatSecDetails() {
        $QryStr = "SELECT * FROM category order by membertype";
        try {

            $stmt = $this->dbh->dbConn->prepare($QryStr);
            $stmt->execute();

            $result = $stmt->fetchAll(\PDO::FETCH_OBJ);

            return $result;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @param $country
     * @return mixed
     */
    public function findTownName($country) {
        $QryStr = "SELECT * FROM towns  WHERE country = :country order by tname asc";
        try {

            $stmt = $this->dbh->dbConn->prepare($QryStr);
            $stmt->bindParam(":country", $country);
            $stmt->execute();

            $result = $stmt->fetchAll(\PDO::FETCH_OBJ);

            return $result;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @return mixed
     */
    public function townList() {
        $QryStr = "SELECT * FROM towns order by tname asc";
        try {

            $stmt = $this->dbh->dbConn->prepare($QryStr);

            $stmt->execute();

            $result = $stmt->fetchAll(\PDO::FETCH_OBJ);

            return $result;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @return mixed
     */
    public function countryList() {
        $QryStr = "SELECT * FROM country";

        try {

            $stmt = $this->dbh->dbConn->prepare($QryStr);

            $stmt->execute();

            $result = $stmt->fetchAll(\PDO::FETCH_OBJ);

            return $result;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @return mixed
     */
    public function userControl() {
        $QryStr = "select * from usercontrol";
        try {

            $stmt = $this->dbh->dbConn->prepare($QryStr);

            $stmt->execute();

            $result = $stmt->fetchAll(\PDO::FETCH_OBJ);

            return $result;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getHolidays() {
        $QryStr = "select * from holidays";
        try {

            $stmt = $this->dbh->dbConn->prepare($QryStr);

            $stmt->execute();

            $result = $stmt->fetchAll(\PDO::FETCH_OBJ);

            return $result;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @return mixed
     */
    public function getCutOff() {

        $QryStr = "select cut_off from syssettings";

        try {

            $stmt = $this->dbh->dbConn->prepare($QryStr);

            $stmt->execute();

            $result = $stmt->fetch(\PDO::FETCH_OBJ);

            return $result;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
/**
    public function navdate() {
        $QryStr = "SELECT  N.NAV_DATE,  N.AMOUNT, N.P_PRICE, S.DESCRIPT FROM  NAVS N
                  INNER JOIN SECURITIES S ON N.SECURITY_CODE = S.SECURITY_CODE
                  WHERE CAST(N.NAV_DATE AS DATE) = (SELECT Max(N.NAV_DATE)
                  FROM NAVS N WHERE N.CONFIRMD IS NOT NULL) AND N.CONFIRMD IS NOT NULL";
    }
 *
*/
    public function todaysMembers() {
        $QryStr = "SELECT COUNT(*) FROM MEMBERS WHERE CONFIRMED IS NULL AND MEMBERS.BRANCHID = $this->branch_code
                    AND REG_DATE = TO_DATE('$this->date','dd/mm/yyyy')";

        try {
            $sth = $this->dbh->dbConn->prepare($QryStr);
            $sth->execute();

            $rows = $sth->fetchColumn();
            return $rows;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    //$sql = "sql query e.g "select * from mytablename";
    //$filename = name of the file to download

    /* function queryToExcel($sql, $fileName = 'name.xlsx')
      {
      // initialise excel column name
      // currently limited to queries with less than 27 columns
      $columnArray = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
      // Execute the database query
      $result = mysql_query($sql) or die(mysql_error());

      // Instantiate a new PHPExcel object
      $objPHPExcel = new PHPExcel();
      // Set the active Excel worksheet to sheet 0
      $objPHPExcel->setActiveSheetIndex(0);
      // Initialise the Excel row number
      $rowCount = 1;
      // fetch result set column information
      $finfo = mysqli_fetch_fields($result);
      // initialise columnlenght counter
      $columnlenght = 0;
      foreach ($finfo as $val) {
      // set column header values
      $objPHPExcel->getActiveSheet()->SetCellValue($columnArray[$columnlenght++] . $rowCount, $val->name);
      }
      // make the column headers bold
      $objPHPExcel->getActiveSheet()->getStyle($columnArray[0] . "1:" . $columnArray[$columnlenght] . "1")->getFont()->setBold(true);

      $rowCount++;
      // Iterate through each result from the SQL query in turn
      // We fetch each database result row into $row in turn

      while ($row = mysqli_fetch_array($result, MYSQL_NUM)) {
      for ($i = 0; $i < $columnLenght; $i++) {
      $objPHPExcel->getActiveSheet()->SetCellValue($columnArray[$i] . $rowCount, $row[$i]);
      }
      $rowCount++;
      }
      // set header information to force download
      header('Content-type: application/vnd.ms-excel');
      header('Content-Disposition: attachment; filename="' . $fileName . '"');
      // Instantiate a Writer to create an OfficeOpenXML Excel .xlsx file
      // Write the Excel file to filename some_excel_file.xlsx in the current directory
      $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
      // Write the Excel file to filename some_excel_file.xlsx in the current directory
      $objWriter->save('php://output');
      } */
}

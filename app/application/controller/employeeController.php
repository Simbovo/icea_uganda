<?php

namespace application\controller;

use app\application\library\commonFunctions;
use application\library\Logger;
use application\model\DbConnection;

class employeeController {

    var $dbConnection;
    private $branchId, $branchName;
    private $function;
    private $user;
    private $logger;

    public function __construct() {
        session_start();
        $this->branchId = $_SESSION['branch_code'];
        $this->branchName = $_SESSION['branch_code'];
        $this->function = new commonFunctions();
        $this->dbConnection = DbConnection::getInstance();
        $this->user = $_SESSION['username'];
        $this->logger = new Logger();
    }

    /**
     * @param $pf_no
     * @return mixed
     */
    public function checkIfExits($pf_no) {
        $QyrStr = "SELECT * FROM EMPLOYEE WHERE PFNO = :pfno";
        try {
            $stmt = $this->dbConnection->dbConn->prepare($QyrStr);
            $stmt->execute(array(":pfno" => $pf_no));

            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    /**
     * @return mixed
     */
    public function employeeDetails() {

        $QryStr = "SELECT * FROM EMPLOYEE WHERE CONFIRMED = 1";

        try {
            $stmt = $this->dbConnection->dbConn->prepare($QryStr);
            $stmt->execute();
            $result = $stmt->fetchAll(\PDO::FETCH_OBJ);

            return $result;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     *
     * @param type $sname
     * @param type $oname
     * @param type $fullname
     * @param type $id_no
     * @param type $dob
     * @param type $d_employed
     * @param type $department
     * @param type $mobile_no
     * @param type $email
     * @param type $home_town
     * @param type $terms
     * @return boolean
     */
    public function registerEmployee($sname, $fullname, $id_no, $dob, $d_employed, $department, $mobile_no, $email, $home_town, $terms, $pf_no) {
        try {

            $query = "INSERT INTO employee(SURNAME, FULLNAMES, IDNO, DOB, DEMPLOYED,DEPTCODE, HTEL, EMAIL, HTOWN, TERMS,PFNO )
            VALUES(:surname,  :fullname, :id_no, :dob, :d_employed, :department, :mobile_no, :email,:hometown,:terms,:pf_no)";

            $stmt = $this->dbConnection->dbConn->prepare($query);

            $stmt->bindparam(":surname", $sname, \PDO::PARAM_STR);
            $stmt->bindparam(":fullname", $fullname, \PDO::PARAM_STR);
            $stmt->bindparam(":id_no", $id_no, \PDO::PARAM_INT);
            $stmt->bindparam(":dob", $dob, \PDO::PARAM_STR);
            $stmt->bindparam(":d_employed", $d_employed, \PDO::PARAM_STR);
            $stmt->bindparam(":department", $department, \PDO::PARAM_STR);
            $stmt->bindparam(":mobile_no", $mobile_no, \PDO::PARAM_STR);
            $stmt->bindparam(":email", $email, \PDO::PARAM_STR);
            $stmt->bindparam(":hometown", $home_town, \PDO::PARAM_STR);
            $stmt->bindparam(":terms", $terms, \PDO::PARAM_STR);
            $stmt->bindparam(":pf_no", $pf_no, \PDO::PARAM_STR);


            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            echo $e->getTraceAsString();
        }
    }

    /**
     *
     * @param type $sname
     * @param type $fullname
     * @param type $id_no
     * @param type $dob
     * @param type $d_employed
     * @param type $department
     * @param type $mobile_no
     * @param type $email
     * @param type $home_town
     * @param type $terms
     * @param type $pf_no
     * @param type $empcode
     * @return type
     */
    public function updateEmployee($sname, $fullname, $id_no, $dob, $d_employed, $department, $mobile_no, $email, $home_town, $terms, $pf_no, $empcode) {
        $QyrStr = "UPDATE EMPLOYEE SET surname=:surname, fullnames=:fullname, idno=:id_no,dob=:dob,demployed=:demployed,"
        . "deptcode=:department,htel=:mobile_no,email=:email,htown=:hometown,terms=:terms,pfno=:pfno where empcode= :empcode";
        ;
        try {

            $stmt = $this->dbConnection->dbConn->prepare($QyrStr);
            $stmt->bindparam(":surname", $sname, \PDO::PARAM_STR);
            $stmt->bindparam(":fullname", $fullname, \PDO::PARAM_STR);
            $stmt->bindparam(":id_no", $id_no, \PDO::PARAM_INT);
            $stmt->bindparam(":dob", $dob, \PDO::PARAM_STR);
            $stmt->bindparam(":demployed", $d_employed, \PDO::PARAM_STR);
            $stmt->bindparam(":department", $department, \PDO::PARAM_STR);
            $stmt->bindparam(":mobile_no", $mobile_no, \PDO::PARAM_STR);
            $stmt->bindparam(":email", $email, \PDO::PARAM_STR);
            $stmt->bindparam(":hometown", $home_town, \PDO::PARAM_STR);
            $stmt->bindparam(":terms", $terms, \PDO::PARAM_STR);
            $stmt->bindparam(":pfno", $pf_no, \PDO::PARAM_STR);
            $stmt->bindparam(":empcode", $empcode, \PDO::PARAM_STR);

            return $stmt->execute();
        } catch (\PDOException $e) {
            echo $e->getMessage();
            echo $e->getTraceAsString();
        }
    }

    public function pendingUsers() {
        $QryStr = "SELECT * FROM USERSETUP WHERE confirmed is null";
        try {
            $stmt = $this->dbConnection->dbConn->prepare($QryStr);
            $stmt->execute();

            $result = $stmt->fetchAll(\PDO::FETCH_OBJ);
            $action = "Viewed all users pending confirmation";
            $this->logger->write_to_log($action);
            return $result;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function deleteEmployee($employeeId, $reason) {
        $QryStr = "UPDATE usersetup SET deleted = 1, deletedby = '$this->user', deleteddate=CURRENT_TIMESTAMP,"
        . " DELETEREASON=:reason where user_id = :user_id";
        try {
            $stmt = $this->dbConnection->dbConn->prepare($QryStr);
            $stmt->bindParam(":reason", $reason);
            $stmt->bindParam("user_id", $employeeId);

            if ($stmt->execute()) {
                $action = "Deleted employee number $employeeId";
                $this->logger->write_to_log($action);
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function revokeEmployee($employeeId, $reason) {
        $QryStr = "UPDATE USESETUP SET DISABLED=1, DISABLEDBY = '$this->user', disableddate=CURRENT_TIMESTAMP, "
        . "DISABLED_REASON = :reason WHERE user_id=:user_id";
        try {
            $stmt = $this->dbConnection->dbConn->prepare($QryStr);
            $stmt->bindParam(":reason", $reason);
            $stmt->bindParam("user_id", $employeeId);

            if ($stmt->execute()) {
                $action = "Disabled employee number $employeeId";
                $this->logger->write_to_log($action);
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    /**
     *
     * @return type
     */
    public function notconfirmedEmployee() {
        $QryStr = "SELECT * FROM EMPLOYEE WHERE CONFIRMED IS NULL";

        try {
            $stmt = $this->dbConnection->dbConn->prepare($QryStr);
            $stmt->execute();

            $result = $stmt->fetchAll(\PDO::FETCH_OBJ);
            $action = "Viewed employees not confirmed";
            $this->logger->write_to_log($action);
            return $result;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    /**
     *
     * @param type $empcode
     * @return type
     *
     */
    public function getEmployeeById($empcode) {
        $QryStr = "SELECT * FROM EMPLOYEE WHERE EMPCODE = :empcode";

        try {
            $stmt = $this->dbConnection->dbConn->prepare($QryStr);
            $stmt->bindparam(":empcode", $empcode);
            $stmt->execute();

            $result = $stmt->fetch(\PDO::FETCH_OBJ);
            $action = "Viewed employee details of employee id $empcode";
            $this->logger->write_to_log($action);
            return $result;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    /**
     * function to confirm user
     * @param $user_id
     * @param $username
     * @return bool
     */
    public function confirmUser($user_id, $username) {
        $QryStr = "UPDATE USERSETUP SET CONFIRMED=1, confirmeddate = CURRENT_DATE, "
        . "confirmedby = :username where user_id= :user_id";

        try {
            $stmt = $this->dbConnection->dbConn->prepare($QryStr);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":user_id", $user_id);
            $rs = $stmt->execute();
            $action = "Confirmed user id $user_id.";
            $this->logger->write_to_log($action);
            if ($rs) {
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    /**
     * function to confirm employees registered in the system
     * @param $employee_code
     * @param $user
     * @return bool
     */
    public function confirmEmployee($employee_code, $user) {
        $QryStr = "UPDATE EMPLOYEE SET CONFIRMED = 1, CONFIRMEDDATE= CURRENT_TIMESTAMP, CONFIRMEDBY = :username "
        . "WHERE EMPCODE = :empcode";


        try {
            $stmt = $this->dbConnection->dbConn->prepare($QryStr);

            $stmt->execute(array(":username" => $user, ":empcode" => $employee_code));
            $action = "Confirmed employee details of employee id $employee_code";
            $this->logger->write_to_log($action);
            return TRUE;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
            return FALSE;
        }
    }

    /**
     *
     * @param type $username
     * @param type $branchid
     * @param type $user_type
     * @param type $branch_name
     * @param type $user_id
     * @return boolean
     *
     */
    public function editUserRoles($username, $branchid, $user_type, $branch_name, $user_id) {
        $QryStr = "UPDATE usersetup SET username = :username, branchid = :branchid, user_type=:user_type, "
        . "branchname = :branchname where user_id = :user_id";

        try {
            $stmt = $this->dbConnection->dbConn->prepare($QryStr);
            $stmt->execute(array(":username" => $username, "branchid" => $branchid, ":user_type" => $user_type, ":branchname" => $branch_name, "user_id" => $user_id));
            $action = "Edited user roles";
            $this->logger->write_to_log($action);
            return TRUE;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    /**
     *
     * @param type $user_id
     * @return type array
     */
    public function getUserDetails($user_id) {
        $QryStr = "select * from usersetup where user_id=:user_id";

        try {
            $stmt = $this->dbConnection->dbConn->prepare($QryStr);
            $stmt->bindparam(":user_id", $user_id);
            $stmt->execute();

            $result = $stmt->fetchAll(\PDO::FETCH_OBJ);
            $action = "Viewed user-setup details of user id $user_id";
            $this->logger->write_to_log($action);
            return $result;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    /**
     * @return mixed
     *
     */
    public function confirmedEmployees() {
        $QryStr = "SELECT  EMPCODE, FULLNAMES, IDNO, DOB,htel,email, deptcode FROM EMPLOYEE where "
        . "confirmed = 1 and EMPCODE not in(select USER_ID from USERSETUP) ORDER BY EMPCODE";

        try {
            $stmt = $this->dbConnection->dbConn->prepare($QryStr);

            $stmt->execute();

            $result = $stmt->fetchAll(\PDO::FETCH_OBJ);
            $action = "Viewed employee details not added as users";
            $this->logger->write_to_log($action);
            return $result;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function OnlineAccess($emp_code) {
        $QryStr = "SELECT  e.empcode, e.fullnames, e.idno, e.email,e.htel, E.DEMPLOYED, u.username, u.user_type, u.uname, u.branchid, u.branchname, u.user_id, e.deptcode, u.webpass FROM EMPLOYEE e
        inner join usersetup u on e.empcode = u.user_id where e.confirmed is not null and e.empcode=:empcode";
        try {
            $stmt = $this->dbConnection->dbConn->prepare($QryStr);
            $stmt->execute(array(":empcode" => $emp_code));

            $result = $stmt->fetch(\PDO::FETCH_OBJ);

            return $result;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function systemStaffById($user_id) {
        $QryStr = "SELECT  e.empcode, e.fullnames, e.idno, e.pfno, e.email,e.htel, E.DEMPLOYED, u.username, u.user_type, u.uname, u.branchid, u.branchname, u.user_id, e.deptcode, u.webpass FROM EMPLOYEE e
        inner join usersetup u on e.empcode = u.user_id where e.confirmed is not null and u.confirmed is not null and u.user_id = :user_id";

        try {
            $stmt = $this->dbConnection->dbConn->prepare($QryStr);

            $stmt->execute(array(":user_id" => $user_id));

            $result = $stmt->fetch(\PDO::FETCH_OBJ);
            $action = "Viewed system staff details";
            $this->logger->write_to_log($action);
            return $result;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function systemStaff() {
        $QryStr = "SELECT  e.empcode, e.fullnames, e.idno, e.email,e.htel, E.DEMPLOYED, u.username, u.user_type, u.uname, u.branchid, u.branchname, u.user_id, e.deptcode, u.webpass FROM EMPLOYEE e
        inner join usersetup u on e.empcode = u.user_id where e.confirmed is not null and u.confirmed is not null";

        try {
            $stmt = $this->dbConnection->dbConn->prepare($QryStr);

            $stmt->execute();

            $result = $stmt->fetchAll(\PDO::FETCH_OBJ);

            return $result;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function userChanges() {
        $strSQL = "SELECT * FROM usersetup where ((disabled is not null) or (deleted is not null)) and "
        . "((disabledby <> '$this->user') OR (deletedby <> '$this->user')) and ((confirm_disable is null) "
        . "AND (confirm_delete is null))";

        try {
            $stmt = $this->dbConnection->dbConn->prepare($strSQL);
            $stmt->execute();
            $result = $stmt->fetchAll(\PDO::FETCH_OBJ);
            $action = "Viewed users deleted/disabled";
            $this->logger->write_to_log($action);
            return $result;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function accessLogOn() {
        $QryStr = "SELECT a.sessionid, a.logid, a.memberid, a.logintime, a.user_type, u.username from accesslog a inner join
        usersetup u on a.memberid = u.user_id WHERE a.logouttime is null and u.user_id !== $this->user";

        try {
            $stmt = $this->dbConnection->dbConn->prepare($QryStr);
            $stmt->execute();
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function saveUser($userId, $username, $surname, $userType, $monn, $tue, $wedd, $thurs, $fri, $sat, $sun, $yearend, $regdate, $email, $uname, $branchid, $branchname) {
        $QryStr = "INSERT INTO usersetup(user_id,username, surname,user_type, monn, tuee, wedd, thurr, frii, satt, sunn,ldate, regdate, email,uname, branchid, branchname)
        VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

        try {
            $stmt = $this->dbConnection->dbConn->prepare($QryStr);

            $stmt->execute(array($userId, $username, $surname, $userType, $monn, $tue, $wedd, $thurs, $fri, $sat, $sun, $yearend, $regdate, $email, $uname, $branchid, $branchname));
            $action = "Registered a $userType user named $surname in the system";
            $this->logger->write_to_log($action);

            return true;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    /**
     * 
     * @param type $userId
     * @param type $email
     * @param type $username
     * @param type $userType
     * @param type $regdate
     * @param type $user_level
     * @return boolean
     */
    public function registerWebAccess($userId, $email, $username, $userType, $regdate, $user_level, $pass) {
        $QryM = "INSERT INTO MEMBERPASS(refno, e_mail, username, category, passwrd, code,  createddate, user_level)
        VALUES(?,?,?,?,?,?,?,?)";
        //$password = $this->function->generateRandomPassword();
        
        try {
            $sth = $this->dbConnection->dbConn->prepare($QryM);
            $res = $sth->execute(array($userId, $email, $username, $userType, $pass, 1, $regdate, $user_level));
            if ($res) {           
                $QyrU = "UPDATE usersetup set webpass = 1 where user_id = :userId";          
            
            try {

                $stmt = $this->dbConnection->dbConn->prepare($QyrU);
                //$params = array(":userId" => $userId, ":userId1"=>$userId, ":userId2"=>$userId);
                $stmt->bindParam(":userId", $userId);
                $rs = $stmt->execute();
                $action = "Registered user $username to access unittrust management portal";
                $this->logger->write_to_log($action);
                if ($rs) {
                    return true;
                } else {
                    return false;
                }
            } catch (Exception $ex) {
                echo $ex->getMessage();
            }
        } else {
            return false;
        }
    } catch (\PDOException $x) {
        echo $x->getMessage();
    }
}


    /**
     * This function is to transfer users from  one branch to anothers
     * 
     * @param type $branch_id
     * @param type $branch_name
     * @param type $user_id
     * @return boolean
     * 
     *
     */
    public function transferUser($branch_id, $branch_name, $user_id) {
        $QryStr = "update usersetup set branchid=:branch_id, branchname=:branch_name  where user_id=:user_id";

        try {
            $stmt = $this->dbConnection->dbConn->prepare($QryStr);
            $res = $stmt->execute(array(":branch_id" => $branch_id, "branch_name" => $branch_name, ":user_id" => $user_id));
            $action = "Transferred user $user_id to $branch_name";
            $this->logger->write_to_log($action);
            if ($res) {
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    /**
     * SELECT USER DETAILS FOR MANAGEMENT
     * @return mixed
     */
    public function manageUsers() {
        $QryStr = "SELECT user_id, username, surname, branchname, user_type FROM USERSETUP WHERE username != :staff and
        confirmed is not null and  deleted is null and
        webpass is not null and disabled is null order by user_id asc";
        try {
            $stmt = $this->dbConnection->dbConn->prepare($QryStr);
            $stmt->execute(array(":staff" => $this->user));
            $result = $stmt->fetchAll(\PDO::FETCH_OBJ);

            return $result;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    /**
     * @param $ref_no
     * @param $username
     * @param $surname
     * @param $category
     * @param $password
     * @param $user_level
     *
     *
     *
     */
    private function grantOnlineAccess($ref_no, $username, $email, $category, $user_level, $password) {
        $QryStr = "insert into memberpass (refno, username, e_mail, category,createddate, passwrd, code, user_level)"
        . "values(:refno, :username, :surname, :category,CURRENT_DATE, :passwrd, 1, :user_level)";
        try {
            $stmt = $this->dbConnection->dbConn->prepare($QryStr);
            $stmt->bindParam(":refno", $ref_no);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":surname", $email);
            $stmt->bindParam(":category", $category);
            $stmt->bindParam(":passwrd", $password);
            $stmt->bindParam(":user_level", $user_level);

           return  $stmt->execute();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function userWebAccess($userId, $email, $username, $userType, $regdate, $user_level, $password){
        $grant = $this->grantOnlineAccess($userId, $username, $email,  $userType,  $user_level, $password);

        if($grant){
            $update = $this->updateWebPass($userId, $userType);
            if(!$update){
                return false;
            }else{
                return true;
            }
            
        }else{
            return false;
        }
    }

    private function updateWebPass($user_id, $user_category){
        switch ($user_category) {
            case 'staff':
                # code...
                $table = 'usersetup';
                $where = 'user_id';
                break;
            case 'agent':
                $table = 'agents';
                $where = 'agent_no';
                break;
            default:
                # code...
                $table = 'members';
                $where = 'member_no';
                break;
        }

        $QryStr = "update $table set webpass = 1 where $where = :code";
        //echo $QryStr;
        try{
            $sth = $this->dbConnection->dbConn->prepare($QryStr);
            $sth->bindParam(":code", $user_id);
            return $sth->execute();
        }catch(\PDOException $ex){
            echo $ex->getMessage();
        }
    }

    public function confirmEditedUser() {

    }

    public function confirmRevokedUser($user_id) {
        $QryStr = "update usersetup set confirm_disable = 1,disable_confirmed_by='$this->user', confirm_disable_date=CURRENT_TIMESTAMP where user_id= :user_id";
        try {
            $stmt = $this->dbConnection->dbConn->prepare($QryStr);
            $res = $stmt->execute(array("user_id" => $user_id));
            if ($res) {
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function confirmDeletedUser($user_id) {
        $QryStr = "update usersetup set confirm_delete = 1,delete_confirmed_by='$this->user', confirm_delete_date=CURRENT_TIMESTAMP where user_id= :user_id";
        try {
            $stmt = $this->dbConnection->dbConn->prepare($QryStr);
            $res = $stmt->execute(array("user_id" => $user_id));
            if ($res) {
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function setPermisions() {

    }

    public function hasAccess() {

    }

}

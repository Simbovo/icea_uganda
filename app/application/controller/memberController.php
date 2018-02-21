<?php

namespace application\controller;

use application\model\DbConnection;
use app\application\library\commonFunctions;

class memberController
{

    var $dbh;
    var $staff_id;
    var $branchCode;
    var $hse_no;
    private $memberNo;
    private $ref_no;
    private $username;
    private $lib;

    function __construct() {
        $this->dbh = DbConnection::getInstance();
        $this->branch_ode = $_SESSION['branch_code'];
        $this->branch_name = $_SESSION['branch_name'];
        $this->current_date = date('d/m/Y');
        $this->ref_no = $_SESSION['ref_no'];
        $this->username = $_SESSION['username'];
        $this->lib = new commonFunctions();
    }

    public function checkIfRegistered($id, $gsm, $mail, $cif_id) {
        $QryStr = "SELECT * FROM MEMBERS WHERE ((id_no = :id) OR (gsm_no = :gsm) or (e_mail = :mail) or (:comments = :cif_id))";

        try {
            $stmt = $this->dbh->dbConn->prepare($QryStr);
            $stmt->execute(array(":id" => $id, ":gsm" => $gsm, ":mail" => $mail, ":cif_id" => $cif_id));

            $result = $stmt->fetch(\PDO::FETCH_ASSOC);

            IF (empty($result)) {
                return false;
            } else {
                return true;
            }
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function generateMemberNo() {
        try {
            $Qry = 'select gen_id(NIC_MEMBER_GEN, 1) as lastno from rdb$database';
            $sth = $this->dbh->dbConn->prepare($Qry);
            $sth->execute();
            $id = $sth->fetchColumn(0);
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }

        /* if (strlen($id) == 1) {
          $this->memberNo = "00000" . $id;
          } else if (strlen($id) == 2) {
          $this->memberNo = "0000" . $id;
          } else if (strlen($id) == 3) {
          $this->memberNo = "00" . $id;
          } else if (strlen($id) == 4) {
          $this->memberNo = "0000" . $id;
          } else if (strlen($id) == 6) {
          $this->memberNo = "000" . $id;
          } else if (strlen($id) == 7) {
          $this->memberNo = "00" . $id;
          } else if (strlen($id) == 8) {
          $this->memberNo = "0" . $id;
          } else {
          $this->memberNo = $id;
          } */
        return $id;
    }

    public function registerMember($title, $fname, $full_name, $sname, $oname, $mobile_no, $idno, $pin_no, $industry, $resident, $taxable, $pLocation, $country, $town, $postal_address, $dob, $employment_status, $employer, $hseNo, $comment, $email) {
        //$this->memberNo = $this->generateMemberNo();

        try {
            $query = "INSERT INTO members
            (member_no, title, firstname, allnames, surname, othernames, gsm_no, id_no, pin_no,occupation,resident,taxexempt,
            phys_address, country,town, post_address, dob,employed,employer, hse_no, branchid, branchname, comments, e_mail )
            VALUES(:member_no, :title, :first_name, :full_name, :surname, :other_name, :gsmNo, :id_no, :pin_no, :occupation,
            :resident, :tax_exempt, :phy_address, :country, :town, :post_address, :dob, :employed, :employer, :hse_no,
            :branch_id, :branch_name, :comments, :email)";


            $stmt = $this->dbh->dbConn->prepare($query);

            $stmt->bindParam(":member_no", $this->memberNo, \PDO::PARAM_STR);
            $stmt->bindParam(":title", $title);
            $stmt->bindParam(":first_name", $fname);
            $stmt->bindParam(":full_name", $full_name);
            $stmt->bindParam(":surname", $sname);
            $stmt->bindParam(":other_name", $oname);
            $stmt->bindParam(":gsmNo", $mobile_no);
            $stmt->bindParam(":id_no", $idno);
            $stmt->bindParam(":pin_no", $pin_no);
            $stmt->bindParam(":occupation", $industry);
            $stmt->bindParam(":resident", $resident);
            $stmt->bindParam(":tax_exempt", $taxable);
            $stmt->bindParam(":phy_address", $pLocation);
            $stmt->bindParam(":country", $country);
            $stmt->bindParam(":town", $town);
            $stmt->bindParam(":post_address", $postal_address);
            $stmt->bindParam(":dob", $dob);
            $stmt->bindParam(":employed", $employment_status);
            $stmt->bindParam(":employer", $employer);
            $stmt->bindParam(":hse_no", $hseNo);
            $stmt->bindParam(":branch_id", $this->branchCode);
            $stmt->bindParam(":branch_name", $this->branchName);
            $stmt->bindParam(":comments", $comment, \PDO::PARAM_STR);
            $stmt->bindParam(":email", $email);

            $stmt->execute();

//$action = "Registered client $full_name, member no $this->memberNo";
//$this->logger->write_to_log($action);
            return true;
        } catch (\PDOException $e) {
            echo $e->getTraceAsString();
            echo "<br>";
            echo $e->getMessage();
            return false;
        }
    }

    /**
     */
    public function checkIfExists($id, $gsm, $mail) {
        $QryStr = "SELECT * FROM members_web WHERE id_no = :id OR gsm_no = :gsm or e_mail = :mail";

        try {
            $stmt = $this->dbh->dbConn->prepare($QryStr);
            $stmt->execute(array(":id" => $id, ":gsm" => $gsm, ":mail" => $mail));

            $result = $stmt->fetch(\PDO::FETCH_ASSOC);

            if (empty($result)) {
                return false;
            } else {
                return true;
            }
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    /**
     *
     * @param string $title
     * @param strin $surname
     * @param string $first_name
     * @param string $othername
     * @param string $fullname
     * @param date $dob
     * @param string $gender
     * @param string $marital_status
     * @param string $town
     * @param string $id_no
     * @param string $gsm_no
     * @param string $email
     * @param string $postal_address
     * @param date $reg_date
     */
    public function memberSelfRegister($title, $surname, $first_name, $othername, $fullname, $dob, $gender, $marital_status, $town, $id_no, $gsm_no, $email, $postal_address, $reg_date) {
        $QryStr = "insert into members_web(title, firstname, surname, lastname,  allnames, post_address,reg_date,phys_address, town, gsm_no, e_mail,id_no,dob,gender, maritalstatus)
    values(:title,:fname,:sname,:lname,:allnames,:post_address,:reg_date,:phy_address, :town, :gsm_no,:email,:id_no,:dob,:gender,:marital_status )";
        try {
            $stmt = $this->dbh->dbConn->prepare($QryStr);
            $stmt->bindparam(":title", $title);
            $stmt->bindparam(":fname", $first_name);
            $stmt->bindparam(":sname", $surname);
            $stmt->bindparam(":lname", $othername);
            $stmt->bindparam(":allnames", $fullname);
            $stmt->bindparam(":post_address", $postal_address);
            $stmt->bindparam(":reg_date", $reg_date);
            $stmt->bindparam(":phy_address", $town);
            $stmt->bindParam(":town", $town);
            $stmt->bindparam(":gsm_no", $gsm_no);
            $stmt->bindparam(":email", $email);
            $stmt->bindparam(":id_no", $id_no);
            $stmt->bindparam(":dob", $dob);
            $stmt->bindparam(":marital_status", $marital_status);
            $stmt->bindparam(":gender", $gender);

            if (!$stmt->execute()) {
                return false;
            }
            return true;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
        }
    }

    /**
     *
     * @param type $data
     */
    public function getMemberImages($memberNo) {
        $QryStr = "SELECT signature1, picture1 FROM members WHERE member_no = :memberNo";
        try {
            $sth = $this->dbh->dbConn->prepare($QryStr);
            $sth->execute(array('memberNo' => $memberNo));

//bind selected columns
            $sth->bindColumn(1, $signature1, \PDO::PDO_BLOB);
            $sth->bindColumn(2, $picture1, \PDO::PDO_BLOB);

            $sth->fetch(\PDO::FETCH_BOUND);

            return $images = array('signature' => $signature1, 'picture' => $picture1);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function SingleRegisteredMembers() {
        $QryStr = "SELECT * FROM members WHERE confirmed = 1 AND hse_no ='Single Member'";

        try {
            $stmt = $this->dbh->dbConn->prepare($QryStr);
            $stmt->execute();

            $result = $stmt->fetchAll(\PDO::FETCH_OBJ);

            return $result;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function JointRegisteredMembers() {
        $QryStr = "SELECT * FROM members WHERE confirmed = 1 AND hse_no = 'Joint Member' ORDER BY member_no DESC";
        try {
            $stmt = $this->dbh->dbConn->prepare($QryStr);
            $stmt->execute();

            $result = $stmt->fetchAll(\PDO::FETCH_OBJ);

            return $result;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function InstitutionalRegisteredMembers() {
        $QryStr = "SELECT * FROM members WHERE confirmed = 1 AND hse_no = 'Institutional Member' ORDER BY member_no DESC";
        try {
            $stmt = $this->dbh->dbConn->prepare($QryStr);
            $stmt->execute();

            $result = $stmt->fetchAll(\PDO::FETCH_OBJ);

            return $result;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function clientProfile($member_no) {
        $QryStr = "select allnames, id_no,pin_no,post_address, tel_no, gsm_no, m.town, e_mail,
    phys_address, hse_no, accountname, accountno, bankname,branch,accounttype, a.town as banktown
    from members m inner join membersbankdetails a on (member_no = memberno) where member_no = :member_no";
        try {
            $stmt = $this->dbh->dbConn->prepare($QryStr);
            $stmt->bindparam(":member_no", $member_no);
            $stmt->execute();

            $result = $stmt->fetch(\PDO::FETCH_OBJ);
            return $result;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getClientDetails($member_no = "") {
        $QryStr = "SELECT * FROM members WHERE MEMBER_NO = :member_num";
        try {
            $stmt = $this->dbh->dbConn->prepare($QryStr);
            $stmt->bindparam(":member_num", $member_no);
            $stmt->execute();

            $result = $stmt->fetch(\PDO::FETCH_OBJ);
            return $result;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getOnlineUsers() {
        $this->staff_id = $_SESSION['ref_no'];
        $QryStr = "select * from memberpass where refno !='$this->staff_id' ORDER BY category ";
        try {
            $stmt = $this->dbh->dbConn->prepare($QryStr);
            $stmt->execute();
            $result = $stmt->fetchAll(\PDO::FETCH_OBJ);

            return $result;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getOnlineUserById($ref_no) {
        $QryStr = "select username, surname, category, refno, e_mail, passwrd  from memberpass where lower(username) = :ref_no";

        try {
            $stmt = $this->dbh->dbConn->prepare($QryStr);
            $stmt->bindparam(":ref_no", strtolower($ref_no));
            $stmt->execute();

            $result = $stmt->fetch(\PDO::FETCH_OBJ);

            return $result;
        } catch (\PDOException $ex) {
            $ex->getMessage();
        }
    }

    public function memberReport($report_type, $startDate, $endDate) {

        $QryStr = "select * from members where trunc(members.reg_date) between
    to_date(:startdate ,'dd/mm/yyyy')and to_date(:enddate ,'dd/mm/yyyy') and
    confirmed = 1 and hse_no =:hse_no and branchid =:br_id and confirmed = 1";
        try {
            $stmt = $this->dbh->dbConn->prepare($QryStr);

            $stmt->bindparam(":startDate", $startDate);
            $stmt->bindparam(":endDate", $endDate);
            $stmt->bindparam(":hse_no", $report_type);
            $stmt->bindparam(":br_id", $this->branchCode);

            $stmt->execute();

            $result = $stmt->fetchAll(\PDO::FETCH_OBJ);
            return $result;
        } catch (\PDOException $exe) {
            echo $exe->getMessage();
        }
    }

    public function changePassword($password, $username) {
        $QryStr = "UPDATE memberpass SET passwrd = ?, CODE=NULL WHERE lower(username) = ?";
        try {
            $stmt = $this->dbh->dbConn->prepare($QryStr);

            $ch_rs = $stmt->execute(array($password, strtolower($username)));

            if (!$ch_rs) {
                return false;
            }
            $rs = $this->updatePasswordHistory($password, 'PASSWORD RESET', $username);
            if (!$rs) {
                return false;
            }
            return true;
        } catch (\PDOException $ex) {
            $ex->getMessage();
        }
    }

    public function getHseNo() {
        $QryStr = "SELECT DISTINCT hse_no FROM members";
        try {
            $stmt = $this->dbh->dbConn->prepare($QryStr);
            $stmt->execute();

            $result = $stmt->fetchAll(\PDO::FETCH_OBJ);

            return $result;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function resetPassword($pass, $refno) {
        $QryStr = "UPDATE memberpass SET passwrd = ? CODE=1 WHERE refno = ?";
        try {
            $stmt = $this->dbh->dbConn->prepare($QryStr);

            $stmt->execute(array($pass, $refno));

            return true;
        } catch (\PDOException $ex) {
            $ex->getMessage();
        }
    }

    public function membersByUsername($username) {
        try {
            $QryStr = "SELECT * FROM memberpass where upper(username) = :username";

            $stmt = $this->dbh->dbConn->prepare($QryStr);
            $stmt->bindparam(":username", strtoupper($username), \PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(\PDO::FETCH_OBJ);

            return $result;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function membersByMemberNo($member_no) {
        try {
            $QryStr = "SELECT * FROM members where member_no = :member_no ";
            $stmt = $this->dbh->dbConn->prepare($QryStr);
            $stmt->bindparam(":member_no", $member_no, \PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(\PDO::FETCH_OBJ);

            return $result;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function membersNotOnline() {
        try {
            $QryStr = "select  * from members where webpass is null and confirmed is not null and e_mail is not null and hse_no = 'Single Member' ORDER BY member_no";
            $stmt = $this->dbh->dbConn->prepare($QryStr);
            $stmt->execute();
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            return $result;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function member_docs() {

    }

    public function AutoComplete($keyword) {
        $QryStr = "select distinct a.member_no, A.AGENT_NO, A.SECURITY_CODE, M.ALLNAMES, A.ACCOUNT_NO, m.HSE_NO, S.DESCRIPT, AG.AGENT_NAME
    from members m inner join accounts a on a.member_no = m.member_no INNER JOIN SECURITIES S ON
    S.SECURITY_CODE = A.SECURITY_CODE INNER JOIN AGENTS AG ON AG.AGENT_NO = A.AGENT_NO where
    ((a.member_no like :mem) OR (lower(m.allnames) like :id) or (a.ACCOUNT_NO like :acc))";

        try {
            $pkeyword = stripcslashes(strtolower($keyword));
            $stmt = $this->dbh->dbConn->prepare($QryStr);
            $stmt->bindValue(':mem', $pkeyword . '%');
            $stmt->bindValue(':id', $pkeyword . '%');
            $stmt->bindValue(':acc', $pkeyword . '%');
            //$params = array("%$pkeyword%", "%($pkeyword)%", "%$pkeyword%");
            $stmt->execute();

            $result = $stmt->fetchAll(\PDO::FETCH_OBJ);
            return $result;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function updateWeb($member_no) {

        $QryStr = "UPDATE members SET webpass=? WHERE member_no=?";
        $code = 1;
        try {
            $sth = $this->dbh->dbConn->prepare($QyrStr);
            $sth->bindValue(1, $code);
            $sth->bindValue(1, $member_no);
            $params = array(':code' => 1, ':code2' => $ref_no);
            $rds = $sth->execute();
            echo $rds;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function WebDetails($data_, $id) {
        $QryStr = 'UPDATE members_web SET bankname=:bank_name,brankname=:branch_name, acctname=:ac_name, acctnumber=:acno ,account_type=:account_type, contact_person=:contact_person, contact_email=:contact_email,kra_pin=:kra_pin, contact_phone=:contact_phone where id_no = :id';
        try {
            $data = json_decode($data_);
            list($bank_code, $bank_name) = explode('-', $data->bank_name, 2);
            $stmt = $this->dbh->dbConn->prepare($QryStr);
            $params = array(':bank_name' => $bank_name, ':branch_name' => $data->branch, ':ac_name' => $data->acct_name, ':acno' => $data->acct_no, ':account_type' => $data->acc_type, ':contact_person' => $data->c_person, ':contact_email' => $data->c_email, ':contact_phone' => $data->c_phone, ':kra_pin' => $data->kra_pin, ':id' => $id);
            if (!$stmt->execute($params)) {
                return false;
            }
            return true;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function beneficiariesInfo($member_no) {
        $SQLQry = "SELECT * FROM beneficiaries WHERE member_no = :member ORDER BY allnames ASC";
        //echo $SQLQry;
        try {
            $sth = $this->dbh->dbConn->prepare($SQLQry);
            $sth->bindParam(':member', $member_no);
            $sth->execute();
            $result = $sth->fetchAll(\PDO::FETCH_OBJ);

            return $result;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function list_members() {
        $QryStr = "SELECT * FROM members order by member_no asc";
        try {
            $sth = $this->dbh->dbConn->prepare($QryStr);

            $sth->execute();
            $result = $sth->fetchAll(\PDO::FETCH_OBJ);
            return $result;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function member_registration_v2($data_) {
        $data = json_decode($data_);


        $action = $this->lib->decryptStringArray($data->file_request, 'token321');


        if ($action === 'single') {
            $this->hse_no = 'Single Member';
            $url = 'beneficiary?id=';
            $salutation = $data->salutation;
            $full_name = $data->sname . " " . $data->fname . " " . $data->oname;
        } else if ($action == 'joint') {
            $this->hse_no = 'Joint Member';
            $url = 'joint-nominees?id=';
            $full_name = $data->joint_name;
            $salutation = "Joint";
        } else if ($action == 'group') {
            $this->hse_no = 'Institutional Member';
            $url = 'group-nominees?id=';
            $salutation = "Group";
            $full_name = $data->group_name;
        } else {

        }
        list($bank_code, $bank_name) = explode("-", $data->bank_name, 2);

        $postal_address = $data->postal_address . "-" . $data->postal_code;
        $branch_id = "68" . $_SESSION['branch_code'];
        $branch_name = $_SESSION['branch_name'];
        $birth_date = date('Y-m-d', strtotime($data->dob));

        try {
            $this->dbh->dbConn->beginTransaction();

            $member_no = $this->generateMemberNo();
            $QrtStrMember = "INSERT INTO members (member_no, title, firstname, surname, othernames, allnames, "
                . "post_address, reg_date, phys_address, hse_no, town, country, gsm_no,e_mail, id_no, dob,gender, maritalstatus, "
                . "comments, taxexempt, resident, branchid, branchname, sms_ntfy, smsqry_accept, statementtype, company_id) "
                . "VALUES(:member_no, :title, :f_name, :surname, :other_name, :full_name, :post_address, "
                . ":phys_address, CURRENT_DATE, :hse_no, :town, :country, :gsm_no,:e_mail, :id_no, :dob,:gender,  :marital_status,:comments, "
                . ":tax_exempt, :resident,  :branch_id, :branch_name,:sms_notify, :sms_query, :statement_via, 2)";

            $QryStrBank = " insert into membersbankdetails(memberno, bankname, bankcode, fullnames, branch, branch_id, accountname,accounttype, accountno)"
                . "values(:mem_num, :bank_name, :bank_code,:full_name, :branch,:branch_id,:acc_name,:acc_type, :acc_no)";

            $sthMember = $this->dbh->dbConn->prepare($QrtStrMember);
            $stmt = $this->dbh->dbConn->prepare($QryStrBank);

            /**
             *
             * Register member
             *
             */
            $sthMember->bindParam(":member_no", $member_no, \PDO::PARAM_STR);
            $sthMember->bindParam(":title", $salutation, \PDO::PARAM_STR);
            $sthMember->bindParam(":f_name", $data->fname, \PDO::PARAM_STR);
            $sthMember->bindParam(":surname", $data->sname, \PDO::PARAM_STR);
            $sthMember->bindParam(":other_name", $data->oname, \PDO::PARAM_STR);
            $sthMember->bindParam(":full_name", ucwords(strtolower($full_name)), \PDO::PARAM_STR);
            $sthMember->bindParam(":post_address", $postal_address, \PDO::PARAM_STR);
            $sthMember->bindParam(":hse_no", $this->hse_no, \PDO::PARAM_STR);
            $sthMember->bindParam(":town", $this->town, \PDO::PARAM_STR);
            $sthMember->bindParam(":country", $data->country, \PDO::PARAM_STR);
            $sthMember->bindParam(":gsm_no", $data->mobile_no, \PDO::PARAM_STR);
            $sthMember->bindParam(":e_mail", $data->email, \PDO::PARAM_STR);
            $sthMember->bindParam(":id_no", $data->idno, \PDO::PARAM_STR);
            $sthMember->bindParam(":dob", $birth_date, \PDO::PARAM_STR);
            $sthMember->bindParam(":gender", $data->gender, \PDO::PARAM_STR);
            $sthMember->bindParam(":marital_status", $data->marital_status, \PDO::PARAM_STR);
            $sthMember->bindParam(":comments", $data->account_mandate, \PDO::PARAM_STR);
            $sthMember->bindParam(":tax_exempt", $data->tax_exempt, \PDO::PARAM_STR);
            $sthMember->bindParam(":resident", $data->resident);
            $sthMember->bindParam(":branch_id", $branch_id, \PDO::PARAM_STR);
            $sthMember->bindParam(":branch_name", $branch_name, \PDO::PARAM_STR);
            $sthMember->bindParam(":sms_notify", $data->sms_notify, \PDO::PARAM_STR);
            $sthMember->bindParam(":sms_query", $data->sms_enquiry, \PDO::PARAM_STR);
            $sthMember->bindParam(":phys_address", $data->pLocation, \PDO::PARAM_STR);
            $sthMember->bindParam(":statement_via", $data->statement_via, \PDO::PARAM_STR);


            /**
             * register client Bank account
             */
            $stmt->bindParam(":mem_num", $member_no);
            $stmt->bindParam(":bank_name", $bank_name);
            $stmt->bindParam(":bank_code", $bank_code);
            $stmt->bindParam(":full_name", ucwords(strtolower($full_name)));
            $stmt->bindParam(":branch", $data->branch);
            $stmt->bindParam(":branch_id", $data->branch);
            $stmt->bindParam(":acc_name", ucwords(strtolower($data->acct_name)));
            $stmt->bindParam(":acc_type", $data->acct_type);
            $stmt->bindParam(":acc_no", $data->acct_no);
            //$stmt->bindParam(":user", )

            $sthMember->execute();
            $stmt->execute();

            /**
             * return success message
             */
            $this->dbh->dbConn->commit();
            $response['status'] = "success";
            $response['member_no'] = $member_no;
            $response['message'] = "Member has been created successfully, member number is ";
            $response['uri'] = $url . $member_no;
        } catch (\PDOException $ex) {

            $this->dbh->dbConn->rollback();
            $response['Status'] = "failed";
            $response['Message'] = "Error While creating user with message: " . $ex->getTraceAsString() . $ex->getMessage() . " " . " on line number " . $ex->getLine();
        }
        return json_encode($response);
    }

    public function nominees_registration($post_data) {

        $data = json_decode($post_data);
        $action = $this->lib->decryptStringArray($data->token, 'token321');
        $request_file = $this->lib->decryptStringArray($data->file, 'token321');


        $postal_address = $data->postal_address . "-" . $data->postal_code;

        $birth_date = date('Y-m-d', strtotime($data->dob));
        $full_name = $data->sname . " " . $data->fname . " " . $data->oname;

        if ($request_file == 'group') {
            $tbl_name = "beneficiaries";
            if ($data->another_nominee == 1) {
                $url = "group-nominees?id=";
            } else {
                $url = "document-upload?id=";
            }
        } else {
            if ($action == 'beneficiaries') {
                $tbl_name = "beneficiaries";
                if ($data->another_nominee == 1) {
                    $url = "beneficiary?id=";
                } else {
                    $url = "document-upload?id=";
                }
            } else {
                $tbl_name = "members_joint";
                if ($data->another_nominee == 1) {
                    $url = "joint-nominees?id=";
                } else {
                    $url = "beneficiaries?id=";
                }
            }
        }


        try {
            $this->dbh->dbConn->beginTransaction();

            $QrtStrMember = "INSERT INTO " . $tbl_name . " (member_no, title, f_name, surname, othernames, allnames, reg_date,"
                . "post_address,  town, country, gsm_no,e_mail, id_no, dob,gender, maritalstatus, "
                . "comments, taxexempt, resident,  sms_ntfy, smsqry_accept, percentage) "
                . "VALUES(:member_no, :title, :f_name,  :surname, :other_name, :full_name, CURRENT_DATE, :post_address, "
                . ":town, :country, :gsm_no,:e_mail, :id_no, :dob,:gender,  :marital_status,:comments, "
                . ":tax_exempt, :resident,:sms_notify , :sms_query, :percentage)";

            $sthMember = $this->dbh->dbConn->prepare($QrtStrMember);
            /**
             *
             * Register member
             *
             */
            $sthMember->bindParam(":member_no", $data->member_no, \PDO::PARAM_STR);
            $sthMember->bindParam(":title", $data->salutation);
            $sthMember->bindParam(":f_name", $data->fname);
            $sthMember->bindParam(":surname", $data->sname);
            $sthMember->bindParam(":other_name", $data->oname);
            $sthMember->bindParam(":full_name", ucwords(strtolower($full_name)), \PDO::PARAM_STR);
            $sthMember->bindParam(":post_address", $postal_address);
            $sthMember->bindParam(":town", $data->town, \PDO::PARAM_STR);
            $sthMember->bindParam(":country", $data->country);
            $sthMember->bindParam(":gsm_no", $data->mobile_no);
            $sthMember->bindParam(":e_mail", $data->email);
            $sthMember->bindParam(":id_no", $data->idno);
            $sthMember->bindParam(":dob", $birth_date);
            $sthMember->bindParam(":gender", $data->gender);
            $sthMember->bindParam(":marital_status", $data->marital_status);
            $sthMember->bindParam(":comments", $data->CustomerID, \PDO::PARAM_STR);
            $sthMember->bindParam(":tax_exempt", $data->tax_exempt);
            $sthMember->bindParam(":resident", $data->resident);
            $sthMember->bindParam(":sms_notify", $data->sms_notify);
            $sthMember->bindParam(":sms_query", $data->sms_enquiry);
            $sthMember->bindParam(":percentage", $data->percentage);
            $sthMember->execute();

            /**
             * return success message
             */
            $this->dbh->dbConn->commit();
            $response['status'] = "success";
            $response['member_no'] = $data->member_no;
            $response['message'] = "Member has been created successfully, member number is ";
            $response['uri'] = $url . $data->member_no;
        } catch (\PDOException $ex) {

            $this->dbh->dbConn->rollback();
            $response['Status'] = "failed";
            $response['Message'] = "Error While creating user with message: " . $ex->getMessage() . " on line number " . $ex->getLine();
        }
        return json_encode($response);
    }

    public function beneficiaries($post_data) {

    }

    public function calculate_percentage($member_no, $percentage) {
        try {
            $sth = $this->dbh->dbConn->prepare("select percentage from beneficiaries where member_no = :member_no");
            $sth->bindParam(":member_no", $member_no, \PDO::PARAM_STR);
            $sth->execute();

            $rows = $sth->fetchAll(\PDO::FETCH_ASSOC);
            if (count($rows) > 0) {
                $total_percent = 0;
                foreach ($rows as $row) {
                    $total_percent = (int)$total_percent + (int)$row['percentage'];
                }
                if($total_percent + $percentage > 100){
                    echo "percentage_invalid";
                }
            } else {
                $total_percent = 0;
            }

        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
        return $total_percent;
    }

}

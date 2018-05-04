<?php

/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 9/4/15
 * Time: 2:17 PM
 */

namespace app\application\controller;

use application\model\DbConnection;

session_start();

class agentController {

    private $dbConnection;
    private $agent_no;

    public function __construct() {
        session_start();
        $this->dbConnection = DbConnection::getInstance();
        $this->agent_no = $_SESSION['ref_no'];
    }
    
    public function viewAgents(){
        $QryStr = "select * from agents order by agent_no asc";
        try{
            $sth = $this->dbConnection->dbConn->prepare($QryStr);
            $sth->execute();
            $rows = $sth->fetchAll(\PDO::FETCH_OBJ);
            return $rows;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

     private function generateAgentNo() {
        $QryStr = 'select gen_id(GENAGENT, 1) as lastno from rdb$database';
        try {
            $sth = $this->dbConnection->dbConn->prepare($QryStr);
            $sth->execute();
            $id = $sth->fetchColumn(0);
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }

        if (strlen($id) == 1) {
            $agentNo = "000" . $id;
        } else if (strlen($id) == 2) {
            $agentNo = "00" . $id;
        } else if (strlen($id) == 3) {
            $agentNo = "0" . $id;
        } else {
            $agentNo = $id;
        }
        return $agentNo;
    }

    public function checkIfExists($email, $idno) {
        $QryStr = "select * from agents where e_mail = :email and id_no = :id_no";
        try {
            $sth = $this->dbConnection->dbConn->prepare($QryStr);
            $sth->execute(array("email" => $email, "id_no" => $idno));
            $rows = $sth->fetch(\PDO::FETCH_ASSOC);
            return $rows;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function agentDetails($id = '') {
        if($id == ''){
            $agent_no = $this->agent_no;
        }else{
            $agent_no = $id; 
        }
        $QryStr = "select * from agents where agent_no = :id";
        //echo $QryStr;
        try {
            $stmt = $this->dbConnection->dbConn->prepare($QryStr);
            $stmt->bindparam(":id", $agent_no);
            $stmt->execute();

            $details = $stmt->fetch(\PDO::FETCH_OBJ);

            return $details;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function agentClients($agent_no) {
        $QryStr = "select distinct agents.agent_no, agents.agent_name,
        members.member_no,members.title,members.allnames,members.post_address,members.reg_date,members.tel_no,
        members.phys_address,members.town,members.street,members.gsm_no,members.e_mail,members.id_no,members.pin_no
        from
        accounts inner join
        agents  on agents.agent_no = accounts.agent_no
        inner join members
        on accounts.member_no = members.member_no where agents.agent_no = :agent_no";

        try {
            $stmt = $this->dbConnection->dbConn->prepare($QryStr);
            $stmt->bindparam(":agent_no", $agent_no);
            $stmt->execute();

            $result = $stmt->fetchAll(\PDO::FETCH_OBJ);
            return $result;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

  public function registerAgent($data_) {
        $agent_no = $this->generateAgentNo();
        $data = json_decode($data_);
        list($bank_id, $bank) = explode("-", $data->bank_name, 2);
        list($cat_id, $category) = explode("-", $data->agent_category,2);        
        list($type_id, $agent_type) = explode("-", $data->agent_type,2);
        

        $QryStr = "insert into agents(agent_no,agent_name, post_address,phys_address,country,town,gsm_no,e_mail,id_no, pin_no, bankcode, bankdesc,  accountno,catid, catname, typeid, typename)
        VALUES (:agent_no,:agent_name,:post_address,:phys_address,:country,:town,:gsm_no,:email,:id_no,:pin_no, :bank_code, :bank_desc, :account_no,:catid,:catname,:typeid, :typename)";
        try {
            $sth = $this->dbConnection->dbConn->prepare($QryStr);
            $sth->bindParam(":agent_no", $agent_no, \PDO::PARAM_STR);
            $sth->bindParam(":agent_name", $data->agent_name, \PDO::PARAM_STR);
            $sth->bindParam(":post_address", $data->post_address, \PDO::PARAM_STR);
            $sth->bindParam(":phys_address", $data->phys_address, \PDO::PARAM_STR);
            $sth->bindParam(":country", $data->country, \PDO::PARAM_STR);
            $sth->bindParam(":town", $data->town, \PDO::PARAM_STR);
            $sth->bindParam(":gsm_no", $data->gsm_no, \PDO::PARAM_STR);
            $sth->bindParam(":email", $data->email, \PDO::PARAM_STR);
            $sth->bindParam(":id_no", $data->id_no, \PDO::PARAM_STR);
            $sth->bindParam(":pin_no", $data->pin_no, \PDO::PARAM_STR);
            $sth->bindParam(":bank_code", $bank_id, \PDO::PARAM_STR);
            $sth->bindParam(":bank_desc", $bank, \PDO::PARAM_STR);
            $sth->bindParam(":account_no", $data->account_no, \PDO::PARAM_STR);
            $sth->bindParam(":catid",$cat_id, \PDO::PARAM_STR);
            $sth->bindParam(":catname", $category, \PDO::PARAM_STR);
            $sth->bindParam(":typeid", $type_id, \PDO::PARAM_STR);
            $sth->bindParam(":typename", $agent_type, \PDO::PARAM_STR);

            $res = $sth->execute();

            return $res;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }
    public function getAgentTypes() {
        $QryStr = "SELECT * FROM agenttype order by typeid asc";
        try {

            $stmt = $this->dbConnection->dbConn->prepare($QryStr);

            $stmt->execute();

            $result = $stmt->fetchAll(\PDO::FETCH_OBJ);

            return $result;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getAgentCat() {
        $QryStr = "select * from agentscategory order by transno asc";
        try {

            $stmt = $this->dbConnection->dbConn->prepare($QryStr);

            $stmt->execute();

            $result = $stmt->fetchAll(\PDO::FETCH_OBJ);

            return $result;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
    
    public function deleteAgent($agentId) {
        $QryStr = "DELETE FROM agents where agent_no = :agent_no";
        try {

            $stmt = $this->dbConnection->dbConn->prepare($QryStr);

            $result  = $stmt->execute(array(":agent_no"=>$agentId));

            return $result;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
    /**
     * View agents not online
     * 
     * @return type array
     */
    public function agentsNotOnline(){
        $QryStr = "SELECT * FROM agents WHERE confirmed IS NOT NULL AND webpass IS NULL AND e_mail IS NOT NULL ORDER BY AGENT_NO;";
        try{
            $sth = $this->dbConnection->dbConn->prepare($QryStr);
            $sth->execute();
            
            $result = $sth->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $ex) {
           echo $ex->getMessage();
       }
   }

   public function agent_new_members($agent_no){
    $QryStr = "SELECT * FROM ";
    }

    public function updateWeb($ref_no){

        $QryStr = "UPDATE agents SET webpass = 1 WHERE agent_no = :ref_no";

        try{
            $sth = $this->dbConnection->dbConn->prepare($QyrStr);
            $sth->bindParam(":ref_no", $ref_no);
            $sth->execute();
        }catch(\PDOException $ex){
            echo $ex->getMessage();
        }
    }

}

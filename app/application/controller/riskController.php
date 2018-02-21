<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of registration
 *
 * @author Allan Wiz
 */

namespace application\controller;

use application\model\DbConnection;

class risk {

    private $dbh, $date;

    function __construct() {
       $this->dbh = DbConnection::getInstance();
       $this->date = CURRENT_TIMESTAMP;
   }



   public function get_quiz() {
    $QryStr = "SELECT * FROM question order by autoid";

    try {
        $stmt = $this->dbh->dbConn->prepare($QryStr);

        $stmt->execute();

        $result = $stmt->fetchAll(\PDO::FETCH_OBJ);

        return $result;
    } catch (\PDOException $ex) {
        echo $ex->getMessage();
    }
}

public function risk_anwers($auto_id) {
    $QryStr = "SELECT * FROM answers WHERE questionid  = :autoid order by tag asc";
    try {
        $stmt = $this->dbh->dbConn->prepare($QryStr);
        $stmt->bindParam(":autoid", $auto_id);
        $stmt->execute();

        $result = $stmt->fetchAll(\PDO::FETCH_OBJ);

        return $result;
    } catch (\PDOException $ex) {
        echo $ex->getMessage();
    }
}

public function save_answers($data, $id){
    $QryStr = "insert into results (questionid, points, transdate, customerid, memberid)
    values(:questionid, :points, $this->date, :cus_id, :mem_id)";
    $ins_data = json_decode($data);
    try{
        $stmt = $this->dbh->dbConn->prepare($QryStr);
        $stmt->bindParam(":questionid", $ins_data->questionid);
        $stmt->bindParam(":points", $ins_data->points);
        $stmt->bindParam(":cus_id", $id);
        $stmt->bindParam(":mem_id", $id);

        if(!$stmt->execute()){
            return false;
        }
        return true;

    }catch(\PDOException $ex){
       echo $ex->getMessage();
   }
}

public function score_card($id, $qn_count){
    $QryStr = "SELECT sum(points) as points, memberid FROM results WHERE memberid = :member_id GROUP BY memberid";

    try{
        $stmt = $this->dbh->dbConn->prepare($QryStr);
        $stmt->bindParam(":member_id", $id);
        $stmt->execute();

        $data = $stmt->fetch(\PDO::FETCH_OBJ);

        $score_card = number_format($data->points/$qn_count, 2);

        return $score_card;

    }catch(\PDOException $ex){
        echo $ex->getMessage();
    }
}
public function getPreferedFund($score){

    $QryStr = "SELECT  rmin,rmax,fund,description,objective, fund_name from risk WHERE :score BETWEEN rmin AND rmax";

    try{
        $stmt = $this->dbh->dbConn->prepare($QryStr);
        $stmt->bindParam(":score", $score);
        $stmt->execute();

        $data = $stmt->fetch(\PDO::FETCH_OBJ);

    
        return $data;


    }catch(\PDOException $ex){
        echo $ex->getMessage();
    }
}
}


?>

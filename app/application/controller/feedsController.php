<?php

namespace application\controller;

use application\model\DbConnection;
use application\controller\memberController;
use application\controller\Mailer;
class feedsController {

    private $dbConnection;
    private $member;
    private $mailer;

    public function __construct() {
        $this->dbConnection = DbConnection::getInstance();
        $this->member = new memberController();
        $this->mailer = new Mailer();
    }

    public function viewAllFeedback() {
        $QryStr = "SELECT * FROM feedbacks";
        try {
            $stmt = $this->dbConnection->dbConn->prepare($QryStr);
            $stmt->execute();

            $result = $stmt->fetchAll(\PDO::FETCH_OBJ);

            return $result;
        } catch (\PDOException $e) {
            echo $e->getTraceAsString();
            echo $e->getMessage();
        }
    }

    public function saveFeedback($member_no, $category, $subject, $message) {
        $QryStr = "INSERT INTO feedbacks (member_no, category,subject,description)
         VALUES (:member_no,:cat, :subject,:description)";
        try {
            $stmt = $this->dbConnection->dbConn->prepare($QryStr);
            $stmt->bindparam(":member_no", $member_no);
            $stmt->bindparam(":cat", $category);
            $stmt->bindparam(":subject", $subject);
            $stmt->bindparam(":description", $message);

            $memberDetails = $this->member->clientProfile($member_no);

            //compose email from here


            $stmt->execute();
            return true;
        } catch (\PDOException $f) {
            echo $f->getMessage();
            echo $f->getTraceAsString();
        }
    }

    public function updateFeedbackResponse($username, $id, $response) {
        $QryStr = "UPDATE feedbacks SET responded_to='1',responce=:response,
        responcedate=current_date ,responded_by=:username where id=:id";
        try {
            $stmt = $this->dbConnection->dbConn->prepare($QryStr);
            $stmt->bindparam(":username", $username);
            $stmt->bindparam(":id", $id);
            $stmt->bindparam(":response", $response);
            $stmt->execute();

            return true;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function viewFeedsById($feed_id) {
        $QryStr = "SELECT * FROM feedbacks where id = :id";
        try {
            $stmt = $this->dbConnection->dbConn->prepare($QryStr);
            $stmt->bindparam(":id", $feed_id, \PDO::PARAM_INT);
            $stmt->execute();

            $result = $stmt->fetch(\PDO::FETCH_OBJ);
            return $result;
        } catch (\PDOException $e) {
            echo $e->getTraceAsString();
            echo $e->getMessage();
        }
    }

    public function clientFeedBack($member_no, $feed_id, $category) {
        $QryStr = "SELECT * FROM feedbacks WHERE id=:id AND member_no=:member_no AND category=:category";
        try {
            $stmt = $this->dbConnection->dbConn->prepare($QryStr);
            $stmt->bindparam(":id", $feed_id);
            $stmt->bindparam(":member_no", $member_no);
            $stmt->bindparam(":category", $category);

            $stmt->execute();
            $result = $stmt->fetch(\PDO::FETCH_OBJ);
            return $result;
        } catch (\PDOException $ex) {
            $ex->getMessage();
        }
    }

    public function agentFeedsDetails($agentNo) {
        $QryStr = "select distinct f.id,f.subject,f.responded_to,f.submission_date, f.responded_by, f.description, a.agent_no,a.member_no,
        m.allnames from feedbacks f inner join accounts a on f.member_no = a.member_no
        inner join members m on a.member_no = m.member_no
         where f.category = 'customer' and a.agent_no =:agent_no";
        try {
            $stmt = $this->dbConnection->dbConn->prepare($QryStr);
            $stmt->bindparam(":agent_no", $agentNo);
            $stmt->execute();

            $result = $stmt->fetchAll(\PDO::FETCH_OBJ);
            return $result;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function feedbackbycategory($ref_no, $category) {
        try {
            $QryStr = "SELECT * FROM feedbacks WHERE member_no =:ref_no AND category =:cat ";
            $stmt = $this->dbConnection->dbConn->prepare($QryStr);
            $stmt->bindParam(":ref_no", $ref_no);
            $stmt->bindParam(":cat", $category);
            $stmt->execute();

            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            return $result;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

}

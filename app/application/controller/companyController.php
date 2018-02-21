<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace application\controller;

use application\model\DbConnection;

/**
 * Description of companyController
 *
 * @author Allan Wiz
 */
class companyController
{

    //put your code here
    private $dbConnection;
    private $company_name;
    private $company_tel;
    private $username;
    private $user_id;

    public function __construct()
    {
        session_start();
        $this->dbConnection = DbConnection::getInstance();
        $this->username = $_SESSION['username'];
        $this->user_id = $_SESSION['user_id'];
    }

    public function getCompanyDetails()
    {
        $QryStr = "SELECT * FROM  COMPANY";
        try {
            $stmt = $this->dbConnection->dbConn->prepare($QryStr);
            $stmt->execute();

            $result = $stmt->fetch(\PDO::FETCH_OBJ);
            return $result;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function viewBranches()
    {
        $QryStr = "SELECT * FROM branches order by branchid";

        try {
            $stmt = $this->dbConnection->dbConn->prepare($QryStr);
            $stmt->execute();

            $result = $stmt->fetchAll(\PDO::FETCH_OBJ);
            return $result;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function addBranch($data)
    {
        $QryStr = "INSERT INTO BRANCHES (branchid,branchname, town, userid)
            VALUES(:br_id, :branch_name, :town, :userid)";

        try {
            $stmt = $this->dbConnection->dbConn->prepare($QryStr);
            $stmt->bindParam(":br_id", $data->branch_code);
            $stmt->bindParam(":branch_name", $data->branch_name);
            $stmt->bindParam(":town", $data->town);
            $stmt->bindParam(":userid", $this->user_id);

            $stmt->execute();
            
            return true;
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
        }
    }
}


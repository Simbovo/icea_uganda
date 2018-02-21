<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require('app/Loader.php');

use application\model\DbConnection;

$dbh = DbConnection::getInstance();


if (isset($_GET)) {
    $account_no = $_GET['account_no'];
    $member_no = $_GET['member_no'];

    $month = date('n');
    $year = date('Y');

    $query = "SELECT * FROM trans WHERE account_no = :account AND member_no =:member_no and deleted is null"
            . " and reversed is null and confirmed is not null and tmonth = :mm and tyear = :yy and trans_type = 'WITHDRAWAL'";
   /* echo $month;
    echo $year;*/
    try {
        $sth = $dbh->dbConn->prepare($query);
        $sth->bindParam(":account", $account_no, PDO::PARAM_STR);
        $sth->bindParam(":member_no", $member_no, PDO::PARAM_STR);
        $sth->bindParam(":mm", $month, PDO::PARAM_INT);
        $sth->bindParam(":yy", $year, PDO::PARAM_INT);
        $sth->execute();

        $result = $sth->fetch(PDO::FETCH_ASSOC);

        if (is_array($result)) {
            $response = array("status" => "info", "message" => "This is your second withdrawal of this month and it will incur some cost, do you wish to continue?");
        } else {
            $response = array("status" => "success", "message"=>"No record this month");
        }
    } catch (Exception $ex) {
        $response = array("status" => "error", "message" => "Error on :  " . $ex->getMessage());
    }
    echo json_encode($response);
}else{
    exit("Invalid request");
}
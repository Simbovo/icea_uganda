<?php

require_once '../app/Loader.php';


foreach ($_POST as $key => $value) {
    $$key = $value;
}

use application\model\DbConnection;
use application\controller\Mailer;
use application\controller\employeeController;

$mailer = new Mailer();
$dbh = DbConnection::getInstance();
$empl = new employeeController();

$chekqry = "SELECT * FROM memberpass WHERE refno = :ref_no";

try {
    $stmt = $dbh->dbConn->prepare($QryStr);
    $stmt->execute(array('ref_no',$empcode));
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);


    if (count($result) >= 1) {
        echo "registered";
    } else {
        if ($user_type == "Administrator") {
            $user_level = 1;
        } else if ($user_type == "Front office" || $user_type=="Customer care" || $user_type == "Inquiry" )  {
            $user_level = 0;
        } else if ($user_type == "Audit") {
            $user_level = 0;
        } else if ($user_type == "System Administrator") {
            $user_level = 1;
        } else {
            $user_level = 0;
        }
        $reg_date = date('Y-M-d');

        $user_registration = $empl->registerWebAccess($empcode, $email, $username, $user_type, $reg_date, $user_level);

        if ($user_registration) {
            echo "success";
        } else {
            echo "error";
        }
    }
} catch (PDOException $ex) {
    echo $ex->getMessage();
}

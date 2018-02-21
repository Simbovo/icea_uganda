<?php

session_start();
require_once('../app/Loader.php');

use app\application\library\commonFunctions;
use application\model\DbConnection;
use application\controller\employeeController;
use application\controller\Mailer;
use application\library\Logger;

$mailer = new Mailer();
$logger = new Logger();

$user = new employeeController();
$lib = new commonFunctions();

foreach ($lib->cleanInputs($_POST) as $key => $value) {
    $$key = $value;
}
$uname = $_SESSION['username'];

list($data_id, $data_name) = explode("-", $branchid, 2);

//die(var_dump($_POST));


try {
    $conn = DbConnection::getInstance();
    $QryStr = "SELECT COUNT (*) FROM USERSETUP WHERE USER_ID = :empcode OR EMAIL = :emailAdd";
    $stmt = $conn->dbConn->prepare($QryStr);
    $stmt->bindParam(":empcode", $empcode);
    $stmt->bindParam(":emailAdd", $email);
    $stmt->execute();

    /* @var $result type bool */
    $result = $stmt->fetchColumn();
} catch (PDOException $e) {
    echo $e->getMessage();
}

if ($result == 1) {
    echo "Sorry, a user with the same details has already been registered in the system.";
} else {

    $create_date = date('d-M-y');

    $yearEnd = date('d-M-y', strtotime('Dec 31'));
    //echo $create_date;
    $result = $user->saveUser($empcode, $username, $surname, $userType, 1, 1, 1, 1, 1, 1, 0, $yearEnd, $create_date, $email, $uname, $data_id, $data_name);

    if ($result) {
        echo "success";
    } else {
        echo "failed";
    }
}








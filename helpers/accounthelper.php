<?php
/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 1/14/16
 * Time: 11:46 AM
 */

session_start();

require_once('../app/Loader.php');


$db = \app\application\model\DbConnection::getInstance();
$fnctn = new \app\application\library\commonFunctions();
$acct = new \app\application\controller\accountController();


$seccode = $fnctn->cleanInputs($_POST["add_type"]);
$agentno = $fnctn->cleanInputs($_SESSION["Branchcode"]);
$catname = $fnctn->cleanInputs($_POST["add_cat"]);
$memno = $fnctn->cleanInputs($_POST["memno"]);


if ($seccode == '002') {
    $modey = 1;
} else {
    $modey = 0;
}
$acctnumber = $agentno . '-' . $catname . '-' . $memno . '-' . $seccode;

$QryStr = "select * from accounts where account_no=:acctno";

try {
    $stmt = $db->dbConn->prepare($QryStr);
    $stmt->bindparam(":acctno", $acctnumber);
    $stmt->execute();

    $array = $stmt->fetch(PDO::FETCH_ASSOC);

    if (is_array($array)) {
        echo "account_exits";
    } else {
        $result = $acct->addUnitTrustAcct($memno, $catname, $acctnumber, $agentno, $seccode, $modey, $uname);

        if ($result) {
            echo "successful";
        } else {
            echo "failed";
        }
    }
} catch (PDOException $ex) {
    echo $ex->getMessage();
}
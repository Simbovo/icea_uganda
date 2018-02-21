<?php

require_once('../app/Loader.php');

use app\application\controller\accountController;
use application\model\DbConnection;

foreach ($_POST as $key => $value) {
    $$key = $value;
}
$dbConn = DbConnection::getInstance();
$acc = new accountController();

list($bank_code, $bank_name) = explode("-", $_POST['bank_name'], 2);



try {
    $QryStr = "select memberno, fullnames, accountname from membersbankdetails where accountno=:acc";
    $stmt = $dbConn->dbConn->prepare($QryStr);
    $stmt->bindParam(":acc", $acct_no);
    $stmt->execute();

    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!is_array($rows)) {

        //take care of user input
        $account_no = strip_tags($acct_no);
        $account_name = strip_tags($acc_name);

        //save the details to the database
        $save_account = $acc->registerAccount($mem_no, $bank_name, $bank_code, $full_name, $branch_name, $branch_code, $acc_type, $acc_name, $acct_no);

        if ($save_account) {
            echo "successful";
        } else {
            echo "failed";
        }
    } else {
        echo "Sorry the account number you are trying to register is registered to " . $result['fullnames'] . ". Please try again another account number!";
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}


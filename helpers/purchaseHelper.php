<?php

/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 9/30/15
 * Time: 4:23 PM
 */
include('../app/Loader.php');

//die(var_dump($_POST));
use app\application\controller\transactionController;

$purchase = new transactionController();

foreach ($_POST as $key => $value) {
    $$key = $value;
}
$branch_id = $_SESSION['branch_code'];
$branch_name = $_SESSION['branch_name'];;
$username = $_SESSION['username'];
$drawer_payee = $bank_details . '-' . strtoupper($town);


if ($purchase->checkIfFirstDeposit($acct_no) && ($amount < 1000)) {
    //if both are true
    echo "first_deposit";
    exit;
} else if ($amount < 2000) {
    //if false
    echo "less_amount";
    exit;
} else {
    if ($purchase->checkReferenceNo($reference)) {
        ///if true
        echo "ref_exists";
        exit;
    } else {
        $result = $purchase->doPurchase($mem_no, $name, $amount, $acct_no, $desc, $payment_mode, $username, $reference, $branch_id, $bank_code, $bank_details, $drawer_name, $drawer_payee);
        if ($result) {
            echo "transacted";
        } else {
            echo "failed";
        }
    }
}



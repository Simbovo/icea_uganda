<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
require_once '../app/Loader.php';

use app\application\controller\transactionController as trans;

$withdrawal = new trans();

//die(var_dump($_POST));
foreach ($_POST as $key => $value) {
    $$key = $value;
}

$amount = (float)preg_replace('/[^0-9\.]/ui', '', $amount);
$market_value = (float)preg_replace('/[^0-9\.]/ui', '', $acct_balance);


if ($market_value < $amount) {
    echo "less_balance";
    exit();
} else if ((int)$amount < 100) {
    echo "zero_amount";
    exit();
} else {
    $username = $_SESSION['username'];
    $doc_no = rand(1000, 10000);

    $save_trans = $withdrawal->withdrawFunds($member_no, $name, $acct_no, $amount, $desc, $payment_mode, $username, $doc_no, $bank_details);
    if ($save_trans) {
        echo "transacted";
        exit();
    } else {
        echo "failed";
        exit();
    }
}




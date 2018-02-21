<?php
/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 17/02/16
 * Time: 13:08
 */


session_start();

//require the autoload file.
require('../app/Loader.php');

//initialize the class to be used
use app\application\controller\transactionController;

$obj = new transactionController();

foreach ($_POST as $key => $value) {
    $$key = $value;
}

$reversed_trans = $obj->reversedTrans($report_type, $startDate, $endDate);

?>


<table class="table table-condensed table-responsive table-bordered" id="reversed_transactions">
    <thead>
    <tr>
        <th>TRANS ID</th>
        <th>Member No</th>
        <th>Full Names</th>
        <th>Reference ID</th>
        <th>Trans Date</th>
        <th>Fund Name</th>
        <th>Reason</th>
        <th style="text-align: right;"> Amount (Ksh)</th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <th colspan="7" style="text-align:right">Total:</th>
        <th></th>
    </tr>
    </tfoot>
    <tbody>
    <?php
    foreach ($reversed_trans as $transaction) {
        echo "<tr>";
        echo "<td >" . $transaction->TRANS_ID . "</td>";
        echo "<td >" . $transaction->MEMBER_NO . "</td>";
        echo "<td >" . $transaction->FULL_NAME . "</td>";
        echo "<td >" . $transaction->DOC_NO . "</td>";
        echo "<td >" . $transaction->TRANS_DATE . "</td>";
        echo "<td >" . $transaction->PORTFOLIO . "</td>";
        echo "<td >" . $transaction->CANCELREASON . "</td>";
        echo "<td >" . $transaction->AMOUNT . "</td>";
        echo "</tr>";
    }
    ?>

    </tbody>
</table>

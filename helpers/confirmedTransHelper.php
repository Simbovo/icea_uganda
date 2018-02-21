<?php
/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 17/02/16
 * Time: 12:23
 */

session_start();

//require the autoload file.
require('../app/Loader.php');

//initialize the class to be used
use app\application\controller\transactionController;
use application\library\Logger;

$obj = new transactionController();
$logger = new Logger();
foreach ($_POST as $key => $value) {
    $$key = $value;
}
$_SESSION['report_type'] = $report_type;
$_SESSION['startDate'] = $startDate;
$_SESSION['endDate'] = $endDate;

$confirmed_trans = $obj->confirmedTransactions($report_type, $startDate, $endDate);

$action =  "Viewed confirmed transactions";

$log = $logger->write_to_log($action);
?>


<table class="table table-condensed table-responsive table-bordered" id="confirmed_transactions">
    <thead>
    <tr>
        <th>Trans #</th>
        <th>Member No</th>
        <th>Full Names</th>
        <th>Trans Date</th>
        <th>Fund Name</th>
        <th style="text-align: right;"> Amount (Ksh)</th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <th colspan="5" style="text-align:right">Total:</th>
        <th></th>
    </tr>
    </tfoot>
    <tbody>
    <?php
    foreach ($confirmed_trans as $transaction) {
        echo "<tr>";
        echo "<td >" . $transaction->TRANS_ID . "</td>";
        echo "<td >" . $transaction->MEMBER_NO . "</td>";
        echo "<td >" . $transaction->FULL_NAME . "</td>";
        echo "<td >" . $transaction->TRANS_DATE . "</td>";
        echo "<td >" . $transaction->PORTFOLIO . "</td>";
        echo "<td >" . $transaction->AMOUNT . "</td>";
        echo "</tr>";
    }
    ?>

    </tbody>
</table>

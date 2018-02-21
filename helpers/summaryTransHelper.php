<?php
/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 17/02/16
 * Time: 14:33
 */

session_start();

require_once('../app/Loader.php');

//initialize the class to be used
use app\application\controller\transactionController;

$obj = new transactionController();

foreach ($_POST as $key => $value) {
    $$key = $value;
}

$summary = $obj->transSummary($startDate, $endDate);

?>

<table class="table table-condensed table-responsive table-bordered" id="summary_transactions">
    <thead>
    <tr>
        <th>Transaction Type</th>
        <th>Fund Name</th>
        <th style="text-align: right;"> Amount (Ksh)</th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <th colspan="6" style="text-align:right">Total:</th>
        <th></th>
    </tr>
    </tfoot>
    <tbody>
    <?php
    foreach ($summary as $transaction) {
        echo "<tr>";
        echo "<td >" . $transaction->TRANS_TYPE . "</td>";
        echo "<td >" . $transaction->PORTFOLIO . "</td>";
        echo "<td >" . $transaction->AMOUNT . "</td>";
        echo "</tr>";
    }
    ?>

    </tbody>
</table>





<?php
/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 10/19/15
 * Time: 9:25 AM
 */

//get the required class
session_start();

//require the autoload file.
require('../app/Loader.php');

//initialize the class to be used
use app\application\controller\transactionController;

$obj = new transactionController();

foreach ($_POST as $key => $value) {
    $$key = $value;
}
if ($startDate == "") {
    $startDate = date('d/m/Y');
}
if ($endDate == "") {
    $endDate = date('d/m/Y');
}
$trans = $obj->transReport($report_type,$startDate, $endDate);
die(var_dump($trans));
?>
<table class="table table-condensed table-responsive table-bordered" id="members">
    <thead>
    <tr>
        <th>TRANS ID</th>
        <th>Member No</th>
        <th>Full Names</th>
        <th>Reference ID</th>
        <th>Trans Date</th>
        <th>Fund Name</th>
        <th>reason</th>
        <th>Amount (Ksh)</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($trans as $members) {
        echo "<tr>";
        echo "<td >" . $members->trans_id . "</td>";
        echo "<td >" . $members->member_no . "</td>";
        echo "<td >" . $members->allnames . "</td>";
        echo "<td >" . $members->doc_no . "</td>";
        echo "<td >" . $members->trans_date . "</td>";
        echo "<td >" . $members->fund_name . "</td>";
        echo "<td >" . $members->reason . "</td>";
        echo "<td >" . $members->amount . "</td>";
        echo "</tr>";
    }
    ?>

    </tbody>
</table>
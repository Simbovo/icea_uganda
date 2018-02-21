<?php

session_start();
require('../app/Loader.php');
use application\controller\memberController;
use application\library\Logger;

$method = new memberController();
$logger = new Logger();
foreach ($_POST as $key => $value) {
    $$key = $value;
}
$_SESSION['report_type'] = $report_type;
$_SESSION['startDate'] = $startDate;
$_SESSION['endDate'] = $endDate;
$data = $method->membersByFund(strval($report_type), $startDate, $endDate);

$action =  "Viewed members by fund report";
$log = $logger->write_to_log($action);

?>


<table class="table table-condensed table-responsive table-bordered" id="members">
    <thead>
    <tr>
        <th>Member No</th>
        <th>Full Name</th>
        <th>ID NO</th>
        <th>PIN NO</th>
        <th>REG_DATE</th>

        <th>DOB</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($data as $members) {
        echo "<tr>";
        echo "<td >" . $members->MEMBER_NO . "</td>";
        echo "<td >" . $members->ALLNAMES . "</td>";
        echo "<td >" . $members->ID_NO . "</td>";
        echo "<td >" . $members->PIN_NO . "</td>";
        echo "<td >" . $members->REG_DATE . "</td>";
        //echo "<td >" . $members->GSM_NO . "</td>";
        echo "<td >" . $members->DOB . "</td>";
        echo "</tr>";
    }
    ?>

    </tbody>
</table>
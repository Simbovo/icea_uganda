<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


require_once ('../app/Loader.php');

//initialize the class to be used
use app\application\controller\transactionController;

$obj = new transactionController();

foreach ($_POST as $key => $value) {
    $$key = $value;
}
$_SESSION['report_type'] = $report_type;
$_SESSION['startDate'] = $startDate;
$_SESSION['endDate'] = $endDate;

$revenues = $obj->revenueReport($startDate, $endDate);

?>
<table class="table table-condensed table-responsive table-bordered" id="revenue">
    <thead>
        <tr>
            <th>Branch</th>
            <th>Portfolio</th>
            <th>Trans Date</th>
            <th style="text-align: right;">Admin Fee (Ksh)</th>
            
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th colspan="3" style="text-align:right">Total:</th>
            <th></th>
        </tr>
    </tfoot>
    <tbody>
        <?php
        foreach ($revenues as $revenue) {
            echo "<tr>";
            echo "<td >" . $revenue->BANKACCDETS . "</td>";            
            echo "<td >" . $revenue->DESCRIPT . "</td>";
            echo "<td >" . $revenue->TRANS_DATE . "</td>";
            echo "<td >" . $revenue->ADMFEE . "</td>";
            echo "</tr>";
        }
        ?>

    </tbody>
</table>
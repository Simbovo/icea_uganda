<?php
/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 9/23/15
 * Time: 10:45 AM
 */

require('../app/Loader.php');
use application\controller\memberController;

$method = new memberController();

foreach ($_POST as $key => $value) {
    $$key = $value;
}

if ($startDate == "") {
    $startDate = date('d/m/Y');
}
if ($endDate == "") {
    $endDate = date('d/m/Y');

}

$data = $method->memberReport($report_type, $startDate, $endDate);

//die(var_dump($_POST));

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
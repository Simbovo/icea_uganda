<?php


require('../app/Loader.php');

session_start();
use application\controller\companyController;

$impl = new companyController();

$branches = $impl->viewBranches();


?>

<table class="table table-stripped table-hover table-condensed" id="branches">
    <thead>
    <tr class="info">
        <th>Branch Code</th>
        <th>Branch Name</th>
        <th>Town</th>
        <th>Contact Name</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($branches as $branch) {
        echo "<tr>";
        echo "<td >" . $branch->BRANCHID . "</td>";
        echo "<td >" . $branch->BRANCHNAME . "</td>";
        echo "<td >" . $branch->TOWN . "</td>";
        echo "<td >" . $branch->CONTACTNAME . "</td>";
        echo "<td ><a href=#editbranch?ref_id=" . $branch->BRANCHID . " id=" . $branch->BRANCH . " class='btnuser' ><i class='fa-fa-edit'></i>&nbsp;Edit</a></td>";
        echo "</tr>";
    }

    ?>
    </tbody>
</table>
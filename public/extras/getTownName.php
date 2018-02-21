<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require('../../app/Loader.php');

use application\controller\dataController;

$branch = new dataController();

//$data = json_decode($_POST['bank']);
foreach ($_POST as $key => $value) {
    $$key = $value;
}

$towns = $branch->findTownName($country);



?>
<div class="form-group">
    <label class="control-label" for="branch">Town:</label>
    <select name="town" class="form-control" id="town" required="required">
        <option value="">--- Please Select Town ---</option>
        <?php
        foreach ($towns as $town) {

            echo "<option value='" . $town->tname . "'>" . $town->tname . "</option>";
        }
        ?>
    </select>
</div>

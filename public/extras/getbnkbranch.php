<?php

require('../../app/Loader.php');

use application\controller\dataController;

$branch = new dataController();
//receive data 
foreach ($_POST as $key => $value) {
    $$key = $value;
}

list($data_id, $data_name) = explode("-", $bank_name, 2);

$branch_names = $branch->getBankBranches($data_id);
?>
<label class="control-label" for="branch">Bank Branch</label>

    <select name="branch" class="form-control" id="branch">
        <option value="">--- Please Select Branch ---</option>
        <?php
        foreach ($branch_names as $branch) {

            echo "<option value='" . $branch->bank_code . "'>" . strtoupper($branch->branch_name) . "</option>";
        }
        ?>
    </select>


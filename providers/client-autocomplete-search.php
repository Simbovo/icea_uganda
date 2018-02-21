<?php

require('../app/Loader.php');

use app\application\library\commonFunctions;
use application\controller\memberController;

$mem = new memberController();
$lib = new commonFunctions();

$keyword = $lib->cleanInputs($_POST['keyword']);

$data = $mem->AutoComplete($keyword);

?>
<div class="box body with-border">
    <table class="table table-responsive table-hover table-stripped" id="group_members">
        <thead>
        <tr>

            <th>MEMBER NO:</th>
            <th>NAME:</th>
            <th>ACCOUNT NUMBER:</th>
            <th>MEMBER TYPE:</th>
            <th>FUND:</th>
            <th>BRANCH NAME:</th>

        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($data as $row) {
            ?>
            <tr>
                <td><?php echo $row->member_no; ?></td>
                <td>
                    <a href="individual-account?id=<?=$lib->encryptStringArray($row->member_no,'7800'); ?>"><?php echo $row->allnames; ?></a>
                </td>
                <td><?php echo $row->account_no; ?></td>
                <td><?php echo $row->hse_no; ?></td>
                <td><?php echo $row->descript; ?></td>
                <td><?php echo $row->agent_name; ?></td>
            </tr>
        <?php
        }
        ?>

        </tbody>
    </table>
</div>

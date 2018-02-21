<?php



require_once('../app/Loader.php');


use application\controller\memberController;
use app\application\library\commonFunctions as Lib;
session_start();

$mem = new memberController();
$lib =  new Lib();

$data = $mem->JointRegisteredMembers();

?>
<div class="box body with-border">
    <table class="table table-responsive table-hover table-stripped" id="joint_members">
        <thead>
            <tr>

                <th>Member No:</th>
                <th>Full names:</th>
                <th>REG DATE:</th>    
                <th>PHONE NO:</th>

            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($data as $row) {
                ?>
                <tr>
                    <td><?php echo $row->member_no; ?></td>
                    <td>
                        <a href="individual-account?id=<?= $lib->encryptStringArray($row->member_no, '7800'); ?>"><?php echo $row->allnames; ?></a>
                    </td>
                    <td><?php echo date('d-m-Y', strtotime($row->reg_date)); ?></td>
                    <td><?php echo $row->gsm_no; ?></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>
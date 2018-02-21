<?php
/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 10/26/15
 * Time: 2:54 PM
 */

require('../app/Loader.php');

use application\controller\memberController;

$user = new memberController();


if (isset($_GET['ref_id'])) {
    $ref_id = $_GET['ref_id'];

    $details = $user->getOnlineUserById($ref_id);

    ?>
    <div class="row">
        <div class="col-sm-12">
            <!--        <div class="box box-header"><h4>User Details</h4></div>-->
            <div class="box-body">
                <div class="col-sm-4>">

                    <div class="col-xs-6"><label class="form-horizontal">Username :</label></div>
                    <div class="col-xs-6">
                        <input type="text" name="username_"  id="username_" class="form-control col-sm-2"
                               value="<?= $details->username; ?>" readonly/>
                    </div>
                </div>
                <div class="col-sm-4>">
                    <div class="col-xs-6">
                        <label class="control-label">User Category:</label>
                    </div>
                    <div class="col-xs-6">
                       <input type="text" name="user_type" class="form-control col-sm-2"
                               value="<?= $details->category; ?>" readonly/>
                    </div>


                </div>
                <div class="col-sm-4>">
                    <div class="col-xs-6">
                        <label class="form-horizontal">Email Address:</label>
                    </div>
                    <div class="col-xs-6">
                        <input type="text" name="email" class="form-control col-sm-2" value="<?= $details->e_mail; ?>"
                               readonly/>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <?php


} else {

}
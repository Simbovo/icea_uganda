<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


require('../app/Loader.php');

use application\controller\employeeController;
use app\application\library\commonFunctions;

$user = new employeeController();
$lib = new commonFunctions();


if (isset($_GET['token'])) {
    $empcode = $lib->cleanInputs($_GET['token']);

    $details = $user->OnlineAccess($empcode);
    ?>
    <div class="row">
        <div class="col-sm-12">

            <div class="box-header"><h4 class="text-center"> <?= strtoupper($details->fullnames); ?></h4></div>
            <div class="box-body">

                <div class="col-sm-4>">
                    <div class="col-xs-6">
                        <label class="control-label">Employment Date:</label>
                    </div>
                    <div class="col-xs-6">
                        <input type="hidden" name="empcode" id="empcode" value="<?= $details->empcode; ?>"/>
                        <input type="hidden" name="full_name" id="full_name" value="<?= $details->fullnames; ?>"/>
                        <input type="hidden" name="user_type" id="user_type" value="<?= $details->user_type; ?>"/>
                        
                        <input type="text" class="form-control col-sm-2" value="<?= $details->demployed; ?>"
                               readonly/>
                       
                    </div
                </div>
                <div class="col-sm-4>">
                    <div class="col-xs-6">
                        <label class="form-horizontal">Email Address:</label>
                    </div>
                    <div class="col-xs-6">
                        <input type="text"  name="email" id="email" class="form-control col-sm-2" value="<?= $details->email; ?>"
                               readonly/>
                    </div>

                </div>
                <div class="col-sm-4>">
                    <div class="col-xs-6">
                        <label class="form-horizontal">User Name:</label>
                    </div>
                    <div class="col-xs-6">
                        <input type="text"  name="username" id="username" class="form-control col-sm-2" value="<?= $details->username; ?>"
                               readonly/>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <?php
}

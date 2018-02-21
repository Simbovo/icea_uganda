<?php
/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 11/10/15
 * Time: 12:41 PM
 */
session_start();
require_once('header.php');

use app\application\controller\agentController;

$agentObj = new agentController();
$agent_no = $_SESSION['ref_no'];
$data = $agentObj->agentDetails($agent_no);

//list($postal_add,$postal_code,)
//die(var_dump($data));

$reg_date = $data->regdate;
$mydate = strtotime($reg_date);
$date = date('Y-m-d', $mydate);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= $data->agent_name ?>

        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i>Home</a></li>

            <li class="active">Profile</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="row">
            <div class="box box-primary">

                <div class="box body with-border">

                    <div class="col-sm-12">
                        <div class="box box-warning">
                            <div class="box-header">
                                <h3 class="box-title">PERSONAL INFORMATION</h3>

                            </div>
                            <div class="row-fluid">
                                <div class="col-xs-12 col-md-3">
                                    <div class="row-fluid">
                                        <div class="col-xs-12" style="text-align: center;">
                                            <img id="profile_image__id_" src="../assets/images/image_profile.png"
                                                 class="img-polaroid" style="max-width: 140px;max-height: 140px;">
                                        </div>

                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-9">
                                    <div class="row-fluid">
                                        <!--    <div class="col-xs-12" style="font-size:18px;border-bottom: 1px solid #DDD;margin-bottom: 10px;padding-bottom: 10px;">
                                                <span id="name"></span><br/>
                                                <button id="employeeProfileEditInfo" class="btn btn-inverse btn-xs" onclick="modJs.editEmployee();" style="margin-right:10px;">Edit Info</button>
                                                <button id="employeeUploadProfileImage" onclick="showUploadDialog('profile_image__id_','Upload Profile Image','profile_image',_id_,'profile_image__id_','src','url','image');return false;" class="btn btn-xs btn-inverse" type="button" style="margin-right:10px;">Upload Profile Image</button>
                                                <button id="employeeDeleteProfileImage" onclick="modJs.deleteProfileImage(_id_);return false;" class="btn btn-xs btn-inverse" type="button">Delete Profile Image</button>
                                                <button id="employeeUpdatePassword" onclick="modJs.changePassword();return false;" class="btn btn-xs btn-inverse" type="button">Change Password</button>
                                            </div>
                                        </div>-->

                                        <div class="row-fluid" style="border-top: 1px;">
                                            <div class="col-xs-6 col-md-4" style="font-size:16px;">
                                                <label class="control-label col-xs-12"
                                                       style="font-size:13px;font-size:13px;">Agent Name</label>
                                                <label class="control-label col-xs-12 iceLabel" style="font-size:13px;"
                                                       id="employee_id"><?= $data->agent_name; ?></label>
                                            </div>
                                            <div class="col-xs-6 col-md-3" style="font-size:16px;">
                                                <label class="control-label col-xs-12" style="font-size:13px;">
                                                    National ID No</label>
                                                <label class="control-label col-xs-12 iceLabel"
                                                       style="font-size:13px;font-weight: bold;"
                                                       id="driving_license"><?= $data->id_no; ?></label>
                                            </div>
                                            <div class="col-xs-6 col-md-3" style="font-size:16px;">
                                                <label class="control-label col-xs-12"
                                                       style="font-size:13px;">Gender</label>
                                                <label class="control-label col-xs-12 iceLabel"
                                                       style="font-size:13px;font-weight: bold;"
                                                       id="gender"><?= $data->gender?></label>
                                            </div>
                                            <div class="col-xs-6 col-md-3" style="font-size:16px;">
                                                <label class="control-label col-xs-12"
                                                       style="font-size:13px;">Registration Date</label>
                                                <label class="control-label col-xs-12 iceLabel"
                                                       style="font-size:13px;font-weight: bold;"
                                                       id="gender"><?= $mydate; ?></label>
                                            </div>
                                        </div>

                                        <div class="row-fluid">

                                            <div class="col-xs-6 col-md-3" style="font-size:16px;">
                                                <label class="control-label col-xs-12"
                                                       style="font-size:13px;">Country</label>
                                                <label class="control-label col-xs-12 iceLabel"
                                                       style="font-size:13px;font-weight: bold;"
                                                       id="nationality_Name"><?= $data->country; ?></label>
                                            </div>
                                            <div class="col-xs-6 col-md-3" style="font-size:16px;">
                                                <label class="control-label col-xs-12" style="font-size:13px;">Marital
                                                    Status</label>
                                                <label class="control-label col-xs-12 iceLabel"
                                                       style="font-size:13px;font-weight: bold;"
                                                       id="marital_status"><?= $data->marital_status;?></label>
                                            </div>
                                            <div class="col-xs-6 col-md-3" style="font-size:16px;">
                                                <label class="control-label col-xs-12" style="font-size:13px;">Registration
                                                    Date</label>
                                                <label class="control-label col-xs-12 iceLabel"
                                                       style="font-size:13px;font-weight: bold;"
                                                       id="joined_date"><?= $data->reg_date; ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row-fluid" style="margin-left:10px;">
                                    <div class="col-xs-12">
                                        <hr/>
                                        <span class="label label-inverse"
                                              style="font-size:16px;background: #405A6A;">Contact Information</span><br/><br/>

                                        <div class="row-fluid">
                                            <table class="table table-condensed table-bordered">
                                                <tr class="warning">
                                                    <th>Postal Address:</th>
                                                    <th>Phone Number:</th>
                                                    <th>Email Address:</th>
                                                    <th>Town:</th>
                                                    <th>Country:</th>
                                                </tr>
                                                <tbody>
                                                    <tr>
                                                        <td><?php echo $data->post_address; ?></td>
                                                        <td><?php echo $data->gsm_no; ?></td>
                                                        <td><?php echo $data->e_mail; ?></td>
                                                        <td><?php echo $data->town; ?></td>
                                                        <td><?php echo $data->country; ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>


                                    </div>
                                </div>
                                <div class="box body table-responsive no-padding">

                                    <div class="row-fluid" style="margin-left:10px;margin-top:20px;">
                                        <div class="col-xs-12">

                                            <span class="label label-inverse"
                                                  style="font-size:16px;background: #405A6A;">Bank Information</span><br/><br/>

                                            <table class="table table-condensed table-bordered">
                                                <tr class="warning">
                                                    <th>Bank Name:</th>
                                                    <th>Branch:</th>
                                                    <th>Account No:</th>
                                                    <th>Acc Type:</th>
                                                    <th>Town:</th>

                                                </tr>
                                                <tbody>
                                                    <tr>
                                                        <td><?php echo $data->bankdesc; ?></td>
                                                        <td><?php echo $data->banklocation; ?></td>
                                                        <td><?php echo $data->accountno; ?></td>
                                                        <td><?php echo $data->acctype; ?></td>
                                                        <td><?php echo $data->town; ?></td>

                                                    </tr>
                                                </tbody>


                                            </table>
                                            <hr/>

                                        </div>
                                    </div>

                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </section>
</div>

<!-- /.content -->
<!-- /.content-wrapper -->

<footer class="main-footer">
  <?php include('extras/footnote.php');?>
</footer>

<!-- Control Sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class='control-sidebar-bg'></div>
</div><!-- ./wrapper -->

<!-- jQuery 2.1.4 -->
<script src="../assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="../assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!-- SlimScroll -->
<script src="../assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<!-- FastClick -->
<script src='../assets/plugins/fastclick/fastclick.min.js'></script>
<!-- AdminLTE App -->
<script src="../assets/dist/js/app.min.js" type="text/javascript"></script>
<!--Data Table js-->
<script src="../assets/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="../assets/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
<!-- Demo -->
<!--<script src="../assets/dist/js/demo.js" type="text/javascript"></script>-->
</body>
</html>
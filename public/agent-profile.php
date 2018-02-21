<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include('header.php');

use app\application\controller\agentController;

$agent_obj = new agentController();

$details = $agent_obj->agentDetails();
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Agent Profile
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-home"></i> Home</a></li>

            <li class="active">Agent Profile</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="../assets/dist/img/avatar.png"
                             alt="User profile picture">

                        <h3 class="profile-username text-center"><?= $details->agent_name; ?></h3>

                        <p class="text-muted text-center"><?= $details->agent_category ?></p>
                        <a href="#" class="btn btn-lg btn-success"
                           data-toggle="modal"
                           data-target="#upload_modal">Upload a profile photo</a>

                        <ul class="list-group list-group-unbordered">
                            <!--  <li class="list-group-item">
                                  <b>Clients</b> <a class="pull-right">1,322</a>
                              </li>
                              <li class="list-group-item">
                                  <b>Agent Since</b> <a class="pull-right">543</a>
                              </li>
                              <li class="list-group-item">
                                  <b>Email Address</b> <a class="pull-right">13,287</a>
                              </li>
                          </ul>

                          <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
                          -->
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->


            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#activity" data-toggle="tab">Personal Information</a></li>
                        <li><a href="#timeline" data-toggle="tab">Contact Details</a></li>
                        <li><a href="#bank_details" data-toggle="tab">Bank Details</a></li>
                        <!--<li><a href="#settings" data-toggle="tab">Settings</a></li> -->
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Personal Basic Information</h3>
                                </div>
                                <div class="box-body">

                                    <table class="table table-condensed table-bordered">
                                        <tr class="info">
                                            <th>Name:</th>
                                            <th>ID Number:</th>
                                            <th>PIN NO:</th>
                                            <th>GENDER:</th>
                                        </tr>
                                        <tbody>
                                        <tr>
                                            <td><?php echo $details->agent_name; ?></td>
                                            <td><?php echo $details->id_no; ?></td>
                                            <td><?php echo $details->pin_no; ?></td>
                                            <td><?php echo $details->gender; ?></td>

                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="timeline">
                            <!-- The timeline -->

                            <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Contact Information</h3>
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <table class="table table-condensed table-bordered">
                                            <tr class="info">
                                                <th>Postal Address:</th>
                                                <th>Phone Number:</th>
                                                <th>Email Address:</th>
                                                <th>Town:</th>
                                            </tr>
                                            <tbody>
                                            <tr>
                                                <td><?php echo $details->post_address; ?></td>
                                                <td><?php echo $details->gsm_no; ?></td>
                                                <td><?php echo $details->e_mail; ?></td>
                                                <td><?php echo $details->town; ?></td>


                                            </tr>
                                            </tbody>
                                            <tr class="info">
                                                <th>TEL NO:</th>
                                                <th>Physical Address:</th>
                                                <th>Agent Type:</th>
                                                <th>:</th>
                                            </tr>
                                            <tbody>
                                            <tr>
                                                <td><?php echo $details->gsm_no; ?></td>
                                                <td><?php echo $details->phys_address; ?></td>
                                                <td><?php echo $details->catname; ?></td>
                                                <td><?php echo $terms; ?></td>
                                            </tr>

                                        </table>


                                    </div>

                                </div>

                            </div>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="bank_details">

                            <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Bank Information</h3>
                                </div>
                                <div class="box-body">
                                    <div class="row">

                                        <table class="table table-condensed table-bordered">
                                            <tr class="info">
                                                <th>Bank Name:</th>
                                                <th>Branch:</th>
                                                <th>Account Name:</th>

                                            </tr>
                                            <tbody>
                                            <tr>
                                                <td><?php echo $details->bankname; ?></td>
                                                <td><?php echo $details->banklocation; ?></td>
                                                <td><?php echo $details->agent_name; ?></td>


                                            </tr>
                                            </tbody>
                                            <tr class="info">
                                                <th>Account Number:</th>
                                                <th>Account Type:</th>
                                                <th>Town:</th>

                                            </tr>
                                            <tbody>
                                            <tr>
                                                <td><?php echo $details->accountno; ?></td>
                                                <td><?php echo $details->acc_type; ?></td>
                                                <td><?php echo $details->banktown; ?></td>
                                            </tr>

                                        </table>


                                    </div>

                                </div>

                            </div>
                        </div>

                        <div class="tab-pane" id="settings">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="inputName" placeholder="Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputName" placeholder="Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputExperience" class="col-sm-2 control-label">Experience</label>

                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="inputExperience"
                                                  placeholder="Experience"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputSkills" class="col-sm-2 control-label">Skills</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"> I agree to the <a href="#">terms and
                                                    conditions</a>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-danger">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
    </section>
</div>
<footer class="main-footer">
    <?php include('extras/footnote.php'); ?>
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
<!-- Demo -->
<script src="../assets/dist/js/demo.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#upload").submit(function () {
            $(".waiting").slideDown();
            $("#submit").attr('disabled', true);
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: "../helpers/agent-profile-upload",
                type: "POST",
                data: formData,
                async: false,
                error: function (error) {
                    console.log(error);
                },
                success: function (response) {
                    $("#save").attr('disabled', false);
                    $(".waiting").slideUp();
                    var data = JSON.parse(response);

                    if (data.status == "uploaded") {
                        $(".alert").attr('alert alert-success');
                        $(".alert").slideDown();
                        $(".alert").html('<strong>' + data.message + '</strong>');
                        setTimeout(function () {
                            window.location.href = data.url;
                        }, 5000);
                    } else {
                        $(".alert").attr('alert alert-info');
                        $(".alert").slideDown();
                        $(".alert").html('<strong>' + data.message + '</strong>');
                        setTimeout(function () {
                            window.location.href = data.url;
                        }, 5000);
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });
            return false;
        });
    });
</script>
<div class="modal fade" id="upload_modal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&amp;times;</button>
                <h4 class="modal-title" id="myModalLabel">Photo upload</h4>
            </div>
            <form name="upload" id="upload" method="post" action="">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="file" name="avatar"/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
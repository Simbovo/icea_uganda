<?php


require('../app/Loader.php');
include("header.php");
use application\controller\memberController;
use app\application\library\commonFunctions;


$data = new memberController();
$url_encrypt = new commonFunctions();

$members = $data->SingleRegisteredMembers();
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Registered Members

        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="registered-members"><i class="fa fa-users"></i>Registered Members</a></li>

            <li class="active">Member Registration</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <div class="form-group pull-right">
                            <div class="dropdown">
                                <button class="btn btn-info dropdown-toggle" type="button"
                                        data-toggle="dropdown"><i class="glyphicon glyphicon-plus-sign"></i>
                                    Add a new member
                                    <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="client-registration">Single Member</a></li>
                                    <li class="divider"></li>
                                    <li><a href="joint-registration">Joint Member</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li><a href="group-registration">Group Member</a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                    <div class="box-body">
                        <div class="container" style="width: 100%">
                            <div class="col-sm-12">
                                <ul class="nav nav-pills">

                                    <li class="active"><a data-toggle="tab" href="#sectionA">Single Registered
                                            Members</a></li>

                                    <li><a data-toggle="tab" href="#sectionB" id="joint">Joint Registered
                                            Members</a>
                                    </li>
                                    <li><a data-toggle="tab" href="#sectionC" id="group">Group/Institutional
                                            Registered
                                            Members</a>
                                    </li>
                                </ul>
                                <div class="tab-content" style="width:100%;">

                                    <div id="sectionA" class="tab-pane fade in active">
                                        <div class="box body with-border">
                                            <table class="table table-responsive table-hover table-stripped"
                                                   id="singlemembers">
                                                <thead>
                                                <tr>

                                                    <th>Member No:</th>
                                                    <th>Full names:</th>
                                                    <th>REG DATE:</th>
                                                    <th>D.O.B:</th>
                                                    <th>ID NO:</th>
                                                    <th>PHONE NUMBER:</th>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                foreach ($members as $row) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $row->member_no; ?></td>
                                                        <td>
                                                            <a href="individual-account?id=<?= $url_encrypt->encryptStringArray($row->member_no, '7800'); ?>"><?php echo $row->allnames; ?></a>
                                                        </td>
                                                        <td><?php echo date('d-m-Y', strtotime($row->reg_date)); ?></td>
                                                        <td><?php echo date('d-m-Y', strtotime($row->dob)); ?></td>
                                                        <td><?php echo $row->id_no; ?></td>
                                                        <td><?php echo $row->gsm_no; ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>

                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                    <div id="sectionB" class="tab-pane fade in">
                                        <div id="loading">

                                        </div>
                                    </div>
                                    <div id="sectionC" class="tab-pane fade in">
                                        <div id="loading">

                                        </div>
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
    <?php
    include('extras/footnote.php');
    ?>
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

<script type="text/javascript">
    $(function () {
        $("#singlemembers").dataTable({
            paging: true,
            lengthChange: true,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: false,
            pagingType: 'full_numbers'
        });
    })

    $(document).ready(function () {
        $("#joint").click(function () {
            $("#loading").slideDown();
            $("#loading").html("<div class='alert alert-info'><center><img src='../assets/images/loading.gif'> Loading ...</center></div>");
            $.ajax({
                type: 'POST',
                url: "../providers/joint-members",
                data: $("#add_booking").serialize(),
                success: function (response) {
                    $("#loading").slideUp();
                    $("#sectionB").html(response);
                    $("#joint_members").dataTable({
                        paging: true,
                        lengthChange: true,
                        searching: true,
                        ordering: true,
                        info: true,
                        autoWidth: false,
                        pagingType: 'full_numbers'
                    });
                }
            })
        });
        $("#group").click(function () {
            $("#loading").slideDown();
            $("#loading").html("<div class='alert alert-info'><center><img src='../assets/images/loading.gif'> Loading ...</center></div>");
            $.ajax({
                type: 'POST',
                url: "../providers/institutional-members",
                data: $("#add_booking").serialize(),
                success: function (response) {
                    $("#loading").slideUp();
                    $("#sectionC").html(response);
                    $("#group_members").dataTable(
                        {
                            paging: true,
                            lengthChange: true,
                            searching: true,
                            ordering: true,
                            info: true,
                            autoWidth: false,
                            pagingType: 'full_numbers'
                        });
                }
            })
        });
    });
</script>
</body>
</html>
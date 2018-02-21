<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

use app\application\library\commonFunctions;

require 'header.php';

$emplobj = new \application\controller\employeeController();

$employees = $emplobj->employeeDetails();
$lib = new commonFunctions();
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Staff Information

        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>

            <li class="active">Staff Information</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="row">
            <div class="col-sm-12">
                <div class="box">
                    <div class="box-header with-border">

                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">CONFIRMED STAFF</h3>


                                <button class="btn btn-large btn-primary pull-right" data-toggle="modal"
                                        data-target="#registerEmployeeModal">
                                    <i class="fa fa-plus"></i> Register New
                                    Staff
                                </button>

                            </div>
                            <!-- /.box-header -->

                            <div class="box body no-padding box-warning">
                                <div class="dataTables_wrapper table-responsive">
                                    <table class="table table-hover table-bordered table-condensed" id="onlineusers">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>ID Number</th>
                                            <th>PFNO</th>
                                            <th>Mobile Number</th>
                                            <th>Email</th>
                                            <th>Department</th>
                                            <th>Edit Details</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        foreach ($employees as $employee) {
                                            echo "<tr>";
                                            echo "<td>" . $employee->fullnames . "</td>";
                                            echo "<td>" . $employee->idno . "</td>";
                                            echo "<td>" . $employee->pdfno . "</td>";
                                            echo "<td>" . $employee->htel . "</td>";
                                            echo "<td>" . $employee->email . "</td>";
                                            echo "<td>" . $employee->deptcode . "</td>";

                                            echo "<td >
                                            <a href=edit-staff-details?ref_id=" . $lib->encryptStringArray($employee->user_id, 'equity1290') . " id=" . $employee->user_id . "><i class='fa fa-edit'></i> Edit Details</a></td>";
                                            echo "</tr>";
                                        }
                                        ?>

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
    </section>
    <!-- /.box-footer-->
</div>
<!-- /.box -->


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

</div>
<!-- jQuery 2.1.4 -->
<script src="../assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="../assets/dist/js/modernizr-jquery.min.js"></script>

<!-- Bootstrap 3.3.2 JS -->
<script src="../assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!-- SlimScroll -->
<script src="../assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<!-- Bootstrap Datepicker js-->
<script src="../assets/plugins/datepicker/bootstrap-datepicker.js"></script>

<!-- FastClick -->
<!--Bootstrap validator-->
<script src="../assets/bootstrap/js/validator.min.js"></script>
<!--Jquery UI Validator-->
<script src="../assets/bootstrap/js/jquery.validate.min.js"></script>
<script src='../assets/plugins/fastclick/fastclick.min.js'></script>
<!--Initialize datepicker-->
<script src="../assets/dist/js/date.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="../assets/dist/js/app.min.js" type="text/javascript"></script>

<!-- Demo -->
<script src="../assets/dist/js/demo.js" type="text/javascript"></script>

<!--Datatables plugins-->
<script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/plugins/datatables/dataTables.bootstrap.min.js"></script>

<script>
    $(document).ready(function () {
        $("#EmployeeRegForm").submit(function () {
            $("#waiting").slideDown();
            $.ajax({
                type: 'POST',
                url: '../helpers/employeeReg',
                data: $("#EmployeeRegForm").serialize(),
                error: function (error) {
                    console.log(error);
                },
                success: function (response) {
                    data = JSON.parse(response);
                    $("#waiting").slideUp();
                    if (data.Status === "failed") {
                        $(".alert").attr("class", "alert alert-info");
                        $(".alert").slideDown();
                        $(".alert").html("<strong>Error!</strong> " + data.Message);
                    } else if (data.Status === "success") {
                        $(".alert").attr("class", "alert alert-success");
                        $(".alert").slideDown();
                        $(".alert").html("<strong>Success!</strong> " + data.Message);
                        setTimeout(function () {
                            window.location.href = data.Location;
                        }, 2000);
                    } else if (data.Status === "registered") {
                        $(".alert").attr("class", "alert alert-info");
                        $(".alert").slideDown();
                        $(".alert").html("<strong>Error!</strong> " + data.Message);
                    } else {
                        $(".alert").attr("class", "alert alert-danger");
                        $(".alert").slideDown();
                        $(".alert").html("<strong>There is a technical error, Please contact administrator!</strong> ");
                    }
                    //console.log(response);
                }
            });
            return false;
        });
    });
</script>
<script type="application/javascript">

</script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".modal").on("hidden.bs.modal", function () {
            $("#user_details").html("");
        });
        $('.btnonline').click(function () {
            $("#onlineaccess").modal({
                backdrop: true,
                keyboard: true
            });
            var ref_id = $(this).attr('id');
            $.ajax({
                type: 'GET',
                url: '../helpers/system-staff?token=' + ref_id,
                error: function (error) {
                    console.log(error);
                },
                success: function (data) {
                    $("#user_details").append(data);
                }
            });

            $("#staff-confirm").submit(function () {
                $("#waiting").slideDown();


                $.ajax({
                    type: 'POST',
                    url: '../helpers/online-access',
                    data: $("#staff-confirm").serialize(),
                    error: function (error) {
                        console.log(error);
                    },
                    success: function (response) {
                        $("#waiting").slideUp();
                        if (response == "failed") {
                            $(".alert").attr("class", "alert alert-danger");
                            $(".alert").slideDown();
                            $(".alert").html("<strong>Sorry, The request ended with an error. Please double check that the details are correct.!</strong>");
                            //window.location.href = "register_client.php";
                        } else if (response == "true") {
                            $(".alert").attr("class", "alert alert-success");
                            $(".alert").slideDown();
                            $(".alert").html("<strong>User confirmation successful.!</strong>");
                            setTimeout(function () {
                                window.location.href = "confirmed-staff";
                            }, 2000);
                        } else {
                            console.log(response);

                        }

                    }
                });
                return false;

            });
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $("#onlineusers").DataTable({
            responsive: true,
            "bProcessing": true,
            "bPaginate": true,
            "sScrollY": "310px",
            "bRetrieve": true,
            "bFilter": true,
            "bAutoWidth": false,
            "bInfo": true,
            "fnPreDrawCallback": function () {
                $("#details").hide();
                $("#loading").show();
                //alert("Pre Draw");
            },
            "fnDrawCallback": function () {
                $("#details").show();
                $("#loading").hide();
                //alert("Draw");
            },
            "fnInitComplete": function () {
                //alert("Complete");
            }

        });
    });
</script>


<div id="onlineaccess" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 id="myModalLabel">Confirm Staff</h3>
            </div>
            <div class="modal-body">

                <div class="modal-body">
                    <div id="waiting" style="display: none"><img src="../assets/images/loading.gif"/> Processing ...
                        Please wait
                    </div>
                    <div class="alert" style="display:none;">

                    </div>

                    <form id="staff-confirm" name="modal-feedback" action=""
                          method="post">
                        <div class="form-group" id="user_details">

                        </div>

                        <div class="form-group">
                            <button type="submit" name="submit" class="btn btn-primary"><i
                                    class="glyphicon glyphicon-check"></i>Register Staff
                            </button>
                            <a href="employees" class="btn btn-danger pull-right"> <i
                                    class="fa fa-close"></i>Close</a>

                        </div>
                    </form>
                </div>

            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>

</div>
<div class="modal fade" id="registerEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="registerEmployeeModal"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="deleteAgentModalLabel">Confirm Delete</h4>
            </div>

            <div class="modal-body">
                <div id="waiting" style="display:none;">
                    <center><img src='../assets/images/loading.gif'> Processing...</center>
                </div>
                <div class="alert " style="display:none;"></div>
                <form novalidate name="EmployeeRegForm" data-toggle="validator" id="EmployeeRegForm" method="post"
                      role="form">

                    <div class="col-lg-4">

                        <div class="form-group required">
                            <label class="control-label" for="pf-no">Employee PF NO: <span
                                    class=" glyphicon-asterisk"></span></label>
                            <input type="text" name="pf_no" class="form-control" id="pf_no"
                                   data-error="Name should not contain numerical values." required>
                            <span class="help-block with-errors"></span>

                        </div>

                        <div class="form-group required">
                            <label class="control-label" for="id_no">ID/Passport NO: <span
                                    class=" glyphicon-asterisk"></span></label>
                            <input type="text" name="id_no" pattern="[0-9]{8}"
                                   class="form-control"
                                   id="id_no"
                                   data-error="ID NO should not contain characters." required>
                            <span class="help-block with-errors"></span>

                        </div>
                        <div class="form-group required">
                            <label class="control-label" for="MOBILE_NO">Mobile NO: <span
                                    class=" glyphicon-asterisk"></span></label>
                            <input type="text" name="mobile_no" pattern="[+254|0]+[0-9]{9}"
                                   data-min-length="10"
                                   data-max-length="13" placeholder="+254720000000" class="form-control"
                                   id="mobile_no"
                                   data-error="Please input the correct mobile number." required>
                            <span class="help-block with-errors"></span>
                        </div>
                        <div class="form-group required">
                            <label class="control-label" for="terms">Gender: <span
                                    class=" glyphicon-asterisk"></span></label>
                            <select name="terms" id="terms" class="form-control">
                                <option value="">----Select Gender----</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                            <span class="help-block with-errors"></span>

                        </div>
                    </div>
                    <div class="col-lg-4">

                        <div class="form-group required">
                            <label class="control-label" for="sname">Surname: <span
                                    class="glyphicon-asterisk"></span></label>
                            <input type="text" name="sname" pattern="[A-Za-z]{1,}"
                                   class="form-control"
                                   id="sname"
                                   data-error="Name should not contain numerical values." required>
                            <span class="help-block with-errors"></span>

                        </div>
                        <div class="form-group required">
                            <label class="control-label" for="email">Email address: <span
                                    class=" glyphicon-asterisk"></span></label>
                            <input class="form-control" name="email" id="email" type="email"
                                   data-error="invalid email address" placeholder="example: email@email.com"
                                   required>
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group required">
                            <label class="control-label" for="home_town">Home Town: <span
                                    class="glyphicon-asterisk"></span></label>
                            <input type="text" name="home_town" pattern="[A-Za-z]{2,}"
                                   class="form-control" id="home_town"
                                   data-error="Name should not contain numerical values." required>
                            <span class="help-block with-errors"></span>

                        </div>
                        <div class="form-group required">
                            <label class="control-label" for="terms">Terms of Employment: <span
                                    class=" glyphicon-asterisk"></span></label>
                            <select name="terms" id="terms" class="form-control">
                                <option value="">----Select type----</option>
                                <option value="Permanent">Permanent</option>
                                <option value="Temporary">Temporary</option>
                            </select>
                            <span class="help-block with-errors"></span>

                        </div>

                    </div>
                    <div class="col-lg-4">
                        <div class="form-group required">
                            <label class="control-label" for="fname">First name: <span
                                    class=glyphicon-asterisk"></span>
                            </label>
                            <input type="text" name="fname" pattern="[A-Za-z]{1,}"
                                   class="form-control"
                                   id="fname"
                                   data-error="Name should not contain numerical values." required>
                            <span class="help-block with-errors"></span>

                        </div>
                        <div class="form-group required">

                            <label class="control-label" for="dob">Date Of Birth: <span
                                    class=" glyphicon-asterisk"></span></label>

                            <div class="input-group">
                                <input type="text" name="dob" class="form-control" id="dob"
                                       readonly
                                       data-error="Please fill in the correct date." required="required"/>
                                        <span class="input-group-addon add-on"><span
                                                class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group required">
                            <label class="control-label" for="d_employed">Date Employed: <span
                                    class=" glyphicon-asterisk"></span></label>

                            <div class="input-group">
                                <input name="d_employed"
                                       type="text" class="form-control" id="d_employed" readonly
                                       data-error="Please fill in the correct date." required="required"/>
                                        <span class="input-group-addon add-on"><span
                                                class="glyphicon glyphicon-calendar"></span></span>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div>
                            <div class="form-group required">
                                <label class="control-label" for="department">Department: <span
                                        class=" glyphicon-asterisk"></span></label>
                                <input type="text" class="form-control" name="department" id="department"
                                       data-error="Please input the correct mobile number." required>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>


                    </div>


                    <div>
                        <div class="form-group">
                            <div class="col-lg-12">
                                <button class="btn btn-success"
                                        type="submit"><span class="fa fa-plus"></span> Save Employee Details
                                </button>
                                <input type="reset" class="btn btn-warning" name="reset" value="Reset">
                            </div>
                        </div>


                    </div>
                </form>
            </div>
            <div class="modal-footer">

            </div>

        </div>
    </div>
</div>
</body>
</html>






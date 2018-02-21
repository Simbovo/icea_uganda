<?php
require_once 'header.php';

use application\controller\employeeController;
use app\application\library\commonFunctions;

$lib = new commonFunctions();
$empl = new employeeController;

$code = filter_var($_GET['empcode'], \FILTER_DEFAULT);
$empcode = $lib->decryptStringArray($_GET['ref_id'], 'equity1290');

$employee_details = $empl->getEmployeeById($empcode);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Edit <?php $employee_details->FULLNAMES ?>  details.

        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="employees"><i class="fa fa-user"></i> Employees</a></li>
            <li class="active">Edit staff</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="box box-primary">
                <div class="box-header with-border">

                </div>
                <div class="box-body">
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
                                <input type="text" name="pf_no" class="form-control" id="pf_no" value="<?= $employee_details->pfno; ?>"
                                       data-error="Name should not contain numerical values." required>
                                <input type="hidden" name="empcode"  value="<?= $employee_details->empcode; ?>"
                                       <span class="help-block with-errors"></span>

                            </div>

                            <div class="form-group required">
                                <label class="control-label" for="id_no">ID/Passport NO: <span
                                        class=" glyphicon-asterisk"></span></label>
                                <input type="text" name="id_no" pattern="[0-9]{8}"
                                       class="form-control"
                                       id="id_no" value="<?= $employee_details->idno; ?>"
                                       data-error="ID NO should not contain characters." required>
                                <span class="help-block with-errors"></span>

                            </div>
                            <div class="form-group required">
                                <label class="control-label" for="MOBILE_NO">Mobile NO: <span
                                        class=" glyphicon-asterisk"></span></label>
                                <input type="text" name="mobile_no" pattern="[+254|0]+[0-9]{9}"
                                       data-min-length="10"
                                       data-max-length="13" placeholder="+254720000000" class="form-control"
                                       id="mobile_no" value="<?= $employee_details->htel; ?>"
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
                                       id="sname" value="<?= $employee_details->surname ?>"
                                       data-error="Name should not contain numerical values." required>
                                <span class="help-block with-errors"></span>

                            </div>
                            <div class="form-group required">
                                <label class="control-label" for="email">Email address: <span
                                        class=" glyphicon-asterisk"></span></label>
                                <input class="form-control" name="email" id="email" type="email" 
                                       value="<?= $employee_details->email; ?>"
                                       data-error="invalid email address" placeholder="example: email@email.com"
                                       required>
                                <span class="help-block with-errors"></span>
                            </div>

                            <div class="form-group required">
                                <label class="control-label" for="home_town">Home Town: <span
                                        class="glyphicon-asterisk"></span></label>
                                <input type="text" name="home_town" pattern="[A-Za-z]{1,}"
                                       class="form-control" id="home_town" value="<?= $employee_details->htown; ?>"
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
                                <label class="control-label" for="fname">Other Names: <span
                                        class=glyphicon-asterisk"></span>
                                </label>
                                <input type="text" name="fname" pattern="[A-Za-z]{1,}"
                                       class="form-control"
                                       id="fname" value="<?= $employee_details->othernames; ?>"
                                       data-error="Name should not contain numerical values." required>
                                <span class="help-block with-errors"></span>

                            </div>
                            <div class="form-group required">

                                <label class="control-label" for="dob">Date Of Birth: <span
                                        class=" glyphicon-asterisk"></span></label>

                                <div class="input-group">
                                    <input type="text" name="dob" class="form-control" id="dob"
                                           readonly value="<?= $employee_details->dob; ?>"
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
                                           data-error="Please fill in the correct date." required="required"
                                           value="<?= $employee_details->demployed; ?>"/>
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
                                           data-error="Please input the correct mobile number." required
                                           value="<?= $employee_details->deptcode ?>" />
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
                                    <a href="confirm-staff" class="btn btn-danger"><i class="fa fa-arrow-left" aria-hidden="true" ></i>&nbsp;Cancel</a>
                                </div>
                            </div>


                        </div>
                    </form>
                </div>
            </div>
            <!-- /.row -->
    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->
<footer class="main-footer">
    <?php
    include('extras/footnote.php');
    ?>
</footer>
<!-- jQuery 2.1.4 -->
<script src="../assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="../assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!-- Bootstrap Datepicker js-->
<script src="../assets/plugins/datepicker/bootstrap-datepicker.js"></script>
<!--Data Table js-->
<script src="../assets/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="../assets/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
<!--Bootstrap validator-->
<script src="../assets/bootstrap/js/validator.min.js"></script>
<!--Jquery UI Validator-->
<script src="../assets/bootstrap/js/jquery.validate.min.js"></script>
<!-- SlimScroll -->
<script src="../assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<!-- FastClick -->
<script src='../assets/plugins/fastclick/fastclick.min.js'></script>
<!-- AdminLTE App -->
<script src="../assets/dist/js/app.min.js" type="text/javascript"></script>
<!--Initialize datepicker-->
<script src="../assets/dist/js/date.js" type="text/javascript"></script>


<!-- AdminLTE for demo purposes -->
<script src="../assets/dist/js/demo.js" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        $("#EmployeeRegForm").submit(function () {
            $("#waiting").slideDown();
            $.ajax({
                type: 'POST',
                url: '../helpers/update-staff-details',
                data: $("#EmployeeRegForm").serialize(),
                error: function (error) {
                    console.log(error);
                },
                success: function (response) {
                    $("#waiting").slideUp();
                    if (response === "false") {
                        $(".alert").attr("class", "alert alert-info");
                        $(".alert").slideDown();
                        $(".alert").html("<strong>Error!</strong> Staff registration not successfull, please try again later");
                    } else if (response === "true") {
                        $(".alert").attr("class", "alert alert-success");
                        $(".alert").slideDown();
                        $(".alert").html("<strong>Success!</strong> Staff registration successfull pending for confirmation");
                        setTimeout(function () {
                            window.location.href = "confirm-staff";
                        }, 2000);
                    } else {
                        
                        $(".alert").attr("class", "alert alert-danger");
                        $(".alert").slideDown() ;         
                        $(".alert").html("<strong>There is a technical error, Please contact administrator!</strong> ");
                    }
                    console.log(response);
                }
            });
            return false;
        })

    });
</script>
<script type="application/javascript">
    $(document).ready(function () {
    $("#dob").datepicker({
    format: "dd-mm-yyyy",
    endDate: '+0d',
    calendarWeeks: true,
    autoClose: true,
    toggleActive: true,
    ChangeYear: true,
    yearRange: "c-100:c+0"
    })
    $("#d_employed").datepicker({
    format: "dd-mm-yyyy",
    endDate: '+0d',
    calendarWeeks: true,
    autoClose: true,
    toggleActive: true,
    ChangeYear: true,
    yearRange: "c-100:c+0"
    })
    })
</script>
</body>
</html>


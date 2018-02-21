<?php
include("header.php");

use application\controller\dataController;
use application\controller\memberController;

$data = new memberController();

$members = $data->SingleRegisteredMembers();


$dtactl = new dataController
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Add a new client

        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>

            <li class="active"> Client registration</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="row">
            <div class="col-sm-12">
                <div class="box">
                    <div class="box-header with-border">
                        Please fill in the form below appropriately
                    </div>


                    <div class="box-body">
                        <div class="waiting" style="display:none">
                            <center><img src="../assets/images/loading.gif"> Processing request ... please wait</center>
                        </div>
                        <div class="alert" style="display:none;">

                        </div>
                        <form id="member_registration" name="member_registration" method="post" action="" data-toggle="validator" novalidate role="form">

                            <div id="rootwizard">
                                <ul class="nav nav-tabs nav-justified" data-tabs="tabs">
                                    <li><a href="#tab1" data-toggle="tab">Personal Information<span
                                                class="chevron"></span></a></li>
                                    <li><a href="#tab2" data-toggle="tab">Contact Details<span
                                                class="chevron"></span></a></li>
                                    <li><a href="#tab3" data-toggle="tab">Other Details<span
                                                class="chevron"></span></a></li>
                                </ul>
                                <div id="bar" class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                                         style="width: 0%;"></div>
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane col-xs-12" id="tab1">
                                        <div class="col-lg-4">
                                            <label class="control-label" for="text">Select Title:</label>
                                            <select name="title" class="form-control" id="title" required="required">
                                                <option value="">---Select Title---</option>
                                                <option value="Mr">Mr</option>
                                                <option value="Mrs">Mrs</option>
                                                <option value="Miss">Miss</option>
                                                <option value="Hon">Hon</option>
                                                <option value="Dr">Dr</option>
                                                <option value="Prof">Prof</option>
                                                <option value="Ms">Ms</option>
                                            </select>

                                            <span class="help-block with-errors"></span>

                                            <div class="form-group">
                                                <label class="control-label" for="text">Other name:</label>
                                                <input type="text" name="oname" class="form-control" id="oname"
                                                       data-error="Name should not contain numerical values." required>
                                                <span class="help-block with-errors"></span>

                                            </div>

                                            <div class="form-group">
                                                <label class="control-label" for="text">ID/Passport NO:</label>
                                                <input type="text" name="idno" pattern="[0-9]{7,8}" class="form-control" id="idno"
                                                       data-error="ID NO should not contain characters." required>
                                                <span class="help-block with-errors"></span>

                                            </div>

                                        </div>
                                        <div class="col-lg-4">

                                            <div class="form-group">
                                                <label class="control-label" for="text">Surname:</label>
                                                <input type="text" name="sname" pattern="[A-Za-z]{1,}" class="form-control" id="sname"
                                                       data-error="Name should not contain numerical values." required>
                                                <span class="help-block with-errors"></span>

                                            </div>
                                            <div class="form-group">
                                                <label class="control-label" for="text">Marital Status:</label>
                                                <select name="marital_status" class="form-control" id="marital_status" required="required">
                                                    <option value="">---Select Marital Status---</option>
                                                    <option value="Married">Single</option>
                                                    <option value="Single">Married</option>
                                                    <option value="other">Other</option>
                                                </select>

                                            </div>

                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="control-label" for="text">First name:</label>
                                                <input type="text" name="fname" pattern="[A-Za-z]{1,}" class="form-control" id="fname"
                                                       data-error="Name should not contain numerical values." required>
                                                <span class="help-block with-errors"></span>

                                            </div>

                                            <div class="form-group">
                                                <label class="control-label" for="text">Gender:</label>
                                                <select name="gender" class="form-control" id="gender" required="required">
                                                    <option value="">---Select Gender---</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label" for="text">Date Of Birth:</label>
                                                <input type="text" name="dob" class="form-control" id="dob" data-provider="datepicker" data-date-end-date="0d"
                                                       data-error="Please fill in the correct date." required="required"/>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="tab-pane col-xs-12" id="tab2">
                                        <div class="col-lg-4">

                                            <div class="form-group">
                                                <label class="control-label" for="text">Postal Address:</label>
                                                <input type="text" name="postal_address" class="form-control" id="postal_address"
                                                       data-error="Invalid Postal address." required>
                                                <span class="help-block with-errors"></span>

                                            </div>
                                            <div class="form-group">
                                                <label class="control-label" for="text"> Country:</label>
                                                <select name="country" class="form-control" id="country" required="required">
                                                    <option value="">---Select Country---</option>
                                                    <?php
                                                    $countries = $dtactl->countryList();

                                                    foreach ($countries as $country) {
                                                        echo "<option value'" . $country->country . ">" . $country->country . "</option>";
                                                    }
                                                    ?>
                                                </select>

                                            </div>

                                        </div>
                                        <div class="col-lg-4">

                                            <div class="form-group" id="options">
                                                <label class="control-label" for="text">Town:</label>
                                                <select name="town" class="form-control" id="town" required="required">
                                                    <option value="">---Select Town---</option>

                                                </select>
                                            </div>

                                            <div>
                                                <div class="form-group">
                                                    <label class="control-label" for="text">Mobile NO:</label>
                                                    <input type="text" name="mobile_no" pattern="[+254|0]+[0-9]{9}" data-min-length="10"
                                                           data-max-length="13" placeholder="+254720000000" class="form-control" id="mobile_no"
                                                           data-error="Please input the correct mobile number." required>
                                                    <span class="help-block with-errors"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="control-label" for="text">Physical location</label>
                                                <input type="text" name="pLocation" pattern="[A-Za-z]{1,}" class="form-control" id="pLocation"
                                                       data-error="Location should not contain numerical values." required>
                                                <span class="help-block with-errors"></span>

                                            </div>
                                            <div class="form-group">
                                                <label class="control-label" for="email">Email address</label>
                                                <input class="form-control" name="email" id="email" type="email" data-error="invalid email address"
                                                       placeholder="example: email@email.com"
                                                       required>
                                                <span class="help-block with-errors"></span>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab3">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="control-label" for="text">KRA PIN NO:</label>
                                                <input type="text" name="pin_no" pattern="[A-Z|0-9|A-Z]{11}" class="form-control" id="pin_no"
                                                       data-error="Invalid pin no." required>
                                                <span class="help-block with-errors"></span>

                                            </div>

                                            <div class="form-group">
                                                <label class="control-label" for="text">Taxable</label>
                                                <select name="taxable" class="form-control" id="taxable" required="required">
                                                    <option value="">---Select Taxation---</option>
                                                    <option value="1">Yes</option>
                                                    <option value="0">No</option>
                                                </select>

                                            </div>

                                            <div class="form-group">
                                                <label class="control-label" for="text">Resident:</label>
                                                <select name="resident" class="form-control" id="resident" required="required">
                                                    <option value="">---Select Residence---</option>
                                                    <option value="1">Yes</option>
                                                    <option value="1">No</option>
                                                </select>

                                            </div>

                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="control-label" for="text">Employment Status</label>
                                                <select name="employment_status" class="form-control" id="employment_status" required="required">
                                                    <option value="">---Select employment Status---</option>
                                                    <option value="1">Yes</option>
                                                    <option value="0">No</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label" for="text">Employer:</label>
                                                <input type="text" name="employer" pattern="[A-Za-z]{1,}" class="form-control" id="employer"
                                                       data-error="Name should not contain numerical values." required>
                                                <span class="help-block with-errors"></span>

                                            </div>
                                            <div class="form-group">
                                                <label class="control-label" for="text">Industry</label>
                                                <select name="industry" class="form-control" id="industry" required="required">
                                                    <option value="">---Select Industry---</option>
                                                    <option value="1">Doctor</option>
                                                    <option value="2">Engineer</option>
                                                    <option value="3">Entrepreneur</option>
                                                    <option value="4">Finance</option>
                                                    <option value="5">Nurse</option>
                                                    <option value="6">Student</option>
                                                    <option value="7">Teacher</option>
                                                    <option value="8">Entrepreneur</option>
                                                    <option value="9">Finance</option>
                                                    <option value="Student">Student</option>
                                                    <option value="Information and Technology">Information & Technology</option>
                                                </select>

                                            </div>

                                        </div>

                                    </div>
                                    <ul class="pager wizard">
                                        <li class="previous first" style="display:none;"><a href="#">First</a></li>
                                        <li class="previous"><a href="#">Previous</a></li>
                                        <li class="next last" style="display:none;"><a href="#">Last</a></li>
                                        <li class="next"><a href="#">Next</a></li>
                                        <li class="finish"><input class="btn btn-success btn-lg pull-right" type="submit" value="Submit"/></li>
                                    </ul>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<footer class="main-footer">
    <?php include('extras/footer.php') ?>
</footer>

<!-- Control Sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class='control-sidebar-bg'></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.1.4 -->
<script src="../assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="../assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!-- Bootstrap wizard JS -->
<script src="../assets/dist/js/jquery.bootstrap.wizard.min.js" type="text/javascript"></script>
<!--Pretiffy-->
<script src="../assets/dist/js/prettify.js"></script>
<!--Bootstrap validator-->
<!--<script src="../assets/bootstrap/js/validator.min.js"></script>-->
<!--Jquery UI Validator-->
<script src="../assets/bootstrap/js/jquery.validate.min.js"></script>
<!--DatePicker JS-->
<script type="text/javascript" src="../assets/plugins/datepicker/bootstrap-datepicker.js"></script>
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
        var $validator = $("#member_registration").validate();

        $('#rootwizard').bootstrapWizard({
            'tabClass': 'nav nav-pills',
            'onNext': function (tab, navigation, index) {
                var $valid = $("#member_registration").valid();
                if (!$valid) {
                    $validator.focusInvalid();
                    //$validator.attr("class", "alert alert-danger");
                    return false;
                }
            }
        });

        $('#rootwizard').bootstrapWizard({
            'onTabClick': function (tab, navigation, index) {
                alert('Please fill in all the tab details');
                return false;
            }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#member_registration").submit(function () {
            $(".waiting").slideDown();
            $.ajax({
                type: "POST",
                url: "../helpers/memberRegistrationHelper",
                data: $("#member_registration").serialize(),
                error: function (err_msg) {
                    console.log(err_msg);
                },
                success: function (response) {
                    $(".waiting").slideUp();
                    if (response == "failed") {
                        $(".alert").attr("class", "alert alert-danger");
                        $(".alert").slideDown();
                        $(".alert").html("<strong>Failed!</strong>There was a problem saving your details, please try again later")
                    } else if (response == "age") {
                        $(".alert").attr("class", "alert alert-danger");
                        $(".alert").slideDown();
                        $(".alert").html("<strong>Sorry!</strong>You should be above 18 years")
                    } else if (response == "successful") {
                        $(".alert").attr("class", "alert alert-success");
                        $(".alert").slideDown();
                        $(".alert").html("<strong>Success!</strong>You have successfully saved the client details. Please wait while the client detials are being confirmed");
                    } else if (response == "exists") {
                        $(".alert").attr("class", "alert alert-info");
                        $(".alert").slideDown();
                        $(".alert").html("<strong>Failed</strong> &nbsp; client already exists with the same registration details, please check that the details are corrects");
                    } else {
                        console.log(response);
                    }
                }
            });
            return(false)
        });

    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#dob").datepicker({
            format: "dd-mm-yyyy",
            todayHighlight: true,
            autoclose: true
        })
    });
</script>
<script type="text/javascript">
    $(document).on("change", '#country', function (e) {
        $.ajax({
            type: "POST",
            data: $("#country").serialize(),
            url: 'extras/getTownName',
            //dataType: 'json',
            success: function (response) {
                $("#options").html(response);
            }
        });
        return false;
    });


</script>
</body>
</html>

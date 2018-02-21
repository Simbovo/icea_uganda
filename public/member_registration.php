<?php


require('../app/Loader.php');

include('header.php');

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Member Registration

        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>

            <li class="active">Member Registration</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="row">
            <div class="box">

                <div class="box-header with-border">
                    Please fill in the member details
                </div>
                <div class="box-body with-border">
                    <div class="col-sm-12">
                        <div class="well">
                            <div class="waiting" style="display: none;">
                                <center><img src="../assets/images/loading.gif"> Verifying ...</center>
                            </div>
                        </div>

                        <form data-toggle="validator" id="add_members" action="" method="post" role="form">
                            <fieldset
                                style="border: solid #991f4c 2px; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px">

                                <legend> Personal Info</legend>
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

                                    <div class="form-group required">
                                        <label class="control-label" for="text">Other name:</label>
                                        <input type="text" name="oname" class="form-control" id="oname"
                                               data-error="Name should not contain numerical values." required>
                                        <span class="help-block with-errors"></span>

                                    </div>

                                    <div class="form-group required">
                                        <label class="control-label" for="text">ID/Passport NO:</label>
                                        <input type="text" name="idno" pattern="[0-9]{8}" class="form-control" id="idno"
                                               data-error="ID NO should not contain characters." required>
                                        <span class="help-block with-errors"></span>

                                    </div>

                                </div>
                                <div class="col-lg-4">

                                    <div class="form-group required">
                                        <label class="control-label" for="text">Surname:</label>
                                        <input type="text" name="sname" pattern="[A-Za-z]{1,}" class="form-control"
                                               id="sname"
                                               data-error="Name should not contain numerical values." required>
                                        <span class="help-block with-errors"></span>

                                    </div>
                                    <div class="form-group required">
                                        <label class="control-label" for="text">Marital Status:</label>
                                        <select name="marital_status" class="form-control" id="marital_status"
                                                required="required">
                                            <option value="">---Select Marital Status---</option>
                                            <option value="Married">Single</option>
                                            <option value="Single">Married</option>
                                            <option value="other">Other</option>
                                        </select>

                                    </div>

                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group required">
                                        <label class="control-label" for="text">First name:</label>
                                        <input type="text" name="fname" pattern="[A-Za-z]{1,}" class="form-control"
                                               id="fname"
                                               data-error="Name should not contain numerical values." required>
                                        <span class="help-block with-errors"></span>

                                    </div>

                                    <div class="form-group required">
                                        <label class="control-label" for="text">Gender:</label>
                                        <select name="gender" class="form-control" id="gender" required="required">
                                            <option value="">---Select Gender---</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                    <div class="form-group required">
                                        <label class="control-label" for="text">Date Of Birth:</label>
                                        <input type="text" name="dob" class="form-control" id="dob"
                                               data-error="Please fill in the correct date." required="required"/>
                                    </div>

                                </div>

                            </fieldset>

                            <fieldset
                                style="border: solid #991f4c 2px; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px">
                                <legend>Contact Information</legend>
                                <div class="col-lg-4">

                                    <div class="form-group required">
                                        <label class="control-label" for="text">Postal Address:</label>
                                        <input type="text" name="postal_address" class="form-control"
                                               id="postal_address"
                                               data-error="Invalid Postal address." required>
                                        <span class="help-block with-errors"></span>

                                    </div>
                                    <div class="form-group required">
                                        <label class="control-label" for="text">Country:</label>
                                        <select name="country" class="form-control" id="country" required="required">
                                            <option value="">---Select Country---</option>
                                            <option value="Kenya">Kenya</option>


                                        </select>

                                    </div>

                                </div>

                                <div class="col-lg-4">

                                    <div class="form-group required">
                                        <label class="control-label" for="text">Town:</label>
                                        <select name="town" class="form-control" id="town" required="required">
                                            <option value="">---Select Town---</option>
                                            <option value="Soy">Soy</option>
                                        </select>
                                    </div>

                                    <div>
                                        <div class="form-group required">
                                            <label class="control-label" for="text">Mobile NO:</label>
                                            <input type="text" name="mobile_no" pattern="[+254|0]+[0-9]{9}"
                                                   data-min-length="10"
                                                   data-max-length="13" placeholder="+254720000000" class="form-control"
                                                   id="mobile_no"
                                                   data-error="Please input the correct mobile number." required>
                                            <span class="help-block with-errors"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group required">
                                        <label class="control-label" for="text">Physical location</label>
                                        <input type="text" name="pLocation" pattern="[A-Za-z]{1,}" class="form-control"
                                               id="pLocation"
                                               data-error="Location should not contain numerical values." required>
                                        <span class="help-block with-errors"></span>

                                    </div>
                                    <div class="form-group required">
                                        <label class="control-label" for="email">Email address</label>
                                        <input class="form-control" name="email" id="email" type="email"
                                               data-error="invalid email address"
                                               placeholder="example: email@email.com"
                                               required>
                                        <span class="help-block with-errors"></span>
                                    </div>

                                </div>
                            </fieldset>

                            <fieldset
                                style="border: solid #991f4c 2px; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px">
                                <legend>Other Details</legend>
                                <div class="col-lg-6">
                                    <div class="form-group required">
                                        <label class="control-label" for="text">KRA PIN NO:</label>
                                        <input type="text" name="pin_no" pattern="[A-Z|0-9|A-Z]{9}" class="form-control"
                                               id="pin_no"
                                               data-error="Invalid pin no." required>
                                        <span class="help-block with-errors"></span>

                                    </div>

                                    <div class="form-group required">
                                        <label class="control-label" for="text">Taxable</label>
                                        <select name="taxable" class="form-control" id="taxable" required="required">
                                            <option value="">---Select Taxation---</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>

                                    </div>

                                    <div class="form-group required">
                                        <label class="control-label" for="text">Resident:</label>
                                        <select name="resident" class="form-control" id="resident" required="required">
                                            <option value="">---Select Residence---</option>
                                            <option value="1">Yes</option>
                                            <option value="1">No</option>
                                        </select>

                                    </div>

                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group required">
                                        <label class="control-label" for="text">Employment Status</label>
                                        <select name="employment_status" class="form-control" id="employment_status"
                                                required="required">
                                            <option value="">---Select employment Status---</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>

                                    <div class="form-group required">
                                        <label class="control-label" for="text">Employer:</label>
                                        <input type="text" name="employer" pattern="[A-Za-z]{1,}" class="form-control"
                                               id="employer"
                                               data-error="Name should not contain numerical values." required>
                                        <span class="help-block with-errors"></span>

                                    </div>
                                    <div class="form-group required">
                                        <label class="control-label" for="text">Industry</label>
                                        <select name="industry" class="form-control" id="industry" required="required">
                                            <option value="">---Select Industry---</option>
                                            <option value="Doctor">Doctor</option>
                                            <option value="Engineer">Engineer</option>
                                            <option value="Entrepreneur">Entrepreneur</option>
                                            <option value="Finance">Finance</option>
                                            <option value="Nurse">Nurse</option>
                                            <option value="Student">Student</option>
                                            <option value="Teacher">Teacher</option>
                                            <option value="Entrepreneur">Entrepreneur</option>
                                            <option value="Finance">Finance</option>
                                            <option value="Nurse">Nurse</option>
                                            <option value="Student">Student</option>
                                            <option value="Information and Technology">Information & Technology</option>
                                        </select>

                                    </div>

                                </div>
                            </fieldset>
                            <div>
                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <input type="reset" class="btn btn-warning" name="reset" value="Reset">
                                    </div>
                                </div>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
    </section>
</div>
<!-- /.content -->
<!-- /.content-wrapper -->

<footer class="main-footer">
    <?php include 'extras/footnote.php' ?>
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
    jQuery(document).ready(function (e) {
        $("#add_members").submit(function () {
            $(".waiting").slideDown();
            $.ajax({
                type: 'POST',
                url: "../helpers/memberRegistrationHelper.php",
                data: $("#add_members").serialize(),
                error: function (error) {
                    console.log(error);
                },
                success: function (response) {
                    $(".waiting").slideUp();
                    if (response == "successful") {
                        $(".alert").attr("class", "alert alert-success");
                        $(".alert").slideDown();
                        $(".alert").html("<strong>The member has been registered. </strong>");
                        window.location = "members_view.php";
                    } else if (response == "failed") {
                        $(".alert").html("<div class='alert alert-danger'><strong>Error!!</strong>Member registration not successful, please try aagain</div>");
                    } else {
                        $(".alert").html("<div class='alert alert-danger'><strong>ERROR!! </strong>" + response + "</div>");
                    }
                    console.log(response);
                }
            })
            return false;
        });
    });
</script>
</body>
</html>
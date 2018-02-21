<?php
/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 9/20/15
 * Time: 4:46 PM
 */
require('../app/Loader.php');

include('header.php');

$members = array(1, 2, 3);

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Joint/Group Member Registration Panel

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


            <div class="col-sm-12">

                <div class="waiting" style="display: none;">
                    <center><img src="../assets/images/loading.gif"> Verifying ...</center>
                </div>
                <fieldset>
                    <legend> Account Information</legend>
                    <div class="col-lg-6">
                        <div class="input-group input-md">
                            <span class="input-group-addon input-md">Account Number:</span>
                            <input type="text" value="" id="title" name="title"
                                   class="form-control input-md"/>
                        </div> <div class="input-group input-md">
                            <span class="input-group-addon input-md">CIF IDENTITY:</span>
                            <input type="text" value="" id="title" name="title"
                                   class="form-control input-md"/>
                        </div> <div class="input-group input-md">
                            <span class="input-group-addon input-md">Branch ID:</span>
                            <input type="text" value="" id="title" name="title"
                                   class="form-control input-md"/>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="input-group input-md">
                            <span class="input-group-addon input-md">Account Name:</span>
                            <input type="text" value="" id="title" name="title"
                                   class="form-control input-md"/>
                        </div> <div class="input-group input-md">
                            <span class="input-group-addon input-md">Branch Name:</span>
                            <input type="text" value="" id="title" name="title"
                                   class="form-control input-md"/>
                        </div> <div class="input-group input-md">
                            <span class="input-group-addon input-md">Group Name:</span>
                            <input type="text" value="" id="title" name="title"
                                   class="form-control input-md"/>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Member Data</legend>
                    <div class="col-lg-4">
                        <div class="input-group input-sm">
                            <span class="input-group-addon input-sm">Title:</span>
                            <input type="text" value="" id="title" name="title"
                                   class="form-control input-sm"/>
                        </div>
                        <div class="input-group input-sm">
                            <span class="input-group-addon input-sm">Member Names:</span>
                            <input type="text" value="" name="member_names"
                                   class="form-control input-sm"/>
                        </div>
                        <div class="input-group input-sm">
                            <span class="input-group-addon input-sm">ID/Passport NO:</span>
                            <input type="text" value="" id="idNo" name="idNo"
                                   class="form-control input-sm"/>
                        </div>
                        <div class="input-group input-sm">
                            <span class="input-group-addon input-sm">Marital Status:</span>
                            <input type="text" value="" id="mStatus" name="mStatus"
                                   class="form-control input-sm"/>
                        </div>
                        <div class="input-group input-sm">
                            <span class="input-group-addon input-sm">Date of Birth:</span>
                            <input type="text" value="" name="dob" id="dob"
                                   class="form-control input-sm"/>
                        </div>
                        <div class="input-group input-sm">
                            <span class="input-group-addon input-sm">Gender:</span>
                            <input type="text" value="" id="gender" name="gender"
                                   class="form-control input-sm"/>
                        </div>
                        <div class="input-group input-sm">
                            <span class="input-group-addon input-sm">Email Address:</span>
                            <input type="text" value="" name="emailAdd" id="emailAdd"
                                   class="form-control input-sm"/>
                        </div>
                        <div class="input-group input-sm">
                            <span class="input-group-addon input-sm">Postal Address:</span>
                            <input type="text" value="" name="postalAdd" id="postalAdd"
                                   class="form-control input-sm"/>
                        </div>


                    </div>
                    <div class="col-lg-4">
                        <div class="input-group input-sm">
                            <span class="input-group-addon input-sm">Physical Address:</span>
                            <input type="text" value="" name="physicalAdd" id="physicalAdd"
                                   class="form-control input-sm"/>
                        </div>
                        <div class="input-group input-sm">
                            <span class="input-group-addon input-sm">Town:</span>
                            <input type="text" value="" name="town" id="town"
                                   class="form-control input-sm"/>
                        </div>
                        <div class="input-group input-sm">
                            <span class="input-group-addon input-sm">Country:</span>
                            <input type="text" value="" name="postalAdd" id="postalAdd"
                                   class="form-control input-sm"/>
                        </div>
                        <div class="input-group input-sm">
                            <span class="input-group-addon input-sm">PIN  NO:</span>
                            <input type="text" value="" name="postalAdd" id="postalAdd"
                                   class="form-control input-sm"/>
                        </div>
                        <div class="input-group input-sm">
                            <span class="input-group-addon input-sm">Phone No:</span>
                            <input type="text" value="" name="phoneNo" id="phoneNo"
                                   class="form-control input-sm"/>
                        </div>
                        <div class="input-group input-sm">
                            <span class="input-group-addon input-sm">Taxable:</span>
                            <select name="taxable" id="taxable" class="form-control input-sm">
                                <option value="">--Please Select one</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="input-group input-sm">
                            <span class="input-group-addon input-sm">Resident:</span>
                            <select name="taxable" id="taxable" class="form-control input-sm">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="input-group input-sm">
                            <span class="input-group-addon input-sm">Industry:</span>
                            <select name="industry" id="industry" class="form-control input-sm">
                                <option>--Please Select Industry</option>
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
                                <option value="Information & Technology">Information & Technology</option>
                            </select>
                        </div>

                    </div>
                    <input type="hidden" name="cif" value="" id="cif" size="16" maxlength="16"/>

                </fieldset>


            </div>
        </div>
    </section>
</div>
<!-- ./wrapper -->

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

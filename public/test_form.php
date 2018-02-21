<?php
/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 9/20/15
 * Time: 4:46 PM
 */
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

<form class="form-horizontal" data-toggle="validator" id="add_members" action="" method="post" role="form">
    <table id="registration" class="table table-responsive" cellspacing="2" colspan="2" width="100%">
        <tr class="formsWhiteBg">
            <td align="right" style="padding-left:5px">CIF ID</td>
            <td align="center"><strong>:</strong></td>
            <td style="padding-left:5px" align="left"><input name="mycif" type="text"
                                                             value=""
                                                             class="form-control"
                                                             style="width:200px" size="20"
                                                             id="mycif"></td>
        </tr>
        <tr class="formsWhiteBg">
            <td align="right" style="padding-left:5px">Title</td>
            <td align="center"><strong>:</strong></td>
            <td style="padding-left:5px" align="left">
                <input name="title" type="text" class="form-control" style="width:200px"
                       size="20" id="title" value="" readonly></td>
            <td width="17%" align="right" style="padding-left:5px">First
                Name
            </td>
            <td width="1%" align="left"><strong>:</strong></td>
            <td width="37%" style="padding-left:5px" align="left">
                <input name="fname" type="text" class="form-control" style="width:200px"
                       size="20" id="fname" value="" readonly></td>
        </tr>
        <tr class="formsWhiteBg">
            <td align="right" style="padding-left:5px">SurName</td>
            <td align="center"><strong>:</strong></td>
            <td style="padding-left:5px" align="left"><input name="sname" type="text"
                                                             class="form-control"
                                                             style="width:200px" size="20"
                                                             id="sname" value=""
                                                             readonly/></td>
            <td width="17%" align="right" style="padding-left:5px">Other
                Names
            </td>
            <td width="1%" align="left"><strong>:</strong></td>
            <td width="37%" style="padding-left:5px" align="left">
                <input name="oname" type="text" class="form-control" style="width:200px"
                       size="20" id="oname" value="" readonly></td>
        </tr>

        <tr class="formsWhiteBg">
            <td align="right" style="padding-left:5px">Physical Location
            </td>
            <td align="center"><strong>:</strong></td>
            <td style="padding-left:5px" align="left"><input name="location" type="text"
                                                             class="form-control"
                                                             style="width:200px" size="20"
                                                             id="location"
                                                             value=""/></td>
            <td width="17%" align="right" style="padding-left:5px">Email
                Address
            </td>
            <td width="1%" align="left"><strong>:</strong></td>
            <td width="37%" style="padding-left:5px" align="left">
                <input name="email" type="text" class="form-control" style="width:200px"
                       size="20" id="email" value="<?= $email ?>" readonly></td>
        </tr>

        <tr class="formsWhiteBg">
            <td align="right" style="padding-left:5px">Postal Address</td>
            <td align="center"><strong>:</strong></td>
            <td style="padding-left:5px" align="left">
                <input name="address" type="text" class="form-control" style="width:200px"
                       size="20" id="address" value="<?= $addr ?>" readonly></td>
            <td width="17%" align="right" style="padding-left:5px">Mobile
                No.
            </td>
            <td width="1%" align="left"><strong>:</strong></td>
            <td width="37%" style="padding-left:5px" align="left">
                <script>
                    function isNumberKey(evt) {
                        var charCode = (evt.which) ? evt.which : event.keyCode
                        if (charCode > 31 && (charCode < 48 || charCode > 57))
                            return false;
                        return true;
                    }
                </script>
                <input name="phone" type="number" onkeypress="return isNumberKey(event)"
                       class="form-control" style="width:200px" size="20" id="phone"
                       value="<?= $phone ?>" readonly/></td>
        </tr>
        <tr class="formsWhiteBg">

            <td align="right" style="padding-left:5px">Pin No</td>
            <td align="center"><strong>:</strong></td>
            <td style="padding-left:5px" align="left">
                <input name="pinno" type="text" class="form-control" style="width:200px"
                       size="20" id="pinno" value="<?= $pin ?>"></td>
            <td width="17%" align="right" style="padding-left:5px">ID
                No./Passport No
            </td>
            <td width="1%" align="left"><strong>:</strong></td>
            <td width="37%" style="padding-left:5px" align="left">
                <input name="idno" type="text" class="form-control" style="width:200px" size="20"
                       id="idno" value="<?= $idno ?>" readonly></td>
        </tr>
        <tr class="formsWhiteBg">
            <td align="right" style="padding-left:5px">Country</td>
            <td align="center"><strong>:</strong></td>
            <td style="padding-left:5px" align="left">
                <input name="country" type="text" class="form-control" style="width:200px"
                       size="20" id="country" value="<?= $country ?>" readonly>
            </td>
            <td width="17%" align="right" style="padding-left:5px">Town
            </td>
            <td width="1%" align="left"><strong>:</strong></td>
            <td width="37%" style="padding-left:5px" align="left">
                <input name="town" type="text" class="form-control" style="width:200px" size="20"
                       id="town" value="<?= $town ?>" readonly></td>
        </tr>
        <tr class="formsWhiteBg">
            <td align="right" style="padding-left:5px">Date of Birth</td>
            <td align="center"><strong>:</strong></td>
            <td style="padding-left:5px" align="left">
                <input type="text" name="dob" id="dob" class="form-control" style="width:200px"
                       value="<?= $dob ?>" readonly></td>
            <td width="17%" align="right" style="padding-left:5px">
                Taxable
            </td>
            <td width="1%" align="left"><strong>:</strong></td>
            <td width="37%" style="padding-left:5px" align="left">
                <select name="taxable" id="taxable" class="form-control" style="width: 200px">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select></td>
        </tr>

        <tr class="formsWhiteBg">
            <td align="right" style="padding-left:5px">Industry</td>
            <td align="center"><strong>:</strong></td>
            <td style="padding-left:5px" align="left">
                <select name="industry" id="industry" class="form-control" style="width:200px">
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
                </select></td>
            <td width="17%" align="right" style="padding-left:5px">
                Employed
            </td>
            <td width="1%" align="left"><strong>:</strong></td>
            <td width="37%" style="padding-left:5px" align="left">
                <select name="emp" id="emp" class="form-control" style="width:200px">
                    <option>Yes</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select></td>
        </tr>
        <tr class="formsWhiteBg">
            <td align="right" style="padding-left:5px">Gender</td>
            <td align="center"><strong>:</strong></td>
            <td style="padding-left:5px" align="left">
                <input name="gender" type="text" class="form-control" style="width:200px"
                       size="20" id="gender" value="<?= $gender ?>" readonly>
            </td>
            <td width="17%" align="right" style="padding-left:5px">Marital
                Status
            </td>
            <td width="1%" align="left"><strong>:</strong></td>
            <td style="padding-left:5px" align="left">
                <input name="marital" type="text" class="form-control" style="width:200px"
                       size="20" id="marital" value="<?= $marital ?>" readonly>
            </td>
        </tr>

    </table>
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
    <div class="pull-right hidden-xs">
        <b>Version</b> 2.0
    </div>
    <strong>Copyright &copy; <?php echo date('Y'); ?> <a
            href="https://clients.cic.co.ke"><?php echo $_SESSION['comp_name']; ?>
        </a>.</strong> All rights reserved.
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
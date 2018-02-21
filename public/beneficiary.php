<?php

include('header.php');

use application\controller\dataController;
use app\application\library\commonFunctions;

$lib = new commonFunctions();

$data_ctl = new dataController();

$member_no = filter_var($_GET['id'], FILTER_SANITIZE_STRING);
$page_action = $lib->encryptStringArray('beneficiaries', 'token321');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Nominee/beneficiary registration

        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="client-registration"><i class="fa fa-dashboard"></i>Client Registration</a></li>

            <li class="active">Beneficiary Registration</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-info">

                    <div class="box-header with-border">
                        <h3> Please fill in the beneficiary details</h3>
                    </div>
                    <div class="box-body with-border">
                        <div class="col-sm-12">

                            <div class="alert" style="display:none;"></div>

                            <form data-toggle="validator" id="add_members" action="" method="post" role="form">
                                <fieldset
                                    style="border: solid #09cbee 2px; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px">

                                    <legend> Personal Info</legend>
                                    <div class="col-lg-4">
                                        <label class="control-label" for="text">Salutation:</label>
                                        <select name="title" class="form-control" id="title" required="required">
                                            <option value="">---Select Salutation---</option>
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
                                            <label class="control-label" for="text">Surname:</label>
                                            <input type="text" name="sname" pattern="[A-Za-z]{1,}" class="form-control"
                                                   id="sname"
                                                   data-error="Name should not contain numerical values." required>
                                            <span class="help-block with-errors"></span>

                                        </div>
                                        <div class="form-group required">
                                            <label class="control-label" for="text">First name:</label>
                                            <input type="text" name="fname" pattern="[A-Za-z]{1,}" class="form-control"
                                                   id="fname"
                                                   data-error="Name should not contain numerical values." required>
                                            <span class="help-block with-errors"></span>

                                        </div>
                                        <div class="form-group required">
                                            <label class="control-label" for="text">Other name:</label>
                                            <input type="text" name="oname" class="form-control" id="oname"
                                                   data-error="Name should not contain numerical values." required>
                                            <span class="help-block with-errors"></span>

                                        </div>

                                        <div class="form-group required">
                                            <label class="control-label" for="text">ID/Passport NO:</label>
                                            <input type="text" name="idno" pattern="[0-9]{8}" class="form-control"
                                                   id="idno"
                                                   data-error="ID NO should not contain characters." required>
                                            <span class="help-block with-errors"></span>

                                        </div>


                                    </div>
                                    <div class="col-lg-4">


                                        <div class="form-group required">
                                            <label class="control-label" for="text">Gender:</label>
                                            <select name="gender" class="form-control" id="gender" required="required">
                                                <option value="">---Select Gender---</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="text">Date Of Birth:</label>

                                            <div class="input-group">
                                                <span class="input-group-addon"><i
                                                        class="glyphicon glyphicon-calendar"></i> </span>
                                                <input type="text" name="dob" class="form-control" id="dob"
                                                       data-provider="datepicker" data-date-end-date="0d"
                                                       data-error="Please fill in the correct date." readonly="readonly"
                                                       required="required"/>
                                            </div>
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
                                        <div class="form-group required">
                                            <label class="control-label" for="relation">Relationship:</label>
                                            <select name="relation" class="form-control" id="relation"
                                                    required="required">
                                                <option value="">---Select relation---</option>
                                                <option value="Brother">Brother</option>
                                                <option value="Daughter">Daughter</option>
                                                <option value="Father">Father</option>
                                                <option value="Husband">Husband</option>
                                                <option value="Husband">Husband</option>
                                                <option value="Nephew">Nephew</option>
                                                <option value="Niece">Niece</option>
                                                <option value="Sister">Sister</option>
                                                <option value="Son">Son</option>
                                                <option value="Wife">Wife</option>
                                                <option value="Other">Other</option>
                                            </select>

                                        </div>
                                        <div class="form-group required">
                                            <label class="control-label" for="percentage">Percentage:</label>
                                            <input type="number" name="percentage" pattern="[0-9]{3}"
                                                   class="form-control"
                                                   id="percentage"
                                                   data-error="Fill in the correct percentage." required>
                                            <span class="help-block with-errors"></span>

                                        </div>

                                    </div>
                                    <div class="col-lg-4">
                                        <div>
                                            <div class="form-group required">
                                                <label class="control-label" for="text">Mobile NO:</label>
                                                <input type="text" name="mobile_no" pattern="[+254|0]+[0-9]{9}"
                                                       data-min-length="10"
                                                       data-max-length="13" placeholder="+254720000000"
                                                       class="form-control"
                                                       id="mobile_no"
                                                       data-error="Please input the correct mobile number." required>
                                                <span class="help-block with-errors"></span>
                                            </div>
                                        </div>
                                        <div class="form-group required">
                                            <label class="control-label" for="email">Email address</label>
                                            <input class="form-control" name="email" id="email" type="email"
                                                   data-error="invalid email address"
                                                   placeholder="example: email@email.com"
                                                   required>
                                            <span class="help-block with-errors"></span>
                                        </div>

                                        <div class="form-group required">
                                            <label class="control-label" for="text">Postal Address:</label>
                                            <input type="text" name="postal_address" class="form-control"
                                                   id="postal_address"
                                                   data-error="Invalid Postal address." required>
                                            <span class="help-block with-errors"></span>

                                        </div>
                                        <div class="form-group required">
                                            <label class="control-label" for="text">Physical location</label>
                                            <input type="text" name="pLocation" pattern="[A-Za-z]{1,}"
                                                   class="form-control"
                                                   id="pLocation"
                                                   data-error="Location should not contain numerical values." required>
                                            <span class="help-block with-errors"></span>

                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="another_nominee">Register another
                                                nominee?</label>

                                            <div class="radio">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" id="another_nominee"
                                                           name="another_nominee" value="1"> Yes
                                                </label>

                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" id="another_nominee"
                                                           name="another_nominee" value="0">
                                                    No
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                </fieldset>

                                <div>
                                    <div class="form-group">
                                        <div class="col-lg-12">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>
                                                Save Details
                                            </button>
                                            <img src="../assets/images/spinner.gif" alt="" id="loader"
                                                 style="display: none">
                                            <input type="reset" class="btn btn-warning pull-right" name="reset"
                                                   value="Reset">
                                        </div>
                                    </div>
                                </div>
                            </form>
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
    <?php include 'extras/footnote.php' ?>
</footer>

</div><!-- ./wrapper -->

<!-- jQuery 2.1.4 -->
<script src="../assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="../assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

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
    jQuery(document).ready(function (e) {
        $("#add_members").submit(function () {
            $("#loader").show();
            $.ajax({
                type: 'POST',
                url: "../helpers/member_registration_minion",
                data: $("#add_members").serialize(),
                error: function (error) {
                    console.log(error);
                },
                success: function (response) {
                    $("#loader").hide();
                    var resp = JSON.parse(response);
                    if (resp.status == "failed") {
                        $(".alert").attr("class", "alert alert-danger");
                        $(".alert").slideDown();
                        $(".alert").html("<strong>Failed!</strong>" + resp.message)
                    } else if (response == "age") {
                        $(".alert").attr("class", "alert alert-danger");
                        $(".alert").slideDown();
                        $(".alert").html("<strong>Sorry!</strong>You should be above 18 years")
                    } else if (resp.status == "success") {
                        $(".alert").attr("class", "alert alert-success");
                        $(".alert").slideDown();
                        $(".alert").html("<strong>Success!</strong>" + resp.message + " - " + resp.member_no);
                        setTimeout(function () {
                            window.location.href = resp.uri;
                        }, 4000);
                    } else if (resp == "exists") {
                        $(".alert").attr("class", "alert alert-info");
                        $(".alert").slideDown();
                        $(".alert").html("<strong>Failed</strong> &nbsp; client already exists with the same registration details, please check that the details are corrects");
                    } else {
                        console.log(response);
                    }
                }
            })
            return false;
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#dob").datepicker({
            format: "yyyy-dd-mm",
            todayHighlight: true,
            autoclose: true
        });

    });

    function check_percentage() {
        $("#loader").show();
        var data = new Object();
        data.member_no = $("#member_no").val();
        data.percentage = $("#percentage").val();
        $.ajax({
            url: "extras/check_percentage.php",
            data: 'data=' + JSON.stringify(data),
            type: "POST",
            success: function (data) {
                $("#user-availability-status").html(data);
                $("#loaderIcon").hide();
            },
            error: function () {
            }
        });
    }//19941.68466
</script>
</body>
</html>
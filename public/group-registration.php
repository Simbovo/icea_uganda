<?php
/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 30/01/2017
 * Time: 08:57
 */

include('header.php');
use app\application\library\commonFunctions;
use application\controller\dataController;

$lib = new commonFunctions();

$data_ctl = new dataController();

$page_action = $lib->encryptStringArray('registration', 'token321');
$request_file = $lib->encryptStringArray('group', 'token321');

$bank_data = $data_ctl->getBankDetails();


?>
<style>
    ul#stepForm, ul#stepForm li {
        margin: 0;
        padding: 0;
    }

    ul#stepForm li {
        list-style: none outside none;
    }

    label {
        margin-top: 10px;
    }

    .help-inline-error {
        color: red;
    }
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Add a new client

        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="dashboard"><i class="glyphicon glyphicon-users"></i> Home</a></li>

            <li class="active"> Client registration</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="text-capitalize">Please fill in the form below appropriately </h3>
                    </div>

                    <div class="box-body">

                        <div class="alert" style="display:none;"></div>

                        <form id="member_registration" name="member_registration" method="post" action=""
                              data-toggle="validator" novalidate role="form">
                            <input type="hidden" value="<?php echo $page_action; ?>" name="token">
                            <input type="hidden" value="<?php echo $request_file; ?>" name="file_request">

                            <div id="sf1" class="frm">
                                <fieldset>
                                    <legend><h5>Step 1 of 3 | Client Details</h5></legend>

                                    <div class="col-lg-4">

                                        <div class="form-group">
                                            <label class="control-label" for="group_name">Group Account Name:</label>
                                            <input type="text" name="group_name" class="form-control" id="group_name"
                                                   data-error="Name should not contain numerical values."
                                                   required="required" autocomplete="off">
                                            <span class="help-block with-errors"></span>

                                        </div>
                                        <input type="hidden" name="member_type" id="member_tye"
                                               value="Institutional Member" />

                                        <div class="form-group">
                                            <label class="control-label" for="text">Date of
                                                Inco-operation/Registration:</label>

                                            <div class="input-group">
                                                <span class="input-group-addon"><i
                                                            class="fa fa-calendar"></i> </span>
                                                <input type="text" name="registration_date" class="form-control"
                                                       id="registration_date" value="<?php echo date('Y-m-d') ?>"
                                                       readonly="readonly"
                                                       data-provider="datepicker" data-date-end-date="0d"
                                                       data-error="ID NO should not contain characters" required
                                                       autocomplete="off">
                                            </div>
                                            <span class="help-block with-errors"></span>

                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="email">Email address</label>
                                            <input class="form-control" name="email" id="email" type="email"
                                                   data-error="Invalid email address"
                                                   placeholder="example: email@email.com"
                                                   required="required">
                                            <span class="help-block with-errors"></span>
                                        </div>

                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="control-label" for="group_type">Institution type:</label>
                                            <select name="group_type" id="group_type" class="form-control"
                                                    required="required">
                                                <option value="">--Please select type--</option>
                                                <option value="church">Church</option>
                                                <option value="company">Company</option>
                                                <option value="chama">Chama</option>
                                                <option value="ngo">NGO</option>
                                                <option value="sacco">Sacco</option>
                                                <option value="school">School</option>
                                                <option value="other">Other</option>
                                            </select>
                                            <span class="help-block with-errors"></span>

                                        </div>

                                        <div class="form-group">
                                            <label class="control-label" for="category">Institution category:</label>
                                            <div class="radio">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" id="category"
                                                           name="category" value="1"> Group
                                                </label>

                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" id="category"
                                                           name="category" value="2">
                                                    Company
                                                </label>

                                            </div>
                                            <span class="help-block with-errors"></span>

                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="registration_no">Registration
                                                Number</label>
                                            <input class="form-control" name="registration_no" id="registration_no"
                                                   type="text"
                                                   data-error="Invalid registration no"
                                                   required="required">
                                            <span class="help-block with-errors"></span>
                                        </div>


                                    </div>
                                    <div class="col-lg-4">

                                    </div>
                                    <div class="clearfix" style="height: 10px;clear: both;"></div>


                                    <div class="form-group">
                                        <div class="pull-right">
                                            <div class="col-lg-6 col-lg-offset-3">
                                                <button class="btn btn-primary open1" type="button">Next <span
                                                            class="fa fa-arrow-right"></span></button>
                                            </div>
                                        </div>
                                    </div>

                                </fieldset>
                            </div>
                            <div id="sf2" class="frm" style="display: none;">
                                <fieldset>
                                    <legend>Step 2 of 3 : Client Contact Details</legend>

                                    <div class="col-lg-4">

                                        <div class="form-group">
                                            <label class="control-label" for="statement">Receive statement via?</label>

                                            <div class="radio">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" id="statement_via"
                                                           name="statement_via" value="1"> Email (Free)
                                                </label>

                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" id="statement_via"
                                                           name="statement_via" value="2">
                                                    Postage Mail (Charged)
                                                </label>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="sms_notify">SMS Notification</label>

                                            <div class="radio">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" id="sms_notify"
                                                           name="sms_notify" value="1"> Yes
                                                </label>

                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" id="sms_notify"
                                                           name="sms_notify" value="0">
                                                    No
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <label class="control-label" for="sms_enquiry">SMS Enquiry</label>

                                            <div class="radio">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" id="sms_enquiry"
                                                           name="sms_enquiry" value="1"> Yes
                                                </label>

                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" id="sms_enquiry"
                                                           name="sms_enquiry" value="0">
                                                    No
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="control-label" for="text">Postal Address:</label>
                                            <input type="number" name="postal_address" class="form-control"
                                                   id="postal_address"
                                                   data-error="Invalid Postal address." required>
                                            <span class="help-block with-errors"></span>

                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="text">Postal Code:</label>
                                            <input type="number" name="postal_code" class="form-control"
                                                   id="postal_code"
                                                   data-error="Invalid Postal address." required>
                                            <span class="help-block with-errors"></span>

                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="text">Land line tel no:</label>
                                            <input type="text" name="mobile_no"
                                                   data-min-length="10"
                                                   data-max-length="13" placeholder="+254720000000"
                                                   class="form-control" id="mobile_no"
                                                   data-error="Please input the correct mobile number."
                                                   required>
                                            <span class="help-block with-errors"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="control-label" for="text"> Country:</label>
                                            <select name="country" class="form-control" id="country"
                                                    required="required">
                                                <option value="">---Select Country---</option>
                                                <?php
                                                $countries = $data_ctl->countryList();

                                                foreach ($countries as $country) {
                                                    echo "<option value='" . $country->country . "'>" . $country->country . "</option>";
                                                }
                                                ?>
                                            </select>

                                        </div>
                                        <div class="form-group" id="options">
                                            <label class="control-label" for="text">Town:</label>
                                            <select name="town" class="form-control" id="town" required="required">
                                                <option value="">---Select Town---</option>

                                            </select>
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label" for="text">Physical Address </label>
                                            <input type="text" name="pLocation" pattern="[A-Za-z]{1,}"
                                                   class="form-control" id="pLocation"
                                                   data-error="Location should not contain numerical values."
                                                   required>
                                            <span class="help-block with-errors"></span>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="pull-right">
                                            <div class="col-lg-6 col-lg-offset-3">
                                                <button class="btn btn-warning back2" type="button"><span
                                                            class="fa fa-arrow-left"></span> Back
                                                </button>
                                                <button class="btn btn-primary open2" type="button">Next <span
                                                            class="fa fa-arrow-right"></span></button>
                                            </div>
                                        </div>
                                    </div>

                                </fieldset>
                            </div>

                            <div id="sf3" class="frm" style="display: none;">
                                <fieldset>
                                    <legend>Step 3 of 3 : Other Details</legend>

                                    <div class="col-lg-5 col-lg-offset-1">
                                        <fieldset>
                                            <legend>Statutory Details</legend>
                                            <div class="form-group">
                                                <label class="control-label" for="account_mandate">Account
                                                    Mandate:</label>
                                                <select name="account_mandate" class="form-control" id="account_mandate"
                                                        required="required">
                                                    <option value="">--Select account mandate--</option>
                                                    <option value="One to sign">One to sign</option>
                                                    <option value="Both to sign">Both to sign</option>
                                                </select>
                                                <span class="help-block with-errors"></span>

                                            </div>

                                            <div class="form-check form-check-inline">
                                                <label class="control-label" for="text">Taxation (Is Client tax
                                                    exempt)</label>

                                                <div class="radio">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="radio" id="tax_exempt"
                                                               name="tax_exempt" value="1"> Yes
                                                    </label>

                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="radio" id="tax_exempt"
                                                               name="tax_exempt" value="0">
                                                        No
                                                    </label>
                                                </div>

                                            </div>

                                            <div class="form-check form-check-inline">
                                                <label class="control-label" for="text">Resident (Is Client
                                                    resident)</label>

                                                <div class="radio">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="radio" id="resident"
                                                               name="resident" value="1"> Yes
                                                    </label>

                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="radio" id="resident"
                                                               name="resident" value="0">
                                                        No
                                                    </label>
                                                </div>

                                            </div>
                                            <div class="form-check form-check-inline">
                                                <label class="control-label" for="text">Employment (Is Client
                                                    employed)</label>

                                                <div class="radio">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="radio"
                                                               id="employment_status"
                                                               name="employment_status" value="1"> Yes
                                                    </label>

                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="radio"
                                                               id="employment_status"
                                                               name="employment_status" value="0">
                                                        No
                                                    </label>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>

                                    <div class="col-lg-5 col-lg-offset-1">
                                        <fieldset>
                                            <legend>Bank account details</legend>
                                            <div class="form-group">

                                                <div class="form-group">
                                                    <label for="bank_name" class="control-label">Bank
                                                        Name </label>


                                                    <select name="bank_name" id="bank_name" class="form-control"
                                                            required="required">
                                                        <option value="">--Select Bank --</option>
                                                        <?php
                                                        foreach ($bank_data as $bank) {
                                                            echo "<option value='" . $bank->bank_code . "-" . $bank->bank_name . "'>" . $bank->bank_name . "</option>";
                                                        }
                                                        ?>
                                                    </select>

                                                </div>
                                                <div class="form-group" id="bankoptions">
                                                    <label class="control-label" for="branch">Bank
                                                        Branch</label>
                                                    <select name="branch" class="form-control" id="branch"
                                                            required="required">
                                                        <option value="">--- Please Select Branch ---</option>

                                                    </select>

                                                </div>

                                                <div class="form-group">
                                                    <label for="acct_no" class="control-label">Account Number </label>
                                                    <input type="text" class="form-control" name="acct_no"
                                                           id="acct_no"
                                                           pattern="[0-9]" data-min-length="10"
                                                           placeholder="1000010000" required="required"
                                                           autocomplete="off"
                                                           data-max-length="13"/>

                                                </div>
                                                <div class="form-group">
                                                    <label for="acct_name" class="control-label">Account
                                                        name </label>
                                                    <input type="text" id="acct_name" required="required"
                                                           placeholder="John Doe" autocomplete="off"
                                                           name="acct_name" class="form-control">

                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label" for="acc_type">Account
                                                        Type:</label>
                                                    <select name="acc_type" class="form-control" id="acc_type"
                                                            required="required">
                                                        <option value="">--- Please Select Account Type ---</option>
                                                        <option value="Current">Current Account</option>
                                                        <option value="Junior">Junior Account</option>
                                                        <option value="Savings">Savings Account</option>
                                                        <option value="Sharia">Sharia Account</option>
                                                        <option value="Student">Student Account</option>
                                                        <option value="Other">Other</option>
                                                    </select>

                                                </div>

                                        </fieldset>


                                    </div>

                                    <div class="clearfix" style="height: 10px;clear: both;"></div>

                                    <div class="form-group">
                                        <div class="pull-right">
                                            <div class="col-lg-6 col-lg-offset-3">
                                                <button class="btn btn-warning back3" type="button"><span
                                                            class="fa fa-arrow-left"></span> Back
                                                </button>
                                                <button class="btn btn-primary open3" type="submit">Submit</button>
                                                <img src="../assets/images/spinner.gif" alt="" id="loader"
                                                     style="display: none">
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
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
<!--Pretiffy-->
<script src="../assets/dist/js/prettify.js"></script>

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


<script type="text/javascript">
    jQuery().ready(function () {
        // validate form on keyup and submit
        var v = jQuery("#member_registration").validate({
            rules: {
                oname: {
                    required: true,
                    minlength: 3,
                    maxlength: 16,
                },
                sname: {
                    required: true,
                    minlength: 5,
                    maxlength: 16,
                },
                fname: {
                    required: true,
                    minlength: 5,
                    maxlength: 16,
                },
                dob: {
                    required: true,
                    minlength: 6

                },
                postal_address: {
                    required: true,
                    number: true,
                    minlength: 1,
                    maxlength: 6,
                },
                postal_code: {
                    required: true,
                    number: true,
                    minlength: 5,
                    maxlength: 5,
                },
                idno: {
                    required: true,
                    minlength: 6,
                    maxlength: 8,

                },
                mobile_no: {
                    required: true,
                    minlength: 8,
                    maxlength: 13,
                },
                pLocation: {
                    required: true,
                    minlength: 5,
                    maxlength: 30,
                },
                email: {
                    required: true,
                    email: true,
                },
                pin_no: {
                    required: true,
                    minlength: 8,
                    maxlength: 11,
                },
                acct_name: {
                    required: true,
                    minlength: 5,
                    maxlength: 32,
                },
                acct_no: {
                    required: true,
                    minlength: 9,
                    maxlength: 13,
                    number: true
                }

            },
            errorElement: "span",
            errorClass: "help-inline-error",
        });

        $(".open1").click(function () {
            if (v.form()) {
                $(".frm").hide("fast");
                $("#sf2").show("slow");
            }
        });

        $(".open2").click(function () {
            if (v.form()) {
                $(".frm").hide("fast");
                $("#sf3").show("slow");
            }
        });

        $(".back2").click(function () {
            $(".frm").hide("fast");
            $("#sf1").show("slow");
        });

        $(".back3").click(function () {
            $(".frm").hide("fast");
            $("#sf2").show("slow");
        });

        $(".open3").submit(function () {
            if (v.form()) {
                $("#loader").show();
                $.ajax({
                    type: "POST",
                    url: "../helpers/member_registration_minion",
                    data: $("#member_registration").serialize(),
                    error: function (err_msg) {
                        console.log(err_msg);
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
                            $(".alert").html("<strong>Success!</strong>" + resp.message + " " + resp.member_no);
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
                });
            }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#member_registration").submit(function () {
            $("#loader").show();
            $.ajax({
                type: "POST",
                url: "../helpers/member_registration_minion",
                data: $("#member_registration").serialize(),
                error: function (err_msg) {
                    console.log(err_msg);
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
            });
            return false;
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#registration_date").datepicker({
            format: "yyyy-dd-mm",
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
    $(document).on("change", '#bank_name', function (e) {


        $.ajax({
            type: "POST",
            data: $("#bank_name").serialize(),
            url: 'extras/getbnkbranch.php',
            success: function (response) {
                $("#bankoptions").html(response);
            }
        });
        return false


    });
    $(document).keydown(function (event) {
        if (event.ctrlKey == true && (event.which == '118' || event.which == '86')) {
            alert('thou. shalt. not. PASTE!');
            event.preventDefault();
        }
    });

</script>
</body>
</html>



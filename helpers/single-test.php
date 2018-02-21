<?php
require('../app/Loader.php');

use app\application\library\commonFunctions;
use app\application\model\DbConnection;
use application\controller\memberController;

$cu_id = new commonFunctions();
$dbConnect = DbConnection::getInstance();
$memObj = new memberController();

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    parse_str(file_get_contents("php://input"), $customer_id);
}
$_serviceUrl = "http://soa3internaldev.ebsafrica.com/ESB/RS/UnitTrust/Rest/Customer/queryCustomerDetails";

$data_json = json_encode($customer_id);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $_serviceUrl);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length: ' . strlen($data_json)));
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);


if (!$response) {
    return false;
} else {
    $client_data = json_decode($response);

    /* print_r($client_data->PersonIdentifier->Phone);
      die; */
    $BankId = $client_data->CustomerIdentifier->BankId;
    $Customer_ID = $client_data->CustomerIdentifier->CustomerID;
    $BranchID = $client_data->CustomerIdentifier->BranchID;
    $CustomerType = $client_data->CustomerIdentifier->CustomerType;
    $FirstName = $client_data->PersonIdentifier->FirstName;
    $LastName = $client_data->PersonIdentifier->LastName;
    $BirthDate = $client_data->PersonIdentifier->BirthDate;
    $EmailAddress = $client_data->PersonIdentifier->EmailAddress;
    $Gender = $client_data->PersonIdentifier->Gender;
    $MaritalStatus = $client_data->PersonIdentifier->MaritalStatus;
    $LineOne = $client_data->PersonIdentifier->Address->LineOne;
    $PostalCode = $client_data->PersonIdentifier->Address->PostalCode;
    $CountryName = $client_data->PersonIdentifier->Address->CountryName;


    $SalutationCode = $client_data->PersonIdentifier->SalutationCode;
    $nationalIdNo = $client_data->DocumentIdentifier->NationalId;

    $PhoneType = $client_data->PersonIdentifier->Phone[0]->PhoneType;
    $CompletePhoneNo = $client_data->PersonIdentifier->Phone[0]->CompleteNumber;


    if ($Gender == "M") {
        $gender = "Male";
    } else {
        $gender = "Female";
    }



    $postal_address = $LineOne . "-" . $PostalCode;

    if (substr($CompletePhoneNo, 0, 1) == 0) {
        $CompletePhoneNo = substr($CompletePhoneNo, 1);
        $phone_number = "254" . $CompletePhoneNo;
    }
    if ($Customer_ID == "") {
        echo "not_exists";
        exit;
    }

    if ($CustomerType != "INDI") {
        echo "not_individual";
    } else {
        ?>

        <fieldset>
            <legend> Personal Info</legend>
            <div class="col-lg-4">
                <label class="control-label" for="text">Select Title:</label>
                <select name="title" class="form-control">
                    <option>----Select Title-----</option>
                    <option value="Mr">Mr</option>
                    <option value="Mrs">Mrs</option>
                    <option value="Miss">Miss</option>
                    <option value="Hon">Hon</option>
                    <option value="Dr">Dr</option>
                    <option value="Prof">Prof</option>
                    <option value="Ms">Ms</option>
                </select>
                <input type="hidden" name="cif_id" id="cif_id" value="<?= $Customer_ID; ?>"/>
                <span class="help-block with-errors"></span>

                <div class="form-group required">
                    <label class="control-label" for="text">Other name:</label>
                    <input type="text" name="oname" class="form-control" id="oname" value=""
                           data-error="Name should not contain numerical values." required>
                    <span class="help-block with-errors"></span>

                </div>

                <div class="form-group required">
                    <label class="control-label" for="text">ID/Passport NO:</label>
                    <input type="text" name="nationalIdNo" pattern="[0-9]{8}" class="form-control" id="nationalIdNo"
                           value="<?= $nationalIdNo ?>"
                           data-error="ID NO should not contain characters." required>
                    <span class="help-block with-errors"></span>

                </div>

            </div>
            <div class="col-lg-4">

                <div class="form-group required">
                    <label class="control-label" for="text">Surname:</label>
                    <input type="text" name="LastName" pattern="[A-Za-z]{1,}" class="form-control" id="LastName"
                           value="<?= $LastName ?>"

                           data-error="Name should not contain numerical values." required>
                    <span class="help-block with-errors"></span>

                </div>
                <div class="form-group required">
                    <label class="control-label" for="text">Marital Status:</label>
                    <input type="text" name="MaritalStatus" pattern="[A-Za-z]{1,}" class="form-control"
                           id="MaritalStatus"
                           value="<?= $MaritalStatus ?>">
                </div>

            </div>
            <div class="col-lg-4">
                <div class="form-group required">
                    <label class="control-label" for="text">First name:</label>
                    <input type="text" name="FirstName" pattern="[A-Za-z]{1,}" class="form-control" id="FirstName"
                           value="<?= $FirstName; ?>"
                           data-error="Name should not contain numerical values." required>
                    <span class="help-block with-errors"></span>

                </div>

                <div class="form-group required">
                    <label class="control-label" for="text">Gender:</label>
                    <select name="gender" class="form-control">
                        <option value="">--Select gender--</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="form-group required">
                    <label class="control-label" for="text">Date Of Birth:</label>
                    <input type="text" name="dob" class="form-control" id="dob" value="<?= $BirthDate; ?>"
                           data-error="Please fill in the correct date." required="required"/>
                </div>

            </div>

        </fieldset>

        <fieldset
            style="border: solid #820210 2px; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px">
            <legend>Contact Information</legend>
            <div class="col-lg-4">

                <div class="form-group required">
                    <label class="control-label" for="text">Postal Address:</label>
                    <input type="text" name="postal_address" class="form-control" id="postal_address"
                           value="<?= $postal_address; ?>"
                           data-error="Invalid Postal address." required>
                    <span class="help-block with-errors"></span>

                </div>
                <div class="form-group required">
                    <label class="control-label" for="text">Country:</label>
                    <input type="text" name="country" pattern="[A-Za-z]{1,}" class="form-control" id="country"
                           value="<?= $CountryName; ?>">
                </div>

            </div>


            <div class="col-lg-4">

                <div class="form-group required">
                    <label class="control-label" for="text">Town:</label>
                    <input type="text" name="town" pattern="[A-Za-z]{1,}" class="form-control" id="town"
                           value="<?= $town ?>">
                </div>


                <div class="form-group required">
                    <label class="control-label" for="text">Mobile Number:</label>
                    <input type="text" name="mobile_no" pattern="[254|0]+[0-9]{9}" data-min-length="10"
                           data-max-length="13" placeholder="2547xxxxxxx" class="form-control" id="mobile_no"
                           value="<?= $CompletePhoneNo; ?>"
                           data-error="Please input the correct mobile number." required>
                    <span class="help-block with-errors"></span>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group required">
                    <label class="control-label" for="text">Physical location</label>
                    <input type="text" name="pLocation" pattern="[A-Za-z]{1,}" class="form-control" id="pLocation"
                           value="<?= $physicalAddress; ?>"
                           data-error="Location should not contain numerical values." required>
                    <span class="help-block with-errors"></span>

                </div>
                <div class="form-group required">
                    <label class="control-label" for="email">Email address</label>
                    <input class="form-control" name="email" id="email" type="email"
                           data-error="invalid email address" placeholder="example: email@email.com"
                           value="<?= $EmailAddress; ?>"
                           required>
                    <span class="help-block with-errors"></span>
                </div>

            </div>
        </fieldset>

        <fieldset
            style="border: solid #820210 2px; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px">
            <legend>Other Details</legend>
            <div class="col-lg-6">
                <div class="form-group required">
                    <label class="control-label" for="text">KRA PIN NO:</label>
                    <input type="text" name="pin_no" pattern="[A-Z|0-9|A-Z]{9}" class="form-control" id="pin_no"
                           value=""
                           data-error="Invalid pin no." required>
                    <span class="help-block with-errors"></span>

                </div>

                <div class="form-group required">
                    <label class="control-label" for="text">Taxable</label>
                    <select name="taxable" class="form-control">
                        <option value="">--Select Taxation</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>

                </div>

                <div class="form-group required">
                    <label class="control-label" for="text">Resident:</label>
                    <select name="resident" class="form-control">
                        <option value="">--Select Status</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>

                </div>

            </div>

            <div class="col-lg-6">
                <div class="form-group required">
                    <label class="control-label" for="text">Employment Status</label>
                    <select name="employment_status" class="form-control">
                        <option value="">--Select Status</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>

                <div class="form-group required">
                    <label class="control-label" for="text">Employer:</label>
                    <input type="text" name="employer" pattern="[A-Za-z]{1,}" class="form-control" id="employer"
                           value=""
                           data-error="Name should not contain numerical values." required>
                    <span class="help-block with-errors"></span>

                </div>
                <div class="form-group required">
                    <label class="control-label" for="text">Industry</label>
                    <select name="industry" class="form-control">
                        <option>----Select Industry-----</option>
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
        </fieldset>
        <div>
            <div class="form-group required">
                <div class="col-lg-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <input type="reset" class="btn btn-warning" name="reset" value="Reset">
                </div>
            </div>


        </div>

    <?php
    }
}

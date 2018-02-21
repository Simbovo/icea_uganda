<?php
/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 11/17/15
 * Time: 9:56 AM
 */

require('../app/Loader.php');
use app\application\library\commonFunctions;
use app\application\model\DbConnection;
use application\controller\memberController;

$cu_id = new commonFunctions();
$dbConnect = DbConnection::getInstance();
$memObj = new memberController();

foreach ($_POST as $key => $value) {
    $$key = $value;
}
$cifId = strip_tags($cifId);

/*
    * generate member number
* */
// Generate Guid


$member_no = $memObj->generateMemberNo();

$request_id = Req_UTS_ . $member_number;

/*
    *
    * check if member exists;
*/
try {
    $QryStr = "select * from members where comments = :comments";
    $stmt = $dbConnect->dbConn->prepare($QryStr);
    $stmt->bindparam(":comments", $cifId);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!empty($result)) {
        echo "member_exists";
    } else {
        //die("Allan Kemboi");
        $CuId = $cu_id->GuId();


        /*
            * initiate new request
            *
        */
        $xml_data = '<?xml version="1.0" encoding="UTF-8"?>
			<FIXML xsi:schemaLocation="http://www.finacle.com/fixml CustInq.xsd" xmlns="http://www.finacle.com/fixml" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
			<Header>
			<RequestHeader>
			<MessageKey>
			<RequestUUID>' . $request_id . '</RequestUUID>
			<ServiceRequestId>CustInq</ServiceRequestId>
			<ServiceRequestVersion>10.2</ServiceRequestVersion>
			<ChannelId>UTS</ChannelId>
			<LanguageId></LanguageId>
			</MessageKey>
			<RequestMessageInfo>
			<BankId>54</BankId>
			<TimeZone></TimeZone>
			<EntityId></EntityId>
			<EntityType></EntityType>
			<ArmCorrelationId></ArmCorrelationId>
			<MessageDateTime>2015-00-12T09:25:08.098</MessageDateTime>
			</RequestMessageInfo>
			<Security>
			<Token>
			<PasswordToken>
			<UserId></UserId>
			<Password></Password>
			</PasswordToken>
			</Token>
			<FICertToken></FICertToken>
			<RealUserLoginSessionId></RealUserLoginSessionId>
			<RealUser></RealUser>
			<RealUserPwd></RealUserPwd>
			<SSOTransferToken></SSOTransferToken>
			</Security>
			</RequestHeader>
			</Header>
			<Body>
			<CustInqRequest>
			<CustInqRq>
			<CustId>' . $cifId . '</CustId>
			</CustInqRq>
			</CustInqRequest>
			</Body>
			</FIXML>';

        //$URL = "http://10.1.5.46:7002/pipeline/unitmaster";
        $URL = "http://10.1.9.36:7001/pipeline/unitmaster";

        /**
         *
         * start Curl
         */
        $ch = curl_init($URL);
        curl_setopt($ch, CURLOPT_PORT, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(array('Content-Type: application/xml')));

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);

        $output = curl_exec($ch);

        curl_close($ch);


        $xml = simplexml_load_string($output);
        //die(print_r($xml));
        $token = $xml->TransToken;

        $bankId = $xml->Header->ResponseHeader->ResponseMessageInfo->BankId;
        $pCode = $xml->Body->CustInqResponse->CustIngs->CustIngAddrInfo->PostalCode;
        $address = $xml->Body->CustInqResponse->CustIngs->CustIngAddrInfo->AddrLine1;
        $country = $xml->Body->CustInqResponse->CustIngs->CustIngAddrInfo->Country;

        $accType = $xml->Body->CustInqResponse->CustIngs->EntityDocInfo->TypeCode;
        $docCode = $xml->Body->CustInqResponse->CustIngs->EntityDocInfo->DocCode;
        $phyAddress = $xml->Body->CustInqResponse->CustIngs->EntityDocInfo->PlaceOfIssue;


        $customerId = $xml->Body->CustInqResponse->CustInqRs->GenCustDtls->CustId;
        $phoneNum = $xml->Body->CustInqResponse->CustInqRs->CustPhoneEmailInfo->PhoneNum;
        $title = $xml->Body->CustInqResponse->CustInqRs->GenCustDtls->SalutationCode;

        $array = array(1, 2, 3, 4, 5);

        foreach ($array as $value) {
            $comType = $xml->Body->CustInqresponse->CustInqRs->GCustPhoneEmailInfo[$value]->PhoneEmailType;
            if ($comType = "COMMEML") {
                $email = $xml->Body->CustInqResponse->CustInqRs->CustPhoneEmailInfo[$value]->Email;
            }
        }

        $fName = $xml->Body->CustInqResponse->CustInqRs->RetailCustInfo->FirstName;
        $lName = $xml->Body->CustInqResponse->CustInqRs->RetailCustInfo->LastName;
        $oName = "-";

        $dob = $xml->Body->CustInqResponse->CustInqRs->RetailsCustInfo->BirthDt;
        $gender = ucfirst($xml->Body->CustInqResponse->CustInqRs->RetailCustInfo->Gender);
        $maritalStatus = $xml->Body->CustInqResponse->CustInqRs->RetailsCustInfo->MaritalStatusDesc;

        $idno = $xml->Body->CustInqResponse->CustInqRs->EntityDocInfo->UniqueId;

        //Do some combinations

        $pAddress = $address . "-" . $pCode;

        if (substr($phoneNum, 0, 1) == 0) { //check if the phone number starts with 0
            $phoneNum = substr($phoneNum, 1); //if it starts with zero remove the leading zero and then prefix with 	country code
        }
        $phone = "254" . $phoneNum;

        //Gender formatting
        $gender = substr($gender, 0, 1);
        if ($gender == "M") {
            $gender = "Male";
        } else {
            $gender = "Female";
        }

        $dob = substr($dob, 0, 10);
        $dob = date("d/m/Y", strtotime($dob));

        if ($customerId == "") {
            echo "not_exists";
        }

        if ($custType == 'INDIV') {
            //echo "indiv";
            ?>

            <form name="custConfirm" id="custConfirm" method="post" action="">
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

                <span class="help-block with-errors"></span>

                <div class="form-group required">
                    <label class="control-label" for="text">Other name:</label>
                    <input type="text" name="oname" class="form-control" id="oname" value="<? ?>"
                           data-error="Name should not contain numerical values." required>
                    <span class="help-block with-errors"></span>

                </div>

                <div class="form-group required">
                    <label class="control-label" for="text">ID/Passport NO:</label>
                    <input type="text" name="idno" pattern="[0-9]{8}" class="form-control" id="idno"
                           value="<?= $idNo ?>"
                           data-error="ID NO should not contain characters." required>
                    <span class="help-block with-errors"></span>

                </div>

            </div>
            <div class="col-lg-4">

                <div class="form-group required">
                    <label class="control-label" for="text">Surname:</label>
                    <input type="text" name="sname" pattern="[A-Za-z]{1,}" class="form-control" id="lname"
                           value="{$lnme}"

                           data-error="Name should not contain numerical values." required>
                    <span class="help-block with-errors"></span>

                </div>
                <div class="form-group required">
                    <label class="control-label" for="text">Marital Status:</label>
                    <input type="text" name="sname" pattern="[A-Za-z]{1,}" class="form-control" id="lname"
                           value="{$marital}">
                </div>

            </div>
            <div class="col-lg-4">
                <div class="form-group required">
                    <label class="control-label" for="text">First name:</label>
                    <input type="text" name="fname" pattern="[A-Za-z]{1,}" class="form-control" id="fname"
                           value="{$fname}"
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
                    <input type="text" name="dob" class="form-control" id="date" value="{$dob}"
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
                               value="{$addr}"
                               data-error="Invalid Postal address." required>
                        <span class="help-block with-errors"></span>

                    </div>
                    <div class="form-group required">
                        <label class="control-label" for="text">Country:</label>
                        <input type="text" name="sname" pattern="[A-Za-z]{1,}" class="form-control" id="lname"
                               value="{$country}">
                    </div>

                </div>

                </div>

                <div class="col-lg-4">

                    <div class="form-group required">
                        <label class="control-label" for="text">Town:</label>
                        <input type="text" name="sname" pattern="[A-Za-z]{1,}" class="form-control" id="lname"
                               value="{$town}">
                    </div>
                </div>

                <div>
                    <div class="form-group required">
                        <label class="control-label" for="text">Mobile NO:</label>
                        <input type="text" name="mobile_no" pattern="[+254|0]+[0-9]{9}" data-min-length="10"
                               data-max-length="13" placeholder="+254720000000" class="form-control" id="fname"
                               value="{$phone}"
                               data-error="Please input the correct mobile number." required>
                        <span class="help-block with-errors"></span>
                    </div>
                </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group required">
                        <label class="control-label" for="text">Physical location</label>
                        <input type="text" name="pLocation" pattern="[A-Za-z]{1,}" class="form-control" id="pLocation"
                               value="{$place}"
                               data-error="Location should not contain numerical values." required>
                        <span class="help-block with-errors"></span>

                    </div>
                    <div class="form-group required">
                        <label class="control-label" for="email">Email address</label>
                        <input class="form-control" name="email" id="email" type="email"
                               data-error="invalid email address" placeholder="example: email@email.com"
                               value="{$email}"
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

            </form>
        <?php

        }


    }
} catch (PDOException $ex) {
    echo $ex->getMessage();
}





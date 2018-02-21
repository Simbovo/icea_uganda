<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
  Get the  required files

 */
require('../app/Loader.php');

use app\application\library\commonFunctions;
use app\application\model\DbConnection;
use application\controller\memberController;

$data = new \application\controller\dataController();
$func = new commonFunctions();
$conn = DbConnection::getInstance();
$mem_obj = new memberController();

foreach ($_POST as $key => $value) {
    $$key = $value;
}
$accountNumber = $func->cleanInputs($account_number);
$member_number = $func->cleanInputs($member_number);


$xml_data = '<?xml version="1.0" encoding="UTF-8"?>
<FIXML xsi:schemaLocation="http://www.finacle.com/fixml AcctInq.xsd" xmlns="http://www.finacle.com/fixml" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
	<Header>
		<RequestHeader>
			<MessageKey>
				<RequestUUID>' . $request_id . '</RequestUUID>
				<ServiceRequestId>AcctInq</ServiceRequestId>
				<ServiceRequestVersion>10.2</ServiceRequestVersion>
				<ChannelId>UTS</ChannelId>
				<LanguageId/>
			</MessageKey>
			<RequestMessageInfo>
				<BankId>54</BankId>
				<TimeZone/>
				<EntityId/>
				<EntityType/>
				<ArmCorrelationId/>
				<MessageDateTime>2015-00-20T16:16:56.158</MessageDateTime>
			</RequestMessageInfo>
			<Security>
				<Token>
					<PasswordToken>
						<UserId/>
						<Password/>
					</PasswordToken>
				</Token>
				<FICertToken/>
				<RealUserLoginSessionId/>
				<RealUser/>
				<RealUserPwd/>
				<SSOTransferToken/>
			</Security>
		</RequestHeader>
	</Header>
	<Body>
		<AcctInqRequest>
			<AcctInqRq>
				<AcctId>
					<AcctId>' . $content . '</AcctId>
				</AcctId>
			</AcctInqRq>
		</AcctInqRequest>
	</Body>
</FIXML>';

$URL = "http://10.1.5.46:7002/pipeline/unitmaster";

/*
  set up curl for use with the url
 */

$ch = curl_init($URL);

curl_setopt($ch, CURL_POST, true);
curl_setopt($ch, CURL_HTTPHEADER, array('Content-Type: application/xml'));
curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLINFO_HEADER_OUT, true);

$output = curl_exec($ch);

curl_close($ch);

$result = simplexml_load_string($output);

$token = $result = Transtoken;

/*
  retrieve returned data
 */
$schemeCode = $result->Body->AcctIngResponse->AcctIngRs->Acctid->AcctType->SchmCode;
$BranchIdy = $result->Body->AcctInqResponse->AcctInqRs->AcctId->BankInfo->BranchId;
$bankacctstatus = $result->Body->AcctInqResponse->AcctInqRs->BankAcctStatusCode;
$acctschemetype = $xml->Body->AcctInqResponse->AcctInqRs->AcctId->AcctType->SchmType;
$acctCurr = $xml->Body->AcctInqResponse->AcctInqRs->AcctId->AcctCurr;

$member_name = $xml->Body->AcctInqResponse->AcctInqRs->CustId->PersonName->Name;
$cif = $xml->Body->AcctInqResponse->AcctInqRs->CustId->CustId;
$BalType = $xml->Body->AcctInqResponse->AcctInqRs->AcctBal[1]->BalType;
$amountValue = $xml->Body->AcctInqResponse->AcctInqRs->AcctBal[1]->BalType[1]->BalAmt->amountValue;

if (!iss_array($cif)) {
    echo "not_allowed";
    exit;
} else if ($member_name == "") {
    echo "exists";
    exit;
} else if ($cif <> $memCif) {
    echo "not_equal";
    exit;
} else if ($bankacctstatus == "D") {
    echo "dormant";
    exit();
} else if ($bankacctstatus == "I") {
    echo "inactive";
    exit();
} else if ($acctschemetype != "SBA" && $acctschemetype != "CAA") {
    echo "accounts_not_allowed";
} else {
    $prefix = 68;
    $branchCode = $prefix . "" . $BranchIdy;
    $branchname = $data->getBankBranches($branchCode);

    foreach ($cif as $value) {
        /*
         * initiate new request
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
            echo "not_registered";
            exit;
        } else {
            /*
             * @
              save member details to a temporary database table for use later
             */
            
        }
    }
}
        
	

				
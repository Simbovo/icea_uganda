<?php
/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 11/30/15
 * Time: 4:42 PM
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
$accountNumber = $func->cleanInputs($accountNumber);
$member_number = $func->cleanInputs($member_number);


$xml_data = '<?xml version="1.0" encoding="UTF-8"?>
<FIXML xsi:schemaLocation="http://www.finacle.com/fixml AcctInq.xsd" xmlns="http://www.finacle.com/fixml" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"><Header>
<RequestHeader>
<MessageKey>
<RequestUUID>' . $request_id . '</RequestUUID>
<ServiceRequestId>AcctInq</ServiceRequestId>
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
<MessageDateTime>2015-00-20T16:16:56.158</MessageDateTime>
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


$ch = curl_init($URL);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLINFO_HEADER_OUT, true);

$output = curl_exec($ch);

curl_close($ch);

$xml = simplexml_load_string($output);

$token = $xml->TransToken;

$SchmCode = $xml->Body->AcctInqResponse->AcctInqRs->AcctId->AcctType->SchmCode;
$BranchIdy = $xml->Body->AcctInqResponse->AcctInqRs->AcctId->BankInfo->BranchId;
$bankacctstatus = $xml->Body->AcctInqResponse->AcctInqRs->BankAcctStatusCode;
$acctschemetype = $xml->Body->AcctInqResponse->AcctInqRs->AcctId->AcctType->SchmType;
$acctCurr = $xml->Body->AcctInqResponse->AcctInqRs->AcctId->AcctCurr;

$member_name = $xml->Body->AcctInqResponse->AcctInqRs->CustId->PersonName->Name;
$cif = $xml->Body->AcctInqResponse->AcctInqRs->CustId->CustId;
$BalType = $xml->Body->AcctInqResponse->AcctInqRs->AcctBal[1]->BalType;
$amountValue = $xml->Body->AcctInqResponse->AcctInqRs->AcctBal[1]->BalType[1]->BalAmt->amountValue;


if ($member_name == "") {
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
    $branchCode = $prefix . $BranchIdy;
    $branchname = $data->getBankBranches($branchCode);
    $member_details = $mem_obj->getClientDetails($member_number);

    $member_no = $member_details->MEMBER_NO;
    $mem_name = $member_details->FULLNAMES;
    ?>
    <form class="inline" name="acct_registration" id="acc_registration" method="post" action="">
        <div class="row">
            <table class="table table-responsive">
            <thead>
            <tr>

                <td>Title: <input type="text" name="title" id-title </td>
            </tr>
            </thead>
            </table>
        </div>


    </form>
    <?php 

}
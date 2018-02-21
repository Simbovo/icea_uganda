<?php
//start up a session here by including the session class.

//here we initiate the login session for the users.global $amtvalue;
$host = "host=192.168.0.96";
$port = "port=5432";
$dbname = "dbname=unitmaster";
$credentials = "user=postgres password=Unit!@#$";
"set search_path to unitmaster,public";

$db = pg_connect("$host $port $dbname $credentials");
if (!$db) {
    echo "Error : Unable to open database\n";
} else {
    // echo "Opened database successfully\n";

//http://localhost:8080/UnitMaster_Mpesa_API/m_pesa.php?orig=1234&dest=254708000928&text=were&customer_id=222222&mpesa_code=WG45RTE&mpesa_msisdn=254722649199&mpesa_amt=6500&mpesa_sender=Daniel%20Mutiso&tstamp=5/4/2012&mpesa_acc=121212
    $orig = $_GET["orig"];
    $dest = $_GET["dest"];
    $tstamp = date('Y-m-d', strtotime($_GET["tstamp"]));
    $text = $_GET["text"];
    $customer_id = $_GET["customer_id"];
    $user = $_GET["user"];
    $pass = $_GET["pass"];
    $routemethod_id = $_GET["routemethod_id"];
    $routemethod_name = $_GET["routemethod_name"];
    $mpesa_code = $_GET["mpesa_code"];
    $mpesa_acc = $_GET["mpesa_acc"];
    $mpesa_msisdn = $_GET["mpesa_msisdn"];
    $mpesa_trx_date = $_GET["mpesa_trx_date"];
    $mpesa_trx_time = $_GET["mpesa_trx_time"];
    $mpesa_amt = $_GET["mpesa_amt"];
    $mpesa_sender = preg_replace('/[^A-Za-z0-9\. -]/', '', $_GET["mpesa_sender"]);
    $provider = 'Safaricom';

    if (isset($mpesa_msisdn)) {
        //$radValue = $databases->RandomString(9);
        $query = "select * from unitmaster.m_payment where receiptno=trim('$mpesa_code')";
        $result = pg_query($db, $query);
        $i = 0;
        while ($row = pg_fetch_object($result)) {
            //$refno= $row->REFNO;

            $i++;
        }
        // If no user/password combo exists return false
        if ($i != 1) {
            $date = new DateTime();
            $newdate = $date->format('Y-m-d');
            $newtime = $date->format('Y-m-d H:i:s');

            $query = "INSERT INTO unitmaster.M_PAYMENT (receiptno, TDATE, REGDATE, TRANSDET, AMTIN, telno, fullnames, acctno, FUND, svc_provider)
 							VALUES ('$mpesa_code','$tstamp','$newdate','$text','$mpesa_amt','$mpesa_msisdn','$mpesa_sender', '$mpesa_acc','$dest','$provider')";

            $result = pg_query($db, $query);

            if (!$result) {
                $message = 'Invalid query: ' . pg_last_error() . "\n";
                $message .= 'Whole query: ' . $query;
                die($message);
            } else {
                $sms = 'Dear ' . $mpesa_sender . ', you have successfully topped up your account with Kshs. ' . $mpesa_amt . ', your account will be updated soon';

                $query = "INSERT INTO unitmaster.OUT_GOING (TYPE_OF_ENQ, PHONE, SMSMSG,OPERATOR, T_DATE, T_TIME) VALUES ('M-Pesa','$mpesa_msisdn','$sms','$provider','$newdate','$newtime')";
                $result = pg_query($db, $query);
                if (!$result) {
                    $message = 'Invalid query: ' . pg_last_error() . "\n";
                    $message .= 'Whole query: ' . $query;
                    die($message);
                } else {
                    $message = 'Record posted successfully' . "\n";
                    $message .= 'and SMS sent';
                    echo $message;
                }
            }
        } else {
            $message = 'Error - Receipt number already exists' . "\n";
            die($message);
        }
    }
}
?>
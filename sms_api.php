<?php
/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 29/08/2016
 * Time: 13:13
 */

date_default_timezone_set('Africa/Nairobi');
$host = "host=192.168.0.96";
$port = "port=5432";
$dbname = "dbname=unitmaster";
$credentials = "user=postgres password=Unit!@#$";

$db = pg_connect("$host $port $dbname $credentials");
if (!$db) {
    die("Error - Unable to open connection");
} else {


//get client request
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $response_['ResponseCode'] = 'UM101';
        $response_['ResponseMessage'] = "The request format is not supported.";
        echo json_encode($response_);
        exit;
    } else {
        if (isset($_GET)) {
            $sms_text = strip_tags($_GET['SMSText']);
            $phone_number = strip_tags($_GET['GSM']);
            $LinkID = "";
            /**
             * set the auth params
             */
            $current_timestamp = date('YmdHis');
            $user_id = "asset";
            $password = "management";
            $AuthDetails['UserID'] = $user_id;
            $AuthDetails['Token'] = md5($user_id . "" . $password . "" . $current_timestamp);
            $AuthDetails['Timestamp'] = $current_timestamp;


            /**
             * Message payload
             */
            $message['Text'] = $sms_text;

            /**
             * Destination address of the message
             */
            $destination['MSISDN'] = $phone_number;
            $destination['LinkID'] = "";

            /**
             * Delivery Request
             */
            $QryStr = "SELECT nextval('unitmaster.correlator_seq')";
            try {
                $sth = pg_query($db, $QryStr);
                $sth_result = pg_fetch_row($sth);

                $id = $sth_result[0];
                if (strlen($id) == 1) {
                    $correlator = "0000000000" . $id;
                } elseif (strlen($id) == 2) {
                    $correlator = "000000000" . $id;
                } elseif (strlen($id) == 3) {
                    $correlator = "00000000" . $id;
                } elseif (strlen($id) == 4) {
                    $correlator = "0000000" . $id;
                } else if (strlen($id) == 5) {
                    $correlator = "000000" . $id;
                } else if (strlen($id) == 6) {
                    $correlator = "00000" . $id;
                } else if (strlen($id) == 7) {
                    $correlator = "0000" . $id;
                } else if (strlen($id) == 8) {
                    $correlator = "000" . $id;
                } else if (strlen($id) == 9) {
                    $correlator = "00" . $id;
                } else if (strlen($id) == 10) {
                    $correlator = "0" . $id;
                } else {
                    $correlator = $id;
                }
            } catch (PDOException $ex) {
                echo $ex->getMessage();
            }

            $delivery_request['EndPoint'] = 'http://client.cic.co.ke/unittrust/response.php';
            $delivery_request['Correlator'] = $correlator;

            $pay_load = array(
                'AuthDetails' => array($AuthDetails),
                'MessageType' => array('3'),
                'BatchType' => array('0'),
                'SourceAddr' => array('Sly'),
                'MessagePayload' => array($message),
                'DestinationAddr' => array($destination),
                'DeliveryRequest' => array($delivery_request)
            );

            $_serviceUrl = "http://197.248.4.47/smsapi/submit.php";

            $data_json = json_encode($pay_load, JSON_BIGINT_AS_STRING);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $_serviceUrl);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length: ' . strlen($data_json)));
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);


            $data = json_decode($response);

           return $data->MessageID;
        } else {

        }
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 22/06/2016
 * Time: 19:13
 */
require('../app/Loader.php');
use app\application\library\commonFunctions;
use app\application\model\DbHelper;

$dbh = new DbHelper();

$lib = new commonFunctions();


foreach ($_POST as $key => $value) {
    $$key = $value;
}

$selection = $lib->cleanInputs($selection);
if ($report_type == "transactions_report") {
    //process other selections
    switch ($selection) {
        case "pending":
            //do the query

            break;
        case "confirmed":
            //do the query
            break;
        case "cancelled":
            //do the query
            break;
        default:
            //do the query
    }
} else if ($report_type == "members_report") {
    //process other selection
    switch ($selection) {
        case "members":
            //do the query
            break;
        case "per_fund":
            //do the query
            break;
        default:
            //do ths call
    }
} else if ($report_type == "revenue_report") {
    //do this call
} else if ($report_type == "accounts_report") {
    //process other selections
    switch ($selection) {
        case "closed":
            //do the query
            break;
        default:
            //do this call
    }
} else {

}

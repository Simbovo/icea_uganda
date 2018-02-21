<?php
/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 9/22/15
 * Time: 11:11 AM
 */

session_start();
require_once('../app/Loader.php');

use application\controller\feedsController as FeedBack;
use app\application\library\commonFunctions;

$lib = new commonFunctions();
$feeds = new FeedBack();

$category = $_SESSION['category'];
$member_no = $_SESSION['ref_no'];

foreach ($lib->cleanInputs($_POST) as $key => $value) {
    $$key = $value;
}



$feedback = $feeds->saveFeedback($member_no, $category, $subject, $message);

if ($feedback) {
    echo "forwarded";
} else {
    echo "nforwarded";
}
?>
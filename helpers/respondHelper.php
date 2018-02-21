<?php
/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 10/22/15
 * Time: 4:38 PM
 */
session_start();
include('../app/Loader.php');
use application\controller\feedsController;

$feed = new feedsController();

$username = $_SESSION['username'];

$id = $_GET['id'];

foreach ($_POST as $key => $value) {
    $$key = $value;
}

$rs_respond = $feed->updateFeedbackResponse($username,$id,$response);

if ($rs_respond) {

    echo "success";
} else {
    echo "failed";
}
<?php
//session start
session_start();
//set expiration time for the session for each log in to ten minutes
$time_out = 1 * 5 * 60;

if (isset($_SESSION['LoggedIn'])) {
    if ($_SESSION['last_activity'] > time() - $time_out) {
        echo "true";
    }else{
        echo "false";
    }

}
$_SESSION['last_activity'] = time();


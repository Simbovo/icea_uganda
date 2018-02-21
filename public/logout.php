<?php
/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 9/13/15
 * Time: 1:09 PM
 */
session_start();
require('../app/Loader.php');

use application\controller\authController;


$logout = new authController();


$session_id = $_SESSION['session_id'];
$datey = new DateTime();
$time = $datey->format('d-M-Y  h:i:s a');


$logout->logout($time, $session_id);

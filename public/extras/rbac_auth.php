<?php
/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 31/10/2016
 * Time: 15:11
 */
session_start();
use application\library\PrivilegedUser;

$privilege = new PrivilegedUser();


if (isset($_SESSION['LoggedIn'])) {
    $u = PrivilegedUser::getByUsername($_SESSION['username']);
}



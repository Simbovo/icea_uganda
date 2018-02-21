<?php


use app\application\library\commonFunctions;
use application\controller\employeeController;

require('../app/Loader.php');

$lib = new commonFunctions();
$empl = new employeeController();

foreach ($_POST as $key => $value) {
    $$key = $value;
}

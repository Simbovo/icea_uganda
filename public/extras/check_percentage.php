<?php


require_once('../../vendor/autoload.php');
use application\controller\memberController;

$mem = new memberController();
/*$data = file_get_contents("php//input");
var_dump($data);
die;*/
$percentage = filter_var($data->percentage, FILTER_VALIDATE_INT);
$member_no = filter_var($data->member_no, FILTER_SANITIZE_STRING);

$result = $mem->calculate_percentage('300021', '67');
echo $result;
<?php
/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 9/15/15
 * Time: 11:52 PM
 */
require '../app/Loader.php';

//die(var_dump($_POST));
foreach ($_POST as $key => $value) {
    $$key = $value;
}
$fullname = $first_name . '' . $surname . '' . $othername;
$dob = date('d-M-Y', strtotime($dob));
$reg_date = date('d-M-Y');
/*echo $dob;
echo "</br>";

echo $reg_date;

$diff = strtotime($reg_date) - strtotime($dob);
echo "</br>";
echo "Age is". $diff;
 if($reg_date - $dob < 18){
     echo "age";
     exit;
 }*/
use application\controller\memberController as selfregister;

$client = new selfregister();

$result = $client->memberSelfRegister($title, $surname, $first_name, $othername, $fullname, $dob, $gender, $marital_status, $town, $id_no, $gsm_no,$email, $postal_address, $reg_date);

if ($result) {
    echo "registered";

} else {
    echo "failed";
}
?>
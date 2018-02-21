<?php

ini_set('max_execution_time', 7200);


$host = "host=192.168.0.96";
$port = "port=5432";
$dbname = "dbname=unitmaster";
$credentials = "user=postgres password=Unit!@#$";
require 'app/Loader.php';
use application\model\DbConnection;

$db_handle = DbConnection::getInstance();

$sqlFileToExecute = 'Accounts-1.sql';
if ($db_handle !== false) {
    // Load and explode the sql file 
    $f = fopen($sqlFileToExecute, "r+");
    $sqlFile = fread($f, filesize($sqlFileToExecute));
    $sqlArray = explode(';', $sqlFile);

    //Process the sql file by statements 
    foreach ($sqlArray as $stmt) {
        if (strlen($stmt) > 3) {
            try {
                $sth = $db_handle->dbConn->prepare($stmt);
                $result = $sth->execute();
                if (!$result) {
                    echo 'Data not uploaded successfully';
                }
            } catch (PDOException $ex) {
                echo $ex->getMessage();
            }
        }
    }
}
  
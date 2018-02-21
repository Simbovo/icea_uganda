<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//print_r(PDO::getAvailableDrivers());
ini_set('max_execution_time', 1200);
ini_set('memory_limit', '2048M');
/**
  First conection to firebird db
 */
define("DB_SERVER", "192.168.0.34:E:\Database\UNITTRUST.FDB");
define("DB_USER", "SYSDBA");
define("DB_PASS", "masterkey");

$conn_firebird = ibase_connect(DB_SERVER, DB_USER, DB_PASS);


/**
  connection to postgress
 */
$host = "host=192.168.0.96";
$port = "port=5432";
$dbname = "dbname=unitmaster";
$credentials = "user=postgres password=Unit!@#$";

$db = pg_connect("$host $port $dbname $credentials");
/* if (!$db) {
  echo "Error : Unable to open database\n";
  } else {
  echo "Opened database successfully\n";
  } */

$Qry1 = "SELECT TRANS_ID FROM trans_agent_comm";
$Qry2 = "SELECT TRANS_ID FROM unitmaster.trans_agent_comm";

$QryFb = ibase_query($conn_firebird, $Qry1);

while ($qryrs_firebird = ibase_fetch_row($QryFb)) {
    $fb_data[] = $qryrs_firebird[0];
}


$QryPg = pg_query($db, $Qry2);


while ($array_postgres = pg_fetch_row($QryPg)) {
    $pg_data[] = $array_postgres[0];
}

$result = array_diff($fb_data, $pg_data);



foreach ($result as $key => $val) {
    $stmt = "insert into missing values ($val)";
    $QryResult = ibase_query($conn_firebird, $stmt);
}




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

$QryFibs = "select trans_id from missing_two";

$QryFb = ibase_query($conn_firebird, $QryFibs);

while ($qryrs_firebird = ibase_fetch_row($QryFb)) {

    $sth = "SELECT
  TRANS_INTEREST.*
FROM
  TRANS_INTEREST
  INNER JOIN MISSING_TWO ON TRANS_INTEREST.TRANS_ID = MISSING_TWO.TRANS_ID";
    $rs = ibase_query($conn_firebird, $sth);

    while ($rs_vals = ibase_fetch_object($rs)) {
        $QryInsert = "INSERT INTO unitmaster.trans_interest(
            trans_id, trans_type, trans_date, member_no, full_name, account_no, 
            portfolio, amount, netamount, u_name, compname, tyear, tmonth, 
            i_rate, used, useddate, usedstaff, sysdate, tno, trans_no, 
            negotiatedamt, negotiatedrate) VALUES ('$rs_vals->trans_id', '$rs_vals->trans_type','$rs_vals->trans_date','$rs_vals->member_no',
            '$rs_vals->full_name', '$rs_vals->account_no', '$rs_val->portfolio', '$rs_vals->amount', '$rs_vals->net_amount', '$rs_vals->u_name', '$rs_vals->compname', 
             '$rs_vals->tyear', '$rs_vals->tmonth','$rs_vals->i_rate', '$rs_vals->used', '$rs_vals->useddate', '$rs_vals->usedstaff', '$rs_vals->sysdate', '$rs_vals->tno', '$rs_vals->trans_no',
            '$rs_vals->negotiatedamt', '$rs_vals->negotiatedrate')";


        $query_insert_pg = pg_query($db, $QryInsert);

        if ($query_insert_pg) {
            echo 'transacted';
        }
    }
}


foreach ($result as $key => $val) {
    //$stmt  = "insert into missing_two values ($val)";
    //$QryResult = ibase_query($conn_firebird, $stmt);
}




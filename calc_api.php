<?php
/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 03/01/2017
 * Time: 16:09
 */


$initial_deposit = $_GET['initial_deposit'];
$monthly_top_up = $_GET['monthly_top_up'];
$no_of_years = $_GET['no_yrs'];
$interest_rate = 0.1034; //divide by 100 to get percentage
$months = $no_of_years * 12;




$total_inv = $initial_deposit + ($monthly_top_up * $months);
/***
 *
 *
 * Compound interest for principal:
 * P(1+r/n)^(nt)
 * Future value of a series:
 * PMT * (((1 + r/n)^nt - 1) / (r/n)) * (1+r/n)
 *
 * Total = [ Compound interest for principal ] + [ Future value of a series ]
 * Total = [ P(1+r/n)^(nt) ] + [ PMT * (((1 + r/n)^nt - 1) / (r/n)) *(1+r/n)]
 * Total = [ 90000 (1 + 0.11 / 12) ^ 24 ] + [ 10000 * (((1 + 0.0091667)^24 - 1) / (0.0091667)) * (1+(0.11/12))]
 **28472091
 */


try {
    $CIFP = $initial_deposit * (pow((1+$interest_rate/12),$months));
    $FVOS = $monthly_top_up * (((pow((1+$interest_rate/12),$months))-1)/($interest_rate/12) *((1+$interest_rate/12)));

} catch (Exception $ex) {
    echo $ex->getMessage();
}

$gross_interest = ($CIFP + $FVOS) - $total_inv;
$with_tax = 0.15 * $gross_interest;
$net_interest = $gross_interest - $with_tax;
$total_projection = $total_inv + $net_interest;


$response = array("initial_amount" => $initial_deposit, "monthly_top_ups" => $monthly_top_up, "years" => $no_of_years,
    "interest_rate" => $interest_rate, "total_inv" => number_format($total_inv, 2, '.', ','), "projection" => number_format(($CIFP + $FVOS), 2, '.', ','),
    "wtax" => number_format($with_tax, 2, '.', ','),
    "gross_interest" => number_format($gross_interest, 2, '.', ','), "net_interest" => number_format($net_interest, 2, '.', ','),
    "total_projection" => number_format($total_projection, 2, '.', ','), "batch_one" => $CIFP, "batch_two" => $FVOS);


echo json_encode($response);


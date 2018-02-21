<?php
/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 12/16/15
 * Time: 10:18 AM
 */
require('../app/Loader.php');

/*
 *
 * require the classes to be used
 *
 */
use app\application\controller\agentController;
use app\application\controller\transactionController;
use app\application\library\commonFunctions;
use application\controller\companyController;
use application\controller\dataController;
use application\controller\memberController;

/*
 *
 * Initialize the objects
 *
 */
$dataObj = new dataController();
$obj = new transactionController();
$company = new companyController();
$member = new memberController();
$functions = new commonFunctions();
$agent = new agentController();

if (isset($_GET['accNo'])) {
    $accountNumber = $functions->decryptStringArray($_GET['accNo'], '7800');
    list($agentNo, $categoryCode, $memberNumber, $secCode) = explode('-', $accountNumber, 4);

    $sec_details = $dataObj->getSecurityDetails($secCode);
    $transactions = $obj->statement($accountNumber);
    $company_details = $company->getCompanyDetails();
    $memberDetails = $member->getClientDetails($memberNumber);
    $navs = $dataObj->getMaxByNavDate($secCode);
    $agent_details = $agent->agentDetails($agentNo);

    //die(var_dump($navs));
}


$test = new FPDF("P");
$test->Open();
$test->AddPage();

$test->Image('../assets/images/logo.png', 10, 10, 80, 30);

$test->SetFont('times', '', 9);
$test->setTextColor(150, 40, 60);
$test->Cell(130);
$test->Cell(130, 05, 'P.O Box: ' . $company_details->address, 'R');
$test->Ln();

$test->Cell(130);
$test->Cell(130, 05, $company_details->town, 'R');
$test->Ln();


$test->Cell(130);
$test->Cell(130, 06, 'Tel : ' . $company_details->tel_no, 'R');
$test->Ln();

$test->Cell(130);
$test->Cell(130, 06, 'Fax : ' . $company_details->fax, 'R');
$test->Ln();

$test->Cell(130);
$test->Cell(130, 06, $company_details->physical_add, 'R');
$test->Ln();

$test->Cell(130);
$test->Cell(130, 06, 'Email  : ' . $company_details->email, 'R');
$test->Ln();

$test->Cell(130);
$test->Cell(130, 06, 'Website: ' . $company_details->website, 'R');


$test->Ln();
$test->SetFont('times', 'BU', 10);
$test->setTextColor(05, 05, 05);
$test->Cell(45);
$test->Cell(30, 20, strtoupper($sec_details->descript) . '  ACCOUNT STATEMENT  ', 0, "C");

/* * **********************Display member Contact details ******************************************************************* */
$test->Ln();
$test->SetX(10);
$test->SetFont('times', '', 9);
$test->Cell(10, 06, $memberDetails->allnames, 'L');
$test->Cell(120);
$test->Cell(120, 05, 'Member NO: ' . $memberNumber, 'R');
$test->Ln();
$test->SetX(10);
$test->Cell(10, 06, 'P.O Box: ' . $memberDetails->post_address, 'L');
$test->Cell(120);
$test->Cell(120, 06, 'Account NO: ' . $accountNumber, 'R');
$test->Ln();
$test->SetX(10);
$test->Cell(10, 06, $memberDetails->town, 'L');
$test->Cell(120);
$test->Cell(120, 06, 'Statement Date: ' . date("D,d-M-Y", time()), 'R');
$test->Ln();
$test->SetX(10);
$test->Cell(10, 06, 'Mobile. No: ' . $memberDetails->gsm_no, 'L');
$test->Cell(120);
$test->Cell(120, 06, 'Agent Name: ' . $agent_details->agent_name, 'R');
$test->Ln();
$test->SetX(10);
$test->Cell(10, 06, 'Email Address: ' . $memberDetails->email, 'L');
/*$test->Ln();
$test->SetX(10);*/
//$test->Cell(170, 5, "_______________________________________________________________________________________________________________________");


/*
 * Query and Output Client Transactions
 *
 */

$test->Ln();
$test->SetX(10);
$test->SetFont('times', 'B', 9);
$test->Cell(200, 10, "                                           PURCHASES.                                                   SALES.                                                  BALANCE.");

$test->SetFillColor(197, 150, 12);
$test->SetTextColor(255, 255, 255);
$test->setFont("times", "B", 9);
$test->Ln();
$test->setXY(10, 110);
$test->Cell(15, 10, "R/NO:", 1, 0, "L", 1); // header fields
$test->Cell(20, 10, "DATE:", 1, 0, "L", 1);
$test->Cell(20, 10, "UNITS:", 1, 0, "L", 1);
$test->Cell(15, 10, "PRICE", 1, 0, "L", 1);
$test->Cell(25, 10, "COST:", 1, 0, "L", 1);
$test->Cell(20, 10, "UNITS:", 1, 0, "L", 1);
$test->Cell(15, 10, "PRICE", 1, 0, "L", 1);
$test->Cell(25, 10, "COST:", 1, 0, "L", 1);
$test->Cell(20, 10, "UNITS:", 1, 0, "L", 1);
$test->Cell(15, 10, "NAV", 1, 0, "L", 1);


$y = 120;
$x = 10;

$test->setXY($x, $y);

/* * ***************************Do the calculations for all the transactions************************************************************* */

if (is_array($transactions)) {
    $salestotals = 0;
    $purchasetotals = 0;
    $Tpurchaseunits = 0;
    $Tsoldunits = 0;
    $balance_units = 0;
    foreach ($transactions as $trans) {

        $trans_id = $trans->trans_id;
        $trans_date = date("d-m-Y", strtotime($trans->trans_date));
        $transtype = $trans->trans_type;

        if ($transtype == "PURCHASE") {
            $unitspurchased = $trans->noofshares;
            $purchaseprice = $trans->price;
            $purchasecost = $trans->amount;
            $unitssold = 0;
            $saleprice = 0;
            $salesamount = 0;
            $Tpurchaseunits = $Tpurchaseunits + $unitspurchased;
            $purchasetotals = $purchasetotals + $purchasecost;

        } elseif ($transtype == "WITHDRAWAL") {
            $unitspurchased = 0;
            $purchaseprice = 0;
            $purchasecost = 0;
            $unitssold = abs($trans->noofshares);
            $saleprice = $trans->nav;
            $salesamount = abs($trans->amount);
            $Tsoldunits = $Tsoldunits + $unitssold;
            $salestotals = $salestotals + $salesamount;
        }
        $balance_units = $Tpurchaseunits - $Tsoldunits;
        $test->SetFont('times', '', '9');
        $test->setTextColor(05, 05, 05);
        $test->Cell(15, 8, $trans_id, 1, 0, "R"); //outputting the selected data
        $test->Cell(20, 8, $trans_date, 1, 0, "C");
        $test->Cell(20, 8, number_format($unitspurchased), 1, 0, "R");
        $test->Cell(15, 8, number_format($purchaseprice, 2,'.'), 1, 0, "R");
        $test->Cell(25, 8, $functions->formatMoney($purchasecost, true), 1, 0, "R");
        $test->Cell(20, 8, number_format($unitssold), 1, 0, "R");
        $test->Cell(15, 8, $functions->formatMoney($saleprice, true), 1, 0, "R");
        $test->Cell(25, 8, $functions->formatMoney($salesamount, true), 1, 0, "R");
        $test->Cell(20, 8, number_format($balance_units), 1, 0, "R");
        $test->Cell(15, 8, number_format($trans->nav,2,'.'), 1, 0, "R");
        $y += 8;

        //Defining the next page break
        if ($y > 260) {
            $test->AddPage("P", "A4");
            $y = 40;
        }

        $test->setXY($x, $y);
    }
} else {
    echo("<script language='JavaScript'>
        window.alert('Sorry, No matching transactions found for this member, please try again later	.');
        window.close();
        </script>");
}
/* * ****************************Calculate the transactions Summary******************************************************************** */
$balance_units = number_format((float)$balance_units, 2, '.', '');
$market_value = $balance_units * number_format($navs->amount, 2, '.', '');
$market_value = number_format((float)$market_value, 2, '.', '');
$market_value = $english_format_number = number_format($market_value, 2); // do without formatting

$test->SetFillColor(250, 248, 250);
$test->SetFont('times', '', 9);
$test->Cell(35, 10, "Summation:", 1, 0, "L", 1);
$test->Cell(35, 10, $functions->formatMoney($Tpurchaseunits, true), 1, 0, "R", 1);
$test->Cell(25, 10, $functions->formatMoney($purchasetotals, true), 1, 0, "R", 1);
$test->Cell(35, 10, $functions->formatMoney($Tsoldunits, true), 1, 0, "R", 1);
$test->Cell(25, 10, $functions->formatMoney($salestotals, true), 1, 0, "R", 1);
$test->Cell(20, 10, $balance_units, 1, 0, "R", 1);
$test->Cell(15, 10, number_format((float)$navs->amount, 2, '.', ''), 1, 0, "R", 1);

/* * **********************************************Display the market Value of my fund************************************************************* */
$test->Ln();

$test->SetFont('times', '', '9');
$test->Cell(155, 10, "Closing as at " . date("D,d-M-Y", time()), 1);
$test->Cell(35, 10, $market_value, 1, 0, "R");

/***********************************************************Setting the footnote***************************************************/
/*$test->SetY(260);
//Arial italic 8
$test->SetFont('times', '', 8);
//date generated
$test->Cell(100, 10, "Generated on: " .  date("D,d-M-Y", time()));
//generated by
if(!$_SESSION['category'] == "customer"){
    $generated_by = $_SESSION['username'];
}  else {
    $generated_by = $memberDetails->allnames;
}
$test->Cell(100, 10, "Printed by: " . $generated_by);
// Page number
$test->Cell(0,10,'Page '.$test->PageNo().'',0,0,'C');*/
//
/* * **********************************************Set Doc Properties************************************************************* */
$test->SetAuthor('Allan Kiplagat Kemboi -WizGlobal Kenya');
$test->SetTitle('Transactions Statement ');

/* * ********************************************Outpput the results*************************************************************************** */
$name = $memberDetails->allnames . "_" . $sec_details->descript;
$filename = $name . "_Statement.pdf";
$test->Output($filename, 'I');

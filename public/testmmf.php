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
    $accountNumber = $_GET['accNo'];
    list($agentNo, $categoryCode, $memberNumber, $secCode) = explode('-', $accountNumber, 4);

    $sec_details = $dataObj->getSecurityDetails($secCode);
    $transactions = $obj->statement($accountNumber);
    $company_details = $company->getCompanyDetails();
    $memberDetails = $member->getClientDetails($memberNumber);
    $navs = $dataObj->getMaxNavDate($secCode);
    $agent_details = $agent->agentDetails($agentNo);
    // die(var_dump($agent_details));
}


$test = new FPDF("P");
$test->Open();
$test->AddPage();

$test->Image('../assets/images/EIBLogo.jpg', 10, 10, 60, 15);

$test->SetFont('times', 'B', 9);
$test->setTextColor(150, 40, 60);
$test->Cell(120);
$test->Cell(120, 05, 'P.O Box: ' . $company_details->ADDRESS, 'R');
$test->Ln();

$test->Cell(120);
$test->Cell(120, 05, $company_details->TOWN, 'R');
$test->Ln();

$test->Cell(120);
$test->Cell(120, 06, 'Fax    : ' . $company_details->FAX, 'R');
$test->Ln();

$test->Cell(120);
$test->Cell(120, 06, 'TEL NO : ' . $company_details->TEL_NO, 'R');
$test->Ln();

$test->Cell(120);
$test->Cell(120, 06, $company_details->PHYSICAL_ADD, 'R');
$test->Ln();

$test->Cell(120);
$test->Cell(135, 06, 'Email  : ' . $company_details->EMAIL, 'R');
$test->Ln();

$test->Cell(120);
$test->Cell(120, 06, 'Website: ' . $company_details->WEBSITE, 'R');


$test->Ln();
$test->SetFont('times', 'BU', 10);
$test->setTextColor(05, 05, 05);
$test->Cell(40);
$test->Cell(40, 20, strtoupper($sec_details->DESCRIPT) . '  ACCOUNT STATEMENT', 0, 'C');

/* * **********************Display member Contact details ******************************************************************* */
$test->Ln();
$test->SetX(10);
$test->SetFont('times', 'B', 9);
$test->Cell(10, 06, $memberDetails->ALLNAMES, 'L');
$test->Cell(120);
$test->Cell(120, 05, 'Member NO: ' . $memberNumber, 'R');
$test->Ln();
$test->SetX(10);
$test->Cell(10, 06, 'P.O Box: ' . $memberDetails->POST_ADDRESS, 'L');
$test->Cell(120);
$test->Cell(120, 06, 'Account NO: ' . $accountNumber, 'R');
$test->Ln();
$test->SetX(10);
$test->Cell(10, 06, $memberDetails->TOWN, 'L');
$test->Cell(120);
$test->Cell(120, 06, 'Statement Date: ' . date("D,d-M-Y", time()), 'R');
$test->Ln();
$test->SetX(10);
$test->Cell(10, 06, 'Telephone. No: ' . $memberDetails->GSM_NO, 'L');
$test->Cell(120);
$test->Cell(120, 06, 'Branch Name: ' . $agent_details->AGENT_NAME, 'R');
$test->Ln();
$test->SetX(10);
$test->Cell(15, 06, 'Email Address: ' . $memberDetails->E_MAIL, 'L');
$test->Ln();
$test->SetX(10);
$test->Cell(200, 5, "_______________________________________________________________________________________________________________________");


/*
 * Query and Output Client Transactions
 *
 */

$test->Ln();
$test->SetX(20);
$test->SetFont('Arial', 'B', 9);
$test->Cell(200, 10, "                 DETAILS.                                                           PURCHASES.                                                   SALES.                                                  BALANCE.");

$test->SetFillColor(197, 150, 12);
$test->SetTextColor(255, 255, 255);
$test->setFont("Arial", "B", "9");
$test->Ln();
$test->setXY(10, 120);
$test->Cell(15, 10, "R NO:", 1, 0, "L", 1); // header fields
$test->Cell(20, 10, "T DATE:", 1, 0, "L", 1);
$test->Cell(30, 10, "DEPOSIT:", 1, 0, "L", 1);
$test->Cell(30, 10, "INTEREST", 1, 0, "L", 1);
$test->Cell(30, 10, "WITHDRAWAL:", 1, 0, "L", 1);
$test->Cell(35, 10, "WITHHOLDING TAX:", 1, 0, "L", 1);
$test->Cell(35, 10, "RUNNING BALANCE", 1, 0, "L", 1);


$y = 130;
$x = 10;

$test->setXY($x, $y);

/* * ***************************Do the calculations for all the transactions************************************************************* */

if (is_array($transactions)) {
    $Tpurchaseamount = 0;
    $Tinterestamount = 0;
    $Twithdrawalamount = 0;
    $running_bal = 0;
    foreach ($transactions as $trans) {

        $trans_id = $trans->TRANS_ID;
        $trans_date = date("d-m-Y", strtotime($trans->TRANS_DATE));
        $transtype = $trans->TRANS_TYPE;

        if ($transtype == "PURCHASE") {
            $purchaseamount = $trans->AMOUNT;
            $interestamount = 0;
            $withdrawalamount = 0;
            $withholding_tax = abs($trans->TAXAMT);
            $Tpurchaseamount = $Tpurchaseamount + $purchaseamount;
        } elseif ($transtype == "WITHDRAWAL") {
            $purchaseamount = 0;
            $interestamount = 0;
            $withdrawalamount = abs($trans->AMOUNT);
            $withholding_tax = abs($trans->TAXAMT);
            $Twithdrawalamount = $Twithdrawalamount + $withdrawalamount;
        } elseif ($transtype == "INTEREST") {
            $purchaseamount = 0;
            $interestamount = $trans->AMOUNT;
            $withdrawalamount = 0;
            $withholding_tax = abs($trans->TAXAMT);

            $interestamount = $interestamount - $withholding_tax;


            $taxman = $taxman + $withholding_tax;
        }
        $Tinterestamount = ($Tinterestamount + $interestamount);
        $running_bal = ($Tpurchaseamount + $Tinterestamount) - $Twithdrawalamount;
        $test->SetFont('helvetica', '', '10');
        $test->setTextColor(05, 05, 05);
        //outputting the selected data
        $test->SetFont('times', '', '10');
        $test->setTextColor(05, 05, 05);
        $test->Cell(15, 8, $trans_id, 1);
        $test->Cell(20, 8, $trans_date, 1);
        $test->Cell(30, 8, number_format($purchaseamount), 1, 0, "R");
        $test->Cell(30, 8, $functions->formatMoney($interestamount, true), 1, 0, "R");
        $test->Cell(30, 8, $functions->formatMoney($withdrawalamount, true), 1, 0, "R");

        $test->Cell(35, 8, $functions->formatMoney($withholding_tax, true), 1, 0, "R");

        $test->Cell(35, 8, $functions->formatMoney($running_bal, true), 1, 0, "R");



        $y += 8;

        //Defining my page break
        if ($y > 260) {
            $test->AddPage("P", "A4");
            $y = 30;
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
$balance_units = number_format((float) $balance_units, 2, '.', '');
$market_value = $balance_units * number_format($navs->AMOUNT, 2, '.', '');
$market_value = number_format((float) $market_value, 2, '.', '');
$market_value = $english_format_number = number_format($market_value, 2); // do without formatting

$test->SetFillColor(250, 248, 250);
$test->Cell(35, 10, "SUMMATION:", 1, 0, "L", 1);
$test->Cell(30, 10, $functions->formatMoney($Tpurchaseamount, true), 1, 0, "R", 1);
$test->Cell(30, 10, $functions->formatMoney($Tinterestamount, true), 1, 0, "R", 1);
$test->Cell(30, 10, $functions->formatMoney($Twithdrawalamount, true), 1, 0, "R", 1);
$test->Cell(35, 10, $functions->formatMoney($taxman, true), 1, 0, "R", 1);
$test->Cell(35, 10, $functions->formatMoney($running_bal, true), 1, 0, "R", 1);



/* * **********************************************Display the market Value of my fund************************************************************* */
$test->Ln();
$test->SetX(10);
$test->SetFont('helvetica', '', '12');
$test->Cell(135, 15, "Market Value: as at " . date("D,d-M-Y", time()), 1);
$test->Cell(60, 15, $functions->formatMoney($running_bal, true), 1, 0, "R");

/* * *********************************************************Setting the footnote************************************************** */
/* $test->SetY(-15);
  //Arial italic 8
  $test->SetFont('Arial', 'I', 8);
  $test->Cell(120);
  $test->Cell(120,10, "Served by: " .$_SESSION['username']);
  $test->AliasNbPages();
 */
/* * **********************************************Set Doc Properties************************************************************* */
$test->SetAuthor('WizGlobal Kenya Limited-Allan Kemboi');
$test->SetTitle('Transactions Statement ');

/* * ********************************************Outpput the results*************************************************************************** */
$name = $memberDetails->ALLNAMES . "-" . $sec_details->DESCRIPT;
$filename = $name . " Statement.pdf";
$test->Output($filename, 'I');

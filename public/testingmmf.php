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
    $accountNumber = $functions->decrytpStringArray($_GET['accNo'],'7800');
    list($agentNo, $categoryCode, $memberNumber, $secCode) = explode('-', $accountNumber, 4);

    $sec_details = $dataObj->getSecurityDetails($secCode);
    $transactions = $obj->statement($accountNumber);
    $company_details = $company->getCompanyDetails();
    $memberDetails = $member->getClientDetails($memberNumber);
    $navs = $dataObj->getMaxNavDate($secCode);
    $agent_details = $agent->agentDetails($agentNo);
    
}


$test = new FPDF("L");
$test->Open();
$test->AddPage();

$test->Image('../assets/images/logo.jpg', 10, 8, 80);

$test->SetFont('helvetica', 'b', 12);
$test->setTextColor(150, 40, 60);
$test->Cell(175);
$test->Cell(185, 05, 'P.O Box: ' . $company_details->ADDRESS, 'R');
$test->Ln();

$test->Cell(175);
$test->Cell(175, 05, $company_details->TOWN, 'R');
$test->Ln();

$test->Cell(175);
$test->Cell(175, 06, 'Fax    : ' . $company_details->FAX, 'R');
$test->Ln();

$test->Cell(175);
$test->Cell(175, 06, 'TEL NO : ' . $company_details->TEL_NO, 'R');
$test->Ln();

$test->Cell(175);
$test->Cell(175, 06, $company_details->PHYSICAL_ADD, 'R');
$test->Ln();

$test->Cell(175);
$test->Cell(15, 06, 'Email  : ' . $company_details->EMAIL, 'R');
$test->Ln();

$test->Cell(175);
$test->Cell(175, 06, 'Website: ' . $company_details->WEBSITE, 'R');


$test->Ln(10);
$test->SetFont('helvetica', 'B', 14);
$test->setTextColor(05, 05, 05);
$test->Cell(90);
$test->Cell(30, 20, strtoupper($sec_details->DESCRIPT) . '  ACCOUNT STATEMENT  ', 0, "C");

/* * **********************Display member Contact details ******************************************************************* */
$test->Ln();
$test->SetX(20);
$test->SetFont('helvetica', '', 12);
$test->Cell(35, 06, $memberDetails->ALLNAMES, 'L');
$test->Cell(140);
$test->Cell(140, 05, 'Member NO: ' . $memberNumber, 'R');
$test->Ln();
$test->SetX(20);
$test->Cell(35, 06, 'P.O Box: ' . $memberDetails->POST_ADDRESS, 'L');
$test->Cell(140);
$test->Cell(140, 06, 'Account NO: ' . $accountNumber, 'R');
$test->Ln();
$test->SetX(20);
$test->Cell(35, 06, $memberDetails->TOWN, 'L');
$test->Cell(140);
$test->Cell(140, 06, 'Statement Date: ' . date("D,d-M-Y", time()), 'R');
$test->Ln();
$test->SetX(20);
$test->Cell(35, 06, 'Telephone. No: ' . $memberDetails->GSM_NO, 'L');
$test->Cell(140);
$test->Cell(140, 06, 'Agent Name: ' . $agent_details->AGENT_NAME, 'R');
$test->Ln();
$test->SetX(20);
$test->Cell(35, 06, 'Email Address: ' . $memberDetails->E_MAIL, 'L');
$test->Ln();
$test->SetX(20);
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
$test->setXY(20, 120);
$test->Cell(15, 10, "R NO:", 1, 0, "L", 1); // header fields
$test->Cell(20, 10, "T DATE:", 1, 0, "L", 1);
$test->Cell(25, 10, "UNITS:", 1, 0, "L", 1);
$test->Cell(20, 10, "PRICE", 1, 0, "L", 1);
$test->Cell(35, 10, "COST:", 1, 0, "L", 1);
$test->Cell(25, 10, "UNITS:", 1, 0, "L", 1);
$test->Cell(25, 10, "PRICE", 1, 0, "L", 1);
$test->Cell(25, 10, "COST:", 1, 0, "L", 1);
$test->Cell(30, 10, "UNITS:", 1, 0, "L", 1);
$test->Cell(30, 10, "Current NAV", 1, 0, "L", 1);


$y = 130;
$x = 20;

$test->setXY($x, $y);

/* * ***************************Do the calculations for all the transactions************************************************************* */

if (is_array($transactions)) {
    $salestotals = 0;
    $purchasetotals = 0;
    $Tpurchaseunits = 0;
    $Tsoldunits = 0;
    $balance_units = 0;
    foreach ($transactions as $trans) {

        $trans_id = $trans->TRANS_ID;
        $trans_date = date("d-m-Y", strtotime($trans->TRANS_DATE));
        $transtype = $trans->TRANS_TYPE;

        if ($transtype == "PURCHASE" || $transtype = "INTEREST") {
            $unitspurchased = $trans->NOOFSHARES;
            $purchaseprice = $trans->PRICE;
            $purchasecost = $trans->AMOUNT;
            $unitssold = 0;
            $saleprice = 0;
            $salesamount = 0;
            $Tpurchaseunits = $Tpurchaseunits + $unitspurchased;
            $purchasetotals = $purchasetotals + $purchasecost;

        } elseif ($transtype == "WITHDRAWAL") {
            $unitspurchased = 0;
            $purchaseprice = 0;
            $purchasecost = 0;
            $unitssold = abs($trans->NOOFSHARES);
            $saleprice = $trans->NAV;
            $salesamount = abs($trans->AMOUNT);
            $Tsoldunits = $Tsoldunits + $unitssold;
            $salestotals = $salestotals + $salesamount;
        }
        $balance_units = $Tpurchaseunits - $Tsoldunits;
        $test->SetFont('helvetica', '', '10');
        $test->setTextColor(05, 05, 05);
        $test->Cell(15, 8, $trans_id, 1,0,"R"); //outputting the selected data
        $test->Cell(20, 8, $trans_date, 1);
        $test->Cell(25, 8, number_format($unitspurchased), 1, 0, "R");
        $test->Cell(20, 8, $functions->formatMoney($purchaseprice, true), 1, 0, "R");
        $test->Cell(35, 8, $functions->formatMoney($purchasecost, true), 1, 0, "R");

        $test->Cell(25, 8, number_format($unitssold), 1, 0, "R");

        $test->Cell(25, 8, $functions->formatMoney($saleprice, true), 1, 0, "R");
        $test->Cell(25, 8, $functions->formatMoney($salesamount, true), 1,0,"R");
        $test->Cell(30, 8, number_format($balance_units), 1, 0, "R");
        $test->Cell(30, 8, $functions->formatMoney($navs->AMOUNT, true), 1,0,"R");

        $y += 8;

        //Defining my page break
        if ($y > 180) {
            $test->AddPage("L", "A4");
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
$balance_units = number_format((float)$balance_units, 2, '.', '');
$market_value = $balance_units * number_format($navs->AMOUNT, 2, '.', '');
$market_value = number_format((float)$market_value, 2, '.', '');
$market_value = $english_format_number = number_format($market_value, 2); // do without formatting

$test->SetFillColor(250, 248, 250);
$test->Cell(35, 10, "Summary:", 1, 0, "L", 1);
$test->Cell(45, 10, $functions->formatMoney($Tpurchaseunits, true), 1, 0, "R", 1);
$test->Cell(35, 10, $functions->formatMoney($purchasetotals, true), 1, 0, "R", 1);
$test->Cell(50, 10, $functions->formatMoney($Tsoldunits, true), 1, 0, "R", 1);
$test->Cell(25, 10, $functions->formatMoney($salestotals, true), 1, 0, "R", 1);
$test->Cell(30, 10, number_format($balance_units, 2, '.', ''), 1, 0, "R", 1);
$test->Cell(30, 10, $navs->AMOUNT, 1, 0, "R", 1);

/* * **********************************************Display the market Value of my fund************************************************************* */
$test->Ln();
$test->SetX(20);
$test->SetFont('helvetica', '', '12');
$test->Cell(190, 15, "Market Value: as at " . date("D,d-M-Y", time()), 1);
$test->Cell(60, 15, $market_value, 1, 0, "R");

/***********************************************************Setting the footnote***************************************************/
/*$test->SetY(-15);
        //Arial italic 8
        $test->SetFont('Arial', 'I', 8);
        $test->Cell(130);
        $test->Cell(130,10, "Served by: " .$_SESSION['username']);
$test->AliasNbPages();
*/
/* * **********************************************Set Doc Properties************************************************************* */
$test->SetAuthor('WizGlobal Kenya Limited');
$test->SetTitle('Transactions Statement ');

/* * ********************************************Outpput the results*************************************************************************** */
$name = $memberDetails->ALLNAMES . "-" . $sec_details->DESCRIPT;
$filename = $name . " Statement.pdf";
$test->Output($filename, 'I');

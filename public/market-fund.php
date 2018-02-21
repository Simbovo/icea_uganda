<?php

/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 10/23/15
 * Time: 9:16 AM
 */
require('../app/Loader.php');

use app\application\controller\transactionController;
use app\application\library\commonFunctions;
use application\controller\companyController;
use application\controller\dataController;
use application\controller\memberController;

$dataObj = new dataController();
$obj = new transactionController();
$company = new companyController();
$member = new memberController();
$functions = new commonFunctions();


if (isset($_GET['accNo'])) {
    $account_number = $functions->decryptStringArray($_GET['accNo'], '7800');
    list($agentNo, $category_code, $member_number, $sec_code) = explode('-', $account_number, 4);


    $sec_details = $dataObj->getSecurityDetails($sec_code);
    $transactions = $obj->statement($account_number);
    $company_details = $company->getCompanyDetails();
    $member_details = $member->getClientDetails($member_number);
    $interest = $obj->uncredited_interest($account_number);
    //die(var_dump($interest));
}


$statement = new FPDF();
$statement->Open();
$statement->AddPage('P', 'A4');


$statement->Image('../assets/images/logo.png', 10, 8, 40, 30);
$statement->ln();
$statement->setfont('times', '', 10);
$statement->cell(130);
$statement->cell(130, 05, 'P.O Box: ' . $company_details->address, 'r');
$statement->ln();
$statement->cell(130);
$statement->cell(130, 06, 'Fax    : ' . $company_details->fax, 'r');
$statement->ln();
$statement->cell(130);
$statement->cell(130, 06, 'Tel No : ' . $company_details->tel, 'r');
$statement->ln();
$statement->cell(130);
$statement->cell(130, 06, 'Email  : ' . $company_details->email, 'r');
$statement->ln();
$statement->cell(130);
$statement->cell(130, 06, 'Website: ' . $company_details->website, 'r');


$statement->ln(5);
$statement->setfont('times', '', 10);
$statement->cell(40, 20, strtoupper($sec_details->descript) . '  Account Statement   -- ', 0, 'C');


/* * **********************display member contact details ******************************************************************* */
$statement->ln();
$statement->setfont("times", '', 9);
$statement->cell(10, 05, $member_details->allnames, 'L');
$statement->cell(120);
$statement->cell(120, 05, 'Member No: ' . $member_number, 'R');
$statement->ln();
$statement->cell(10, 06, 'P.O Box: ' . $member_details->post_address, 'L');
$statement->cell(120);
$statement->cell(120, 06, 'Account No: ' . $account_number, 'R');
$statement->ln();
$statement->cell(10, 06, $member_details->town, 'L');
$statement->cell(120);
$statement->cell(120, 06, 'Statement Date: ' . date("D,d-m-y", time()), 'R');
$statement->ln();
$statement->cell(10, 06, 'Mobile No: ' . $member_details->gsm_no, 'L');
$statement->cell(120);
$statement->cell(120, 06);
$statement->ln();
$statement->cell(10, 06, 'Email Address: ' . $member_details->e_mail, 'L');
$statement->ln();
$statement->cell(200, 5, "************************************************************************************************************");

/* * **********************show the member transations******************************************************************* */

$statement->ln();
$statement->setfont('times', '', 9);
$statement->cell(200, 10, "     Details.                                 Purchases.                                    Sales.                                                  Balance.");

$statement->setfillcolor(197, 150, 12);
$statement->settextcolor(255, 255, 255);
$statement->setfont("times", "", "9");
$statement->setxy(10, 100);
$statement->cell(15, 10, "#:", 1, 0, "l", 1); // header fields
$statement->cell(20, 10, "Date:", 1, 0, "l", 1);
$statement->cell(30, 10, "Purchase:", 1, 0, "l", 1);
$statement->cell(30, 10, "Interest", 1, 0, "l", 1);
$statement->cell(30, 10, "Withdrawal:", 1, 0, "l", 1);
$statement->cell(35, 10, "Withholding Tax:", 1, 0, "l", 1);
$statement->cell(35, 10, "Running Balance", 1, 0, "l", 1);


$y = 110;
$x = 10;

$statement->setxy($x, $y);



/* * ***************************Do the calculations for all the transactions************************************************************* */

if (is_array($transactions)) {
    $Tpurchaseamount = 0;
    $Tinterestamount = 0;
    $Twithdrawalamount = 0;
    $running_bal = 0;
    $total_tax = 0;
    foreach ($transactions as $trans) {

        $trans_id = $trans->trans_id;
        $trans_date = date("d-m-Y", strtotime($trans->trans_date));
        $transtype = $trans->trans_type;

        if ($transtype == "PURCHASE") {
            $purchaseamount = $trans->amount;
            $interestamount = 0;
            $withdrawalamount = 0;
            $withholding_tax = abs($trans->taxamt);
            $Tpurchaseamount = $Tpurchaseamount + $purchaseamount;
        } elseif ($transtype == "WITHDRAWAL") {
            $purchaseamount = 0;
            $interestamount = 0;
            $withdrawalamount = abs($trans->amount);
            $withholding_tax = abs($trans->taxamt);
            $Twithdrawalamount = $Twithdrawalamount + $withdrawalamount;
        } elseif ($transtype == "INTEREST") {
            $purchaseamount = 0;
            $interestamount = $trans->amount;
            $withdrawalamount = 0;
            $withholding_tax = abs($trans->taxamt);

            $Tinterestamount = ($Tinterestamount + $interestamount);

            $total_tax = $total_tax + $withholding_tax;
        }
        //


        $running_bal = ($Tpurchaseamount + $Tinterestamount) - ($Twithdrawalamount + $total_tax);
        //outputting the selected data
        $statement->SetFont('times', '', '10');
        $statement->setTextColor(05, 05, 05);

        $statement->Cell(15, 8, $trans_id, 1);
        $statement->Cell(20, 8, $trans_date, 1);
        $statement->Cell(30, 8, number_format($purchaseamount), 1, 0, "R");
        $statement->Cell(30, 8, $functions->formatMoney($interestamount, true), 1, 0, "R");
        $statement->Cell(30, 8, $functions->formatMoney($withdrawalamount, true), 1, 0, "R");

        $statement->Cell(35, 8, $functions->formatMoney($withholding_tax, true), 1, 0, "R");

        $statement->Cell(35, 8, $functions->formatMoney($running_bal, true), 1, 0, "R");


        $y += 8;

        //Defining my page break
        if ($y > 260) {
            $statement->AddPage();
            $y = 40;
        }

        $statement->setXY($x, $y);
    }

    /*     * **************************Calculate the transactions Summary******************************************************************** */

//$statement->Ln();

    $statement->SetFillColor(250, 248, 250);
    $statement->Cell(35, 10, "SUMMATION:", 1, 0, "L", 1);
    $statement->Cell(30, 10, $functions->formatMoney($Tpurchaseamount, true), 1, 0, "R", 1);
    $statement->Cell(30, 10, $functions->formatMoney($Tinterestamount, true), 1, 0, "R", 1);
    $statement->Cell(30, 10, $functions->formatMoney($Twithdrawalamount, true), 1, 0, "R", 1);
    $statement->Cell(35, 10, $functions->formatMoney($total_tax, true), 1, 0, "R", 1);
    $statement->Cell(35, 10, $functions->formatMoney($running_bal, true), 1, 0, "R", 1);
    $statement->Ln();
    $statement->SetFillColor(250, 248, 250);
    $statement->Cell(160, 10, "UNCREDITED INTEREST:", 1, 0, "L", 1);
   
    $statement->Cell(35, 10, $functions->formatMoney($interest['interestamount'], true), 1, 0, "R", 1);
} else {
    echo("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Sorry, No matching transactions found for this member, please try again later	.')

        window.close();

        </SCRIPT>");
}


/* * **********************************************Set Doc Properties************************************************************* */
$statement->SetAuthor('WizGlobal Kenya Limited');
$statement->SetTitle('Transactions Statement ');

/* * ********************************************Outpput the results*************************************************************************** */

$filename = $member_no . "_" . date('d-m-Y') . "_transactions_statement.pdf";
$statement->Output($filename, 'I');


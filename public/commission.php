<?php

/**
 * Created by PhpStorm.
 * User: Allan Wiz
 * Date: 10/23/15
 * Time: 9:16 AM
 */
require('../app/Loader.php');

session_start();



use app\application\controller\transactionController;
use app\application\library\commonFunctions;
use application\controller\companyController;
use application\controller\dataController;
use application\controller\memberController;
use app\application\controller\agentController;

$dataObj = new dataController();
$obj = new transactionController();
$company = new companyController();
$member = new memberController();
$functions = new commonFunctions();
$agents = new agentController();

$agent_code = $_SESSION['ref_no'];

$start_date = $_SESSION['startDate'];
$end_date = $_SESSION['endDate'];

 $header = "AGENT SUMMARY STATEMENT OF ACCOUNT";
    $account_number = $functions->decryptStringArray($_GET['accNo'], '7800');
    list($agentNo, $category_code, $member_number, $sec_code) = explode('-', $account_number, 4);


    $sec_details = $dataObj->getSecurityDetails($sec_code);
    $transactions = $obj->agent_commission($agent_code, $start_date, $end_date);
    
    $company_details = $company->getCompanyDetails();
    $agent_details = $agents->agentDetails();



$statement = new FPDF();
$statement->Open();
$statement->AddPage('P', 'A4');


$statement->Image('../assets/images/logo.png', 10, 8, 50, 30);
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


$statement->ln(3);
$statement->setfont('times', '', 10);

$statement->cell(40, 20, ' ',  0, 'C');
$statement->ln();
$statement->setfont('times', 'B', 9);
$statement->cell(180, 10, "AGENT TRANSACTION REPORT BETWEEEN, ". date("D, d-m-Y", strtotime($start_date)). " AND " . date("D, d-m-Y", strtotime($end_date)), 1, 0, 'C');

/* * **********************display member contact details ******************************************************************* */
$statement->ln();
$statement->setfont("times", '', 9);
$statement->cell(10, 05, $agent_details->agent_name, 0,'L');
$statement->cell(120);
$statement->cell(120, 05, 'Agent Code: ' . $agent_code,  'R');
$statement->ln();
$statement->cell(10, 06, 'P.O Box: ' . $agent_details->post_address, 0, 'L');
$statement->cell(120);
$statement->cell(120, 06, 'Country: ' . $agent_details->country, 'R');
$statement->ln();
$statement->cell(10, 06, $agent_details->town, 0, 'L');
$statement->cell(120);
$statement->cell(120, 06, 'Statement Date: ' . date("D,d-m-y", time()), 'R');
$statement->ln();
$statement->cell(10, 06, 'Mobile No: ' . $member_details->gsm_no, 0, 'L');
$statement->cell(120);
$statement->cell(120, 06);
$statement->ln();
$statement->cell(10, 06, 'Email Address: ' . $agent_details->e_mail, 0, 'L');
$statement->ln();
$statement->cell(200, 5, "************************************************************************************************************");

/* * **********************show the member transations******************************************************************* */



$statement->setfillcolor(249,190,0);
$statement->settextcolor(255, 255, 255);
$statement->setfont("times", "", "9");
$statement->setxy(10, 100);
$statement->cell(15, 10, "MEMBER No:", 1, 0, "l", 1); // header fields
$statement->cell(120, 10, "MEMBER NAME:", 1, 0, "l", 1);
$statement->cell(25, 10, "FUND:", 1, 0, "l", 1);
$statement->cell(30, 10, "AMOUNT:", 1, 0, "l", 1);


$y = 110;
$x = 10;

$statement->setxy($x, $y);



/* * ***************************Do the calculations for all the transactions************************************************************* */

if (is_array($transactions)) {
    $total_commission = 0;   
    foreach ($transactions as $trans) {

        //outputting the selected data
        $statement->SetFont('times', '', '8');
        $statement->setTextColor(05, 05, 05);

        $statement->Cell(15, 8, $trans->member_no, 1, 0, "R");
        $statement->Cell(120, 8, $trans->allnames, 1, 0, "L");
        $statement->Cell(25, 8, $trans->descript, 1, 0, "L");
        $statement->Cell(30, 8, $functions->formatMoney($trans->commision, true), 1, 0, "R");

        $total_commission = $total_commission + $trans->commision;

        $y += 8;

        //Defining my page break
        if ($y > 260) {
            $statement->AddPage();
            $y = 40;
        }

        $statement->setXY($x, $y);
    }

    /*    Calculate the transactions summary */

        $with_holding_tax = 0.1 * $total_commission;
        $net_amount = $total_commission - $with_holding_tax;

    $statement->SetFillColor(250, 248, 250);
    $statement->SetFont('times', 'B', '12');
    $statement->Cell(160, 10, "SUMMATION:", 1, 0, "L", 1);
    $statement->Cell(30, 10, $functions->formatMoney($total_commission, true), 1, 0, "R", 1);

    //tax and net amount
    $statement->ln();
    $statement->SetFillColor(250, 248, 250);
    $statement->Cell(160, 10, "WITH HOLDING TAX:", 1, 0, "L", 1);
    $statement->Cell(30, 10, $functions->formatMoney($with_holding_tax, true), 1, 0, "R", 1);
    //
    $statement->ln();
    $statement->SetFillColor(250, 248, 250);
    $statement->Cell(160, 10, "NET AMOUNT:", 1, 0, "L", 1);
    $statement->Cell(30, 10, $functions->formatMoney($net_amount, true), 1, 0, "R", 1);

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

$filename = $agent_code . "_" . date('d-m-Y') . "_agent_statement.pdf";
$statement->Output($filename, 'I');


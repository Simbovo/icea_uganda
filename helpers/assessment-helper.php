<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
require '../app/Loader.php';

use app\application\library\commonFunctions;
use application\controller\risk;

$risk_ctl =  new risk();

$id = $_SESSION['id_no'];
$lib = new commonFunctions();

$question_count = 0;
foreach ($_POST as $key => $value) {

	$data['questionid'] = $key;
	$data['points'] = $value;

	$save_ans = $risk_ctl->save_answers(json_encode($data), $id);

	$question_count ++;

}
if($save_ans){
	$score_ = $risk_ctl->score_card($id , $question_count);
	$_SESSION['score'] = $score_;
	$response['code'] = "ok";
	$response['Message'] = "Successfully completed the risk assessment. Your scrore is ". $score_;
	$response['location'] = 'bank-info';

	echo json_encode($response);
}else{
	$response['code'] = "fail";
	$response['Message'] = "There was a technical error, please try again later";
	$response['location'] = '';
	
	echo json_encode($response);
}

<?php



require_once('../app/Loader.php');

use app\application\library\commonFunctions as Lib;
use application\controller\settingsController as settings;

$lib = new Lib();
$set = new settings();

$data =  json_decode($_POST['data']);

if($data->c_password != $data->password){
	$response['status'] = 'err_match';
	$response['message'] = 'Passwords do not match';
	echo json_encode($response);
}else{
//select from password history if password is associated with user
	$username = $lib->decryptStringArray($data->token, 'cicam0912');
	$pwd_history = $set->checkIfPwdExits(md5($data->password), $username);

	if($pwd_history){
		$response['status'] = 'existing';
		$response['message'] = 'You cannot re-use a password';
		echo json_encode($response);
	}else{

//change password here
		$password_change = $set->changePassword(md5($data->password), $username);
		if($password_change){
			$response['status'] = 'ok';
			$response['message'] = 'Passwords changed successfully';
			$response['url_location'] = '../index.php';
			echo json_encode($response);
		}	else{
			$response['status'] = 'fail';
			$response['message'] = 'technical error, password not changed';
			$response['url_location'] = '../index.php';
			echo json_encode($response);
		}

	}

}

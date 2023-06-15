<?php
// +------------------------------------------------------------------------+
// | @author        : Michael Arawole (HENT Technologies)
// | @author_url    : https://logad.net
// | @author_email  : henttech@gmail.com
// +------------------------------------------------------------------------+
// | Copyright (c) 2020 HENT Technologies. All rights reserved.
// +------------------------------------------------------------------------+

// +----------------------------+
// | User Actions Handler
// +----------------------------+

require '../../core/functions.php';

$app->onlyxhr();
$app->onlyadmin();

if (empty($_POST['edit_id']) || empty($_GET['action'])) {
	exit;
}
$response['code'] = 400;
$response['msg'] = "Error Occurred";
$action = $app->clean($_GET['action']);
$user_id = $app->clean($_POST['edit_id']);

// echo $action;
if(!is_numeric($user_id)){
	// return false;
}

if($action == "delete" || $action == "edit" || $action == "suspend"){
	if ($action == 'edit') {
		$user_id = $app->decrypt($app->clean($_POST['edit_id']));
	}
	$req = $app->user_actions($user_id, $action);
	if($req['status'] === true){
		$response['code'] = 200;
		$response['msg'] = $req['msg'];
	}
}

if($action == "delete_trans" || $action == "edit_trans" || $action == "update"){
	$req = $app->trans_actions($user_id, $action);
	if($req['status'] == true){
		$response['code'] = 200;
		$response['msg'] = $req['message'];
	}
}

if($action == "delete_crypto_trans" || $action == "edit_crypto_trans" || $action == "update_crypto"){
	// echo $user_id;
	$req = $app->crypto_trans_actions($user_id, $action);
	if($req['status'] == true){
		$response['code'] = 200;
		$response['msg'] = $req['message'];
	}
}

if($action == "delete_kyc" || $action == "update_kyc"){
	// echo $user_id;
	$req = $app->kyc_actions($user_id, $action);
	if($req['status'] == true){
		$response['code'] = 200;
		$response['msg'] = $req['message'];
	}
}

if($action == "delete_gift_pin" || $action == "create_gift_pin"){
    
    if($action == "create_gift_pin"){
        $gift_pin_code = $app->clean($_POST['Gift_Pin_Code']);
        $gift_pin_amount = $app->clean($_POST['gift_pin_amount']);
        $req = $app->create_gift_pin_actions($action,$gift_pin_code,$gift_pin_amount);
    	if($req['status'] == true){
    		$response['code'] = 200;
    		$response['msg'] = $req['message'];
    	}        	
    }
    
    if ($action == 'delete_gift_pin') {
    	$gift_id = $app->clean($_POST['edit_id']);
    	$req = $app->delete_gift_pin_actions($action,$gift_id);
    	if($req['status'] == true){
    		$response['code'] = 200;
    		$response['msg'] = $req['message'];
    	}
	}
}


echo json_encode($response);
exit;

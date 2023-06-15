<?php 
// +------------------------------------------------------------------------+
// | @author        : Michael Arawole (HENT Technologies)
// | @author_url    : https://logad.net
// | @author_email  : henttech@gmail.com
// +------------------------------------------------------------------------+
// | Copyright (c) 2020 HENT Technologies. All rights reserved.
// +------------------------------------------------------------------------+

// +----------------------------+
// | Ignored Items Handler
// +----------------------------+

require '../../core/functions.php';

$app->onlyxhr();
$app->onlyadmin();

if (empty($_POST['type']) || empty($_POST['item_id']) || empty($_GET['action'])) {
	exit;
}

$response['code'] = 400;
$response['msg'] = "Error Occurred";

$type = $app->clean($_POST['type']);
$item_id = $app->clean($_POST['item_id']);
$item_name = null;
$action = $app->clean($_GET['action']);

if($action == "disable"){
	if(empty($_POST['item_name'])) exit;
	$item_name = $app->clean($_POST['item_name']);
}

$req = $app->ignore_item($item_id,$item_name,$type,$action);
if($req['status'] === true){
	$response['code'] = 200;
	$response['msg'] = $req['msg'];
}
else{
	$response['code'] = 400;
	$response['msg'] = $req['msg'];
}

echo json_encode($response);
exit;
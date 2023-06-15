<?php 
// +------------------------------------------------------------------------+
// | @author        : Michael Arawole (HENT Technologies)
// | @author_url    : https://logad.net
// | @author_email  : henttech@gmail.com
// +------------------------------------------------------------------------+
// | Copyright (c) 2020 HENT Technologies. All rights reserved.
// +------------------------------------------------------------------------+

// +----------------------------+
// | Loan Action Handler
// +----------------------------+

require '../../core/functions.php';
if(empty($_POST['req_id'])){
	exit();
}

$app->onlyxhr();
$app->onlyadmin();

$req_id = $app->clean($app->decrypt($_POST['req_id']));
$action = $app->clean($_GET['action']);

if($action == "change_amount"){
	$newamount = $app->clean($_POST['new_amount']);
	$app->loan_action($req_id,$action,$newamount);
}
else{
	$app->loan_action($req_id,$action);
}
exit;
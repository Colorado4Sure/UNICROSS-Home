<?php
// +------------------------------------------------------------------------+
// | @author        : PopNaija Ent.
// | @author_url    : https://popnaija.net
// | @author_email  : info@pop9ja.com
// +------------------------------------------------------------------------+
// | Copyright (c) 2020 PopNaija Ent. All rights reserved.
// +------------------------------------------------------------------------+

// +----------------------------+
// | User Authentication Handler
// +----------------------------+

require '../../main/classes/user.class.php';

// $app->onlyxhr();

if (empty($_GET['trans_type'])) {
	http_response_code(400);
	exit;
}

$trans = $_GET['trans_type'];

if ($trans == "airtime") {
	// +----------------------------+
	// | AIRTIME HANDLER
	// +----------------------------+
	$app->buyAirtime();
}elseif ($trans == 'buy-data') {
	// +----------------------------+
	// | BUY DATA HANDLER
	// +----------------------------+
	$app->buyData();
}elseif ($trans == 'pay-bills') {
	// +----------------------------+
	// | PAYBILL HANDLER
	// +----------------------------+
	$app->pay_bill();
}
elseif ($trans == 'verify-bill') {
	// +----------------------------+
	// | VERIFY BILL CUSTOMER HANDLER
	// +----------------------------+
	$app->verify_bill();
}
elseif ($trans == 'send-money') {
	// +----------------------------+
	// | PAYBILL HANDLER
	// +----------------------------+
	$app->send_money();
}
elseif ($trans == 'request-money') {
	// +----------------------------+
	// | REQUEST MONEY HANDLER
	// +----------------------------+
	$app->request_money();
}
elseif ($trans == 'pay-money') {
	// +----------------------------+
	// | PAY REQUEST MONEY HANDLER
	// +----------------------------+
	$app->pay_money();
}
elseif ($trans == 'verify-account') {
	// +----------------------------+
	// | VERIFY ACCOUNT DETAILS
	// +----------------------------+
	$app->resolve_acc('', '');
}
elseif ($trans == 'virtual-withdraw') {
	// +----------------------------+
	// | VERIFY ACCOUNT DETAILS
	// +----------------------------+
	$app->virtual_withdraw();
}
elseif ($trans == 'withdraw-money') {
	// +----------------------------+
	// | WITHDRAW MONEY
	// +----------------------------+
	$app->withdraw();
}
elseif ($trans == 'deposit-crypto') {
	// +----------------------------+
	// | WITHDRAW MONEY
	// +----------------------------+
	$app->deposit_crypto();
}
elseif ($trans == 'send-crypto') {
	// +----------------------------+
	// | WITHDRAW MONEY
	// +----------------------------+
	$app->send_crypto();
}
elseif ($trans == 'swap-crypto') {
	// +----------------------------+
	// | WITHDRAW MONEY
	// +----------------------------+
	$app->swap_crypto();
}
elseif ($trans == 'page') {
	// +----------------------------+
	// | WITHDRAW MONEY
	// +----------------------------+
	if ($_POST['source'] == 'local-trans') {
		$app->history();
	}elseif ($_POST['source'] == 'crypto-trans') {
		$app->crypto_history();
	}

}
elseif ($trans == 'delete-card') {
	// +----------------------------+
	// | WITHDRAW MONEY
	// +----------------------------+
	$app->delete_cards();
}
elseif ($trans == 'create-card') {
	// +----------------------------+
	// | WITHDRAW MONEY
	// +----------------------------+
	$app->create_card();
}
elseif ($trans == 'freeze-card') {
	// +----------------------------+
	// | WITHDRAW MONEY
	// +----------------------------+
	$app->freeze_cards();
}
elseif ($trans == 'fund-card') {
	// +----------------------------+
	// | WITHDRAW MONEY
	// +----------------------------+
	$app->fund_card();
}
elseif ($trans == 'withdraw-from-card') {
	// +----------------------------+
	// | WITHDRAW MONEY
	// +----------------------------+
	$app->withdraw_from_card();
}
else{
	http_response_code(400);
	exit;
}

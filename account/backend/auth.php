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

if (empty($_GET['auth_type'])) {
	http_response_code(400);
	exit;
}

$auth = $_GET['auth_type'];

if ($auth == "login") {
	// +----------------------------+
	// | LOGIN HANDLER
	// +----------------------------+
	$app->login();
}
elseif ($auth == "register") {
	// +----------------------------+
	// | REGISTRATION HANDLER
	// +----------------------------+
	$app->register();
}
elseif ($auth == 'verify') {
  // +----------------------------+
	// | REGISTRATION HANDLER
	// +----------------------------+
	$app->verify();
}
elseif ($auth == 'forget-pass') {
  // +----------------------------+
	// | REGISTRATION HANDLER
	// +----------------------------+
	$app->forget_pass();
}
elseif ($auth == 'reset') {
  // +----------------------------+
	// | REGISTRATION HANDLER
	// +----------------------------+
	$app->reset_pass();
}
else{
	http_response_code(400);
	exit;
}

<?php
// +------------------------------------------------------------------------+
// | @author        : Michael Arawole (HENT Technologies)
// | @author_url    : https://logad.net
// | @author_email  : henttech@gmail.com   
// +------------------------------------------------------------------------+
// | Copyright (c) 2020 HENT Technologies. All rights reserved.
// +------------------------------------------------------------------------+

// +----------------------------+
// | Save Settings
// +----------------------------+
require '../../core/functions.php';

$app->onlyxhr();
$app->onlyadmin();

if (empty($_POST['save-type'])) {
	$data['code'] = 400;
	$data['msg'] = "Error occurred please recheck values";
	echo(json_encode($data));
}
else{
	$app->admin_save_site_settings($_POST);
}
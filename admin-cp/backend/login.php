<?php 
// +------------------------------------------------------------------------+
// | @author        : Michael Arawole (HENT Technologies)
// | @author_url    : https://logad.net
// | @author_email  : henttech@gmail.com
// +------------------------------------------------------------------------+
// | Copyright (c) 2020 HENT Technologies. All rights reserved.
// +------------------------------------------------------------------------+

// +----------------------------+
// | Admin Login Handler
// +----------------------------+

require '../../core/functions.php';

$app->onlyxhr();

$errorMSG="";

/* username */
if (empty($_POST["email"])) {
    $errorMSG .= "<li>Email is required!</<li>";
} else {
    $email = $app->clean($_POST["email"]);
}

/* PASS */
if (empty($_POST["password"])) {
    $errorMSG .= " - Password is required\n";
} else {
    $password = $app->clean($_POST["password"]);
}


if(empty($errorMSG)){
    $app->admin_login();
}

elseif(!empty($errorMSG)){
    echo json_encode(['code'=>404, 'msg'=>$errorMSG]);
    exit;
}

?>
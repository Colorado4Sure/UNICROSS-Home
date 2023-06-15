<?php
// +------------------------------------------------------------------------+
// | @author        : Michael Arawole (HENT Technologies)
// | @author_url    : https://logad.net
// | @author_email  : henttech@gmail.com
// +------------------------------------------------------------------------+
// | Copyright (c) 2020 HENT Technologies. All rights reserved.
// +------------------------------------------------------------------------+
require '../core/functions.php';
// require '../main/classes/user.class.php';

//ADMIN PANEL
if ($app->admin_logged_in() === false) {
    header("Location: $siteurl/admin-cp/login");
    exit;
}

// if(!$app->is_login()){
//     header("Location: /login");
//     exit;
// }

$user_id = $app->user_session();
$user = $app->user($user_id);
$stats = $app->admin_stats();

if (!empty($_GET['page'])) {
    $pager = strtolower($app->clean($_GET['page']));
    switch ($pager) {
        case "dashboard":
            $page = "Dashboard";
            $file = "index";
            break;

        case "change-log":
            $page = "Change Log";
            $file = "change-log";
            break;

            # Settings #
        case "site-settings":
            $page = "Site Settings";
            $file = "site-settings";
            break;
        case "general-settings":
            $page = "General Settings";
            $file = "general-settings";
            break;
        case "site-rates":
            $page = "Site Rates Settings";
            $file = "site-rates";
            break;

        case "payment-gateways":
            $page = "Payment Settings";
            $file = "payments-gateways";
            break;

        case "airtime-data-settings":
            $page = "Airtime - Data Settings";
            $file = "airtime-data-settings";
            break;

        case "loan-settings":
            $page = "Loan Settings";
            $file = "loan-settings";
            break;
        case "discounts":
            $page = "Discounts";
            $file = "discounts";
            break;

            # Users #
        case "manage-users":
            $page = "Manage Users";
            $file = "manage-users";
            break;

        case "manage-kyc":
            $page = "Manage KYC";
            $file = "kyc-lists";
            break;

        case "kyc-details":
            if (empty($_GET['sub'])) {
                header("Location: $siteurl/admin-cp");
            }
            $sub = $app->clean($_GET['sub']);
            $edit = $app->single_kyc($sub);
            $page = "Manage KYC";
            $file = "kyc-details";
            break;

        case "add-user":
            $page = "Add User";
            $file = "add-user";
            break;
        case "edit-user":
            if (empty($_GET['sub'])) {
                header("Location: $siteurl/admin-cp");
            }
            $sub = $app->clean($_GET['sub']);
            $edit = $app->user($sub);
            $page = "Edit User : " . $edit->name;
            $file = "edit-user";
            break;
        case "view-user":
            if (empty($_GET['sub'])) {
                header("Location: $siteurl/admin-cp");
            }
            $sub = $app->clean($_GET['sub']);
            $edit = $app->user($user_id);
            $page = "User Profile : " . $edit->name;
            $file = "user-profile";
            break;

            //TRANSACTIONS
        case "all-transactions":
            $page = "All Transactions";
            $file = "all-transactions";
            break;

            //TRANSACTIONS
        case "crypto-transaction":
            $page = "All Transactions";
            $file = "crypto-transactions";
            break;

        case "view-transaction":
            if (empty($_GET['sub'])) {
                header("Location: $siteurl/admin-cp");
            }
            $sub = $app->clean($_GET['sub']);
            $tranx = $app->single_transaction($sub, false);
            $u_user = $app->user($tranx->user_id);
            $page = "Edit Transaction for : " . $u_user->username;
            $file = "transaction";
            break;

        case "activities":
            $page = "All Activities";
            $file = "activities";
            break;

        case "index-crypto":
            $page = "Crypto Dashboard";
            $file = "index-crypto";
            break;

            # Airtime - Data #
        case "airtime-cash":
            $page = "Airtime to Cash";
            $file = "airtime-cash";
            break;

        case "manage-vtu":
            $page = "Manage Networks";
            $file = "manage-networks";
            break;
        case "manage-data-plans":
            $page = "Manage Data Plans";
            $file = "manage-data-plans";
            break;

        case 'profile':
            $page = "Profile";
            $file = "profile";
            break;

            # Bills #
        case "manage-bills":
            $page = "Manage Bills";
            $file = "manage-bills";
            break;
        case "add-bill":
            $page = "Add Bill";
            $file = "add-bill";
            break;

            # Loans #
        case "loan-requests":
            $page = "Loan Requests";
            $file = "loan-requests";
            break;
        case "approved-loans":
            $page = "Approved Loans";
            $file = "approved-loans";
            break;

            # Fake Users #
        case "fake-users":
            $page = "Fake Users";
            $file = "fake-users";
            break;
        case "site-backup":
            $page = "Site Backup";
            $file = "site-backup";
            break;

        case "ignored-items":
            $page = "Disabled/Ignored Items";
            $file = "ignored-items";
            break;

        case "mails":
            $page = "Inbox";
            $file = "mail";
            break;

        default:
            $page = "Under Construction";
            $file = "404";
            break;

        case "transit":
            $page = "Transit Account";
            $file = "transits";
            break;

        case "generate":
            $page = "Generate virtual account";
            $file = "generate";
            break;

        case "virtual-accounts":
            $page = "All Virtual Accounts";
            $file = "virtual-accounts";
            break;

        case "virtual-statement":
            if (empty($_GET['sub'])) {
                header("Location: $siteurl/admin-cp");
            }
            $sub = $app->clean($_GET['sub']);
            $tranx = $app->virtual_statement($sub);
            $page = "Account Statement";
            $file = "virtual-statements";
            break;
            
        case "gift-pins":
            $page = "Ditepay Gift Pins";
            $file = "gift-pin";
            break;
                        
        case "create-gift-pin":
            $page = "Create Ditepay Gift Pin";
            $file = "create-gift-pin";
            break;
            
    }
} else {
    $page = "Dashboard";
    $file = "index";
}
if (empty($page) || empty($file) || !file_exists("layouts/$file.php")) {
    $page = "404 - Page not found";
    $file = "404";
}

include 'layouts/head.phtml';
include 'layouts/nav.phtml';
include 'layouts/top.phtml';
include 'layouts/' . $file . ".php";
include 'layouts/footer.phtml';

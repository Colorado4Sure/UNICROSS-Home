<?php
// +------------------------------------------------------------------------+
// | @author        : Wednesday (PopNaija Ent)
// | @author_url    : https://popnaija.net
// | @author_email  : info@pop9ja.com
// +------------------------------------------------------------------------+
// | Copyright (c) 2020 HENT Technologies. All rights reserved.
// +------------------------------------------------------------------------+
date_default_timezone_set("Africa/Lagos");
require '../main/classes/user.class.php';

if (!$app->is_login()) {
    header("Location: /UNICROSS/login");
    exit;
}
// $user_id = $app->user_session();
// $user = $app->user($user_id);

if (!empty($_GET['page'])) {
    $pager = strtolower($_GET['page']);
    switch ($pager) {

        case "twotrade":
            $page = "p2p trade";
            $file = "twotrade";
            break;

        case "pay-bills":
            $page = "Pay Bills";
            $file = "paybills";
            break;

        case "txn-history":
            $page = "Transaction Details";
            $file = "txn.history";
            break;

        case 'transactions':
            $page = "All Transactions";
            $file = "transactions";
            break;

            // case 'crypto-transactions':
            //     $page = "Crypto Transactions";
            //     $file = "crypto-transactions";
            //     break;

            // case 'crypto-history':
            //     $page = "Transactions History";
            //     $file = "crypto.tnx.history";
            //     break;

        case 'vtu_services':
            $page = "VTU Services";
            $file = "vtu_services";
            break;
        case 'send-confirmation':
            $page = "Send to Wallet";
            $file = "send-confirmation";
            break;
        case 'fund-account':
            $page = "Send to Account";
            $file = "send-account";
            break;
        case 'profile':
            $page = "Profile";
            $file = "profile";
            break;
        case 'my-wallet':
            $page = "My Wallet";
            $file = "wallet";
            break;
        case 'deposit':
            $page = "Deposit";
            $file = "deposit";
            break;
        case 'referrals':
            $page = "Referrals";
            $file = "referrals";
            break;

        case 'pay-money-request':
            $page = "Pay Money Request";
            $file = "pay-money-request";
            break;

            // case 'crypto-index':
            //     $page = "Crypto Index";
            //     $file = "crypto-index";
            //     break;

        case 'swap':
            $page = "Currency Swap";
            $file = "swap";
            break;

        case 'request-loan':
            $page = "Request Loan";
            $file = "request-loan";
            break;
        case 'payback-loans':
            $page = "Payback Loans";
            $file = "payback-loan";
            break;

        case 'request-money':
            $page = "Request Money";
            $file = "requestmoney";
            break;

        case 'fund-requests':
            $page = "Fund Requests";
            $file = "fundrequests";
            break;
        case 'account-statement':
            $page = "Account Statement";
            $file = "account-statement";
            break;

        case "complete-loan":
            $page = "Complete Loan";
            $file = "complete-loan";
            break;

        case "withdraw":
            $page = "Withdraw Money";
            $file = "withdraw";
            break;

        case "maintenance":
            $page = "Site under maintenance";
            $file = "maintenance";
            break;

        case "cards":
            $page = "Credit / Debit Cards";
            $file = "cards";
            break;

        case "card":
            $page = "Card Details";
            $file = "card";
            break;

        case 'add-card':
            $page = "Add Credit / Debit Card";
            $file = "add-card";
            break;

        case 'settings':
            $page = "Site Settings";
            $file = "settings";
            break;

        case 'notifications':
            $page = "Notifications";
            $file = "notification";
            break;

        case 'notification-details':
            $page = "Notification Details";
            $file = "notify-history";
            break;

        case "api":
            $page = "Developers API";
            $file = "api";
            break;

        case "coming":
            $page = "Coming Soon";
            $file = "app-coming";
            break;

        case "savings":
            $page = "Savings Dashboard";
            $file = "savings";
            break;

        case "notify":
            $page = "Notify";
            $file = "notify";
            break;

        case "send":
            $page = "send";
            $file = "send";
            break;
    }
} else {
    $page = "Dashboard";
    $file = "index";
}
// if($site->site_maintenance == 1){
//     $page = "Site under maintenance";
//     $file = "maintenance";
// }
if (empty($page) || empty($file) || !file_exists("layout/$file.php")) {
    $page = "404 - Page not found";
    // $file = "app-404";
    include 'layout/app-404.phtml';
} else {
    // code...
    include 'layout/head.phtml';
    include 'layout/top.phtml';
    // include 'layout/nav.phtml';
    include 'layout/' . $file . ".php";
    include 'layout/footer.phtml';
}

<?php
// +------------------------------------------------------------------------+
// | @author        : Colorado4Sure (PopNaija Ent.)
// | @author_url    : https://popnaija.net
// | @author_email  : support@pop9ja.com
// +------------------------------------------------------------------------+
// | Copyright (c) 2022 PopNaija Ent. All rights reserved.
// +------------------------------------------------------------------------+

// +----------------------------+
// | Deposit Handler
// +----------------------------+

require '../../main/classes/user.class.php';

if (isset($_GET['payload'])) {
  if (isset($_GET['user'])) {

    // Paystack Payment Method
    if (isset($_GET['method']) && $_GET['method'] == 'paystack') {
      
      echo '<h1> Paystack Gateway is not supported at the moment! </h1>';
      echo '<br><button onclick="history.back()">Back</button>';
      Return;
      $url = "https://api.paystack.co/transaction/initialize";
      $fields = [
        'email' => $_GET['user'],
        'amount' => $_GET['amount'] * 100,
        'reference' => $_GET['payload']
      ];
      $fields_string = http_build_query($fields);
      //open connection
      $ch = curl_init();

      //set the url, number of POST vars, POST data
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Authorization: Bearer sk_live_bf9bb9c402757d4259159d38616b6bce535b80e2",
        "Cache-Control: no-cache",
      ));

      //So that curl_exec returns the contents of the cURL; rather than echoing it
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

      //execute post
      $result = curl_exec($ch);

      $result = json_decode($result);
      if ($result->status == true) {
        header('location: ' . $result->data->authorization_url . '?payload=' . $_GET['payload']);
      }

      // FLUTTERWAVE Payment Method
    } elseif (isset($_GET['method']) && $_GET['method'] == 'flutterwave') {

      $url = "https://api.flutterwave.com/v3/payments";

      $fields = json_encode([
        'amount' => $_GET['amount'],
        'tx_ref' => $_GET['payload'],
        'currency' => "NGN",
        'redirect_url' => $app->siteurl.'account/backend/deposit/?payload=' . $_GET['payload'].'&method='.$_GET['method'],
        'customer' => [
          'email' => $_GET['user'],
        ],
      ]);
      
      //open connection
      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.flutterwave.com/v3/payments',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $fields,
        CURLOPT_HTTPHEADER => array(
          'Authorization: Bearer FLWSECK-5ad8779af42984a87bd098aa2a7748eb-X',
          'Content-Type: application/json'
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);

      $res = json_decode($response);

      if ($res->status == 'success') {
        $link = $res->data->link;
        echo $link;
        header('Location: ' . $link);
      } else {
        echo 'We can not process your payment';
      }

    }
  } else {
    if (isset($_GET['method']) && $_GET['method'] == 'paystack')
      $_GET['trxref'] = $_GET['trxref'];
    else
      $_GET['trxref'] = $_GET['transaction_id'];

    $depo = $app->deposit_callback($_GET['trxref'], $_GET['method']);
    if ($depo->status == true) {
      echo "<h1>" . $depo->message . '</h1>';
      header("refresh:2;");
      echo "<script>window.close();</script>";
    } else {
      echo "<h1>" . $depo->message . '</h1>';
      header("refresh:2; url=".$app->siteurl."account");
    }
  }
} else {
  $app->deposit();
}

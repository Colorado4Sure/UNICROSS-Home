<?php

/**
 * User class all validated classes
 */
// return die("<h1>Site is down for maintenance <h1>");
date_default_timezone_set("Africa/Lagos");
class User
{
  public function __construct()
  {
    require 'config.php';
    $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
    $this->con = $mysqli;
    $this->site_url = 'http://localhost:8080/api/';
    $this->x_access_token = '';
    $this->msg = '';
    $this->siteurl = 'http://localhost/UNICROSS/';
    $this->notifyApiKey = 'AAAAgZfTLbc:APA91bH8Au9lI2XeNRCRjgLzbKReBkwX1gB8zDx1-dp9199e9E4MtPSH9vKp-imWeQTa5PBp8uDHJm9e7PFvWQK9Rnt5X8gKX95UKn3DNRZpbm18X0eSWgXMzkwC3oaSNcXOWW3qFfl5';
  }


  public function site_settings()
  {
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => $this->site_url . 'settings',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    echo $response;
    // return json_decode($response);
  }

  public function site_settings1()
  {
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => $this->site_url . 'settings',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    // echo $response;
    return json_decode($response);
  }

  ////////////////////////////////////
  // Registration Card Starts here
  ////////////////////////////////////
  public function register()
  {
    $errorMSG = "";
    /* FIRST NAME */
    if (empty($_POST["fname"])) {
      $errorMSG .= "<li>First Name is required!</li><br>";
    } else {
      $fname = $_POST["fname"];
    }

    /* LAST NAME */
    if (empty($_POST["lname"])) {
      $errorMSG .= "<li>Last Name is required!</li><br>";
    } else {
      $lname = $_POST["lname"];
    }

    /* USERNAME */
    if (empty($_POST["username"])) {
      $errorMSG .= "<li>Username is required!</li><br>";
    } else {
      $user = $_POST["username"];
      $user = str_replace(" ", null, $user);
    }

    /* EMAIL */
    if (empty($_POST["email"])) {
      $errorMSG .= "<li>Email is required</li>";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
      $errorMSG .= "<li>Invalid email format</li><br>";
    } else {
      $email = $_POST["email"];
    }

    /* USERNAME */
    if (empty($_POST["phone"])) {
      $errorMSG .= "<li>Phone number is required!</li><br>";
    } else {
      $phone = $_POST["phone"];
    }

    /* PASS */
    if (empty($_POST["password"])) {
      $errorMSG .= "<li>Password is required!</li><br>";
    } else {
      $pass = $_POST["password"];
    }
    /* R PASS */
    if (empty($_POST["repeat_password"])) {
      $errorMSG .= "<li>Passwords must be identical</li><br>";
    } else {
      $rpass = $_POST["repeat_password"];
    }
    if (!empty($pass) && !empty($rpass) && $pass != $rpass) {
      $errorMSG .= "Passwords don't match";
    }

    // $pass = password_hash($pass, PASSWORD_DEFAULT);

    if (empty($errorMSG)) {
      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => $this->site_url . 'auth/signup',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'firstname=' . $fname . '&lastname=' . $lname . '&username=' . $user . '&email=' . $email . '&phone=' . $phone . '&password=' . $pass,
      ));

      $response = curl_exec($curl);

      curl_close($curl);
      $response = json_decode($response);
      echo json_encode(['status' => $response->status, 'msg' => $response->message, 'url' => 'verify']);
    } elseif (!empty($errorMSG)) {
      echo json_encode(['status' => false, 'msg' => $errorMSG]);
      exit;
    }
  }

  /////////////////////////////////////
  // Account Verification
  ////////////////////////////////////

  public function verify()
  {

    $errorMSG = "";
    /* VERIFY CODE */
    if (empty($_POST["code"])) {
      $errorMSG .= "Verification code is required!";
    } elseif (!filter_var($_POST["code"], FILTER_VALIDATE_INT)) {
      $errorMSG .= "<li>Invalid code format</li>";
    } else {
      $code = $_POST["code"];
    }

    if (empty($errorMSG)) {
      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => $this->site_url . 'auth/verify',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'verify_code=' . $code,
      ));

      $response = curl_exec($curl);

      curl_close($curl);
      $response = json_decode($response);
      echo json_encode(['status' => $response->status, 'msg' => $response->message, 'url' => 'account']);
    } elseif (!empty($errorMSG)) {
      echo json_encode(['code' => 404, 'msg' => $errorMSG]);
      exit;
    }
  }

  //KYC VERIFY
  public function verify_KYC()
  {
    $errorMSG = '';
    if (empty($_POST["doc_type"])) {
      $errorMSG .= "Document type is required! <br>";
    } else {
      $doc_type = $_POST["doc_type"];
    }

    if (empty($_POST["doc_id"])) {
      $errorMSG .= "Document number is required! <br>";
    } else {
      $doc_id = $_POST["doc_id"];
    }

    // if (empty($_FILE["document"])) {
    //     $errorMSG .= "Please upload a document! <br>";
    // }

    $target_dir    = "../uploads/kyc/";
    $target_file   = $target_dir . basename($_FILES["document"]["name"]);
    $uploadOk      = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $file_fullName = basename($_FILES["document"]["name"]);

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["document"]["tmp_name"]);
    if ($check !== false) {
      // $errorMSG .= "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
    } else {
      $errorMSG .= "Please upload a valid file type.";
      $uploadOk = 0;
    }

    // Check file size
    // if ($_FILES["document"]["size"] > 500000) {
    //   $errorMSG .= "Sorry, your file is too large.";
    //   $uploadOk = 0;
    // }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != 'pdf') {
      $errorMSG .= "Invalid File type, only JPG, JPEG, PNG & PDF files are allowed.";
      $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      $errorMSG .= "There was an error with your upload.";
      // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["document"]["tmp_name"], $target_file)) {
        // echo "The file ". htmlspecialchars( basename( $_FILES["document"]["name"])). " has been uploaded.";
      } else {
        $errorMSG .= "Sorry, there was an error uploading your document.";
      }
    }

    if (empty($errorMSG)) {
      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => $this->site_url . 'kyc',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'doc_id=' . $doc_id . '&doc_type=' . $doc_type . '&image=' . $file_fullName,
        CURLOPT_HTTPHEADER => array(
          'x-access-token: ' . $this->is_login()
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);
      echo $response;
    } elseif (!empty($errorMSG)) {
      echo json_encode(['status' => false, 'message' => $errorMSG]);
      exit;
    }
  }


  /////////////////////////////////////
  //  Login Method Starts Here
  ////////////////////////////////////

  public function login()
  {
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }

    $errorMSG = "";
    /* EMAIL */
    if (empty($_POST["login_id"])) {
      $errorMSG .= "<li>Login ID is required!</<li>";
    } else {
      $username = $_POST["login_id"];
    }

    /* PASS */
    if (empty($_POST["password"])) {
      $errorMSG .= "<li>Password is required!</<li>";
    } else {
      $pass = $_POST["password"];
    }

    if (empty($errorMSG)) {
      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => $this->site_url . 'auth/login',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'login_id=' . $username . '&password=' . $pass,
      ));

      $res = curl_exec($curl);

      curl_close($curl);

      $res = json_decode($res, true);
      // var_dump($res);

      if ($res['status'] === true) {
        if (session_status() == PHP_SESSION_NONE) {
          session_start();
        }
        $this->x_access_token = $res["data"]['authorization'];
        $_SESSION['user_auth_token'] = $res["data"]['authorization'];
        echo json_encode(['status' => $res['status'], 'msg' => $res['message'], 'token' => $res["data"]['authorization'], 'url' => 'account']);
      } else {
        echo json_encode(['status' => false, 'msg' => $res['message']]);
      }
    } elseif (!empty($errorMSG)) {
      echo json_encode(['code' => 404, 'msg' => $errorMSG]);
      exit;
    }
  }

  /////////////////////////////////
  // check for login user
  ////////////////////////////////
  public function is_login()
  {
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }

    if (isset($_SESSION['user_auth_token'])) {
      $this->x_access_token = $_SESSION['user_auth_token'];
    }
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => $this->site_url . 'user',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        'Authorization: ' . $this->x_access_token
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    $resp = json_decode($response, true);
    if (!$resp) {
      return false;
    }
    if ($resp['status'] === true) {
      if (isset($_SESSION['user_auth_token'])) {
        $token = $_SESSION['user_auth_token'];
      }
    } else {
      $token = false;
    }

    // var_dump($response);
    // echo json_encode(['status'=> $resp['status'], 'msg'=> $resp['message']]);
    return $token;
  }

  ///////////////////////////////////////////
  // Logout Starts Here
  //////////////////////////////////////////

  public function logout()
  {
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => $this->site_url . 'auth/logout',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_HTTPHEADER => array(
        'x-access-token:' . Self::is_login(),
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $res = json_decode($response);

    header('Location: /login');
  }


  ///////////////////////////////////////////
  // User Account function starts here
  //////////////////////////////////////////
  public function user_acc()
  {
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => $this->site_url . 'user',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        'Authorization: ' . self::is_login()
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    $res = json_decode($response);
    if (!$res) {
      return false;
    }
    if ($res->status === true) {
      return $res->data;
    } else {
      return $res->message;
    }
  }

  ////////////////////////////////////////
  // Transaction history
  ///////////////////////////////////////
  public function history()
  {
    $page = '';
    if (isset($_POST['page'])) {
      $page = '?page=' . $_POST['page'];
    }
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => $this->site_url . 'transactions' . $page,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        'Authorization: ' . $this->is_login()
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    // echo $response;
    $res = json_decode($response, true);

    if (isset($_POST['page'])) {
      echo json_encode($res);
    } else {
      return $res;
    }
  }

  //////////////////////////////////
  //Single Transaction history
  //////////////////////////////////
  public function txn_history($trans_id)
  {
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => $this->site_url . 'transactions/' . $trans_id,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        'x-access-token: ' . $this->is_login()
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    $resp = json_decode($response);
    return $resp;
  }

  //////////////////////////////////
  // USER NOTIFICATION/ACTIVITIE
  //////////////////////////////////
  public function notification()
  {
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => $this->site_url . 'notifications',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        'x-access-token: ' . $this->is_login()
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    // echo $response;
    $res = json_decode($response, true);

    return $res;
  }

  //////////////////////////////////
  //Single Transaction history
  //////////////////////////////////
  public function notify_history($trans_id)
  {
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => $this->site_url . 'notifications/' . $trans_id,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        'x-access-token: ' . $this->is_login()
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    $resp = json_decode($response);
    return $resp;
  }


  ////////////////////////////////////
  // Deposit Method starts Here
  ////////////////////////////////////
  public function deposit()
  {
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }

    $errorMSG = "";
    /* EMAIL */
    if (empty($_POST["method"])) {
      $errorMSG .= "Payment method is required!";
    } else {
      $method = $_POST["method"];
    }

    /* PASS */
    if (empty($_POST["amount"])) {
      $errorMSG .= "Please specify amount to deposit!";
    } else {
      $amount = $_POST["amount"];
    }

    if (empty($errorMSG)) {
      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => $this->site_url . 'deposit',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'amount=' . $amount . '&payment_method=' . $method,
        CURLOPT_HTTPHEADER => array(
          'Authorization: ' . $this->is_login()
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);
      $res = json_decode($response);
      // echo $response;
      echo json_encode($res);
      // return $res;
    } elseif (!empty($errorMSG)) {
      echo json_encode(['code' => 404, 'msg' => $errorMSG]);
      exit;
    }
  }

  /////////////////////////////////////
  // Deposit CALLBACKS
  /////////////////////////////////////
  public function deposit_callback($ref, $method)
  {
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => $this->site_url . 'deposit',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'PUT',
      CURLOPT_POSTFIELDS => 'tx_ref=' . $ref . '&payment_method=' . $method,
      CURLOPT_HTTPHEADER => array(
        'Authorization: ' . $this->is_login()
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    return json_decode($response);
    // echo $response;
  }

  /////////////////////////////////////////
  // RESOLVE/VERIFY ACCOUNT DETAILS
  ////////////////////////////////////////
  public function resolve_acc($account, $bank)
  {

    $errorMSG = '';
    if ($account == '' && $bank == '') {
      if (empty($_POST["account"])) {
        $errorMSG .= "Account Number is required! <br>";
      } else {
        $account_no = $_POST["account"];
      }

      if (empty($_POST["bank"])) {
        $errorMSG .= "User Bank is required! <br>";
      } else {
        $bank = $_POST["bank"];
      }
    } else {
      $account_no = $account;
      $bank = $bank;
    }


    if (empty($errorMSG)) {
      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => $this->site_url . 'verify-account-number',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_POSTFIELDS => 'account_number=' . $account_no . '&bank=' . $bank,
        CURLOPT_HTTPHEADER => array(
          'x-access-token: ' . $this->is_login()
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);
      echo $response;
    } elseif (!empty($errorMSG)) {
      echo json_encode(['status' => false, 'message' => $errorMSG]);
      exit;
    }
  }

  /////////////////////////////////////////
  // RESOLVE/VERIFY ACCOUNT DETAILS With custome details
  ////////////////////////////////////////
  public function resolve_account($account, $bank)
  {

    $errorMSG = '';
    if ($account == '' && $bank == '') {
      if (empty($_POST["account"])) {
        $errorMSG .= "Account Number is required! <br>";
      } else {
        $account_no = $_POST["account"];
      }

      if (empty($_POST["bank"])) {
        $errorMSG .= "User Bank is required! <br>";
      } else {
        $bank = $_POST["bank"];
      }
    } else {
      $account_no = $account;
      $bank = $bank;
    }


    if (empty($errorMSG)) {
      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => $this->site_url . 'verify-account-number',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_POSTFIELDS => 'account_number=' . $account_no . '&bank=' . $bank,
        CURLOPT_HTTPHEADER => array(
          'x-access-token: ' . $this->is_login()
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);
      return json_decode($response);
    } elseif (!empty($errorMSG)) {
      echo json_encode(['status' => false, 'message' => $errorMSG]);
      exit;
    }
  }


  /////////////////////////////////////////
  // Withdraw
  ////////////////////////////////////////
  public function withdraw()
  {
    $errorMSG = '';
    if (empty($_POST["account_no"])) {
      $errorMSG .= "Reciepent account is required! <br>";
    } else {
      $account_no = $_POST["account_no"];
    }

    if (empty($_POST["amount"])) {
      $errorMSG .= "Amount is required! <br>";
    } else {
      $amount = $_POST["amount"];
    }

    if (empty($_POST["bank"])) {
      $errorMSG .= "User Bank is required! <br>";
    } else {
      $bank = $_POST["bank"];
    }

    if (empty($_POST["description"])) {
      $errorMSG .= "Transaction description is required! <br>";
    } else {
      $desc = $_POST["description"];
    }

    if (empty($_POST["pin"])) {
      $errorMSG .= "Transaction pin is required! <br>";
    } else {
      $pin = $_POST["pin"];
    }

    if (empty($errorMSG)) {
      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => $this->site_url . 'withdrawal',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'amount=' . $amount . '&description=' . $desc . '&bank_code=' . $bank . '&account_number=' . $account_no . '&pin=' . $pin,
        CURLOPT_HTTPHEADER => array(
          'x-access-token: ' . $this->is_login()
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);
      echo $response;
      // return $response;
    } elseif (!empty($errorMSG)) {
      echo json_encode(['status' => false, 'message' => $errorMSG]);
      exit;
    }
  }

  /////////////////////////////////////////
  // Withdraw from virtual account
  ////////////////////////////////////////
  public function virtual_withdraw()
  {
    $errorMSG = '';
    if (empty($_POST["from"])) {
      $errorMSG .= "Account reference is required! <br>";
    } else {
      $from = $_POST["from"];
    }

    if (empty($_POST["account"])) {
      $errorMSG .= "Reciepent account is required! <br>";
    } else {
      $account_no = $_POST["account"];
    }

    if (empty($_POST["amount"])) {
      $errorMSG .= "Amount is required! <br>";
    } else {
      $amount = $_POST["amount"];
    }

    if (empty($_POST["bank"])) {
      $errorMSG .= "User Bank is required! <br>";
    } else {
      $bank = $_POST["bank"];
    }

    if (empty($_POST["description"])) {
      $errorMSG .= "Transaction description is required! <br>";
    } else {
      $desc = $_POST["description"];
    }

    if (empty($_POST["pin"])) {
      $errorMSG .= "Transaction pin is required! <br>";
    } else {
      $pin = $_POST["pin"];
    }

    if (empty($errorMSG)) {
      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => $this->site_url . 'virtual-withdraw',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'from=' . $from . '&amount=' . $amount . '&description=' . $desc . '&bank=' . $bank . '&account_number=' . $account_no . '&pin=' . $pin,
        // CURLOPT_HTTPHEADER => array(
        // 	'x-access-token: ' . $this->is_login()
        // ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);
      echo $response;
      // return $response;
    } elseif (!empty($errorMSG)) {
      echo json_encode(['status' => false, 'message' => $errorMSG]);
      exit;
    }
  }

  public function banks()
  {
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => $this->site_url . 'banks',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        'x-access-token: ' . $this->is_login()
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return json_decode($response, true);
  }

  ////////////////////////////////
  // Forget Password method
  ///////////////////////////////

  public function forget_pass()
  {
    //EMAIL ADDRESS
    $errorMSG = '';
    if (empty($_POST["email"])) {
      $errorMSG .= "Email address is required!";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
      $errorMSG .= "<li>Invalid email address</li>";
    } else {
      $email = $_POST["email"];
    }

    //PROCCESS IF NO ERROR
    if (empty($errorMSG)) {
      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => $this->site_url . 'auth/reset',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'email=' . $email,
      ));

      $response = curl_exec($curl);

      curl_close($curl);
      $response = json_decode($response);

      echo json_encode(['status' => $response->status, 'msg' => $response->message, 'url' => 'reset']);
      // echo $response;
    } elseif (!empty($errorMSG)) {
      echo json_encode(['code' => 404, 'msg' => $errorMSG]);
      exit;
    }
  }

  /////////////////////////////
  // Reset Password
  ////////////////////////////

  public function reset_pass()
  {
    //EMAIL ADDRESS
    $errorMSG = '';
    if (empty($_POST["code"])) {
      $errorMSG .= "Email address is required!";
    } elseif (!filter_var($_POST["code"], FILTER_VALIDATE_INT)) {
      $errorMSG .= "<li>Invalid code format!</li>";
    } else {
      $code = $_POST["code"];
    }

    /* PASS */
    if (empty($_POST["password"])) {
      $errorMSG .= "<li>Password is required!</li><br>";
    } else {
      $pass = $_POST["password"];
    }
    /* R PASS */
    if (empty($_POST["repeat_password"])) {
      $errorMSG .= "<li>Passwords must be identical</li><br>";
    } else {
      $rpass = $_POST["repeat_password"];
    }
    if (!empty($pass) && !empty($rpass) && $pass != $rpass) {
      $errorMSG .= "Passwords don't match";
    }

    //PROCCESS IF NO ERROR
    if (empty($errorMSG)) {
      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => $this->site_url . 'auth/reset',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'PUT',
        CURLOPT_POSTFIELDS => 'reset_code=' . $code . '&password=' . $pass . '&repeat_password=' . $rpass,
      ));

      $response = curl_exec($curl);

      curl_close($curl);
      $response = json_decode($response);

      echo json_encode(['status' => $response->status, 'msg' => $response->message, 'url' => 'login']);
      // echo $response;
    } elseif (!empty($errorMSG)) {
      echo json_encode(['code' => 404, 'msg' => $errorMSG]);
      exit;
    }
  }

  public function vtu()
  {
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => $this->site_url . 'networks',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return json_decode($response);
  }

  public function data_plans($network)
  {
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => $this->site_url . 'data-plans?id=' . $network,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return json_decode($response);
  }

  public function buyAirtime()
  {
    $errorMSG = '';
    if (empty($_POST["amount"])) {
      $errorMSG .= "Amount is required! ";
    } else {
      $amount = $_POST["amount"];
    }

    if (empty($_POST["network"])) {
      $errorMSG .= "Network is required! ";
    } else {
      $network = $_POST["network"];
    }

    if (empty($_POST["phoneNumber"])) {
      $errorMSG .= "Phone number is required! ";
    } else {
      $phone = $_POST["phoneNumber"];
    }

    if (empty($_POST["pin"])) {
      $errorMSG .= "Transaction pin is required! ";
    } else {
      $pin = $_POST["pin"];
    }

    if (empty($errorMSG)) {
      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => $this->site_url . 'recharge',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'amount=' . $amount . '&phone_number=' . $phone . '&network=' . $network . '&pin=' . $pin,
        CURLOPT_HTTPHEADER => array(
          'x-access-token: ' . $this->is_login()
        ),
      ));

      $response = curl_exec($curl);
      curl_close($curl);

      echo $response;
    } elseif (!empty($errorMSG)) {
      echo json_encode(['code' => 400, 'message' => $errorMSG]);
      exit;
    }
  }

  public function buyData()
  {
    $errorMSG = '';
    if (empty($_POST["plan"])) {
      $errorMSG .= "Data Plan is required! ";
    } else {
      $plan = $_POST["plan"];
    }

    if (empty($_POST["network"])) {
      $errorMSG .= "Network is required! ";
    } else {
      $network = $_POST["network"];
    }

    if (empty($_POST["phoneNumber"])) {
      $errorMSG .= "Phone number is required! ";
    } else {
      $phone = $_POST["phoneNumber"];
    }

    if (empty($_POST["pin"])) {
      $errorMSG .= "Transaction pin is required! ";
    } else {
      $pin = $_POST["pin"];
    }

    if (empty($errorMSG)) {
      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => $this->site_url . 'data',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'plan=' . $plan . '&phone_number=' . $phone . '&network=' . $network . '&pin=' . $pin,
        CURLOPT_HTTPHEADER => array(
          'x-access-token: ' . $this->is_login()
        ),
      ));

      $response = curl_exec($curl);
      curl_close($curl);

      echo $response;
    } elseif (!empty($errorMSG)) {
      echo json_encode(['code' => 400, 'message' => $errorMSG]);
      exit;
    }
  }

  //+----------------------------+
  // Utility services Starts here
  //+----------------------------+
  public function services($id = '', $service = '')
  {
    $curl = curl_init();
    if ($id !== '') {
      $id = 'id=' . $id;
    }

    if ($service !== '') {
      $service = '?service=' . $service . '&';
    }

    curl_setopt_array($curl, array(
      CURLOPT_URL => $this->site_url . 'all-bills' . $service . $id,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return json_decode($response);
  }

  // VERIFY BILL CUSTOMER
  public function verify_bill()
  {
    $errorMSG = '';
    if (empty($_POST["customer_id"])) {
      $errorMSG .= "Customers ID is required! <br>";
    } else {
      $customer_id = $_POST["customer_id"];
    }

    if (empty($_POST["service"])) {
      $errorMSG .= "Service is required! <br>";
    } else {
      $service = $_POST["service"];
    }

    if (empty($_POST["bill_id"])) {
      $errorMSG .= "Bill ID is required! <br>";
    } else {
      $bill_id = $_POST["bill_id"];
    }

    if (empty($_POST["bill_type"])) {
      $bill_type = ' ';
    } else {
      $bill_type = $_POST["bill_type"];
    }

    // $get = $_POST['get'];

    if (empty($errorMSG)) {
      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => $this->site_url . 'bill-customer',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'customer_id=' . $customer_id . '&service=' . $service . '&bill_id=' . $bill_id . '&bill_type=' . $bill_type,
        // 'customer_id=' . $customer_id . '&service=' . $service . '&bill_id=' . $bill_id . '&bill_type=' . $bill_type,
        CURLOPT_HTTPHEADER => array(
          'x-access-token: ' . $this->is_login()
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);

      echo json_encode($response);
    } elseif (!empty($errorMSG)) {
      echo json_encode(['status' => false, 'message' => $errorMSG]);
      exit;
    }
  }

  // PAY Utility BILL
  public function pay_bill()
  {
    $errorMSG = '';
    if (empty($_POST["customer_id"])) {
      $errorMSG .= "Customers ID is required! <br>";
    } else {
      $customer_id = $_POST["customer_id"];
    }

    if (empty($_POST["amount"])) {
      $errorMSG .= "Amount is required! <br>";
    } else {
      $amount = $_POST["amount"];
    }

    if (empty($_POST["variation"])) {
      $variation = "";
    } else {
      $variation = $_POST["variation"];
    }

    if (empty($_POST["service"])) {
      $errorMSG .= "Service is required! <br>";
    } else {
      $service = $_POST["service"];
    }

    if (empty($_POST["product_id"])) {
      $errorMSG .= "product_id is required! <br>";
    } else {
      $bill_id = $_POST["product_id"];
    }

    if (empty($_POST["type"])) {
      $type = "";
    } else {
      $type = $_POST["type"];
    }

    if (empty($_POST["plan"])) {
      $plan = "";
    } else {
      $plan = $_POST["plan"];
    }

    if (empty($_POST["pin"])) {
      $errorMSG .= "Transaction pin is required! <br>";
    } else {
      $pin = $_POST["pin"];
    }

    if (empty($errorMSG)) {
      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => $this->site_url . 'pay-bill',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'customer_id=' . $customer_id .
          '&amount=' . $amount .
          '&variation=' . $variation .
          '&pin=' . $pin .
          '&service=' . $service .
          '&bill_type=' . $type .
          '&bill_id=' . $bill_id .
          '&month=' . $plan,

        CURLOPT_HTTPHEADER => array(
          'x-access-token: ' . $this->is_login()
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);

      echo $response;
    } elseif (!empty($errorMSG)) {
      echo json_encode(['status' => false, 'message' => $errorMSG]);
      exit;
    }
  }

  // VERY USER USING EMAIL METHOD
  public function verify_user($email)
  {
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => $this->site_url . 'verify-user',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => 'email=' . $email,
      CURLOPT_HTTPHEADER => array(
        'x-access-token: ' . $this->is_login()
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return json_decode($response);
  }

  // SEND MONEY METHOD
  public function send_money()
  {
    $errorMSG = '';
    if (empty($_POST["email"])) {
      $errorMSG .= "Reciepent email is required! <br>";
    } else {
      $email = $_POST["email"];
    }

    if (empty($_POST["amount"])) {
      $errorMSG .= "Amount is required! <br>";
    } else {
      $amount = $_POST["amount"];
    }

    if (empty($_POST["description"])) {
      $errorMSG .= "Transaction description is required! <br>";
    } else {
      $description = $_POST["description"];
    }

    if (empty($_POST["pin"])) {
      $errorMSG .= "Transaction pin is required! <br>";
    } else {
      $pin = $_POST["pin"];
    }

    if (empty($errorMSG)) {
      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => $this->site_url . 'send-money',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'amount=' . $amount . '&email=' . $email . '&pin=' . $pin . '&description=' . $description,
        CURLOPT_HTTPHEADER => array(
          'x-access-token: ' . $this->is_login()
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);

      echo json_encode($response);
    } elseif (!empty($errorMSG)) {
      echo json_encode(['status' => false, 'message' => $errorMSG]);
      exit;
    }
  }

  //REQUEST MONEY METHOD
  public function request_money()
  {
    $errorMSG = '';
    if (empty($_POST["email"])) {
      $errorMSG .= "Reciepent email is required! <br>";
    } else {
      $email = $_POST["email"];
    }

    if (empty($_POST["amount"])) {
      $errorMSG .= "Amount is required! <br>";
    } else {
      $amount = $_POST["amount"];
    }

    if (empty($_POST["description"])) {
      $errorMSG .= "Transaction description is required! <br>";
    } else {
      $description = $_POST["description"];
    }

    if (empty($_POST["pin"])) {
      $errorMSG .= "Transaction pin is required! <br>";
    } else {
      $pin = $_POST["pin"];
    }

    if (empty($errorMSG)) {
      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => $this->site_url . 'request-money',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'amount=' . $amount . '&email=' . $email . '&pin=' . $pin . '&description=' . $description,
        CURLOPT_HTTPHEADER => array(
          'x-access-token: ' . $this->is_login()
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);

      echo json_encode($response);
    } elseif (!empty($errorMSG)) {
      echo json_encode(['status' => false, 'message' => $errorMSG]);
      exit;
    }
  }

  //PAY REQUEST MONEY METHOD
  public function pay_money()
  {
    $errorMSG = '';
    if (empty($_POST["trans_id"])) {
      $errorMSG .= "Transaction ID is required! <br>";
    } else {
      $trans_id = $_POST["trans_id"];
    }

    if (empty($_POST["pin"])) {
      $errorMSG .= "Transaction pin is required! <br>";
    } else {
      $pin = $_POST["pin"];
    }

    if (empty($errorMSG)) {
      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => $this->site_url . 'pay-requested-money',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'transaction_id=' . $trans_id . '&pin=' . $pin,
        CURLOPT_HTTPHEADER => array(
          'x-access-token: ' . $this->is_login()
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);

      echo json_encode($response);
    } elseif (!empty($errorMSG)) {
      echo json_encode(['status' => false, 'message' => $errorMSG]);
      exit;
    }
  }

  //CRYPTO NEWS
  public function news()
  {
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://newsapi.org/v2/everything?q=crypto&sortBy=publishedAt&apiKey=03e170fd9dbc4f79b3d7afbeefa09667',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return json_decode($response);
  }

  //UPDATE PASSWORD
  public function password()
  {
    $errorMSG = '';
    if (empty($_POST["old_password"])) {
      $errorMSG .= "Old password is required! <br>";
    } else {
      $old_password = $_POST["old_password"];
    }

    if (empty($_POST["new_password"])) {
      $errorMSG .= "New password is required! <br>";
    } else {
      $new_password = $_POST["new_password"];
    }

    if (empty($_POST["re_password"])) {
      $errorMSG .= "Comfirm password is required! <br>";
    } else {
      $re_password = $_POST["re_password"];
    }

    if ($_POST["new_password"] != $_POST["re_password"]) {
      $errorMSG .= "Password doesn't match! <br>";
    }

    if (empty($errorMSG)) {
      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => $this->site_url . 'auth/reset',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'PATCH',
        CURLOPT_POSTFIELDS => 'current_password=' . $old_password . '&password=' . $new_password . '&repeat_password=' . $re_password,
        CURLOPT_HTTPHEADER => array(
          'x-access-token: ' . $this->is_login()
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);
      echo $response;
    } elseif (!empty($errorMSG)) {
      echo json_encode(['status' => false, 'message' => $errorMSG]);
      exit;
    }
  }

  //UPDATE TRANSACTION PIN
  public function pin()
  {
    $errorMSG = '';
    if (empty($_POST["old_pin"])) {
      $errorMSG .= "Old pin is required! <br>";
    } else {
      $old_pin = $_POST["old_pin"];
    }

    if (empty($_POST["new_pin"])) {
      $errorMSG .= "New pin is required! <br>";
    } else {
      $new_pin = $_POST["new_pin"];
    }

    if (empty($_POST["re_pin"])) {
      $errorMSG .= "Comfirm pin is required! <br>";
    } else {
      $re_pin = $_POST["re_pin"];
    }

    if ($_POST["new_pin"] != $_POST["re_pin"]) {
      $errorMSG .= "Pin doesn't match! <br>";
    }

    if (empty($errorMSG)) {
      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => $this->site_url . 'auth/reset-pin',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'current_pin=' . $old_pin . '&pin=' . $new_pin . '&repeat_pin=' . $re_pin,
        CURLOPT_HTTPHEADER => array(
          'x-access-token: ' . $this->is_login()
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);
      echo $response;
    } elseif (!empty($errorMSG)) {
      echo json_encode(['status' => false, 'message' => $errorMSG]);
      exit;
    }
  }

  //DEPOSIT CRYPTO
  public function deposit_crypto()
  {
    $errorMSG = '';
    if (empty($_POST["coin_type"])) {
      $errorMSG .= "Please select a coin! <br>";
    } else {
      $coin = $_POST["coin_type"];
    }

    if (empty($_POST["amount"])) {
      $errorMSG .= "Amount is required! <br>";
    } else {
      $amount = $_POST["amount"];
    }

    if (empty($_POST["trans_hash"])) {
      $errorMSG .= "Transaction ID is required! <br>";
    } else {
      $trans_id = $_POST["trans_hash"];
    }

    if (empty($errorMSG)) {
      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => $this->site_url . 'deposit-crypto',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'coin_type=' . $coin . '&amount=' . $amount . '&trans_hash=' . $trans_id,
        CURLOPT_HTTPHEADER => array(
          'x-access-token: ' . $this->is_login()
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);

      echo json_encode($response);
    } elseif (!empty($errorMSG)) {
      echo json_encode(['status' => false, 'message' => $errorMSG]);
      exit;
    }
  }

  //SEND CRYPTO
  public function send_crypto()
  {
    $errorMSG = '';
    if (empty($_POST["coin_type"])) {
      $errorMSG .= "Please select a coin! <br>";
    } else {
      $coin = $_POST["coin_type"];
    }

    if (empty($_POST["amount"])) {
      $errorMSG .= "Amount is required! <br>";
    } else {
      $amount = $_POST["amount"];
    }

    if (empty($_POST["wallet_address"])) {
      $errorMSG .= "Wallet address is required! <br>";
    } else {
      $address = $_POST["wallet_address"];
    }

    if (empty($_POST["pin"])) {
      $errorMSG .= "Transaction Pin is required! <br>";
    } else {
      $pin = $_POST["pin"];
    }

    if (empty($errorMSG)) {
      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => $this->site_url . 'send-crypto',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'coin_type=' . $coin . '&amount=' . $amount . '&wallet_address=' . $address . '&pin=' . $pin,
        CURLOPT_HTTPHEADER => array(
          'x-access-token: ' . $this->is_login()
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);

      echo json_encode($response);
    } elseif (!empty($errorMSG)) {
      echo json_encode(['status' => false, 'message' => $errorMSG]);
      exit;
    }
  }

  //SWAP CRYPTO
  public function swap_crypto()
  {
    $errorMSG = '';
    if (empty($_POST["from"])) {
      $errorMSG .= "Please select a wallet to swap from! <br>";
    } else {
      $from = $_POST["from"];
    }

    if (empty($_POST["to"])) {
      $errorMSG .= "Please select a wallet to swap with! <br>";
    } else {
      $to = $_POST["to"];
    }

    if (empty($_POST["amount"])) {
      $errorMSG .= "Amount is required! <br>";
    } else {
      $amount = $_POST["amount"];
    }

    if (empty($_POST["pin"])) {
      $errorMSG .= "Transaction Pin is required! <br>";
    } else {
      $pin = $_POST["pin"];
    }

    if (empty($errorMSG)) {
      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => $this->site_url . 'swap',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'from=' . $from . '&amount=' . $amount . '&to=' . $to . '&pin=' . $pin,
        CURLOPT_HTTPHEADER => array(
          'x-access-token: ' . $this->is_login()
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);

      echo json_encode($response);
    } elseif (!empty($errorMSG)) {
      echo json_encode(['status' => false, 'message' => $errorMSG]);
      exit;
    }
  }
  ////////////////////////////////////////
  // CRYPTO Transaction history
  ///////////////////////////////////////
  public function crypto_history()
  {
    $page = '';
    if (isset($_POST['page'])) {
      $page = '?page=' . $_POST['page'];
    }
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => $this->site_url . 'crypto-histories' . $page,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        'x-access-token: ' . $this->is_login()
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    // echo $response;
    $res = json_decode($response, true);
    if (isset($_POST['page'])) {
      echo json_encode($res);
    } else {
      return $res;
    }
    // return $res;
  }

  //////////////////////////////////
  //Single Transaction history
  //////////////////////////////////
  public function crypto_txn_history($trans_id)
  {
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => $this->site_url . 'crypto-history/' . $trans_id,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        'x-access-token: ' . $this->is_login()
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    $resp = json_decode($response);
    return $resp;
  }

  //////////////////////////////////
  //GET ALL/SINGLE CARDs
  //////////////////////////////////
  public function cards($card_id = '')
  {
    if ($card_id !== '') {
      $card_id = '?id=' . $card_id;
    }
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => $this->site_url . 'get-card/' . $card_id,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        'x-access-token: ' . $this->is_login()
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    $resp = json_decode($response);
    return $resp;
  }

  //DELETE VIRTUAL CARD
  public function delete_cards()
  {

    $errorMSG = '';
    if (empty($_POST["card_id"])) {
      $errorMSG .= "Invalid card ID! <br>";
    } else {
      $card_id = '?id=' . $_POST["card_id"];
    }

    if (empty($errorMSG)) {

      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => $this->site_url . 'terminate-card/' . $card_id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_HTTPHEADER => array(
          'x-access-token: ' . $this->is_login()
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);

      // $resp = json_decode($response);
      echo $response;
    } elseif (!empty($errorMSG)) {
      echo json_encode(['status' => false, 'message' => $errorMSG]);
      exit;
    }
  }

  //FREEZE VIRTUAL CARD
  public function freeze_cards()
  {
    $errorMSG = '';
    if (empty($_POST["card_id"])) {
      $errorMSG .= "Invalid card ID! <br>";
    } else {
      $card_id = '?id=' . $_POST["card_id"];
    }

    if (empty($_POST["status"])) {
      $errorMSG .= "Status is required! <br>";
    } else {
      $status = $_POST["status"];
    }

    if (empty($errorMSG)) {

      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => $this->site_url . 'block-card' . $card_id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'status=' . $status,
        CURLOPT_HTTPHEADER => array(
          'x-access-token: ' . $this->is_login()
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);

      // $resp = json_decode($response);
      echo $response;
    } elseif (!empty($errorMSG)) {
      echo json_encode(['status' => false, 'message' => $errorMSG]);
      exit;
    }
  }

  //DELETE VIRTUAL CARD
  public function create_card()
  {
    $errorMSG = '';
    if (empty($_POST["amount"])) {
      $errorMSG .= "Please Provide the amount to fund the card with! <br>";
    } else {
      $amount = $_POST["amount"];
    }

    if (empty($_POST["name"])) {
      $errorMSG .= "Please input the name to display on your card! <br>";
    } else {
      $name = $_POST["name"];
    }

    if (empty($_POST["address"])) {
      $errorMSG .= "Address is required! <br>";
    } else {
      $address = $_POST["address"];
    }

    if (empty($_POST["city"])) {
      $errorMSG .= "City is required! <br>";
    } else {
      $city = $_POST["city"];
    }

    if (empty($_POST["state"])) {
      $errorMSG .= "State is required! <br>";
    } else {
      $state = $_POST["state"];
    }

    if (empty($_POST["postal_code"])) {
      $errorMSG .= "Postal Code is required! <br>";
    } else {
      $postal_code = $_POST["postal_code"];
    }

    if (empty($errorMSG)) {

      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => $this->site_url . 'create-card',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'amount=' . $amount . '&name_on_card=' . $name . '&address=' . $address . '&city=' . $city . '&postal_code=' . $postal_code . '&state=' . $state,
        CURLOPT_HTTPHEADER => array(
          'x-access-token: ' . $this->is_login()
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);

      echo $response;
    } elseif (!empty($errorMSG)) {
      echo json_encode(['status' => false, 'message' => $errorMSG]);
      exit;
    }
  }

  //FUND VIRTUAL CARD
  public function fund_card()
  {
    $errorMSG = '';
    if (empty($_POST["amount"])) {
      $errorMSG .= "Please Provide the amount to fund the card with! <br>";
    } else {
      $amount = $_POST["amount"];
    }

    if (empty($_POST["card_id"])) {
      $errorMSG .= "Invalid card ID! <br>";
    } else {
      $card_id = '?id=' . $_POST["card_id"];
    }

    if (empty($errorMSG)) {

      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => $this->site_url . 'fund-card' . $card_id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'amount=' . $amount,
        CURLOPT_HTTPHEADER => array(
          'x-access-token: ' . $this->is_login()
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);

      echo $response;
    } elseif (!empty($errorMSG)) {
      echo json_encode(['status' => false, 'message' => $errorMSG]);
      exit;
    }
  }

  //FUND VIRTUAL CARD
  public function withdraw_from_card()
  {
    $errorMSG = '';
    if (empty($_POST["amount"])) {
      $errorMSG .= "Please Provide the amount to fund the card with! <br>";
    } else {
      $amount = $_POST["amount"];
    }

    if (empty($_POST["card_id"])) {
      $errorMSG .= "Invalid card ID! <br>";
    } else {
      $card_id = '?id=' . $_POST["card_id"];
    }

    if (empty($errorMSG)) {

      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => $this->site_url . 'withdraw-from-card' . $card_id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'amount=' . $amount,
        CURLOPT_HTTPHEADER => array(
          'x-access-token: ' . $this->is_login()
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);

      echo $response;
    } elseif (!empty($errorMSG)) {
      echo json_encode(['status' => false, 'message' => $errorMSG]);
      exit;
    }
  }

  public function RedeemGiftPin($userid, $pin)
  {
    $stmt = $this->con->prepare("SELECT * FROM gift_pins WHERE gift_code = '$pin' LIMIT 1");
    $stmt->execute();
    $res = $stmt->get_result();
    $obj = $res->fetch_object();
    if (empty($obj)) {
      echo json_encode(['status' => 'false', 'msg' => 'Invalid Pin']);
      exit;
    } else if ($obj->gift_status == '0') {
      echo json_encode(['status' => 'false', 'msg' => 'Gift Pin Already Used Please Try Another One']);
      exit;
    } else {
      $stmt1 = $this->con->prepare("UPDATE `gift_pins` SET `gift_status` = '0' WHERE `gift_pins`.`gift_code` = $pin");
      $stmt2 = $this->con->prepare("UPDATE `users` SET `balance` = balance + '$obj->gift_amount' WHERE `users`.`id` = $userid");
      $stmt1->execute();
      $stmt2->execute();
      echo json_encode(['status' => 'true', 'msg' => 'Congraturations 🏆 You Recieved ₦' . $obj->gift_amount . ' keep winning']);
      exit;
    }
  }

  public function BuyGiftPin($gift_amount, $userid)
  {
    $gift_pin = rand(164748821993, 947488219999);
    #INSERT INTO GIFT PIN
    $stmt1 = $this->con->prepare("INSERT INTO gift_pins (gift_code,gift_amount,gift_reciever_id) VALUES (?,?,?)");
    $stmt1->bind_param("sss", $gift_pin, $gift_amount, $userid);
    #UPDATE USER BALANCE
    $stmt2 = $this->con->prepare("UPDATE `users` SET `balance` = balance - '$gift_amount' WHERE `users`.`id` = $userid");
    $stmt1->execute();
    $stmt2->execute();
    #RETURN
    $stmt = $this->con->prepare("SELECT * FROM users WHERE id = '$userid' LIMIT 1");
    $stmt->execute();
    $res = $stmt->get_result();
    $obj = $res->fetch_object();
    echo json_encode(['status' => 'true', 'msg' => 'GiftPin Purchased Successfully Your Pin : ' . $gift_pin . ' keep save!']);
    // 	$app = new User();
    // 	$app->Notify($obj->notify_token,'Dite Gift Pin','You Successfully Purchased Gift Pin From Ditepay. Your Pin : '.$gift_pin.' keep save!','https://app.ditepay.com');
    exit;
  }

  public function UpdateNotifyToken($userid, $new_token)
  {
    #UPDATE USER NOTIFICATION TOKEN
    $stmt = $this->con->prepare("UPDATE `users` SET `notify_token` = '$new_token' WHERE `users`.`id` = $userid");
    $stmt->execute();
    #RETURN
    echo json_encode(['status' => 'true', 'msg' => 'token updated']);
    exit;
  }


  function Notify($token, $title, $body, $link)
  {
    $url = "https://fcm.googleapis.com/fcm/send";

    $fields = array(
      "to" => $token,
      "notification" => array(
        "title" => $title,
        "body" => $body,
        "icon" => 'https://ditepay.com/_nuxt/img/ditepay.png',
        "click_action" => $link
      )
    );

    $headers = array(
      'Authorization: key=AAAAgZfTLbc:APA91bH8Au9lI2XeNRCRjgLzbKReBkwX1gB8zDx1-dp9199e9E4MtPSH9vKp-imWeQTa5PBp8uDHJm9e7PFvWQK9Rnt5X8gKX95UKn3DNRZpbm18X0eSWgXMzkwC3oaSNcXOWW3qFfl5',
      'Content-Type:application/json'
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);
    print_r($result);
    curl_close($ch);

    echo json_encode(['status' => 'true', 'msg' => 'notification sent']);
    exit;
  }
}

$app = new User();
$user = $app->user_acc();
$siteurl = $app->siteurl;
$coin = "NGN";
$settings = $app->site_settings1()->data;

if (!empty($user->email)) {
  $this_user = $app->verify_user($user->email);
}
// $callback = $app->deposit_callback($ref, $method);

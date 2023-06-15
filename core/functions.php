<?php
// +------------------------------------------------------------------------+
// | @author 		: Michael Arawole (HENT Technologies)
// | @author_url	: https://logad.net
// | @author_email	: henttech@gmail.com
// +------------------------------------------------------------------------+
// | Copyright (c) 2020 HENT Technologies. All rights reserved.
// | Unauthorized copying of this file, via any medium is strictly prohibited
// | Proprietary and confidential
// +------------------------------------------------------------------------+

// +----------------------------+
// | Core Functions
// +----------------------------+

class app
{
	public function __construct()
	{
		require 'config.php';
		$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
		$this->con = $mysqli;
		$this->siteurl = $siteurl;
		$this->coin = $coin;
		$this->apiurl = "https://api.ditepay.com/api/";
	}

	## Site Settings ##
	public function settings()
	{
		$stmt = $this->con->prepare("SELECT * FROM site_settings LIMIT 1");
		$stmt->execute();
		$res = $stmt->get_result();
		$obj = $res->fetch_object();
		$obj->siteurl = $this->siteurl;
		$obj->site_logo = $this->siteurl . "/" . $obj->site_logo;
		foreach ($obj as $key => $value) {

			$ex = explode('_', $key);

			if ($ex[0] == 'feature') {
				unset($obj->$key);
				$value = ($value == 1) ? true : false;
				$meta['value'] = $value;
				$meta['name'] = ucfirst($ex[1]) . " " . ucfirst($ex[0]);
				$features[$ex[1]] = (object) $meta;
			}
		}
		// var_dump((object) $features);
		$obj->features = (object) $features;
		return $obj;
	}

	// Custom Mail
	public function mail($to, $subject, $message)
	{
		$to = $this->clean($to);
		$subject = $this->clean($subject);
		$message = $this->clean($message);
		$headers = "From: " . $this->settings()->site_title . "\r\n";
		$headers .= "Reply-To: " . $this->settings()->site_email . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

		if (mail($to, $subject, $message, $headers) === true) {
			return true;
		} else {
			//Use PHP Mailer
		}
		return false;
	}

	## Allow only XHR ##
	public function onlyxhr()
	{
		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])) {
			if (strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
				http_response_code(404);
				exit;
			}
		} else {
			http_response_code(404);
			exit;
		}
	}

	## Allow only logged in users ##
	public function onlyauth($redirect = false)
	{
		if ($this->user_logged_in() === false) {
			if ($redirect === true) {
				$_SESSION['return_url'] = $_SERVER['REQUEST_URI'];
				header("Location: $this->siteurl/login");
				exit;
			} else {
				http_response_code(404);
				exit;
			}
		}
	}

	## Allow only admin ##
	public function onlyadmin($redirect = false)
	{
		if ($this->admin_logged_in() === false) {
			if ($redirect === true) {
				$_SESSION['return_url'] = $_SERVER['REQUEST_URI'];
				header("Location: $this->siteurl/login");
				exit;
			} else {
				http_response_code(404);
				exit;
			}
		}
	}

	## Ignored Services ##
	public function is_ignored($item, $type)
	{
		$stmt = $this->con->prepare("SELECT id FROM ignored_items WHERE item_id = ? AND type = ?");
		$stmt->bind_param("ss", $item, $type);
		$stmt->execute();
		$result = $stmt->get_result();
		if ($result->num_rows > 0) {
			return true;
		}
		return false;
	}

	## Ignore Item ##
	public function ignore_item($item_id, $item_name, $type, $action)
	{
		$response['status'] = false;
		$response['msg'] = "Error occurred";

		if ($action == "disable") {
			$stmt = $this->con->prepare("INSERT INTO ignored_items (item_id,item_name,type) VALUES (?,?,?)");
			$stmt->bind_param("sss", $item_id, $item_name, $type);
			$stmt->execute();
			if ($stmt->affected_rows == 1) {
				$response['status'] = true;
				$response['msg'] = "Item Ignored successfully";
				return $response;
			} else {
				$response['msg'] = "Couldn't Ignore item";
			}
		} elseif ($action == "enable") {
			$stmt = $this->con->prepare("DELETE FROM ignored_items WHERE item_id = ? AND type = ?");
			$stmt->bind_param("ss", $item_id, $type);
			$stmt->execute();
			if ($stmt->affected_rows == 1) {
				$response['status'] = true;
				$response['msg'] = "Item Un-ignored successfully";
				return $response;
			} else {
				$response['msg'] = "couldn't Un-ignore item";
			}
		}
		return $response;
	}

	## Log API Errors ##
	public function log_error($error, $line = null, $file = null, $type = "api")
	{
		if ($line == "custom") {
			$error = $error;
		} else {
			$error = "Error Message : " . $error->getMessage();
			$error .= "\r\nError Line : " . $line;
			$error .= "\r\nError File : " . $file;
		}
		$message = "[" . gmdate("M d Y H:i:s") . "] \r\n" . $error . "\r\n";
		error_log(PHP_EOL . $message, 3, '../../api_errors.log');
	}

	## Generate random string ##
	public function GenerateKey($minlength = 20, $maxlength = 20, $uselower = true, $useupper = true, $usenumbers = true, $usespecial = false)
	{
		$charset = '';
		if ($uselower) {
			$charset .= "abcdefghijklmnopqrstuvwxyz";
		}
		if ($useupper) {
			$charset .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		}
		if ($usenumbers) {
			$charset .= "0123456789";
		}
		if ($usespecial) {
			$charset .= "~@#$%^*()_+-={}|][";
		}
		if ($minlength > $maxlength) {
			$length = mt_rand($maxlength, $minlength);
		} else {
			$length = mt_rand($minlength, $maxlength);
		}
		$key = '';
		for ($i = 0; $i < $length; $i++) {
			$key .= $charset[(mt_rand(0, strlen($charset) - 1))];
		}
		return $key;
	}

	public function query($sql, $args = null, $values = null)
	{
		$stmt = $this->con->prepare($sql);
		if ($stmt) {
			if (!empty($args) && !empty($values)) {
				$stmt->bind_param($args, $values);
			}
			$stmt->execute();
			$result = $stmt->get_result();
			return $result;
		}
		return false;
	}

	public function hide_email($email)
	{
		$character_set = '+-.0123456789@ABCDEFGHIJKLMNOPQRSTUVWXYZ_abcdefghijklmnopqrstuvwxyz';

		$key = str_shuffle($character_set);
		$cipher_text = '';
		$id = 'e' . rand(1, 999999999);
		for ($i = 0; $i < strlen($email); $i += 1) $cipher_text .= $key[strpos($character_set, $email[$i])];

		$script = 'var a="' . $key . '";var b=a.split("").sort().join("");var c="' . $cipher_text . '";var d="";';
		$script .= 'for(var e=0;e<c.length;e++)d+=b.charAt(a.indexOf(c.charAt(e)));';
		$script .= 'document.getElementById("' . $id . '").innerHTML="<a href=\\"mailto:"+d+"\\">"+d+"</a>"';

		$script = "eval(\"" . str_replace(array("\\", '"'), array("\\\\", '\"'), $script) . "\")";

		$script = '<script type="text/javascript">/*<![CDATA[*/' . $script . '/*]]>*/</script>';

		return '<span id="' . $id . '">[javascript protected email address]</span>' . $script;
	}

	private function upload_image($file, $type)
	{
		$_FILES = $file;
		switch ($type) {
			case "payment-proof":
				$folder = "../../uploads/payment-proof/" . date("Y") . "/" . date("m") . "/";
				if (!is_dir($folder)) mkdir($folder, 0777, true);
				$target_dir = $folder;
				$temp = explode(".", $_FILES["name"]);
				$rand = $this->GenerateKey();
				$oldfilename = "payment-proof-" . time() . "-" . $rand . "." . end($temp);
				break;
		}

		$target_file = $target_dir . basename($_FILES["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
		$check = getimagesize($_FILES["tmp_name"]);
		if ($check !== false) {
			$uploadOk = 1;
		} else {
			$msg = "File is not an image.";
			return json_encode(['code' => 404, 'msg' => $msg]);
		}

		// Check file size
		if ($_FILES["size"] > 5000000) {
			$msg = "Sorry, your file is too large.";
			return json_encode(['code' => 404, 'msg' => $msg]);
		}
		// Allow certain file formats
		if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
			$msg = "Sorry, only JPG, JPEG & PNG files are allowed.";
			return json_encode(['code' => 404, 'msg' => $msg]);
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 1) {
			// if everything is ok, try to upload file
			$newfilename = $target_dir . $oldfilename;
			if (move_uploaded_file($_FILES["tmp_name"], $newfilename)) {
				$path = str_replace("../", null, $target_dir . $oldfilename);
				$msg = "Thumb Uploaded";
				return json_encode(['code' => 200, 'path' => $path, 'msg' => $msg]);
			}
		}
	}

	// +----------------------------+
	// | Bank Related functions
	// +----------------------------+
	## Get all banks / Single bank ##
	public function get_banks()
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => $this->apiurl . 'banks',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'GET',
			// CURLOPT_HTTPHEADER => array(
			//   'x-access-token: '.$this->is_login()
			// ),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		return json_decode($response, true);
	}

	## Account Details ##
	function account_details($ano, $bankcode)
	{
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.paystack.co/bank/resolve?account_number=" . $ano . "&bank_code=" . $bankcode,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => [
				"authorization: Bearer {$this->settings()->paystack_secret_key}",
				"content-type: application/json",
				"cache-control: no-cache"
			],
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		if ($err) {
			return $err;
		}
		$res = json_decode($response);
		$status = $res->status;
		if ($status === false) {
			echo json_encode(['code' => 404, 'msg' => "Account Number / Bank is incorrect"]);
		} else {
			$name = $res->data->account_name;
			return $name;
		}
	}


	## Get URL Content ##
	public function get_content($url)
	{
		$arrContextOptions = array(
			"ssl" => array(
				"verify_peer" => false,
				"verify_peer_name" => false,
			),
		);
		$result = file_get_contents($url, false, stream_context_create($arrContextOptions));
		if (empty($result)) {
			if (function_exists('curl_version')) {
				$curl = curl_init();
				curl_setopt_array($curl, array(
					CURLOPT_URL => $url,
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_CUSTOMREQUEST => "POST",
					CURLOPT_SSL_VERIFYPEER => false
				));
				// curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
				$result = curl_exec($curl);
				curl_close($curl);
			}
		}
		return $result;
	}

	//Clean string
	public function clean($string)
	{
		$string = htmlentities($string);
		return $string;
	}

	## Encrypt string ##
	public function encrypt($string)
	{
		// Store a string into the variable which
		// need to be Encrypted
		$simple_string = $string;
		// Store the cipher method
		$ciphering = "AES-128-CTR";
		// Use OpenSSl Encryption method
		$iv_length = openssl_cipher_iv_length($ciphering);
		$options = 0;
		// Non-NULL Initialization Vector for encryption
		$encryption_iv = 'Rhm2lRLbGwi5m(!!';
		// Store the encryption key
		$encryption_key = "5OZHVomiqK4e62RT1zaFWur0jAY3cEkf";
		// Use openssl_encrypt() public function to encrypt the data
		$encryption = openssl_encrypt(
			$simple_string,
			$ciphering,
			$encryption_key,
			$options,
			$encryption_iv
		);
		return $encryption;
	}

	## Decrypt string ##
	public function decrypt($string)
	{
		$encryption = $string;
		// Store the cipher method
		$ciphering = "AES-128-CTR";
		// Use OpenSSl Encryption method
		$iv_length = openssl_cipher_iv_length($ciphering);
		$options = 0;
		// Non-NULL Initialization Vector for decryption
		$decryption_iv = 'Rhm2lRLbGwi5m(!!';
		// Store the decryption key
		$decryption_key = "5OZHVomiqK4e62RT1zaFWur0jAY3cEkf";
		// Use openssl_decrypt() public function to decrypt the data
		$decryption = openssl_decrypt(
			$encryption,
			$ciphering,
			$decryption_key,
			$options,
			$decryption_iv
		);
		return $decryption;
	}

	//Pretty time
	public function nicetime($date, $timezone = "Africa/Lagos")
	{
		if (!isset($date) && !strtotime($date)) {
			return "Improper Parameter.";
		} else {
			date_default_timezone_set($timezone);
			$now = time();
			$date = $date;
			$periods = array(
				array("second", 1),
				array("minute", 60),
				array("hour", 60),
				array("day", 24),
				array("week", 7),
				array("month", 4.35),
				array("year", 12)
			);
			if ($now > $date) {
				$difference = $now - $date;
				$tense = "ago";
			}
			if ($difference < 120) {
				return "now";
			}
			$figure = $difference;
			for ($index = 1; ($figure >= 1 && ($figure / $periods[$index][1]) >= 1) && $index < count($periods); $index++) {
				$figure /= $periods[$index][1];
				if ($figure != 1) {
					$periods[$index][0] .= "s";
				}
			}
			return round($figure) . " " . $periods[$index - 1][0] . " " . $tense;
		}
	}

	// +----------------------------+
	// | Site processes
	// +----------------------------+

	## Log Action ##
	public function log_action($type, $user_id, $r_id, $amount, $third_party, $extra, $time, $activity = null)
	{
		$time = time();
		$stmt = $this->con->prepare("INSERT INTO site_logs (activity,type,user_id,r_id,amount,third_party,extra,time) VALUES(?,?,?,?,?,?,?,?)");
		$stmt->bind_param("ssiiissi", $activity, $type, $user_id, $r_id, $amount, $third_party, $extra, $time);
		$run = $stmt->execute();
		$res = $stmt->get_result();
		if ($stmt->affected_rows == 1) {
			return true;
		} else {
			return false;
		}
		return false;
	}

	## Transfer to account ##
	public function transfertoaccount($user_id, $ano, $bank, $amount, $method = "paystack")
	{
		$user = $this->user($user_id);
		$uid = $user_id;
		$return['status'] = false;
		$return['msg'] = "Error Occurred";

		if ($method == "paystack") {
			//Create Transfer Recipient
			$curl = curl_init();
			curl_setopt_array($curl, array(
				CURLOPT_URL => "https://api.paystack.co/transferrecipient",
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_CUSTOMREQUEST => "POST",
				CURLOPT_POSTFIELDS => json_encode([
					'type' => "nuban",
					'name' => $user->fname . " " . $user->lname,
					'account_number' => $ano,
					'bank_code' => $bank
				]),
				CURLOPT_HTTPHEADER => [
					"authorization: Bearer {$this->settings()->paystack_secret_key}",
					"content-type: application/json",
					"cache-control: no-cache"
				],
			));

			$response = curl_exec($curl);
			$resp = json_decode($response);
			if ($resp->status !== true) {
				$return['msg'] = $resp->message;
				return $return;
			}

			if ($resp->status === true) {
				$recipient_code = $resp->data->recipient_code;
				//Initialize Transfer
				$curl = curl_init();
				curl_setopt_array($curl, array(
					CURLOPT_URL => "https://api.paystack.co/transfer",
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_CUSTOMREQUEST => "POST",
					CURLOPT_POSTFIELDS => json_encode([
						'source' => "balance",
						'reason' => "Funds Transfer on {$this->settings()->site_title}",
						'amount' => $amount * 100,
						'recipient' => $recipient_code
					]),
					CURLOPT_HTTPHEADER => [
						"authorization: Bearer {$this->settings()->paystack_secret_key}",
						"content-type: application/json",
						"cache-control: no-cache"
					],
				));
				$response = curl_exec($curl);
				$resp = json_decode($response);
				if ($resp->status !== true) {
					$return['msg'] = $resp->message;
					return $return;
				}
				if ($resp->status === true) {
					if ($this->debit_balance($user_id, $amount) === true) {
						$code = $resp->data->transfer_code;
						$return['status'] = true;
						$return['msg'] = true;
						return $return;
					}
				}
			}
			return $return;
		} elseif ($method == "flutterwave") {
		}
	}

	## API Balance ##
	public function api_balance()
	{
		require '../sources/aimtoget/index.php';
		$account = new Account($config);
		echo $account->getBalance();
	}

	## GET ALL SERVICES ##
	public function get_services($view = "all")
	{
		if ($view == "result_checker" || $view == "all") {
			$data = array();
			$ser['id'] = "waec";
			$ser['name'] = "WAEC";
			$ser['image_url'] = $this->siteurl . "/uploads/bills/waec.jpg";
			$ser['description'] = "WAEC result checker pin";
			$ser = (object) $ser;
			$serv['id'] = "neco";
			$serv['name'] = "NECO";
			$serv['image_url'] = $this->siteurl . "/uploads/bills/neco.jpg";
			$serv['description'] = "NECO result checker pin";
			$serv = (object) $serv;
			if ($view != "all") {
				array_push($data, $ser);
				array_push($data, $serv);
				$data = (object) $data;
				return $data;
			}
		}
		global $services;
		$services = $services->getAll();

		if ($view != "all") {
			$data = array();
			foreach ($services as $service) {
				switch ($view) {
					case "cable":
						if ($service->id == "8d92ad62f61bcb71935de41a9fc3be7e" || $service->id == "c5a742666888962a16beea710e269099" || $service->id == "6efa39ac32f035d66473531ed7622483") {
							array_push($data, $service);
						}
						break;
					case "electricity":
						if ($service->id == "79c342927f098de7b9e59292df0aa21d" || $service->id == "e5229a520fe6dee7c391732e9cfa641d" || $service->id == "b16bde7b306effda5f87e5fe8cb9198c" || $service->id == "43e4c01da97b2d1effc24ca5aa712114" || $service->id == "3b009a9c72eb0061cf168b52f7e04b91" || $service->id == "1a92b1306cf1ddf47efda507b9ffa4e9" || $service->id == "1658962e9cf8c65e62d196114b7ca25d" || $service->id == "7a9b92a6e31fa61e602c93d4cd23953d" || $service->id == "6d305107ecc2bba18612723e51aaab20" || $service->id == "6911e809fb0e6862bba275a94c7f97d1") {
							array_push($data, $service);
						}
						break;
					case "internet":
						if ($service->id == "d7b562ec1156e4ef34aa7cebb6c6aee2" || $service->id == "f8046070c618484fb157c314cd1f4c31" || $service->id == "244a035047057f73cd51a4ab06d6c9cc") {
							array_push($data, $service);
						}
						break;
						// case "":
						// 	if ($service->id == "" || $service->id == "" || $service->id == "") {
						// 		array_push($data, $service);
						// 	}
						// 	break;
				}
			}
			return $data;
		} else {
			array_push($services, $ser);
			array_push($services, $serv);
			return $services;
		}
		return false;
	}

	//Network Data plans
	public function data_plans($netword_id)
	{
		$data = new Data($config);
		$plans = $data->getNetworkVariations($network_id);
	}

	public function verify_reference($reference)
	{
		$stmt = $this->con->prepare("SELECT * FROM payment_reference WHERE reference = ?");
		$stmt->bind_param("s", $reference);
		$stmt->execute();
		$result = $stmt->get_result();
		if ($result->num_rows == 0) {
			return false;
		} else {
			$obj = $result->fetch_object();
			if ($obj->used == 1) {
				return false;
			} else {
				return true;
			}
		}
		return false;
	}
	

	## Update payment ##
	public function update_payment($reference, $ref_id, $resp, $auth = null, $user_id = null)
	{
		$resp = json_encode($resp);
		if (!empty($auth) && !empty($user_id)) {
			$stmt = $this->con->prepare("UPDATE users SET charge_auth_code = ? WHERE id = ?");
			$stmt->bind_param("si", $auth, $user_id);
		} else {
			$stmt = $this->con->prepare("UPDATE payment_reference SET response = ?, used = 1 WHERE id = ?");
			$stmt->bind_param("si", $resp, $ref_id);
		}
		$stmt->execute();
		if ($stmt->affected_rows == 1) {
			return true;
		}
		return false;
	}

	## Confirm virtual payment reference ##
	public function confirm_virtual_payment($reference)
	{
		$stmt = $this->con->prepare("SELECT * FROM virtual_account_payments WHERE payment_reference = ?");
		$stmt->bind_param("s", $reference);
		$stmt->execute();
		$result = $stmt->get_result();
		if ($result->num_rows == 0) {
			return true;
		}
		return false;
	}

	## Log payments made tru virtual accounts ##
	public function virtual_payment($payload)
	{
		$response['status'] = true;
		$response['msg'] = "some error occurred";
		if (empty($payload)) return $response;

		$user = $this->user($payload->virtualaccount, "custom_account_number");
		if (empty($user)) {
			$response['msg'] = "No user with accoount number of $payload->virtualaccount was found";
			return $response;
		}

		$date = time();
		$json = json_encode($payload);
		$stmt = $this->con->prepare("INSERT INTO virtual_account_payments (user_id, payment_reference, virtual_account_number, amount, payload, date) VALUES (?,?,?,?,?,?)");
		$stmt->bind_param("issssi", $user->id, $payload->paymentreference, $payload->virtualaccount, $payload->amount, $json, $date);
		$stmt->execute();
		if ($stmt->affected_rows == 1) {
			$trans_id = $this->GenerateKey();
			if ($this->credit_balance($user->id, $payload->amount) === true) {
				$activity = "Deposited {amount} through your virtual account";
				if ($this->register_user_activity($user->id, $activity, null, $payload->amount, $this->user($user->id)->balance, "deposit", "credit", $trans_id) === true) {
					$response['status'] = true;
					$response['msg'] = "success";
				}
			}
		}

		return $response;
	}

	// Function to get the client IP address
	function get_client_ip()
	{
		$ipaddress = '';
		if (isset($_SERVER['HTTP_CLIENT_IP']))
			$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
			$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else if (isset($_SERVER['HTTP_X_FORWARDED']))
			$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
			$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		else if (isset($_SERVER['HTTP_FORWARDED']))
			$ipaddress = $_SERVER['HTTP_FORWARDED'];
		else if (isset($_SERVER['REMOTE_ADDR']))
			$ipaddress = $_SERVER['REMOTE_ADDR'];
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}

	// +-------------------------------+
	// | User related functions
	// +-------------------------------+

	## User logout ##
	public function user_logout()
	{
		session_destroy();
		if (isset($_COOKIE['user_auth_token'])) {
			setcookie("user_auth_token", "", time() - 3600000, "/");
		}
		return true;
	}
	## User last login date ##
	public function set_last_login($user_id)
	{
		$last_login = time() . "--" . $this->get_client_ip();
		$stmt = $this->con->prepare("UPDATE users SET last_login = ? WHERE id = ?");
		$stmt->bind_param("si", $last_login, $user_id);
		$stmt->execute();
		if ($stmt->affected_rows == 1) {
			return true;
		}
		return false;
	}

	## User login ##
	public function user_login($admin = false)
	{
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		$errorMSG = "";
		/* EMAIL */
		if (empty($_POST["email"])) {
			$errorMSG .= "<li>Email is required!</<li>";
		} else {
			$email = $this->clean($_POST["email"]);
		}

		/* PASS */
		if (empty($_POST["password"])) {
			$errorMSG .= "<li>Password is required!</<li>";
		} else {
			$pass = $this->clean($_POST["password"]);
		}

		if (!empty($email)) {
			$stmt = $this->con->prepare("SELECT * FROM users WHERE email = ? OR username = ?");
			$stmt->bind_param("ss", $email, $email);
			$stmt->execute();
			$result = $stmt->get_result();
			if ($result->num_rows == 0) {
				$msg = "User Does not Exist";
				echo json_encode(['code' => 404, 'msg' => $msg]);
				exit;
			}
		}

		if (empty($errorMSG)) {
			$put = $this->con->prepare("SELECT * FROM users WHERE email=? OR username = ?");
			$put->bind_param("ss", $email, $email);
			$putresult = $put->execute();
			if ($putresult) {
				$result = $put->get_result();
				while ($row = $result->fetch_assoc()) {
					$rowpass = $row['password'];
					if (!password_verify($pass, $rowpass)) {
						$msg = "Invalid Login";
						echo json_encode(['code' => 404, 'msg' => $msg]);
						exit;
					} else {
						if ($admin === true) {
							if (($row['type'] !== "admin") && ($row['type'] !== "super-admin")) {
								$msg = "Invalid Login";
								echo json_encode(['code' => 404, 'msg' => $msg]);
								exit;
							}
						}
						$token = $this->setUserToken($row['id']);
						$_SESSION['user_auth_token'] = $token;
						setcookie("user_auth_token", $token, time() + (60 * 60 * 24 * 10), "/", "", false, true);
						$put->close();
						$msg = "successful";

						// Set user Last login date / ip
						$this->set_last_login($row['id']);

						if ($admin === true) {
							echo json_encode(['code' => 200, 'url' => $this->siteurl . "/admin-cp", 'msg' => $msg]);
							exit;
						}
						echo json_encode(['code' => 200, 'url' => $this->siteurl . "/account", 'msg' => $msg]);
						exit;
					}
				}
			} else {
				$msg = "Error occurred";
				echo json_encode(['code' => 500, 'msg' => $msg]);
				exit;
			}
		} elseif (!empty($errorMSG)) {
			echo json_encode(['code' => 400, 'msg' => $errorMSG]);
			exit;
		}
	}

	## User registration ##
	public function user_register()
	{
		$mysqli = $this->con;

		$errorMSG = "";
		session_start();

		if (!empty($_SESSION['referral'])) {
			// $reff = $this->decrypt($_SESSION['referral']);
			$reff = $this->clean($_SESSION['referral']);
			$reff = $this->user($reff, "username");
			$ref = $reff->id;
		} else {
			$ref = null;
		}

		/* FIRST NAME */
		if (empty($_POST["fname"])) {
			$errorMSG .= "<li>First Name is required!</<li>";
		} else {
			$fname = $this->clean($_POST["fname"]);
		}

		/* LAST NAME */
		if (empty($_POST["lname"])) {
			$errorMSG .= "<li>Last Name is required!</<li>";
		} else {
			$lname = $this->clean($_POST["lname"]);
		}

		/* USERNAME */
		if (empty($_POST["username"])) {
			$errorMSG .= "<li>Username is required!</<li>";
		} else {
			$user = $this->clean($_POST["username"]);
			$user = str_replace(" ", null, $user);
		}

		/* PHONE */
		if (empty($_POST["phone"])) {
			$phone = null;
		} else {
			$phone = $this->clean($_POST["phone"]);
		}

		/* EMAIL */
		if (empty($_POST["email"])) {
			$errorMSG .= "<li>Email is required</li>";
		} elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
			$errorMSG .= "<li>Invalid email format</li>";
		} else {
			$email = $this->clean($_POST["email"]);
		}

		/* PASS */
		if (empty($_POST["password"])) {
			$errorMSG .= "<li>Password is required!</<li>";
		} else {
			$pass = $this->clean($_POST["password"]);
		}
		/* R PASS */
		if (empty($_POST["repeat_password"])) {
			$errorMSG .= "<li>Passwords must be identical</<li>";
		} else {
			$rpass = $this->clean($_POST["repeat_password"]);
		}
		if (!empty($pass) && !empty($rpass) && $pass != $rpass) {
			$errorMSG .= "Passwords don't match";
		}

		$pass = password_hash($pass, PASSWORD_DEFAULT);

		if (empty($errorMSG)) {
			$stmt = $mysqli->prepare("SELECT * FROM users WHERE email = ? OR username=?");
			$stmt->bind_param("ss", $email, $user);
			$stmt->execute();
			$result = $stmt->get_result();
			//check if user exists
			if ($result->num_rows !== 0) {
				$errorMSG = "<li>Username / Email Already taken</li>";
				echo json_encode(['code' => 404, 'msg' => $errorMSG]);
				exit;
			} else {
				date_default_timezone_set("Africa/Lagos");
				$date = time();
				$put = $mysqli->prepare("INSERT INTO users (fname,lname,username,email,phone,password,doj) VALUES(?,?,?,?,?,?,?)");
				$put->bind_param("sssssss", $fname, $lname, $user, $email, $phone, $pass, $date);
				$putresult = $put->execute();
				if ($putresult) {
					$uid = $mysqli->insert_id;
					if ($ref !== null) {
						$put = $mysqli->prepare("INSERT INTO referrals (user_id,ref_id,date) VALUES(?,?,?)");
						$put->bind_param("iii", $uid, $ref, $date);
						if ($put->execute()) {
							$msg = "successful";
							echo json_encode(['code' => 200, 'url' => $this->siteurl . "/login", 'msg' => $msg]);
							exit;
						} else {
							$msg = "successful";
							echo json_encode(['code' => 200, 'url' => $this->siteurl . "/login", 'msg' => $msg]);
							exit;
						}
					}
					$msg = "successful";
					echo json_encode(['code' => 200, 'url' => $this->siteurl . "/login", 'msg' => $msg]);
				} else {
					$msg = "Error occurred";
					echo json_encode(['code' => 400, 'msg' => $msg]);
				}
			}
		} elseif (!empty($errorMSG)) {
			echo json_encode(['code' => 404, 'msg' => $errorMSG]);
			exit;
		}
	}

	## Reserve User account ##
	public function reserve_account($user_id, $method = "rubbies")
	{
		$user = $this->user($user_id);

		// REQUIRES VERIFIED BUSINESS ACCOUNT, NOT TESTED //
		if ($method == "paystack") {
			$url = "https://api.paystack.co/customer";
			$fields = [
				'email' => $user->email,
				'first_name' => $user->fname,
				'last_name' => $user->lname,
				'phone' => $user->phone,
				'metadata' => array(
					"user_id" => $this->encrypt($user_id)
				),
			];
			$fields_string = http_build_query($fields);
			//open connection
			$ch = curl_init();

			//set the url, number of POST vars, POST data
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				"Authorization: Bearer {$this->settings()->paystack_secret_key}",
				"Cache-Control: no-cache",
			));

			//So that curl_exec returns the contents of the cURL; rather than echoing it
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			//execute post
			$result = curl_exec($ch);
			$result = json_decode($result);

			if ($result->status === false) return false;
			$customer_code = $result->data->customer_code;
			$customer_id = $result->data->id;
			$customer = $customer_code . "--" . $customer_id;
			$stmt = $this->con->prepare("UPDATE users SET paystack_customer_code = ? WHERE id = ?");
			$stmt->bind_param("si", $customer, $user_id);
			$stmt->execute();
			if ($stmt->affected_rows == 1) {
				$curl = curl_init();
				curl_setopt_array($curl, array(
					CURLOPT_URL => "https://api.paystack.co/customer/" . $result->data->customer_code,
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => "",
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 30,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => "GET",
					CURLOPT_HTTPHEADER => array(
						"Authorization: Bearer {$this->settings()->paystack_secret_key}",
						"Cache-Control: no-cache",
					),
				));
				$response = curl_exec($curl);
				$res = json_decode($response);
				$err = curl_error($curl);
				curl_close($curl);

				$url = "https://api.paystack.co/dedicated_account";
				$fields = [
					"customer" => $customer_code,
					"preferred_bank" => "providus-bank"
				];
				$fields_string = http_build_query($fields);
				//open connection
				$ch = curl_init();

				//set the url, number of POST vars, POST data
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
				curl_setopt($ch, CURLOPT_HTTPHEADER, array(
					"Authorization: Bearer " . $this->settings()->paystack_secret_key,
					"Cache-Control: no-cache",
				));

				//So that curl_exec returns the contents of the cURL; rather than echoing it
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

				//execute post
				$result = curl_exec($ch);
				$result = json_decode($result);
				print_r($result);

				if ($result->status === true) {
					$account_number = $result->data->account_number;
					$account_name = $result->data->account_name;
					$account_number = $result->data->account_number;
					$stmt = $this->con->prepare("UPDATE users SET custom_account_number = ?, custom_account_name = ?, custom_account_bank = ? WHERE id = ?");
					$stmt->bind_param("issi", $account_number, $account_name, $bank_name, $user_id);
					$stmt->execute();
					if ($stmt->affected_rows == 1) {
						return true;
					}
				} else {
					return false;
				}
			}
			return false;
		}
		// END paystack method

		elseif ($method == "rubbies") {
			$secret_key = $this->settings()->rubies_secret_key;
			$callback = $this->siteurl . "/payment-callback/virtual";
			$curl = curl_init();

			curl_setopt_array($curl, array(
				CURLOPT_URL => "https://openapi.rubiesbank.io/v1/createvirtualaccount",
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "POST",
				CURLOPT_POSTFIELDS => "{\n    \"virtualaccountname\": \"$user->name\",\n    \"amount\": \"1\",\n    \"amountcontrol\": \"VARIABLEAMOUNT\",\n    \"daysactive\": 1000,\n    \"minutesactive\": 30,\n    \"callbackurl\": \"$callback\"\n}",
				CURLOPT_HTTPHEADER => array(
					"Authorization: $secret_key",
					"Content-Type: application/json"
				),
			));

			$response = curl_exec($curl);
			curl_close($curl);
			$resp = json_decode($response);
			if ($resp->responsecode == "00") {
				$stmt = $this->con->prepare("UPDATE users SET custom_account_number = ?, custom_account_name = ?, custom_account_bank = ?, custom_account_ref = ? WHERE id = ?");
				$stmt->bind_param("isssi", $resp->virtualaccount, $resp->virtualaccountname, $resp->bankname, $resp->bankcode, $user_id);
				$stmt->execute();
				if ($stmt->affected_rows == 1) {
					return true;
				}
				return false;
			}
		}
	}

	## Is user logged in ##
	public function user_logged_in()
	{
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if (isset($_SESSION['user_auth_token'])) {
			$token = $_SESSION['user_auth_token'];
			$id = $this->get_user_id($token);
			if (is_numeric($id) && !empty($id)) {
				return true;
			}
		} else {
			if (isset($_COOKIE['user_auth_token'])) {
				$token = $_COOKIE['user_auth_token'];
				$id = $this->get_user_id($token);
				if (is_numeric($id) && !empty($id)) {
					return true;
				}
			}
		}
		return false;
	}

	## USer session ##
	public function user_session()
	{
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if (!empty($_SESSION['user_auth_token'])) {
			$token = $this->clean($_SESSION['user_auth_token']);
			$id = $this->get_user_id($token);
			if (is_numeric($id) && !empty($id)) {
				return $id;
			}
		} else {
			if (!empty($_COOKIE['user_auth_token'])) {
				$token = $this->clean($_COOKIE['user_auth_token']);
				$id = $this->get_user_id($token);
				if (is_numeric($id) && !empty($id)) {
					return $id;
				}
			}
		}
		return false;
	}

	## Get user id ##
	private function get_user_id($token)
	{
		$query = "SELECT id FROM users WHERE login_token = ?";
		$stmt = $this->con->prepare($query);
		$stmt->bind_param("s", $token);
		if ($stmt->execute()) {
			$res = $stmt->get_result();
			$obj = $res->fetch_object();
			return $obj->id;
		}
		return false;
	}

	## Login token ##
	private function setUserToken($user_id)
	{
		$token = bin2hex(random_bytes(12));
		// If you get an error concerning the above,
		// comment the above line and uncomment the next line.
		// $token = bin2hex(openssl_random_pseudo_bytes(12));
		$query = "UPDATE users SET login_token = ? WHERE id = ?";
		$stmt = $this->con->prepare($query);
		$stmt->bind_param("si", $token, $user_id);
		if ($stmt->execute()) {
			return $token;
		}
		return false;
	}

	## Single User ##
	public function user($user_id, $selector = null)
	{
		$user_id = $this->clean($user_id);
		if (!empty($selector)) {
			$stmt = $this->con->prepare("SELECT * FROM users WHERE $selector = ? LIMIT 1");
			$stmt->bind_param("s", $user_id);
		} else {
			$stmt = $this->con->prepare("SELECT * FROM users WHERE id = ? LIMIT 1");
			$stmt->bind_param("i", $user_id);
		}

		$stmt->execute();
		$res = $stmt->get_result();
		$obj = $res->fetch_object();
		if (empty($obj)) {
			return;
		}
		unset($obj->password);
		$obj->profilepic = $this->siteurl . "/account/assets/profilepics/" . $obj->profilepic;
		$obj->name = $obj->fname . ' ' . $obj->lname;
		$obj->data = $this->user_data($obj->id);
		$obj->activity = $this->user_activity($obj->id);
		$obj->funds_requests = $this->user_funds_requests($obj->id);
		$obj->loan_requests = $this->user_loan_requests($obj->id);
		$obj->referrals = $this->user_referrals($obj->id);
		$obj->credit_cards = $this->user_credit_cards($obj->id);
		$obj->ref_link = "{$this->siteurl}/share/{$obj->username}";
		$obj->is_referred = $this->user_is_referred($obj->id);
		$obj->ref = $this->user_ref($obj->id);
		$obj->has_deposit = $this->user_has_deposit($obj->id);
		if ($obj->is_developer == 1) {
			$obj->api = $this->user_api($obj->id);
		}
		return $obj;
	}

	## User Data ##
	private function user_data($user_id)
	{
		$user_id = $this->clean($user_id);
		$stmt = $this->con->prepare("SELECT * FROM userdata WHERE user_id = ? LIMIT 1");
		$stmt->bind_param("i", $user_id);
		$run = $stmt->execute();
		$res = $stmt->get_result();
		$obj = $res->fetch_object();
		return $obj;
	}

	## Check if user has deposited ##
	private function user_has_deposit($user_id)
	{
		$stmt = $this->con->prepare("SELECT * FROM activities WHERE user_id = ? AND type = 'deposit'");
		$stmt->bind_param("i", $user_id);
		$stmt->execute();
		$stmt->store_result();
		if ($stmt->num_rows > 0) {
			return true;
		}
		return false;
	}

	## Checks if current user was referred ##
	private function user_is_referred($user_id)
	{
		$stmt = $this->con->prepare("SELECT * FROM referrals WHERE user_id = ?");
		$stmt->bind_param("i", $user_id);
		$stmt->execute();
		$res = $stmt->get_result();
		if ($res->num_rows != 0) {
			return true;
		}
		return false;
	}

	## Returns the user's referrer if user was referred
	private function user_ref($user_id)
	{
		$stmt = $this->con->prepare("SELECT * FROM referrals WHERE user_id = ?");
		$stmt->bind_param("i", $user_id);
		$stmt->execute();
		$res = $stmt->get_result();
		if ($res->num_rows != 0) {
			$obj = $res->fetch_object();
			return $obj->ref_id;
		}
		return false;
	}

	## Returns the user's referrer if user was referred
	private function user_api($user_id)
	{
		$stmt = $this->con->prepare("SELECT * FROM api_requests WHERE user_id = ? LIMIT 1");
		$stmt->bind_param("i", $user_id);
		$stmt->execute();
		$res = $stmt->get_result();
		if ($res->num_rows != 0) {
			$obj = $res->fetch_object();
			$obj->domain = parse_url($obj->site_url)['host'];
			return $obj;
		}
		return false;
	}

	## User Activity ##
	private function user_activity($user_id)
	{
		$data = array();
		$user_id = $this->clean($user_id);
		$stmt = $this->con->prepare("SELECT * FROM activities WHERE user_id = ? ORDER BY id DESC");
		$stmt->bind_param("i", $user_id);
		$run = $stmt->execute();
		$res = $stmt->get_result();
		while ($obj = $res->fetch_object()) {
			$obj->activity = str_replace("{amount}", $this->coin . number_format($obj->amount), $obj->activity);
			if ($obj->type == "deposit") {
				$obj->activity = "You " . $obj->activity;
			}
			// $obj->activity = str_replace("{user}", $obj->user, $obj->activity);
			array_push($data, $obj);
		}
		return $data;
	}

	//User Notifications
	public function user_notifications($user_id)
	{
		$data = array();
		$user_id = $this->clean($user_id);
		$stmt = $this->con->prepare("SELECT * FROM notifications WHERE user_id = ? AND seen = 0 ORDER BY id DESC");
		$stmt->bind_param("i", $user_id);
		$run = $stmt->execute();
		$res = $stmt->get_result();
		while ($obj = $res->fetch_object()) {
			$obj->text = str_replace("{coin}", $this->coin, $obj->text);
			// $obj->text = preg_replace("/[0-9]/", $this->coin, $obj->text);
			array_push($data, $obj);
		}
		// print_r($data);
		return $data;
	}
	//User Fund Requests
	private function user_funds_requests($user_id)
	{
		$data = array();
		$user_id = $this->clean($user_id);
		$stmt = $this->con->prepare("SELECT * FROM funds_requests WHERE s_id = ? ORDER BY id DESC");
		$stmt->bind_param("i", $user_id);
		$run = $stmt->execute();
		$res = $stmt->get_result();
		while ($obj = $res->fetch_object()) {
			array_push($data, $obj);
		}
		return $data;
	}

	//User Loan Requests
	private function user_loan_requests($user_id)
	{
		$data = array();
		$user_id = $this->clean($user_id);
		$stmt = $this->con->prepare("SELECT * FROM loan_requests WHERE user_id = ? AND paid = 'yes' ORDER BY id DESC");
		$stmt->bind_param("i", $user_id);
		$run = $stmt->execute();
		$res = $stmt->get_result();
		while ($obj = $res->fetch_object()) {
			array_push($data, $obj);
		}
		return $data;
	}
	//User Referrals
	private function user_referrals($user_id)
	{
		$data = array();
		$user_id = $this->clean($user_id);
		$stmt = $this->con->prepare("SELECT * FROM referrals WHERE ref_id = ? ORDER BY id desc");
		$stmt->bind_param("i", $user_id);
		$run = $stmt->execute();
		$res = $stmt->get_result();
		while ($obj = $res->fetch_object()) {
			array_push($data, $obj);
		}
		return $data;
	}
	private function user_credit_cards($user_id)
	{
		$data = array();
		$stmt = $this->con->prepare("SELECT * FROM credit_cards WHERE user_id = ? AND card_id != '' AND deleted != 1 ORDER BY id DESC");
		$stmt->bind_param("i", $user_id);
		$stmt->execute();
		$res = $stmt->get_result();
		while ($obj = $res->fetch_object()) {
			array_push($data, $obj);
		}
		return $data;
	}

	## Change user pass ##
	public function change_password($user_id, $old_pass, $new_pass)
	{
		$response['status'] = false;
		$response['msg'] = "Error Occurred";

		$stmt = $this->con->prepare("SELECT email,password from users where id = ?");
		$stmt->bind_param("i", $user_id);
		$stmt->execute();
		$result = $stmt->get_result();
		if ($result->num_rows == 0) {
			$response['msg'] = "Couldn't change password";
		}
		$obj = $result->fetch_object();
		$real_pass = $obj->password;
		if (!password_verify($old_pass, $real_pass)) {
			$response['msg'] = "Incorrect Password";
			return $response;
		}

		// You're supposed to verify the user's identity

		$new_pass = password_hash($new_pass, PASSWORD_DEFAULT);
		$stmt = $this->con->prepare("UPDATE users SET password = ? WHERE id = ?");
		$stmt->bind_param("si", $new_pass, $user_id);
		$stmt->execute();
		if ($stmt->affected_rows == 1) {
			$message = "Dear user, a password change was made on your acount with {$this->settings()->site_title}. \n If you didn't make this request, contact our support team to reverse it and secure your account";
			$this->mail($obj->email, "Password Change", $message);
			// Register activity
			$response['status'] = true;
			$response['msg'] = "Password change successful";
		} else {
			$response['msg'] = "Password wasn't changed";
		}

		return $response;
	}

	## Edit User ##
	public function edit_profile($user_id, $data, $action = "update")
	{
		if (empty($this->user($user_id)) || !is_numeric($user_id)) {
			return false;
		}
		switch ($action) {
			case "update":
				$stmt = $this->con->prepare("UPDATE users SET fname = ?, lname = ?, gender = ?, phone = ? WHERE id = ?");
				$stmt->bind_param("ssssi", $data['fname'], $data['lname'], $data['gender'], $data['phone'], $user_id);
				if ($stmt->execute() === true) {
					if ($stmt->affected_rows > 0) {
						return true;
					}
				}
				break;
		}

		return false;
	}

	## Add user balance ##
	public function credit_balance($user_id, $amount)
	{
		$amount = $this->clean($amount);
		$user_id = $this->clean($user_id);
		if (!$this->user($user_id)) return false;
		if (!is_numeric($amount) || $amount < 0) return false;
		$stmt = $this->con->prepare("UPDATE users SET balance = balance+? WHERE id = ?");
		$stmt->bind_param("si", $amount, $user_id);
		$stmt->execute();
		if ($stmt->affected_rows == 0) {
			return false;
		} else {
			return true;
		}
	}

	## Deduct user balance ##
	public function debit_balance($user_id, $amount)
	{
		$amount = $this->clean($amount);
		$user_id = $this->clean($user_id);
		if (!$this->user($user_id)) return false;
		if (!is_numeric($amount) || $amount < 0) return false;
		$stmt = $this->con->prepare("UPDATE users SET balance = balance-? WHERE id = ?");
		$stmt->bind_param("si", $amount, $user_id);
		$stmt->execute();
		if ($stmt->affected_rows == 0) {
			return false;
		} else {
			return true;
		}
	}

	## Validate Credit Card ##
	function validate_credit_card($number)
	{
		include '../../sources/validate-credit-card.php';
		if (!empty($valid)) {
			return $valid;
		} else {
			return false;
		}
	}

	## Save Card ##
	public function savecard($user_id, $card_number, $type)
	{
		$response['status'] = false;
		$date = time();
		$stmt = $this->con->prepare("INSERT INTO credit_cards (user_id,card_number,type,date) VALUES(?,?,?,?)");
		$stmt->bind_param("iiss", $user_id, $card_number, $type, $date);
		$stmt->execute();
		if ($stmt->affected_rows == 1) {
			$ins = $stmt->insert_id;
			$user = $this->user($user_id);
			$trans_id = $this->GenerateKey(8, 8, false, false, true, false);
			$curl = curl_init();
			curl_setopt_array($curl, array(
				CURLOPT_URL => "https://api.paystack.co/transaction/initialize",
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_CUSTOMREQUEST => "POST",
				CURLOPT_POSTFIELDS => json_encode([
					'amount' => $this->settings()->card_fee * 100,
					'email' => $user->email,
					'callback_url' => $this->siteurl . "/payment-callback/add-card?trans_id=$trans_id&action_id=$ins",
					'channels' => ['card']
				]),
				CURLOPT_HTTPHEADER => [
					"authorization: Bearer {$this->settings()->paystack_secret_key}",
					"content-type: application/json",
					"cache-control: no-cache"
				],
			));

			$resp = curl_exec($curl);
			$err = curl_error($curl);

			$tranx = json_decode($resp, true);
			if ($tranx['status'] == false) {
				return $response;
			}

			$reference = $tranx['data']['reference'];
			$method = "add-card";
			$stmt = $this->con->prepare("INSERT INTO payment_reference (user_id,trans_id,method,reference,amount,date) VALUES (?,?,?,?,?,?)");
			$stmt->bind_param("iissii", $user_id, $trans_id, $method, $reference, $amount, $date);
			$stmt->execute();
			if ($stmt->affected_rows == 1) {
				$ref_id = $stmt->insert_id;
				$ret = $trans_id . "--" . $ref_id;
				$stmt = $this->con->prepare("UPDATE users SET reference = '$ret' WHERE id = '$user_id'");
				$stmt->execute();
				$response['status'] = true;
				$response['url'] = $tranx['data']['authorization_url'];
			}
			return $response;
		}

		return $response;
	}

	## Save Card 2 ##
	public function save_card($id, $bin, $last4, $type, $auth, $bank, $exp_month, $exp_year, $signature)
	{
		$stmt = $this->con->prepare("UPDATE credit_cards SET bin = ?, last4 = ?, type = ?, auth_code = ?, bank = ?, exp_month = ?, exp_year = ?, signature = ? WHERE id = ?");
		$stmt->bind_param("ssssssisi", $bin, $last4, $type, $auth, $bank, $exp_month, $exp_year, $signature, $id);
		$stmt->execute();
		if ($stmt->affected_rows === 1) {
			return true;
		}
		return false;
	}

	## EDIT CARD ##
	public function edit_card($user_id, $card_id, $action)
	{
		$response['status'] = false;
		$response['msg'] = "Some error occurred";
		if ($action != "disable" && $action != "delete" && $action != "enable") return $response;
		if ($action == "disable") {
			$stmt = $this->con->prepare("UPDATE credit_cards SET disabled = 1 where signature = ? AND user_id = ?");
		} elseif ($action == "enable") {
			$stmt = $this->con->prepare("UPDATE credit_cards SET disabled = 0 where signature = ? AND user_id = ?");
		} elseif ($action == "delete") {
			$stmt = $this->con->prepare("UPDATE credit_cards SET deleted = 1 where signature = ? AND user_id = ?");
		}
		$stmt->bind_param("si", $card_id, $user_id);
		$stmt->execute();
		if ($stmt->affected_rows == 1) {
			$response['status'] = true;
			$response['msg'] = "Card {$action}d successfully";
		}

		return $response;
	}

	## Pay with Card ##
	public function pay_with_card($user_id, $card_id, $amount)
	{
		$response['status'] = false;
		$response['msg'] = "Some error occurred";

		$stmt = $this->con->prepare("SELECT * FROM credit_cards WHERE signature = ? AND user_id = ?");
		$stmt->bind_param("si", $card_id, $user_id);
		$stmt->execute();
		$result = $stmt->get_result();
		if ($result->num_rows == 0) {
			$response['msg'] = "Card not found for particular user";
		} else {
			$obj = $result->fetch_object();
			// $user = $this->user($user_id);
			$curl = curl_init();
			curl_setopt_array($curl, array(
				CURLOPT_URL => "https://api.paystack.co/transaction/charge_authorization",
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_CUSTOMREQUEST => "POST",
				CURLOPT_POSTFIELDS => json_encode([
					'authorization_code' => $obj->auth_code,
					'email' => $this->user($user_id)->email,
					'amount' => $amount * 100
				]),
				CURLOPT_HTTPHEADER => [
					"authorization: Bearer " . $this->settings()->paystack_secret_key,
					"content-type: application/json",
					"cache-control: no-cache"
				],
			));

			$resp = curl_exec($curl);
			$resp = json_decode($resp);
			if ($resp->status !== true) {
				$response['msg'] = "Card Charge failed";
			} else {
				if ($amount == ($resp->data->amount / 100) && $resp->data->status == "success") {
					$response['status'] = true;
					$response['msg'] = "Charge successful";
				}
			}
		}

		return $response;
	}

	## Register notification ##
	public function register_notification($from_id, $to_id, $text, $link, $type)
	{
		$from_id = $this->clean($from_id);
		$to_id = $this->clean($to_id);
		$text = $this->clean($text);
		$link = $this->clean($link);
		$time = time();
		$query = "INSERT INTO notifications (from_id,user_id,text,link,type,time) VALUES(?,?,?,?,?,?)";
		$stmt = $this->con->prepare($query);
		$stmt->bind_param("iisssi", $from_id, $to_id, $text, $link, $type, $time);
		if ($stmt->execute() === true) {
			return true;
		}
		return false;
	}

	public function register_user_activity($user_id, $activity, $link, $amount, $balance, $type, $type2, $trans_id = false)
	{
		$time = time();
		if (empty($trans_id)) {
			$trans_id = $this->GenerateKey(8, 8, false, false, true, false);
		}
		$stmt = $this->con->prepare("INSERT INTO activity (user_id, trans_id, activity, link, amount, balance, type, type2, time) VALUES(?,?,?,?,?,?,?,?,?)");
		$stmt->bind_param("iissiissi", $user_id, $trans_id, $activity, $link, $amount, $balance, $type, $type2, $time);
		$stmt->execute();
		if ($stmt->affected_rows == 1) {
			return true;
		} else {
			return false;
		}
		return false;
	}

	public function send_wallet($user_id, $send_id, $amount, $reason = null)
	{
		$response['status'] = false;
		if ($this->credit_balance($send_id, $amount) === true && $this->debit_balance($user_id, $amount) === true) {
			$text = "You sent {amount} to {$this->user($send_id)->username}'s wallet. Reason : $reason";
			$req = $this->register_user_activity($user_id, $text, null, $amount, $this->user($user_id)->balance, "send-wallet", "debit");

			$text2 = "You received {amount} from {user--$user_id} Reason : $reason";
			$req2 = $this->register_user_activity($send_id, $text2, null, $amount, $this->user($send_id)->balance, "send-wallet", "credit");
			$amount = number_format($amount);
			$text2 = "You received {$amount} from {$this->user($user_id)->username} Reason : $reason";
			$notify = $this->register_notification($user_id, $send_id, $text2, null, "credit");
			if ($req === true && $req2 === true && $notify === true) {
				$response['status'] = true;
				return $response;
			}
		}
		return $response;
	}

	public function request_funds($user_id, $send_id, $amount, $reason)
	{
		$response['status'] = false;
		$stmt = $this->con->prepare("INSERT INTO funds_requests (user_id,s_id,amount,reason) VALUES (?,?,?,?)");
		$stmt->bind_param("iiis", $user_id, $send_id, $amount, $reason);
		$stmt->execute();
		if ($stmt->affected_rows == 1) {
			$amount = number_format($amount);
			$text = "You sent a funds request of {$amount} to {$this->user($send_id)->name}";
			$notify = $this->register_notification($user_id, $user_id, $text, null, "funds-request");
			$text2 = "{$this->user($user_id)->name} sent a funds request of {$amount}";
			$notify2 = $this->register_notification($user_id, $send_id, $text2, null, "funds-request");
			if ($notify === true) {
				$response['status'] = true;
			}
		}
		return $response;
	}

	## Buy Airtime ##
	public function buy_airtime($user_id, $amount, $phone, $network, $card = false)
	{

		$response['status'] = false;
		$response['msg'] = "Airtime purchase failed. \nYou weren't debited. \nPlease contact support if error presists";
		$method = $this->settings()->airtime_api;

		// Aimtoget (Recommended)
		if ($method == "aimtoget") {
			require '../../sources/aimtoget/index.php';

			$discount = $this->settings()->discount_airtime / 100;
			$newam = $amount * $discount;
			$newam = $amount - $newam;

			//Purchase Airtime
			if (empty($card)) {
				try {
					$reference = $airtime->purchase([
						'phone' => $phone,
						'network_id' => $network,
						'amount' => $amount
					]);
				}
				//catch exception
				catch (Exception $e) {
					$this->log_error($e);
					$response['msg'] = $e->getMessage();
					if ($response['msg'] == "Insufficient wallet balance" || $response['msg'] == "Insufficient funds") {
						$response['msg'] = "API balance insufficient. Please contact admin";
					}
					return $response;
				}
			} else { // Card payment
				$request = $this->pay_with_card($user_id, $card, $newam);
				if ($request['status'] !== true) {
					$this->log_error("User {$this->user($user_id)->email} tried to purchase airtime but their card payment didn't go through", "custom");
					$response['msg'] = $request['msg'];
					return $response;
				}
				$reference = true;
				$req = true;
			}

			if (!empty($reference)) {

				if (empty($card)) {
					$req = $this->debit_balance($user_id, $newam);
				}

				if ($req === true) {
					$text = "Airtime Purchase of " . $this->coin . $amount . "to $phone";
					$this->register_user_activity($user_id, $text, null, $amount, $this->user($user_id)->balance, "airtime", "debit");
					$response['status'] = true;
					$response['msg'] = "Airtime purchase successful! You were charged {$this->coin}{$newam}";
				} else {
					$response['msg'] = "User account not debitted for some reason";
				}
			}
		}

		// MobileNIG method
		elseif ($method == "mobilenig") {
			switch ($network) {
				case 1:
					$network = "MTN";
					break;
				case 2:
					$network = "AIRTEL";
					break;
				case 3:
					$network = "9MOBILE";
					break;
				case 4:
					$network = "GLO";
					break;
			}
			$username = $this->settings()->mobile_nig_username;
			$trans_id = $this->GenerateKey(20, 20, false, false, true, false);
			$api_key =  $this->settings()->mobile_nig_api_key;
			$retdata = $user_id . "--" . $amount;
			$ret_url = $this->siteurl . "/payment-callback/airtime?data=$retdata";

			$req = "https://mobilenig.com/API/airtime_premium?username={$username}&api_key={$api_key}&network={$network}&phoneNumber={$phone}&amount={$amount}&trans_id={$trans_id}&return_url={$ret_url}";

			$discount = $this->settings()->discount_airtime / 100;
			$newam = $amount * $discount;
			$newam = $amount - $newam;

			if (empty($card)) {
				try {
					$data = file_get_contents($req);
				} catch (Exception $e) {
					$this->log_error($e);
					return $response;
				}

				$data = json_decode($data);
			} else { // Card Payment
				$request = $this->pay_with_card($user_id, $card, $newam);
				if ($request['status'] !== true) {
					$this->log_error("User {$this->user($user_id)->email} tried to purchase airtime but their card payment didn't go through", "custom");
					$response['msg'] = $request['msg'];
					return $response;
				}

				$text = "Airtime Purchase of " . $this->coin . $amount . "to $phone";
				$this->register_user_activity($user_id, $text, null, $amount, $this->user($user_id)->balance, "airtime", "debit");
				$response['status'] = true;
				$response['msg'] = "Airtime purchase successful! You were charged {$this->coin}{$newam}";
				return $response;
			}

			if (!empty($data->trans_id)) {
				$req = $this->debit_balance($user_id, $newam);

				if ($req === true) {
					$text = "Airtime Purchase of " . $this->coin . $amount;
					$this->register_user_activity($user_id, $text, null, $amount, $this->user($user_id)->balance, "airtime", "debit");
					$response['status'] = true;
					$response['msg'] = "Airtime purchase successful! You were charged {$this->coin}{$newam}";
				} else {
					$response['msg'] = "User account not debitted for some reason";
				}
			} else {
				if (!empty($data->code) && $data->code == "ERR106") {
					$msg = "Mobile Airtime Error \n --- " . $data->code . " --- " . $data->description;
					$this->log_error($msg, "custom");
					return $response;
				}
			}
		}
		return $response;
	}

	## Buy Data ##
	public function buy_data($user_id, $variation, $phone, $network, $amount)
	{

		$response['status'] = false;
		$response['msg'] = "Data purchase failed. \nYou weren't debited. \nPlease contact support if error presists";

		$method = $this->settings()->data_api;
		if ($method == "aimtoget") {
			require '../../sources/aimtoget/index.php';
			//Purchase Data
			try {
				//Purchase 1GB of MTN data
				$reference = $data_req->purchase([
					'phone' => $phone,
					'network_id' => $network,
					'variation' => $variation
				]);
			}
			//catch exception
			catch (Exception $e) {
				$this->log_error($e);
				$response['msg'] = $e->getMessage();
				if ($response['msg'] == "Insufficient wallet balance" || $response['msg'] == "Insufficient funds") {
					$response['msg'] = "API balance insufficient. Please contact admin";
				}
				return $response;
			}
			if (!empty($reference)) {
				$discount = $this->settings()->discount_data / 100;
				$newam = $amount * $discount;
				$newam = $amount - $newam;
				if ($this->debit_balance($user_id, $newam) === true) {
					$text = "Data Purchase of " . $this->coin . $amount . "to $phone";
					$this->register_user_activity($user_id, $text, null, $amount, $this->user($user_id)->balance, "data", "debit");
					$response['status'] = true;
					$response['msg'] = "Data purchase successful! You were charged {$this->coin}{$newam}";
				}
			}
		}

		// MobileNig method
		elseif ($method == "mobilenig") {
			switch ($network) {
				case 1:
					$network = "MTN";
					break;
				case 2:
					$network = "AIRTEL";
					break;
				case 3:
					$network = "9MOBILE";
					break;
				case 4:
					$network = "GLO";
					break;
			}

			$token = $this->GenerateKey(20, 20, false, false, true, false);
			$ret_url = $this->siteurl . "/payment-callback/data";

			$req = "https://mobilenig.com/API/data?username={$this->settings()->mobile_nig_username}&api_key={$this->settings()->mobile_nig_api_key}&network=$network&phoneNumber=$phone&product_code=$product_code&price=$product_amount&trans_id=$token&return_url=$ret_url";

			try {
				$data = file_get_contents($req);
			} catch (Exception $e) {
				$this->log_error($e);
				return $response;
			}

			$data = json_decode($data);

			if (!empty($data->trans_id)) {
				$discount = $this->settings()->discount_data / 100;
				$newam = $amount * $discount;
				$newam = $amount - $newam;
				if ($this->debit_balance($user_id, $newam) === true) {
					$text = "Data Purchase of " . $this->coin . $amount . "to phone";
					$this->register_user_activity($user_id, $text, null, $amount, $this->user($user_id)->balance, "data", "debit");
					$response['status'] = true;
					$response['msg'] = "Data purchase successful! You were charged {$this->coin}{$newam}";
				}
			} else {
				if (!empty($data->code) && $data->code == "ERR106") {
					$msg = "MobileNig Data Error \n --- " . $data->code . " --- " . $data->description;
					$this->log_error($msg, "custom");
					return $response;
				}
			}
		}

		return $response;
	}

	## Process user deposit ##
	public function process_deposit($user_id, $method, $amount, $card = false)
	{
		$response['status'] = false;
		$response['msg'] = "Error Occurred";
		if (!empty($this->min_deposit) && $amount < $this->min_deposit) {
			$response['msg'] = "Minimum deposit is {$this->coin}{$this->min_deposit}";
			return $response;
		}

		// START Card Payment //
		if (!empty($card)) {
			$request = $this->pay_with_card($user_id, $card, $amount);
			if ($request['status'] !== true) {
				$this->log_error("User {$this->user($user_id)->email} tried to deposit using saved card but their card payment didn't go through", "custom");
				$response['msg'] = $request['msg'];
				return $response;
			}

			$credit_amount = $amount;
			if (!empty($deposit_fee)) {
				$credit_amount = $credit_amount - $this->settings()->deposit_fee;
			}
			if ($this->credit_balance($user_id, $credit_amount) === true) {

				$activity = "Deposited {amount} into your wallet";
				if ($this->register_user_activity($user_id, $activity, null, $amount, $this->user($user_id)->balance, "deposit", "credit", $this->GenerateKey()) === true) {
					$response['status'] = true;
					$response['msg'] = "Deposit of {$this->coin}{$amount} was successful";
					return $response;
				}
			}
		}
		// END Card Payment //

		switch ($method) {
				// Paystack
			case "paystack":
				$trans_id = $this->GenerateKey(8, 8, false, false, true, false);
				$curl = curl_init();
				curl_setopt_array($curl, array(
					CURLOPT_URL => "https://api.paystack.co/transaction/initialize",
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_CUSTOMREQUEST => "POST",
					CURLOPT_POSTFIELDS => json_encode([
						'amount' => $amount * 100,
						'email' => $this->user($user_id)->email,
						'callback_url' => $this->siteurl . "/payment-callback/deposit?trans_id=$trans_id&method=$method",
						// 'channels' => ['card']
					]),
					CURLOPT_HTTPHEADER => [
						"authorization: Bearer " . $this->settings()->paystack_secret_key,
						"content-type: application/json",
						"cache-control: no-cache"
					],
				));

				$resp = curl_exec($curl);
				$tranx = json_decode($resp);
				if (empty($tranx) || $tranx->status === false) {
					$response['msg'] = "Transaction initialization failed. Please try again later";
					return $response;
				}
				$reference = $tranx->data->reference;
				$date = time();
				$method = "paystack";
				$stmt = $this->con->prepare("INSERT INTO payment_reference (user_id,trans_id,method,reference,amount,date) VALUES (?,?,?,?,?,?)");
				$stmt->bind_param("iissii", $user_id, $trans_id, $method, $reference, $amount, $date);
				$stmt->execute();
				if ($stmt->affected_rows == 1) {
					$ref_id = $stmt->insert_id;
					$ret = $trans_id . "--" . $ref_id;
					$stmt = $this->con->prepare("UPDATE users SET reference = '$ret' WHERE id = '$user_id'");
					$stmt->execute();
					$response['status'] = true;
					$response['url'] = $tranx->data->authorization_url;
				}
				break;

				// Flutterwave
			case "flutterwave":
				$trans_id = $this->GenerateKey(8, 8, false, false, true, false);
				$reference = "flutterwave" . uniqid();
				$curl = curl_init();
				curl_setopt_array($curl, array(
					CURLOPT_URL => "https://api.flutterwave.com/v3/payments",
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_CUSTOMREQUEST => "POST",
					CURLOPT_POSTFIELDS => json_encode([
						'amount' => $amount,
						'tx_ref' => $reference,
						'currency' => "NGN",
						// 'payment_options'=> 'card',
						'redirect_url' => $this->siteurl . "/payment-callback/deposit?trans_id=$trans_id&method=$method",
						'customer' => [
							'email' => $this->user($user_id)->email,
							'phonenumber' => '08000000000',
							'name' => $this->user($user_id)->name
						],
						'customization' => [
							'title' => 'Deposit to wallet : ' . $this->settings()->site_title,
							'description' => 'Deposit to wallet : ' . $this->settings()->site_title,
							'logo' => 'https://assets.piedpiper.com/logo.png'
						]
					]),
					CURLOPT_HTTPHEADER => [
						"content-type: application/json",
						"cache-control: no-cache",
						"Authorization: Bearer " . $this->settings()->flutterwave_secret_key
					],
				));

				$response = curl_exec($curl);
				$transaction = json_decode($response);
				if (empty($transaction) || empty($transaction->data)) {
					$response['msg'] = "Transaction initialization failed. Please try again later " . $transaction->message;
					return $response;
				}

				$date = time();
				$method = "flutterwave";
				$stmt = $this->con->prepare("INSERT INTO payment_reference (user_id,trans_id,method,reference,amount,date) VALUES (?,?,?,?,?,?)");
				$stmt->bind_param("iissii", $user_id, $trans_id, $method, $reference, $amount, $date);
				$stmt->execute();
				if ($stmt->affected_rows == 1) {
					$ref_id = $stmt->insert_id;
					$ret = $trans_id . "--" . $ref_id;
					$stmt = $this->con->prepare("UPDATE users SET reference = '$ret' WHERE id = '$user_id'");
					$stmt->execute();
					$response = array();
					$response['status'] = true;
					$response['url'] = $transaction->data->link;
				}
				break;
		}

		return $response;
	}

	## Payment Reference details ##
	public function reference_details($refid)
	{
		$stmt = $this->con->prepare("SELECT * FROM payment_reference WHERE id = ?");
		$stmt->bind_param("s", $refid);
		$stmt->execute();
		$result = $stmt->get_result();
		if ($result->num_rows == 0) {
			return false;
		}
		return $result->fetch_object();
	}

	// +----------------------------+
	// | User API related functions
	// +----------------------------+

	public function request_api($user_id, $site_url, $reason)
	{
		$response['status'] = false;
		$response['msg'] = "Error occurred";

		$date = time();
		$stmt = $this->con->prepare("INSERT INTO api_requests (user_id,site_url,reason,date) VALUES (?,?,?,?)");
		$stmt->bind_param("issi", $user_id, $site_url, $reason, $date);
		$stmt->execute();
		if ($stmt->affected_rows == 1) {
			$val = 1;
			if (!empty($this->settings()->auto_approve_api_request)) {
				$val = 1;
			}
			$api = bin2hex(random_bytes(25));
			$api = $this->encrypt($api);
			$stmt = $this->con->prepare("UPDATE users SET is_developer = ?, api_key = ? WHERE id = ?");
			$stmt->bind_param("isi", $val, $api, $user_id);
			$stmt->execute();
			if ($stmt->affected_rows == 1) {
				$response['status'] = true;
			}
		}
		return $response;
	}


	// +-------------------------------+
	// | Loan related functions
	// +-------------------------------+

	## Unpaid Loans ##
	public function unpaid_loans()
	{
		$data = array();
		$stmt = $this->con->prepare("SELECT * FROM loan_requests WHERE status2 != 'paid'");
		$stmt->execute();
		$result = $stmt->get_result();
		while ($obj = $result->fetch_object()) {
			array_push($data, $obj);
		}
		return $data;
	}

	## Payback Loan ##
	public function payback_loan($user_id, $loan_id, $method, $card = false)
	{
		$response['status'] = false;
		$response['msg'] = "Some error occurred";
		$loan = $this->loan_request_details($loan_id);
		if (empty($loan)) {
			$response['msg'] = "Loan details not found";
			return $response;
		}

		$amount = (($this->settings()->loan_interest / 100) * $loan->amount) + $loan->amount;

		// START Card Payment //
		if (!empty($card)) {
			$request = $this->pay_with_card($user_id, $card, $amount);
			if ($request['status'] !== true) {
				$this->log_error("User {$this->user($user_id)->email} tried to payback loan through card but some error occurred", "custom");
				$response['msg'] = $request['msg'];
				return $response;
			}

			$stmt = $this->con->prepare("UPDATE loan_requests SET status2 = 'paid' WHERE user_id = ? AND id = ?");
			$stmt->bind_param("ii", $user_id, $loan->id);
			$stmt->execute();
			if ($stmt->affected_rows == 1) {
				$response['staus'] = true;
				$response['msg'] = "Loan paid successfully";
			}
		}
		// END Card Payment //

		else {
			// Payment Gateway
			switch ($method) {
					// Paystack
				case "paystack":
					$trans_id = $this->GenerateKey(8, 8, false, false, true, false);
					$curl = curl_init();
					curl_setopt_array($curl, array(
						CURLOPT_URL => "https://api.paystack.co/transaction/initialize",
						CURLOPT_RETURNTRANSFER => true,
						CURLOPT_CUSTOMREQUEST => "POST",
						CURLOPT_POSTFIELDS => json_encode([
							'amount' => $amount * 100,
							'email' => $this->user($user_id)->email,
							'callback_url' => $this->siteurl . "/payment-callback/payback-loan?trans_id=$trans_id&method=$method",
						]),
						CURLOPT_HTTPHEADER => [
							"authorization: Bearer " . $this->settings()->paystack_secret_key,
							"content-type: application/json",
							"cache-control: no-cache"
						],
					));

					$resp = curl_exec($curl);
					$tranx = json_decode($resp);
					if (empty($tranx) || $tranx->status === false) {
						$response['msg'] = "Transaction initialization failed. Please try again later";
						return $response;
					}
					$reference = $tranx->data->reference;
					$date = time();
					$method = "paystack";
					$type = "payback-loan";
					$stmt = $this->con->prepare("INSERT INTO payment_reference (user_id,trans_id,type,method,reference,amount,date) VALUES (?,?,?,?,?,?,?)");
					$stmt->bind_param("iisssii", $user_id, $trans_id, $type, $method, $reference, $amount, $date);
					$stmt->execute();
					if ($stmt->affected_rows == 1) {
						$ref_id = $stmt->insert_id;
						$ret = $trans_id . "--" . $ref_id;
						$stmt = $this->con->prepare("UPDATE users SET reference = '$ret' WHERE id = '$user_id'");
						$stmt->execute();

						$stmt = $this->con->prepare("UPDATE loan_requests SET payback_trans_id = ? WHERE id = ?");
						$stmt->bind_param("si", $trans_id, $loan->id);
						$stmt->execute();

						$response['status'] = true;
						$response['msg'] = "Redirecting to payment Gateway";
						$response['url'] = $tranx->data->authorization_url;
						return $response;
					}
					break;

					// Flutterwave
				case "flutterwave":
					$trans_id = $this->GenerateKey(8, 8, false, false, true, false);
					$reference = "flutterwave" . uniqid();
					$curl = curl_init();
					curl_setopt_array($curl, array(
						CURLOPT_URL => "https://api.flutterwave.com/v3/payments",
						CURLOPT_RETURNTRANSFER => true,
						CURLOPT_CUSTOMREQUEST => "POST",
						CURLOPT_POSTFIELDS => json_encode([
							'amount' => $amount,
							'tx_ref' => $reference,
							'currency' => "NGN",
							'redirect_url' => $this->siteurl . "/payment-callback/payback-loan?trans_id=$trans_id&method=$method",
							'customer' => [
								'email' => $this->user($user_id)->email,
								'phonenumber' => $this->user($user_id)->phone,
								'name' => $this->user($user_id)->name
							],
							'customization' => [
								'title' => 'Loan payback : ' . $this->settings()->site_title,
								'description' => 'Loan payback : ' . $this->settings()->site_title,
								'logo' => 'https://assets.piedpiper.com/logo.png'
							]
						]),
						CURLOPT_HTTPHEADER => [
							"content-type: application/json",
							"cache-control: no-cache",
							"Authorization: Bearer " . $this->settings()->flutterwave_secret_key
						],
					));

					$response = curl_exec($curl);
					$transaction = json_decode($response);
					if (empty($transaction) || empty($transaction->data)) {
						$response['msg'] = "Transaction initialization failed. Please try again later " . $transaction->message;
						return $response;
					}

					$date = time();
					$method = "flutterwave";
					$type = "payback-loan";
					$stmt = $this->con->prepare("INSERT INTO payment_reference (user_id,trans_id,type,method,reference,amount,date) VALUES (?,?,?,?,?,?,?)");
					$stmt->bind_param("iisssii", $user_id, $trans_id, $type, $method, $reference, $amount, $date);
					$stmt->execute();
					if ($stmt->affected_rows == 1) {
						$ref_id = $stmt->insert_id;
						$ret = $trans_id . "--" . $ref_id;
						$stmt = $this->con->prepare("UPDATE users SET reference = '$ret' WHERE id = '$user_id'");
						$stmt->execute();

						$stmt = $this->con->prepare("UPDATE loan_requests SET payback_trans_id = ? WHERE id = ?");
						$stmt->bind_param("si", $trans_id, $loan->id);
						$stmt->execute();

						$response = array();
						$response['status'] = true;
						$response['msg'] = "Redirecting to payment Gateway";
						$response['url'] = $transaction->data->link;
					}
					break;
			}
		}

		return $response;
	}

	## Complete loan payback ##
	public function complete_loan_payback($user_id, $trans_id)
	{
		if (empty($user_id) || empty($trans_id)) exit;
		$stmt = $this->con->prepare("UPDATE loan_requests SET status2 = 'paid' WHERE payback_trans_id = ? AND user_id = ?");
		$stmt->bind_param("si", $trans_id, $user_id);
		$stmt->execute();
		if ($stmt->affected_rows == 1) {
			return true;
		}
		return false;
	}

	# Request Loan #
	public function request_loan($user_id, $amount, $reason, $type)
	{
		$date = time();
		if ($type == "personal") {
			$stmt = $this->con->prepare("INSERT INTO `loan_requests` (`user_id`, `amount`, `type`, `reason`, `time`) VALUES (?, ?, ?, ?, ?)");
			$stmt->bind_param("iissi", $user_id, $amount, $type, $reason, $date);
			$run = $stmt->execute();
			$res = $stmt->get_result();
			if ($stmt->affected_rows == 1) {
				$ret['status'] = true;
				$ret['value'] = $stmt->insert_id;
				return $ret;
			} else {
				$ret['status'] = false;
				return $ret;
			}
		} elseif ($type == "salary") {
			$stmt = $this->con->prepare("INSERT INTO loan_requests (user_id,amount,type,reason,time) VALUES(?,?,?,?,?)");
			$stmt->bind_param("iissi", $user_id, $amount, $type, $reason, $date);
			$run = $stmt->execute();
			$res = $stmt->get_result();
			if ($stmt->affected_rows == 1) {
				$ret['status'] = true;
				$ret['value'] = $stmt->insert_id;
				return $ret;
			} else {
				$ret['status'] = false;
				return $ret;
			}
		}
		return false;
	}

	# Check is user is eligible for loan
	public function is_elegible_loan($user_id, $type, $amount)
	{
		if ($type == "personal") {
			$activity = $this->user_activity($user_id);
			$amount_spent = 0;
			foreach ($activity as $activity) {
				$amount_spent + $activity->amount;
			}
			if ($amount_spent < 500) {
				return false;
			} else {
				return true;
			}
		} elseif ($type == "salary") {
		}

		return false;
	}

	public function get_states($id = false)
	{
		if ($id !== false) {
			$stmt = $this->con->prepare("SELECT * FROM states WHERE id = ?");
			$stmt->bind_param("i", $id);
			$stmt->execute();
			$res = $stmt->get_result();
			$obj = $res->fetch_object();
			return $obj->name;
		}
		$data = array();
		$stmt = $this->con->prepare("SELECT * FROM states ORDER BY name ASC");
		$stmt->execute();
		$res = $stmt->get_result();
		while ($obj = $res->fetch_object()) {
			array_push($data, $obj);
		}
		return $data;
	}

	public function get_cities($state, $id = false)
	{
		if ($id !== false) {
			$stmt = $this->con->prepare("SELECT * FROM local_governments WHERE id = ?");
			$stmt->bind_param("i", $state);
			$stmt->execute();
			$res = $stmt->get_result();
			$obj = $res->fetch_object();
			return $obj->name;
		}
		$data = array();
		$stmt = $this->con->prepare("SELECT * FROM local_governments WHERE state_id = ?");
		$stmt->bind_param("i", $state);
		$stmt->execute();
		$res = $stmt->get_result();
		while ($obj = $res->fetch_object()) {
			array_push($data, $obj);
		}
		return $data;
	}



	# Loan Request details #
	public function loan_request_details($req_id)
	{
		$req_id = $this->clean($req_id);
		$stmt = $this->con->prepare("SELECT * FROM loan_requests WHERE id = ?");
		$stmt->bind_param("i", $req_id);
		$stmt->execute();
		$res = $stmt->get_result();
		if ($res->num_rows == 0) {
			return false;
		}
		$obj = $res->fetch_object();
		$obj->details = $this->loan_req_details($obj->id);
		return $obj;
	}

	# Loan Request Full details
	private function loan_req_details($id)
	{
		$id = $this->clean($id);
		$stmt = $this->con->prepare("SELECT * FROM loan_request_details WHERE req_id = ?");
		$stmt->bind_param("i", $id);
		$run = $stmt->execute();
		$res = $stmt->get_result();
		$obj = $res->fetch_object();
		$obj->work_id = str_replace("../", "", $obj->work_id);
		$obj->gov_id = str_replace("../", "", $obj->gov_id);
		$obj->passport = str_replace("../", "", $obj->passport);
		$obj->bank_statement = str_replace("../", "", $obj->bank_statement);
		return $obj;
	}

	public function loan_request()
	{
		$type = $this->clean($_GET['type']);
		$mysqli = $this->con;

		$user_id = $this->user_session();

		if (!empty($this->user_loan_requests($user_id))) {
			$last = $this->user_loan_requests($user_id)[0];
			// Check if user has paid back their last loan
			if ($last->status == 1 && $last->status2 !== "paid") {
				$response['code'] = 200;
				$response['msg'] = "You can request for a loan at this time\n Please payback your outstanding debts";
				echo json_encode($response);
				exit;
			}
		}

		//if Personal Loan
		if ($type == "personal") {
			if (isset($_GET['step']) && !empty($_POST['method']) && $_GET['step'] == "final" && !empty($_POST['req_id'])) {
				$method = $this->clean($_POST['method']);
				$req_id = $this->clean($_POST['req_id']);
				$req = $this->loan_request_details($req_id);
				$response['code'] = 400;
				$response['msg'] = "Error Occurred";

				if ($method == "paystack") {
					$trans_id = $this->GenerateKey(8, 8, false, false, true, false);
					$curl = curl_init();
					curl_setopt_array($curl, array(
						CURLOPT_URL => "https://api.paystack.co/transaction/initialize",
						CURLOPT_RETURNTRANSFER => true,
						CURLOPT_CUSTOMREQUEST => "POST",
						CURLOPT_POSTFIELDS => json_encode([
							'amount' => $req->amount * 100,
							'email' => $this->user($user_id)->email,
							'callback_url' => $this->siteurl . "/payment-callback/loan-fee?trans_id=$trans_id&loan_type=personal&req_id=$req_id"
						]),
						CURLOPT_HTTPHEADER => [
							"authorization: Bearer " . $this->settings()->paystack_secret_key,
							"content-type: application/json",
							"cache-control: no-cache"
						],
					));

					$resp = curl_exec($curl);
					$tranx = json_decode($resp);
					if (empty($tranx) || $tranx->status === false) {
						$response['msg'] = "Transaction initialization failed. Please try again later";
						echo json_encode($response);
						exit;
					}

					$reference = $tranx->data->reference;
					$date = time();
					$method = "paystack";
					$type = "loan-fee";
					$stmt = $this->con->prepare("INSERT INTO payment_reference (user_id,trans_id,type,method,reference,amount,date) VALUES (?,?,?,?,?,?,?)");
					$stmt->bind_param("iisssii", $user_id, $trans_id, $type, $method, $reference, $amount, $date);
					$stmt->execute();
					if ($stmt->affected_rows == 1) {
						$ref_id = $stmt->insert_id;
						$ret = $trans_id . "--" . $ref_id;
						$stmt = $this->con->prepare("UPDATE users SET reference = '$ret' WHERE id = '$user_id'");
						$stmt->execute();
						$response['status'] = true;
						$response['code'] = 200;
						$response['msg'] = "Redirecting to payment Gateway";
						$response['url'] = $tranx->data->authorization_url;
						echo json_encode($response);
						exit;
					}
				}

				if ($method == "flutterwave") {
				}

				echo json_encode($response);
				exit;
			} else {
				$errorMSG = "";
				if (empty($_POST['loan-amount'])) {
					$errorMSG .= "<li>Loan Amount is required</li>";
				} else {
					$amount = $this->clean($_POST['loan-amount']);
				}

				if (empty($_POST['reason'])) {
					$errorMSG .= "<li>Reason is required</li>";
				} else {
					$reason = $this->clean($_POST['reason']);
				}

				//Full name
				if (empty($_POST['fname'])) {
					$errorMSG .= "<li>First Name is required</li>";
				} else {
					$fname = $this->clean($_POST['fname']);
				}
				//Full name
				if (empty($_POST['lname'])) {
					$errorMSG .= "<li>Last Name is required</li>";
				} else {
					$lname = $this->clean($_POST['lname']);
				}
				//DOB
				if (empty($_POST['dob'])) {
					$errorMSG .= "<li>Date of Birth is required</li>";
				} else {
					$dob = $this->clean($_POST['dob']);
				}
				//Address
				if (empty($_POST['address'])) {
					$errorMSG .= "<li>Address is required</li>";
				} else {
					$address = $this->clean($_POST['address']);
				}

				if (empty($_POST['state_address'])) {
					$errorMSG .= "<li>State is required</li>";
				} else {
					$state = $this->decrypt($this->clean($_POST['state_address']));
				}

				if (empty($_POST['city_address'])) {
					$errorMSG .= "<li>Local Government is required</li>";
				} else {
					$city = $this->decrypt($this->clean($_POST['city_address']));
				}

				if (empty($_POST['fb_url'])) {
					$errorMSG .= "<li>Facebook profile link is required</li>";
				} else {
					$fb = $this->clean($_POST['fb_url']);
				}

				if (empty($errorMSG)) {
					//Check if the user is eligible
					$eligible = $this->is_elegible_loan($user_id, $type, $amount);
					if ($eligible !== false) {
						echo json_encode(['code' => 400, 'msg' => "Sorry, You're not eligible for a loan of $amount. \n Please make more transactions"]);
						exit;
					}

					$request = $this->request_loan($user_id, $amount, $reason, "personal");
					if ($request['status'] === true) {
						$loanreq_id = $request['value'];
						$query = "INSERT INTO `loan_request_details` (req_id,`fname`, `lname`, `dob`,fb_url,address,state_address,city_address,loan_amount,loan_reason) VALUES (?,?,?,?,?,?,?,?,?,?)";
						$stmt = $mysqli->prepare($query);
						$stmt->bind_param("isssssiiis", $loanreq_id, $fname, $lname, $dob, $fb, $address, $state, $city, $amount, $reason);
						$stmt->execute();
						$res = $stmt->get_result();
						if ($stmt->affected_rows == 1) {
							echo json_encode(['code' => 200, 'msg' => "Reached", "amount" => $amount, "req_id" => $loanreq_id]);
							exit;
						}
					} else {
						echo json_encode(['code' => 404, 'msg' => 'Error Occured. Please refresh page']);
						exit;
					}
				} else {
					echo json_encode(['code' => 404, 'msg' => $errorMSG]);
					exit;
				}
			}
		} elseif ($type = "salary") {

			if (empty($_GET['step'])) {
				exit;
			}
			$step = $this->clean($_GET['step']);
			if ($step !== "final") {
				$next_step = $step + 1;
			}
			switch ($step) {
				case 1:
					$fname = $this->clean($_POST['fname']);
					$lname = $this->clean($_POST['lname']);
					$dob = $this->clean($_POST['dob']);
					$gender = $this->clean($_POST['gender']);
					$marital_status = $this->clean($_POST['marital_status']);
					$state_origin = $this->decrypt($this->clean($_POST['state_origin']));
					$city_origin = $this->decrypt($this->clean($_POST['city_origin']));
					$children = $this->clean($_POST['number_children']);
					$dependants = $this->clean($_POST['number_dependants']);
					$query = "INSERT INTO `loan_request_details` (`fname`, `lname`, `dob`, `gender`, `marital_status`, `state_origin`, `city_origin`, `children`, `dependants`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
					$stmt = $mysqli->prepare($query);
					$stmt->bind_param("sssssiiis", $fname, $lname, $dob, $gender, $marital_status, $state_origin, $city_origin, $children, $dependants);
					$stmt->execute();
					$res = $stmt->get_result();
					if ($stmt->affected_rows == 1) {
						$_SESSION['loan_request_details_id'] = $stmt->insert_id;
						echo json_encode(['code' => 200, "last_step" => $step, "next_step" => $next_step, 'msg' => "received"]);
						exit;
					} else {
						echo json_encode(['code' => 400, 'msg' => "Error Occurred"]);
						exit;
					}
					break;

				case 2:
					if (empty($_SESSION['loan_request_details_id'])) {
						exit("err");
					}
					$fb_url = $this->clean($_POST['fb_url']);
					$address = $this->clean($_POST['address']);
					$subrub_address = $this->clean($_POST['subrub_address']);
					$state_address = $this->decrypt($this->clean($_POST['state_address']));
					$city_address = $this->decrypt($this->clean($_POST['city_address']));
					$address_duration = $this->clean($_POST['address_duration']);
					$accommodation_type = $this->clean($_POST['accommodation_type']);
					$mobile_number = $this->clean($_POST['mobile_number']);
					$query = "UPDATE `loan_request_details` SET fb_url = ?, address = ?, subrub_address = ?, state_address = ?, city_address = ?, address_duration = ?, accommodation_type = ?, mobile_number = ? WHERE `loan_request_details`.`id` = ?";
					$stmt = $mysqli->prepare($query);
					$stmt->bind_param("sssiissii", $fb_url, $address, $subrub_address, $state_address, $city_address, $address_duration, $accommodation_type, $mobile_number, $_SESSION['loan_request_details_id']);
					$stmt->execute();
					$res = $stmt->get_result();
					if ($stmt->affected_rows == 1) {
						echo json_encode(['code' => 200, "last_step" => $step, "next_step" => $next_step, 'msg' => "received"]);
						exit;
					} else {
						echo json_encode(['code' => 400, 'msg' => "Error Occurred"]);
						exit;
					}
					break;

				case 3:
					$employment_type = $this->clean($_POST['employment_type']);
					$monthly_salary = $this->clean($_POST['monthly_salary']);
					$employer_name = $this->clean($_POST['employer_name']);
					$employer_phone = $this->clean($_POST['employer_phone']);
					$employement_duration = $this->clean($_POST['employement_duration']);
					$office_address = $this->clean($_POST['office_address']);
					$subrub_office = $this->clean($_POST['subrub_office']);
					$office_sate = $this->decrypt($this->clean($_POST['office_state']));
					$office_city = $this->decrypt($this->clean($_POST['office_city']));

					//Upload Work ID
					$target_dir = "../../uploads/userdata/id/";
					$uploadOk = 1;
					// Check if image file is a actual image or fake image
					$target_file = $target_dir . basename($_FILES["work_id"]["name"]);
					$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
					// Allow certain file formats
					if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
						echo json_encode(['code' => 404, 'msg' => "Sorry, only jpg,png,jpqg files are allowed."]);
						$uploadOk = 0;
						exit;
					}
					// Check if $uploadOk is set to 0 by an error
					if ($uploadOk == 0) {
						$msg = "Sorry, your file was not uploaded.";
						echo json_encode(['code' => 404, 'msg' => $msg]);
						exit;
					} else {
						$temp = explode(".", $_FILES["work_id"]["name"]);
						$oldfilename = $user_id . "--work_id" . round(microtime(true)) . '.' . end($temp);
						$newfilename = $target_dir . $oldfilename;
						if (move_uploaded_file($_FILES["work_id"]["tmp_name"], $newfilename)) {
							$work_id = $newfilename;
							$query = "UPDATE `loan_request_details` SET `employment_type` = ?, `work_id` = ?, `monthly_salary` = ?, `employer_name` = ?, `employer_phone` = ?, `employment_duration` = ?, `office_address` = ?, `subrub_office` = ?, `office_state` = ?, `office_city` = ? WHERE `loan_request_details`.`id` = ?";
							$stmt = $mysqli->prepare($query);
							$stmt->bind_param("ssssssssiii", $employment_type, $work_id, $monthly_salary, $employer_name, $employer_phone, $employement_duration, $office_address, $subrub_office, $office_sate, $office_city, $_SESSION['loan_request_details_id']);
							$stmt->execute();
							$res = $stmt->get_result();
							if ($stmt->affected_rows == 1) {
								echo json_encode(['code' => 200, "last_step" => $step, "next_step" => $next_step, 'msg' => "received"]);
								exit;
							} else {
								echo json_encode(['code' => 400, 'msg' => "Error Occurred"]);
								exit;
							}
						} else {
							echo json_encode(['code' => 400, 'msg' => "Error Occurred"]);
							exit;
						}
					}
					break;

				case 4:
					$bvn = $this->clean($_POST['bvn']);
					$salary_ano = $this->clean($_POST['salary_ano']);
					$salary_bank = $this->clean($_POST['salary_bank']);
					$amount = $this->clean($_POST['loan_amount']);
					$reason = $this->clean($_POST['loan_reason']);
					$res = $this->request_loan($user_id, $amount, $reason, $type);
					if ($res['status'] === true) {
						$loanreq_id = $res['value'];

						//Upload DAta
						$target_dir = "../../uploads/userdata/verification/";
						$uploadOk = 1;
						// Check if image file is a actual image or fake image
						$target_file1 = $target_dir . basename($_FILES["gov_id"]["name"]);
						$imageFileType1 = strtolower(pathinfo($target_file1, PATHINFO_EXTENSION));
						$target_file2 = $target_dir . basename($_FILES["passport"]["name"]);
						$imageFileType2 = strtolower(pathinfo($target_file2, PATHINFO_EXTENSION));
						$target_file3 = $target_dir . basename($_FILES["bank_statement"]["name"]);
						$imageFileType3 = strtolower(pathinfo($target_file2, PATHINFO_EXTENSION));
						// Allow certain file formats
						if ($imageFileType1 != "jpg" && $imageFileType1 != "png" && $imageFileType2 != "jpg" && $imageFileType2 != "png" && $imageFileType3 != "jpg" && $imageFileType3 != "png") {
							echo json_encode(['code' => 404, 'msg' => "Sorry, only jpg files are allowed."]);
							$uploadOk = 0;
						}
						// Check if $uploadOk is set to 0 by an error
						if ($uploadOk == 0) {
							$msg = "Sorry, your file was not uploaded.";
							echo json_encode(['code' => 404, 'msg' => $msg]);
							exit;
						} else {
							$temp1 = explode(".", $_FILES["gov_id"]["name"]);
							$temp2 = explode(".", $_FILES["passport"]["name"]);
							$temp3 = explode(".", $_FILES["bank_statement"]["name"]);

							$oldfilename1 = $user_id . "--id_card" . round(microtime(true)) . '.' . end($temp1);
							$oldfilename2 = $user_id . "--passport" . round(microtime(true)) . '.' . end($temp2);
							$oldfilename3 = $user_id . "--bank_statement" . round(microtime(true)) . '.' . end($temp3);

							$newfilename1 = $target_dir . $oldfilename1;
							$newfilename2 = $target_dir . $oldfilename2;
							$newfilename3 = $target_dir . $oldfilename3;
							if (move_uploaded_file($_FILES["gov_id"]["tmp_name"], $newfilename1) && move_uploaded_file($_FILES["passport"]["tmp_name"], $newfilename2) && move_uploaded_file($_FILES["bank_statement"]["tmp_name"], $newfilename3)) {
								$gov_id = $newfilename1;
								$passport = $newfilename2;
								$bank_statement = $newfilename3;

								$query = "UPDATE loan_request_details SET req_id=?,gov_id=?,bvn=?,salary_ano=?,salary_bank=?,passport=?,bank_statement=?,loan_amount=?,loan_reason=? WHERE id=?";
								$stmt = $mysqli->prepare($query);
								$stmt->bind_param("isiiissisi", $loanreq_id, $gov_id, $bvn, $salary_ano, $salary_bank, $passport, $bank_statement, $amount, $reason, $_SESSION['loan_request_details_id']);
								$stmt->execute();
								$res = $stmt->get_result();
								if ($stmt->affected_rows == 1) {
									echo json_encode(['code' => 200, "last_step" => $step, "next_step" => "final", 'msg' => "received"]);
									exit;
								} else {
									echo json_encode(['code' => 400, 'msg' => "Error Occurred"]);
									exit;
								}
							} else {
								echo json_encode(['code' => 400, 'msg' => "Error Occurred"]);
								exit;
							}
						}
					}
					break;

				case "final":
					$trans_id = $this->GenerateKey(8, 8, false, false, true, false);
					// $_SESSION['paystack_transaction_type'] = "loan";
					// $_SESSION['loan_req_id'] = $this->encrypt($_SESSION['loan_request_details_id']);

					$req_id = $this->clean($_SESSION['loan_request_details_id']);

					$curl = curl_init();
					$amount = 1000 * 100;
					curl_setopt_array($curl, array(
						CURLOPT_URL => "https://api.paystack.co/transaction/initialize",
						CURLOPT_RETURNTRANSFER => true,
						CURLOPT_CUSTOMREQUEST => "POST",
						CURLOPT_POSTFIELDS => json_encode([
							'amount' => $amount,
							'email' => $this->user($user_id)->email,
							'callback_url' => $this->siteurl . "/payment-callback/loan-fee?trans_id=$trans_id&loan_type=salary&req_id=$req_id",
							'channel' => ['card']
						]),
						CURLOPT_HTTPHEADER => [
							"authorization: Bearer {$this->settings()->paystack_secret_key}",
							"content-type: application/json",
							"cache-control: no-cache"
						],
					));

					$response = curl_exec($curl);
					$tranx = json_decode($response, true);
					if ($tranx['status'] == false) {
						echo json_encode(['code' => 400, 'msg' => "Error Occured!!"]);
						exit;
					}
					$tran = $tranx['data']['reference'];

					$reference = $tran;
					$date = time();
					$method = "paystack";
					$type = "loan-fee";
					$stmt = $this->con->prepare("INSERT INTO payment_reference (user_id,trans_id,type,method,reference,amount,date) VALUES (?,?,?,?,?,?,?)");
					$stmt->bind_param("iisssii", $user_id, $trans_id, $type, $method, $reference, $amount, $date);
					$stmt->execute();
					if ($stmt->affected_rows == 1) {
						$ref_id = $stmt->insert_id;
						$ret = $trans_id . "--" . $ref_id;
						$stmt = $this->con->prepare("UPDATE users SET reference = '$ret' WHERE id = '$user_id'");
						$stmt->execute();

						// $_SESSION['paystack_transaction_reference'] = $this->encrypt($tran);
						echo json_encode(['code' => 200, 'msg' => "Redirecting to Payment Gateway", 'url' => $tranx['data']['authorization_url']]);
						exit;
					}
					break;
			}
		}
	}

	## Complete Loan Process ##
	public function complete_loan($req_id, $user_id, $trans_id, $type)
	{
		if ($type == "salary") {
			$stmt = $this->con->prepare("SELECT * FROM loan_request_details WHERE id = ?");
			$stmt->bind_param("i", $req_id);
			$stmt->execute();
			$result = $stmt->get_result();
			if ($result->num_rows == 0) {
				echo 'Error 1';
				exit;
			}
			$obj = $result->fetch_object();
			$req_id = $obj->req_id;
		}
		$req = $this->loan_request_details($req_id);
		if (empty($req)) {
			echo 'Error';
			exit;
		}
		$stmt = $this->con->prepare("UPDATE loan_requests SET paid = 'yes', trans_id = ? WHERE id = ?");
		$stmt->bind_param("ii", $trans_id, $req_id);
		$stmt->execute();
		if ($stmt->affected_rows == 1) {
			$activity = "You requested a loan of {amount}. Type: " . strtoupper($req->type);
			$link = "loans";
			$balance = $this->user($user_id)->balance;
			$type = "loan";
			$time = time();
			$amount = $req->amount;
			if ($this->register_user_activity($user_id, $activity, $link, $amount, $balance, $type, $time) === true) {
				$this->log_action("loan", $user_id, $req->id, null, null, null, time());
				return true;
			}
		}

		return false;
	}

	## Accept Loan Offer ##
	public function loan_offer($req_id, $action)
	{
		$response['msg'] = "Error Occurred";
		$response['status'] = false;

		$req = $this->loan_request_details($req_id);
		if (empty($req)) {
			return $response;
		}

		$loan_amount = $req->details->loan_amount;
		$user_id = $req->user_id;

		if ($action == "decline") {
			$stmt = $this->con->prepare("UPDATE loan_requests SET status = 1 WHERE id = ?");
			$stmt->bind_param("i", $req_id);
			$stmt->execute();
			if ($stmt->affected_rows == 1) {
				// Logs
				$activity = "User : {user_email} declined loan offer of {new_amount}. Request ID : {req_id}";
				$this->log_action("loan", $user_id, $req->id, null, null, null, time(), $activity);
				//END Logs
				$response['status'] = true;
				$response['msg'] = "Offer declined";
			}
		} elseif ($action == "approve") {
			$stmt = $this->con->prepare("UPDATE loan_requests SET status = 1 WHERE id = ?");
			$stmt->bind_param("i", $req_id);
			$stmt->execute();
			if ($stmt->affected_rows == 1) {
				$amm = number_format($req->new_amount);
				$text = "Your loan of {$this->coin}{$amm} has been approved";
				$this->register_notification(null, $user_id, $text, "loans", "loan-response");
				$user = $this->user($user_id);
				$message = $text . " \n Login to your account for more information";
				$this->mail($user->email, $this->settings()->site_title . " Loan request", $message);
				if ($this->credit_balance($user_id, $req->amount) === true) {
					if ($this->register_user_activity($user_id, "You received a loan of {amount}", null, $req->amount, $this->user($user_id)->balance, "loan", "credit", $req->trans_id) === true) {

						// Logs
						$activity = "You approved a loan of {amount}. Request ID : {req_id}";
						$this->log_action("loan", $user->id, $req_id, null, null, null, time(), $activity);
						//END Logs
						$response['status'] = true;
						$response['msg'] = "Offer Accepted";
					}
				}
			}
		}
		return $response;
	}

	// +----------------------------+
	// | Admin Panel
	// +----------------------------+
	public function admin_logged_in()
	{
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if (isset($_SESSION['user_auth_token'])) {
			$token = $_SESSION['user_auth_token'];
			$id = $this->get_user_id($token);
			if (is_numeric($id) && !empty($id)) {
				if ($this->user($id)->type == "admin" || $this->user($id)->type == "super-admin") {
					return true;
				}
			}
		} else {
			if (isset($_COOKIE['user_auth_token'])) {
				$token = $_COOKIE['user_auth_token'];
				$id = $this->get_user_id($token);
				if (is_numeric($id) && !empty($id)) {
					if ($this->user($id)->type == "admin" || $this->user($id)->type == "super-admin") {
						return true;
					}
				}
			}
		}
		return false;
	}

	## Admin login ##
	public function admin_login()
	{
		$this->user_login(true);
	}

	## Save Site Settings ##
	public function admin_save_site_settings($_DATA)
	{
		$_POST = $_DATA;
		//Save Settings General Handler
		if (!isset($_POST['save-type'])) {
			echo json_encode(['code' => 404, 'msg' => 'Error Occured. Please refresh page']);
			exit;
		}
		$mysqli = $this->con;
		$savetype   =   $this->clean($_POST['save-type']);
		switch ($savetype) {
			case 'site-settings':
				$site_title     =   $this->clean($_POST['site_title']);
				$admin_email     =   $this->clean($_POST['admin_email']);
				$mod_email     =   $this->clean($_POST['moderator_email']);
				$site_keys      =   $this->clean($_POST['site_keys']);
				$site_desc      =   $this->clean($_POST['site_desc']);

				$query = $mysqli->prepare("UPDATE `site_settings` SET `site_title`=?, `site_email`=?, `admin_email`=?, `site_keys`=?, `site_desc`=?");
				$query->bind_param("sssss", $site_title, $mod_email, $admin_email, $site_keys, $site_desc);
				$putresult = $query->execute();

				if ($query->affected_rows === 1) {
					$msg = "Saved!";
					echo json_encode(['code' => 200, 'msg' => $msg]);
				} else {
					$msg = "No Changes were made";
					echo json_encode(['code' => 400, 'msg' => $msg]);
				}
				break;
			case 'payment-settings':
				$ps_sk      =   $this->clean($_POST['paystack_secret_key']);
				$fl_sk      =   $this->clean($_POST['flutterwave_secret_key']);
				$query = $mysqli->prepare("UPDATE `site_settings` SET `paystack_secret_key` = ?, flutterwave_secret_key = ?");
				$query->bind_param("ss", $ps_sk, $fl_sk);
				$putresult = $query->execute();
				if ($query->affected_rows === 1) {
					$msg = "Saved!";
					echo json_encode(['code' => 200, 'msg' => $msg]);
				} else {
					$msg = "No Changes were made";
					echo json_encode(['code' => 400, 'msg' => $msg]);
				}
				break;

			case 'api-settings':
				$atg_api_key = $this->clean($_POST['atg_api_key']);
				if (!empty($_POST['atg_merchant_key'])) {
					$atg_merchant_key = $this->clean($_POST['atg_merchant_key']);
				} else {
					$atg_merchant_key = null;
				}
				$atg_pin = $this->encrypt($this->clean($_POST['atg_pin']));
				$mobile_nig_username = $this->clean($_POST['mobile_nig_username']);
				$mobile_nig_api_key = $this->clean($_POST['mobile_nig_api_key']);
				$airtime_api = $this->clean($_POST['airtime_api']);
				$data_api = $this->clean($_POST['data_api']);
				$rubies_secret_key = $this->clean($_POST['rubies_secret_key']);

				$query = $mysqli->prepare("UPDATE `site_settings` SET atg_api_key = ?, atg_public_key = ?, atg_pin = ?, mobile_nig_username = ?, mobile_nig_api_key = ?, airtime_api = ?, data_api = ?, rubies_secret_key = ?");
				$query->bind_param("ssssssss", $atg_api_key, $atg_merchant_key, $atg_pin, $mobile_nig_username, $mobile_nig_api_key, $airtime_api, $data_api, $rubies_secret_key);
				$query->execute();
				if ($query->affected_rows === 1) {
					$msg = "successful";
					echo json_encode(['code' => 200, 'msg' => $msg]);
				} else {
					$msg = "No changes made";
					echo json_encode(['code' => 400, 'msg' => $msg]);
				}
				break;

			case "site-rates":
				$deposit           =   $this->clean($_POST['deposit_charge']);
				$withdrawal_charge =   $this->clean($_POST['withdrawal_charge']);
				$airtime_charge    =   $this->clean($_POST['airtime_charge']);
				$data_charge       =   $this->clean($_POST['data_charge']);
				$crypto_comission  =   $this->clean($_POST['crypto_comission']);
				$withdral_review   =   $this->clean($_POST['withdrawal_review']);
				$bill_fee          =   $this->clean($_POST['bill_fee']);

				$buy_btc           =   $this->clean($_POST['buy_btc']);
				$sell_btc          =   $this->clean($_POST['sell_btc']);
				$buy_eth           =   $this->clean($_POST['buy_eth']);
				$sell_eth          =   $this->clean($_POST['sell_eth']);
				$buy_usdt          =   $this->clean($_POST['buy_usdt']);
				$sell_usdt         =   $this->clean($_POST['sell_usdt']);
				$not_verified_user_withdrawal = $this->clean($_POST['not_verified_user_withdrawal']);

				$query = $mysqli->prepare("UPDATE `site_settings` SET `deposit_charge`=?, `withdrawal_fee`=?, `discount_airtime`=?, `discount_data`=?, `crypto_comission`=?, `withdrawal_review`=?, `btc_rate`=?, `sell_btc_rate`=?, `buy_eth`=?, `sell_eth`=?, `buy_usdt`=?, `pay_bill_fee`=?, `sell_usdt`=?, `not_verified_user_withdrawal`= ?");
				$query->bind_param("sssssssssssssd", $deposit, $withdrawal_charge, $airtime_charge, $data_charge, $crypto_comission, $withdral_review, $buy_btc, $sell_btc, $buy_eth, $sell_eth, $buy_usdt, $bill_fee, $sell_usdt, $not_verified_user_withdrawal);
				$putresult = $query->execute();

				if ($query->affected_rows === 1) {
					$msg = "Saved!";
					echo json_encode(['code' => 200, 'msg' => $msg]);
				} else {
					$msg = "No Changes were made";
					echo json_encode(['code' => 400, 'msg' => $msg]);
				}
				break;

			case "payments":
				$btc_address   =   $this->clean($_POST['btc_address']);
				$eth_address   =   $this->clean($_POST['eth_address']);
				$usdt_address  =   $this->clean($_POST['usdt_address']);

				$btc_wallet    =   $this->clean($_POST['btc_wallet']);
				$eth_wallet    =   $this->clean($_POST['eth_wallet']);
				$usdt_wallet   =   $this->clean($_POST['usdt_wallet']);

				$btc_barcode   =   $this->clean($_POST['btc_barcode']);
				$eth_barcode   =   $this->clean($_POST['eth_barcode']);
				$usdt_barcode  =   $this->clean($_POST['usdt_barcode']);

				$query = $mysqli->prepare("UPDATE `site_settings` SET `btc_address`=?, `eth_address`=?, `usdt_address`=?, `btc_wallet_type`=?, `eth_wallet_type`=?, `usdt_wallet_type`=?, `btc_barcode`=?, `eth_barcode`=?, `usdt_barcode`=? ");
				$query->bind_param("sssssssss", $btc_address, $eth_address, $usdt_address, $btc_wallet, $eth_wallet, $usdt_wallet, $btc_barcode, $eth_barcode, $usdt_barcode);
				$putresult = $query->execute();

				if ($query->affected_rows === 1) {
					$msg = "Saved!";
					echo json_encode(['code' => 200, 'msg' => $msg]);
				} else {
					$msg = "No Changes were made";
					echo json_encode(['code' => 400, 'msg' => $msg]);
				}
				break;

			case "loan-settings":
				$per_loan = $this->clean($_POST['personal_loan']);
				$ser_loan = $this->clean($_POST['salary_loan']);
				$loan_interest = $this->clean($_POST['loan_interest']);

				$stmt = $this->con->prepare("UPDATE site_settings SET personal_loan = ?, salary_loan = ?, loan_interest = ?");
				$stmt->bind_param("iis", $per_loan, $ser_loan, $loan_interest);

				if ($stmt->execute() === true && $stmt->affected_rows > 0) {
					$msg = "successful";
					echo json_encode(['code' => 200, 'msg' => $msg]);
				} else {
					$msg = "Error Occured";
					echo json_encode(['code' => 400, 'msg' => $msg]);
				}
				break;

			case "discount":
				$discount_airtime = $this->clean($_POST['discount_airtime']);
				$discount_data = $this->clean($_POST['discount_data']);

				$stmt = $this->con->prepare("UPDATE site_settings SET discount_airtime = ?, discount_data = ?");
				$stmt->bind_param("ss", $discount_airtime, $discount_data);

				if ($stmt->execute() === true && $stmt->affected_rows > 0) {
					$msg = "Saved";
					echo json_encode(['code' => 200, 'msg' => $msg]);
				} else {
					$msg = "Error Occured";
					echo json_encode(['code' => 400, 'msg' => $msg]);
				}
				break;
		}
	}

	## Admin panel stats ##
	public function admin_stats()
	{
		$data = array();
		$object = new stdClass();
		$object->users = $this->all_users();
		$object->plans = $this->all_plans();
		$object->loan_requests = $this->loan_requests();
		$object->funds_requests = $this->funds_requests();
		$object->transactions_count = $this->all_transactions(true);
		$object->gift_pins = $this->gift_pins();
		return $object;
	}

	## All Users ##
	private function all_users()
	{
		$data = array();
		$stmt = $this->con->prepare("SELECT * FROM users ORDER BY id desc");
		$stmt->execute();
		$res = $stmt->get_result();
		while ($obj = $res->fetch_object()) {
			$obj->name = $obj->fname . " " . $obj->lname;
			array_push($data, $obj);
		}
		return $data;
	}

	public function all_plans()
	{
		$data = array();
		$stmt = $this->con->prepare("SELECT * FROM data_plans");
		$stmt->execute();
		$res = $stmt->get_result();
		while ($obj = mysqli_fetch_object($res)) {
			array_push($data, $obj);
		}
		return $data;
	}

	public function all_transactions($count = false)
	{
		$data = array();
		$stmt = $this->con->prepare("SELECT * FROM activities ORDER BY id desc");
		$stmt->execute();
		$res = $stmt->get_result();
		if ($count === true) {
			return $res->num_rows;
		}
		while ($obj = mysqli_fetch_object($res)) {
			array_push($data, $obj);
		}
		return $data;
	}

	public function all_transaction($count = false)
	{
		$data = array();
		$stmt = $this->con->prepare("SELECT * FROM transactions ORDER BY id desc");
		$stmt->execute();
		$res = $stmt->get_result();
		if ($count === true) {
			return $res->num_rows;
		}
		while ($obj = mysqli_fetch_object($res)) {
			array_push($data, $obj);
		}
		return $data;
	}

	//All Crypto trans_actions
	public function crypto_transaction($count = false)
	{
		$data = array();
		$stmt = $this->con->prepare("SELECT * FROM crypto_transactions ORDER BY id desc");
		$stmt->execute();
		$res = $stmt->get_result();
		if ($count === true) {
			return $res->num_rows;
		}
		while ($obj = mysqli_fetch_object($res)) {
			array_push($data, $obj);
		}
		return $data;
	}

	public function all_kyc($count = false)
	{
		$data = array();
		$stmt = $this->con->prepare("SELECT * FROM kyc_details ORDER BY id desc");
		$stmt->execute();
		$res = $stmt->get_result();
		if ($count === true) {
			return $res->num_rows;
		}
		while ($obj = mysqli_fetch_object($res)) {
			array_push($data, $obj);
		}
		return $data;
	}
	
    //All Gift Pins
    public function gift_pins()
    {
        $data = array();
        $stmt = $this->con->prepare("SELECT * FROM gift_pins ORDER BY gift_id desc");
        $stmt->execute();
		$res = $stmt->get_result();
		while ($obj = mysqli_fetch_object($res))  {
			array_push($data, $obj);
		}
		return $data;
    }
    
    // Gift Pins Actions
    public function delete_gift_pin_actions($action, $gift_id)
    {

      if($action == 'delete_gift_pin'){
			$stmt = $this->con->prepare("DELETE FROM gift_pins WHERE gift_id = ?");
			$stmt->bind_param("s", $gift_id);
			$stmt->execute();
			
			$response['status'] = true;
			$response['message'] = 'Gift Pin Deleted Successfully';          
      }
     return $response;
    }
    
    public function create_gift_pin_actions($action, $gift_pin_code, $gift_pin_amount)
    {
        
      if($action == 'create_gift_pin'){
			$stmt = $this->con->prepare("INSERT INTO gift_pins (gift_code,gift_amount) VALUES (?,?)");
			$stmt->bind_param('ss', $gift_pin_code, $gift_pin_amount);
			$stmt->execute();
			
			$response['status'] = true;
			$response['message'] = 'Gift Pin created Successfully';          
      }
      return $response;
    }

	// | Admin - User actions |
	public function trans_actions($trans_id, $action)
	{
		$response['status'] = false;
		$response['msg'] = "Error Occurred";

		if ($action == "delete_trans") {
			$stmt = $this->con->prepare("DELETE FROM transactions WHERE trans_id = ?");
			$stmt->bind_param("s", $trans_id);
			$stmt2 = $this->con->prepare("DELETE FROM activities WHERE trans_id = ?");
			$stmt2->bind_param("s", $trans_id);

			$stmt->execute();
			$stmt2->execute();

			$response['status'] = true;
			$response['message'] = "History deleted successfully";
		}

		if ($action == "update") {
			$status = '';
			if (isset($_POST['status'])) {
				$status = $this->clean($_POST['status']);
			}

			if ($status == 'cancelled') {
				// $bal = $this->clean($_POST['amount']);
				// $id  = $this->clean($_POST['id']);

				// $stmt = $this->con->prepare("UPDATE users SET balance = balance+? WHERE id = ?");
				// $stmt->bind_param("ss", $bal, $id);

				// $stmt->execute();
			}

			$stmt = $this->con->prepare("UPDATE transactions SET status = ? WHERE trans_id = ?");
			$stmt->bind_param("ss", $status, $trans_id);
			$stmt2 = $this->con->prepare("UPDATE activities SET status = ? WHERE trans_id = ?");
			$stmt2->bind_param("ss", $status, $trans_id);

			$stmt->execute();
			$stmt2->execute();

			$response['status'] = true;
			$response['message'] = "User info updated successfully";
		}

		if ($action == "edit") {
			$fname = $this->clean($_POST['amount']);
			$lname = $this->clean($_POST['balance']);
			$email = $this->clean($_POST['user_email']);
			$phone = $this->clean($_POST['user_phone']);
			$user  = $this->clean($_POST['user_username']);
			$type  = $this->clean($_POST['user_type']);
			$bal   = $this->clean($_POST['add_balance']);

			$stmt = $this->con->prepare("UPDATE users SET fname = ?, lname = ?, email = ?, phone = ?, username = ?, type = ?, balance = balance+? WHERE id = ?");
			$stmt->bind_param("sssssssi", $fname, $lname, $email, $phone, $user, $type, $bal, $user_id);

			if ($stmt->execute() === true && $stmt->affected_rows > 0) {
				$response['status'] = true;
				$response['msg'] = "User info updated successfully";
			} else {
				$response['msg'] = "No changes were made";
			}
		}

		return $response;
	}

	// | Admin - Crypto actions |
	public function crypto_trans_actions($trans_id, $action)
	{
		$response['status'] = false;
		$response['msg'] = "Error Occurred";

		if ($action == "delete_crypto_trans") {
			$stmt = $this->con->prepare("DELETE FROM crypto_transactions WHERE trans_id = ?");
			$stmt->bind_param("s", $trans_id);
			$stmt1 = $this->con->prepare("DELETE FROM transactions WHERE trans_id = ?");
			$stmt1->bind_param("s", $trans_id);
			$stmt2 = $this->con->prepare("DELETE FROM activities WHERE trans_id = ?");
			$stmt2->bind_param("s", $trans_id);

			$stmt->execute();
			$stmt1->execute();
			$stmt2->execute();

			$response['status'] = true;
			$response['message'] = "History deleted successfully";
		}

		if ($action == "update_crypto") {
			$status = '';
			$trans_type = '';

			if (isset($_POST['status'])) $status = $this->clean($_POST['status']);
			if (isset($_POST['trans_type'])) $trans_type = $this->clean($_POST['trans_type']);

			if ($status == 'canceled' && $trans_type == 'debit') {

				$bal       =   $this->clean($_POST['amount']);
				$id        =   $this->clean($_POST['id']);
				$coin_type =   $this->clean($_POST['coin_type']);
				$coin      =   strtoupper($coin_type);

				$stmt = $this->con->prepare("UPDATE users SET $coin = $coin+? WHERE id = ?");
				$stmt->bind_param("ds", $bal, $id);

				$stmt->execute();
			}

			if ($status == 'success' && $trans_type == 'credit') {
				$bal       =   $this->clean($_POST['amount']);
				$id        =   $this->clean($_POST['id']);
				$coin_type =   $this->clean($_POST['coin_type']);
				$coin      =   strtoupper($coin_type);

				$stmt = $this->con->prepare("UPDATE users SET $coin = $coin+? WHERE id = ?");
				$stmt->bind_param("ds", $bal, $id);

				$stmt->execute();
			}

			$stmt = $this->con->prepare("UPDATE crypto_transactions SET status = ? WHERE trans_id = ?");
			$stmt->bind_param("ss", $status, $trans_id);
			$stmt1 = $this->con->prepare("UPDATE transactions SET status = ? WHERE trans_id = ?");
			$stmt1->bind_param("ss", $status, $trans_id);
			$stmt2 = $this->con->prepare("UPDATE activities SET status = ? WHERE trans_id = ?");
			$stmt2->bind_param("ss", $status, $trans_id);

			$stmt->execute();
			$stmt1->execute();
			$stmt2->execute();

			$response['status'] = true;
			$response['message'] = "User info updated successfully";
		}

		if ($action == "edit") {
			$fname = $this->clean($_POST['amount']);
			$lname = $this->clean($_POST['balance']);
			$email = $this->clean($_POST['user_email']);
			$phone = $this->clean($_POST['user_phone']);
			$user  = $this->clean($_POST['user_username']);
			$type  = $this->clean($_POST['user_type']);
			$bal   = $this->clean($_POST['add_balance']);

			$stmt = $this->con->prepare("UPDATE users SET fname = ?, lname = ?, email = ?, phone = ?, username = ?, type = ?, balance = balance+? WHERE id = ?");
			$stmt->bind_param("sssssssi", $fname, $lname, $email, $phone, $user, $type, $bal, $user_id);

			if ($stmt->execute() === true && $stmt->affected_rows > 0) {
				$response['status'] = true;
				$response['msg'] = "User info updated successfully";
			} else {
				$response['msg'] = "No changes were made";
			}
		}

		return $response;
	}

	// | Admin - KYC ACTIONS |
	public function kyc_actions($id, $action)
	{
		$response['status'] = false;
		$response['msg'] = "Error Occurred";

		if ($action == "delete_kyc") {
			$stmt = $this->con->prepare("DELETE FROM kyc_details WHERE id = ?");
			$stmt->bind_param("i", $id);

			$stmt->execute();

			$response['status'] = true;
			$response['message'] = "Details deleted successfully";
		}

		if ($action == "update_kyc") {
			$status = '';

			if (isset($_POST['status'])) $status = $this->clean($_POST['status']);
			if (isset($_POST['edit_id'])) $edit_id = $this->clean($_POST['edit_id']);
			if (isset($_POST['trans_type'])) $trans_type = $this->clean($_POST['trans_type']);

			$id        =   $this->clean($_POST['id']);
			$review_by =   $this->clean($_POST['review_by']);
			$date      =   date('Y-m-d H:i:s');

			$statuss = ($status == 'approved') ? 'yes' : 'no';
			$stmt = $this->con->prepare("UPDATE users SET kyc_verified = ? WHERE id = ?");
			$stmt->bind_param("ss", $statuss, $id);

			$stmt1 = $this->con->prepare("UPDATE kyc_details SET status = ?, approved_by = ?, approval_date = ? WHERE id = ?");
			$stmt1->bind_param("sssi", $status, $review_by, $date, $edit_id);

			$stmt->execute();
			$stmt1->execute();

			$response['status'] = true;
			$response['message'] = "User info updated successfully";
		}

		return $response;
	}

	## Single KYC DETAILS ##
	public function single_kyc($id, $selector = null)
	{
		$id = $this->clean($id);
		if (!empty($selector)) {
			$stmt = $this->con->prepare("SELECT * FROM kyc_details WHERE $selector = ? LIMIT 1");
			$stmt->bind_param("s", $id);
		} else {
			$stmt = $this->con->prepare("SELECT * FROM kyc_details WHERE id = ? LIMIT 1");
			$stmt->bind_param("s", $id);
		}

		$stmt->execute();
		$res = $stmt->get_result();
		$obj = $res->fetch_object();
		if (empty($obj)) {
			return;
		}

		return $obj;
	}


	## Single Transaction ##
	public function single_transaction($trans_id, $selector = null)
	{
		$trans_id = $this->clean($trans_id);
		if (!empty($selector)) {
			$stmt = $this->con->prepare("SELECT * FROM transactions WHERE $selector = ? LIMIT 1");
			$stmt->bind_param("s", $trans_id);
		} else {
			$stmt = $this->con->prepare("SELECT * FROM transactions WHERE trans_id = ? LIMIT 1");
			$stmt->bind_param("s", $trans_id);
		}

		$stmt->execute();
		$res = $stmt->get_result();
		$obj = $res->fetch_object();
		if (empty($obj)) {
			return;
		}

		return $obj;
	}


	## Loan requests ##
	public function loan_requests()
	{
		$data = array();
		$stmt = $this->con->prepare("SELECT * FROM loan_requests where paid = 'yes' ORDER BY id DESC");
		$stmt->execute();
		$res = $stmt->get_result();
		while ($obj = $res->fetch_object()) {
			array_push($data, $obj);
		}
		return $data;
	}

	## Loan requests ##
	public function funds_requests()
	{
		$data = array();
		$stmt = $this->con->prepare("SELECT * FROM funds_requests ORDER BY id DESC");
		$stmt->execute();
		$res = $stmt->get_result();
		while ($obj = $res->fetch_object()) {
			array_push($data, $obj);
		}
		return $data;
	}

	// | Admin - User actions |
	public function user_actions($user_id, $action)
	{
		$response['status'] = false;
		$response['msg'] = "Error Occurred";

		if ($action == "delete") {
			$stmt = $this->con->prepare("DELETE FROM users WHERE id = ?");
			$stmt->bind_param("i", $user_id);

			$stmt2 = $this->con->prepare("DELETE FROM activities WHERE user_id = ?");
			$stmt2->bind_param("i", $user_id);

			$stmt3 = $this->con->prepare("DELETE FROM credit_cards WHERE user_id = ?");
			$stmt3->bind_param("i", $user_id);

			$stmt4 = $this->con->prepare("DELETE FROM loan_requests WHERE user_id = ?");
			$stmt4->bind_param("i", $user_id);

			// $stmt5 = $this->con->prepare("DELETE FROM loan_request_details WHERE user_id = ?");
			// $stmt5->bind_param("i",$user_id);

			$stmt6 = $this->con->prepare("DELETE FROM notifications WHERE user_id = ?");
			$stmt6->bind_param("i", $user_id);

			$stmt7 = $this->con->prepare("DELETE FROM userdata WHERE user_id = ?");
			$stmt7->bind_param("i", $user_id);

			$stmt7 = $this->con->prepare("DELETE FROM referrals WHERE user_id = ? OR ref_id = ?");
			$stmt7->bind_param("ii", $user_id, $user_id);

			$stmt8 = $this->con->prepare("DELETE FROM transactions WHERE user_id = ?");
			$stmt8->bind_param("s", $trans_id);

			$stmt9 = $this->con->prepare("DELETE FROM crypto_transactions WHERE user_id = ?");
			$stmt9->bind_param("s", $trans_id);

			$stmt->execute();
			$stmt2->execute();
			$stmt3->execute();
			$stmt4->execute();
			// $stmt5->execute();
			$stmt6->execute();
			$stmt7->execute();
			$stmt8->execute();
			$stmt9->execute();
			$response['status'] = true;
			$response['msg'] = "User deleted successfully";
		}
		if ($action == "edit") {
			$fname = $this->clean($_POST['user_fname']);
			$lname = $this->clean($_POST['user_lname']);
			$email = $this->clean($_POST['user_email']);
			$phone = $this->clean($_POST['user_phone']);
			$user  = $this->clean($_POST['user_username']);
			$type  = $this->clean($_POST['user_type']);
			$status  = $this->clean($_POST['user_status']);
			$bal   = $this->clean($_POST['add_balance']);
			$btc   = $this->clean($_POST['add_btc_balance']);
			$eth   = $this->clean($_POST['add_eth_balance']);
			$usdt   = $this->clean($_POST['add_usdt_balance']);

			$email_verified = 0;
			if ($status == 'active') {
				$email_verified = 1;
			}

			$stmt = $this->con->prepare("UPDATE users SET fname = ?, lname = ?, email = ?, phone = ?, username = ?, type = ?, status = ?, email_verified = ?, balance = balance+?, BTC = BTC+?, ETH = ETH+?, USDT = USDT+? WHERE id = ?");
			$stmt->bind_param("sssssssisdddi", $fname, $lname, $email, $phone, $user, $type, $status, $email_verified, $bal, $btc, $eth, $usdt, $user_id);

			if ($stmt->execute() === true && $stmt->affected_rows > 0) {
				$response['status'] = true;
				$response['msg'] = "User info updated successfully";
			} else {
				$response['msg'] = "No changes were made";
			}
		}

		if ($action == "suspend") {
			$status  = $this->clean($_POST['user_status']);

			$email_verified = 0;
			if ($status == 'active') {
				$email_verified = 1;
			}

			$stmt = $this->con->prepare("UPDATE users SET email_verified = ?, status = ? WHERE id = ?");
			$stmt->bind_param("isi", $email_verified, $status, $user_id);

			if ($stmt->execute() === true && $stmt->affected_rows > 0) {
				$response['status'] = true;
				$response['msg'] = "Action successful!";
			} else {
				$response['msg'] = "No changes were made";
			}
		}

		return $response;
	}

	public function loan_action($req_id, $action, $change = false)
	{
		$req = $this->loan_request_details($req_id);
		$loan_amount = $req->amount;
		$user_id = $req->user_id;
		$sitename = $this->settings()->site_title;

		// Decline Loan
		if ($action == "decline") {
			$stmt = $this->con->prepare("UPDATE loan_requests SET status='0' WHERE id = ?");
			$stmt->bind_param("i", $req_id);
			$stmt->execute();
			if ($stmt->affected_rows == 1) {
				$amount = number_format($loan_amount);
				$text = "Your loan of {$this->coin}{$amount} was declined";
				$link = "loans";
				$type = "loan-response";
				$this->register_notification(null, $user_id, $text, $link, $type);
				$user = $this->user($user_id);
				$message = $text . " \n Login to your account for more information";
				$this->mail($user->email, $sitename . " Loan request", $message);

				// Logs
				$activity = "You declined a loan of {amount}. Request ID : {req_id}";
				$this->log_action("loan", $user->id, $req_id, null, null, null, time(), $activity);
				//END Logs

				echo json_encode(["code" => 200, "msg" => "Loan Declined"]);
				exit;
			} else {
				echo json_encode(["code" => 400, "msg" => "Error occurred while declining loan"]);
				exit;
			}
		}
		// Approve Loan
		if ($action == "approve") {
			$stmt = $this->con->prepare("UPDATE loan_requests SET status='1' WHERE id = ?");
			$stmt->bind_param("i", $req_id);
			$stmt->execute();
			if ($stmt->affected_rows == 1) {
				$amount = number_format($loan_amount);
				$text = "Your loan of {$this->coin}{$amount} has been approved";
				$link = "loans";
				$type = "loan-response";
				$this->register_notification(null, $user_id, $text, $link, $type);
				$user = $this->user($user_id);
				$message = $text . " \n Login to your account for more information";
				$this->mail($user->email, $sitename . " Loan request", $message);
				if ($this->credit_balance($user_id, $req->amount) === true) {
					if ($this->register_user_activity($user_id, "You recieved a loan of {amount}", null, $req->amount, $this->user($user_id)->balance, "loan", "credit", $req->trans_id) === true) {
						// Logs
						$activity = "You approved a loan of {amount}. Request ID : {req_id}";
						$this->log_action("loan", $user->id, $req_id, null, null, null, time(), $activity);
						//END Logs

						echo json_encode(["code" => 200, "msg" => "Loan Approved"]);
						exit;
					}
				}
			} else {
				echo json_encode(["code" => 400, "msg" => "Error occurred while approving loan"]);
				exit;
			}
		}

		if ($action == "change_amount" && !empty($change)) {
			$stmt = $this->con->prepare("UPDATE loan_requests SET status='3', new_amount = ? WHERE id = ?");
			$stmt->bind_param("ii", $change, $req_id);
			$stmt->execute();
			if ($stmt->affected_rows == 1) {
				$amount = number_format($loan_amount);
				$text = "Your loan of {$this->coin}{$amount} was changed to {$this->coin}{$change}";
				$link = "loans";
				$type = "loan-response";
				$this->register_notification(null, $user_id, $text, $link, $type);
				$user = $this->user($uid);
				$message = $text . " \n Login to your account for more information";
				$this->mail($user->email, $sitename . " Loan request", $message);

				// Logs
				$activity = "You change a loan of {amount} to {new_amount}. Request ID : {req_id}";
				$this->log_action("loan", $user->id, $req_id, null, null, null, time(), $activity);
				//END Logs

				echo json_encode(["code" => 200, "msg" => "Loan Amount changed!"]);
				exit;
			} else {
				echo json_encode(["code" => 400, "msg" => "Error occurred while changing loan amount"]);
				exit;
			}
		}
	}


	// +----------------------------+
	// | Developers API
	// +----------------------------+

	## Verify api Key ##
	public function verify_api_key($key, $username = "payment")
	{
		$key = $this->encrypt($key);
		if ($username == "payment") {
			$stmt = $this->con->prepare("SELECT id FROM users WHERE api_key = ?");
			$stmt->bind_param("s", $key);
		} else {
			$stmt = $this->con->prepare("SELECT id FROM users WHERE api_key = ? AND username = ?");
			$stmt->bind_param("ss", $key, $username);
		}
		$stmt->execute();
		$result = $stmt->get_result();
		if ($result->num_rows == 0) {
			return false;
		} else {
			$obj = $result->fetch_object();
			return $this->user($obj->id);
		}
		return false;
	}

	## Api transaction ##
	public function api_transaction($trans_id)
	{
		$stmt = $this->con->prepare("SELECT * FROM api_payment_reference WHERE trans_id = ?");
		$stmt->bind_param("s", $trans_id);
		$stmt->execute();
		$result = $stmt->get_result();
		if ($result->num_rows == 0) {
			return false;
		} else {
			$obj = $result->fetch_object();
			return $obj;
		}
		return false;
	}
	

	public function verify_api_reference($reference)
	{
		$stmt = $this->con->prepare("SELECT * FROM api_payment_reference WHERE gateway_reference = ?");
		$stmt->bind_param("s", $reference);
		$stmt->execute();
		$result = $stmt->get_result();
		if ($result->num_rows == 0) {
			return false;
		} else {
			$obj = $result->fetch_object();
			if ($obj->used == 1) {
				return false;
			} else {
				return true;
			}
		}
		return false;
	}

	## Update API payment ##
	public function update_api_payment($reference, $trans_id, $resp)
	{
		$resp = json_encode($resp);
		$stmt = $this->con->prepare("UPDATE api_payment_reference SET response = ?, used = 1 WHERE trans_id = ?");
		$stmt->bind_param("ss", $resp, $trans_id);
		$stmt->execute();
		if ($stmt->affected_rows == 1) {
			return true;
		}

		return false;
	}

	public function chk_bal($url, $token = '')
	{
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'GET',
			CURLOPT_HTTPHEADER => array(
				'Authorization: ' . $token
			),
		));

		$response = curl_exec($curl);
		curl_close($curl);

		return json_decode($response);
	}

	public function virtual_statement($reference, $txnRef = '')
	{
		if ($txnRef !== '') $txnRef = '?reference=' . $txnRef;
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => $this->apiurl.'virtual-statement/' . $reference . $txnRef,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'GET',
			// CURLOPT_HTTPHEADER => array(
			// 	'Authorization: ' . $token
			// ),
		));

		$response = curl_exec($curl);
		curl_close($curl);

		return json_decode($response);
	}


	public function checBalance($source, $reference = '')
	{
		if ($source == 'paystack') {
			return $this->chk_bal('https://api.paystack.co/balance', 'Bearer sk_live_bf9bb9c402757d4259159d38616b6bce535b80e2');
		} elseif ($source == 'flutterwave') {
			return $this->chk_bal('https://api.flutterwave.com/v3/balances', 'Bearer FLWSECK-5ad8779af42984a87bd098aa2a7748eb-X');
		} elseif ($source == 'kuda') {
			return $this->chk_bal($this->apiurl.'virtual-balance/' . $reference);
		} elseif ($source == 'atg') {
			return $this->chk_bal('https://aimtoget.com/api/v1/balance', 'Bearer b1219e3d628e41f9367ff77c4382f9fd8510c5c4b31de5a2a2d68edea6b733a6');
		} else {
			return false;
		}
	}
	
	public function checkUserBalance(){
		$data = array();
		$stmt = $this->con->prepare("SELECT * FROM users");
		$stmt->execute();
		$res = $stmt->get_result();
		$obj = $res->fetch_object();
		while($obj = $res->fetch_object()){
		  $balance += $obj->balance;
		}
		return $balance;
	}
}


$app = new app();
$site = $app->settings();
$sitename = $app->settings()->site_title;
$siteurl = $app->siteurl;
$apiurl = $app->apiurl;
$coin = "₦";

// if ($site->site_maintenance == 1) {
// 	header("Location: ./maintenance");
// }

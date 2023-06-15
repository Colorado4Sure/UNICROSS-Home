<?php 
// +------------------------------------------------------------------------+
// | @author        : Michael Arawole (HENT Technologies)
// | @author_url    : https://logad.net
// | @author_email  : henttech@gmail.com
// +------------------------------------------------------------------------+
// | Copyright (c) 2020 HENT Technologies. All rights reserved.
// +------------------------------------------------------------------------+

// +----------------------------+
// | Loan Request Details
// +----------------------------+

require '../../core/functions.php';

if(empty($_POST['req_id'])){
	exit();
}


$req_id = $app->clean($app->decrypt($_POST['req_id']));
$req = $app->loan_request_details($req_id);
$user = $app->user($req->user_id);

$response['code'] = 400;
$response['msg'] = "Error Occurred";

if ($req->type == "personal") {
	$doj = date("d-M-Y h:ia",$user->doj);
	$req->amount = number_format($req->amount);
	$user->balance = number_format($user->balance);
	$html = <<< HEREDOC
	<div class="table-responsive ">
		<table class="table table-borderless w-100 mt-4 ">
			<tbody>
			    <tr>
			    	<td>
			        	<strong>First Name :</strong> {$user->fname}
			        </td>
			        <td>
			        	<strong>Last Name :</strong> {$user->lname}
			        </td>
			    </tr>
			    <tr>
			    	<td>
			        	<strong>Email :</strong> {$user->email}
			    	</td>
			    	<td>
			        	<strong>Phone :</strong> {$user->phone}
			    	</td>
			    </tr>
			    <tr>
			    	<td>
			        	<strong>Amount :</strong> {$coin}{$req->amount}
			        </td>
			    	<td>
			        	<strong>Type :</strong> {$req->type}
			    	</td>
			    </tr>
			    <tr>
			    	<td>
			        	<strong>User joined date :</strong> {$doj}
			    	</td>
			    	<td>
			        	<strong>User balance :</strong> {$coin}{$user->balance}
			    	</td>
			    </tr>
		  	</tbody>
	  	</table>
	</div>
HEREDOC;

	echo json_encode(["code"=>200, "html"=>$html, "msg"=>"Retrieved"]);
	exit;
}


if($req->type=="salary"){
	$state_origin = $app->get_states($req->details->state_origin);
	$city_origin = $app->get_cities($req->details->city_origin,true);

	$state_address = $app->get_states($req->details->state_address);
	$city_address = $app->get_cities($req->details->city_address,true);
	$office_city = $app->get_cities($req->details->office_city, true);
	$office_state = $app->get_states($req->details->office_state);

	$req->amount = number_format($req->amount);
	$user->balance = number_format($user->balance);
	// $req->details->salary_bank = $app->get_banks($req->details->salary_bank, "id");
	// print_r($req->details->salary_bank);
	$html = <<< HEREDOC
	<div class="table-responsive ">
		<table class="table table-borderless w-100 mt-4 ">
			<tbody>
			    <tr>
			    	<td>
			        	<strong>First Name :</strong> {$req->details->fname}
			        </td>
			        <td>
			        	<strong>Last Name :</strong> {$req->details->lname}
			        </td>
			    </tr>
			    <tr>
			    	<td>
			        	<strong>Amount :</strong> {$coin}{$req->amount}
			        </td>
			    	<td>
			        	<strong>Type :</strong> {$req->type}
			    	</td>
			    </tr>
			    <tr>
			    	<td>
			        	<strong>DOB :</strong> {$req->details->dob}
			    	</td>
			    	<td>
			        	<strong>Gender :</strong> {$req->details->gender}
			    	</td>
			    </tr>
			    <tr>
			    	<td>
			        	<strong>Marital Status :</strong> {$req->details->marital_status}
			    	</td>
			    	<td>
			        	<strong>State of Origin :</strong> {$state_origin}
			    	</td>
			    </tr>
			    <tr>
			    	<td>
			        	<strong>City of Origin :</strong> {$city_origin}
			    	</td>
			    	<td>
			        	<strong>Children :</strong> {$req->details->children}
			    	</td>
			    </tr>
			    <tr>
			    	<td>
			        	<strong>Dependants :</strong> {$req->details->dependants}
			    	</td>
			    	<td>
			        	<strong>Facebook :</strong> {$req->details->fb_url}
			    	</td>
			    </tr>
			    <tr>
			    	<td>
			        	<strong>Home Address :</strong> {$req->details->address}
			    	</td>
			    	<td>
			        	<strong>Nearest Bustop :</strong> {$req->details->subrub_address}
			    	</td>
			    </tr>
			    <tr>
			    	<td>
			        	<strong>Residential State :</strong> {$state_address}
			    	</td>
			    	<td>
			        	<strong>City :</strong> {$city_address}
			    	</td>
			    </tr>
			    <tr>
			    	<td>
			        	<strong>Home Address :</strong> {$req->details->address}
			    	</td>
			    	<td>
			        	<strong>Nearest Bustop :</strong> {$req->details->subrub_address}
			    	</td>
			    </tr>
			    <tr>
			    	<td>
			        	<strong>Time at current residence :</strong> {$req->details->address_duration}
			    	</td>
			    	<td>
			        	<strong>Accommodation Type :</strong> {$req->details->accommodation_type}
			    	</td>
			    </tr><tr>
			    	<td>
			        	<strong>Mobile :</strong> {$req->details->mobile_number}
			    	</td>
			    	<td>
			        	<strong>Employment Type :</strong> {$req->details->employment_type}
			    	</td>
			    </tr>
			    <tr>
			    	<td>
			        	<strong>Monthly Salary :</strong> {$req->details->monthly_salary}
			    	</td>
			    	<td>
			        	<strong>Employer Name :</strong> {$req->details->employer_name}
			    	</td>
			    </tr>
			    <tr>
			    	<td>
			        	<strong>Employer Phone :</strong> {$req->details->employer_phone}
			    	</td>
			    	<td>
			        	<strong>Time at current work place :</strong> {$req->details->employment_duration}
			    	</td>
			    </tr>
			    <tr>
			    	<td>
			        	<strong>Office Address :</strong> {$req->details->office_address}
			    	</td>
			    	<td>
			        	<strong>Nearest Bustop :</strong> {$req->details->subrub_office}
			    	</td>
			    </tr> 
			    <tr>
			    	<td>
			        	<strong>Office Sate :</strong> {$office_state}
			    	</td>
			    	<td>
			        	<strong>Office City :</strong> {$office_city}
			    	</td>
			    </tr> 
			    <tr>
			    	<td>
			        	<strong>BVN :</strong> {$req->details->bvn}
			    	</td>
			    	<td>
			        	<strong>Account Number :</strong> {$req->details->salary_ano}
			    	</td>
			    </tr> 
			    <tr>
			    	<td>
			        	<strong>Account Bank :</strong> {$req->details->salary_bank}
			    	</td>
			    </tr>
			    <tr>
			    	<td>
			        	<strong>Loan Amount :</strong> {$req->details->loan_amount}
			    	</td>
			    	<td>
			        	<strong>Loan Reason :</strong> {$req->details->loan_reason}
			    	</td>
			    </tr>
		  	</tbody>
	  	</table>

		<div class="col-12">
			<h5 class="font-weight:bold">Uploads</h5><hr>
			<h5 class="mt-5 ">Work ID</h5>
			<img class="img-fluid" src="{$siteurl}/{$req->details->work_id}"/>
			<h5 class="mt-5 ">Government issued ID</h5>
			<img class="img-fluid" src="{$siteurl}/{$req->details->gov_id}"/>
			<h5 class="mt-5 ">Passport</h5>
			<img class="img-fluid" src="{$siteurl}/{$req->details->passport}"/>
			<h5  class="mt-5 ">Bank Statment</h5>
			<img class="img-fluid" src="{$siteurl}/{$req->details->bank_statement}"/>
		</div>
	</div>
HEREDOC;

	echo json_encode(["code"=>200, "html"=>$html, "msg"=>"Retrieved"]);
	exit;
}


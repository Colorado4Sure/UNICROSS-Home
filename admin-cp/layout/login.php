<?php
require '../../core/functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login - <?=$sitename?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="auth-assets/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="auth-assets/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="auth-assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="auth-assets/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="auth-assets/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="auth-assets/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="auth-assets/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="auth-assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="auth-assets/css/main.css">
<!--===============================================================================================-->
    <style>
        .disabled {
            opacity: 0.65;
            cursor: not-allowed;
            touch-action: none;
        }
    </style>
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-50 p-r-50 p-t-77 p-b-30">
				<form class="login100-form validate-form" id="login-form">
					<span class="login100-form-title p-b-55">
						Login
					</span>

					<div class="wrap-input100 m-b-16">
						<input class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<span class="lnr lnr-user"></span>
						</span>
					</div>

					<div class="wrap-input100 m-b-16">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<span class="lnr lnr-lock"></span>
						</span>
					</div>

					<div class="contact100-form-checkbox m-l-4">
						<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
						<label class="label-checkbox100" for="ckb1">
							Remember me
						</label>
					</div>
					
					<div class="container-login100-form-btn p-t-25">
						<button type="submit" class="login100-form-btn">
							Login
						</button>
					</div>

					<div class="text-center w-full p-t-10">
						<span class="txt1">
							Not a member?
						</span>

						<a class="txt1 bo1 hov1" href="<?=$siteurl?>/register">
							Register
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="auth-assets/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="auth-assets/vendor/bootstrap/js/popper.js"></script>
	<script src="auth-assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="auth-assets/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="auth-assets/js/main.js"></script>
	<script type="text/javascript">
	    $("form#login-form").submit(function(e){
	        e.preventDefault();
	        var formData = new FormData($(this)[0]);
	        $thiss=$(this).find("[type=submit]");
	        $thiss.text("please wait...");
	        $thiss.addClass("disabled");

	        $.ajax({
	            url: '<?=$siteurl?>/auth/login',
	            type: 'POST',
	            data: formData,
	            dataType: "json",
	            cache: false,
	            contentType: false,
	            processData: false,
	            success : function(data){
	                if (data.code == "200"){
	                    $thiss.text("Redirecting...");
	                    window.location.replace(data.url);
	                } else {
	                    $thiss.text("Login");
	                    $thiss.removeClass("disabled");
	                    alert(data.msg);
	                }
	            }
	        });
	    })
	</script>

</body>
</html>
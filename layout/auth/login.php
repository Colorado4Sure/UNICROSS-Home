<?php
require '../../main/classes/user.class.php';
if ($app->is_login()) {
    header("Location: $siteurl/account");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="admin, dashboard" />
    <meta name="author" content="DexignZone" />
    <meta name="robots" content="index, follow" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="MOPHY : Payment Admin Dashboard  Bootstrap 5 Template" />
    <meta property="og:title" content="MOPHY : Payment Admin Dashboard  Bootstrap 5 Template" />
    <meta property="og:description" content="MOPHY : Payment Admin Dashboard  Bootstrap 5 Template" />
    <meta property="og:image" content="social-image.png" />
    <meta name="format-detection" content="telephone=no">
    <title>UNICROSS - Portal Login</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="account/assets/images/logo.png">
    <link href="account/assets/css/style.css" rel="stylesheet">

</head>
<style>
    .loader {
        border: 16px solid #f3f3f3;
        /* Light grey */
        border-top: 16px solid #3498db;
        /* Blue */
        border-radius: 50%;
        /* width: 120px;
        height: 120px; */
        animation: spin 2s linear infinite;
        position: absolute;
        left: 50%;
        top: 50%;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .hide {
        display: none;
    }
</style>
<div class="loading hide" style="background: #000000ab; width: 100vw;height: 100vh; position: fixed;">
    <div class="loader"></div>
</div>

<body class="h-100">

    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">

                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <div class="text-center mb-3">
                                        <a href="index-2.html"><img src="account/assets/images/logo-text.png" alt=""></a>
                                    </div>
                                    <h4 class="text-center mb-4 text-white">Sign in your account</h4>
                                    <div class="message hide" style="background: #fe8024;text-align: center;color: #fff;padding: 10px;border-radius: 10px;margin-bottom: 10px;"></div>
                                    <form action="" id=regNow>
                                        <div class="form-group">
                                            <label for=login_id class="mb-1 text-white"><strong>Matric No/Reg No/Email or Phone Number</strong></label>
                                            <input type="text" name=login_id class="form-control" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for=password class="mb-1 text-white"><strong>Password</strong></label>
                                            <input type="password" name=password class="form-control" value="">
                                        </div>
                                        <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                            <div class="form-group">
                                                <a class="text-white" href="page-forgot-password.html">Forgot Password?</a>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn bg-white text-primary btn-block">Log In</button>
                                        </div>
                                    </form>
                                    <div class="new-account mt-3">
                                        <p class="text-white">Don't have a password? <a class="text-white" href="page-register.html">Create One</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="account/assets/vendor/global/global.min.js"></script>
    <script src="account/assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="account/assets/js/custom.min.js"></script>
    <script src="account/assets/js/deznav-init.js"></script>

    <script>
        $('#regNow').submit(function(e) {
            e.preventDefault();
            var formData = new FormData($(this)[0]);
            $thiss = $(this).find("[type=submit]");
            $thiss.text("please wait...");
            $thiss.addClass("disabled");
            $(".loading").removeClass("hide");

            $.ajax({
                url: '<?= $siteurl ?>auth/login',
                type: 'POST',
                data: formData,
                dataType: "json",
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    // console.log(data);
                    if (data.status == true) {
                        $thiss.text("Redirecting...");
                        window.location.replace('<?= $siteurl ?>' + data.url);
                    } else {
                        $thiss.text("Log in");
                        $thiss.removeClass("disabled");
                        $(".loading").addClass("hide");

                        $(".message").html(data.msg);

                        $(".message").removeClass("hide");
                        // alert(data.msg);
                    }
                }
            }).fail(function(jqXHR, textStatus, error) {
                // Handle error here
                console.log(jqXHR.responseText, textStatus, error);
                $thiss.text("Log in");
                $thiss.removeClass("disabled");
                $(".loading").addClass("hide");

                $(".message").html(jqXHR.responseText);
                $(".message").removeClass("hide");
                // $('#editor-content-container').html(jqXHR.responseText);
                // $('#editor-container').modal('show');
            });
        })
    </script>
</body>

</html>
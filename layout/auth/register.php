<?php include '../../main/classes/user.class.php'; ?>

<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">
    <title>Ditepay - Create Account</title>
    <meta name="description" content="Ditepay Finetech">
    <meta name="keywords" content="Ditepay is a leading mobile money company that is building an ecosystem to enable people to digitally send and receive money, and creating simple financial access for everyone." />
    <link rel="icon" type="image/png" href="/_nuxt/img/dite_bg.png" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="/_nuxt/img/dite_bg.png">
    <link rel="stylesheet" href="/account/assets/css/style.css">
    <link rel="manifest" href="/account/__manifest.json">
    <script src="/account/assets/js/lib/jquery-3.6.0.min.js"></script>
</head>

<body>

    <!-- loader -->
    <div id="loader">
        <img src="/account/assets/img/loading-icon.png" alt="icon" class="loading-icon">
    </div>
    <!-- * loader -->

    <!-- App Header -->
    <div class="appHeader no-border transparent position-absolute">
        <div class="left">
            <a href="#" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle"></div>
        <div class="right">
            <a href="/login" class="headerButton">
                Login
            </a>
        </div>
    </div>
    <!-- * App Header -->

    <!-- App Capsule -->
    <div id="appCapsule">

        <div class="section mt-2 text-center">
            <h1>Register now</h1>
            <h4>Create an account</h4>
        </div>
        <div class="section mb-5 p-2">
            <form method="post" id="regNow">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="fname">First Name</label>
                                <input type="text" class="form-control" name="fname" id="fname" placeholder="Your First Name">
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>

                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="lname">Last Name</label>
                                <input type="text" class="form-control" name="lname" id="lname" placeholder="Your Last Name">
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>

                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="username">UserName</label>
                                <input type="text" class="form-control" name="username" id="username" placeholder="Your UserName">
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>

                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="username">Phone Number</label>
                                <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control" name="phone" id="phone" placeholder="08012345678">
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>

                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="email1">E-mail</label>
                                <input type="email" class="form-control" name="email" id="email1" placeholder="Your e-mail">
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>

                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="password1">Password</label>
                                <input type="password" class="form-control" name="password" id="password1" autocomplete="off" placeholder="Your password">
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>

                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="password2">Password Again</label>
                                <input type="password" name="repeat_password" class="form-control" id="password2" autocomplete="off" placeholder="Type password again">
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>

                        <div class="custom-control custom-checkbox mt-2 mb-1">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="customCheckb1">
                                <label class="form-check-label" for="customCheckb1">
                                    I agree <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">terms and
                                        conditions</a>
                                </label>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="form-button-group transparent">
                    <button type="submit" disabled class="btn btn-primary btn-block btn-lg" id="register">Register</button>
                </div>

            </form>
        </div>

        <div id="toast-16" class="toast-box toast-bottom bg-danger">
            <div class="in">
                <div class="text">
                    <!-- Danger Color -->
                </div>
            </div>
        </div>
        <div id="toast-15" class="toast-box toast-bottom bg-success">
            <div class="in">
                <div class="text">
                    <!-- Success Color -->
                </div>
            </div>
        </div>
    </div>
    <!-- * App Capsule -->


    <!-- Terms Modal -->
    <div class="modal fade modalbox" id="termsModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Terms and Conditions</h5>
                    <a href="#" data-bs-dismiss="modal">Close</a>
                </div>
                <div class="modal-body">
                    <p>Copyright ©️ 2021. DITEPAYHUB GROUPS. This site is protected by copyright and registered under Nigeria . All rights reserved.</p>
                    <p>
                        Ditepayhub may revise and update these Terms of Use at any time. Please periodically review these Terms of Use because of your continued usage of Ditepay services.
                    </p>
                    <p>
                        Please be informed that we can terminate your relationship with us if we believe that you have violated any of these terms.
                    </p>
                    <h3>Ditepay Privacy Policy</h3>
                    <p>
                        Ditepay’s position on the privacy of its clients and visitors to this website can be found in the Ditepay’s Privacy Policy.
                    </p>
                    <h3>Use of contents – Copyright</h3>
                    <p>
                        Upon acceptance of these Terms and Conditions, Ditepay authorizes you, to view or download a single copy of, the material on this website solely for your personal, informational use, provided that you retain all copyright and other proprietary notices contained in the original material on any copies of the material. Such material specified above does not include the design or layout of Ditepay’s websites.
                    </p>
                    <h3>Account Registration</h3>
                    <p>
                        To be eligible to use the Ditepay Services, you must create an account with your email. As further detailed in our Privacy Policy, in order to register, create and use an account, Company may require that you submit certain Personal Information (as defined in the Privacy Policy).
                    </p>
                    <p>
                        You agree that the Personal Information you provide to our Company upon registration and at all other times will be true, accurate, current and complete, and you agree to maintain and update this Personal Information with us as necessary.
                    </p>
                    <h3>Transaction History</h3>
                    <p>You have the right to receive an account history. You may view your account activity or history by logging into your Ditepay Account.
                    </p>
                    <h3>Links and Third parties</h3>
                    <p>Ditepay website contain links to third party websites. These links are provided solely as a convenience to you and not as an endorsement by Ditepay of the content on such third-party websites.</p>
                    <p>Ditepay is not responsible for the content of linked third-party websites and does not make any representations regarding the content or accuracy of materials on such third-party websites. If you decide to access linked third-party websites, you do so at your own risk.</p>
                    <p>Your use of third-party websites is subject to any applicable terms and conditions of use for such sites. Linking to any page of any of Ditepay websites other than https://ditepay.com through a plain text link is strictly prohibited in the absence of a separate linking Agreement with Ditepay. Any website or other device that links to https://ditepay.com is prohibited from:</p>
                        
                    <h3>Closing your account</h3>
                    <p>As long as there are no pending or in progress transactions, you may close your account at any time. You may close your account by emailing us at ditepayhub001@gmail.com and requesting that we close your account. It may take up to 30 days for your account closure to be complete.</p>
                    <p>You may not close your account to evade a payment investigation. If you attempt to close your account while we are conducting an investigation, we may hold your funds for up to 100 days to protect the Company or a third party against the risk of reversals, chargebacks, claims, fees, fines, penalties and other liability. You will remain liable for all obligations related to your account even after the account is closed.</p>

                    <h3>Compliance with the law</h3>
                    <p>These Terms of Use shall be interpreted and governed by the laws currently in force in the Federal Republic of Nigeria.</p>

                    <h3>General</h3>
                    <p>Ditepay is based in Fedral Republic Of Nigeria. Ditepay makes no claims the Content is appropriate or may be downloaded outside of Nigeria. Access to the Content (including Software) may not be legal by certain persons or in certain countries.</p>
                    <p>If you access Ditepay’s websites from outside the Nigeria, you do so at your own risk and are solely responsible for compliance with the laws of your jurisdiction and any other applicable laws.</p>

                    <h3>Payment Investigations</h3>
                    <p>Payment investigation is a process by which the Company reviews certain potentially high-risk transactions. If a payment is subject to payment investigation, Ditepay will place a hold on the payment or account and may provide notice to the recipient.</p>
                    <p>We will will conduct a review and either clear or cancel the payment. If the payment is cleared, Company will provide notice to the recipient. Otherwise, Company will cancel the payment and the funds will be returned. Company will provide notice to you by email and/or in the account history tab of your Ditepay account if the payment is canceled.</p>

                    <h3>Changes to our terms of service</h3>
                    <p>Any changes we may make to our privacy policy in the future will be posted on this page.</p>
                    
                    <h3>Contact Us</h3>
                    <p>Questions, comments, complaints and requests regarding this terms are welcomed and should be addressed to:</p>
                    <p>
                    Email: ditepayhub001@gmail.com <br>
                    Phone Number: +2348163974533 <br>
                    Address: De5CEE PLAZA Enugwu ukwu, Nigeria.</p>
                </div>

            </div>
        </div>
    </div>
    <!-- * Terms Modal -->


    <!-- ========= JS Files =========  -->
    <!-- Bootstrap -->
    <script src="/account/assets/js/lib/bootstrap.bundle.min.js"></script>
    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- Splide -->
    <script src="/account/assets/js/plugins/splide/splide.min.js"></script>
    <!-- Base Js File -->
    <script src="/account/assets/js/base.js"></script>


    <script>
        $('#customCheckb1').click(function() {
            if ($('#customCheckb1').is(':checked')) {
                $("#register").removeAttr("disabled");
            } else {
                $("#register").attr("disabled", "disabled");
            }
            // alert()
        })

        $('#regNow').submit(function(e) {
            e.preventDefault();
            var formData = new FormData($(this)[0]);
            $thiss = $(this).find("[type=submit]");
            $thiss.text("please wait...");
            $thiss.addClass("disabled");

            $.ajax({
                url: '<?= $siteurl ?>/auth/register',
                type: 'POST',
                data: formData,
                dataType: "json",
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.status == true) {
                        $(".bg-success").html(data.msg);
                        toastbox('toast-15', 5000);
                        $thiss.text("Redirecting...");
                        window.location.replace('<?= $siteurl ?>' + data.url);
                    } else {
                        $thiss.text("Register");
                        $thiss.removeClass("disabled");
                        $(".bg-danger").html(data.msg);
                        toastbox('toast-16', 3000);
                        // alert(data.msg);
                    }
                }
            }).fail(function(jqXHR, textStatus, error) {
                // Handle error here
                console.log(jqXHR.responseText);
                // $('#editor-content-container').html(jqXHR.responseText);
                // $('#editor-container').modal('show');
            });
        })
    </script>
</body>

</html>
<?php
    require '../core/functions.php';
    $page = "Login";
    require 'layouts/head.phtml';
?>
<body class="nk-body bg-white npc-general pg-auth">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- wrap @s -->
            <div class="nk-wrap nk-wrap-nosidebar">
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
                        <div class="card card-bordered">
                            <div class="card-inner card-inner-lg">
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title">Admin Sign-In</h4>
                                    </div>
                                </div>
                                <form id="ajax-form">
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="default-01">Email or Username</label>
                                        </div>
                                        <input type="text" name="email" class="form-control form-control-lg" id="default-01" placeholder="Enter your email address or username">
                                    </div>
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="password">Passcode</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <a href="#" class="form-icon form-icon-right passcode-switch" data-target="password">
                                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                            </a>
                                            <input type="password" name="password" class="form-control form-control-lg" id="password" placeholder="Enter your passcode">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-lg btn-primary btn-block">Sign in</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="nk-footer nk-auth-footer-full">
                        <div class="container wide-lg">
                            <div class="row g-3">
                                <div class="col-lg-6">
                                    <div class="nk-block-content text-center text-lg-left">
                                        <p class="text-soft">&copy; <?=date('Y') ?> Ditepay. All Rights Reserved.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- wrap @e -->
            </div>
            <!-- content @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <!-- JavaScript -->
    <script src="asset/assets/js/bundle.js?ver=2.4.0"></script>
    <script src="asset/assets/js/scripts.js?ver=2.4.0"></script>

</html>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".page-preloader").hide('slow');
        });
        $("form#ajax-form").submit(function(e){
            e.preventDefault();
            var formData = new FormData($(this)[0]);
            $thiss=$(this).find("[type=submit]");
            $thiss.find(".ld").addClass("running");
            $thiss.addClass("btn-disabled");
            $thiss.attr("disabled",true);
            $.ajax({
                url: './backend/login',
                type: 'POST',
                data: formData,
                dataType: "json",
                cache: false,
                contentType: false,
                processData: false,
                success : function(data){
                    if (data.code == "200"){
                        $thiss.find(".ld").removeClass("running");
                        $thiss.removeClass("btn-disabled");;
                        $thiss.removeAttr("disabled");
                        toastr["success"](data.msg);
                        window.location.replace(data.url);
                    } else {
                        $thiss.find(".ld").removeClass("running");
                        $thiss.removeClass("btn-disabled");
                        $thiss.removeAttr("disabled");
                        toastr["error"](data.msg);
                        // alert(data.msg);
                    }
                }
            });
        })
    </script>

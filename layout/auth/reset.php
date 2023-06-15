<?php include '../../main/classes/user.class.php'; ?>
<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">
    <title>Ditepay - Create New Password</title>
    <meta name="description" content="Finapp HTML Mobile Template">
    <meta name="keywords" content="bootstrap, wallet, banking, fintech mobile template, cordova, phonegap, mobile, html, responsive" />
    <link rel="icon" type="image/png" href="/account/assets/img/favicon.png" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="/account/assets/img/icon/192x192.png">
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
        </div>
    </div>
    <!-- * App Header -->

    <!-- App Capsule -->
    <div id="appCapsule">

        <div class="section mt-2 text-center">
            <h1>Enter Reset Code</h1>
            <h4>Enter your account reset code</h4>
        </div>
        <div class="section mb-5 p-2">
            <form id="regNow">
              <div class="code-hidden">
                <div class="form-group basic">
                    <input type="text" name="code" class="form-control verification-input" id="smscode" placeholder="••••"
                        maxlength="10">
                </div>
                <div class="form-group basic">
                  <div class="form-button-group transparent">
                      <button class="btn btn-primary btn-block btn-lg" id="continue">Continue</button>
                  </div>
                </div>
              </div>

                <div class="password-hidden" style="display: none;">
                  <br>
                  <div class="form-group basic">
                      <div class="input-wrapper">
                          <label class="label" for="password1">Password</label>
                          <input type="password" class="form-control" name="password" id="password1" autocomplete="off"
                              placeholder="Your password">
                          <i class="clear-input">
                              <ion-icon name="close-circle"></ion-icon>
                          </i>
                      </div>
                  </div>

                  <div class="form-group basic">
                      <div class="input-wrapper">
                          <label class="label" for="password2">Password Again</label>
                          <input type="password" name="repeat_password" class="form-control" id="password2" autocomplete="off"
                              placeholder="Type password again">
                          <i class="clear-input">
                              <ion-icon name="close-circle"></ion-icon>
                          </i>
                      </div>
                  </div>

                  <div class="form-group basic">
                    <button type="button" class="btn btn-outline-danger me-1 mb-1 buttonBack" >GO BACK</button>
                  </div>

                  <div class="form-button-group transparent">
                      <button type="submit" class="btn btn-primary btn-block btn-lg">Submit</button>
                  </div>
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

    <!-- ========= JS Files =========  -->
    <!-- Bootstrap -->
    <script src="/account/assets/js/lib/bootstrap.bundle.min.js"></script>
    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- Splide -->
    <script src="/account/assets/js/plugins/splide/splide.min.js"></script>
    <!-- Base Js File -->
    <script src="/account/assets/js/base.js"></script>

    <script type="text/javascript">
    $("#continue").click(function (e) {
      e.preventDefault();

      $(".password-hidden").css('display', 'block');
      $(".code-hidden").css('display', 'none')
      $('.text-center').html('<h1>Enter Password</h1> <h4>Enter your new account password</h4>')
    })

    $(".buttonBack").click(function (e) {
      e.preventDefault();

      $(".password-hidden").css('display', 'none');
      $(".code-hidden").css('display', 'block')
      $('.text-center').html('<h1>Enter Reset Code</h1> <h4>Enter your account reset code</h4>')
    })

    $('#regNow').submit(function (e) {
          e.preventDefault();
          var formData = new FormData($(this)[0]);
          $thiss=$(this).find("[type=submit]");
          $thiss.text("please wait...");
          $thiss.addClass("disabled");

          $.ajax({
              url: '<?=$siteurl?>/auth/reset',
              type: 'POST',
              data: formData,
              dataType: "json",
              cache: false,
              contentType: false,
              processData: false,
              success : function(data){
                console.log(data);
                  if (data.status == true){
                    $(".bg-success").html(data.msg);
                      toastbox('toast-15', 5000);
                      $thiss.text("Redirecting...");
                      window.location.replace('<?=$siteurl?>'+data.url);
                      console.log(data);
                  } else {
                      $thiss.text("Verify");
                      $thiss.removeClass("disabled");
                      $(".bg-danger").html(data.msg);
                      toastbox('toast-16', 3000);
                      console.log(data);
                      // alert(data.msg);
                  }
              }
          }).fail(function (jqXHR, textStatus, error) {
          // Handle error here
          console.log(jqXHR.responseText);
          // $('#editor-content-container').html(jqXHR.responseText);
          // $('#editor-container').modal('show');
      });
      })

    </script>
</body>

</html>

<!-- App Header -->
<div class="appHeader no-border">
    <div class="left">
        <a href="#" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">
        <?= $page ?>
    </div>
    <div class="right"> </div>
</div>
<!-- * App Header -->

<!-- App Capsule -->
<div id="appCapsule">
      <div class="section mt-2">
        <div class="section-title">Request Money</div>
        <div class="card">
          <div class="card-body">
            <form id="verify">
              <div class="form-group basic">
                <div class="input-wrapper">
                  <label class="label" for="userid1">User email</label>
                  <input type="email" class="form-control email" id="email" placeholder="Enter email Address" required>
                  <i class="clear-input">
                    <ion-icon name="close-circle" role="img" class="md hydrated" aria-label="close circle"></ion-icon>
                  </i>
                </div>
              </div>

              <div class="form-group basic">
                <div class="input-wrapper">
                  <label class="label" for="amount1">Amount</label>
                  <input type="number" class="form-control amount" id="amount" placeholder="Enter an Amount" required>
                  <i class="clear-input">
                    <ion-icon name="close-circle" role="img" class="md hydrated" aria-label="close circle"></ion-icon>
                  </i>
                </div>
              </div>

              <div class="form-group basic">
                  <label class="label">Description</label>
                  <div class="input-group">
                      <span class="input-group-text" id="basic-addon1"><ion-icon name="newspaper-outline"></ion-icon></span>
                      <textarea class="form-control description" placeholder="Transaction Description" value="" name="description"></textarea>
                      <!-- <textarea name="name" rows="8" cols="80"></textarea> -->
                  </div>
              </div>

              <div class="form-group basic animated">
                <div class="input-wrapper">
                  <button type="submit" class="btn btn-primary btn-block">CONTINUE</button>
                </div>
              </div>
            </form>

          </div>
        </div>
      </div>
</div>


    <!-- Form Action Sheet -->
    <div class="modal fade action-sheet" id="actionSheetForm" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Request Money</h5>
                </div>
                <div class="modal-body">
                    <div class="action-sheet-content">
                        <form id="payload">
                          <!-- <div class="yesser" style="display: none;"> -->
                            <div class="form-group basic">
                                <label class="label">Transaction Pin</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><ion-icon name="lock-closed-outline"></ion-icon></span>
                                    <input type="text" class="form-control" placeholder="Enter Your Transaction Pin" value="" name="pin">
                                    <input type="hidden" class="form-control amountt" value="" name="amount">
                                    <input type="hidden" class="form-control emaill" name="email" value="">
                                    <input type="hidden" class="descriptionn" name="description" value="">
                                </div>
                            </div>

                            <div class="form-group basic">
                                <button type="submit" class="btn btn-primary btn-block">Send</button>
                            </div>
                          <!-- </div> -->
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- * Form Action Sheet -->


<!-- Success Action Sheet -->
<div id="toast-11" class="toast-box toast-center" style="z-index: 999999999999;">
    <div class="in">
        <ion-icon name="checkmark-circle" class="text-success md hydrated" role="img" aria-label="checkmark circle"></ion-icon>
        <div class="text" id="succ-modal">
            Success Message
        </div>
    </div>
    <button type="button" class="btn btn-sm btn-text-light close-button close">CLOSE</button>
</div>

<!-- Failed Action Sheet -->
<div id="toast-90" class="toast-box toast-center" style="z-index: 99999999999;">
    <div class="in">
        <ion-icon name="close-circle" role="img" class="text-danger md hydrated" aria-label="close circle"></ion-icon>
        <div class="text" id="failed-modal">
            Failed Message
        </div>
    </div>
    <button type="button" class="btn btn-sm btn-text-light close-button">CLOSE</button>
</div>

<div id="toast-16" class="toast-box toast-bottom bg-danger" style="z-index: 999999999999999999;">
    <div class="in">
        <div class="text" id="dang-msg">
            Danger Message
        </div>
    </div>
    <button type="button" class="btn btn-sm btn-text-light close-button">OK</button>
</div>


<script>
$('.close').click(function () {
window.location.href = '/account';
})
$('#verify').submit(function (e) {
  e.preventDefault();

  //Load Details to form payload
  $('.emaill').val($('.email').val())
  $('.amountt').val($('.amount').val())
  $('.descriptionn').val($('.description').val())

  ms($('.email').val(), $('.amount').val())
  validate($('.amount').val());
})

function validate(amount) {
  {
    email = $('#email').val();
    var settings = {
      "url": "<?= $app->site_url; ?>verify-user",
      "method": "POST",
      "timeout": 0,
      "data": {
        "email": $('#email').val()
      },
      beforeSend: function () {
        $('#appCapsule').empty()
        $('#appCapsule').html(`
          <div class="section mt-2" style="text-align: center;">
          <div class="spinner-border text-dark" role="status"></div>
          </div>`)
        }
    };

    $.ajax(settings).done(function (response) {
      // console.log(response);
      if (response.status === true) {
        $("#appCapsule").html(`<div class="section proceed">
        <div class="splash-page mt-5 mb-5">
            <div class="transfer-verification">
                <div class="transfer-amount">
                    <span class="caption">Amount</span>
                    <h2><?= $coin. ' '; ?>${parseFloat(amount).toFixed(2)}</h2>
                </div>
                <div class="from-to-block mb-5">
                    <div class="item text-start">
                        <img src="/account/assets/profilepics/<?= $user->profile_pic ?>" alt="avatar" class="imaged w48">
                        <strong>Acc. Balance <br><?= $coin. ' '. number_format($user->balance, 2) ?></strong>
                    </div>
                    <div class="item text-end">
                        <img src="/account/assets/profilepics/${response.data.pics}" alt="avatar" class="imaged w48">
                        <strong>${response.data.name}</strong>
                    </div>
                    <div class="arrow"></div>
                </div>
            </div>
            <h2 class="mb-2 mt-2">Verify the Transaction</h2>
            <p>
                You are requestings <strong class="text-primary"><?= $coin. ' '; ?>${parseFloat(amount).toFixed(2)}</strong> from ${response.data.name}. <br>Are you sure?
            </p>
        </div>

        <!-- <div class="fixed-bar"> -->
        <div class="row" style="margin-bottom: 25px;"></div>
        <div class="row" style="margin-bottom: 25px;">
          <div class="col-6">
            <a href="#" class="btn btn-lg btn-outline-secondary btn-block goBack">Cancel</a>
          </div>
          <div class="col-6">
            <a href="app-pages.html" class="btn btn-lg btn-primary btn-block confirm" onclick="clicked()" data-amount="${parseFloat($('.amount').val()).toFixed(2)}" data-email="${$('#email').val()}" data-bs-toggle="modal" data-bs-target="#actionSheetForm">Confirm</a>
          </div>
        </div>
        </div>`)
      }else {
        // console.log(response);
        alert(response.message)
        $('.proceed').empty();
      }
    });

  }
}

function dataChange() {
  $('#appCapsule').empty()
  $('#appCapsule').html(`
    <div class="section mt-2" style="text-align: center;">
    <div class="spinner-border text-dark" role="status"></div>
    </div>`)

  $('#appCapsule').html(`
    <div class="section mt-2">
      <div class="section-title">Request Money</div>
      <div class="card">
        <div class="card-body">
          <form id="verify">
            <div class="form-group basic">
              <div class="input-wrapper">
                <label class="label" for="userid1">User email</label>
                <input type="email" class="form-control email" id="email" placeholder="Enter email Address" required>
                <i class="clear-input">
                  <ion-icon name="close-circle" role="img" class="md hydrated" aria-label="close circle"></ion-icon>
                </i>
              </div>
            </div>

            <div class="form-group basic">
              <div class="input-wrapper">
                <label class="label" for="amount1">Amount</label>
                <input type="number" class="form-control amount" id="amount" placeholder="Enter an Amount" required>
                <i class="clear-input">
                  <ion-icon name="close-circle" role="img" class="md hydrated" aria-label="close circle"></ion-icon>
                </i>
              </div>
            </div>

            <div class="form-group basic">
                <label class="label">Description</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1"><ion-icon name="newspaper-outline"></ion-icon></span>
                    <input type="hidden" class="form-control amountt" value="" name="amount">
                    <input type="hidden" class="form-control emaill" name="email" value="">
                    <textarea class="form-control" placeholder="Transaction Description" value="" name="description"></textarea>
                    <!-- <textarea name="name" rows="8" cols="80"></textarea> -->
                </div>
            </div>

            <div class="form-group basic animated">
              <div class="input-wrapper">
                <button type="submit" class="btn btn-primary btn-block" onclick="ms(${$('.email').val()}, ${$('.amount').val()})">CONTINUE</button>
              </div>
            </div>
          </form>

        </div>
      </div>
    </div>
        `)
      }
function ms(email, amount) {
  email = $('.email').val();
  amount = $('.amount').val();
  window.history.pushState({page: 1}, name, '?sentTo='+email+'&amount='+amount);
  validate(amount)
  return false;
}

$(window).on('popstate', function(e) {
  e.preventDefault();
  dataChange();
  return false;
});

$('#payload').submit(function(e) {
  e.preventDefault();

  var formData = new FormData($(this)[0]);
  $thiss = $(this).find("[type=submit]");
  $thiss.text("please wait...");
  $thiss.addClass("disabled");

  $.ajax({
      url: '<?=$siteurl?>trans/request-money',
      type: 'POST',
      data: formData,
      dataType: "json",
      cache: false,
      contentType: false,
      processData: false,
      success : function(data){
        data = JSON.parse(data);
          // console.log(data);
          if (data.status == true){
            $("#succ-modal").html(data.message);
            // $("#succ").click();
            toastbox('toast-11');
            $thiss.text("SEND");
            $thiss.removeClass("disabled");
            $('#payload')[0].reset()
          } else {
              $thiss.text("SEND");
              $thiss.removeClass("disabled");
              $("#failed-modal").html(data.message);
              toastbox('toast-90');
              // $("#dang").click();
          }
      }
  }).fail(function (jqXHR, textStatus, error) {
      // Handle error here
      console.log(jqXHR, textStatus, error);
      $thiss.text("SEND");
      $thiss.removeClass("disabled");
      $("#failed-modal").html(jqXHR.responseText);
      toastbox('toast-90');
      // console.log(jqXHR.responseText);
  });
})
  </script>


<body class="bg-white">
    <!-- App Header -->
    <div class="appHeader">
        <div class="left">
            <a href="#" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">
            <?= $page ?>
        </div>
    </div>
    <!-- * App Header -->

    <!-- App Capsule -->
    <div id="appCapsule" class="full-height">
      <?php if (!isset($_GET['bank']) && !isset($_GET['account'])){
        include 'layout/app-404.phtml';
        die();
        }

        $account = $_GET['account'];
        $bank = $_GET['bank'];
        $trans = $app->resolve_account($account, $bank);

        if ($trans->status !== true) {
          ?>
          <div class="listed-detail mt-3">
              <h3 class="text-center mt-2"><?= ucwords($trans->message); ?></h3>
          </div>

          <?php
        }else {
        //
          // print_r($trans);
          ?>
        <div class="section mt-2 mb-2">


            <div class="listed-detail mt-3">
                <div class="icon-wrapper">
                    <div class="iconbox">
                        <ion-icon name="wallet-outline"></ion-icon>

                        <!-- <ion-icon name="arrow-forward-outline"></ion-icon> -->
                    </div>
                </div>
                <h3 class="text-center mt-2">Verify Transaction</h3>
            </div>

            <ul class="listview flush transparent simple-listview no-space mt-3">
                <li>
                    <strong>Account Name: </strong>
                    <span><?= ucwords($trans->data->account_name); ?></span>
                </li>
                <li>
                    <strong>Account No:</strong>
                    <span><?= ucwords($trans->data->account_number); ?></span>
                </li>
                <li>
                    <strong>Bank Name:</strong>
                    <span>
                      <?php
                      $bnk_name = '';
                       foreach ($app->banks()['data'] as $banks) {
                         if ($banks['code'] === $_GET['bank']) $bnk_name = $banks['name'];
                      } ?>

                      <?= $bnk_name; ?></span>
                </li>
                <!-- <li>
                    <strong>Txn Desc.: </strong>
                    <span><?= $trans->data->text; ?></span>
                </li>
                <li>
                    <strong>Date</strong>
                    <span><?= date_format(date_create($trans->data->date), "M d, Y g:i:s A"); ?></span>
                </li> -->
                <li>
                  <?php $get_amount = $_GET['amount'];
                  $get_amount = (($get_amount >= 10000)? ($settings->withdrawal_fee + 5): $settings->withdrawal_fee);
                   ?>
                    <strong>Amount:</strong>
                    <h3 class="m-0"><?= $coin. ' '.number_format($_GET['amount'], 2); ?></h3>
                </li>
                <li>
                    <strong>Txn Note: </strong>
                    <span><?= $_GET['note']; ?></span>
                </li>
                <li>
                    <strong>Fees:</strong>
                    <span><?= $coin. ' '.number_format($get_amount, 2); ?></span>
                </li>

                <li>
                    <strong>Total:</strong>
                    <span><?= $coin. ' '.number_format(($get_amount) + $_GET['amount'], 2); ?></span>
                </li>
            </ul>
        </div>

          <div class="section mt-2">
              <div class="card">
                  <div class="card-body">
                      <div class="mt-1"></div>
                      <button type="button" class="btn btn-primary btn-lg btn-block" data-bs-toggle="modal" data-bs-target="#actionSheetForm">CONTINUE</button>
                      <div class="mt-1"></div>
                      <div class="mt-1"></div>
                      <div class="mt-1"></div>
                      <div class="mt-1"></div>
                  </div>
              </div>
          </div>

        <!-- Form Action Sheet -->
        <div class="modal fade action-sheet" id="actionSheetForm" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?= $page ?></h5>
                    </div>
                    <div class="modal-body">
                        <div class="action-sheet-content">
                            <form id="payload">
                              <!-- <div class="yesser" style="display: none;"> -->
                                <div class="form-group basic">
                                    <label class="label">Transaction Pin</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><ion-icon name="lock-closed-outline"></ion-icon></span>
                                        <input type="password" maxlength="4" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\.*?)\..*/g, '$1');" class="form-control" placeholder="Enter Your Transaction Pin" name="pin">
                                        <input type="hidden" class="form-control amountt" value="<?= $_GET['account'] ?>" name="account_no">
                                        <input type="hidden" class="form-control amountt" value="<?= $_GET['amount'] ?>" name="amount">
                                        <input type="hidden" class="form-control amountt" value="<?= $_GET['bank'] ?>" name="bank">
                                        <input type="hidden" class="form-control amountt" value="<?= $_GET['note'] ?>" name="description">
                                    </div>
                                </div>

                                <div class="form-group basic">
                                    <button type="submit" class="btn btn-primary btn-block">WITHDRAW</button>
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
            <button type="button" class="btn btn-sm btn-text-light close-button close">OK</button>
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
        $(".close").click(function () {
          window.location.href = '/account'
        })
        $('#payload').submit(function(e) {
          e.preventDefault();

          var formData = new FormData($(this)[0]);
          $thiss = $(this).find("[type=submit]");
          $thiss.text("please wait...");
          $thiss.addClass("disabled");

          $.ajax({
              url: '<?=$siteurl?>trans/withdraw-money',
              type: 'POST',
              data: formData,
              dataType: "json",
              cache: false,
              contentType: false,
              processData: false,
              success : function(data){
                // data = JSON.parse(data);
                  // console.log(data);
                  if (data.status == true){
                    $("#succ-modal").html(data.message);
                    // $("#succ").click();
                    toastbox('toast-11');
                    $thiss.text("WITHDRAW");
                    $thiss.removeClass("disabled");
                    $('#payload')[0].reset()
                  } else {
                      $thiss.text("WITHDRAW");
                      $thiss.removeClass("disabled");
                      $("#failed-modal").html(data.message);
                      toastbox('toast-90');
                      // $("#dang").click();
                  }
              }
          }).fail(function (jqXHR, textStatus, error) {
              // Handle error here
              console.log(jqXHR, textStatus, error);
              $thiss.text("WITHDRAW");
              $thiss.removeClass("disabled");
              $("#failed-modal").html(jqXHR.responseText);
              toastbox('toast-90');
              // console.log(jqXHR.responseText);
          });
        })

        </script>
        <?php
          // code...
        } ?>
    </div>
    <!-- * App Capsule -->

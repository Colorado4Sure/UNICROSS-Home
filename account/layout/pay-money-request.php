
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
        <!-- <div class="right">
            <a href="#" class="headerButton" data-bs-toggle="modal" data-bs-target="#DialogBasic">
                <ion-icon name="trash-outline"></ion-icon>
            </a>
        </div> -->
    </div>
    <!-- * App Header -->

    <!-- Dialog Basic -->
    <!-- <div class="modal fade dialogbox" id="DialogBasic" data-bs-backdrop="static" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete</h5>
                </div>
                <div class="modal-body">
                    Are you sure?
                </div>
                <div class="modal-footer">
                    <div class="btn-inline">
                        <a href="#" class="btn btn-text-secondary" data-bs-dismiss="modal">CANCEL</a>
                        <a href="#" class="btn btn-text-primary" data-bs-dismiss="modal">DELETE</a>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- * Dialog Basic -->

    <!-- App Capsule -->
    <div id="appCapsule" class="full-height">
      <?php if (!isset($_GET['trans_id'])){
        include 'layout/app-404.phtml';
        die();
        }

        $trans_id = $_GET['trans_id'];
        $trans = $app->txn_history($trans_id);

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
                      <?php if ($trans->data->type === 'credit'): ?>
                        <ion-icon name="arrow-down-outline"></ion-icon>
                      <?php
                      else: ?>
                        <ion-icon name="arrow-forward-outline"></ion-icon>
                      <?php
                      endif; ?>
                    </div>
                </div>
                <h3 class="text-center mt-2"><?= ucwords($trans->data->title); ?></h3>
            </div>

            <ul class="listview flush transparent simple-listview no-space mt-3">
                <li>
                    <strong>Status</strong>
                    <?= ($trans->data->status == 'success')? '<span class="text-success">'.$trans->data->status.'</span>' : (($trans->data->status == 'pending')? '<span class="text-warning">'.$trans->data->status.'</span>' : '<span class="text-danger">'.$trans->data->status.'</span>') ?>
                </li>
                <li>
                    <strong>Payment Method</strong>
                    <span><?= ucwords($trans->data->method); ?></span>
                </li>
                <li>
                    <strong>Transaction Type</strong>
                    <span><?= ucwords($trans->data->type); ?></span>
                </li>
                <li>
                    <strong>Txn ID:</strong>
                    <span><?= $trans->data->trans_id; ?></span>
                </li>
                <li>
                    <strong>Txn Desc.: </strong>
                    <span><?= $trans->data->text; ?></span>
                </li>
                <li>
                    <strong>Date</strong>
                    <span><?= date_format(date_create($trans->data->date), "M d, Y g:i:s A"); ?></span>
                </li>
                <li>
                    <strong>Amount</strong>
                    <h3 class="m-0"><?= $coin. ' '.number_format($trans->data->amount, 2); ?></h3>
                </li>
                <li>
                    <strong>Balance</strong>
                    <span><?= $coin. ' '.number_format($trans->data->balance, 2); ?></span>
                </li>
                <li>
                    <strong>Details: </strong>
                    <span><?= $trans->data->description; ?></span>
                </li>
            </ul>
        </div>
        <?php if ($trans->data->status !== 'success'): ?>
          <div class="section mt-2">
              <div class="card">
                  <div class="card-body">
                      <div class="mt-1"></div>
                      <button type="button" class="btn btn-primary btn-lg btn-block" data-bs-toggle="modal" data-bs-target="#actionSheetForm">PAY NOW</button>
                      <div class="mt-1"></div>
                      <div class="mt-1"></div>
                      <div class="mt-1"></div>
                      <div class="mt-1"></div>
                  </div>
              </div>
          </div>

        <?php endif; ?>

        <!-- Form Action Sheet -->
        <div class="modal fade action-sheet" id="actionSheetForm" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Send Money</h5>
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
                                        <input type="hidden" class="form-control amountt" value="<?= $trans_id ?>" name="trans_id">
                                    </div>
                                </div>

                                <div class="form-group basic">
                                    <button type="submit" class="btn btn-primary btn-block">Pay</button>
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
        $('#payload').submit(function(e) {
          e.preventDefault();

          var formData = new FormData($(this)[0]);
          $thiss = $(this).find("[type=submit]");
          $thiss.text("please wait...");
          $thiss.addClass("disabled");

          $.ajax({
              url: '<?=$siteurl?>trans/pay-money',
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
        <?php
          // code...
        } ?>
    </div>
    <!-- * App Capsule -->

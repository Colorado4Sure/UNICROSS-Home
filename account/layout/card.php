<?php if (!isset($_GET['card_hash'])){
  include 'layout/app-404.phtml';
  die();
  }

  $card_id = $_GET['card_hash'];
  $card = $app->cards($card_id); ?>
<body class="bg-white">
    <!-- App Header -->
    <div class="appHeader">
        <div class="left">
            <a href="#" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">
            <?= $page; ?>
        </div>
        <?php if ($card->status == true) {
          ?>
          <div class="right">
              <a href="#" class="headerButton" data-bs-toggle="modal" data-bs-target="#DialogBasic">
                  <ion-icon name="trash-outline"></ion-icon>
              </a>
          </div>
          <?php
        } ?>
    </div>
    <!-- * App Header -->

    <!-- Dialog Basic -->
    <div class="modal fade dialogbox" id="DialogBasic" data-bs-backdrop="static" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Terminate</h5>
                </div>
                <div class="modal-body">
                    Are you sure?
                </div>
                <div class="modal-footer">
                    <div class="btn-inline">
                        <a href="#" class="btn btn-text-secondary" data-bs-dismiss="modal">CANCEL</a>
                        <a href="#" class="btn btn-text-primary" onclick="terminate_card('<?= $card_id ?>')">DELETE</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- * Dialog Basic -->

    <!-- App Capsule -->
    <div id="appCapsule" class="full-height">
      <?php

        if ($card->status !== true) {
          ?>
          <div class="listed-detail mt-3">
              <h3 class="text-center mt-2"><?= ucwords($card->message); ?></h3>
          </div>

          <?php
        }else {
          ?>
        <div class="section mt-2 mb-2">

            <div class="listed-detail mt-3">
                <div class="icon-wrapper">
                    <div class="iconbox">
                      <ion-icon name="card-outline" role="img" class="md hydrated" aria-label="calendar outline"></ion-icon>
                </div>
                <h3 class="text-center mt-2">$<?= number_format($card->data->amount, 2); ?></h3>
            </div>

            <ul class="listview flush transparent simple-listview no-space mt-3">
              <li>
                  <strong>Status</strong>
                  <?= ($card->data->is_active == true)? '<span class="text-success">Active</span>' : '<span class="text-danger">Inactive</span>' ?>
              </li>
                <li>
                    <strong>Name On Card</strong>
                    <span><?= ucwords($card->data->name_on_card); ?></span>
                </li>
                <li>
                    <strong>Card Number</strong>
                    <span><?= $card->data->card_pan; ?></span>
                </li>
                <li>
                    <strong>Expiry Date:</strong>
                    <span><?= $card->data->expiration; ?></span>
                </li>
                <li>
                    <strong>CVV: </strong>
                    <span><?= $card->data->cvv; ?></span>
                </li>
                <li>
                    <strong>Billing Address</strong>
                    <span><?= $card->data->address_1 ?></span>
                </li>
                <li>
                    <strong>Zip Code</strong>
                    <span><?= $card->data->zip_code ?></span>
                </li>
                <li>
                    <strong>City</strong>
                    <h3 class="m-0"><?= $card->data->city ?></h3>
                </li>
                <li>
                    <strong>State</strong>
                    <h3 class="m-0"><?= $card->data->state ?></h3>
                </li>
                <li>
                    <strong>Balance</strong>
                    <span>$<?=number_format($card->data->amount, 2); ?></span>
                </li>
            </ul>

        </div>
        <?php
          // code...
        } ?>
    </div>
    <!-- * App Capsule -->

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

function terminate_card(id) {
    $.ajax({
        url: '<?=$siteurl?>trans/delete-card',
        type: 'POST',
        data: {
          card_id: id
        },
        // dataType: "json",
        // cache: false,
        // contentType: false,
        // processData: false,
        success : function(data){
          data = JSON.parse(data);
            // console.log(data);
            if (data.status == true){
              $("#succ-modal").html(data.message);
              // $("#succ").click();
              toastbox('toast-11');
              setTimeout(function () {
                window.location.href = '/account/cards'
              }, 2000)
            } else {
                $("#failed-modal").html(data.message);
                toastbox('toast-90');
            }
        }
    }).fail(function (jqXHR, textStatus, error) {
        // Handle error here
        console.log(jqXHR, textStatus, error);
        $("#failed-modal").html(jqXHR.responseText);
        toastbox('toast-90');
        // console.log(jqXHR.responseText);
    });
}

</script>

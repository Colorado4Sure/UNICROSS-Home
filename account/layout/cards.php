<!-- App Header -->
<div class="appHeader">
    <div class="left">
        <a href="#" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">
        <?=$page ?>
    </div>
    <div class="right">
        <a href="#" class="headerButton" data-bs-toggle="modal" data-bs-target="#addCardActionSheet">
            <ion-icon name="add-outline"></ion-icon>
        </a>
    </div>
</div>
<!-- * App Header -->

<!-- Add Card Action Sheet -->
<div class="modal fade action-sheet" id="addCardActionSheet" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add a Card</h5>
            </div>
            <div class="modal-body">
                <div class="action-sheet-content">
                    <form id="payload">
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="cardnumber1">Amount to Fund ($)</label>
                                <input type="number" name="amount" id="cardnumber1" class="form-control"
                                    placeholder="Amount to Fund Card With">
                            </div>
                        </div>

                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="name">Name On Card</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="Name on card">
                            </div>
                        </div>

                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="address">Address</label>
                                <input type="text" name="address" id="address" class="form-control"
                                    placeholder="Address">
                            </div>
                        </div>

                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="city">City</label>
                                <input type="text" name="city" id="city" class="form-control"
                                    placeholder="city">
                            </div>
                        </div>

                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="state">State</label>
                                <input type="text" name="state" id="state" class="form-control"
                                    placeholder="State">
                            </div>
                        </div>

                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="postal_code">postal_code</label>
                                <input type="text" name="postal_code" id="postal_code" class="form-control"
                                    placeholder="postal_code">
                            </div>
                        </div>

                        <div class="form-group basic mt-2">
                            <button type="submit" class="btn btn-primary btn-block btn-lg">Create Card</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- * Add Card Action Sheet -->

<!-- App Capsule -->
<div id="appCapsule">

    <div class="section mt-2">
      <?php foreach ($app->cards('')->data->rows as $card): ?>
        <!-- card block -->
        <div class="card-block mb-2">
            <div class="card-main">
                <div class="card-button dropdown">
                    <button type="button" class="btn btn-link btn-icon" data-bs-toggle="dropdown">
                        <ion-icon name="ellipsis-horizontal"></ion-icon>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="card?card_hash=<?=$card->card_id ?>">
                            <ion-icon name="pencil-outline"></ion-icon>View
                        </a>

                        <a class="dropdown-item" href="#" onclick="fund_card('<?= $card->card_id ?>')">
                            <ion-icon name="close-outline"></ion-icon>Fund
                        </a>

                        <a class="dropdown-item" href="#" onclick="withdraw_from_card('<?= $card->card_id ?>')">
                            <ion-icon name="close-outline"></ion-icon>Withdraw
                        </a>

                        <a class="dropdown-item" href="#" onclick="freeze_card('<?= $card->card_id ?>', '<?= ($card->status)? 'block': 'unblock' ?>')">
                            <ion-icon name="close-outline"></ion-icon>Freeze
                        </a>
                        <a class="dropdown-item" href="#" onclick="terminate_card('<?= $card->card_id ?>')">
                            <ion-icon name="arrow-up-circle-outline"></ion-icon>Delete
                        </a>
                    </div>
                </div>
                <div class="balance">
                    <span class="label">BALANCE</span>
                    <h1 class="title">$ ••••</h1>
                </div>
                <div class="in">
                    <div class="card-number">
                        <span class="label">Card Number</span>
                        <?=$card->card_hash ?>
                    </div>
                    <div class="bottom">
                        <div class="card-expiry">
                            <span class="label">Expiry</span>
                            <?=$card->date ?>
                        </div>
                        <div class="card-ccv">
                            <span class="label">CCV</span>
                            <?=$card->cvv ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- * card block -->

      <?php endforeach; ?>
    </div>


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
$('#payload').submit(function(e) {
  e.preventDefault();

  var formData = new FormData($(this)[0]);
  $thiss = $(this).find("[type=submit]");
  $thiss.text("please wait...");
  $thiss.addClass("disabled");

  $.ajax({
      url: '<?=$siteurl?>trans/create-card',
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
            $thiss.text("Create Card");
            $thiss.removeClass("disabled");
            $('#payload')[0].reset()

            setTimeout(function () {
              location.reload();
            }, 1000)

          } else {
              $thiss.text("Create Card");
              $thiss.removeClass("disabled");
              $("#failed-modal").html(data.message);
              toastbox('toast-90');
          }
      }
  }).fail(function (jqXHR, textStatus, error) {
      // Handle error here
      console.log(jqXHR, textStatus, error);
      $thiss.text("Create Card");
      $thiss.removeClass("disabled");
      $("#failed-modal").html(jqXHR.responseText);
      toastbox('toast-90');
      // console.log(jqXHR.responseText);
  });
})


function terminate_card(id) {
  if (!confirm("Are you sure you want to delete this card?")) return false

    $.ajax({
        url: '<?=$siteurl?>trans/delete-card',
        type: 'POST',
        data: {
          card_id: id
        },
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


function freeze_card(id, status) {
  if (!confirm(`Are you sure you want to ${status} this card?`)) return false

    $.ajax({
        url: '<?=$siteurl?>trans/freeze-card',
        type: 'POST',
        data: {
          card_id: id,
          status: status,
        },
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


function fund_card(id) {
  let amount = prompt("Please enter amount to fund ($)", 5.5);

  if (amount == 0 || amount < 5.5) alert('amount must be greater than $5.5')
  // if (!confirm(`Are you sure you want to ${status} this card?`)) return false

    $.ajax({
        url: '<?=$siteurl?>trans/fund-card',
        type: 'POST',
        data: {
          card_id: id,
          amount: amount,
        },
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

function withdraw_from_card(id) {
  let amount = prompt("Please enter amount to withdraw ($)", 2.5);

  if (amount == 0) alert('amount must be greater than $2.5')
  // if (!confirm(`Are you sure you want to ${status} this card?`)) return false

    $.ajax({
        url: '<?=$siteurl?>trans/withdraw-from-card',
        type: 'POST',
        data: {
          card_id: id,
          amount: amount,
        },
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

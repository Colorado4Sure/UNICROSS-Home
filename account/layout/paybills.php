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
  <div class="section tab-content mt-2 mb-1">
    <!-- waiting tab -->
    <div class="tab-pane fade show active" id="waiting" role="tabpanel">
      <div class="row" id="bills">
        <?php if (isset($_GET['service'])) :
          $services = $app->services('', $_GET['service'])->data; ?>
          <div class="carousel-small splide splide--loop splide--ltr splide--draggable is-active" id="splide04" style="visibility: visible;">
            <div class="splide__track" id="splide04-track" style="padding-left: 16px; padding-right: 16px;">
              <ul class="splide__list" id="splide04-list" style="transform: translateX(-778px);">
                <?php
                $ntwk_img = '';
                foreach ($services as $service) : ?>
                  <li class="splide__slide" id="<?= $service->id; ?>" aria-hidden="false" tabindex="0" style="margin-right: 16px; width: 86.25px;">
                    <a onclick="ms('<?= $service->id ?>', '<?= $service->description; ?>', '<?= $_GET['service']; ?>', '<?= $service->image ?>')">
                      <div class="user-card">
                        <img src="<?= $service->image ?> " style="    height: 48px; width: 48px; max-width: 48px;" alt="<?= $service->name ?>" class="imaged w-100">
                        <strong><?= $service->name ?></strong>

                      </div>
                    </a>
                  </li>
                <?php endforeach; ?>

              </ul>
            </div>
          </div>
          <div class="row" id="main_bill" style="margin-top: 20px;"></div>
          <?php if ($_GET['service'] === 'electricity' || $_GET['service'] === 'betting') : ?>
            <div class="row payBills" id="main_bills" style="margin-top: 20px; display: none;">
              <div class="card">
                <div class="card-body">
                  <div class="section-title">
                    Pay for <span class="billHead">${title}</dspan>
                  </div>
                  <form class="payBill" method="POST" id="payBill2" autocomplete="off">
                    <div class="form-group basic animated">
                      <div class="input-wrapper">
                        <label class="label" for="userid2">User ID</label>
                        <input type="text" name="customer_id" class="form-control customer_id userid2" oninput="client_details()" id="userid2" placeholder="" value="">

                        <input type="hidden" name="product_id" class="form-control product_id" id="product_id" value="">

                        <input type="hidden" name="service" class="form-control service" id="service" value="">
                        <i class="clear-input">
                          <ion-icon name="close-circle" role="img" class="md hydrated" aria-label="close circle"></ion-icon>
                        </i>
                      </div>
                    </div>

                    <div class="form-group basic animated client" style="display:none">
                      <div class="input-wrapper">
                        <input type="text" class="form-control cname" disabled>
                        <i class="clear-input">
                          <ion-icon name="close-circle" role="img" class="md hydrated" aria-label="close circle"></ion-icon>
                        </i>
                      </div>
                    </div>

                    <div class="form-group basic animated meterType" style="display: none;">
                      <div class="input-wrapper">
                        <label class="label" for="meterType">Meter Type</label>
                        <select class="form-control custom-select meterType" name="type" id="meterType" onchange="client_details()">
                          <option value="prepaid" selected>Prepaid</option>
                          <option value="postpaid">PostPaid</option>
                        </select>
                        <i class="clear-input">
                          <ion-icon name="close-circle" role="img" class="md hydrated" aria-label="close circle"></ion-icon>
                        </i>
                      </div>
                    </div>

                    <div class="form-group basic animated">
                      <div class="input-wrapper">
                        <label class="label" for="amount2">Amount</label>
                        <input type="number" name="amount" class="form-control amount2" id="amount2" placeholder="${amount}">
                        <i class="clear-input">
                          <ion-icon name="close-circle" role="img" class="md hydrated" aria-label="close circle"></ion-icon>
                        </i>
                      </div>
                    </div>

                    <div class="form-group basic animated">
                      <div class="input-wrapper">
                        <label class="label" for="text4">Transaction Pin</label>
                        <input type="password" name="pin" maxlength="4" class="form-control" id="text4" placeholder="transaction pin">
                        <i class="clear-input">
                          <ion-icon name="close-circle" role="img" class="md hydrated" aria-label="close circle"></ion-icon>
                        </i>
                      </div>
                    </div>

                    <div class="form-group basic animated">
                      <div class="input-wrapper">
                        <button type="submit" disabled class="btn btn-primary btn-block btn-lg">CONTINUE</button>
                      </div>
                    </div>

                </div>
              </div>
            </div>
          <?php endif; ?>
        <?php else : ?>
          <?php foreach ($app->services('')->data as $bills) : ?>
            <div class="col-6 mb-2">
              <div class="bill-box">
                <div class="img-wrapper">
                  <img src="<?= $bills->image_url; ?>" alt="img" class="image-block imaged w48" style="height: 48px;">
                </div>
                <div class="price" style="height: 50px;"><?= $bills->name; ?></div>
                <p><?= $bills->description; ?></p>
                <a href="?service=<?= $bills->id ?>" id="<?= $bills->id ?>" data-name="<?= $bills->description; ?>" class="btn btn-primary btn-block btn-sm ms">PAY NOW</a>
              </div>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </div>
    <!-- * waiting tab -->
  </div>
</div>

<!-- Form Action Sheet -->
<?php if (isset($_GET['service'])) :

  if ($_GET['service'] === 'cable' || $_GET['service'] === 'internet') : ?>
    <div class="modal fade dialogbox" id="actionSheetForm" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">PAY <?= strtoupper($_GET['service']) ?> BILL</h5>
          </div>
          <form class="payBill" id="payBill1" autocomplete="off">
            <div class="modal-body text-start mb-2">

              <div class="form-group basic">
                <div class="input-wrapper">
                  <label class="label" for="account1">SELECT PLAN</label>
                  <select class="form-control custom-select" name="plan" id="BillVariation">
                    <option>Loading...</option>
                  </select>
                  <input type="hidden" name="network" class="form-control" id="text11">
                </div>
                <!-- <div class="input-info amount">(NGN)</div> -->
              </div>

              <div class="form-group basic">
                <div class="input-wrapper">
                  <label class="label" for="userid2s">IUC Number</label>
                  <input type="text" name="customer_id" oninput="client_details()" oninput="this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control userid2" id="userid2s" placeholder="1234567890">
                  <input type="hidden" name="product_id" class="form-control product_id" id="product_id" value="">
                  <input type="hidden" name="variation" class="form-control variation" id="variation" value="">
                  <input type="hidden" name="service" class="form-control service" id="service" value="">
                  <input type="hidden" name="type" class="form-control type" id="type" value="change">
                  <input type="hidden" name="amount" class="form-control amount" id="amount" value="">
                  <i class="clear-input">
                    <ion-icon name="close-circle"></ion-icon>
                  </i>
                </div>
              </div>

              <div class="form-group basic animated client" style="display:none;">
                <div class="input-wrapper">
                  <input type="text" class="form-control cname" disabled>
                  <i class="clear-input">
                    <ion-icon name="close-circle" role="img" class="md hydrated" aria-label="close circle"></ion-icon>
                  </i>
                </div>
              </div>

              <div class="form-group basic">
                <div class="input-wrapper">
                  <label class="label" for="text4">Transaction Pin</label>
                  <input type="password" name="pin" maxlength="4" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control" id="text4" placeholder="transaction pin">
                  <i class="clear-input">
                    <ion-icon name="close-circle"></ion-icon>
                  </i>
                </div>
              </div>

            </div>
            <div class="modal-footer">
              <div class="btn-inline">
                <button type="button" class="btn btn-text-secondary" data-bs-dismiss="modal">CANCEL</button>
                <button type="submit" disabled class="btn btn-text-primary btn-lg">BUY</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
<?php
  endif;
endif; ?>
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
  let getM = '<?= (isset($_GET['service'])) ? $_GET['service'] : '' ?>'

  //check for cable plan from selected variation
  function variation(service = '', id = '', variation = '', amount = '') {
    $('.product_id').val(id)
    $('.variation').val(variation)
    $('.service').val(getM)
    $('.amount').val(parseFloat(amount))

    if (service !== '') service = `?service=${service}&`;
    if (id !== '') id = `id=${id}&`;
    if (variation !== '') variation = `variation=${variation}`;

    var settings = {
      "url": `<?= $app->site_url ?>all-bills${service}${id}${variation}`,
      "method": "GET",
      "timeout": 0,
      beforeSend: () => {
        $('#BillVariation').empty();
        $('#BillVariation').append(`<option>loading...</option>`)
      }
    };

    $.ajax(settings).done((response) => {
      $('#BillVariation').empty();

      response.data.options.forEach((data) =>
        $('#BillVariation').append(`<option value="${data.months}">${data.name} (<?= $coin ?>${data.price})</option>`))

    })

  }

  //Track all user changes/navigation
  let dataChange = (id = '', service = getM, image = '') => {
    let rawId = id;
    if (service !== '') service = `?service=${service}&`;
    if (id !== '') id = `id=${id}&`;

    var settings = {
      "url": "<?= $app->site_url ?>all-bills" + service + id,
      "method": "GET",
      "timeout": 0,
      beforeSend: function() {
        $('#main_bill').empty();
        $(".payBills").css('display', 'none')
        // $('form').trigger('reset')
        $('#main_bill').html(`
              <div class="section mt-2" style="text-align: center;">
              <div class="spinner-border text-dark" role="status"></div>
              </div>`)
      }
    };

    $.ajax(settings).done(function(response) {
      if (response.status === true) {
        if (response.data?.variations.length <= 0) {
          $('#main_bill').empty();
          let placeholder = getM === 'betting' ? 'Customer ID' : (getM === 'internet' ? 'SmartCard Number' : (getM === 'electricity' ? 'Meter Number' : ''))

          $('#main_bills').css('display', 'block')
          $('.billHead').text(response.data.product_name)
          $('.service').val(getM)
          $('.customer_id').attr('placeholder', placeholder)
          $('.product_id').val(response.data.product_id)
          if (getM === 'electricity') $('.meterType').css('display', 'block')

          $('.amount2').val(response.data.min_amount)
          $('.amount2').attr('placeholder', placeholder)

        } else {
          // console.table(response.data.variations);
          $('#main_bill').empty();
          $(response.data?.variations).each((req, res) => {
            $('#main_bill').append(`<div class="col-6 mb-2">
                  <div class="bill-box">
                    <div class="img-wrapper">
                    <img src="${image}" alt="img" class="image-block imaged w48" style="height: 48px;">
                    </div>
                    <div class="price" style="height: 50px;"><?= $coin ?>${res.surface_amount}</div>
                    <p>${res.v_name}</p>
                    <a onclick="variation('${getM}', '${rawId}', '${res.v_code}', '${res.surface_amount}')" data-bs-toggle="modal" data-bs-target="#actionSheetForm" class="btn btn-primary btn-block btn-sm ms" data-name="${res.description}" id="${res.v_code}">PAY NOW</a>
                  </div>
                  </div>`)
          })
        }
      } else {
        $("#failed-modal").html(response.message);
        toastbox('toast-90');
      }
    });
  }

  let ms = (id, name, service = getM, image = '') => {
    window.history.pushState({
      page: 1
    }, name, '?service=' + service);
    dataChange(id, service, image)
    return false;
  }

  //validate user details
  let client_details = () => {
    let thiss = $(".userid2").val();

    let maxL = (getM === 'cable') ? 10 : 7;

    if (thiss.length >= maxL) {
      $(".btn-lg").attr('disabled', true)
      $('.client').css('display', 'block')

      $('.client').empty();
      $('.client').html(`
        <div class="section mt-2" style="text-align: center;">
        <div class="spinner-border text-dark" role="status"></div>
        </div>
      `)

      let meterType = $('#meterType').val();

      $.ajax({
        url: '<?= $siteurl ?>trans/verify-bill',
        type: 'POST',
        data: {
          get: $('#get').val(),
          customer_id: $(".userid2").val(),
          service: getM,
          bill_id: $('.product_id').val(),
          bill_type: meterType
        },
        dataType: "json",
        success: function(data) {
          data = JSON.parse(data);

          if (data.status === true) {
            $(".btn-lg").attr('disabled', false)
            $('.client').css('display', 'block')
            $('.cname').val(data.data.customer_name)

            $('.client').html(`
            <div class="input-wrapper">
                <input type="text" class="form-control cname" value="${data.data.customer_name}" disabled>
                <i class="clear-input">
                    <ion-icon name="close-circle" role="img" class="md hydrated" aria-label="close circle"></ion-icon>
                </i>
            </div>`)
          } else {
            $("#failed-modal").html(data.message);
            toastbox('toast-90');
            // alert(data.message)
            $('.client').css('display', 'none')
          }
        }
      }).fail(function(jqXHR, textStatus, error) {
        // Handle error here
        $('.client').css('display', 'none')
        console.log(jqXHR, textStatus, error);
        $(".btn-lg").attr('disabled', false)
      });

    } else {
      $('.client').css('display', 'none')
    }
  }


  $('form').submit(function(e) {
    e.preventDefault();

    // var fata = $(this).attr('id')
    var formData = new FormData($(this)[0]);
    $thiss = $(this).find("[type=submit]");
    $thiss.text("please wait...");
    $thiss.addClass("disabled");

    $.ajax({
      url: '<?= $siteurl ?>trans/pay-bills',
      type: 'POST',
      data: formData,
      dataType: "json",
      cache: false,
      contentType: false,
      processData: false,
      success: function(data) {
        if (data.status === true) {
          $("#succ-modal").html(data.message);
          toastbox('toast-11');
          $thiss.text("PAY");
          $thiss.removeClass("disabled");
          $('form')[0].reset()
        } else {
          $thiss.text("PAY");
          $thiss.removeClass("disabled");
          $("#failed-modal").html(data.message);
          toastbox('toast-90');
        }
      }
    }).fail(function(jqXHR, textStatus, error) {
      // Handle error here
      console.log(jqXHR, textStatus, error);
      $thiss.text("PAY");
      $thiss.removeClass("disabled");
      $("#failed-modal").html(jqXHR.responseText);
      toastbox('toast-90');
      // console.log(jqXHR.responseText);
    });
  });

</script>
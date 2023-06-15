    <!-- App Header -->
    <div class="appHeader">
      <div class="left">
        <a href="#" class="headerButton goBack">
          <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
      </div>
      <div class="pageTitle">
        VTU Services
      </div>
    </div>
    <!-- * App Header -->

    <!-- Extra Header -->
    <?php $action = 'airtime'; if (isset($_GET['action']))  $action = $_GET['action']; ?>
    <div class="extraHeader pe-0 ps-0">
      <ul class="nav nav-tabs lined" role="tablist">
        <li class="nav-item">
          <a class="nav-link <?= $action == 'airtime' ? 'active' : '' ?>" data-bs-toggle="tab" href="#waiting" role="tab">
            Airtime
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= $action == 'data' ? 'active' : '' ?>" data-bs-toggle="tab" href="#paid" role="tab">
            Data
          </a>
        </li>
      </ul>
    </div>
    <!-- * Extra Header -->

    <!-- App Capsule -->
    <div id="appCapsule" class="extra-header-active full-height">

      <div class="section tab-content mt-2 mb-1">

        <!-- waiting tab -->
        <div class="tab-pane fade show <?= $action == 'airtime' ? 'active' : '' ?>" id="waiting" role="tabpanel">
          <div class="row">
            <?php
            $ntwk_img = '';
            foreach ($app->vtu()->data as $networks) :
              if (isset($_GET['network_id'])) {
                if ($_GET['network_id'] == $networks->id) {
                  $ntwk_img = $networks->image;
                }
              }
            ?>
              <div class="col-6 mb-2">
                <div class="bill-box">
                  <div class="img-wrapper">
                    <img src="<?= $networks->image; ?>" alt="img" class="image-block imaged w48">
                  </div>
                  <div class="price"><?= $networks->name; ?></div>
                  <a href="#" id="<?= $networks->id; ?>" data-bs-toggle="modal" data-bs-target="#actionSheetForms" class="btn btn-primary btn-block btn-sm rech">RECHARGE</a>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
        <!-- * waiting tab -->

        <!-- paid tab -->
        <div class="tab-pane fade show <?= $action == 'data' ? 'active' : '' ?>" id="paid" role="tabpanel">
          <div class="section mt-2" style="text-align: center;">
            <div class="card">
              <div class="card-body">

                <!-- Wallet Services -->
                <!-- <div class="section mt-4"> -->
                <div class="wallet-card" style="padding: 0px;">
                  <div class="section-heading padding">
                    <h3 class="title">Select Network</h3>
                  </div>
                  <!-- Wallet Footer -->
                  <div class="wallet-footer" style="border: none;">
                    <?php
                    $ntwk_img = '';
                    foreach ($app->vtu()->data as $networks) :
                      if (isset($_GET['network_id'])) {
                        if ($_GET['network_id'] == $networks->id) {
                          $ntwk_img = $networks->image;
                        }
                      }
                    ?>
                      <div class="item">
                        <a class="network" href="#" id="<?= $networks->id; ?>">
                          <div class="img-wrapper">
                            <img src="<?= $networks->image; ?>" alt="img" class="image-block imaged w48">
                            <!-- <ion-icon name="swap-vertical"></ion-icon> -->
                          </div>
                          <br>
                          <h4 class="price"><?= $networks->name ?></h4>
                        </a>
                      </div>
                    <?php endforeach; ?>
                  </div>
                  <!-- * Wallet Footer -->
                </div>
                <!-- </div> -->
                <!-- Wallet Services -->
              </div>
            </div>
          </div>
          <div class="section mt-2">
          </div>

          <div class="row" id="data-plans">
            <?php if (isset($_GET['network_id'])) : ?>
              <?php
              $network_id = $_GET['network_id'];
              foreach ($app->data_plans($network_id)->data as $networks) : ?>
                <div class="col-6 mb-2">
                  <div class="bill-box">
                    <div class="img-wrapper">
                      <img src="<?= $ntwk_img ?>" alt="img" class="image-block imaged w48">
                    </div>
                    <div class="price"><?= $coin . ' ' . number_format($networks->price, 2); ?></div>
                    <p><?= $networks->name; ?></p>
                    <a href="#" id="<?= $networks->name; ?>" data-bs-toggle="modal" data-bs-target="#actionSheetForm" id="<?= $networks->plan; ?>" class="btn btn-primary btn-block btn-sm" onclick="dataplan('<?= $networks->plan; ?>', '<?= $networks->network_name; ?>', '<?= $networks->name; ?>', '<?= $networks->price; ?>')">BUY</a>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php
            endif; ?>
          </div>

        </div>
        <!-- * paid tab -->
      </div>

    </div>

    <!-- Form Action Sheet -->
    <div class="modal fade dialogbox" id="actionSheetForm" tabindex="-1" role="dialog">

      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">BUY DATA</h5>
          </div>
          <form id="buyData">
            <div class="modal-body text-start mb-2">

              <div class="form-group basic">
                <div class="input-wrapper">
                  <label class="label" for="account1">SELECT PLAN</label>
                  <input type="text" class="form-control" id="text8" disabled>
                  <input type="hidden" name="plan" class="form-control" id="text9">
                  <input type="hidden" name="network" class="form-control" id="text11">
                </div>
                <div class="input-info amount">(NGN)</div>
              </div>

              <div class="form-group basic">
                <div class="input-wrapper">
                  <label class="label" for="text1">Enter Phone Number</label>
                  <input type="text" name="phoneNumber" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control" id="text10" placeholder="08012345678">
                  <i class="clear-input">
                    <ion-icon name="close-circle"></ion-icon>
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
                <button type="submit" class="btn btn-text-primary">BUY</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- * Form Action Sheet -->

    <!-- Form Action Sheet -->
    <div class="modal fade dialogbox" id="actionSheetForms" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">AIRTIME RECHARGE</h5>
          </div>
          <form id="buyAirtime">
            <div class="modal-body text-start mb-2">
              <div class="form-group basic">
                <div class="input-wrapper">
                  <label class="label" for="account1">Amount</label>
                  <input type="hidden" id="network" name="network" value="">
                  <input type="text" name="amount" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control" id="text2" placeholder="100">
                  <i class="clear-input">
                    <ion-icon name="close-circle"></ion-icon>
                  </i>
                </div>
              </div>

              <div class="form-group basic">
                <div class="input-wrapper">
                  <label class="label" for="text1">Enter Phone Number</label>
                  <input type="text" name="phoneNumber" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control" id="text3" placeholder="08012345678">
                  <i class="clear-input">
                    <ion-icon name="close-circle"></ion-icon>
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
                <button type="button" class="btn btn-text-secondary cancel" data-bs-dismiss="modal">CANCEL</button>
                <button type="submit" class="btn btn-text-primary">BUY</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Success Action Sheet -->
    <div id="toast-11" class="toast-box toast-center" style="z-index: 99999;">
      <div class="in">
        <ion-icon name="checkmark-circle" class="text-success md hydrated" role="img" aria-label="checkmark circle"></ion-icon>
        <div class="text" id="succ-modal">
          Success Message
        </div>
      </div>
      <button type="button" class="btn btn-sm btn-text-light close-button close">CLOSE</button>
    </div>

    <!-- Failed Action Sheet -->
    <div id="toast-90" class="toast-box toast-center" style="z-index: 99999;">
      <div class="in">
        <ion-icon name="close-circle" role="img" class="text-danger md hydrated" aria-label="close circle"></ion-icon>
        <div class="text" id="failed-modal">
          Failed Message
        </div>
      </div>
      <button type="button" class="btn btn-sm btn-text-light close-button">CLOSE</button>
    </div>

    <div id="toast-16" class="toast-box toast-bottom bg-danger" style="z-index: 99999;">
      <div class="in">
        <div class="text" id="dang-msg">
          Danger Message
        </div>
      </div>
      <button type="button" class="btn btn-sm btn-text-light close-button">OK</button>
    </div>

    <script>
      //////////////////////////////
      // Airtime Set Up here
      /////////////////////////////
      $('.rech').click(function() {
        $("#network").val($(this).attr('id'))
      })
      $(".close").click(function() {
        $(".cancel").click();
        location.reload()
      })

      $(".cancel").click(function() {
        $('#buyAirtime')[0].reset()
      })
      $('#buyAirtime').submit(function(e) {
        e.preventDefault();

        if ($("#text2").val() === '') {
          $("#dang-msg").html("Amount is required!");
          return toastbox('toast-16', 3000);
        }

        if ($("#text3").val() === '') {
          $("#dang-msg").html("Phone number is required! ");
          return toastbox('toast-16', 3000);
        }

        var formData = new FormData($(this)[0]);
        $thiss = $(this).find("[type=submit]");
        $thiss.text("please wait...");
        $thiss.addClass("disabled");

        $.ajax({
          url: '<?= $siteurl ?>trans/airtime',
          type: 'POST',
          data: formData,
          dataType: "json",
          cache: false,
          contentType: false,
          processData: false,
          success: function(data) {
            // console.log(data.data);
            if (data.status == true) {
              $("#succ-modal").html(data.message);
              // $("#succ").click();
              toastbox('toast-11');
              $thiss.text("BUY");
              $thiss.removeClass("disabled");
              $('#buyAirtime')[0].reset()
            } else {
              $thiss.text("BUY");
              $thiss.removeClass("disabled");
              $("#failed-modal").html(data.message);
              toastbox('toast-90');
              // $("#dang").click();
            }
          }
        }).fail(function(jqXHR, textStatus, error) {
          // Handle error here
          console.log(jqXHR.responseText);
        });
      })



      ////////////////////////////
      // Data Setup Here
      ///////////////////////////
      function dataChange(id) {
        let ntwk_img = '';
        var settings = {
          "url": "<?= $app->site_url ?>networks",
          "method": "GET",
          "timeout": 0,
        };

        $.ajax(settings).done(function(response) {
          if (response.status === true) {
            $(response.data).each(function(req, res) {
              if (res.id === id) {
                ntwk_img = res.image;
              }
            })
          }
          // console.log(response);
        });

        var settings = {
          "url": "<?= $app->site_url ?>data-plans?id=" + id,
          "method": "GET",
          "timeout": 0,
          beforeSend: function() {
            $('#data-plans').empty();
            $('#data-plans').html(`
                    <div class="section mt-2" style="text-align: center;">
                          <div class="spinner-border text-dark" role="status"></div>
                    </div>`)
          }
        };

        $.ajax(settings).done(function(response) {
          if (response.status === true) {
            if (response.data.length <= 0) {
              $('#data-plans').empty();
              $("#failed-modal").html('No data plan is available at the moment for the selected network, <br>Please try again later.');
              toastbox('toast-90');
            } else {
              $('#data-plans').empty();
              $(response.data).each(function(req, res) {
                $('#data-plans').append(`<div class="col-6 mb-2">
                          <div class="bill-box">
                              <div class="img-wrapper">
                                  <img src="${ntwk_img}" alt="img" class="image-block imaged w48">
                              </div>
                              <div class="price"><?= $coin ?> ${res.price}</div>
                              <p>${res.name}</p>
                              <a href="#" id="${res.name}" data-bs-toggle="modal" data-bs-target="#actionSheetForm" id="${res.plan}" class="btn btn-primary btn-block btn-sm" onclick="dataplan('${res.plan}', '${res.network_name}', '${res.name}', '${res.price}')">BUY</a>
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

      $('.network').click(function() {
        let id = $(this).attr('id')
        dataChange(id)
      })

      function dataplan(id, ntwk_name, name, price) {
        // alert(id)
        $("#text9").val(id);
        $("#text8").val(ntwk_name + ' (' + name + ')');
        $("#text11").val(ntwk_name);
        $(".amount").html('Price - <?= $coin; ?> ' + parseFloat(price).toFixed(2))

        $('#buyData').submit(function(e) {
          e.preventDefault();

          if ($("#text10").val() === '') {
            $("#dang-msg").html("Phone number is required! ");
            return toastbox('toast-16', 3000);
          }

          if ($("#text10").val().length < 11) {
            $("#dang-msg").html("Invalid phone number!");
            return toastbox('toast-16', 3000);
          }

          var formData = new FormData($(this)[0]);
          $thiss = $(this).find("[type=submit]");
          $thiss.text("please wait...");
          $thiss.addClass("disabled");

          $.ajax({
            url: '<?= $siteurl ?>trans/buy-data',
            type: 'POST',
            data: formData,
            dataType: "json",
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
              console.log(data);
              if (data.status == true) {
                $("#succ-modal").html(data.data.msg);
                // $("#succ").click();
                toastbox('toast-11');
                $thiss.text("BUY");
                $thiss.removeClass("disabled");
                $('#buyData')[0].reset()
              } else {
                $thiss.text("BUY");
                $thiss.removeClass("disabled");
                $("#failed-modal").html(data.message);
                toastbox('toast-90');
                // console.log(data);
                // $("#dang").click();
              }
            }
          }).fail(function(error) {
            // Handle error here
            // console.log(jqXHR.responseText, textStatus, error);
            console.table(error);

            $thiss.text("BUY");
            $thiss.removeClass("disabled");
            toastbox('toast-90');
          });
        })

      }
    </script>
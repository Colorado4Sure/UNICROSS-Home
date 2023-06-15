<!-- content @s -->
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="components-preview wide-md mx-auto">
                    <div class="nk-block-head nk-block-head-lg wide-sm">
                        <div class="nk-block-head-content">
                            <div class="nk-block-head-sub"><a class="back-to" href="/admin-cp"><em class="icon ni ni-arrow-left"></em><span>Dashboard</span></a></div>
                            <h2 class="nk-block-title fw-normal"><?=$page ?></h2>
                        </div>
                    </div><!-- .nk-block-head -->
                    <div class="nk-block nk-block-lg">
                        <div class="card card-preview">
                            <div class="card-inner">
                              <form id="add-user-form">
                                <div class="preview-block">
                                  <span class="preview-title-lg overline-title">Crypto Addresses</span>
                                    <div class="row gy-3">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="form-label" for="default-01">BTC Wallet Address</label>
                                                <div class="form-control-wrap">
                                                    <div class="form-icon form-icon-left">
                                                        <em class="icon ni ni-bitcoin"></em>
                                                    </div>
                                                    <input type="text" name="btc_address" class="form-control" id="default-01" value="<?=$site->btc_address?>" placeholder="BTC wallet">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="form-label" for="default-01">BTC Wallet Type</label>
                                                <div class="form-control-wrap">
                                                    <div class="form-icon form-icon-left">
                                                        <em class="icon ni ni-bitcoin"></em>
                                                    </div>
                                                    <input type="text" name="btc_wallet" class="form-control" id="default-01" value="<?=$site->btc_wallet_type?>" placeholder="BTC wallet">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="form-label" for="default-03">BTC Barcode</label>
                                                <div class="form-control-wrap">
                                                  <div class="form-icon form-icon-left">
                                                      <em class="icon ni ni-focus"></em>
                                                  </div>
                                                    <input type="text" name="btc_barcode" value="<?=$site->btc_barcode?>" class="form-control" id="default-03" placeholder="Site description">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                          <div class="form-group">
                                            <label class="form-label" for="default-04">ETH Wallet Address</label>
                                            <div class="form-control-wrap">
                                                <div class="form-icon form-icon-left">
                                                    <em class="icon ni ni-sign-eth"></em>
                                                </div>
                                                <input type="text" name="eth_address" class="form-control" value="<?=$site->eth_address?>" id="default-04" placeholder="Airtime charge">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-sm-4">
                                          <div class="form-group">
                                            <label class="form-label" for="default-04">ETH Wallet Type</label>
                                            <div class="form-control-wrap">
                                                <div class="form-icon form-icon-left">
                                                    <em class="icon ni ni-sign-eth"></em>
                                                </div>
                                                <input type="text" name="eth_wallet" class="form-control" value="<?=$site->eth_wallet_type?>" id="default-04" placeholder="Airtime charge">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-sm-4">
                                          <div class="form-group">
                                            <label class="form-label" for="default-mod">ETH Barcode</label>
                                            <div class="form-control-wrap">
                                                <div class="form-icon form-icon-left">
                                                    <em class="icon ni ni-focus"></em>
                                                </div>
                                                <input type="text" name="eth_barcode" class="form-control" value="<?=$site->eth_barcode?>" id="default-mod" placeholder="Data charges">
                                            </div>
                                          </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="form-label" for="default-03">USDT Wallet Address</label>
                                                <div class="form-control-wrap">
                                                  <div class="form-icon form-icon-left">
                                                      <em class="icon ni ni-tether"></em>
                                                  </div>
                                                    <input type="text" name="usdt_address" value="<?=$site->usdt_address?>" class="form-control" id="default-03" placeholder="Withdrawal review">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="form-label" for="default-03">USDT Wallet Type</label>
                                                <div class="form-control-wrap">
                                                  <div class="form-icon form-icon-left">
                                                      <em class="icon ni ni-tether"></em>
                                                  </div>
                                                    <input type="text" name="usdt_wallet" value="<?=$site->usdt_wallet_type?>" class="form-control" id="default-03" placeholder="Withdrawal review">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="form-label" for="default-03">USDT Barcode</label>
                                                <div class="form-control-wrap">
                                                  <div class="form-icon form-icon-left">
                                                      <em class="icon ni ni-focus"></em>
                                                  </div>
                                                    <input type="text" name="usdt_barcode" value="<?=$site->usdt_barcode?>" class="form-control" id="default-03" placeholder="Site description">
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <hr class="preview-hr">

                                    <div class="col-sm-12">
                                      <div class="form-group">
                                        <input type="hidden" name="save-type" value="payments">
                                        <span class="text-danger"><b>N/B:-</b> To set each wallet's barcode, upload the barcode picture to <i><b>public_html/uploads</b></i> then past the file names here. </span>
                                      </div>
                                    </div>
                                    <hr class="preview-hr">
                                    <div class="form-group">
                                      <button type="submit" class="btn ld btn-primary btn-lg btn-block" type="submit">Save Settings</button>
                                    </div>
                                </div>
                              </form>
                            </div>
                        </div><!-- .card-preview -->
                    </div><!-- .nk-block -->
                </div><!-- .components-preview -->
            </div>
        </div>
    </div>
</div>
<!-- content @e -->


  <script type="text/javascript">
    $("form#add-user-form").submit(function(e){
      e.preventDefault();
      form = $(this);
      var formData = new FormData($(this)[0]);
      $thiss=$(this).find("[type=submit]");
      $thiss.addClass("running");
      $thiss.addClass("btn-disabled");
      $thiss.attr("disabled",true);
      $.ajax({
        url: '/admin-cp/backend/save-settings',
        type: 'POST',
        data: formData,
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        success : function(data){
          if (data.code == "200"){
            $thiss.removeClass("running");
            $thiss.removeClass("btn-disabled");;
            $thiss.removeAttr("disabled");
            toastr["success"](data.msg);
          } else {
            $thiss.removeClass("running");
            $thiss.removeClass("btn-disabled");
            $thiss.removeAttr("disabled");
            // alert(data.msg);
            toastr["error"](data.msg);
          }
        }
      })
      .fail(function (jqXHR, textStatus, error) {
          // Handle error here
          console.log(jqXHR, textStatus, error);
          // $thiss.text("SEND");
          // $thiss.removeClass("disabled");
          // $("#failed-modal").html(jqXHR.responseText);
          // toastbox('toast-90');
          // console.log(jqXHR.responseText);
      });
    })
  </script>

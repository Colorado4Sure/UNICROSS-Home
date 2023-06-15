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
                                  <span class="preview-title-lg overline-title">Site Charges</span>
                                    <div class="row gy-3">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Deposit Charges</label>
                                                <div class="form-control-wrap">
                                                    <div class="form-icon form-icon-left">
                                                        <em class="icon ni ni-sign-kobo"></em>
                                                    </div>
                                                    <input type="text" name="deposit_charge" class="form-control" id="default-01" value="<?=$site->deposit_charge?>" placeholder="Site Name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label" for="default-05">Withdraw Charges</label>
                                                <div class="form-control-wrap">
                                                    <div class="form-icon form-icon-left">
                                                        <em class="icon ni ni-sign-kobo"></em>
                                                    </div>
                                                    <input type="text" name="withdrawal_charge" class="form-control" id="default-05" placeholder="Site keywords" value="<?=$site->withdrawal_fee?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                          <div class="form-group">
                                            <label class="form-label" for="default-04">Airtime Charges (%)</label>
                                            <div class="form-control-wrap">
                                                <div class="form-icon form-icon-left">
                                                    <em class="icon ni ni-percent"></em>
                                                </div>
                                                <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" name="airtime_charge" class="form-control" value="<?=$site->discount_airtime?>" id="default-04" placeholder="Airtime charge">
                                            </div>
                                          </div>
                                        </div>

                                        <div class="col-sm-6">
                                          <div class="form-group">
                                            <label class="form-label" for="default-mod">Data Charges</label>
                                            <div class="form-control-wrap">
                                                <div class="form-icon form-icon-left">
                                                    <em class="icon ni ni-sign-kobo"></em>
                                                </div>
                                                <input type="number" name="data_charge" class="form-control" value="<?=$site->discount_data?>" id="default-mod" placeholder="Data charges">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label" for="default-03">Max. Auto Withdrawal</label>
                                                <div class="form-control-wrap">
                                                  <div class="form-icon form-icon-left">
                                                      <em class="icon ni ni-sign-kobo"></em>
                                                  </div>
                                                    <input type="number" name="withdrawal_review" value="<?=$site->withdrawal_review?>" class="form-control" id="default-03" placeholder="Withdrawal review">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label" for="default-03">Crypto Comission (%)</label>
                                                <div class="form-control-wrap">
                                                  <div class="form-icon form-icon-left">
                                                      <em class="icon ni ni-percent"></em>
                                                  </div>
                                                    <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" name="crypto_comission" value="<?=$site->crypto_comission?>" class="form-control" id="default-03" placeholder="Site description">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label" for="default-0t">Non-Verified Users Withdraw Limit</label>
                                                <div class="form-control-wrap">
                                                  <div class="form-icon form-icon-left">
                                                      <em class="icon ni ni-sign-kobo"></em>
                                                  </div>
                                                    <input type="number" name="not_verified_user_withdrawal" value="<?=$site->not_verified_user_withdrawal?>" class="form-control" id="default-0t" placeholder="0.00">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label" for="default-03">Bill Charges</label>
                                                <div class="form-control-wrap">
                                                  <div class="form-icon form-icon-left">
                                                      <em class="icon ni ni-sign-kobo"></em>
                                                  </div>
                                                    <input type="number" name="bill_fee" value="<?=$site->pay_bill_fee?>" class="form-control" id="default-03" placeholder="Site description">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                  <hr class="preview-hr">
                                    <span class="preview-title-lg overline-title">Site Rates</span>
                                      <div class="row gy-3">
                                          <div class="col-sm-6">
                                              <div class="form-group">
                                                  <label class="form-label" for="default-01">Buy BTC Rate</label>
                                                  <div class="form-control-wrap">
                                                    <div class="form-icon form-icon-left">
                                                        <em class="icon ni ni-sign-kobo"></em>
                                                    </div>
                                                      <input type="number" name="buy_btc" class="form-control" id="default-01" value="<?=$site->btc_rate?>" placeholder="Site Name">
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-sm-6">
                                              <div class="form-group">
                                                  <label class="form-label" for="default-05">Sell BTC Rate</label>
                                                  <div class="form-control-wrap">
                                                      <div class="form-icon form-icon-left">
                                                          <em class="icon ni ni-sign-kobo"></em>
                                                      </div>
                                                      <input type="number" name="sell_btc" class="form-control" id="default-05" placeholder="Site keywords" value="<?=$site->sell_btc_rate?>">
                                                  </div>
                                              </div>
                                          </div>

                                          <div class="col-sm-6">
                                            <div class="form-group">
                                              <label class="form-label" for="default-04">Buy ETH Rate</label>
                                              <div class="form-control-wrap">
                                                  <div class="form-icon form-icon-left">
                                                      <em class="icon ni ni-sign-kobo"></em>
                                                  </div>
                                                  <input type="number" name="buy_eth" class="form-control" value="<?=$site->buy_eth?>" id="default-04" placeholder="Admin email">
                                              </div>
                                            </div>
                                          </div>

                                          <div class="col-sm-6">
                                            <div class="form-group">
                                              <label class="form-label" for="default-mod">Sell ETH Rate</label>
                                              <div class="form-control-wrap">
                                                <div class="form-icon form-icon-left">
                                                    <em class="icon ni ni-sign-kobo"></em>
                                                </div>
                                                  <input type="number" name="sell_eth" class="form-control" value="<?=$site->sell_eth?>" id="default-mod" placeholder="Moderator's email">
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-6">
                                              <div class="form-group">
                                                  <label class="form-label" for="default-03">Buy USDT Rate</label>
                                                  <div class="form-control-wrap">
                                                    <div class="form-icon form-icon-left">
                                                        <em class="icon ni ni-sign-kobo"></em>
                                                    </div>
                                                      <input type="number" name="buy_usdt" value="<?=$site->buy_usdt?>" class="form-control" id="default-03" placeholder="Site description">
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-sm-6">
                                              <div class="form-group">
                                                  <label class="form-label" for="default-03">Sell USDT Rate</label>
                                                  <div class="form-control-wrap">
                                                    <div class="form-icon form-icon-left">
                                                        <em class="icon ni ni-sign-kobo"></em>
                                                    </div>
                                                      <input type="number" name="sell_usdt" value="<?=$site->sell_usdt?>" class="form-control" id="default-03" placeholder="Site description">
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                      <input type="hidden" name="save-type" value="site-rates">
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
      });
    })
  </script>

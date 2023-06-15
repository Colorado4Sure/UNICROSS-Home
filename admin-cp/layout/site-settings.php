<div class="pcoded-content">
  <div class="page-header card">
      <div class="row align-items-end">
          <div class="col-lg-8">
              <div class="page-header-title">
                  <i class="feather icon-sliders bg-c-blue"></i>
                  <div class="d-inline">
                      <h5><?=$page?></h5>
                      <span><?=$page?></span>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <div class="pcoded-inner-content">
      <div class="main-body">
            <div class="page-wrapper">
              <div class="page-body">

                <div class="row">
                  <div class="col-md-6">

                     <div class="card">
                         <div class="card-header">
                             <h5><?=$page?></h5>
                         </div>
                         <div class="card-block">
                             <form id="ajax-form" class="form-material">
                                 <div class="form-group">
                                     <label>Site Title:</label>
                                     <input type="text" class="form-control" placeholder="Site Title" name="site_title" value="<?=$site->site_title?>" required="">
                                     
                                 </div>
                                 <div class="form-group">
                                     <label>Site Email:</label>
                                     <input type="email" class="form-control" placeholder="Site Email" value="<?=$site->site_email?>" name="site_email" required="">
                                 </div>
                                 <div class="form-group">
                                     <label>Site Keywords:</label>
                                     <input type="text" class="form-control" placeholder="Site Keywords" name="site_keys" value="<?=$site->site_keys?>" required="">
                                 </div>
                                 <div class="form-group">
                                     <label>Site Description</label>
                                     <textarea name="site_desc" class="form-control" placeholder="Site Description"><?=$site->site_desc?></textarea>
                                 </div>
                                 <div class="text-center">
                                     <button type="submit" class="btn btn-block btn-dark">
                                         <div class="ld-ext-left ld">
                                         <span class="ld ld-ring ld-cycle"></span> Save
                                         </div>
                                     </button>
                                 </div>
                                 <input type="hidden" name="save-type" value="site-settings">
                             </form>
                         </div>
                     </div>
                  </div>

                  
                  <div class="col-md-6">
                    <div class="card">
                      <div class="card-header">
                        <h5>API Settings</h5>
                      </div>
                      <div class="card-block">
                        <form id="ajax-form" class="form-material">
                          <div class="form-group">
                           <label>Aimtoget API Key:</label>
                           <input type="text" class="form-control" placeholder="Aimtoget API Key" name="atg_api_key" value="<?=$site->atg_api_key?>">
                          </div>
                          <div class="form-group">
                            <label>Aimtoget Wallet Pin: (This value is encrypted in database)</label>
                            <input type="text" class="form-control" placeholder="Aimtoget Pin" name="atg_pin" value="<?=$app->decrypt($site->atg_pin)?>">
                          </div>
                          <div class="form-group">
                           <label>MobileNig API Key:</label>
                           <input type="text" class="form-control" placeholder="MobileNig API Key" name="mobile_nig_api_key" value="<?=$site->mobile_nig_api_key?>">
                          </div>
                          <div class="form-group">
                           <label>MobileNig Username:</label>
                           <input type="text" class="form-control" placeholder="MobileNig Username" name="mobile_nig_username" value="<?=$site->mobile_nig_username?>">
                          </div>
                          <div class="form-group">
                           <label>Rubies Secret Key (For dedicated NUBAN):</label>
                           <input type="text" class="form-control" placeholder="Rubies Secret Key" name="rubies_secret_key" value="<?=$site->rubies_secret_key?>">
                          </div>
                          <div class="form-group">
                            <label>Airtime API</label>
                            <select name="airtime_api" class="form-control">
                              <option value="aimtoget">Aimtoget (Recommended)</option>
                              <option value="mobilenig" <?php if($site->airtime_api=="mobilenig") echo "selected";?> >MobileNig</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label>Data API</label>
                            <select name="data_api" class="form-control">
                              <option value="aimtoget">Aimtoget (Recommended)</option>
                              <option value="mobilenig" <?php if($site->data_api=="mobilenig") echo "selected";?>>MobileNig</option>
                            </select>
                          </div>
                          
                          <div class="text-center">
                            <button type="submit" class="btn btn-block btn-dark">
                              <div class="ld-ext-left ld">
                                <span class="ld ld-ring ld-cycle"></span> Save
                              </div>
                            </button>
                          </div>
                          <input type="hidden" name="save-type" value="api-settings">
                        </form>
                      </div>
                    </div>

                    <div class="">
                      <div class="card">
                        <div class="card-header">
                          <h5>Payment Settings</h5>
                        </div>
                        <div class="card-block">
                          <form id="ajax-form" class="form-material">
                            <div class="form-group">
                              <label>Paystack Secret Key:</label>
                              <input type="text" class="form-control" placeholder="Paysatck Secret Key" name="paystack_secret_key" value="<?=$site->paystack_secret_key?>">
                            </div>
                            <div class="form-group">
                              <label>Fultterwave (Rave) Secret Key</label>
                              <input type="text" class="form-control" placeholder="Fultterwave Secret Key" name="flutterwave_secret_key" value="<?=$site->flutterwave_secret_key?>">
                            </div>
                            <div class="text-center">
                              <button type="submit" class="btn btn-block btn-dark">
                                <div class="ld-ext-left ld">
                                  <span class="ld ld-ring ld-cycle"></span>Save
                                </div>
                              </button>
                            </div>
                            <input type="hidden" name="save-type" value="payment-settings">
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>

                </div> 
              </div>
            </div>
      </div>
  </div>

  <script type="text/javascript">
    $("form#ajax-form").submit(function(e){
      e.preventDefault();
      var formData = new FormData($(this)[0]);
      $thiss=$(this).find("[type=submit]");
      $thiss.find(".ld").addClass("running");
      $thiss.addClass("btn-disabled");
      $thiss.attr("disabled",true);

      $.ajax({
        url: './backend/save-settings',
        type: 'POST',
        data: formData,
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        success : function(data){
          if (data.code == "200"){
            $thiss.find(".ld").removeClass("running");
            $thiss.removeClass("btn-disabled");;
            $thiss.removeAttr("disabled");
            alert(data.msg);
          } else {
            $thiss.find(".ld").removeClass("running");
            $thiss.removeClass("btn-disabled");
            $thiss.removeAttr("disabled");
            alert(data.msg);
          }
        }
      });
    })
  </script>
</div>
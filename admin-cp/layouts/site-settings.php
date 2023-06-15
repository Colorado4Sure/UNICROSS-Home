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
                                    <div class="row gy-4">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Site Title</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="site_title" class="form-control" id="default-01" value="<?=$site->site_title?>" placeholder="Site Name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label" for="default-05">Site Keywords</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="site_keys" class="form-control" id="default-05" placeholder="Site keywords" value="<?=$site->site_keys?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                          <div class="form-group">
                                            <label class="form-label" for="default-04">Admin Email</label>
                                            <div class="form-control-wrap">
                                                <div class="form-icon form-icon-left">
                                                    <em class="icon ni ni-mail"></em>
                                                </div>
                                                <input type="email" name="admin_email" class="form-control" value="<?=$site->admin_email?>" id="default-04" placeholder="Admin email">
                                            </div>
                                          </div>
                                        </div>

                                        <div class="col-sm-6">
                                          <div class="form-group">
                                            <label class="form-label" for="default-mod">Moderator's Email</label>
                                            <div class="form-control-wrap">
                                                <div class="form-icon form-icon-left">
                                                    <em class="icon ni ni-mail"></em>
                                                </div>
                                                <input type="email" name="moderator_email" class="form-control" value="<?=$site->site_email?>" id="default-mod" placeholder="Moderator's email">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label" for="default-03">Site Description</label>
                                                <div class="form-control-wrap">
                                                    <textarea name="site_desc" class="form-control" id="default-03" placeholder="Site description"><?=$site->site_desc?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label" for="default-03">Referrer Username (Can be blank)</label>
                                                <div class="form-control-wrap">
                                                    <div class="form-icon form-icon-left">
                                                        <em class="icon ni ni-user"></em>
                                                    </div>
                                                    <input type="text" name="phone" class="form-control" id="default-03" placeholder="Referrer Username">
                                                </div>
                                            </div>
                                        </div> -->
                                        <input type="hidden" name="save-type" value="site-settings">
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
            // alert(data.msg);
            form.trigger('reset');
          } else {
            $thiss.removeClass("running");
            $thiss.removeClass("btn-disabled");
            $thiss.removeAttr("disabled");
            // alert(data.msg);
            toastr["error"](data.msg);
          }
        }
      })
      // .fail(function (jqXHR, textStatus, error) {
      //     // Handle error here
      //     console.log(jqXHR, textStatus, error);
      //     // $thiss.text("SEND");
      //     // $thiss.removeClass("disabled");
      //     // $("#failed-modal").html(jqXHR.responseText);
      //     // toastbox('toast-90');
      //     // console.log(jqXHR.responseText);
      // });
    })
  </script>

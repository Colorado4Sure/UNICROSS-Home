<!-- content @s -->
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="components-preview wide-md mx-auto">
                    <div class="nk-block-head nk-block-head-lg wide-sm">
                        <div class="nk-block-head-content">
                            <div class="nk-block-head-sub"><a class="back-to" href="/admin-cp/manage-users"><em class="icon ni ni-arrow-left"></em><span>All Users</span></a></div>
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
                                                <label class="form-label" for="default-01">First Name</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="fname" class="form-control" id="default-01" placeholder="First name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label" for="default-05">Last Name</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="lname" class="form-control" id="default-05" placeholder="Last name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label" for="default-03">Username</label>
                                                <div class="form-control-wrap">
                                                    <div class="form-icon form-icon-left">
                                                        <em class="icon ni ni-user"></em>
                                                    </div>
                                                    <input type="text" name="username" class="form-control" id="default-03" placeholder="Username">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                          <div class="form-group">
                                            <label class="form-label" for="default-04">Email</label>
                                            <div class="form-control-wrap">
                                                <div class="form-icon form-icon-left">
                                                    <em class="icon ni ni-mail"></em>
                                                </div>
                                                <input type="email" name="email" class="form-control" id="default-04" placeholder="Email">
                                            </div>
                                            <small style="color:red;"><b>(Verification code will be sent to this email)</b></small>
                                          </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label" for="phone">Phone (080*****) (can be blank)</label>
                                                <div class="form-control-wrap">
                                                    <div class="form-icon form-icon-left">
                                                        <em class="icon ni ni-user"></em>
                                                    </div>
                                                    <input type="text" maxlength="11" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" name="phone" class="form-control" id="phone" placeholder="Phone number">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label" for="default-03">Referrer Username (Can be blank)</label>
                                                <div class="form-control-wrap">
                                                    <div class="form-icon form-icon-left">
                                                        <em class="icon ni ni-user"></em>
                                                    </div>
                                                    <input type="text" name="" class="form-control" id="default-03" placeholder="Referrer Username">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label" for="default-03">Password</label>
                                                <div class="form-control-wrap">
                                                    <div class="form-icon form-icon-left">
                                                        <em class="icon ni ni-user"></em>
                                                    </div>
                                                    <input type="password" name="password" class="form-control" id="default-03" placeholder="Password">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label" for="default-03">Repeat Password</label>
                                                <div class="form-control-wrap">
                                                    <div class="form-icon form-icon-left">
                                                        <em class="icon ni ni-user"></em>
                                                    </div>
                                                    <input type="password" name="repeat_password" class="form-control" id="default-03" placeholder="Repeat Password">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="preview-hr">
                                    <div class="form-group">
                                      <button type="submit" class="btn ld btn-primary btn-lg btn-block" type="submit">Add User</button>
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
        url: '<?=$siteurl?>/auth/register',
        type: 'POST',
        data: formData,
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        success : function(data){
          // console.log(data);
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

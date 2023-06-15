<div class="pcoded-content">
  <div class="page-header card">
      <div class="row align-items-end">
          <div class="col-lg-8">
              <div class="page-header-title">
                  <i class="feather icon-home bg-c-blue"></i>
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
                             <form id="edit-user-form" class="md-float-material form-material">
                              <p class="text-danger font-weight-bold"> Editing some values may cause broken links</p>
                                 <div class="form-group">
                                     <label for="">First Name</label>
                                     <input type="text" name="user_fname" class="form-control" value="<?=$edit->fname?>" placeholder="First Name" required>
                                 </div>
                                 <div class="form-group">
                                     <label for="">Last Name</label>
                                     <input type="text" name="user_lname" class="form-control" value="<?=$edit->lname?>" placeholder="Last Name" required>
                                 </div>
                                 <div class="form-group">
                                     <label for="">Username</label>
                                     <input type="text" name="user_username" class="form-control" value="<?=$edit->username?>" placeholder="Username" required>
                                 </div>
                                 <div class="form-group">
                                     <label for="">Email</label>
                                     <input type="email" class="form-control" value="<?=$edit->email?>" name="user_email" placeholder="Email" required>
                                 </div>
                                 <div class="form-group">
                                     <label for="">Phone (080*****)</label>
                                     <input type="number" name="user_phone" class="form-control" value="<?=$edit->phone?>" placeholder="Phone number" required>
                                 </div>
                                 <div class="form-group">
                                     <label for="">Add Balance (can be blank)</label>
                                     <p><b>Current Balance : <?=$coin.number_format($edit->balance)?></b></p>
                                     <input type="number" name="add_balance" class="form-control" placeholder="Amount to add">
                                 </div>
                                 <div class="form-group">
                                     <label for="">User Type</label>
                                     <select name="user_type" class="form-control" required>
                                       <option value="user">User</option>
                                       <option value="admin" <?php if($edit->type=="admin"){ echo "selected"; } ?>>Admin</option>
                                     </select>
                                 </div>
                                 <div class="form-group">
                                     <button type="submit" class="btn btn-block btn-dark">
                                         <div class="ld-ext-left ld">
                                             <span class="ld ld-ring ld-cycle"></span> Save
                                         </div>
                                     </button>
                                 </div>
                                 <input type="hidden" name="edit_id" value="<?=$app->encrypt($edit->id)?>">
                             </form>
                         </div>
                     </div>
                  </div>
                </div>
              </div>
            </div>
      </div>
  </div>

  <script type="text/javascript">
    $("form#edit-user-form").submit(function(e){
      e.preventDefault();
      var formData = new FormData($(this)[0]);
      $thiss=$(this).find("[type=submit]");
      $thiss.find(".ld").addClass("running");
      $thiss.addClass("btn-disabled");
      $thiss.attr("disabled",true);
      $.ajax({
        url: './backend/user-actions?action=edit',
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

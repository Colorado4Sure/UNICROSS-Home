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
                                     <label for="">Transaction Title</label>
                                     <input type="text" class="form-control" value="<?=$tranx->title?>" disabled>
                                 </div>
                                 <div class="form-group">
                                     <label for="">TNX Type</label>
                                     <input type="text" class="form-control" value="<?=$tranx->type?>" disabled>
                                 </div>
                                 <div class="form-group">
                                     <label for="">Description</label>
                                     <input type="text" class="form-control" value="<?=$tranx->description?>"  disabled>
                                 </div>
                                 <div class="form-group">
                                     <label for="">User Description</label>
                                     <input type="text" class="form-control" value="<?=$tranx->text ?>"  disabled>
                                 </div>
                                 <div class="form-group">
                                     <label for="">Amount</label>
                                     <input type="text" class="form-control" value="<?=number_format($tranx->amount, 2) ?>" name="amount" placeholder="Amount" required>
                                 </div>
                                 <!-- <div class="form-group">
                                     <label for="">Phone (080*****)</label>
                                     <input type="number" name="user_phone" class="form-control" value="<?=$edit->phone?>" placeholder="Phone number" required>
                                 </div> -->
                                 <div class="form-group">
                                     <label for="">Current Balance (can be blank)</label>
                                     <input type="text" value="<?=number_format($tranx->balance, 2)?>" name="add_balance" class="form-control" placeholder="Amount to add">
                                     <p><b style="color: #a90000;">(Current Balance : <?=$coin.number_format($tranx->balance, 2)?>)</b></p>
                                 </div>
                                 <div class="form-group">
                                     <label for="">Transaction Status</label>
                                     <select name="trans_status" class="form-control" required>
                                       <option value="success" <?= ($tranx->status=="success")? "selected": ''?>> Success</option>
                                       <option value="pending" <?= ($tranx->status=="pending")? "selected": ''?>>Pending</option>
                                       <option value="cancelled" <?= ($tranx->status=="cancelled")? "selected": ''?>>Cancelled</option>
                                     </select>
                                 </div>

                                 <div class="form-group">
                                     <label for="">Dispute</label>
                                     <select name="disputed" class="form-control" required>
                                       <option value="yes" <?= ($tranx->status=="yes")? "selected": ''?>> Yes</option>
                                       <option value="no" <?= ($tranx->status=="No")? "selected": ''?>>No</option>
                                     </select>
                                 </div>
                                 <div class="form-group">
                                     <button type="submit" class="btn btn-block btn-dark">
                                         <div class="ld-ext-left ld">
                                             <span class="ld ld-ring ld-cycle"></span> Save
                                         </div>
                                     </button>
                                 </div>
                                 <input type="hidden" name="edit_id" value="<?=$app->encrypt($tranx->trans_id)?>">
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

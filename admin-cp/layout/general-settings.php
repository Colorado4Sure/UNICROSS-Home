<div class="pcoded-content">
   <div class="page-header card">
      <div class="row align-items-end">
         <div class="col-lg-8">
            <div class="page-header-title">
               <i class="feather icon-sliders bg-c-blue"></i>
               <div class="d-inline">
                  <h5><?= $page?></h5>
                  <span><?= $page ?></span>
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
                           <h5><?= $page ?></h5>
                        </div>
                        <div class="card-block">
                           <form id="ajax-form">
                              <h4 class="sub-title">
                                 Maintenance Mode
                                 <span class="black" data-toggle="popover" data-trigger="hover" data-content="Turn the whole site under Maintenance. You can get the site back by visiting /admin-cp">
                                    <i class="fa fa-question-circle fa-fw"></i>
                                 </span>
                              </h4>
                              <div class="form-group form-radio">
                                 <div class="radio radiofill radio-inline radio-success">
                                    <label>
                                       <input type="radio" name="maintenance_mode" value="1" <?php if($site->site_maintenance === 1){ echo 'checked="checked"';} ?> />
                                       <i class="helper"></i>Enabled
                                    </label>
                                 </div>
                                 <div class="radio radiofill radio-inline radio-danger">
                                    <label>
                                       <input type="radio" name="maintenance_mode" value="0" <?php if($site->site_maintenance === 0){ echo 'checked="checked"';} ?> />
                                       <i class="helper"></i>Disabled
                                    </label>
                                 </div>
                              </div>
                              <h4 class="sub-title">
                                 Deposit Fee
                                 <span class="black" data-toggle="popover" data-trigger="hover" data-content="Charge users extra fee each when they deposit" data-original-title="" title=""><i class="fa fa-question-circle fa-fw"></i></span>
                              </h4>
                              <div class="form-group form-radio">
                                 <div class="radio radiofill radio-inline radio-success">
                                    <label>
                                       <input type="radio" <?php if($site->deposit_fee === 1){ echo 'checked="checked"';} ?> name="deposit_fee" value="1" />
                                       <i class="helper"></i>Enabled
                                    </label>
                                 </div>
                                 <div class="radio radiofill radio-inline radio-danger">
                                    <label>
                                       <input type="radio" <?php if($site->deposit_fee === 1){ echo 'checked="checked"';} ?> name="deposit_fee" value="0" />
                                       <i class="helper"></i>Disabled
                                    </label>
                                 </div>
                              </div>
                              <div id="deposit-settings">
                              	<div class="form-group">
                              		<label>Deposit Fee Occurrence</label>
                              		<select name="deposit_occ" class="form-control">
                              			<option value="one-time">One Time</option>
                              			<option value="all" <?php if($site->deposit_occ == "all"){ echo 'selected';} ?>>Every Deposit</option>
                              		</select>
                              	</div>
                                 <div class="form-group">
                                    <label>Deposit Fee: </label>
                                    <input type="number" class="form-control" placeholder="Deposit Fee" name="deposit_charge" value="<?=$site->deposit_fee?>" required="" />
                                 </div>
                              </div>

                              <div class="text-center">
                                 <button type="submit" class="ld-over-inverse ld btn btn-dark btn-block">
                                     <span class="ld ld-ring ld-cycle" style="font-size: 2rem"></span> Save
                                 </button>
                              </div>
                              <input type="hidden" name="save-type" value="general-settings" />
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
   	$("#deposit-settings").hide();
   	$('input[type=radio][name=deposit_fee]').change(function() {
   	   if (this.value == '1') {
			   $("#deposit-settings").show();
   	   }
   	   else if (this.value == '0') {
   	   	$("#deposit-settings").hide();
   	   }
   	});
      $(document).ready(function () {
         $('[data-toggle="popover"]').popover({
            html: true,
            content: function () {
               return $("#primary-popover-content").html();
            },
         });
      });
      $("form#ajax-form").submit(function (e) {
         e.preventDefault();
         var formData = new FormData($(this)[0]);
         $thiss = $(this).find("[type=submit]");
         $thiss.addClass("running");
         $thiss.addClass("btn-disabled");
         $thiss.attr("disabled", true);
         $.ajax({
            url: "./backend/save-settings",
            type: "POST",
            data: formData,
            dataType: "json",
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
               if (data.code == "200") {
                  $thiss.removeClass("running");
                  $thiss.removeClass("btn-disabled");
                  $thiss.removeAttr("disabled");
                  swal({
                      title: data.msg,
                      // text: data.msg+" \nReloading in 5..",
                      type: "success",
                  });
               } else {
                  $thiss.removeClass("running");
                  $thiss.removeClass("btn-disabled");
                  $thiss.removeAttr("disabled");
                  swal({
                      title: data.msg,
                      // text: data.msg+" \nReloading in 5..",
                      type: "error",
                  });
               }
            },
         });
      });
   </script>
</div>

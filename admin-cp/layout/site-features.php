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
                           <div class="form-radio">
                              <form id="ajax-form">
                                 <?php
											foreach ($site->features as $key => $feature) { ?>
                                 <div class="form-group">
                                    <h4 class="sub-title"><?=$feature->name?></h4>
                                    <div class="radio radiofill radio-inline radio-success">
                                       <label> <input type="radio" name="feature['<?=$key?>']" <?php if($feature->value===true){ echo 'checked="checked"';} ?> value="1" /> <i class="helper"></i>Enabled </label>
                                    </div>
                                    <div class="radio radiofill radio-inline radio-danger">
                                       <label> <input type="radio" name="feature['<?=$key?>']" <?php if($feature->value===false){ echo 'checked="checked"';} ?> value="0"/> <i class="helper"></i>Disabled </label>
                                    </div>
                                 </div>
                                 <?php } ?>
                                 <button type="submit" class="ld-over-inverse ld btn btn-dark btn-block">
                                     <span class="ld ld-ring ld-cycle" style="font-size: 2rem"></span> Save
                                 </button>
                                 <input type="hidden" name="save-type" value="site-features" />
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

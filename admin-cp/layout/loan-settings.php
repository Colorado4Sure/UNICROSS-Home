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
                           <?php if($site->features->loan->value === false):?>
                             <h6 class="font-weight-bold text-danger">Loan feature is diabled. Enable it in site settings</h6>
                           <?php endif?>
                           <form id="ajax-form">
                              <h4 class="sub-title">
                                 Personal Loan
                                 <span class="black" data-toggle="popover" data-trigger="hover" data-content="Allow users request for low amount loans">
                                    <i class="fa fa-question-circle fa-fw"></i>
                                 </span>
                              </h4>
                              <div class="form-group form-radio">
                                 <div class="radio radiofill radio-inline radio-success">
                                    <label>
                                       <input type="radio" name="personal_loan" value="1" <?php if($site->personal_loan == 1){ echo "checked='checked'"; } ?>/>
                                       <i class="helper"></i>Enabled
                                    </label>
                                 </div>
                                 <div class="radio radiofill radio-inline radio-danger">
                                    <label>
                                       <input type="radio" name="personal_loan" value="0" <?php if($site->personal_loan == 0){ echo "checked='checked'"; } ?> />
                                       <i class="helper"></i>Disabled
                                    </label>
                                 </div>
                              </div>
                              <h4 class="sub-title">
                                 Salary Loans
                                 <span class="black" data-toggle="popover" data-trigger="hover" data-content="Allow users request for medium-high amount loans" data-original-title="" title=""><i class="fa fa-question-circle fa-fw"></i></span>
                              </h4>
                              <div class="form-group form-radio">
                                 <div class="radio radiofill radio-inline radio-success">
                                    <label>
                                       <input type="radio" name="salary_loan" value="1" <?php if($site->salary_loan == 1){ echo "checked='checked'"; } ?>/>
                                       <i class="helper"></i>Enabled
                                    </label>
                                 </div>
                                 <div class="radio radiofill radio-inline radio-danger">
                                    <label>
                                       <input type="radio" name="salary_loan" value="0" <?php if($site->salary_loan == 0){ echo "checked='checked'"; } ?>/>
                                       <i class="helper"></i>Disabled
                                    </label>
                                 </div>
                              </div>
                              <h4 class="sub-title">
                                 Loan Interest
                                 <span class="black" data-toggle="popover" data-trigger="hover" data-content="Add interest to Loans" data-original-title="" title=""><i class="fa fa-question-circle fa-fw"></i></span>
                              </h4>
                              <div class="form-group form-material">
                                 <input type="text" name="loan_interest" value="<?=$site->loan_interest?>" placeholder="5%" class="form-control">
                              </div>

                              <div class="text-center">
                                 <button type="submit" class="ld-over-inverse ld btn btn-dark btn-block">
                                     <span class="ld ld-ring ld-cycle" style="font-size: 2rem"></span> Save
                                 </button>
                              </div>
                              <input type="hidden" name="save-type" value="loan-settings" />
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
                  alert(data.msg);
                  swal({
                      title: data.msg,
                      type: "error",
                  });
               }
            },
         });
      });
   </script>
</div>

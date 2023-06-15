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
                          <p><b>Use 0 to indicate no discount</b></p>
                             <form id="ajax-form" class="form-material">
                                 <div class="form-group">
                                     <label>Airtime Discount (in %):</label>
                                     <input type="number" class="form-control" placeholder="Airtime Discount" value="<?=$site->discount_airtime?>" name="discount_airtime" required="">
                                 </div>
                                 <div class="form-group">
                                     <label>Data Discount (in %):</label>
                                     <input type="number" class="form-control" placeholder="Data Discount" value="<?=$site->discount_data?>" name="discount_data" required="">
                                 </div>
                                 <div class="text-center">
                                     <button type="submit" class="ld-over-inverse ld btn btn-dark btn-block">
                                         <span class="ld ld-ring ld-cycle" style="font-size: 2rem"></span> Save
                                     </button>
                                 </div>
                                 <input type="hidden" name="save-type" value="discount" />
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
    $("form#ajax-form").submit(function(e){
      e.preventDefault();
      var formData = new FormData($(this)[0]);
      $thiss = $(this).find("[type=submit]");
      $thiss.addClass("running");
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
            $thiss.removeClass("running");
            $thiss.removeClass("btn-disabled");;
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
        }
      });
    })
  </script>
</div>
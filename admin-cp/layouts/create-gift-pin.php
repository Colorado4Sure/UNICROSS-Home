<!-- content @s -->
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="components-preview wide-md mx-auto">
                    <div class="nk-block-head nk-block-head-lg wide-sm">
                        <div class="nk-block-head-content">
                            <div class="nk-block-head-sub"><a class="back-to" href="/admin-cp/gift-pins"><em class="icon ni ni-arrow-left"></em><span>All Gift Pins</span></a></div>
                            <h2 class="nk-block-title fw-normal"><?=$page ?></h2>
                        </div>
                    </div><!-- .nk-block-head -->
                    <div class="nk-block nk-block-lg">
                        <div class="card card-preview">
                            <div class="card-inner">
                              <form id="new-gift-pin">
                                <div class="preview-block">
                                    <div class="row gy-4">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Gift Amount</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" name="Gift_Pin_Amount" class="form-control" id="gift_amount" placeholder="Input Gift Amount">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label" for="default-01">Generate Gift Pin</label>
                                                <div class="input-group">
                                                  <input type="text" disabled name="Gift_Pin_Code" class="form-control" id="gift_code" placeholder="Gift Code">
                                                   <div class="input-group-prepend">
                                                     <button class="btn btn-primary" id="generate_btn" onclick="generatecode()" type="button"><em class="icon ni ni-reload"></em></button>
                                                   </div> 
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                    <hr class="preview-hr">
                                    <div class="form-group">
                                      <button type="submit" class="btn ld btn-primary btn-lg btn-block" type="submit">Activate Gift Pin</button>
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

      function generatecode() {
        $('#gift_code').val(Math.floor(Math.random() * 84345678910) + 72344679910);
      }

  
    $("form#new-gift-pin").submit(function(e){
      e.preventDefault();
      
      if($("#gift_code").val() == ''){
         toastr["error"]('Please Generate Gift Code');
         return
      }
      
      form = $(this);
      var formData = new FormData($(this)[0]);
      $thiss=$(this).find("[type=submit]");
      $thiss.addClass("running");
      $thiss.addClass("btn-disabled");
      $thiss.attr("disabled",true);
      $.ajax({
      url: '/admin-cp/backend/user-actions?action=create_gift_pin',
      type: 'POST',
      dataType: "json",
      data:{
          edit_id : parseInt(1),
          gift_pin_amount : $("#gift_amount").val(),
          Gift_Pin_Code : $("#gift_code").val()
      },
      cache: false,
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
    })
  </script>

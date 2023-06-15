<div class="pcoded-content">
  <div class="page-header card">
      <div class="row align-items-end">
          <div class="col-lg-8">
              <div class="page-header-title">
                  <i class="feather icon-user bg-c-blue"></i>
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
                             <form id="add-user-form" class="md-float-material form-material">
                                 <div class="form-group">
                                     <label for="">First Name</label>
                                     <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                                 </div>
                                 <div class="form-group">
                                     <label for="">Last Name</label>
                                     <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                                 </div>
                                 <div class="form-group">
                                     <label for="">Username</label>
                                     <input type="text" name="username" class="form-control" placeholder="Username" required>
                                 </div>
                                 <div class="form-group">
                                     <label for="">Email</label>
                                     <input type="email" class="form-control" name="email" placeholder="Email" required>
                                 </div>
                                 <div class="form-group">
                                     <label for="">Phone (080*****) (can be blank)</label>
                                     <input type="number" name="phone" class="form-control" placeholder="Phone number">
                                 </div>
                                 <div class="form-group">
                                     <label for="">Password</label>
                                     <input type="password" name="password" class="form-control" placeholder="Password" required>
                                 </div>
                                 <div class="form-group">
                                     <label for="">Repeat Password</label>
                                     <input type="password" name="repeat_password" class="form-control" placeholder="Repeat Password" required>
                                 </div>
                                 <div class="form-group">
                                     <label for="">Referrer Username (Can be blank)</label>
                                     <input type="text" name="phone" class="form-control" placeholder="Referrer Username">
                                 </div>
                                 <div class="form-group">
                                     <button type="submit" class="ld-over-inverse ld btn btn-dark btn-block">
                                         <span class="ld ld-ring ld-cycle" style="font-size: 2rem"></span> Add User
                                     </button>
                                 </div>
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
          if (data.code == "200"){
            $thiss..removeClass("running");
            $thiss.removeClass("btn-disabled");;
            $thiss.removeAttr("disabled");
            alert(data.msg);
            form.trigger('reset');
          } else {
            $thiss.removeClass("running");
            $thiss.removeClass("btn-disabled");
            $thiss.removeAttr("disabled");
            alert(data.msg);
          }
        }
      });
    })
  </script>
</div>
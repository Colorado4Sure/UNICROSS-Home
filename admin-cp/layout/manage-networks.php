<div class="pcoded-content">
   <div class="page-header card">
      <div class="row align-items-end">
         <div class="col-lg-8">
            <div class="page-header-title">
               <i class="bg-c-blue"><img src="./assets/icons/topup.png" width="90%" height="90%"></i>
               <div class="d-inline">
                  <h5><?= $page?></h5>
                  <span>Enable / disable mobile networks</span>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="pcoded-inner-content">
      <div class="main-body">
         <div class="page-wrapper">
            <div class="page-body">
               <div class="col-12 card">
                  <div class="card-header table-card-header">
                     <h5><?=$page?></h5>
                     <div class="card-header-right">
                         <ul class="list-unstyled card-option">
                             <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
                             <li><i class="feather icon-maximize full-card"></i></li>
                             <li><i class="feather icon-minus minimize-card"></i></li>
                             <li><i class="feather icon-refresh-cw reload-card"></i></li>
                             <li><i class="feather icon-trash close-card"></i></li>
                             <li><i class="feather icon-chevron-left open-card-option"></i></li>
                         </ul>
                     </div>
                  </div>
                  <div class="card-block">
                    <?php if($site->features->airtime->value === false):?>
                      <h6 class="font-weight-bold text-danger">Airtime feature is diabled. Enable it in site settings</h6>
                    <?php endif?>
                    <?php if($site->features->data->value === false):?>
                      <h6 class="font-weight-bold text-danger">Data feature is diabled. Enable it in site settings</h6>
                    <?php endif?>
                     <div class="table-responsive dt-responsive">
                        <table class="table table-striped table-bordered table-hover">
                           <thead>
                             <tr>
                                <th>#</th>
                                <th>Network</th>
                                <th>Status</th>
                                <th>Action</th>
                             </tr>
                           </thead>
                           <tbody>
                              <tr class="blank_row loading"><td colspan="7" class="text-center"><h6 class="font-weight-bold">Loading..</h6></td></tr>
                           </tbody>
                           <tfoot>
                             <tr>
                                <th>#</th>
                                <th>Network</th>
                                <th>Status</th>
                                <th>Action</th>
                             </tr>
                           </tfoot>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <script type="text/javascript">
     $.ajax({
         url: '<?=$siteurl?>/api/networks?table=true',
         type: 'POST',
         dataType: "json",
         cache: false,
         success : function(data){
           if (data.code == "200"){
            $("tr.loading").hide();
             $("table>tbody").append(data.html);

             $(".ignore-item").click(function(event) {
               event.preventDefault();
               con = confirm("Are you sure?");
               if(con !== true){ return false; }

               var thiss = $(this);
               var oldtext = thiss.html();
               var item_id = thiss.closest("tr").attr("item_id");
               var item_name = thiss.closest("tr").attr("item_name");
               thiss.addClass('btn-disabled');
               thiss.attr('disable',true);
               thiss.text('please wait..');
               var type = "network";
               $.ajax({
                   url: './backend/ignore-item?action=disable',
                   type: 'POST',
                   data: {
                      item_id:item_id,
                      item_name:item_name,
                      type:type
                   },
                   dataType: "json",
                   cache: false,
                   success : function(data){
                       if (data.code == "200"){
                        thiss.removeClass("btn-disabled");;
                        thiss.removeAttr("disabled");
                        thiss.text(oldtext);
                        alert(data.msg);
                        thiss.closest('tr').remove();
                       }
                       else{
                        thiss.removeClass("btn-disabled");;
                        thiss.removeAttr("disabled");
                        thiss.text(oldtext);
                        alert(data.msg);
                       }
                   }
               });
             });
           }
         }
     });
   </script>
</div>

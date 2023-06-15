<div class="pcoded-content">
   <div class="page-header card">
      <div class="row align-items-end">
         <div class="col-lg-8">
            <div class="page-header-title">
               <i class="feather icon-sliders bg-c-blue"></i>
               <div class="d-inline">
                  <h5><?= $page?></h5>
                  <span>Enable / disable items</span>
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
                     <div class="table-responsive dt-responsive">
                        <table class="table table-striped table-bordered table-hover">
                           <thead>
                             <tr>
                                <th>#</th>
                                <th>Item Name</th>
                                <th>Item ID</th>
                                <th>Type</th>
                                <th>Action</th>
                             </tr>
                           </thead>
                           <tbody>
                            <?php
                            $items = $app->query("SELECT * FROM ignored_items ORDER BY id DESC");
                            $count = 0;
                            while($item = $items->fetch_object()) {
                              $count++;
                              ?>
                              <tr item_id="<?=$item->item_id?>" item_type="<?=$item->type?>">
                                <td><?=$count?></td>
                                 <td><?=$item->item_name?></td>
                                 <td><?=$item->item_id?></td>
                                 <td><?=$item->type?></td>
                                 <td><button class="btn-sm btn btn-dark ignore-item">Enable</button></td>
                              </tr>
                            <?php } ?>
                           </tbody>
                           <tfoot>
                             <tr>
                                <th>#</th>
                                <th>Item Name</th>
                                <th>Item ID</th>
                                <th>Type</th>
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
     $(".ignore-item").click(function(event) {
       event.preventDefault();
       con = confirm("Are you sure?");
       if(con !== true){ return false; }

       var thiss = $(this);
       var oldtext = thiss.html();
       var item_id = thiss.closest("tr").attr("item_id");
       var type = thiss.closest("tr").attr("item_type");
       thiss.addClass('btn-disabled');
       thiss.attr('disable',true);
       thiss.text('please wait..');
       $.ajax({
           url: './backend/ignore-item?action=enable',
           type: 'POST',
           data: {
              item_id:item_id,
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
                reload_page();
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
   </script>
</div>

<div class="pcoded-content">
   <div class="page-header card">
      <div class="row align-items-end">
         <div class="col-lg-8">
            <div class="page-header-title">
               <i class="feather icon-list bg-c-blue"></i>
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
                    <?php if($site->features->loan->value === false):?>
                      <h6 class="font-weight-bold text-danger">Loan feature is diabled. Enable it in site settings</h6>
                    <?php endif?>
                     <div class="table-responsive dt-responsive">
                        <table class="table table-striped table-bordered table-hover data-table">
                           <thead>
                             <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Loan Amount</th>
                                <th>Loan Type</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                             </tr>
                           </thead>
                           <tbody>
                            <?php
                            $key = 0;
                            foreach ($stats->loan_requests as $req) {
                              if($req->status == 1)continue;
                              $key++;
                              $user = $app->user($req->user_id);
                              ?>
                              <tr req_id = "<?=$app->encrypt($req->id)?>">
                                <td><?=$key?></td>
                                <td><?=$user->name?></td>
                                <td><?=$user->email?></td>
                                <td><?=$coin.number_format($req->amount)?></td>
                                <td><?=strtoupper($req->type)?></td>
                                <td><?=date("d-M-Y h:ia",$req->time)?></td>
                                <?php if($req->status == 2):?>
                                <td class="font-weight-bold text-warning">pending</td>
                                <?php elseif($req->status == 0):?>
                                <td class="font-weight-bold text-danger">Declined</td>
                                <?php elseif($req->status == 3):?>
                                <td class="font-weight-bold text-info">Amount Changed</td>
                                <?php endif?>
                                <td><button class="btn-sm btn btn-dark view-req">View</button></td> 
                              </tr>
                              <?php
                            }
                            ?>
                           </tbody>
                           <tfoot>
                             <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Loan Amount</th>
                                <th>Loan Type</th>
                                <th>Date</th>
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
      <style type="text/css">
        @media (min-width: 320px) and (max-width: 480px) {
          .modal-content{
            width: 100%;
          }
        }
      </style>
      <button type="button" id="loan-details-modal-opener" data-toggle="modal" data-target="#loan-details-modal" style="display: none;"></button>
      <div class="modal fade" id="loan-details-modal" tabindex="-1" role="dialog" aria-labelledby="loan-details-modal" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document" style="margin-top:0">
              <div class="modal-content" style="height: 100vh">
                <div class="modal-header">
                  <h5 class="modal-title" id="loan-details-modal-title">Loan Request </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body ld-over running" id="loan-details-modal-body" style="overflow: auto; padding: 0">
                    <div class="ld ld-ring ld-spin"></div>
                  <div id="loan-details-modal-content"></div>
                </div>
                <div class="modal-footer">
                  <button type="button" id="loan-details-modal-approve" class="btn btn-success">Approve Loan</button>
                  <button type="button" id="loan-details-modal-decline" class="btn btn-danger">Decline Loan</button>
                  <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
        </div>
        <script src="assets/ui/jquery-ui-1.12.1.js"></script>
        <link rel="stylesheet" href="assets/ui/jquery-ui-1.12.1.css">
        <style type="text/css">
          .ui-dialog { z-index: 1060 !important ;}
        </style>
        <div id="dialog-confirm">
          <p></p>
        </div>
   <script type="text/javascript">
      $("button.view-req").click(function(e){
        thiss = $(this);
        reqid = thiss.closest("tr").attr("req_id");
        modal = $("#loan-details-modal");
        modal.find('.modal-body').addClass('running');
        $("#loan-details-modal-opener").click();
        $("#loan-details-modal-loader").show();
        $("#loan-details-modal-decline").attr("reqid",reqid);
        $("#loan-details-modal-approve").attr("reqid",reqid);
        $.ajax({
                 url: "./backend/loan-details",
                 type: 'POST',
                 data: {
                   req_id:reqid
                 },
                 dataType: "json",
                 cache: false,
                 success : function(data){
                  if (data.code == "200"){
                      modal.find('.modal-body').removeClass('running');
                      $("#loan-details-modal-content").html(data.html);
                     }
                     else{
              $("#loan-details-modal-loader").hide();
                         alert(data.msg);
                     }
                 }
             });
      });
      $("#loan-details-modal-decline").click(function(e){
        thiss = $(this);
        reqid = $(thiss).attr("reqid");
        $("#dialog-confirm p").text("Decline Loan request?");
        $("#dialog-confirm").attr("title","Decline loan request?");
        $("#dialog-confirm").dialog({
          resizable: false,
            height: "auto",
            width: 400,
            modal: false,
            buttons: {
              "Decline": function() {
              thiss.attr("disabled",true);
              console.log(reqid);
                $.ajax({
                      url: "./backend/loan-action?action=decline",
                      type: 'POST',
                      data: {
                        req_id:reqid
                      },
                      dataType: "json",
                      cache: false,
                      success : function(data){
                          if (data.code == "200"){
                    alert(data.msg);
                    pjax.reload();
                          }
                          else{
                              alert(data.msg);
                              thiss.removeAttr("disabled");
                          }
                      }
                  }); 
              },
                Cancel: function() {
                  $( this ).dialog( "close" );
                }
            }
        });
      })

      $("#loan-details-modal-approve").click(function(e){
        thiss = $(this);
        reqid=$(thiss).attr("reqid");
        $("#dialog-confirm p").text("Approve Loan request?");
        $("#dialog-confirm").attr("title","Approve loan request?");
        $(function() {
          $("#dialog-confirm").dialog({
            resizable: false,
            height: "auto",
            width: 400,
            modal: false,
            buttons: {
              "Approve": function() {
            thiss.attr("disabled",true);
              $.ajax({
                    url: "./backend/loan-action?action=approve",
                    type: 'POST',
                    data: {
                      req_id:reqid
                    },
                    dataType: "json",
                    cache: false,
                    success : function(data){
                        if (data.code == "200"){
                  alert(data.msg);
                  pjax.reload();
                        }
                        else{
                            alert(data.msg);
                            thiss.removeAttr("disabled");
                        }
                    }
                }); 
              },
              "Change Amount": function() {
            var amount = prompt("Please enter new amount (numbers only)", "");
            if (amount != null) {
            thiss.attr("disabled",true);
              $.ajax({
                    url: "./backend/loan-action?action=change_amount",
                    type: 'POST',
                    data: {
                      req_id:reqid,
                      new_amount:amount
                    },
                    dataType: "json",
                    cache: false,
                    success : function(data){
                        if (data.code == "200"){
                  alert(data.msg);
                  pjax.reload();
                        }
                        else{
                            alert(data.msg);
                            thiss.removeAttr("disabled");
                        }
                    }
                });
            }
              },
              Cancel: function() {
                $(this).dialog( "close" );
              }
            }
          });
        }); 
      })
   </script>
   <script type="text/javascript">
     $(function() {
       $(".data-table").DataTable();
     });
   </script>
</div>

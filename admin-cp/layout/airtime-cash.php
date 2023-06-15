<div class="pcoded-content">
   <div class="page-header card">
      <div class="row align-items-end">
         <div class="col-lg-8">
            <div class="page-header-title">
               <i class="bg-c-blue"><img src="./assets/icons/topup.png" width="90%" height="90%"></i>
               <div class="d-inline">
                  <h5><?= $page?></h5>
                  <span><?= $page ?></span>
               </div>
            </div>
         </div>
      </div>
   </div>
   <style type="text/css">
      .blank_row{
        height: 10px !important; /* overwrites any other rules */
        background-color: #FFFFFF;
      }
   </style>
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
                    <?php if($site->features->airtime_to_cash->value === false):?>
                      <h6 class="font-weight-bold text-danger">Airtime to Cash is diabled. Enable it in site settings</h6>
                    <?php endif?>

                     <div class="table-responsive dt-responsive">
                      <h6 class="font-weight-bold text-center">Airtime to Cash requests</h6>
                        <table class="table table-striped data-table">
                           <thead>
                             <tr>
                                <th>#</th>
                                <th>User Email</th>
                                <th>Network</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                             </tr>
                           </thead>
                           <tbody>
                            <?php
                            $key = 0;
                            foreach ($stats->plans as $plan) {
                              $key++;
                              ?>
                              <tr item_id="<?=$req->id?>">
                                <td><?=$key?></td>
                                <td><?=$app->user($req->user_id)->email?></td>
                                <td><?=$req->network?>?></td>
                                <td><?=$coin.number_format($req->amount)?></td>
                                <?php if($plan->status == 0):?>
                                <td class="font-weight-bold text-danger">Declined</td>
                                <?php else:?>
                                <td class="font-weight-bold text-success">Approved</td>
                                <?php endif?>
                                <td><button class="btn-sm btn btn-dark edit-item">View </button></td> 
                              </tr>
                              <?php
                            }
                            ?>
                           </tbody>
                           <tfoot>
                             <tr>
                                <th>#</th>
                                <th>User Email</th>
                                <th>Network</th>
                                <th>Amount</th>
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
    
  </script>
</div>

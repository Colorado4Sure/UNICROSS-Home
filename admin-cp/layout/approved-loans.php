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
                                <th>Payback Status</th>
                                <th>Duration</th>
                                <th>Action</th>
                             </tr>
                           </thead>
                           <tbody>
                            <?php
                            $key = 0;
                            foreach ($stats->loan_requests as $req) {
                              if($req->status != 1)continue;
                              $key++;
                              $user = $app->user($req->user_id);
                              ?>
                              <tr>
                                <td><?=$key?></td>
                                <td><?=$user->name?></td>
                                <td><?=$user->email?></td>
                                <td><?=$coin.number_format($req->amount)?></td>
                                <td><?=strtoupper($req->type)?></td>
                                <td><?=date("d-M-Y h:ia",$req->time)?></td>
                                <?php if($req->status == 1):?>
                                <td class="font-weight-bold text-success">Approved</td>
                                <?php endif?>
                                <td class="font-weight-bold <?=($req->status2=="paid")?"text-success":"text-danger"?>"><b><?=$req->status2?></b></td>
                                <td><?=$req->duration?></td>
                                <td><button class="btn-sm btn btn-dark loan-action">View</button></td> 
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
                                <th>Payback Status</th>
                                <th>Duration</th>
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
  $(function() {
    $(".data-table").DataTable();
  });
</script>
</div>

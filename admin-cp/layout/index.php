<div class="pcoded-content">
   <div class="page-header card">
      <div class="row align-items-end">
         <div class="col-lg-8">
            <div class="page-header-title">
               <i class="feather icon-home bg-c-blue"></i>
               <div class="d-inline">
                  <h5>Dashboard</h5>
                  <span>Account Overview</span>
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
                  <div class="col-xl-3 col-md-12">
                     <div class="card comp-card">
                        <div class="card-body">
                           <div class="row align-items-center">
                              <div class="col">
                                 <h6 class="m-b-25">Users</h6>
                                 <h3 class="f-w-700 text-c-blue"><?=count($stats->users)?></h3>
                              </div>
                              <div class="col-auto">
                                 <i class="fas feather icon-users bg-c-blue"></i>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="col-xl-3 col-md-12">
                     <div class="card comp-card">
                        <div class="card-body">
                           <div class="row align-items-center">
                              <?php if ($site->features->loan === true):?>
                              <div class="col">
                                 <h6 class="m-b-25">Loan Requests</h6>
                                 <h3 class="f-w-700 text-c-green"><?=count($stats->loan_requests)?></h3>
                              </div>
                              <div class="col-auto">
                                 <i class="fas feather icon-list bg-c-green"></i>
                              </div>
                              <?php else:?>
                              <div class="col">
                                 <h6 class="m-b-25">Funds Requests</h6>
                                 <h3 class="f-w-700 text-c-green"><?=count($stats->funds_requests)?></h3>
                              </div>
                              <div class="col-auto">
                                 <i class="fas feather icon-list bg-c-green"></i>
                              </div>
                              <?php endif ?>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="col-xl-3 col-md-12">
                     <div class="card comp-card">
                        <div class="card-body">
                           <div class="row align-items-center">
                              <div class="col">
                                 <h6 class="m-b-25">Transactions</h6>
                                 <h3 class="f-w-700 text-c-yellow"><?=$stats->transactions_count?></h3>
                              </div>
                              <div class="col-auto">
                                 <i class="fas fa-money bg-c-yellow"></i>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="col-xl-3 col-md-12">
                     <div class="card comp-card">
                        <div class="card-body">
                           <div class="row align-items-center">
                              <div class="col">
                                 <h6 class="m-b-25">API Balance</h6>
                                 <h3 class="f-w-700 text-c-red"><?=count($user->referrals)?></h3>
                              </div>
                              <div class="col-auto">
                                 <i class="fas fe-dollar-sign bg-c-red"></i>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="row">
                  <div class="col-xl-6 col-md-6">
                     <div class="card table-card">
                        <div class="card-header">
                           <h5>Recent Transactions</h5>
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
                           <div class="table-responsive">
                              <table class="table table-hover m-b-0">
                                 <thead>
                                    <tr>
                                       <th>#</th>
                                       <th>User</th>
                                       <th>Transaction</th>
                                       <th>Time</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php
                                    $transact = $app->all_transaction(false);
                                    $key = 0;
												foreach ($transact as $trans) {
                                       if ($trans->type=="credit") continue;
                                       if($key++ == 15) break;
                                       ?>
                                    <tr>
                                       <td><?=$key?></td>
                                       <td><?=$trans->user_id?></td>
                                       <td><?=$trans->title?></td>
                                       <td><?=date("d-m-Y h:ia", strtotime($trans->date))?></td>
                                    </tr>
                                    <?php
													}
												?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-6 col-md-6">
                     <div class="card table-card">
                        <div class="card-header">
                           <h5>Recent Deposits</h5>
                        </div>
                        <div class="card-block">
                           <div class="table-responsive">
                              <table class="table table-hover m-b-0">
                                 <thead>
                                    <tr>
                                       <th>#</th>
                                       <th>User</th>
                                       <th>Trans ID</th>
                                       <th>Amount</th>
                                       <th>Date</th>
                                       <th>Status</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php
												   $key = 0;
													foreach ($transact as $trans) {
                                          if ($trans->type !== "credit") continue;
                                          $key++;
                                          if($key == 15) break;
                                          ?>
                                    <tr>
                                       <td><?=$key?></td>
                                       <td><?=$trans->user_id?></td>
                                       <td><?=$trans->trans_id?></td>
                                       <td><?= $coin. ' '. number_format($trans->amount, 2)?></td>
                                       <td><?=date("d-m-Y h:ia", strtotime($trans->date))?></td>
                                       <td><?= ($trans->status == 'success')? '<label class="label label-success">Success</label>': (($trans->status == 'pending')? '<label class="label label-warning">pending</label>' : '<label class="label label-danger">Failed</label>') ?></td>
                                    </tr>
                                    <?php
													 }
													 ?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

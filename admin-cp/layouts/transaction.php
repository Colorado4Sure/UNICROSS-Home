<!-- content @s -->
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title"><?=$page ?></h3>
                            <div class="nk-block-des text-soft">
                                <p>Viewing transaction details for <b> <?=$tranx->title ?> </b>by <b><?=$u_user->username ?></b> </p>
                            </div>
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="card card-bordered card-stretch">
                        <div class="card-inner-group">
                            <div class="card-inner position-relative card-tools-toggle" style="border-bottom: 0px;">

                                <div class="nk-modal-head">
                                  <h4 class="nk-modal-title title">Transaction Serial No. <small class="text-primary id">#<?=$tranx->id ?></small></h4>
                                </div>
                            </div><!-- .card-inner -->
                            <div class="card-inner p-0">
                              <div class="modal-content">
                                        <div class="modal-body">
                                          <div class="nk-tnx-details mt-sm-3">
                                            <div class="row gy-3">
                                              <div class="col-lg-6">
                                                <span class="sub-text">Trans ID</span><span class="caption-text trans_id"><?=$tranx->trans_id ?></span>
                                              </div>
                                              <div class="col-lg-6">
                                                <span class="sub-text">Trans Title </span><span class="caption-text text-break trans_title"><?=$tranx->title ?></span>
                                              </div>
                                              <div class="col-lg-6">
                                                <span class="sub-text">Trans Type</span><span class="caption-text trans_type"><?=$tranx->type ?></span>
                                              </div>
                                              <div class="col-lg-6">
                                                <span class="sub-text">Payment Method</span><span class="caption-text trans_method"><?=$tranx->method ?></span>
                                              </div>
                                              <div class="col-lg-6">
                                                <span class="sub-text">Amount</span><span class="caption-text trans_amount"><?=number_format($tranx->amount,2) ?></span>
                                              </div>
                                              <div class="col-lg-6">
                                                <span class="sub-text">User Balance</span><span class="caption-text trans_balance"><?=number_format($tranx->balance, 2) ?></span>
                                              </div>
                                              <div class="col-lg-6">
                                                <span class="sub-text">Description</span><span class="caption-text trans_desc"><?=$tranx->description ?></span>
                                              </div>
                                              <div class="col-lg-6">
                                                <span class="sub-text">User Description</span><span class="caption-text user_desc"> <?=$tranx->text ?></span>
                                              </div>
                                              <div class="col-lg-6">
                                                <span class="sub-text">Status</span><span class="trans_status"><?=$tranx->status ?></span>
                                              </div>
                                              <div class="col-lg-6">
                                                <span class="sub-text">Date</span><span class="caption-text trans_date"><?=date("M d, Y h:ia", strtotime($tranx->date))?></span>
                                              </div>
                                              <div class="col-lg-6">
                                                <span class="sub-text">Dispute?</span><span class="caption-text dispute"><?=$tranx->dispute ?></span>
                                              </div>
                                              <div class="col-lg-6">
                                                <span class="sub-text">Admin Note:</span><span class="caption-text adminNote"><?=$tranx->admin_note ?></span>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      <!-- </div> -->
                                  </div><!-- .modal-dialog -->

                            </div><!-- .card-inner -->
                        </div><!-- .card-inner-group -->
                    </div><!-- .card -->
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
</div>
<!-- content @e -->

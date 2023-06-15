<!-- content @s -->
<?php $this_user = $app->user($edit->user_id); ?>
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between g-3">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">KYCs / <strong class="text-primary small"><?= $this_user->fname. ' '.$this_user->lname ?></strong></h3>
                        </div>
                        <div class="nk-block-head-content">
                            <a href="/admin-cp/manage-kyc" class="btn btn-outline-light bg-white d-none d-sm-inline-flex"><em class="icon ni ni-arrow-left"></em><span>Back</span></a>
                            <a href="html/kyc-list-regular.html" class="btn btn-icon btn-outline-light bg-white d-inline-flex d-sm-none"><em class="icon ni ni-arrow-left"></em></a>
                        </div>
                    </div>
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="row gy-5">
                        <div class="col-lg-5">
                            <div class="nk-block-head">
                                <div class="nk-block-head-content">
                                    <h5 class="nk-block-title title">Application Info</h5>
                                    <p>Submission date, approve date, status etc.</p>
                                </div>
                            </div><!-- .nk-block-head -->
                            <div class="card card-bordered">
                                <ul class="data-list is-compact">
                                    <li class="data-item">
                                        <div class="data-col">
                                            <div class="data-label">Document ID</div>
                                            <div class="data-value"><?=$edit->doc_id ?></div>
                                        </div>
                                    </li>
                                    <li class="data-item">
                                        <div class="data-col">
                                            <div class="data-label">Submitted At</div>
                                            <div class="data-value"><?=date("d M, Y h:i A", strtotime($edit->createdAt))?></div>
                                        </div>
                                    </li>
                                    <li class="data-item">
                                        <div class="data-col">
                                            <div class="data-label">Status</div>
                                            <div class="data-value"><span class="badge badge-dim badge-sm badge-outline-success"><?= ucfirst($edit->status) ?></span></div>
                                        </div>
                                    </li>
                                    <li class="data-item">
                                        <div class="data-col">
                                            <div class="data-label">Approved By</div>
                                            <div class="data-value">
                                                <div class="user-card">
                                                    <div class="user-name">
                                                        <span class="tb-lead"><?= ucfirst($edit->approved_by) ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="data-item">
                                        <div class="data-col">
                                            <div class="data-label">Approved At</div>
                                            <div class="data-value"><?=date("d M, Y h:i A", strtotime($edit->approval_date))?></div>
                                        </div>
                                    </li>
                                </ul>
                            </div><!-- .card -->
                            <div class="nk-block-head">
                                <div class="nk-block-head-content">
                                    <h5 class="nk-block-title title">Uploaded Documents</h5>
                                    <p>Here is user uploaded documents.</p>
                                </div>
                            </div><!-- .nk-block-head -->
                            <div class="card card-bordered">
                                <ul class="data-list is-compact">
                                    <li class="data-item">
                                        <div class="data-col">
                                            <div class="data-label">Document Type</div>
                                            <div class="data-value"><?= ucfirst($edit->doc_type) ?></div>
                                        </div>
                                    </li>
                                    <li class="data-item">
                                        <div class="data-col">
                                            <div class="data-label">Document/File Name</div>
                                            <div class="data-value"><?=$edit->image ?></div>
                                        </div>
                                    </li>
                                </ul>
                            </div><!-- .card -->
                        </div><!-- .col -->
                        <div class="col-lg-7">
                            <div class="nk-block-head">
                                <div class="nk-block-head-content">
                                    <h5 class="nk-block-title title">Users Information</h5>
                                    <p>Basic info, like name, phone etc.</p>
                                </div>
                            </div>
                            <div class="card card-bordered">
                                <ul class="data-list is-compact">
                                    <li class="data-item">
                                        <div class="data-col">
                                            <div class="data-label">First Name</div>
                                            <div class="data-value"><?=ucfirst($this_user->fname) ?></div>
                                        </div>
                                    </li>
                                    <li class="data-item">
                                        <div class="data-col">
                                            <div class="data-label">Last Name</div>
                                            <div class="data-value"><?=ucfirst($this_user->lname) ?></div>
                                        </div>
                                    </li>
                                    <li class="data-item">
                                        <div class="data-col">
                                            <div class="data-label">Email Address</div>
                                            <div class="data-value"><?=$this_user->email ?></div>
                                        </div>
                                    </li>
                                    <li class="data-item">
                                        <div class="data-col">
                                            <div class="data-label">Phone Number</div>
                                            <div class="data-value text-soft"><em><?=$this_user->phone ?></em></div>
                                        </div>
                                    </li>
                                    <li class="data-item">
                                        <div class="data-col">
                                            <div class="data-label">Joined Date</div>
                                            <div class="data-value"><?=date("d M, Y h:i A", strtotime($this_user->createdAt))?></div>
                                        </div>
                                    </li>
                                    <li class="data-item">
                                        <div class="data-col">
                                            <div class="data-label">NGN Wallet Balance</div>
                                            <div class="data-value"><?=$coin.number_format($this_user->balance, 2) ?></div>
                                        </div>
                                    </li>
                                    <li class="data-item">
                                        <div class="data-col">
                                            <div class="data-label">BTC Balance</div>
                                            <div class="data-value text-break"><?=number_format($this_user->BTC, 9) ?> BTC</div>
                                        </div>
                                    </li>
                                    <li class="data-item">
                                        <div class="data-col">
                                            <div class="data-label">ETH Balance</div>
                                            <div class="data-value text-break"><?=number_format($this_user->ETH, 9) ?> BTC</div>
                                        </div>
                                    </li>
                                    <li class="data-item">
                                        <div class="data-col">
                                            <div class="data-label">USDT Balance</div>
                                            <div class="data-value text-break"><?=number_format($this_user->USDT, 9) ?> BTC</div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- .col -->
                    </div><!-- .row -->
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
</div>
<!-- content @e -->

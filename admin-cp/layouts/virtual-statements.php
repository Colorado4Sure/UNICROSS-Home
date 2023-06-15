<!-- content @s -->
<?php if ($user->type !== 'super-admin') return false; ?>
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title"><?= $page ?></h3>
                            <div class="nk-block-des text-soft">
                                <p>Total Transactions: <?= number_format((int) count($tranx->data)) ?>.
                                    <br> Total Credit: <?= number_format($tranx->balance->credit, 2) ?>
                                    <br> Total Debit: <?= number_format($tranx->balance->debit, 2) ?>
                                    <br> Balance: <?= number_format($tranx->balance->balance, 2) ?>
                                </p>
                            </div>
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="card card-bordered card-stretch">
                        <div class="card-inner-group">
                            <div class="card-inner position-relative card-tools-toggle" style="border-bottom: 0px;">
                            </div><!-- .card-inner -->
                            <div class="card-inner p-0">
                                <?php if (!isset($_GET['reference'])) : ?>
                                    <table class="nk-tb-list nk-tb-ulist table table-striped table-bordered table-hover data-table">
                                        <thead>
                                            <tr>
                                                <th class="nk-tb-col nk-tb-col-check tb-col-md">
                                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                                        <input type="checkbox" class="custom-control-input" id="uid">
                                                        <label class="custom-control-label" for="uid"></label>
                                                    </div>
                                                </th>
                                                <th class="nk-tb-col"><span>Account Name</span></th>
                                                <th class="nk-tb-col tb-col-md"><span>Date/Time</span></th>
                                                <th class="nk-tb-col tb-col-lg"><span>Trans ID</span></th>
                                                <th class="nk-tb-col tb-col-lg"><span>Bank</span></th>
                                                <th class="nk-tb-col"><span>Amount</span></th>
                                                <th class="nk-tb-col"><span class="d-sm-inline">Status</span></th>
                                                <th class="nk-tb-col"><span>&nbsp;</span></th>
                                            </tr>
                                        </thead><!-- .nk-tb-item -->

                                        <tbody>
                                            <?php foreach ($tranx->data as $trans) :
                                            ?>
                                                <tr class="nk-tb-item <?= $trans->ReferenceNumber ?>">
                                                    <td class="nk-tb-col nk-tb-col-check tb-col-md">
                                                        <div class="custom-control custom-control-sm custom-checkbox notext">
                                                            <input type="checkbox" class="custom-control-input" id="uid1">
                                                            <label class="custom-control-label" for="uid1"></label>
                                                        </div>
                                                    </td>
                                                    <td class="nk-tb-col">
                                                        <a href="?reference=<?= $trans->ReferenceNumber ?>">
                                                            <div class="user-card">
                                                                <div class="user-info">
                                                                    <span class="tb-lead"><?= $trans->BeneficiaryName ?> </span>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </td>
                                                    <td class="nk-tb-col tb-col-lg">
                                                        <span><?= date("M d, Y h:ia", strtotime($trans->RealDate)) ?></span>
                                                    </td>
                                                    <td class="nk-tb-col tb-col-md">
                                                        <span><?= $trans->ReferenceNumber ?></span>
                                                    </td>
                                                    <td class="nk-tb-col tb-col-md">
                                                        <span><?= $trans->Merchant ?></span>
                                                    </td>
                                                    <td class="nk-tb-col">
                                                        <span class="tb-amount"><?= $coin . number_format($trans->Amount / 100, 2) ?></span>
                                                    </td>
                                                    <td class="nk-tb-col">
                                                        <?= ($trans->PostingRecordType === 2) ? '<span class="tb-status text-success">Credit</span>' : '<span class="tb-status text-danger">Debit</span>' ?>
                                                    </td>
                                                    <td class="nk-tb-col nk-tb-col-tools">
                                                        <ul class="nk-tb-actions gx-1">
                                                            <li>
                                                                <div class="drodown">
                                                                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                    <div class="dropdown-menu dropdown-menu-right">
                                                                        <ul class="link-list-opt no-bdr">
                                                                            <li><a href="?reference=<?= $trans->ReferenceNumber ?>"><em class="icon ni ni-eye"></em><span>View</span></a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr><!-- .nk-tb-item -->
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table><!-- .nk-tb-list -->
                                <?php
                                else : 
                                    $tranx = $app->virtual_statement($sub, $_GET['reference'])->data
                                ?>
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="nk-tnx-details mt-sm-3">
                                                <div class="row gy-3">
                                                    <div class="col-lg-6">
                                                        <span class="sub-text">Trans ID</span><span class="caption-text trans_id"><?= $tranx->ReferenceNumber ?></span>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <span class="sub-text">Beneficiary </span><span class="caption-text text-break trans_title"><?= $tranx->BeneficiaryName ?></span>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <span class="sub-text">Trans Type</span><span class="caption-text trans_type"><?= ($tranx->PostingRecordType === 2) ? '<span class="tb-status text-success">Credit</span>' : '<span class="tb-status text-danger">Debit</span>' ?></span>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <span class="sub-text">Account Number</span><span class="caption-text trans_method"><?= $tranx->AccountNumber ?></span>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <span class="sub-text">Amount</span><span class="caption-text trans_amount"><?= number_format($tranx->Amount/100, 2) ?></span>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <span class="sub-text">Balance After</span><span class="caption-text trans_balance"><?= number_format($tranx->BalanceAfter/100, 2) ?></span>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <span class="sub-text">Description</span><span class="caption-text trans_desc"><?= $tranx->Narration ?></span>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <span class="sub-text">Instrument ID</span><span class="trans_status"><?= $tranx->InstrumentNumber ?></span>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <span class="sub-text">Date</span><span class="caption-text trans_date"><?= date("M d, Y h:ia", strtotime($tranx->RealDate)) ?></span>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <span class="sub-text">Session ID</span><span class="caption-text dispute"><?= $tranx->SessionId ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- </div> -->
                                    </div><!-- .modal-dialog -->
                                <?php endif; ?>
                            </div><!-- .card-inner -->
                        </div><!-- .card-inner-group -->
                    </div><!-- .card -->
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
</div>
<!-- content @e -->
<!-- content @s -->
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title"><?= $page ?></h3>
                            <div class="nk-block-des text-soft">
                                <p>Welcome, <?= $user->fname . ' ' . $user->lname ?></p>
                            </div>
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <?php
                $totlal_credit = 0;
                $total_debit = 0;
                foreach ($app->all_transaction(false) as $total) {
                    if ($total->type == 'debit') $total_debit += (int)$total->amount;
                    if ($total->type == 'credit') $totlal_credit += (int)$total->amount;
                } ?>
                <div class="nk-block">
                    <div class="row g-gs">
                        <div class="col-xxl-6">
                            <div class="row g-gs">
                                <div class="col-lg-6 col-xxl-12">
                                    <div class="card card-bordered">
                                        <div class="card-inner">
                                            <div class="card-title-group align-start mb-2">
                                                <div class="card-title">
                                                    <h6 class="title">Total Credit</h6>
                                                </div>
                                                <div class="card-tools">
                                                    <em class="card-hint icon ni ni-help-fill" data-toggle="tooltip" data-placement="left" title="Total amount credited by your users"></em>
                                                </div>
                                            </div>
                                            <div class="align-end gy-3 gx-5 flex-wrap flex-md-nowrap flex-lg-wrap flex-xxl-nowrap">
                                                <div class="nk-sale-data-group flex-md-nowrap g-4">
                                                    <div class="nk-sale-data">
                                                        <span class="amount"><?= $coin . number_format($totlal_credit, 2) ?>
                                                            <!-- <span class="change down text-danger"><em class="icon ni ni-arrow-long-down"></em>16.93%</span> -->
                                                        </span>
                                                        <!-- <span class="sub-title">This Month</span> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- .col -->
                                <div class="col-lg-6  col-xxl-12">
                                    <div class="card card-bordered">
                                        <div class="card-inner">
                                            <div class="card-title-group align-start mb-2">
                                                <div class="card-title">
                                                    <h6 class="title">Total Debit</h6>
                                                </div>
                                                <div class="card-tools">
                                                    <em class="card-hint icon ni ni-help-fill" data-toggle="tooltip" data-placement="left" title="Total amount spent by your users"></em>
                                                </div>
                                            </div>
                                            <div class="align-end gy-3 gx-5 flex-wrap flex-md-nowrap flex-lg-wrap flex-xxl-nowrap">
                                                <div class="nk-sale-data-group flex-md-nowrap g-4">
                                                    <div class="nk-sale-data">
                                                        <span class="amount"><?= $coin . number_format($total_debit, 2) ?>
                                                            <!-- <span class="change down text-danger"><em class="icon ni ni-arrow-long-down"></em>16.93%</span> -->
                                                        </span>
                                                        <!-- <span class="sub-title">This Month</span> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- .col -->
                                <div class="col-lg-6  col-xxl-12">
                                    <div class="card card-bordered">
                                        <div class="card-inner">
                                            <div class="card-title-group align-start mb-2">
                                                <div class="card-title">
                                                    <h6 class="title">Total Users</h6>
                                                </div>
                                                <div class="card-tools">
                                                    <em class="card-hint icon ni ni-help-fill" data-toggle="tooltip" data-placement="left" title="Total amount credited by your users"></em>
                                                </div>
                                            </div>
                                            <div class="align-end gy-3 gx-5 flex-wrap flex-md-nowrap flex-lg-wrap flex-xxl-nowrap">
                                                <div class="nk-sale-data-group flex-md-nowrap g-4">
                                                    <div class="nk-sale-data">
                                                        <span class="amount"><?= count($stats->users) ?></span>
                                                        <span class="sub-title">(All Users)</span>
                                                    </div>
                                                    <div class="nk-sale-data">
                                                        <?php $active = array_filter($stats->users, function ($count) {
                                                            if ($count->status == 'active') return $count;
                                                        }) ?>
                                                        <span class="amount"><?= number_format(count($active)) ?> </span>
                                                        <span class="sub-title">(Active)</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- .col -->
                                <div class="col-lg-6 col-xxl-12">
                                    <div class="row g-gs">
                                        <div class="col-sm-6 col-lg-12 col-xxl-6">
                                            <div class="card card-bordered">
                                                <div class="card-inner">
                                                    <div class="card-title-group align-start mb-2">
                                                        <div class="card-title">
                                                            <h6 class="title">Wallet/Api Balance</h6>
                                                        </div>
                                                        <div class="card-tools">
                                                            <em class="card-hint icon ni ni-help-fill" data-toggle="tooltip" data-placement="left" title="Amounts Present in your api/external wallets"></em>
                                                        </div>
                                                    </div>
                                                    <div class="align-end gy-3 gx-5 flex-wrap flex-md-nowrap flex-lg-wrap flex-xxl-nowrap">
                                                        <div class="nk-sale-data-group flex-md-nowrap g-4">
                                                            <div class="nk-sale-data">
                                                                  <span class="amount"><?= $coin ?>
                                                                      <?=  $app->checkUserBalance() ?>
                                                                  </span>
                                                                <span class="sub-title">(Users Balance)</span>
                                                            </div>
                                                            <div class="nk-sale-data">
                                                                <span class="amount"><?= $coin ?><?= $app->checBalance('atg')->data->balance_formatted ?> </span>
                                                                <span class="sub-title">(Aim-To-Get)</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- .card -->
                                        </div><!-- .col -->
                                    </div><!-- .row -->
                                </div><!-- .col -->
                            </div><!-- .row -->
                        </div><!-- .col -->
                        <div class="col-xxl-8">
                            <div class="card card-bordered card-full">
                                <div class="card-inner">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title"><span class="mr-2">Recent Transactions</span> </h6>
                                        </div>
                                        <div class="card-tools">
                                            <a href="all-transactions" class="link d-sm-inline">See All</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-inner p-0 border-top">
                                    <div class="nk-tb-list nk-tb-orders">
                                        <div class="nk-tb-item nk-tb-head">
                                            <div class="nk-tb-col tb-col-md"><span>ID</span></div>
                                            <div class="nk-tb-col"><span>Customer Name</span></div>
                                            <div class="nk-tb-col tb-col-md"><span>Date/Time</span></div>
                                            <div class="nk-tb-col tb-col-lg"><span>Trans ID</span></div>
                                            <div class="nk-tb-col"><span>Amount</span></div>
                                            <div class="nk-tb-col"><span class="d-sm-inline">Status</span></div>
                                            <div class="nk-tb-col"><span>&nbsp;</span></div>
                                        </div>
                                        <?php $key = 0;
                                        foreach ($app->all_transaction(false) as $trans) :
                                            if ($key++ == 10) break;

                                            $user_name = '';
                                            $strName = '';
                                            foreach ($stats->users as $userss) {
                                                if ($trans->user_id == $userss->id) {
                                                    $user_name = $userss->fname . ' ' . $userss->lname;
                                                    $strName = strtoupper($userss->fname[0] . $userss->lname[0]);
                                                }
                                            }
                                        ?>
                                            <div class="nk-tb-item">
                                                <div class="nk-tb-col tb-col-md">
                                                    <span class="tb-lead"><a href="#">#<?= $trans->id ?></a></span>
                                                </div>
                                                <div class="nk-tb-col">
                                                    <div class="user-card">
                                                        <div class="user-avatar user-avatar-sm bg-purple">
                                                            <span><?= $strName ?></span>
                                                        </div>
                                                        <div class="user-name">
                                                            <span class="tb-lead"><?= $user_name ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="nk-tb-col tb-col-md">
                                                    <span class="tb-sub"><?= date("d/m/Y h:ia", strtotime($trans->date)) ?> </span>
                                                </div>
                                                <div class="nk-tb-col tb-col-lg">
                                                    <span class="tb-sub text-primary"><?= $trans->trans_id ?></span>
                                                </div>
                                                <div class="nk-tb-col">
                                                    <span class="tb-sub tb-amount"><?= number_format($trans->amount, 2) ?> <span>NGN</span></span>
                                                </div>
                                                <div class="nk-tb-col">
                                                    <?= ($trans->status == 'success') ? '<span class="badge badge-dot badge-dot-xs badge-success">Success</span>' : (($trans->status == 'pending') ? '<span class="badge badge-dot badge-dot-xs badge-warning">Pending</span>' : '<span class="badge badge-dot badge-dot-xs badge-danger">Canceled</span>') ?>
                                                </div>
                                                <div class="nk-tb-col nk-tb-col-action">
                                                    <div class="dropdown">
                                                        <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                                                            <ul class="link-list-plain">
                                                                <li><a href="view-transaction/<?=$trans->trans_id ?>">View</a></li>
                                                                <li><a href="#" onclick="print()">Print</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <div class="card-inner-sm border-top text-center d-sm-none">
                                    <a href="#" class="btn btn-link btn-block">See History</a>
                                </div>
                            </div><!-- .card -->
                        </div><!-- .col -->
                        <div class="col-md-6 col-xxl-4">
                            <div class="card card-bordered card-full">
                                <div class="card-inner border-bottom">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">Recent Activities</h6>
                                        </div>
                                        <div class="card-tools">
                                            <ul class="card-tools-nav">
                                                <li><a href="activities"><span>See All</span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <ul class="nk-activity">
                                    <?php $key = 0;
                                    foreach ($app->all_transactions(false) as $activity) :
                                        if ($key++ == 10) break;

                                        $user_name = '';
                                        $strName = '';
                                        $image = '';
                                        foreach ($stats->users as $userss) {
                                            if ($activity->user_id == $userss->id) {
                                                $user_name = $userss->fname . ' ' . $userss->lname;
                                                $strName = strtoupper($userss->fname[0] . $userss->lname[0]);
                                                $image = $userss->profilepic;
                                            }
                                        }
                                    ?>
                                        <li class="nk-activity-item">
                                            <div class="nk-activity-media user-avatar bg-success"><?php if ($image == '') : $strName;
                                            else : ?>
                                                    <img src="/account/assets/profilepics/<?= $image ?>" alt="">
                                                <?php endif; ?>
                                            </div>
                                            <div class="nk-activity-data">
                                                <div class="label"><?= '<b>' . $activity->title . '</b> by <b>' . $user_name . '</b>' ?></div>
                                                <span class="time"><?= date("M d, Y h:ia", strtotime($activity->createdAt)) ?></span>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div><!-- .card -->
                        </div><!-- .col -->
                        <div class="col-md-6 col-xxl-4">
                            <div class="card card-bordered card-full">
                                <div class="card-inner-group">
                                    <div class="card-inner">
                                        <div class="card-title-group">
                                            <div class="card-title">
                                                <h6 class="title">New Users</h6>
                                            </div>
                                            <div class="card-tools">
                                                <a href="manage-users" class="link">View All</a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $key = 0;
                                    ?>
                                    <?php foreach ($stats->users as $users) :
                                        if ($key++ == 10) break; ?>
                                        <div class="card-inner card-inner-md">
                                            <div class="user-card">
                                                <div class="user-avatar <?= ($users->email_verified == 1 && $users->type == 'user') ? 'bg-success-dim' : (($users->email_verified == 1 && $users->type == 'admin') ? 'bg-primary-dim' : 'bg-warning-dim') ?>">
                                                    <span><?= $users->fname[0] . $users->lname[0] ?></span>
                                                </div>
                                                <div class="user-info">
                                                    <span class="lead-text"><?= $users->fname . ' ' . $users->lname ?></span>
                                                    <span class="sub-text"><?= $users->email ?></span>
                                                </div>
                                                <div class="user-action">
                                                    <div class="drodown">
                                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger mr-n1" data-toggle="dropdown" aria-expanded="false"><em class="icon ni ni-more-h"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li><a href="#"><em class="icon ni ni-setting"></em><span>Action Settings</span></a></li>
                                                                <li><a href="#"><em class="icon ni ni-notify"></em><span>Push Notification</span></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div><!-- .card -->
                        </div><!-- .col -->
                    </div><!-- .row -->
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
</div>
<!-- content @e -->

<div class="modal fade" tabindex="-1" role="dialog" id="view-trans">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <a href="#cancel" data-dismiss="modal" class="close">
                    <em class="icon ni ni-cross-sm"></em>
                </a>
                <div class="nk-modal-head">
                    <h4 class="nk-modal-title title">Transaction <small class="text-primary id">#4947</small></h4>
                </div>
                <div class="nk-tnx-details mt-sm-3">
                    <div class="row gy-3">
                        <div class="col-lg-6">
                            <span class="sub-text">Trans ID</span><span class="caption-text trans_id">000000</span>
                        </div>
                        <div class="col-lg-6">
                            <span class="sub-text">Trans Title </span><span class="caption-text text-break trans_title">title</span>
                        </div>
                        <div class="col-lg-6">
                            <span class="sub-text">Trans Type</span><span class="caption-text trans_type">type</span>
                        </div>
                        <div class="col-lg-6">
                            <span class="sub-text">Payment Method</span><span class="caption-text trans_method">method</span>
                        </div>
                        <div class="col-lg-6">
                            <span class="sub-text">Amount</span><span class="caption-text trans_amount">0.00</span>
                        </div>
                        <div class="col-lg-6">
                            <span class="sub-text">User Balance</span><span class="caption-text trans_balance">0.00</span>
                        </div>
                        <div class="col-lg-6">
                            <span class="sub-text">Description</span><span class="caption-text trans_desc">desc</span>
                        </div>
                        <div class="col-lg-6">
                            <span class="sub-text">User Description</span><span class="caption-text user_desc"> desc</span>
                        </div>
                        <div class="col-lg-6">
                            <span class="sub-text">Status</span><span class="trans_status">Due</span>
                        </div>
                        <div class="col-lg-6">
                            <span class="sub-text">Date</span><span class="caption-text trans_date"> 10-13-2019</span>
                        </div>
                        <div class="col-lg-6">
                            <span class="sub-text">Dispute?</span><span class="caption-text dispute">dispute</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .modal-dialog -->
</div><!-- .modal -->

<script>
    function data(id) {
        var newData = [];
        newData.push(<?php echo json_encode($app->all_transaction()); ?>)
        newData = newData[0]

        // console.log(newData);
        newData = newData.filter(function(index) {
            if (index.id == id) {
                return index;
            }
        })

        newData.forEach(function(v) {
            $('.id').html('#' + v.id)
            $('.trans_id').html(v.trans_id)
            $('.trans_title').html(v.title)
            $('.trans_amount').html(number_format.format(v.amount))
            $('.trans_type').html(v.type)
            $('.trans_method').html(v.method)
            $('.trans_balance').html(number_format.format(v.balance))
            $('.trans_desc').html(v.description)
            $('.user_desc').html(v.text)
            $('.trans_status').html((v.status == 'success') ? '<span class="badge badge-success">Success</span>' : ((v.status == 'pending') ? '<span class="badge badge-warning">Pending</span>' : '<span class="badge badge-danger">Canceled</span>'))
            $('.dispute').html(v.dispute)
            $('.user_desc').html(v.text)
            $('.trans_date').html(new Date(v.date).toLocaleString('en-US', {
                timeZone: "Africa/Lagos"
            }))
        })

    }
</script>

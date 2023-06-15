<!-- content @s -->
<?php 
if ($user->type !== 'super-admin') return false;
$transactions = array_filter($app->all_transaction(false), function ($trans) {
    if ($trans->action === 'transit')
        return $trans;
}) ?>
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title"><?= $page ?></h3>
                            <div class="nk-block-des text-soft">
                                <p>You have total of <?= number_format((int)count($transactions)) ?> Transactions.</p>
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
                                <table class="nk-tb-list nk-tb-ulist table table-striped table-bordered table-hover data-table">
                                    <thead>
                                        <tr>
                                            <th class="nk-tb-col nk-tb-col-check tb-col-md">
                                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                                    <input type="checkbox" class="custom-control-input" id="uid">
                                                    <label class="custom-control-label" for="uid"></label>
                                                </div>
                                            </th>
                                            <th class="nk-tb-col"><span>ID</span></th>
                                            <th class="nk-tb-col"><span>Customer/Activity</span></th>
                                            <th class="nk-tb-col tb-col-md"><span>Date/Time</span></th>
                                            <th class="nk-tb-col tb-col-lg"><span>Trans ID</span></th>
                                            <th class="nk-tb-col"><span>Amount</span></th>
                                            <th class="nk-tb-col"><span class="d-sm-inline">Status</span></th>
                                            <th class="nk-tb-col"><span>&nbsp;</span></th>
                                        </tr>
                                    </thead><!-- .nk-tb-item -->

                                    <tbody>
                                        <?php foreach ($transactions as $trans) :
                                            $user_name = '';
                                            $strName = '';
                                            $image = '';
                                            foreach ($stats->users as $userss) {
                                                if ($trans->user_id == $userss->id) {
                                                    $user_name = $userss->fname . ' ' . $userss->lname;
                                                    $strName = strtoupper($userss->fname[0] . $userss->lname[0]);
                                                    $image = $userss->profilepic;
                                                }
                                            }
                                        ?>
                                            <tr class="nk-tb-item <?= $trans->trans_id ?>">
                                                <td class="nk-tb-col nk-tb-col-check tb-col-md">
                                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                                        <input type="checkbox" class="custom-control-input" id="uid1">
                                                        <label class="custom-control-label" for="uid1"></label>
                                                    </div>
                                                </td>
                                                <td class="nk-tb-col">
                                                    <span class="tb-amount"><?= $trans->id ?></span></span>
                                                </td>
                                                <td class="nk-tb-col">
                                                    <a href="view-transaction/<?= $trans->trans_id ?>">
                                                        <div class="user-card">
                                                            <div class="user-info">
                                                                <span class="tb-lead"><?= $trans->title ?> </span>
                                                                <span><?= $user_name ?></span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </td>
                                                <td class="nk-tb-col tb-col-lg">
                                                    <span><?= date("M d, Y h:ia", strtotime($trans->date)) ?></span>
                                                </td>
                                                <td class="nk-tb-col tb-col-md">
                                                    <span><?= $trans->trans_id ?></span>
                                                </td>
                                                <td class="nk-tb-col">
                                                    <span class="tb-amount"><?= $coin . number_format($trans->amount, 2) ?></span>
                                                </td>
                                                <td class="nk-tb-col">
                                                    <?= ($trans->status == 'success') ? '<span class="tb-status text-success">Success</span>' : (($trans->status == 'pending') ? '<span class="tb-status text-warning">Pending</span>' : '<span class="tb-status text-danger">Declined</span>') ?>
                                                </td>
                                                <td class="nk-tb-col nk-tb-col-tools">
                                                    <ul class="nk-tb-actions gx-1">
                                                        <li>
                                                            <div class="drodown">
                                                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <ul class="link-list-opt no-bdr">
                                                                        <li><a href="view-transaction/<?= $trans->trans_id ?>"><em class="icon ni ni-eye"></em><span>View</span></a></li>

                                                                        <!-- <?php if ($trans->status == 'pending') : ?>
                                                                            <li><a href="#" onclick="updated('<?= $trans->trans_id ?>', 'success')"><em class="icon ni ni-done"></em><span>Approved</span></a></li>
                                                                            <li><a href="#" onclick="updated('<?= $trans->trans_id ?>', 'cancelled', '<?= $trans->amount ?>', '<?= $trans->user_id ?>')"><em class="icon ni ni-cross-round"></em><span>Decline</span></a></li>
                                                                        <?php endif; ?> -->

                                                                        <li class="divider"></li>
                                                                        <li onclick="deleted('<?= $trans->trans_id ?>')"><a href="#"><em class="icon ni ni-trash "></em><span>Delete</span></a></li>
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
                            </div><!-- .card-inner -->
                        </div><!-- .card-inner-group -->
                    </div><!-- .card -->
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
</div>
<!-- content @e -->
<script type="text/javascript">
    function deleted(id) {
        // con = ;
        if (!confirm("Are you sure?")) {
            return false;
        }
        var thiss = $('.' + id);
        var trans_id = id;

        $.ajax({
            url: '/admin-cp/backend/user-actions?action=delete_trans',
            type: 'POST',
            dataType: "json",
            data: {
                edit_id: trans_id
            },
            cache: false,
            success: function(data) {
                if (data.code == 200) {
                    toastr["success"](data.msg);
                    $('.' + id).fadeOut();
                } else {
                    toastr["error"](data.msg);
                }
            }
        }).fail(function(error, msg) {
            console.log(error, msg);
        });
    }

    function updated(id, status, amount = 0, user_id = null) {
        event.preventDefault();

        amount = parseFloat(amount)

        if (!confirm("Are you sure?")) return false;
        $.ajax({
            url: '/admin-cp/backend/user-actions?action=update',
            type: 'POST',
            dataType: "json",
            data: {
                edit_id: id,
                status: status,
                amount: amount,
                id: user_id
            },
            cache: false,
            success: function(data) {
                if (data.code == 200) {
                    toastr["success"](data.msg);
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                } else {
                    toastr["error"](data.msg);
                    // alert(data.msg);
                }
            }
        }).fail(function(error, mgs) {
            console.log(error, mgs);
        })
    }
</script>
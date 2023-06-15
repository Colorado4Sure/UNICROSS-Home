<!-- content @s -->
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between g-3">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Crypto Transaction</h3>
                            <div class="nk-block-des text-soft">
                                <p>You have total of <?= number_format(count($app->crypto_transaction())) ?> orders.</p>
                            </div>
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="card card-bordered card-stretch">
                        <div class="card-inner-group">
                            <div class="card-inner">
                                <div class="card-title-group">
                                    <div class="card-title">
                                        <h5 class="title">All Orders</h5>
                                    </div>
                                    <div class="card-tools mr-n1">
                                    </div><!-- .card-tools -->
                                    <div class="card-search search-wrap" data-search="search">
                                        <div class="search-content">
                                            <a href="#" class="search-back btn btn-icon toggle-search" data-target="search"><em class="icon ni ni-arrow-left"></em></a>
                                            <input type="text" class="form-control border-transparent form-focus-none" placeholder="Quick search by transaction">
                                            <button class="search-submit btn btn-icon"><em class="icon ni ni-search"></em></button>
                                        </div>
                                    </div><!-- .card-search -->
                                </div><!-- .card-title-group -->
                            </div><!-- .card-inner -->
                            <div class="card-inner p-0">
                                <table class="nk-tb-list nk-tb-tnx table table-striped table-bordered table-hover data-table">
                                    <thead>
                                      <tr>
                                        <th class="nk-tb-col"><span>Details</span></th>
                                        <th class="nk-tb-col tb-col-lg"><span>Order</span></th>
                                        <th class="nk-tb-col text-right"><span>Amount</span></th>
                                        <th class="nk-tb-col text-right tb-col-sm"><span>Trans Hash</span></th>
                                        <th class="nk-tb-col nk-tb-col-status"><span class="sub-text d-none d-md-block">Status</span></th>
                                        <th class="nk-tb-col nk-tb-col-tools"></th>
                                      </tr>
                                    </thead><!-- .nk-tb-item -->
                                    <tbody>
                                    <?php
                                    $i = 0;
                                    foreach ($app->crypto_transaction() as $crypto): ?>

                                      <tr class="nk-tb-item <?=$crypto->trans_id ?>">
                                          <td class="nk-tb-col">
                                              <div class="nk-tnx-type">

                                                  <div class="nk-tnx-type-icon <?= ($crypto->status == 'success')? 'bg-success-dim text-success': (($crypto->status == 'pending')? 'bg-warning-dim text-warning': 'bg-danger-dim text-danger') ?> ">
                                                      <em class="icon ni ni-arrow-up-right"></em>
                                                  </div>
                                                  <div class="nk-tnx-type-text">
                                                      <span class="tb-lead"><?=$crypto->title ?></span>
                                                      <span class="tb-date"><?=date("d/m/Y h:i A", strtotime($crypto->date))?></span>
                                                  </div>
                                              </div>
                                          </td>
                                          <td class="nk-tb-col tb-col-lg">
                                              <span class="tb-lead-sub"><?= $crypto->trans_id ?></span>
                                              <span class="badge badge-dot <?= ($crypto->status == 'success')? 'badge-success': (($crypto->status == 'pending')? 'badge-warning': 'badge-danger') ?> "><?= ucfirst($crypto->type) ?></span>
                                          </td>
                                          <td class="nk-tb-col text-right">
                                              <span class="tb-amount"> <?= number_format($crypto->value, 9); ?> <span><?= strtoupper($crypto->coin_type) ?></span></span>
                                              <span class="tb-amount-sm">
                                                <?php if ($crypto->coin_type == 'ngn') {
                                                  echo strtoupper($coin);
                                                }else {
                                                  echo "$";
                                                } ?>
                                                <?= number_format((int)$crypto->amount, 2) ?></span>
                                          </td>
                                          <td class="nk-tb-col text-right tb-col-sm">
                                              <span class="tb-amount" title="<?=$crypto->trans_hash ?>" style="overflow: scroll; width: 140px; white-space: nowrap;"><?=$crypto->trans_hash ?></span>
                                          </td>
                                          <td class="nk-tb-col nk-tb-col-status">
                                              <div class="dot dot-success d-md-none"></div>
                                              <span class="badge badge-sm badge-dim <?= ($crypto->status == 'success')? 'badge-outline-success': (($crypto->status == 'pending')? 'badge-outline-warning': 'badge-outline-danger') ?>  d-none d-md-inline-flex"><?= ucfirst($crypto->status) ?></span>
                                          </td>
                                          <td class="nk-tb-col nk-tb-col-tools">
                                              <ul class="nk-tb-actions gx-2">
                                                  <li>
                                                      <div class="dropdown">
                                                          <a href="#" class="dropdown-toggle bg-white btn btn-sm btn-outline-light btn-icon" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                          <div class="dropdown-menu dropdown-menu-right">
                                                              <ul class="link-list-opt">

                                                                  <li><a href="#tranxDetails" data-toggle="modal" data-target="#view-trans" onclick="data('<?=$crypto->id ?>')"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                                <?php if ($crypto->status == 'pending'): ?>
                                                                    <li><a href="#" onclick="updated('<?=$crypto->trans_id ?>', 'success', '<?=$crypto->value ?>', '<?=$crypto->user_id ?>', '<?=$crypto->type ?>', '<?=$crypto->coin_type ?>')"><em class="icon ni ni-done"></em><span>Approve</span></a></li>
                                                                    <li><a href="#" onclick="updated('<?=$crypto->trans_id ?>', 'canceled', '<?=$crypto->value ?>', '<?=$crypto->user_id ?>', '<?=$crypto->type ?>', '<?=$crypto->coin_type ?>')"><em class="icon ni ni-cross-round"></em><span>Decline</span></a></li>
                                                                <?php endif; ?>
                                                                  <li><a href="#tranxDetails" onclick="deleted('<?=$crypto->trans_id ?>')"><em class="icon ni ni-trash"></em><span>Delete</span></a></li>
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

<div class="modal fade" tabindex="-1" role="dialog" id="view-trans">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <a href="#cancel"  data-dismiss="modal" class="close">
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
                  <span class="sub-text">Payment Method</span><span class="caption-text coin_type">Coin Type</span>
                </div>
                <div class="col-lg-6">
                  <span class="sub-text">Amount</span><span class="caption-text trans_amount">0.00</span>
                </div>
                <div class="col-lg-6">
                  <span class="sub-text">Value</span><span class="caption-text trans_value">0.00000000</span>
                </div>
                <div class="col-lg-6">
                  <span class="sub-text">Trans Hash</span><span class="caption-text trans_hash"> desc</span>
                </div>
                <div class="col-lg-6">
                  <span class="sub-text">Status</span><span class="trans_status">Due</span>
                </div>
                <div class="col-lg-6">
                  <span class="sub-text">Date</span><span class="caption-text trans_date"> 10-13-2019</span>
                </div>
                <div class="col-lg-6">
                  <span class="sub-text">Dispute?</span><span class="caption-text dispute">No</span>
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
  newData.push(<?php echo json_encode($app->crypto_transaction()); ?>)
  newData = newData[0]

  // console.log(newData);
  newData = newData.filter(function (index) {
    if (index.id == id) {
      return index;
    }
  })

  newData.forEach(function (v) {
    var number_format = ''
    if (v.coin_type == 'ngn') {
      number_format = new Intl.NumberFormat(undefined, {style: 'currency', currency: 'NGN',});
    }else {
      number_format = new Intl.NumberFormat(undefined, {style: 'currency', currency: 'USD',});
    }
    $('.id').html('#'+v.id)
    $('.trans_id').html(v.trans_id)
    $('.trans_title').html(v.title)
    $('.trans_amount').html(number_format.format(v.amount))
    $('.trans_type').html(v.type)
    $('.coin_type').html(v.coin_type.toUpperCase())
    $('.trans_value').html(parseFloat(v.value).toFixed(9) + ' '+ v.coin_type.toUpperCase())
    $('.trans_hash').html(v.trans_hash)
    $('.trans_status').html((v.status == 'success')? '<span class="badge badge-success">Success</span>' : ((v.status == 'pending')? '<span class="badge badge-warning">Pending</span>': '<span class="badge badge-danger">Canceled</span>'))
    $('.trans_date').html(new Date(v.date).toLocaleString('en-US', {timeZone: "Africa/Lagos"}))
  })

}

function deleted(id) {
  // con = ;
  if(!confirm("Are you sure?")){
    return false;
  }
  var thiss = $('.'+id);
  var trans_id = id;

  $.ajax({
    url: '/admin-cp/backend/user-actions?action=delete_crypto_trans',
    type: 'POST',
    dataType: "json",
    data: {edit_id: trans_id},
    cache: false,
    success : function(data){
      if(data.code == 200){
        toastr["success"](data.msg);
        $('.'+id).fadeOut();
      } else {
        toastr["error"](data.msg);
      }
    }
  }).fail(function (error, msg) {
    console.log(error, msg);
  });
}

function updated(id, status, amount = 0, user_id = null, trans_type = '', coin_type='') {
  event.preventDefault();

  amount = parseFloat(amount)

  let value;
  let chk = prompt("Please comfirm crypto value:", amount);
  if (value == null || value == "") {
    value = chk;
  } else {
    return false;
  }

  $.ajax({
      url: '/admin-cp/backend/user-actions?action=update_crypto',
      type: 'POST',
      dataType: "json",
      data: {
          edit_id: id,
          status: status,
          amount: value,
          id: user_id,
          trans_type: trans_type,
          coin_type: coin_type
      },
      cache: false,
      success: function(data) {
          if (data.code == 200) {
            toastr["success"](data.msg);
            setTimeout(function () {
              location.reload();
            }, 1000);
          } else {
            toastr["error"](data.msg);
              // alert(data.msg);
          }
      }
  }).fail(function (error, mgs) {
    console.log(error, mgs);
  })
}

</script>

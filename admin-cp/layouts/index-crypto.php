<!-- content @s -->
<?php
$data = array_filter($app->crypto_transaction(),function ($value) {
  if ($value->status == 'pending') return $value;
});

$buy_order = array_filter($app->crypto_transaction(),function ($value) {
  if ($value->type == 'credit') return $value;
});

$sell_order = array_filter($app->crypto_transaction(),function ($value) {
  if ($value->type == 'debit') return $value;
});

$total_buy_order = 0;
$total_sell_order = 0;
foreach ($buy_order as $buy) {
  if ($buy->coin_type == 'ngn')
    $total_buy_order += ($buy->amount/$app->settings()->usd_rate);
  else
    $total_buy_order += $buy->amount;
}

foreach ($sell_order as $buy) {
  if ($buy->coin_type == 'ngn')
    $total_sell_order += ($buy->amount/$app->settings()->usd_rate);
  else
    $total_sell_order += $buy->amount;
}
// var_dump($total_buy_order);
$debit = 0;
$credit = 0;
foreach ($data as $status) {
  if ($status->type == 'credit') $credit++;
  if ($status->type == 'debit') $debit ++;
}

// var_dump($app->settings())
 ?>
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Overview</h3>
                            <div class="nk-block-des text-soft">
                                <p>Welcome to Crypto Buy/Sell Platform.</p>
                            </div>
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="row g-gs">
                        <div class="col-lg-8">
                            <div class="card card-bordered h-100">
                                <div class="card-inner">
                                    <div class="card-title-group align-start mb-3">
                                        <div class="card-title">
                                            <h6 class="title">Orders Overview</h6>
                                            <p>Amount here depends on your site USD rate.
                                              <!-- <a href="#" class="link link-sm">Detailed Stats</a> -->
                                            </p>
                                        </div>
                                        <!-- <div class="card-tools mt-n1 mr-n1">
                                            <div class="drodown">
                                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                    <ul class="link-list-opt no-bdr">
                                                        <li><a href="#" class="active"><span>15 Days</span></a></li>
                                                        <li><a href="#"><span>30 Days</span></a></li>
                                                        <li><a href="#"><span>3 Months</span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div> -->
                                    </div><!-- .card-title-group -->
                                    <div class="nk-order-ovwg">
                                        <div class="row g-4 align-end">
                                            <div class="col-xxl-4">
                                                <div class="row g-4">
                                                    <div class="col-sm-6 col-xxl-12">
                                                        <div class="nk-order-ovwg-data buy">
                                                            <div class="amount"><?= number_format($total_buy_order, 2) ?> <small class="currenct currency-usd">USD</small></div>
                                                            <!-- <div class="info">Last month <strong>39,485 <span class="currenct currency-usd">USD</span></strong></div> -->
                                                            <div class="title"><em class="icon ni ni-arrow-down-left"></em> Buy Orders</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 col-xxl-12">
                                                        <div class="nk-order-ovwg-data sell">
                                                            <div class="amount"><?= number_format($total_sell_order, 2) ?> <small class="currenct currency-usd">USD</small></div>
                                                            <!-- <div class="info">Last month <strong>39,485 <span class="currenct currency-usd">USD</span></strong></div> -->
                                                            <div class="title"><em class="icon ni ni-arrow-up-left"></em> Sell Orders</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- .col -->
                                        </div>
                                    </div><!-- .nk-order-ovwg -->
                                </div><!-- .card-inner -->
                            </div><!-- .card -->
                        </div><!-- .col -->
                        <div class="col-lg-4">
                            <div class="card card-bordered h-100">
                                <div class="card-inner-group">
                                    <div class="card-inner card-inner-md">
                                        <div class="card-title-group">
                                            <div class="card-title">
                                                <h6 class="title">Action Center</h6>
                                            </div>
                                            <div class="card-tools mr-n1">
                                                <div class="drodown">
                                                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <ul class="link-list-opt no-bdr">
                                                            <li><a href="#"><em class="icon ni ni-setting"></em><span>Action Settings</span></a></li>
                                                            <li><a href="#"><em class="icon ni ni-notify"></em><span>Push Notification</span></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- .card-inner -->
                                    <div class="card-inner">
                                        <div class="nk-wg-action">
                                            <div class="nk-wg-action-content">
                                                <em class="icon ni ni-cc-alt-fill"></em>
                                                <div class="title">Pending Buy/Sell Orders</div>
                                                <p>We have still <strong><?=$credit ?> Buy orders</strong> and <strong><?=$debit ?> Sell orders</strong>, thats need to review & take necessary action.</p>
                                            </div>
                                            <a href="/admin-cp/crypto-transaction" class="btn btn-icon btn-trigger mr-n2"><em class="icon ni ni-forward-ios"></em></a>
                                        </div>
                                    </div><!-- .card-inner -->
                                </div><!-- .card-inner-group -->
                            </div><!-- .card -->
                        </div><!-- .col -->
                        <div class="col-lg-8">
                            <div class="card card-bordered card-full">
                                <div class="card-inner">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title"><span class="mr-2">Orders Activities</span> <a href="/admin-cp/crypto-transaction" class="link d-none d-sm-inline">See All History</a></h6>
                                        </div>
                                        <div class="card-tools">
                                            <ul class="card-tools-nav">
                                                <li><a href="#"><span>Buy</span></a></li>
                                                <li><a href="#"><span>Sell</span></a></li>
                                                <li class="active"><a href="#"><span>All</span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div><!-- .card-inner -->
                                <div class="card-inner p-0 border-top">
                                    <div class="nk-tb-list nk-tb-orders">
                                        <div class="nk-tb-item nk-tb-head">
                                            <div class="nk-tb-col nk-tb-orders-type"><span>Type</span></div>
                                            <div class="nk-tb-col"><span>Desc</span></div>
                                            <div class="nk-tb-col tb-col-sm"><span>Date</span></div>
                                            <div class="nk-tb-col tb-col-xl"><span>Time</span></div>
                                            <div class="nk-tb-col tb-col-xxl"><span>Ref</span></div>
                                            <div class="nk-tb-col tb-col-sm text-right"><span>USD Amount</span></div>
                                            <div class="nk-tb-col text-right"><span>Amount</span></div>
                                        </div><!-- .nk-tb-item -->
                                        <?php //var_dump($app->crypto_transaction()) ?>
                                        <?php $i = 0; foreach ($app->crypto_transaction() as $crypto):
                                          if ($i++ == 7) break;
                                          ?>
                                          <div class="nk-tb-item">
                                              <div class="nk-tb-col nk-tb-orders-type">
                                                  <ul class="icon-overlap">
                                                      <?php if($crypto->coin_type == 'btc') echo '<li><em class="bg-btc-dim icon-circle icon ni ni-sign-btc"></em></li>'; ?>
                                                      <?php if($crypto->coin_type == 'eth') echo '<li><em class="bg-eth-dim icon-circle icon ni ni-sign-eth"></em></li>'; ?>
                                                      <?php if($crypto->coin_type == 'usdt') echo '<li><em class="bg-success-dim icon-circle icon ni ni-sign-usdt"></em></li>'; ?>
                                                      <?php if($crypto->coin_type == 'ngn') echo '<li><em class="bg-secondary icon-circle icon ni ni-sign-kobo"></em></li>'; ?>
                                                    <!-- <Icon name="sign-usdt-alt"> -->

                                                      <li><em class="bg-success-dim icon-circle icon ni ni-arrow-down-left"></em></li>
                                                  </ul>
                                              </div>
                                              <div class="nk-tb-col">
                                                  <span class="tb-lead"><?=$crypto->title ?></span>
                                              </div>
                                              <div class="nk-tb-col tb-col-sm">
                                                  <span class="tb-sub"><?=date("d/m/Y", strtotime($crypto->date))?></span>
                                              </div>
                                              <div class="nk-tb-col tb-col-xl">
                                                  <span class="tb-sub"><?=date("h:i A", strtotime($crypto->date))?></span>
                                              </div>
                                              <div class="nk-tb-col tb-col-sm text-right">
                                                <span class="tb-sub tb-amount">
                                                  <span>
                                                    <?php if ($crypto->coin_type == 'ngn') {
                                                      echo strtoupper($coin);
                                                    }else {
                                                      echo "$";
                                                    } ?></span><?=number_format($crypto->amount, 2) ?> </span>

                                              </div>
                                              <div class="nk-tb-col text-right">
                                                  <span class="tb-sub tb-amount ">
                                                    <?php
                                                    $val = number_format($crypto->value, 9);
                                                     if ($crypto->coin_type == 'ngn' || $crypto->coin_type == 'usdt') {
                                                      $val = number_format($crypto->value, 2);
                                                    } ?>

                                                    <?= $val ?> <span><?= strtoupper($crypto->coin_type) ?></span></span>
                                              </div>
                                          </div><!-- .nk-tb-item -->
                                        <?php endforeach; ?>
                                    </div>
                                </div><!-- .card-inner -->
                                <div class="card-inner-sm border-top text-center d-sm-none">
                                    <a href="#" class="btn btn-link btn-block">See History</a>
                                </div><!-- .card-inner -->
                            </div><!-- .card -->
                        </div><!-- .col -->
                        <div class="col-lg-4">
                            <div class="row g-gs">
                                <div class="col-md-6 col-lg-12">
                                    <div class="card card-bordered card-full">
                                        <div class="card-inner">
                                            <div class="card-title-group align-start mb-2">
                                                <div class="card-title">
                                                    <h6 class="title">Top Coin in Orders</h6>
                                                    <!-- <p>In last 15 days buy and sells overview.</p> -->
                                                </div>
                                                <!-- <div class="card-tools mt-n1 mr-n1">
                                                    <div class="drodown">
                                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li><a href="#" class="active"><span>15 Days</span></a></li>
                                                                <li><a href="#"><span>30 Days</span></a></li>
                                                                <li><a href="#"><span>3 Months</span></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div> -->
                                            </div><!-- .card-title-group -->
                                            <div class="nk-coin-ovwg">
                                                <div class="nk-coin-ovwg-ck">
                                                    <canvas class="coin-overview-chart" id="coinOverview"></canvas>
                                                </div>
                                                <ul class="nk-coin-ovwg-legends">
                                                    <li><span class="dot dot-lg sq" data-bg="#f98c45"></span><span>Bitcoin</span></li>
                                                    <li><span class="dot dot-lg sq" data-bg="#9cabff"></span><span>Ethereum</span></li>
                                                    <li><span class="dot dot-lg sq" data-bg="#8feac5"></span><span>TeterUS</span></li>
                                                </ul>
                                            </div><!-- .nk-coin-ovwg -->
                                        </div><!-- .card-inner -->
                                    </div><!-- .card -->
                                </div><!-- .col -->
                            </div><!-- .row -->
                        </div><!-- .col -->
                    </div><!-- .row -->
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
</div>
<!-- content @e -->

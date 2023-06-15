
<body class="bg-white">
    <!-- App Header -->
    <div class="appHeader">
        <div class="left">
            <a href="#" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">
            <?= $page; ?>
        </div>
    </div>
    <!-- * App Header -->

    <!-- App Capsule -->
    <div id="appCapsule" class="full-height">
      <?php if (!isset($_GET['trans_id'])){
        include 'layout/app-404.phtml';
        die();
        }

        $trans_id = $_GET['trans_id'];
        $trans = $app->crypto_txn_history($trans_id);

        if ($trans->status !== true) {
          ?>
          <div class="listed-detail mt-3">
              <h3 class="text-center mt-2"><?= ucwords($trans->message); ?></h3>
          </div>

          <?php
        }else {
        //
          // print_r($trans);
          ?>
        <div class="section mt-2 mb-2">

            <div class="listed-detail mt-3">
                <div class="icon-wrapper">
                    <div class="iconbox">
                      <?= ($trans->data->type == 'credit')? '<ion-icon name="arrow-down-outline"></ion-icon>': '<ion-icon name="swap-vertical-outline"></ion-icon>' ?>
                    </div>
                </div>
                <h3 class="text-center mt-2"><?= ucwords($trans->data->title); ?></h3>
            </div>

            <ul class="listview flush transparent simple-listview no-space mt-3" style="padding: 10px;">
                <li>
                    <strong>Status</strong>
                    <?= ($trans->data->status == 'success')? '<span class="text-success">Completed</span>' : (($trans->data->status == 'pending')? '<span class="text-warning">Pending Confirmation</span>' : '<span class="text-danger">'.$trans->data->status.'</span>') ?>
                </li>
                <li>
                    <strong>Coin Type</strong>
                    <span><?= mb_strtoupper($trans->data->coin_type); ?></span>
                </li>
                <li>
                    <strong>Transaction Type</strong>
                    <span><?= ucwords($trans->data->type); ?></span>
                </li>
                <li>
                    <strong>Amount</strong>
                    <h3 class="m-0">$<?=number_format($trans->data->amount, 2); ?></h3>
                </li>
                <li>
                    <strong>Coin Value.: </strong>
                    <span><?= number_format($trans->data->value, 8). ' '.mb_strtoupper($trans->data->coin_type); ?></span>
                </li>
                <li>
                    <strong>Txn ID:</strong>
                    <span><?= $trans->data->trans_id; ?></span>
                </li>
                <li>
                    <strong>Trans Ref: </strong>
                    <span style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?= $trans->data->trans_hash; ?></span>
                </li>

                <li>
                    <strong>Date</strong>
                    <span><?= date_format(date_create($trans->data->date), "M d, Y g:i:s A"); ?></span>
                </li>
            </ul>

        </div>
        <?php
          // code...
        } ?>
    </div>
    <!-- * App Capsule -->

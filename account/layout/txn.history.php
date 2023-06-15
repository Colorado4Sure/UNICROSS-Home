
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
        <!-- <div class="right">
            <a href="#" class="headerButton" data-bs-toggle="modal" data-bs-target="#DialogBasic">
                <ion-icon name="trash-outline"></ion-icon>
            </a>
        </div> -->
    </div>
    <!-- * App Header -->

    <!-- Dialog Basic -->
    <!-- <div class="modal fade dialogbox" id="DialogBasic" data-bs-backdrop="static" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete</h5>
                </div>
                <div class="modal-body">
                    Are you sure?
                </div>
                <div class="modal-footer">
                    <div class="btn-inline">
                        <a href="#" class="btn btn-text-secondary" data-bs-dismiss="modal">CANCEL</a>
                        <a href="#" class="btn btn-text-primary" data-bs-dismiss="modal">DELETE</a>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- * Dialog Basic -->

    <!-- App Capsule -->
    <div id="appCapsule" class="full-height">
      <?php if (!isset($_GET['trans_id'])){
        include 'layout/app-404.phtml';
        die();
        }

        $trans_id = $_GET['trans_id'];
        $trans = $app->txn_history($trans_id);

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
                      <?php if ($trans->data->type === 'deposit'): ?>
                        <ion-icon name="arrow-down-outline"></ion-icon>
                      <?php
                      else: ?>
                        <ion-icon name="arrow-forward-outline"></ion-icon>
                      <?php
                      endif; ?>
                    </div>
                </div>
                <h3 class="text-center mt-2"><?= ucwords($trans->data->title); ?></h3>
            </div>

            <ul class="listview flush transparent simple-listview no-space mt-3">
                <li>
                    <strong>Status</strong>
                    <?= ($trans->data->status == 'success')? '<span class="text-success">'.$trans->data->status.'</span>' : (($trans->data->status == 'pending')? '<span class="text-warning">'.$trans->data->status.'</span>' : '<span class="text-danger">'.$trans->data->status.'</span>') ?>
                </li>
                <li>
                    <strong>Payment Method</strong>
                    <span><?= ucwords($trans->data->method); ?></span>
                </li>
                <li>
                    <strong>Transaction Type</strong>
                    <span><?= ucwords($trans->data->type); ?></span>
                </li>
                <li>
                    <strong>Txn ID:</strong>
                    <span><?= $trans->data->trans_id; ?></span>
                </li>
                <li>
                    <strong>Txn Desc.: </strong>
                    <span><?= $trans->data->text; ?></span>
                </li>
                <li>
                    <strong>Date</strong>
                    <span><?= date_format(date_create($trans->data->date), "M d, Y g:i:s A"); ?></span>
                </li>
                <li>
                    <strong>Amount</strong>
                    <h3 class="m-0"><?= $coin. ' '.number_format($trans->data->amount, 2); ?></h3>
                </li>
                <li>
                    <strong>Balance</strong>
                    <span><?= $coin. ' '.number_format($trans->data->balance, 2); ?></span>
                </li>
                <li>
                    <strong>Details: </strong>
                    <span><?= $trans->data->description; ?></span>
                </li>
            </ul>


        </div>
        <?php
          // code...
        } ?>
    </div>
    <!-- * App Capsule -->

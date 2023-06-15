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
        <div class="right">
            <a href="#" class="headerButton" data-bs-toggle="modal" data-bs-target="#DialogBasic">
                <ion-icon name="trash-outline"></ion-icon>
            </a>
        </div>
    </div>
    <!-- * App Header -->

    <!-- Dialog Basic -->
    <div class="modal fade dialogbox" id="DialogBasic" data-bs-backdrop="static" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Notification</h5>
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
    </div>
    <!-- * Dialog Basic -->

    <!-- App Capsule -->
    <div id="appCapsule" class="full-height">
      <?php if (!isset($_GET['trans_id'])){
        include 'layout/app-404.phtml';
        die();
        }

        $trans_id = $_GET['trans_id'];
        $trans = $app->notify_history($trans_id);
        $notify = $trans->data;

        if ($trans->status !== true) {
          ?>
          <div class="listed-detail mt-3">
              <h3 class="text-center mt-2"><?= ucwords($trans->message); ?></h3>
          </div>

          <?php
        }else {
          ?>
        <!-- <div class="section"> -->

            <div class="listed-detail mt-3">
                <div class="icon-wrapper">
                    <div class="iconbox">
                      <?php if ($notify->type == 'password'): ?>
                            <ion-icon name="key-outline"></ion-icon>
                      <?php elseif ($notify->type == 'debit'): ?>
                            <ion-icon name="arrow-forward-outline"></ion-icon>
                      <?php elseif ($notify->type == 'message'): ?>
                            <ion-icon name="chatbubble-outline"></ion-icon>
                        <?php else: ?>
                              <ion-icon name="arrow-down-outline"></ion-icon>
                      <?php endif; ?>
                        <!-- <ion-icon name="arrow-down-outline"></ion-icon> -->
                    </div>
                </div>
                <h3 class="text-center mt-2"><?= $notify->title; ?></h3>
            </div>

            <ul class="listview simple-listview no-space mt-3" style="padding: 0px 10px;">
                <li>
                    <span>Title</span>
                    <strong><?= $notify->title ?></strong>
                </li>
                <li>
                    <span>Description</span>
                    <strong><?= $notify->activity; ?></strong>
                </li>
                <li>
                    <span>Date</span>
                    <strong><?php $date = new DateTime($notify->date); $date = $date->format('M d, Y h:i A'); ?>
                    <?= $date;?></strong>
                </li>
                <!-- <li>
                    <span>Amount</span>
                    <strong>$ 50</strong>
                </li> -->
            </ul>


        <!-- </div> -->
    <?php } ?>
    </div>
    <!-- * App Capsule -->

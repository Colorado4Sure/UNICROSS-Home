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
            <a href="#" class="headerButton" onclick="toastbox('toast-example-1', 3000)">
                <ion-icon name="notifications-off-outline"></ion-icon>
            </a>
        </div>
    </div>
    <!-- * App Header -->

    <!-- toast bottom iconed -->
    <div id="toast-example-1" class="toast-box toast-bottom bg-primary">
        <div class="in">
            <ion-icon name="notifications-off-outline"></ion-icon>
            <div class="text">
                Notification sounds have been muted
            </div>
        </div>
        <button type="button" class="btn btn-sm btn-text-light close-button">OK</button>
    </div>
    <!-- * toast bottom iconed -->

    <!-- App Capsule -->
    <div id="appCapsule">

        <div class="section full">

            <ul class="listview image-listview flush">
              <?php
              $activity = $app->notification()['data'];
              $i = 0;
               ?>

               <?php foreach ($activity as $notify):
                 if ($i++ == 20) break;
                 $status = ($notify['is_read'] == 1)? 'active': '';

                 ?>
                   <li class="<?= $status ?>">
                       <a href="notification-details?trans_id=<?= $notify['trans_id']; ?>" class="item">
                         <?php if ($notify['type'] == 'password'): ?>
                           <div class="icon-box bg-danger">
                               <ion-icon name="key-outline"></ion-icon>
                           </div>
                         <?php elseif ($notify['type'] == 'debit'): ?>
                           <div class="icon-box bg-success">
                               <ion-icon name="arrow-forward-outline"></ion-icon>
                           </div>
                         <?php elseif ($notify['type'] == 'message'): ?>
                           <div class="icon-box bg-warning">
                               <ion-icon name="chatbubble-outline"></ion-icon>
                           </div>
                           <?php else: ?>
                             <div class="icon-box bg-primary">
                                 <ion-icon name="arrow-down-outline"></ion-icon>
                             </div>
                         <?php endif; ?>

                           <div class="in">
                               <div>
                                   <div class="mb-05"><strong><?= $notify['title'] ?></strong></div>
                                   <div class="text-small mb-05"><?= $notify['activity'] ?></div>
                                   <div class="text-xsmall">
                                     <?php $date = new DateTime($notify['date']); $date = $date->format('d/m/Y h:i A'); ?>
                                     <?= $date;?></div>
                               </div>
                               <?= ($notify['is_read'] == 1)? '<span class="badge badge-primary badge-empty"></span>': ''; ?>
                           </div>
                       </a>
                   </li>
               <?php endforeach; ?>
            </ul>

        </div>

    </div>
    <!-- * App Capsule -->

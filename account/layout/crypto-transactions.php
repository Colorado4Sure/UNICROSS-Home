    <!-- App Capsule -->
    <div id="appCapsule">

        <!-- Today -->
        <div class="section mt-2">
          <?php

          $history = $app->crypto_history()['data']['rows'];

          function group_by($key, $data) {
              $result = array();

              foreach($data as $val) {
                  if(array_key_exists($key, $val)){
                    $val['date'] = new DateTime($val['date']); $val['date'] = $val['date']->format('d-m-Y');
                      $result[$val[$key]][] = $val;
                  }else{
                      $result[""][] = $val;
                  }
              }

              return $result;
          }

          // Group data by the "gender" key
          $byGroup = group_by("date", $history);

          // Dump result
          // echo "<pre>" . var_export($byGroup, true) . "</pre>";
          $i = 0;
          foreach ($byGroup as $key => $value) {
            // if ($i++ == 5) {
            //   break;
            // }
            $date = new DateTime($key); $time = $date->format('g:i A'); $date = $date->format('M d, Y');
            $yesterday = date('d-m-Y', strtotime("yesterday"));
            $thisWeek = date('d-m-Y', strtotime('-1 week monday 00:00:00'));

            if ($key == date('d-m-Y')) {
                echo '<div class="section-title">Today</div>';
                ?>
                <div class="card">
                  <ul class="listview flush transparent no-line image-listview detailed-list mt-1 mb-1">
                  <?php
                foreach ($value as $hist) {?>
                    <!-- item -->
                    <li>
                        <a href="crypto-history?trans_id=<?= $hist['trans_id']; ?>" class="item">
                            <div class="icon-box <?=($hist['status'] == 'success')? 'bg-success': (($hist['status'] == 'pending')? 'bg-warning': 'bg-danger' ) ?>">
                                <?= ($hist['type'] == 'credit')? '<ion-icon name="arrow-down-outline"></ion-icon>': (($hist['type'] == 'debit')? '<ion-icon name="arrow-up-outline"></ion-icon>' : '<ion-icon name="swap-vertical-outline"></ion-icon>') ?>
                            </div>
                            <div class="in">
                                <div>
                                    <strong><?= ($hist['coin_type'] == 'btc')? 'Bitcoin': (($hist['coin_type'] == 'eth')? 'Ethereum': 'TetherUS') ?></strong>
                                    <div class="text-small text-secondary"><?= ($hist['type'] == 'credit')? 'Deposit': (($hist['type'] == 'debit')? 'Withdraw' : 'Swap') ?></div>
                                </div>
                                <div class="text-end">
                                    <strong>$<?=number_format($hist['amount'],2) ?></strong>
                                    <div class="text-small">
                                      <?= number_format($hist['value'], 8); ?>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>
                    <!-- * item -->
        <!-- * Today -->
      <?php }
      ?>
    </ul>

      </div>
    </div>
      <?php
    }else if ($key == $yesterday) { ?>
        <!-- This Week -->
        <div class="section mt-2">
            <div class="section-title">Yesterday</div>
            <div class="card">
                <ul class="listview flush transparent no-line image-listview detailed-list mt-1 mb-1">
                  <?php foreach ($value as $hist): ?>
                    <li>
                        <a href="crypto-history?trans_id=<?= $hist['trans_id']; ?>" class="item">
                            <div class="icon-box <?=($hist['status'] == 'success')? 'bg-success': (($hist['status'] == 'pending')? 'bg-warning': 'bg-danger' ) ?>">
                                <?= ($hist['type'] == 'credit')? '<ion-icon name="arrow-down-outline"></ion-icon>': (($hist['type'] == 'debit')? '<ion-icon name="arrow-up-outline"></ion-icon>' : '<ion-icon name="swap-vertical-outline"></ion-icon>') ?>
                            </div>
                            <div class="in">
                                <div>
                                    <strong><?= ($hist['coin_type'] == 'btc')? 'Bitcoin': (($hist['coin_type'] == 'eth')? 'Ethereum': 'TetherUS') ?></strong>
                                    <div class="text-small text-secondary"><?= ($hist['type'] == 'credit')? 'Deposit': (($hist['type'] == 'debit')? 'Withdraw' : 'Swap') ?></div>
                                </div>
                                <div class="text-end">
                                    <strong>$<?=number_format($hist['amount'],2) ?></strong>
                                    <div class="text-small">
                                      <?= number_format($hist['value'], 8); ?>
                                        <!-- Today 11:38 AM -->
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>
                  <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <!-- * This Week -->
      <?php }else {
        ?>
          <!-- December -->
          <div class="section mt-2">
              <div class="section-title"><?=$date ?></div>
              <div class="card">
                  <ul class="listview flush transparent no-line image-listview detailed-list mt-1 mb-1 ">
                    <?php foreach ($value as $hist): ?>
                      <li>
                          <a href="crypto-history?trans_id=<?= $hist['trans_id']; ?>" class="item">
                              <div class="icon-box <?=($hist['status'] == 'success')? 'bg-success': (($hist['status'] == 'pending')? 'bg-warning': 'bg-danger' ) ?>">
                                  <?= ($hist['type'] == 'credit')? '<ion-icon name="arrow-down-outline"></ion-icon>': (($hist['type'] == 'debit')? '<ion-icon name="arrow-up-outline"></ion-icon>' : '<ion-icon name="swap-vertical-outline"></ion-icon>') ?>
                              </div>
                              <div class="in">
                                  <div>
                                      <strong><?= ($hist['coin_type'] == 'btc')? 'Bitcoin': (($hist['coin_type'] == 'eth')? 'Ethereum': 'TetherUS') ?></strong>
                                      <div class="text-small text-secondary"><?= ($hist['type'] == 'credit')? 'Deposit': (($hist['type'] == 'debit')? 'Withdraw' : 'Swap') ?></div>
                                  </div>
                                  <div class="text-end">
                                      <strong>$<?=number_format($hist['amount'],2) ?></strong>
                                      <div class="text-small">
                                        <?= number_format($hist['value'], 8); ?>
                                          <!-- Today 11:38 AM -->
                                      </div>
                                  </div>
                              </div>
                          </a>
                      </li>
                    <?php endforeach; ?>
                  </ul>
              </div>
          </div>
          <!-- * December -->

        <?php } ?>
      <?php } ?>
      <!-- </div> -->

      <div class="section mt-2 older" style="display: none;">
          <div class="section-title">Older Transactions</div>
          <div class="card">
              <ul class="listview flush transparent no-line image-listview detailed-list mt-1 mb-1 mainSection">
              </ul>
          </div>
      </div>

        <?php if ($app->crypto_history()['data']['count']/10 > 1): ?>
         <div class="section mt-3 mb-3 pagination">
             <a href="#" class="btn btn-lg btn-block btn-primary loadMore">Load More</a>
         </div>
        <?php endif; ?>

        <style>
          .appBottomMenu {
            display: none!important;
          }
        </style>
    </div>
    <!-- * App Capsule -->

    <script>
    let loadMore = document.querySelector(".loadMore");
    let countClicks = 0;

    loadMore.addEventListener("click", function() {
      $(this).html('<div class="spinner-border text-dark" role="status"></div>')
      $(this).addClass("disabled");
      countClicks += 1;

      $.ajax({
        url: '<?=$siteurl?>trans/page',
        type: 'POST',
        dataType: "json",
        data: {
          page: countClicks,
          source: 'crypto-trans'
        },
        cache: false,
        success : function(data){
          if(data.status == true){
            $('.older').css('display', 'block');
            $('.loadMore').html('Load More')
            $('.loadMore').removeClass("disabled");

            if (countClicks > parseInt(data.data.count/10) ) {
              $('.pagination').remove()
            }

            $(data.data.rows).each(function(index, item){
              console.log(item);
                let bg = (item.status == 'success')? 'bg-success': ((item.status == 'pending')? 'bg-warning': 'bg-danger' );

                let icon = (item.type == 'credit')? '<ion-icon name="arrow-down-outline"></ion-icon>': ((item.type == 'debit')? '<ion-icon name="arrow-up-outline"></ion-icon>' : '<ion-icon name="swap-vertical-outline"></ion-icon>');

                let coin = (item.coin_type == 'btc')? 'Bitcoin': ((item.coin_type == 'eth')? 'Ethereum': 'TetherUS');

                let label = (item.type == 'credit')? 'Deposit': ((item.type == 'debit')? 'Withdraw' : 'Swap');

              $('.mainSection').append( `<li>
                  <a href="crypto-history?trans_id=${item.trans_id}" class="item">
                      <div class="icon-box ${bg}">
                          ${icon}
                      </div>
                      <div class="in">
                          <div>
                              <strong>${coin}</strong>
                              <div class="text-small text-secondary">${label}</div>
                          </div>
                          <div class="text-end">
                              <strong>${item.amount.toLocaleString()}</strong>
                              <div class="text-small">
                                ${parseFloat(item.value).toFixed(8)}
                              </div>
                          </div>
                      </div>
                  </a>
              </li>`)
            });
          } else {
              $('.loadMore').html('Load More')
              $('.loadMore').removeClass("disabled");
          }
        }
      }).fail(function (error, msg) {
        console.log(error, msg);
      });

    });
    </script>

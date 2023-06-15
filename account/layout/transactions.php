<body>
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
            <a href="notifications" class="headerButton">
                <ion-icon class="icon" name="notifications-outline"></ion-icon>
                <span class="badge badge-danger">4</span>
            </a>
        </div> -->
  </div>
  <!-- * App Header -->


  <!-- App Capsule -->
  <div id="appCapsule">
    <!-- Stats -->
    <div class="section">
      <div class="row mt-2">
        <?php
        $spend = 0;
        $income = 0;
        foreach ($app->history()['data']['rows'] as $history) {
          if ($history['status'] === 'success') {
            if ($history['type'] !== 'credit') {
              $spend += $history['amount'];
            } else {
              $income += $history['amount'];
            }
          }
        } ?>
        <div class="col-6">
          <div class="stat-box">
            <div class="title">Money In</div>
            <div class="value text-success"><?= $coin . ' ' . number_format($income, 2); ?></div>
          </div>
        </div>
        <div class="col-6">
          <div class="stat-box">
            <div class="title">Money Out</div>
            <div class="value text-danger"><?= $coin . ' ' . number_format($spend, 2); ?></div>
          </div>
        </div>
      </div>
    </div>
    <!-- * Stats -->
    <span class="divider"></span>
    <!-- Transactions -->
    <div class="section mt-2">
      <?php

      $history = $app->history()['data']['rows'];

      function group_by($key, $data)
      {
        $result = array();

        foreach ($data as $val) {
          if (array_key_exists($key, $val)) {
            $val['date'] = new DateTime($val['date']);
            $val['date'] = $val['date']->format('d-m-Y');
            $result[$val[$key]][] = $val;
          } else {
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
        if ($i++ == 5) {
          break;
        }
        $date = new DateTime($key);
        $date = $date->format('M d, Y');
        $yesterday = date('d-m-Y', strtotime("yesterday"));

        if ($key == date('d-m-Y')) {
          echo '<div class="section-title">Today</div>';
          echo '<div class="transactions">';

          foreach ($value as $hist) { ?>
            <!-- item -->
            <a href="txn-history?trans_id=<?= $hist['trans_id']; ?>" class="item">
              <div class="detail">
                <!-- <img src="assets/img/sample/brand/1.jpg" alt="img" class="image-block imaged w48"> -->
                <?php
                if ($hist['type'] != 'credit') : ?>
                  <div class="icon-wrapper bg-danger" style="width: 48px; height: 48px;  display: inline-flex; align-items: center; justify-content: center; border-radius: 10px; color: #fff; font-size: 24px; margin-bottom: 14px; margin: 0px 10px 0px 0px;">
                    <ion-icon name="arrow-down-outline" role="img" class="md hydrated" aria-label="arrow down outline"></ion-icon>
                  </div>
                <?php elseif ($hist['status'] == 'pending') : ?>
                  <div class="icon-wrapper bg-warning" style="width: 48px; height: 48px;  display: inline-flex; align-items: center; justify-content: center; border-radius: 10px; color: #fff; font-size: 24px; margin-bottom: 14px; margin: 0px 10px 0px 0px;">
                    <ion-icon name="ban-outline"></ion-icon>
                  </div>
                <?php else : ?>
                  <div class="icon-wrapper bg-success" style="width: 48px; height: 48px;  display: inline-flex; align-items: center; justify-content: center; border-radius: 10px; color: #fff; font-size: 24px; margin-bottom: 14px; margin: 0px 10px 0px 0px;">
                    <ion-icon name="arrow-up-outline" role="img" class="md hydrated" aria-label="arrow up outline"></ion-icon>
                  </div>
                <?php endif;
                ?>
                <div>
                  <strong><?= ucwords($hist['title']) ?></strong>
                  <p><?= ucwords($hist['method']) ?></p>
                </div>
              </div>
              <div class="right">
                <?= ($hist['type'] !== 'credit') ? '<div class="price text-danger"> - ' . $coin . ' ' . number_format($hist['amount'], 2) . '</div>' : '<div class="price">+ ' . $coin . ' ' . number_format($hist['amount'], 2) . '</div>' ?>
              </div>
            </a>
            <!-- * item -->
          <?php
          }

          echo '</div>';
        } else if ($key == $yesterday) {
          echo '<div class="section-title"> Yesterday</div>';
          echo '<div class="transactions">';
          foreach ($value as $hist) { ?>
            <!-- item -->
            <a href="txn-history?trans_id=<?= $hist['trans_id']; ?>" class="item">
              <div class="detail">
                <?php
                if ($hist['type'] != 'credit' && $hist['status'] == 'success') : ?>
                  <div class="icon-wrapper bg-danger" style="width: 48px; height: 48px;  display: inline-flex; align-items: center; justify-content: center; border-radius: 10px; color: #fff; font-size: 24px; margin-bottom: 14px; margin: 0px 10px 0px 0px;">
                    <ion-icon name="arrow-down-outline" role="img" class="md hydrated" aria-label="arrow down outline"></ion-icon>
                  </div>
                <?php
                elseif ($hist['status'] == 'pending') : ?>
                  <div class="icon-wrapper bg-warning" style="width: 48px; height: 48px;  display: inline-flex; align-items: center; justify-content: center; border-radius: 10px; color: #fff; font-size: 24px; margin-bottom: 14px; margin: 0px 10px 0px 0px;">
                    <ion-icon name="ban-outline"></ion-icon>
                  </div>
                <?php
                else : ?>
                  <div class="icon-wrapper bg-success" style="width: 48px; height: 48px;  display: inline-flex; align-items: center; justify-content: center; border-radius: 10px; color: #fff; font-size: 24px; margin-bottom: 14px; margin: 0px 10px 0px 0px;">
                    <ion-icon name="arrow-up-outline" role="img" class="md hydrated" aria-label="arrow up outline"></ion-icon>
                  </div>
                <?php endif;
                ?>
                <div>
                  <strong><?= ucwords($hist['type']) ?></strong>
                  <p><?= ucwords($hist['method']) ?></p>
                </div>
              </div>
              <div class="right">
                <?= ($hist['type'] !== 'credit') ? '<div class="price text-danger"> - ' . $coin . ' ' . number_format($hist['amount'], 2) . '</div>' : '<div class="price">+ ' . $coin . ' ' . number_format($hist['amount'], 2) . '</div>' ?>
              </div>
            </a>
            <!-- * item -->
          <?php
          }

          echo '</div>';
        } else {
          echo '<div class="section-title">' . $date . '</div>';
          echo '<div class="transactions">';

          foreach ($value as $hist) { ?>
            <!-- item -->
            <a href="txn-history?trans_id=<?= $hist['trans_id']; ?>" class="item">
              <div class="detail"><?php
                                  if ($hist['type'] != 'credit') : ?>
                  <div class="icon-wrapper bg-danger" style="width: 48px; height: 48px;  display: inline-flex; align-items: center; justify-content: center; border-radius: 10px; color: #fff; font-size: 24px; margin-bottom: 14px; margin: 0px 10px 0px 0px;">
                    <ion-icon name="arrow-down-outline" role="img" class="md hydrated" aria-label="arrow down outline"></ion-icon>
                  </div>
                <?php elseif ($hist['status'] == 'pending') : ?>
                  <div class="icon-wrapper bg-warning" style="width: 48px; height: 48px;  display: inline-flex; align-items: center; justify-content: center; border-radius: 10px; color: #fff; font-size: 24px; margin-bottom: 14px; margin: 0px 10px 0px 0px;">
                    <ion-icon name="ban-outline"></ion-icon>
                  </div>
                <?php else : ?>
                  <div class="icon-wrapper bg-success" style="width: 48px; height: 48px;  display: inline-flex; align-items: center; justify-content: center; border-radius: 10px; color: #fff; font-size: 24px; margin-bottom: 14px; margin: 0px 10px 0px 0px;">
                    <ion-icon name="arrow-up-outline" role="img" class="md hydrated" aria-label="arrow up outline"></ion-icon>
                  </div>
                <?php endif;
                ?>
                <!-- <img src="assets/img/sample/brand/1.jpg" alt="img" class="image-block imaged w48"> -->
                <div>
                  <strong><?= ucwords($hist['type']) ?></strong>
                  <p><?= ucwords($hist['method']) ?></p>
                </div>
              </div>
              <div class="right">
                <?= ($hist['type'] !== 'credit') ? '<div class="price text-danger"> - ' . $coin . ' ' . number_format($hist['amount'], 2) . '</div>' : '<div class="price">+ ' . $coin . ' ' . number_format($hist['amount'], 2) . '</div>' ?>
              </div>
            </a>
            <!-- * item -->
      <?php
          }
          echo '</div>';
        }
        // echo "<pre>" . var_export($key, true) . "</pre>";
      }
      ?>

      <div class="transactions mainSection">
        <div class="section-title"></div>
      </div>
    </div>
    <!-- * Transactions -->

    <?php if ($app->history()['data']['count'] / 10 > 1) : ?>
      <div class="section mt-2 mb-2 pagination">
        <a href="#" class="btn btn-primary btn-block btn-lg loadMore">Load More</a>
      </div>
    <?php endif; ?>

    <style>
      .appBottomMenu {
        display: none !important;
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
        url: '<?= $siteurl ?>trans/page',
        type: 'POST',
        dataType: "json",
        data: {
          page: countClicks,
          source: 'local-trans'
        },
        cache: false,
        success: function(data) {
          if (data.status == true) {
            $('.loadMore').html('Load More')
            $('.loadMore').removeClass("disabled");
            console.log();
            if (countClicks > parseInt(data.data.count / 10)) {
              $('.pagination').remove()
            }

            $(data.data.rows).each(function(index, item) {
              console.log(item);
              let indicate = '',
                text_id;

              if (item.type == 'credit') {
                text_id = `<div class="price text-danger"> - '<?= $coin ?>'${parseFloat(item.amount.toLocaleString())}</div>`
                indicate = `<div class="icon-wrapper bg-danger" style="width: 48px; height: 48px;  display: inline-flex; align-items: center; justify-content: center; border-radius: 10px; color: #fff; font-size: 24px; margin-bottom: 14px; margin: 0px 10px 0px 0px;">
                      <ion-icon name="arrow-down-outline" role="img" class="md hydrated" aria-label="arrow down outline"></ion-icon>
                  </div>`
              } else if (item.type == 'pending') {
                indicate = `<div class="icon-wrapper bg-warning" style="width: 48px; height: 48px;  display: inline-flex; align-items: center; justify-content: center; border-radius: 10px; color: #fff; font-size: 24px; margin-bottom: 14px; margin: 0px 10px 0px 0px;">
                    <ion-icon name="ban-outline"></ion-icon>
                </div>`
              } else {
                text_id = `<div class="price">+ <?= $coin ?> ${item.amount.toLocaleString()}</div>`
                indicate = `<div class="icon-wrapper bg-success" style="width: 48px; height: 48px;  display: inline-flex; align-items: center; justify-content: center; border-radius: 10px; color: #fff; font-size: 24px; margin-bottom: 14px; margin: 0px 10px 0px 0px;">
                      <ion-icon name="arrow-up-outline" role="img" class="md hydrated" aria-label="arrow up outline"></ion-icon>
                  </div>`
              }

              $('.mainSection').append(`
                <a href="txn-history?trans_id=${item.trans_id}" class="item">
                  <div class="detail">
                  ${indicate}
                      <div>
                          <strong>${item.title}</strong>
                          <p>${item.method}</p>
                      </div>
                  </div>
                  <div class="right">
                    ${text_id}
                  </div>
              </a>`)
            });
          } else {
            $('.loadMore').html('Load More')
            $('.loadMore').removeClass("disabled");
          }
        }
      }).fail(function(error, msg) {
        console.log(error, msg);
      });

      // alert(countClicks);
    });
  </script>
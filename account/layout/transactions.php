		<!--**********************************
            Content body start
        ***********************************-->
		<div class="content-body">
		  <!-- row -->
		  <div class="container-fluid">
		    <div class="page-titles form-head d-flex flex-wrap justify-content-between align-items-center mb-4">
		      <h2 class="text-black font-w600 mb-0 me-auto mb-2 pe-3"><?= $page ?></h2>

		    </div>
		    <div class="row">
		      <div class="col-lg-12">
		        <div class="table-responsive table-hover fs-14 card-table">
		          <table class="table display mb-4 dataTablesCard " id="example5">
		            <thead>
		              <tr>
		                <th>Name</th>
		                <th>Type</th>
		                <th>Amount (NGN)</th>
		                <th>Method</th>
		                <th>Date</th>
		                <th>Status</th>
		                <th></th>
		              </tr>
		            </thead>
		            <tbody>

		              <?php $history = $app->history()['data']['rows'];

                  $i = 0;
                  foreach ($history as $hist) :
                    if (
                      $i++ == 10
                    ) {
                      break;
                    } ?>

		                <tr>
		                  <td>
		                    <div class="text-black font-w600">
		                      <div>
		                        <h6 class="font-w600 mb-0 text-nowrap"><a href="txn-history?trans_id=<?= $hist['trans_id']; ?>" class="text-black"><?= ucwords($hist['title']) ?></a></h6>
		                      </div>
		                    </div>
		                  </td>
		                  <td>
		                    <?php
                        if ($hist['type'] != 'credit') : ?>
		                      <div class="text-black">
		                        <span class="me-2 oi-icon bgl-danger">
		                          <svg width="18" height="18" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
		                            <path d="M6.57624 0.769646C6.77936 1.18944 6.59993 1.69725 6.18014 1.90038C5.01217 2.46236 4.02363 3.33579 3.31947 4.42928C2.59837 5.54986 2.21582 6.84986 2.21582 8.19048C2.21582 12.0363 5.34394 15.1644 9.18978 15.1644C13.0356 15.1644 16.1637 12.0363 16.1637 8.19048C16.1637 6.84986 15.7812 5.54985 15.0635 4.4259C14.3627 3.33241 13.3708 2.45897 12.2028 1.89699C11.783 1.69387 11.6036 1.18944 11.8067 0.766262C12.0098 0.34647 12.5143 0.167042 12.9374 0.370167C14.3898 1.06756 15.6187 2.1509 16.4887 3.51183C17.3825 4.90663 17.8564 6.52486 17.8564 8.19048C17.8564 10.5061 16.9559 12.6829 15.3174 14.3181C13.6822 15.9566 11.5054 16.8571 9.18978 16.8571C6.87415 16.8571 4.69733 15.9566 3.06217 14.3181C1.42363 12.6795 0.523111 10.5061 0.523111 8.19048C0.523111 6.52486 0.99707 4.90663 1.89421 3.51183C2.76764 2.15428 3.99655 1.06756 5.44551 0.370167C5.86868 0.170427 6.37311 0.34647 6.57624 0.769646Z" fill="#FF2E2E"></path>
		                            <path d="M5.89551 7.7402C5.72962 7.57431 5.64837 7.35765 5.64837 7.14098C5.64837 6.92431 5.72962 6.70765 5.89551 6.54176L8.02493 4.41233C8.33639 4.10088 8.74941 3.93161 9.18613 3.93161C9.62285 3.93161 10.0393 4.10426 10.3473 4.41233L12.4768 6.54176C12.8085 6.87353 12.8085 7.40843 12.4768 7.7402C12.145 8.07197 11.6101 8.07197 11.2783 7.7402L10.0291 6.49098L10.0291 11.3017C10.0291 11.7688 9.64993 12.148 9.18275 12.148C8.71556 12.148 8.33639 11.7688 8.33639 11.3017L8.33639 6.4876L7.08717 7.73681C6.76217 8.06858 6.22728 8.06858 5.89551 7.7402Z" fill="#FF2E2E"></path>
		                          </svg>

		                        </span>
		                        <?= ucwords($hist['type']) ?>
		                      </div>
		                    <?php else : ?>
		                      <div class="text-black">
		                        <span class="me-2 oi-icon bgl-success">
		                          <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
		                            <g clip-path="url(#clip2)">
		                              <path d="M11.4238 16.2304C11.2206 15.8106 11.4001 15.3027 11.8199 15.0996C12.9878 14.5376 13.9764 13.6642 14.6805 12.5707C15.4016 11.4501 15.7842 10.1501 15.7842 8.80952C15.7842 4.96369 12.6561 1.83556 8.81022 1.83556C4.96439 1.83556 1.83626 4.96369 1.83626 8.80952C1.83626 10.1501 2.21881 11.4501 2.93652 12.5741C3.6373 13.6676 4.62923 14.541 5.7972 15.103C6.21699 15.3061 6.39642 15.8106 6.19329 16.2337C5.99017 16.6535 5.48574 16.833 5.06256 16.6298C3.61022 15.9324 2.38131 14.8491 1.51126 13.4882C0.617512 12.0934 0.143554 10.4751 0.143554 8.80952C0.143554 6.49389 1.04408 4.31707 2.68262 2.68192C4.31777 1.04337 6.4946 0.142853 8.81022 0.142854C11.1258 0.142854 13.3027 1.04337 14.9378 2.68192C16.5764 4.32046 17.4769 6.4939 17.4769 8.80952C17.4769 10.4751 17.0029 12.0934 16.1058 13.4882C15.2324 14.8457 14.0034 15.9324 12.5545 16.6298C12.1313 16.8296 11.6269 16.6535 11.4238 16.2304Z" fill="#2BC155" />
		                              <path d="M12.1045 9.2598C12.2704 9.42569 12.3516 9.64235 12.3516 9.85902C12.3516 10.0757 12.2704 10.2924 12.1045 10.4582L9.97506 12.5877C9.66361 12.8991 9.25059 13.0684 8.81387 13.0684C8.37715 13.0684 7.96074 12.8957 7.65267 12.5877L5.52324 10.4582C5.19147 10.1265 5.19147 9.59157 5.52324 9.2598C5.85501 8.92803 6.38991 8.92803 6.72168 9.2598L7.9709 10.509L7.9709 5.69834C7.9709 5.23116 8.35007 4.85199 8.81725 4.85199C9.28444 4.85199 9.66361 5.23116 9.66361 5.69834L9.66361 10.5124L10.9128 9.26319C11.2378 8.93142 11.7727 8.93142 12.1045 9.2598Z" fill="#2BC155" />
		                            </g>
		                            <defs>
		                              <clipPath id="clip2">
		                                <rect width="17.3333" height="17.3333" fill="white" transform="matrix(-9.93477e-08 1 1 9.93477e-08 0.143555 0.142853)" />
		                              </clipPath>
		                            </defs>
		                          </svg>
		                        </span>
		                        <?= ucwords($hist['type']) ?>
		                      </div>
		                    <?php endif;
                        ?>
		                  </td>
		                  <td><span class="text-black font-w600">
		                      <?= number_format($hist['amount'], 2) ?></span></td>
		                  <td><span class="text-black"><?= ucwords($hist['method']) ?></span></td>
		                  <td><span class="text-black text-nowrap">
		                      <?php $hist['date'] = new DateTime($hist['date']);
                          $hist['date'] = $hist['date']->format('M d, Y h:i:s A');

                          echo $hist['date']; ?>
		                    </span></td>
		                  <td>
		                    <?php
                        if ($hist['status'] == 'success') : ?>
		                      <a href="txn-history?trans_id=<?= $hist['trans_id']; ?>" class="btn btn-outline-success btn-rounded">Completed</a>
		                    <?php elseif ($hist['status'] == 'pending') : ?>
		                      <a href="txn-history?trans_id=<?= $hist['trans_id']; ?>" class="btn btn-outline-warning btn-rounded">Pending</a>
		                    <?php else : ?>
		                      <a href="txn-history?trans_id=<?= $hist['trans_id']; ?>" class="btn btn-outline-dark btn-rounded">Canceled</a>
		                    <?php endif;
                        ?>
		                  </td>
		                <?php endforeach; ?>
		            </tbody>
		          </table>

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
		      </div>
		    </div>
		  </div>
		</div>

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

		<!--**********************************
            Content body end
        ***********************************-->
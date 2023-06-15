    <!-- App Capsule -->
    <div id="appCapsule">
        <!-- Wallet -->
        <div class="section full gradientSection">
            <div class="in">
                <h5 class="title mb-2">Current Balance</h5>
                <h1 class="total totalAmount">$ 0.00</h1>
                <h4 class="caption userBalance">
                    <span class="iconbox text-success">
                        <ion-icon name="trending-up-outline"></ion-icon>
                    </span>
                    0.00000 BTC
                </h4>
                <div class="wallet-inline-button mt-5">
                    <a href="#" class="item" data-bs-toggle="modal" data-bs-target="#depositActionSheet">
                        <div class="iconbox">
                            <ion-icon name="arrow-up-outline"></ion-icon>
                        </div>
                        <strong>Deposit</strong>
                    </a>

                    <a href="#" class="item" data-bs-toggle="modal" data-bs-target="#sendActionSheet">
                        <div class="iconbox">
                            <ion-icon name="arrow-forward-outline"></ion-icon>
                        </div>
                        <strong>Send</strong>
                    </a>
                    <a href="swap" class="item">
                        <div class="iconbox">
                            <ion-icon name="swap-vertical-outline"></ion-icon>
                        </div>
                        <strong>Swap</strong>
                    </a>
                </div>
            </div>
        </div>
        <!-- * Wallet -->

        <!-- Deposit Action Sheet -->
        <div class="modal fade action-sheet" id="depositActionSheet" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title tttle">Deposit Crypto</h5>
                    </div>
                    <div class="modal-body">
                        <div class="action-sheet-content">
                            <form id="payload">
                              <div class="first-part">
                                <div class="form-group basic mb-2">
                                    <div class="input-wrapper">
                                        <label class="label" for="coin">Select Coin</label>
                                        <select name="coin_type" class="form-control custom-select" id="coins">
                                            <option value="BTC" selected>Bitcoin (BTC)</option>
                                            <option value="ETH">Ethereum (ETH)</option>
                                            <option value="USDT">TetherUS (USDT)</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group basic">
                                    <div class="input-wrapper">
                                        <label class="label" for="depositAmount">Enter Amount</label>
                                        <div class="exchange-group small">
                                            <div class="input-col">
                                                <input type="text" name="amount" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control form-control-lg pe-0"
                                                    id="depositAmount" placeholder="0" value="0.00" maxlength="8">
                                            </div>
                                            <div class="select-col currency">
                                                <select class="form-select form-select-lg ">
                                                    <option value="USD" selected>USD</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group basic form-man" style="display: none">
                                    <div class="input-wrapper">
                                        <label class="label" for="">Coin Value</label>
                                        <div class="input-col">
                                            <input type="text" class="form-control form-control-lg pe-0 depositValue"
                                                id="depositValue" placeholder="0.0000" value="" disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-2">
                                    <button type="button" class="btn btn-primary btn-lg btn-block contii" disabled>Deposit</button>
                                </div>

                              </div>
                              <div class="second-part" style="display:none;">
                                <div class="form-group basic">
                                    <div class="input-wrapper">
                                      <div class="section mt-2 mb-2">
                                        <div class="listed-detail mt-3 text-center">
                                          <div class="icon-wrapper coin-image">
                                            <!-- <div class="iconbox "> -->
                                              <img src="" alt="Coin image">
                                              <!-- <ion-icon name="arrow-forward-outline"></ion-icon> -->
                                            <!-- </div> -->
                                          </div>
                                          <h4 class="text-center mt-2 depositAddress" style="" id="text" onclick="copy()">xxxxxxxxxxxxxxx</h4>
                                          <small class="notice">(Send only the selected coin type to this address, sending other coin type will result in total funds lost)</small>
                                        </div>

                                        <ul class="listview flush transparent simple-listview no-space mt-3">
                                          <li>
                                            <strong>Coin Type</strong>
                                            <span class="coinType">BTC</span>
                                          </li>
                                          <li>
                                            <strong>Amount</strong>
                                            <h3 class="m-0 co depositAmount">$ 0.00</h3>
                                          </li>
                                          <li>
                                            <strong>Value</strong>
                                            <span class="depositValue">0.00000</span>
                                          </li>
                                          </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-2">
                                    <button type="button" class="btn btn-primary btn-lg btn-block ConfirmDepo">Confirm Deposit</button>
                                </div>
                              </div>

                              <div class="third-part" style="display: none;">
                                <div class="form-group basic">
                                    <div class="input-wrapper">
                                        <label class="label" for="">Transaction Hash</label>
                                        <div class="input-col">
                                            <input type="text" name="trans_hash" class="form-control form-control-lg pe-0" placeholder="Enter transaction hash" value="" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">Submit</button>
                                </div>
                              </div>

                            </form>

                            <script>
                            document.addEventListener('DOMContentLoaded', function () {
                              $('.close').click(function () {
                                location.reload()
                              })
                              let setting = JSON.parse('<?=$app->site_settings() ?>')
                              let settings = setting.data;
                              let sel = 'BTC';
                              $('#coins').on('change', function() {
                                sel = $('#coins').find(":selected").val();
                                $('.form-man').html("")
                                $('#depositAmount').val('0.00')
                                $('.coinType').html(sel)
                              })
                            // })

                            var coin_img = '';
                            var wallet = '';
                            $('#depositAmount').on('keyup', function() {
                              let select_rate = (sel == 'BTC')? btc().others.rate : ((sel == 'ETH')? eth().others.rate : usdt().others.rate);
                              let input = $(this).val();

                              $('.form-man').css("display", "");

                              if (input < 1 || input > 10000) return $('.form-man').html("<span style='color:red'>Amount must be greater than $1 and less than $10,000</span>"), $('.contii').attr('disabled', true), $('.contii').html('Deposit')
                              // }else {
                              // }

                              $(".form-man").html('<div class="spinner-border text-dark" role="status"></div>')

                              $('.form-man').html(`<div class="input-wrapper">
                                  <label class="label" for="">Coin Value</label>
                                  <div class="input-col depositValue">
                                      <input type="text" class="form-control form-control-lg pe-0"
                                          id="depositValue" placeholder="0.0000" value="${parseFloat($(this).val()/select_rate).toFixed(8)}" disabled>
                                  </div>
                              </div>`)

                              $('.depositValue').html(parseFloat($(this).val()/select_rate).toFixed(8))
                              $('.depositAmount').html('$'+input);

                              $('.contii').attr('disabled', false)
                              $('.contii').html('Continue')

                              // let wallet = (!settings.btc_address)? settings.btc_address = null: ((!settings.eth_address)? null)
                              wallet = (sel == 'BTC')? settings.btc_address : ((sel == 'ETH')? settings.eth_address: settings.usdt_address);
                              if (wallet == '') wallet = 'xxxxx-xxxxxx-xxxxxx-xxxxx';
                              let wallet_type = (sel == 'BTC')? settings.btc_wallet_type : ((sel == 'ETH')? settings.eth_wallet_type: settings.usdt_wallet_type);

                              coin_img = (sel == 'BTC')? settings.btc_barcode : ((sel == 'ETH')? settings.eth_barcode: settings.usdt_barcode);

                              $('.depositAddress').html(wallet);
                              $('.notice').html(`(Send only ${wallet_type} to this deposit address, sending other coin type will result in total funds lost)`)
                            })

                            $('.contii').click(function () {
                              $('.tttle').html('Make Deposit')
                              $('.coin-image').html(`<img src="/uploads/${coin_img}" alt="${sel} barcode" style="width: 160px;"> `);
                              $(this).html('<div class="spinner-border text-light" role="status"></div>');
                              setTimeout(function() {
                                $('.second-part').css('display', 'block');
                                $('.first-part').css('display', 'none');
                              }, 1000)
                            })

                            $('.ConfirmDepo').click(function () {
                              $('.tttle').html('Complete Deposit')
                              $(this).html('<div class="spinner-border text-light" role="status"></div>');
                              setTimeout(function() {
                                $('.second-part').css('display', 'none');
                                $('.first-part').css('display', 'none');
                                $('.third-part').css('display', 'block');
                              }, 1000)
                            })

                            function copy() {
                              var copyText = document.getElementById('text').innerHTML
                              navigator.clipboard.writeText(copyText);
                              alert("Wallet address copied: " + copyText);
                            }
                          })
                        </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- * Deposit Action Sheet-->

        <!-- Send Action Sheet -->
        <div class="modal fade action-sheet" id="sendActionSheet" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header migration">
                        <h5 class="modal-title tttle">Send</h5>
                    </div>
                    <div class="modal-body">
                        <div class="action-sheet-content">
                            <form id="payloads">
                              <div class="first-part">
                                <div class="form-group basic mb-2">
                                    <div class="input-wrapper">
                                        <label class="label" for="walletaddress">Wallet Address</label>
                                        <input type="text" class="form-control" id="walletaddress"
                                            placeholder="Enter a wallet address" name="wallet_address" required>
                                        <i class="clear-input">
                                            <ion-icon name="close-circle"></ion-icon>
                                        </i>
                                    </div>
                                </div>

                                <div class="form-group basic">
                                    <div class="input-wrapper">
                                        <label class="label" for="sendAmount">Enter Amount</label>
                                        <div class="exchange-group small">
                                            <div class="input-col">
                                                <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control form-control-lg pe-0" id="sendAmount" name="amount" placeholder="0" value="0.00" maxlength="6">
                                            </div>
                                            <div class="select-col">
                                                <select class="form-select form-select-lg currency send-coin" name="coin_type">
                                                    <option value="BTC">BTC</option>
                                                    <option value="ETH">ETH</option>
                                                    <option value="USDT">USDT</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group basic form-man" style="display: none">
                                    <div class="input-wrapper">
                                      <div class="exchange-group small">
                                        <div class="input-wrapper">
                                          <label class="label" for="">Coin Value</label>
                                          <div class="input-col deposit-coin-value">
                                            <input type="text" class="form-control depositValue"
                                                id="depositValue" placeholder="0.0000" value="" disabled>
                                          </div>
                                        </div>
                                          <div class="input-wrapper">
                                          <label class="label" for="">Fees</label>
                                          <div class="input-col fees">
                                            <input type="text" class="form-control depositValue"
                                                id="depositChargeValue" placeholder="0.0000" value="" disabled>
                                          </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                <div class="mt-2">
                                    <button type="button" class="btn btn-primary btn-lg btn-block contii" disabled>Send</button>
                                </div>
                              </div>
                                <div class="second-part" style="display:none;">
                                  <div class="form-group basic">
                                      <div class="input-wrapper">
                                        <div class="section mt-2 mb-2">
                                          <ul class="listview flush transparent simple-listview no-space mt-3">
                                            <li>
                                              <strong>Coin Type</strong>
                                              <span class="coinType">BTC</span>
                                            </li>
                                            <li>
                                              <strong>Wallet address</strong>
                                              <span class="depositAddress" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">xxxxxxxxxxxxxxx</span>
                                            </li>
                                            <li>
                                              <strong>Amount</strong>
                                              <h3 class="m-0 co depositAmount">$ 0.00</h3>
                                            </li>
                                            <li>
                                              <strong>Value</strong>
                                              <span class="depositValue">0.00000</span>
                                            </li>
                                            <li>
                                              <strong>Fee</strong>
                                              <span class="depositFee">0.00000</span>
                                            </li>
                                            </ul>
                                          </div>
                                      </div>
                                  </div>

                                  <div class="mt-2">
                                      <button type="button" class="btn btn-primary btn-lg btn-block ConfirmDepo">Confirmed</button>
                                  </div>
                                </div>

                                <div class="third-part" style="display: none;">
                                  <div class="form-group basic">
                                      <div class="input-wrapper">
                                          <label class="label" for="">Transaction Pin</label>
                                          <div class="input-col">
                                              <input type="password" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="4" name="pin" class="form-control form-control-lg pe-0" placeholder="Enter your transaction Pin" value="" required>
                                          </div>
                                      </div>
                                  </div>

                                  <div class="mt-2">
                                      <button type="submit" class="btn btn-primary btn-lg btn-block">Send</button>
                                  </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- * Send Action Sheet-->

        <script>
        document.addEventListener('DOMContentLoaded', function () {
          let setting = JSON.parse('<?=$app->site_settings(); ?>')
          let settings = setting.data;
          let sel = 'BTC';
          $('.send-coin').on('change', function() {
            sel = $('.send-coin').find(":selected").val();
            $('.form-man').html("")
            $('#sendAmount').val('0.00')
            $('.coinType').html(sel)
          })
        // })

        $('#sendAmount').on('keyup', function() {
          let select_rate = (sel == 'BTC')? btc().others.rate : ((sel == 'ETH')? eth().others.rate : usdt().others.rate);
          let input = $(this).val();

          $('.form-man').css("display", "");

          if (input < 10 || input > 500) return $('.form-man').html("<span style='color:red'>Amount must be greater than $10 and less than $500</span>"), $('.contii').attr('disabled', true), $('.contii').html('Deposit')
          // }else {
          // }
          let trans_fee = (sel == 'BTC')? settings.btc_fee : ((sel == 'ETH')? settings.eth_fee: settings.usdt_fee);

          $(".form-man").html('<div class="spinner-border text-dark" role="status"></div>')

          $('.form-man').html(`
            <div class="input-wrapper">
              <div class="exchange-group small" style="margin: 0px 1px;">
                <div class="input-wrapper">
                  <label class="label" for="">Coin Value</label>
                  <div class="input-col deposit-coin-value depositValue">
                    ${parseFloat($(this).val()/select_rate).toFixed(8)}
                  </div>
                </div>
                  <div class="input-wrapper">
                  <label class="label" for="">Fees</label>
                  <div class="input-col fees">
                    ${parseFloat(trans_fee/select_rate).toFixed(8)}
                  </div>
              </div>
            </div>
          </div>`)

          $('.depositValue').html(parseFloat($(this).val()/select_rate).toFixed(8))
          $('.depositAmount').html('$'+input);
          $('.depositFee').html(parseFloat(trans_fee/select_rate).toFixed(8))

          $('.contii').attr('disabled', false)
          $('.contii').html('Continue')

          $('.depositAddress').html($('#walletaddress').val());
        })

        $('.contii').click(function () {
          // $('.tttle').html('Confirm Details')
          $(this).html('<div class="spinner-border text-light" role="status"></div>');
          setTimeout(function() {
            $('.migration').html(`
              <div class="left" onclick="go_to_part('first')" style="position: absolute; padding: 10px;">
                <a href="#" class="">
                  <ion-icon name="chevron-back-outline" role="img" class="md hydrated" aria-label="chevron back outline"></ion-icon>
                </a>
              </div>

              <h5 class="modal-title tttle">Confirm Details</h5>
              `)

            $('.second-part').css('display', 'block');
            $('.first-part').css('display', 'none');
          }, 1000)
        })

        $('.ConfirmDepo').click(function () {
          $(this).html('<div class="spinner-border text-light" role="status"></div>');
          setTimeout(function() {
            $('.migration').html(`
              <div class="left" onclick="go_to_part('second')" style="position: absolute; padding: 10px;">
                <a href="#" class="">
                  <ion-icon name="chevron-back-outline" role="img" class="md hydrated" aria-label="chevron back outline"></ion-icon>
                </a>
              </div>

              <h5 class="modal-title tttle">Complete Transaction</h5>
              `)

            $('.second-part').css('display', 'none');
            $('.first-part').css('display', 'none');
            $('.third-part').css('display', 'block');
            // $(this).html('Confirmed');
          }, 1000)

        })

        function copy() {
          var copyText = document.getElementById('text').innerHTML
          navigator.clipboard.writeText(copyText);
          alert("Wallet address copied: " + copyText);
        }
      })

      function go_to_part(part) {
        if (part == 'first') {
          $('.first-part').css('display', 'block');
          $('.second-part').css('display', 'none');
          $('.contii').html('Continue');
        }else if (part == 'second') {
          $('.migration').html(`<div class="left" onclick="go_to_part('first')" style="position: absolute; padding: 10px;">
            <a href="#" class="">
              <ion-icon name="chevron-back-outline" role="img" class="md hydrated" aria-label="chevron back outline"></ion-icon>
            </a>
          </div>
          <h5 class="modal-title tttle">Complete Transaction</h5> `)

          $('.second-part').css('display', 'block');
          $('.first-part').css('display', 'none');
          $('.third-part').css('display', 'none');
          $('.ConfirmDepo').html('Confirmed')
        }
      }
    </script>


        <!-- Portfolio -->
        <div class="section mt-4">
            <div class="section-heading">
                <h2 class="title">My Portfolio</h2>
                <!-- <a href="crypto-portfolio.html" class="link">View All</a> -->
            </div>
            <div class="card">
                <ul class="listview flush transparent no-line image-listview detailed-list mt-1 mb-1">
                    <!-- item -->
                    <li>
                        <div class="item">
                          <div class="BTCtrend">
                            <div class="icon-box text-success">
                                <ion-icon name="trending-up-outline"></ion-icon>
                            </div>
                          </div>
                            <div class="in">
                                <div>
                                    <strong>Bitcoin</strong>
                                    <div class="text-small text-secondary"><?= number_format($user->BTC, 6) ?> BTC</div>
                                </div>
                                <div class="text-end">
                                    <strong class="BTCrate ">$0.00</strong>
                                    <div class="text-small BTCchange">
                                        <span class="badge badge-success">
                                            <ion-icon name="arrow-up-outline"></ion-icon>
                                            2.59%
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <!-- * item -->
                    <!-- item -->
                    <li>
                        <div class="item">
                          <div class="ETHtrend">
                            <div class="icon-box text-success">
                                <ion-icon name="trending-up-outline"></ion-icon>
                            </div>
                          </div>
                            <div class="in">
                                <div>
                                    <strong>Ethereum</strong>
                                    <div class="text-small text-secondary"><?= number_format($user->ETH, 4) ?> ETH</div>
                                </div>
                                <div class="text-end">
                                    <strong class="ETHrate">$0.00</strong>
                                    <div class="text-small ETHchange">
                                        <span class="badge badge-success">
                                            <ion-icon name="arrow-up-outline"></ion-icon>
                                            2.59%
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <!-- * item -->
                    <!-- item -->
                    <li>
                        <div class="item">
                          <div class="USDTtrend">
                            <div class="icon-box text-success">
                                <ion-icon name="trending-up-outline"></ion-icon>
                            </div>
                          </div>
                            <div class="in">
                                <div>
                                    <strong>Tether</strong>
                                    <div class="text-small text-secondary"><?= number_format($user->USDT, 2) ?> USDT</div>
                                </div>
                                <div class="text-end">
                                    <strong class="USDTrate">$0.00</strong>
                                    <div class="text-small USDTchange">
                                        <span class="badge badge-success">
                                            <ion-icon name="arrow-up-outline"></ion-icon>
                                            2.59%
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <!-- * item -->
                </ul>
            </div>
        </div>
        <!-- Portfolio -->


        <!-- Watchlist -->
        <div class="section-heading padding mt-4">
            <h2 class="title">Watchlist</h2>
            <a href="#" class="link">View All</a>
        </div>
        <!-- carousel  -->
        <div class="carousel-multiple splide">
            <div class="splide__track">
                <ul class="splide__list">
                    <!-- item -->
                    <li class="splide__slide">
                        <div class="card coinbox">
                            <div class="card-body pb-0">
                                <a href="#" class="fixed-button" data-bs-toggle="modal"
                                    data-bs-target="#actionSheetWatchlist">
                                    <ion-icon name="ellipsis-vertical"></ion-icon>
                                </a>
                                <h4>BTC/USD</h4>
                                <div class="text BTCprice" id="BTCprice"></div>
                                <div class="change BTCchange">
                                    <span class="badge badge-success">
                                        <ion-icon name="arrow-up-outline"></ion-icon>
                                        0.00%
                                    </span>
                                </div>
                            </div>
                            <div class="chart chart-sparkline-success-1" id="BTCprice"></div>
                            <!-- <canvas class="chart chart-sparkline-success-1" id="btcChart"></canvas> -->
                        </div>
                    </li>
                    <!-- * item -->
                    <!-- item -->
                    <li class="splide__slide">
                        <div class="card coinbox">
                            <div class="card-body pb-0">
                                <a href="#" class="fixed-button" data-bs-toggle="modal"
                                    data-bs-target="#actionSheetWatchlist">
                                    <ion-icon name="ellipsis-vertical"></ion-icon>
                                </a>
                                <h4>ETH/USD</h4>
                                <div class="text ETHprice" id="ETHprice"></div>
                                <div class="change ETHchange">
                                    <span class="badge badge-danger">
                                        <ion-icon name="arrow-down-outline"></ion-icon>
                                        0.00%
                                    </span>
                                </div>
                            </div>
                            <div class="chart chart-sparkline-danger-1" id="ETHprice"></div>
                            <!-- <canvas class="chart chart-sparkline-danger-1" id="ethereumChart"></canvas> -->

                        </div>
                    </li>
                    <!-- * item -->
                    <!-- item -->
                    <li class="splide__slide">
                        <div class="card coinbox">
                            <div class="card-body pb-0">
                                <a href="#" class="fixed-button" data-bs-toggle="modal"
                                    data-bs-target="#actionSheetWatchlist">
                                    <ion-icon name="ellipsis-vertical"></ion-icon>
                                </a>
                                <h4>USDT/USD</h4>
                                <div class="text USDTprice" id="USDTprice"></div>
                                <div class="change USDTchange">
                                    <span class="badge badge-success">
                                        <ion-icon name="arrow-up-outline"></ion-icon>
                                        0.00%
                                    </span>
                                </div>
                            </div>
                            <div class="chart chart-sparkline-success-2"></div>
                            <!-- <canvas class="chart chart-sparkline-success-2" id="usdtChart"></canvas> -->
                        </div>
                    </li>
                    <!-- * item -->
                </ul>
            </div>
        </div>
        <!-- * carousel  -->
        <!-- Watchlist -->

        <!-- Action Sheet Watchlist -->
        <!-- <div class="modal fade action-sheet" id="actionSheetWatchlist" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">BTC/USD</h5>
                        <h3 class="text-center mb-05 fontsize-headingLarge text-success">$38,509.44</h3>
                        <div class="text-muted text-center mb-1 fontsize-caption">Added 28 days ago</div>
                    </div>

                    <div class="modal-body">
                        <ul class="action-button-list">
                            <li>
                                <a href="#" class="btn btn-list" data-bs-dismiss="modal">
                                    <span>Buy</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="btn btn-list" data-bs-dismiss="modal">
                                    <span>Sell</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="btn btn-list" data-bs-dismiss="modal">
                                    <span>Remove from List</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="btn btn-list" data-bs-dismiss="modal">
                                    <span>Hide from List</span>
                                </a>
                            </li>
                            <li class="action-divider"></li>
                            <li>
                                <a href="#" class="btn btn-list text-danger" data-bs-dismiss="modal">
                                    <span>Close</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- * Action Sheet Watchlist -->


        <!-- Transactions -->
        <div class="section mt-4">
            <div class="section-heading">
                <h2 class="title">Transactions</h2>
                <a href="crypto-transactions" class="link">View All</a>
            </div>
            <div class="card">
                <ul class="listview flush transparent no-line image-listview detailed-list mt-1 mb-1">
                    <!-- item -->
                    <?php if($app->crypto_history()['status'] === false) { ?>
                      <a class="item" style="color: white">
                          <div class="detail">
                            <?= $app->history()['message']; ?>
                          </div>
                      </a>
                      <?php
                    }
                    $co = 0; foreach ($app->crypto_history()['data']['rows'] as $crypto):
                      if ($co++ == 4) break; ?>
                      <li>
                          <a href="crypto-history?trans_id=<?= $crypto['trans_id']; ?>" class="item">
                              <div class="icon-box <?=($crypto['status'] == 'success')? 'bg-success': (($crypto['status'] == 'pending')? 'bg-warning': 'bg-danger' ) ?>">
                                <?= ($crypto['type'] == 'credit')? '<ion-icon name="arrow-down-outline"></ion-icon>': (($crypto['type'] == 'debit')? '<ion-icon name="arrow-up-outline"></ion-icon>' : '<ion-icon name="swap-vertical-outline"></ion-icon>') ?>
                              </div>
                              <div class="in">
                                  <div>
                                      <strong><?= ($crypto['coin_type'] == 'btc')? 'Bitcoin': (($crypto['coin_type'] == 'eth')? 'Ethereum' : 'TetherUS') ?></strong>
                                      <div class="text-small text-secondary"><?= ($crypto['type'] == 'credit')? 'Deposit': (($crypto['type'] == 'debit')? 'Withdraw' : 'Swap') ?></div>
                                  </div>
                                  <div class="text-end">
                                      <strong>$<?=number_format($crypto['amount'],2) ?></strong>
                                      <div class="text-small">
                                          <?= number_format($crypto['value'], 8); ?>
                                      </div>
                                  </div>
                              </div>
                          </a>
                      </li>
                      <!-- * item -->
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <!-- Transactions -->


        <!-- Slider -->
        <div class="section mt-4 full">
            <div class="carousel-single splide">
                <div class="splide__track">
                    <ul class="splide__list">

                        <li class="splide__slide">
                            <div class="card card-with-icon">
                                <div class="card-body pt-3 pb-3 text-center">
                                    <div class="card-icon bg-success mb-2">
                                        <ion-icon name="link"></ion-icon>
                                    </div>
                                    <h3 class="card-titlde mb-1">Refer a Friend</h3>

                                    <p>Invite your friends and earn prizes!</p>
                                    <div class="row">
                                        <div class="col">
                                            <a href="#" class="btn btn-secondary">
                                                <ion-icon name="copy-outline"></ion-icon>
                                                Invite now
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li class="splide__slide">
                            <div class="card card-with-icon">
                                <div class="card-body pt-3 pb-3 text-center">
                                    <div class="card-icon mb-2">
                                        <ion-icon name="chatbox-ellipses"></ion-icon>
                                    </div>
                                    <h3 class="card-titlde mb-1">Join Our Group Chat</h3>

                                    <p>Let's talk about the market and strategiest!</p>
                                    <div class="row">
                                        <div class="col">
                                            <a href="component-messages.html" class="btn btn-block btn-primary">
                                                Join now
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a href="component-messages.html" class="btn btn-block btn-secondary">
                                                View groups
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li class="splide__slide">
                            <div class="card card-with-icon">
                                <div class="card-body pt-3 pb-3 text-center">
                                    <div class="card-icon bg-secondary mb-2">
                                        <ion-icon name="share-social-outline"></ion-icon>
                                    </div>
                                    <h3 class="card-titlde mb-1">Follow Us</h3>

                                    <p>Follow us on social media!</p>
                                    <div class="row">
                                        <div class="col">
                                            <a href="#" class="btn btn-block btn-facebook">
                                                <ion-icon name="logo-facebook"></ion-icon>
                                                Facebook
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a href="#" class="btn btn-block btn-twitter">
                                                <ion-icon name="logo-twitter"></ion-icon>
                                                Twitter
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <!-- * Slider -->


        <!-- News -->
        <div class="section full mt-4 mb-3">
            <div class="section-heading padding">
                <h2 class="title">Lastest News</h2>
                <a href="app-blog.html" class="link">View All</a>
            </div>

            <!-- carousel multiple -->
            <div class="carousel-multiple splide">
                <div class="splide__track">
                    <ul class="splide__list">

                      <?php
                      function custom_echo($x, $length)
                      {
                          if(strlen($x)<=$length)
                          {
                            echo $x;
                          }
                          else
                          {
                            $y=substr($x,0,$length) . '...';
                            echo $y;
                          }
                        }
                      $index = 0;
                      foreach ($app->news()->articles as $news):
                        if ($index++ == 10) {
                          break;
                        }  ?>
                      <li class="splide__slide">
                          <a href="<?= $news->url; ?>" target="_blank" title="<?= $news->title ?>" rel="nofollow">
                              <div class="blog-card">
                                  <img src="<?= $news->urlToImage; ?>" alt="image" class="imaged w-100" style="max-height: 220px; height: 160px;">
                                  <div class="text">
                                      <h4 class="title"><?php echo custom_echo($news->title, 30)  ?></h4>
                                  </div>
                              </div>
                          </a>
                      </li>
                      <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <!-- * carousel multiple -->

        </div>
        <!-- * News -->


        <!-- app footer -->
        <div class="appFooter">
            <div class="footer-title">
                Copyright © DitePay <?= date('Y') ?>.
            </div>
            All Rights Reserved.
        </div>
        <!-- * app footer -->

    </div>
    <!-- * App Capsule -->
<!-- </body>

</html> -->
<!-- Success Action Sheet -->
<div id="toast-11" class="toast-box toast-center" style="z-index: 999999999999;">
    <div class="in">
        <ion-icon name="checkmark-circle" class="text-success md hydrated" role="img" aria-label="checkmark circle"></ion-icon>
        <div class="text" id="succ-modal">
            Success Message
        </div>
    </div>
    <button type="button" class="btn btn-sm btn-text-light close-button close">CLOSE</button>
</div>

<!-- Failed Action Sheet -->
<div id="toast-90" class="toast-box toast-center" style="z-index: 99999999999;">
    <div class="in">
        <ion-icon name="close-circle" role="img" class="text-danger md hydrated" aria-label="close circle"></ion-icon>
        <div class="text" id="failed-modal">
            Failed Message
        </div>
    </div>
    <button type="button" class="btn btn-sm btn-text-light close-button">CLOSE</button>
</div>

<div id="toast-16" class="toast-box toast-bottom bg-danger" style="z-index: 999999999999999999;">
    <div class="in">
        <div class="text" id="dang-msg">
            Danger Message
        </div>
    </div>
    <button type="button" class="btn btn-sm btn-text-light close-button">OK</button>
</div>
<script>
  $('.close').click(function () {
    location.reload()
  })
$('#payload').submit(function(e) {
  e.preventDefault();

  var formData = new FormData($(this)[0]);
  $thiss = $(this).find("[type=submit]");
  $thiss.text("please wait...");
  $thiss.addClass("disabled");

  $.ajax({
      url: '<?=$siteurl?>trans/deposit-crypto',
      type: 'POST',
      data: formData,
      dataType: "json",
      cache: false,
      contentType: false,
      processData: false,
      success : function(data){
        data = JSON.parse(data);
          // console.log(data);
          if (data.status == true){
            $("#succ-modal").html(data.message);
            // $("#succ").click();
            toastbox('toast-11');
            $thiss.text("Deposit");
            $thiss.removeClass("disabled");
            $('#payload')[0].reset()
          } else {
              $thiss.text("Deposit");
              $thiss.removeClass("disabled");
              $("#failed-modal").html(data.message);
              toastbox('toast-90');
              // $("#dang").click();
          }
      }
  }).fail(function (jqXHR, textStatus, error) {
      // Handle error here
      console.log(jqXHR, textStatus, error);
      $thiss.text("Deposit");
      $thiss.removeClass("disabled");
      $("#failed-modal").html(jqXHR.responseText);
      toastbox('toast-90');
      // console.log(jqXHR.responseText);
  });
})

$('#payloads').submit(function(e) {
  e.preventDefault();

  var formData = new FormData($(this)[0]);
  $thiss = $(this).find("[type=submit]");
  $thiss.text("please wait...");
  $thiss.addClass("disabled");

  $.ajax({
      url: '<?=$siteurl?>trans/send-crypto',
      type: 'POST',
      data: formData,
      dataType: "json",
      cache: false,
      contentType: false,
      processData: false,
      success : function(data){
        data = JSON.parse(data);
          // console.log(data);
          if (data.status == true){
            $("#succ-modal").html(data.message);
            // $("#succ").click();
            toastbox('toast-11');
            $thiss.text("Send");
            $thiss.removeClass("disabled");
            $('#payload')[0].reset()
          } else {
              $thiss.text("Send");
              $thiss.removeClass("disabled");
              $("#failed-modal").html(data.message);
              toastbox('toast-90');
              // $("#dang").click();
          }
      }
  }).fail(function (jqXHR, textStatus, error) {
      // Handle error here
      console.log(jqXHR, textStatus, error);
      $thiss.text("Send");
      $thiss.removeClass("disabled");
      $("#failed-modal").html(jqXHR.responseText);
      toastbox('toast-90');
      // console.log(jqXHR.responseText);
  });
})
</script>

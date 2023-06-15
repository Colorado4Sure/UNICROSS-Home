    <!-- App Capsule -->
    <div id="appCapsule">

        <!-- Wallet Card -->
        <div class="section wallet-card-section pt-1">
            <div class="wallet-card">
                <!-- Balance -->
                <div class="balance">
                    <div class="right">Total Saved</span>
                        <h1 class="total"><?= $coin . ' ' . number_format($user->balance, 2); ?></h1>
                    </div>
                </div>
                
                <!--<div class="balance">-->
                <!--    <div class="right">-->
                <!--        <span class="title">Total Savings</span>-->
                <!--        <h1 class="total"><?= $coin . ' ' . number_format($user->balance, 2); ?></h1>-->
                <!--    </div>-->
                <!--    <div class="right">-->
                <!--        <a href="#" class="button" data-bs-toggle="modal" data-bs-target="#depositActionSheet">-->
                <!--            <ion-icon name="add-outline"></ion-icon>-->
                <!--        </a>-->
                <!--    </div>-->
                <!--</div>-->
                <!-- * Balance -->
                <!-- Wallet Footer -->
                
                <div class="wallet-footer">
                    <div class="item">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#withdrawActionShee">
                            <div class="icon-wrapper bg-danger">
                                <ion-icon name="arrow-down-outline"></ion-icon>
                            </div>
                            <strong>Withdraw</strong>
                        </a>
                    </div>
                    <div class="item">
                        <a href="/account">
                            <div class="icon-wrapper">
                                <ion-icon name="home-outline"></ion-icon>
                            </div>
                            <strong>Account</strong>
                        </a>
                    </div>
                    <div class="item">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#sendActionShee">
                            <div class="icon-wrapper">
                                <ion-icon name="wallet-outline"></ion-icon>
                            </div>
                            <strong>Save</strong>
                        </a>
                    </div>


                </div>
                <!-- * Wallet Footer -->
            </div>
        </div>
        <!-- Wallet Card -->

        <!-- Deposit Action Sheet -->
        <div class="modal fade action-sheet" id="depositActionSheet" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Money</h5>
                    </div>
                    <div class="modal-body">
                        <div class="action-sheet-content">
                            <form id="DepositForm" action='backend/deposit'>
                                <ul class="action-button-list">
                                    <li>
                                        <a href="#" class="btn btn-list" id="bnk_tnf" data-bs-toggle="modal" data-bs-target="#methodAction">
                                            <span>
                                                <ion-icon name="storefront-outline" role="img"></ion-icon>
                                                Bank Transfer
                                            </span>
                                        </a>
                                    </li>
                                    <li class="action-divider"></li>
                                    <li>
                                        <a href="#" class="btn btn-list" id="card_dps" data-bs-toggle="modal" data-bs-target="#methodAction">
                                            <span>
                                                <ion-icon name="card-outline" role="img"></ion-icon>
                                                Top-up with Card
                                            </span>
                                        </a>
                                    </li>
                                    <li class="action-divider"></li>
                                </ul>
                                <!-- <div class="form-group basic">
                                    <div class="input-wrapper">
                                        <label class="label" for="account1">Payment Method</label>
                                        <select class="form-control custom-select" name="method" id="account1"> -->
                                <!-- <option value="flutterwave">Card Funding</option> -->
                                <!-- <option value="paystack">Paystack</option> -->
                                <!-- <option value="bank_transfer">Bank Transfer</option>
                                        </select>
                                    </div>
                                </div> -->

                                <!-- <div class="form-group basic">
                                    <label class="label">Enter Amount</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text" id="basic-addona1"><?= $coin ?></span>
                                        <input id="amount" type="number" step=".01" name="amount" class="form-control" placeholder="Enter an amount" value="1000">
                                    </div>
                                </div>

                                <div class="form-group basic deposs">
                                    <button type="submit" class="btn btn-primary btn-block btn-lg">Deposit</button>
                                </div> -->

                                <div class="form-group basic deposs" data-bs-dismiss="modal">
                                    <button type="button" class="btn btn-primary btn-block btn-lg">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade action-sheet inset show" id="methodAction" tabindex="-1" aria-modal="true" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title methodAction">Receive Money</h5>
                    </div>
                    <div class="modal-body">
                        <div class="section mt-2 bankDepos">
                            <div class="card">
                                <div class="card-body">
                                    <h5>You can now Transfer Money directly from any Bank to you Ditepay Account</h5>
                                    <br>
                                    <h6 class="text-danger">NB: You MUST use ONLY your reference code as the transaction Narration/Description/Purpose</h6>
                                </div>
                            </div>

                            <div class="card" style="background: #2d2354;">
                                <div class="card-body">
                                    <h5 class="card-title" style="color: #ffffff;">Use <?= $user->account_bank ?> as Bank Name</h5>
                                    <p class="card-text">
                                        Acc No: <?= $user->account_number ?> <br>
                                        Acc Name: <?= $user->account_name ?> <br>
                                        Reference: <?= $user->reference ?>
                                    </p>

                                </div>
                            </div>
                        </div>

                        <div class="section mt-2 cardDepos">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Card Deposit is not available at the moment, please check back. </h5>
                                    <br>
                                    <h5>Having issues with the bank deposit option? <span class="text-danger" onclick="tidioChatApi.open()">Please Contact Us</span> </h5>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="form-group basic deposs" data-bs-dismiss="modal">
                            <button type="button" class="btn btn-primary btn-block btn-lg">Back</button>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>

        <!-- * Deposit Action Sheet -->

        <!-- Withdraw Action Sheet -->
        <div class="modal fade action-sheet" id="withdrawActionSheet" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Withdraw Money</h5>
                    </div>
                    <div class="modal-body">
                        <div class="action-sheet-content">
                            <form action='withdraw' id="withdrw">
                                <div class="form-group basic">
                                    <div class="input-wrapper">
                                        <label class="label" for="account2d">Select Bank</label>
                                        <select class="form-control custom-select" name="bank" id="account2d">

                                            <option>Choose Bank</option>
                                            <?php foreach ($app->banks()['data'] as $banks) {
                                                echo '<option value="' . $banks['bankCode'] . '">' . $banks['bankName'] . '</option>';
                                            } ?>

                                            <!-- <option value="2">Mortgage (*** 5021)</option> -->
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group basic">
                                    <div class="input-wrapper">
                                        <label class="label" for="text11d">Account No.</label>
                                        <input type="text" maxlength="10" name="account" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\.*?)\..*/g, '$1');" class="form-control" id="text11d" placeholder="Enter Account No" />

                                        <i class="clear-input">
                                            <ion-icon name="close-circle"></ion-icon>
                                        </i>
                                    </div>
                                </div>

                                <div class="form-group basic" id="account_name" style="display: none">
                                    <div class="input-wrapper">
                                        <label class="label" for="acc_name">Account Name</label>
                                        <div class="form-man" style="text-align: center;">
                                            <input type="text" name="account_name" class="form-control" id="acc_name" disabled>
                                        </div>
                                        <i class="clear-input">
                                            <ion-icon name="close-circle"></ion-icon>
                                        </i>
                                    </div>
                                </div>

                                <div class="form-group basic">
                                    <label class="label">Enter Amount</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text" id="basic-addonb1"><?= $coin ?></span>
                                        <input type="text" name="amount" class="form-control" placeholder="Enter an amount" value="100" required>
                                    </div>
                                </div>

                                <div class="form-group basic">
                                    <label class="label">Description</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <ion-icon name="newspaper-outline"></ion-icon>
                                        </span>
                                        <textarea class="form-control description" placeholder="Transaction Description" value="" name="note" required></textarea>
                                        <!-- <textarea name="name" rows="8" cols="80"></textarea> -->
                                    </div>
                                </div>

                                <div class="form-group basic">
                                    <button type="submit" class="btn btn-primary btn-block btn-lg withdraw" disabled>Withdraw</button>
                                </div>
                            </form>

                            <script>
                                // validate account details
                                $("#text11d").on("keyup", function() {
                                    if ($("#text11d").val().length == 10) {
                                        $("#account_name").css("display", "")
                                        $(".form-man").html('<div class="spinner-border text-dark" role="status"></div>')

                                        $(".acc_name").html("Loading...")
                                        var selected = $("#account2d option:selected").val()

                                        if (selected == "Select Bank")
                                            return $(".acc_name").html("<span style='color:red'>Please Select Your Bank</span>");

                                        var formData = new FormData($('#withdrw')[0]);

                                        var settings = {
                                            "url": "<?= $siteurl ?>trans/verify-account",
                                            "method": "POST",
                                            "timeout": 0,
                                            data: formData,
                                            dataType: "json",
                                            cache: false,
                                            contentType: false,
                                            processData: false,
                                        };

                                        $.ajax(settings).done(function(response) {
                                            // response = JSON.parse(response);
                                            if (response.status == true) {
                                                $(".acc_name").html("Account Name")
                                                $("#account_name").css("display", "")
                                                $('.form-man').html(`<input type="text" class="form-control" id="acc_name" name="account_name" value="${response.data.account_name}" disabled>`)

                                            } else {
                                                alert(response.message)
                                                $("#account_name").css("display", "none")
                                                $('.form-man').html("");
                                                $(".withdraw").attr("disabled", true)
                                            }
                                            $(".withdraw").removeAttr("disabled")

                                        }).fail(function(response) {
                                            alert('Invalid Account Details')
                                            $("#account_name").css("display", "none")
                                            $('.form-man').html("");
                                            $(".withdraw").attr("disabled", true)
                                        })
                                        // alert()
                                    } else {
                                        $("#acc_name").val('')
                                        $("#acc_name").html("")
                                        $("#account_name").css("display", "none")
                                        $(".withdraw").attr("disabled", true)
                                    }
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- * Withdraw Action Sheet -->

        <!-- Send Action Sheet -->
        <div class="modal fade action-sheet" id="sendActionSheet" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Send Money</h5>
                    </div>
                    <div class="modal-body">
                        <div class="action-sheet-content">
                            <form action="send-confirmation" method="get">
                                <div class="form-group basic">
                                    <div class="input-wrapper">
                                        <label class="label" for="text11">To</label>
                                        <input type="email" required name="sentTo" class="form-control" id="text11" placeholder="User email address">
                                        <i class="clear-input">
                                            <ion-icon name="close-circle"></ion-icon>
                                        </i>
                                    </div>
                                </div>

                                <div class="form-group basic">
                                    <label class="label">Enter Amount</label>
                                    <div class="input-group mb-2">
                                        <span class="input-group-text" id="basic-addon1"><?= $coin ?></span>
                                        <input type="text" required name="amount" class="form-control" placeholder="Enter an amount" value="1000">
                                    </div>
                                </div>

                                <div class="form-group basic">
                                    <button type="submit" class="btn btn-primary btn-block btn-lg">Send</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- * Send Action Sheet -->
        

        <!-- Transactions -->
        <div class="section mt-4">
            <div class="section-heading">
                <h2 class="title">Transactions</h2>
                <a href="transactions" class="link">View All</a>
            </div>
            <div class="transactions">
                <!-- item -->
                <?php
                if ($app->history()['status'] === false) { ?>
                    <a class="item" style="color: white">
                        <div class="detail">
                            <?= $app->history()['message']; ?>
                        </div>
                    </a>
                <?php
                }

                $i = 0;
                foreach ($app->history()['data']['rows'] as $history) :
                    if ($i++ > 4) {
                        break;
                    }

                    // if ($history['status'] === 'success') {
                    // continue;
                ?>
                    <a href="#" class="item">
                        <div class="detail">
                            <?php
                            if ($history['type'] != 'credit' && $history['status'] == "success") : ?>
                                <div class="icon-wrapper bg-danger" style="width: 48px; height: 48px;  display: inline-flex; align-items: center; justify-content: center; border-radius: 10px; color: #fff; font-size: 24px; margin-bottom: 14px; margin: 0px 10px 0px 0px;">
                                    <ion-icon name="arrow-up-outline" role="img" class="md hydrated" aria-label="arrow up outline"></ion-icon>
                                </div>
                            <?php elseif ($history['type'] != 'credit' && $history['status'] == "pending") : ?>
                                <div class="icon-wrapper bg-warning" style="width: 48px; height: 48px;  display: inline-flex; align-items: center; justify-content: center; border-radius: 10px; color: #fff; font-size: 24px; margin-bottom: 14px; margin: 0px 10px 0px 0px;">
                                    <ion-icon name="arrow-up-outline" role="img" class="md hydrated" aria-label="arrow up outline"></ion-icon>
                                </div>
                            <?php elseif ($history['type'] == 'credit' && $history['status'] == "pending") : ?>
                                <div class="icon-wrapper bg-warning" style="width: 48px; height: 48px;  display: inline-flex; align-items: center; justify-content: center; border-radius: 10px; color: #fff; font-size: 24px; margin-bottom: 14px; margin: 0px 10px 0px 0px;">
                                    <ion-icon name="arrow-down-outline" role="img" class="md hydrated" aria-label="arrow down outline"></ion-icon>
                                </div>
                            <?php else : ?>
                                <div class="icon-wrapper bg-success" style="width: 48px; height: 48px;  display: inline-flex; align-items: center; justify-content: center; border-radius: 10px; color: #fff; font-size: 24px; margin-bottom: 14px; margin: 0px 10px 0px 0px;">
                                    <ion-icon name="arrow-down-outline" role="img" class="md hydrated" aria-label="arrow down outline"></ion-icon>
                                </div>
                            <?php endif;
                            ?>
                            <!-- <img src="assets/img/sample/brand/1.jpg" alt="img" class="image-block imaged w48"> -->
                            <div>
                                <strong><?= ucwords($history['title']); ?></strong>
                                <p><?= $history['method']; ?></p>
                            </div>
                        </div>
                        <div class="right">
                            <?php echo ($history['type'] != 'credit') ? '<div class="price text-danger"> - ' . $coin . ' ' . number_format($history['amount'], 2) . '</div>' : '<div class="price">+ ' . $coin . ' ' . number_format($history['amount'], 2) . '</div>' ?>
                            <p class="<?= ($history['status'] == 'pending') ? 'text-warning' : '' ?>"><?= ($history['status'] == 'pending') ? 'pending' : '' ?></p>
                        </div>
                    </a>
                    <!-- * item -->
                <?php endforeach; ?>
            </div>
        </div>
        <!-- * Transactions -->

        <!-- News -->
        <div class="section full mt-4 mb-3">

        </div>
        <!-- * News -->


        <!-- DialogIconedSuccess -->
        <div class="modal fade dialogbox" id="DialogIconedSuccess" data-bs-backdrop="static" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-icon text-success">
                        <ion-icon name="checkmark-circle"></ion-icon>
                    </div>
                    <div class="modal-header">
                        <h5 class="modal-title">Success</h5>
                    </div>
                    <div class="modal-body">
                        Transaction Successful!
                    </div>
                    <div class="modal-footer" id="closeModal">
                        <div class="btn-inline">
                            <a href="#" class="btn" data-bs-dismiss="modal">CLOSE</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
<!-- Success Action Sheet -->
    <div id="toast-11" class="toast-box toast-center" style="z-index: 999999999999;">
        <div class="in">
            <ion-icon name="checkmark-circle" class="text-success md hydrated" role="img" aria-label="checkmark circle"></ion-icon>
            <div class="text" id="succ-modal">
                Success Message
            </div>
        </div>
        <a href =""><button type="button" id="close-success-btn" class="btn btn-sm btn-text-light close-button close">CLOSE</button></a>
    </div>
    
    <!-- Failed Action Sheet -->
<div id="toast-90" class="toast-box toast-center" style="z-index: 99999999999;">
    <div class="in">
        <ion-icon name="close-circle" role="img" class="text-danger md hydrated" aria-label="close circle"></ion-icon>
        <div class="text" id="failed-modal">
            Failed Message
        </div>
    </div>
    <button type="button" id="close-error-btn" class="btn btn-sm btn-text-light close-button">CLOSE</button>
</div>

        <!-- * DialogIconedSuccess -->
        <!-- * App Sidebar -->

        <!-- app footer -->
        <div class="appFooter">
            <div class="footer-title">
                Copyright © DitePay <?= date('Y') ?>.
            </div>
            All Rights Reserved.
        </div>
        <!-- * app footer -->

        <script src="https://js.paystack.co/v1/inline.js"></script>
        <script type="text/javascript">
            $("#DepositForm").submit(function(e) {
                e.preventDefault();
                var formData = new FormData($("#DepositForm")[0]);
                $thiss = $(this).find("[type=submit]");
                $thiss.text("please wait...");
                $thiss.addClass("disabled");
                // console.log(formData);
                $.ajax({
                    url: 'backend/deposit',
                    type: 'POST',
                    data: formData,
                    // dataType: "json",
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        //   console.log(data);
                        data = $.parseJSON(data)
                        if (data.status == true) {
                            if ($('#account1').val() == 'bank_transfer') {
                                deposs = document.querySelector('.deposs')
                                // if ($('#amount').val() < 50000) {
                                //     deposs.innerHTML = `<h3> Make <?= $coin ?>${$('#amount').val()}  Deposit to: </h3>
                                //     <p> Account No: <?= $user->account_number ?> <br>
                                //     Account Name: <?= $user->account_name ?> <br>
                                //     Bank Name: <?= $user->account_bank ?> </p>`
                                // } else {
                                deposs.innerHTML = `<h3> Make <?= $coin ?>${$('#amount').val()}  Deposit to: </h3>
                                    <p> Account No: <?= $settings->site_acc_no ?> <br>
                                    Account Name: <?= $settings->site_acc_name ?> <br>
                                    Bank Name: <?= $settings->site_bank ?> </p>
                                    <h1 id="demo"> </h1> `
                                // }
                            } else {
                                window.location.href = 'backend/deposit/?payload=' + data.data.trans_id + '&user=<?= $user->email ?>&amount=' + data.data.amount + '&method=' + data.data.method;
                            }

                        } else {
                            $thiss.text("Deposit");
                            $thiss.removeClass("disabled");
                            alert(data.msg);
                            console.log(data);
                        }
                    }
                });
            })


            let countDown = () => {
                var countDownDate = new Date().getTime() + 200000;

                // Update the count down every 1 second
                var x = setInterval(() => {
                    var distance = countDownDate - new Date().getTime();

                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    // Display the result in the element with id="demo"
                    document.getElementById("demo").innerHTML = minutes + "Mins : " + seconds + "Secs";

                    // If the count down is finished, write some text
                    if (distance < 0) {
                        clearInterval(x);
                        document.getElementById("demo").innerHTML = "0:00:00";
                        window.location.reload();
                    }
                }, 1000);
            }

            countDown()

            $('#bnk_tnf').click(() => {
                $('.methodAction').text('Recieve Money')
                $('.cardDepos').css('display', 'none')
                $('.bankDepos').css('display', 'block')
            })

            $('#card_dps').click(() => {
                $('.methodAction').text('Card Deposit')
                $('.cardDepos').css('display', 'block')
                $('.bankDepos').css('display', 'none')
            });
            
            
            $('#ContinueGiftPin').on('click', function(){
               $("#SelectGiftPinType").modal('show');
            });
            
            // gift redeem function
            $('#GiftRedeemForm').on('submit', function (e) {
              e.preventDefault();
                var formData = new FormData($("#GiftRedeemForm")[0]);
                $thiss = $(this).find("[type=submit]");
                $thiss.text("please wait...");
                $thiss.addClass("disabled");
                
                $.ajax({
                    url: 'backend/giftpin?action=redeem',
                    type: 'POST',
                    data: formData,
                    dataType: "json",
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                $thiss.text('Redeem Pin');
                $thiss.removeClass("disabled");
                        
                      if(data.status == 'false'){
                          $('#GiftRedeemForm').trigger('reset');
                          $("#failed-modal").html(data.msg);
                          toastbox('toast-90');
                      }else if(data.status == 'true'){
                          
                        $("#succ-modal").html(data.msg);
                        toastbox('toast-11');
                        
                       $("#close-success-btn").click(function(e){
                             e.preventDefault();
                             window.location = "";    
                        });
                            
                      }
                    }
            })
        })
        
          $('#GiftbuyForm').on('submit', function (e) {
              e.preventDefault();
                var formData = new FormData($("#GiftbuyForm")[0]);
                $thiss = $(this).find("[type=submit]");
                $thiss.text("please wait...");
                $thiss.addClass("disabled");
                
                $.ajax({
                    url: 'backend/giftpin?action=buy',
                    type: 'POST',
                    data: formData,
                    dataType: "json",
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                $thiss.text('Redeem Pin');
                $thiss.removeClass("disabled");
                
                      if(data.status == 'false'){
                          $('#GiftbuyForm').trigger('reset');
                          $("#failed-modal").html(data.msg);
                          toastbox('toast-90');
                          
                      }else if(data.status == 'true'){
                         $("#succ-modal").html(data.msg);
                         toastbox('toast-11');
                        $("#close-success-btn").click(function(e){
                             e.preventDefault();
                             window.location = "";    
                        });
                      }
                    }
            })
        })
            
        </script>
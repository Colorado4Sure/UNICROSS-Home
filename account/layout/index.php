<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class="form-head mb-4">
            <h2 class="text-black font-w600 mb-0">Dashboard</h2>
        </div>
        <div class="row">
            <div class="col-xl-9 col-xxl-12">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card stacked-2">
                            <div class="card-header flex-wrap border-0 pb-0 align-items-end">
                                <div class="d-flex align-items-center mb-3 me-3">
                                    <svg class="me-3" width="68" height="68" viewBox="0 0 68 68" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M59.4999 31.688V19.8333C59.4999 19.0818 59.2014 18.3612 58.6701 17.8298C58.1387 17.2985 57.418 17 56.6666 17H11.3333C10.5818 17 9.86114 16.7014 9.32978 16.1701C8.79843 15.6387 8.49992 14.9181 8.49992 14.1666C8.49992 13.4152 8.79843 12.6945 9.32978 12.1632C9.86114 11.6318 10.5818 11.3333 11.3333 11.3333H56.6666C57.418 11.3333 58.1387 11.0348 58.6701 10.5034C59.2014 9.97208 59.4999 9.25141 59.4999 8.49996C59.4999 7.74851 59.2014 7.02784 58.6701 6.49649C58.1387 5.96514 57.418 5.66663 56.6666 5.66663H11.3333C9.07891 5.66663 6.9169 6.56216 5.32284 8.15622C3.72878 9.75028 2.83325 11.9123 2.83325 14.1666V53.8333C2.83325 56.0876 3.72878 58.2496 5.32284 59.8437C6.9169 61.4378 9.07891 62.3333 11.3333 62.3333H56.6666C57.418 62.3333 58.1387 62.0348 58.6701 61.5034C59.2014 60.9721 59.4999 60.2514 59.4999 59.5V47.6453C61.1561 47.0683 62.5917 45.9902 63.6076 44.5605C64.6235 43.1308 65.1693 41.4205 65.1693 39.6666C65.1693 37.9128 64.6235 36.2024 63.6076 34.7727C62.5917 33.3431 61.1561 32.265 59.4999 31.688ZM53.8333 56.6666H11.3333C10.5818 56.6666 9.86114 56.3681 9.32978 55.8368C8.79843 55.3054 8.49992 54.5847 8.49992 53.8333V22.1453C9.40731 22.4809 10.3658 22.6572 11.3333 22.6666H53.8333V31.1666H45.3333C43.0789 31.1666 40.9169 32.0622 39.3228 33.6562C37.7288 35.2503 36.8333 37.4123 36.8333 39.6666C36.8333 41.921 37.7288 44.083 39.3228 45.677C40.9169 47.2711 43.0789 48.1666 45.3333 48.1666H53.8333V56.6666ZM56.6666 42.5H45.3333C44.5818 42.5 43.8611 42.2015 43.3298 41.6701C42.7984 41.1387 42.4999 40.4181 42.4999 39.6666C42.4999 38.9152 42.7984 38.1945 43.3298 37.6632C43.8611 37.1318 44.5818 36.8333 45.3333 36.8333H56.6666C57.418 36.8333 58.1387 37.1318 58.6701 37.6632C59.2014 38.1945 59.4999 38.9152 59.4999 39.6666C59.4999 40.4181 59.2014 41.1387 58.6701 41.6701C58.1387 42.2015 57.418 42.5 56.6666 42.5Z" fill="#1EAAE7" />
                                    </svg>
                                    <div class="me-auto">
                                        <h5 class="fs-20 text-black font-w600">Main Balance</h5>
                                        <span class="text-num text-black font-w600"><?= $coin . ' ' . number_format($user->balance, 2); ?></span>
                                    </div>
                                </div>
                                <div class="dropdown mb-auto">
                                    <div class="btn-link" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10 11.9999C10 13.1045 10.8954 13.9999 12 13.9999C13.1046 13.9999 14 13.1045 14 11.9999C14 10.8954 13.1046 9.99994 12 9.99994C10.8954 9.99994 10 10.8954 10 11.9999Z" fill="black" />
                                            <path d="M10 4.00006C10 5.10463 10.8954 6.00006 12 6.00006C13.1046 6.00006 14 5.10463 14 4.00006C14 2.89549 13.1046 2.00006 12 2.00006C10.8954 2.00006 10 2.89549 10 4.00006Z" fill="black" />
                                            <path d="M10 20C10 21.1046 10.8954 22 12 22C13.1046 22 14 21.1046 14 20C14 18.8954 13.1046 18 12 18C10.8954 18 10 18.8954 10 20Z" fill="black" />
                                        </svg>
                                    </div>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="javascript:void(0)">Send Money</a>
                                        <a class="dropdown-item" href="javascript:void(0)">Request Money</a>
                                    </div>
                                </div>
                            </div>

                            <style>
                                .single-payment {
                                    width: 100%;
                                    max-width: 50%;
                                    float: left;
                                    padding: 10px;
                                    text-align: center;
                                }

                                .single-payment img {
                                    width: 80%;
                                }

                                .payment {
                                    border: 1px solid #8d8d8d38;
                                    display: inline-block;
                                    border-radius: 10px;
                                    margin-top: 20px;
                                }

                                .form-check.single-payment:first-child {
                                    border-right: 1px dotted #8d8d8d38;
                                }

                                .radio-payment {
                                    display: inline-block;
                                    text-align: center;
                                    margin-left: 20px;
                                }

                                .pay-label {
                                    margin-top: -15px;
                                    text-align: center;
                                    width: 100%;
                                }

                                .payment-m {
                                    background: #ffff;
                                    display: inline-block;
                                    width: 160px;
                                }
                            </style>
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-xl-3 mb-3 col-xxl-12 col-sm-6">
                                        <a class="btn btn-outline-primary rounded d-block btn-lg" data-bs-toggle="modal" data-bs-target="#newspends">+Add Money</a>
                                        <div class="modal fade" id="newspends">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Deposit Money</h5>
                                                        <button type="button" class="close" data-bs-dismiss="modal"><span>&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card-body">
                                                            <div class="message hide" style="background: #fe8024;text-align: center;color: #fff;padding: 10px;border-radius: 10px;margin-bottom: 10px;"></div>

                                                            <div class="basic-form">
                                                                <form id="DepositForm" method="POST">
                                                                    <div class="input-group mb-3">
                                                                        <span class="input-group-text search_icon"><?= $coin ?></span>
                                                                        <input type="text" class="form-control" name=amount id=amount placeholder="100" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                                                    </div>

                                                                    <div class="payment">
                                                                        <div class="pay-label">
                                                                            <div class="payment-m">payment method</div>
                                                                        </div>
                                                                        <div class="form-check single-payment">
                                                                            <div class="radio-payment">
                                                                                <input class="form-check-input" type="radio" name="method" id="flutterwave" value="flutterwave" checked="">
                                                                            </div>
                                                                            <label class="form-check-label" for="flutterwave">
                                                                                <img src="assets/images/flutterwave.png" alt="" srcset="">
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check single-payment">
                                                                            <div class="radio-payment">
                                                                                <input class="form-check-input" type="radio" name="method" id="paystack" value="paystack">
                                                                            </div>
                                                                            <label class="form-check-label" for="paystack">
                                                                                <img src="assets/images/paystack.png" alt="" srcset="">
                                                                            </label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="modal-footers" style="margin-top: 40px;text-align: center;">
                                                                        <button type="submit" class="btn btn-lg btn-primary" style="width: 60%;">Pay Now</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script src="https://js.paystack.co/v1/inline.js"> </script>
                    <script>
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
                                        $thiss.text("Pay Now");
                                        $thiss.removeClass("disabled");
                                        $(".message").text(data.message)
                                        // alert(data.msg);
                                        console.log(data);
                                    }
                                },
                                fail: (err) => {
                                    console.log(err);
                                }
                            });
                        })
                    </script>


                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header d-block d-sm-flex border-0">
                                <div class="me-3">
                                    <h4 class="fs-20 text-black">Transactions</h4>
                                    <p class="mb-0 fs-13">This shows all your frequent transactions.</p>
                                </div>
                                <div class="card-action card-tabs mt-3 mt-sm-0">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#all-trans" role="tab">All Trans</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#credit" role="tab">Credits</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#debit" role="tab">Debits</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body tab-content p-0">

                                <?php
                                if ($app->history()['status'] === false) { ?>
                                    <a class="item">
                                        <div class="detail">
                                            <?= $app->history()['message']; ?>
                                        </div>
                                    </a>
                                <?php
                                } ?>

                                <div class="tab-pane active show fade" id="all-trans" role="tabpanel">
                                    <div class="table-responsive">
                                        <table class="table table-responsive-md card-table previous-transactions">
                                            <tbody>
                                                <?php $in = 0;
                                                foreach ($app->history()['data']['rows'] as $history) :
                                                    if ($in++ > 4) {
                                                        break;
                                                    }

                                                    // if ($history['status'] === 'success') {
                                                    // continue;
                                                ?>
                                                    <tr>
                                                        <?php if ($history['type'] == 'credit') { ?>
                                                            <td>
                                                                <svg width="63" height="63" viewBox="0 0 63 63" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <rect x="1.00002" y="1" width="61" height="61" rx="29" stroke="#2BC155" stroke-width="2" />
                                                                    <g clip-path="url(#clip0)">
                                                                        <path d="M35.2219 42.9875C34.8938 42.3094 35.1836 41.4891 35.8617 41.1609C37.7484 40.2531 39.3453 38.8422 40.4828 37.0758C41.6477 35.2656 42.2656 33.1656 42.2656 31C42.2656 24.7875 37.2125 19.7344 31 19.7344C24.7875 19.7344 19.7344 24.7875 19.7344 31C19.7344 33.1656 20.3523 35.2656 21.5117 37.0813C22.6437 38.8477 24.2461 40.2586 26.1328 41.1664C26.8109 41.4945 27.1008 42.3094 26.7727 42.993C26.4445 43.6711 25.6297 43.9609 24.9461 43.6328C22.6 42.5063 20.6148 40.7563 19.2094 38.5578C17.7656 36.3047 17 33.6906 17 31C17 27.2594 18.4547 23.743 21.1016 21.1016C23.743 18.4547 27.2594 17 31 17C34.7406 17 38.257 18.4547 40.8984 21.1016C43.5453 23.7484 45 27.2594 45 31C45 33.6906 44.2344 36.3047 42.7852 38.5578C41.3742 40.7508 39.3891 42.5063 37.0484 43.6328C36.3648 43.9555 35.55 43.6711 35.2219 42.9875Z" fill="#2BC155" />
                                                                        <path d="M36.3211 31.7274C36.5891 31.9953 36.7203 32.3453 36.7203 32.6953C36.7203 33.0453 36.5891 33.3953 36.3211 33.6633L32.8812 37.1031C32.3781 37.6063 31.7109 37.8797 31.0055 37.8797C30.3 37.8797 29.6273 37.6008 29.1297 37.1031L25.6898 33.6633C25.1539 33.1274 25.1539 32.2633 25.6898 31.7274C26.2258 31.1914 27.0898 31.1914 27.6258 31.7274L29.6437 33.7453L29.6437 25.9742C29.6437 25.2196 30.2562 24.6071 31.0109 24.6071C31.7656 24.6071 32.3781 25.2196 32.3781 25.9742L32.3781 33.7508L34.3961 31.7328C34.9211 31.1969 35.7852 31.1969 36.3211 31.7274Z" fill="#2BC155" />
                                                                    </g>
                                                                    <defs>
                                                                        <clippath id="clip0">
                                                                            <rect width="28" height="28" fill="white" transform="matrix(-4.37114e-08 1 1 4.37114e-08 17 17)" />
                                                                        </clippath>
                                                                    </defs>
                                                                </svg>
                                                            </td>
                                                        <?php } else { ?>

                                                            <td>
                                                                <svg width="63" height="63" viewBox="0 0 63 63" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <rect x="1" y="1" width="61" height="61" rx="29" stroke="#FF2E2E" stroke-width="2" />
                                                                    <g clip-path="url(#clip1)">
                                                                        <path d="M35.2219 19.0125C34.8937 19.6906 35.1836 20.5109 35.8617 20.8391C37.7484 21.7469 39.3453 23.1578 40.4828 24.9242C41.6476 26.7344 42.2656 28.8344 42.2656 31C42.2656 37.2125 37.2125 42.2656 31 42.2656C24.7875 42.2656 19.7344 37.2125 19.7344 31C19.7344 28.8344 20.3523 26.7344 21.5117 24.9187C22.6437 23.1523 24.2461 21.7414 26.1328 20.8336C26.8109 20.5055 27.1008 19.6906 26.7726 19.007C26.4445 18.3289 25.6297 18.0391 24.9461 18.3672C22.6 19.4937 20.6148 21.2437 19.2094 23.4422C17.7656 25.6953 17 28.3094 17 31C17 34.7406 18.4547 38.257 21.1015 40.8984C23.743 43.5453 27.2594 45 31 45C34.7406 45 38.257 43.5453 40.8984 40.8984C43.5453 38.2516 45 34.7406 45 31C45 28.3094 44.2344 25.6953 42.7851 23.4422C41.3742 21.2492 39.389 19.4937 37.0484 18.3672C36.3648 18.0445 35.55 18.3289 35.2219 19.0125Z" fill="#FF2E2E" />
                                                                        <path d="M36.3211 30.2726C36.589 30.0047 36.7203 29.6547 36.7203 29.3047C36.7203 28.9547 36.589 28.6047 36.3211 28.3367L32.8812 24.8969C32.3781 24.3937 31.7109 24.1203 31.0055 24.1203C30.3 24.1203 29.6273 24.3992 29.1297 24.8969L25.6898 28.3367C25.1539 28.8726 25.1539 29.7367 25.6898 30.2726C26.2258 30.8086 27.0898 30.8086 27.6258 30.2726L29.6437 28.2547L29.6437 36.0258C29.6437 36.7804 30.2562 37.3929 31.0109 37.3929C31.7656 37.3929 32.3781 36.7804 32.3781 36.0258L32.3781 28.2492L34.3961 30.2672C34.9211 30.8031 35.7851 30.8031 36.3211 30.2726Z" fill="#FF2E2E" />
                                                                    </g>
                                                                    <defs>
                                                                        <clippath id="clip1">
                                                                            <rect width="28" height="28" fill="white" transform="translate(17 45) rotate(-90)" />
                                                                        </clippath>
                                                                    </defs>
                                                                </svg>
                                                            </td>
                                                        <?php } ?>
                                                        <td>
                                                            <h6 class="fs-16 font-w600 mb-0"><a href="txn-history?trans_id=<?= $history['trans_id']; ?>" class="text-black"> <?= ucwords($history['title']); ?> </a>
                                                            </h6>
                                                            <span class="fs-14"><?= $history['method']; ?></span>
                                                        </td>
                                                        <td>
                                                            <h6 class="fs-16 text-black font-w400 mb-0">June 4, 2020</h6>
                                                            <span class="fs-14">05:34</span>
                                                        </td>
                                                        <td><span class="fs-16 text-black font-w500"> <?php echo ($history['type'] != 'credit') ? '-' . $coin . ' ' . number_format($history['amount'], 2) : '+' . $coin . ' ' . number_format($history['amount'], 2) ?>
                                                            </span></td>
                                                        <td><span class="<?= ($history['status'] == 'pending') ? 'text-warning' : (($history['status'] == 'success') ? 'text-success' : "text-dark") ?>  fs-16 font-w500 text-end d-block"><?= $history['status'] ?></span></td>
                                                    </tr>

                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- * Transactions -->

                                <div class="tab-pane show fade" id="credit" role="tabpanel">
                                    <div class="table-responsive">
                                        <table class="table table-responsive-md card-table previous-transactions">
                                            <tbody>
                                                <?php $i = 0;
                                                foreach ($app->history()['data']['rows'] as $history) :
                                                    if ($i++ > 4) {
                                                        break;
                                                    }

                                                    if ($history['type'] === 'debit')
                                                        continue;
                                                ?>
                                                    <tr>
                                                        <td>
                                                            <svg width="63" height="63" viewBox="0 0 63 63" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <rect x="1.00002" y="1" width="61" height="61" rx="29" stroke="#2BC155" stroke-width="2" />
                                                                <g clip-path="url(#clip0)">
                                                                    <path d="M35.2219 42.9875C34.8938 42.3094 35.1836 41.4891 35.8617 41.1609C37.7484 40.2531 39.3453 38.8422 40.4828 37.0758C41.6477 35.2656 42.2656 33.1656 42.2656 31C42.2656 24.7875 37.2125 19.7344 31 19.7344C24.7875 19.7344 19.7344 24.7875 19.7344 31C19.7344 33.1656 20.3523 35.2656 21.5117 37.0813C22.6437 38.8477 24.2461 40.2586 26.1328 41.1664C26.8109 41.4945 27.1008 42.3094 26.7727 42.993C26.4445 43.6711 25.6297 43.9609 24.9461 43.6328C22.6 42.5063 20.6148 40.7563 19.2094 38.5578C17.7656 36.3047 17 33.6906 17 31C17 27.2594 18.4547 23.743 21.1016 21.1016C23.743 18.4547 27.2594 17 31 17C34.7406 17 38.257 18.4547 40.8984 21.1016C43.5453 23.7484 45 27.2594 45 31C45 33.6906 44.2344 36.3047 42.7852 38.5578C41.3742 40.7508 39.3891 42.5063 37.0484 43.6328C36.3648 43.9555 35.55 43.6711 35.2219 42.9875Z" fill="#2BC155" />
                                                                    <path d="M36.3211 31.7274C36.5891 31.9953 36.7203 32.3453 36.7203 32.6953C36.7203 33.0453 36.5891 33.3953 36.3211 33.6633L32.8812 37.1031C32.3781 37.6063 31.7109 37.8797 31.0055 37.8797C30.3 37.8797 29.6273 37.6008 29.1297 37.1031L25.6898 33.6633C25.1539 33.1274 25.1539 32.2633 25.6898 31.7274C26.2258 31.1914 27.0898 31.1914 27.6258 31.7274L29.6437 33.7453L29.6437 25.9742C29.6437 25.2196 30.2562 24.6071 31.0109 24.6071C31.7656 24.6071 32.3781 25.2196 32.3781 25.9742L32.3781 33.7508L34.3961 31.7328C34.9211 31.1969 35.7852 31.1969 36.3211 31.7274Z" fill="#2BC155" />
                                                                </g>
                                                                <defs>
                                                                    <clippath id="clip0">
                                                                        <rect width="28" height="28" fill="white" transform="matrix(-4.37114e-08 1 1 4.37114e-08 17 17)" />
                                                                    </clippath>
                                                                </defs>
                                                            </svg>
                                                        </td>

                                                        <td>
                                                            <h6 class="fs-16 font-w600 mb-0"><a href="txn-history?trans_id=<?= $history['trans_id']; ?>" class="text-black"> <?= ucwords($history['title']); ?> </a>
                                                            </h6>
                                                            <span class="fs-14"><?= $history['method']; ?></span>
                                                        </td>
                                                        <td>
                                                            <h6 class="fs-16 text-black font-w400 mb-0">June 4, 2020</h6>
                                                            <span class="fs-14">05:34</span>
                                                        </td>
                                                        <td><span class="fs-16 text-black font-w500"> <?php echo ($history['type'] != 'credit') ? '-' . $coin . ' ' . number_format($history['amount'], 2) : '+' . $coin . ' ' . number_format($history['amount'], 2) ?>
                                                            </span></td>
                                                        <td><span class="<?= ($history['status'] == 'pending') ? 'text-warning' : (($history['status'] == 'success') ? 'text-success' : "text-dark") ?>  fs-16 font-w500 text-end d-block"><?= $history['status'] ?></span></td>
                                                    </tr>

                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane show fade" id="debit" role="tabpanel">
                                    <div class="table-responsive">
                                        <table class="table card-table previous-transactions">
                                            <tbody>
                                                <?php $i = 0;
                                                foreach ($app->history()['data']['rows'] as $history) :
                                                    if ($i++ > 4) {
                                                        break;
                                                    }

                                                    if ($history['type'] === 'credit')
                                                        continue;
                                                ?>
                                                    <tr>
                                                        <?php if ($history['type'] == 'credit') { ?>
                                                            <td>
                                                                <svg width="63" height="63" viewBox="0 0 63 63" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <rect x="1.00002" y="1" width="61" height="61" rx="29" stroke="#2BC155" stroke-width="2" />
                                                                    <g clip-path="url(#clip0)">
                                                                        <path d="M35.2219 42.9875C34.8938 42.3094 35.1836 41.4891 35.8617 41.1609C37.7484 40.2531 39.3453 38.8422 40.4828 37.0758C41.6477 35.2656 42.2656 33.1656 42.2656 31C42.2656 24.7875 37.2125 19.7344 31 19.7344C24.7875 19.7344 19.7344 24.7875 19.7344 31C19.7344 33.1656 20.3523 35.2656 21.5117 37.0813C22.6437 38.8477 24.2461 40.2586 26.1328 41.1664C26.8109 41.4945 27.1008 42.3094 26.7727 42.993C26.4445 43.6711 25.6297 43.9609 24.9461 43.6328C22.6 42.5063 20.6148 40.7563 19.2094 38.5578C17.7656 36.3047 17 33.6906 17 31C17 27.2594 18.4547 23.743 21.1016 21.1016C23.743 18.4547 27.2594 17 31 17C34.7406 17 38.257 18.4547 40.8984 21.1016C43.5453 23.7484 45 27.2594 45 31C45 33.6906 44.2344 36.3047 42.7852 38.5578C41.3742 40.7508 39.3891 42.5063 37.0484 43.6328C36.3648 43.9555 35.55 43.6711 35.2219 42.9875Z" fill="#2BC155" />
                                                                        <path d="M36.3211 31.7274C36.5891 31.9953 36.7203 32.3453 36.7203 32.6953C36.7203 33.0453 36.5891 33.3953 36.3211 33.6633L32.8812 37.1031C32.3781 37.6063 31.7109 37.8797 31.0055 37.8797C30.3 37.8797 29.6273 37.6008 29.1297 37.1031L25.6898 33.6633C25.1539 33.1274 25.1539 32.2633 25.6898 31.7274C26.2258 31.1914 27.0898 31.1914 27.6258 31.7274L29.6437 33.7453L29.6437 25.9742C29.6437 25.2196 30.2562 24.6071 31.0109 24.6071C31.7656 24.6071 32.3781 25.2196 32.3781 25.9742L32.3781 33.7508L34.3961 31.7328C34.9211 31.1969 35.7852 31.1969 36.3211 31.7274Z" fill="#2BC155" />
                                                                    </g>
                                                                    <defs>
                                                                        <clippath id="clip0">
                                                                            <rect width="28" height="28" fill="white" transform="matrix(-4.37114e-08 1 1 4.37114e-08 17 17)" />
                                                                        </clippath>
                                                                    </defs>
                                                                </svg>
                                                            </td>
                                                        <?php } else { ?>

                                                            <td>
                                                                <svg width="63" height="63" viewBox="0 0 63 63" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <rect x="1" y="1" width="61" height="61" rx="29" stroke="#FF2E2E" stroke-width="2" />
                                                                    <g clip-path="url(#clip1)">
                                                                        <path d="M35.2219 19.0125C34.8937 19.6906 35.1836 20.5109 35.8617 20.8391C37.7484 21.7469 39.3453 23.1578 40.4828 24.9242C41.6476 26.7344 42.2656 28.8344 42.2656 31C42.2656 37.2125 37.2125 42.2656 31 42.2656C24.7875 42.2656 19.7344 37.2125 19.7344 31C19.7344 28.8344 20.3523 26.7344 21.5117 24.9187C22.6437 23.1523 24.2461 21.7414 26.1328 20.8336C26.8109 20.5055 27.1008 19.6906 26.7726 19.007C26.4445 18.3289 25.6297 18.0391 24.9461 18.3672C22.6 19.4937 20.6148 21.2437 19.2094 23.4422C17.7656 25.6953 17 28.3094 17 31C17 34.7406 18.4547 38.257 21.1015 40.8984C23.743 43.5453 27.2594 45 31 45C34.7406 45 38.257 43.5453 40.8984 40.8984C43.5453 38.2516 45 34.7406 45 31C45 28.3094 44.2344 25.6953 42.7851 23.4422C41.3742 21.2492 39.389 19.4937 37.0484 18.3672C36.3648 18.0445 35.55 18.3289 35.2219 19.0125Z" fill="#FF2E2E" />
                                                                        <path d="M36.3211 30.2726C36.589 30.0047 36.7203 29.6547 36.7203 29.3047C36.7203 28.9547 36.589 28.6047 36.3211 28.3367L32.8812 24.8969C32.3781 24.3937 31.7109 24.1203 31.0055 24.1203C30.3 24.1203 29.6273 24.3992 29.1297 24.8969L25.6898 28.3367C25.1539 28.8726 25.1539 29.7367 25.6898 30.2726C26.2258 30.8086 27.0898 30.8086 27.6258 30.2726L29.6437 28.2547L29.6437 36.0258C29.6437 36.7804 30.2562 37.3929 31.0109 37.3929C31.7656 37.3929 32.3781 36.7804 32.3781 36.0258L32.3781 28.2492L34.3961 30.2672C34.9211 30.8031 35.7851 30.8031 36.3211 30.2726Z" fill="#FF2E2E" />
                                                                    </g>
                                                                    <defs>
                                                                        <clippath id="clip1">
                                                                            <rect width="28" height="28" fill="white" transform="translate(17 45) rotate(-90)" />
                                                                        </clippath>
                                                                    </defs>
                                                                </svg>
                                                            </td>
                                                        <?php } ?>
                                                        <td>
                                                            <h6 class="fs-16 font-w600 mb-0"><a href="txn-history?trans_id=<?= $history['trans_id']; ?>" class="text-black"> <?= ucwords($history['title']); ?> </a>
                                                            </h6>
                                                            <span class="fs-14"><?= $history['method']; ?></span>
                                                        </td>
                                                        <td>
                                                            <h6 class="fs-16 text-black font-w400 mb-0">June 4, 2020</h6>
                                                            <span class="fs-14">05:34</span>
                                                        </td>
                                                        <td><span class="fs-16 text-black font-w500"> <?php echo ($history['type'] != 'credit') ? '-' . $coin . ' ' . number_format($history['amount'], 2) : '+' . $coin . ' ' . number_format($history['amount'], 2) ?>
                                                            </span></td>
                                                        <td><span class="<?= ($history['status'] == 'pending') ? 'text-warning' : (($history['status'] == 'success') ? 'text-success' : "text-dark") ?>  fs-16 font-w500 text-end d-block"><?= $history['status'] ?></span></td>
                                                    </tr>

                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body pb-1">
                                <div class="row align-items-center">
                                    <div class="col-xl-5 col-xxl-12 col-md-5">
                                        <h4 class="fs-20 text-black mb-4">Registered Courses</h4>
                                        <div class="row">
                                            Coming Soon...
                                            <!-- <div class="d-flex col-xl-12 col-xxl-6  col-md-12 col-sm-6 mb-4">
                                                <svg class="me-3" width="14" height="54" viewBox="0 0 14 54" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect x="-6.10352e-05" width="14" height="54" rx="7" fill="#AC39D4" />
                                                </svg>
                                                <div>
                                                    <p class="fs-14 mb-2">2017/2018 Session</p>
                                                    <span class="fs-18 font-w500"><span class="text-black me-2">1st & 2nd Semester</span></span>
                                                </div>
                                            </div>
                                            <div class="d-flex col-xl-12 col-xxl-6 col-md-12 col-sm-6 mb-4">
                                                <svg class="me-3" width="14" height="54" viewBox="0 0 14 54" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect x="-6.10352e-05" width="14" height="54" rx="7" fill="#40D4A8" />
                                                </svg>
                                                <div>
                                                    <p class="fs-14 mb-2">2019/2020 Session</p>
                                                    <span class="fs-18 font-w500"><span class="text-black me-2">1st & 2nd Semester</span></span>
                                                </div>
                                            </div>
                                            <div class="d-flex col-xl-12 col-xxl-6 col-md-12 col-sm-6 mb-4">
                                                <svg class="me-3" width="14" height="54" viewBox="0 0 14 54" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect x="-6.10352e-05" width="14" height="54" rx="7" fill="#1EB6E7" />
                                                </svg>
                                                <div>
                                                    <p class="fs-14 mb-2">2021/2022 Session</p>
                                                    <span class="fs-18 font-w500"><span class="text-black me-2">1st & 2nd Semester</span></span>
                                                </div>
                                            </div>
                                            <div class="d-flex col-xl-12 col-xxl-6 col-md-12 col-sm-6 mb-4">
                                                <svg class="me-3" width="14" height="54" viewBox="0 0 14 54" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect x="-6.10352e-05" width="14" height="54" rx="7" fill="#461EE7" />
                                                </svg>
                                                <div>
                                                    <p class="fs-14 mb-2">2023/2024 Session</p>
                                                    <span class="fs-18 font-w500"><span class="text-black me-2">1st Semester</span></span>
                                                </div>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
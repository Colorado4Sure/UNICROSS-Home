<!-- content @s -->
<?php 
if ($user->type !== 'super-admin') return false;
$allUsers = array_filter($stats->users, function ($user) {
    if ($user->custom_account_number !== "2038317204")
        return $user;
});
?>
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title"><?= $page; ?></h3>
                            <div class="nk-block-des text-soft">
                                <p>You have total <?= count($allUsers)?> Accounts.</p>
                            </div>
                        </div><!-- .nk-block-head-content -->
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <a href="/admin-cp/generate" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                <div class="toggle-expand-content" data-content="pageMenu">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <div class="drodown">
                                                <a href="/admin-cp/generate" class="btn btn-icon btn-primary"><em class="icon ni ni-plus"></em></a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div><!-- .toggle-wrap -->
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="card card-bordered card-stretch">
                        <div class="card-inner-group">
                            <div class="card-inner position-relative card-tools-toggle">
                                <div class="card-title-group">
                                    <div class="card-tools">
                                        <div class="form-inline flex-nowrap gx-3">
                                            <div class="form-wrap w-150px">
                                                <select class="form-select form-select-sm" data-search="off" data-placeholder="Bulk Action">
                                                    <option value="">Bulk Action</option>
                                                    <option value="suspend">Suspend User</option>
                                                    <option value="delete">Delete User</option>
                                                </select>
                                            </div>
                                            <div class="btn-wrap">
                                                <span class="d-none d-md-block"><button class="btn btn-dim btn-outline-light disabled">Apply</button></span>
                                                <span class="d-md-none"><button class="btn btn-dim btn-outline-light btn-icon disabled"><em class="icon ni ni-arrow-right"></em></button></span>
                                            </div>
                                        </div><!-- .form-inline -->
                                    </div><!-- .card-tools -->
                                    <div class="card-tools mr-n1">
                                        <ul class="btn-toolbar gx-1">
                                            <li>
                                                <a href="#" class="btn btn-icon search-toggle toggle-search" data-target="search"><em class="icon ni ni-search"></em></a>
                                            </li><!-- li -->
                                        </ul><!-- .btn-toolbar -->
                                    </div><!-- .card-tools -->
                                </div><!-- .card-title-group -->
                                <div class="card-search search-wrap" data-search="search">
                                    <div class="card-body">
                                        <div class="search-content">
                                            <a href="#" class="search-back btn btn-icon toggle-search" data-target="search"><em class="icon ni ni-arrow-left"></em></a>
                                            <input type="text" class="form-control border-transparent form-focus-none" placeholder="Search by user or email">
                                            <button class="search-submit btn btn-icon"><em class="icon ni ni-search"></em></button>
                                        </div>
                                    </div>
                                </div><!-- .card-search -->
                            </div><!-- .card-inner -->
                            <div class="card-inner p-0">
                                <table class="nk-tb-list nk-tb-ulist table table-striped table-bordered table-hover data-table">
                                    <thead>
                                        <tr>
                                            <th class="nk-tb-col nk-tb-col-check">
                                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                                    <input type="checkbox" class="custom-control-input" id="uid">
                                                    <label class="custom-control-label" for="uid"></label>
                                                </div>
                                            </th>
                                            <th class="nk-tb-col"><span class="sub-text">User</span></th>
                                            <th class="nk-tb-col"><span class="sub-text">Balance</span></th>
                                            <th class="nk-tb-col tb-col-md"><span class="sub-text">Phone</span></th>
                                            <th class="nk-tb-col tb-col-lg"><span class="sub-text">email</span></th>
                                            <th class="nk-tb-col tb-col-lg"><span class="sub-text">Acc. Reference</span></th>
                                            <th class="nk-tb-col"><span class="sub-text">Action</span></th>
                                        </tr>
                                    </thead><!-- .nk-tb-item -->
                                    <tbody>
                                        <tr class="nk-tb-item ">
                                            <td class="nk-tb-col">
                                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                                    <input type="checkbox" class="custom-control-input" id="uid-1">
                                                    <label class="custom-control-label" for="uid-1"></label>
                                                </div>
                                            </td>
                                            <td class="nk-tb-col">
                                                <a href="virtual-statement/216156030181">
                                                    <div class="user-card">
                                                        </div>
                                                        <div class="user-info">
                                                            <span class="tb-lead">Ditepay Tech</span>
                                                            <span>2038317204</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </td>
                                            <td class="nk-tb-col">
                                                <span class="tb-amount"><?= $coin . number_format((int) $app->checBalance('kuda',  '216156030181')->Data->AvailableBalance / 100, 2) ?></span>
                                            </td>
                                            <td class="nk-tb-col tb-col-md">
                                                <span>07086936654</span>
                                            </td>
                                            <td class="nk-tb-col tb-col-lg">
                                                <span>colorado4sure@gmail.com</span>
                                            </td>
                                            <td class="nk-tb-col tb-col-lg">
                                                <span>216156030181</span>
                                            </td>
                                            <td class="nk-tb-col nk-tb-col-tools">
                                                <ul class="nk-tb-actions gx-1">
                                                    <li>
                                                        <div class="drodown">
                                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <ul class="link-list-opt no-bdr">
                                                                    <li><a href="virtual-statement/216156030181"><em class="icon ni ni-eye"></em><span>View Statement</span></a></li>

                                                                    <li data-toggle="modal" data-target="#view-trans" onclick="data('216156030181')"><a href="#virtual-statement/216156030181"><em class="icon ni ni-edit"></em><span>Withdraw Funds</span></a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr><!-- .nk-tb-item -->

                                        <?php $key = 0;
                                        foreach ($allUsers as $user) :
                                            //if ($key++ == 20) break; 
                                        ?>
                                            <tr class="nk-tb-item <?= $user->id ?>">
                                                <td class="nk-tb-col">
                                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                                        <input type="checkbox" class="custom-control-input" id="uid-<?= $user->id ?>">
                                                        <label class="custom-control-label" for="uid-<?= $user->id ?>"></label>
                                                    </div>
                                                </td>
                                                <td class="nk-tb-col">
                                                    <a href="virtual-statement/<?= $user->reference ?>">
                                                        <div class="user-card">
                                                            <!-- <div class="user-avatar bg-primary">
                                                            <span><?php if ($user->profilepic == '') : $user->fname[0] . $user->lname[0];
                                                                    else : ?>
                                                                    <img src="/account/assets/profilepics/<?= $user->profilepic ?>" alt="">
                                                                <?php endif; ?></span>
                                                        </div> -->
                                                            <div class="user-info">
                                                                <span class="tb-lead"><?= $user->custom_account_name ?></span>
                                                                <span><?= $user->custom_account_number ?></span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </td>
                                                <td class="nk-tb-col">
                                                    <span class="tb-amount"><?= $coin . number_format((int) $app->checBalance('kuda',  $user->reference)->Data->AvailableBalance / 100, 2) ?></span>
                                                </td>
                                                <td class="nk-tb-col tb-col-md">
                                                    <span><?= $user->phone ?></span>
                                                </td>
                                                <td class="nk-tb-col tb-col-lg">
                                                    <span><?= $user->email ?></span>
                                                </td>
                                                <td class="nk-tb-col tb-col-lg">
                                                    <span><?= $user->reference ?></span>
                                                </td>
                                                <td class="nk-tb-col nk-tb-col-tools">
                                                    <ul class="nk-tb-actions gx-1">
                                                        <li>
                                                            <div class="drodown">
                                                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <ul class="link-list-opt no-bdr">
                                                                        <li><a href="virtual-statement/<?= $user->reference ?>"><em class="icon ni ni-eye"></em><span>View Statement</span></a></li>

                                                                        <li data-toggle="modal" data-target="#view-trans" onclick="data('<?= $user->reference ?>')"><a href="#virtual-statement/<?= $user->reference ?>"><em class="icon ni ni-edit"></em><span>Withdraw Funds</span></a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr><!-- .nk-tb-item -->
                                        <?php endforeach; ?>
                                    </tbody>
                                </table><!-- .nk-tb-list -->
                            </div><!-- .card-inner -->
                        </div><!-- .card-inner-group -->
                    </div><!-- .card -->
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
</div>
<!-- content @e -->

<div class="modal fade" tabindex="-1" role="dialog" id="view-trans">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <a href="#cancel" data-dismiss="modal" class="close">
                    <em class="icon ni ni-cross-sm"></em>
                </a>
                <div class="nk-modal-head">
                    <h4 class="nk-modal-title title">Transfer Money</h4>
                </div>
                <div class="nk-tnx-details mt-sm-3" style="padding: 50px;">
                    <form id="withdrw" autocomplete="off">
                        <div class="preview-block">
                            <div class="row gy-4">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <div class="form-icon form-icon-right xl"><em class="icon ni ni-123"></em></div>
                                            <input type="hidden" id="reference" name="from" value="">
                                            <input type="text" name="amount" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control form-control-xl form-control-outlined" id="outlined-right-icon" value="0.00">
                                            <label class="form-label-outlined" for="outlined-right-icon">Amount</label>
                                        </div>
                                    </div>

                                    <div class="form-group" data-select2-id="13">
                                        <div class="form-control-wrap" data-select2-id="12">
                                            <select class="form-select js-select2 select2-hidden-accessible" data-ui="xl" name="bank" data-search="on" tabindex="-1" aria-hidden="true">
                                                <option>Choose Bank</option>
                                                <?php foreach ($app->get_banks()['data'] as $bank) : ?>
                                                    <option value="<?= $bank['bankCode'] ?>" data-select2-id="<?= $bank['bankCode'] ?>"><?= $bank['bankName'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <div class="form-icon form-icon-right xl"><em class="icon ni ni-123"></em></div>
                                            <input type="text" name="account" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control form-control-xl form-control-outlined" id="account_number" maxlength="10" placeholder="2117502325">
                                            <label class="form-label-outlined" for="account_number">Account number</label>
                                        </div>
                                    </div>

                                    <div class="form-group" id="account_name" style="display: none">
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

                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <div class="form-icon form-icon-right xl"><em class="icon ni ni-123"></em></div>
                                            <input type="text" class="form-control form-control-xl form-control-outlined" id="description" name="description" placeholder="Description">
                                            <label class="form-label-outlined" for="description">Description</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <div class="form-icon form-icon-right xl"><em class="icon ni ni-123"></em></div>
                                            <input type="password" name="pin" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control form-control-xl form-control-outlined" id="admin_pin" maxlength="6">
                                            <label class="form-label-outlined" for="admin_pin">Admin Pin</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="preview-hr">
                            <div class="form-group">
                                <button type="submit" class="btn ld btn-primary btn-lg btn-block withdraw" disabled>Transfer</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- .modal-dialog -->
</div><!-- .modal -->

<script>
    // validate account details
    $("#account_number").on("keyup", function() {
        if ($("#account_number").val().length == 10) {
            $("#account_name").css("display", "")
            $(".form-man").html('<div class="spinner-border text-dark" role="status"></div>')

            $(".acc_name").html("Loading...")
            var selected = $("#bank_code option:selected").val()

            if (selected == "Select Bank")
                return $(".acc_name").html("<span style='color:red'>Please Select Your Bank</span>");

            var formData = new FormData($('#withdrw')[0]);

            var settings = {
                "url": "<?= $siteurl ?>/trans/verify-account",
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
                if (response.status === true) {
                    $(".acc_name").html("Account Name")
                    $("#account_name").css("display", "")
                    $('.form-man').html(`<input type="text" class="form-control" id="acc_name" name="account_name" value="${response.data.account_name}" disabled>`)
                    $(".withdraw").removeAttr("disabled")
                } else {
                    alert(response.message)
                    $("#account_name").css("display", "none")
                    $('.form-man').html("");
                    $(".withdraw").attr("disabled", true)
                }
                // $(".withdraw").removeAttr("disabled")

            }).fail(function(response) {
                console.log(response);
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

<script type="text/javascript">
    function data(ref = '') {
        if (ref === '') return alert('invalid transaction reference');
        $("#reference").val(ref);
    }

    $("#withdrw").submit(e => {
        e.preventDefault();

        if (!confirm("Are you sure?")) return false;

        var formData = new FormData($('#withdrw')[0]);

        $thiss = $("#withdrw").find("[type=submit]");
        $thiss.text("please wait...");
        $thiss.attr("disabled", true);

        console.log(formData);
        $.ajax({
            url: "<?= $siteurl ?>/trans/virtual-withdraw",
            type: 'POST',
            dataType: "json",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                console.log(data);
                if (data.status === true) {
                    toastr["success"](data.message);
                    $thiss.text("Success")
                    setInterval(() => {
                        location.reload();
                    }, 2000);

                } else {
                    toastr["error"](data.message);
                    $thiss.text("Transfer")
                    $thiss.removeAttr("disabled");

                }
            },
            fail: err => {
                console.log(err);
                $thiss.text("Transfer")
                $thiss.removeAttr("disabled");
            }
        })
    })
</script>
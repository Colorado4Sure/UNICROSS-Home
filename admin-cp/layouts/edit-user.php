<!-- content @s -->
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block">
                    <div class="card card-bordered">
                        <div class="card-aside-wrap">
                            <div class="card-inner card-inner-lg">
                                <div class="nk-block-head nk-block-head-lg">
                                    <div class="nk-block-between">
                                        <div class="nk-block-head-content">
                                            <h4 class="nk-block-title">Personal Information</h4>
                                            <div class="nk-block-des">
                                                <p>Basic info, like your name and address, that you use on Nio Platform.</p>
                                            </div>
                                        </div>
                                        <div class="nk-block-head-content align-self-start d-lg-none">
                                            <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                                        </div>
                                    </div>
                                </div><!-- .nk-block-head -->
                                <div class="nk-block">
                                    <div class="nk-data data-list">
                                        <div class="data-head">
                                            <h6 class="overline-title">Basics</h6>
                                        </div>
                                        <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                            <div class="data-col">
                                                <span class="data-label">Full Name</span>
                                                <span class="data-value"><?= $edit->fname . ' ' . $edit->lname ?></span>
                                            </div>
                                            <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                        </div><!-- data-item -->
                                        <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                            <div class="data-col">
                                                <span class="data-label">Username</span>
                                                <span class="data-value"><?= $edit->username ?></span>
                                            </div>
                                            <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                        </div><!-- data-item -->
                                        <div class="data-item">
                                            <div class="data-col">
                                                <span class="data-label">Email</span>
                                                <span class="data-value"><?= $edit->email ?></span>
                                            </div>
                                            <div class="data-col data-col-end"><span class="data-more disable"><em class="icon ni ni-lock-alt"></em></span></div>
                                        </div><!-- data-item -->
                                        <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                            <div class="data-col">
                                                <span class="data-label">Phone Number</span>
                                                <span class="data-value text-soft"><?= ($edit->phone == null || $edit->phone == '') ? 'Not added yet' : $edit->phone ?></span>
                                            </div>
                                            <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                        </div><!-- data-item -->
                                        <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                            <div class="data-col">
                                                <span class="data-label">Date of Birth</span>
                                                <span class="data-value"><?= ($edit->dob == '' || $edit->dob == null) ? date("d M, Y", strtotime($edit->dob)) : 'Not added yet' ?></span>
                                            </div>
                                            <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                        </div><!-- data-item -->
                                        <div class="data-item" data-toggle="modal" data-target="#profile-edit" data-tab-target="#address">
                                            <div class="data-col">
                                                <span class="data-label">Address</span>
                                                <span class="data-value">Coming soon...</span>
                                            </div>
                                            <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                        </div><!-- data-item -->
                                    </div><!-- data-list -->
                                </div><!-- .nk-block -->
                            </div>
                            <div class="card-aside card-aside-left user-aside toggle-slide toggle-slide-left toggle-break-lg" data-content="userAside" data-toggle-screen="lg" data-toggle-overlay="true">
                                <div class="card-inner-group" data-simplebar>
                                    <div class="card-inner">
                                        <div class="user-card">
                                            <div class="user-avatar bg-primary">
                                                <span><?php if ($edit->profilepic == '') : $edit->fname[0] . $edit->lname[0];
                                                        else : ?>
                                                        <img src="<?= $edit->profilepic ?>" alt="">
                                                    <?php endif; ?></span>
                                            </div>
                                            <div class="user-info">
                                                <span class="lead-text"><?= $edit->fname . ' ' . $edit->lname ?></span>
                                                <span class="sub-text"><?= $edit->email ?></span>
                                            </div>
                                            <div class="user-action">
                                                <div class="dropdown">
                                                    <a class="btn btn-icon btn-trigger mr-n2" data-toggle="dropdown" href="#"><em class="icon ni ni-more-v"></em></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <ul class="link-list-opt no-bdr">
                                                            <li><a href="#"><em class="icon ni ni-camera-fill"></em><span>Change Photo</span></a></li>
                                                            <li><a href="#"><em class="icon ni ni-edit-fill"></em><span>Update Profile</span></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- .user-card -->
                                    </div><!-- .card-inner -->
                                    <div class="card-inner">
                                        <div class="user-account-info py-0">
                                            <h6 class="overline-title-alt">NGN Wallet Balance</h6>
                                            <div class="user-balance"><?= number_format($edit->balance, 2) ?> <small class="currency currency-btc">NGN</small></div>
                                            <div class="user-balance-sub">BTC Bal: <span><?= $edit->BTC ?></span></div>
                                            <div class="user-balance-sub">ETH Bal: <span><?= $edit->ETH ?></span></div>
                                            <div class="user-balance-sub">USDT Bal: <span><?= $edit->USDT ?></span></div>
                                        </div>
                                    </div><!-- .card-inner -->
                                </div><!-- .card-inner-group -->
                            </div><!-- card-aside -->
                        </div><!-- .card-aside-wrap -->
                    </div><!-- .card -->
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
</div>
<!-- content @e -->
<!-- @@ Profile Edit Modal @e -->
<div class="modal fade" tabindex="-1" role="dialog" id="profile-edit">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
            <div class="modal-body modal-body-lg">
                <h5 class="title">Update Profile</h5>
                <ul class="nk-nav nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#personal">Personal</a>
                    </li>
                </ul><!-- .nav-tabs -->
                <div class="tab-content">
                    <div class="tab-pane active" id="personal">
                        <form id="edit-user-form">
                            <div class="row gy-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="full-name">Full Name</label>
                                        <input type="text" name="user_fname" class="form-control form-control-lg" id="full-name" value="<?= $edit->fname ?>" placeholder="Enter First name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="lname">Full Name</label>
                                        <input type="text" name="user_lname" class="form-control form-control-lg" id="lname" value="<?= $edit->lname ?>" placeholder="Enter First name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="display-name">Username</label>
                                        <input type="text" name="user_username" class="form-control form-control-lg" id="display-name" value="<?= $edit->username ?>" placeholder="Enter username">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="email">Email</label>
                                        <input type="email" id="email" class="form-control form-control-lg" value="<?= $edit->email ?>" name="user_email" placeholder="Email" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="phone-no">Phone (080*****)</label>
                                        <input type="text" name="user_phone" class="form-control form-control-lg" id="phone-no" value="<?= $edit->phone ?>" placeholder="Phone Number">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="birth-day">Date of Birth</label>
                                        <input type="text" value="<?= $edit->dob ?>" class="form-control form-control-lg date-picker" id="birth-day" placeholder="Enter your name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="">Add NGN Balance (can be blank)</label>
                                        <input type="text" oninput="this.value = this.value.replace(/[^0-9.-]/g, '').replace(/(\..*?)\..*/g, '$1');" name="add_balance" class="form-control form-control-lg" placeholder="Amount to add">
                                        <p><i>Current Balance : <?= $coin . number_format($edit->balance, 2) ?></i></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="">Add BTC Balance (can be blank)</label>
                                        <input type="text" oninput="this.value = this.value.replace(/[^0-9.-]/g, '').replace(/(\..*?)\..*/g, '$1');" name="add_btc_balance" class="form-control form-control-lg" placeholder="Amount to add">
                                        <p><i>Current Balance : <?= number_format($edit->BTC, 9) ?> BTC</i></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="">Add ETH Balance (can be blank)</label>
                                        <input type="text" oninput="this.value = this.value.replace(/[^0-9.-]/g, '').replace(/(\..*?)\..*/g, '$1');" name="add_eth_balance" class="form-control form-control-lg" placeholder="Amount to add">
                                        <p><i>Current Balance : <?= number_format($edit->ETH, 9) ?> ETH</i></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="">Add USDT Balance (can be blank)</label>
                                        <input type="text" oninput="this.value = this.value.replace(/[^0-9.-]/g, '').replace(/(\..*?)\..*/g, '$1');" name="add_usdt_balance" class="form-control form-control-lg" placeholder="Amount to add">
                                        <p><i>Current Balance : <?= number_format($edit->USDT, 2) ?> USDT</i></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="default-06">User Type</label>
                                        <select class="form-control form-control-lg" id="default-06" name="user_type">
                                            <option value="user">User</option>
                                            <option value="admin" <?= ($edit->type === "admin")? "selected" : ""; ?>>Admin</option>
                                            <?php if($edit->type === "super-admin") : ?>
                                            <option value="super-admin" <?= ($edit->type === "super-admin")? "selected" : ""; ?>>Super Admin</option>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="default-06">User Status</label>
                                        <select class="form-control form-control-lg" id="default-06" name="user_status">
                                            <option value="active">Active</option>
                                            <option value="inactive" <?php if ($edit->status == "inactive") {
                                                                            echo "selected";
                                                                        } ?>>Inactive</option>
                                            <option value="disabled" <?php if ($edit->status == "disabled") {
                                                                            echo "selected";
                                                                        } ?>>Disabled</option>
                                        </select>
                                    </div>
                                </div>

                                <input type="hidden" name="edit_id" value="<?= $app->encrypt($edit->id) ?>">
                                <div class="col-12">
                                    <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                        <li>
                                            <button type="submit" class="btn btn-lg btn-primary">
                                                <div class="ld-ext-left ld">
                                                    <span class="ld ld-ring ld-cycle"></span> Update Profile
                                                </div>
                                            </button>
                                        </li>
                                        <li>
                                            <a href="#" data-dismiss="modal" class="link link-light">Cancel</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </form>
                    </div><!-- .tab-pane -->
                </div><!-- .tab-content -->
            </div><!-- .modal-body -->
        </div><!-- .modal-content -->
    </div><!-- .modal-dialog -->
</div><!-- .modal -->

<script type="text/javascript">
    $("form#edit-user-form").submit(function(e) {
        e.preventDefault();
        var formData = new FormData($(this)[0]);
        $thiss = $(this).find("[type=submit]");
        $thiss.find(".ld").addClass("running");
        $thiss.addClass("btn-disabled");
        $thiss.attr("disabled", true);
        $.ajax({
            url: '/admin-cp/backend/user-actions?action=edit',
            type: 'POST',
            data: formData,
            dataType: "json",
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                if (data.code == "200") {
                    $thiss.find(".ld").removeClass("running");
                    $thiss.removeClass("btn-disabled");;
                    $thiss.removeAttr("disabled");
                    toastr["success"](data.msg);
                    // alert(data.msg);
                } else {
                    $thiss.find(".ld").removeClass("running");
                    $thiss.removeClass("btn-disabled");
                    $thiss.removeAttr("disabled");
                    toastr["error"](data.msg);
                    // alert(data.msg);
                }
            }
        }).fail(function(error, res) {
            // console.log(error, res);
        });
    })
</script>
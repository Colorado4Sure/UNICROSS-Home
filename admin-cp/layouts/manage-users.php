<!-- content @s -->
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Users Lists</h3>
                            <div class="nk-block-des text-soft">
                                <p>You have total <?= count($stats->users) ?> users.</p>
                            </div>
                        </div><!-- .nk-block-head-content -->
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <a href="add-user" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                <div class="toggle-expand-content" data-content="pageMenu">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <div class="drodown">
                                                <a href="add-user" class="btn btn-icon btn-primary"><em class="icon ni ni-plus"></em></a>
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
                                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Balance</span></th>
                                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Phone</span></th>
                                        <th class="nk-tb-col tb-col-lg"><span class="sub-text">Verified</span></th>
                                        <th class="nk-tb-col tb-col-lg"><span class="sub-text">Last Login</span></th>
                                        <th class="nk-tb-col"><span class="sub-text">Status</span></th>
                                        <th class="nk-tb-col"><span class="sub-text">Action</span></th>
                                      </tr>
                                    </thead><!-- .nk-tb-item -->
                                    <tbody>
                                    <?php $key = 0;
                                    foreach ($stats->users as $user) :
                                        //if ($key++ == 20) break; ?>
                                        <tr class="nk-tb-item <?= $user->id ?>">
                                            <td class="nk-tb-col">
                                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                                    <input type="checkbox" class="custom-control-input" id="uid1">
                                                    <label class="custom-control-label" for="uid1"></label>
                                                </div>
                                            </td>
                                            <td class="nk-tb-col">
                                                <a href="edit-user/<?= $user->id ?>">
                                                    <div class="user-card">
                                                        <div class="user-avatar bg-primary">
                                                            <span><?php if ($user->profilepic == '') : $user->fname[0] . $user->lname[0];
                                                                    else : ?>
                                                                    <img src="/account/assets/profilepics/<?= $user->profilepic ?>" alt="">
                                                                <?php endif; ?></span>
                                                        </div>
                                                        <div class="user-info">
                                                            <span class="tb-lead"><?= $user->fname . ' ' . $user->lname ?></span>
                                                            <span><?= $user->email ?></span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </td>
                                            <td class="nk-tb-col tb-col-mb">
                                                <span class="tb-amount"><?= $coin . number_format((int)$user->balance, 2) ?></span>
                                            </td>
                                            <td class="nk-tb-col tb-col-md">
                                                <span><?= $user->phone ?></span>
                                            </td>
                                            <td class="nk-tb-col tb-col-lg">
                                                <ul class="list-status">
                                                    <li><?= ($user->email_verified == 1) ? '<em class="icon text-success ni ni-check-circle"></em>' : '<em class="icon text-danger ni ni-alert-circle"></em>' ?> <span>Email</span></li>
                                                    <li><em class="icon ni ni-alert-circle"></em> <span>KYC</span></li>
                                                </ul>
                                            </td>
                                            <td class="nk-tb-col tb-col-lg">
                                                <span><?= date("d M Y", strtotime($user->last_login)) ?></span>
                                            </td>
                                            <td class="nk-tb-col">
                                                <?= ($user->status == 'active')? '<span class="tb-status text-success">Active</span>' : (($user->status == 'inactive')? '<span class="tb-status text-warning">Inactive</span>': '<span class="tb-status text-danger">Suspended</span>') ?>

                                            </td>
                                            <td class="nk-tb-col nk-tb-col-tools">
                                                <ul class="nk-tb-actions gx-1">
                                                    <li>
                                                        <div class="drodown">
                                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <ul class="link-list-opt no-bdr">
                                                                    <li><a href="edit-user/<?= $user->id ?>"><em class="icon ni ni-edit"></em><span>Edit User</span></a></li>
                                                                    <li class="divider"></li>

                                                                    <?php if ($user->status == 'active'): ?>
                                                                      <li><a href="#" onclick="updated('<?= $user->id ?>', 'inactive')"><em class="icon ni ni-cross-circle"></em><span>Deactivate User</span></a></li>
                                                                      <li><a href="#" onclick="updated('<?= $user->id ?>', 'disabled')"><em class="icon ni ni-na"></em><span>Suspend User</span></a></li>

                                                                    <?php elseif ($user->status == 'inactive'): ?>
                                                                        <li><a href="#" onclick="updated('<?= $user->id ?>', 'active')"><em class="icon ni ni-check-circle-cut"></em><span>Activate User</span></a></li>
                                                                        <li><a href="#" onclick="updated('<?= $user->id ?>', 'disabled')"><em class="icon ni ni-na"></em><span>Suspend User</span></a></li>

                                                                        <?php else: ?>
                                                                            <li><a href="#" onclick="updated('<?= $user->id ?>', 'active')"><em class="icon ni ni-check-circle-cut"></em><span>Activate User</span></a></li>
                                                                            <li><a href="#" onclick="updated('<?= $user->id ?>', 'inactive')"><em class="icon ni ni-cross-circle"></em><span>Deactivate User</span></a></li>
                                                                    <?php endif; ?>

                                                                    <li class="divider"></li>
                                                                    <li class="delete-user"><a href="#" onclick="deleted('<?= $user->id ?>')"><em class="icon ni ni-trash"></em><span>Delete User</span></a></li>
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

<script type="text/javascript">
function deleted(id) {
  event.preventDefault();

  if (!confirm("Are you sure?")) return false;
  $.ajax({
      url: '/admin-cp/backend/user-actions?action=delete',
      type: 'POST',
      dataType: "json",
      data: {
          edit_id: parseInt(id)
      },
      cache: false,
      success: function(data) {
          if (data.code == 200) {
            toastr["success"](data.msg);
            $('.'+id).fadeOut();
          } else {
              toastr["error"](data.msg);
          }
      }
  })
}

function updated(id, status) {
  event.preventDefault();

  if (!confirm("Are you sure?")) return false;
  $.ajax({
      url: '/admin-cp/backend/user-actions?action=suspend',
      type: 'POST',
      dataType: "json",
      data: {
          edit_id: parseInt(id),
          user_status: status
      },
      cache: false,
      success: function(data) {
          if (data.code == 200) {
            toastr["success"](data.msg);
            setTimeout(function () {
              location.reload();
            }, 2000);
          } else {
            toastr["error"](data.msg);
              // alert(data.msg);
          }
      }
  }).fail(function (error, mgs) {
    console.log(error, mgs);
  })
}

</script>

<!-- content @s -->
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Gift Pin List</h3>
                            <div class="nk-block-des text-soft">
                                <p>You have total <?= count($stats->gift_pins) ?> Gift Pins .</p>
                            </div>
                        </div><!-- .nk-block-head-content -->
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <a href="add-user" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                <div class="toggle-expand-content" data-content="pageMenu">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt">
                                            <div class="drodown">
                                                <a href="create-gift-pin" class="btn btn-icon btn-primary"><em class="icon ni ni-plus"></em></a>
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
                                                    <option value="delete">Delete Gift Pin</option>
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
                                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Gift Amount</span></th>
                                        <th class="nk-tb-col tb-col-lg"><span class="sub-text">Gift Code</span></th>
                                        <th class="nk-tb-col tb-col-lg"><span class="sub-text">Gift Status</span></th>
                                        <th class="nk-tb-col"><span class="sub-text">Action</span></th>
                                      </tr>
                                    </thead><!-- .nk-tb-item -->
                                    <tbody>
                                    <?php $key = 0;
                                    foreach ($stats->gift_pins as $gift_pin) :
                                        //if ($key++ == 20) break; ?>
                                        <tr class="nk-tb-item <?= $gift_pin->gift_id ?>">
                                            <td class="nk-tb-col">
                                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                                    <input type="checkbox" class="custom-control-input" id="uid1">
                                                    <label class="custom-control-label" for="uid1"></label>
                                                </div>
                                            </td>
                                            <td class="nk-tb-col tb-col-mb">
                                                <span class="tb-amount"><?= $coin . number_format((int) $gift_pin->gift_amount, 2) ?></span>
                                            </td>
                                            <td class="nk-tb-col tb-col-mb">
                                                <span class=""><?= $gift_pin->gift_code ?></span>
                                            </td>                                            

                                            <td class="nk-tb-col">
                                                <?= ($gift_pin->gift_status == '1')? '<span class="tb-status text-success">Active</span>' : (($gift_pin->gift_status == '0')?  '<span class="tb-status text-danger">Used</span>' : '<span class="tb-status text-danger">Used</span>') ?>
                                            </td>
                                            <td class="nk-tb-col nk-tb-col-tools">
                                                <ul class="nk-tb-actions gx-1">
                                                    <li>
                                                        <div class="drodown">
                                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <ul class="link-list-opt no-bdr">
                                                                    <li class="delete-user"><a href="#" onclick="delete_gift_pin(<?= $gift_pin->gift_id ?>)"><em class="icon ni ni-trash"></em><span>Delete Gift Pin</span></a></li>
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

function delete_gift_pin(id) {
  event.preventDefault();

  if (!confirm("Are you sure?")) return false;
  $.ajax({
      url: '/admin-cp/backend/user-actions?action=delete_gift_pin',
      type: 'POST',
      dataType: "json",
      data: {
          edit_id: parseInt(id),
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

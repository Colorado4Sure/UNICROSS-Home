<!-- content @s -->
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between g-3">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title"><?=$page ?> Documents</h3>
                            <div class="nk-block-des text-soft">
                                <p>You have total <span class="text-base"><?= $app->all_kyc(true) ?></span> KYC documents.</p>
                            </div>
                        </div>
                    </div>
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="card card-bordered card-stretch">
                        <div class="card-inner-group">
                            <div class="card-inner position-relative">
                                <div class="card-title-group">
                                    <div class="card-tools">
                                    </div><!-- .card-tools -->
                                    <div class="card-tools mr-n1">
                                        <ul class="btn-toolbar gx-1">
                                            <li>
                                                <a href="#" class="btn btn-icon search-toggle toggle-search" data-target="search"><em class="icon ni ni-search"></em></a>
                                            </li>
                                            <li class="btn-toolbar-sep"></li>
                                            <li>
                                                <div class="dropdown">
                                                    <a href="#" class="btn btn-trigger btn-icon dropdown-toggle" data-toggle="dropdown">
                                                        <div class="dot dot-primary"></div>
                                                        <em class="icon ni ni-filter-alt"></em>
                                                    </a>
                                                    <div class="filter-wg dropdown-menu dropdown-menu-xl dropdown-menu-right">
                                                        <div class="dropdown-head">
                                                            <span class="sub-title dropdown-title">Filter Document</span>
                                                        </div>
                                                        <div class="dropdown-body dropdown-body-rg">
                                                            <div class="row gx-6 gy-3">
                                                                <div class="col-6">
                                                                    <div class="form-group">
                                                                        <label class="overline-title overline-title-alt">Doc Type</label>
                                                                        <select class="form-select form-select-sm">
                                                                            <option value="any">Any Type</option>
                                                                            <option value="nidcard">Nidcard</option>
                                                                            <option value="passport">Passport</option>
                                                                            <option value="driving">Driving</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="form-group">
                                                                        <label class="overline-title overline-title-alt">Status</label>
                                                                        <select class="form-select form-select-sm">
                                                                            <option value="any">Any Status</option>
                                                                            <option value="approved">Approved</option>
                                                                            <option value="pending">Pending</option>
                                                                            <option value="suspend">Rejected</option>
                                                                            <option value="deleted">Deleted</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <button type="button" class="btn btn-secondary">Filter</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="dropdown-foot between">
                                                            <a class="clickable" href="#">Reset Filter</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="dropdown">
                                                    <a href="#" class="btn btn-trigger btn-icon dropdown-toggle" data-toggle="dropdown">
                                                        <em class="icon ni ni-setting"></em>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-xs dropdown-menu-right">
                                                        <ul class="link-check">
                                                            <li><span>Show</span></li>
                                                            <li class="active"><a href="#">10</a></li>
                                                            <li><a href="#">20</a></li>
                                                            <li><a href="#">50</a></li>
                                                        </ul>
                                                        <ul class="link-check">
                                                            <li><span>Order</span></li>
                                                            <li class="active"><a href="#">DESC</a></li>
                                                            <li><a href="#">ASC</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div><!-- .card-tools -->
                                </div><!-- .card-title-group -->
                                <div class="card-search search-wrap" data-search="search">
                                    <div class="card-body">
                                        <div class="search-content">
                                            <a href="#" class="search-back btn btn-icon toggle-search" data-target="search"><em class="icon ni ni-arrow-left"></em></a>
                                            <input type="text" class="form-control border-transparent form-focus-none" placeholder="Search by user or id">
                                            <button class="search-submit btn btn-icon"><em class="icon ni ni-search"></em></button>
                                        </div>
                                    </div>
                                </div><!-- .card-search -->
                            </div><!-- .card-inner -->
                            <div class="card-inner p-0">
                                <div class="nk-tb-list nk-tb-ulist">
                                    <div class="nk-tb-item nk-tb-head">
                                        <div class="nk-tb-col nk-tb-col-check">
                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                <input type="checkbox" class="custom-control-input" id="uid">
                                                <label class="custom-control-label" for="uid"></label>
                                            </div>
                                        </div>
                                        <div class="nk-tb-col"><span>User</span></div>
                                        <div class="nk-tb-col tb-col-mb"><span>Doc Type</span></div>
                                        <div class="nk-tb-col tb-col-md"><span>Documents</span></div>
                                        <div class="nk-tb-col tb-col-lg"><span>Submitted</span></div>
                                        <div class="nk-tb-col tb-col-md"><span>Status</span></div>
                                        <div class="nk-tb-col tb-col-lg"><span>Checked By</span></div>
                                        <div class="nk-tb-col nk-tb-col-tools">&nbsp;</div>
                                    </div><!-- .nk-tb-item -->

                                    <?php foreach ($app->all_kyc() as $doc): ?>
                                      <?php $user_name = '';
                                      $strName = '';
                                      $image = '';
                                      foreach ($stats->users as $users) {
                                        if ($doc->user_id == $users->id) {
                                          $user_name = $users->fname.' '.$users->lname;
                                          $strName = strtoupper($users->fname[0].$users->lname[0]);
                                          $image = $users->profilepic;
                                        }
                                      } ?>
                                      <div class="nk-tb-item doc_<?=$doc->id ?>">
                                          <div class="nk-tb-col nk-tb-col-check">
                                              <div class="custom-control custom-control-sm custom-checkbox notext">
                                                  <input type="checkbox" class="custom-control-input" id="uid1">
                                                  <label class="custom-control-label" for="uid1"></label>
                                              </div>
                                          </div>
                                          <div class="nk-tb-col">
                                              <div class="user-card">
                                                  <div class="user-avatar bg-primary">
                                                      <span><?=$strName ?></span>
                                                  </div>
                                                  <div class="user-info">
                                                      <span class="tb-lead"><?=$user_name ?> <span class="dot dot-success d-md-none ml-1"></span></span>
                                                      <span><?=$doc->doc_id ?></span>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="nk-tb-col tb-col-mb">
                                              <span class="tb-lead-sub"><?=$doc->doc_type ?></span>
                                          </div>
                                          <div class="nk-tb-col tb-col-md">
                                              <ul class="list-inline list-download">
                                                  <li>Document File <a href="/uploads/kyc/<?=$doc->image ?>" class="popup" target="_blank"><em class="icon ni ni-download"></em></a></li>
                                              </ul>
                                          </div>
                                          <div class="nk-tb-col tb-col-lg">
                                              <span class="tb-date"><?=date("d M, Y h:i A", strtotime($doc->createdAt))?></span>
                                          </div>
                                          <div class="nk-tb-col tb-col-md">
                                              <span class="tb-status <?=($doc->status == 'approved')? 'text-success': (($doc->status == 'pending')? 'text-warning': 'text-danger') ?>"><?=$doc->status ?></span>
                                              <?php if ($doc->approval_date != ''): ?>
                                                <span data-toggle="tooltip" title="Reviewed at <?=date("d M, Y h:i A", strtotime($doc->approval_date))?>" data-placement="top"><em class="icon ni ni-info"></em></span>
                                              <?php endif; ?>
                                          </div>
                                          <div class="nk-tb-col tb-col-lg">
                                              <div class="user-card">
                                                  <div class="user-name">
                                                      <span class="tb-lead"><?=$doc->approved_by ?></span>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="nk-tb-col nk-tb-col-tools">
                                              <ul class="nk-tb-actions gx-1">
                                                  <li>
                                                      <div class="drodown">
                                                          <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                          <div class="dropdown-menu dropdown-menu-right">
                                                              <ul class="link-list-opt no-bdr">
                                                                  <li><a href="kyc-details/<?=$doc->id ?>"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>

                                                                  <?php if ($doc->status == 'pending'): ?>

                                                                    <li class="divider"></li>
                                                                    <li><a href="#" onclick="updated('<?=$doc->id ?>', 'approved', '<?=$doc->user_id ?>', '<?=$user->fname .' '.$user->lname ?>')"><em class="icon ni ni-check-round"></em><span>Approved</span></a></li>
                                                                    <li><a href="#" onclick="updated('<?=$doc->id ?>', 'declined', '<?=$doc->user_id ?>', '<?=$user->fname .' '.$user->lname ?>')"><em class="icon ni ni-na"></em><span>Reject</span></a></li>
                                                                  <?php endif; ?>
                                                                  <li><a href="#" onclick="deleted('<?=$doc->id ?>')"><em class="icon ni ni-trash"></em><span>Delete</span></a></li>
                                                              </ul>
                                                          </div>
                                                      </div>
                                                  </li>
                                              </ul>
                                          </div>
                                      </div><!-- .nk-tb-item -->
                                    <?php endforeach; ?>
                                </div>
                            </div><!-- .card-inner -->
                            <div class="card-inner">
                                <ul class="pagination justify-content-center justify-content-md-start">
                                    <li class="page-item"><a class="page-link" href="#">Prev</a></li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><span class="page-link"><em class="icon ni ni-more-h"></em></span></li>
                                    <li class="page-item"><a class="page-link" href="#">6</a></li>
                                    <li class="page-item"><a class="page-link" href="#">7</a></li>
                                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                </ul><!-- .pagination -->
                            </div><!-- .card-inner -->
                        </div><!-- .card-inner-group -->
                    </div><!-- .card -->
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
</div>
<!-- content @e -->
<script>

function deleted(id) {
  // con = ;
  if(!confirm("Are you sure?")){
    return false;
  }
  var thiss = $('.doc_'+id);
  // alert('doc_'+id)
  $.ajax({
    url: '/admin-cp/backend/user-actions?action=delete_kyc',
    type: 'POST',
    dataType: "json",
    data: {edit_id: id},
    cache: false,
    success : function(data){
      if(data.code == 200){
        toastr["success"](data.msg);
        $('.'+id).fadeOut();
      } else {
        toastr["error"](data.msg);
      }
    }
  }).fail(function (error, msg) {
    console.log(error, msg);
  });
}

function updated(id, status, user_id = null, review_by = '') {
  event.preventDefault();

  if (!confirm("Are you sure?")) return false;
  $.ajax({
      url: '/admin-cp/backend/user-actions?action=update_kyc',
      type: 'POST',
      dataType: "json",
      data: {
          edit_id: id,
          status: status,
          id: user_id,
          review_by: review_by
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

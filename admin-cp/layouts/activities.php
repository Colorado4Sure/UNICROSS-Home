<!-- content @s -->
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title"><?=$page ?></h3>
                            <div class="nk-block-des text-soft">
                                <p>You have total <?=$app->all_transactions(true) ?> Activities.</p>
                            </div>
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="card card-bordered card-stretch">
                        <div class="card-inner-group">
                            <div class="card-inner position-relative card-tools-toggle" style="border-bottom: 0px;">
                            </div><!-- .card-inner -->
                            <div class="card-inner p-0">
                                <table class="nk-tb-list nk-tb-ulist table table-striped table-bordered table-hover data-table">
                                    <thead>
                                      <tr>
                                        <th class="nk-tb-col"><span class="sub-text">User</span></th>
                                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">TNX Title</span></th>
                                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Description</span></th>
                                        <th class="nk-tb-col tb-col-lg"><span class="sub-text">Amount</span></th>
                                        <th class="nk-tb-col tb-col-lg"><span class="sub-text">Date</span></th>
                                        <th class="nk-tb-col"><span class="sub-text">Read</span></th>
                                        <th class="nk-tb-col"><span class="sub-text">Action</span></th>
                                      </tr>
                                    </thead><!-- .nk-tb-item -->
                                    <tbody>
                                    <?php $key = 0;
                                    foreach ($app->all_transactions(false) as $activity):
                                      $user_name = '';
                                      $strName = '';
                                      $image = '';
                                      foreach ($stats->users as $userss) {
                                        if ($activity->user_id == $userss->id) {
                                          $user_name = $userss->fname.' '.$userss->lname;
                                          $strName = strtoupper($userss->fname[0].$userss->lname[0]);
                                          $image = $userss->profilepic;
                                        }
                                      }
                                      ?>

                                    <tr class="nk-tb-item">
                                        <td class="nk-tb-col">
                                            <a>
                                                <div class="user-card">
                                                    <div class="user-avatar bg-primary">
                                                        <span><?php if ($image == ''): $user->fname[0].$user->lname[0]; else: ?>
                                                          <img src="/account/assets/profilepics/<?=$image ?>" alt="">
                                                        <?php endif; ?></span>
                                                    </div>
                                                    <div class="user-info">
                                                        <span class="tb-lead"><?=$user_name ?></span>
                                                        <span><?=$user->email ?></span>
                                                    </div>
                                                </div>
                                            </a>
                                        </td>
                                        <td class="nk-tb-col tb-col-mb">
                                              <span class="tb-lead"><?=$activity->title?></span>
                                            <span><?=$coin.number_format((int)$activity->amount, 2)  ?></span>
                                        </td>
                                        <td class="nk-tb-col tb-col-md">
                                            <span><?=$activity->activity ?></span>
                                        </td>
                                        <td class="nk-tb-col tb-col-lg">
                                          <span><?=$coin.number_format((int)$activity->amount, 2)  ?></span>
                                        </td>
                                        <td class="nk-tb-col tb-col-lg">
                                            <span><?=date("d M, Y h:ia", strtotime($activity->date))?></span>
                                        </td>
                                        <td class="nk-tb-col">
                                          <?= ($activity->is_read == 1)? '<span class="tb-status text-success">Yes</span>' : '<span class="tb-status text-danger">No</span>' ?>

                                        </td>
                                        <td class="nk-tb-col nk-tb-col-tools">
                                            <ul class="nk-tb-actions gx-1">
                                                <li>
                                                    <div class="drodown">
                                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li><a href="#"><em class="icon ni ni-edit"></em><span>Mark as Read</span></a></li>
                                                                <li class="divider"></li>
                                                                <li><a href="#"><em class="icon ni ni-trash"></em><span>Delete</span></a></li>
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
  $(".delete-user").on('click', function(event) {
    event.preventDefault();
    // con = ;
    if(!confirm("Are you sure?")){
      return false;
    }
    $(this).attr("disabled",true);
    var thiss = $(this).closest('tr');
    var user_id = thiss.attr("user_id");
    $.ajax({
      url: './backend/user-actions?action=delete',
      type: 'POST',
      dataType: "json",
      data: {edit_id: user_id},
      cache: false,
      success : function(data){
        if(data.code == 200){
          alert(data.msg);
          thiss.remove();
        } else {
          alert(data.msg);
        }
      }
    });
  });
</script>

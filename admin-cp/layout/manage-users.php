<div class="pcoded-content">
   <div class="page-header card">
      <div class="row align-items-end">
         <div class="col-lg-8">
            <div class="page-header-title">
               <i class="feather icon-users bg-c-blue"></i>
               <div class="d-inline">
                  <h5><?= $page?></h5>
                  <span><?= $page ?></span>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="pcoded-inner-content">
      <div class="main-body">
         <div class="page-wrapper">
            <div class="page-body">
               <div class="col-12 card">
                  <div class="card-header table-card-header">
                     <h5><?=$page?></h5>
                     <div class="card-header-right">
                         <ul class="list-unstyled card-option">
                             <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
                             <li><i class="feather icon-maximize full-card"></i></li>
                             <li><i class="feather icon-minus minimize-card"></i></li>
                             <li><i class="feather icon-refresh-cw reload-card"></i></li>
                             <li><i class="feather icon-trash close-card"></i></li>
                             <li><i class="feather icon-chevron-left open-card-option"></i></li>
                         </ul>
                     </div>
                  </div>
                  <div class="card-block">
                     <div class="table-responsive dt-responsive">
                        <table class="table table-striped table-bordered table-hover data-table">
                           <thead>
                             <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th>Date Joined</th>
                                <th>Action</th>
                             </tr>
                           </thead>
                           <tbody>
                            <?php
                            $key = 0;
                            foreach ($stats->users as $user) {
                              $key++;
                              ?>
                              <tr user_id="<?=$app->encrypt($user->id)?>">
                                <td><?=$key?></td>
                                <td><?=$user->name?></td>
                                <td><?=$user->email?></td>
                                <td><?=$user->username?></td>
                                <td><?=date("d-M-Y h:ia",$user->doj)?></td>
                                <td class="dropdown">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-cog" aria-hidden="true"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right b-none">
                                      <a class="dropdown-item lazy" href="./edit-user/<?=$user->username?>"><i class="icofont icofont-edit"></i>Edit</a>
                                      <a class="dropdown-item delete-user" href="javascript:"><i class="icofont icofont-ui-delete"></i>Delete</a>
                                      <a class="dropdown-item lazy" href="./view-user/<?=$user->username?>"><i class="icofont icofont-eye-alt"></i>View</a>
                                    </div>
                                </td>
                              </tr>
                              <?php
                            }
                            ?>
                           </tbody>
                           <tfoot>
                             <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th>Date Joined</th>
                                <th>Action</th>
                             </tr>
                           </tfoot>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
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
</div>

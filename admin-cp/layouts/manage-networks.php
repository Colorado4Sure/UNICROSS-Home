<!-- content @s -->
<?php require '../main/classes/user.class.php'; ?>
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title"><?= $page ?></h3>
                            <div class="nk-block-des text-soft">
                                <p>Click on any network to get it data plans</p>
                            </div>
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->

                  <?php
                  $ntwk_img = '';
                  $network_id = 1;
                  foreach ($app->vtu()->data as $networks):
                    if (isset($_GET['network_id'])) {
                      $network_id = $_GET['network_id'];
                    }

                    if ($network_id == $networks->id) {
                      $ntwk_img = $networks->image;
                    }

                  endforeach;
                    ?>
                <div class="nk-block">
                    <div class="row g-gs">
                        <div class="col-md-6 col-xxl-4">
                            <div class="card card-bordered card-full">
                                <div class="card-inner border-bottom">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">All Networks</h6>
                                        </div>
                                    </div>
                                </div>
                                <ul class="nk-activity">
                                  <?php $key = 0;
                                  foreach ($app->vtu()->data as $networks):
                                    if ($key++ == 10) break;
                                    ?>
                                    <a href="#plans">
                                      <li class="nk-activity-item" onclick="dataChange('<?=$networks->id ?>')">
                                          <div class="nk-activity-media user-avatar bg-success">
                                            <img src="<?=$networks->image ?>" alt="<?=$networks->name ?>"></div>
                                          <div class="nk-activity-data">
                                              <div class="label"><?= '<b>'.$networks->name.'</b>' ?></div>
                                          </div>

                                          <div class="card-tools">
                                              <em class="card-hint icon ni ni-help-fill" data-toggle="tooltip" data-placement="left" title="<?=$networks->note ?>"></em>
                                          </div>
                                      </li>
                                      </a>
                                  <?php endforeach; ?>
                                </ul>
                            </div><!-- .card -->
                        </div><!-- .col -->
                        <div class="col-md-6 col-xxl-4" id="plans">
                            <div class="card card-bordered card-full">
                                <div class="card-inner-group">
                                    <div class="card-inner">
                                        <div class="card-title-group">
                                            <div class="card-title">
                                                <h6 class="title">Data Plans</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="data-plans">

                                      <?php
                                      $key = 0;
                                      ?>
                                      <?php foreach ($app->data_plans($network_id)->data as $networks):
                                        //var_dump($networks)?>
                                        <div class="card-inner card-inner-md">
                                            <div class="user-card">
                                                <div class="user-avatar bg-warning-dim">
                                                    <span><img src="<?=$ntwk_img ?>" alt="<?=$networks->name ?>"> </span>
                                                </div>
                                                <div class="user-info">
                                                    <span class="lead-text"><?=$networks->name ?> <?=($networks->is_active == '1')? '(Active)': '(Not Active)' ?></span>
                                                    <span class="sub-text"><?= $coin. number_format($networks->price, 2) ?></span>
                                                </div>
                                            </div>
                                        </div>
                                      <?php endforeach; ?>
                                    </div>
                                </div>
                            </div><!-- .card -->
                        </div><!-- .col -->
                    </div><!-- .row -->
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
</div>
<!-- content @e -->
<script>
////////////////////////////
// Data Setup Here
///////////////////////////
  function dataChange(id) {
    let ntwk_img = '';
    var settings = {
      "url": "<?= $app->site_url ?>networks",
      "method": "GET",
      "timeout": 0,
    };

    $.ajax(settings).done(function (response) {
      if (response.status === true) {
        $(response.data).each(function (req, res) {
          if (res.id === id) {
            ntwk_img = res.image;
          }
        })
      }
      // console.log(response);
    });

    var settings = {
      "url": "<?= $app->site_url ?>data-plans?id="+id,
      "method": "GET",
      "timeout": 0,
      beforeSend: function () {
        $('#data-plans').empty();
        $('#data-plans').html(`
          <div class="section mt-2" style="text-align: center;">
                <div class="spinner-border text-dark" role="status"></div>
          </div>`)
      }
    };

    $.ajax(settings).done(function (response) {
      if (response.status === true) {
        if (response.data.length <= 0) {
          $('#data-plans').empty();
          $("#data-plans").html('No data plan is available at the moment for the selected network, <br>Please try again later.');
        }else {
          $('#data-plans').empty();
          $(response.data).each(function (req, res) {
            $('#data-plans').append(`
            <div class="card-inner card-inner-md">
                <div class="user-card">
                    <div class="user-avatar bg-warning-dim">
                        <span><img src="${ntwk_img}" alt="${res.name}"> </span>
                    </div>
                    <div class="user-info">
                        <span class="lead-text">${res.name} ${ (res.is_active == '1')? '(Active)': '(Not Active)'}</span>
                        <span class="sub-text">${number_format.format(res.price)}</span>
                    </div>
                </div>
            </div>`)
          })
        }
      }else {
        // alert(response.message)
        $("#data-plans").html(response.message);
        // toastbox('toast-90');
      }
    });
  }

</script>

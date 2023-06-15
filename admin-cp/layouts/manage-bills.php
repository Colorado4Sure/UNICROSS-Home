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
                                <p>Click on any Bill to get it variety</p>
                            </div>
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="row g-gs">
                        <div class="col-md-6 col-xxl-4">
                            <div class="card card-bordered card-full">
                                <div class="card-inner border-bottom">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">All Bill Services</h6>
                                        </div>
                                    </div>
                                </div>
                                <ul class="nk-activity">
                                  <?php $key = 0;
                                  foreach ($app->services('')->data as $networks):
                                    //var_dump($networks);
                                    ?>
                                    <a href="#plans">
                                      <li class="nk-activity-item" onclick="dataChange('<?=$networks->id ?>')">
                                          <div class="nk-activity-media user-avatar">
                                            <img src="<?=$networks->image_url ?>" alt="<?=$networks->name ?>" style="height: 40px; width: 40px;"></div>
                                          <div class="nk-activity-data">
                                              <div class="label">
                                                <?= '<b>'.$networks->name.'</b>' ?>
                                              </div>
                                              <span class="time"><?=$networks->description ?></span>
                                          </div>
                                      </li>
                                      </a>
                                  <?php endforeach; ?>
                                </ul>
                            </div><!-- .card -->
                        </div><!-- .col -->
                        <div class="col-md-6 col-xxl-4" id="plans">
                            <div class="card card-bordered card-full">
                              <?php
                              $bill_id = 'c5a742666888962a16beea710e269099';
                              $newData = $app->services($bill_id)->data; ?>
                                <div class="card-inner-group">
                                    <div class="card-inner">
                                        <div class="card-title-group">
                                            <div class="card-title">
                                                <h6 class="title"> <span class="titi"><?=$newData->name ?>  Services</span></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="data-plans">
                                      <?php
                                      foreach ($newData->variations as $bill):
                                        //var_dump($bill); ?>
                                        <div class="card-inner card-inner-md">
                                            <div class="user-card">
                                                <div class="user-avatar bg-warning-dim">
                                                    <span><img src="<?=$newData->image_url ?>" alt="<?=$bill->title ?>" style="height: 40px; width: 40px;"> </span>
                                                </div>
                                                <div class="user-info">
                                                    <span class="lead-text"><?=$bill->title ?> </span>
                                                    <span class="sub-text"><?= $coin. number_format($bill->price, 2) ?></span>
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
    if (id !== '') {
      id = "?id="+id
    }

    var settings = {
      "url": "<?= $app->site_url ?>all-bills"+id,
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
        $('.titi').html(response.data.name)
        if (response.data.variations.length <= 0) {
          $('#data-plans').empty();
          $("#data-plans").html('No Service variation is available at the moment for the selected service, <br>Please try again later.');
        }else {
          $('#data-plans').empty();
          $(response.data.variations).each(function (req, res) {
            $('#data-plans').append(`
            <div class="card-inner card-inner-md">
                <div class="user-card">
                    <div class="user-avatar bg-warning-dim">
                        <span><img src="${response.data.image_url}" alt="${res.title}"  style="height: 40px; width: 40px;"> </span>
                    </div>
                    <div class="user-info">
                        <span class="lead-text">${res.title}</span>
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
    }).fail(function (jqXHR, textStatus, error) {
        // Handle error here
        console.log(jqXHR, textStatus, error);
    });
  }

</script>

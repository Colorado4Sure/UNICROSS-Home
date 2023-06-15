<!-- content @s -->
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="components-preview wide-md mx-auto">
                    <div class="nk-block-head nk-block-head-lg wide-sm">
                        <div class="nk-block-head-content">
                            <div class="nk-block-head-sub"><a class="back-to" href="/admin-cp"><em class="icon ni ni-arrow-left"></em><span>Dashboard</span></a></div>
                            <h2 class="nk-block-title fw-normal"><?= $page ?></h2>
                        </div>
                    </div><!-- .nk-block-head -->
                    <div class="nk-block nk-block-lg">
                        <div class="card card-preview">
                            <div class="card-inner">
                                <form id="add-user-form">
                                    <div class="preview-block">
                                        <div class="row gy-4">

                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="default-04">Email</label>
                                                    <div class="form-control-wrap">
                                                        <div class="form-icon form-icon-left">
                                                            <em class="icon ni ni-mail"></em>
                                                        </div>
                                                        <input type="email" name="email" class="form-control" value="" id="default-04" placeholder="User Email">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label" for="default-05">Admin Pin</label>
                                                    <div class="form-control-wrap">
                                                        <div class="form-icon form-icon-left">
                                                            <em class="icon ni ni-lock"></em>
                                                        </div>
                                                        <input type="password" name="pin" max="6" class="form-control" value="" id="default-05" placeholder="123456">
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="save-type" value="site-settings">
                                        </div>
                                        <hr class="preview-hr">
                                        <div class="form-group">
                                            <button type="submit" class="btn ld btn-primary btn-lg btn-block" type="submit">Generate</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div><!-- .card-preview -->
                    </div><!-- .nk-block -->
                </div><!-- .components-preview -->
            </div>
        </div>
    </div>
</div>
<!-- content @e -->


<script type="text/javascript">
    $("form#add-user-form").submit(function(e) {
        e.preventDefault();
        form = $(this);
        var formData = new FormData($(this)[0]);
        $thiss = $(this).find("[type=submit]");
        $thiss.addClass("running");
        $thiss.addClass("btn-disabled");
        $thiss.attr("disabled", true);

        var settings = {
            "url": "https://api.ditepay.com/api/generate-account",
            "method": "POST",
            "timeout": 0,
            "data": {
                'email': $('#default-04').val(),
                'pin': $('#default-05').val(),
            }
        };

        $.ajax(settings)
            .done(response => {
                // console.log(response);
                let data = response;

                if (data.status === true) {
                    $thiss.removeClass("running");
                    $thiss.removeClass("btn-disabled");;
                    $thiss.removeAttr("disabled");
                    toastr["success"](data.message);
                    // alert(data.msg);
                    form.trigger('reset');
                } else {
                    $thiss.removeClass("running");
                    $thiss.removeClass("btn-disabled");
                    $thiss.removeAttr("disabled");
                    // alert(data.msg);
                    toastr["error"](data.message);
                }

            }).fail(data => {
                // console.log(data);
                $thiss.removeClass("running");
                $thiss.removeClass("btn-disabled");
                $thiss.removeAttr("disabled");
                // alert(data.msg);
                toastr["error"](data.responseJSON.message);
            });

    })
</script>
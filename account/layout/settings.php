    <!-- App Header -->
    <div class="appHeader">
        <div class="left">
            <a href="#" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">
            <?= $page; ?>
        </div>
        <div class="right">
            <a href="notifications" class="headerButton">
                <ion-icon class="icon" name="notifications-outline"></ion-icon>
                <span class="badge badge-danger"><?= count($newData) ?></span>
            </a>
        </div>
    </div>
    <!-- * App Header -->

    <!-- App Capsule -->
    <div id="appCapsule">

        <div class="section mt-3 text-center">
            <div class="avatar-section">
                <a href="#">
                    <img src="/account/assets/profilepics/<?= $this_user->data->pics; ?>" alt="avatar" class="imaged w100 rounded">
                    <!-- <span class="button">
                        <ion-icon name="camera-outline"></ion-icon>
                    </span> -->
                </a>
            </div>
        </div>

        <!-- <div class="listview-title mt-1">Deposit Account Details</div>
        <ul class="listview image-listview text inset">
            <li>
                <div class="item">
                    <div class="in">
                        <div>
                            Acc No:
                            <div class="text-muted">
                                <?= $user->account_number ?>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <div class="item">
                  <div class="in">
                      <div>
                          Acc Name:
                          <div class="text-muted">
                              <?= $user->account_name ?>
                          </div>
                      </div>
                  </div>
                </div>
            </li>
            <li>
                <div class="item">
                  <div class="in">
                      <div>
                          Acc Bank:
                          <div class="text-muted">
                              <?= $user->account_bank ?>
                          </div>
                      </div>
                  </div>
                </div>
            </li>
        </ul> -->

        <div class="listview-title mt-1">Theme</div>
        <ul class="listview image-listview text inset no-line">
            <li>
                <div class="item">
                    <div class="in">
                        <div>
                            Dark Mode
                        </div>
                        <div class="form-check form-switch  ms-2">
                            <input class="form-check-input dark-mode-switch" type="checkbox" id="darkmodeSwitch">
                            <label class="form-check-label" for="darkmodeSwitch"></label>
                        </div>
                    </div>
                </div>
            </li>
        </ul>

        <div class="listview-title mt-1">Notifications</div>
        <ul class="listview image-listview text inset">
            <li>
                <div class="item">
                    <div class="in">
                        <div>
                            Payment Alert
                            <div class="text-muted">
                                Send notification when new payment received
                            </div>
                        </div>
                        <div class="form-check form-switch  ms-2">
                            <input class="form-check-input" type="checkbox" id="SwitchCheckDefault1">
                            <label class="form-check-label" for="SwitchCheckDefault1"></label>
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <a href="#" class="item">
                    <div class="in">
                        <div>Notification Sound</div>
                        <span class="text-primary">Beep</span>
                    </div>
                </a>
            </li>
        </ul>

        <div class="listview-title mt-1">Profile Settings</div>
        <ul class="listview image-listview text inset">
          <li data-bs-toggle="collapse" <?= ($user->kyc_verified == 'no')? 'data-bs-target="#kyc"': '' ?>  aria-expanded="false">
              <a href="#" class="item">
                  <div class="in">
                      <div>KYC Verification</div> <?= ($user->kyc_verified == 'yes')? '<span class="badge badge-success right">verified</span>': (($user->kyc_verified == 'pending')? '<span class="badge badge-warning right">submitted</span>': '<span class="badge badge-danger right">needs attention</span>') ?>
                  </div>
              </a>
          </li>
          <div id="kyc" class="accordion-collapse collapse" data-bs-parent="#accordionExample1" style="">
            <div class="accordion-body">
              <form class="" action="/auth/KYC" method="post">
                <div class="form-group boxed">
                  <div class="input-wrapper">
                    <label class="label" for="doc_type">Document Type</label>
                      <select name="doc_type" class="form-control custom-select" id="select4">
                        <option>Choose One</option>
                        <option value="Passport">Passport</option>
                        <option value="National ID">National ID</option>
                        <option value="Drivers License">Driver's Licence</option>
                    </select>
                    <i class="clear-input">
                      <ion-icon name="close-circle" role="img" class="md hydrated" aria-label="close circle"></ion-icon>
                    </i>
                  </div>

                  <div class="mt-1"></div>
                  <div class="input-wrapper">
                    <label class="label" for="doc_id">Document No.</label>
                    <input type="text" name="doc_id" class="form-control" id="doc_id" placeholder="Document Number">
                    <i class="clear-input">
                      <ion-icon name="close-circle" role="img" class="md hydrated" aria-label="close circle"></ion-icon>
                    </i>
                  </div>

                  <div class="mt-1"></div>
                  <div class="input-wrapper">
                      <div class="custom-file-upload" id="fileUpload1">
                        <input type="file" name="document" id="fileuploadInput" accept=".png, .jpg, .jpeg">
                        <label for="fileuploadInput"> <span>
                            <strong>
                              <ion-icon name="arrow-up-circle-outline" role="img" class="md hydrated" aria-label="arrow up circle outline"></ion-icon>
                              <i>Upload Document (5MB max)</i>
                            </strong>
                          </span>
                        </label>
                      </div>
                  </div>

                  <div class="mt-1"></div>
                  <div class="input-wrapper">
                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                  </div>
                </div>
              </form>
            </div>
          </div>

            <li data-bs-toggle="collapse" data-bs-target="#profile" aria-expanded="false">
                <a href="#" class="item">
                    <div class="in">
                        <div>Update Profile</div>
                    </div>
                </a>
            </li>
            <div id="profile" class="accordion-collapse collapse" data-bs-parent="#accordionExample1" style="">
              <div class="accordion-body">
                <form class="" action="/auth/updateProfile" method="post">
                  <div class="form-group boxed">
                    <div class="input-wrapper">
                      <label class="label" for="firstName"></label>
                      <input type="text" class="form-control" id="firstName" placeholder="Enter First name" value="<?= $user->firstName; ?>" disabled>
                      <i class="clear-input">
                        <ion-icon name="close-circle" role="img" class="md hydrated" aria-label="close circle"></ion-icon>
                      </i>
                    </div>

                    <div class="input-wrapper">
                      <label class="label" for="lastName"></label>
                      <input type="text" class="form-control" value="<?= $user->lastName; ?>" id="lastName" placeholder="enter last name" disabled>
                      <i class="clear-input">
                        <ion-icon name="close-circle" role="img" class="md hydrated" aria-label="close circle"></ion-icon>
                      </i>
                    </div>

                    <div class="input-wrapper">
                      <label class="label" for="phoneNumber"></label>
                      <input type="text" id="phoneNumber" class="form-control" maxlength="11" placeholder="Phone number" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\.*?)\..*/g, '$1');" value="<?= $user->phone; ?>">
                      <i class="clear-input">
                        <ion-icon name="close-circle" role="img" class="md hydrated" aria-label="close circle"></ion-icon>
                      </i>
                    </div>

                    <div class="mt-1"></div>
                    <div class="input-wrapper">
                      <button type="submit" class="btn btn-primary btn-block">Update Profile</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <li>
                <a href="#" class="item">
                    <div class="in">
                        <div>Address</div>
                        <span class="text-primary">Edit</span>
                    </div>
                </a>
            </li>
            <!-- <li>
                <div class="item">
                    <div class="in">
                        <div>
                            Private Profile
                        </div>
                        <div class="form-check form-switch ms-2">
                            <input class="form-check-input" type="checkbox" id="SwitchCheckDefault2">
                            <label class="form-check-label" for="SwitchCheckDefault2"></label>
                        </div>
                    </div>
                </div>
            </li> -->
        </ul>

        <div class="listview-title mt-1">Security</div>
        <ul class="listview image-listview text mb-2 inset">
            <li data-bs-toggle="collapse" data-bs-target="#passworder" aria-expanded="false">
                <a href="#" class="item">
                    <div class="in">
                        <div>Update Password</div>
                    </div>
                </a>
            </li>
            <div id="passworder" class="accordion-collapse collapse" data-bs-parent="#accordionExample1" style="">
              <div class="accordion-body">
                <form class="" action="/auth/password" method="post">
                  <div class="form-group boxed">
                    <div class="input-wrapper">
                      <label class="label" for="password4b"></label>
                      <input type="password" autocomplete="off" class="form-control" id="password4b" placeholder="enter old password" name="old_password">
                      <i class="clear-input">
                        <ion-icon name="close-circle" role="img" class="md hydrated" aria-label="close circle"></ion-icon>
                      </i>
                    </div>

                    <div class="input-wrapper">
                      <label class="label" for="password4b"></label>
                      <input type="password" autocomplete="off" class="form-control" id="password4b" placeholder="enter new password" name="new_password">
                      <i class="clear-input">
                        <ion-icon name="close-circle" role="img" class="md hydrated" aria-label="close circle"></ion-icon>
                      </i>
                    </div>

                    <div class="input-wrapper">
                      <label class="label" for="password4b"></label>
                      <input type="password" id="password4b" autocomplete="off" class="form-control" placeholder="re-type new password" name="re_password">
                      <i class="clear-input">
                        <ion-icon name="close-circle" role="img" class="md hydrated" aria-label="close circle"></ion-icon>
                      </i>
                    </div>

                    <div class="mt-1"></div>
                    <div class="input-wrapper">
                      <button type="submit" class="btn btn-primary btn-block">Update Password</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <li class="collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#pin" aria-expanded="false">
                <a href="#" class="item">
                    <div class="in">
                        <div>Update Transaction Pin</div>
                    </div>
                </a>
            </li>
            <div id="pin" class="accordion-collapse collapse" data-bs-parent="#accordionExample1" style="">
              <div class="accordion-body">
                <form class="" action="/auth/pin" method="post">
                  <div class="form-group boxed">
                    <div class="input-wrapper">
                      <label class="label" for="password4b"></label>
                      <input type="password" maxlength="4" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\.*?)\..*/g, '$1');" autocomplete="off" class="form-control" id="password4b" placeholder="enter old pin" name="old_pin">
                      <i class="clear-input">
                        <ion-icon name="close-circle" role="img" class="md hydrated" aria-label="close circle"></ion-icon>
                      </i>
                    </div>

                    <div class="input-wrapper">
                      <label class="label" for="password4b"></label>
                      <input type="password" maxlength="4" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\.*?)\..*/g, '$1');" autocomplete="off" class="form-control" id="password4b" placeholder="enter new pin" name="new_pin">
                      <i class="clear-input">
                        <ion-icon name="close-circle" role="img" class="md hydrated" aria-label="close circle"></ion-icon>
                      </i>
                    </div>

                    <div class="input-wrapper">
                      <label class="label" for="password4b"></label>
                      <input type="password" maxlength="4" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\.*?)\..*/g, '$1');" autocomplete="off" class="form-control" id="password4b" placeholder="re-type new pin" name="re_pin">
                      <i class="clear-input">
                        <ion-icon name="close-circle" role="img" class="md hydrated" aria-label="close circle"></ion-icon>
                      </i>
                    </div>

                    <div class="mt-1"></div>
                    <div class="input-wrapper">
                      <button type="submit" class="btn btn-primary btn-block">Update Pin</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <!-- <li>
                <div class="item">
                    <div class="in">
                        <div>
                            2 Step Verification
                        </div>
                        <div class="form-check form-switch ms-2">
                            <input class="form-check-input" type="checkbox" id="SwitchCheckDefault3" checked />
                            <label class="form-check-label" for="SwitchCheckDefault3"></label>
                        </div>
                    </div>
                </div>
            </li> -->
            <li>
                <a href="/auth/logout" class="item">
                    <div class="in">
                        <div>Log out all devices</div>
                    </div>
                </a>
            </li>
        </ul>
    </div>
    <!-- * App Capsule -->

    <!-- Success Action Sheet -->
    <div id="toast-11" class="toast-box toast-center" style="z-index: 999999999999;">
        <div class="in">
            <ion-icon name="checkmark-circle" class="text-success md hydrated" role="img" aria-label="checkmark circle"></ion-icon>
            <div class="text" id="succ-modal">
                Success Message
            </div>
        </div>
        <button type="button" class="btn btn-sm btn-text-light close-button close">OK</button>
    </div>

    <!-- Failed Action Sheet -->
    <div id="toast-90" class="toast-box toast-center" style="z-index: 99999999999;">
        <div class="in">
            <ion-icon name="close-circle" role="img" class="text-danger md hydrated" aria-label="close circle"></ion-icon>
            <div class="text" id="failed-modal">
                Failed Message
            </div>
        </div>
        <button type="button" class="btn btn-sm btn-text-light close-button">CLOSE</button>
    </div>

    <div id="toast-16" class="toast-box toast-bottom bg-danger" style="z-index: 999999999999999999;">
        <div class="in">
            <div class="text" id="dang-msg">
                Danger Message
            </div>
        </div>
        <button type="button" class="btn btn-sm btn-text-light close-button">OK</button>
    </div>

    <script>
    $(".close").click(function () {
      window.location.href = '/account'
    })
    $('form').submit(function(e) {
      e.preventDefault();

      var formData = new FormData($(this)[0]);
      $thiss = $(this).find("[type=submit]");
      var action = e.currentTarget.action;
      $thiss.text("please wait...");
      $thiss.addClass("disabled");

      $.ajax({
          url:  action,
          type: 'POST',
          data: formData,
          dataType: "json",
          cache: false,
          contentType: false,
          processData: false,
          success : function(data){
            // data = JSON.parse(data);
              // console.log(data);
              if (data.status == true){
                $("#succ-modal").html(data.message);
                // $("#succ").click();
                toastbox('toast-11');
                $thiss.text("Update");
                $thiss.removeClass("disabled");
                $('form')[0].reset()
              } else {
                  $thiss.text("Update");
                  $thiss.removeClass("disabled");
                  $("#failed-modal").html(data.message);
                  toastbox('toast-90');
                  // $("#dang").click();
              }
          }
      }).fail(function (jqXHR, textStatus, error) {
          // Handle error here
          console.log(jqXHR, textStatus, error);
          $thiss.text("Update");
          $thiss.removeClass("disabled");
          $("#failed-modal").html(jqXHR.responseText);
          toastbox('toast-90');
      });
    })

    </script>

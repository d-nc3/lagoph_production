<?php

$first_name = isset($info['first_name']) ? strtoupper($info['first_name']) : '';
$last_name = isset($info['last_name']) ? strtoupper($info['last_name']) : '';
$middle_name = isset($info['middle_name']) ? strtoupper($info['middle_name']) :'';
$position = isset($info['position']) ? $info['position'] : '';
$date_hired = isset($info['date_hired']) ? $info['date_hired'] : '';
$address = isset($info['birth_place']) ? strtoupper($info['birth_place']) : '';
$mobile_number = isset($info['mobile_number']) ? '+63 ' . strtoupper($info['mobile_number']) : '';
$email = isset($info['email']) ? $info['email'] : '';
$position = isset($info['role']) ? $info['role'] : ' ';
$address = isset($info['address']) ? $info['address'] : '';

$full_path = isset($info['profile_path']) ? $info['profile_path'] : 'uploads/user/profile/default.jpg';
$public_path = str_replace('\\', '/', $full_path); 
$base_path = str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']);
$relative_path = str_replace($base_path, '', $public_path);
$profile_picture_url =$relative_path;
?>





<?php $this->load->view('layout/header'); ?>
<div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">
    <?php $this->load->view('layout/sidenav'); ?>
    <div class="layout-page">
      <?php $this->load->view('layout/navbar'); ?>
      <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
          <h4 class="py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4>
          <?php $this->load->view('layout/settings-option/index') ?>
          <div class="card mb-4">
            <h5 class="card-header">Profile Details</h5>
            <!-- Account -->




            <div class="card-body">

              <form id="editProfileInformation" onsubmit="return false">
                <div class="card-body">
                  <div class="d-flex align-items-start align-items-sm-center gap-4">
                    <img src="<?=$profile_picture_url?>" alt="Current profile picture" class="rounded"
                      id="currentProfileImage" width="120" height="120" />

                    <div class="button-wrapper">
                      <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                        <span class="d-none d-sm-block">Upload new photo</span>
                        <i class="bx bx-upload d-block d-sm-none"></i>
                        <input value="<?=$profile_picture_url?>"type="file" id="upload" name="profile-picture" class="account-file-input" hidden
                          accept="image/png, image/jpeg" />
                      </label>

                      <button type="button" class="btn btn-label-secondary account-image-reset mb-4" id="resetButton">
                        <i class="bx bx-reset d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Reset</span>
                      </button>

                      <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                    </div>

                  </div>
                </div>
                <hr class="my-0" />
                <div class="row">
                  <div class="mb-3 col-md-6">
                    <label for="firstName" class="form-label">First Name</label>
                    <input class="form-control" type="text" id="firstName" name="first_name" value="<?=$first_name?>" autofocus />

                  </div>

                  <div class="mb-3 col-md-6">
                    <label for="middleName" class="form-label">Middle Name</label>
                    <input class="form-control" type="text" name="middle_name" id="middleName" value="<?=$middle_name?>" />
                  </div>

                  <div class="mb-3 col-md-6">
                    <label for="lastName" class="form-label">Last Name</label>
                    <input class="form-control" type="text" name="last_name" id="lastName" value="<?=$last_name?>" />
                  </div>


                  <div class="mb-3 col-md-6">
                    <label for="email" class="form-label">E-mail</label>
                    <input class="form-control" type="text" id="email" name="email" value="<?=$email?>"
                      placeholder="john.doe@example.com" />

                  </div>

                  <div class="mb-3 col-md-6">
                    <label class="form-label" for="phoneNumber">Phone Number</label>
                    <div class="input-group input-group-merge">
                      <span class="input-group-text">PH (+63)</span>
                      <input type="text" id="phoneNumber" name="phone_number" class="form-control" value="<?=$mobile_number?>"
                        placeholder="202 555 0111" />
                    </div>
                  </div>

                  <div class="mb-3 col-md-6">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="<?=$address?>"/>
                  </div>
                </div>

                <div class="mt-2">
                  <button id="submitButton" class="btn btn-primary me-2">Save changes</button>
                  <button type="reset" class="btn btn-label-secondary">Cancel</button>
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

</div>

<div class="content-backdrop fade"></div>

</div>

<!-- Content wrapper -->

</div>

</div>



<?php $this->load->view('layout/footer'); ?>
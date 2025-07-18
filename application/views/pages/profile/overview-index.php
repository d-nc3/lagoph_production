<?php
$first_name = isset($info['first_name']) ? strtoupper($info['first_name']) : '';
$last_name = isset($info['last_name']) ? strtoupper($info['last_name']) : '';
$position = isset($info['position']) ? $info['position'] : '';
$date_hired = isset($info['date_hired']) ? $info['date_hired'] : '';
$address = isset($info['birth_place']) ? strtoupper($info['birth_place']) : '';
$mobile_number = isset($info['mobile_number']) ? '+63 ' . strtoupper($info['mobile_number']) : '';
$email = isset($info['email']) ? $info['email'] : '';
$position = isset($info['role']) ? $info['role'] : ' ';

// Path to user document or default image
$img_path_url = isset($user_documents['doc_path']) &&
  $user_documents['doc_path'] &&
  file_exists(FCPATH . $user_documents['doc_path']) ?
  base_url($user_documents['doc_path']) :
  base_url('assets/img/avatars/1.png');

?>


<?php $this->load->view('layout/header'); ?>
<div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">
    <?php $this->load->view('layout/sidenav'); ?>
    <div class="layout-page">
      <?php $this->load->view('layout/navbar'); ?>
      <div class="content-wrapper">

        <div class="container-xxl flex-grow-1 container-p-y">
          <h4 class="py-3 mb-4"><span class="text-muted fw-light">Account Settings/</span> Profile</h4>



          <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
              <!-- Left Card (User Profile) -->

              <div class="col-xl-4 col-lg-5 col-md-5 mb-4">
                <div class="card">
                  <div class="card-body">
                    <div class="user-profile-header text-center mb-3">
                      <img
                        src="<?= $img_path_url ?>"
                        alt="user image"
                        class="d-block mx-auto rounded-circle user-profile-img"
                        style="width: 180px; height: 180px;" />
                      <h4 class="mt-3 mb-1 no-uppercase"><?= $first_name ?> <?= $last_name ?></h4>

                      <p class="text-muted badge bg-label-primary"><?= $position ?></p>
                    </div>
                    <button class="btn text-decoration-none" data-bs-toggle="collapse" data-bs-target="#collapseAbout" aria-expanded="false" aria-controls="collapseAbout">
                      <i class="bx bx-chevron-down ms-2" id="collapseIcon"></i>
                      <span class="fw-bold">DETAILS</span>
                    </button>
                    <hr id="separatorLine" class="my-3" style=" 1px dotted #000; width: 50%; margin: 20px auto 10px auto;" />
                  </div>
                  <div id="collapseAbout" class="collapse show">
                    <div class="px-5">
                      <ul class="list-unstyled mb-4 ">
                        <li class="d-flex align-items-start mb-3">

                          <div>
                            <span class="fw-bold d-block">Full Name:</span>
                            <span class="d-block"><?= $first_name ?> <?= $last_name ?></span>
                          </div>
                        </li>
                        <li class="d-flex align-items-start mb-3">

                          <div>
                            <span class="fw-bold d-block">Status:</span>
                            <span class="d-block">Active</span>
                          </div>
                        </li>

                        <li class="d-flex align-items-start mb-3">

                          <div>
                            <span class="fw-bold d-block">Country:</span>
                            <span class="d-block">Philippines</span>
                          </div>
                        </li>
                        <li class="d-flex align-items-center mb-3">
                          <div>
                            <span class="fw-bold d-block">Contact:</span>
                            <span class="d-block"><?= $mobile_number ?? 'N/A' ?> </span>
                          </div>
                        </li>
                        <li class="d-flex align-items-center mb-3">
                          <div>
                            <span class="fw-bold d-block">Skype:</span>
                            <span class="d-block"><?= $skype ?? 'N/A' ?></span>
                          </div>
                        </li>
                        <li class="d-flex align-items-center mb-5">
                          <div>
                            <span class="fw-bold d-block">Email:</span>
                            <span class="d-block"><?= $email ?></span>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <!--/ About User -->

              </div>
              <!-- <div class="col-xl-8 col-lg-7 col-md-7">
                <!-- Activity Timeline --> <?php $this->load->view('layout/profile-nav/nav-options') ?>
                <div class="card card-action mb-4">
                  <div class="card-header align-items-center">
                    <h5 class="card-action-title mb-0"><i class="bx bx-list-ul me-2"></i>Activity Timeline</h5>
                  </div>
                  <div class="card-body  overflow-hidden mb-4" style="height: 500px;">
                    <div class="card-body" id="vertical-example">
                      <ul class="timeline pt-3">
                        <?php if (isset($user_logs) && is_array($user_logs)): ?>
                          <?php foreach ($user_logs as $log): ?>
                            <?php if (isset($log['type_of_action'])): ?>
                              <?php
                              $iconClass = '';
                              switch ($log['type_of_action']) {
                                case 'User Add':
                                  $iconClass = '
                                  <li class="timeline-item pb-4 timeline-item-primary border-left-dashed">
                                    <span class="timeline-point-wrapper"><span class="timeline-point timeline-point-info"></span></span>
                                    <div class="timeline-event">
                                      <div class="timeline-header mb-3">
                                        <b class="text-uppercase">' . $log['type_of_action'] . '</b>
                                        <button class="btn btn-outline-primary btn-sm">View Profile</button>
                                      </div>
                                      <div class="d-flex justify-content-between mb-2">
                                        <div><span>' . $log['action_description'] . '</span></div>
                                        <div><span class="text-muted">' . $log['updated_at'] . '</span></div>
                                      </div>
                                    </div>
                                  </li>';
                                  break;
                              
                                case 'User Edit':
                                  $iconClass = '
                                  <li class="timeline-item pb-4 timeline-item-success border-left-dashed">
                                    <span class="timeline-point-wrapper"><span class="timeline-point timeline-point-success"></span></span>
                                    <div class="timeline-event">
                                      <div class="timeline-header mb-3">
                                        <b>' . $log['type_of_action'] . '</b>
                                        <span class="text-muted">' . $log['updated_at'] . '</span>
                                      </div>
                                      <hr />
                                      <p>' . $log['action_description'] . '</p>
                                    </div>
                                  </li>';
                                  break;
                              
                                case 'User Delete':
                                  $iconClass = '
                                  <li class="timeline-item pb-4 timeline-item-danger border-left-dashed">
                                    <span class="timeline-point-wrapper"><span class="timeline-point timeline-point-danger"></span></span>
                                    <div class="timeline-event">
                                      <div class="timeline-header mb-3">
                                        <b>' . $log['type_of_action'] . '</b>
                                        <span class="text-muted">' . $log['updated_at'] . '</span>
                                      </div>
                                      <hr />
                                      <p>' . $log['action_description'] . '</p>
                                    </div>
                                  </li>';
                                  break;
                              
                                case 'Membership Application Update':
                                  $iconClass = '
                                  <li class="timeline-item pb-4 timeline-item-info border-left-dashed">
                                    <span class="timeline-point-wrapper"><span class="timeline-point timeline-point-primary"></span></span>
                                    <div class="timeline-event">
                                      <div class="timeline-header">
                                        <b>' . $log['type_of_action'] . '</b>
                                        <span class="text-muted">' . $log['updated_at'] . '</span>
                                      </div>
                                      <hr />
                                      <p>' . $log['action_description'] . '</p>
                                      <div class="d-flex justify-content-between">
                                        <button class="btn btn-outline-secondary btn-sm">Contact</button>
                                        <button class="btn btn-outline-success btn-sm">View Update</button>
                                      </div>
                                    </div>
                                  </li>';
                                  break;
                              
                                case 'Membership Application Rejected':
                                  $iconClass = '
                                  <li class="timeline-item pb-4 timeline-item-danger border-left-dashed">
                                    <span class="timeline-point-wrapper"><span class="timeline-point timeline-point-danger"></span></span>
                                    <div class="timeline-event">
                                      <div class="timeline-header mb-3">
                                        <b class="text-uppercase">' . $log['type_of_action'] . '</b>
                                        <button class="btn btn-outline-primary btn-sm">View Profile</button>
                                      </div>
                                      <div class="d-flex justify-content-between mb-2">
                                        <div><span>' . $log['action_description'] . '</span></div>
                                        <div><span class="text-muted">' . $log['updated_at'] . '</span></div>
                                      </div>
                                    </div>
                                      
                                    
                                    </div>
                                  </li>';
                                  break;
                              }
                              
                              ?>
                              <?= $iconClass ?>
                            <?php endif; ?>
                          <?php endforeach; ?>
                        <?php endif; ?>
                      </ul>

                    </div>
                  </div>
                </div>
                <!-- /Activity Timeline -->
              </div> -->
            </div>
          </div>
        </div>
        <!--/ User Profile Content -->
      </div>
    </div>
    <div class="content-backdrop fade"></div>
  </div>
  <!-- Content wrapper -->
</div>
</div>

<?php $this->load->view('layout/footer'); ?>
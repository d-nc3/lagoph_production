<?php
$first_name = isset($info['first_name']) ? $info['first_name'] : '';
$last_name = isset($info['last_name']) ? $info['last_name'] : '';
$position = isset($info['role']) ? $info['role'] : '';
$date_hired = isset($info['date_hired']) ? $info['date_hired'] : '';
$address = isset($info['birth_place']) ? strtoupper($info['birth_place']) : '';
$mobile_number = isset($info['mobile_number']) ? '+63 ' . strtoupper($info['mobile_number']) : '';
$email = isset($info['email']) ? $info['email'] : '';


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
          <h4 class="py-3 mb-4"><span class="text-muted fw-light">User Profile /</span> Profile</h4>


          <div class="row">
            <div class="col-12">
              <div class="card mb-4">
                <div class="user-profile-header-banner">
                  <img src="assets/img/pages/profile-banner.png" alt="Banner image" class="rounded-top" />
                </div>
                <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                  <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                    <img
                      src="assets/img/avatars/1.png"
                      alt="user image"
                      class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img" />
                  </div>
                  <div class="flex-grow-1 mt-3 mt-sm-5">
                    <div
                      class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                      <div class="user-profile-info">
                        <h4><?= $first_name ?> <?= $last_name ?></h4>
                        <ul
                          class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                          <li class="list-inline-item fw-medium"><i class="bx bx-pen"></i> <?= $position ?></li>
                          <li class="list-inline-item fw-medium"><i class="bx bx-map"></i> <?= $address ?></li>
                          <li class="list-inline-item fw-medium">
                            <i class="bx bx-calendar-alt"></i> Joined <?= $date_hired ?>
                          </li>
                        </ul>
                      </div>
                      <a href="javascript:void(0)" class="btn btn-primary text-nowrap">
                        <i class="bx bx-user-check me-1"></i>Connected
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--/ Header -->
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-5">
              <!-- About User -->
              <div class="card mb-4">
                <div class="card-body">
                  <small class="text-muted text-uppercase">About</small>
                  <ul class="list-unstyled mb-4 mt-3">
                    <li class="d-flex align-items-center mb-3">
                      <i class="bx bx-user"></i><span class="fw-medium mx-2">Full Name:</span> <span><?= $first_name ?> <?= $last_name ?></span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                      <i class="bx bx-check"></i><span class="fw-medium mx-2">Status:</span> <span>Active</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                      <i class="bx bx-star"></i><span class="fw-medium mx-2">Role:</span> <span>Developer</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                      <i class="bx bx-flag"></i><span class="fw-medium mx-2">Country:</span> <span>USA</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                      <i class="bx bx-detail"></i><span class="fw-medium mx-2">Languages:</span>
                      <span>English</span>
                    </li>
                  </ul>
                  <small class="text-muted text-uppercase">Contacts</small>
                  <ul class="list-unstyled mb-4 mt-3">
                    <li class="d-flex align-items-center mb-3">
                      <i class="bx bx-phone"></i><span class="fw-medium mx-2">Contact:</span>
                      <span>(123) 456-7890</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                      <i class="bx bx-chat"></i><span class="fw-medium mx-2">Skype:</span> <span>john.doe</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                      <i class="bx bx-envelope"></i><span class="fw-medium mx-2">Email:</span>
                      <span>john.doe@example.com</span>
                    </li>
                  </ul>
                  <small class="text-muted text-uppercase">Teams</small>
                  <ul class="list-unstyled mt-3 mb-0">
                    <li class="d-flex align-items-center mb-3">
                      <i class="bx bxl-github text-primary me-2"></i>
                      <div class="d-flex flex-wrap">
                        <span class="fw-medium me-2">Backend Developer</span><span>(126 Members)</span>
                      </div>
                    </li>
                    <li class="d-flex align-items-center">
                      <i class="bx bxl-react text-info me-2"></i>
                      <div class="d-flex flex-wrap">
                        <span class="fw-medium me-2">React Developer</span><span>(98 Members)</span>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
              <!--/ About User -->
              <!-- Profile Overview -->
              <div class="card mb-4">
                <div class="card-body">
                  <small class="text-muted text-uppercase">Overview</small>
                  <ul class="list-unstyled mt-3 mb-0">
                    <li class="d-flex align-items-center mb-3">
                      <i class="bx bx-check"></i><span class="fw-medium mx-2">Task Compiled:</span>
                      <span>13.5k</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                      <i class="bx bx-customize"></i><span class="fw-medium mx-2">Projects Compiled:</span>
                      <span>146</span>
                    </li>
                    <li class="d-flex align-items-center">
                      <i class="bx bx-user"></i><span class="fw-medium mx-2">Connections:</span> <span>897</span>
                    </li>
                  </ul>
                </div>
              </div>
              <!--/ Profile Overview -->
            </div>
            <div class="col-xl-8 col-lg-7 col-md-7">
              <!-- Activity Timeline -->
              <div class="card card-action mb-4">
                <div class="card-header align-items-center">
                  <h5 class="card-action-title mb-0"><i class="bx bx-list-ul me-2"></i>Activity Timeline</h5>
                  <div class="card-action-element">
                    <div class="dropdown">
                      <button
                        type="button"
                        class="btn dropdown-toggle hide-arrow p-0"
                        data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="javascript:void(0);">Share timeline</a></li>
                        <li><a class="dropdown-item" href="javascript:void(0);">Suggest edits</a></li>
                        <li>
                          <hr class="dropdown-divider" />
                        </li>
                        <li><a class="dropdown-item" href="javascript:void(0);">Report bug</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <ul class="timeline ms-2">
                    <li class="timeline-item timeline-item-transparent">
                      <span class="timeline-point-wrapper"><span class="timeline-point timeline-point-warning"></span></span>
                      <div class="timeline-event">
                        <div class="timeline-header mb-1">
                          <h6 class="mb-0">Client Meeting</h6>
                          <small class="text-muted">Today</small>
                        </div>
                        <p class="mb-2">Project meeting with john @10:15am</p>
                        <div class="d-flex flex-wrap">
                          <div class="avatar me-3">
                            <img src="assets/img/avatars/3.png" alt="Avatar" class="rounded-circle" />
                          </div>
                          <div>
                            <h6 class="mb-0">Lester McCarthy (Client)</h6>
                            <span>CEO of Infibeam</span>
                          </div>
                        </div>
                      </div>
                    </li>
                    <li class="timeline-item timeline-item-transparent">
                      <span class="timeline-point-wrapper"><span class="timeline-point timeline-point-info"></span></span>
                      <div class="timeline-event">
                        <div class="timeline-header mb-1">
                          <h6 class="mb-0">Create a new project for client</h6>
                          <small class="text-muted">2 Day Ago</small>
                        </div>
                        <p class="mb-0">Add files to new design folder</p>
                      </div>
                    </li>
                    <li class="timeline-item timeline-item-transparent">
                      <span class="timeline-point-wrapper"><span class="timeline-point timeline-point-primary"></span></span>
                      <div class="timeline-event">
                        <div class="timeline-header mb-1">
                          <h6 class="mb-0">Shared 2 New Project Files</h6>
                          <small class="text-muted">6 Day Ago</small>
                        </div>
                        <p class="mb-2">
                          Sent by Mollie Dixon
                          <img
                            src="assets/img/avatars/4.png"
                            class="rounded-circle ms-3"
                            alt="avatar"
                            height="20"
                            width="20" />
                        </p>
                        <div class="d-flex flex-wrap gap-2">
                          <a href="javascript:void(0)" class="me-3">
                            <img
                              src="assets/img/icons/misc/pdf.png"
                              alt="Document image"
                              width="20"
                              class="me-2" />
                            <span class="h6">App Guidelines</span>
                          </a>
                          <a href="javascript:void(0)">
                            <img
                              src="assets/img/icons/misc/doc.png"
                              alt="Excel image"
                              width="20"
                              class="me-2" />
                            <span class="h6">Testing Results</span>
                          </a>
                        </div>
                      </div>
                    </li>
                    <li class="timeline-item timeline-item-transparent">
                      <span class="timeline-point-wrapper"><span class="timeline-point timeline-point-success"></span></span>
                      <div class="timeline-event pb-0">
                        <div class="timeline-header mb-1">
                          <h6 class="mb-0">Project status updated</h6>
                          <small class="text-muted">10 Day Ago</small>
                        </div>
                        <p class="mb-0">Woocommerce iOS App Completed</p>
                      </div>
                    </li>
                    <li class="timeline-end-indicator">
                      <i class="bx bx-check-circle"></i>
                    </li>
                  </ul>
                </div>
              </div>
              <!--/ Activity Timeline -->
              <div class="row">
                <!-- Connections -->
                <div class="col-lg-12 col-xl-6">
                  <div class="card card-action mb-4">
                    <div class="card-header align-items-center">
                      <h5 class="card-action-title mb-0">Connections</h5>
                      <div class="card-action-element">
                        <div class="dropdown">
                          <button
                            type="button"
                            class="btn dropdown-toggle hide-arrow p-0"
                            data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="bx bx-dots-vertical-rounded"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="javascript:void(0);">Share connections</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);">Suggest edits</a></li>
                            <li>
                              <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item" href="javascript:void(0);">Report bug</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                      <ul class="list-unstyled mb-0">
                        <li class="mb-3">
                          <div class="d-flex align-items-start">
                            <div class="d-flex align-items-start">
                              <div class="avatar me-3">
                                <img src="assets/img/avatars/2.png" alt="Avatar" class="rounded-circle" />
                              </div>
                              <div class="me-2">
                                <h6 class="mb-0">Cecilia Payne</h6>
                                <small class="text-muted">45 Connections</small>
                              </div>
                            </div>
                            <div class="ms-auto">
                              <button class="btn btn-label-primary btn-icon btn-sm">
                                <i class="bx bx-user"></i>
                              </button>
                            </div>
                          </div>
                        </li>
                        <li class="mb-3">
                          <div class="d-flex align-items-start">
                            <div class="d-flex align-items-start">
                              <div class="avatar me-3">
                                <img src="assets/img/avatars/3.png" alt="Avatar" class="rounded-circle" />
                              </div>
                              <div class="me-2">
                                <h6 class="mb-0">Curtis Fletcher</h6>
                                <small class="text-muted">1.32k Connections</small>
                              </div>
                            </div>
                            <div class="ms-auto">
                              <button class="btn btn-primary btn-icon btn-sm"><i class="bx bx-user"></i></button>
                            </div>
                          </div>
                        </li>
                        <li class="mb-3">
                          <div class="d-flex align-items-start">
                            <div class="d-flex align-items-start">
                              <div class="avatar me-3">
                                <img src="assets/img/avatars/10.png" alt="Avatar" class="rounded-circle" />
                              </div>
                              <div class="me-2">
                                <h6 class="mb-0">Alice Stone</h6>
                                <small class="text-muted">125 Connections</small>
                              </div>
                            </div>
                            <div class="ms-auto">
                              <button class="btn btn-primary btn-icon btn-sm"><i class="bx bx-user"></i></button>
                            </div>
                          </div>
                        </li>
                        <li class="mb-3">
                          <div class="d-flex align-items-start">
                            <div class="d-flex align-items-start">
                              <div class="avatar me-3">
                                <img src="assets/img/avatars/7.png" alt="Avatar" class="rounded-circle" />
                              </div>
                              <div class="me-2">
                                <h6 class="mb-0">Darrell Barnes</h6>
                                <small class="text-muted">456 Connections</small>
                              </div>
                            </div>
                            <div class="ms-auto">
                              <button class="btn btn-label-primary btn-icon btn-sm">
                                <i class="bx bx-user"></i>
                              </button>
                            </div>
                          </div>
                        </li>

                        <li class="mb-3">
                          <div class="d-flex align-items-start">
                            <div class="d-flex align-items-start">
                              <div class="avatar me-3">
                                <img src="assets/img/avatars/12.png" alt="Avatar" class="rounded-circle" />
                              </div>
                              <div class="me-2">
                                <h6 class="mb-0">Eugenia Moore</h6>
                                <small class="text-muted">1.2k Connections</small>
                              </div>
                            </div>
                            <div class="ms-auto">
                              <button class="btn btn-label-primary btn-icon btn-sm">
                                <i class="bx bx-user"></i>
                              </button>
                            </div>
                          </div>
                        </li>
                        <li class="text-center">
                          <a href="javascript:;">View all connections</a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <!--/ Connections -->
                <!-- Teams -->
                <div class="col-lg-12 col-xl-6">
                  <div class="card card-action mb-4">
                    <div class="card-header align-items-center">
                      <h5 class="card-action-title mb-0">Teams</h5>
                      <div class="card-action-element">
                        <div class="dropdown">
                          <button
                            type="button"
                            class="btn dropdown-toggle hide-arrow p-0"
                            data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="bx bx-dots-vertical-rounded"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="javascript:void(0);">Share teams</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);">Suggest edits</a></li>
                            <li>
                              <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item" href="javascript:void(0);">Report bug</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                      <ul class="list-unstyled mb-0">
                        <li class="mb-3">
                          <div class="d-flex align-items-center">
                            <div class="d-flex align-items-start">
                              <div class="avatar me-3">
                                <img
                                  src="assets/img/icons/brands/react-label.png"
                                  alt="Avatar"
                                  class="rounded-circle" />
                              </div>
                              <div class="me-2">
                                <h6 class="mb-0">React Developers</h6>
                                <small class="text-muted">72 Members</small>
                              </div>
                            </div>
                            <div class="ms-auto">
                              <a href="javascript:;"><span class="badge bg-label-danger">Developer</span></a>
                            </div>
                          </div>
                        </li>
                        <li class="mb-3">
                          <div class="d-flex align-items-center">
                            <div class="d-flex align-items-start">
                              <div class="avatar me-3">
                                <img
                                  src="assets/img/icons/brands/support-label.png"
                                  alt="Avatar"
                                  class="rounded-circle" />
                              </div>
                              <div class="me-2">
                                <h6 class="mb-0">Support Team</h6>
                                <small class="text-muted">122 Members</small>
                              </div>
                            </div>
                            <div class="ms-auto">
                              <a href="javascript:;"><span class="badge bg-label-primary">Support</span></a>
                            </div>
                          </div>
                        </li>
                        <li class="mb-3">
                          <div class="d-flex align-items-center">
                            <div class="d-flex align-items-start">
                              <div class="avatar me-3">
                                <img
                                  src="assets/img/icons/brands/figma-label.png"
                                  alt="Avatar"
                                  class="rounded-circle" />
                              </div>
                              <div class="me-2">
                                <h6 class="mb-0">UI Designers</h6>
                                <small class="text-muted">7 Members</small>
                              </div>
                            </div>
                            <div class="ms-auto">
                              <a href="javascript:;"><span class="badge bg-label-info">Designer</span></a>
                            </div>
                          </div>
                        </li>
                        <li class="mb-3">
                          <div class="d-flex align-items-center">
                            <div class="d-flex align-items-start">
                              <div class="avatar me-3">
                                <img
                                  src="assets/img/icons/brands/vue-label.png"
                                  alt="Avatar"
                                  class="rounded-circle" />
                              </div>
                              <div class="me-2">
                                <h6 class="mb-0">Vue.js Developers</h6>
                                <small class="text-muted">289 Members</small>
                              </div>
                            </div>
                            <div class="ms-auto">
                              <a href="javascript:;"><span class="badge bg-label-danger">Developer</span></a>
                            </div>
                          </div>
                        </li>
                        <li class="mb-3">
                          <div class="d-flex align-items-center">
                            <div class="d-flex align-items-start">
                              <div class="avatar me-3">
                                <img
                                  src="assets/img/icons/brands/twitter-label.png"
                                  alt="Avatar"
                                  class="rounded-circle" />
                              </div>
                              <div class="me-w">
                                <h6 class="mb-0">Digital Marketing</h6>
                                <small class="text-muted">24 Members</small>
                              </div>
                            </div>
                            <div class="ms-auto">
                              <a href="javascript:;"><span class="badge bg-label-secondary">Marketing</span></a>
                            </div>
                          </div>
                        </li>
                        <li class="text-center">
                          <a href="javascript:;">View all teams</a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <!--/ Teams -->
              </div>
              <!-- Projects table -->
              <div class="card mb-4">
                <h5 class="card-header">Projects List</h5>
                <div class="table-responsive mb-3">
                  <table class="table datatable-project">
                    <thead class="table-light">
                      <tr>
                        <th></th>
                        <th></th>
                        <th>Project</th>
                        <th class="text-nowrap">Total Task</th>
                        <th>Progress</th>
                        <th>Hours</th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>
              <!--/ Projects table -->
            </div>
          </div>
          <!--/ User Profile Content -->
        </div>

        <?php $this->load->view('layout/footer'); ?>
<?php
$first_name = $this->session->userdata('first_name');
$last_name = $this->session->userdata('last_name');
?>
<div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">
    <div class="layout-page">
      <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
          <div class="card bg-transparent shadow-none border-0 my-4">
            <div class="card-body row p-0 pb-3">
              <div class="col-12 col-md-8 card-separator">
                <h3>Welcome back, <?= $first_name ?> <?= $last_name ?> 👋🏻</h3>
                <div class="col-12 col-lg-7">
                  <p>You're one step closer to your membership! Book your seminar schedule today and complete your journey to becoming an official member. </p>
                </div>
               

              </div>
              <div class="col-12 col-md-4 ps-md-3 ps-lg-5 pt-3 pt-md-0">
                <div class="d-flex justify-content-between align-items-center">
                  <div>
                    <div>
                      <h5 class="mb-2">Time Spendings</h5>
                      <p class="mb-4">Weekly report</p>
                    </div>
                    <div class="time-spending-chart">
                      <h3 class="mb-2">231<span class="text-muted">h</span> 14<span class="text-muted">m</span></h3>
                      <span class="badge bg-label-success">+18.4%</span>
                    </div>
                  </div>
                  <div id="leadsReportChart"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="row mb-4 g-4 ">
            <div class="col-12 col-xl-8">
              <div class="card h-100 shadow-sm rounded-4">
                <!-- Card Header -->
                <div class="card-header d-flex align-items-center justify-content-between bg-light border-bottom">
                  <h5 class="card-title m-0 text-primary">Calendar of Activities</h5>
                </div>

                <!-- Card Body -->
                <div class="card-body app-calendar-wrapper">
                  <!-- Book Seminar Button -->
                  <div class="mb-4">
                    <a href="<?= base_url('membership/schedules') ?>" class="btn btn-primary w-100">
                      Book Seminar Schedule
                    </a>
                  </div>

                  <!-- Calendar Section -->
                  <div class="row app-calendar-content">
                    <div class="col-12 p-3">
                      <div id="calendar" class=" rounded p-2"></div>
                    </div>
                  </div>

                  <!-- Sidebar and Overlay (Hidden until triggered) -->
                  <div class="app-overlay d-none"></div>
                  <div class="offcanvas offcanvas-end event-sidebar" tabindex="-1" id="addEventSidebar"
                    aria-labelledby="addEventSidebarLabel">
                    <!-- Dynamic event content will be injected here -->
                  </div>
                </div>
              </div>
            </div>




            <div class="col-12 col-xl-4 col-md-6">
              <div class="card h-50">
                <div class="card-body">
                  <div class="bg-label-primary rounded-3 text-center mb-3 pt-4">
                    <img
                      class="img-fluid w-60"
                      src="assets/img/illustrations/sitting-girl-with-laptop-dark.png"
                      alt="Card girl image" />
                  </div>
                  <h4 class="mb-2 pb-1">Upcoming Webinar</h4>
                  <p class="small">
                    Next Generation Frontend Architecture Using Layout Engine And React Native Web.
                  </p>
                  <div class="row mb-3 g-3">
                    <div class="col-6">
                      <div class="d-flex">
                        <div class="avatar flex-shrink-0 me-2">
                          <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-calendar-exclamation bx-sm"></i></span>
                        </div>
                        <div>
                          <h6 class="mb-0 text-nowrap">17 Nov 23</h6>
                          <small>Date</small>
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="d-flex">
                        <div class="avatar flex-shrink-0 me-2">
                          <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-time-five bx-sm"></i></span>
                        </div>
                        <div>
                          <h6 class="mb-0 text-nowrap">32 minutes</h6>
                          <small>Duration</small>
                        </div>
                      </div>
                    </div>
                  </div>
                  <a href="javascript:void(0);" class="btn btn-primary w-100">Join the event</a>
                </div>
              </div>
            </div>

          </div>
          <!--  Topic and Instructors  End-->


        </div>
        <!-- / Content -->
        <div class="content-backdrop fade"></div>
      </div>
    </div>
  </div>
  <div class="layout-overlay layout-menu-toggle"></div>
  <div class="drag-target"></div>
</div>
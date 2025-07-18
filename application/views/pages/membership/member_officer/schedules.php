<?php $this->load->view('layout/header'); ?>
<div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">
    <?php $this->load->view('layout/sidenav'); ?>
    <div class="layout-page">
      <!-- Content wrapper -->
      <div class="content-wrapper">
        <?php $this->load->view('layout/navbar'); ?>
        <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-1"><span class="text-muted fw-light">Dashboard /</span> Event and Schedules
      
      </h4>
          <div class="card app-calendar-wrapper">
            <div class="row g-0">
              <!-- Calendar Sidebar -->
              <div class="col app-calendar-sidebar" id="app-calendar-sidebar">
                <div class="border-bottom p-4 my-sm-0 mb-3">
                  <div class="d-grid">
                    <button
                      class="btn btn-primary btn-toggle-sidebar"
                      data-bs-toggle="offcanvas"
                      data-bs-target="#addEventSidebar"
                      aria-controls="addEventSidebar">
                      <i class="bx bx-plus me-1"></i>
                      <span class="align-middle">Add Event</span>
                    </button>
                  </div>
                </div>
                <div class="p-4">
                  <!-- inline calendar (flatpicker) -->
                  <div class="ms-n2">
                    <div class="inline-calendar"></div>
                  </div>

                  <hr class="container-m-nx my-4" />

                  <!-- Filter -->
                  <div class="mb-4">
                    <small class="text-small text-muted text-uppercase align-middle">Filter</small>
                  </div>

                  <div class="form-check mb-2">
                    <input
                      class="form-check-input select-all"
                      type="checkbox"
                      id="selectAll"
                      data-value="all"
                      checked />
                    <label class="form-check-label" for="selectAll">View All</label>
                  </div>

                  <div class="app-calendar-events-filter">
                    <div class="form-check form-check-danger mb-2">
                      <input
                        class="form-check-input input-filter"
                        type="checkbox"
                        id="select-personal"
                        data-value="personal"
                        checked />
                      <label class="form-check-label" for="select-personal">Personal</label>
                    </div>
                    <div class="form-check mb-2">
                      <input
                        class="form-check-input input-filter"
                        type="checkbox"
                        id="select-business"
                        data-value="business"
                        checked />
                      <label class="form-check-label" for="select-business">Business</label>
                    </div>
                    <div class="form-check form-check-warning mb-2">
                      <input
                        class="form-check-input input-filter"
                        type="checkbox"
                        id="select-family"
                        data-value="family"
                        checked />
                      <label class="form-check-label" for="select-family">Family</label>
                    </div>
                    <div class="form-check form-check-success mb-2">
                      <input
                        class="form-check-input input-filter"
                        type="checkbox"
                        id="select-holiday"
                        data-value="holiday"
                        checked />
                      <label class="form-check-label" for="select-holiday">Holiday</label>
                    </div>
                    <div class="form-check form-check-info">
                      <input
                        class="form-check-input input-filter"
                        type="checkbox"
                        id="select-etc"
                        data-value="etc"
                        checked />
                      <label class="form-check-label" for="select-etc">ETC</label>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /Calendar Sidebar -->

              <!-- Calendar & Modal -->
              <div class="col app-calendar-content">
                <div class="card shadow-none border-0">
                  <div class="card-body pb-0">
                    <!-- FullCalendar -->
                    <div id="calendar"></div>
                  </div>
                </div>
                <div class="app-overlay"></div>
                <!-- FullCalendar Offcanvas -->
                <div
                  class="offcanvas offcanvas-end event-sidebar"
                  tabindex="-1"
                  id="addEventSidebar"
                  aria-labelledby="addEventSidebarLabel">
                  <div class="offcanvas-header border-bottom">
                    <h5 class="offcanvas-title mb-2" id="addEventSidebarLabel">Add Event</h5>
                    <button
                      type="button"
                      class="btn-close text-reset"
                      data-bs-dismiss="offcanvas"
                      aria-label="Close"></button>
                  </div>
                  <div class="offcanvas-body">
                    <form class="event-form pt-0" id="eventForm" onsubmit="return false">
                      <!-- Event Title -->
                      <input type="hidden" name="calendar_id" value="1" />
                      <input type="hidden" name="creator_id" value="<?= $info['id'] ?>" />
                      <div class="mb-3">
                        <label class="form-label" for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Event Title" />
                      </div>

                      <!-- Start DateTime -->
                      <div class="mb-3">
                        <label class="form-label" for="start_datetime">Start Date & Time</label>
                        <input type="datetime-local" class="form-control" id="start_datetime" name="start_datetime" />
                      </div>

                      <!-- End DateTime -->
                      <div class="mb-3">
                        <label class="form-label" for="end_datetime">End Date & Time</label>
                        <input type="datetime-local" class="form-control" id="end_datetime" name="end_datetime" />
                      </div>
                      
                      <!-- Status -->
                      <div class="mb-3">
                        <label class="form-label" for="status">Status</label>
                        <select class="form-select" id="status" name="status">
                          <option value="confirmed" selected>Confirmed</option>
                          <option value="tentative">Tentative</option>
                          <option value="cancelled">Cancelled</option>
                        </select>
                      </div>

                      <!-- Description -->
                      <!-- Video Link -->
                      <div class="mb-3">
                        <label class="form-label" for="video_link">Video Link</label>
                        <input type="url" class="form-control" id="video_link" name="video_link" placeholder="https://example.com/meet" />
                      </div>

                      <!-- Location -->
                      <div class="mb-3">
                        <label class="form-label" for="location">Location</label>
                        <input type="text" class="form-control" id="location" name="location" placeholder="Enter Location" />
                      </div>

                      <div class="mb-3">
                        <label class="form-label" for="description">Description</label>
                        <textarea class="form-control" name="description" id="description"></textarea>
                      </div>

                      <!-- Buttons -->
                      <div class="mb-3 d-flex justify-content-sm-between justify-content-start my-4">
                        <div>
                          <button type="submit" class="btn btn-primary btn-add-event me-sm-3 me-1">Add</button>
                          <button type="reset" class="btn btn-label-secondary btn-cancel me-sm-0 me-1" data-bs-dismiss="offcanvas">Cancel</button>
                        </div>
                        <div>
                          <button class="btn btn-label-danger btn-delete-event d-none">Delete</button>
                        </div>
                      </div>
                    </form>

                  </div>
                </div>
              </div>
              <!-- /Calendar & Modal -->
            </div>
          </div>
        </div>


        <div class="content-backdrop fade"></div>
      </div>
      <!--/ Content wrapper -->
    </div>
  </div>
</div>
<?php $this->load->view('layout/footer'); ?>
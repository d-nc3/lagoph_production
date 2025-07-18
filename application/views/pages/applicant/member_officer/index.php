<?php

$pending_members = $pending_member_approval ?? 0;

$approved_members = $approved_member ?? 0;

$total_users = $total_users ?? 0;



?>



<div class="container-xxl flex-grow-1 container-p-y">

  <h4 class="py-1"><span class="text-muted fw-light">Dashboard /</span> Member Applicant</h4>

  <p>

    A role provided access to predefined menus and features so that depending on <br />

    assigned role an administrator can have access to what user needs.

  </p>



  <div class="row g-4 mb-4">

    <!-- Pending Member Approval -->
    <div class="col-12 col-md-6 col-xl-4">
      <div class="card h-100">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Pending Member Approval</span>
              <div class="d-flex align-items-end mt-2">
                <h4 class="mb-0 me-2"><?= $pending_members ?></h4>
                <small class="text-success">(+29%)</small>
              </div>
              <p class="mb-0">Total Users</p>
            </div>
            <div class="avatar">
              <span class="avatar-initial rounded bg-label-primary">
                <i class="bx bx-user bx-sm"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Approved Member Application -->
    <div class="col-12 col-md-6 col-xl-4">
      <div class="card h-100">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Approved Member Application</span>
              <div class="d-flex align-items-end mt-2">
                <h4 class="mb-0 me-2"><?= $approved_members ?></h4>
                <small class="text-success">(+18%)</small>
              </div>
              <p class="mb-0">Last week analytics</p>
            </div>
            <div class="avatar">
              <span class="avatar-initial rounded bg-label-danger">
                <i class="bx bx-user-check bx-sm"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Total Users -->
    <div class="col-12 col-md-6 col-xl-4">
      <div class="card h-100">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Total Users</span>
              <div class="d-flex align-items-end mt-2">
                <h4 class="mb-0 me-2"><?= $total_users ?></h4>
                <small class="text-success">(+42%)</small>
              </div>
              <p class="mb-0">Last week analytics</p>
            </div>
            <div class="avatar">
              <span class="avatar-initial rounded bg-label-warning">
                <i class="bx bx-user-voice bx-sm"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Users List Table -->

  <div class="card">

    <div class="card-header border-bottom">

      <h5 class="card-title">Search Filter</h5>

      <div class="row py-3 gap-3 gap-md-0">

        <div class="col-md-4">

          <select id="sex" class="select2 form-select" data-hide-filter="true" data-allow-clear="true">

            <option value=""></option>

            <option value="Male">Male</option>

            <option value="Female">Female</option>

          </select>

        </div>

        <div class="col-md-4">

          <select id="civilStatus" class="select2 form-select" data-hide-filter="true" data-allow-clear="true">

            <option value=""></option>

            <option value="Single">Single</option>

            <option value="Married">Married</option>

            <option value="Widowed">Widowed</option>

            <option value="Legally Separated">Legally Separated</option>

          </select>

        </div>

        <div class="col-md-4">

          <select id="birthPlace" class="select2 form-select" data-hide-filter="true" data-allow-clear="true">

            <option value=""></option>

            <option value="NCR">National Capital Region (NCR)</option>

            <option value="CAR">Cordillera Administrative Region (CAR)</option>

            <option value="Region I">Ilocos Region (Region I)</option>

            <option value="Region II">Cagayan Valley (Region II)</option>

            <option value="Region III">Central Luzon (Region III)</option>

            <option value="Region IV-A">Calabarzon (Region IV-A)</option>

            <option value="Region IV-B">Southwestern Tagalog Region (Region IV-B)</option>

            <option value="Region V">Bicol Region (Region V)</option>

            <option value="Region VI">Western Visayas (Region VI)</option>

            <option value="Region VII">Central Visayas (Region VII)</option>

            <option value="Region VIII">Eastern Visayas (Region VIII)</option>

            <option value="Region IX">Zamboanga Peninsula (Region IX)</option>

            <option value="Region X">Northern Mindanao (Region X)</option>

            <option value="Region XI">Davao Region (Region XI)</option>

            <option value="Region XII">Soccsksargen (Region XII)</option>

            <option value="Region XIII">Caraga (Region XIII)</option>

            <option value="BARMM">Bangsamoro (BARMM)</option>

          </select>

        </div>

      </div>

    </div>

    <div class="card-datatable table-responsive">

      <table class="datatables-member-officer table border-top">

        <thead>

          <tr>

            <th></th>

            <th>Reference No</th>

            <th>Applicant</th>

            <th>Sex</th>

            <th>Civil Status</th>

            <th>Mobile No</th>

            <th>Actions</th>

          </tr>

        </thead>

      </table>

    </div>

  </div>

</div>

<!-- / Content -->





<div class="content-backdrop fade"></div>

</div>



</div>

</div>

</div>
<?php $this->load->view('layout/header'); ?>
<div class="layout-wrapper layout-content-navbar">
 <div class="layout-container">
  <?php $this->load->view('layout/sidenav'); ?>
  <div class="layout-page">
   <?php $this->load->view('layout/navbar'); ?>
    <div class="container-xxl flex-grow-1 container-p-y">
     <div class="row g-4 mb-4">
      <div class="col-sm-6 col-xl-3">
       <div class="card">
        <div class="card-body">
         <div class="d-flex align-items-start justify-content-between">
          <div class="content-left">
           <span>Session</span>
           <div class="d-flex align-items-end mt-2">
            <h4 class="mb-0 me-2">21,459</h4>
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
      <div class="col-sm-6 col-xl-3">
       <div class="card">
        <div class="card-body">
         <div class="d-flex align-items-start justify-content-between">
          <div class="content-left">
           <span>Paid Users</span>
           <div class="d-flex align-items-end mt-2">
            <h4 class="mb-0 me-2">4,567</h4>
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
      <div class="col-sm-6 col-xl-3">
       <div class="card">
        <div class="card-body">
         <div class="d-flex align-items-start justify-content-between">
          <div class="content-left">
           <span>Active Users</span>
           <div class="d-flex align-items-end mt-2">
            <h4 class="mb-0 me-2">19,860</h4>
            <small class="text-danger">(-14%)</small>
           </div>
           <p class="mb-0">Last week analytics</p>
          </div>
          <div class="avatar">
           <span class="avatar-initial rounded bg-label-success">
            <i class="bx bx-group bx-sm"></i>
           </span>
          </div>
         </div>
        </div>
       </div>
      </div>
      <div class="col-sm-6 col-xl-3">
       <div class="card">
        <div class="card-body">
         <div class="d-flex align-items-start justify-content-between">
          <div class="content-left">
           <span>Pending Users</span>
           <div class="d-flex align-items-end mt-2">
            <h4 class="mb-0 me-2">237</h4>
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

      </div>
      <div class="card-datatable table-responsive">
       <table class="datatables-users table border-top">
        <thead>
         <tr>
          <th></th>
          <th>Id</th>
          <th>Applicant Name</th>
          <th>Loan Amount</th>
          <th>Loan type</th>
          <th>Payment terms</th>
          <th>Status</th>
          <th>Actions</th>
          <th></th>

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
<?php $this->load->view('layout/footer'); ?>
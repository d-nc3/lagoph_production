<?php
$get_pending_loans = $pending_loans ?? 0;
$get_disbursed_loans = $disbursed_loans ?? 0;
$rejected_loans = $rejected_loans ?? 0;
$all_loans = $all_loans ?? 0;

?>

<?php $this->load->view('layout/header'); ?>
<div class="layout-wrapper layout-content-navbar">
 <div class="layout-container">
  <?php $this->load->view('layout/sidenav'); ?>
  <div class="layout-page">
   <?php $this->load->view('layout/navbar'); ?>



    <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-1"><span class="text-muted fw-light">Dashboard /</span> Loan Applicant</h4>
   <p>
   The Loan Applicant dashboard provides administrators with an overview of loan applications and user roles.<br/> Depending on assigned roles, administrators can manage access to specific menus and features, ensuring users have the necessary permissions to perform their tasks efficiently.
   </p>

     <div class="row g-4 mb-4">
      <div class="col-sm-6 col-xl-3">
       <div class="card">
        <div class="card-body">
         <div class="d-flex align-items-start justify-content-between">
          <div class="content-left">
           <span>Loans For Approval</span>
           <div class="d-flex align-items-end mt-2">
            <h4 class="mb-0 me-2"><?= $get_pending_loans ?></h4>
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
           <span>Disbursed Loans</span>
           <div class="d-flex align-items-end mt-2">
            <h4 class="mb-0 me-2"><?= $get_disbursed_loans ?></h4>
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
           <span>Rejected Loans</span>
           <div class="d-flex align-items-end mt-2">
            <h4 class="mb-0 me-2"><?= $rejected_loans ?></h4>
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
           <span>All loan Transactions</span>
           <div class="d-flex align-items-end mt-2">
            <h4 class="mb-0 me-2"><?= $all_loans ?></h4>
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

    <!-- Footer -->
    <footer class="content-footer footer bg-footer-theme">
     <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
      <div class="mb-2 mb-md-0">
       ©
       <script>
        document.write(new Date().getFullYear());
       </script>
       , made with ❤️ by
       <a href="https://themeselection.com" target="_blank" class="footer-link fw-medium">ThemeSelection</a>
      </div>
      <div class="d-none d-lg-inline-block">
       <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
       <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More Themes</a>

       <a
        href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/documentation/"
        target="_blank"
        class="footer-link me-4">Documentation</a>

       <a
        href="https://themeselection.com/support/"
        target="_blank"
        class="footer-link d-none d-sm-inline-block">Support</a>
      </div>
     </div>
    </footer>
    <!-- / Footer -->

    <div class="content-backdrop fade"></div>
   </div>

  </div>
 </div>
</div>
<?php $this->load->view('layout/footer'); ?>
<?php $this->load->view('layout/header'); ?>
<div class="layout-wrapper layout-content-navbar">
 <div class="layout-container">
  <?php $this->load->view('layout/sidenav'); ?>
  <div class="layout-page">
   <?php $this->load->view('layout/navbar'); ?>

   <!-- Content wrapper -->
   <div class="content-wrapper">


    <div class="container-xxl flex-grow-1 container-p-y">
     <h4 class="py-3 mb-4"><span class="text-muted fw-light">Applicant /</span> Receipt</h4>

     <!-- Invoice List Widget -->

     <div class="card mb-4">
      <div class="card-widget-separator-wrapper">
       <div class="card-body card-widget-separator">
        <div class="row gy-4 gy-sm-1">
         <div class="col-sm-6 col-lg-3">
          <div
           class="d-flex justify-content-between align-items-start card-widget-1 border-end pb-3 pb-sm-0">
           <div>
            <h3 class="mb-1">24</h3>
            <p class="mb-0">Clients</p>
           </div>
           <div class="avatar me-sm-4">
            <span class="avatar-initial rounded bg-label-secondary">
             <i class="bx bx-user bx-sm"></i>
            </span>
           </div>
          </div>
          <hr class="d-none d-sm-block d-lg-none me-4" />
         </div>
         <div class="col-sm-6 col-lg-3">
          <div
           class="d-flex justify-content-between align-items-start card-widget-2 border-end pb-3 pb-sm-0">
           <div>
            <h3 class="mb-1">165</h3>
            <p class="mb-0">Invoices</p>
           </div>
           <div class="avatar me-lg-4">
            <span class="avatar-initial rounded bg-label-secondary">
             <i class="bx bx-file bx-sm"></i>
            </span>
           </div>
          </div>
          <hr class="d-none d-sm-block d-lg-none" />
         </div>
         <div class="col-sm-6 col-lg-3">
          <div
           class="d-flex justify-content-between align-items-start border-end pb-3 pb-sm-0 card-widget-3">
           <div>
            <h3 class="mb-1">$2.46k</h3>
            <p class="mb-0">Paid</p>
           </div>
           <div class="avatar me-sm-4">
            <span class="avatar-initial rounded bg-label-secondary">
             <i class="bx bx-check-double bx-sm"></i>
            </span>
           </div>
          </div>
         </div>
         <div class="col-sm-6 col-lg-3">
          <div class="d-flex justify-content-between align-items-start">
           <div>
            <h3 class="mb-1">$876</h3>
            <p class="mb-0">Unpaid</p>
           </div>
           <div class="avatar">
            <span class="avatar-initial rounded bg-label-secondary">
             <i class="bx bx-error-circle bx-sm"></i>
            </span>
           </div>
          </div>
         </div>
        </div>
       </div>
      </div>
     </div>

     <!-- Invoice List Table -->
     <div class="card">
      <div class="card-header border-bottom">
       <h5 class="card-title">Search Filter</h5>
       <div class="row py-3 gap-3 gap-md-0">
        <div class="col-md-4">
         <label class="form-label" for="transaction-type">Type of Transaction</label>
         <select
          id="transaction-type-id"
          class="select2 form-select"
          name="transaction_type"
          data-hide-filter="true"
          data-allow-clear="true">
          <option value=""></option>
          <?php if (!empty($cash_accounts)): ?>
           <?php foreach ($cash_accounts as $key => $val): ?>
            <option value="<?= $val['id'] ?>"><?= $val['code_of_cash_account'] . '-' . $val['title'] ?></option>
           <?php endforeach; ?>
          <?php endif; ?>
         </select>
        </div>
       </div>
      </div>
      <div class="card-datatable table-responsive">
       <table class="datatables-transactions table border-top">
        <thead>
         <tr>

          <th>Invoice id</th>
          <th>Name</th>
          <th>Receipt Name</th>
          <th>Transaction type</th>
          <th>Status</th>
          <th>Actions</th>

         </tr>
        </thead>
       </table>
      </div>
     </div>
     <!--/ Content -->

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
    <!--/ Content wrapper -->
   </div>
   <?php $this->load->view('layout/footer'); ?>
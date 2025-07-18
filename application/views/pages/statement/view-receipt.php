<?php $this->load->view('layout/header'); ?>
<div class="layout-wrapper layout-content-navbar">
 <div class="layout-container">
  <?php $this->load->view('layout/sidenav'); ?>
  <div class="layout-page">
   <?php $this->load->view('layout/navbar'); ?>




   <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Transaction /</span> History</h4>

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

     </div>
     <div class="card-datatable table-responsive">
      <table class="table-bordered  table-striped datatables-transactions table border-top">
       <thead>
        <tr>

         <th></th>
         <th>Name</th>
         <th>Official Receipt #</th>
         <th>Payment date</th>
         <th>Actions</th>
        </tr>
       </thead>
      </table>
     </div>
    </div>

    <?php $this->load->view('layout/footer'); ?>
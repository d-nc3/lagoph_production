<?php $this->load->view('layout/header'); ?>
<div class="layout-wrapper layout-content-navbar">
 <div class="layout-container">
  <?php $this->load->view('layout/sidenav'); ?>
  <div class="layout-page">
   <?php $this->load->view('layout/navbar'); ?>

   <div class="content-wrapper">


    <div class="container-xxl flex-grow-1 container-p-y">
     <h4 class="py-3 mb-1"><span class="text-muted fw-light">Dashboard /</span> Member list</h4>
     <div class="row">
      <input type="text" id="user_id" value=<?= $info['user_id'] ?> hidden />

      <?php $this->load->view('pages/loan/loan_officer/layout/profile'); ?>

      <div class="col-xl-12">
       <div class="card overflow-hidden mb-4">
        <div class="card-datatable table-responsive">
         <div class="card-header border-bottom">
          <h5 class="card-title">Loan Transactions</h5>

         </div>
         <table class="datatables-payment table border-top">
          <thead>
           <tr>
            <th></th>
            <th>Id</th>
            <th>Name</th>
            <th>Date Of Payment &nbsp;</th>
            <th>Status &nbsp;</th>
            <th>Actions</th>
           </tr>
          </thead>
         </table>
        </div>
       </div>

<!-- Add New Address Modal -->
<div class="modal fade view_modal" id="data_table_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
         <div class="modal-content rounded-3 shadow-lg">
          <div class="modal-body p-4">
           <!-- Close Button -->
           <div class="d-flex justify-content-end">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
           </div>
           <div class="card-body">
         
           </div>
          </div>
         </div>
        </div>
       </div>

       <div class="content-backdrop fade"></div>
      </div>
     </div>
    </div>
    <div class="layout-overlay layout-menu-toggle"></div>
    <div class="drag-target"></div>
   </div>

   <?php $this->load->view('layout/footer'); ?>
<?php $this->load->view('layout/header'); ?>
<div class="layout-wrapper layout-content-navbar">
 <div class="layout-container">
  <?php $this->load->view('layout/sidenav'); ?>
  <div class="layout-page">
   <?php $this->load->view('layout/navbar'); ?>


   <!-- Content -->
   <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-1"><span class="text-muted fw-light">Dashboard /</span> Member list</h4>

    <!-- Users List Table -->
    <div class="card">
     <div class="card-header border-bottom">
      <h5 class="card-title">Search Filter</h5>
      <div class="row py-3 gap-3 gap-md-0">
       <div class="col-md-4">
        <label class="form-label" for="add-department-name">Join Date</label>
        <select
         id="department_id"
         class="select2 form-select"
         data-hide-filter="true"
         data-allow-clear="true">
         <option value=""></option>

        </select>
       </div>
       <div class="col-md-4">
        <label class="form-label" for="add-department-name">Civil Status</label>

        <select
         id="civil_status"
         class="select2 form-select"
         data-hide-filter="true"
         data-allow-clear="true">
         <option value=""></option>
         <option value="Single">Single</option>
         <option value="Married">Married</option>
         <option value="Widowed">Widowed</option>
         <option value="Separated">Separated</option>
         <option value="Divorced">Divorced</option>
        </select>

       </div>
       <div class="col-md-4">
        <label class="form-label" for="add-department-name">Status</label>
        <select
         id="status"
         class="select2 form-select"
         data-hide-filter="true"
         data-allow-clear="true">
         <option value=""></option>
         <option value="Approved">Approved</option>
         <option value="Completed">Completed</option>
         <option value="Processing">Processing</option>

        </select>
       </div>
      </div>
     </div>
     <div class="card-datatable table-responsive">
      <table class="datatables-employees table border-top">
       <thead>
        <tr>
         <th></th>
         <th>Member Name</th>
         <th>Join Date</th>
         <th>Status</th>
         <th>Actions</th>
        </tr>
       </thead>
      </table>
     </div>
    </div>
   </div>


  </div>
 </div>

 <?php $this->load->view('layout/footer'); ?>
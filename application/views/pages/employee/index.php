<?php $this->load->view('layout/header'); ?>
<div class="layout-wrapper layout-content-navbar">
 <div class="layout-container">
  <?php $this->load->view('layout/sidenav'); ?>
  <div class="layout-page">
   <?php $this->load->view('layout/navbar'); ?>


    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
     <h4 class="py-3 mb-1"><span class="text-muted fw-light">Dashboard /</span> Employees</h4>
     <p>
       A role provided access to predefined menus and features so that depending on <br />
       assigned role an administrator can have access to what user needs.
      </p>
     <!-- Users List Table -->
     <div class="card">
      <div class="card-header border-bottom">
       <h5 class="card-title">Search Filter</h5>
       <div class="row py-3 gap-3 gap-md-0">
        <div class="col-md-4">
         <label class="form-label" for="add-department-name">Department Name</label>
         <select
          id="department_id"
          class="select2 form-select"
          data-hide-filter="true"
          data-allow-clear="true">
          <option value=""></option>
          <?php if (!empty($departments)): ?>
           <?php foreach ($departments as $key => $val): ?>
            <option value="<?= $val['id'] ?>"><?= $val['department_name'] ?></option>
           <?php endforeach; ?>
          <?php endif; ?>
         </select>
        </div>

        <div class="col-md-4">
         <label class="form-label" for="add-department-name">Unit Name</label>
         <select
          id="unit_id"
          class="select2 form-select"
          data-hide-filter="true"
          data-allow-clear="true">
          <option value=""></option>`
          <?php if (!empty($units)): ?>
           <?php foreach ($units as $key => $val): ?>
            <option value="<?= $val['id'] ?>"><?= $val['unit_name'] ?></option>
           <?php endforeach; ?>
          <?php endif; ?>
         </select>
        </div>
        <!-- <div class="col-md-4">
                                        <select
                                            id="birth_place"
                                            class="select2 form-select"
                                            data-hide-filter="true"
                                            data-allow-clear="true" >
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
                                    </div> -->
       </div>
      </div>
      <div class="card-datatable table-responsive">
       <table class="datatables-employees table border-top">
        <thead>
         <tr>
          <th></th>
          <th>Employee Name</th>
          <th>Position</th>
          <th>Department Name</th>
          <th>Sex</th>

          <th>Date Hired</th>
          <th>Status</th>
          <th>Actions</th>

         </tr>
        </thead>
       </table>
      </div>
     </div>
    </div>
    <!-- / Content -->
    <div class="modal fade" id="data_table_modal" tabindex="-1" aria-hidden="true">
     <div class="modal-dialog modal-lg modal-simple">
      <div class="modal-content p-3 p-md-5">
       <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

        <!-- Modal Header -->
        <div class="text-center mb-4">
         <h3 class="address-title">Add Employee</h3>
         <p class="address-subtitle">Add Employee for System Accessibility</p>
        </div>
        <form id="addForm" class="row g-3" onsubmit="return true">
         <!-- Full Name -->
         <div class="col-md-6">
          <label class="form-label" for="modal_first_name">First Name</label>
          <input type="text" id="modal_first_name" name="modal_first_name" class="form-control" placeholder="Doe" />
         </div>
         <div class="col-md-6">
          <label class="form-label" for="modal_last_name">Last Name</label>
          <input type="text" id="modal_last_name" name="modal_last_name" class="form-control" placeholder="Doe" />
         </div>
         <div class="col-md-6">
          <label class="form-label" for="modal_middle_name">Middle Name</label>
          <input type="text" id="modal_middle_name" name="modal_middle_name" class="form-control" placeholder="Doe" />
         </div>

         <!-- Sex -->
         <div class="col-md-6">
          <label class="form-label">Sex</label>
          <div class="form-check custom mb-2">
           <input type="radio" id="modal_sex_male" name="modal_sex" value="Male" class="form-check-input" />
           <label class="form-check-label" for="modal_sex_male">Male</label>
          </div>
          <div class="form-check custom mb-6">
           <input type="radio" id="modal_sex_female" name="modal_sex" value="Female" class="form-check-input" />
           <label class="form-check-label" for="modal_sex_female">Female</label>
          </div>
         </div>

         <!-- Date of Birth -->
         <div class="col-sm-6">
          <label class="form-label" for="modal_date_of_birth">Date of Birth</label>
          <input type="date" class="form-control flatpickr-validation" id="modal_date_of_birth" name="modal_date_of_birth" />
         </div>

         <!-- Place of Birth -->
         <div class="col-sm-6">
          <label class="form-label" for="modal_place_of_birth">Place Of Birth</label>
          <select id="modal_place_of_birth" name="modal_place_of_birth" class="select2-search form-select" data-allow-clear="false">
           <option value="">Select Value</option>
           <!-- Regions options -->
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

         <!-- Employment Status -->
         <div class="col-sm-6">
          <label class="form-label" for="modal_employment_status">Employment Status</label>
          <select id="modal_employment_status" name="modal_employment_status" class="select2-search form-select" data-allow-clear="false">
           <option value="">Select Value</option>
           <option value="Employed">Employed</option>
           <option value="Terminated">Terminated</option>
           <option value="Resigned">Resigned</option>
          </select>
         </div>

         <!-- Mobile Number -->
         <div class="col-sm-6">
          <label class="form-label" for="modal_mobile_number">Mobile Number</label>
          <div class="input-group input-group-merge">
           <span class="input-group-text">PH (+63)</span>
           <input type="text" id="modal_mobile_number" name="modal_mobile_number" class="form-control mobile-number-mask" maxlength="12" placeholder="955 501 1022" />
          </div>
         </div>

         <!-- Divider for Employee Details -->
         <div class="divider">
          <div class="divider-text">Employee Details</div>
         </div>

         <!-- Date Hired -->
         <div class="col-sm-6">
          <label class="form-label" for="modal_date_hired">Date Hired</label>
          <input type="date" class="form-control flatpickr-validation" id="modal_date_hired" name="modal_date_hired" />
         </div>

         <!-- Position -->
         <div class="col-sm-6">
          <label class="form-label" for="modal_position_id">Position</label>
          <select id="modal_position_id" name="modal_position_id" class="form-select rel">
           <option value=""></option>
           <?php if (!empty($positions)): ?>
            <?php foreach ($positions as $key => $val): ?>
             <option value="<?= $val['id'] ?>"><?= $val['position_title'] ?></option>
            <?php endforeach; ?>
           <?php endif; ?>
          </select>
         </div>

         <!-- Email -->
         <div class="col-12 col-md-6">
          <label class="form-label" for="modal_email">Email</label>
          <input type="text" id="modal_email" name="modal_email" class="form-control" placeholder="sample@gmail.com" />
         </div>

         <!-- Form Buttons -->
         <div class="col-12 text-center">
          <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Save</button>
          <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
         </div>
        </form>
       </div>
      </div>
     </div>
    </div>


   </div>
  </div>

  <?php $this->load->view('layout/footer'); ?>
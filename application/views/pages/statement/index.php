<?php

?>
<?php $this->load->view('layout/header'); ?>
<div class="layout-wrapper layout-content-navbar">
 <div class="layout-container">
  <?php $this->load->view('layout/sidenav'); ?>
  <div class="layout-page">
   <?php $this->load->view('layout/navbar'); ?>
   <!-- Content wrapper -->
   <div class="content-wrapper">
    <div class="container-md  container-p-y">
     <h4 class="py-3 mb-4"><span class="text-muted fw-light">Statements/</span> Billings</h4>
     <div class="container-fluid">
      <div class="row">
       <!-- Billing Address Card -->
       <div class="container">
        <div class="row">
         <!-- Billing History Table -->
         <div class="row">
          <div class="col-lg-12 mb-4">
           <div class="card">
            <h5 class="card-header bg-primary text-white mb-5">Billing Address</h5>
            <div class="card-body">
             <?php if (empty($billing_address)) : ?>
              <form id="billing_settings" onsubmit="return false">
               <div class="row g-3">
                <div class="col-sm-6">
                 <div class="mb-3">
                  <label for="billingEmail" class="form-label">Billing Email</label>
                  <input class="form-control" type="text" id="billingEmail" name="billing_email" placeholder="john.doe@example.com" />
                 </div>
                </div>
                <div class="col-sm-6">
                 <div class="mb-3">
                  <label for="mobileNumber" class="form-label">Mobile</label>
                  <div class="input-group input-group-merge">
                   <span class="input-group-text">PH (+69)</span>
                   <input class="form-control mobile-number" type="text" id="mobileNumber" name="mobile_number" placeholder="10 200 0001" />
                  </div>
                 </div>
                </div>
               </div>
               <div class="row g-3">
                <div class="col-sm-6">
                 <div class="mb-3">
                  <label class="form-label" for="address">Address</label>
                  <textarea id="address" name="address" class="form-control" rows="2" placeholder="Unit/Building, Street, Barangay, Municipality/City, Province"></textarea>
                 </div>
                </div>
                <div class="col-sm-6">
                 <div class="mb-3">
                  <label class="form-label" for="province">Province</label>
                  <select id="province" name="province" class="select2 form-select" data-allow-clear="false">
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
                   <!-- Add province options here -->
                  </select>
                 </div>
                </div>
               </div>
               <div class="mt-3">
                <button type="submit" class="btn btn-primary me-2 submit-billing">Save changes</button>
                <button type="reset" class="btn btn-label-secondary">Reset</button>
               </div>
              </form>
             <?php else : ?>
              <ul class="list-unstyled">
               <!-- First Row of Details -->
               <div class="row">
                <div class="col-md-6">
                 <li class="d-flex ">
                  <i class="bx bx-envelope me-2 text-primary"></i>
                  <div>
                   <strong>Email: </strong><?= $billing_address['billing_email'] ?>
                  </div>
                 </li>
                </div>
                <div class="col-md-6">
                 <li class="d-flex mb-3">
                  <i class="bx bx-phone me-2 text-primary"></i>
                  <div>
                   <strong>Mobile Number: </strong><?= $billing_address['mobile_number'] ?>
                  </div>
                 </li>
                </div>
               </div>

               <!-- Second Row of Details -->
               <div class="row">
                <div class="col-md-6">
                 <li class="d-flex mb-3">
                  <i class="bx bx-map me-2 text-primary"></i>
                  <div>
                   <strong>Address: </strong><?= $billing_address['street_address'] ?>
                  </div>
                 </li>
                </div>
                <div class="col-md-6">
                 <li class="d-flex mb-3">
                  <i class="bx bx-flag me-2 text-primary"></i>
                  <div>
                   <strong>Province: </strong><?= $billing_address['province'] ?>
                  </div>
                 </li>
                </div>
               </div>
              </ul>
             <?php endif; ?>
            </div>
            <hr />
            <div class="card-datatable table-responsive">
             <table class="table-bordered  table-striped datatables-transactions table border-top">
              <thead>
               <tr>
                <th>Reference Number</th>
                <th>Date Issued</th>
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

       </div>
      </div>
     </div>
    </div>
   </div>
  </div>

  <div class="content-backdrop fade"></div>
 </div>
 <!--/ Content wrapper -->
</div>
<?php $this->load->view('layout/footer'); ?>
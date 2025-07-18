

<?php $this->load->view('layout/header'); ?>
<div class="layout-wrapper layout-content-navbar">
 <div class="layout-container">
  <?php $this->load->view('layout/sidenav'); ?>
  <div class="layout-page">
   <?php $this->load->view('layout/navbar'); ?>

   <!-- Content wrapper -->

   <div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
     <h4 class="py-3 mb-1"><span class="text-muted fw-light">Dashboard /</span> Member list</h4>
     <div class="row">
    
     <?php $this->load->view('pages/member/layout/profile',$info); ?>

       <!-- /Activity Timeline -->
       <div class="col-xl-12">
        <div class="card overflow-hidden mb-4">
         <div class="card-datatable table-responsive">
          <div class="card-header border-bottom">
           <h5 class="card-title">Payment Records</h5>

          </div>
          <table class="datatables-statement table border-top">
           <thead>
            <tr>
             <th></th>
             <th>Date</th>
             <th>Reference number</th>
              <th>Transaction Type</th>
             <th>Invoice</th>
            </tr>
           </thead>
          </table>
         </div>
        </div>



        <!-- Edit User Modal -->
        <div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
         <div class="modal-dialog modal-lg modal-simple modal-edit-user">
          <div class="modal-content p-3 p-md-5">
           <div class="modal-body">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="text-center mb-4">
             <h3>Edit User Information</h3>
             <p>Updating user details will receive a privacy audit.</p>
            </div>

            <form id="edit-form" class="row g-3" onsubmit="return true">
             <input type="hidden" id="edit-id" name="id" class="form-control" readonly />
             <div class="col-12 col-md-6">
              <label class="form-label" for="edit-first-name">First name</label>
              <input
               type="text"
               id="edit-first-name"
               class="form-control"
               placeholder="Enter First Name"
               name="first_name"
               aria-label="First name" />
             </div>

             <!-- Description -->
             <div class="col-12 col-md-6">
              <label class="form-label" for="edit-last-name">Last Name</label>
              <input
               type="text"
               id="edit-last-name"
               name="last_name"
               class="form-control"
               aria-label="Last Name"
               placeholder="Description"></textarea>
             </div>

             <div class="col-12 col-md-6">
              <label class="form-label" for="edit-middle-name">Middle Name</label>
              <input
               type="text"
               class="form-control"
               id="edit-middle-name"
               placeholder="Enter Middle Name"
               name="middle_name"
               aria-label="Middle Name" />
             </div>


             <div class="col-12 col-md-6">
              <label class="form-label" for="edit-sex">Sex</label>
              <select id="edit-sex " name="sex" class="select2 form-select" data-allow-clear="false">
               <option value="Male"> Male </option>
               <option value="Female">Female</option>
              </select>
             </div>


             <div class="col-12 col-md-6">
              <label class="form-label" for="edit-birth-place">Place Of Birth</label>
              <select id="edit-birth-place" name="place_of_birth" class="select2 form-select" data-allow-clear="false">

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

             <div class="col-12 col-md-6">
              <label class="form-label" for="edit-dob">Date of Birth</label>
              <input
               type="date"
               id="edit-dob"
               name="date_of_birth"
               class="form-control"
               data-allow-clear="false" />
             </div>



             <div class="col-12 col-md-6">
              <label class="form-label" for="edit-number">Email</label>
              <input
               type="text"
               id="edit-email"
               name="email"
               class="form-control"
               data-allow-clear="false" />

             </div>

             <div class="col-12 col-md-6">
              <label class="form-label" for="edit-number">Mobile Number</label>
              <input
               type="text"
               id="edit-number"
               name="mobile_number"
               class="form-control"
               data-allow-clear="false" />

             </div>


             <div class="col-12 col-md-6">
              <label class="form-label" for="edit-position-title">Position title</label>
              <select
               id="edit-position-title"
               class="select2 form-select"
               name="position_title"
               data-allow-clear="true">

               <?php if (!empty($positions)): ?>
                <?php foreach ($positions as $key => $val): ?>
                 <option value="<?= $val['id'] ?>"><?= $val['position_title'] ?></option>
                <?php endforeach; ?>
               <?php endif; ?>
              </select>
             </div>

             <div class="col-12 col-md-6">
              <label class="form-label" for="edit-date-hired">Date Hired </label>
              <input
               type="date"
               id="edit-date-hired"
               class="form-control"
               name="date_hired" />
             </div>

             <div class="col-12 col-md-6">
              <label class="form-label" for="edit-status">Status </label>
              <select id="edit-status" name="status" class="select2 form-select" data-allow-clear="false">

               <option value="Employed">Employed</option>
               <option value="Terminated">Terminated</option>
               <option value="Resigned">Resigned</option>
              </select>
             </div>

             <div class="col-12 text-center">
              <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Save</button>

              <button
               type="reset"
               class="btn btn-label-secondary"
               data-bs-dismiss="modal"
               aria-label="Close">
               Cancel
              </button>
             </div>
            </form>
           </div>
          </div>
         </div>
        </div>
        <!--/ Edit User Modal -->

        <div class="modal fade" id="creditBalanceModal" tabindex="-1" aria-labelledby="adjustBalanceModalLabel" aria-hidden="true">
         <div class="modal-dialog">
          <div class="modal-content">
           <div class="modal-header">
            <h5 class="modal-title" id="adjustBalanceModalLabel">Adjust Balance</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
           </div>
           <div class="modal-body">
            <div class="row g-2 mb-3">
             <div class="col-12">
              <div class="border p-3 rounded text-center">
               <p class="text-muted small mb-1">Current Balance</p>
               <p class="fs-5 fw-semibold">PHP <?=number_format($credit_information['available_credit'],2)?></p>
              </div>
             </div>
            
            </div>
            <div class="mb-3">
             <label class="form-label">Adjustment Type <span class="text-danger">*</span></label>
             <select class="form-select">
              <option>Debit</option>
              <option>Credit</option>
             </select>
            </div>
            <div class="mb-3">
             <label class="form-label">Amount <span class="text-danger">*</span></label>
             <input type="number" class="form-control" placeholder="Enter amount">
            </div>
            <div class="mb-3">
             <label class="form-label">Add adjustment note</label>
             <textarea class="form-control" rows="3"></textarea>
            </div>
            <p class="text-muted small">
             Please be aware that all manual balance changes will be audited by the financial team every fortnight.
             Please maintain your invoices and receipts until then. Thank you.
            </p>
           </div>
           <div class="modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Discard</button>
            <button type="button" class="btn btn-primary">Submit</button>
           </div>
          </div>
         </div>
        </div>




        <!-- /Modal -->
       </div>
       <!-- / Content -->

       <!-- Footer -->

       <!-- / Footer -->

       <div class="content-backdrop fade"></div>
      </div>
      <!-- Content wrapper -->
     </div>
     <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>

    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    <div class="drag-target"></div>
   </div>
   <!-- / Layout wrapper -->
   <?php $this->load->view('layout/footer'); ?>
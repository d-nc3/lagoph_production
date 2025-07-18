<?php
$loan_reference_number = isset($invoice['loan_reference_number']) && $invoice['loan_reference_number'] ? strtoupper($invoice['loan_reference_number']) : '';
$user_id = isset($invoice['user_id']) && $invoice['user_id'] ? strtoupper($invoice['user_id']) : '';
$loan_id = isset($invoice['loan_id']) ? $invoice['loan_id'] : '';
$member_id = isset($invoice['member_id']) && $invoice['member_id'] ? strtoupper($invoice['member_id']) : '';
$loan_status = isset($invoice['loan_status']) && $invoice['loan_status'] ? strtoupper($invoice['loan_status']) : '';
$first_name = isset($invoice['first_name']) && $invoice['first_name'] ? strtoupper($invoice['first_name']) : '';
$middle_name = isset($invoice['middle_name']) && $invoice['middle_name'] ? strtoupper($invoice['middle_name']) : '';
$last_name = isset($invoice['last_name']) && $invoice['last_name'] ? strtoupper($invoice['last_name']) : '';
$loan_amount = isset($invoice['loan_amount']) && $invoice['loan_amount'] ? $invoice['loan_amount'] : '';
$loan_type = isset($invoice['loan_type']) && $invoice['loan_type'] ? $invoice['loan_type'] : '';
$principal_with_interest = isset($invoice['principal_with_interest']) ? $invoice['principal_with_interest'] : null;
$remaining_balance = isset($invoice['remaining_balance']) && $invoice['remaining_balance'] ? strtoupper($invoice['remaining_balance']) : '';
$start_date = isset($invoice['start_date']) && $invoice['start_date'] ? strtoupper($invoice['start_date']) : '';
$end_date = isset($invoice['end_date']) && $invoice['end_date'] ? '+63 ' . strtoupper($invoice['end_date']) : '';
$loan_term = isset($invoice['loan_term']) && $invoice['loan_term'] ? $invoice['loan_term'] : '';
$date_applied = isset($invoice['created_at']) && $invoice['created_at'] ? $invoice['created_at'] : '';
$account_name = isset($invoice['account_name']) && $invoice['account_name'] ? $invoice['account_name'] : '';
$due_date = isset($invoice['due_date']) && $invoice['due_date'] ? $invoice['due_date'] : '';
$account_number = isset($invoice['account_number']) && $invoice['account_number'] ? $invoice['account_number'] : '';

$financial_service_provider = isset($invoice['financial_service_provider']) && $invoice['financial_service_provider'] ? $invoice['financial_service_provider'] : '';
?>
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
      <input type="text" id="user_id" value=<?= $info['user_id'] ?> hidden />
      <?php $this->load->view('pages/loan/loan_officer/layout/profile'); ?>

      <!-- /Activity Timeline -->
      <div class="col-xl-12">
       <div class="card overflow-hidden mb-4">
        <div class="card-datatable table-responsive">
         <div class="card-header border-bottom">
          <h5 class="card-title">Loan Transactions</h5>

         </div>
         <table class="datatables-view-loan table border-top">
          <thead>
           <tr>
            <th></th>
         
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



       <!-- Edit User Modal -->
       <div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-simple modal-edit-user">
         <div class="modal-content p-3 p-md-5">
          <div class="modal-body">
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
           <div class="text-center mb-4">
            <h3>Edit User invoicermation</h3>
            <p>Updating user details will receive a privacy audit.</p>
           </div>

           <form id="edit-form" class="row g-3" onsubmit="return true">
            <input type="hidden" id="edit-id" name="id" class="form-control" readonly />
            <div class="col-12 col-md-6">
             <label class="form-label" for="edit-first-name">First name</label>
             <input type="text" id="edit-first-name" class="form-control" placeholder="Enter First Name"
              name="first_name" aria-label="First name" />
            </div>

            <!-- Description -->
            <div class="col-12 col-md-6">
             <label class="form-label" for="edit-last-name">Last Name</label>
             <input type="text" id="edit-last-name" name="last_name" class="form-control"
              aria-label="Last Name" placeholder="Description"></textarea>
            </div>

            <div class="col-12 col-md-6">
             <label class="form-label" for="edit-middle-name">Middle Name</label>
             <input type="text" class="form-control" id="edit-middle-name" placeholder="Enter Middle Name"
              name="middle_name" aria-label="Middle Name" />
            </div>


            <div class="col-12 col-md-6">
             <label class="form-label" for="edit-sex">Sex</label>
             <select id="edit-sex " name="sex" class="select2 form-select" data-allow-clear="false">
              <option value="Male"> Male </option>
              <option value="Female">Female</option>
             </select>
            </div>


            <div class="col-12 col-md-6">
             <label class="form-label" for="edit-birth-place">Place Of
              Birth</label>
             <select id="edit-birth-place" name="place_of_birth" class="select2 form-select"
              data-allow-clear="false">

              <!-- Regions options -->
              <option value="NCR">National Capital Region (NCR)</option>
              <option value="CAR">Cordillera Administrative Region (CAR)
              </option>
              <option value="Region I">Ilocos Region (Region I)</option>
              <option value="Region II">Cagayan Valley (Region II)</option>
              <option value="Region III">Central Luzon (Region III)</option>
              <option value="Region IV-A">Calabarzon (Region IV-A)</option>
              <option value="Region IV-B">Southwestern Tagalog Region (Region
               IV-B)</option>
              <option value="Region V">Bicol Region (Region V)</option>
              <option value="Region VI">Western Visayas (Region VI)</option>
              <option value="Region VII">Central Visayas (Region VII)</option>
              <option value="Region VIII">Eastern Visayas (Region VIII)
              </option>
              <option value="Region IX">Zamboanga Peninsula (Region IX)
              </option>
              <option value="Region X">Northern Mindanao (Region X)</option>
              <option value="Region XI">Davao Region (Region XI)</option>
              <option value="Region XII">Soccsksargen (Region XII)</option>
              <option value="Region XIII">Caraga (Region XIII)</option>
              <option value="BARMM">Bangsamoro (BARMM)</option>
             </select>
            </div>

            <div class="col-12 col-md-6">
             <label class="form-label" for="edit-dob">Date of Birth</label>
             <input type="date" id="edit-dob" name="date_of_birth" class="form-control"
              data-allow-clear="false" />
            </div>



            <div class="col-12 col-md-6">
             <label class="form-label" for="edit-number">Email</label>
             <input type="text" id="edit-email" name="email" class="form-control"
              data-allow-clear="false" />

            </div>

            <div class="col-12 col-md-6">
             <label class="form-label" for="edit-number">Mobile Number</label>
             <input type="text" id="edit-number" name="mobile_number" class="form-control"
              data-allow-clear="false" />

            </div>


            <div class="col-12 col-md-6">
             <label class="form-label" for="edit-position-title">Position
              title</label>
             <select id="edit-position-title" class="select2 form-select" name="position_title"
              data-allow-clear="true">

              <?php if (!empty($positions)): ?>
               <?php foreach ($positions as $key => $val): ?>
                <option value="<?= $val['id'] ?>"><?= $val['position_title'] ?>
                </option>
               <?php endforeach; ?>
              <?php endif; ?>
             </select>
            </div>

            <div class="col-12 col-md-6">
             <label class="form-label" for="edit-date-hired">Date Hired </label>
             <input type="date" id="edit-date-hired" class="form-control" name="date_hired" />
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

             <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
              aria-label="Close">
              Cancel
             </button>
            </div>
           </form>
          </div>
         </div>
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
            <!-- Header -->
            <div class="d-flex justify-content-between flex-wrap align-items-center mb-4">
             <div class="d-flex align-items-center gap-3">
              <img
               src="<?= base_url('assets/img/branding/logo.png') ?>"
               alt="Loan Icon" width="60" height="60" />
              <div>
               <h5 class="mb-0 fw-bold">Loan Invoice</h5>
               <small class="text-primary fw-semibold">Loan Reference #:
                <?= $loan_reference_number ?></small><br>
               <small class="text-muted"><?= date('F j, Y', strtotime($start_date)) ?></small>
              </div>
             </div>
            </div>

            <hr>

            <!-- Borrower Info -->
            <div class="row mb-4">
             <div class="col-md-6 mb-3">
              <h6 class="fw-bold mb-2">Borrower Information</h6>
              <p class="mb-1"><strong>Name:</strong> <?= $first_name ?> <?= $last_name ?></p>
              <p class="mb-1"><strong>Loan Amount:</strong> PHP <?= number_format($loan_amount, 2) ?>
              </p>
              <p class="mb-1"><strong>Loan Type:</strong> <?= ucfirst($loan_type) ?> Loan</p>
              <p class="mb-1"><strong>Payment Term:</strong> <?= $loan_term ?> Months</p>
              <p class="mb-0"><strong>Total with Interest:</strong> PHP
               <?= number_format($principal_with_interest, 2) ?>
              </p>
             </div>

             <!-- Disbursement Info -->
             <div class="col-md-6">
              <h6 class="fw-bold mb-2">Disbursement Account</h6>
              <table class="table table-sm table-borderless mb-0">
               <tbody>
                <tr>
                 <td><strong>Total Due:</strong></td>
                 <td class="text-end">PHP <?= number_format($principal_with_interest, 2) ?></td>
                </tr>
                <tr>
                 <td><strong>Bank Name:</strong></td>
                 <td class="text-end"><?= $financial_service_provider ?></td>
                </tr>
                <tr>
                 <td><strong>Account Name:</strong></td>
                 <td class="text-end"><?= $account_name ?></td>
                </tr>
                <tr>
                 <td><strong>Account Number:</strong></td>
                 <td class="text-end"><?= $account_number ?></td>
                </tr>
               </tbody>
              </table>
             </div>
            </div>

            <!-- Loan Status -->
            <div class="mb-4">
             <h6 class="fw-bold mb-2">Loan Status</h6>
             <p class="text-muted mb-2">The current status of your loan application is:</p>
             <span
              class="badge <?= $loan_status === "Approved" ? 'bg-success' : ($loan_status === 'Pending' ? 'bg-warning' : 'bg-secondary') ?> px-3 py-2 text-white">
              <?= htmlspecialchars($loan_status) ?>
             </span>
            </div>

            <!-- Payment Term Summary -->
            <div class="table-responsive mb-4">
             <input type="hidden" value="<?= $loan_term ?>" id="paymentTerm" name="payment_term">
             <input type="hidden" value="<?= $loan_amount ?>" id="loanAmount" name="loan_amount">
             <input type="hidden" value="<?= $member_id ?>" id="memberId" name="member_id">
             <input type="hidden" value="<?= $loan_id ?>" id="loanId" name="loan_id">
             <table class="table table-bordered mb-0">
              <thead class="table-light">
               <tr>
                <th>#</th>
                <th>Due date</th>
                <th>Amount Due</th>
               </tr>
              </thead>
              <tbody id="tableBody">

               <td>1</td>
               <td><span id="date_due"></span></td>
               <td>PHP <span id="amount_due"></span></td>


               </tr>
              </tbody>
             </table>
            </div>

            <!-- Notes -->
            <div>
             <h6 class="fw-bold mb-2">Note:</h6>
             <p class="mb-1">Thank you for applying for a loan with us. We are committed to providing
              you with the best financial solutions.</p>
             <p><strong>Important:</strong> Please ensure your repayments are made on time to avoid
              penalties.</p>
            </div>
           </div>


           <!-- /Invoice Content -->
          </div>
         </div>
        </div>
       </div>

       <div class="content-backdrop fade"></div>
      </div>

     </div>

    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>

    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    <div class="drag-target"></div>
   </div>
   <!-- / Layout wrapper -->
   <?php $this->load->view('layout/footer'); ?>
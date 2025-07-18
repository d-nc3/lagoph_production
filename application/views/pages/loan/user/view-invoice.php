<?php
$loan_reference_number =   isset($info['loan_reference_number'])    &&  $info['loan_reference_number']   ?   strtoupper($info['loan_reference_number'])   :   '';
$user_id =   isset($info['user_id'])    &&  $info['user_id']   ?   strtoupper($info['user_id'])   :   '';

$member_id =   isset($info['member_id'])    &&  $info['member_id']   ?   strtoupper($info['member_id'])   :   '';
$loan_status =   isset($info['loan_status'])    &&  $info['loan_status']   ?   strtoupper($info['loan_status'])   :   '';
$first_name =   isset($info['first_name'])    &&  $info['first_name']   ?   strtoupper($info['first_name'])   :   '';
$middle_name =   isset($info['middle_name'])    &&  $info['middle_name']   ?    strtoupper($info['middle_name'])   :   '';
$last_name =   isset($info['last_name'])    &&  $info['last_name']   ?   strtoupper($info['last_name'])   :   '';
$loan_amount =   isset($info['loan_amount'])    &&  $info['loan_amount']   ?   $info['loan_amount']   :   '';
$loan_type =   isset($info['loan_type'])    &&  $info['loan_type']   ?   $info['loan_type']   :   '';
$principal_with_interest = isset($info['principal_with_interest']) ? $info['principal_with_interest'] : null;
$remaining_balance =   isset($info['remaining_balance'])    &&  $info['remaining_balance']   ?   strtoupper($info['remaining_balance'])   :   '';
$start_date =   isset($info['start_date'])    &&  $info['start_date']   ?   strtoupper($info['start_date'])   :   '';
$end_date =   isset($info['end_date'])    &&  $info['end_date']   ?  '+63 ' . strtoupper($info['end_date'])   :   '';
$loan_term =   isset($info['loan_term'])    &&  $info['loan_term']   ?  $info['loan_term']   :   '';
$date_applied = isset($info['created_at']) && $info['created_at'] ? $info['created_at'] : '';
$account_name = isset($info['account_name']) && $info['account_name'] ? $info['account_name'] : '';
$account_number = isset($info['account_number']) && $info['account_number'] ? $info['account_number'] : '';
$financial_service_provider = isset($info['financial_service_provider']) && $info['financial_service_provider'] ? $info['financial_service_provider'] : '';
$repayment_amount = isset($loan_info['amount_due']) && $loan_info['amount_due'] ? $loan_info['amount_due'] :  '';
$loan_due_date = isset($loan_info['due_date']) && $loan_info['due_date'] ? $loan_info['due_date'] :  '';
$loanId = isset($loan_info['id']) && $loan_info['id'] ? $loan_info['id'] :  '';
$repayment_status = isset($loan_info['status']) && $loan_info['status'] ? $loan_info['status'] :  '';



?>

<?php $this->load->view('layout/header'); ?>
<div class="layout-wrapper layout-content-navbar">
 <div class="layout-container">
  <?php $this->load->view('layout/sidenav'); ?>
  <div class="layout-page">
   <?php $this->load->view('layout/navbar'); ?>
   <!-- Content -->
   <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row invoice-preview">
     <!-- Invoice -->
     <div class="col-xl-9 col-md-8 col-12 mb-md-0 mb-4">
      <div class="card invoice-preview-card">
       <div class="card-body">
        <!-- Header with Logo and Loan Details -->
        <div class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column p-sm-3 p-0">
         <div class="mb-xl-0 mb-4">
          <div class="d-flex svg-illustration mb-3 gap-2">
           <span class="app-brand-logo demo">
            <div class="mb-xl-0 mb-4">
             <div class="d-flex svg-illustration mb-3 gap-2">
              <span class="app-brand-logo demo">
               <img width="66" height="66" src="https://img.icons8.com/external-smashingstocks-flat-smashing-stocks/66/external-Loan-online-payments-smashingstocks-flat-smashing-stocks.png" alt="external-Loan-online-payments-smashingstocks-flat-smashing-stocks" />
              </span>
              <span class="app-brand-text demo text-body fw-bold">CycommPh</span>
             </div>
             <!-- Revise to the actual address of the cooperative -->
             <p class="mb-1">Office 149, 450 South Brand Brooklyn</p>
             <p class="mb-1">San Diego County, CA 91905, USA</p>
             <p class="mb-0">+1 (123) 456 7891, +44 (876) 543 2198</p>
            </div>
           </span>

          </div>
         </div>
         <div class="text-right">
          <!-- Loan Reference and Date -->
          <h5 class="text-primary">Loan Reference #: <?= $loan_reference_number ?></h5>
          <p class="text-muted"><?= date('F j, Y', strtotime($loan_due_date)) ?>
          </p>
          </p>
         </div>
        </div>
       </div>
       <hr class="my-3" />
       <div class="card-body">
        <div class="row p-sm-3 p-0">
         <!-- Borrower Details -->
         <div class="col-xl-6 col-md-12 col-sm-5 col-12 mb-xl-0 mb-md-4 mb-sm-0 mb-4">
          <h6 class="fw-bold mb-2">Borrower Information</h6>
          <p class="mb-1"><strong>Name:</strong> <?= $first_name ?> <?= $last_name ?></p>
          <p class="mb-1"><strong>Loan Amount:</strong> PHP <?= number_format($loan_amount, 2) ?></p>
          <p class="mb-1"><strong>Loan Type:</strong> <?= ucfirst($loan_type) ?> Loan</p>
          <p class="mb-1"><strong>Payment Term:</strong> <?= $loan_term ?> Months</p>
          <p class="mb-0"><strong>Total Loan with Interest:</strong> PHP <?= number_format($principal_with_interest, 2) ?></p>
         </div>

         <!-- Disbursement Details -->
         <div class="col-xl-6 col-md-12 col-sm-7 col-12">
          <h6 class="fw-bold mb-2">Disbursement Account</h6>
          <table class="table table-borderless table-sm">
           <tbody>
            <tr>
             <td><strong>Total Due:</strong></td>
             <td class="text-end">PHP <?= $repayment_amount ?></td>
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
       </div>

       <!-- Loan Status Section -->
       <div class="card-body">
        <div class="row p-sm-3 p-0">
         <div class="col-12">
          <h6 class="fw-bold mb-2">Loan Status</h6>
          <p class="text-muted">The current status of your loan application is:</p>
          <!-- <div class="badge <?= $loan_status == 'approved' ? 'bg-success' : ($loan_status == 'pending' ? 'bg-warning' : 'bg-success') ?> text-light p-2">
                        <strong><?= ucfirst($loan_status) ?></strong>
                      </div> -->
         </div>
        </div>
       </div>

       <!-- Payment Installment Breakdown -->
       <div class="table-responsive">
        <table class="table table-bordered table-striped">
         <thead class="table-light">
          <tr>
           <th>#</th>
           <th>Loan Amount</th>
           <th>Due Date</th>
          </tr>
         </thead>
         <tbody id="tableBody">
          <th><?= $loanId ?></th>
          <th>PHP <?= number_format($repayment_amount, 2) ?></th>
          <th><?= date('F j, Y', strtotime($loan_due_date)) ?>
           </p>
          </th>
         </tbody>
        </table>
       </div>

       <!-- Footer Section with Terms and Notes -->
       <div class="card-body">
        <div class="row">
         <div class="col-12">
          <span class="fw-medium">Note:</span>
          <p>Thank you for applying for a loan with us. We are committed to providing you with the best financial solutions and look forward to assisting you in your journey!</p>
          <p><strong>Important:</strong> Please ensure that your repayment is made on or before the due date to avoid penalties.</p>
         </div>
        </div>
       </div>
      </div>
     </div>
     <!-- /Invoice -->
     <!-- Invoice Actions -->
     <?php if ($repayment_status == "pending"): ?>
      <div class="col-xl-3 col-md-4 col-12 invoice-actions">
       <div class="card">
        <div class="card-body">
         <a class="btn btn-label-secondary d-grid w-100 mb-3" target="_blank" href="./app-invoice-print.html">
          Print
         </a>
         <a href="./app-invoice-edit.html" class="btn btn-label-secondary d-grid w-100 mb-3">
          Edit Invoice
         </a>
         <button class="btn btn-primary d-grid w-100" data-bs-toggle="offcanvas" data-bs-target="#addPaymentOffcanvas">
          <span class="d-flex align-items-center justify-content-center text-nowrap"><i class="bx bx-dollar bx-xs me-1"></i>Add Payment</span>
         </button>
        </div>
       </div>
      </div>
     <?php else: ?>

      <div class="col-xl-3 col-md-4 col-12 invoice-actions">

       <div class="card">
        <div class="card-body">
         <a class="btn btn-label-secondary d-grid w-100 mb-3" target="_blank" href="./app-invoice-print.html">
          Print
         </a>
        </div>
       </div>
       <div class="mb-3">


       </div>
      <?php endif; ?>

      <!-- /Invoice Actions -->
      </div>
    </div>
    <!-- Content wrapper -->
    <!-- Add Payment Sidebar -->
    <div class="offcanvas offcanvas-end" id="addPaymentOffcanvas" aria-hidden="true">
     <div class="offcanvas-header mb-3">
      <h5 class="offcanvas-title">Add Payment</h5>
      <button
       type="button"
       class="btn-close text-reset"
       data-bs-dismiss="offcanvas"
       aria-label="Close">
      </button>
     </div>
     <div class="offcanvas-body flex-grow-1">
      <div class="d-flex justify-content-between bg-lighter p-2 mb-3">
       <p class="mb-0">Invoice Balance:</p>
       <p class="fw-medium mb-0">PHP <?= number_format($remaining_balance) ?></p>
      </div>
      <form id="paymentForm" class="row g-3" onsubmit="return false">
       <div class="mb-3">
        <label for="totalPayment" class="form-label">Enter Amount</label>
        <input type="number" id="totalPayment" name="total_payment" class="form-control" value="<?= $repayment_amount ?>" placeholder="₱0.00">
       </div>

        <input type="number" id="loan_schedule_id" name="schedule_id" class="form-control" value="<?=$loanId?>" hidden>
  
       <div class="mb-3 col-12 mb-0">
        <p>Upload Proof of payment/Receipt</p>
        <input type="file" id="attachments-membership-receipt" name="attachments[payment-receipt]" class="form-control" accept=".jpg,.jpeg">
       </div>

       <div class="mb-3">
        <label class="form-label" for="paymentMode">Payment Mode</label>
        <select class="form-select select2-search" id="paymentMode" name="payment_mode">
         <option value=""></option>
         <?php foreach ($payment_options as $val) : ?>
          <option value="<?= $val['id'] ?>"><?= $val['payment_name'] ?></option>
         <?php endforeach; ?>
        </select>
       </div>

       <div class="mb-3">
        <label for="paymentMethod" class="form-label">Payment Method</label>
        <select class="form-select select2-search" id="paymentMethod" name="payment_method">
         <option value=""></option>
         <?php foreach ($payment_method as $method) : ?>
          <option value="<?= $method['id'] ?>" data-mode="<?= $method['payment_option_id'] ?>">
           <?= $method['financial_service_provider'] ?>
          </option>
         <?php endforeach; ?>
        </select>
       </div>

       <div class="mb-3">
        <label for="payment-date" class="form-label">Payment Date:</label>
        <input type="date" id="payment-date" name='payment_date' class="form-control" placeholder="Select payment date">
       </div>
       <!-- <input type="hidden" name="invoice_id" value="<?= $invoice_id ?>"> -->
       <div class="mb-3" style="display:none;" id="accNameContainer">
        <label for="account">Account Name</label>
        <input type="text" id="accountName" name="account_name" class="form-control" placeholder="Account Name">
       </div>
       <div class="mb-3" style="display:none;" id="accNumContainer">
        <label for="account">Account Number</label>
        <input type="text" id="accountNum" name="account_number" class="form-control" placeholder="Account">
       </div>
       <div class="mb-3" style="display:none;" id="refNumContainer">
        <label for="reference_no">Reference No.</label>
        <input type="text" id="referenceNo" name="reference_number" class="form-control" placeholder="Reference No.">
       </div>

       <div class="mb-3 d-flex flex-wrap">
        <button class="btn btn-primary" id="submitPayment">Submit</button>
        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
       </div>
      </form>

     </div>
    </div>

    <!-- /Add Payment Sidebar -->
   </div>
   <!-- / Layout page -->
  </div>

  <!-- Overlay -->
  <div class="layout-overlay layout-menu-toggle"></div>

  <!-- Drag Target Area -->
  <div class="drag-target"></div>
 </div>
</div>



</div>
</div>
</div>
<?php $this->load->view('layout/footer'); ?>
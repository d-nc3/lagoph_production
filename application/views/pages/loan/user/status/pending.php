<?php
$loan_reference_number =   isset($info['loan_reference_number'])    &&  $info['loan_reference_number']   ?   strtoupper($info['loan_reference_number'])   :   '';
$user_id =   isset($info['user_id'])    &&  $info['user_id']   ?   strtoupper($info['user_id'])   :   '';
$loan_id = isset($info['loan_id']) ? $info['loan_id'] : '';
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
$due_date = isset($info['due_date']) && $info['due_date'] ? $info['due_date'] : '';
$account_number = isset($info['account_number']) && $info['account_number'] ? $info['account_number'] : '';

$financial_service_provider = isset($info['financial_service_provider']) && $info['financial_service_provider'] ? $info['financial_service_provider'] : '';

?>


<div class="content-wrapper">
  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-center row invoice-preview">
      <!-- Invoice -->
      <div class="col-xl-9 col-md-8 col-12 mb-md-0 mb-3">
        <div class="card invoice-preview-card">
          <div class="card-body">
            <!-- Header with Logo and Loan Details -->
            <div class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column p-sm-3 p-0">
              <div class="mb-xl-0 mb-4">
                <div class="d-flex svg-illustration mb-3 gap-2">
                  <span class="app-brand-logo demo">
                  <img src="<?= base_url('assets/img/branding/logo.png') ?>" alt="Logo" class="logo" width="50" height="50">
                  </span>
                  <div>
                    <span class="app-brand-text demo text-body fw-bold d-block ">Loan Application Receipt</span>
                    <h5 class="text-primary fw-semibold mb-1">Loan Reference #: <?= $loan_reference_number ?></h5>
                    <p class="text-muted mb-0"><?= date('F j, Y', strtotime($start_date)) ?></p>
                  </div>

                </div>
              </div>
            </div>
          </div>

          <!-- Borrower Information -->
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
          </div>

          <!-- Loan Status Section -->
          <div class="card-body">
            <div class="row p-sm-3 p-0">
              <div class="col-12">
                <h6 class="fw-bold mb-2">Loan Status</h6>
                <p class="text-muted">The current status of your loan application is:</p>
                <div class="badge <?=
                                  $loan_status === "Approved"
                                    ? 'bg-success'
                                    : ($loan_status === 'Pending' ? 'bg-warning' : 'bg-success')
                                  ?> text-white p-2 d-inline-block">
                  <?= htmlspecialchars($loan_status) ?>
                </div>

              </div>
            </div>
          </div>

          <!-- Payment Installment Breakdown -->
          <div class="table-responsive">
            <input type="hidden" value="<?= $loan_term ?>" id="paymentTerm" name="payment_term">
            <input type="hidden" value="<?= $loan_amount ?>" id="loanAmount" name="loan_amount">
            <input type="hidden" value="<?= $member_id ?>" id="memberId" name="member_id">
            <input type="hidden" value="<?= $loan_id ?>" id="loanId" name="loan_id">
            <table class="table border-top m-0">
              <thead class="table-light">
                <tr>
                  <th></th>
                  <th>Payment Term</th>
                  <th>Loan Amount</th>

                </tr>
              </thead>
              <tbody id="tableBody">
                <td></td>
                <td> <?= $loan_term ?> Months</td>
                <td> PHP <?= $loan_amount ?></td>
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
    </div>
  </div>
  <!-- Content wrapper -->
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
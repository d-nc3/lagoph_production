<!-- JavaScript -->
<?php

$billing_email =   isset($payment_details['billing_email'])    &&  $payment_details['billing_email']   ?   ($payment_details['billing_email'])   :   '';
$street_address =   isset($payment_details['street_address'])    &&  $payment_details['street_address']   ?   ($payment_details['street_address'])   :   '';
$mobile_number =   isset($payment_details['mobile_number'])    &&  $payment_details['mobile_number']   ?   ($payment_details['mobile_number'])   :   '';
$municipality =   isset($payment_details['municipality'])    &&  $payment_details['municipality']   ?   ($payment_details['municipality'])   :   '';
$province =   isset($payment_details['province'])    &&  $payment_details['province']   ?    ($payment_details['province'])   :   '';
$date = date('Y-m-d');
$user_first_name =   isset($payment_details['first_name'])    &&  $payment_details['first_name']   ?    ($payment_details['first_name'])   :   '';
$user_last_name =   isset($payment_details['last_name'])    &&  $payment_details['last_name']   ?    ($payment_details['last_name'])   :   '';

// invoice particulars w/ cashiering invoice data inner join
$invoice_id = isset($payment_details['cashiering_invoice_id']) && $payment_details['cashiering_invoice_id'] ? ($payment_details['cashiering_invoice_id']) : '';
$invoice_number = isset($payment_details['invoice_number']) && $payment_details['invoice_number'] ? strtoupper($payment_details['invoice_number']) : 'No Invoice';
$official_receipt_number = isset($payment_details['official_receipt_number']) && $payment_details['official_receipt_number'] ? strtoupper($payment_details['official_receipt_number']) : '';
$particulars = isset($payment_details['name']) && $payment_details['name'] ? strtoupper($payment_details['name']) : '';
$invoice_type = isset($payment_details['invoice_type']) && $payment_details['invoice_type'] ? ($payment_details['invoice_type']) :  '';
$date_paid = isset($payment_details['payment_date']) && $payment_details['payment_date'] ? strtoupper($payment_details['payment_date']) : '';
$status = isset($payment_details['status']) && $payment_details['status'] ? ($payment_details['status']) : '';
$processed_by = isset($payment_details['processed_by']) && $payment_details['processed_by'] ? ($payment_details['processed_by']) : '';
$user_id = isset($payment_details['user_id']) && $payment_details['user_id'] ? ($payment_details['user_id']) : '';
$unit_cost = isset($payment_details['unit_cost']) && $payment_details['unit_cost'] ? strtoupper($payment_details['unit_cost']) : '';
$amount = isset($payment_details['total_cost']) && $payment_details['total_cost'] ? strtoupper($payment_details['total_cost']) : '';
$quantity = isset($payment_details['quantity']) && $payment_details['quantity'] ? strtoupper($payment_details['quantity']) : '';
$account_number = isset($payment_details['account_number']) && $payment_details['account_number'] ? strtoupper($payment_details['account_number']) : '';
$account_name = isset($payment_details['account_name']) && $payment_details['account_name'] ? strtoupper($payment_details['account_name']) : '';
$reference_number = isset($payment_details['reference_number']) && $payment_details['reference_number'] ? strtoupper($payment_details['reference_number']) : '';
$total_payment = isset($payment_details['total_payment']) && $payment_details['total_payment'] ? strtoupper($payment_details['total_payment']) : '';
$payment_name = isset($payment_details['payment_name']) && $payment_details['payment_name'] ? ($payment_details['payment_name']) : '';
$payment_method = isset($payment_details['financial_service_provider']) && $payment_details['financial_service_provider'] ? ($payment_details['financial_service_provider']) : '';

?>

<?php $this->load->view('layout/header') ?>
<div class="layout-wrapper layout-content-navbar">
 <div class="layout-container">
  <?php $this->load->view('layout/sidenav'); ?>
  <div class="layout-page">
   <?php $this->load->view('layout/navbar'); ?>
   <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-2 mb-3"><span class="text-muted fw-light">Transactions /</span> Official Receipts</h4>

    <div class="card p-5 mx-auto" style="max-width: 600px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
     <!-- Header -->
     <div class="text-center">
      <h2 class="fw-bold mt-3 text-uppercase">LagoPH</h2>
      <i class="fas fa-check-circle text-success fa-3x mb-2"></i>
      <h5 class="mb-2">Official Receipt</h5>
      <p class="text-muted fs-7">Your payment has been successfully verified.</p>
      <div class="bg-light p-2 rounded mt-4 d-flex flex-column justify-content-center align-items-center mb-2" style="border: 1px solid #dcdcdc;">
       <strong class="mb-3 fs-6">Amount Paid:</strong>
       <h4 class="text-success"><b>₱ <?= $total_payment ?></b></h4>
      </div>
     </div>

     <!-- Receipt Info -->
     <div class="mt-3">
      <h6 class="fw-bold mb-2 fs-6">Receipt ID: <span class="text-primary"><?= $reference_number ?></span></h6>
      <p class="text-muted fs-7">Transaction Date: <?= $date_paid ?></p>
      <hr />
      <!-- Amount Section -->
      <ul class="list-unstyled fs-7">
       <li><strong class="me-2">Transaction Status:</strong><br /><span class="text-success"><?= $status ?></span></li>
       <li><strong>Payment Method:</strong><br /> Service Provider: <?= $payment_method ?> <br /> Account Name: <?= $account_name ?> <br /> Reference Number: <?= $reference_number ?></li>
       <li><strong>Invoice Number:</strong><br /> <?= $invoice_number ?></li>
      </ul>
     </div>
    </div>
    <!-- Footer (Buttons Section) -->
    <div class="mt-4 text-center">
     <button class="btn btn-primary me-2" onclick="window.print()">
      <i class="fas fa-print"></i> Print
     </button>
     <button class="btn btn-secondary" onclick="sharePaymentDetails()">
      <i class="fas fa-share"></i> Share
     </button>
    </div>
   </div>
  </div>
 </div>
</div>
</div>

<?php $this->load->view('layout/footer') ?>
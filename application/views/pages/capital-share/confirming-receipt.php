<?php

$payment_mode = isset($payment_record['payment_name']) && $payment_record['payment_name'] ? ($payment_record['payment_name']) : '';
$payment_method =  isset($payment_record['financial_service_provider']) && $payment_record['financial_service_provider'] ? ($payment_record['financial_service_provider']) : '';
$amount = isset($payment_record['total_payment']) && $payment_record['total_payment'] ? ($payment_record['total_payment']) : '';
$date = isset($payment_record['payment_date']) && $payment_record['payment_date'] ? ($payment_record['payment_date']) : '';
$reference_number = isset($payment_record['reference_number']) && $payment_record['reference_number'] ? ($payment_record['reference_number']) : '';
$account_name = isset($payment_record['account_name']) && $payment_record['account_name'] ? ($payment_record['account_name']) : '';
$status = isset($payment_record['status']) && $payment_record['status'] ? ($payment_record['status']) : '';
$invoice_number = isset($payment_record['invoice_number']) && $payment_record['invoice_number'] ? ($payment_record['invoice_number']) : '';

?>

<?php $this->load->view('layout/header') ?>

<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <?php $this->load->view('layout/sidenav'); ?>
        <div class="layout-page">
            <?php $this->load->view('layout/navbar'); ?>
            <div class="container-xxl flex-grow-1 container-p-y">
                <h4 class="py-2 mb-3"><span class="text-muted fw-light">Capital Share /</span> Contributions</h4>

                <div class="card p-5 mx-auto" style="max-width: 500px;">
                    <div class="text-center">
                        <h2 class="fw-bold mt-3">CycommPh</h2>
                        <i class="fas fa-check-circle text-success fa-3x mb-2"></i>
                        <h5 class="mb-2">Proof of Payment</h5>
                        <p class="text-muted fs-7">Your proof of payment has been successfully uploaded.</p>
                    </div>

                    <p class="mt-2 text-center fs-6">
                        You will receive an email with the status and monitoring of your transaction shortly. Please keep track of your payment status in your email.
                    </p>

                    <div class="mt-3">
                        <h6 class="fw-bold mb-2 fs-6">Transaction Details</h6>
                        <p><?= $date ?><br /> <span><?= $invoice_number ?></span></p>
                        <hr />

                        <div class="bg-light p-4 rounded mt-4 d-flex flex-column justify-content-center align-items-center mb-2">
                            <strong class="mb-3">Amount Paid:</strong>
                            <h4><b> ₱ <?= $amount ?></b></h4>
                        </div>

                        <ul class="list-unstyled fs-7">
                            <li><strong class="me-2">Transaction Status:</strong><span><?= $status ?></span></li>
                            <hr />
                            <li><strong>Payment Method</strong><br /><?= $account_name ?><br /><?= $reference_number ?><br /><?= $payment_method ?></li>
                        </ul>
                    </div>
                </div>
                   <!-- Buttons Section -->
                   <div class="mt-4 text-center">
                        <button class="btn btn-primary  me-2" onclick="window.print()">
                            <i class="fas fa-print"></i> Print
                        </button>
                        <button class="btn btn-secondary " onclick="sharePaymentDetails()">
                            <i class="fas fa-share"></i> Share
                        </button>
                    </div>
            </div>
        </div>
    </div>
</div>
</div>

<?php $this->load->view('layout/footer') ?>
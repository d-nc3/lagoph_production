<?php

$pending_filtered = array_filter($pending_payments, function ($payment) {
  return $payment['status'] === 'pending';
});

$start_date = !empty($pending_filtered)  ? (new DateTime(array_column($pending_filtered, 'due_date')[0] ?? null))->format('Y-m')  : null;
$end_date = !empty($pending_filtered)   ? (new DateTime(array_column($pending_filtered, 'due_date')[count($pending_filtered) - 1] ?? null))->format('Y-m')   : null;
$user_id = isset($subscribed_transaction['user_id']) ? $subscribed_transaction['user_id'] : NULL;

?>


<?php $this->load->view('layout/header') ?>


<div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">
    <?php $this->load->view('layout/sidenav'); ?>
    <div class="layout-page">
      <?php $this->load->view('layout/navbar'); ?>
      <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Services /</span> Payments</h4>



        <div class="container">
          <div class="card px-3">
            <form id="paymentForm" class="row g-3" onsubmit="return false">
              <div class="row g-3 align-items-start">
                <!-- Capital Share Payment Section -->
                <div class="col-lg-8 card-body border-end">
                  <h4 class="mb-2">Settle Account Dues</h4>
                  <p class="mb-10">
                    Investing in capital shares supports the growth of the organization and provides members with financial returns based on their contributions.
                  </p>
                  <div class="row">
                  <div class="col-md-6 mb-3">
                      <label class="form-label" for="transaction_name">Select Category</label>
                      <select class="form-select select2-search" id="transactionName" name="transaction_name">
                        <option value=""></option>
                        <?php foreach ($transaction_category as $val) : ?>
                          <option value="<?= $val['id'] ?>"><?= $val['transaction_name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  <div class="col-md-6 mb-3">
                      <label class="form-label" for="paymentScope">No. Of Payments</label>
                      <div class="col-md-12 mb-3">
                        <input type="number" placeholder="No. Of Payments" id="paymentNo" name="number_of_payments" class="form-control" max=12>
                      </div>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label for="totalPayment" class="form-label">Enter Amount</label>
                      <input type="number" id="totalPayment" name="total_payment" class="form-control" placeholder="₱0.00" step="0.01" min="0">
                    </div>
                   
                    <div class="col-md-6 mb-3">
                      <label class="form-label" for="paymentScope">Payment Frequency</label>
                      <select class="form-select select2-search" id="paymentFrequency" name="payment_frequency">
                        <option value=""></option>
                        <option value="1">Daily</option>
                        <option value="2">Weekly</option>
                        <option value="3">Quarterly</option>
                        <option value="3">Customized</option>
                      </select>
                    </div>
                  </div>
                  <div class="row">
                    <!-- Payment Scope -->
          

                    <input type="hidden" id="user_id" value="<?= $user_id ?>">
                    <div class="col-md-6 mb-3">
                      <label for="attachments-capital-share" class="form-label">Upload Proof of Payment/Receipt</label>
                      <input type="file" id="attachments-capital-share" name="attachments[payment_receipt]" class="form-control" accept=".jpg,.jpeg">
                    </div>
                  </div>

                  <!-- Payment Information Section -->
                  <h4 class="mt-2 mb-4">Payment Information</h4>
                  <div class="row g-3">
                    <!-- Payment Mode -->
                    <div class="col-md-6 mb-3">
                      <label class="form-label" for="paymentMode">Payment Mode</label>
                      <select class="form-select select2-search" id="paymentMode" name="payment_mode">
                        <option value=""></option>
                        <?php foreach ($payment_options as $val) : ?>
                          <option value="<?= $val['id'] ?>"><?= $val['payment_name'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>

                    <!-- Payment Method -->
                    <div class="col-md-6 mb-3">
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

                    <!-- Reference Information (conditionally shown) -->
                    <div class="col-md-6 mb-3" style="display: none;" id="refNumContainer">
                      <label for="referenceNo" class="form-label">Reference No.</label>
                      <input type="text" id="referenceNo" name="reference_number" class="form-control" placeholder="Reference No.">
                    </div>

                    <div class="col-md-6 mb-3" style="display: none;" id="accNumContainer">
                      <label for="accountNum" class="form-label">Account Number</label>
                      <input type="number" id="accountNum" name="account_number" class="form-control" placeholder="Account Number">
                    </div>

                    <div class="col-md-6 mb-3" style="display: none;" id="accNameContainer">
                      <label for="accountName" class="form-label">Account Name</label>
                      <input type="text" id="accountName" name="account_name" class="form-control" placeholder="Account Name">
                    </div>
                  </div>
                </div>
            </form>
            <!-- Order Summary Section -->
            <div class="col-lg-4 card-body">
              <h4 class="mb-2">Payment Summary</h4>
              <div class="bg-lighter p-4 rounded mt-4">
                <p>A simple start for everyone.</p>
              </div>
              <div class="mt-3">
                <div class="d-flex justify-content-between align-items-center">
                  <p class="mb-0">Subtotal</p>
                  <h6 class="mb-0">$85.99</h6>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-3">
                  <p class="mb-0">Tax</p>
                  <h6 class="mb-0">$4.99</h6>
                </div>
                <hr>
                <div class="d-flex justify-content-between align-items-center mt-3 pb-1">
                  <p class="mb-0">Total</p>
                  <h6 class="mb-0">$90.98</h6>
                </div>
                <div class="d-grid mt-3">
                  <button type="submit" class="btn btn-success save">Proceed with Payment</button>
                </div>
                <p class="mt-4 pt-2">
                  By continuing, you accept our Terms of Services and Privacy Policy. Payments are non-refundable.
                </p>
              </div>
            </div>
          </div>

        </div>


      </div>

    </div>
  </div>

</div>
</div>

<?php $this->load->view('layout/footer') ?>
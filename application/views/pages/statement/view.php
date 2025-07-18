<!-- JavaScript -->
<?php
$billing_email =   isset($billing_address['billing_email'])    &&  $billing_address['billing_email']   ?   ($billing_address['billing_email'])   :   '';
$street_address =   isset($billing_address['street_address'])    &&  $billing_address['street_address']   ?   ($billing_address['street_address'])   :   '';
$mobile_number =   isset($billing_address['mobile_number'])    &&  $billing_address['mobile_number']   ?   ($billing_address['mobile_number'])   :   '';
$municipality =   isset($billing_address['municipality'])    &&  $billing_address['municipality']   ?   ($billing_address['municipality'])   :   '';
$province =   isset($billing_address['province'])    &&  $billing_address['province']   ?    ($billing_address['province'])   :   '';
$date = date('Y-m-d');

$user_first_name =   isset($invoice_particulars['first_name'])    &&  $invoice_particulars['first_name']   ?    ($invoice_particulars['first_name'])   :   '';
$user_last_name =   isset($invoice_particulars['last_name'])    &&  $invoice_particulars['last_name']   ?    ($invoice_particulars['last_name'])   :   '';

// invoice particulars w/ cashiering invoice data inner join
$invoice_number = isset($invoice_particulars['invoice_number']) && $invoice_particulars['invoice_number'] ? strtoupper($invoice_particulars['invoice_number']) : '';
$invoice_id = isset($invoice_particulars['cashiering_invoice_id']) && $invoice_particulars['cashiering_invoice_id'] ? strtoupper($invoice_particulars['cashiering_invoice_id']) : '';
$particulars = isset($invoice_particulars['name']) && $invoice_particulars['name'] ? strtoupper($invoice_particulars['name']) : '';
$invoice_type = isset($invoice_particulars['transaction_name']) && $invoice_particulars['transaction_name'] ? ($invoice_particulars['transaction_name']) :  '';
$date_issued = isset($invoice_particulars['date_issued']) && $invoice_particulars['date_issued'] ? strtoupper($invoice_particulars['date_issued']) : '';
$status = isset($invoice_particulars['status']) && $invoice_particulars['status'] ? ($invoice_particulars['status']) : '';
$unit_cost = isset($invoice_particulars['unit_cost']) && $invoice_particulars['unit_cost'] ? strtoupper($invoice_particulars['unit_cost']) : '';
$total_cost = isset($invoice_particulars['total_cost']) && $invoice_particulars['total_cost'] ? strtoupper($invoice_particulars['total_cost']) : '';
$quantity = isset($invoice_particulars['quantity']) && $invoice_particulars['quantity'] ? strtoupper($invoice_particulars['quantity']) : '';
$payment_proof = isset($receipt['payment_proof']) && $receipt['payment_proof'] ? ($receipt['payment_proof']) : NULL;


?>
<?php $this->load->view('layout/header'); ?>

<div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">
    <?php $this->load->view('layout/sidenav'); ?>
    <div class="layout-page">
      <?php $this->load->view('layout/navbar'); ?>
      <!-- Content wrapper -->
      <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
          <span class="text-muted fw-light">Invoice /</span> Billing Summary
        </h4>
        <div class="row invoice-preview">
          <!-- Invoice -->
          <div class="col-xl-9 col-md-8 col-12 mb-md-0 mb-4">
            <div class="card border rounded">
              <div class="card-body">
                <div class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column p-4">
                  <div class="mb-xl-0 mb-4">
                    <h4 class="mb-2">CycommPh</h4>
                    <p class="mb-1">Office 49, Don A. Roces Ave.</p>
                    <p class="mb-1">Brgy. Paligsahan, Quezon City</p>
                    <p class="mb-0">(02) 70919513</p>
                  </div>
                  <div class="justify">
                    <span class="fw-medium d-block">Invoice: <?= $invoice_number ?></span>
                    <span class="fw-medium d-block">Date Issued: <?= $date_issued ?></span>
                    <span class="fw-medium">Status: <?= $status ?></span>
                  </div>
                </div>

                <hr class="my-4">

                <div class="d-flex flex-column flex-md-row p-4">
                  <div class="w-50">
                    <h5 class="mb-2" style="font-size: 0.9rem;">Invoice To</h5>

                    <p class="mb-1 text-muted" style="font-size: 0.9rem;"><?= $user_first_name ?> <?= $user_last_name ?> </p>
                  </div>
                  <div class="w-50">
                    <h5 class="mb-2" style="font-size: 0.9rem;">Billing Address</h5>
                    <p class="mb-1 text-muted" style="font-size: 0.9rem;">Address: <?= $street_address ?></p>
                    <p class="mb-1 text-muted" style="font-size: 0.9rem;">Email: <?= $billing_email ?></p>
                    <p class="mb-1 text-muted" style="font-size: 0.9rem;">Province: <?= $province ?></p>
                    <p class="mb-0 text-muted" style="font-size: 0.9rem;">Municipality: <?= $municipality ?></p>
                  </div>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th class="text-center">Quantity</th>
                      <th class="text-center">Unit</th>
                      <th class="text-center">Particular</th>
                      <th class="text-center">Unit Price</th>
                      <th class="text-center">Amount</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if ($invoice_type === 'membership_fee'): ?>
                      <tr>
                        <td class="text-center"><?= $quantity ?></td>
                        <td class="text-center">Unit</td>
                        <td class="text-center"><?= $particulars ?></td>
                        <td class="text-center">₱<?= $unit_cost ?></td>
                        <td class="text-center">₱<?= $total_cost ?></td>
                      </tr>
                    <?php elseif ($invoice_type === 'capital_contribution'): ?>
                      <tr>
                        <td class="text-center"><?= $quantity ?></td>
                        <td class="text-center">Unit</td>
                        <td class="text-center"><?= $particulars ?></td>
                        <td class="text-center">₱<?= $unit_cost ?></td>
                        <td class="text-center">₱<?= $total_cost ?></td>
                      </tr>
                    <?php endif; ?>
                    <tr>
                      <td colspan="3" class="align-top px-4 py-5">
                        <p class="mb-2">
                          <span class="me-1 fw-medium">Issued By:</span>
                          <hr style="width: 18em; border: 0.5px solid #000; margin: 20px 0 0 0;">
                          <span>Cashier (printed name over signature)</span>
                        </p>
                      </td>
                      <td class="align-top px-4 py-5">
                        <p class="mb-2">Subtotal:</p>
                        <p class="mb-2">Discount:</p>
                        <p class="mb-2">Tax:</p>
                        <p class="mb-0">Total:</p>
                      </td>
                      <td class="align-top px-4 py-5">
                        <p class="fw-medium mb-2">₱<?= $total_cost ?></p>
                        <p class="fw-medium mb-2">₱00.00</p>
                        <p class="fw-medium mb-2">₱00.00</p>
                        <p class="fw-medium mb-0">₱<?= $total_cost ?></p>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- Invoice Actions-->
          <div class="col-xl-3 col-md-4 col-12">
            <div class="card border rounded">
              <div class="card-body">
                <?php if ($status === 'payment-initiated'): ?>
                  <div class="d-grid mb-3">
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#invoiceActionsModal">Access Payment Proof</button>
                  </div>
                <?php elseif ($status === 'completed'): ?>
                  <div class="d-flex my-3">
                    <div class="alert alert-success w-100 me-3" role="alert">
                      Transaction Successful! Your transaction ID is <strong>#123456</strong>.
                    </div>
                  </div>
                  <h5 class="card-title">Transaction Details</h5>
                  <div class="card-body">
                    <p><strong>Transaction ID:</strong> </p>
                    <p><strong>Date:</strong> September 5, 2024</p>
                    <p><strong>Amount:</strong> $100.00</p>
                    <p><strong>Payment Method:</strong> Credit Card</p>
                    <div class="my-2">
                      <button class="btn btn-primary w-100 mb-3" onclick="copyTransactionDetails()">Copy Transaction Details</button>
                      <button class="btn btn-label-secondary w-100" onclick="downloadReceipt()">Download Receipt</button>
                    </div>
                    <div class="my-2">
                      <p>This transaction has been added to your <a href="#transaction-history">Transaction History</a>.</p>
                    </div>
                  <?php else: ?>
                    <div class="d-grid mb-3">
                      <button class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#invoiceActionsOffcanvas" aria-controls="invoiceActionsOffcanvas">Proceed to Payment</button>
                    </div>
                  <?php endif; ?>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="offcanvas offcanvas-end" tabindex="-1" id="invoiceActionsOffcanvas" aria-labelledby="invoiceActionsOffcanvasLabel">
        <div class="offcanvas-header">
          <h5 id="invoiceActionsOffcanvasLabel">Invoice Actions</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <div class="mb-4">
            <div class="card border-0 shadow-sm">
              <div class="card-body p-4">
                <ul class="list-unstyled">
                  <li class="mb-2">
                    Use the details provided in the invoice and upload a copy of your receipt to confirm your payment.
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <form id="payment-form">
            <div class="mb-3 col-12 mb-0">
              <input type="hidden" name="invoice_id" value="<?= $invoice_id?>">
              <div class="mb-3"  >
                <label for="paymentMethod" class="form-label">Payment  options</label>
                <select class="form-select select2-search" id="paymentMode" name="payment_mode" aria-label="Select Payment Option">
                  <option value="" ></option>
                  <?php foreach ($payment_options as $key => $val) : ?>
                    <option value="<?= $val['id'] ?>"><?= $val['payment_name'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <!-- Financial Institution Dropdown -->
              <div class="mb-3 o" style="display: none;" id="financialContainer"  >
                <label for="paymentMethod"   class="form-label">Financial Institution</label>
                <select class="form-select select2-search" id="paymentMethod" name="payment_method" aria-label="Select Financial Institution" >
                  <option value=""  ></option>               
                    <?php foreach ($payment_method as $method) : ?>
                        <!-- Add a data attribute to link methods with a payment mode ID -->
                        <option value="<?= $method['id'] ?>" data-mode="<?= $method['payment_option_id'] ?>">
                            <?= $method['financial_service_provider'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                </select>
              </div>
              <div class="mb-3  form-spacing" style="display: none;" id="accNameContainer">
                <label for="account">Account Name</label>
                <input type="text" id="accountName" name="account_name" class="form-control" placeholder="Account Name">
              </div>
              <div class="mb-3  form-spacing" style="display: none;" id="accNumContainer">
                <label for="account">Account Number</label>
                <input type="text" id="accountNum" name="account_number" class="form-control" placeholder="Account">
              </div>
              <div class="mb-3 form-spacing" style="display: none;" id="refNumContainer">
                <label for="reference_no">Reference No.</label>
                <input type="text" id="referenceNo" name="reference_number" class="form-control" placeholder="Reference No.">
              </div>
              <div class="mb-3 form-spacing">
                <label for="total_payment">Enter Amount</label>
                <input type="text" id="totalPayment" name="total_payment" class="form-control" placeholder="₱0.00">
              </div>
              <p>Payment Date</p>
              <input type="date" id="payment-date" name="payment_date" class="form-control" placeholder="Select payment date">
            </div>
            <div class="mb-3 col-12 mb-0">
              <p>Upload Proof of payment/Receipt</p>
              <input type="file" id="attachments-membership-receipt" name="attachments[membership_receipt]" class="form-control" accept=".jpg,.jpeg">
            </div>
            <div class="mb-3 col-12 mb-0">
              <p>Details</p>
              <textarea id="receipt-details" name="receipt_details" class="form-control" rows="4" placeholder="Enter additional details here"></textarea>
            </div>
          </form>
          <div class="d-grid mb-3">
            <button class="btn btn-primary" id="submitPayment">Submit</button>
          </div>

          <div class="d-grid">
            <button class="btn btn-outline-danger">Cancel</button>
          </div>
        </div>
      </div>
      <!-- /Offcanvas -->

      <!-- Modal -->
      <div class="modal fade" id="invoiceActionsModal" tabindex="-1" aria-labelledby="invoiceActionsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg"> <!-- Use modal-lg for a larger view if necessary -->
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="invoiceActionsModalLabel">Invoice Actions</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center"> <!-- Center content within the modal body -->
              <div class="card">
                <div class="card-body">
                  <?php if ($payment_proof): ?>
                    <img src="<?= base_url($payment_proof) ?>" alt="Payment Proof" class="img-fluid rounded" style="max-width: 100%; height: auto; border: 1px solid #ddd; padding: 5px;" onerror="this.onerror=null; this.src='path/to/default-image.jpg';">
                  <?php else: ?>
                    <p class="text-muted">No payment proof found.</p>
                  <?php endif; ?>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

            </div>
          </div>
        </div>
      </div>

      <!--/ Modal -->
    </div>
  </div>

  <?php $this->load->view('layout/footer'); ?>
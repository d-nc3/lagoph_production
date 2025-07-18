<!-- JavaScript -->
<?php
$billing_email =   isset($billing_address['billing_email'])    &&  $billing_address['billing_email']   ?   ($billing_address['billing_email'])   :   '';
$street_address =   isset($billing_address['street_address'])    &&  $billing_address['street_address']   ?   ($billing_address['street_address'])   :   '';
$mobile_number =   isset($billing_address['mobile_number'])    &&  $billing_address['mobile_number']   ?   ($billing_address['mobile_number'])   :   '';
$municipality =   isset($billing_address['municipality'])    &&  $billing_address['municipality']   ?   ($billing_address['municipality'])   :   '';
$province =   isset($billing_address['province'])    &&  $billing_address['province']   ?    ($billing_address['province'])   :   '';
$date = date('Y-m-d'); // Format: Year-Month-Day

//Invoice Details: 
$invoice_number = isset($invoice_details['invoice_number']) && $invoice_details['invoice_number'] ? strtoupper($invoice_details['invoice_number']) : '';
$particulars = isset($invoice_details['name']) && $invoice_details['name'] ? strtoupper($invoice_details['name']) : '';
$invoice_type = isset($invoice_details['invoice_type']) && $invoice_details['invoice_type'] ? ($invoice_details['invoice_type']) :  '';
$date_issued = isset($invoice_details['date_issued']) && $invoice_details['date_issued'] ? strtoupper($invoice_details['date_issued']) : '';
$status = isset($payment_records['payment_status']) && $payment_records['payment_status'] ? ($payment_records['payment_status']) : '';
$member_reference = isset($members['reference_number']) && $members['reference_number'] ? ($members['reference_number']) : '';


?>

<?php $this->load->view('layout/header'); ?>

<div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">
    <?php $this->load->view('layout/sidenav'); ?>
    <div class="layout-page">
      <?php $this->load->view('layout/navbar'); ?>
      <!-- Content wrapper -->
      <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Loan /</span> Application</h4>

        <div id="wizard-checkout" class="bs-stepper wizard-icons wizard-icons-example mb-5">
          <div class="bs-stepper-header m-auto border-0 py-4">
            <div class="step" data-target="#checkout-cart">
              <button type="button" class="step-trigger">
                <span class="bs-stepper-icon">
                  <svg viewBox="0 0 58 54">
                    <use xlink:href="./assets/svg/icons/wizard-checkout-cart.svg#wizardCart"></use>
                  </svg>
                </span>
                <span class="bs-stepper-label">Loan Information </span>
              </button>
            </div>
            <div class="line">
              <i class="bx bx-chevron-right"></i>
            </div>
            <div class="step" data-target="#checkout-confirmation">
              <button type="button" class="step-trigger">
                <span class="bs-stepper-icon">
                  <svg viewBox="0 0 58 54">
                    <use xlink:href="./assets/svg/icons/wizard-checkout-confirmation.svg#wizardConfirm"></use>
                  </svg>
                </span>
                <span class="bs-stepper-label">Confirmation</span>
              </button>
            </div>
          </div>
          <div class="bs-stepper-content border-top">
            <div class="bs-stepper-content border-top">
              <form id="wizard-checkout-form" onSubmit="return false">
                <!-- Cart -->
                <div id="checkout-cart" class="content">
                  <div class="row">

                    <div class="col-xl-8 mb-3 mb-xl-0">
                      <ul class="list-group mb-3">
                        <li class="list-group-item p-4 shadow-sm rounded-3">
                          <div class="d-flex gap-3">
                            <div class="flex-grow-1">

                              <label for="select-account" class="form-label fw-bold">Credit Available</label>
                              <div class="row">
                                <div class="d-flex flex-column col-md-8">

                                  <div class="col-12">
                                    <div class="d-flex align-items-center btn btn-outline-secondary border-1 rounded-4 w-50 py-4">
                                      <!-- First Column: Icon -->
                                      <div class="me-3">
                                        <i class='bx bxs-credit-card' style="font-size: 2rem; color: #6c757d;"></i>
                                      </div>
                                      <!-- Second Column: Information -->
                                      <div style="text-align: left;">
                                        <div class="fw-bold">LOAN CREDIT</div>
                                        <div><?= $member_reference ?></div>
                                        <div class="fw-bold">PHP 10,678.80</div>
                                      </div>
                                    </div>
                                  </div>

                                  <hr />

                                  <div class="row">
                                    <div class="d-flex flex-column col-md-8">
                                      <div class="col-12">
                                        <label for="select-account" class="form-label fw-bold">Select Disbursement Account</label>
                                        <!-- Button styled as a modal trigger -->
                                        <a href="#" class="d-block text-decoration-none btn btn-outline-secondary border-1 w-70 py-5 text-center" role="button" data-bs-toggle="modal" data-bs-target="#accountModal">
                                          Select Accounts <i class='bx bx-plus-circle'></i>
                                        </a>
                                        <form>
                                        
                                          <div class="row g-3 mt-3">
                                            <div class="col-lg-6">
                                              <label class="form-label fw-bold" for="loanAmount">Loan Amount*</label>
                                              <input type="number" name="loan_amount" id="loanAmount" class="form-control" placeholder="10,000" />
                                              <input type="text" id="disbursmentAccount" name="disbursment_account" class="form-control" value="" />
                                            </div>
                                        
                                            <div class="col-md-6">
                                              <div class="mb-3">
                                                <label for="paymentSchedule" class="form-label fw-bold">Payment Schedule*</label>
                                                <select id="paymentSchedule" name="payment_schedule" class="form-control" aria-label="Payment Schedule">
                                                  <option>Select Option</option>
                                                  <option value="3">3 months</option>
                                                  <option value="6">6 months</option>
                                                  <option value="9">9 months</option>
                                                  <option value="12">12 months</option>
                                                </select>
                                              </div>
                                            </div>
                                          </div>
                                        </form>

                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </li>
                      </ul>
                   

                    <!-- Loan function -->
                    <div class="col-xl-4">
                      <div class="border rounded p-4 mb-3 pb-3">
                        <!-- Payment schedule -->
                        <h6 class="fw-bold mt-2">Payment Schedules</h6>
                        <span class="fw-light" style="font-size: 12px"> *Due dates will be sent upon loan approval</span>
                        <div class="container mt-4">
                          <div class="accordion" id="tableAccordion">
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed d-flex justify-content-between align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                  <span>Monthly Repayment</span>
                                  <span id="monthlyPayment" class="ms-auto">PHP </span>
                                </button>
                              </h2>
                              <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#tableAccordion">
                                <div class="accordion-body">
                                  <div id="tableContainer" class="mt-3">
                                    <table id="dataTable" class="table table-bordered">
                                      <thead>
                                        <tr>
                                          <th>Date Due</th>
                                          <th>Amount Due</th>
                                        </tr>
                                      </thead>
                                      <tbody id="tableBody">
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <hr />
                          <h6 class="fw-bold">Price Details</h6>
                          <dl class="row mb-0">
                            <dt class="col-6 fw-light">Loan Total</dt>
                            <dd class="col-6 text-end" id="loanTotal">PHP</dd>
                            <dt class="col-6 fw-light" style="white-space: nowrap;">
                              Interest Amount <span class="text-muted" style="font-size: 12px;">(2.25%)</span>
                            </dt>
                            <dd class="col-6 text-end" id="totalInterest">PHP </dd>
                            <dt class="col-6 fw-light" style="white-space: nowrap;">
                              Service Charge <span class="text-muted" style="font-size: 12px;">(2.5%)</span>
                            </dt>
                            <dd class="col-6 text-end" id="serviceCharge">PHP </dd>
                          </dl>
                          <hr class="mx-n4" />
                          <dl class="row mb-0">
                            <dt class="col-6">Total</dt>
                            <dd class="col-6 fw-medium text-end mb-0" id="totalAmount"></dd>
                          </dl>
                        </div>
                        <div class="d-grid mt-4">
                          <button class="btn btn-primary btn-next">Next</button>
                        </div>

                      </div>
                    </div>

                  </div>
                </div>
                <div id="checkout-confirmation" class="content">
                  <div class="row mb-3">
                    <div class="col-12 col-lg-8 mx-auto text-center mb-3">
                      <h4 class="mt-2">Thank You! 😇</h4>
                      <p>Your order <a href="javascript:void(0)">#1536548131</a> has been placed!</p>
                      <p>
                        We sent an email to <a href="mailto:john.doe@example.com">john.doe@example.com</a> with your order
                        confirmation and receipt. If the email hasn't arrived within two minutes, please check your spam
                        folder to see if the email was routed there.
                      </p>
                      <p>
                        <span class="fw-medium"><i class="bx bx-time-five me-1"></i> Time placed:&nbsp;</span> 25/05/2020
                        13:35pm
                      </p>
                    </div>
                    <!-- Confirmation details -->
                    <div class="col-12">
                      <ul class="list-group list-group-horizontal-md">
                        <li class="list-group-item flex-fill p-4 text-heading">
                          <h6 class="d-flex align-items-center gap-1"><i class="bx bx-map"></i> Shipping</h6>
                          <address class="mb-0">
                            John Doe <br />
                            4135 Parkway Street,<br />
                            Los Angeles, CA 90017,<br />
                            USA
                          </address>
                          <p class="mb-0 mt-3">+123456789</p>
                        </li>
                        <li class="list-group-item flex-fill p-4 text-heading">
                          <h6 class="d-flex align-items-center gap-1">
                            <i class="bx bx-credit-card"></i> Billing Address
                          </h6>
                          <address class="mb-0">
                            John Doe <br />
                            4135 Parkway Street,<br />
                            Los Angeles, CA 90017,<br />
                            USA
                          </address>
                          <p class="mb-0 mt-3">+123456789</p>
                        </li>
                        <li class="list-group-item flex-fill p-4 text-heading">
                          <h6 class="d-flex align-items-center gap-1"><i class="bx bxs-ship"></i> Shipping Method</h6>
                          <p class="fw-medium mb-3">Preferred Method:</p>
                          Standard Delivery<br />
                          (Normally 3-4 business days)
                        </li>
                      </ul>
                    </div>
                  </div>

                  <div class="row">
                    <!-- Confirmation items -->
                    <div class="col-xl-9 mb-3 mb-xl-0">
                      <ul class="list-group">
                        <li class="list-group-item p-4">
                          <div class="d-flex gap-3">
                            <div class="flex-shrink-0">
                              <img src="../../assets/img/products/1.png" alt="google home" class="w-px-75" />
                            </div>
                            <div class="flex-grow-1">
                              <div class="row">
                                <div class="col-md-8">
                                  <a href="javascript:void(0)" class="text-body">
                                    <p>Google - Google Home - White</p>
                                  </a>
                                  <div class="text-muted mb-1 d-flex flex-wrap">
                                    <span class="me-1">Sold by:</span>
                                    <a href="javascript:void(0)" class="me-3">Apple</a>
                                    <span class="badge bg-label-success">In Stock</span>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="text-md-end">
                                    <div class="my-2 my-lg-4">
                                      <span class="text-primary">$299/</span><s class="text-muted">$359</s>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </li>
                        <li class="list-group-item p-4">
                          <div class="d-flex gap-3">
                            <div class="flex-shrink-0">
                              <img src="../../assets/img/products/2.png" alt="google home" class="w-px-75" />
                            </div>
                            <div class="flex-grow-1">
                              <div class="row">
                                <div class="col-md-8">
                                  <a href="javascript:void(0)" class="text-body">
                                    <p>Apple iPhone 11 (64GB, Black)</p>
                                  </a>
                                  <div class="text-muted mb-1 d-flex flex-wrap">
                                    <span class="me-1">Sold by:</span>
                                    <a href="javascript:void(0)" class="me-3">Apple</a>
                                    <span class="badge bg-label-success">In Stock</span>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="text-md-end">
                                    <div class="my-2 my-lg-4">
                                      <span class="text-primary">$299/</span><s class="text-muted">$359</s>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </li>
                      </ul>
                    </div>
                    <!-- Confirmation total -->
                    <div class="col-xl-3">
                      <div class="border rounded p-4 pb-3">
                        <!-- Price Details -->
                        <h6>Price Details</h6>
                        <dl class="row mb-0">
                          <dt class="col-6 fw-normal">Order Total</dt>
                          <dd class="col-6 text-end">$1198.00</dd>

                          <dt class="col-sm-6 fw-normal">Delivery Charges</dt>
                          <dd class="col-sm-6 text-end">
                            <s class="text-muted">$5.00</s> <span class="badge bg-label-success ms-1">Free</span>
                          </dd>
                        </dl>
                        <hr class="mx-n4" />
                        <dl class="row mb-0">
                          <dt class="col-6">Total</dt>
                          <dd class="col-6 fw-medium text-end mb-0">$1198.00</dd>
                        </dl>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
        </div>
      </div>
    </div>

    <div class="content-backdrop fade"></div>
    <!-- Modal for Disbursment Account -->
    <div class="modal fade" id="accountModal" tabindex="-1" aria-labelledby="accountModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title fw-bold" id="accountModalLabel">Select Disbursement Account</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <!-- "New Recipient" Button -->
            <div class="d-flex justify-content-between align-items-center mb-3">
              <h6 class="mb-0">Your Accounts</h6>
              <button class="btn btn-primary" id="newRecipientButton" onclick="triggerNewRecipient()">
                New Account <i class="bx bx-plus-circle"></i>
              </button>
            </div>

            <!-- List of Accounts -->
            <ul class="list-group" id="accountList">
              <!-- Example of a clickable list item with an image -->
              <li class="list-group-item d-flex justify-content-between align-items-center account-item" data-account-id="1">
                <div class="d-flex align-items-center">
                  <!-- Account Image -->
                  <img src="assets/img/icons/brands/BDO-logo.png" alt="Account 1" class="rounded-circle me-3" style="width: 40px; height: 40px;">
                  <div>
                    <span class="fw-bold">Account 1</span><br>
                    <small>Bank: XYZ Bank</small>
                  </div>
                </div>
                <button class="btn btn-outline-secondary btn-sm">Select</button>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center account-item" data-account-id="2">
                <div class="d-flex align-items-center">
                  <!-- Account Image -->
                  <img src="assets/img/icons/brands/BDO-logo.png" alt="Account 2" class="rounded-circle me-3" style="width: 40px; height: 40px;">
                  <div>
                    <span class="fw-bold">Account 2</span><br>
                    <small>Bank: ABC Bank</small>
                  </div>
                </div>
                <button class="btn btn-outline-secondary btn-sm">Select</button>
              </li>
              <!-- Add more accounts here -->
            </ul>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal for Disbursment Account -->

  </div>
  <!--/ Content wrapper -->
</div>
<?php $this->load->view('layout/footer'); ?>
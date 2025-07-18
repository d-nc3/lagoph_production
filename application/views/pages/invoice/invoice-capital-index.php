<!-- JavaScript -->
<?php
$billing_email = isset($billing_address['billing_email']) && $billing_address['billing_email'] ? ($billing_address['billing_email']) : '';
$street_address = isset($billing_address['street_address']) && $billing_address['street_address'] ? ($billing_address['street_address']) : '';
$mobile_number = isset($billing_address['mobile_number']) && $billing_address['mobile_number'] ? ($billing_address['mobile_number']) : '';
$municipality = isset($billing_address['municipality']) && $billing_address['municipality'] ? ($billing_address['municipality']) : '';
$province = isset($billing_address['province']) && $billing_address['province'] ? ($billing_address['province']) : '';
$date = date('Y-m-d'); // Format: Year-Month-Day

//Invoice Details: 
$invoice_number = isset($invoice_details['invoice_number']) && $invoice_details['invoice_number'] ? strtoupper($invoice_details['invoice_number']) : '';
$particulars = isset($invoice_details['name']) && $invoice_details['name'] ? strtoupper($invoice_details['name']) : '';
$invoice_type = isset($invoice_details['invoice_type']) && $invoice_details['invoice_type'] ? ($invoice_details['invoice_type']) : '';
$date_issued = isset($invoice_details['date_issued']) && $invoice_details['date_issued'] ? strtoupper($invoice_details['date_issued']) : '';
$status = isset($payment_records['payment_status']) && $payment_records['payment_status'] ? ($payment_records['payment_status']) : '';


?>

<?php $this->load->view('layout/header'); ?>

<div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">
    <?php $this->load->view('layout/sidenav'); ?>
    <div class="layout-page">
      <?php $this->load->view('layout/navbar'); ?>
      <!-- Content wrapper -->
      <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Membership /</span> Capital Share subscription plan</h4>

        <!-- Quotation checkout -->
        <div id="quotation-checkout" class="bs-stepper wizard-icons wizard-icons-example mb-5">
          <div class="bs-stepper-header m-auto border-0 py-4">
            <div class="step" data-target="#quotation-details">
              <button type="button" class="step-trigger">
                <span class="bs-stepper-circle">
                  <i class="bx bx-user"></i>
                </span>
                <span class="bs-stepper-label">
                  <span class="bs-stepper-title">Subscription Details</span>
                  <span class="bs-stepper-subtitle">Plot your initial Subscription Plan</span>
                </span>
              </button>
            </div>
            <div class="line">
              <i class="bx bx-chevron-right"></i>
            </div>
            <div class="step" data-target="#quotation-payment">
              <button type="button" class="step-trigger">
                <span class="bs-stepper-circle">
                  <i class="bx bx-file"></i>
                </span>
                <span class="bs-stepper-label">
                  <span class="bs-stepper-title">Subscription Form</span>
                  <span class="bs-stepper-subtitle">Your subscription form</span>
                </span>
              </button>
            </div>


          </div>

          <div class="bs-stepper-content border-top">
            <form id="quotation-checkout-form" onSubmit="return false">
              <!-- Quotation Details Section -->
              <div id="quotation-details" class="content">
                <div class="row">
                  <!-- Capital Share Subscription Plan -->
                  <div class="col-xl-8 mb-3 mb-xl-0">
                    <h5>Capital Share Subscription Plan</h5>
                    <div class="card invoice-preview-card">
                      <div class="card-body">
                        <div class="row border rounded p-3">
                          <!-- Amount per Share Input -->
                          <input type="number" id="totalContribution" name="subscribed_contribution" hidden readOnly />
                          <div class="col-md-2 mb-3">
                            <label class="form-label" for="shareAmount">Amount Per Share</label>
                            <input type="number" id="shareAmount" name="share_amount" class="form-control"
                              placeholder="1,000" min="1000" value=1000 readonly />
                          </div>
                          <!-- Unit Display -->
                          <div class="col-md-2 mb-3">
                            <p class="mb-2">Unit</p>
                            <p class="mb-0">Pax</p>
                          </div>
                          <!-- Particular Display -->
                          <div class="col-md-3 mb-3">
                            <p class="mb-2">Particular</p>
                            <p class="mb-0">Initial Capital Contribution</p>
                          </div>
                          <!-- Number of Shares Input -->
                          <div class="col-md-2 mb-3">
                            <label class="form-label" for="shareFrequency">No. Of Shares</label>
                            <input type="number" id="shareFrequency" name="share_frequency" class="form-control"
                              placeholder="10" min="10" />
                          </div>

                          <!-- Initial Contribution Input -->
                          <div class="col-md-3 mb-3">
                            <label class="form-label" for="contributionAmount">Initial Contribution</label>
                            <input type="number" id="contributionAmount" name="contribution_amount" class="form-control"
                              placeholder="1,000" />
                          </div>

                        </div>
                        <!-- Summary of Contributions -->
                        <div class="mt-2">
                          <hr class="my-4" />
                          <span class="h4 text-capitalize">Summary of Contributions</span>
                          <div id="tableContainer" class="mt-3">
                            <table id="dataTable" class="table table-bordered">
                              <thead>
                                <tr>
                                  <th>Amount per Share</th>
                                  <th>Number of Shares</th>
                                  <th>Outstanding Balance</th>
                                </tr>
                              </thead>
                              <tbody id="tableBody">
                                <!-- Dynamic table content -->
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Capital Share Subscription Form -->
                  <div class="col-xl-4">
                    <div class="border rounded p-4 mb-3">
                      <h6>Capital Share Subscription Form</h6>
                      <button type="button" class="btn btn-primary w-100 mb-2" data-bs-toggle="modal"
                        data-bs-target="#modal-terms">Payment Instructions</button>
                      <div class="bg-lighter rounded p-3 mt-3">
                        <p class="fw-medium mb-2">Want to be a member?</p>
                        <p class="mb-2">Follow the membership instructions and fill out the information sheet</p>
                        <a href="javascript:void(0)" class="fw-medium">Information Sheet</a>
                      </div>
                      <hr class="my-4" />
                      <!-- Contribution Details -->
                      <h6>Contribution Details</h6>
                      <dl class="row">
                        <dt class="col-6 fw-normal">Total Contribution</dt>
                        <dd class="col-6 text-end" id="total_capital_contribution">0</dd>
                        <dt class="col-6 fw-normal">Balance</dt>
                        <dd class="col-6 text-end" id="balance">0.00</dd>
                      </dl>
                      <hr class="my-4" />
                      <dl class="row">
                        <dt class="col-6">Total</dt>
                        <dd class="col-6 fw-medium text-end mb-0" id="total">0.00</dd>
                      </dl>
                    </div>
                  </div>
                </div>
                <!-- Navigation Buttons -->
                <div class="row mt-3">
                  <div class="col-12 d-flex justify-content-between">
                    <button class="btn btn-primary btn-prev">
                      <i class="bx bx-chevron-left bx-sm"></i>
                      <span class="d-none d-sm-inline">Previous</span>
                    </button>
                    <button class="btn btn-primary btn-next">
                      <span class="d-none d-sm-inline">Next</span>
                      <i class="bx bx-chevron-right bx-sm"></i>
                    </button>
                  </div>
                </div>
              </div>
              <div id="quotation-payment" class="content">
                <div class="row">
                  <!-- Payment Left Section -->
                  <div class="col-xl-8 col-xxl-9 mb-3 mb-xl-0">
                    <div class="col app-email-view flex-grow-0 bg-body" id="app-email-view">
                      <div class="app-email-view-header p-3 py-md-3 py-2 rounded-0">
                        <!-- Message View: Content -->
                        <div class="app-email-view-content py-4">
                          <div class="card email-card-prev mx-sm-4 mx-3 border">
                            <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                              <div class="d-flex align-items-center mb-sm-0 mb-3">
                                <div class="flex-grow-1 ms-1">
                                  <!-- Subscription Agreement Header -->
                                  <h6 class="m-0">Subscription Agreement</h6>
                                  <small class="text-muted">Subscription Agreement</small>
                                </div>
                              </div>
                            </div>
                            <!-- Subscription Agreement Body -->
                            <div class="card-body">
                              <p>
                                In connection with my membership to the Cyber-Community Philippines (CyPh) Credit
                                Cooperative,
                                I hereby subscribe <strong>Ten (10) Shares valued at Two Thousand Pesos (Php 2,000.00)
                                  per share,
                                  which is equivalent to Ten Thousand Pesos (Php10,000.00)</strong>, on the following
                                terms and conditions:
                              </p>
                              <p class="ms-4 text-justify-custom">
                                1. That I shall pay the <strong>initial amount of at least Two Thousand Pesos (Php
                                  2,000.00)</strong> upon subscribing,
                                and the balance to be paid in installment for a period not to exceed <strong>twenty-four
                                  (24) months</strong>.
                                I acknowledge that the unpaid balance of my Subscribed Capital is my liability to the
                                Cooperative.
                              </p>
                              <p class="ms-4 text-justify-custom">
                                2. That I could guarantee or sell a portion of my Share Capital to any member with the
                                prior approval of the Cooperative.
                              </p>
                              <p class="ms-4 text-justify-custom">
                                3. That I shall contribute to the Share Capital a percentage of the annual interest on
                                capital and patronage refund due me,
                                as may be determined and required by the Cooperative.
                              </p>
                              <p class="ms-4 text-justify-custom">
                                4. That I could make claims to my Capital Contributions upon termination of my
                                membership without pending obligation,
                                subject to applicable policies and processes of the Cooperative.
                              </p>
                              <p class="text-justify-custom">

                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="termsCheckbox"
                                  name="terms_checkbox">
                                <label class="form-check-label" for="termsCheckbox">
                                  I understand and agree to abide with all of the provisions of this Agreement and the
                                  Articles of Incorporation and By-laws of the Cooperative. I am aware that the
                                  Cooperative or
                                  the Board of Directors may impose corresponding sanction/s against me in case of
                                  non-compliance
                                  or commission of acts contrary to the said provisions.
                                </label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Payment Right Section -->
                  <div class="col-xl-4 col-xxl-3">
                    <!-- Estimated Delivery and Price Details Section -->
                    <div class="border rounded p-4 pb-3 mb-3">
                      <!-- Estimated Delivery -->
                      <h6>Item particular</h6>
                      <ul class="list-unstyled">
                        <li class="d-flex gap-3 align-items-center">
                          <div class="flex-shrink-0">
                            <i class='bx bxs-donate-heart'></i>
                          </div>
                          <div class="flex-grow-1">
                            <p class="mb-0">
                              <a class="text-body" href="javascript:void(0)">Initial Capital Contributions</a>
                            </p>
                            <p class="fw-medium"><?= $date ?></p>
                          </div>
                        </li>
                      </ul>

                      <hr class="mx-n4" />

                      <!-- Price Details -->
                      <h6>Price Details</h6>
                      <dl class="row mb-0">
                        <dt class="col-6 fw-normal">Order Total</dt>
                        <dd class="col-6 text-end" id="total-1">0</dd>
                      </dl>
                      <hr class="mx-n4" />
                      <dl class="row mb-0">
                        <dt class="col-6">Total</dt>
                        <dd class="col-6 fw-medium text-end mb-0 " id="total-2">0</dd>
                      </dl>
                    </div>

                    <!-- Place Order Button -->
                    <div class="d-grid">
                      <button class="btn btn-primary btn-next">Place Order</button>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="col-12 d-flex justify-content-between">
                    </div>


                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
        <!--/ Quotation Wizard -->
      </div>
    </div>
    <div class="content-backdrop fade"></div>
  </div>
  <!--/ Content wrapper -->
</div>
<?php $this->load->view('layout/footer'); ?>
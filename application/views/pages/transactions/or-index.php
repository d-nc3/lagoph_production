_<?php
$first_name =   isset($users['first_name'])    &&  $users['first_name']   ?    ($users['first_name'])   :   '';
$last_name =   isset($users['last_name'])    &&  $users['last_name']   ?    ($users['last_name'])   :   '';
$last_name =   isset($users['last_name'])    &&  $users['last_name']   ?    ($users['last_name'])   :   '';
$address = isset($billing_address['street_address']) && $billing_address['street_address'] ? ($billing_address['street_address']) : '';
$email = isset($billing_address['billing_email']) && $billing_address['billing_email'] ? ($billing_address['billing_email']) : '';
$province = isset($billing_address['province']) && $billing_address['province'] ? ($billing_address['province']) : '';
$municipality = isset($billing_address['municipality']) && $billing_address['municipality'] ? ($billing_address['municipality']) : '';

$billing_address_id = isset($billing_address['id']) && $billing_address['id'] ? ($billing_address['id']) : '';

$user_id = isset($users['id']) && $users['id'] ? ($users['id']) : '';

$date_issued = isset($payment_records['date_issued']) && $payment_records['date_issued'] ? strtoupper($payment_records['date_issued']) : '';
$invoice_number = isset($payment_records['invoice_number']) && $payment_records['invoice_number'] ? strtoupper($payment_records['invoice_number']) : '';
$particulars_id = isset($payment_records['invoice_particulars_id']) && $payment_records['invoice_particulars_id'] ? strtoupper($payment_records['invoice_particulars_id']) : '';
$invoice_id = isset($payment_records['cashiering_invoice_id']) && $payment_records['cashiering_invoice_id'] ? strtoupper($payment_records['cashiering_invoice_id']) : '';
$status = isset($payment_records['status']) && $payment_records['status'] ? ($payment_records['status']) : '';

$pending_cashiering_id = isset($invoice_particulars['cashiering_invoice_id']) && $invoice_particulars['cashiering_invoice_id'] ? strtoupper($invoice_particulars['cashiering_invoice_id']) : '';
$pending_particular_id = isset($invoice_particulars['id']) && $invoice_particulars['id'] ? strtoupper($invoice_particulars['id']) : '';


$particular = isset($invoice_particulars['item_id']) && $invoice_particulars['item_id'] ? strtoupper($invoice_particulars['item_id']) : '';
$unit_cost = isset($invoice_particulars['unit_cost']) && $invoice_particulars['unit_cost'] ? strtoupper($invoice_particulars['unit_cost']) : '';
$total_cost = isset($invoice_particulars['total_cost']) && $invoice_particulars['total_cost'] ? strtoupper($invoice_particulars['total_cost']) : '';
$current_date = date('Y-m-d');

$cashier_first_name =  isset($_SESSION['first_name']) &&  isset($_SESSION['first_name']) ? ($_SESSION['first_name']) : '';
$cashier_last_name = isset($_SESSION['last_name']) && isset($_SESSION['last_name']) ? ($_SESSION['last_name']) : '';

?>

<?php $this->load->view('layout/header'); ?>
<div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">
    <?php $this->load->view('layout/sidenav'); ?>
    <div class="layout-page">
      <?php $this->load->view('layout/navbar'); ?>
      <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
          <h4 class="py-3 mb-2"><span class="text-muted fw-light">Invoice/</span> Pending Invoice</h4>

          <div class="card card-action mb-3">
            <div class="card-header">
              <div class="card-action-title"><b>Transactions/ Online Payment</b></div>
              <div class="card-action-element">
                <ul class="list-inline mb-0">
                  <li class="list-inline-item">
                    <a href="javascript:void(0);" class="card-collapsible"><i class="tf-icons bx bx-chevron-up"></i></a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="collapse hide" style="">
              <div class="card-body pt-0">
                <div class="card border">
                  <div class="card-datatable table-responsive">
                    <table class="datatables-payment table table-bordered table-striped ">
                      <thead>
                        <tr>
                          <th></th>
                          <th>Id</th>
                          <th>Name</th>
                          <th>Date Of Payment &nbsp;</th>
                          <th>Status &nbsp;</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row invoice-edit" id="transactionData">
            <div class="col-lg-9 col-12 mb-lg-0 mb-4">
              <div class="card invoice-preview-card">
                <div class="card-body">
                  <div class="row p-sm-3 p-0">
                    <div class="col-md-5">
                      <h3 class="fw-bold text-uppercase">CycommPh</h3>
                      <p class="mb-1">Office 49, Don A. Roces Ave.</p>
                      <p class="mb-1">Brgy. Paligsahan, Quezon City</p>
                      <p class="mb-0">(02) 70919513</p>
                    </div>
                    <div class="col-md-6">
                      <div class="container">
                        <div class="row justify-content-end">
                          <div class="col-lg-8">
                            <dl class="row p-sm-2">
                              <dt class="col-sm-6 mb-2 mb-sm-0 text-md-end">
                                <span class="fw-normal">Date:</span>
                              </dt>
                              <dd class="col-sm-6 text-md-end">
                                <div class="w-px-150">
                                  <input type="date" class="form-control invoice-date" placeholder="YYYY-MM-DD" value=<?= $current_date ?> id="invoiceDate" />
                                </div>
                              </dd>
                            </dl>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <hr class="my-4 mx-n4" />

                  <div class="row p-sm-3 p-0">
                    <div class="col-md-6 col-sm-5 col-12 mb-sm-0 mb-4">
                      <p>Invoice to</p><?= $first_name ?> <?= $last_name ?>
                    </div>
                    <div class="col-md-6 col-sm-7">
                      <h6 class="pb-2">Bill To:</h6>
                      <table>
                        <tbody>
                          <tr class="mb-3">
                            <td class="pe-3">Address:</td>
                            <td><input type="text" class="form-control mb-2" name="billing_address" id="billingAddress" value=<?= $address ?>> </td>
                          </tr>
                          <tr class="mb-3">
                            <td class="pe-3">Email:</td>
                            <td><input type="text" class="form-control mb-2" name="billing_email" id="billingEmail" value="<?= $email ?>"></td>
                          </tr>
                          <tr class="mb-3">
                            <td class="pe-3">Province:</td>
                            <td><input type="text" id="billingProvince" name="billing_province" class="form-control mb-2" placeholder="Enter Province" value="<?= $province ?>"></td>
                          </tr>
                          <tr class="mb-3">
                            <td class="pe-3">Municipality:</td>
                            <td><input type="text" id="billingMunicipality" name="billing_municipality" class="form-control mb-2" placeholder="Enter Municipality" value="<?= $municipality ?>"></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>

                  <hr class="mx-n4" />

                  <form class="form-repeater" id="formRepeater">
                    <!-- Labels Row (Non-Repeating) -->
                    <div class="row mb-2">
                      <div class="col-lg-6 col-xl-2 col-12">
                        <label class="form-label">Items</label>
                      </div>
                      <div class="col-lg-6 col-xl-3 col-12">
                        <label class="form-label">Unit Cost</label>
                      </div>
                      <div class="col-lg-6 col-xl-2 col-12">
                        <label class="form-label">Item Quantity</label>
                      </div>
                      <div class="col-lg-6 col-xl-3 col-12">
                        <label class="form-label">Total Cost</label>
                      </div>
                    </div>

                    <!-- Repeater Items -->
                    <div data-repeater-list="group-a">
                      <div data-repeater-item>
                        <div class="row">
                          <!-- Items Select -->
                          <div class="mb-3 col-lg-6 col-xl-2 col-12 mb-0">
                            <select class="form-select form-select2 items" id="itemDetails" name="group-a[0][item_details]">
                              <option value="">Select Option</option>
                              <?php foreach ($items as $key => $val) : ?>
                                <option value="<?= $val['id'] ?>" <?= ($val['id'] == $particular) ? 'selected' : '' ?>>
                                  <?= $val['name'] ?>
                                </option>
                              <?php endforeach; ?>
                            </select>
                          </div>

                          <!-- Unit Cost -->
                          <div class="mb-3 col-lg-6 col-xl-3 col-12 mb-0">
                            <input type="text" class="form-control item-price" id="itemPrice" name="group-a[0][item_cost]" placeholder="PHP 1000" readonly value="<?= $unit_cost ?>" />
                          </div>

                          <!-- Item Quantity -->
                          <div class="mb-3 col-lg-6 col-xl-2 col-12 mb-0">
                            <input class="form-control item-qty" name="group-a[0][item_quantity]" id="itemQuantity" value="1" placeholder="1" min="1" max="50">
                          </div>

                          <!-- Total Cost -->
                          <div class="mb-3 col-lg-6 col-xl-3 col-12 mb-0">
                            <input type="text" class="form-control total-price" name="group-a[0][item_total]" id="itemTotal" placeholder="1" readonly value="<?= $total_cost ?>" />
                          </div>

                          <!-- Delete Button -->
                          <div class="mb-3 col-lg-12 col-xl-2 col-12 d-flex align-items-center mb-0">
                            <button type="button" class="btn btn-label-danger mt-6" data-repeater-delete>
                              <i class="bx bx-x me-1"></i>
                              <span class="align-middle">Delete</span>
                            </button>
                          </div>
                        </div>
                        <hr>
                      </div>
                    </div>
                    <input type="hidden" id="userId" name="user_id" value="<?= $user_id ?>" />
                    <input type="hidden" id="billingId" name="billing_id" value="<?= $billing_address_id ?>" />
                    <input type="hidden" id="invoiceId" name="invoice_id" value="<?= $invoice_id ? $invoice_id : $pending_cashiering_id ?>">
                    <input type="hidden" id="particularsId" name="particulars_id" value="<?= $particulars_id ? $particulars_id : $pending_particular_id ?>" />
                    <!-- Add Button -->
                    <div class="mb-0">
                      <button type="button" class="btn btn-primary" data-repeater-create>
                        <i class="bx bx-plus me-1"></i>
                        <span class="align-middle">Add</span>
                      </button>
                    </div>

                    <!-- Summary Section -->
                    <hr class="my-4 mx-n4" />

                    <div class="row py-sm-3">
                      <div class="col-md-6 mb-md-0 mb-3">
                        <div class="d-flex align-items-center mb-3">
                          <label for="salesperson" class="form-label me-2 fw-medium">Cashier:</label>
                          <input type="text" class="form-control" id="issuedBy" name="issued_by" value="<?= $cashier_first_name ?> <?= $cashier_last_name ?>" />
                        </div>
                      </div>
                      <div class="col-md-6 d-flex justify-content-end">
                        <div class="invoice-calculations">
                          <div class="d-flex justify-content-between mb-2">

                            <span class="w-px-100">Subtotal:</span>
                            <span class="fw-medium" id="subTotal">₱<?= number_format((float)$total_cost, 2) ?></span> <!-- Ensure it's a float -->
                          </div>
                          <hr />
                          <div class="d-flex justify-content-between">
                            <span class="w-px-100">Total:</span>
                            <span class="fw-medium" id="total" name="total_amount">₱<?= number_format((float)$total_cost, 2) ?></span> <!-- Ensure it's a float -->
                          </div>

                        </div>
                      </div>
                    </div>

                    <!-- Note Section -->
                    <hr class="my-4" />
                    <div class="row">
                      <div class="col-12">
                        <div class="mb-3">
                          <label for="note" class="form-label fw-medium">Note:</label>
                          <textarea class="form-control" rows="2" id="note">It was a pleasure working with you and your team. We hope you will keep us in mind for future freelance projects. Thank You!</textarea>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-12 invoice-actions">
              <div class="card mb-4">
                <div class="card-body">
                  <form class="payment-record" id="payment">
                    <?php if ($status !== NULL) : ?>
                    
                      <div class="mb-3 col-12">
                        <p class="mb-2">Mode of Payment</p>
                        <select class="form-select mb-4 select2-search" id="paymentMode" name="payment_mode">
                          <option value=""></option>
                          <?php foreach ($payment_options as $key => $val) : ?>
                            <option value="<?= $val['id'] ?>"><?= $val['payment_name'] ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                      <div class="mb-3 form-spacing" id="financialContainer"  style="display: none;">
                        <label for="total_payment">Payment Method</label>
                        <select class="form-select select2-search" id="paymentMethod" name="payment_method" aria-label="Select Financial Institution">
                          <option value="" >Select financial institution</option>               
                            <?php foreach ($payment_method as $method) : ?>
                                <option value="<?= $method['id'] ?>" data-mode="<?= $method['payment_option_id'] ?>">
                                    <?= $method['financial_service_provider'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                      </div>
                      <div class="mb-3  form-spacing" style="display: none;" id="accNameContainer">
                        <label for="account">Account Name</label>
                        <input type="text" id="accountName" name="account_name" class="form-control" placeholder="Account Name">
                      </div>
                      <div class="mb-3  form-spacing" style="display: none;" id="accNumContainer">
                        <label for="account">Account Number</label>
                        <input type="text" id="accountNum" name="account_num" class="form-control" placeholder="Account">
                      </div>
                      <div class="mb-3 form-spacing" style="display: none;" id="refNumContainer">
                        <label for="reference_no">Reference No.</label>
                        <input type="text" id="referenceNo" name="reference_no" class="form-control" placeholder="Reference No.">
                      </div>
                      <div class="mb-3 form-spacing">
                        <label for="total_payment">Enter Amount</label>
                        <input type="text" id="totalPayment" name="total_payment" class="form-control" placeholder="₱0.00">
                      </div>
                      <div class="mb-3 col-12 mb-0">
                        <p class="mb-2"> Payment Status</p>
                        <select class="form-select mb-4" id="paymenStatus" name="payment_status">
                          <option value="">Select</option>
                          <option value="Completed">Completed</option>
                          <option value="Failed">Failed</option>
                        </select>
                      </div>
                      <div class="d-flex my-3" style="display: none;">
                        <a class="btn btn-label-secondary w-100 me-3" href="<?= site_url('Official_receipt/receipt_view/' . $invoice_id) ?>">Preview</a>
                      </div>
                      <button
                        type="button"
                        class="btn btn-primary d-grid w-100 btn-save">
                        <span class="d-flex align-items-center justify-content-center text-nowrap"><i class="bx bx-dollar bx-xs me-1 "></i>Issue Official Receipt</s>
                      </button>
                  </form>
                <?php endif; ?>
                </div>
              </div>
              <div>
              </div>
            </div>
          </div>
        </div>

        <?php $this->load->view('layout/footer'); ?>
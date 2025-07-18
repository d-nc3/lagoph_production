<?php
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

                  <form class="source-item py-sm-3" id="item" onsubmit="return false">
                    <div id="item-details">
                      <div class="item-form-repeater">
                        <div class="mb-3 label" data-repeater-list="item-list">
                          <div class="row w-100  text-center fw-bold">
                            <div class="col-md-3 col-12 mb-md-0 mb-3 ps-md-0">
                              <p>Item</p>
                            </div>
                            <div class="col-md-3 col-12 mb-md-0 mb-3">
                              <p class="mb-2">Cost</p>
                            </div>
                            <div class="col-md-1 col-12 mb-md-0 mb-3">
                              <p class="mb-2">Qty</p>
                            </div>
                            <div class="col-md-1 col-12 pe-0">
                              <p class="mb-2">Unit</p>
                            </div>
                            <div class="col-md-3 col-12 pe-0">
                              <p class="mb-2">Total</p>
                            </div>
                          </div>

                          <div class="repeater-wrapper pt-0 pt-md-4" data-repeater-item id="itemData">
                            <div class="d-flex border rounded position-relative pe-0">
                              <div class="row w-100 m-0 p-3 repeater-item">
                                <div class="row repeater-item">
                                  <div class="col-md-3 col-12 mb-md-0 mb-3 ps-md-0">
                                    <select class="select2-search form-select items mb-2"
                                      id="itemDetails-<?= $row ?>"
                                      name="item-list[<?= $row ?>][item_details]"
                                      data-allow-clear="true"
                                      placeholder="Select an item">
                                      <option value="" disabled selected>Select an item</option>
                                      <?php foreach ($items as $key => $val) : ?>
                                        <option value="<?= $val['id'] ?>" <?= ($val['id'] == $particular) ? 'selected' : '' ?>>
                                          <?= $val['name'] ?>
                                        </option>
                                      <?php endforeach; ?>
                                    </select>
                                  </div>
                                  <div class="col-md-3 col-12 mb-md-0 mb-3">
                                    <input type="text" class="form-control item-price mb-2" id="itemPrice" name="item-list[0][item_cost]" placeholder="PHP 1000" min="12" readonly value="<?= $unit_cost ?>" />
                                  </div>
                                  <div class="col-md-2 col-12 mb-md-0 mb-3">
                                    <input type="text" class="form-control item-qty" id="itemQuantity" name="item-list[0][item_quantity]" value=1 placeholder="1" min="1" max="50" />
                                  </div>
                                  <div class="col-md-1 col-12 pe-0">
                                    <p class="mb-0">Php</p>
                                  </div>
                                  <div class="col-md-3 col-12 pe-0">
                                    <input type="text" class="form-control total-price" id="itemTotal" name="item-list[0][item_total]" placeholder="1" min="1" max="50" readonly value="<?= $total_cost ?>" />
                                  </div>
                                </div>
                              </div>

                              <div class="d-flex flex-column align-items-center justify-content-between border-start p-2">
                                <i class="bx bx-x fs-4 text-muted cursor-pointer" data-repeater-delete></i>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-12">
                            <button type="button" class="btn btn-primary" data-repeater-create>Add Item</button>
                          </div>
                        </div>

                        <hr class="my-4 mx-n4" />

                        <input type="hidden" id="userId" name="user_id" value="<?= $user_id ?>" />
                        <input type="hidden" id="billingId" name="billing_id" value="<?= $billing_address_id ?>" />
                        <input type="hidden" id="invoiceId" name="invoice_id" value="<?= $invoice_id ?>" />
                        <input type="hidden" id="particularsId" name="particulars_id" value="<?= $particulars_id ?>" />

                        <div class="row py-sm-3">
                          <div class="col-md-6 mb-md-0 mb-3">
                            <div class="d-flex align-items-center mb-3">
                              <label for="salesperson" class="form-label me-2 fw-medium">Cashier:</label>
                              <input type="text" class="form-control" id="issuedBy" name="issued_by" value="<?= $cashier_first_name ?> <?= $cashier_last_name ?>" disabled />
                            </div>
                          </div>
                          <div class="col-md-6 d-flex justify-content-end">
                            <div class="invoice-calculations">
                              <div class="d-flex justify-content-between mb-2">
                                <span class="w-px-100">Subtotal:</span>
                                <span class="fw-medium" id="subTotal">₱</span>
                              </div>
                              <hr />
                              <div class="d-flex justify-content-between">
                                <span class="w-px-100">Total:</span>
                                <span class="fw-medium" id='total' name="total_amount">₱</span>
                              </div>
                            </div>
                          </div>
                        </div>

                        <hr class="my-4" />

                        <div class="row">
                          <div class="col-12">
                            <div class="mb-3">
                              <label for="note" class="form-label fw-medium">Note:</label>
                              <textarea class="form-control" rows="2" id="note">It was a pleasure working with you and your team. We hope you will keep us in mind for future freelance projects. Thank You!</textarea>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-12 invoice-actions">
              <div class="card mb-4">
                <div class="card-body">
                  <form class="payment-record" id="payment" onsubmit=false>
                    <?php if ($status !== NULL) : ?>
                      <!-- Mode of Payment Dropdown -->
                      <div class="mb-3 col-12">
                        <p class="mb-2">Mode of Payment</p>
                        <select class="form-select select2 mb-4" id="paymentMode" name="payment_mode">
                          <option value=""></option>
                          <?php foreach ($payment_options as $key => $val) : ?>
                            <option value="<?= $val['id'] ?>"><?= $val['payment_name'] ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                      <div class="mb-3 form-spacing" id="financialContainer" style="display: none;">
                        <label for="total_payment">Bank/E-wallet</label>
                        <select class="form-select select2 mb-4" id="financialInstitution" name="financial_institution">
                          <option value=""></option>
                          <?php foreach ($financial_institution as $key => $val) : ?>
                            <option value="<?= $val['id'] ?>"><?= $val['financial_service_provider'] ?></option>
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
                        <input type="text" id="total_payment" name="total_payment" class="form-control" placeholder="₱0.00">
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
                        <a class="btn btn-label-secondary w-100 me-3" href="<?= site_url('Cashiering/receipt_view/' . $invoice_id) ?>">Preview</a>
                      </div>
                      <button
                        class="btn btn-primary d-grid w-100">
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
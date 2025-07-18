<?php   

    $billing_email =   isset($invoice_particulars['billing_email'])    &&  $invoice_particulars['billing_email']   ?   ($invoice_particulars['billing_email'])   :   '';
    $street_address =   isset($invoice_particulars['street_address'])    &&  $invoice_particulars['street_address']   ?   ($invoice_particulars['street_address'])   :   '';
    $mobile_number =   isset($invoice_particulars['mobile_number'])    &&  $invoice_particulars['mobile_number']   ?   ($invoice_particulars['mobile_number'])   :   '';
    $municipality =   isset($invoice_particulars['municipality'])    &&  $invoice_particulars['municipality']   ?   ($invoice_particulars['municipality'])   :   '';
    $province =   isset($invoice_particulars['province'])    &&  $invoice_particulars['province']   ?    ($invoice_particulars['province'])   :   '';
    $date = date('Y-m-d'); 
    $user_first_name =   isset($invoice_particulars['first_name'])    &&  $invoice_particulars['first_name']   ?    ($invoice_particulars['first_name'])   :   '';
    $user_last_name =   isset($invoice_particulars['last_name'])    &&  $invoice_particulars['last_name']   ?    ($invoice_particulars['last_name'])   :   '';
    
    // invoice particulars w/ cashiering invoice data inner join
    $particular_id = isset($invoice_particulars['id']) && $invoice_particulars['id'] ? ($invoice_particulars['id']) : '';
    $invoice_id = isset($invoice_particulars['cashiering_invoice_id']) && $invoice_particulars['cashiering_invoice_id'] ? ($invoice_particulars['cashiering_invoice_id']) : '';
    $invoice_number = isset($invoice_particulars['invoice_number']) && $invoice_particulars['invoice_number'] ? $invoice_particulars['invoice_number']: '';
    $particulars = isset($invoice_particulars['name']) && $invoice_particulars['name'] ? $invoice_particulars['name'] : '';
    $invoice_type = isset($invoice_particulars['invoice_type']) && $invoice_particulars['invoice_type'] ? ($invoice_particulars['invoice_type']) :  '';
    $date_issued = isset($invoice_particulars['date_issued']) && $invoice_particulars['date_issued'] ? $invoice_particulars['date_issued'] : '';
    $status = isset($invoice_particulars['status']) && $invoice_particulars['status'] ? ($invoice_particulars['status']) : '';
    $user_id = isset($invoice_particulars['user_id']) && $invoice_particulars['user_id'] ? ($invoice_particulars['user_id']) : '';
    $unit_cost = isset($invoice_particulars['unit_cost']) && $invoice_particulars['unit_cost'] ? $invoice_particulars['unit_cost'] : '';
    $total_cost = isset($invoice_particulars['total_cost']) && $invoice_particulars['total_cost'] ? $invoice_particulars['total_cost'] : '';
    $quantity = isset($invoice_particulars['quantity']) && $invoice_particulars['quantity'] ? $invoice_particulars['quantity']: '';

    //login session details
    $first_name  = isset($_SESSION['first_name']) ? $this->session->userdata('first_name') : DEFAULT_ADMIN_USER_ROLE;
    $last_name  = isset($_SESSION['last_name']) ? $this->session->userdata('last_name') : DEFAULT_ADMIN_USER_ROLE;
 ?>
<?php $this->load->view('layout/header'); ?>

    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <?php $this->load->view('layout/sidenav'); ?>
        <div class="layout-page">
          <?php $this->load->view('layout/navbar'); ?>
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-4"><span class="text-muted fw-light">Invoice/</span> Pending Invoice</h4>
              <div class="row invoice-preview">
              <!-- Invoice -->
              <div class="col-xl-8 col-md-7 col-12 mb-md-0 mb-4">
                <div class="card mb-2">
                 <div class="card-body">
                  <div class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column p-sm-3 p-0">
                    <div class="mb-xl-0 mb-4">
                    <h3 class="fw-bold text-uppercase">CycommPh</h3>  
                        <p class="mb-1">Office 49, Don A. Roces Ave.</p>
                        <p class="mb-1">Brgy. Paligsahan, Quezon City</p>
                        <p class="mb-0">(02) 70919513</p>
                      </div>
                      <div class="justify">
                        <span class="fw-medium d-block">Invoice: <?=$invoice_number?></span>
                        <span class="fw-medium d-block">Date Issued: <?=$date_issued?></span>
                  <span class="fw-medium " >Status: <?= ($status) ?></span>
                      </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex flex-column flex-md-row p-4">
                      <div class="w-50">
                        <h5 class="mb-2" style="font-size: 0.9rem;">Invoice To</h5>
                        <p class="mb-1 text-muted" style="font-size: 0.9rem;"><?=$user_first_name?> <?=$user_last_name?> </p>
                        
                      </div>
                      <div class="w-50">
                        <h5 class="mb-2" style="font-size: 0.9rem;">Billing Address</h5>
                        <p class="mb-1 text-muted" style="font-size: 0.9rem;">Address: <?=$street_address?></p>
                        <p class="mb-1 text-muted" style="font-size: 0.9rem;">Email: <?=$billing_email?></p>
                        <p class="mb-1 text-muted" style="font-size: 0.9rem;">Province: <?=$province?></p>
                        <p class="mb-0 text-muted" style="font-size: 0.9rem;">Municipality: <?=$municipality?></p>
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
                          <tr>
                            <td class="text-center"><?=$quantity?></td>
                            <td class="text-center">Unit</td>
                            <td class="text-center"><?=$particulars?></td>
                            <td class="text-center">₱<?=$unit_cost?></td>
                            <td class="text-center">₱<?=$total_cost?></td>
                          </tr>
                    
                        <tr>
                          <td colspan="3" class="align-top px-4 py-5">
                            <p class="mb-2">
                              <span class="me-1 fw-medium">Issued By:</span>
                              <input
                              type="text"
                              class="form-control"
                              id="cashierName"
                              name="cashier_name" 
                              placeholder="Edward Crowley"
                              value="<?=$first_name?> <?=$last_name?>" disabled />
                              
                            </p>
                          </td>
                          <td class="align-top px-4 py-5">
                            <p class="mb-2">Subtotal:</p>
                            <p class="mb-2">Discount:</p>
                            <p class="mb-2">Tax:</p>
                            <p class="mb-0">Total:</p>
                          </td>
                          <td class="align-top px-4 py-5">
                            <p class="fw-medium mb-2">₱<?=$total_cost?></p>
                            <p class="fw-medium mb-2">₱00.00</p>
                            <p class="fw-medium mb-2">₱00.00</p>
                            <p class="fw-medium mb-0">₱<?=$total_cost?></p>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
          
                         
                </div>
              </div>
              <!-- Invoice Actions-->
              <div class="col-xl-4 col-md-5 col-12 invoice-actions">
                <div class="card mb-4">
                 <div class="card-body">
                  <form id="approval-form" onsubmit="return false">
                   <input type="hidden" name="id" value=<?=$invoice_id?>> <!-- User ID is submitted -->
                   <input type="hidden" name="invoice_id" value=<?=$invoice_id?>> <!-- User ID is submitted -->
                   <input type="hidden" name="particular_id" value=<?=$particular_id?>> <!-- User ID is submitted -->
                   <input type="hidden" name="user_id" value=<?=$user_id?>> <!-- User ID is submitted -->
        
                   <?php if ($status === 'pending'): ?>
                    <!-- Mode of Payment Dropdown -->
                    <div class="mb-3 col-12">
                       <p class="mb-2">Mode of Payment</p>
                       <select class="form-select select2 mb-4" id="paymentMode" name="payment_mode">
                        <option value=""></option>
                        <?php foreach($payment_options as $key => $val) :?>
                          <option value ="<?=$val['id']?>"><?=$val['payment_name']?></option>
                        <?php endforeach; ?>  
                       </select>
                     </div>
                     
                     <div class="mb-3 form-spacing" id="financialContainer" style="display: none;">
                      <label for="total_payment">Bank/E-wallet</label>
                        <select class="form-select select2 mb-4" id="financialInstitution" name="financial_institution" >
                        <option value=""></option>
                        <?php foreach($financial_institution as $key => $val) :?>
                          <option value ="<?=$val['id']?>"><?=$val['financial_service_provider']?></option>
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
                      <input type="text" id="total_payment" name="total_payment" class="form-control" placeholder="₱0.00"  >
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
                      class="btn btn-primary d-grid w-100 btn-receipt">
                      <span class="d-flex align-items-center justify-content-center text-nowrap"
                      ><i class="bx bx-dollar bx-xs me-1 "></i>Issue Official Receipt</s>
                     </button>
                    </form>
                     
                    <?php elseif ($status === 'completed'): ?>
                     <div class="d-flex my-3">
                     <!-- Confirmation Message -->
                      <div class="alert alert-success w-100 me-3" role="alert">
                       Transaction Successful! Your transaction ID is <strong>#123456</strong>.
                       Transaction Successful for Invoice ID is <strong><?=$invoice_number?></strong>.
                      </div>
                     </div>
                    <h5 class="card-title">Transaction Details</h5>
                    <div class="card-body">
                       <p><strong>Transaction ID:</strong> </p>
                       <p><strong>Date:</strong> September 5, 2024</p>
                       <p><strong>Amount:</strong> $100.00</p>
                       <p><strong>Payment  Method:</strong> Credit Card</p>
                   <div class="my-2">
                       <button class="btn btn-primary w-100 mb-3" onclick="copyTransactionDetails()">Copy Transaction Details</button>
                       <button class="btn btn-label-secondary w-100" onclick="downloadReceipt()">Download Receipt</button>
                      </div>
                   <div class="my-2">
                       <p>This transaction has been added to your <a href="#transaction-history">Transaction History</a>.</p>
                      </div>
                     <?php endif; ?>
                    </div>
                  </div>
                <div>
               </div>
             </div>
           </div>
          <!-- /Invoice Actions -->
        </div>
      </div>
      
      <div class="offcanvas offcanvas-end" tabindex="-1" id="invoiceActionsOffcanvas" aria-labelledby="invoiceActionsOffcanvasLabel">
       <div class="offcanvas-header">
        <h5 id="invoiceActionsOffcanvasLabel">Cashier Actions</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
       </div>
       <div class="offcanvas-body">
        <!-- Payment Instructions Box -->
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
                
           <div class="d-grid mb-3">
            <button class="btn btn-primary" id="submitPayment">Submit</button>
           </div>
           <div class="d-grid">
            <button class="btn btn-outline-danger" data-bs-dismiss="offcanvas">Cancel</button>
           </div>
          </div>
         </div>
          <!-- Modal -->
          <div class="modal fade" id="invoiceActionsModal" tabindex="-1" aria-labelledby="invoiceActionsModalLabel" aria-hidden="true">
            <div class="modal-dialog">
             <div class="modal-content">
              <div class="modal-header">
               <h5 class="modal-title" id="invoiceActionsModalLabel">Payment Receipt preview</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
              <div class="mb-3">
               <img id="image-preview" src="" alt="Image Preview" class="img-fluid d-none">
              </div>
             </div>
            <div class="modal-footer">
             <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
       <!--/ Modal -->
      </div>
    </div>
  
<?php $this->load->view('layout/footer'); ?>

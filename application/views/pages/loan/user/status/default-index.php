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

// loan information details 
$available_credit = isset($balance['available_credit']) && $balance['available_credit'] ? ($balance['available_credit']) : '';

?>
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
               <div class="col-md-5">
                <div class="btn btn-outline-secondary border-1 rounded-4 w-100 py-3 d-flex align-items-center">
                 <div class="me-3">
                  <i class='bx bxs-credit-card' style="font-size: 2rem; color: #6c757d;"></i>
                 </div>
                 <div>
                  <div class="fw-bold">LOAN CREDIT</div>
                  <div><?= $member_reference ?></div>
                  <div class="fw-bold" id="creditAvailable">PHP <?= $available_credit ?></div>
                 </div>
                </div>
               </div>
              </div>

              <hr />

              <div class="row">
               <div class="flex-column col-md-5">
                <div class="col-12">

                 <label for="select-account" class="form-label fw-bold">Select Disbursement Account</label>

                 <input type="hidden" id="disbursmentAccount" name="disbursment_account" class="form-control" value="" />
                 <a href="#" id="selectAccount" name="select_account" class="d-block text-decoration-none btn btn-outline-secondary border-1 w-70 py-5 text-center" role="button"
                  data-bs-toggle="modal" data-bs-target="#accountModal">
                  Select Accounts <i class='bx bx-plus-circle'></i>
                 </a>
                </div>
               </div>

               <div class="row g-3 mt-3">
                <!-- Loan Amount -->
                <div class="col-md-6">
                 <label class="form-label fw-bold" for="loanAmount">Loan Amount*</label>
                 <input type="number" name="loan_amount" id="loanAmount" class="form-control" placeholder="10,000" />
                </div>

                <!-- Payment Schedule -->
                <div class="col-md-6">
                 <label for="paymentSchedule" class="form-label fw-bold">Payment Schedule*</label>
                 <select id="paymentSchedule" name="payment_schedule" class="form-select" aria-label="Payment Schedule">
                  <option value="">Select Value</option>
                  <option value="3">3 months</option>
                  <option value="6">6 months</option>
                  <option value="9">9 months</option>
                  <option value="12">12 months</option>
                 </select>
                </div>
               </div>
              </div>
             </div>
           </li>
          </ul>
         </div>


         <!-- Cart right -->
         <div class="col-xl-4">
          <div class="border rounded p-4 mb-3 pb-3">
           <!-- Offer -->
           <h6 class="fw-bold mt-2">Payment Schedules</h6>
           <span class="fw-light" style="font-size: 12px"> *Due dates will be sent upon loan approval</span>
           <div class="container mt-4">
            <div class="accordion" id="tableAccordion">
             <div class="accordion-item">
              <h2 class="accordion-header" id="headingOne">
               <button class="accordion-button collapsed d-flex justify-content-between align-items-center"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#collapseOne"
                aria-expanded="false"
                aria-controls="collapseOne">
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
       </div>
       <!-- Loan Confirmation -->
       <div id="checkout-confirmation" class="content">
        <div class="container py-5">
         <div class="loan-disbursement" style="background-color: #f8f9fa; border-radius: 10px; padding: 25px;">
          <!-- Header Section -->
          <div class="text-center mb-5">
           <i class="bx bx-wallet img-fluid mb-3" style="width: 150px; font-size: 150px;"></i>
           <h2 class="font-weight-bold text-dark" style="font-weight: bold; color: #343a40;">Your Loan Has Been Submitted Successfully</h2>
           <h3 class="amount text-primary" style="font-size: 1.5rem; color: #007bff; font-weight: bold;">PHP 49,625.00</h3>
          </div>

          <!-- Loan Details Section -->
          <div class="card p-4 shadow-sm" style="padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
           <div class="mb-4">
            <div class="detail-item d-flex justify-content-between align-items-center" style="font-size: 16px; margin-bottom: 1.5rem;">
             <span class="font-weight-bold" style="font-weight: bold; color: #6c757d;">Loan ID</span>
             <span style="font-weight: 600;">8286682998</span>
            </div>
            <div class="detail-item d-flex justify-content-between align-items-center" style="font-size: 16px; margin-bottom: 1.5rem;">
             <span class="font-weight-bold" style="font-weight: bold; color: #6c757d;">Installment Due Date</span>
             <span>10th of every month <br />1st Due on 10 Mar</span>
            </div>
            <div class="detail-item d-flex justify-content-between align-items-center" style="font-size: 16px; margin-bottom: 1.5rem;">
             <span class="font-weight-bold" style="font-weight: bold; color: #6c757d;">Amount to be Received</span>
             <span style="font-weight: 600; color: #28a745;">PHP 49,625.00</span>
            </div>
            <div class="detail-item d-flex justify-content-between align-items-center" style="font-size: 16px; margin-bottom: 1.5rem;">
             <span class="font-weight-bold" style="font-weight: bold; color: #6c757d;">Amount Requested</span>
             <span style="font-weight: 600; color: #dc3545;">PHP 50,000.00</span>
            </div>
            <div class="detail-item d-flex justify-content-between align-items-center" style="font-size: 16px; margin-bottom: 1.5rem;">
             <span class="font-weight-bold" style="font-weight: bold; color: #6c757d;">Processing Fee</span>
             <span style="font-weight: 600; color: #28a745;">FREE</span>
            </div>
            <div class="detail-item d-flex justify-content-between align-items-center" style="font-size: 16px; margin-bottom: 1.5rem;">
             <span class="font-weight-bold" style="font-weight: bold; color: #6c757d;">Documentary Stamp Tax</span>
             <span style="font-weight: 600; color: #007bff;">PHP 375.00</span>
            </div>
            <div class="detail-item d-flex justify-content-between align-items-center" style="font-size: 16px; margin-bottom: 1.5rem;">
             <span class="font-weight-bold" style="font-weight: bold; color: #6c757d;">Disburse to</span>
             <span style="font-weight: 600; color: #17a2b8;">SeaBank (*8498)</span>
            </div>
           </div>

           <!-- Button Section -->
           <div class="text-center mt-4">
            <button class="btn btn-primary" style="background-color: #007bff; border: none; padding: 12px 30px; font-size: 18px; border-radius: 25px; font-weight: bold; transition: background-color 0.3s;">
             Done
            </button>
           </div>
          </div>
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
 <div class="modal fade" id="accountModal" tabindex="-1" aria-labelledby="accountModalLabel" aria-hidden="true">
  <div class="modal-dialog">
   <div class="modal-content">
    <div class="modal-header">
     <h5 class="modal-title" id="accountModalLabel">Select Disbursement Account</h5>
     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
     <div class="d-flex justify-content-between align-items-center mb-3">
      <h6 class="mb-0">Your Accounts</h6>
      <a href="<?= site_url('Settings/Billing') ?>" class="btn btn-primary" id="newRecipientButton">
       New Account <i class="bx bx-plus-circle"></i>
      </a>
     </div>
     <ul class="list-group" id="accountList">
      <li class="list-group-item d-flex justify-content-between align-items-center account-item" data-account-id="1">
       <div class="d-flex align-items-center">
      </li>
     </ul>
    </div>
    <div class="modal-footer">
     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    </div>
   </div>
  </div>
 </div>

</div>
<!--/ Content wrapper -->
</div>

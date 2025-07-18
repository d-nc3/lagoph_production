<!-- JavaScript -->
<?php
$billing_email = isset($billing_address['billing_email']) && $billing_address['billing_email'] ? strtoupper($billing_address['billing_email']) : '';
$street_address = isset($billing_address['street_address']) && $billing_address['street_address'] ? strtoupper($billing_address['street_address']) : '';
$mobile_number = isset($billing_address['mobile_number']) && $billing_address['mobile_number'] ? strtoupper($billing_address['mobile_number']) : '';
$municipality = isset($billing_address['municipality']) && $billing_address['municipality'] ? strtoupper($billing_address['municipality']) : '';
$province = isset($billing_address['province']) && $billing_address['province'] ? strtoupper($billing_address['province']) : '';
$date = date('Y-m-d'); // Format: Year-Month-Day
?>
<?php $this->load->view('layout/header'); ?>

<div class="layout-wrapper layout-content-navbar">
 <div class="layout-container">
  <?php $this->load->view('layout/sidenav'); ?>
  <div class="layout-page">
   <?php $this->load->view('layout/navbar'); ?>
   <!-- Content wrapper -->
   <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Membership /</span> Membership Agreement Form</h4>
    <!-- Membership Agreement Section -->
    <div class="row">
     <div class="col-xl-8 col-xxl-9 mb-3 mb-xl-0">
      <div class="card shadow-sm border-0">
       <div class="card-header text-white mb-3"
        style="background-color: #008080; color: white; border-top-left-radius: 10px; border-top-right-radius: 10px;">
        <h5 class="mb-0 text-white">Membership Agreement</h5>
        <small class="text-white-50">Subscription Agreement</small>
       </div>
       <div class="card-body">
        <form id="membershipAgreementForm">
         <p>I hereby apply for membership in the Cyber-Community Philippines Credit Cooperative. I agree to faithfully
          abide by the rules and regulations set forth in its Articles of Incorporation and By-Laws.</p>
         <p class="ms-4">In view of that, I pledge to:</p>
         <ol class="ms-4">
          <li>Attend and finish the prescribed Pre-Membership Education Seminar (PMES);</li>
          <li>Pay the membership fee of Five Hundred Pesos (P500.00);</li>
          <li>Participate in the savings, credit, and loans programs, and other associated services of the Cooperative;
          </li>
          <li>Subscribe for at least Ten (10) Shares and pay the same either in lumpsum or in installment, under the
           terms and conditions prescribed in the Subscription Agreement;</li>
          <li>Perform my responsibilities as a member and conform with the directives of duly constituted authorities
           including the decisions of the Board of Directors relative to the sound administration and operations of the
           cooperative.</li>
         </ol>
         <hr />
         <div class="form-check">
          <input class="form-check-input" type="checkbox" id="termsCheckbox" name="terms_checkbox">
          <label class="form-check-label" for="termsCheckbox">
           I understand and agree to abide by all the provisions of this Agreement and the Articles of Incorporation and
           By-laws of the Cooperative. I am aware that the Cooperative or the Board of Directors may impose
           corresponding sanction/s against me in case of non-compliance or commission of acts contrary to the said
           provisions.
          </label>
         </div>
         <div class="d-flex justify-content-end mt-3">
          <button class="btn btn-success btn-md" id="submitAgreement">Agree and Submit</button>
         </div>
        </form>
       </div>
      </div>
     </div>

     <!-- Submission Section -->
     <div class="col-xl-4 col-xxl-3">
      <div class="card border-0 shadow-sm mb-3">
       <div class="card-body">
        <h6>Order Summary</h6>
        <ul class="list-unstyled">
         <li class="d-flex justify-content-between align-items-center">
          <span>Membership Fee</span>
          <span class="text-muted"><?= $date ?></span>
         </li>
        </ul>
        <hr />
        <dl class="row">
         <dt class="col-6">Order Total</dt>
         <dd class="col-6 text-end">PHP 500.00</dd>
         <dt class="col-6 fw-bold">Total</dt>
         <dd class="col-6 text-end fw-bold">PHP 500.00</dd>
        </dl>
       </div>
      </div>

      <!-- Submit button -->

     </div>
    </div>
   </div>

  </div>
 </div>
</div>
<?php $this->load->view('layout/footer'); ?>
<?php

$all_users = $all_users ?? 0;
$paid_users = $paid_users ?? 0;
$total_payments = $total_payments ?? 0;
$total_pending_invoice = $total_pending_invoice ?? 0;
$total_amount_of_share = $contributions['subscribed_amount'] ?? 0;
$total_withdrawals = $member_balance['total_withdrawals'] ?? 0;
$total_loans = $member_balance['total_outstanding_loans'] ?? 0;
$loan_count = $loan_counts ?? 0;
$completed_transactions = $completed_transactions ?? 0;
$total_contributions = $all_contributions ?? 0;

?>
<?php $this->load->view('layout/header'); ?>
<div class="layout-wrapper layout-content-navbar">
 <div class="layout-container">
  <?php $this->load->view('layout/sidenav'); ?>
  <div class="layout-page">
   <?php $this->load->view('layout/navbar'); ?>
   <!-- Content wrapper -->
 

    <div class="container-xxl flex-grow-1 container-p-y">
     <h4 class="py-3 mb-4"><span class="text-muted fw-light">Transaction/</span> Pending Invoice</h4>
     <div class="row g-4 mb-4">
      <div class="col-sm-6 col-xl-3">
       <div class="card">
        <div class="card-body">
         <div class="d-flex align-items-start justify-content-between">
          <div class="content-left">
           <span>Total Pending Invoice</span>
           <div class="d-flex align-items-end mt-2">
            <h4 class="mb-0 me-2"><?= $total_pending_invoice ?></h4>
            <small class="text-success">(+29%)</small>
           </div>
           <p class="mb-0">Total Users</p>
          </div>
          <div class="avatar">
           <span class="avatar-initial rounded bg-label-primary">
            <i class="bx bx-user bx-sm"></i>
           </span>
          </div>
         </div>
        </div>
       </div>
      </div>



     </div>
     <!-- Billing History Table -->
     <div class="col-lg-12  col-md-12 mb-4">
      <div class="card">
       <div class="card-header border-bottom">
        <h5 class="card-title">Billing History</h5>
       </div>
       <div class="card-datatable table-responsive">
        <table class="datatables-transactions table border-top">
         <thead>
          <tr>
           <th>Name</th>
           <th>Date Issued</th>
           <th>Status</th>
           <th>Invoice type</th>
           <th>Actions</th>
          </tr>
         </thead>
        </table>
       </div>
      </div>
     </div>
    </div>
   </div>


   <!-- Create App Modal -->
   <div class="modal fade" id="createApp" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-simple modal-upgrade-plan">
     <div class="modal-content p-3 p-md-5">
      <div class="modal-body p-2">
       <form id="form" onSubmit="return false">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center">
         <h3 class="mb-2">Upload Receipt </h3>
         <p>Provide data with this form to settle invoice payments.</p>
        </div>
        <!-- App Wizard -->

        <div id="wizard-create-app" class="bs-stepper vertical mt-2 shadow-none border-0">
         <div class="bs-stepper-header border-0 p-1">
          <div class="step" data-target="#details">
           <button type="button" class="step-trigger">
            <span class="bs-stepper-circle"><i class="bx bx-file fs-5"></i></span>
            <span class="bs-stepper-label">

             <span class="bs-stepper-title text-uppercase">Details</span>
             <span class="bs-stepper-subtitle">Enter Details</span>
            </span>
           </button>
          </div>


          <div class="line"></div>
          <div class="step" data-target="#submit">
           <button type="button" class="step-trigger">
            <span class="bs-stepper-circle"><i class="bx bx-check fs-5"></i></span>
            <span class="bs-stepper-label">
             <span class="bs-stepper-title text-uppercase">Submit</span>
             <span class="bs-stepper-subtitle">Submit</span>
            </span>
           </button>
          </div>
         </div>
         <div class="bs-stepper-content p-1">
          <form id="upload-payment-id" onSubmit="return false">
           <div id="details" class="content pt-3 pt-lg-0">
            <div class="mb-2">
             <b class="mb-5">Payment Details</b>
             <small class="text-muted">
              <p>What is the payment for</p>
             </small>
             <input
              name="details"
              type="text"
              class="form-control form-control-lg"
              id="payment-detail"
              placeholder="Details of payment" />
            </div>
            <div class="d-flex justify-content-between w-100 flex-wrap gap-2">
             <div class="me-2">
              <b class="mb-5">Upload Receipt</b>
              <small class="text-muted">
               <p>Make sure to capture the important details of the Receipt</p>
              </small>
              <input type="file" id="attachments[contribution_receipt]" name="attachments[contribution_receipt]" class="form-control" accept=".jpg,.jpeg" single />
             </div>
            </div>

            <div class="col-12 d-flex justify-content-between mt-4">
             <button class="btn btn-primary btn-next">
              <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
              <i class="bx bx-right-arrow-alt bx-xs"></i>
             </button>
            </div>
           </div>

           <!-- Frameworks -->
           <div id="frameworks" class="content pt-3 pt-lg-0">


           </div>


           <!-- submit -->
           <div id="submit" class="content text-center pt-3 pt-lg-0">
            <h5 class="mb-2 mt-3">Submit</h5>
            <p>Submit to become a member.</p>
            <!-- image -->
            <img
             src="../../assets/img/illustrations/man-with-laptop-light.png"
             alt="Create App img"
             width="200"
             class="img-fluid"
             data-app-light-img="illustrations/man-with-laptop-light.png"
             data-app-dark-img="illustrations/man-with-laptop-dark.png" />
            <div class="col-12 d-flex justify-content-between mt-4 pt-2">
             <button class="btn btn-label-secondary btn-prev">
              <i class="bx bx-left-arrow-alt bx-xs me-sm-1 me-0"></i>
              <span class="align-middle d-sm-inline-block d-none">Previous</span>
             </button>
             <button class="btn btn-success btn-submit">
              <span class="align-middle d-sm-inline-block d-none">Submit</span>
              <i class="bx bx-check bx-xs ms-sm-1 ms-0"></i>
             </button>
            </div>
           </div>
          </form>
         </div>
        </div>
       </form>
      </div>
      <!--/ App Wizard -->
     </div>
    </div>
   </div>
   <!--/ Create App Modal -->

   <div class="content-backdrop fade"></div>
  </div>
  <!--/ Content wrapper -->
 </div>
 <?php $this->load->view('layout/footer'); ?>


<?php $this->load->view('layout/header'); ?>
<div class="layout-wrapper layout-content-navbar">
 <div class="layout-container">
  <?php $this->load->view('layout/sidenav'); ?>
  <div class="layout-page">
   <?php $this->load->view('layout/navbar'); ?>

   <!-- Content wrapper -->

   <div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
     <h4 class="py-3 mb-1"><span class="text-muted fw-light">Dashboard /</span> Member list</h4>
     <div class="row">
   
        <?php $this->load->view('pages/member/layout/profile', $info)?>

       <!-- /Activity Timeline -->
       <div class="col-xl-12">
        <div class="card overflow-hidden mb-4 position-relative p-4">
         <h5>Events</h5>
         <div class="card-datatable table-responsive">
          <ul class="list-unstyled">
           <li class="d-flex justify-content-between align-items-start mb-2">
            <span><strong>Emma Smith</strong> has made payment to <strong class="text-primary">#XRS-45670</strong></span>
            <span class="text-muted">05 May 2025, 11:30 am</span>
           </li>
           <li class="d-flex justify-content-between align-items-start mb-2">
            <span>Invoice <strong class="text-primary">#LOP-45640</strong> has been
             <span class="badge badge-declined">Declined</span>
            </span>
            <span class="text-muted">25 Jul 2025, 10:30 am</span>
           </li>
           <li class="d-flex justify-content-between align-items-start mb-2">
            <span>Invoice <strong class="text-primary">#KIO-45656</strong> status has changed from
             <span class="badge badge-in-transit">In Transit</span> to
             <span class="badge badge-approved">Approved</span>
            </span>
            <span class="text-muted">25 Oct 2025, 6:43 am</span>
           </li>
           <li class="d-flex justify-content-between align-items-start mb-2">
            <span><strong>Max Smith</strong> has made payment to <strong class="text-primary">#SDK-45670</strong></span>
            <span class="text-muted">20 Dec 2025, 9:23 pm</span>
           </li>
           <li class="d-flex justify-content-between align-items-start mb-2">
            <span>Invoice <strong class="text-primary">#DER-45645</strong> status has changed from
             <span class="badge badge-in-progress">In Progress</span> to
             <span class="badge badge-in-transit">In Transit</span>
            </span>
            <span class="text-muted">10 Nov 2025, 6:05 pm</span>
           </li>
           <li class="d-flex justify-content-between align-items-start mb-2">
            <span><strong>Max Smith</strong> has made payment to <strong class="text-primary">#SDK-45670</strong></span>
            <span class="text-muted">15 Apr 2025, 5:30 pm</span>
           </li>
           <li class="d-flex justify-content-between align-items-start mb-2">
            <span>Invoice <strong class="text-primary">#WER-45670</strong> is
             <span class="badge badge-in-progress">In Progress</span>
            </span>
            <span class="text-muted">10 Nov 2025, 10:10 pm</span>
           </li>
          </ul>
         </div>
        </div>
       </div>



       <div class="modal fade" id="creditBalanceModal" tabindex="-1" aria-labelledby="adjustBalanceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
         <div class="modal-content">
          <div class="modal-header">
           <h5 class="modal-title" id="adjustBalanceModalLabel">Adjust Balance</h5>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
           <div class="row g-2 mb-3">
            <div class="col-12">
             <div class="border p-3 rounded text-center">
              <p class="text-muted small mb-1">Current Balance</p>
              <p class="fs-5 fw-semibold">PHP <?= number_format($credit_information['available_credit'], 2) ?></p>
             </div>
            </div>

           </div>
           <div class="mb-3">
            <label class="form-label">Adjustment Type <span class="text-danger">*</span></label>
            <select class="form-select">
             <option>Debit</option>
             <option>Credit</option>
            </select>
           </div>
           <div class="mb-3">
            <label class="form-label">Amount <span class="text-danger">*</span></label>
            <input type="number" class="form-control" placeholder="Enter amount">
           </div>
           <div class="mb-3">
            <label class="form-label">Add adjustment note</label>
            <textarea class="form-control" rows="3"></textarea>
           </div>
           <p class="text-muted small">
            Please be aware that all manual balance changes will be audited by the financial team every fortnight.
            Please maintain your invoices and receipts until then. Thank you.
           </p>
          </div>
          <div class="modal-footer">
           <button type="button" class="btn btn-light" data-bs-dismiss="modal">Discard</button>
           <button type="button" class="btn btn-primary">Submit</button>
          </div>
         </div>
        </div>
       </div>


      </div>
      <div class="content-backdrop fade"></div>
     </div>
    </div>
   </div>

   <!-- Overlay -->
   <div class="layout-overlay layout-menu-toggle"></div>

   <!-- Drag Target Area To SlideIn Menu On Small Screens -->
   <div class="drag-target"></div>
  </div>
  <!-- / Layout wrapper -->
  <?php $this->load->view('layout/footer'); ?>
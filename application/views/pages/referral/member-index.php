<?php

$referralCode = isset($referral['code']) ? strtoupper($referral['code']) : '';



?>

<?php $this->load->view('layout/header') ?>



<!-- Layout wrapper -->

<div class="layout-wrapper layout-content-navbar">

 <div class="layout-container">

  <?php $this->load->view('layout/sidenav'); ?>

  <!-- Layout container -->

  <div class="layout-page">

   <?php $this->load->view('layout/navbar'); ?>



   <div class="container-xxl flex-grow-1 container-p-y">

    <h4 class="py-3 mb-4"><span class="text-muted fw-light">eCommerce / </span> Referrals</h4>





    <div class="row mb-4 g-4">

     <div class="col-lg-7">

      <div class="card h-100">

       <div class="card-body">

        <h5 class="mb-1">How to use</h5>

        <p class="mb-4">Integrate your referral code in 3 easy steps.</p>

        <div class="d-flex flex-column flex-sm-row justify-content-between text-center gap-3">

         <div class="d-flex flex-column align-items-center">

          <span><i

            class="bx bx-rocket text-primary bx-md p-3 border border-primary rounded-circle border-dashed mb-0"></i></span>

          <p class="mt-3 mb-2 w-75">

           You must be a CyPh Member

           (Coop Part-Owner)

          </p>

          <h5 class="text-primary mb-0">$50</h5>

         </div>

         <div class="d-flex flex-column align-items-center">

          <span><i

            class="bx bxs-user-badge text-primary bx-md p-3 border border-primary rounded-circle border-dashed mb-0"></i></span>

          <p class="mt-3 mb-2 w-75">Referred at least Four (4)

           CyPh Members

          </p>

          <h5 class="text-primary mb-0">10%</h5>

         </div>

         <div class="d-flex flex-column align-items-center">

          <span><i

            class="bx bxs-paper-plane text-primary bx-md p-3 border border-primary rounded-circle border-dashed mb-0"></i></span>

          <p class="mt-3 mb-2 w-75">Avail Goods and/or Services with an average of P3,200 a month, to unlock referral incentives in addition to rebates and dv.

          </p>

          <h5 class="text-primary mb-0">$100</h5>

         </div>

        </div>

       </div>

      </div>

     </div>



     <div class="col-lg-5">

      <div class="card h-100">

       <div class="card-body">

        <form class="d-form" onsubmit="return false">

         <div class="mb-4 mt-1">

         </div>

         <div class="referral-container">

          <!-- Referral Link Input -->

          <label for="referralLink" class="form-label">Your Referral Link</label>

          <input type="hidden" class="userId" value="<?= $this->_user_id ?>" />

          <div class=" d-flex mt-3 justify-content-center align-items-center">

           <input

            type="text"

            id="referralLink"

            name="referral_link"

            class="form-control w-100"

            placeholder="CycommPh.com/?ref=6479"

            value="<?= site_url('Register/index?ref=' . $referralCode) ?>"

            readonly />

          </div>

          <div class=" d-flex mt-3 justify-content-center align-items-center">

           <button type="button" class="btn btn-primary ms-2 mt-2 linkButton">

            <i class='bx bx-link'></i> Generate Link

           </button>

           <button type="button" class="btn btn-primary ms-2 mt-2 qrButton">

            <i class='bx bx-qr'></i> Show Qr

           </button>

          </div>



          <div class="d-flex mt-3 justify-content-center align-items-center">



           <div id="qrCodeContainer" style="display: flex; justify-content: center; align-items: center; width: 100%; margin-top: 10px;">





           </div>

          </div>



        </form>

       </div>

      </div>

     </div>

    </div>



    <!-- Referral List Table -->

    <div class="card">

     <div class="card-datatable table-responsive">

      <table class="datatables-referral table border-top" id="referralTable">

       <thead>

        <tr>

         <th></th>

         <th></th>

         <th>Users</th>

         <th class="text-nowrap">Referred ID</th>

         <th>Status</th>

         <th>Actions</th>

        </tr>

       </thead>

      </table>

     </div>

    </div>

   </div>





   <div class="modal fade" id="qrCodeModal" tabindex="-1" aria-labelledby="qrCodeModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

     <div class="modal-content">

      <div class="modal-header">

       <h5 class="modal-title" id="qrCodeModalLabel">QR Code</h5>

       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

      </div>

      <div class="modal-body">

       <div id="qrCodeContainer"></div>

       <!-- Button to trigger QR code generation -->

       <div id="qr_code_display" class="text-center align-items-center"></div>

      </div>

     </div>

    </div>

   </div>

  </div>





  <div class="drag-target"></div>

 </div>

 <!-- / Layout wrapper -->



 <!-- Core JS -->

 <!-- build:js assets/vendor/js/core.js -->



 <?php $this->load->view('layout/footer') ?>
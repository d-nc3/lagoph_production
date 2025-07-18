<?php $this->load->view('layout/header') ?>
<!-- Content -->
<div class="authentication-wrapper authentication-cover">
 <div class="authentication-inner row m-0">
  <!-- Left Text -->
  <div class="d-none d-lg-flex col-lg-4 align-items-center justify-content-end p-5 pe-0">
   <div class="w-px-400">
    <img
     src="<?= base_url('assets/img/illustrations/create-account-light.png') ?>"
     class="img-fluid"
     alt="multi-steps"
     width="600"
     data-app-dark-img="illustrations/create-account-dark.png"
     data-app-light-img="illustrations/create-account-light.png" />
   </div>
  </div>
  <!-- /Left Text -->

  <!--  Multi Steps Registration -->
  <div class="d-flex col-lg-8 align-items-center justify-content-center authentication-bg p-sm-5 p-3">
   <div class="w-px-700">
    <div id="multiStepsValidation" class="bs-stepper shadow-none">
     <div class="bs-stepper-header border-bottom-0">
      <div class="step" data-target="#accountValidation">

       <h4 class="bs-stepper-title">Verification Email Code 
        <span class="text-muted">(note that this prompt is only for testing)</span></h4>
       
        <p>Your verification code is: <strong><?=$email_code['code']?></strong></p>
       </span>
       </button>
      </div>
     </div>
    </div>
   </div>
   <!-- / Multi Steps Registration -->
  </div>
 </div>
 <?php $this->load->view('layout/footer') ?>
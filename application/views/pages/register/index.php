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
       <button type="button" class="step-trigger">
        <span class="bs-stepper-circle"><i class="bx bx-home-alt"></i></span>
        <span class="bs-stepper-label mt-1">
         <span class="bs-stepper-title">Account</span>
         <span class="bs-stepper-subtitle">Enter your account details</span>
        </span>
       </button>
      </div>
      <div class="line">
       <i class="bx bx-chevron-right"></i>
      </div>
      <div class="step" data-target="#codeValidation">
       <button type="button" class="step-trigger">
        <span class="bs-stepper-circle"><i class="bx bx-user"></i></span>
        <span class="bs-stepper-label mt-1">
         <span class="bs-stepper-title">Verify</span>
         <span class="bs-stepper-subtitle">Verify your email address</span>
        </span>
       </button>
      </div>
     </div>
     <div class="bs-stepper-content">
      <form id="multiStepsForm" onSubmit="return false">
       <input
        type="hidden"
        name="ref"
        id="ref"
        class="form-control"
        value="<?= $page_data['ref']; ?>" />
       <!-- Account Details -->
       <div id="accountValidation" class="content">
        <div class="content-header mb-3">
         <h3 class="mb-1">Account Information</h3>
         <span>Enter Your Account Details</span>
        </div>
        <div class="row g-3">
         <div class="col-sm-6 ">
          <label class="form-label" for="multiStepsPass">First name</label>
          <div class="input-group input-group-merge">
           <input
            type="text"
            id="multiStepsFirstname"
            name="multiStepsFirstname"
            class="form-control"
            placeholder="John"
            aria-describedby="usernameDesc" />

          </div>
         </div>
         <div class="col-sm-6 ">
          <label class="form-label" for="last_name">Last name</label>
          <div class="input-group input-group-merge">
           <input
            type="text"
            id="multiStepsLastname"
            name="multiStepsLastname"
            class="form-control"
            placeholder="Doe"
            aria-describedby="usernameDesc" />

          </div>
         </div>

         <div class="col-md-12">
          <label class="form-label" for="multiStepsEmail">Email</label>
          <input
           type="email"
           name="multiStepsEmail"
           id="multiStepsEmail"
           class="form-control"
           placeholder="john.doe@email.com"
           aria-label="john.doe" />
         </div>
         <div class="col-sm-6 form-password-toggle">
          <label class="form-label" for="multiStepsPass">Password</label>
          <div class="input-group input-group-merge">
           <input
            type="password"
            id="multiStepsPass"
            name="multiStepsPass"
            class="form-control"
            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
            aria-describedby="multiStepsPass2" />
           <span class="input-group-text cursor-pointer" id="multiStepsPass2"><i class="bx bx-hide"></i></span>
          </div>
         </div>
         <div class="col-sm-6 form-password-toggle">
          <label class="form-label" for="multiStepsConfirmPass">Confirm Password</label>
          <div class="input-group input-group-merge">
           <input
            type="password"
            id="multiStepsConfirmPass"
            name="multiStepsConfirmPass"
            class="form-control"
            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
            aria-describedby="multiStepsConfirmPass2" />
           <span class="input-group-text cursor-pointer" id="multiStepsConfirmPass2"><i class="bx bx-hide"></i></span>
          </div>
         </div>
         <div class="col-12 d-flex justify-content-end">
          <button class="btn btn-primary btn-next text-end">
           <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>
           <i class="bx bx-chevron-right bx-sm me-sm-n2"></i>
          </button>
         </div>
        </div>
       </div>

       <!-- Personal Info -->
       <div id="codeValidation" class="content">
        <div class="content-header mb-3">
         <h3 class="mb-1">Verification Code</h3>
         <span>Enter Email Verification Code</span>
        </div>
        <div class="row g-3">
         <div class="col-md-12">
          <label class="form-label" for="multiStepsCode">Code</label>
          <div class="input-group input-group-merge">
           <input
            type="text"
            name="multiStepsCode"
            id="multiStepsCode"
            class="form-control multi-steps-code"
            placeholder="XXXXXX"
            maxlength="6" />
           <span class="input-group-text cursor-pointer" id="multiStepsResendCode"><i
             class="bx bx-mail-send text-muted"
             data-bs-toggle="tooltip"
             data-bs-placement="top"
             title="Resend Code"></i></span>
          </div>
         </div>
         <div class="col-12 d-flex justify-content-end">
          <button type="submit" class="btn btn-success btn-next btn-submit">Submit</button>
         </div>
        </div>
       </div>
      </form>
     </div>
    </div>
   </div>
  </div>
  <!-- / Multi Steps Registration -->
 </div>
</div>
<?php $this->load->view('layout/footer') ?>
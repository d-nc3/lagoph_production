<?php $this->load->view('layout/header'); ?>
<div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">
    <?php $this->load->view('layout/sidenav'); ?>
    <div class="layout-page">
      <?php $this->load->view('layout/navbar'); ?>
      <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
          <!-- <h4 class="py-3 mb-4"><span class="text-muted fw-light">UI elements /</span> Carousel</h4> -->
          <div class="container">
            <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
              <div class="card w-100" style="max-width: 600px;">
                <div class="card-body text-center">

                  <!-- Logo Section -->
                  <div class="mb-3">
                    <img src="<?= base_url('assets/img/branding/logo.png') ?>" alt="Logo" class="logo" style="max-width: 150px;">
                  </div>

                  <!-- Welcome Message -->
                  <h1 class="card-title mb-3">Welcome to Lago PH</h1>
                  <p class="mb-4">To get started, please click the button below to proceed with your membership application.</p>

                  <!-- Apply Button -->
                  <a href="<?= site_url('membership/form') ?>" class="btn btn-lg mb-4" style="background-color: #008080; color: white;">
                    Apply Here
                  </a>

                  <!-- Membership Process -->
                  <div class="text-start mt-4">
                    <h5 class="text-center mb-3">Membership Application Process</h5>
                    <ol class="list-group list-group-numbered">
                      <li class="list-group-item">Fill out the online membership application form</li>
                      <li class="list-group-item">Upload required documents (Valid ID, proof of billing, etc.)</li>
                      <li class="list-group-item">Pay the initial share capital contribution</li>
                      <li class="list-group-item">Wait for application review and verification</li>
                      <li class="list-group-item">Receive confirmation and member ID number</li>
                    </ol>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="content-backdrop fade"></div>
      </div>
    </div>
  </div> 
</div>
<?php $this->load->view('layout/footer'); ?>
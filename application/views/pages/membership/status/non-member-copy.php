<?php $this->load->view('layout/header'); ?>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <?php $this->load->view('layout/sidenav'); ?>
            <div class="layout-page">
                <?php $this->load->view('layout/navbar'); ?>
                
                <!-- Content wrapper -->
                <div class="content-wrapper">
                  <!-- Content -->
                  <div class="container-xxl flex-grow-1 container-p-y">
                    <!-- <h4 class="py-3 mb-4"><span class="text-muted fw-light">UI elements /</span> Carousel</h4> -->
                    <div class="container">
                      <h3 class="text-center mb-1">How to Become A Member</h3>
                      <p class="text-center mb-5 pb-3">Below are your guide on how to join our community, make sure to read each sections below. Thank you and see you soon!</p>
                      <div class="row gy-5">
                        <div class="col-lg-5">
                          <div class="text-center">
                            <img
                              src="<?=base_url('assets/img/front-pages/landing-page/faq-boy-with-logos.png')?>"
                              alt="faq boy with logos"
                              class="faq-image" />
                          </div>
                        </div>
                        <div class="col-lg-7">
                          <div class="accordion" id="accordionExample">
                            <div class="card accordion-item active">
                              <h2 class="accordion-header" id="headingOne">
                                <button
                                  type="button"
                                  class="accordion-button"
                                  data-bs-toggle="collapse"
                                  data-bs-target="#accordionOne"
                                  aria-expanded="true"
                                  aria-controls="accordionOne">
                                  <b>Step 1:</b>&nbsp;Attend Membership Webinar
                                </button>
                              </h2>

                              <div id="accordionOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                  <p>Attend the Pre-Membership Education Seminar, the seminar may be conducted via zoom, face-to-face, or a pre-recorded video</p>
                                  <a href="<?=site_url('Membership/schedules')?>" class="btn btn-label-primary d-grid w-100" >Check Seminar Schedule</a>
                                </div>
                              </div>
                            </div>
                            <div class="card accordion-item">
                              <h2 class="accordion-header" id="headingTwo">
                                <button
                                  type="button"
                                  class="accordion-button collapsed"
                                  data-bs-toggle="collapse"
                                  data-bs-target="#accordionTwo"
                                  aria-expanded="false"
                                  aria-controls="accordionTwo">
                                  <b>Step 2:</b>&nbsp;Agree to the membership terms and conditions
                                </button>
                              </h2>
                              <div
                                id="accordionTwo"
                                class="accordion-collapse collapse"
                                aria-labelledby="headingTwo"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                <p>Please fill out the one-time Membership Sworn Statement of Php 500.00. This statement confirms your commitment to the membership process and covers the initial overhead costs related to the processing of membership applications and administrative expenses.</p> <p>Once you have completed the sworn statement, be sure to download or take a screenshot of the document for your records. The sworn statement must be submitted along with your membership application as proof of your commitment.</p> <p>If you require further assistance, please don't hesitate to contact our support team.</p>
                              
                                  <a href="<?=site_url('Invoice_membership/index')?>" class="btn btn-label-primary d-grid w-100"> Access Statement here</a>
                                </div>
                              </div>
                            </div>
                            <div class="card accordion-item">
                              <h2 class="accordion-header" id="headingThree">
                                <button
                                  type="button"
                                  class="accordion-button collapsed"
                                  data-bs-toggle="collapse"
                                  data-bs-target="#accordionThree"
                                  aria-expanded="false"
                                  aria-controls="accordionThree">
                                  <b>Step 3:</b>&nbsp;Agree to the contribution terms and agreement.
                                </button>
                              </h2>
                              <div
                                id="accordionThree"
                                class="accordion-collapse collapse"
                                aria-labelledby="headingThree"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                  <p>Pay the initial Shared Capital Fee of atleast Php 1,000.00. Don't forget to download or take a screenshot of the receipt.</p>
                                    
                                  <a href="<?=site_url("Invoice_capital_contribution/index")?>" class="btn btn-label-primary d-grid w-100"  >Generate Quotation here</a>
                                </div>
                              </div>
                            </div>
                            <div class="card accordion-item">
                              <h2 class="accordion-header" id="headingFour">
                                <button
                                  type="button"
                                  class="accordion-button collapsed"
                                  data-bs-toggle="collapse"
                                  data-bs-target="#accordionFour"
                                  aria-expanded="false"
                                  aria-controls="accordionFour">
                                  <b>Step 4:</b>&nbsp;Fill-up the Information Sheet
                                </button>
                              </h2>
                              <div
                                id="accordionFour"
                                class="accordion-collapse collapse"
                                aria-labelledby="headingFour"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                  <p>Please fill-up our Infromation Sheet. Don't skip the required fields, and upload the required file attachments accordingly.</p>
                                  <a href="<?=site_url('Membership/form')?>" class="btn btn-primary d-grid w-100" >Click here to start!</a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                  </div>
                  <!-- / Content -->

                  <!-- Footer -->
                  <footer class="content-footer footer bg-footer-theme">
                    <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                      <div class="mb-2 mb-md-0">
                        ©
                        <script>
                          document.write(new Date().getFullYear());
                        </script>
                        , made with ❤️ by
                        <a href="https://themeselection.com"  class="footer-link fw-medium">ThemeSelection</a>
                      </div>
                      <div class="d-none d-lg-inline-block">
                        <a href="https://themeselection.com/license/" class="footer-link me-4" >License</a>
                        <a href="https://themeselection.com/"  class="footer-link me-4">More Themes</a>

                        <a
                          href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/documentation/"
                          
                          class="footer-link me-4"
                          >Documentation</a
                        >

                        <a
                          href="https://themeselection.com/support/"
                          
                          class="footer-link d-none d-sm-inline-block"
                          >Support</a
                        >
                      </div>
                    </div>
                  </footer>
                  <!-- / Footer -->

                  <div class="content-backdrop fade"></div>
                </div>
  
            </div>
        </div>
    </div>
<?php $this->load->view('layout/footer'); ?>
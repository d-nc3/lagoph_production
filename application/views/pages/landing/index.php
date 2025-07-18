  <?php $this->load->view('layout/landing_header'); ?>

  <?php $this->load->view('layout/landing-navbar'); ?>



  <div id="landingHero" class="section-py landing-hero position-relative mb-10">

    <section id="hero-animation">

      <div class="container">

        <div class="container py-5">

          <div class="row align-items-center">

            <div class="col-md-6 text-center mb-md-0" style="margin-top: 50px;">

              <img src="assets/img/landing/illustration.png" alt="Illustration" class="img-fluid" style="max-width: 100%;" />

            </div>

            <div class="col-md-6">

              <h1 class="text-primary hero-title display-4 fw-bold"> <br />Creating and Achieving Dreams Together</h1>

              <h2 class="hero-sub-title h6 mb-2 pb-1">

                Start your cooperatives journey with us<br class="d-none d-lg-block" />

              </h2>

              <div class="landing-hero-btn d-inline-block position-relative">

                <a href="<?=site_url('Landing/membership')?>" class="btn btn-primary">Read More</a>

              </div>

            </div>

          </div>

        </div>

      </div>

    </section>

  </div>

  <div class="landing-hero-blank"></div>

  </section>

  <section id="coopServices" class="section-py landing-features">

    <div class="container">

      <h1></h1>

      <div class="text-center  pb-1">

        <h1>Our Services</h1>

      </div>

      <h3 class="text-center mb-1">Empowering Members Through Inclusive Financial Services</h3>

      <p class="text-center mb-3 mb-md-5 pb-3">

        We offer a variety of services designed to uplift our members and support community growth.

      </p>

      <div class="row gy-4">

        <!-- Savings & Deposits -->

        <div class="col-lg-4 col-sm-6">

          <div class=" custom-card h-100 text-center p-4">

            <div class="display-4 text-primary mb-3"> <img

                src="assets/img/landing/loan.png"

                alt="nav item col image"

                class="w-10" /></div>

            <h5 class="card-title">Savings Program</h5>

            <p class="card-text">Secure and accessible savings programs tailored for every member’s need.</p>
            <p class="card-text">Regularly save a portion of your income for future needs. Grow your savings while you support, promote, and make use of your Cooperative’s products and services.</p>


          </div>

        </div>



        <!-- Loan Services -->

        <div class="col-lg-4 col-sm-6">

          <div class=" h-100 text-center p-4">

            <div class="display-4 text-primary mb-3"> <img

                src="assets/img/landing/person-money.png"

                alt="nav item col image"

                class="w-10" /></div>

            <h5 class="card-title">Loan Services</h5>

            <p class="card-text">Affordable and flexible loan options to support personal, business, or emergency needs.</p>
        <p class="card-text">Avail <b>PERSONAL LOAN </b>for various purposes such as to finance a holiday vacation, buy home appliance, purchase electronic device, or pay for emergency medical bills and other essentials.</p>
        <p class="card-text">Apply for <b>MULTIPURPOSE LOAN</b> to fund important projects such as home renovation, small business venture, and other meaningful initiatives.</p></p>


          </div>

        </div>



        <!-- Membership Programs -->

        <div class="col-lg-4 col-sm-6">

          <div class=" h-100 text-center p-4">

            <div class="display-4 text-primary mb-3"> <img

                src="assets/img/landing/car-money.png"

                alt="nav item col image"

                class="w-10" /></div>

            <h5 class="card-title">Personal Line Of Credit</h5>

            <p class="card-text">A readily available cash that members can use for daily necessities.
            </p>
             <p class="card-text">Access your Credit Line for basic needs such as food, groceries, household supplies, utility bills, and other recurring expenses.
            </p>




          </div>

        </div>

        <div class="d-flex justify-content-center">

          <a class="btn btn-landing w-20 text-center"href="<?= site_url('Landing/membership') ?>">View More</a>

        </div>



      </div>

    </div>

  </section>

  <section id="landingContact" class="section-py  landing-contact">

    <div class="container">

      <div class="text-center mb-3 pb-1">

        <h1>Contact us</h1>

      </div>

      <h3 class="text-center mb-1">Let's work together</h3>

      <p class="text-center mb-4 mb-lg-5 pb-md-3">Any question or remark? just write us a message</p>

      <div class="row gy-4">

        <div class="col-lg-5">

          <div class="contact-img-box position-relative border p-2 h-100">



            <img

              src="<?= site_url('assets/img/front-pages/landing-page/contact-customer-service.png') ?>"

              alt="contact customer service"

              class="contact-img w-100 scaleX-n1-rtl" />

            <div class="pt-3 px-4 pb-1">

              <div class="row gy-3 gx-md-4">

                <div class="col-md-6 col-lg-12 col-xl-6">

                  <div class="d-flex align-items-center">

                    <div class="badge bg-label-primary rounded p-2 me-2"><i class="bx bx-envelope bx-sm"></i></div>

                    <div>

                      <p class="mb-0">Email</p>

                      <h5 class="mb-0">

                        <a href="mailto:example@gmail.com" class="text-heading">example@gmail.com</a>

                      </h5>

                    </div>

                  </div>

                </div>

                <div class="col-md-6 col-lg-12 col-xl-6">

                  <div class="d-flex align-items-center">

                    <div class="badge bg-label-success rounded p-2 me-2">

                      <i class="bx bx-phone-call bx-sm"></i>

                    </div>

                    <div>

                      <p class="mb-0">Phone</p>

                      <h5 class="mb-0"><a href="tel:+1234-568-963" class="text-heading">+1234 568 963</a></h5>

                    </div>

                  </div>

                </div>

              </div>

            </div>

          </div>

        </div>

        <div class="col-lg-7">

          <div class="card">

            <div class="card-body">

              <h4 class="mb-1">Send a message</h4>

              <p class="mb-4">

                If you would like to discuss anything related to payment, account, licensing,<br

                  class="d-none d-lg-block" />

                partnerships, or have pre-sales questions, you’re at the right place.

              </p>

              <form id="email-form">

                <div class="row g-4">

                  <div class="col-md-6">

                    <label class="form-label" for="contact-form-fullname">Full Name</label>

                    <input type="text" class="form-control" name="fullName" id="contact-fullname"  placeholder="john" />

                  </div>

                  <div class="col-md-6">

                    <label class="form-label" for="contact-form-email">Email</label>

                    <input

                      type="text"

                      name="contactEmail"

                      id="contact-email"

                       class="form-control"

                      placeholder="johndoe@gmail.com" />

                  </div>

                  <div class="col-12">

                    <label class="form-label" for="contact-form-message">Message</label>

                    <textarea

                      name="contactMessage"

                      id="contact-message"

                      class="form-control"

                      rows="9"

                      placeholder="Write a message"></textarea>

                  </div>

                  <div class="col-12">

                    <button type="submit" class="btn btn-primary">Send inquiry</button>

                  </div>

                </div>

              </form>

            </div>

          </div>

        </div>

      </div>

    </div>

  </section>

  <!-- Contact Us: End -->

  </div>



  <!-- / Sections:End -->



  <?php $this->load->view('layout/footer'); ?>
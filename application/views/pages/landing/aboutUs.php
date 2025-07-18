<?php $this->load->view('layout/landing_header'); ?>
<?php $this->load->view('layout/landing-navbar'); ?>

<section id="coopServices" class="section-py landing-features">
    <div class="container mt-5">
        <h3 class="text-start mb-3">Who We Are</h3>

        <div class="row align-items-start">
            <!-- Text Content -->
            <div class="col-md-8">
                <p>
                    We are a <b>Community</b> who believes in the potential of purposeful collaboration, harnessed by
                    innovative Information and Communication Technologies, to enhance and empower people’s lives.
                </p>
                <p>
                    Location and time differences are no longer barriers to collaborative opportunities. Thus, we strive to
                    work together across space and time to establish technology-driven activities that help develop the
                    socioeconomic well-being of community members and their families.
                </p>
                <p>
                    Our shared values bind us together and define who we are as a <b>Community</b>.
                </p>

                <div style="padding-left: 1rem;">
                    <p><b><i>Solidarity</i></b> – <i>Community Spirit</i> or "<i>Bayanihan</i>" drives our passion to
                        innovate and succeed in what we do.</p>
                    <p><b><i>Care</i></b> – We care for each other’s welfare and have a heart for those who are in need.</p>
                    <p><b><i>Integrity</i></b> – We make every effort to act with fairness and honesty at all times.</p>
                </div>

                <p>
                    <b><i>LagoPH</i></b> as our community name reflects our VISION – a “Thriving Community with a strong
                    ‘Stewardship Culture’, where all members have equitable opportunities to pursue and achieve their
                    personal and family financial goals.”
                </p>

                <p>
                    The Filipino root word <i>“lago”</i> means <i>growth</i> (unlad) or <i>to thrive</i> (umunlad). For
                    us, each letter of the word “lago” represents key words in Filipino: <b>L</b> for “Lakas” (strength),
                    <b>A</b> for “Alab” (zeal), <b>G</b> for “Galing” (ingenuity), and <b>O</b> for “Oportunidad” (hope).
                    Thus, “LagoPH” is a declaration of our commitment to contribute to our Nation’s development.
                </p>
            </div>

            <!-- Image on Right -->
            <div class="col-md-4">
                <div class="contact-img-box border p-2">
                    <img src="<?= site_url('assets/img/front-pages/landing-page/contact-customer-service.png') ?>"
                        alt="Contact Customer Service"
                        class="img-fluid rounded shadow" />
                </div>
            </div>
        </div>
    </div>
</section>



<div class="container mt-5 mb-10 pb-5">
    <h3 class="text-start mb-1">Where are we going</h3>

    <!-- Image floated to right -->
    <div class="row">
         <div class="col-md-4 d-flex align-items-start">
            <img src="<?= site_url('assets/img/front-pages/landing-page/contact-customer-service.png') ?>"
                 alt="Vision Mission Illustration"
                 class="img-fluid rounded shadow-sm" />
        </div>
        <div class="col-md-8">
            <h3 class="mt-2"><b>Vision</b></h3>
            <p>
                A thriving community where all members have equitable opportunities to pursue their financial goals.
            </p>

            <h3 class="mt-2"><b>Mission</b></h3>
            <p>
                We leverage the power of cooperation and harness the potential of evolving Information and Communication
                Technologies in creating socioeconomic opportunities for community members.
            </p>

            <h3 class="mt-2"><b>Key initiatives</b></h3>
            <ul>
                <li>Create an environment where members work together in pursuing common goals that enhance one another’s socioeconomic wellbeing.</li>
                <li>Provide innovative savings, credit, and other allied services that are accessible to members and responsive to varying needs, whether on a day-by-day or long-term basis.</li>
                <li>Promote financial awareness and literacy among members.</li>
            </ul>
        </div>


    </div>
</div>


<footer class="content-footer footer bg-footer-theme">
    <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
        <div class="mb-2 mb-md-0">
            ©
            <script>

                document.write(new Date().getFullYear());

            </script>

            powered by

            <a href="https://Lagoph.co" target="_blank" class="footer-link fw-medium">LagoPh</a>

        </div>


    </div>

</footer>
<?php $this->load->view('layout/footer'); ?>
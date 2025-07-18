<?php $this->load->view('layout/header'); ?>

<div class="layout-wrapper layout-content-navbar">

    <div class="layout-container">

        <?php $this->load->view('layout/sidenav'); ?>

        <div class="layout-page">

            <?php $this->load->view('layout/navbar'); ?>

            <?php if ($this->session->userdata('user_role') == 'User'): ?>

                <?php $this->load->view('pages/dashboard/non-mem-index'); ?>

            <?php elseif ($this->session->userdata('user_role') == 'Member'): ?>

                <?php $this->load->view('pages/dashboard/member-index'); ?>

            <?php elseif ($this->session->userdata('user_role') == 'Loan Approver'): ?>

                <?php $this->load->view('pages/dashboard/employee-index'); ?>

            <?php elseif ($this->session->userdata('user_role') == 'Loan Officer'): ?>

                <?php $this->load->view('pages/dashboard/loan-officer-index'); ?>

            <?php elseif ($this->session->userdata('user_role') == 'Admin-approver'): ?>

                <?php $this->load->view('pages/dashboard/employee-index'); ?>

            <?php elseif ($this->session->userdata('user_role') == 'Member Officer'): ?>

                <?php $this->load->view('pages/dashboard/member-officer-index'); ?>

            <?php elseif ($this->session->userdata('user_role') == 'Coop Manager'): ?>

                <?php $this->load->view('pages/dashboard/manager-index'); ?>

            <?php elseif ($this->session->userdata('user_role') == 'Cashier'): ?>

                <?php $this->load->view('pages/dashboard/cashier-index'); ?>
            <?php else: ?>

                <?php $this->load->view('pages/dashboard/employee-index'); ?>

            <?php endif; ?>

        </div>

    </div>

</div>



<!-- Check if billing address is null -->

<?php if (empty($billing_address)): ?>

    <!-- Teal Themed Modal -->

    <div id="setupBillingModal" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="profileProgressModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content" style="border-radius: 10px;">

                <div class="modal-header"
                    style="background-color: #008080; color: white; border-top-left-radius: 10px; border-top-right-radius: 10px;">

                    <h5 class="modal-title w-100 text-white text-center" id="profileProgressModalLabel">

                        <i class="bi me-2"></i> Profile Setup

                    </h5>

                </div>

                <div class="modal-body text-center">

                    <div class="mb-3">

                        <img src="<?= base_url('assets/img/branding/logo.png') ?>" alt="Logo" class="logo" height="50"
                            width="50">

                    </div>

                    <h5 style="color: #008080;">Dear valued member!</h5>

                    <p class="text-muted">

                        In order to avail LagoPh's services, Fill out your billing information and information sheet.

                    </p>

                    <p class="fw-semibold">Thank you!</p>

                </div>

                <div class="modal-footer justify-content-center">

                    <a href="<?= site_url('Settings/Billing') ?>" class="btn btn-lg"
                        style="background-color: #008080; color: white;">

                        Go to Profile Billing

                    </a>

                </div>

            </div>

        </div>

    </div>



    </div>

<?php endif; ?>



<?php $this->load->view('layout/footer'); ?>
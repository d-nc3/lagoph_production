<?php



$all_users = $all_users ?? 0;

$paid_users = $paid_users ?? 0;

$total_payments = $total_payments ?? 0;

$total_pending_collection = $total_pending_collection ?? 0;

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



            <!-- Content -->



            <div class="container-xxl flex-grow-1 container-p-y">

                <h4 class="py-3 mb-4"><span class="text-muted fw-light">Transactions/</span> Billings</h4>



                <div class="card mb-4">

                    <div class="card-widget-separator-wrapper">

                        <div class="card-body card-widget-separator">

                            <div class="row gy-4 gy-sm-1">

                                <div class="col-sm-6 col-lg-3">

                                    <div
                                        class="d-flex justify-content-between align-items-start card-widget-1 border-end pb-3 pb-sm-0">

                                        <div>

                                            <h3 class="mb-1"><?= $all_users ?></h3>

                                            <p class="mb-0">Clients</p>

                                        </div>

                                        <div class="avatar me-sm-4">

                                            <span class="avatar-initial rounded bg-label-secondary">

                                                <i class="bx bx-user bx-sm"></i>

                                            </span>

                                        </div>

                                    </div>

                                    <hr class="d-none d-sm-block d-lg-none me-4" />

                                </div>

                                <div class="col-sm-6 col-lg-3">

                                    <div
                                        class="d-flex justify-content-between align-items-start card-widget-2 border-end pb-3 pb-sm-0">

                                        <div>

                                            <h3 class="mb-1"><?= $paid_users ?> </h3>

                                            <p class="mb-0">Paid Transactions</p>

                                        </div>

                                        <div class="avatar me-lg-4">

                                            <span class="avatar-initial rounded bg-label-secondary">

                                                <i class="bx bx-file bx-sm"></i>

                                            </span>

                                        </div>

                                    </div>

                                    <hr class="d-none d-sm-block d-lg-none" />

                                </div>

                                <div class="col-sm-6 col-lg-3">

                                    <div
                                        class="d-flex justify-content-between align-items-start border-end pb-3 pb-sm-0 card-widget-3">

                                        <div>

                                            <h3 class="mb-1">₱ <?= number_format($total_payments, 2) ?></h3>

                                            <p class="mb-0">Total Collection</p>

                                        </div>

                                        <div class="avatar me-sm-4">

                                            <span class="avatar-initial rounded bg-label-secondary">

                                                <i class="bx bx-check-double bx-sm"></i>

                                            </span>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-sm-6 col-lg-3">

                                    <div class="d-flex justify-content-between align-items-start">

                                        <div>

                                            <h3 class="mb-1">₱<?= number_format($total_pending_collection, 2) ?></h3>

                                            <p class="mb-0">Total pending collection</p>

                                        </div>

                                        <div class="avatar">

                                            <span class="avatar-initial rounded bg-label-secondary">

                                                <i class="bx bx-error-circle bx-sm"></i>

                                            </span>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- Invoice List Table -->

                <div class="card">



                    <div class="card-datatable table-responsive">

                        <table class="datatables-user table border-top">
                            <thead>
                                <div class="container p-4">
                                    <div class="row g-2">
                                        <div class="col-md-4">
                                            <select class="form-select" id="status-filter">
                                                <option value="">Select Status</option>
                                                <option value="payment-initiated">Payment Initiated</option>
                                                <option value="completed">Completed</option>
                                            </select>
                                        </div>


                                    </div>
                                </div>

                                <tr>

                                    <th></th>

                                    <th>Name of user</th>

                                    <th>Date Issued</th>

                                    <th>Status</th>

                                    <th>Actions</th>

                                </tr>

                            </thead>

                        </table>

                    </div>

                </div>





                <div class="content-backdrop fade"></div>

            </div>

            <!--/ Content wrapper -->

        </div>

        <?php $this->load->view('layout/footer'); ?>
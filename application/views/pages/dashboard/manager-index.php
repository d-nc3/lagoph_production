<?php



$user_email = $this->session->userdata('user_email') ?? '';

$first_name = $this->session->userdata('first_name') ?? '';

$last_name = $this->session->userdata('last_name') ?? '';

$user_role = $this->session->userdata('user_role') ?? '';

$loan_count = $loan_count ?? NULL;

$date = date('Y-m-d');

$referral_count = $referral_count ?? NULL;

$pending_payments = $pending_payments ?? NULL;

$outstanding_balance = $contributions['outstanding_balance'] ?? 0;

$available_credit = $member_balance['available_credit'] ?? "No Data";

$no_of_shares = $contributions['number_of_shares'] ?? 0;

$total_amount_of_share = $contributions['subscribed_amount'] ?? 0;

$paid_up_share = max($total_amount_of_share - $outstanding_balance, 0);

$total_withdrawals = $member_balance['total_withdrawals'] ?? 0;

$total_loans = $member_balance['total_outstanding_loans'] ?? 0;

$loan_count = $loan_counts ?? 0;

$completed_transactions = $completed_transactions ?? 0;

$total_contributions = $all_contributions ?? 0;



?>



<?php $this->load->view('layout/header'); ?>



<div class="layout-container">



 <div class="layout-page">





   <div class="container-xxl flex-grow-1 container-p-y">

    <h4 class="py-3 mb-4">Welcome back, <?= $first_name ?> <?= $last_name ?> 👋🏻</h4>

    <div class="container-fluid">

   <div class="row mb-4">
  <div class="col-sm-6 col-xl-4">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-start justify-content-between">
          <div class="content-left">
            <span>Total Contributions</span>
            <div class="d-flex align-items-end mt-2">
              <h4 class="mb-0 me-2"><?= $total_contributions ?></h4>
              <small class="text-success">(+29%)</small>
            </div>
            <p class="mb-0">Pending Approval</p>
          </div>
          <div class="avatar">
            <span class="avatar-initial rounded bg-label-primary">
              <i class="bx bx-user bx-sm"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-sm-6 col-xl-4">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-start justify-content-between">
          <div class="content-left">
            <span>Pending Payments</span>
            <div class="d-flex align-items-end mt-2">
              <h4 class="mb-0 me-2"><?= $pending_payments ?></h4>
              <small class="text-success">(+18%)</small>
            </div>
            <p class="mb-0">Last week analytics</p>
          </div>
          <div class="avatar">
            <span class="avatar-initial rounded bg-label-danger">
              <i class="bx bx-user-check bx-sm"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-sm-6 col-xl-4">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-start justify-content-between">
          <div class="content-left">
            <span>Total Transactions</span>
            <div class="d-flex align-items-end mt-2">
              <h4 class="mb-0 me-2"><?= $completed_transactions ?></h4>
              <small class="text-success">(+42%)</small>
            </div>
            <p class="mb-0">Last week analytics</p>
          </div>
          <div class="avatar">
            <span class="avatar-initial rounded bg-label-warning">
              <i class="bx bx-user-voice bx-sm"></i>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



     <div class="row mt-4">

      <!-- Pending Invoice Approval -->

      <div class="col-lg-8 col-md-6">

       <div class="card">

        <div class="card-header border-bottom">

         <h5 class="card-title">Pending Invoice Approval</h5>

        </div>

        <div class="card-datatable table-responsive">

         <table class="datatables-transactions table border-top">

          <thead>

           <tr>

            <th>Name</th>

            <th>Date Issued</th>

            <th>Status</th>

            <th>Invoice Type</th>

            <th>Actions</th>

           </tr>

          </thead>

         </table>

        </div>

       </div>

      </div>



      <!-- Reasons for Delivery Exceptions -->

      <div class="col-lg-4 col-md-6">

       <div class="card h-100">

        <div class="card-header d-flex align-items-center justify-content-between">

         <h5 class="m-0 me-2">Reasons for Delivery Exceptions</h5>

         <div class="dropdown">

          <button

           class="btn p-0"

           type="button"

           id="deliveryExceptions"

           data-bs-toggle="dropdown"

           aria-haspopup="true"

           aria-expanded="false">

           <i class="bx bx-dots-vertical-rounded"></i>

          </button>

          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="deliveryExceptions">

           <a class="dropdown-item" href="javascript:void(0);">Select All</a>

           <a class="dropdown-item" href="javascript:void(0);">Refresh</a>

           <a class="dropdown-item" href="javascript:void(0);">Share</a>

          </div>

         </div>

        </div>

        <div class="card-body">

         <div id="deliveryExceptionsChart"></div>

        </div>

       </div>

      </div>

     </div>

    </div> <!-- End Container -->

   </div> <!-- End Layout Page -->

  </div> <!-- End Layout Container -->

 </div> <!-- End Layout Wrapper -->
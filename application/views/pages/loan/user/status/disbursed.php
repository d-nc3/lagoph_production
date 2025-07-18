<?php
$first_name =  $this->session->userdata('first_name') ? $this->session->userdata('first_name') : '';
$last_name = $this->session->userdata('last_name') ? $this->session->userdata('last_name') : '';
$email = $this->session->userdata('user_email') ? $this->session->userdata('user_email') : '';
$outstanding_balance = isset($info['loan_amount']) ? $info['loan_amount'] : NULL;
$balance = isset($info['remaining_balance']) ? $info['remaining_balance'] : NULL; // revise
$billing_address = isset($billing_info['street_address']) ? $billing_info['street_address'] : NULL;
$billing_number = isset($billing_info['mobile_number']) ? $billing_info['mobile_number'] : NULL;
$account_name = isset($financial_info['account_name']) ? $financial_info['account_name'] : NULL;
$account_number = isset($financial_info['account_number']) ? $financial_info['account_number'] : NULL;
$account_type = isset($financial_info['account_type']) ? $financial_info['account_type'] : NULL;

?>

<?php $this->load->view('layout/header'); ?>
<div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">
    <?php $this->load->view('layout/sidenav'); ?>
    <div class="layout-page">
      <?php $this->load->view('layout/navbar'); ?>

<div class="container-xxl flex-grow-1 container-p-y">
 <h4 class="py-3 mb-4"><span class="text-muted fw-light">Loan /</span> Loan Payments</h4>

 <div class="row">
  <div class="col-12 col-lg-8">
   <div class="card mb-4">
    <div class="card-header">
     <h5 class="card-title">Loan Payments</h5>
     <div class="row">
      <!-- Outstanding Balance -->
      <div class="col-md-4">
       <div>Loan Amount: </div>
       <div class="fs-5 text-primary"> ₱ <?= $balance ?></div>
      </div>

      <div class="col-md-4">
       <div>Next Payment Due: </div>
       <?php foreach ($payment_schedule as $payment) {
        $due_info = get_payment_due($payment); // Call helper function
        if ($due_info) {
         echo $due_info;
         break;
        }
       }
       ?>
      </div>
      <div class="col-md-4">
       <div>Important Notes: </div>
       <div class="fs-6 badge bg-warning">Pay on time</div>
      </div>
     </div>
    </div>

   </div>

   <div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
     <h5 class="card-title m-0">Loan Repayment Schedule </h5>
    </div>

    <div class="col-md-4 p-3">
     <select
      id="filter-status-id"
      class="select2-filters form-select"
      data-allow-clear="true">
      <option value="">Select Status</option> <!-- Default empty option -->
      <option value="paid">Paid</option>
      <option value="pending">Pending</option>
     </select>
   </div>



    <div class="card-datatable table-responsive">
     <table class="datatables-loan table">
      <thead>
       <tr>
        <th></th>
        <th></th>
        <th class="w-30">Due date</th>
        <th class="w-35">Amount due</th>
        <th class="w-25">Status</th>
        <th class="w-25">Actions</th>
       </tr>
      </thead>
     </table>
    </div>
   </div>
  </div>

  <!-- / Content -->

  <div class="col-12 col-lg-4">
   <div class="card mb-4">
    <div class="card-header">
     <h6 class="card-title m-0">Member details</h6>
    </div>

    <div class="card-body">

     <div class="d-flex justify-content-start align-items-center mb-4">

      <div class="avatar me-2">

       <img src="assets/img/avatars/1.png" alt="Avatar" class="rounded-circle" />

      </div>

      <div class="d-flex flex-column">

       <a href="app-user-view-account.html" class="text-body text-nowrap">

        <h6 class="mb-0"> <?= $first_name ?> <?= $last_name ?></h6>

       </a>

      </div>

     </div>



     <div class="d-flex justify-content-start align-items-center mb-4">
      <span
       class="avatar rounded-circle bg-label-success me-2 d-flex align-items-center justify-content-center"><i class="bx bx-cart-alt bx-sm lh-sm"></i></span>
      <h6 class="text-body text-nowrap mb-0">12 Orders</h6>
     </div>
     <div class="d-flex justify-content-between">
      <h6>Contact info</h6>
     </div>
     <p class="mb-1">Email: <?= $email ?></p>
     <p class="mb-0">Mobile: +1 (609) 972-22-22</p>
    </div>
   </div>



   <div class="card mb-4">
    <div class="card-header d-flex justify-content-between">
     <h6 class="card-title m-0">Billing address</h6>
     <h6 class="m-0">
      <a href=" javascript:void(0)" data-bs-toggle="modal" data-bs-target="#addNewAddress">Edit</a>
     </h6>
    </div>

    <div class="card-body">
     <p class="text-wrap"><?= $billing_address ?></p>
     <p class="text-wrap"><?= $billing_number ?></p>
     <h6 class="mb-0 pb-2">Financial Transactions</h6>
     <p class="mb-0 b-2">Card Holder Name: <?= $account_name ?></p>
     <p class="mb-0">Card Number: <?= $account_number ?></p>
     <p class="mb-0">Account Type: <?= $account_type ?></p>
    </div>
   </div>
   <div class="d-grid col-lg-10 mx-auto mb-4">
   </div>
  </div>
 </div>
 
<?php $this->load->view('layout/footer'); ?>
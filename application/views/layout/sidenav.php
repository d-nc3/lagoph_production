<?php

$CI = &get_instance();
$CI->load->model('billing_address_model', 'M_billing_address');
$user_id = $this->session->userdata('user_id');
$billing_address = $CI->M_billing_address->get($user_id);
?>
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
   <div class="app-brand demo">
      <a href="index.html" class="app-brand-link">
         <span class="app-brand-logo demo">
            <span class="app-brand-logo demo">
               <img src="<?= base_url('assets/img/branding/logo.png') ?>" alt="Logo" class="logo" width="25" height="25">
            </span>
         </span>
         <span class="app-brand-text demo menu-text fw-bold ms-2">LagoPH</span>
      </a>
      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
         <i class="bx bx-chevron-left bx-sm align-middle"></i>
      </a>
   </div>
   <div class="menu-inner-shadow"></div>
   <ul class="menu-inner py-1">
      <?php if (!empty($billing_address)): ?>
         <?php if ($this->session->userdata('user_role') == 'User'): ?>
            <?php $this->load->view('layout/sidenav/nav-user'); ?>
         <?php elseif ($this->session->userdata('user_role') == 'Member'): ?>
            <?php $this->load->view('layout/sidenav/nav-member'); ?>
         <?php elseif ($this->session->userdata('user_role') == 'Admin-approver'): ?>
            <?php $this->load->view('layout/sidenav/nav-approver'); ?>
         <?php elseif ($this->session->userdata('user_role') == 'Loan Approver'): ?>
            <?php $this->load->view('layout/sidenav/nav-approver'); ?>
         <?php elseif ($this->session->userdata('user_role') == 'Member Officer'): ?>
            <?php $this->load->view('layout/sidenav/nav-member-officer'); ?>
         <?php elseif ($this->session->userdata('user_role') == 'Loan Officer'): ?>
            <?php $this->load->view('layout/sidenav/nav-loan-officer'); ?>
         <?php elseif ($this->session->userdata('user_role') == 'Cashier'): ?>
            <?php $this->load->view('layout/sidenav/nav-cashier'); ?>
         <?php elseif ($this->session->userdata('user_role') == 'Coop Manager'): ?>
            <?php $this->load->view('layout/sidenav/nav-manager'); ?>
         <?php endif; ?>
      <?php else: ?>
      <?php endif; ?>
   </ul>
</aside>

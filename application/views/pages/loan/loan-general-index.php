<?php $this->load->view('layout/header'); ?>
<div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">
    <?php $this->load->view('layout/sidenav'); ?>
    <div class="layout-page">
      <?php $this->load->view('layout/navbar'); ?>
      <?php if (!$info): ?>
        <?php $this->load->view('pages/loan/user/status/default-index'); ?>
      <?php elseif ($info['loan_status'] == 'Pending' || $info['loan_status'] == 'Approved'): ?>
        <?php $this->load->view('pages/loan/user/status/pending'); ?>
      <?php elseif ($info['loan_status'] == 'Disbursed'): ?>
        <?php $this->load->view('pages/loan/user/status/pending'); ?>
      <?php elseif ($info['loan_status'] == 'Rejected' || $info['loan_status'] == 'Fully Paid'): ?>
        <?php $this->load->view('pages/loan/user/status/default-index'); ?>
      <?php endif; ?>
    </div>
  </div>
  <?php $this->load->view('layout/footer');
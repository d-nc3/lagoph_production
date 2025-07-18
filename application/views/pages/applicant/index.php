<?php $this->load->view('layout/header'); ?>
<div class="layout-wrapper layout-content-navbar">
 <div class="layout-container">
  <?php $this->load->view('layout/sidenav'); ?>
  <div class="layout-page">
   <?php $this->load->view('layout/navbar'); ?>
    <?php if ($this->session->userdata('user_role') == 'Member Officer'): ?>
        <?php $this->load->view('pages/applicant/member_officer/index'); ?>
        <?php elseif ($this->session->userdata('user_role') == 'Coop Manager'): ?>
            <?php $this->load->view('pages/applicant/manager/index'); ?>
   <?php endif; ?>
  </div>
 </div>
</div>
<?php $this->load->view('layout/footer'); ?>
<?php
 if($this->session->userdata('user_role') == 'User'): ?>
    <?php $this->load->view('layout/options/opt-user'); ?>
<?php elseif($this->session->userdata('user_role') == 'Member'): ?>
    <?php $this->load->view('layout/options/opt-member'); ?>
<?php elseif($this->session->userdata('user_role') == 'Admin-approver'): ?>
    <?php $this->load->view('layout/options/opt-approver'); ?>
<?php elseif($this->session->userdata('user_role') == 'Cashier'): ?>
    <?php $this->load->view('layout/options/opt-member'); ?>
<?php elseif($this->session->userdata('user_role') == 'Loan Approver'): ?>
    <?php $this->load->view('layout/options/opt-member'); ?>
<?php elseif($this->session->userdata('user_role') == 'Member Officer'): ?>
    <?php $this->load->view('layout/options/opt-approver'); ?>
<?php elseif($this->session->userdata('user_role') == 'Loan Officer'): ?>
    <?php $this->load->view('layout/options/opt-approver'); ?>
<?php elseif($this->session->userdata('user_role') == 'Coop Manager'): ?>
    <?php $this->load->view('layout/options/opt-manager'); ?>
<?php else: ?>
    <?php $this->load->view('layout/options/opt-user'); // fallback ?>
<?php endif; ?>
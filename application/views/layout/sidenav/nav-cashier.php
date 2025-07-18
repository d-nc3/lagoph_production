<!-- Dashboard -->
<li class="menu-item <?= ($page_data['system_module']) == 'Dashboard' ? 'active' : '' ?>">
 <a href="<?= site_url('Dashboard') ?>" class="menu-link">
  <i class="menu-icon tf-icons bx bx-home-circle"></i>
  <div class="text-truncate" data-i18n="Dashboard">Dashboard</div>
 </a>
</li>
<li class="menu-header small text-uppercase">
 <span class="menu-header-text" data-i18n="Cashiering Transactions">Cashiering Transactions</span>
</li>

<li class="menu-item <?= ($page_data['system_module']) == 'Billing' ? 'active open' : '' ?>">
 <a href="javascript:void(0)" class="menu-link menu-toggle">
  <i class="menu-icon tf-icons bx bx-collection"></i>
  <div class="text-truncate" data-i18n="Sales & Payment">Sales & Payment</div>
 </a>
 <ul class="menu-sub">

  <li class="menu-item <?= ($page_data['system_module']) == 'Pending Invoice' ? 'active' : '' ?>">
   <a href="<?= site_url('transactions') ?>" class="menu-link">

    <div class="text-truncate" data-i18n="General Transactions"> Transactions</div>
   </a>
  </li>



  <li class="menu-item <?= ($page_data['system_module']) == 'Pending Invoice' ? 'active' : '' ?>">
   <a href="<?= site_url('Invoices/Pending_invoice/index') ?>" class="menu-link">

    <div class="text-truncate" data-i18n="Invoice">Invoice</div>
   </a>
  </li>


 </ul>
</li>
<!-- Components -->
<!-- User interface -->
<li class="menu-item <?= ($page_data['system_module']) == 'History' ? 'active open' : '' ?>">
 <a href="javascript:void(0)" class="menu-link menu-toggle">
  <i class="menu-icon tf-icons bx bx-chart"></i>
  <div class="text-truncate" data-i18n="History">History</div>
 </a>
 <ul class="menu-sub">
  <li class="menu-item <?= ($page_data['system_module']) == 'Pending Invoice' ? 'active' : '' ?>">
   <a href="<?= site_url('transaction-history') ?>" class="menu-link">

    <div class="text-truncate" data-i18n="Transaction History"> Transaction History</div>
   </a>
  </li>

  <li class="menu-item <?= ($page_data['system_module']) == 'Sales' ? 'active' : '' ?>">
   <a href="<?= site_url('Sales') ?>" class="menu-link">

    <div class="text-truncate" data-i18n="Balance Sheet">Balance Sheet</div>
   </a>
  </li>


 </ul>
</li>

<li class="menu-header small text-uppercase">
 <span class="menu-header-text" data-i18n="Loan Transactions">Loan Transactions</span>
</li>

<li class="menu-item <?= ($page_data['system_module']) == 'Disbursment' ? 'active' : '' ?>">
   <a href="<?= site_url('loan-disbursment') ?>" class="menu-link">
   <i class="menu-icon tf-icons bx bx-wallet-alt"></i>
    <div class="text-truncate" data-i18n=" Disbursments"> Disbursments</div>
   </a>
  </li>

  <li class="menu-item <?= ($page_data['system_module']) == 'Disbursment' ? 'active' : '' ?>">
   <a href="<?= site_url('loan-repayment') ?>" class="menu-link">
   <i class='menu-icon tf-icons bx bx-coin-stack'></i>
    <div class="text-truncate" data-i18n="Repayments"> Repayments</div>
   </a>
  </li>

<!-- <li class="menu-header small text-uppercase">
 <span class="menu-header-text" data-i18n="Settings">Settings</span>
</li>



<li class="menu-item <?= ($page_data['system_module'] == 'Settings') ? 'active open' : '' ?>">
 <a href="javascript:void(0)" class="menu-link menu-toggle">
  <i class="menu-icon tf-icons bx bx-cog"></i>
  
  <div class="text-truncate" data-i18n="Settings">Settings</div>
 </a>
 <ul class="menu-sub">

  <li class="menu-item <?= ($page_data['system_module'] == 'Transaction types') ? 'active' : '' ?>">
   <a href="<?= site_url('Transaction_types/index') ?>" class="menu-link">
    <i class="menu-icon tf-icons bx bx-money"></i>
    <div class="text-truncate" data-i18n="Cash Accounts">Cash Accounts</div>
   </a>
  </li>
  <li class="menu-item <?= ($page_data['system_module'] == 'Transaction types') ? 'active' : '' ?>">
   <a href="<?= site_url('Transaction_type_cash_account/index') ?>" class="menu-link">
    <div class="text-truncate" data-i18n="Transaction types">Transaction Types</div>
   </a>
  </li>
  <li class="menu-item <?= ($page_data['system_module'] == 'NULL') ? 'active' : '' ?>">
   <a href="<?= site_url('Sales') ?>" class="menu-link">
    <div class="text-truncate" data-i18n="Discounts">Discounts</div>
   </a>
  </li>
  <li class="menu-item <?= ($page_data['system_module'] == 'NULL') ? 'active' : '' ?>">
   <a href="<?= site_url('Sales') ?>" class="menu-link">
    <div class="text-truncate" data-i18n="Sales Taxes">Sales Taxes</div>
   </a>
  </li>
  <li class="menu-item <?= ($page_data['system_module'] == 'NULL') ? 'active' : '' ?>">
   <a href="<?= site_url('Sales') ?>" class="menu-link">
    <div class="text-truncate" data-i18n="Payment Gateways">Payment Gateways</div>
   </a>
  </li>
 </ul>
</li> -->
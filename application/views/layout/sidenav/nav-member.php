<li class="menu-item <?= ($page_data['system_module']) == 'Dashboard' ? 'active' : '' ?>">
    <a href="<?= site_url('Dashboard') ?>" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div class="text-truncate" data-i18n="Dashboard">Dashboard</div>
    </a>
</li>
<!-- Loan -->
<li class="menu-header small text-uppercase">
    <span class="menu-header-text" data-i18n="Products and Services">Products and Services</span>
</li>
<li class="menu-item <?= ($page_data['system_module']) == 'Loan' ? 'active' : '' ?>">
    <a href="<?= site_url('loans') ?>" class="menu-link">
        <i class="menu-icon tf-icons bx bx-credit-card-alt"></i>
        <div class="text-truncate" data-i18n="Loan">Loan</div>
    </a>
</li>
<li class="menu-item <?= ($page_data['system_module']) == 'Capital Share' ? 'active' : '' ?>">
    <a href="<?= site_url('Capital_share') ?>" class="menu-link">
        <i class="menu-icon tf-icons bx bx-donate-heart"></i>
        <div class="text-truncate" data-i18n="Capital Share">Contribution</div>
    </a>
</li>
<li class="menu-item <?= ($page_data['system_module']) == 'Savings' ? 'active' : '' ?>">
    <a href="<?= site_url('Savings') ?>" class="menu-link">
        <i class="menu-icon tf-icons bx bx-wallet-alt"></i>
        <div class="text-truncate" data-i18n="Savings">Savings</div>
    </a>
</li>
<!-- Referral -->
<li class="menu-header small text-uppercase">
    <span class="menu-header-text" data-i18n="Referrals">Referrals</span>
</li>
<li class="menu-item <?= ($page_data['system_module']) == 'Referrals' ? 'active' : '' ?>">
    <a href="<?= site_url('Referral_member') ?>" class="menu-link">
        <i class="menu-icon tf-icons bx bx-group"></i>
        <div class="text-truncate" data-i18n="Referrals">Referrals</div>
    </a>
</li>
<li class="menu-header small text-uppercase">
    <span class="menu-header-text" data-i18n="History">History</span>
</li>
<li class="menu-item <?= ($page_data['system_module'] == 'Statements') ? 'active open' : '' ?>">
    <a href="javascript:void(0)" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-book-alt"></i>
        <div class="text-truncate" data-i18n="Statement">Statement</div>
    </a>
    <ul class="menu-sub">
        <li class="menu-item <?= ($page_data['system_module'] == 'Billing') ? 'active' : '' ?>">
            <a href="<?= site_url('Statement') ?>" class="menu-link">
                <div class="text-truncate" data-i18n="Billing History">Billing Statements</div>
            </a>
        </li>
        <li class="menu-item <?= ($page_data['system_module'] == 'Transaction types') ? 'active' : '' ?>">
            <a href="<?= site_url('Statement/payment_index') ?>" class="menu-link">
                <div class="text-truncate" data-i18n="Payment records">Payment Records</div>
            </a>
        </li>
        <li class="menu-item <?= ($page_data['system_module'] == 'Transaction types') ? 'active' : '' ?>">
            <a href="<?= site_url('Statement/payment_index') ?>" class="menu-link">
                <div class="text-truncate" data-i18n="Loan History">Loan History</div>
            </a>
        </li>
    </ul>
</li>
<li class="menu-header small text-uppercase">
    <span class="menu-header-text" data-i18n="Settings">Settings</span>
</li>
<li class="menu-item <?= ($page_data['system_module'] == 'Transaction types') ? 'active' : '' ?>">
    <a href="<?= site_url('Profile') ?>" class="menu-link">
        <i class="menu-icon tf-icons bx bx-cog"></i>
        <div class="text-truncate" data-i18n="Settings">Settings</div>
    </a>
</li>
<!-- Dashboard -->
<li class="menu-item <?= ($page_data['system_module']) == 'Dashboard' ? 'active' : '' ?>">
    <a href="<?= site_url('Dashboard') ?>" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div class="text-truncate" data-i18n="Dashboard">Dashboard</div>
    </a>
</li>

<li class="menu-header small text-uppercase">
    <span class="menu-header-text" data-i18n="Applications">Applications</span>
</li>
<li class="menu-item <?= ($page_data['system_module']) == 'Loan Approval' ? 'active' : '' ?>">
    <a href="<?= site_url('manager/loans') ?>" class="menu-link">
        <i class="menu-icon tf-icons bx bx-group"></i>
        <div class="text-truncate" data-i18n="Loan Application">Loan Application</div>
    </a>
</li>
<!-- Applicants -->
<li class="menu-item <?= ($page_data['system_module']) == 'Applicants' ? 'active' : '' ?>">
    <a href="<?= site_url('Membership/Applicant') ?>" class="menu-link">
        <i class='menu-icon tf-icons bx bx-money'></i>
        <div class="text-truncate" data-i18n="Member Applicants">Applicants</div>
    </a>
</li>


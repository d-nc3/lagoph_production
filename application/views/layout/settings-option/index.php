<ul class="nav nav-pills flex-column flex-md-row mb-3">
    <li class="menu-item">
        <a class="nav-link <?= ($page_data['system_module'] == 'Profile') ? 'active' : '' ?>" href="<?= site_url('Settings') ?>">
            <i class="bx bx-user me-1"></i> Account
        </a>
    </li>

    <li class="menu-item">
        <a class="nav-link <?= ($page_data['system_module'] == 'Billings') ? 'active' : '' ?>" href="<?= site_url('Settings/Billing') ?>">
            <i class="bx bx-detail me-1"></i> Billing & Plans
        </a>
    </li>

    <li class="menu-item">
        <a class="nav-link <?= ($page_data['system_module'] == 'Security') ? 'active' : '' ?>" href="<?= site_url('Settings/Security') ?>">
            <i class="bx bx-detail me-1"></i> Security
        </a>
    </li>
</ul>

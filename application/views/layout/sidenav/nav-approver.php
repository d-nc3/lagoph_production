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
    <a href="<?= site_url('Loan/index_admin') ?>" class="menu-link">
        <i class="menu-icon tf-icons bx bx-group"></i>
        <div class="text-truncate" data-i18n="Loan Application">Loan Application</div>
    </a>
</li>
<!-- Applicants -->
<li class="menu-item <?= ($page_data['system_module']) == 'Applicants' ? 'active' : '' ?>">
    <a href="<?= site_url('Applicant') ?>" class="menu-link">
        <i class='menu-icon tf-icons bx bx-money'></i>
        <div class="text-truncate" data-i18n="Member Applicants">Applicants</div>
    </a>
</li>

<li class="menu-header small text-uppercase">
    <span class="menu-header-text" data-i18n="Employee Relations ">Employee Relations</span>
</li>

<li class="menu-item <?= ($page_data['system_module']) == 'Employees' ? 'active' : '' ?>">
    <a href="<?= site_url('Employee') ?>" class="menu-link">
        <i class="menu-icon tf-icons bx bx-group"></i>
        <div class="text-truncate" data-i18n="Employees">Employee</div>
    </a>
</li>

<li class="menu-header small text-uppercase">
    <span class="menu-header-text" data-i18n="Admin Relations">Employee Relations</span>
</li>

<li class="menu-item <?= ($page_data['system_module']) == 'Roles and Permissions' ? 'active open' : '' ?>">
    <a href="javascript:void(0)" class="menu-link">
        <i class="menu-icon bx bx-calendar"></i>
        <div class="text-truncate" data-i18n="Events And Schedules">Post Event Schedule</div>
    </a>
</li>   

<li class="menu-item <?= ($page_data['system_module']) == 'Roles and Permissions' ? 'active open' : '' ?>">
    <a href="javascript:void(0)" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-check-shield"></i>
        <div class="text-truncate" data-i18n="Roles and Permissions">Roles and Permissions</div>
    </a>
    <ul class="menu-sub">
        <li class="menu-item <?= ($page_data['system_section']) == 'User_role' ? 'active' : '' ?>">
            <a href="<?= site_url('Role') ?>" class="menu-link">
                <div class="text-truncate" data-i18n="Roles">Roles</div>
            </a>
        </li>
        <li class="menu-item <?= ($page_data['system_section']) == 'User_permissions' ? 'active' : '' ?>">
            <a href="<?= site_url('Permissions') ?>" class="menu-link">
                <div class="text-truncate" data-i18n="Permissions">Permissions</div>
            </a>
        </li>
        <li class="menu-item <?= ($page_data['system_section']) == 'User_roles_permissions' ? 'active' : '' ?>">
            <a href="<?= site_url('User_roles_permissions') ?>" class="menu-link">
                <div class="text-truncate" data-i18n="User roles and permissions">Permissions</div>
            </a>
        </li>
        <li class="menu-item <?= ($page_data['system_section']) == 'User_roles' ? 'active' : '' ?>">
            <a href="<?= site_url('User_roles') ?>" class="menu-link">
                <div class="text-truncate" data-i18n="User roles">User Roles</div>
            </a>
        </li>
    </ul>
</li>
<!-- Components -->
<!-- User interface -->
<li class="menu-item <?= ($page_data['system_module']) == 'Settings' ? 'active open' : '' ?>">
    <a href="javascript:void(0)" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-cog"></i>
        <div class="text-truncate" data-i18n="Designations">Settings</div>
    </a>
    <ul class="menu-sub">
        <li class="menu-item <?= ($page_data['system_section']) == 'Departments' ? 'active' : '' ?>">
            <a href="<?= site_url('Department') ?>" class="menu-link">
                <div class="text-truncate" data-i18n="Departments">Departments</div>
            </a>
        </li>
        <li class="menu-item <?= ($page_data['system_section']) == 'Units' ? 'active' : '' ?>">
            <a href="<?= site_url('Unit') ?>" class="menu-link">
                <div class="text-truncate" data-i18n="Units">Units</div>
            </a>
        </li>
        <li class="menu-item <?= ($page_data['system_section']) == 'Positions' ? 'active' : '' ?>">
            <a href="<?= site_url('Position') ?>" class="menu-link">
                <div class="text-truncate" data-i18n="Positions">Positions</div>
            </a>
        </li>



    </ul>
</li>
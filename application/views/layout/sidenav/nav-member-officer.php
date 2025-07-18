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



<!-- Applicants -->

<li class="menu-item <?= ($page_data['system_module']) == 'Applicants' ? 'active' : '' ?>">

 <a href="<?= site_url('Membership/Applicant') ?>" class="menu-link">

  <i class='menu-icon tf-icons bx bx-group'></i>

  <div class="text-truncate" data-i18n="Member Applicants">Applicants</div>

 </a>

</li>



<li class="menu-header small text-uppercase">

 <span class="menu-header-text" data-i18n="Employee Relations ">Employee Relations</span>

</li>



<li class="menu-item <?= ($page_data['system_module']) == 'Member' ? 'active' : '' ?>">

 <a href="<?= site_url('Admin/Member') ?>" class="menu-link">

  <i class="menu-icon tf-icons bx bx-group"></i>

  <div class="text-truncate" data-i18n="Member List">Member</div>

 </a>

</li>

<li class="menu-item <?= ($page_data['system_module']) == 'Roles and Permissions' ? 'active open' : '' ?>">

 <a href="javascript:void(0)" class="menu-link">

  <i class="menu-icon bx bxs-file-doc"></i>

  <div class="text-truncate" data-i18n="Documents">Documents</div>

 </a>

</li>



<li class="menu-item <?= ($page_data['system_module']) == 'Member' ? 'active open' : '' ?>">

 <a href="<?= site_url('Event-scheduling') ?>" class="menu-link">

  <i class="menu-icon bx bx-calendar"></i>

  <div class="text-truncate" data-i18n="Events & Schedules">Post Event Schedule</div>

 </a>

</li>



<li class="menu-item <?= ($page_data['system_module']) == 'Roles and Permissions' ? 'active open' : '' ?>">

    <a href="javascript:void(0)" class="menu-link menu-toggle">

        <i class="menu-icon tf-icons bx bx-check-shield"></i>

        <div class="text-truncate" data-i18n="Roles and Permissions">Roles and Permissions</div>

    </a>

    <ul class="menu-sub">

        <li class="menu-item <?= ($page_data['system_section']) == 'User_role' ? 'active' : '' ?>">

            <a href="<?= site_url('Admin/Role') ?>" class="menu-link">

                <div class="text-truncate" data-i18n="Roles">Roles</div>

            </a>

        </li>

        <li class="menu-item <?= ($page_data['system_section']) == 'User_permissions' ? 'active' : '' ?>">

            <a href="<?= site_url('Admin/Permissions') ?>" class="menu-link">

                <div class="text-truncate" data-i18n="Permissions">Permissions</div>

            </a>

        </li>

        <li class="menu-item <?= ($page_data['system_section']) == 'User_roles_permissions' ? 'active' : '' ?>">

            <a href="<?= site_url('Admin/User_roles_permissions') ?>" class="menu-link">

                <div class="text-truncate" data-i18n="User roles and permissions">Permissions</div>

            </a>

        </li>

        <li class="menu-item <?= ($page_data['system_section']) == 'User_roles' ? 'active' : '' ?>">

            <a href="<?= site_url('Admin/User_roles') ?>" class="menu-link">

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

            <a href="<?= site_url('Admin/Department') ?>" class="menu-link">

                <div class="text-truncate" data-i18n="Departments">Departments</div>

            </a>

        </li>

        <li class="menu-item <?= ($page_data['system_section']) == 'Units' ? 'active' : '' ?>">

            <a href="<?= site_url('Admin/Unit') ?>" class="menu-link">

                <div class="text-truncate" data-i18n="Units">Units</div>

            </a>

        </li>

        <li class="menu-item <?= ($page_data['system_section']) == 'Positions' ? 'active' : '' ?>">

            <a href="<?= site_url('Admin/Position') ?>" class="menu-link">

                <div class="text-truncate" data-i18n="Positions">Positions</div>

            </a>

        </li>







    </ul>

</li>


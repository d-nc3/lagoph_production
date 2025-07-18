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

    <a href="<?= site_url('Loan/admin') ?>" class="menu-link">

        <i class='menu-icon tf-icons bx bx-group'></i>

        <div class="text-truncate" data-i18n="Loan Applicants">Applicants</div>

    </a>

</li>



<li class="menu-header small text-uppercase">

    <span class="menu-header-text" data-i18n="Employee Relations ">Employee Relations</span>

</li>


<!-- 
<li class="menu-item <?= ($page_data['system_module']) == 'Member' ? 'active' : '' ?>">

    <a href="<?= site_url('Loan/Member_list') ?>" class="menu-link">

        <i class="menu-icon tf-icons bx bx-group"></i>

        <div class="text-truncate" data-i18n="Active Loans List">Member</div>

    </a>

</li>

<li class="menu-item <?= ($page_data['system_module']) == 'Roles and Permissions' ? 'active open' : '' ?>">

    <a href="javascript:void(0)" class="menu-link">

        <i class="menu-icon bx bxs-file-doc"></i>

        <div class="text-truncate" data-i18n="Total Loan list">Documents</div>

    </a>

</li>    -->


<!-- 
<li class="menu-item <?= ($page_data['system_module']) == 'Roles and Permissions' ? 'active open' : '' ?>">

    <a href="javascript:void(0)" class="menu-link">

        <i class="menu-icon bx bx-calendar"></i>

        <div class="text-truncate" data-i18n="Events And Schedules">Post Event Schedule</div>

    </a>

</li>   
 -->





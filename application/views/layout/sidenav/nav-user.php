
<?php
    $system_module = isset($page_data['system_module']) && $page_data['system_module'] ? $page_data['system_module'] : '';
    $system_section = isset($page_data['system_section']) && $page_data['system_section'] ? $page_data['system_section'] : '';
?>

<!-- Dashboard -->
<li class="menu-item <?=$system_module == 'Dashboard' ? 'active' : ''?>">
    <a href="<?=site_url('Dashboard')?>" class="menu-link">
    <i class="menu-icon tf-icons bx bx-home-circle"></i>
    <div class="text-truncate" data-i18n="Dashboard">Dashboard</div>
    </a>
</li>
<li class="menu-item <?=$system_module == 'Membership' ? 'active' : ''?>">
    <a href="<?=site_url('membership')?>" class="menu-link">
    <i class="menu-icon tf-icons bx bxs-user-badge"></i>
    <div class="text-truncate" data-i18n="Membership">Membership</div>
    </a>
</li>


<div class="row">
<div class="col-md-12">
    <ul class="nav nav-pills flex-column flex-sm-row mb-4">
        <li class="nav-item <?=($page_data['system_module']) === 'Profile' ? 'active' : ''?>">
            <a href="<?=site_url('Profile/index/' . $info['id'])?>" class="nav-link <?=($page_data['system_module']) === 'Profile' ? 'active' : ''?>">
                <i class="bx bx-user me-1"></i>
                <div class="text-truncate" data-i18n="Profile">Profile</div>
            </a>
        </li>   
        <li class="nav-item <?=($page_data['system_module']) === 'Billings & Plans' ? 'active' : ''?>">
            <a href="<?=site_url('Profile/Billing')?>" class="nav-link <?=($page_data['system_module']) === 'Billings & Plans' ? 'active' : ''?>">
            <i class="bx bx-detail me-1"></i>
                <div class="text-truncate" data-i18n="Billings & Plans">Billings & Plans</div>
            </a>
        </li>   
       
            
        <li class="nav-item">
            <a class="nav-link <?=($page_data['system_module']) === 'Referral' ? 'active' : ''?>" href="<?=site_url('pages/profile/referral-index')?>">
                <i class="bx bx-link-alt me-1"></i> Referral
            </a>
        </li>
    </ul>
</div>
</div>
<?php

$profile = $this->session->userdata('profile');

$full_path = isset($profile) ? $profile : 'uploads/user/profile/default.jpg';
$public_path = str_replace('\\', '/', $full_path);
$base_path = str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']);
$relative_path = str_replace($base_path, '', $public_path);
$profile_picture_url = $relative_path;

$user_email = $this->session->userdata('user_email') ? $this->session->userdata('user_email') : '';

$user_role = $this->session->userdata('user_role') ? $this->session->userdata('user_role') : '';

?>



<!-- User -->

<li class="nav-item navbar-dropdown dropdown-user dropdown">

    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">

        <div class="avatar">

            <img src="<?= $profile_picture_url ?>" alt class="w-px-40 h-auto rounded-circle" />

        </div>

    </a>

    <ul class="dropdown-menu dropdown-menu-end">

        <li>

            <a class="dropdown-item" href="pages-account-settings-account.html">

                <div class="d-flex">

                    <div class="flex-shrink-0 me-3">

                        <div class="avatar">

                            <img src="<?= $profile_picture_url ?>" alt class="w-px-40 h-auto rounded-circle" />

                        </div>

                    </div>

                    <div class="flex-grow-1">

                        <span class="fw-medium d-block"><?= $user_email ?></span>

                        <small class="text-muted"><?= $user_role ?></small>

                    </div>

                </div>

            </a>

        </li>

        <li>

            <div class="dropdown-divider"></div>

        </li>

        <li>

            <a class="dropdown-item" href="<?= site_url('Profile') ?>">

                <i class="bx bx-user me-2"></i>

                <span class="align-middle">My Profile</span>

            </a>

        </li>

        <li>

            <a class="dropdown-item" href="<?= site_url('Settings') ?>">

                <i class="bx bx-cog me-2"></i>

                <span class="align-middle">Settings</span>

            </a>

        </li>

        <li>

            <a class="dropdown-item" href="javascript:;">

                <span class="d-flex align-items-center align-middle">

                    <i class="flex-shrink-0 bx bx-credit-card me-2"></i>

                    <span class="flex-grow-1 align-middle">Billing</span>

                    <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>

                </span>

            </a>

        </li>

        <li>

            <div class="dropdown-divider"></div>

        </li>

        <li>

            <a id="btn-logout" class="dropdown-item" href="javascript:;">

                <i class="bx bx-power-off me-2"></i>

                <span class="align-middle">Log Out</span>

            </a>

        </li>

    </ul>

</li>

<!--/ User -->
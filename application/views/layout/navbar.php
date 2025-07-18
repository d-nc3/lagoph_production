<!-- Navbar -->
<?php 
$current_group     =    isset($page_data['system_web_module_group']) && $page_data['system_web_module_group'] ? $page_data['system_web_module_group'] : '';
$current_module     =    isset($page_data['system_module']) && $page_data['system_module'] ? $page_data['system_module'] : '';
$current_section     =    isset($page_data['system_section']) && $page_data['system_section'] ? $page_data['system_section'] : '';


?>
                         

<nav
    class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
        <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <!-- Title -->
        <div class="navbar-nav align-items-center">
        <div class="nav-item navbar-search-wrapper mb-0">
            Cybercommunity Cooperative Philippines
        </div>
        </div>
        <!-- /Title -->
        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- Style Switcher -->
            <li class="nav-item dropdown-style-switcher dropdown me-2 me-xl-0">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                <i class="bx bx-sm"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-styles">
                <li>
                    <a class="dropdown-item" href="javascript:void(0);" data-theme="light">
                    <span class="align-middle"><i class="bx bx-sun me-2"></i>Light</span>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="javascript:void(0);" data-theme="dark">
                    <span class="align-middle"><i class="bx bx-moon me-2"></i>Dark</span>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="javascript:void(0);" data-theme="system">
                    <span class="align-middle"><i class="bx bx-desktop me-2"></i>System</span>
                    </a>
                </li>
                </ul>
            </li>
            <!-- / Style Switcher-->

            <!-- Notification -->
            <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1">
                <a
                class="nav-link dropdown-toggle hide-arrow"
                href="javascript:void(0);"
                data-bs-toggle="dropdown"
                data-bs-auto-close="outside"
                aria-expanded="false">
                <i class="bx bx-bell bx-sm"></i>
                <span class="badge bg-danger rounded-pill badge-notifications"><?=$page_data['unread_count']?></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end py-0">
                <li class="dropdown-menu-header border-bottom">
                    <div class="dropdown-header d-flex align-items-center py-3">
                    <h5 class="text-body mb-0 me-auto">Notification</h5>
                    <a
                        href="javascript:void(0)"
                        class="dropdown-notifications-all text-body"
                        id ="unreadButton"
                        data-bs-toggle="tooltip"
                        data-bs-placement="top"
                        title="Mark all as read"
                        ><i class="bx fs-4 bx-envelope-open"></i
                    ></a>
                    </div>
                </li>
        
                <li class="dropdown-notifications-list scrollable-container">
                  <ul class="list-group list-group-flush">
                    <?php if (!empty($page_data['notifications'])): // Check if notifications exist ?>
                      <?php foreach ($page_data['notifications'] as $key => $value): ?>
                        <li class="list-group-item list-group-item-action dropdown-notifications-item">
                          <div class="d-flex flex-stack py-4">
                            <div class="d-flex align-items-center">
                              <div class="symbol symbol-35px me-4">
                                <div class="px-7 py-5">
                                  <div class="menu-item px-2">
                                    <?php $is_read = isset($value['is_read']) && $value['is_read']; ?>
                                    <i class="fas fa-envelope-open-text text-primary unreadButton" title="Mark As Unread" style="font-size: 24px;" data-id="<?= $value['id']?>"></i>
                                   
                                  </div>
                                </div>
                              </div>
                              <a href="<?= isset($value['link']) && is_string($value['link']) ? $value['link'] : 'javascript:void(0);' ?>">
                              
                                  <div class=" fs-7 mb-0 me-1 readButton <?= $is_read ? ' text-hover-primary' : 'text-primary fw-bold' ?>" data-id="<?= $value['id'] ?>">
                                    <?= htmlspecialchars($value['notification_title']) ?>
                                  </div>
                                  
                                  <div class="text-dark-400 fs-9">
                                    <?= htmlspecialchars($value['message']) ?></div> <!-- Escape output for safety -->
                                  </div>
                              
                              </a>
                             <!-- Timestamp for the notification -->
                                <span class="badge text-dark "> <?= get_time_ago($value['created_at']) ?></span>
                                <div class="flex-shrink-2 dropdown-notifications-actions">
                                  <a href="javascript:void(0)" class="dropdown-notifications-read"
                                  ></span
                                  ></a>
                                  <a href="javascript:void(0)" class="dropdown-notifications-archive"
                                  ><span class="bx bx-x"></span
                                  ></a>
                                  
                                </div>
                            
                              <?php $is_read = isset($value['is_read']) && $value['is_read']; ?>
                              <a href="javascript:void(0)" class="dropdown-notifications-read">
                                  <?php if ($is_read == 0): ?>
                                      <!-- Display the badge only if is_read is 0 -->
                                      <span class="badge badge-dot"></span>
                                  <?php endif; ?>
                              </a>
                         
                        </div>
                        <?php endforeach; ?>
                          <?php else: ?>
                            <div class="d-flex flex-stack py-4">
                              <div class="d-flex align-items-center text-center">
                              <span class="fs-6 text-gray-800 fw-bolder">No notifications available</span>
                              </div>
                            </div>
                          <?php endif;?>
                      </li>
                  </ul>
                </li>
                <li class="dropdown-menu-footer border-top p-3">
                  <button class="btn btn-primary text-uppercase w-100">View all notifications</button>
                </li>
              </ul>
            </li>
            <!--/ Notification -->
            <?php $this->load->view('layout/options'); ?>
        </ul>
    </div>
</nav>
<!-- / Navbar -->
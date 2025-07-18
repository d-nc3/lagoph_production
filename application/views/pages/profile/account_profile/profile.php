<?php
$first_name = isset($info['first_name']) ? strtoupper($info['first_name']) : '';
$last_name = isset($info['last_name']) ? strtoupper($info['last_name']) : '';
$position = isset($info['position']) ? $info['position'] : '';
$date_hired = isset($info['date_hired']) ? $info['date_hired'] : '';
$address = isset($info['birth_place']) ? strtoupper($info['birth_place']) : '';
$mobile_number = isset($info['mobile_number']) ? '+63 ' . strtoupper($info['mobile_number']) : '';
$email = isset($info['email']) ? $info['email'] : '';
$position = isset($info['position_title']) ? $info['position_title'] : ' ';

// Path to user document or default image
$img_path_url = isset($user_documents['doc_path']) &&
 $user_documents['doc_path'] &&
 file_exists(FCPATH . $user_documents['doc_path']) ?
 base_url($user_documents['doc_path']) :
 base_url('assets/img/avatars/1.png');

?>
<?php $this->load->view('layout/header'); ?>
<div class="layout-wrapper layout-content-navbar">
 <div class="layout-container">
  <?php $this->load->view('layout/sidenav'); ?>
  <div class="layout-page">
   <?php $this->load->view('layout/navbar'); ?>
   <!-- Content wrapper -->
   <div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
     <h4 class="py-3 mb-4"><span class="text-muted fw-light">User Profile /</span> Profile</h4>

     <div class="row pt-3">
      <div class="col-12">
       <div class="card mb-4">
        <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
         <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
          <img
           src="<?= $img_path_url ?>"
           alt="user image"
           class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img" />
         </div>
         <div class="flex-grow-1 mt-3 mt-sm-5">
          <div
           class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
           <div class="user-profile-info">
            <h4><?= $first_name ?> <?= $last_name ?></h4>
            <ul
             class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
             <li class="list-inline-item fw-medium"><i class="bx bx-pen"></i> <?= $position ?></li>
             <li class="list-inline-item fw-medium"><i class="bx bx-map"></i> <?= $address ?></li>
             <li class="list-inline-item fw-medium">
              <i class="bx bx-calendar-alt"></i> Joined <?= $date_hired ?>
             </li>
            </ul>
           </div>
           <a href="javascript:void(0)" class="btn btn-primary text-nowrap">
            <i class="bx bx-user-check me-1"></i>Connected
           </a>
          </div>
         </div>
        </div>
       </div>
      </div>


      <?php $this->load->view('layout/profile-nav/nav-options') ?>
      <!--Security Functions  Content -->
      <div class="row  mb-4 justify-content-center">
       <div class="col-sm-6 col-xl-3">
        <div class="card">
         <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
           <div class="content-left">
            <span>Succesful Attempts</span>
            <div class="d-flex align-items-end mt-2">
             <h4 class="mb-0 me-2">21,459</h4>
             <small class="text-success">(+29%)</small>
            </div>
            <p class="mb-0">Total Users</p>
           </div>
           <div class="avatar">
            <span class="avatar-initial rounded bg-label-primary">
             <i class="bx bx-user bx-sm"></i>
            </span>
           </div>
          </div>
         </div>
        </div>
       </div>
       <div class="col-sm-6 col-xl-3">
        <div class="card">
         <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
           <div class="content-left">
            <span>Failed Attempts</span>
            <div class="d-flex align-items-end mt-2">
             <h4 class="mb-0 me-2">4,567</h4>
             <small class="text-success">(+18%)</small>
            </div>
            <p class="mb-0">Last week analytics</p>
           </div>
           <div class="avatar">
            <span class="avatar-initial rounded bg-label-danger">
             <i class="bx bx-user-check bx-sm"></i>
            </span>
           </div>
          </div>
         </div>
        </div>
       </div>
       <div class="col-sm-6 col-xl-3">
        <div class="card">
         <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
           <div class="content-left">
            <span>Total Attempts</span>
            <div class="d-flex align-items-end mt-2">
             <h4 class="mb-0 me-2">19,860</h4>
             <small class="text-danger">(-14%)</small>
            </div>
            <p class="mb-0">Last week analytics</p>
           </div>
           <div class="avatar">
            <span class="avatar-initial rounded bg-label-success">
             <i class="bx bx-group bx-sm"></i>
            </span>
           </div>
          </div>
         </div>
        </div>
       </div>
      </div>
      <div class="col-xl-10 col-lg-7 col-md-7 justify-content-center">
       <div class="card mb-4">
        <h5 class="card-header">Recent Devices</h5>
        <div class="table-responsive">
         <table class="table border-top">
          <thead>
           <tr>
            <th class="text-truncate">Browser</th>
            <th class="text-truncate">Device</th>
            <th class="text-truncate">Location</th>
            <th class="text-truncate">Recent Activities</th>
           </tr>
          </thead>
          <tbody>
           <tr>
            <td class="text-truncate">
             <i class="bx bxl-windows text-info me-3"></i>
             <span class="fw-medium">Chrome on Windows</span>
            </td>
            <td class="text-truncate">HP Spectre 360</td>
            <td class="text-truncate">Switzerland</td>
            <td class="text-truncate">10, July 2021 20:07</td>
           </tr>
           <tr>
            <td class="text-truncate">
             <i class="bx bx-mobile-alt text-danger me-3"></i>
             <span class="fw-medium">Chrome on iPhone</span>
            </td>
            <td class="text-truncate">iPhone 12x</td>
            <td class="text-truncate">Australia</td>
            <td class="text-truncate">13, July 2021 10:10</td>
           </tr>
           <tr>
            <td class="text-truncate">
             <i class="bx bxl-android text-success me-3"></i>
             <span class="fw-medium">Chrome on Android</span>
            </td>
            <td class="text-truncate">Oneplus 9 Pro</td>
            <td class="text-truncate">Dubai</td>
            <td class="text-truncate">14, July 2021 15:15</td>
           </tr>
           <tr>
            <td class="text-truncate">
             <i class="bx bxl-apple me-3"></i> <span class="fw-medium">Chrome on MacOS</span>
            </td>
            <td class="text-truncate">Apple iMac</td>
            <td class="text-truncate">India</td>
            <td class="text-truncate">16, July 2021 16:17</td>
           </tr>
           <tr>
            <td class="text-truncate">
             <i class="bx bxl-windows text-info me-3"></i>
             <span class="fw-medium">Chrome on Windows</span>
            </td>
            <td class="text-truncate">HP Spectre 360</td>
            <td class="text-truncate">Switzerland</td>
            <td class="text-truncate">20, July 2021 21:01</td>
           </tr>
           <tr class="border-transparent">
            <td class="text-truncate">
             <i class="bx bxl-android text-success me-3"></i>
             <span class="fw-medium">Chrome on Android</span>
            </td>
            <td class="text-truncate">Oneplus 9 Pro</td>
            <td class="text-truncate">Dubai</td>
            <td class="text-truncate">21, July 2021 12:22</td>
           </tr>
          </tbody>
         </table>
        </div>
       </div>
      </div>
      <!--/Secruity Functions  Content -->
     </div>

    </div>


    <?php $this->load->view('layout/footer'); ?>
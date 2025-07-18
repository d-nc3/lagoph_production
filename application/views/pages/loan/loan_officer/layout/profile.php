  <!-- User Sidebar -->
  <?php
  $id =   isset($info['id'])    &&  $info['id']   ?   strtoupper($info['id'])   :   '';
  $user_id =   isset($info['user_id'])    &&  $info['user_id']   ?   strtoupper($info['user_id'])   :   '';
  $status =   isset($info['status'])    &&  $info['status']   ?   strtoupper($info['status'])   :   '';
  $badgeClass = ($status === "Employed") ? "bg-label-danger" : "bg-label-success";
  $first_name =   isset($info['first_name'])    &&  $info['first_name']   ?   strtoupper($info['first_name'])   :   '';
  $middle_name =   isset($info['middle_name'])    &&  $info['middle_name']   ?    strtoupper($info['middle_name'])   :   '';
  $last_name =   isset($info['last_name'])    &&  $info['last_name']   ?   strtoupper($info['last_name'])   :   '';
  $sex =   isset($info['sex'])    &&  $info['sex']   ?   $info['sex']   :   '';
  $date_hired =   isset($info['date_hired'])    &&  $info['date_hired']   ?   $info['date_hired']   :   '';
  $date_of_birth =   isset($info['date_of_birth'])    &&  $info['date_of_birth']   ?   strtoupper($info['date_of_birth'])   :   '';
  $place_of_birth =   isset($info['place_of_birth'])    &&  $info['place_of_birth']   ?   strtoupper($info['place_of_birth'])   :   '';
  $position_title =   isset($info['position_id'])    &&  $info['position_id']   ?   strtoupper($info['position_id'])   :   '';
  $mobile_number =   isset($info['mobile_number'])    &&  $info['mobile_number']   ?  strtoupper($info['mobile_number'])   :   '';
  $unit_name =   isset($info['unit_name'])    &&  $info['unit_name']   ?   strtoupper($info['unit_name'])   :   '';
  $email =   isset($info['email'])    &&  $info['email']   ?  $info['email']   :   '';
  $department_name =   isset($info['department_id'])    &&  $info['department_id']   ?  $info['department_id']   :   '';
  $role =   isset($info['role'])    &&  $info['role']   ?   $info['role']   :   '-';

  ?>
  <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
    <div class="card mb-4">
      <div class="card-body">
        <div class="user-avatar-section">
          <div class="d-flex align-items-center flex-column">
            <img
              class="img-fluid rounded my-4"
              src="../../assets/img/avatars/10.png"
              height="110"
              width="110"
              alt="User avatar" />
            <div class="user-info text-center">
              <h4 class="mb-2"><?= $first_name ?> <?= $middle_name ?> <?= $last_name ?></h4>
              <span class="badge bg-label-secondary"><?= $role ?></span>
            </div>
          </div>
        </div>
        <div class="d-flex justify-content-around flex-wrap my-4 py-3">
          <div class="d-flex align-items-start me-4 mt-3 gap-3">
            <span class="badge bg-label-primary p-2 rounded"><i class="bx bx-check bx-sm"></i></span>
            <div>
              <h5 class="mb-0">1.23k</h5>
              <span>Tasks Done</span>
            </div>
          </div>
          <div class="d-flex align-items-start mt-3 gap-3">
            <span class="badge bg-label-primary p-2 rounded"><i class="bx bx-customize bx-sm"></i></span>
            <div>
              <h5 class="mb-0">568</h5>
              <span>Projects Done</span>
            </div>
          </div>
        </div>
        <h5 class="pb-2 border-bottom mb-4">Details</h5>
        <div class="info-container">
          <ul class="list-unstyled">
            <li class="">
              <span class="fw-medium me-2">Name:</span>
              <span><?= $first_name ?> <?= $middle_name ?> <?= $last_name ?></span>
            </li>
            <li class="">
              <span class="fw-medium me-2">Birth Date:</span>
              <span><?= $date_of_birth ?></span>
            </li>
            <li class="">
              <span class="fw-medium me-2">Birth Place:</span>
              <span><?= $place_of_birth ?></span>
            </li>
            <li class="">
              <span class="fw-medium me-2">Email:</span>
              <span><?= $email ?></span>
            </li>
            <li class="">
              <span class="fw-medium me-2">Membership Status:</span>
              <span class="badge <?= $badgeClass ?>"><?= $status ?></span>
            </li>


            <li class="">
              <span class="fw-medium me-2">Contact:</span>
              <span><?= $mobile_number ?></span>
            </li>
          </ul>

        
     
        </div>
      </div>
    </div>
  </div>
  <!-- User Content -->
  <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
    <ul class="nav nav-pills flex-column flex-md-row mb-3">
      <li class="nav-item">
        <a class="nav-link <?= ($page_data['system_module'] == 'Overview') ? 'active' : '' ?>" href="<?= site_url('Loan/overview/' . $user_id); ?>">

          <i class="bx bx-user me-1"></i> Overview
        </a>



      </li>
     
      <li class="nav-item">
        <a class="nav-link <?= ($page_data['system_module'] == 'Statement') ? 'active' : '' ?>" href="<?= site_url('Loan/payment_history/' . $user_id) ?>">
          <i class="bx bx-user me-1"></i> Statements
        </a>
      </li>

    </ul>
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
$birth_place =   isset($info['birth_place'])    &&  $info['birth_place']   ?   strtoupper($info['birth_place'])   :   '';
$position_title =   isset($info['position_id'])    &&  $info['position_id']   ?   strtoupper($info['position_id'])   :   '';
$mobile_number =   isset($info['mobile_number'])    &&  $info['mobile_number']   ?  strtoupper($info['mobile_number'])   :   '';
$unit_name =   isset($info['unit_name'])    &&  $info['unit_name']   ?   strtoupper($info['unit_name'])   :   '';
$email =   isset($info['email'])    &&  $info['email']   ?  $info['email']   :   '';
$department_name =   isset($info['department_id'])    &&  $info['department_id']   ?  $info['department_id']   :   '';
$role =   isset($info['role'])    &&  $info['role']   ?   $info['role']   :   '-';
$created_by =   isset($info['created_by'])    &&  $info['created_by']   ?   $info['created_by']   :   '-';
$created_at =   isset($info['created_at'])    &&  $info['created_at']   ?   $info['created_at']   :   '-';
$updated_by =   isset($info['updated_by'])    &&  $info['updated_by']   ?   $info['updated_by']   :   '-';
$updated_at =   isset($info['updated_at'])    &&  $info['updated_at']   ?   $info['updated_at']   :   '-';

?>

<?php $this->load->view('layout/header'); ?>
<div class="layout-wrapper layout-content-navbar">
 <div class="layout-container">
  <?php $this->load->view('layout/sidenav'); ?>
  <div class="layout-page">
   <?php $this->load->view('layout/navbar'); ?>

   <!-- Content wrapper -->

   <div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
     <h4 class="py-3 mb-4"><span class="text-muted fw-light">User / View /</span> Account</h4>
     <div class="row">
      <!-- User Sidebar -->
      <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
       <!-- User Card -->
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
           <li class="mb-3">
            <span class="fw-medium me-2">Name:</span>
            <span><?= $first_name ?> <?= $middle_name ?> <?= $last_name ?></span>
           </li>
           <li class="mb-3">
            <span class="fw-medium me-2">Birth Date:</span>
            <span><?= $date_of_birth ?></span>
           </li>
           <li class="mb-3">
            <span class="fw-medium me-2">Birth Place:</span>
            <span><?= $birth_place ?></span>
           </li>
           <li class="mb-3">
            <span class="fw-medium me-2">Email:</span>
            <span><?= $email ?></span>
           </li>
           <li class="mb-3">
            <span class="fw-medium me-2">Employment Status:</span>
            <span class="badge <?= $badgeClass ?>"><?= $status ?></span>
           </li>

           <li class="mb-3">
            <span class="fw-medium me-2">Role:</span>
            <span><?= $role ?></span>
           </li>

           <li class="mb-3">
            <span class="fw-medium me-2">Contact:</span>
            <span><?= $mobile_number ?></span>
           </li>
           <li class="mb-3">
            <span class="fw-medium me-2">Date hired:</span>
            <span><?= $date_hired ?></span>
           </li>
           <li class="mb-3">
            <span class="fw-medium me-2">Date of Temination:</span>
            <span>England</span>
           </li>
          </ul>

          <div class="d-flex justify-content-center pt-3">
           <a href="javascript:;" class="btn btn-primary me-3 edit-record"
            data-id="<?php echo $id; ?>"
            data-bs-target="#editUser"
            data-bs-toggle="modal"
            title="Edit item details">Edit</a>


           <a href="javascript:;" class="btn btn-label-danger suspend-user">Suspended</a>
          </div>
         </div>
        </div>
       </div>
       <!-- /User Card -->

      </div>
      <!--/ User Sidebar -->

      <!-- User Content -->
      <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
       <?php $this->load->view('pages/employee/partials/nav-options'); ?>


       <div class="col-xl-12">
        <div class="card overflow-hidden mb-4" style="height: 500px;">
         <h5 class="card-header">User History logs</h5>
         <div class="card-body" id="vertical-example">
          <ul class="timeline pt-3">
         
          </ul>
         </div>
        </div>

        <div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
         <div class="modal-dialog modal-lg modal-simple modal-edit-user">
          <div class="modal-content p-3 p-md-5">
           <div class="modal-body">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="text-center mb-4">
             <h3>Edit User Information</h3>
             <p>Updating user details will receive a privacy audit.</p>
            </div>

            <form id="edit-form" class="row g-3" onsubmit="return true">
             <input type="hidden" id="edit-id" name="id" class="form-control" readonly />
             <div class="col-12 col-md-6">
              <label class="form-label" for="edit-first-name">First name</label>
              <input
               type="text"
               id="edit-first-name"
               class="form-control"
               placeholder="Enter First Name"
               name="first_name"
               aria-label="First name" />
             </div>

             <!-- Description -->
             <div class="col-12 col-md-6">
              <label class="form-label" for="edit-last-name">Last Name</label>
              <input
               type="text"
               id="edit-last-name"
               name="last_name"
               class="form-control"
               aria-label="Last Name"
               placeholder="Description"></textarea>
             </div>

             <div class="col-12 col-md-6">
              <label class="form-label" for="edit-middle-name">Middle Name</label>
              <input
               type="text"
               class="form-control"
               id="edit-middle-name"
               placeholder="Enter Middle Name"
               name="middle_name"
               aria-label="Middle Name" />
             </div>


             <div class="col-12 col-md-6">
              <label class="form-label" for="edit-sex">Sex</label>
              <select id="edit-sex " name="sex" class="select2 form-select" data-allow-clear="false">
               <option value="Male"> Male </option>
               <option value="Female">Female</option>
              </select>
             </div>


             <div class="col-12 col-md-6">
              <label class="form-label" for="edit-birth-place">Place Of Birth</label>
              <select id="edit-birth-place" name="birth_place" class="select2 form-select" data-allow-clear="false">

               <!-- Regions options -->
               <option value="NCR">National Capital Region (NCR)</option>
               <option value="CAR">Cordillera Administrative Region (CAR)</option>
               <option value="Region I">Ilocos Region (Region I)</option>
               <option value="Region II">Cagayan Valley (Region II)</option>
               <option value="Region III">Central Luzon (Region III)</option>
               <option value="Region IV-A">Calabarzon (Region IV-A)</option>
               <option value="Region IV-B">Southwestern Tagalog Region (Region IV-B)</option>
               <option value="Region V">Bicol Region (Region V)</option>
               <option value="Region VI">Western Visayas (Region VI)</option>
               <option value="Region VII">Central Visayas (Region VII)</option>
               <option value="Region VIII">Eastern Visayas (Region VIII)</option>
               <option value="Region IX">Zamboanga Peninsula (Region IX)</option>
               <option value="Region X">Northern Mindanao (Region X)</option>
               <option value="Region XI">Davao Region (Region XI)</option>
               <option value="Region XII">Soccsksargen (Region XII)</option>
               <option value="Region XIII">Caraga (Region XIII)</option>
               <option value="BARMM">Bangsamoro (BARMM)</option>
              </select>
             </div>

             <div class="col-12 col-md-6">
              <label class="form-label" for="edit-dob">Date of Birth</label>
              <input
               type="date"
               id="edit-dob"
               name="date_of_birth"
               class="form-control"
               data-allow-clear="false" />
             </div>



             <div class="col-12 col-md-6">
              <label class="form-label" for="edit-number">Email</label>
              <input
               type="text"
               id="edit-email"
               name="email"
               class="form-control"
               data-allow-clear="false" />

             </div>

             <div class="col-12 col-md-6">
              <label class="form-label" for="edit-number">Mobile Number</label>
              <input
               type="text"
               id="edit-number"
               name="mobile_number"
               class="form-control"
               data-allow-clear="false" />

             </div>


             <div class="col-12 col-md-6">
              <label class="form-label" for="edit-position-title">Position title</label>
              <select
               id="edit-position-title"
               class="select2 form-select"
               name="position_title"
               data-allow-clear="true">

               <?php if (!empty($positions)): ?>
                <?php foreach ($positions as $key => $val): ?>
                 <option value="<?= $val['id'] ?>"><?= $val['position_title'] ?></option>
                <?php endforeach; ?>
               <?php endif; ?>
              </select>
             </div>

             <div class="col-12 col-md-6">
              <label class="form-label" for="edit-date-hired">Date Hired </label>
              <input
               type="date"
               id="edit-date-hired"
               class="form-control"
               name="date_hired" />
             </div>

             <div class="col-12 col-md-6">
              <label class="form-label" for="edit-status">Status </label>
              <select id="edit-status" name="status" class="select2 form-select" data-allow-clear="false">

               <option value="Employed">Employed</option>
               <option value="Terminated">Terminated</option>
               <option value="Resigned">Resigned</option>
              </select>
             </div>

             <div class="col-12 text-center">
              <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Save</button>

              <button
               type="reset"
               class="btn btn-label-secondary"
               data-bs-dismiss="modal"
               aria-label="Close">
               Cancel
              </button>
             </div>
            </form>
           </div>
          </div>
         </div>
        </div>
       </div>

       <div class="content-backdrop fade"></div>
      </div>
      <!-- / Layout page -->
     </div>

     <!-- Overlay -->
     <div class="layout-overlay layout-menu-toggle"></div>

     <!-- Drag Target Area To SlideIn Menu On Small Screens -->
     <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->
    <?php $this->load->view('layout/footer'); ?>
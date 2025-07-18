<?php

$permissions = "";

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

     <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="py-1"><span class="text-muted fw-light">Dashboard /</span> Role Permissions</h4>
      <p>
       A role provided access to predefined menus and features so that depending on <br />
       assigned role an administrator can have access to what user needs.
      </p>
      <!-- Role cards -->
      <div class="row g-4">


       <div class="col-12">
        <div class="card">
         <div class="card-header border-bottom">
          <h5 class="card-title">Search Filter</h5>
          <div class="row py-3 gap-3 gap-md-0">
          </div>
          <div class="card-datatable table-responsive">
           <table class="datatables-user table border-top">
            <thead>
             <tr>
              <th></th>
              <th>Role Name</th>
              <th>Permissions</th>
              <th>Actions</th>
             
             </tr>
            </thead>
           </table>
          </div>
         </div>
        </div>
       </div>
       <!--/ Role cards -->

       <!-- Add Role Modal -->
       <!-- Add Role Modal -->


       <!-- Edit Permission Modal -->
       <div class="modal fade" id="addRolePermissionsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-simple">
         <div class="modal-content p-3 p-md-5">
          <div class="modal-body">
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
           <div class="text-center mb-4">
            <h3>Add User Role and Permission</h3>
            <p>Add permission as per your requirements.</p>
           </div>
           <div class="alert alert-warning" role="alert">
            <h6 class="alert-heading mb-2">Warning</h6>
            <p class="mb-0">
             By editing the User role and permission name, you might break the system accessibility and functionality. Please
             ensure you're absolutely certain before proceeding.
            </p>
           </div>
           <form id="addRolePermissionModal" class="row g-3" onsubmit="return false">
            <!-- Role Dropdown -->
            <div class="col-md-12">
             <label class="form-label" for="modalRoleName">Role Name</label>
             <select class="select2 Form-control" id="modalRoleName" name="modalRoleName">
              <?php foreach ($roles as $role) : ?>
               <option value=""></option>
               <option value="<?= $role['id'] ?>"><?= $role['role_name'] ?></option>
              <?php endforeach; ?>
             </select>
            </div>

            <!-- Permissions Dropdown -->
            <div class="col-md-12">
             <label for="modalPermission" class="form-label">Permissions</label>
             <input
              id="modalPermission"
              name="permissions"
              class="form-control"
              value="<?= $permissions ?>"
              placeholder="select permissions that apply" />
            </div>

            <!-- Submit Button -->
            <div class="col-md-12 text-end">
             <button type="submit" class="btn btn-primary">Add</button>
            </div>
           </form>
          </div>
         </div>
        </div>
       </div>

       <div class="modal fade" id="editPermissionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-simple">
         <div class="modal-content p-3 p-md-5">
          <div class="modal-body">
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
           <div class="text-center mb-4">
            <h3>Edit User Role and Permission</h3>
            <p>Edit permissions</p>
           </div>
           <div class="alert alert-warning" role="alert">
            <h6 class="alert-heading mb-2">Warning</h6>
            <p class="mb-0">
             By editing the User role and permission name, you might break the system accessibility and functionality. Please
             ensure you're absolutely certain before proceeding.
            </p>
           </div>
           <form id="editPermissionModal" class="row g-3" onsubmit="return false">
            <!-- Role Dropdown -->
            <div class="col-md-12">
             <label class="form-label" for="modalRoleName">Role Name</label>
             <select class="select2 Form-control" id="modalRoleName" name="modalRoleName">
              <?php foreach ($roles as $role) : ?>
               <option value=""></option>
               <option value="<?= $role['id'] ?>"><?= $role['role_name'] ?></option>
              <?php endforeach; ?>
             </select>
            </div>

            <!-- Permissions Dropdown -->
            <div class="col-md-12">
             <label for="modalPermission" class="form-label">Permissions</label>
             <input
              id="modalPermission"
              name="permissions"
              class="form-control"
              value="<?= $permissions ?>"
              placeholder="select permissions that apply" />
            </div>

            <!-- Submit Button -->
            <div class="col-md-12 text-end">
             <button type="submit" class="btn btn-primary">Add</button>
            </div>
           </form>
          </div>
         </div>
        </div>
       </div>

      </div>

     </div>
    </div>
   </div>

   <?php $this->load->view('layout/footer'); ?>
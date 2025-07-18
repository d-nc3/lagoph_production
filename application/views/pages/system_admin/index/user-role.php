<?php
$permissions = "";
$total_members = $count_member ?? 0;
$loan_approver = $loan_approver_count ?? 0;
$admin_counter = $admin_counter ?? 0;
$cashier_counter = $cashier_counter ?? 0;
$user_counter = $user_counter ?? 0;
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
            <h4 class="py-1"><span class="text-muted fw-light">Dashboard /</span> User Roles</h4>
            <p>
              A role provided access to predefined menus and features so that depending on <br />
              assigned role an administrator can have access to what user needs.
            </p>
            <!-- Role cards -->
            <div class="row g-4">
              <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                      <h6 class="fw-normal">Total <?= $total_members ?> Members</h6>
                      <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">


                      </ul>
                    </div>
                    <div class="d-flex justify-content-between align-items-end">
                      <div class="role-heading">
                        <h4 class="mb-1">Members</h4>
                        <a
                          href="javascript:;"
                          data-bs-toggle="modal"
                          data-bs-target="#addRoleModal"
                          class="role-edit-modal"><small>Edit Role</small></a>
                      </div>
                      <a href="javascript:void(0);" class="text-muted"><i class="bx bx-copy"></i></a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                      <h6 class="fw-normal">Total <?= $loan_approver ?> Loan Approvers</h6>

                    </div>
                    <div class="d-flex justify-content-between align-items-end">
                      <div class="role-heading">
                        <h4 class="mb-1">Loan Approver</h4>
                        <a
                          href="javascript:;"
                          data-bs-toggle="modal"
                          data-bs-target="#addRoleModal"
                          class="role-edit-modal"><small>Edit Role</small></a>
                      </div>
                      <a href="javascript:void(0);" class="text-muted"><i class="bx bx-copy"></i></a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                      <h6 class="fw-normal">Total <?= $admin_counter ?> Admin</h6>

                    </div>
                    <div class="d-flex justify-content-between align-items-end">
                      <div class="role-heading">
                        <h4 class="mb-1">Admin</h4>
                        <a
                          href="javascript:;"
                          data-bs-toggle="modal"
                          data-bs-target="#addRoleModal"
                          class="role-edit-modal"><small>Edit Role</small></a>
                      </div>
                      <a href="javascript:void(0);" class="text-muted"><i class="bx bx-copy"></i></a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                      <h6 class="fw-normal">Total <?= $user_counter ?> users</h6>

                    </div>
                    <div class="d-flex justify-content-between align-items-end">
                      <div class="role-heading">
                        <h4 class="mb-1">Users</h4>
                        <a
                          href="javascript:;"
                          data-bs-toggle="modal"
                          data-bs-target="#addRoleModal"
                          class="role-edit-modal"><small>Edit Role</small></a>
                      </div>
                      <a href="javascript:void(0);" class="text-muted"><i class="bx bx-copy"></i></a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                      <h6 class="fw-normal">Total <?= $cashier_counter ?> cashier</h6>
                    </div>
                    <div class="d-flex justify-content-between align-items-end">
                      <div class="role-heading">
                        <h4 class="mb-1">Cashier</h4>
                        <a
                          href="javascript:;"
                          data-bs-toggle="modal"
                          data-bs-target="#addRoleModal"
                          class="role-edit-modal"><small>Edit Role</small></a>
                      </div>
                      <a href="javascript:void(0);" class="text-muted"><i class="bx bx-copy"></i></a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card h-100">
                  <div class="row h-100">
                    <div class="col-sm-5">
                      <div class="d-flex align-items-end h-100 justify-content-center mt-sm-0 mt-3">
                        <img
                          src="../../assets/img/illustrations/sitting-girl-with-laptop-light.png"
                          class="img-fluid"
                          alt="Image"
                          width="120"
                          data-app-light-img="illustrations/sitting-girl-with-laptop-light.png"
                          data-app-dark-img="illustrations/sitting-girl-with-laptop-dark.png" />
                      </div>
                    </div>
                    <div class="col-sm-7">
                      <div class="card-body text-sm-end text-center ps-sm-0">
                        <button
                          data-bs-target="#addRoleModal"
                          data-bs-toggle="modal"
                          class="btn btn-primary mb-3 text-nowrap add-new-role">
                          Assign User roles
                        </button>
                        <p class="mb-0">Designate a role, if it does not exist</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
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
                            <th>User</th>
                            <th>Role</th>
                            <th>Created at</th>
                            <th>Actions</th>

                          </tr>
                        </thead>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal fade" id="addRoleModal" tabindex="-1" aria-hidden="true">
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
                          <label class="form-label" for="modalRoleName">Users</label>
                          <select class="select2 Form-control" id="modalUserName" name="modalUserName">
                            <?php foreach ($users as $user) : ?>
                              <option value=""></option>
                              <option value="<?= $user['id'] ?>"><?= $user['first_name'] ?> <?= $user['last_name'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>

                        <!-- Permissions Dropdown -->
                        <div class="col-md-12">
                          <label for="modalPermission" class="form-label">Roles</label>
                          <select class="select2 Form-control" id="modalRoleName" name="modalRoleName">
                            <?php foreach ($roles as $role) : ?>
                              <option value=""></option>
                              <option value="<?= $role['id'] ?>"><?= $role['role_name'] ?></option>
                            <?php endforeach; ?>
                          </select>
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

              <div class="modal fade" id="editUserRole" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-simple">
                  <div class="modal-content p-3 p-md-5">
                    <div class="modal-body">
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      <div class="text-center mb-4">
                        <h3>Edit User Role</h3>
                        <p>Edit role per requirement.</p>
                      </div>
                      <div class="alert alert-warning" role="alert">
                        <h6 class="alert-heading mb-2">Warning</h6>
                        <p class="mb-0">
                          By editing the permission name, you might break the system permissions functionality. Please
                          ensure you're absolutely certain before proceeding.
                        </p>
                      </div>
                      <form id="editUserForm" class="row" onsubmit="return false">
                        <div class="col-md-12 mb-2">
                          <label class="form-label" for="editPermissionName">User Name</label>
                          <input
                            type="text"
                            id="editUserName"
                            name="editName"
                            class="form-control"
                            tabindex="-1"
                            readOnly />
                        </div>

                        <input
                          type="text"
                          id="user_id"
                          name="editUserId"
                          class="form-control"
                          tabindex="-1"
                          hidden />

                        <div class="col-md-12 mb-2">
                          <label for="modalPermission" class="form-label">Roles</label>
                          <select class="select2 Form-control" id="editRole" name="editRole">
                            <?php foreach ($roles as $role) : ?>
                              <option value=""></option>
                              <option value="<?= $role['id'] ?>"><?= $role['role_name'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <div class="col-md-12 text-end">
                          <button type="submit" class="btn btn-primary">Add</button>
                          <button type="submit" class="btn btn-">Close</button>
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
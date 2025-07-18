 <?php $this->load->view('layout/header'); ?>
 <div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">
   <?php $this->load->view('layout/sidenav'); ?>
   <div class="layout-page">
    <?php $this->load->view('layout/navbar'); ?>
     <!-- Content -->
     <div class="container-xxl flex-grow-1 container-p-y">

     <h4 class="py-1"><span class="text-muted fw-light">Settings /</span> Unit</h4>
      <p>
      A unit represents a specific division within the organization, grouping users based on their functions or responsibilities. Assigning users to units helps streamline access control, ensuring that each group has the appropriate permissions and resources needed to perform their tasks efficiently.
      </p>
      <div class="card">
       <div class="card-header border-bottom">
        <h5 class="card-title">Search Filter</h5>
        <div class="row py-3 gap-3 gap-md-0">
         <div class="col-md-4">
          <select
           id="filter-department-id"
           class="select2-filters form-select"
           data-allow-clear="true">
           <option value=""></option>
           <?php if (!empty($departments)): ?>
            <?php foreach ($departments as $key => $val): ?>
             <option value="<?= $val['id'] ?>"><?= $val['department_name'] ?></option>
            <?php endforeach; ?>
           <?php endif; ?>
          </select>
         </div>
        </div>
       </div>
       <div class="card-datatable table-responsive">
        <table class="datatables-unit table border-top">
         <thead>
          <tr>
           <th></th>
           <th>Department Name</th>
           <th>Unit Name</th>
           <th>Unit Head &nbsp;</th>
           <th>Description</th>
           <th>Actions</th>
          </tr>
         </thead>
        </table>
       </div>
      </div>

      <!-- Offcanvas Add -->
      <div class="offcanvas offcanvas-end" tabindex="-1" id="offCanvassAdd" aria-labelledby="offCanvassAddLabel">

       <!-- Header -->
       <div class="offcanvas-header py-4">
        <h5 id="offCanvassAddLabel" class="offcanvas-title">Add New Unit</h5>
        <button type="button" class="btn-close bg-label-secondary text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
       </div>

       <!-- Body -->
       <div class="offcanvas-body border-top">
        <form class="pt-0" id="addForm" onsubmit="return true">

         <!-- Department -->
         <div class="mb-3">
          <label class="form-label" for="add-department-id">Department</label>
          <select
           id="add-department-id"
           class="select2 form-select"
           name="department_id"
           data-allow-clear="true">
           <option value=""></option>
           <?php if (!empty($departments)): ?>
            <?php foreach ($departments as $key => $val): ?>
             <option value="<?= $val['id'] ?>"><?= $val['department_name'] ?></option>
            <?php endforeach; ?>
           <?php endif; ?>
          </select>
         </div>

         <!-- Title -->
         <div class="mb-3">
          <label class="form-label" for="add-unit-name">Unit Name</label>
          <input
           type="text"
           class="form-control"
           id="add-unit-name"
           placeholder="Enter Unit Name"
           name="unit_name"
           aria-label="Unit Name" />
         </div>

         <!-- Unit Heads -->
         <div class="mb-3">
          <label class="form-label" for="add-unit-head">Unit Head</label>
          <input
           type="text"
           id="add-unit-head"
           class="form-control"
           placeholder="Enter Unit Head Full Name"
           name="unit_head"
           aria-label="Unit Head" />
         </div>

         <!-- Description -->
         <div class="mb-3">
          <label class="form-label" for="add-description">Description</label>
          <textarea
           id="add-description"
           name="description"
           class="form-control"
           rows="3"
           aria-label="Description"
           placeholder="Description"></textarea>
         </div>

         <!-- Submit and reset -->
         <div class="mb-3">
          <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Add</button>
          <button type="reset" class="btn bg-label-danger" data-bs-dismiss="offcanvas">Discard</button>
         </div>
        </form>
       </div>
      </div>

      <!-- Offcanvas Edit -->
      <div class="offcanvas offcanvas-end" tabindex="-1" id="offCanvassEdit" aria-labelledby="offCanvassEditLabel">

       <!-- Header -->
       <div class="offcanvas-header py-4">
        <h5 id="offCanvassEditLabel" class="offcanvas-title">Edit Unit</h5>
        <button type="button" class="btn-close bg-label-secondary text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
       </div>

       <!-- Body -->
       <div class="offcanvas-body border-top">
        <form class="pt-0" id="editForm" onsubmit="return true">
         <input type="hidden" id="edit-id" name="id" class="form-control" readonly />

         <!-- Department -->
         <div class="mb-3">
          <label class="form-label" for="edit-department-id">Department</label>
          <select
           id="edit-department-id"
           class="select2 form-select"
           name="department_id"
           data-allow-clear="true">
           <option value=""></option>
           <?php if (!empty($departments)): ?>
            <?php foreach ($departments as $key => $val): ?>
             <option value="<?= $val['id'] ?>"><?= $val['department_name'] ?></option>
            <?php endforeach; ?>
           <?php endif; ?>
          </select>
         </div>

         <!-- Title -->
         <div class="mb-3">
          <label class="form-label" for="edit-unit-name">Unit Name</label>
          <input
           type="text"
           class="form-control"
           id="edit-unit-name"
           placeholder="Enter Unit Name"
           name="unit_name"
           aria-label="Unit Name" />
         </div>

         <!-- Unit Heads -->
         <div class="mb-3">
          <label class="form-label" for="edit-unit-head">Unit Head</label>
          <input
           type="text"
           id="edit-unit-head"
           class="form-control"
           placeholder="Enter Unit Head Full Name"
           aria-label="Unit Head"
           name="unit_head" />
         </div>

         <!-- Description -->
         <div class="mb-3">
          <label class="form-label" for="edit-description">Description</label>
          <textarea
           id="edit-description"
           name="description"
           class="form-control"
           rows="3"
           aria-label="Description"
           placeholder="Description"></textarea>
         </div>

         <!-- Submit and reset -->
         <div class="mb-3">
          <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Save Changes</button>
          <button type="reset" class="btn bg-label-danger" data-bs-dismiss="offcanvas">Discard</button>
         </div>
        </form>
       </div>
      </div>
     </div>
     <!-- / Content -->

     <!-- Footer -->
     <footer class="content-footer footer bg-footer-theme">
      <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
       <div class="mb-2 mb-md-0">
        ©
        <script>
         document.write(new Date().getFullYear());
        </script>
        , made with ❤️ by
        <a href="https://themeselection.com" target="_blank" class="footer-link fw-medium">ThemeSelection</a>
       </div>
       <div class="d-none d-lg-inline-block">
        <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
        <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More Themes</a>

        <a
         href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/documentation/"
         target="_blank"
         class="footer-link me-4">Documentation</a>

        <a
         href="https://themeselection.com/support/"
         target="_blank"
         class="footer-link d-none d-sm-inline-block">Support</a>
       </div>
      </div>
     </footer>
     <!-- / Footer -->

     <div class="content-backdrop fade"></div>
    </div>

   </div>
  </div>
 </div>
 <?php $this->load->view('layout/footer'); ?>
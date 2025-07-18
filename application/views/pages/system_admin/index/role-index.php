 <!-- Content wrapper -->
 <?php $this->load->view('layout/header'); ?>
 <div class="layout-wrapper layout-content-navbar">
   <div class="layout-container">
     <?php $this->load->view('layout/sidenav'); ?>
     <div class="layout-page">
       <?php $this->load->view('layout/navbar'); ?>

       <!-- Content -->

       <div class="container-xxl flex-grow-1 container-p-y">
         <h4 class="py-3 mb-2">Roles List</h4>

         <p class="mb-4">
           Each category (Basic, Professional, and Business) includes the four predefined roles shown below.
         </p>

         <!-- Permission Table -->
         <div class="card">
           <div class="card-datatable table-responsive">
             <table class="datatables-roles table border-top">
               <thead>
                 <tr>
                   <th></th>

                   <th>Name</th>
                   <th>Description</th>
                   <th>Created Date</th>
                   <th>Actions</th>
                 </tr>
               </thead>
             </table>
           </div>
         </div>

         <!-- Add Permission Modal -->
         <div class="modal fade" id="addPermissionModal" tabindex="-1" aria-hidden="true">
           <div class="modal-dialog modal-dialog-centered modal-simple">
             <div class="modal-content p-3 p-md-5">
               <div class="modal-body">
                 <button
                   type="button"
                   class="btn-close btn-pinned"
                   data-bs-dismiss="modal"
                   aria-label="Close"></button>
                 <div class="text-center mb-4">
                   <h3>Add New Role</h3>
                   <p>Roles you may use and assign to your users.</p>
                 </div>
                 <form id="addPermissionForm" class="row" onsubmit="return false">
                   <div class="col-12 mb-3">
                     <label class="form-label" for="modalRoleName">Role Name</label>
                     <input
                       type="text"
                       id="modalRoleName"
                       name="modalRoleName"
                       class="form-control"
                       placeholder="Role Name"
                       autofocus />
                   </div>
                   <div class="col-12 mb-3">
                     <label class="form-label" for="modalDescription">Description</label>
                     <input
                       type="text"
                       id="modalDescription"
                       name="modalDescription"
                       class="form-control"
                       placeholder="Description"
                       autofocus />
                   </div>
                   <div class="col-12 mb-2">
                     <div class="form-check">
                       <input class="form-check-input" type="checkbox" id="corePermission" />
                       <label class="form-check-label" for="corePermission"> Set as core Role </label>
                     </div>
                   </div>
                   <div class="col-12 text-center demo-vertical-spacing">
                     <button type="submit" class="btn btn-primary me-sm-3 me-1">Create Role</button>
                     <button
                       type="reset"
                       class="btn btn-label-secondary"
                       data-bs-dismiss="modal"
                       aria-label="Close">
                       Discard
                     </button>
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
                   <h3>Edit Permission</h3>
                   <p>Edit permission as per your requirements.</p>
                 </div>
                 <div class="alert alert-warning" role="alert">
                   <h6 class="alert-heading mb-2">Warning</h6>
                   <p class="mb-0">
                     By editing the permission name, you might break the system permissions functionality. Please
                     ensure you're absolutely certain before proceeding.
                   </p>
                 </div>
                 <form id="editPermissionForm" class="row" onsubmit="return false">
                   <div class="col-sm-9">
                     <label class="form-label" for="editPermissionName">Permission Name</label>
                     <input
                       type="text"
                       id="editPermissionName"
                       name="editPermissionName"
                       class="form-control"
                       placeholder="Permission Name"
                       tabindex="-1" />
                   </div>
                   <div class="col-sm-3 mb-3">
                     <label class="form-label invisible d-none d-sm-inline-block ">Button</label>
                     <button type="submit" class="btn btn-primary mt-1 mt-sm-0 edit-record">Update</button>
                   </div>
                   <div class="col-12">
                     <div class="form-check">
                       <input class="form-check-input" type="checkbox" id="editCorePermission" />
                       <label class="form-check-label" for="editCorePermission"> Set as core permission </label>
                     </div>
                   </div>
                 </form>
               </div>
             </div>
           </div>
         </div>

       </div>



       <div class="content-backdrop fade"></div>
     </div>

     <?php $this->load->view('layout/footer'); ?>
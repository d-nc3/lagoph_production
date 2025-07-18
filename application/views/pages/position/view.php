<?php   
    $id =   isset($info['id'])    &&  $info['id']   ?   strtoupper($info['id'])   :   0;
    $position_title =   isset($info['position_title'])    &&  $info['position_title']   ?   strtoupper($info['position_title'])   :   '-';
    $department_name =   isset($info['department_name'])    &&  $info['department_name']   ?   $info['department_name']   :   '-';
    $unit_name =   isset($info['unit_name'])    &&  $info['unit_name']   ?   $info['unit_name']   :   '-';
    $description =   isset($info['description'])    &&  $info['description']   ?   $info['description']   :   '-';
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
                        <div class="row">
                            <div class="col-xl-4 col-lg-5 col-md-5">
                                <!-- About User -->
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <small class="text-muted text-uppercase">About</small>
                                        <input type="hidden" id="id" name="id" class="form-control" value="<?=$id?>" readonly />
                                        <ul class="list-unstyled mb-4 mt-3">
                                            <li class="d-flex align-items-center">
                                                <span class="fw-medium mx-2">Position Name:</span>
                                            </li>
                                            <li class="d-flex align-items-center mb-3">
                                                <span class="text-muted mx-2"><?=$position_title?></span>
                                            </li>
                                            <li class="d-flex align-items-center">
                                                <span class="fw-medium mx-2">Department Name:</span>
                                            </li>
                                            <li class="d-flex align-items-center mb-3">
                                                <span class="text-muted mx-2"><?=$department_name?></span>
                                            </li>
                                            <li class="d-flex align-items-center">
                                                <span class="fw-medium mx-2">Unit Name:</span>
                                            </li>
                                            <li class="d-flex align-items-center mb-3">
                                                <span class="text-muted mx-2"><?=$unit_name?></span>
                                            </li>
                                            <li class="d-flex align-items-center">
                                                <span class="fw-medium mx-2">Description:</span>
                                            </li>
                                            <li class="d-flex align-items-center mb-3">
                                                <span class="text-muted mx-2"><?=$description?></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!--/ About User -->
                                <!-- Profile Overview -->
                                <div class="card mb-4">
                                    <div class="card-body">
                                    <small class="text-muted text-uppercase">Logs</small>
                                        <ul class="list-unstyled mt-3 mb-0">
                                            <li class="d-flex align-items-center">
                                                <span class="fw-medium mx-2">Created By:</span> <span class="text-muted"><?=$created_by?></span>
                                            </li>
                                            <li class="d-flex align-items-center">
                                                <span class="fw-medium mx-2">Created At:</span> <?=$created_at?></span>
                                            </li>
                                            <li class="d-flex align-items-center">
                                                <span class="fw-medium mx-2">Updated By:</span> <?=$updated_by?></span>
                                            </li>
                                            <li class="d-flex align-items-center">
                                                <span class="fw-medium mx-2">Updated At:</span> <?=$updated_at?></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!--/ Profile Overview -->
                            </div>
                            <div class="col-xl-8 col-lg-7 col-md-7">
                                <div class="card mb-4">
                                    <h5 class="card-header">Unit     List</h5>
                                    <div class="card-datatable table-responsive mb-3">
                                        <table class="table datatable-position border-top">
                                            <thead class="table-light">
                                            <tr>
                                                <th></th>
                                                <th>Unit Name</th>
                                                <th>Unit Head</th>
                                                <th>Description</th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
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
                                class="footer-link me-4"
                                >Documentation</a
                            >

                            <a
                                href="https://themeselection.com/support/"
                                target="_blank"
                                class="footer-link d-none d-sm-inline-block"
                                >Support</a
                            >
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
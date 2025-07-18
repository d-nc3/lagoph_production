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
                        <div class="card">
                          
                            <div class="card-datatable table-responsive">
                                <table class="datatables-cash-account table border-top">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Id</th>
                                            <th>Transaction Name</th>
                                            <th>Cash account &nbsp;</th>
                                            <th>Code of account &nbsp;</th>
                                            <th>Account type &nbsp;</th>
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
                                    <div class="mb-3">
                                        <label class="form-label" for="add-department-id">Transaction type</label>
                                        <select
                                            id="transactionType"
                                            class="select2 form-select"
                                            name="transaction_type"
                                            data-allow-clear="true" >
                                            <option value=""></option>
                                            <?php if(!empty($transactions)): ?>
                                                <?php foreach($transactions as $key => $val): ?>
                                                    <option value="<?=$val['id']?>"><?=$val['transaction_name']?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>

                                   
                                    <div class="mb-3">
                                        <label class="form-label" for="add-department-id">Cash Account </label>
                                        <select
                                            id="cash_account"
                                            class="select2 form-select"
                                            name="cash_account"
                                            data-allow-clear="true" >
                                            <option value=""></option>
                                            <?php if(!empty($cash_accounts)): ?>
                                                <?php foreach($cash_accounts as $key => $val): ?>
                                                    <option value="<?=$val['id']?>"><?=$val['title']?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>       

                                    <div class="mb-3">
                                        <label class="form-label" for="add-department-id">Account type</label>
                                        <select
                                            id="acountType"
                                            class="select2 form-select"
                                            name="account_type"
                                            data-allow-clear="true" >
                                            <option value="credit">Credit</option>
                                            <option value="debit">Debit</option>
                                           
                                        </select>
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
                                <h5 id="offCanvassEditLabel" class="offcanvas-title">Edit Transaction</h5>
                                <button type="button" class="btn-close bg-label-secondary text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>

                            <!-- Body -->
                            <div class="offcanvas-body border-top">
                                <form class="pt-0" id="editForm" onsubmit="return true">
                                    <input type="hidden" id="edit-id" name="id" class="form-control" readonly />
                                    
                                    <div class="mb-3">
                                        <label class="form-label" for="edit-transaction-type">Transaction type</label>
                                        <select
                                            id="edit-transaction-type"
                                            class="select2 form-select"
                                            name="transaction_type"
                                            data-allow-clear="true" >
                                            <option value=""></option>
                                            <?php if(!empty($transactions)): ?>
                                                <?php foreach($transactions as $key => $val): ?>
                                                    <option value="<?=$val['id']?>"><?=$val['transaction_name']?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
      
                                    <!-- Title -->
                                    <div class="mb-3">
                                        <label class="form-label" for="edit-cash-account">Cash Account </label>
                                        <select
                                            id="edit-cash-account"
                                            class="select2 form-select"
                                            name="cash_account"
                                            data-allow-clear="true" >
                                            <option value=""></option>
                                            <?php if(!empty($cash_accounts)): ?>
                                                <?php foreach($cash_accounts as $key => $val): ?>
                                                    <option value="<?=$val['id']?>"><?=$val['title']?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="add-department-id">Account type</label>
                                        <select
                                            id="acountType"
                                            class="select2 form-select"
                                            name="account_type"
                                            data-allow-clear="true" >
                                            <option value="credit">Credit</option>
                                            <option value="debit">Debit</option>
                                           
                                        </select>
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
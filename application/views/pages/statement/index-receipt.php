<?php

?>
<?php $this->load->view('layout/header'); ?>
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <?php $this->load->view('layout/sidenav'); ?>
        <div class="layout-page">
        <?php $this->load->view('layout/navbar'); ?>
          <!-- Content wrapper -->
          <div class="content-wrapper">
          <div class="container-md  container-p-y">
            <h4 class="py-3 mb-4"><span class="text-muted fw-light">Statements/</span> Receipts</h4>
            <div class="container-fluid">
                    <div class="row">
                      <div class="col-lg-12 mb-4">
                        <div class="card">
                            <hr/>
                            <div class="card-datatable table-responsive">
                              <table class="table-bordered  table-striped datatables-transactions table border-top">
                                  <thead>
                                      <tr>
                                          <th>Reference Number</th>
                                          <th>Date Issued</th>
                                          <th>Status</th>
                                          <th>Actions</th>
                                      </tr>
                                  </thead>
                              </table>
                            </div>
                        </div>

                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
    </div>

  <div class="content-backdrop fade"></div>
          </div>
<!--/ Content wrapper -->
</div>
<?php $this->load->view('layout/footer'); ?>
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
            <h4 class="py-3 mb-1"><span class="text-muted fw-light">Dashboard /</span> Member list</h4>
            <div class="row">

              <?php $this->load->view('pages/member/layout/profile', $info) ?>


              <!-- /Activity Timeline -->
              <div class="col-xl-12">
                <div class="card overflow-hidden mb-4">
                  <div class="card-datatable table-responsive">
                    <div class="card-header border-bottom">
                      <h5 class="card-title">Invoice Records</h5>

                    </div>
                    <table class="datatables-member table border-top">
                      <thead>
                        <tr>
                          <th></th>
                          <th>Invoice No.</th>
                          <th>Status</th>
                          <th>Amount</th>
                          <th>Date</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>

                <div class="card overflow-hidden mb-4 position-relative p-4">
                  <div class="card-datatable table-responsive">
                    <h5>Credit Balance</h5>
                    <h2>PHP <?= $credit_information['available_credit'] ?? NULL ?>
                      <p class="text-muted">Balance will increase the amount due on the customer's next invoice.</p>

                      <!-- Button positioned at the top right of the card -->
                      <button type="button" class="btn btn-primary position-absolute" style="top: 10px; right: 10px;"
                        data-bs-toggle="modal" data-bs-target="#creditBalanceModal">
                        Open Modal
                      </button>
                  </div>
                </div>


          

                <div class="modal fade" id="creditBalanceModal" tabindex="-1" aria-labelledby="adjustBalanceModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <form id="creditScoreForm" class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="adjustBalanceModalLabel">Adjust Balance</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>

                      <div class="modal-body">
                        <div class="row g-2 mb-3">
                          <div class="col-12">
                            <div class="border p-3 rounded text-center">
                              <p class="text-muted small mb-1">Current Balance</p>
                              <p class="fs-5 fw-semibold">PHP <?= $credit_information['available_credit'] ?? '0.00' ?></p>
                            </div>
                          </div>
                        </div>
                        <input type="hidden" name="userId" id="user_id" value="<?= $user_id?>">

                        <div class="mb-3">
                          <label class="form-label">Amount <span class="text-danger">*</span></label>
                          <input type="number" class="form-control" name="creditAmount" id="credit_amount" placeholder="Enter amount">
                        </div>

                        <div class="mb-3">
                          <label class="form-label">Add adjustment note <span class="text-danger">*</span></label>
                          <textarea class="form-control" rows="3" name="adjustmentNote" id="adjustment_note"></textarea>
                        </div>

                        <p class="text-muted small">
                          Please be aware that all manual balance changes will be audited by the financial team every fortnight.
                          Please maintain your invoices and receipts until then. Thank you.
                        </p>
                      </div>

                      <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Discard</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                    </form>
                  </div>
                </div>





                <!-- /Modal -->
              </div>

              <div class="content-backdrop fade"></div>
            </div>
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
<?php

$first_name = isset($info['first_name']) ? strtoupper($info['first_name']) : '';

$last_name = isset($info['last_name']) ? strtoupper($info['last_name']) : '';

$position = isset($info['position']) ? $info['position'] : '';

$date_hired = isset($info['date_hired']) ? $info['date_hired'] : '';

$address = isset($info['birth_place']) ? strtoupper($info['birth_place']) : '';

$mobile_number = isset($info['mobile_number']) ? '+63 ' . strtoupper($info['mobile_number']) : '';

$email = isset($info['email']) ? $info['email'] : '';

$position = isset($info['role']) ? $info['role'] : ' ';



// Path to user document or default image

$img_path_url = isset($user_documents['doc_path']) &&

  $user_documents['doc_path'] &&

  file_exists(FCPATH . $user_documents['doc_path']) ?

  base_url($user_documents['doc_path']) :

  base_url('assets/img/avatars/1.png');





?>





<?php $this->load->view('layout/header'); ?>

<div class="layout-wrapper layout-content-navbar">

  <div class="layout-container">

    <?php $this->load->view('layout/sidenav'); ?>

    <div class="layout-page">

      <?php $this->load->view('layout/navbar'); ?>

      <div class="content-wrapper">

        <div class="container-xxl flex-grow-1 container-p-y">

          <h4 class="py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Billings & Plans</h4>



          <div class="row">

            <div class="col-md-12">

              <?php $this->load->view('layout/settings-option/index'); ?>

              <!-- User Content -->



              <!-- Billing Address -->



              <div class="card mb-4">

                <?php if (!$billing_address): ?>

                  <h5 class="card-header">Billing Address</h5>

                  <div class="card-body">

                    <div class="row">

                      <!-- Billing Form Section -->



                      <div class="col-5">

                        <form id="billing_settings" onsubmit="return false">

                          <div class="row">

                            <!-- Billing Email -->

                            <div class="col-md-12 mb-3">

                              <label for="billingEmail" class="form-label">Billing Email</label>

                              <input class="form-control" type="email" id="billingEmail" name="billing_email"
                                placeholder="john.doe@example.com" />

                            </div>



                            <!-- Mobile Number -->

                            <div class="col-md-12 mb-3">

                              <label for="mobileNumber" class="form-label">Mobile</label>

                              <div class="input-group input-group-merge">

                                <span class="input-group-text">PH (+63)</span>

                                <input class="form-control mobile-number" type="text" id="mobileNumber"
                                  name="mobile_number" placeholder="202 555 0111" />

                              </div>

                            </div>



                            <!-- Address -->
                            <button type="button" class="btn bordered btn-primary" onclick="useCurrentLocation()">📍 Use
                              Current Location</button>
                            <div class="col-md-12 mb-3">

                              <label for="address" class="form-label">Address</label>

                              <input type="text" id="address" name="address" class="form-control"
                                placeholder="Unit/Building, Street, Barangay" />

                            </div>



                            <!-- Province -->

                            <div class="col-md-12 mb-3">

                              <label for="province" class="form-label">Province</label>

                              <input id="province" name="province" class="form-control"> </input>

                            </div>
                            <div class="col-md-12 mb-3">

                              <label for="city" class="form-label">City</label>

                              <input id="city" name="city" class="form-control"> </input>

                            </div>




                            <!-- Buttons -->

                            <div class="col-md-12 mt-3">

                              <button type="submit" class="btn btn-primary me-2 submit-billing">Save changes</button>

                              <button type="reset" class="btn btn-label-secondary">Reset</button>

                            </div>

                          </div>

                        </form>

                      </div>

                    <?php endif; ?>



                    <!-- Billing Details Section -->

                    <div class="col-7">

                      <h5 class="card-header mb-2">Billing Details</h5>

                      <div class="card-body">

                        <div class="billings" id="billing-address">

                          <!-- Billing address will be displayed here -->

                        </div>

                      </div>

                    </div>

                  </div>

                </div>





                <!--/ Billing Address -->

              </div>

              <!--/ Payment Methods -->

              <div class="card mb-4">


                <h5 class="card-header">Payment Methods</h5>

                <div class="card-body">

                  <div class="row">

                    <div class="col-md-6">



                      <form id="addNewAccForm" class="row g-3" onsubmit="return false">

                        <div class="col-6">

                          <label for="paymentMethod" class="form-label">Account Type</label>

                          <select class="form-select select2-search" id="accountType" name="account_type"
                            aria-label="Select Payment Option">

                            <option value=""></option>

                            <?php foreach ($account_types as $key => $val): ?>

                              <option value="<?= $val['id'] ?>"><?= $val['payment_name'] ?></option>

                            <?php endforeach; ?>

                          </select>

                        </div>



                        <div class="col-6">

                          <label for="paymentMethod" class="form-label">Financial Institution</label>

                          <select class="form-select select2-search" id="accountInstitution" name="account_institution"
                            aria-label="Select Financial Institution">

                            <option value=""></option>

                            <?php foreach ($payment_method as $method): ?>

                              <!-- Add a data attribute to link methods with a payment mode ID -->

                              <option value="<?= $method['id'] ?>" data-mode="<?= $method['account_type_id'] ?>">

                                <?= $method['financial_service_provider'] ?>

                              </option>

                            <?php endforeach; ?>

                          </select>

                        </div>



                        <div class="col-12 ">

                          <label class="form-label" for="modalEditName">Account Name</label>

                          <input type="text" id="modalAddName" name="modal_add_name" class="form-control"
                            placeholder="John Doe" value="" />

                        </div>



                        <div class="col-12">

                          <label class="form-label w-100" for="modalAddCard">Account Number</label>

                          <div class="input-group input-group-merge">

                            <input id="modalAddCard" name="modal_add_card_num" class="form-control credit-card-mask"
                              type="text" placeholder="1356 3215 6548 7898" aria-describedby="modalAddCard2" />

                            <span class="input-group-text cursor-pointer p-1" id="modalAddCard2"><span
                                class="card-type"></span></span>

                          </div>

                        </div>



                        <div class="col-12">

                          <button type="submit" class="btn btn-primary me-sm-3 me-1 mt-3">Submit</button>

                          <button type="reset" class="btn btn-label-secondary btn-reset mt-3" data-bs-dismiss="modal"
                            aria-label="Close">

                            Cancel

                          </button>

                        </div>

                      </form>

                    </div>

                    <div class="col-md-6 mt-5 mt-md-0">

                      <h6>My Cards</h6>

                      <div class="card-body">



                        <div class="added-cards" id="added-cards">



                        </div>

                      </div>

                    </div>

                  </div>

                </div>

              </div>

            </div>

          </div>

        </div>



        <!-- Add New billing Modal -->

        <div class="modal fade" id="editBillingAddress" tabindex="-1" aria-hidden="true">

          <div class="modal-dialog modal-lg modal-simple modal-add-new-address">

            <div class="modal-content p-3 p-md-5">

              <div class="modal-body">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                <div class="text-center mb-4">

                  <h3 class="address-title">Edit Billing Address</h3>

                </div>

                <form id="editForm" class="row g-3" onsubmit="return false">

                  <div class="col-12 mb-2">

                    <input type="hidden" id="edit-id" name="id" class="form-control" readonly />

                    <label class="form-label" for="edit_email">Email</label>

                    <input type="Email" id="edit-email-address" name="edit_email" class="form-control"
                      placeholder="John@example.com" />

                  </div>



                  <div class="col-12 mb-2">

                    <label class="form-label" for="edit_province">Province</label>

                    <select id="edit-province" name="edit_province" class="form-select select2-search"
                      data-allow-clear="true">

                      <option value=""></option>

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



                  <div class="col-12 mb-2">

                    <label class="form-label" for="edit_address">Address</label>

                    <input type="text" id="edit-address" name="edit_address" class="form-control"
                      placeholder="12, Business Park" />

                  </div>



                  <div class="col-12 mb-2">

                    <label class="form-label" for="edit_number">Mobile number</label>

                    <input type="Number" id="edit-mobile-number" name="edit_number" class="form-control"
                      placeholder="09xxx" />

                  </div>



                  <div class="col-12 text-center">

                    <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>

                    <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">

                      Cancel

                    </button>

                  </div>

                </form>

              </div>

            </div>

          </div>

        </div>



        <!-- edit card address -->

        <div class="modal fade" id="editCard" tabindex="-1" aria-hidden="true">

          <div class="modal-dialog modal-dialog-centered modal-simple modal-add-new-cc">

            <div class="modal-content p-3 p-md-5">

              <div class="modal-body">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>



                <div class="text-center mb-4">

                  <h3>Edit Card</h3>

                  <p>Edit your saved card details</p>

                </div>



                <form id="editCardForm" class="row g-3" onsubmit="return false">

                  <div class="mb-3">

                    <input type="hidden" id="edit-card-id" name="id" class="form-control" readonly />

                    <label for="edit-account-type" class="form-label">Account Type</label>

                    <select class="form-select select2-search" id="edit-account-type" name="edit_account_type" required>

                      <option value=""></option>

                      <?php foreach ($account_types as $key => $val): ?>

                        <option value="<?= $val['id'] ?>"><?= $val['payment_name'] ?></option>

                      <?php endforeach; ?>

                    </select>

                  </div>



                  <!-- Edit payment method here -->

                  <div class="mb-3">

                    <label for="edit-provider" class="form-label">Financial Service Provider</label>

                    <select class="form-select select2-search" id="edit-financial-provider"
                      name="edit_financial_provider" required>

                      <?php foreach ($payment_method as $method): ?>

                        <!-- Add a data attribute to link methods with a payment mode ID -->

                        <option value="<?= $method['id'] ?>" data-mode="<?= $method['account_type_id'] ?>">

                          <?= $method['financial_service_provider'] ?>

                        </option>

                      <?php endforeach; ?>

                    </select>

                  </div>



                  <!-- Account Name -->

                  <div class="mb-3">

                    <label for="edit-account-name" class="form-label">Account Name</label>

                    <input type="text" class="form-control" id="edit-account-name" name="edit_account_name"
                      placeholder="John Doe" required>

                  </div>



                  <!-- Account Number -->

                  <div class="mb-3">

                    <label for="edit-account-number" class="form-label">Account Number</label>

                    <input type="text" class="form-control" id="edit-account-number" name="edit_account_number"
                      required>

                  </div>

              </div>



              <div class="col-12 text-center">

                <button type="submit" class="btn btn-primary me-sm-3 me-1 mt-3">Submit</button>

                <button type="reset" class="btn btn-label-secondary mt-3" data-bs-dismiss="modal" aria-label="Close">

                  Cancel

                </button>

              </div>

              </form>

            </div>

          </div>

        </div>

      </div>



    </div>

    <!--/ User Profile Content -->

  </div>

</div>

<div class="content-backdrop fade"></div>

</div>

<!-- Content wrapper -->

</div>

</div>



<?php $this->load->view('layout/footer'); ?>
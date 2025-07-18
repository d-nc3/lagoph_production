<?php
$reference_number = strtoupper($info['reference_number'] ?? '');
$user_id = strtoupper($info['user_id'] ?? '');
$status = strtoupper($info['status'] ?? '');
$first_name = strtoupper($info['first_name'] ?? '');
$middle_name = strtoupper($info['middle_name'] ?? '');
$last_name = strtoupper($info['last_name'] ?? '');
$sex = $info['sex'] ?? '';
$civil_status = $info['civil_status'] ?? '';
$date_of_birth = strtoupper($info['date_of_birth'] ?? '');
$place_of_birth = strtoupper($info['place_of_birth'] ?? '');
$address = strtoupper($info['address'] ?? '');
$mobile_number = $info['mobile_number'] ? '+63 ' . strtoupper($info['mobile_number']) : '';
$tel_number = strtoupper($info['tel_number'] ?? '');
$email = $info['email'] ?? '';
$member_id = $info['id'] ?? '';

$age = !empty($info['date_of_birth']) ? date_diff(date_create($info['date_of_birth']), date_create(date('Y-m-d')))->format('%y') : '';

$spouse_name = strtoupper($info['spouse_name'] ?? '');
$spouse_occupation = strtoupper($info['spouse_occupation'] ?? '');
$spouse_mobile_number = strtoupper($info['spouse_mobile_number'] ?? '');


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
     <div class="row invoice-preview">
      <!-- Invoice -->
      <div class="col-xl-8 col-md-7 col-12 mb-md-0 mb-4">
       <div class="card mb-2">
        <div class="card-body">
         <div class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column p-sm-3 p-0">
          <div class="mb-xl-0 mb-4">
           <div class="d-flex mb-3 gap-2">
            <h3 class="fw-bold text-uppercase"><?= $reference_number ?></h3>
           </div>
           <p class="mb-1"><?= $first_name ?> <?= $middle_name ?> <?= $last_name ?></p>
           <p class="mb-1"><?= $email ?></p>
           <p class="mb-1"><?= $mobile_number ?></p>
           <p class="mb-0"><?= $address ?></p>
          </div>
          <div>
           <h4><?= $status ?></h4>
           <div class="mb-2">
            <span class="me-1">Date Applied:</span>
            <span class="fw-medium">25/08/2020</span>
           </div>
           <div>
            <span class="me-1">Date Approved:</span>
            <span class="fw-medium">29/08/2020</span>
           </div>
          </div>
         </div>
        </div>

        <hr />

        <div class="card-body">
         <div class="row p-sm-3 p-0">
          <div class="col-xl-6 col-md-12 col-sm-7 col-12">
           <table>
            <tbody>
             <tr>
              <td class="pe-3 text-muted">Age:</td>
              <td><?= $age ?></td>
             </tr>
             <tr>
              <td class="pe-3 text-muted">Sex:</td>
              <td><?= $sex ?></td>
             </tr>
             <tr>
              <td class="pe-3 text-muted">Civil Status:</td>
              <td><?= $civil_status ?></td>
             </tr>
             <tr>
              <td class="pe-3 text-muted">Date of Birth:</td>
              <td><?= $date_of_birth ?></td>
             </tr>
             <tr>
              <td class="pe-3 text-muted">Place of Birth:</td>
              <td><?= $place_of_birth ?></td>
             </tr>
             <tr>
              <td class="pe-3 text-muted">Telephone No.:</td>
              <td><?= $tel_number ?></td>
             </tr>
            </tbody>
           </table>
          </div>
          <div class="col-xl-6 col-md-12 col-sm-5 col-12 mb-xl-0 mb-md-4 mb-sm-0 mb-4">
           <h6 class="pb-2">Spouse:</h6>
           <?php if ($spouse_name || $spouse_occupation || $spouse_mobile_number): ?>
            <p class="mb-1"><?= $spouse_name ?></p>
            <p class="mb-1"><?= $spouse_occupation ?></p>
            <p class="mb-0"><?= $spouse_mobile_number ?></p>
           <?php else: ?>
            <p class="mb-0">Not Applicable</p>
           <?php endif; ?>
          </div>
         </div>
        </div>
       </div>
       <div class="card mb-2">
        <div class="card-body py-3">
         <h5 class="mb-0">Beneficiaries</h5>
        </div>
        <div class="table-responsive">
         <table class="table border-top m-0">
          <thead>
           <th class="text-nowrap">NAME</th>
           <th class="text-nowrap text-center">DATE OF BIRTH</th>
           <th class="text-nowrap text-center">RELATIONSHIP</th>
          </thead>
          <tbody>
           <?php if (!empty($beneficiaries)): ?>
            <?php foreach ($beneficiaries as $beneficiary): ?>
             <?php
             $beneficiary_name = isset($beneficiary['name']) && $beneficiary['name'] ? strtoupper($beneficiary['name']) : '';
             $beneficiary_birth_date = isset($beneficiary['date_of_birth']) && $beneficiary['date_of_birth'] ? strtoupper($beneficiary['date_of_birth']) : '';
             $beneficiary_relationship_type = isset($beneficiary['relationship_type']) && $beneficiary['relationship_type'] ? strtoupper($beneficiary['relationship_type']) : '';
             ?>
             <tr>
              <td class="text-nowrap"><?= $beneficiary_name ?></td>
              <td><?= $beneficiary_birth_date ?></td>
              <td><?= $beneficiary_relationship_type ?></td>
             </tr>
            <?php endforeach; ?>
           <?php else: ?>
            <tr>
             <td class="text-nowrap text-center" colspan="3">Not Applicable</td>
            </tr>
           <?php endif; ?>
          </tbody>
         </table>
        </div>
       </div>
       <div class="card mb-2">
        <div class="card-body py-3">
         <h5 class="mb-0">Educational Attainment</h5>
        </div>
        <div class="table-responsive">
         <table class="table border-top m-0">
          <thead>
           <th>LEVEL</th>
           <th class="text-nowrap">EDUCATION / COURSE</th>
           <th class="text-nowrap">SCHOOL / INSTITUTION</th>
          </thead>
          <tbody>
           <?php if (!empty($educ_backgrounds)): ?>
            <?php foreach ($educ_backgrounds as $educ_background): ?>
             <?php
             $educ_background_education_course = isset($educ_background['education_course']) && $educ_background['education_course'] ? strtoupper($educ_background['education_course']) : '';
             $educ_background_school_institution = isset($educ_background['school_institution']) && $educ_background['school_institution'] ? strtoupper($educ_background['school_institution']) : '';
             $educ_background_level = isset($educ_background['level']) && $educ_background['level'] ? strtoupper($educ_background['level']) : '';
             ?>
             <tr>
              <td><?= $educ_background_level ?></td>
              <td class="text-nowrap"><?= $educ_background_education_course ?></td>
              <td class="text-nowrap"><?= $educ_background_school_institution ?></td>
             </tr>
            <?php endforeach; ?>
           <?php else: ?>
            <tr>
             <td class="text-nowrap text-center" colspan="3">Not Applicable</td>
            </tr>
           <?php endif; ?>
          </tbody>
         </table>
        </div>
       </div>
       <div class="card mb-2">
        <div class="card-body py-3">
         <h5 class="mb-0">Work History</h5>
        </div>
        <div class="table-responsive">
         <table class="table border-top m-0">
          <tbody>
           <tr>
            <td>
             <div class="card-body p-1">
              <div class="row p-0">
               <?php if (!empty($educ_backgrounds)): ?>
                <?php foreach ($work_backgrounds as $work_background): ?>
                 <?php
                 $work_background_employment_status = isset($work_background['employment_status']) && $work_background['employment_status'] ? strtoupper($work_background['employment_status']) : '';
                 $work_background_occupation = isset($work_background['occupation']) && $work_background['occupation'] ? strtoupper($work_background['occupation']) : '';
                 $work_background_office = isset($work_background['office']) && $work_background['office'] ? strtoupper($work_background['office']) : '';
                 $work_background_address = isset($work_background['address']) && $work_background['address'] ? strtoupper($work_background['address']) : '';
                 $work_background_income = isset($work_background['income']) && $work_background['income'] ? strtoupper($work_background['income']) : '';
                 $work_background_tel_no = isset($work_background['tel_no']) && $work_background['tel_no'] ? strtoupper($work_background['tel_no']) : '';
                 ?>
                 <div class="col-md-6 mb-4">
                  <div class="d-flex ">
                   <h6 class="fw-bold text-uppercase">
                    <?= $work_background_employment_status ?>
                   </h6>
                  </div>
                  <p class="mb-0"><?= $work_background_occupation ?></p>
                  <p class="mb-0"><?= $work_background_office ?></p>
                  <p class="mb-0"><?= $work_background_address ?></p>
                  <p class="mb-0"><?= $work_background_tel_no ?></p>
                  <p class="mb-0"><?= $work_background_income ?></p>

                 </div>
                <?php endforeach; ?>
               <?php else: ?>
                <div class="col-md-12 text-center">
                 <span>Not Applicable</span>
                </div>
               <?php endif; ?>
              </div>
             </div>
            </td>
           </tr>
          </tbody>
         </table>
        </div>
       </div>
       <div class="card mb-2">
        <div class="card-body py-3">
         <ul class="list-unstyled">
          <li><span class="fw-medium">Have you ever been found guilty of any
            administrative offense?</span></li>
          <li><span class="text-muted"><?= $info['has_admin_offense'] ?>.
            <?= $info['admin_offense'] ?></span></li>
         </ul>
         <ul class="list-unstyled">
          <li><span class="fw-medium">Have you ever been charged or convicted of any crime
            by any court or tribunal?</span></li>
          <li><span class="text-muted"><?= $info['has_admin_offense'] ?>.
            <?= $info['admin_offense'] ?></span></li>
         </ul>
        </div>
       </div>
      </div>
      <!-- /Invoice -->

      <!-- Invoice Actions -->
      <div class="col-xl-4 col-md-5 col-12 invoice-actions">
       <div class="card">
        <div class="card-body">
         <h5>Attachments</h5>

         <?php if (!empty($documents)): ?>
          <ol class="mb-0">
           <?php foreach ($documents as $document): ?>
            <?php
            $document_type = isset($document['document_type']) ? $document['document_type'] : 'N/A';
            $document_path = isset($document['doc_path']) ? base_url($document['doc_path']) : 'javascript:;';
            ?>
            <li><a class="h6" href="<?= $document_path ?>" target="_blank"><?= $document_type ?></a></li>
           <?php endforeach; ?>
          </ol>
         <?php else: ?>
          <ul class="list-unstyled mb-0">
           <li class="mb-3 text-center">
            <h6 class="mb-0">No Documents Available</h6>
           </li>
          </ul>
         <?php endif; ?>

         <hr class="m-4" />

         <?php if (!empty($payment_records)): ?>
          <h5>Payment Records</h5>
          <ol class="mb-0">
           <?php foreach ($payment_records as $payment): ?>
            <?php
            $payment_proof = isset($payment['payment_proof']) ? base_url($payment['payment_proof']) : 'javascript:;';
            $receipt_number = isset($payment['official_receipt_number']) ? $payment['official_receipt_number'] : 'No Receipt';
            ?>
            <li><a class="h6" href="<?= $payment_proof ?>" target="_blank"><?= $receipt_number ?></a></li>
           <?php endforeach; ?>
          </ol>
         <?php else: ?>
          <ul class="list-unstyled mb-0">
           <li class="mb-3 text-center">
            <h6 class="mb-0">No Payment Records Found</h6>
           </li>
          </ul>
         <?php endif; ?>

        </div>
        <div class="card-footer">
         <button class="btn btn-success d-grid w-100 mb-2 button-approve" data-application-id="<?= $user_id ?>" data-member-id="<?=$member_id?>">
          <span class="d-flex align-items-center justify-content-center text-nowrap">
           <i class="bx bx-check bx-xs me-1"></i>APPROVE APPLICATION
          </span>
         </button>
         <button class="btn btn-danger d-grid w-100" data-bs-toggle="modal" data-bs-target="#modalCenter">
          <span class="d-flex align-items-center justify-content-center text-nowrap">
           <i class="bx bx-x bx-xs me-1"></i>DISAPPROVE APPLICATION
          </span>
         </button>
        </div>
       </div>
      </div>

      <!-- /Invoice Actions -->
     </div>


     <div class="modal fade" id="modalCenter" tabindex="-1" aria-modal="true">
      <div class="modal-dialog modal-lg modal-dialog-centered modal-simple modal-upgrade-plan">
       <div class="modal-content p-3 p-md-5">
        <div class="modal-body p-2">
         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         <div id="wizard-create-app" class="bs-stepper vertical mt-2 shadow-none border-0">

          <div class="bs-stepper-header border-0 p-1">

           <div class="step active" data-target="#details">
            <button type="button" class="step-trigger" aria-selected="true">
             <span class="bs-stepper-circle"><i class="bx bx-file fs-5"></i></span>
             <span class="bs-stepper-label">
              <span class="bs-stepper-title text-uppercase">Reject
               Application</span>
              <span class="bs-stepper-subtitle">Enter Details</span>
             </span>
            </button>
           </div>

           <div class="line"></div>
           <div class="step" data-target="#submit">
            <button type="button" class="step-trigger" aria-selected="false">
             <span class="bs-stepper-circle"><i class="bx bx-check fs-5"></i></span>
             <span class="bs-stepper-label">
              <span class="bs-stepper-title text-uppercase">Submit</span>
              <span class="bs-stepper-subtitle">Submit</span>
             </span>
            </button>
           </div>
          </div>

          <div class="bs-stepper-content p-1">
           <div id="details" class="content pt-3 pt-lg-0 dstepper-block active">
            <div class="mb-3">
             <label for="remarks-reject" class="form-label">Remarks</label>
             <textarea id="remarks-reject" class="form-control" placeholder="Enter Remarks"></textarea>
            </div>

            <div class="col-12 d-flex justify-content-between mt-4">
             <button class="btn btn-primary btn-next">
              <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
              <i class="bx bx-right-arrow-alt bx-xs"></i>
             </button>
            </div>
           </div>
           <div id="submit" class="content text-center pt-3 pt-lg-0 dstepper-block">
            <h5 class="mb-2 mt-3">Submit</h5>
            <p>Submit to kick start your project.</p>
            <img src="../../assets/img/illustrations/man-with-laptop-light.png" alt="Create App img" width="200"
             class="img-fluid" data-app-light-img="illustrations/man-with-laptop-light.png"
             data-app-dark-img="illustrations/man-with-laptop-dark.png">
            <div class="col-12 d-flex justify-content-between mt-4 pt-2">
             <button class="btn btn-label-secondary btn-prev" data-bs-dismiss="modal">
              <i class="bx bx-left-arrow-alt bx-xs me-sm-1 me-0"></i>
              <span class="align-middle d-sm-inline-block d-none">Close</span>
             </button>
             <button class="btn btn-success btn-submit">
              <span class="align-middle d-sm-inline-block d-none button-reject">Reject
               Application</span>
              <i class="bx bx-check bx-xs ms-sm-1 ms-0"></i>
             </button>
            </div>
           </div>
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
         <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More
          Themes</a>

         <a href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/documentation/" target="_blank"
          class="footer-link me-4">Documentation</a>

         <a href="https://themeselection.com/support/" target="_blank"
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
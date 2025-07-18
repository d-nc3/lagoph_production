<?php
$reference_number =   isset($membership['reference_number'])    &&  $membership['reference_number']   ?   strtoupper($membership['reference_number'])   :   '';
$status =   isset($membership['status'])    &&  $membership['status']   ?   strtoupper($membership['status'])   :   '';
$first_name =   isset($membership['first_name'])    &&  $membership['first_name']   ?   strtoupper($membership['first_name'])   :   '';
$middle_name =   isset($membership['middle_name'])    &&  $membership['middle_name']   ?    strtoupper($membership['middle_name'])   :   '';
$last_name =   isset($membership['last_name'])    &&  $membership['last_name']   ?   strtoupper($membership['last_name'])   :   '';
$sex =   isset($membership['sex'])    &&  $membership['sex']   ?   $membership['sex']   :   '';
$civil_status =   isset($membership['civil_status'])    &&  $membership['civil_status']   ?   $membership['civil_status']   :   '';
$date_of_birth =   isset($membership['date_of_birth'])    &&  $membership['date_of_birth']   ?   strtoupper($membership['date_of_birth'])   :   '';
$place_of_birth =   isset($membership['place_of_birth'])    &&  $membership['place_of_birth']   ?   strtoupper($membership['place_of_birth'])   :   '';
$address =   isset($membership['address'])    &&  $membership['address']   ?   strtoupper($membership['address'])   :   '';
$mobile_number =   isset($membership['mobile_number'])    &&  $membership['mobile_number']   ?  '+63 ' . strtoupper($membership['mobile_number'])   :   '';
$tel_number =   isset($membership['tel_number'])    &&  $membership['tel_number']   ?   strtoupper($membership['tel_number'])   :   '';
$email =   isset($membership['email'])    &&  $membership['email']   ?  $membership['email']   :   '';

$diff = date_diff(date_create($membership['date_of_birth']), date_create(DATE_NOW));
$age = $diff->format('%y');

$spouse_name =   isset($membership['spouse_name'])    &&  $membership['spouse_name']   ?   strtoupper($membership['spouse_name'])   :   '';
$spouse_occupation =   isset($membership['spouse_occupation'])    &&  $membership['spouse_occupation']   ?   strtoupper($membership['spouse_occupation'])   :   '';
$spouse_mobile_number =   isset($membership['spouse_mobile_number'])    &&  $membership['spouse_mobile_number']   ?   strtoupper($membership['spouse_mobile_number'])   :   '';
?>

<?php $this->load->view('layout/header'); ?>
<div class="layout-wrapper layout-content-navbar">
 <div class="layout-container">
  <?php $this->load->view('layout/sidenav'); ?>
  <div class="layout-page">
   <?php $this->load->view('layout/navbar'); ?>

   <!-- Content wrapper -->

    <div class="container-xxl flex-grow-1 container-p-y">
     <div class="row invoice-preview">
      <!-- Invoice -->
      <div class="col-xl-12 col-md-12 col-12 mb-md-0 mb-4">
       <div class="card mb-2">
        <div class="card-body">
         <div
          class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column p-sm-3 p-0">
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
          <tbody>
           <?php if (!empty($beneficiaries)): ?>
            <?php foreach ($beneficiaries as $beneficiary): ?>
             <?php
             $beneficiary_name =   isset($beneficiary['name'])    &&  $beneficiary['name']   ?   strtoupper($beneficiary['name'])   :   '';
             $beneficiary_birth_date =   isset($beneficiary['date_of_birth'])    &&  $beneficiary['date_of_birth']   ?   strtoupper($beneficiary['date_of_birth'])   :   '';
             $beneficiary_relationship_type =   isset($beneficiary['relationship_type'])    &&  $beneficiary['relationship_type']   ?   strtoupper($beneficiary['relationship_type'])   :   '';
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
          <tbody>
           <?php if (!empty($educ_backgrounds)): ?>
            <?php foreach ($educ_backgrounds as $educ_background): ?>
             <?php
             $educ_background_education_course =   isset($educ_background['education_course'])    &&  $educ_background['education_course']   ?   strtoupper($educ_background['education_course'])   :   '';
             $educ_background_school_institution =   isset($educ_background['school_institution'])    &&  $educ_background['school_institution']   ?   strtoupper($educ_background['school_institution'])   :   '';
             $educ_background_level =   isset($educ_background['level'])    &&  $educ_background['level']   ?   strtoupper($educ_background['level'])   :   '';
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
                <?php foreach ($work_experience as $work_background): ?>
                 <?php
                 $work_background_employment_status =   isset($work_background['employment_status'])    &&  $work_background['employment_status']   ?   strtoupper($work_background['employment_status'])   :   '';
                 $work_background_occupation =   isset($work_background['occupation'])    &&  $work_background['occupation']   ?   strtoupper($work_background['occupation'])   :   '';
                 $work_background_office =   isset($work_background['office'])    &&  $work_background['office']   ?   strtoupper($work_background['office'])   :   '';
                 $work_background_address =   isset($work_background['address'])    &&  $work_background['address']   ?   strtoupper($work_background['address'])   :   '';
                 $work_background_income =   isset($work_background['income'])    &&  $work_background['income']   ?   strtoupper($work_background['income'])   :   '';
                 $work_background_tel_no =   isset($work_background['tel_no'])    &&  $work_background['tel_no']   ?  strtoupper($work_background['tel_no'])   :   '';
                 ?>
                 <div class="col-md-6 mb-4">
                  <div class="d-flex ">
                   <h6 class="fw-bold text-uppercase"><?= $work_background_employment_status ?></h6>
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
          <li><span class="fw-medium">Have you ever been found guilty of any administrative offense?</span></li>
          <li><span class="text-muted"><?= $membership['has_admin_offense'] ?>. <?= $membership['admin_offense'] ?></span></li>
         </ul>
         <ul class="list-unstyled">
          <li><span class="fw-medium">Have you ever been charged or convicted of any crime by any court or tribunal?</span></li>
          <li><span class="text-muted"><?= $membership['has_admin_offense'] ?>. <?= $membership['admin_offense'] ?></span></li>
         </ul>
        </div>
       </div>
      </div>
      <!-- /Invoice -->

      <!-- Invoice Actions -->
      <div class="col-xl-12 col-md-12 col-12 invoice-actions">
       <div class="card">
        <div class="card-body">
         <div class="row p-sm-3 p-0">
          <div class="col-xl-6 col-md-12 col-6">
           <h5>Attachments</h5>
           <?php if (!empty($documents)): ?>
            <ol class="mb-0">
             <?php foreach ($documents as $document): ?>
              <?php
              $document_type =   isset($document['document_type'])    &&  $document['document_type']   ?   $document['document_type']   :   '';
              $document_path =   isset($document['doc_path'])    &&  $document['doc_path']   ?  base_url($document['doc_path'])   :   'javascript:;';
              ?>
              <li><a class="h6" href="<?= $document_path ?>" target="_blank"><?= $document_type ?></a></li>
             <?php endforeach; ?>
            </ol>
           <?php else: ?>
            <ul class="list-unstyled mb-0">
             <li class="mb-3">
              <div class="text-center me-2">
               <h6 class="mb-0">N/A</h6>
              </div>
             </li>
            </ul>
           <?php endif; ?>
          </div>
          <div class="col-xl-6 col-md-12 col-6">
           <h4>Referred by:</h4>
           <div class="mb-2">
            <span class="me-1"><?=$referral_member['first_name']?> <?= $referral_member['last_name']?></span>
           </div>
          </div>
         </div>
        </div>
       </div>
      </div>
      <!-- /Invoice Actions -->
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
     
       <a href="https://themeselection.com" target="_blank" class="footer-link fw-medium">Lago PH</a>
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
   <!-- Content wrapper -->

  </div>
 </div>
</div>
<?php $this->load->view('layout/footer'); ?>